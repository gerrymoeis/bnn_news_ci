<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
        <div class="row">
            <div class="col-12">
                <div class="swiper sliderFeaturedPosts">
                    <div class="swiper-wrapper">
                        <?php foreach($posts as $post): ?>
                        <div class="swiper-slide">
                            <?php $imageUrl = !empty($post['image']) ? base_url('uploads/' . esc($post['image'])) : 'https://placehold.co/700x450/CCCCCC/FFFFFF?text=Image+Not+Available'; ?>
                            <a href="/post/<?= esc($post['slug'], 'url') ?>" class="img-bg d-flex align-items-end" style="background-image: url('<?= $imageUrl ?>');">
                                <div class="img-bg-inner">
                                    <h2><?= esc($post['title']) ?></h2>
                                    <p><?= esc(word_limiter($post['content'], 20)) ?></p>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="custom-swiper-button-next">
                        <span class="bi-chevron-right"></span>
                    </div>
                    <div class="custom-swiper-button-prev">
                        <span class="bi-chevron-left"></span>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Slider Section -->

<!-- ======= Post Grid Section ======= -->
<section id="posts" class="posts">
    <div class="container" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="row g-5">
                    <?php foreach($posts as $post): ?>
                    <div class="col-lg-4 border-start custom-border">
                        <div class="post-entry-1">
                            <?php $imageUrl = !empty($post['image']) ? base_url('uploads/' . esc($post['image'])) : 'https://placehold.co/400x250/CCCCCC/FFFFFF?text=Image+Not+Available'; ?>
                            <a href="/post/<?= esc($post['slug'], 'url') ?>"><img src="<?= $imageUrl ?>" alt="<?= esc($post['title']) ?>" class="img-fluid"></a>
                            <div class="post-meta"><span class="date"><?= esc($post['category_name']) ?></span> <span class="mx-1">&bullet;</span> <span><?= date('d M Y', strtotime($post['created_at'])) ?></span></div>
                            <h2><a href="/post/<?= esc($post['slug'], 'url') ?>"><?= esc($post['title']) ?></a></h2>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                 <!-- Pager -->
                 <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links() ?>
                </div>
            </div>
        </div> <!-- End .row -->
    </div>
</section> <!-- End Post Grid Section -->

<?= $this->endSection() ?>
