<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Daftar Buku</h2>
        <p class="text-muted mb-0">Kelola data koleksi buku perpustakaan.</p>
    </div>
    <a href="<?php echo e(route('buku.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3" style="width: 50px;">No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th class="text-center">Tahun</th>
                        <th class="text-center">Stok</th>
                        <th class="text-end pe-3" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3 text-muted"><?php echo e($buku->firstItem() + $index); ?></td>
                            <td class="fw-semibold text-dark"><?php echo e($item->judul); ?></td>
                            <td><?php echo e($item->penulis); ?></td>
                            <td><?php echo e($item->penerbit); ?></td>
                            <td class="text-center"><?php echo e($item->tahun_terbit); ?></td>
                            <td class="text-center">
                                <?php if($item->stok > 0): ?>
                                    <span class="badge bg-secondary px-2 py-1"><?php echo e($item->stok); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-dark px-2 py-1">Habis (0)</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-3">
                                <a href="<?php echo e(route('buku.show', $item->id)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('buku.edit', $item->id)); ?>" class="btn btn-sm btn-outline-secondary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('buku.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
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
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data buku tersedia.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($buku->hasPages()): ?>
        <div class="card-footer bg-white py-3">
            <?php echo e($buku->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\Sistem_Peminjaman_Buku\resources\views/buku/index.blade.php ENDPATH**/ ?>