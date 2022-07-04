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
                                        <h4>Data Peminjaman</h4>
                                    </div>
                                    <div class="col text-right">
                                        <a href="<?= base_url('Admin/Perpustakaan/Peminjaman') ?>" class="btn btn-primary">Pinjam Buku</a>

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
                                            <th>Nama Peminjam</th>
                                            <th>Status Peminjam</th>
                                            <th>Angkatan</th>
                                            <th>Judul Buku</th>
                                            <th>ID Buku</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pemngembalian Seharusnya</th>
                                            <th>Status Pengembalian</th>
                                            <th>Dikerjakan Oleh</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($laporan as $lpr) : $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?php if ($lpr['id_siswa'] != null) {
                                                        echo $lpr['nama'];
                                                    } elseif ($lpr['id_guru'] != null) {
                                                        echo $lpr['nama_guru'];
                                                    } ?></td>
                                                <td><?php if ($lpr['role_id'] == 1) {
                                                        echo "Siswa";
                                                    } elseif ($lpr['role_id'] == 2) {
                                                        echo "Guru";
                                                    } ?></td>
                                                <td><?= $lpr['angkatan'] ?></td>
                                                <td><?= $lpr['judul_buku'] ?></td>
                                                <td><?= $lpr['id_buku'] ?></td>
                                                <td><?= $lpr['tanggal_pinjam'] ?></td>
                                                <td><?= $lpr['tanggal_pengembalian'] ?></td>
                                                <td><?php if ($lpr['status_pengembalian'] == 1) {
                                                        echo "Sudah Dikembalikan";
                                                    } elseif ($lpr['status_pengembalian'] == 0) {
                                                        echo "Belum Dikembalikan";
                                                    } ?></td>
                                                <td><?= $lpr['nama_admin'] ?></td>






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