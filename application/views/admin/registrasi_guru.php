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
                                         <h4>Registrasi Guru</h4>
                                     </div>
                                     <div class="col text-right">
                                         <button onclick="modalguru()" type="button" class="btn btn-primary" href="">Tambah Data</button>
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
                                             <th>Nama Guru</th>
                                             <th>No HP</th>
                                             <th>Kode Aktifasi</th>
                                             <th>Email</th>
                                             <th>Status Registrasi</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 0;
                                            foreach ($guru as $gr) : $no++; ?>
                                             <tr>
                                                 <td>
                                                     <?= $no; ?>
                                                 </td>
                                                 <td><?= $gr['nama_guru'] ?></td>
                                                 <td><?= $gr['no_hp'] ?></td>
                                                 <td><?= $gr['code'] ?></td>
                                                 <td><?= $gr['email'] ?></td>
                                                 <td class="text-center">
                                                     <?php if ($gr['status_daftar'] == 1) { ?>
                                                         <div class="badge badge-success badge-shadow w-75">Sudah</div>
                                                     <?php } else { ?>
                                                         <div class="badge badge-success badge-shadow w-75">Belum</div>
                                                     <?php } ?>

                                                 </td>

                                                 <td>
                                                     <div class="dropdown">
                                                         <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                         <div class="dropdown-menu">
                                                             <a onclick="modal_EditDa()" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                             <a href="" class="dropdown-item has-icon"><i class="far fa-trash-alt"></i> Delete</a>
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
             function modalguru() {

                 $('#add_regisguru').appendTo("body").modal('show');

             }
         </script>
         <div class="modal fade" id="add_regisguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Data Register</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?php echo base_url('SuperAdmin/Registrasi/tambah_regist_guru') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <input id="jeneng" placeholder="Nama" type="text" name="nama" class="form-control" required="">
                             </div>
                             <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                             <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                             <div class="form-group">
                                 <input id="no_wa" placeholder="No Whatssapp" type="text" name="no_wa" class="form-control" required="">
                             </div>
                             <div class="form-group">
                                 <input id="email" placeholder="Email" type="text" name="email" class="form-control" required="">
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