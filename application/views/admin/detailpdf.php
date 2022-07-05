 <?php if ($this->session->flashdata('pdf_edit')) {
        echo $this->session->flashdata('pdf_edit');
        $this->session->set_flashdata(
            'pdf_edit',
            ''
        );
    } ?>
 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row mt-sm-4">
                 <div class="col-12 col-md-12 col-lg-12">
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
                                         <div class="col-md-3 col-6">
                                             <strong>Judul</strong>
                                             <br>
                                             <p class="text-muted"><?= $ebook->judul_ebook ?></p>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>Penulis</strong>
                                             <br>
                                             <p class="text-muted"><?= $ebook->penulis ?></p>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>Halaman</strong>
                                             <br>
                                             <p class="text-muted"><?= $ebook->halaman ?></p>
                                         </div>
                                         <div class="col-md-3 col-6">
                                             <strong>File Ebook</strong>
                                             <br>
                                             <p class="text-muted"><?= $ebook->file_ebook ?></p>
                                         </div>
                                         <div class="col-md-3 col-6 b-r">
                                             <strong>Kategori</strong>
                                             <br>
                                             <?php $kategori = explode(',', $ebook->kategori);
                                                foreach ($kategori as $ktg) : ?>
                                                 <span class="badge badge-secondary w-100 mt-1"><?= $ktg ?></span>
                                             <?php endforeach; ?>
                                         </div>
                                         <div class="col-md-3 col-6 b-r ml-2">
                                             <strong>Dimasukan Oleh</strong>
                                             <br>
                                             <p class="text-muted"><?= $admin->nama_admin ?></p>
                                         </div>


                                     </div>
                                     <div class="section-title">Sinopsis</div>
                                     <p class="m-t-30"><?= $ebook->deskripsi ?></p>
                                 </div>
                                 <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                     <form method="post" class="needs-validation" action="<?= base_url('Admin/Inventorypdf/EditPdf/' . $ebook->id_ebook) ?>" enctype="multipart/form-data">
                                         <div class="card-header">
                                             <h4>Edit Profile</h4>
                                         </div>
                                         <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Judul</label>
                                                     <input type="text" name="judul" class="form-control" value="<?= $ebook->judul_ebook ?>">
                                                 </div>
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>Penulis</label>
                                                     <input type="text" name="penulis" class="form-control" value="<?= $ebook->penulis ?>">

                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label>Kategori</label>
                                                         <br>
                                                         <?php foreach ($category_pdf as $ktt) {
                                                                $ctg_place[] = $ktt['nama_kategori'];
                                                            }
                                                            $kat_place = explode(",", $ebook->kategori);
                                                            $truth = array_intersect($ctg_place, $kat_place);
                                                            ?>
                                                         <select name="kategori[]" class="form-control select2cok" multiple="" style="width: 100%">
                                                             <?php if ($truth != null) : ?>

                                                                 <?php foreach ($category_pdf as $ctg) : ?>
                                                                     <?php if (in_array($ctg['nama_kategori'], $truth)) : ?>
                                                                         <option value="<?= $ctg['nama_kategori'] ?>" selected><?= $ctg['nama_kategori'] ?></option>
                                                                     <?php else : ?>
                                                                         <option value="<?= $ctg['nama_kategori'] ?>"><?= $ctg['nama_kategori'] ?></option>
                                                                     <?php endif; ?>
                                                                 <?php endforeach; ?>
                                                             <?php else : ?>
                                                                 <?php foreach ($category_pdf as $ctg) : ?>
                                                                     <option value="<?= $ctg['nama_kategori'] ?>"><?= $ctg['nama_kategori'] ?></option>
                                                                 <?php endforeach; ?>
                                                             <?php endif; ?>
                                                         </select>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label>Halaman</label>
                                                         <input type="text" name="halaman" class="form-control" value="<?= $ebook->halaman ?> ">
                                                     </div>
                                                 </div>
                                             </div>


                                             <div class="row">
                                                 <div class="form-group col-md-6 col-12">
                                                     <label>File Pdf</label>
                                                     <input type="file" name="file_pdf" class="form-control" />
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-12">
                                                     <label>Sinopsis / Deskripsi</label>
                                                     <textarea name="deskripsi" class="form-control summernote-simple"><?= $ebook->deskripsi ?></textarea>
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