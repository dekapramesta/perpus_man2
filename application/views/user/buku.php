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
                         <?php foreach ($getAllBook as $gbook) : ?>
                             <div class="col-lg-4 col-md-6 d-flex justify-content-center ">
                                 <div class="course-item">
                                     <img src="<?php if ($gbook['src_book'] == 0) {
                                                    echo $gbook['cover_buku'];
                                                } else {
                                                    echo base_url('assets/img/CoverBuku/' . $gbook['cover_buku']);
                                                } ?>" class="img-fluid align-item-center pe-2 ps-2" alt="..." style="height: 20rem; width:100%" />
                                     <div class="course-content">
                                         <div class="d-flex  align-items-start mb-3">
                                             <?php $kategori = explode(",", $gbook['kategori']); ?>
                                             <?php foreach ($kategori as $ktg) : ?>
                                                 <div class="d-flex flex-wrap">
                                                     <h4 class="ms-2 mt-1"><?= $ktg ?></h4>

                                                 </div>
                                             <?php endforeach; ?>


                                             <!-- <h4>asuajshkajsh</h4> -->

                                         </div>

                                         <h3><a href="<?= base_url('Buku/DetailBuku') ?>"><?= $gbook['judul_buku'] ?></a></h3>
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
                         <?php endforeach; ?>



                     </div>
                 </div>
                 <div class="col">
                     <div class="course-item">
                         <div class="course-content text-center">
                             <h3 id="ktg">Kategori</h3>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </div>
     </section><!-- End Courses Section -->

 </main><!-- End #main -->