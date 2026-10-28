<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::orderBy('nama')->paginate(10);
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    // TODO 6: validasi dan simpan data anggota baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required|string|min:3|max:100',
            'email' => 'required|email|max:100|unique:anggota,email',
            'no_hp' => 'required|string|max:15',
        ]);

        Anggota::create($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        $anggota->load('peminjaman.buku');
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->validate([
            'nama'  => 'required|string|min:3|max:100',
            'email' => 'required|email|max:100|unique:anggota,email,' . $anggota->id,
            'no_hp' => 'required|string|max:15',
        ]);

        $anggota->update($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        if ($anggota->peminjaman()->where('status', 'dipinjam')->exists()) {
            return back()->with('error', 'Anggota masih memiliki buku yang belum dikembalikan.');
        }

        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}