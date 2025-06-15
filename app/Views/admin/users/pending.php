<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <h3><?= esc($title ?? 'Persetujuan Pengguna') ?></h3>
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
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= date('d M Y, H:i', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/users/approve/' . $user['id']) ?>" class="btn btn-sm btn-success">Setujui</a>
                                        <a href="<?= site_url('admin/users/reject/' . $user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak dan menghapus pengguna ini?')">Tolak</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pengguna yang menunggu persetujuan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
