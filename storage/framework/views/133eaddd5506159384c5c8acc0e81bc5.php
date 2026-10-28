<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Detail Anggota</h3>
                <p class="text-muted small mb-0">Informasi anggota dan riwayat peminjaman buku.</p>
            </div>
            <div>
                <a href="<?php echo e(route('anggota.edit', $anggota->id)); ?>" class="btn btn-primary btn-sm me-1">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="<?php echo e(route('anggota.index')); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="mb-3">
                    <h4 class="fw-bold mb-0 text-dark"><?php echo e($anggota->nama); ?></h4>
                    <span class="text-muted small">Anggota Terdaftar sejak <?php echo e($anggota->created_at->translatedFormat('d F Y')); ?></span>
                </div>

                <div class="row g-2 pt-2 border-top">
                    <div class="col-sm-3 fw-semibold text-muted">Email</div>
                    <div class="col-sm-9 text-dark"><?php echo e($anggota->email); ?></div>

                    <div class="col-sm-3 fw-semibold text-muted">Nomor Handphone</div>
                    <div class="col-sm-9 text-dark"><?php echo e($anggota->no_hp); ?></div>
                </div>
            </div>
        </div>

        <!-- Riwayat Peminjaman oleh Anggota Ini -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Riwayat Peminjaman Buku</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $anggota->peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-3 fw-semibold"><?php echo e($pinjam->buku->judul ?? '-'); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($pinjam->tanggal_pinjam)->translatedFormat('d F Y')); ?></td>
                                    <td>
                                        <?php if($pinjam->tanggal_kembali): ?>
                                            <?php echo e(\Carbon\Carbon::parse($pinjam->tanggal_kembali)->translatedFormat('d F Y')); ?>

                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($pinjam->status === 'Dipinjam'): ?>
                                            <span class="badge bg-secondary">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge bg-dark">Dikembalikan</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Anggota ini belum pernah meminjam buku.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\Sistem_Peminjaman_Buku\resources\views/anggota/show.blade.php ENDPATH**/ ?>