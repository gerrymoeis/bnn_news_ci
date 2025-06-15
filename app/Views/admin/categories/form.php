<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <h3><?= esc($title ?? 'Form Kategori') ?></h3>
            </div>
            <div class="col-md-4 text-end">
                 <a href="<?= site_url('/admin/categories/manage') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="<?= isset($category) ? site_url('/admin/categories/update/' . $category['id']) : site_url('/admin/categories/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $category['name'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
