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


<body>
    <div style="text-align:center">
        <h3><?= $title_pdf ?></h3>
    </div>
    <table id="table">
        <thead>
            <tr>

                <th>Judul Buku</th>
                <th style="text-align: center;">Barcode Buku</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($buku as $bk) : ?>
                <?php foreach ($bk as $bl) : ?>
                    <?php

                    //Use this code to convert your image to base64
                    // Apply this in a view 

                    // $path = base_url('Admin/InventoryBuku/BarcodeCetak/' . $bk['id_buku']); // Modify this part (your_img.png
                    // $base64 = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
                    // $gambar = file_get_contents('https://awsimages.detik.net.id/community/media/visual/2020/07/13/manga-naruto-1_43.webp?w=700&q=90');
                    $url = base_url('assets/img/Barcode/' . $bl['barcode_pic']);
                    $image = file_get_contents($url);
                    $gambar = 'data:image/jpg;base64,' . base64_encode($image);
                    ?>
                    <tr>

                        <td><?= $bl['judul_buku'] ?></td>
                        <td>
                            <div class="col">
                                <div class="col" style="text-align: center; margin-bottom: 10px;">
                                    Perpus Man 2 Ngawi
                                </div>
                                <div class="col" style="text-align: center; ">
                                    <img src="<?= $gambar ?>" style="width:50%;">
                                </div>

                            </div>
                        </td>


                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

        </tbody>
    </table>
</body>



</html>