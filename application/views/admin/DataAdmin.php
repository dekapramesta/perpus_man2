<?php if ($this->session->flashdata('adminDU')) {
    echo $this->session->flashdata('adminDU');
    $this->session->set_flashdata(
        'adminDU',
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
                                        <h4>Data Admin</h4>
                                    </div>
                                    <div class="col text-right">
                                        <button onclick="ModalAdmin()" class="btn btn-primary ">Tambah Admin</button>
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
                                            <th>Username</th>
                                            <th>Nama Admin</th>
                                            <th>Status User</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($admin as $gr) : $no++; ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                </td>
                                                <td><?= $gr['username'] ?></td>
                                                <td><?= $gr['nama_admin'] ?></td>
                                                <td class="text-center">
                                                    <?php if ($gr['status_block'] == 0) { ?>
                                                        <div class="badge badge-success badge-shadow w-75">Aktif</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Non-Aktif</div>
                                                    <?php } ?>

                                                </td>

                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a onclick="edit_dta(<?= $gr['id_admin'] ?>)" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                            <a onclick="ganti_pass(<?= $gr['id_user'] ?>)" class="dropdown-item has-icon"><i class="fas fa-user-shield"></i> Ganti Password</a>
                                                            <?php if ($gr['status_block'] == 0) { ?>
                                                                <a class="dropdown-item has-icon" href="<?= base_url('SuperAdmin/DataUser/UbahStatusById/' . $gr['id_user']) ?>"><i class="fas fa-times"></i>Non Aktif User</a>
                                                            <?php } else { ?>
                                                                <a class="dropdown-item has-icon" href="<?= base_url('SuperAdmin/DataUser/UbahStatusById/' . $gr['id_user']) ?>"><i class="fas fa-check"></i>Aktifkan User</a>
                                                            <?php } ?>
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
            function ganti_pass(id) {
                $('#id_gantipass').val(id)
                $('#ganti_pass').appendTo("body").modal('show');

            }

            function ModalAdmin() {

                $('#add_admin').appendTo("body").modal('show');

            }

            function edit_dta(id) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                $('#edit_dataadmin').appendTo("body").modal('show');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('SuperAdmin/DataUser/getAdmin/') ?>" + id,
                    data: {
                        [csrfName]: csrfHash,
                    },
                    dataType: "JSON",
                    success: function(resultData) {
                        console.log(resultData)
                        $('.txt_csrfname').val(resultData.token);

                        $('#edit_id_admin').val(resultData.profile.id_admin);
                        $('#edit_nama').val(resultData.profile.nama_admin);
                        $('#edit_user').val(resultData.profile.username);

                    }

                });
            }
        </script>
        <div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('SuperAdmin/DataUser/TambahAdmin') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input id="jeneng" placeholder="Username" type="text" name="username" class="form-control" required="">
                            </div>
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->
                            <div class="form-group">
                                <input placeholder="Nama Admin" type="text" name="nama_admin" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <input placeholder="Password" type="password" name="password" class="form-control" required="">
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
        <div class="modal fade" id="ganti_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ubah_pass" action="<?php echo base_url('SuperAdmin/DataUser/UbahPassword') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Password</label></strong>
                                <input id="password_ubah" type="password" name="password" class="form-control" required="">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input hidden type="text" id="id_gantipass" name="id_user">


                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Confirmasi Password</label></strong>
                                <input type="password" id="conf_pass" name="conf_password" class="form-control" required="">
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
        <div class="modal fade" id="edit_dataadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('SuperAdmin/DataUser/UpdateAdmin') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Username</label></strong>
                                <input id="edit_user" type="text" name="username" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <strong><label>Nama</label></strong>
                                <input hidden id="edit_id_admin" type="text" name="id_admin" class="form-control " required="">
                                <input id="edit_nama" type="text" name="nama_admin" class="form-control " required="">
                            </div>
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->



                            <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>