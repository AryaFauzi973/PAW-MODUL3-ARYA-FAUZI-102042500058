<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Transaksi Peminjaman Buku</h3>
                <p class="text-muted small mb-0">Catat peminjaman buku oleh anggota perpustakaan.</p>
            </div>
            <a href="<?php echo e(route('peminjaman.index')); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?php echo e(route('peminjaman.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Pilih Anggota -->
                    <div class="mb-3">
                        <label for="anggota_id" class="form-label fw-semibold">Pilih Anggota <span class="text-danger">*</span></label>
                        <select class="form-select <?php $__errorArgs = ['anggota_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="anggota_id" name="anggota_id" required>
                            <option value="" disabled <?php echo e(old('anggota_id') ? '' : 'selected'); ?>>-- Pilih Anggota Peminjam --</option>
                            <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(old('anggota_id') == $item->id ? 'selected' : ''); ?>>
                                    <?php echo e($item->nama); ?> (<?php echo e($item->no_hp); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['anggota_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Pilih Buku -->
                    <div class="mb-3">
                        <label for="buku_id" class="form-label fw-semibold">Pilih Buku <span class="text-danger">*</span></label>
                        <select class="form-select <?php $__errorArgs = ['buku_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="buku_id" name="buku_id" required>
                            <option value="" disabled <?php echo e(old('buku_id') ? '' : 'selected'); ?>>-- Pilih Buku yang Dipinjam --</option>
                            <?php $__empty_1 = true; $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(old('buku_id') == $item->id ? 'selected' : ''); ?>>
                                    <?php echo e($item->judul); ?> — Penulis: <?php echo e($item->penulis); ?> (Tersedia: <?php echo e($item->stok); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" disabled>Tidak ada buku dengan stok tersedia saat ini</option>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['buku_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text small text-muted">
                            <i class="bi bi-info-circle me-1"></i> Hanya buku dengan stok &gt; 0 yang muncul dalam pilihan. Stok akan otomatis berkurang 1.
                        </div>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="mb-4">
                        <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" class="form-control <?php $__errorArgs = ['tanggal_pinjam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo e(old('tanggal_pinjam', date('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['tanggal_pinjam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?php echo e(route('peminjaman.index')); ?>" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4" <?php echo e($buku->isEmpty() ? 'disabled' : ''); ?>>
                            <i class="bi bi-check-lg me-1"></i> Simpan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Sistem_Peminjaman_Buku\resources\views/peminjaman/create.blade.php ENDPATH**/ ?>