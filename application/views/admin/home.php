<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row justify-content-center">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Home</h4>
                        </div>
                        <div class="card-body text-center" id="card_kembali">
                            <h3> <?php if ($this->session->userdata('role_id') == 77) : ?>
                                    Selamat Datang Admin
                                <?php elseif ($this->session->userdata('role_id') == 70) : ?>
                                    Selamat Datang Super Admin
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>