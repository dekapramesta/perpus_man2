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
                                        <h4>Booking Buku</h4>
                                    </div>
                                    <div class="col text-right">
                                        <button onclick="AmbilBuku()" type="button" class="btn btn-primary" href="">Ambil Buku</button>


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
                                            <th>Peminjam</th>
                                            <th>Judul Buku</th>
                                            <th>Id Buku</th>
                                            <th>Tanggal Booking</th>
                                            <th>Status Booking</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($booking as $bk) : $no++; ?>

                                            <tr>
                                                <td <?php if ($bk['status_pesan'] == 1) {
                                                        echo "style = 'color : green;'";
                                                    } elseif ($bk['status_pesan'] == 6) {
                                                        echo "style = 'color : red;'";
                                                    } ?>><?= $no; ?></td>
                                                <td <?php if ($bk['status_pesan'] == 1) {
                                                        echo "style = 'color : green;'";
                                                    } elseif ($bk['status_pesan'] == 6) {
                                                        echo "style = 'color : red;'";
                                                    } ?>><?php if ($bk['nama'] != null) {
                                                                echo $bk['nama'];
                                                            } else {
                                                                echo $bk['nama_guru'];
                                                            }  ?></td>
                                                <td <?php if ($bk['status_pesan'] == 1) {
                                                        echo "style = 'color : green;'";
                                                    } elseif ($bk['status_pesan'] == 6) {
                                                        echo "style = 'color : red;'";
                                                    } ?>><?= $bk['judul_buku'] ?></td>
                                                <td <?php if ($bk['status_pesan'] == 1) {
                                                        echo "style = 'color : green;'";
                                                    } elseif ($bk['status_pesan'] == 6) {
                                                        echo "style = 'color : red;'";
                                                    } ?>><?= $bk['id_buku'] ?></td>
                                                <td <?php if ($bk['status_pesan'] == 1) {
                                                        echo "style = 'color : green;'";
                                                    } elseif ($bk['status_pesan'] == 6) {
                                                        echo "style = 'color : red;'";
                                                    } ?>><?= date('Y-m-d', strtotime($bk['tgl_pemesanan']))  ?></td>
                                                <td class="text-center" <?php if ($bk['status_pesan'] != 0) {
                                                                            echo "style = 'color : red;'";
                                                                        } ?>> <?php if ($bk['status_pesan'] == 0) {
                                                                                    echo '<span class="badge badge-primary">Berlaku</span>';
                                                                                } elseif ($bk['status_pesan'] == 1) {
                                                                                    echo '<span class="badge badge-success">Sudah Dimbil</span>';
                                                                                } elseif ($bk['status_pesan'] == 6) {
                                                                                    echo '<span class="badge badge-danger">Invalid</span>';
                                                                                } ?></td>

                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle w-75">Options</a>
                                                        <div class="dropdown-menu">
                                                            <a onclick="" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                            <a href="#" onclick="deleteBooking('<?= $bk['id_booking'] ?>')" class="dropdown-item has-icon"><i class="far fa-trash-alt"></i> Delete</a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            // $(window).on('load', function() {
            //     $('#ambil_buku').appendTo("body").modal('show');
            // });

            function AmbilBuku() {
                $('#ambil_buku').appendTo("body").modal('show');
            }
        </script>
        <div class="modal fade" id="ambil_buku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ambil Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="card_cari">
                        <div id="container_dup" class="form-group">
                            <div class="pretty p-switch">
                                <input id="togBtn" onchange="ByGuru(event)" type="checkbox" value="0" />
                                <div class="state p-primary">
                                    <label>Peminjam Guru</label>
                                </div>
                            </div>
                        </div>
                        <form id="form_booking" action="asas" method="post" enctype="multipart/form-data">
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <div class="form-group" id="id_place">

                                <input id="idsiswa" placeholder="Kode Buku" type="text" name="idsiswa" class="form-control " required="">
                            </div>

                            <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="import" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id="card_pilih" style="display: none;">
                        <form id="form_pilih" action="asas" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row justify-content-center mt-2" id="pilih_opsi">
                                </div>
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            </div>

                            <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="import" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-body" id="card_detail" style="display: none;">
                        <form id="form_pilih" action="<?= base_url('Admin/InventoryBuku/PinjamBuku') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Bar</label>
                                <input readonly id="kode_buku" placeholder="Kode Buku" type="text" name="barcode_buku" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <label for="">Judul Buku</label>
                                <input readonly id="judul_buku" placeholder="Judul Buku" type="text" name="judul_buku" class="form-control " required="">
                            </div>
                            <div class="form-group">
                                <label for="">Id Siswa / Barcode</label>
                                <input readonly id="barcode_siswa" placeholder="Nisn" type="text" name="barcode_siswa" class="form-control " required="">
                                <input hidden type="text" value="1" name="booking" class="form-control " required="">
                                <input hidden id="id_booking" type="text" name="id_booking" class="form-control ">
                            </div>
                            <div class="form-group">
                                <label for="">Lama Pinjam</label>
                                <select name="lama_pinjam" class="form-control" id="">
                                    <option value="3">3 hari</option>
                                    <option value="5">5 Hari</option>
                                    <option value="7">7 hari</option>
                                </select>
                            </div>

                            <!-- <div class="form-group">
                                 <input id="judulbuku" placeholder="Judul Buku" type="text" name="judul_buku    " class="form-control" required="">
                             </div> -->
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">


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
            let data_pick = [];
            let sts_val = 0;

            function ByGuru(event) {

                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                if (event.target.value == 0) {
                    event.target.value = 1
                    sts_val = 1;
                    $('#id_place').html(' <label>Nama Guru</label><select class = "form-control select2" id="idguru" name="idguru"></select>')
                    $(".select2").select2({
                        dropdownParent: $('#ambil_buku')

                    });

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Admin/InventoryBuku/getGuru/') ?>",
                        data: {
                            [csrfName]: csrfHash,
                        },
                        dataType: "JSON",
                        success: function(resultData) {
                            console.log(resultData)
                            $('.txt_csrfname').val(resultData.token);
                            $.each(resultData.guru, function(i, guru) {
                                $('#idguru').append('<option value="' + guru.id_user + '">' + guru.nama_guru + '</option>')
                            });





                        }

                    });
                    // $('#id_place').html('<input id="idguru" placeholder="Kode Buku" type="text" name="idsiswa" class="form-control " required="">')

                } else {
                    sts_val = 0;
                    event.target.value = 0
                    $('#id_place').html('<input id="idsiswa" placeholder="Kode Buku" type="text" name="idsiswa" class="form-control " required="">')

                }
            }
            document.getElementById("form_booking").addEventListener('submit', function(e) {
                e.preventDefault();
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                if (sts_val == 1) {
                    let idguru = document.getElementById('idguru').value;
                    console.log(idguru)
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Admin/Booking/getBooking') ?>",
                        data: {
                            [csrfName]: csrfHash,
                            'idguru': idguru

                        },
                        dataType: "JSON",
                        success: function(result) {
                            $('.txt_csrfname').val(result.token);
                            if (!result.buku) {
                                swal('Tidak Ditemukan', 'Guru Tersebut Belum Melakukan Pemesanan', 'error');

                            } else {
                                $.each(result.buku, function(i, buku) {
                                    data_pick = result.buku;
                                    document.getElementById('card_cari').style.display = "None";
                                    document.getElementById('card_pilih').style.display = "Block";
                                    $('#pilih_opsi').append('<div class="col-12 col-md-6 col-lg-6"><a href="#" onclick="cekData(' + i + ')"><div class="card card-primary"><div class="card-header"><h4>' + buku.Judul + '</h4></div><div class = "card-body" ><p>Nama : ' + buku.Nama + '</p><p>Kode Buku: ' + buku.Kode_Buku + '</p></div></div></a></div>')
                                });
                            }
                            console.log(result.buku)




                        }

                    });

                } else if (sts_val == 0) {
                    let idsiswa = document.getElementById('idsiswa').value;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Admin/Booking/getBooking') ?>",
                        data: {
                            [csrfName]: csrfHash,
                            'idsiswa': idsiswa

                        },
                        dataType: "JSON",
                        success: function(result) {
                            $('.txt_csrfname').val(result.token);
                            if (!result.buku) {
                                swal('Tidak Ditemukan', 'Siswa Tersebut Belum Meakukan Pemesanan', 'error');

                            } else {
                                $.each(result.buku, function(i, buku) {
                                    data_pick = result.buku;
                                    document.getElementById('card_cari').style.display = "None";
                                    document.getElementById('card_pilih').style.display = "Block";
                                    $('#pilih_opsi').append('<div class="col-12 col-md-6 col-lg-6"><a href="#" onclick="cekData(' + i + ')"><div class="card card-primary"><div class="card-header"><h4>' + buku.Judul + '</h4></div><div class = "card-body" ><p>Nama : ' + buku.Nama + '</p><p>Kode Buku: ' + buku.Kode_Buku + '</p></div></div></a></div>')
                                });
                            }
                            console.log(result.buku)




                        }

                    });

                }
                // let idsiswa = document.getElementById('idsiswa').value;


                // alert(sts_val, sts_val);
                // return false;



                // $.ajax({
                //     type: "POST",
                //     url: "<?php echo site_url('Admin/Booking/getBooking') ?>",
                //     data: {
                //         [csrfName]: csrfHash,
                //         'idsiswa': idsiswa

                //     },
                //     dataType: "JSON",
                //     success: function(result) {
                //         $('.txt_csrfname').val(result.token);
                //         if (!result.buku) {
                //             swal('Tidak Ditemukan', 'Siswa Tersebut Belum Meakukan Pemesanan', 'error');

                //         } else {
                //             $.each(result.buku, function(i, buku) {
                //                 data_pick = result.buku;
                //                 document.getElementById('card_cari').style.display = "None";
                //                 document.getElementById('card_pilih').style.display = "Block";
                //                 $('#pilih_opsi').append('<div class="col-12 col-md-6 col-lg-6"><a href="#" onclick="cekData(' + i + ')"><div class="card card-primary"><div class="card-header"><h4>' + buku.Judul + '</h4></div><div class = "card-body" ><p>Nama : ' + buku.Nama + '</p><p>Kode Buku: ' + buku.Kode_Buku + '</p></div></div></a></div>')
                //             });
                //         }
                //         console.log(result.buku)




                //     }

                // });
            });

            function cekData(i) {
                console.log(data_pick[i])
                document.getElementById('card_pilih').style.display = "None";
                document.getElementById('card_detail').style.display = "Block";
                document.getElementById('kode_buku').value = data_pick[i].Kode_Buku;
                document.getElementById('judul_buku').value = data_pick[i].Judul;
                document.getElementById('barcode_siswa').value = data_pick[i].nisn;
                document.getElementById('id_booking').value = data_pick[i].Id_booking;


            }

            function deleteBooking(id) {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                swal({
                        title: 'Delete Booking',
                        text: 'Yakin ingin Mengdelete Booking?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('Admin/Booking/deleteBooking') ?>",
                                data: {
                                    [csrfName]: csrfHash,
                                    'id_booking': id,
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