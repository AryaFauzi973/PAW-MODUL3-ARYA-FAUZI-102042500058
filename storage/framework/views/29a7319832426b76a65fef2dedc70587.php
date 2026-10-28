<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Anggota</h2>
        <p class="text-muted mb-0">Kelola data keanggotaan perpustakaan.</p>
    </div>
    <a href="<?php echo e(route('anggota.create')); ?>" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i> Tambah Anggota
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 50px;">No</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th class="text-end pe-3" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3 text-muted"><?php echo e($anggota->firstItem() + $index); ?></td>
                            <td class="fw-semibold text-dark"><?php echo e($item->nama); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->no_hp); ?></td>
                            <td class="text-end pe-3">
                                <a href="<?php echo e(route('anggota.show', $item->id)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('anggota.edit', $item->id)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('anggota.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Belum ada data anggota tersedia.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($anggota->hasPages()): ?>
        <div class="card-footer bg-white py-3">
            <?php echo e($anggota->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\Sistem_Peminjaman_Buku\resources\views/anggota/index.blade.php ENDPATH**/ ?>