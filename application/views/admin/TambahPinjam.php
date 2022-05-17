 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Peminjaman</h4>
                         </div>
                         <div class="card-body" id="card_search">
                             <div class="section-title mt-0">Kode Buku</div>
                             <form id="pinjam_form">
                                 <div class="form-group">
                                     <input type="text" id="id_buku" class="form-control">
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary w-100">Lihat</button>
                                 </div>
                             </form>
                             <script>
                                 document.getElementById("pinjam_form").addEventListener('submit', function(e) {
                                     e.preventDefault();
                                     var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                                     var csrfHash = $('.txt_csrfname').val();
                                     let place_search = document.getElementById('card_search')
                                     let place_pinjam = document.getElementById('card_pinjam')
                                     let idbuku = document.getElementById('id_buku').value;
                                     $.ajax({
                                         type: "POST",
                                         url: "<?php echo site_url('Admin/InventoryBuku/getBook') ?>",
                                         data: {
                                             [csrfName]: csrfHash,
                                             'barcode_book': idbuku

                                         },
                                         dataType: "JSON",
                                         success: function(result) {
                                             console.log(result)
                                             if (result.buku == "unavailable") {
                                                 $('.txt_csrfname').val(result.token);
                                                 swal('Tidak Tersedia', 'Buku Masih Dipinjam', 'error');
                                             } else if (result.buku == "booking") {
                                                 $('.txt_csrfname').val(result.token);
                                                 swal('Tidak Tersedia', 'Buku Telah Dipesan', 'error');
                                             } else if (result.buku == false) {
                                                 $('.txt_csrfname').val(result.token);
                                                 swal('Tidak Tersedia', 'Buku Tidak Ada', 'error');
                                             } else {
                                                 console.log(result.buku)
                                                 $('.txt_csrfname').val(result.token);
                                                 document.getElementById('barcode_buku').value = result.buku.id_buku
                                                 document.getElementById('judul_buku').value = result.buku.judul_buku
                                                 place_search.style.display = "none";
                                                 place_pinjam.style.display = "block";

                                             }
                                         }

                                     });
                                 });
                             </script>

                         </div>
                         <div class="card-body" id="card_pinjam" style="display: none;">
                             <form action="<?= base_url('Admin/InventoryBuku/PinjamBuku') ?>" method="post" enctype="multipart/form-data">
                                 <div id="container_dup" class="form-group">
                                     <div class="pretty p-switch">
                                         <input id="togBtn" onchange="ModeGuru(event)" type="checkbox" value="0" />
                                         <div class="state p-primary">
                                             <label>Peminjamn Guru</label>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Kode Bar</label>
                                     <input readonly id="barcode_buku" placeholder="Barcode Buku" type="text" name="barcode_buku" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Judul Buku</label>
                                     <input readonly id="judul_buku" placeholder="Judul Buku" type="text" name="judul_buku" class="form-control " required="">
                                 </div>
                                 <div class="form-group" id="id_place">
                                     <label for="">Id Siswa / Barcode</label>
                                     <input id="barcode_siswa" placeholder="Barcode Siswa" type="text" name="barcode_siswa" class="form-control " required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lama Pinjam</label>
                                     <select name="lama_pinjam" class="form-control" id="">
                                         <option value="3">3 hari</option>
                                         <option value="5">5 Hari</option>
                                         <option value="7">7 hari</option>
                                     </select>
                                 </div>
                                 <!-- <div class="form-group">
                                 <input id="judulbuku" placeholder="Judul Buku" type="text" name="judul_buku    " class="form-control" required="">
                             </div> -->
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 <div class="form-group">
                                     <button class="btn btn-primary w-100" type="submit">Pinjam</button>
                                 </div>
                             </form>
                         </div>
                         <!-- <div class="card-body">
                             <div class="section-title mt-0">Default</div>
                             <div class="form-group">
                                 <label>Default Select</label>
                                 <select class="form-control">
                                     <option>Option 1</option>
                                     <option>Option 2</option>
                                     <option>Option 3</option>
                                 </select>
                             </div>
                             <div class="section-title">Select 2</div>
                             <div class="form-group">
                                 <label>Select2</label>
                                 <select class="form-control select2">
                                     <option>Option 1</option>
                                     <option>Option 2</option>
                                     <option>Option 3</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>Select2 Multiple</label>
                                 <select class="form-control select2" multiple="">
                                     <option>Option 1</option>
                                     <option>Option 2</option>
                                     <option>Option 3</option>
                                     <option>Option 4</option>
                                     <option>Option 5</option>
                                     <option>Option 6</option>
                                 </select>
                             </div>
                             <div class="section-title">jQuery Selectric</div>
                             <div class="form-group">
                                 <label>jQuery Selectric</label>
                                 <select class="form-control selectric">
                                     <option>Option 1</option>
                                     <option>Option 2</option>
                                     <option>Option 3</option>
                                     <option>Option 4</option>
                                     <option>Option 5</option>
                                     <option>Option 6</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label>jQuery Selectric Multiple</label>
                                 <select class="form-control selectric" multiple="">
                                     <option>Option 1</option>
                                     <option>Option 2</option>
                                     <option>Option 3</option>
                                     <option>Option 4</option>
                                     <option>Option 5</option>
                                     <option>Option 6</option>
                                 </select>
                             </div>
                             <div class="section-title">Select Group Button</div>
                             <div class="form-group">
                                 <label class="form-label">Button Input</label>
                                 <div class="selectgroup w-100">
                                     <label class="selectgroup-item">
                                         <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
                                         <span class="selectgroup-button">S</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
                                         <span class="selectgroup-button">M</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="radio1" value="3" class="selectgroup-input-radio">
                                         <span class="selectgroup-button">L</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="radio1" value="4" class="selectgroup-input-radio">
                                         <span class="selectgroup-button">XL</span>
                                     </label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="form-label">Icons input</label>
                                 <div class="selectgroup w-100">
                                     <label class="selectgroup-item">
                                         <input type="radio" name="transportation" value="2" class="selectgroup-input-radio">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mobile"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="transportation" value="1" class="selectgroup-input-radio" checked>
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-tablet"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="transportation" value="6" class="selectgroup-input-radio">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="transportation" value="5" class="selectgroup-input-radio">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-times"></i></span>
                                     </label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="form-label">Icon input</label>
                                 <div class="selectgroup selectgroup-pills">
                                     <label class="selectgroup-item">
                                         <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked>
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-sun"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-moon"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="icon-input" value="3" class="selectgroup-input">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud-rain"></i></span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="radio" name="icon-input" value="4" class="selectgroup-input">
                                         <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud"></i></span>
                                     </label>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label class="form-label">Your skills</label>
                                 <div class="selectgroup selectgroup-pills">
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked>
                                         <span class="selectgroup-button">HTML</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
                                         <span class="selectgroup-button">CSS</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
                                         <span class="selectgroup-button">PHP</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
                                         <span class="selectgroup-button">JavaScript</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                         <span class="selectgroup-button">Ruby</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                         <span class="selectgroup-button">Ruby</span>
                                     </label>
                                     <label class="selectgroup-item">
                                         <input type="checkbox" name="value" value="C++" class="selectgroup-input">
                                         <span class="selectgroup-button">C++</span>
                                     </label>
                                 </div>
                             </div>
                         </div> -->
                     </div>

                 </div>
             </div>
         </div>
     </section>

 </div>
 <script>
     function ModeGuru(event) {
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         if (event.target.value == 0) {
             event.target.value = 1
             $('#id_place').html(' <label>Nama Guru</label><select class = "form-control select2" id="dropdown_guru" name="id_guru"></select>')
             $(".select2").select2();

             $.ajax({
                 type: "POST",
                 url: "<?php echo site_url('Admin/InventoryBuku/getGuru/') ?>",
                 data: {
                     [csrfName]: csrfHash,
                 },
                 dataType: "JSON",
                 success: function(resultData) {
                     console.log(resultData)
                     $('.txt_csrfname').val(resultData.token);
                     $.each(resultData.guru, function(i, guru) {
                         $('#dropdown_guru').html('<option value="' + guru.id_user + '">' + guru.nama_guru + '</option>')
                     });




                 }

             });

         } else {
             event.target.value = 0
             $('#id_place').html('<label for="">Id Siswa / Barcode</label> <input id = "barcode_siswa"placeholder = "Barcode Siswa"type = "text"name = "barcode_siswa"class = "form-control required = "">')

         }
     }
 </script>