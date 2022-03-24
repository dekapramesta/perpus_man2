<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col text-center">
                <h2 style="color: black">Login</h2>
            </div>
            <?php echo $this->session->flashdata('pesan') ?>
            <div class="row justify-content-center">
                <form action="<?php echo base_url('Login/login_user') ?>" method="post" enctype="multipart/form-data">
                    <div class="card col-5 py-2 mx-auto ">
                        <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="text" name="username" class="form-control" placeholder="username" required />
                        <input type="text" name="password" class="form-control mt-2" placeholder="Password" required />
                        <div class="row justify-content-center">
                            <div class=" col-xl-6 col-lg-6 col-12">
                                <button type="submit" class="btn btn-outline-light mt-3 w-100" style="background-color: #3ac162;">Masuk</button>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <button type="button " class="btn btn-secondary mt-3 w-100">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>