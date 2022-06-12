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
                                        <h4>Data Guru</h4>
                                    </div>
                                    <div class="col text-right">
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
                                            <th>Email</th>
                                            <th>Status User</th>
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
                                                <td><?= $gr['email'] ?></td>
                                                <td class="text-center">
                                                    <?php if ($gr['status_block'] == 0) { ?>
                                                        <div class="badge badge-success badge-shadow w-75">Aktif</div>
                                                    <?php } else { ?>
                                                        <div class="badge badge-danger badge-shadow">Non-Aktif</div>
                                                    <?php } ?>

                                                </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a onclick="edit_dtg(<?= $gr['id_guru'] ?>)" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
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
            function edit_dtg(id) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                $('#edit_datasiswa').appendTo("body").modal('show');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('SuperAdmin/DataUser/getGuru/') ?>" + id,
                    data: {
                        [csrfName]: csrfHash,
                    },
                    dataType: "JSON",
                    success: function(resultData) {
                        console.log(resultData)
                        $('.txt_csrfname').val(resultData.token);
                        $('#edit_id_guru').val(resultData.profile.id_guru);
                        $('#edit_nama').val(resultData.profile.nama_guru);
                        $('#edit_nohp').val(resultData.profile.no_hp);
                        $('#edit_email').val(resultData.profile.email);

                    }

                });
            }

            function ganti_pass(id) {
                $('#id_gantipass').val(id)
                $('#ganti_pass').appendTo("body").modal('show');

            }


            function modal_block() {

                $('#angkatan_block').appendTo("body").modal('show');

            }
        </script>
        <div class="modal fade" id="angkatan_block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Non Aktif Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('SuperAdmin/DataUser/UbahStatus') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                <select class="form-control" name="angkatan">
                                    <?php foreach ($angkatan as $akt) : ?>
                                        <option disabled selected hidden>Pilih Angkatan</option>
                                        <option value="<?= $akt['angkatan'] ?>"><?= $akt['angkatan'] ?></option>

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
        <div class="modal fade" id="edit_datasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('SuperAdmin/DataUser/UpdateGuru') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Nama</label></strong>
                                <input id="edit_id_guru" type="text" name="id_guru" class="form-control " required="">
                                <input id="edit_nama" type="text" name="nama_guru" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <strong><label>No HP</label></strong>
                                <input id="edit_nohp" type="text" name="no_hp" class="form-control" required="">
                            </div>
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                            <!-- <div class="form-group">
                                 <input placeholder="Code" type="text" name="code" class="form-control" required="">
                             </div> -->

                            <div class="form-group">
                                <strong><label>Email</label></strong>
                                <input id="edit_email" type="text" name="email" class="form-control" required="">
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
                        <h5 class="modal-title" id="exampleModalLabel">Non Aktif Siswa</h5>
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
        <script>
            document.getElementById("ubah_pass").addEventListener('submit', function(e) {
                e.preventDefault();
                let pass = $('#password_ubah').val()
                let conf = $('#conf_pass').val()
                if (pass == conf) {
                    document.getElementById("ubah_pass").submit();

                } else {
                    swal('Forbiden', 'Password Tidak Cocok', 'error');

                }
            })
        </script>