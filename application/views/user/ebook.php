 <main id="main" data-aos="fade-in">

     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs">
         <div class="container text-start">
             <h2>Menu E-Book</h2>
             <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
         </div>
     </div>

     <!-- ======= Courses Section ======= -->
     <section id="courses" class="courses">
         <div class="container" data-aos="fade-up">

             <div class="row" data-aos="zoom-in" data-aos-delay="100">
                 <div class="col-lg-9">
                     <div class="row">
                         <?php if ($getAllPdf == null) : ?>
                             <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                             <script>
                                 swal('Kosong', "Data Tidak Ada", 'error')
                             </script>
                         <?php else : ?>
                             <?php foreach ($getAllPdf as $gpdf) : ?>
                                 <div class="col-lg-12 col-md-12 mt-2">
                                     <div class="course-item">
                                         <div class="course-content">


                                             <h3><a href="<?= base_url('Ebook/DetailEbook/' . $gpdf['id_ebook']) ?>"><?= $gpdf['judul_ebook'] ?></a></h3>
                                             <p><?= $gpdf['deskripsi'] ?></p>
                                             <div class="trainer d-flex justify-content-between align-items-center">
                                                 <div class="trainer-profile d-flex align-items-center">
                                                     <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                                     <div class="d-flex justify-content-between align-items-center mb-3">
                                                         <?php $ktg = explode(",", $gpdf['kategori']);
                                                            foreach ($ktg as $kt) { ?>
                                                             <h4 class="ms-1"><?= $kt ?></h4>
                                                         <?php }  ?>

                                                     </div>
                                                 </div>
                                                 <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                             </div>
                                             <div class="trainer d-flex justify-content-between align-items-center">
                                                 <div class="trainer-profile d-flex align-items-center">
                                                     <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                                     <span>Penulis : <?= $gpdf['penulis'] ?></span>
                                                 </div>
                                                 <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             <?php endforeach; ?>
                         <?php endif; ?>




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

                         <?php if ($this->uri->segment(2) != 'SearchEbook') {
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
                             <div onclick="window.location='<?= base_url('Ebook/ByKategori/' . str_replace(' ', '-', $ktg['nama_kategori'])) ?>'" style=" cursor: pointer;" class="trainer d-flex justify-content-between align-items-center ">
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