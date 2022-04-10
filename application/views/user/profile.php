   <main id="main">
       <!-- ======= Breadcrumbs ======= -->
       <div class="breadcrumbs" data-aos="fade-in">
           <div class="container text-start">
               <h2>Profile</h2>
           </div>
       </div>
       <!-- End Breadcrumbs -->

       <!-- ======= Cource Details Section ======= -->
       <section id="course-details" class="course-details">
           <div class="container" data-aos="fade-up">
               <div class="row">
                   <div class="col-lg-4 text-center">
                       <img src="<?= base_url('assets/img/dk.jpeg') ?>" class="img-fluid mb-3 mt-3" style="border-radius: 50%; height:230px; width: 270px;" alt="" />
                   </div>
                   <div class="col-lg-8">
                       <div class="course-info d-flex justify-content-between align-items-center">
                           <h5>Nama</h5>
                           <p><a href="#"><?= $profile->nama ?></a></p>
                       </div>

                       <div class="course-info d-flex justify-content-between align-items-center">
                           <h5>Email</h5>
                           <p><?= $profile->email ?></p>
                       </div>

                       <div class="course-info d-flex justify-content-between align-items-center">
                           <h5>No Hp</h5>
                           <p><?= $profile->no_hp ?></p>
                       </div>

                       <div class="course-info d-flex justify-content-between align-items-center">
                           <h5>Angkatan</h5>
                           <p><?= $profile->angkatan ?></p>
                       </div>
                       <div class="course-info d-flex justify-content-between align-items-center">
                           <h5>NISN</h5>
                           <p><?= $profile->nisn ?></p>
                       </div>
                       <div class="col text-center">
                           <button class="btn btn-primary w-50">Edit</button>
                       </div>

                   </div>
               </div>
               <!-- <div class="col text-end">
                   <button class="btn btn-primary w-25">Edit</button>
               </div> -->
           </div>
       </section>
       <!-- End Cource Details Section -->
   </main>