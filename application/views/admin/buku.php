 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <div class="col">
                                 <div class="row ">
                                     <div class="col">
                                         <h4>Buku</h4>
                                     </div>
                                     <div class="col text-right">
                                         <!-- <button onclick="KembaliBuku()" type="button" class="btn btn-success" href="">Pengembalian Buku</button>
                                         <button onclick="PinjamBuku()" type="button" class="btn btn-success" href="">Pinjam Buku</button> -->
                                         <a href="<?= base_url('Admin/InventoryBuku/PenambahanBuku') ?>" class="btn btn-primary">Tambah Data</a>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped" id="table-2">
                                     <thead>
                                         <tr>
                                             <th class="text-center">
                                                 #
                                             </th>
                                             <th>Judul Buku</th>
                                             <th>Kode Buku</th>
                                             <th>Tanggal Masuk</th>
                                             <th>Status Buku</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 0;
                                            foreach ($getAllBook as $book) : $no++ ?>
                                             <tr>
                                                 <td>
                                                     <?= $no ?>
                                                 </td>
                                                 <td><?= $book['judul_buku'] ?></td>
                                                 <td><?= $book['id_buku'] ?></td>
                                                 <td><?= $book['tanggal_masuk'] ?></td>
                                                 <td><?php if ($book['status_buku'] == 0) {
                                                            echo "Tersedia";
                                                        } elseif ($book['status_buku'] == 7) {
                                                            echo "Dipesan";
                                                        } else {
                                                            echo "Dipinjam";
                                                        }  ?></td>

                                                 <td>
                                                     <div class="dropdown">
                                                         <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                         <div class="dropdown-menu">
                                                             <a href="<?= base_url('Admin/InventoryBuku/DetailBuku/' . $book['id_buku']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i>Detail & Edit</a>
                                                             <a href="#" onclick="deleteBuku('<?= $book['id_buku'] ?>')" class="dropdown-item has-icon"><i class="far fa-trash-alt"></i> Delete</a>
                                                         </div>
                                                     </div>
                                                 </td>
                                             </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <script>
             function KembaliBuku() {
                 $('#kembali_buku').appendTo("body").modal('show');

             }

             function addBook() {
                 $('#add_book').appendTo("body").modal('show');

             }

             function PinjamBuku() {
                 $('#pinjam_buku').appendTo("body").modal('show');
             }
         </script>
         <div class="modal fade" id="kembali_buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Pinjam Buku</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body" id="container_kembali">
                         <form action="#" method="post" id="form_kembali">
                             <div class="form-group">
                                 <input id="barcode_kembali" placeholder="Barcode Buku" type="text" name="barcode" class="form-control " required="">
                             </div>

                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                     <div id="container_pengembalian" class="modal-body" style="display: none;">
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
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                             <div class="row justify-content-between">
                                 <div align="left">

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
         <div class="modal fade" id="pinjam_buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Pinjam Buku</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div id="container_search" class="modal-body">
                         <form id="form_pinjam">
                             <div class="form-group">
                                 <input id="barcode_pinjam" placeholder="Barcode Buku" type="text" name="barcode" class="form-control " required="">
                             </div>

                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                     <div id="container_pinjam" class="modal-body" style="display: none;">
                         <form action="<?= base_url('Admin/InventoryBuku/PinjamBuku') ?>" method="post" enctype="multipart/form-data">
                             <div id="container" class="form-group">
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

                             <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                             <div class="row justify-content-between">
                                 <div align="left">
                                     <button type="button" onclick="back_scan()" class="btn btn-success ml-3">Back To Scan</button>

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
         <div class="modal fade" id="add_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Register</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div id="form_scan" class="modal-body">
                         <form action="#" method="post" id="form_scaner">
                             <div class="form-group">
                                 <input id="isbn_code" placeholder="Kode Buku ISBN" type="text" name="isbn_code" class="form-control " required="">
                             </div>

                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
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
                                 <textarea id="sinopsis" name="desc" class="form-control" rows="3" h-100>asjakj</textarea>

                             </div>


                             <div class="form-group">
                                 <label for="">Judul</label>
                                 <input id="judul" placeholder="Judul" type="text" name="judul" class="form-control" required="">
                             </div>
                             <div class="form-group" id="category">
                                 <label class="form-label">Kategori</label>

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
                                 <label for="">Cover</label>
                                 <div id="cover_place">

                                 </div>
                                 <div id="src_place">

                                 </div>
                             </div>


                             <div class="row justify-content-between">
                                 <div align="left">
                                     <button type="button" onclick="back_scan()" class="btn btn-success ml-3">Back To Scan</button>

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
         <script>
             document.getElementById("form_kembali").addEventListener('submit', function(e) {
                 e.preventDefault();
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 let book_return = document.getElementById('barcode_kembali').value;
                 let return_search = document.getElementById('container_kembali')
                 let place_return = document.getElementById('container_pengembalian')
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


             });
             document.getElementById("form_pinjam").addEventListener('submit', function(e) {
                 e.preventDefault();
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 let book = document.getElementById('barcode_pinjam').value;
                 let place_search = document.getElementById('container_search')
                 let place_pinjam = document.getElementById('container_pinjam')
                 $.ajax({
                     type: "POST",
                     url: "<?php echo site_url('Admin/InventoryBuku/getBook') ?>",
                     data: {
                         [csrfName]: csrfHash,
                         'barcode_book': book

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
                             $('.txt_csrfname').val(result.token);
                             document.getElementById('barcode_buku').value = result.buku.id_buku
                             document.getElementById('judul_buku').value = result.buku.judul_buku
                             place_search.style.display = "none";
                             place_pinjam.style.display = "block";

                         }
                     }

                 });


             });

             function back_scan() {
                 document.getElementById('form_scan').style.display = "block";
                 document.getElementById('form_addBook').style.display = "none";
                 document.getElementById('isbn_code_add').value = " ";
                 document.getElementById('sinopsis').innerHTML = " ";
                 document.getElementById('tahun_terbit').value = " ";
                 //  document.getElementById('tanggal_masuk').value = " ";
                 document.getElementById('halaman').value = " ";
                 document.getElementById('penulis').value = " ";
             }
             document.getElementById("form_scaner").addEventListener('submit', function(e) {
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
                                 $('#src_place').html('<input type="text" name="src_book" class="form-control" value="0"/>');

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
                                             $('#src_place').html('<input type="text" name="src_book"  class="form-control" value="1"/>');
                                             $('#category').append('<select name="kategori" class="form-control"><option value="Fiksi"> Fiksi</option><option >Option 2</option><option>Option 3 < /option></select>');
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
                                         $('#src_place').html('<input type="text" name="src_book" class="form-control" value="1"/>');
                                         formscan.style.display = "none";
                                         document.getElementById('form_addBook').style.display = "block";
                                     } else {
                                         swal('Your imaginary file is safe!');
                                     }
                                 });
                         }




                     }

                 });


                 // document.forms["my_form"]["tes"].focus();



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

             function ModeGuru(event) {
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 if (event.target.value == 0) {
                     event.target.value = 1
                     $('#id_place').html(' <label>Nama Guru</label><select class = "form-control" id="dropdown_guru" name="id_guru"></select>')

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

             function deleteBuku(id) {
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 swal({
                         title: 'Delete Buku',
                         text: 'Yakin ingin Mengdelete Buku?',
                         icon: 'warning',
                         buttons: true,
                         dangerMode: true,
                     })
                     .then((willDelete) => {
                         if (willDelete) {
                             $.ajax({
                                 type: "POST",
                                 url: "<?php echo site_url('Admin/InventoryBuku/deleteBook') ?>",
                                 data: {
                                     [csrfName]: csrfHash,
                                     'id_buku': id,
                                 },
                                 dataType: "JSON",
                                 success: function(resultData) {
                                     $('.txt_csrfname').val(resultData.token);
                                     console.log(resultData);
                                     $(document).ajaxStop(function() {
                                         if (resultData.status == 0) {
                                             swal('Gagal', 'Gagal Menghapus', 'error');

                                         } else {
                                             swal('Success', 'Sukses Menghapus', 'success').then((ok) => {
                                                 window.location.reload();

                                             });

                                         }
                                     });

                                 }

                             });
                         } else {
                             swal('Dibatalkan!');
                         }
                     });
             }
         </script>