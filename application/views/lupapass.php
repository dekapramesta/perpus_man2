<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col text-center">
                <h2 style="color: black">Lupa Password</h2>
            </div>
            <div class="row justify-content-center">
                <form action="<?php echo base_url('Login/PassChange') ?>" id="lupapass" method="post" enctype="multipart/form-data">
                    <div class="col text-center">
                        <div class="card col-5  mx-auto ">
                            <div class="card-body">
                                <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type="password" name="password" class="form-control" placeholder="Password" required />
                                <input type="text" hidden name="hash" value="<?= $this->uri->segment(3) ?>" class="form-control" placeholder="Password" required />

                                <input type="password" name="conf_password" class="form-control mt-2" placeholder="Confirmasi Password" required />
                                <div class="col-12 ">
                                    <button type="submit" class="btn btn-outline-light mt-3 w-100" style="background-color: #3ac162;">Masuk</button>
                                </div>


                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById("lupapass").addEventListener('submit', function(e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('.txt_csrfname').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Login/PassChange') ?>",
            data: $('#lupapass').serialize(),
            dataType: "JSON",
            success: function(result) {
                //  console.log(result)
                $('.txt_csrfname').val(result.token);
                $(document).ajaxStop(function() {
                    if (result.status == 0) {

                        Swal.fire('Gagal', result.pesan, 'error');

                    } else {
                        Swal.fire('Success', "Berhasil Dirubah", 'success').then((ok) => {
                            window.location.href = "<?= base_url('Login') ?>";

                        });

                    }
                });


            }

        });

    });
</script>