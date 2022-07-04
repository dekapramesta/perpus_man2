<?php if ($this->session->flashdata('kategori')) {
    echo $this->session->flashdata('kategori');
    $this->session->set_flashdata(
        'kategori',
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
                                        <h4>Kategori</h4>
                                    </div>
                                    <div class="col text-right">
                                        <button onclick="TambahKtg()" type="button" class="btn btn-primary">Tambah Kategori</button>
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
                                            <th>Nama Kategori</th>

                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($kategori as $ktg) : $no++ ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $ktg['nama_kategori'] ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a onclick="editKtg(<?= $ktg['id_kategori'] ?>)" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                            <a onclick="deleteKTG('<?= $ktg['id_kategori'] ?>')" class="dropdown-item has-icon"><i class="fas fa-trash"></i> Delete Kategori</a>

                                                        </div>
                                                    </div>
                                                </td>





                                            </tr>
                                        <?php endforeach; ?>

                                        <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function TambahKtg() {
                $('#tambah_ktg').appendTo("body").modal('show');

            }

            function deleteKTG(id) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                swal({
                        title: 'Delete Kategori',
                        text: 'Yakin ingin Menghapus Kategori?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Admin/Perpustakaan/deleteKategori') ?>",
                                data: {
                                    [csrfName]: csrfHash,
                                    'id_kategori': id,
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

            function editKtg(id) {
                $('#edit_ktg').appendTo("body").modal('show');


                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                $('#edit_dataadmin').appendTo("body").modal('show');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Admin/Perpustakaan/getKategori/') ?>" + id,
                    data: {
                        [csrfName]: csrfHash,
                    },
                    dataType: "JSON",
                    success: function(resultData) {
                        console.log(resultData)
                        $('.txt_csrfname').val(resultData.token);
                        $('#id').val(resultData.kategori.id_kategori);
                        $('#nama_kategori').val(resultData.kategori.nama_kategori);





                    }

                });

            }
        </script>

        <div class="modal fade" id="edit_ktg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pdf</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('Admin/Perpustakaan/UpdateKategori') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Nama Kategori</label></strong>
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input hidden id="id" type="text" name="id_kategori" class="form-control" required="">
                                <input id="nama_kategori" type="text" name="nama_kategori" class="form-control" required="">
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
        <div class="modal fade" id="tambah_ktg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('Admin/Perpustakaan/TambahKategori') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Nama Kategori</label></strong>
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <!-- <input hidden id="id" type="text" name="id_kategori" class="form-control" required=""> -->
                                <input type="text" name="nama_kategori" class="form-control" required="">
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