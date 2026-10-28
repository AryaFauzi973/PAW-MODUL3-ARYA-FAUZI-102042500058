@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="fw-bold mb-0">Transaksi Peminjaman Buku</h2>
                <p class="text-muted small mb-0">Catat peminjaman buku oleh anggota perpustakaan.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Pesan error dari controller (misalnya stok habis) --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">
                {{-- TODO 9: formulir peminjaman --}}
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="anggota_id" class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" id="anggota_id"
                                class="form-select @error('anggota_id') is-invalid @enderror">
                            <option value="">-- Pilih Anggota Peminjam --</option>
                            @foreach ($anggota as $a)
                                <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" id="buku_id"
                                class="form-select @error('buku_id') is-invalid @enderror">
                            <option value="">-- Pilih Buku yang Dipinjam --</option>
                            @foreach ($buku as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }} (stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i>
                            Hanya buku dengan stok &gt; 0 yang muncul dalam pilihan. Stok akan otomatis berkurang 1.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                               class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                               value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
                        @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2"></i> Simpan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection