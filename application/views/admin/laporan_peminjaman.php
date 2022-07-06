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
<?php foreach ($peminjaman as $pnj) : ?>

    <body>
        <div style="text-align:center">
            <h3><?= $title_pdf ?></h3>
        </div>
        <table id="table">
            <thead>
                <tr>

                    <th>Nama Peminjam</th>
                    <th>Status</th>
                    <th>Angkatan</th>
                    <th>Judul Buku</th>
                    <th>ID Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Peminjaman Oleh</th>
                    <th>Pengembalian Oleh</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pnj as $pjm) : $no++; ?>
                    <tr>

                        <td><?php if ($pjm['id_siswa'] != null) {
                                echo $pjm['nama'];
                            } else {
                                echo $pjm['nama_guru'];
                            } ?></td>
                        <td><?php if ($pjm['role_id'] == 1) {
                                echo "Siswa";
                            } elseif ($pjm['role_id'] == 2) {
                                echo "Guru";
                            } ?></td>
                        <td><?= $pjm['angkatan'] ?></td>
                        <td><?= $pjm['judul_buku'] ?></td>
                        <td><?= $pjm['id_buku'] ?></td>
                        <td><?= $pjm['tanggal_pinjam'] ?></td>
                        <td><?= $pjm['tgl_pengembalian'] ?></td>
                        <td><?php foreach ($admin as $adm) : ?>
                                <?php if ($pjm['peminjaman_by'] == $adm['id_admin']) : ?>
                                    <?= $adm['nama_admin'] ?>
                                <?php endif; ?>
                            <?php endforeach; ?></td>
                        <td><?php foreach ($admin as $adm) : ?>
                                <?php if ($pjm['pengembalian_by'] == $adm['id_admin']) : ?>
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