 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Cetak Barcode Guru</h4>
                         </div>
                         <div class="card-body" id="card_kembali">
                             <h1>Wa API</h1>
                             <p></p>
                             <img id="qrcode" src="" alt="qrcode" />
                             <h3>Logs:</h3>
                             <ul class="logs"></ul>
                         </div>

                     </div>

                 </div>
             </div>
         </div>
     </section>

 </div>
 <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>"></script>
 <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.1/socket.io.min.js" integrity="sha512-iqRVtNB+t9O+epcgUTIPF+nklypcR23H1yR1NFM9kffn6/iBhZ9bTB6oKLaGMv8JE9UgjcwfBFg/eHC/VMws+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
 <script>
     $(document).ready(function() {
         const socket = io.connect('http://localhost:5000/');

         socket.on("connect", () => {
             // either with send()
         });

         socket.on("message", function(msg) {
             $(".logs").append($("<li>").text(msg));
         });
         socket.on("qr", function(templek) {
             $("#qrcode").attr("src", templek);
         });
     });
 </script>