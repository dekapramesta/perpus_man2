 <main id="main" data-aos="fade-in">

     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs">
         <div class="container text-start">
             <h2>Menu Buku</h2>
             <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
         </div>
     </div>

     <!-- ======= Courses Section ======= -->
     <section id="courses" class="courses">
         <div class="container" data-aos="fade-up">

             <div class="row" data-aos="zoom-in" data-aos-delay="100">
                 <div class="col-lg-9">
                     <div class="row">
                         <div class="row" data-aos="zoom-in" data-aos-delay="100">
                             <?php if ($getAllBook == null) : ?>
                                 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                 <script>
                                     swal('Kosong', "Data Tidak Ada", 'error')
                                 </script>
                             <?php else : ?>
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

                                                 <h3><a href="<?= base_url('Buku/DetailBuku/' . $gbook['kode_buku']) ?>"><?= $gbook['judul_buku'] ?></a></h3>
                                                 <p><?= substr($gbook['sinopsis'], 0, 300) ?></p>
                                                 <div class="trainer d-flex justify-content-between align-items-center">
                                                     <div class="trainer-profile d-flex align-items-center">
                                                         <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                                         <span>Penulis : <?= $gbook['penulis'] ?></span>
                                                     </div>

                                                     <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                                 </div>
                                                 <div class="trainer d-flex justify-content-between align-items-center">
                                                     <div class="trainer-profile d-flex align-items-center">
                                                         <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                                         <span>Kategori : <?= $gbook['kategori'] ?></span>
                                                     </div>

                                                     <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 <?php } ?>
                             <?php endif; ?>


                             <!-- End Course Item-->


                             <!-- End Course Item-->


                             <!-- End Course Item-->
                         </div>



                     </div>
                     <style>
                         .page-item.active .page-link {
                             z-index: 1;

                             color: #ffff !important;
                             background: #8FBC8F !important;
                             border-color: #8FBC8F;

                         }
                     </style>
                     <div class="col-lg-12 d-flex justify-content-center mt-3">

                         <?php if ($this->uri->segment(2) == 'SearchBuku') {
                            } elseif ($this->uri->segment(2) == 'BukuCariHome') {
                            } else {
                                echo $this->pagination->create_links();
                            }
                            ?>
                     </div>

                 </div>
                 <div class="col">
                     <div class="course-item">
                         <div class="course-content text-center">
                             <h3 id="ktg">Kategori</h3>
                         </div>
                         <?php foreach ($kategori as $ktg) : ?>
                             <div onclick="window.location='<?= base_url('Buku/ByKategori/' . str_replace(' ', '-', $ktg['nama_kategori'])) ?>'" style=" cursor: pointer;" class="trainer d-flex justify-content-between align-items-center ">
                                 <div class="trainer-profile d-flex align-items-center">
                                     <span class="mb-3"><?= $ktg['nama_kategori'] ?> </span>
                                 </div>
                             </div>
                         <?php endforeach; ?>

                     </div>
                 </div>

             </div>

         </div>
     </section><!-- End Courses Section -->

 </main><!-- End #main -->