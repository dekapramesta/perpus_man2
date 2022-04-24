 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Cetak laporan Buku Masuk</h4>
                         </div>
                         <div class="card-body" id="card_kembali">
                             <form action="<?= base_url('Admin/Laporan/CetakBukuMasuk') ?>" method="post" enctype="multipart/form-data">
                                 <div class="section-title">Tahun</div>
                                 <div class="form-group">
                                     <select name="tahun" class="form-control" id="">
                                         <?php foreach ($tahun as $thn) { ?>
                                             <option value="<?= $thn['YEAR(tanggal_masuk)'] ?>"><?= $thn['YEAR(tanggal_masuk)'] ?></option>
                                         <?php } ?>
                                     </select>
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="section-title">Bulan</div>
                                 <div class="form-group">
                                     <select name="bulan" class="form-control" id="">
                                         <option value="" selected>Pilih Bulan</option>
                                         <?php $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            $no = 0;
                                            foreach ($bulan as $bln) : $no++; ?>
                                             <option value="<?= $no ?>"><?= $bln ?></option>
                                         <?php endforeach; ?>

                                     </select>
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="section-title">Tanggal</div>
                                 <div class="form-group">
                                     <select name="hari" class="form-control" id="">
                                         <option value="" selected>Pilih Hari</option>
                                         <?php for ($no = 1; $no <= 31; $no++) { ?>
                                             <option value="<?= $no ?>"><?= $no ?></option>
                                         <?php } ?>
                                     </select>
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>

                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary w-100">Lihat</button>
                                 </div>
                             </form>
                         </div>

                     </div>

                 </div>
             </div>
         </div>
     </section>

 </div>