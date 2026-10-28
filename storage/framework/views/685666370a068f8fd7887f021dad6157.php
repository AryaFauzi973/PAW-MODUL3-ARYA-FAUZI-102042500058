<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="fw-bold mb-0">Daftar Peminjaman</h2>
        <p class="text-muted small mb-0">Kelola transaksi peminjaman dan pengembalian buku.</p>
    </div>
    <a href="<?php echo e(route('peminjaman.create')); ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Peminjaman
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $__empty_1 = true; $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($peminjaman->firstItem() + $loop->index); ?></td>
                        <td><?php echo e($p->anggota->nama); ?></td>
                        <td><?php echo e($p->buku->judul); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/Y')); ?></td>
                        <td><?php echo e($p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/Y') : '-'); ?></td>
                        <td>
                            <?php if($p->status === 'dipinjam'): ?>
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if($p->status === 'dipinjam'): ?>
                                <form action="<?php echo e(route('peminjaman.kembali', $p->id)); ?>" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tandai buku ini sudah dikembalikan?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-return-left"></i> Kembalikan
                                    </button>
                                </form>
                            <?php endif; ?>
                            <form action="<?php echo e(route('peminjaman.destroy', $p->id)); ?>" method="POST" class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman buku.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <?php echo e($peminjaman->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\Sistem_Peminjaman_Buku\resources\views/peminjaman/index.blade.php ENDPATH**/ ?>