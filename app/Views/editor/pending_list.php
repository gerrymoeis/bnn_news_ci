<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
                <h3><?= esc($title ?? 'Review Postingan') ?></h3>
                <p>Postingan yang menunggu persetujuan Anda.</p>
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
                            <th>Penulis</th>
                            <th>Kategori</th>
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
                                    <td><?= esc($post['author_name']) ?></td>
                                    <td><?= esc($post['category_name']) ?></td>
                                    <td><?= date('d M Y, H:i', strtotime($post['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= site_url('post/' . $post['slug']) ?>" class="btn btn-sm btn-info" target="_blank">Lihat</a>
                                        <a href="<?= site_url('editor/approve/' . $post['id']) ?>" class="btn btn-sm btn-success" onclick="return confirm('Anda yakin ingin menyetujui postingan ini?')">Setujui</a>
                                        <a href="<?= site_url('editor/reject/' . $post['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menolak postingan ini?')">Tolak</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada postingan yang perlu direview saat ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
