  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center" style="background: url('<?= base_url('assets/img/' . profile_perpus()->banner) ?>') top center; ">
      <!-- <img src=" <?= base_url('assets/img/bg-library.jpg') ?>" alt="..." /> -->
      <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
          <h1>Perpustakaan,<br />Man 2 Ngawi</h1>
          <!-- <h2>We are team of talented designers making websites with Bootstrap</h2> -->
          <div class="col-lg-3 col-10 col-md-7">
              <form action="<?= base_url('Buku/SearchBuku') ?>" style="margin-top: 30px;
	background: #fff;
	padding: 6px 10px;
	position: relative;
	border-radius: 50px;
	text-align: left;
	border: 1px solid #e0e5e2;" method="post" enctype="multipart/form-data"><input name="buku" id="search-book" type="text" style="border: 0;
	padding: 4px 20px;
	width: calc(100% - 100px);">
                  <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                  <button class="btn-Cari" type="text">Cari</button>
              </form>
          </div>
      </div>
  </section>
  <!-- End Hero -->

  <main id="main">
      <!-- ======= About Section ======= -->
      <!-- <section id="about" class="about">
          <div class="container" data-aos="fade-up">
              <div class="row">
                  <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                      <img src="<?= base_url('assets/img/about.jpg') ?>" class="img-fluid" alt="" />
                  </div>
                  <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                      <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                      <p class="fst-italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      <ul>
                          <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                          <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                          <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                      </ul>
                      <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate</p>
                  </div>
              </div>
          </div>
      </section> -->
      <!-- End About Section -->

      <!-- ======= Counts Section ======= -->
      <!-- <section id="counts" class="counts section-bg">
          <div class="container">
              <div class="row counters justify-content-center">

                  <div class="col-lg-3 col-6 text-center">
                      <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
                      <p>Buku</p>
                  </div>

                  <div class="col-lg-3 col-6 text-center">
                      <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
                      <p>Ebook</p>
                  </div>


              </div>
          </div>
      </section> -->
      <!-- End Counts Section -->

      <!-- ======= Why Us Section ======= -->
      <section id="why-us" class="why-us">
          <div class="container" data-aos="fade-up">
              <div class="row justify-content-center">
                  <!-- <div class="col-lg-4 d-flex align-items-stretch">
                      <div class="content">
                          <h3>Why Choose Mentor?</h3>
                          <p>
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit Asperiores dolores sed et. Tenetur quia eos. Autem tempore
                              quibusdam vel necessitatibus optio ad corporis.
                          </p>
                          <div class="text-center">
                              <a href="about.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                          </div>
                      </div>
                  </div> -->
                  <div class="col-xl-12" data-aos="zoom-in" data-aos-delay="100">
                      <div class="icon-boxes d-flex flex-column justify-content-center">
                          <div class="row justify-content-center">
                              <!-- <div class="col-xl-4 d-flex align-items-stretch">
                                  <div class="icon-box mt-4 mt-xl-0">
                                      <i class="bx bx-receipt"></i>
                                      <h4>Corporis voluptates sit</h4>
                                      <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                                  </div>
                              </div> -->
                              <div class="col-xl-6 d-flex align-items-stretch w-50 ">
                                  <div class="icon-box mt-4 mt-xl-0">
                                      <i class="bx"><span data-purecounter-start="0" data-purecounter-end="<?= $total_buku ?>" data-purecounter-duration="1" class="purecounter"></span>
                                      </i>
                                      <h4>Buku</h4>
                                      <p>Saat ini ada <?= $total_buku ?> Buku di perpustakaan</p>
                                  </div>
                              </div>
                              <div class="col-xl-6 d-flex align-items-stretch w-50">
                                  <div class="icon-box mt-4 mt-xl-0">
                                      <i class="bx"><span data-purecounter-start="0" data-purecounter-end="<?= $total_ebook ?>" data-purecounter-duration="1" class="purecounter"></span></i>
                                      <h4>E-Book</h4>
                                      <p>Saat ini ada <?= $total_ebook ?> E-Book yang tersedia</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- End .content-->
                  </div>
              </div>
          </div>
      </section>
      <!-- End Why Us Section -->

      <!-- ======= Features Section ======= -->
      <section id="features" class="features">
          <div class="container" data-aos="fade-up">
              <div class="section-title ">

                  <p class="text-center">Kategori</p>
                  <?php function kodecolor_part()
                    {
                        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
                    }
                    function kodecolor()
                    {
                        return kodecolor_part() . kodecolor_part() . kodecolor_part();
                    }
                    ?>
              </div>
              <div class="row" data-aos="zoom-in" data-aos-delay="100">
                  <?php foreach ($kategori as $ktg) : ?>
                      <div onclick="window.location='<?= base_url('Buku/ByKategori/' . $ktg['nama_kategori']) ?>'" class="col-lg-3 col-md-4 mt-2">
                          <div class="icon-box">
                              <i class="ri-gradienter-line" style="color:#<?= kodecolor() ?>"></i>
                              <h3><a href=""><?= $ktg['nama_kategori'] ?></a></h3>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </section>
      <!-- End Features Section -->

      <!-- ======= Popular Courses Section ======= -->
      <section id="popular-courses" class="courses">
          <div class="container" data-aos="fade-up">
              <div class="section-title">
                  <h2>Buku</h2>
                  <p>Rekomendasi Buku</p>
              </div>

              <div class="row" data-aos="zoom-in" data-aos-delay="100">
                  <?php foreach ($getAllBook as $gbook) { ?>
                      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                          <div class="course-item">
                              <div class="col text-center mt-2 mb-2 ">
                                  <img src="<?php if ($gbook['src_book'] == 0) {
                                                echo $gbook['cover_buku'];
                                            } else {
                                                echo base_url('assets/img/CoverBuku/' . $gbook['cover_buku']);
                                            } ?>" class="img-fluid" alt="..." style="height: 20rem;" />
                              </div>
                              <div class="course-content">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4>Fiksi</h4>
                                  </div>

                                  <h3><a href="<?= base_url('Buku/DetailBuku/' . $gbook['kode_buku']) ?>"><?= $gbook['judul_buku'] ?></a></h3>
                                  <p><?= substr($gbook['sinopsis'], 0, 300) ?></p>
                                  <div class="trainer d-flex justify-content-between align-items-center">
                                      <div class="trainer-profile d-flex align-items-center">
                                          <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                          <span>Penulis : <?= $gbook['penulis'] ?></span>
                                      </div>
                                      <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php } ?>

                  <!-- End Course Item-->


                  <!-- End Course Item-->


                  <!-- End Course Item-->
              </div>
          </div>
      </section>
      <!-- End Popular Courses Section -->

      <!-- ======= Trainers Section ======= -->
      <!-- <section id="trainers" class="trainers">
          <div class="container" data-aos="fade-up">
              <div class="row" data-aos="zoom-in" data-aos-delay="100">
                  <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                      <div class="member">
                          <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" />
                          <div class="member-content">
                              <h4>Walter White</h4>
                              <span>Web Development</span>
                              <p>Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut</p>
                              <div class="social">
                                  <a href=""><i class="bi bi-twitter"></i></a>
                                  <a href=""><i class="bi bi-facebook"></i></a>
                                  <a href=""><i class="bi bi-instagram"></i></a>
                                  <a href=""><i class="bi bi-linkedin"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                      <div class="member">
                          <img src="<?= base_url('assets/img/trainers/trainer-2.jpg') ?>" class="img-fluid" alt="" />
                          <div class="member-content">
                              <h4>Sarah Jhinson</h4>
                              <span>Marketing</span>
                              <p>Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus</p>
                              <div class="social">
                                  <a href=""><i class="bi bi-twitter"></i></a>
                                  <a href=""><i class="bi bi-facebook"></i></a>
                                  <a href=""><i class="bi bi-instagram"></i></a>
                                  <a href=""><i class="bi bi-linkedin"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                      <div class="member">
                          <img src="<?= base_url('assets/img/trainers/trainer-3.jpg') ?>" class="img-fluid" alt="" />
                          <div class="member-content">
                              <h4>William Anderson</h4>
                              <span>Content</span>
                              <p>Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara</p>
                              <div class="social">
                                  <a href=""><i class="bi bi-twitter"></i></a>
                                  <a href=""><i class="bi bi-facebook"></i></a>
                                  <a href=""><i class="bi bi-instagram"></i></a>
                                  <a href=""><i class="bi bi-linkedin"></i></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section> -->
      <!-- End Trainers Section -->
  </main>
  <!-- End #main -->

  <script>
      function searchbuku() {

          let apiurl = 'https://www.googleapis.com/books/v1/volumes?q=';
          let NameBook = $('#search-book').val()
          let bella = parseInt(NameBook);
          let deka;
          let takdir = "Buku Tidak Ada";

          console.log(NameBook);
          $.ajax({
              url: apiurl + NameBook,
              dataType: "JSON",
              success: function(resultData) {
                  if (resultData.totalItems > 0) {
                      for (var i = 0; i < resultData.items.length; i += 2) {
                          item = resultData.items[i];
                          isbn = item.volumeInfo.industryIdentifiers
                          $.each(isbn, function(i, data) {
                              deka = parseInt(data.identifier)
                              if (deka == bella) {
                                  takdir = item.volumeInfo
                              }


                          });

                      }
                      console.log(takdir)
                  } else {
                      console.log(takdir)
                  }

                  //   if (isbncode.includes(gu)) {
                  //       console.log(isbn)
                  //   } else {
                  //       console.log("ora")
                  //   }


              }

          });

      }
  </script>