<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container text-start">
            <h2>Detail Buku</h2>
            <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col text-center">
                    <img src="<?php if ($buku->src_book == 0) {
                                    echo $buku->cover_buku;
                                } else {
                                    echo base_url('assets/img/CoverBuku/' . $buku->cover_buku);
                                } ?>" class="img-fluid" alt="">
                    <h3><?= $buku->judul_buku ?></h3>
                    <p class="text-start">
                        <?= $buku->sinopsis ?>
                    </p>
                </div>
                <!-- <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainer</h5>
                        <p><a href="#">Walter White</a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Course Fee</h5>
                        <p>$165</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Available Seats</h5>
                        <p>30</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Schedule</h5>
                        <p>5.00 pm - 7.00 pm</p>
                    </div>

                </div> -->
            </div>

        </div>
    </section>
    <!-- End Cource Details Section -->
    <section id="cource-details-tabs" class="cource-details-tabs">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Infromasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Ketersedian</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Pariatur explicabo vel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Nostrum qui quasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Iusto ut expedita aut</a>
                        </li> -->
                    </ul>
                </div>
                <div class="col-lg mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <div class="row">
                                <div class="col-lg details order-2 order-lg-1">
                                    <h3>Detail</h3>
                                    <table class="table table-borderless">

                                        <tbody>
                                            <tr>
                                                <th scope="row" width="150">Penulis</th>
                                                <td><?= $buku->penulis ?></td>
                                                <!-- <td>Otto</td>
                                                <td>@mdo</td> -->
                                            </tr>
                                            <tr>
                                                <th scope="row" width="150">Kategori</th>
                                                <td><?= $buku->kategori ?></td>
                                                <!-- <td>Thornton</td>
                                                <td>@fat</td> -->
                                            </tr>
                                            <tr>
                                                <th scope="row" width="150">ISBN</th>
                                                <td colspan="2"><?= $buku->kode_buku ?></td>
                                                <!-- <td>@twitter</td> -->
                                            </tr>
                                            <tr>
                                                <th scope="row" width="150">Tahun Terbit</th>
                                                <td colspan="2"><?= $buku->tahun_terbit ?></td>
                                                <!-- <td>@twitter</td> -->
                                            </tr>
                                            <tr>
                                                <th scope="row" width="150">Lokasi Buku</th>
                                                <td colspan="2"><?= $buku->lokasi_buku ?></td>
                                                <!-- <td>@twitter</td> -->
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p> -->
                                    <!-- <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p> -->
                                </div>
                                <!-- <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-1.png" alt="" class="img-fluid">
                                </div> -->
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Ketersedian</h3>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID Buku</th>
                                                <th scope="col">Ketersedian</th>
                                                <th scope="col">Booking</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($isbn as $kd) : ?>
                                                <tr>
                                                    <th scope="row"><?= $kd['id_buku'] ?></th>
                                                    <td><?php if ($kd['status_buku'] == 0) {
                                                            echo "Tersedia";
                                                        } else {
                                                            echo "Tidak";
                                                        }
                                                        ?></td>

                                                    <td><a onclick="Modaltes('<?= $kd['id_buku'] ?>')" class="btn btn-success w-100 <?php if ($kd['status_buku'] == 0) {
                                                                                                                                    } else {
                                                                                                                                        echo "disabled";
                                                                                                                                    }
                                                                                                                                    ?>">Booking Buku</a></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <!-- <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p> -->
                                    <!-- <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p> -->
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-2.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-3.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                                    <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-4.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-5">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                                    <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/course-details-tab-5.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ======= Cource Details Tabs Section ======= -->
    <!-- End Cource Details Tabs Section -->

</main>

<script>
    let sess = <?= json_encode($this->session->userdata('id_user')); ?>;
    let role = <?= json_encode($this->session->userdata('role_id')); ?>;

    function Modaltes(id) {
        if (!sess) {
            swal('Gagal', 'Login Terlebih Dahulu', 'error')
        } else if (parseInt(role) == 70 || parseInt(role) == 77) {
            swal('Gagal', 'Level User Tidak Diiizinkan', 'error')

        } else {
            $('#idbooking').val(id);
            $('#ModalPinjam').appendTo("body").modal('show');

        }


    }
</script>
<div class="modal fade" id="ModalPinjam" tabindex="-1" aria-labelledby="exampleModalPromoLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered no-transform">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPromoLabel4">Booking Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Buku/BookingBuku') ?>" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <p>Apa kau Yakin Ingin Meminjam Buku?</p>
                    <input hidden name="id_buku" id="idbooking" type="text" value="">
                    <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                </div>
                <div class="modal-footer align-item-center">
                    <div class="col">
                        <div class="row justify-content-center">
                            <div class="col"> <button type="button" class="btn btn-secondary w-100 " data-bs-dismiss="modal">Tidak</button>
                            </div>
                            <div class="col d-flex flex-row-reverse"> <button type="submit" class="btn btn-primary w-100">Iya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>