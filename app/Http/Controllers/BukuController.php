<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::orderBy('judul')->paginate(10);
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

    // TODO 5: validasi dan simpan data buku baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'        => 'required|string|min:3|max:150',
            'penulis'      => 'required|string|min:3|max:100',
            'penerbit'     => 'required|string|min:3|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'stok'         => 'required|integer|min:0',
        ]);

        Buku::create($data);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load('peminjaman.anggota');
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'judul'        => 'required|string|min:3|max:150',
            'penulis'      => 'required|string|min:3|max:100',
            'penerbit'     => 'required|string|min:3|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'stok'         => 'required|integer|min:0',
        ]);

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        // Buku yang masih dipinjam tidak boleh dihapus
        if ($buku->peminjaman()->where('status', 'dipinjam')->exists()) {
            return back()->with('error', 'Buku masih dipinjam, tidak dapat dihapus.');
        }

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}