 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row mt-sm-4">
                 <div class="col-12 col-md-12 col-lg-4">
                     <div class="card author-box">
                         <div class="card-body">
                             <div class="author-box-center">
                                 <img alt="image" src="<?php if ($buku->src_book == 0) {
                                                            echo $buku->cover_buku;
                                                        } else {
                                                            echo base_url('assets/img/CoverBuku/' . $buku->cover_buku);
                                                        } ?>" class=" author-box-picture" height="200" style="width: 200px;">

                                 <div class="clearfix"></div>
                                 <div class="author-box-name mt-4">
                                     <a href="#"><?= $buku->judul_buku ?></a>
                                 </div>
                                 <div class="author-box-job"><strong> <?= $buku->penulis ?></strong></div>
                             </div>
                         </div>
                     </div>


                 </div>
                 <div class="col-12 col-md-12 col-lg-8">
                     <div class="card">
                         <div class="padding-20">
                             <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                 <li class="nav-item">
                                     <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">About</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Setting</a>
                                 </li>
                             </ul>
                             <div class="tab-content tab-bordered" id="myTab3Content">
                                 <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                     <div class="row">
                                         <div class="col-md-3 col-6 b-r">
                                             <strong>Kategori</strong>
                                             <br>
                                             <?php $kategori = explode(',', $buku->kategori);
                                                foreach ($kategori as $ktg) : ?>
                                                 <span class="badge badge-secondary w-100 mt-1"><?= $ktg ?></span>
                                             <?php endforeach; ?>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>Tahun Terbit</strong>
                                             <br>
                                             <p class="text-muted"><?= $buku->tahun_terbit ?></p>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>Halaman</strong>
                                             <br>
                                             <p class="text-muted"><?= $buku->halaman ?></p>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>Kode Buku</strong>
                                             <br>
                                             <p class="text-muted"><?= $buku->kode_buku ?></p>
                                         </div>
                                         <div class="col-md-3 col-6 mt-3">
                                             <strong>Tanggal Masuk</strong>
                                             <br>
                                             <p class="text-muted"><?= $buku->tanggal_masuk ?></p>
                                         </div>
                                         <div class="col-md-3 col-6 mt-3">
                                             <strong>Status Buku</strong>
                                             <br>
                                             <p class="text-muted"><?php if ($buku->status_buku == 0) {
                                                                        echo "Tersedia";
                                                                    } else {
                                                                        echo "Dipinjam";
                                                                    } ?></p>
                                         </div>
                                         <?php if ($buku->status_buku == 0) : ?>
                                         <?php elseif ($buku->status_buku == 1) : ?>
                                             <div class="col-md-3 col-6 mt-3">
                                                 <strong>Dipinjam Oleh</strong>
                                                 <br>
                                                 <p class="text-muted"><?php echo $buku->username; ?></p>
                                             </div>
                                         <?php elseif ($buku->status_buku == 7) : ?>
                                             <div class="col-md-3 col-6 mt-3">
                                                 <strong>Dipesan Oleh</strong>
                                                 <br>
                                                 <p class="text-muted"><?php check_booking($buku->id_buku) ?></p>
                                             </div>
                                         <?php endif; ?>

                                         <!-- <div class="col-md-3 col-6 mt-3">
                                             <strong>Dipinjam Oleh</strong>
                                             <br>
                                             <p class="text-muted"><?php if ($buku->status_buku == 0) {
                                                                        echo "Tersedia";
                                                                    } else {
                                                                        echo $buku->username;
                                                                    } ?></p>
                                         </div> -->
                                     </div>
                                     <div class="section-title">Barcode</div>
                                     <img alt="image" src="<?= base_url('Admin/InventoryBuku/Barcode/' . $buku->id_buku) ?>" class=" author-box-picture" height="100" style="width: 200px;">
                                     <div class="section-title">Sinopsis</div>
                                     <p class="m-t-30"><?= $buku->sinopsis ?></p>
                                 </div>
                                 <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                     <form method="post" class="needs-validation" action="<?= base_url('Admin/InventoryBuku/EditBuku/' . $buku->id_buku) ?>" enctype="multipart/form-data">
                                         <div class="card-header">
                                             <h4>Edit Profile</h4>
                                         </div>
                                         <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Judul</label>
                                                     <input type="text" name="judul" class="form-control" value="<?= $buku->judul_buku ?>">
                                                 </div>
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Penulis</label>
                                                     <input type="text" name="penulis" class="form-control" value="<?= $buku->judul_buku ?>">

                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Kategori</label>
                                                     <?php foreach ($category as $ktt) {
                                                            $ctg_place[] = $ktt['nama_kategori'];
                                                        }
                                                        $kat_place = explode(",", $buku->kategori);
                                                        $truth = array_intersect($ctg_place, $kat_place);
                                                        // echo var_dump($kat_place);
                                                        // echo var_dump($truth);
                                                        // foreach ($kat_place as $ter) {
                                                        //     echo $ter;
                                                        // }
                                                        ?>
                                                     <select name="kategori[]" class="form-control selectric" multiple="">
                                                         <?php foreach ($kat_place as $ktp) : ?>
                                                             <option value="<?= $ktp ?>" selected><?= $ktp ?></option>
                                                         <?php endforeach; ?>
                                                         <?php foreach ($category as $ctg) : ?>
                                                             <?php if (in_array($ctg['nama_kategori'], $kat_place)) : ?>
                                                             <?php else : ?>
                                                                 <option value="<?= $ctg['nama_kategori'] ?>" s><?= $ctg['nama_kategori'] ?></option>
                                                             <?php endif; ?>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <!-- <?php foreach ($kat_place as $ter) : ?>
                                                         <?php if ($ter == $ctg['nama_kategori']) : ?>
                                                             <option value="<?= $ctg['nama_kategori']; ?>" selected><?= $ctg['nama_kategori']; ?></option>

                                                         <?php else : ?>
                                                             <option value="<?= $ctg['nama_kategori']; ?>"><?= $ctg['nama_kategori']; ?></option>
                                                         <?php endif; ?>
                                                     <?php endforeach; ?> -->

                                                 </div>
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Kode ISBN</label>
                                                     <input type="text" name="isbn_code" class="form-control" value="<?= $buku->kode_buku ?>">
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Tahun Terbit</label>
                                                     <input id="tahun_terbit" type="date" name="tahun_terbit" value="<?= $buku->tahun_terbit ?>" class="form-control" required="">

                                                 </div>
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Tanggal Masuk</label>
                                                     <input id="tanggal_masuk" type="date" name="tanggal_masuk" value="<?= $buku->tanggal_masuk ?>" class="form-control" required="">

                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Halaman</label>
                                                     <input type="text" name="halaman" class="form-control" value="<?= $buku->halaman ?> ">

                                                 </div>
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Cover Buku</label>
                                                     <div class="custom-file">
                                                         <label class="custom-file-label" for="customFile" id="nama-file">Pilih</label>
                                                         <input type="file" name="cover_buku" class="custom-file-input" id="nama-input" />
                                                     </div>

                                                 </div>
                                                 <script>
                                                     document.getElementById('nama-input').onchange = function() {
                                                         var nama = this.files.item(0).name;
                                                         document.getElementById('nama-file').innerText = nama;
                                                     };
                                                 </script>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-md-12 col-12">
                                                     <label>Status Buku</label>
                                                     <select name="status_buku" class="form-control">
                                                         <?php if ($buku->status_buku == 0) { ?>
                                                             <option selected value="0">Tersedia</option>
                                                             <option value="1">Tidak</option>
                                                         <?php } else {
                                                            ?>
                                                             <option value="0">Tersedia</option>
                                                             <option value="1" selected>Tidak</option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>

                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-12">
                                                     <label>Sinopsis / Deskripsi</label>
                                                     <textarea name="sinopsis" class="form-control summernote-simple"><?= $buku->sinopsis ?></textarea>
                                                 </div>
                                             </div>


                                         </div>
                                         <div class="card-footer text-right">
                                             <button class="btn btn-primary">Save Changes</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <div class="settingSidebar">
         <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
         </a>
         <div class="settingSidebar-body ps-container ps-theme-default">
             <div class=" fade show active">
                 <div class="setting-panel-header">Setting Panel
                 </div>
                 <div class="p-15 border-bottom">
                     <h6 class="font-medium m-b-10">Select Layout</h6>
                     <div class="selectgroup layout-color w-50">
                         <label class="selectgroup-item">
                             <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                             <span class="selectgroup-button">Light</span>
                         </label>
                         <label class="selectgroup-item">
                             <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                             <span class="selectgroup-button">Dark</span>
                         </label>
                     </div>
                 </div>
                 <div class="p-15 border-bottom">
                     <h6 class="font-medium m-b-10">Sidebar Color</h6>
                     <div class="selectgroup selectgroup-pills sidebar-color">
                         <label class="selectgroup-item">
                             <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                             <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                         </label>
                         <label class="selectgroup-item">
                             <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                             <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                         </label>
                     </div>
                 </div>
                 <div class="p-15 border-bottom">
                     <h6 class="font-medium m-b-10">Color Theme</h6>
                     <div class="theme-setting-options">
                         <ul class="choose-theme list-unstyled mb-0">
                             <li title="white" class="active">
                                 <div class="white"></div>
                             </li>
                             <li title="cyan">
                                 <div class="cyan"></div>
                             </li>
                             <li title="black">
                                 <div class="black"></div>
                             </li>
                             <li title="purple">
                                 <div class="purple"></div>
                             </li>
                             <li title="orange">
                                 <div class="orange"></div>
                             </li>
                             <li title="green">
                                 <div class="green"></div>
                             </li>
                             <li title="red">
                                 <div class="red"></div>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="p-15 border-bottom">
                     <div class="theme-setting-options">
                         <label class="m-b-0">
                             <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
                             <span class="custom-switch-indicator"></span>
                             <span class="control-label p-l-10">Mini Sidebar</span>
                         </label>
                     </div>
                 </div>
                 <div class="p-15 border-bottom">
                     <div class="theme-setting-options">
                         <label class="m-b-0">
                             <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
                             <span class="custom-switch-indicator"></span>
                             <span class="control-label p-l-10">Sticky Header</span>
                         </label>
                     </div>
                 </div>
                 <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                     <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                         <i class="fas fa-undo"></i> Restore Default
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>