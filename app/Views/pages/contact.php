<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<section id="contact" class="contact mb-5">
  <div class="container" data-aos="fade-up">

    <div class="row">
      <div class="col-lg-12 text-center mb-5">
        <h1 class="page-title">Hubungi Kami</h1>
      </div>
    </div>

    <div class="row gy-4">

      <div class="col-md-4">
        <div class="info-item">
          <i class="bi bi-geo-alt"></i>
          <h3>Alamat</h3>
          <address>Jalan Teknologi No. 1, Jakarta, Indonesia</address>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-4">
        <div class="info-item info-item-borders">
          <i class="bi bi-phone"></i>
          <h3>Telepon</h3>
          <p><a href="tel:+62211234567">+62 21 1234 567</a></p>
        </div>
      </div><!-- End Info Item -->

      <div class="col-md-4">
        <div class="info-item">
          <i class="bi bi-envelope"></i>
          <h3>Email</h3>
          <p><a href="mailto:redaksi@bnn.news">redaksi@bnn.news</a></p>
        </div>
      </div><!-- End Info Item -->

    </div>

    <div class="form mt-5">
      <form action="#" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="form-group col-md-6">
            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
          </div>
          <div class="form-group col-md-6">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" required>
          </div>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="message" rows="5" placeholder="Pesan" required></textarea>
        </div>
        <div class="my-3">
          <div class="loading">Memuat</div>
          <div class="error-message"></div>
          <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
        </div>
        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
      </form>
    </div><!-- End Contact Form -->

  </div>
</section>
<?= $this->endSection() ?>
