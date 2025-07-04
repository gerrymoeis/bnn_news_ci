<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= esc($title ?? 'BNN News') ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
    <link href="/assets/css/variables.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top shadow-sm">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="/assets/img/logo.png" alt=""> -->
        <h1>BNN News</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/">Beranda</a></li>
          <li><a href="/about">Tentang Kami</a></li>
          <li><a href="/contact">Kontak</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="/dashboard" class="btn btn-sm btn-outline-primary me-2">Dashboard</a>
            <a href="/logout" class="btn btn-sm btn-primary">Logout</a>
        <?php else: ?>
            <a href="/login" class="btn btn-sm btn-primary">Masuk</a>
        <?php endif; ?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <?= $this->renderSection('content') ?>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-legal">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Hak Cipta <strong><span>BNN News</span></strong>. Semua Hak Dilindungi
            </div>
            <div class="credits">
              Didesain ulang oleh <a href="#">Gerry</a>
            </div>
          </div>

          <div class="col-md-6">
            <div class="social-links text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
