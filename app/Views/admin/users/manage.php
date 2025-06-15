<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h3><?= esc($title ?? 'Manajemen Pengguna') ?></h3>
        </div>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td>
                                    <?php 
                                        $roles = [1 => 'Admin', 2 => 'Editor', 3 => 'Wartawan'];
                                        echo $roles[$user['role_id']] ?? 'Tidak Diketahui';
                                    ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $user['status'] == 'approved' ? 'success' : 'warning' ?>">
                                        <?= esc(ucfirst($user['status'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('admin/users/delete/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
