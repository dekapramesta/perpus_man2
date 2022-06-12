  <!-- ======= Footer ======= -->
  <footer id="footer">
      <div class="footer-top">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-lg-5 col-md-6 footer-contact text-center">

                      <h3>Perpustakaan <?php echo profile_perpus()->nama_sekolah; ?></h3>
                      <p>
                          <?php echo profile_perpus()->alamat; ?> </br> </br>
                      </p>
                  </div>



              </div>
          </div>
      </div>
      </div>


  </footer>
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?= base_url('assets/vendor/purecounter/purecounter.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('') ?>assets/admin/bundles/sweetalert/sweetalert.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?= base_url('') ?>assets/admin/js/page/sweetalert.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
  </body>


  </html>