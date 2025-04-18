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

      <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4 rounded-4 w-100" style="max-width: 600px;">
          <h3 class="text-center fw-bold mb-4 text-primary">Email Fetch Form</h3>
          <form action="all_mails.php" method="POST">
            <div class="mb-5">
              <label for="email" class="form-label fw-bold fs-5">Email Address</label>
              <input class="form-control p-2 fs-5" required name="email" type="email" placeholder="">
            </div>

            <div class="mb-5">
              <div class="d-flex justify-content-between my-2">
                <label for="AapPassword" class="form-label fw-bold fs-5">Google App Password</label>
                <a href="https://www.youtube.com/watch?v=hXiPshHn9Pw" target="_blank" class="btn btn-primary btn-sm">How to Create Google App Password</a>
              </div>
              <input class="form-control p-2 fs-5" required name="AapPassword" type="text" placeholder="">
            </div>

            <div class="mb-5">
              <label for="email_num" class="form-label fw-bold fs-5">Number of Emails to Fetch</label>
              <input class="form-control p-2 fs-5" required name="email_num" type="number" min="1" placeholder="">
            </div>

            <button type="submit" class="btn btn-info w-100 fw-bold">Fetch Emails</button>
          </form>
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