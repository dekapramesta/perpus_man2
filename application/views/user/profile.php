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
                       <?php if ($role == 1) : ?>
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
                       <?php elseif ($role == 2) : ?>
                           <div class="course-info d-flex justify-content-between align-items-center">
                               <h5>Nama</h5>
                               <p><a href="#"><?= $profile->nama_guru ?></a></p>
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
                               <h5>Alamat</h5>
                               <p><?= $profile->alamat ?></p>
                           </div>
                       <?php endif; ?>
                       <div class="col text-center">
                           <button onclick="edit_profile()" class="btn btn-primary w-50">Edit</button>
                       </div>

                   </div>
               </div>
               <!-- <div class="col text-end">
                   <button class="btn btn-primary w-25">Edit</button>
               </div> -->
           </div>
       </section>
       <script>
           function edit_profile() {
               $('#edit_profile').appendTo("body").modal('show');
           }
       </script>
       <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <?php if ($role == 1) {
                        $id_url = $profile->id_profile;
                    } elseif ($role == 2) {
                        $id_url = $profile->id_guru;
                    } ?>
                   <form action="<?= base_url('Profile/EditProfile/' . $id_url) ?>" enctype="multipart/form-data" method="post">
                       <div class="modal-body">
                           <?php if ($role == 1) : ?>
                               <div class="form-group ">
                                   <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_profile ?>" required="">
                                   <input placeholder="Nama" name="nama" type="text" class="form-control " value="<?= $profile->nama ?>" required="">
                                   <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               </div>

                               <div class="form-group mt-3">
                                   <input placeholder="Email" name="email" type="text" class="form-control" value="<?= $profile->email ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="No HP" name="no_hp" type="text" class="form-control " value="<?= $profile->no_hp ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="Angkatan" name="angkatan" type="text" class="form-control " value="<?= $profile->angkatan ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="NISN" type="text" name="nisn" class="form-control " value="<?= $profile->nisn ?>" required="">
                               </div>
                           <?php elseif ($role == 2) : ?>
                               <div class="form-group ">
                                   <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_guru ?>" required="">
                                   <input placeholder="Nama" name="nama" type="text" class="form-control " value="<?= $profile->nama_guru ?>" required="">
                                   <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               </div>

                               <div class="form-group mt-3">
                                   <input placeholder="Email" name="email" type="text" class="form-control" value="<?= $profile->email ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="No HP" name="no_hp" type="text" class="form-control " value="<?= $profile->no_hp ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <textarea name="alamat" class="form-control " required=""><?= $profile->alamat ?></textarea>
                               </div>
                           <?php endif; ?>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Save changes</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       <!-- End Cource Details Section -->
   </main>