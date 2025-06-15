<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <h3><?= esc($title ?? 'Kelola Postingan') ?></h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= site_url('/posts/create') ?>" class="btn btn-primary">Tambah Postingan Baru</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($post['title']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $post['status'] == 'published' ? 'success' : ($post['status'] == 'pending' ? 'warning' : 'danger') ?>">
                                            <?= esc(ucfirst($post['status'])) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y, H:i', strtotime($post['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= site_url('posts/edit/' . $post['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('posts/delete/' . $post['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada postingan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
