<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <h3><?= esc($title ?? 'Manajemen Kategori') ?></h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= site_url('/admin/categories/create') ?>" class="btn btn-primary">Tambah Kategori Baru</a>
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
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $key => $category): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($category['name']) ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/categories/edit/' . $category['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= site_url('admin/categories/delete/' . $category['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">Belum ada kategori.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
