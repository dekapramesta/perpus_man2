 <?php echo $this->session->flashdata('pesan'); ?>
 <main id="main">
     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs" data-aos="fade-in">
         <div class="container">
             <h2>Pricing</h2>
             <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
         </div>
     </div><!-- End Breadcrumbs -->

     <!-- ======= Pricing Section ======= -->
     <section id="pricing" class="pricing">
         <div class="container" data-aos="fade-up">

             <div class="row justify-content-center">
                 <?php foreach ($hadiah as $hdh) : ?>
                     <div class="col-lg-3 col-md-6 mt-2">
                         <div class="box">
                             <h3><?= $hdh['jenis_item'] ?></h3>
                             <h4><?= $hdh['coin_hadiah'] ?> Coin</h4>
                             <ul>
                                 <li>Tukar Dengan</li>
                                 <li>
                                     <h4 style="font-size: medium;"><?= $hdh['nama_item'] ?></h4>
                                 </li>

                             </ul>
                             <div class="btn-wrap">
                                 <a href="#" onclick="Modaltukar('<?= $hdh['id_hadiah'] ?>','<?= $hdh['nama_item'] ?>')" class="btn-buy">Tukar Sekarang</a>
                             </div>
                         </div>
                     </div>
                 <?php endforeach; ?>








             </div>

         </div>
     </section><!-- End Pricing Section -->

 </main>
 <script>
     function Modaltukar(id, nama) {
         //  alert(nama)
         $('#idhadiah').val(id);
         $('#item_name').html(nama);
         $('#ModalTukar').appendTo("body").modal('show');
     }
 </script>
 <div class="modal fade" id="ModalTukar" tabindex="-1" aria-labelledby="exampleModalPromoLabel4" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered no-transform">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalPromoLabel4">Booking Buku</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="<?= base_url('Events/TukarHadiah') ?>" enctype="multipart/form-data" method="post">
                 <div class="modal-body text-center">
                     <p>Apa kau Yakin Ingin Menukarkan Coin mu Dengan <span id="item_name"></span> ? </p>
                     <input hidden name="id_hadiah" id="idhadiah" type="text" value="">
                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                 </div>
                 <div class="modal-footer align-item-center">
                     <div class="col">
                         <div class="row justify-content-center">
                             <div class="col"> <button type="button" class="btn btn-secondary w-100 " data-bs-dismiss="modal">Tidak</button>
                             </div>
                             <div class="col d-flex flex-row-reverse"> <button type="submit" class="btn btn-primary w-100">Iya</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>