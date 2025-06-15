<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h3><?= esc($title ?? 'Form Pengguna') ?></h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('/admin/users/update/' . $user['id']) ?>" method="post">
                <?= csrf_field() ?>

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= esc($user['name']) ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role_id" class="form-label">Peran</label>
                    <select class="form-select" id="role_id" name="role_id">
                        <option value="1" <?= $user['role_id'] == 1 ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= $user['role_id'] == 2 ? 'selected' : '' ?>>Editor</option>
                        <option value="3" <?= $user['role_id'] == 3 ? 'selected' : '' ?>>Wartawan</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="pending" <?= $user['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="approved" <?= $user['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                    </select>
                </div>

                <!-- Password (Optional) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= site_url('/admin/users') ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
