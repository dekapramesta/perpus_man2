 <?php if ($this->session->flashdata('buku_hilang')) {
        echo $this->session->flashdata('buku_hilang');
        $this->session->set_flashdata(
            'buku_hilang',
            ''
        );
    } ?>
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
                                         <h4>Buku Hilang</h4>
                                     </div>
                                     <div class="col text-right">
                                         <a href="#" onclick="BukuHilang()" class="btn btn-primary">Tambah Data</a>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped" id="table-1">
                                     <thead>
                                         <tr>
                                             <th>
                                                 #
                                             </th>
                                             <th>Id Buku</th>
                                             <th>Judul Buku</th>
                                             <th>Kode ISBN</th>
                                             <th>Aksi</th>


                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 1;
                                            foreach ($all as $al) : $no++ ?>
                                             <tr>
                                                 <td><?= $no; ?></td>
                                                 <td><?= $al['id_buku'] ?></td>
                                                 <td><?= $al['judul_buku'] ?></td>
                                                 <td><?= $al['kode_buku'] ?></td>
                                                 <td onclick="BukuKetemu('<?= $al['id_buku'] ?>','<?= $al['status_buku'] ?>')" class="text-center"><button class="btn btn-primary">Buku Ketemu</button></td>
                                             </tr>
                                         <?php endforeach ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <script>
             function BukuHilang() {
                 $('#modal_hilang').appendTo("body").modal('show');
                 $(".select2").select2({
                     dropdownParent: $('#modal_hilang')

                 });
             }
         </script>
         <div class="modal fade" id="modal_hilang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Buku Hilang</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form id="form_hilang" action="<?php echo base_url('Admin/Perpustakaan/TambahBukuHilang') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                 <select id="buku_sel" class="form-control select2" name="id_buku" style="width: 100%;" required>
                                     <option value="" disabled selected hidden>Pilih Buku</option>

                                     <?php foreach ($buku as $bk) : ?>
                                         <?php if ($bk['status_buku'] == 66) : ?>
                                         <?php elseif ($bk['status_buku'] == 99) : ?>
                                         <?php else : ?>
                                             <option value="<?= $bk['id_buku'] ?>"><?= $bk['judul_buku'] . "-" . $bk['id_buku'] ?></option>
                                         <?php endif; ?>
                                     <?php endforeach; ?>

                                 </select>
                                 <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                             </div>

                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" name="import" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>

         <script>
             document.getElementById("form_hilang").addEventListener('submit', function(e) {
                 e.preventDefault();
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 let val = $('#buku_sel').val()
                 $.ajax({
                     type: "POST",
                     url: "<?php echo site_url('Admin/InventoryBuku/BukuPinjamHilang') ?>",
                     data: {
                         [csrfName]: csrfHash,
                         'id_buku': val
                     },
                     dataType: "JSON",
                     success: function(resultData) {
                         $('.txt_csrfname').val(resultData.token);
                         if (!resultData.buku) {

                             swal({
                                     title: 'Buku Hilang ?',
                                     text: 'Apakah Anda Yakin Bahwa Buku Hilang?',
                                     icon: 'warning',
                                     buttons: true,
                                     dangerMode: true,
                                 })
                                 .then((willDelete) => {
                                     if (willDelete) {
                                         document.getElementById("form_hilang").submit();


                                     }
                                 });

                         } else {

                             swal({
                                     title: 'Buku Hilang Saat Peminjaman?',
                                     text: 'Hilang Saat Dibawa ' + resultData.buku.peminjaman.username,
                                     icon: 'warning',
                                     buttons: true,
                                     dangerMode: true,
                                 })
                                 .then((willDelete) => {
                                     if (willDelete) {
                                         let csrfName_sec = $('.txt_csrfname').attr('name');
                                         let csrfHash_sec = $('.txt_csrfname').val();
                                         $.ajax({

                                             type: "POST",
                                             url: "<?php echo site_url('Admin/InventoryBuku/HilangPeminjaman') ?>",
                                             data: {
                                                 [csrfName_sec]: csrfHash_sec,
                                                 'id_buku': val,
                                                 'id_peminjaman': resultData.buku.peminjaman.id_peminjaman
                                             },
                                             dataType: "JSON",
                                             success: function(status) {
                                                 $(document).ajaxStop(function() {
                                                     if (status == 1) {
                                                         swal('Success', 'Sukses', 'success').then((ok) => {
                                                             window.location.reload();

                                                         });
                                                     }

                                                 });

                                             }

                                         });

                                     }
                                 });

                         }

                     }

                 });
             })

             function BukuKetemu(id, sts) {
                 if (sts == 99) {
                     swal('Warning', 'Jika Buku Hilang Saat Peminjaman, Lakukan Saja di Menu Pengembalian', 'warning');
                 } else if (sts == 66) {

                     swal({
                             title: 'Buku Ketemu',
                             text: 'Yakin Buku Telah Ditemukan',
                             icon: 'warning',
                             buttons: true,
                             dangerMode: true,
                         })
                         .then((willDelete) => {
                             if (willDelete) {
                                 let csrfName_sec = $('.txt_csrfname').attr('name');
                                 let csrfHash_sec = $('.txt_csrfname').val();
                                 $.ajax({

                                     type: "POST",
                                     url: "<?php echo site_url('Admin/InventoryBuku/BukuKetemu') ?>",
                                     data: {
                                         [csrfName_sec]: csrfHash_sec,
                                         'id_buku': id,

                                     },
                                     dataType: "JSON",
                                     success: function(status) {
                                         $(document).ajaxStop(function() {
                                             if (status == 1) {
                                                 swal('Success', 'Sukses', 'success').then((ok) => {
                                                     window.location.reload();

                                                 });
                                             }

                                         });

                                     }

                                 });

                             }
                         });
                 }
             }
         </script>