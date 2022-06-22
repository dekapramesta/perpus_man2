 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row justify-content-center">

                 <div class="col-12 col-md-12 col-lg-10">
                     <div class="card">
                         <div class="card-header">
                             <h4>Penambahan Buku</h4>
                         </div>
                         <div class="card-body" id="form_scan">
                             <div class="section-title mt-0">Kode Buku</div>
                             <form id="tambah_buku">
                                 <div class="form-group">
                                     <input id="isbn_code" placeholder="Kode Buku ISBN" type="text" name="isbn_code" class="form-control " required="">
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary w-100">Lihat</button>
                                 </div>
                             </form>


                         </div>
                         <div id="form_addBook" class="modal-body" style="display: none;">
                             <form action="<?= base_url('Admin/InventoryBuku/TambahBuku') ?>" method="post" enctype="multipart/form-data">
                                 <div id="container_dup" class="form-group">
                                     <div class="pretty p-switch">
                                         <input id="togBtn" onchange="Duplikat(event)" type="checkbox" value="0" />
                                         <div class="state p-primary">
                                             <label>Duplikat Buku</label>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <label for="">Kode ISBN</label>
                                     <input id="isbn_code_add" placeholder="Kode Buku ISBN" type="text" name="isbn_code" class="form-control " required="">
                                 </div>
                                 <!-- <div class="form-group">
                                 <input id="judulbuku" placeholder="Judul Buku" type="text" name="judul_buku    " class="form-control" required="">
                             </div> -->
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                 <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->

                                 <div class="form-group">
                                     <label for="">Deskripsis / Sinopsis</label>
                                     <textarea id="sinopsis" name="desc" class="form-control" rows="3" h-100></textarea>

                                 </div>


                                 <div class="form-group">
                                     <label for="">Judul</label>
                                     <input id="judul" placeholder="Judul" type="text" name="judul" class="form-control" required="">
                                 </div>
                                 <div class="form-group" id="category">
                                     <label class="form-label">Kategori</label>
                                     <div class="col" id="kene_cat"></div>

                                 </div>
                                 <div class="form-group">
                                     <label for="">Penulis</label>
                                     <input id="penulis" placeholder="Penulis" type="text" name="penulis" class="form-control" required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Tahun Terbit</label>
                                     <input id="tahun_terbit" type="date" name="tahun_terbit" class="form-control" required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Halaman</label>
                                     <input id="halaman" placeholder="Halaman" type="text" name="halaman" class="form-control" required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Lokasi Buku</label>
                                     <input id="lokasi" placeholder="Lokasi Buku" type="text" name="lokasi_buku" class="form-control" required="">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Cover</label>
                                     <div id="cover_place">

                                     </div>
                                     <div id="src_place">

                                     </div>
                                 </div>


                                 <div class="row justify-content-between">
                                     <div align="left">
                                         <button type="button" onclick="back_scan_add()" class="btn btn-success ml-3">Back To Scan</button>

                                     </div>
                                     <div align="right">
                                         <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tutup</button>
                                         <button type="submit" class="btn btn-primary">Simpan</button>
                                     </div>
                                 </div>
                             </form>
                         </div>


                     </div>

                 </div>
             </div>
         </div>
     </section>
     <script>
         document.getElementById("tambah_buku").addEventListener('submit', function(e) {
             e.preventDefault();
             let apiurl = 'https://www.googleapis.com/books/v1/volumes?q=';
             let NameBook = $('#isbn_code').val()
             let bella = parseInt(NameBook);
             let deka;
             let codeisbn;
             let takdir = "Buku Tidak Ada";
             let formscan = document.getElementById('form_scan');
             let form_addBook = document.getElementById('form_addBook');


             console.log(NameBook);
             $.ajax({
                 url: apiurl + NameBook,
                 dataType: "JSON",
                 success: function(resultData) {
                     //  console.log(resultData);
                     if (resultData.totalItems > 0) {
                         $.each(resultData.items, function(i, datas) {
                             //  console.log(data)
                             isbn = datas.volumeInfo.industryIdentifiers
                             //  console.log(isbn)
                             $.each(isbn, function(i, data) {
                                 deka = parseInt(data.identifier)
                                 console.log(data.identifier)
                                 if (deka == bella) {

                                     codeisbn = parseInt(data.identifier)

                                     takdir = datas.volumeInfo

                                     //  console.log(takdir)

                                 }


                             });
                         })
                         console.log(takdir)
                         //  for (var i = 0; i < resultData.items.length; i += 2) {
                         //      item = resultData.items[i];
                         //      isbn = item.volumeInfo.industryIdentifiers
                         //      console.log(item)
                         //      $.each(isbn, function(i, data) {
                         //          deka = parseInt(data.identifier)
                         //          console.log(data.identifier)
                         //          if (deka == bella) {

                         //              codeisbn = parseInt(data.identifier)
                         //              console.log(codeisbn);
                         //              takdir = item.volumeInfo

                         //          }


                         //      });

                         //  }
                         //  console.log(takdir);
                         if (takdir != "Buku Tidak Ada") {
                             formscan.style.display = "none";
                             form_addBook.style.display = "block";
                             //  console.log(takdir)
                             document.getElementById('isbn_code_add').value = codeisbn;
                             document.getElementById('sinopsis').innerHTML = takdir.description;
                             document.getElementById('tahun_terbit').value = takdir.publishedDate;
                             //  document.getElementById('tanggal_masuk').value = " ";
                             document.getElementById('halaman').value = takdir.pageCount;
                             document.getElementById('judul').value = takdir.title;
                             $.each(takdir.authors, function(i, penulis) {
                                 writer = penulis
                                 console.log(writer)
                                 document.getElementById('penulis').value = writer;
                             });
                             let ctg = $('#category').append('<div class="selectgroup selectgroup-pills"><label class="selectgroup-item" id="ctg_place"></label></div>');
                             $.each(takdir.categories, function(i, kategori) {
                                 category = kategori
                                 console.log(category)
                                 if (ctg) {
                                     $('#ctg_place').append('<input type="checkbox" name="kategori[]"  class="selectgroup-input" value="' + category + '" checked><span class = "selectgroup-button" >' + category + '</span>')

                                 }
                             });
                             $('#cover_place').html('<input type="text" class="form-control" name="cover" value="' + takdir.imageLinks.thumbnail + '"/>');
                             $('#src_place').html('<input hidden type="text" name="src_book" class="form-control" value="0"/>');

                             //  $.each(takdir.imageLinks, function(i, gambar) {
                             //      console.log(gambar.thumbnail)

                             //      //  document.getElementById('cover').value = gambar.thumbnail;
                             //  });
                         } else if (takdir == "Buku Tidak Ada") {
                             swal({
                                     title: 'Buku Tidak Ada',
                                     text: 'Apakah Anda Ingin Menginputkan Secara Manual?',
                                     icon: 'warning',
                                     buttons: true,
                                     dangerMode: true,
                                 })
                                 .then((willDelete) => {
                                     if (willDelete) {
                                         $('#cover_place').html('<input type="file" name="cover" class="form-control"/>');
                                         $('#src_place').html('<input hidden type="text" name="src_book"  class="form-control" value="1"/>');
                                         $('#category').append('<select name="kategori[]" class="form-control select2" style="width:100%" multiple="" ><?php foreach ($kategori as $ktg) : ?><option value="<?= $ktg['nama_kategori'] ?>"><?= $ktg['nama_kategori'] ?></option><?php endforeach; ?></select>');
                                         $(".select2").select2();
                                         formscan.style.display = "none";
                                         document.getElementById('form_addBook').style.display = "block";
                                     } else {
                                         swal('Your imaginary file is safe!');
                                     }
                                 });

                         }



                     } else {
                         swal({
                                 title: 'Buku Tidak Ada',
                                 text: 'Apakah Anda Ingin Menginputkan Secara Manual?',
                                 icon: 'warning',
                                 buttons: true,
                                 dangerMode: true,
                             })
                             .then((willDel) => {
                                 if (willDel) {
                                     $('#cover_place').html('<input type="file" name"cover" class="form-control"/>');
                                     $('#src_place').html('<input hidden type="text" name="src_book" class="form-control" value="1"/>');
                                     formscan.style.display = "none";
                                     document.getElementById('form_addBook').style.display = "block";
                                 } else {
                                     swal('Your imaginary file is safe!');
                                 }
                             });
                     }




                 }

             });

         });

         function Duplikat(event) {
             if (event.target.value == 0) {
                 event.target.value = 1
                 $('#container_dup').append('<input id="dup_num" name="dup_number" type="number" class="form-control mt-3 w-25" value=""/>')
             } else {
                 event.target.value = 0
                 $('#dup_num').remove()
                 console.log('asu')
             }
         }

         function back_scan_add() {

             document.getElementById('form_scan').style.display = "block";
             document.getElementById('form_addBook').style.display = "none";
             document.getElementById('isbn_code_add').value = " ";
             document.getElementById('sinopsis').innerHTML = " ";
             document.getElementById('tahun_terbit').value = " ";
             //  document.getElementById('tanggal_masuk').value = " ";
             document.getElementById('halaman').value = " ";
             document.getElementById('lokasi').value = " ";
             document.getElementById('judul').value = " ";
             document.getElementById('penulis').value = " ";
             $('#togBtn').prop('checked', false);
             $('#ctg_place').remove()
             $('#dup_num').remove()
             $('#cover_place').html('');
             $('#src_place').html('');

         }
     </script>

 </div>