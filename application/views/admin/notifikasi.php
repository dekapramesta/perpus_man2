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
                                        <h4>Notifikasi Buku</h4>
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
                                            <th>Nama Peminjam</th>
                                            <th>Id Buku</th>
                                            <th>No HP</th>
                                            <th>Status Buku</th>
                                            <th>Status Notifikasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($data as $dt) : $no++ ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                </td>
                                                <td><?php if ($dt['id_siswa'] != null) {
                                                        echo $dt['nama'];
                                                    } elseif ($dt['id_guru'] != null) {
                                                        echo $dt['nama_guru'];
                                                    } ?></td>
                                                <td><?= $dt['id_buku'] ?></td>
                                                <td><?= $dt['no_wa'] ?></td>
                                                <td class="<?php if ($dt['status_pengembalian'] == 0) echo "text-danger"; ?>"><?php if ($dt['status_pengembalian'] == 0) {
                                                                                                                                    echo "Belum Dikembalikan";
                                                                                                                                } elseif ($dt['status_pengembalian'] == 1) {
                                                                                                                                    echo "Sudah Dikembalikan";
                                                                                                                                } ?></td>
                                                <td class="text-center">
                                                    <?php if ($dt['status_kirim'] == 0) : ?>
                                                        <div class="badge badge-danger badge-shadow">Belum Terkirim</div>
                                                    <?php else : ?>
                                                        <div class="badge badge-success badge-shadow">Terkirim</div>
                                                    <?php endif; ?>


                                                </td>

                                                <td>
                                                    <button onclick="KirimNotif(<?= $dt['id_notice'] ?>)" class="btn btn-primary">Kirim Notifikasi</button>
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
        <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

        <script>
            function KirimNotif(id) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                swal({
                        title: 'Kirim Notifikasi',
                        text: 'Mengirim Ulang Notifikasi?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Admin/Notifikasi/KirimNotif') ?>",
                                data: {
                                    [csrfName]: csrfHash,
                                    'id': id,
                                },
                                dataType: "JSON",
                                success: function(resultData) {
                                    $('.txt_csrfname').val(resultData.token);
                                    console.log(resultData);
                                    $(document).ajaxStop(function() {
                                        if (resultData.status == 0) {
                                            swal('Gagal', resultData.message, 'error');

                                        } else {
                                            swal('Success', resultData.message, 'success').then((ok) => {
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