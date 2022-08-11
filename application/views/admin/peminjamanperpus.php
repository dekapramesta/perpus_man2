 <?php if ($this->session->flashdata('peminjaman_buku')) {
        echo $this->session->flashdata('peminjaman_buku');
        $this->session->set_flashdata(
            'peminjaman_buku',
            ''
        );
    } ?>
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
                             <div class="col d-flex">
                                 <div class="section-title mt-0" id="label_level">Siswa</div>
                                 <div class="pretty p-switch ml-auto">
                                     <input id="togBtn" onchange="ModeGuru(event)" type="checkbox" value="0" />
                                     <div class="state p-primary">
                                         <label>Peminjaman Guru</label>
                                     </div>
                                 </div>
                             </div>

                             <form id="pinjam_form">
                                 <div class="form-group">
                                     <input type="text" id="id_siswa" class="form-control">
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary w-100">Lihat</button>
                                 </div>
                             </form>
                             <form id="form_cariguru" style="display: none;">
                                 <div class="form-group">
                                     <select class="form-control select2" id="id_guru" style="width: 100%;">
                                         <?php foreach ($guru as $gr) : ?>
                                             <option value="<?= $gr['id_guru'] ?>"><?= $gr['nama_guru'] ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                     <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-primary w-100">Lihat</button>
                                 </div>
                             </form>
                         </div>
                         <div class="card-body" id="card_siswa" style="display: none;">
                             <div class="row" id="user_place">

                             </div>
                             <div class="padding-20">
                                 <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                     <li class="nav-item w-50">
                                         <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">Peminjaman</a>
                                     </li>
                                     <li class="nav-item w-50">
                                         <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Pinjaman Saat Ini</a>
                                     </li>
                                 </ul>
                                 <div class="tab-content tab-bordered" id="myTab3Content">
                                     <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                         <form action="#" id="form_caribuku">
                                             <div class="d-flex">
                                                 <input id="codebuku" type="text" class="form-control mr-2">
                                                 <button class="btn btn-primary">Cari</button>
                                             </div>
                                         </form>
                                         <form id="form_submitbuku" action="<?= base_url('Admin/Perpustakaan/BukuPinjam') ?>" enctype="multipart/form-data" method="post">
                                             <div class="col" id="book_place">

                                             </div>
                                             <div class="col" id="select_hari" style="display: none;">
                                                 <div class="form-group col-12">
                                                     <label>Lama Pinjam</label>
                                                     <select name="lama_pinjam" class="form-control" id="lama_pinjamhidden" style="width:100%;" required>
                                                         <option value="3">3 hari</option>
                                                         <option value="5">5 Hari</option>
                                                         <option value="7">7 hari</option>
                                                     </select>
                                                 </div>
                                             </div>

                                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                             <div class="form-group" id="btn_sub" style="display: none;">
                                                 <input hidden type="text" id="id_user" name="id_user">
                                                 <button class="btn btn-primary w-100">Submit</button>
                                             </div>
                                         </form>

                                     </div>
                                     <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                         <form method="post" action="<?= base_url('Admin/Perpustakaan/KembalikanSemuaBuku') ?>" enctype="multipart/form-data" class="needs-validation">
                                             <div class="card-header">
                                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                                 <h4>Peminjaman Saat ini</h4>
                                             </div>
                                             <div class="card-body">
                                                 <table class="table table-striped table-hover">
                                                     <thead>
                                                         <tr>
                                                             <th scope="col">ID Buku </th>
                                                             <th scope="col">Judul Buku </th>
                                                             <th scope="col">Batas Tanggal Pengembalian</th>
                                                             <th scope="col">Aksi</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody id="list_peminjaman">


                                                     </tbody>
                                                 </table>

                                             </div>
                                             <div class="card-footer" id="ftkembalisemua" style="display: none;">
                                                 <button class="btn btn-primary w-100">Kembalikan Semua</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </section>

 </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
     function DataPeminjaman(id) {
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         let datenow = new Date().getFullYear() + '-' + ("0" + (parseInt(new Date().getMonth()) + 1)).slice(-2) + '-' + new Date().getDate()
         console.log(datenow);
         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/Perpustakaan/getPeminjaman') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'id': id
             },
             dataType: "JSON",
             success: function(result) {
                 $('.txt_csrfname').val(result.token);
                 if (result.peminjaman != "") {
                     $('#ftkembalisemua').show()
                 }
                 $.each(result.peminjaman, function(i, peminjaman) {
                     $('#list_peminjaman').append(` <tr>
                   <th scope="row">` + peminjaman.id_buku + `</th>
                   <td>` + peminjaman.judul_buku + `</td>
                   <td ` + (parseInt(new Date(peminjaman.tanggal_pengembalian).getTime()) < parseInt(new Date(datenow).getTime()) ? document.write = "style='color:red;'" : "") + ` >` + peminjaman.tanggal_pengembalian + `</td>
                   <td><button type="button" id="btnkembali" class="btn btn-primary"><input name="id_peminjaman[]" hidden id="pinjaminput" type="text" value="` + peminjaman.id_peminjaman + `" />Kembali</button></td>
                 </tr>`)

                 });

             }

         });
     }
     document.getElementById("pinjam_form").addEventListener('submit', function(e) {
         e.preventDefault();
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         let idsiswa = document.getElementById('id_siswa').value;
         let place_search = document.getElementById('card_search')
         let place_diri = document.getElementById('card_siswa')
         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/Perpustakaan/getSiswa') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'code': idsiswa
             },
             dataType: "JSON",
             success: function(result) {
                 $('.txt_csrfname').val(result.token);
                 if (result.status == true) {
                     //  $('#nama_siswa').val(result.data.nama)
                     //  $('#siswa_code').val(result.data.nisn)
                     //  $('#status_user').val('Siswa')
                     $('#id_user').val(result.data.id_user)

                     $('#user_place').html(`<div class="form-group col-md-6 col-12">
                                     <label>Nama</label>
                                     <input id="nama_siswa" type="text" value="` + result.data.nama + `" class="form-control" required="" readonly>
                                 </div>
                                 <div class="form-group col-md-6 col-12">
                                     <label>Status</label>
                                     <input id="status_user" type="text" value="Siswa" class="form-control" required="" readonly>

                                 </div>
                                 <div class="form-group col-md-6 col-12">
                                     <label>NISN</label>
                                     <input id="siswa_code" type="text" value="` + result.data.nisn + `" class="form-control" required="" readonly>

                                 </div>
                                 <div class="form-group col-md-6 col-12">
                                     <label>Lama Pinjam</label>
                                     <select name="lama_pinjam" class="form-control" id="lama_pinjam" required>
                                         <option value="3">3 hari</option>
                                         <option value="5">5 Hari</option>
                                         <option value="7">7 hari</option>
                                     </select>
                                 </div>

`)
                     DataPeminjaman(result.data.id_user)
                     //  $('select_hari').html(`<div class="form-group col-12">
                     //                  <label>Lama Pinjam</label>
                     //                  <select name="lama_pinjam" class="form-control" id="lama_pinjamhidden" style="width:100%;" required>
                     //                      <option value="3">3 hari</option>
                     //                      <option value="5">5 Hari</option>
                     //                      <option value="7">7 hari</option>
                     //                  </select>
                     //              </div>`)
                     place_search.style.display = "none";
                     place_diri.style.display = "block";
                 } else {
                     swal('Tidak Ditemukan', 'Data Tidak Ditemukan', 'error')
                 }
                 console.log(result);
             }

         });
     });
     document.getElementById("form_cariguru").addEventListener('submit', function(e) {
         e.preventDefault();
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         console.log('gruu');
         let guru_place = document.getElementById("card_search")
         let place_diri = document.getElementById('card_siswa')

         let idguru = document.getElementById('id_guru').value;
         //   let place_search = document.getElementById('card_search')
         //   let place_diri = document.getElementById('card_siswa')
         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/Perpustakaan/getGuru') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'id_user': idguru
             },
             dataType: "JSON",
             success: function(result) {
                 $('.txt_csrfname').val(result.token);
                 if (result.status == true) {
                     $('#id_user').val(result.data.id_user)
                     $('#user_place').html(`<div class="form-group col-md-6 col-12">
                                     <label>Nama</label>
                                     <input id="nama_guru" type="text" value="` + result.data.nama_guru + `" class="form-control" required="" readonly>
                                 </div>
                                 <div class="form-group col-md-6 col-12">
                                     <label>Status</label>
                                     <input id="status_user" type="text" value="Guru" class="form-control" required="" readonly>

                                 </div>
                                 <div class="form-group col-12">
                                     <label>Lama Pinjam</label>
                                     <select name="lama_pinjam" class="form-control" id="lama_pinjam" style="width:100%;" required>
                                         <option value="3">3 hari</option>
                                         <option value="5">5 Hari</option>
                                         <option value="7">7 hari</option>
                                     </select>
                                 </div>

`)
                     DataPeminjaman(result.data.id_user)


                     guru_place.style.display = "none";
                     place_diri.style.display = "block";
                 } else {
                     swal('Tidak Ditemukan', 'Data Tidak Ditemukan', 'error')
                 }
                 console.log(result);
             }

         });
     });
     var bukuarray = [];

     document.getElementById("form_caribuku").addEventListener('submit', function(e) {
         e.preventDefault();
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         console.log('oiiii');
         let idbuku = $('#codebuku').val()

         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/Perpustakaan/getBuku') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'idbuku': idbuku
             },
             dataType: "JSON",
             success: function(result) {
                 $('#codebuku').val('')
                 console.log(result);
                 $('.txt_csrfname').val(result.token);
                 if (result.status == true) {
                     if (result.message.status_buku == 1) {
                         swal('Gagal', "Buku Tidak Ada/Tidak Tersedia", "error")
                     } else if (result.message.status_buku == 0) {
                         if (bukuarray.includes(result.message.id_buku)) {
                             swal('Gagal', "Buku dalam daftar", "error")
                         } else {
                             console.log('tidak');
                             bukuarray.push(result.message.id_buku)
                             $('#book_place').append(' <div class="form-group mt-4 d-flex"><input id="idinput" readonly name="buku[]" value="' + result.message.id_buku + '-' + result.message.judul_buku + '" type = "text"class = "form-control mr-2" ><button class ="btn btn-danger" id="btnhapus"><i class="fas fa-trash"></i></button ></div>')
                             $('#btn_sub').show();
                         }
                         console.log();
                     }
                 } else {
                     swal("Gagal", "Buku Tidak Ada/Tersedia", "error")
                 }
                 console.log(bukuarray);

             }

         });



     });


     $("#book_place").on("click", '#btnhapus', function() {
         let nilai = $(this).parent().find('#idinput').val();
         let takenil = nilai.split("-");
         console.log(takenil[0]);
         for (var i = 0; i < bukuarray.length; i++) {

             if (bukuarray[i] == takenil[0]) {

                 bukuarray.splice(i, 1);
             }

         }
         console.log(bukuarray);
         $(this).parent().remove()
         if (bukuarray.length == 0) {
             $('#btn_sub').hide();

         }
     })

     function ModeGuru(event) {
         let siswa_form = document.getElementById('pinjam_form')
         let guru_form = document.getElementById('form_cariguru')
         if (event.target.value == 0) {
             event.target.value = 1
             siswa_form.style.display = "none";
             guru_form.style.display = "block";
             $('#label_level').html('Guru')

         } else {
             event.target.value = 0
             guru_form.style.display = "none";
             siswa_form.style.display = "block";
             $('#label_level').html('Siswa')


         }
     }


     $("#user_place").on("change", '#lama_pinjam', function() {
         console.log($(this).val());
         $('#lama_pinjamhidden').val($(this).val())
     })
     $("#list_peminjaman").on("click", '#btnkembali', function() {
         var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
         var csrfHash = $('.txt_csrfname').val();
         let iduser = $('#id_user').val()
         let idpeminjaman = $(this).parent().find('#pinjaminput').val();
         $.ajax({
             type: "POST",
             url: "<?php echo site_url('Admin/Perpustakaan/KembaliBuku') ?>",
             data: {
                 [csrfName]: csrfHash,
                 'id_peminjaman': idpeminjaman
             },
             dataType: "JSON",
             success: function(result) {
                 console.log(result);
                 $('.txt_csrfname').val(result.token);
                 if (result.status == true) {
                     swal('Success', 'Sukses', 'success').then((ok) => {
                         $('#list_peminjaman').html(' ');
                         DataPeminjaman(iduser)
                     });

                 } else {
                     swal("Gagal", "Gagal", "error")
                 }

             }

         });

     })
 </script>