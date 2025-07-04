<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<section>
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-lg-12 text-center mb-5">
        <h1 class="page-title">Tentang Kami</h1>
      </div>
    </div>

    <div class="row mb-5">

      <div class="d-md-flex post-entry-2 half">
        <a href="#" class="me-4 thumbnail">
          <img src="https://placehold.co/600x400?text=BNN+News+Team" alt="" class="img-fluid">
        </a>
        <div class="ps-md-5 mt-4 mt-md-0">
          <div class="post-meta mt-4">Tim Kami</div>
          <h2 class="mb-4 display-4">Misi & Visi Kami</h2>

          <p>BNN News didirikan dengan misi untuk menyajikan berita yang tidak hanya cepat, tetapi juga akurat, mendalam, dan berimbang. Kami percaya pada kekuatan informasi untuk mencerahkan dan memberdayakan masyarakat.</p>
          <p>Visi kami adalah menjadi sumber informasi terpercaya nomor satu di Indonesia, dengan menjunjung tinggi etika jurnalisme dan terus berinovasi dalam penyampaian konten digital.</p>
        </div>
      </div>

    </div>

  </div>
</section>
<?= $this->endSection() ?>
