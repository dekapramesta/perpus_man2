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
                                        <button class="btn btn-primary" onclick="tambah_brg()">Tambah Data</button>
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
                                            <th>Barang</th>
                                            <th>Jenis Item</th>
                                            <th>Coin</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($barang as $hdh) : $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $hdh['nama_item'] ?></td>
                                                <td><?= $hdh['jenis_item'] ?></td>
                                                <td><?= $hdh['coin_hadiah'] ?></td>
                                                <td><?= $hdh['jumlah'] ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a onclick="edit_brg('<?= $hdh['id_hadiah'] ?>')" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item has-icon"><i class="fas fa-trash"></i>Delete</a>

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
            function edit_brg(data) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('SuperAdmin/Event/getBarang/') ?>" + data,
                    data: {
                        [csrfName]: csrfHash,
                    },
                    dataType: "JSON",
                    success: function(resultData) {
                        console.log(resultData)
                        $('.txt_csrfname').val(resultData.token);
                        $('#id_hadiah').val(resultData.hadiah.id_hadiah)
                        $('#barang_edt').val(resultData.hadiah.nama_item)
                        $('#jenis_edt').val(resultData.hadiah.jenis_item)
                        $('#coin_edt').val(resultData.hadiah.coin_hadiah)
                        $('#jumlah_edt').val(resultData.hadiah.jumlah)


                    }

                });
                $('#modal_barang').appendTo("body").modal('show');

            }

            function tambah_brg() {
                $('#tambah_barang').appendTo("body").modal('show');

            }
        </script>
        <div class="modal fade" id="modal_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ubah_pass" action="<?php echo base_url('SuperAdmin/Event/UbahBarang') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Barang</label></strong>
                                <input id="barang_edt" type="text" name="nama_item" class="form-control" required="">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input hidden type="text" id="id_hadiah" name="id_hadiah">


                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Jenis Item</label></strong>
                                <input type="text" id="jenis_edt" name="jenis_item" class="form-control" required="">
                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Coin Hadiah</label></strong>
                                <input type="text" id="coin_edt" name="coin_hadiah" class="form-control" required="">
                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Jumlah</label></strong>
                                <input type="number" id="jumlah_edt" name="jumlah" class="form-control" required="">
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
        <div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ubah_pass" action="<?php echo base_url('SuperAdmin/Event/TambahBarang') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <strong><label>Barang</label></strong>
                                <input type="text" name="nama_item" class="form-control" required="">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Jenis Item</label></strong>
                                <input type="text" name="jenis_item" class="form-control" required="">
                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Coin Hadiah</label></strong>
                                <input type="text" name="coin_hadiah" class="form-control" required="">
                                <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                            </div>
                            <div class="form-group">
                                <strong><label>Jumlah</label></strong>
                                <input type="number" name="jumlah" class="form-control" required="">
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