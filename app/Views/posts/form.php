<?= $this->extend('layouts/simple_dashboard_layout') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <h3><?= esc($title ?? 'Form Postingan') ?></h3>
            </div>
            <div class="col-md-4 text-end">
                 <a href="<?= site_url('/posts') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="<?= isset($post) ? site_url('/posts/update/' . $post['id']) : site_url('/posts/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= old('title', $post['title'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required><?= old('content', $post['content'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($post) && $post['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" <?= isset($post) ? '' : 'required' ?>>
                        <?php if (isset($post) && $post['thumbnail']): ?>
                            <div class="mt-2">
                                <small>Thumbnail saat ini:</small><br>
                                <img src="<?= base_url('uploads/thumbnails/' . $post['thumbnail']) ?>" alt="Thumbnail" width="150">
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Postingan</button>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
