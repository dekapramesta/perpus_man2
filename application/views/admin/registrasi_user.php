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
                                             <th>Barcode</th>
                                             <th>Status Registrasi</th>
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
                                                 <td><?= $sis['no_wa'] ?></td>
                                                 <td><?= $sis['barcode'] ?></td>
                                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                 <td class="text-center"><?php if ($sis['status_daftar'] == 1) { ?>
                                                         <div class="badge badge-success badge-shadow w-75">Sudah</div>
                                                     <?php } else { ?>
                                                         <div class="badge badge-danger badge-shadow w-75">Belum</div>
                                                     <?php } ?>
                                                 </td>

                                                 <td>
                                                     <div class="dropdown">
                                                         <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                         <div class="dropdown-menu">
                                                             <a onclick="modal_EditRegist(<?= $sis['id_register'] ?>)" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
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