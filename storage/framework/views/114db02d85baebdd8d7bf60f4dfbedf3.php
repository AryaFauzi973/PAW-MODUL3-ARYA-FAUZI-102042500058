<?php $__env->startSection('content'); ?>
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="fw-bold mb-1">Dashboard Perpustakaan</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <strong><?php echo e(Auth::user()->name); ?></strong>. Berikut ringkasan operasional perpustakaan.</p>
    </div>
    <div class="col-auto">
        <a href="<?php echo e(route('peminjaman.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Transaksi Peminjaman Baru
        </a>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card p-3 shadow-sm bg-white">
            <span class="text-muted small d-block mb-1">Total Koleksi Buku</span>
            <h3 class="fw-bold mb-0 text-dark"><?php echo e($totalBuku); ?></h3>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card p-3 shadow-sm bg-white">
            <span class="text-muted small d-block mb-1">Total Anggota</span>
            <h3 class="fw-bold mb-0 text-dark"><?php echo e($totalAnggota); ?></h3>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card p-3 shadow-sm bg-white">
            <span class="text-muted small d-block mb-1">Sedang Dipinjam</span>
            <h3 class="fw-bold mb-0 text-dark"><?php echo e($totalPeminjamanAktif); ?></h3>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card p-3 shadow-sm bg-white">
            <span class="text-muted small d-block mb-1">Sudah Dikembalikan</span>
            <h3 class="fw-bold mb-0 text-dark"><?php echo e($totalPeminjamanSelesai); ?></h3>
        </div>
    </div>
</div>

<!-- Riwayat Peminjaman Terbaru -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">5 Transaksi Peminjaman Terbaru</h5>
        <a href="<?php echo e(route('peminjaman.index')); ?>" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $peminjamanTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3 fw-semibold"><?php echo e($item->anggota->nama ?? '-'); ?></td>
                            <td><?php echo e($item->buku->judul ?? '-'); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y')); ?></td>
                            <td>
                                <?php if($item->tanggal_kembali): ?>
                                    <?php echo e(\Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($item->status === 'Dipinjam'): ?>
                                    <span class="badge bg-secondary">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge bg-dark">Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Belum ada riwayat transaksi peminjaman.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\Sistem_Peminjaman_Buku\resources\views/dashboard.blade.php ENDPATH**/ ?>