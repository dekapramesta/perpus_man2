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
                                         <h4>Registrasi Siswa</h4>
                                     </div>
                                     <div class="col text-right">
                                         <button onclick="modal_register()" type="button" class="btn btn-primary" href="">Tambah Data</button>
                                         <button onclick="modal_csv()" type="button" class="btn btn-primary" href="">Import CSV file</button>
                                         <a href="<?= base_url('SuperAdmin/Registrasi/download') ?>" type="button" class="btn btn-primary" href="">Download</a>


                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped" id="table-1">
                                     <thead>
                                         <tr>
                                             <th class="text-center">
                                                 #
                                             </th>
                                             <th>NISN</th>
                                             <th>Nama</th>

                                             <th>Code</th>
                                             <th>No Whatsapp</th>

                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 0;
                                            foreach ($siswa as $sis) : $no++; ?>
                                             <tr>
                                                 <td>
                                                     <?= $no; ?>
                                                 </td>
                                                 <td><?= $sis['nisn'] ?></td>
                                                 <td><?= $sis['nama'] ?></td>
                                                 <td><?= $sis['code'] ?></td>
                                                 <td><?= $sis['no_hp'] ?></td>
                                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                                                 <td>
                                                     <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                     <div class="dropdown-menu">
                                                         <a onclick="modal_EditRegist(<?= $sis['id_user'] ?>)" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                         <a href="#" onclick="deleteAktivasi('<?= $sis['id_user'] ?>')" class="dropdown-item has-icon"><i class="far fa-trash-alt"></i> Delete</a>
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
             function modal_register() {
                 $('#add_regis').appendTo("body").modal('show');
                 //  document.getElementById("jeneng").value = "";
             }

             function modal_EditRegist(id) {
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 $('#edit_regis').appendTo("body").modal('show');
                 $.ajax({
                     type: "POST",
                     url: "<?php echo site_url('SuperAdmin/Registrasi/getRegister/') ?>" + id,
                     data: {
                         [csrfName]: csrfHash,
                     },
                     dataType: "JSON",
                     success: function(resultData) {
                         console.log(resultData)
                         $('.txt_csrfname').val(resultData.token);
                         $('#edit_id_register').val(resultData.profile.id_user);
                         $('#edit_nama').val(resultData.profile.nama);
                         $('#edit_no_wa').val(resultData.profile.no_hp);
                         $('#edit_nisn').val(resultData.profile.nisn);

                     }

                 });

             }

             function modal_csv() {
                 $('#upload_csv').appendTo("body").modal('show');
             }
         </script>
         <div class="modal fade" id="upload_csv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Register</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?php echo base_url('SuperAdmin/Registrasi/csv_regist') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                 <input type="file" name="userfile">
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
         <div class="modal fade" id="add_regis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Register</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?php echo base_url('SuperAdmin/Registrasi/tambah_regist') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required="">
                             </div>
                             <div class="form-group">
                                 <input id="jeneng" placeholder="Nama" type="text" name="nama" class="form-control" required="">
                             </div>
                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                             <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                             <div class="form-group">
                                 <input id="no_wa" placeholder="No Whatssapp" type="text" name="no_hp" class="form-control" required="">
                             </div>
                             <div class="form-group">
                                 <input id="barcode" placeholder="Angkatan" type="text" name="angkatan" class="form-control" required="">
                             </div>
                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="edit_regis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Edit Data Register</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?php echo base_url('SuperAdmin/Registrasi/edit_regist') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <strong><label>NISN</label></strong>
                                 <input id="edit_id_register" type="text" name="id_register" class="form-control " required="">
                                 <input id="edit_nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required="">
                             </div>
                             <div class="form-group">
                                 <strong><label>Nama</label></strong>
                                 <input id="edit_nama" placeholder="Nama" type="text" name="nama" class="form-control" required="">
                             </div>
                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                             <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                             <div class="form-group">
                                 <strong><label>No Whatsapp</label></strong>
                                 <input id="edit_no_wa" placeholder="No Whatssapp" type="text" name="no_wa" class="form-control" required="">
                             </div>

                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <script>
             function deleteAktivasi(id) {
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 swal({
                         title: 'Delete Aktivasi',
                         text: 'Yakin ingin Menghapus Aktivasi User?',
                         icon: 'warning',
                         buttons: true,
                         dangerMode: true,
                     })
                     .then((willDelete) => {
                         if (willDelete) {
                             $.ajax({
                                 type: "POST",
                                 url: "<?php echo site_url('SuperAdmin/Registrasi/deleteAktivasi') ?>",
                                 data: {
                                     [csrfName]: csrfHash,
                                     'id_user': id,
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