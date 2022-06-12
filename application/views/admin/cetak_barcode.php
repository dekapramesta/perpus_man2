 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Cetak Barcode</h4>
                         </div>
                         <div class="card-body" id="card_kembali">
                             <form action="<?= base_url('Admin/InventoryBuku/CetakBarcodeBuku') ?>" method="post" enctype="multipart/form-data">
                                 <div class="section-title">Buku</div>
                                 <div class="form-group">
                                     <select name="buku[]" class="form-control w-100 select2" multiple="" id="pilih_buku">
                                         <?php foreach ($buku as $bk) : ?>
                                             <option value="<?= $bk['judul_buku'] ?>"><?= $bk['judul_buku'] ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <script>
                                     //  function Change() {
                                     //      $("#pilih_buku").each(function() {
                                     //          let thisOptionValue = $(this).val();


                                     //          if (thisOptionValue.includes("BU")) {
                                     //              // <-- HERE
                                     //             //  $(this).val('').trigger('change');
                                     //              $(this).prop('selected', true);

                                     //          }
                                     //          console.log(thisOptionValue)

                                     //      });
                                     //      //  var elements = document.getElementById("pilih_buku").options;
                                     //      //  let value = $("#pilih_buku").val();
                                     //      //  if (value.includes("BU")) {


                                     //      //      for (var i = 0; i < elements.length; i++) {
                                     //      //          elements[i].selected = false;
                                     //      //      }
                                     //      //      $("#pilih_buku").val('').trigger('change');
                                     //      //      let su = $(this).val()
                                     //      //      console.log(su)
                                     //      //  }


                                     //  }
                                 </script>


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