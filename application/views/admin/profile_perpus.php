 <?php if ($this->session->flashdata('profile_su')) {
        echo $this->session->flashdata('profile_su');
        $this->session->set_flashdata(
            'profile_su',
            ''
        );
    } ?>
 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Profile Perpus</h4>
                         </div>
                         <div class="card-body" id="form_scan">
                             <form action="<?= base_url('SuperAdmin/ProfilePerpus/UpdateProfile') ?>" enctype="multipart/form-data" method="post">

                                 <div class="form-group">
                                     <label for="">Nama Sekolah</label>
                                     <input value="<?= $profile->nama_sekolah ?>" type="text" name="nama_sekolah" class="form-control " required="">
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Alamat</label>
                                     <input value="<?= $profile->alamat ?>" type="text" name="alamat" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Profile</label>
                                     <textarea name="profile" class="form-control" rows="3" h-100><?= $profile->profile ?></textarea>

                                 </div>
                                 <div class="form-group">
                                     <label for="">Koordinat Peta</label>
                                     <input type="text" name="kordinat_gmaps" value="<?= $profile->kordinat_gmaps ?>" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Token</label>
                                     <input type="text" name="token_wa" value="<?= $profile->token_wa ?>" class="form-control " required="">
                                 </div>
                                 <div class="form-group d-flex justify-content-center">
                                     <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary w-50 mr-3">Banner Foto</button>
                                     <button type="submit" class="btn btn-primary w-50">Save</button>

                                 </div>
                             </form>


                         </div>

                     </div>

                 </div>
             </div>
         </div>
     </section>


 </div>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="<?= base_url('SuperAdmin/ProfilePerpus/UpdateFoto') ?>" enctype="multipart/form-data" method="post">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Banner Foto</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <img src="<?= base_url('assets/img/' . $profile->banner) ?>" class="img-fluid" alt="">
                         <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                     </div>
                     <div class="form-group">
                         <div class="mb-3">
                             <label for="banner" class="form-label">Masukan Gambar</label>
                             <input class="form-control form-control-sm" id="banner" name="banner" type="file">
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
             </form>
         </div>
     </div>
 </div>