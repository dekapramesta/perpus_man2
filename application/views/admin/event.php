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
                                        <h4>Event</h4>
                                    </div>
                                    <div class="col text-right">
                                        <?php if ($status->status_fitur == 0) :  ?>
                                            <a href="<?= base_url('SuperAdmin/Event/ChangeStatus') ?>" type="button" class="btn btn-primary" href="">Aktifkan</a>
                                        <?php elseif ($status->status_fitur == 1) : ?>
                                            <a href="<?= base_url('SuperAdmin/Event/ChangeStatus') ?>" type="button" class="btn btn-danger" href=""> Non-Aktifkan</a>
                                        <?php endif; ?>

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
                                            <th>Nama Siswa</th>
                                            <th>Coin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($siswa as $sw) : $no++; ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $no; ?>
                                                </td>
                                                <td> <?= $sw['nama']; ?></td>
                                                <td> <?= $sw['coin']; ?></td>

                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>