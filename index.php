<?php
include 'components/css_files.php';
include 'components/js_files.php';
?>

<link rel="stylesheet" type="text/css" href="css/welcome_page.css">

<body class="index-page">

  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner"></div>
  </div>
  <!-- Spinner End -->

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Advanced IMAP Email Handler in PHP</h1>
            <p data-aos="fade-up" data-aos-delay="100">A lightweight PHP-based email client using IMAP to fetch, read, reply, and manage attachments.</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="starter.php" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Email Reader</span> <span>All Rights Reserved</span></p>
      <div class="credits">
        Developed by <a href="https://itimium.com/HaseebPortfolio/">Haseeb ur Rehman</a>
      </div>
    </div>

  </footer>


  <!-- Main JS File -->

</body>