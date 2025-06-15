<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<?php
// Helper untuk mendapatkan URL gambar atau placeholder
function getImageUrl($post, $placeholderSize = '400x250') {
    return !empty($post['image']) 
        ? '/uploads/posts/' . esc($post['image']) 
        : 'https://placehold.co/' . $placeholderSize . '/e8e8e8/999999?text=Gambar+Tidak+Tersedia';
}

// Memisahkan postingan utama (hero) dari sisanya
$heroPost = array_shift($posts);
$otherPosts = $posts;
?>

<main id="main">
    <div class="container py-5">

        <?php if ($heroPost): ?>
        <!-- ======= Hero Section ======= -->
        <section id="hero-post" class="mb-5">
            <div class="card text-white border-0 shadow-lg">
                <img src="<?= getImageUrl($heroPost, '1200x500') ?>" class="card-img" alt="<?= esc($heroPost['title']) ?>" style="object-fit: cover; max-height: 500px;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 100%);">
                    <div>
                        <span class="badge bg-danger mb-2"><?= esc($heroPost['category_name']) ?></span>
                        <h1 class="card-title display-5 fw-bold mb-1"><a href="/post/<?= esc($heroPost['slug'], 'url') ?>" class="text-white stretched-link text-decoration-none"><?= esc($heroPost['title']) ?></a></h1>
                        <p class="card-text d-none d-md-block lead"><?= esc(word_limiter($heroPost['content'], 25)) ?></p>
                        <div class="post-meta text-white-50"><span><?= date('d M Y', strtotime($heroPost['created_at'])) ?></span></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Hero Section -->
        <?php endif; ?>

        <!-- ======= Posts Grid Section ======= -->
        <section id="posts-grid">
            <div class="row g-4">
                <?php if (!empty($otherPosts)): ?>
                    <?php foreach($otherPosts as $post): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 post-entry-1">
                            <a href="/post/<?= esc($post['slug'], 'url') ?>">
                                <img src="<?= getImageUrl($post, '400x250') ?>" class="card-img-top" alt="<?= esc($post['title']) ?>">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <div class="post-meta mb-2">
                                    <span class="date text-danger"><?= esc($post['category_name']) ?></span> 
                                    <span class="mx-1">&bullet;</span> 
                                    <span><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                                </div>
                                <h5 class="card-title flex-grow-1"><a href="/post/<?= esc($post['slug'], 'url') ?>" class="text-dark text-decoration-none"><?= esc($post['title']) ?></a></h5>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php elseif (!$heroPost): ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h2>Belum Ada Berita</h2>
                            <p>Saat ini belum ada berita yang dipublikasikan. Silakan kembali lagi nanti.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pager -->
            <div class="d-flex justify-content-center mt-5">
                <?= $pager->links() ?>
            </div>
        </section>
        <!-- End Posts Grid Section -->

    </div>
</main>

<?= $this->endSection() ?>
