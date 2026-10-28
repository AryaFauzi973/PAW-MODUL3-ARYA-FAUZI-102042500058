<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar semua transaksi peminjaman buku.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->paginate(10);

        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Menampilkan form peminjaman buku.
     */
    public function create()
    {
        $anggota = Anggota::orderBy('nama')->get();
        // Buku dengan stok 0 tidak boleh dipilih
        $buku = Buku::where('stok', '>', 0)->orderBy('judul')->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    /**
     * TODO 7: validasi transaksi, simpan data, kurangi stok buku.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'     => 'required|exists:anggota,id',
            'buku_id'        => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // lockForUpdate mencegah dua transaksi mengambil stok yang sama
                $buku = Buku::lockForUpdate()->findOrFail($request->buku_id);

                if ($buku->stok <= 0) {
                    throw new \RuntimeException('Stok buku "' . $buku->judul . '" habis. Peminjaman ditolak.');
                }

                Peminjaman::create([
                    'anggota_id'      => $request->anggota_id,
                    'buku_id'         => $buku->id,
                    'tanggal_pinjam'  => $request->tanggal_pinjam,
                    'tanggal_kembali' => null,
                    'status'          => 'dipinjam',
                ]);

                $buku->decrement('stok');
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat dan stok buku dikurangi.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['anggota', 'buku']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Pengembalian buku: ubah status, isi tanggal kembali, tambah stok.
     */
    public function kembali(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->update([
                'status'          => 'dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            $peminjaman->buku()->increment('stok');
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok bertambah.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            // Jika masih dipinjam, stok dikembalikan agar tidak hilang
            if ($peminjaman->status === 'dipinjam') {
                $peminjaman->buku()->increment('stok');
            }
            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}