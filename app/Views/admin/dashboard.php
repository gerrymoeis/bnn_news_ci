<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h3><?= esc($title ?? 'Dashboard Admin') ?></h3>
            <p>Selamat datang di panel administrasi BNN News.</p>
        </div>
    </div>

    <div class="row">
        <!-- Card: Persetujuan Pengguna -->
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Persetujuan Pengguna</h5>
                    <p class="card-text">Setujui atau tolak pengguna baru yang mendaftar.</p>
                    <a href="<?= site_url('/admin/users/pending') ?>" class="btn btn-primary">
                        Kelola Persetujuan
                        <?php if ($pending_users_count > 0): ?>
                            <span class="badge bg-danger ms-2"><?= $pending_users_count ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Manajemen Pengguna -->
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Pengguna</h5>
                    <p class="card-text">Lihat, edit, atau hapus data pengguna yang sudah ada.</p>
                    <a href="<?= site_url('/admin/users/manage') ?>" class="btn btn-secondary">Kelola Pengguna</a>
                </div>
            </div>
        </div>

        <!-- Card: Manajemen Kategori -->
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Kategori</h5>
                    <p class="card-text">Tambah, edit, atau hapus kategori berita.</p>
                    <a href="<?= site_url('/admin/categories') ?>" class="btn btn-info">Kelola Kategori</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
