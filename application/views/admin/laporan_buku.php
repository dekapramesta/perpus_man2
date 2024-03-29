<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<?php foreach ($buku as $pnj) : ?>

    <body>
        <!-- <div style="text-align:center">
            <h3><?= $title_pdf ?></h3>
        </div> -->
        <?php
        $path = base_url('/assets/img/man2ngawi.jpeg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <!-- <img src="<?php echo base_url() ?>/assets/img/man2ngawi.jpeg" alt="" style="width:9%; position: absolute; margin-left: 10px;"> -->
        <img src="<?= $base64 ?>" alt="" style="width:9%; position: absolute; margin-left: 10px;">
        <!-- <img src="<?php echo base_url() ?>/assets/img/man2ngawi.jpeg" alt="" style="width:2.5cm; position: absolute;"> -->
        <div style="text-align: center;">
            <div style="margin-bottom: 3px;">
                <span style="font-size: 16pt;">
                    KEMENTRIAN AGAMA
                </span>
            </div>
            <div style="margin-bottom: 3px;">
                <span style="font-size: 16pt;">
                    <b>MADRASAH ALIYAH NEGERI 2 NGAWI</b>
                </span>
            </div>
            <div style="margin-bottom: 3px;">
                <small>Jl. Raya Paron No.2, Kenaiban, Paron, Kec. Paron, Kabupaten Ngawi</small>
            </div>
            <div style="margin-bottom: 3px;">
                <small>Kode Pos: 63253 Telepon (0351) 749772</small>
            </div>
            <div style="height: 4px; background-color: #000000; margin-bottom: 2px; margin-top: 8px;"></div>
            <div style="height: 1.5px; background-color: #000000; margin-bottom: 15px;"></div>
            <div style="margin-bottom: 20px;">
                <span style="font-size: 18px;">
                    <b>LAPORAN BUKU MASUK</b>
                </span>
            </div>
        </div>
        <table id="table">
            <thead>
                <tr>

                    <th>Judul Buku</th>
                    <th>Kode ISBN</th>
                    <th>Penulis</th>
                    <th>Tahun Terbot</th>
                    <th>Tanggal Masuk</th>
                    <th>Dikerjakan Oleh</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pnj as $pjm) : $no++; ?>
                    <tr>

                        <td><?= $pjm['judul_buku'] ?></td>
                        <td><?= $pjm['kode_buku'] ?></td>
                        <td><?= $pjm['penulis'] ?></td>
                        <td><?= $pjm['tahun_terbit'] ?></td>
                        <td><?= $pjm['tanggal_masuk'] ?></td>
                        <td><?php foreach ($admin as $adm) : ?>
                                <?php if ($pjm['insert_by'] == $adm['id_admin']) : ?>
                                    <?= $adm['nama_admin'] ?>
                                <?php endif; ?>
                            <?php endforeach; ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
<?php endforeach; ?>


</html>