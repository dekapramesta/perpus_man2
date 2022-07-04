<style>
    .swal-modal .swal-text {
        text-align: center;
    }
</style>
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col text-center">
                <h2 style="color: black">Register</h2>
            </div>
            <div class="row justify-content-center align-items-center">
                <form class="form-example" id="code_regis" action="<?php echo base_url('Register/checkingcode_guru') ?>" method="post">
                    <div class="col">
                        <div class="card mx-auto col-5" id="cardcode">

                            <div class="card-body">
                                <div class="form-group">
                                    <input id="code_reg" type="text" class="form-control" placeholder="Kode" required />
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-outline-light mt-3 w-100" style="background-color: #3ac162;">Masuk</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <form id="daftar_guru" action="<?php echo base_url('Register/daftar_guru') ?>" method="post" enctype="multipart/form-data">
                    <div class="card col-5 py-2 mx-auto " style="display: none;" id="cardregist">
                        <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input name="username" type="text" class="form-control mt-2" placeholder="Username" required />
                        <span class="text-danger"><?= form_error('username') ?></span>
                        <input name="password" type="password" class="form-control mt-2" placeholder="Password" required />
                        <span class="text-danger"><?= form_error('password') ?></span>
                        <input id="namalengkap" name="nama_lengkap" type="text" class="form-control mt-2" placeholder="Nama Lengkap" required />
                        <span class="text-danger"><?= form_error('nama_lengkap') ?></span>
                        <input name="email" id="email" type="text" class="form-control mt-2" placeholder="Email" required />
                        <span class="text-danger"><?= form_error('email') ?></span>
                        <input id="no_hp" name="no_hp" type="text" class="form-control mt-2" placeholder="No Hp" required />
                        <span class="text-danger"><?= form_error('no_hp') ?></span>
                        <textarea name="alamat" class="form-control summernote-simple mt-2">Alamat</textarea>
                        <input type="text" id="id_user" hidden name="id_user">

                        <span class="text-danger"><?= form_error('alamat') ?></span>

                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <button type="submit" class="btn btn-secondary mt-3 w-100">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    document.getElementById("code_regis").addEventListener('submit', function(e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('.txt_csrfname').val();
        let codehash = document.getElementById("code_reg").value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Register/checkingcode_guru/') ?>",
            data: {
                'hashcode': codehash,
                [csrfName]: csrfHash
            },
            dataType: "JSON",
            success: function(resultData) {
                console.log(resultData);
                $('.txt_csrfname').val(resultData.token);

                if (!resultData.profile) {
                    alert('Data Tidak Ditemukan');
                } else {

                    let x = document.getElementById("cardcode");
                    let cregis = document.getElementById("cardregist");
                    x.style.display = "none";
                    cregis.style.display = "block";
                    document.getElementById("namalengkap").value = resultData.profile.nama_guru;
                    document.getElementById("no_hp").value = resultData.profile.no_hp;
                    document.getElementById("email").value = resultData.profile.email;
                    $('#id_user').val(resultData.profile.id_user)


                }


            }

        });


    });
    document.getElementById("daftar_guru").addEventListener('submit', function(e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('.txt_csrfname').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Register/daftar_guru') ?>",
            data: $('#daftar_guru').serialize(),
            dataType: "JSON",
            success: function(result) {
                //  console.log(result)
                $('.txt_csrfname').val(result.token);
                $(document).ajaxStop(function() {
                    if (result.status == 0) {
                        swal('Gagal', result.message, 'error');

                    } else {
                        swal('Success', "Berhasil Daftar", 'success').then((ok) => {
                            window.location.reload();

                        });

                    }
                });


            }

        });

    });
</script>