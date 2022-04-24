 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Pengembalian</h4>
                         </div>
                         <div class="card-body" id="card_kembali">
                             <div class="section-title mt-0">Kode Buku</div>
                             <div class="form-group">
                                 <input type="text" id="barcode_kembali" class="form-control">
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                             </div>
                             <div class="form-group">
                                 <button onclick="CariBukuKembali()" class="btn btn-primary w-100">Lihat</button>
                             </div>

                         </div>
                         <div class="card-body" id="card_pengembalian" style="display: none;">
                             <form action="<?= base_url('Admin/InventoryBuku/KembaliBuku') ?>" method="post" enctype="multipart/form-data">
                                 <div class="form-group">
                                     <label for="">Kode Bar</label>
                                     <input readonly id="barcode_return" placeholder="Barcode Buku" type="text" name="barcode_return" class="form-control " required="">
                                     <input readonly id="id_peminjaman" placeholder="Barcode Buku" type="text" name="id_peminjaman" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Judul Buku</label>
                                     <input readonly id="buku_return" placeholder="Judul Buku" type="text" name="judul_return" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Id Siswa / Barcode</label>
                                     <input readonly id="siswa_return" placeholder="Barcode Siswa" type="text" name="siswa_return" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lama Pinjam</label>
                                     <input readonly id="lama_return" placeholder="Barcode Siswa" type="text" name="lama_return" class="form-control " required="">
                                 </div>

                                 <!-- <div class="form-group">
                                 <input id="judulbuku" placeholder="Judul Buku" type="text" name="judul_buku    " class="form-control" required="">
                             </div> -->
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                 <!-- <div class="form-group">
                                 <input id="judulbuku" placeholder="Judul Buku" type="text" name="judul_buku    " class="form-control" required="">
                             </div> -->
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 <div class="form-group">
                                     <button class="btn btn-primary w-100" type="submit">Pengembalian</button>
                                 </div>
                             </form>
                         </div>

                     </div>

                 </div>
             </div>
         </div>
     </section>

 </div>
 <script>
     function CariBukuKembali() {
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         let book_return = document.getElementById('barcode_kembali').value;
         let return_search = document.getElementById('card_kembali')
         let place_return = document.getElementById('card_pengembalian')
         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/InventoryBuku/getBookReturn') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'barcode_book': book_return

             },
             dataType: "JSON",
             success: function(result) {
                 //  console.log(result)
                 console.log(result)
                 if (result.buku != false) {

                     $('.txt_csrfname').val(result.token);
                     document.getElementById('id_peminjaman').value = result.buku.peminjaman.id_peminjaman
                     document.getElementById('barcode_return').value = result.buku.peminjaman.id_buku
                     document.getElementById('buku_return').value = result.buku.peminjaman.judul_buku
                     document.getElementById('siswa_return').value = result.buku.peminjaman.username
                     document.getElementById('lama_return').value = result.buku.lamapinjam
                     return_search.style.display = "none";
                     place_return.style.display = "block";
                 } else {
                     $('.txt_csrfname').val(result.token);
                     swal('Tidak Ditemukan', 'Peminjaman Dengan Buku Tersebut Tidak Ada', 'error');

                 }
             }

         });


     }
 </script>