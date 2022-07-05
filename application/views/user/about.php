<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container text-start">
            <h2>Profil Perpustakaan</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div data-aos="fade-up">
            <iframe style="border:0; width: 100%; height: 350px;" src="<?= $perpus->kordinat_gmaps ?>" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="container" data-aos="fade-up">

            <div class="row mt-5 ms-2 me-2">
                <div class="card" style="border-radius: 20px;">
                    <div class="col-lg-12 text-center mt-2">
                        <h3>Profile Perpustakaan</h3>
                    </div>
                    <div class="col-lg-12 mt-2 mb-2">
                        <?= $perpus->profile ?>
                    </div>
                </div>


            </div>

        </div>
    </section><!-- End Contact Section -->

</main>