   <?php if ($this->session->flashdata('password_erorr')) {
        echo $this->session->flashdata('password_erorr');
        $this->session->set_flashdata(
            'password_erorr',
            ''
        );
    } ?>
   <main id="main">
       <!-- ======= Breadcrumbs ======= -->
       <div class="breadcrumbs" data-aos="fade-in">
           <div class="container text-start">
               <h2>Profile</h2>
           </div>
       </div>
       <!-- End Breadcrumbs -->

       <!-- ======= Cource Details Section ======= -->

       <section id="cource-details-tabs" style="margin-top: 30px;" class="cource-details-tabs">
           <div class="container" data-aos="fade-up">

               <div class="row">
                   <div class="col-lg-3">
                       <ul class="nav nav-tabs flex-column">
                           <li class="nav-item">
                               <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Infromasi</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Riwayat Peminjaman</a>
                           </li>

                       </ul>
                   </div>
                   <div class="col-lg mt-4 mt-lg-0">
                       <div class="tab-content">
                           <div class="tab-pane active show" id="tab-1">
                               <div class="row">
                                   <div class="col-lg details order-2 order-lg-1">
                                       <h3 class="ms-3">Detail</h3>
                                       <section id="course-details" style="margin-top:-60px ; margin-left: -10px;" class="course-details">
                                           <div class="container" data-aos="fade-up">
                                               <div class="row">

                                                   <div class="col-lg-12">
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

                                                       <div class="col text-center d-flex">
                                                           <button onclick="edit_profile()" class="btn w-50 me-2" style="background-color: #5fcf80; color: white;">Edit</button>
                                                           <button onclick="PassChange()" class="btn w-50" style="background-color: #5fcf80; color: white;">Ubah Password</button>

                                                       </div>
                                                   </div>

                                               </div>

                                           </div>
                                       </section>

                                   </div>

                               </div>
                           </div>
                           <div class="tab-pane" id="tab-2">
                               <div class="row">
                                   <div class="col-lg-8 details order-2 order-lg-1">
                                       <h3>Riwayat Peminjaman</h3>
                                       <table class="table table-borderless">
                                           <thead>
                                               <tr>
                                                   <th scope="col">ID Buku</th>
                                                   <th scope="col">Nama Buku</th>
                                                   <th scope="col">Status</th>

                                               </tr>
                                           </thead>
                                           <tbody>
                                               <?php foreach ($peminjaman as $pj) : ?>
                                                   <tr>
                                                       <td><?= $pj['id_buku'] ?></td>
                                                       <td><?= $pj['judul_buku'] ?></td>
                                                       <td><?php if ($pj['status_pengembalian'] == 1) {
                                                                echo "Sudah Dikembalikan";
                                                            } elseif ($pj['status_pengembalian'] == 0) {
                                                                echo "Belum Dikembalikan";
                                                            }  ?></td>

                                                   </tr>
                                               <?php endforeach; ?>
                                           </tbody>
                                       </table>
                                       <!-- <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p> -->
                                       <!-- <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p> -->
                                   </div>
                                   <div class="col-lg-4 text-center order-1 order-lg-2">
                                       <img src="assets/img/course-details-tab-2.png" alt="" class="img-fluid">
                                   </div>
                               </div>
                           </div>
                           <!-- <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-3.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                                    <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-4.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-5">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                                    <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-5.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div> -->
                       </div>
                   </div>
               </div>

           </div>
       </section>

       <script>
           function PassChange() {
               $('#change_pass').appendTo("body").modal('show');
           }

           function edit_profile() {
               $('#edit_profile').appendTo("body").modal('show');
           }
       </script>
       <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <?php if ($role == 1) {
                        $id_url = $profile->id_siswa;
                    } elseif ($role == 2) {
                        $id_url = $profile->id_guru;
                    } ?>
                   <form action="<?= base_url('Profile/EditProfile/') ?>" enctype="multipart/form-data" method="post">
                       <div class="modal-body">
                           <?php if ($role == 1) : ?>
                               <div class="form-group ">
                                   <!-- <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_siswa ?>" required=""> -->
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
                                   <input hidden placeholder="Angkatan" name="angkatan" type="text" class="form-control " value="<?= $profile->angkatan ?>" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="NISN" type="text" name="nisn" class="form-control " value="<?= $profile->nisn ?>" required="">
                               </div>
                           <?php elseif ($role == 2) : ?>
                               <div class="form-group ">
                                   <!-- <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_guru ?>" required=""> -->
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
       <div class="modal fade" id="change_pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <?php if ($role == 1) {
                        $id_url = $profile->id_siswa;
                    } elseif ($role == 2) {
                        $id_url = $profile->id_guru;
                    } ?>
                   <form action="<?= base_url('Profile/UbahPass/') ?>" enctype="multipart/form-data" method="post">
                       <div class="modal-body">
                           <?php if ($role == 1) : ?>
                               <div class="form-group ">
                                   <!-- <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_siswa ?>" required=""> -->
                                   <input placeholder="Password Lama" name="password" type="text" class="form-control " required="">
                                   <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               </div>

                               <div class="form-group mt-3">
                                   <input placeholder="Password Baru" name="new_pass" type="text" class="form-control" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="Konfirmasi Password" name="conf_pass" type="text" class="form-control" required="">
                               </div>


                           <?php elseif ($role == 2) : ?>
                               <div class="form-group ">
                                   <!-- <input hidden name="id_profile" type="text" class="form-control " value="<?= $profile->id_siswa ?>" required=""> -->
                                   <input placeholder="Password Lama" name="password" type="text" class="form-control " required="">
                                   <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                               </div>

                               <div class="form-group mt-3">
                                   <input placeholder="Password Baru" name="new_pass" type="text" class="form-control" required="">
                               </div>
                               <div class="form-group mt-3">
                                   <input placeholder="Konfirmasi Password" name="conf_pass" type="text" class="form-control" required="">
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