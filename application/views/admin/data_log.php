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
                                        <h4>Log Masuk Perpustakaan</h4>
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
                                            <th>
                                                #
                                            </th>
                                            <th>Nama Siswa</th>
                                            <th>NISN</th>
                                            <th>Tanggal dan Jam Masuk</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($log_perpus as $log) : $no++ ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $log['nama'] ?></td>
                                                <td><?= $log['nisn'] ?></td>
                                                <td><?= $log['jam'] ?></td>





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