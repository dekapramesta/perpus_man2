<style>
    .swal-modal .swal-text {
        text-align: center;
    }
</style>
<section class="my-5">
    <div class="container">
        <div class="col text-center">
            <h2 style="color: black">Register</h2>
        </div>
        <div align="center">
            <form class="form-example" id="code_regis" action="<?php echo base_url('Register/checkingcode') ?>" method="post">
                <div class="col col-md-8 col-lg-6">
                    <div class="card" id="cardcode">
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <input id="code_reg" type="text" class="form-control" placeholder="Kode" required />
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-6 px-2">
                                    <button type="submit" class="btn btn-outline-light mt-1 w-100" style="background-color: #3ac162;">Masuk</button>
                                </div>
                                <div class="col-6 px-2">
                                    <a href="<?= base_url('Register/RegisterGuru') ?>" class="btn btn-outline-light mt-1 w-100" style="background-color: #86B88A;">Daftar Guru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div align="center">
            <div class="col col-md-8 col-lg-6">
                <form id="daftar" action="<?php echo base_url('Register/daftar') ?>" method="post" enctype="multipart/form-data">
                    <div class="card" style="display: none;" id="cardregist">
                        <div class="card-body">
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input readonly id="nisn" name="nisn" type="text" class="form-control" placeholder="NISN" required />
                            <span class="text-danger"><?= form_error('nisn') ?></span>
                            <input name="username" type="text" class="form-control mt-2" placeholder="Username" required />
                            <span class="text-danger"><?= form_error('username') ?></span>
                            <input name="password" type="password" class="form-control mt-2" placeholder="Password" required />
                            <span class="text-danger"><?= form_error('password') ?></span>
                            <input id="namalengkap" name="nama_lengkap" type="text" class="form-control mt-2" placeholder="Nama Lengkap" required />
                            <span class="text-danger"><?= form_error('nama_lengkap') ?></span>
                            <input name="email" type="text" class="form-control mt-2" placeholder="Email" required />
                            <span class="text-danger"><?= form_error('email') ?></span>
                            <input id="no_hp" name="no_hp" type="text" class="form-control mt-2" placeholder="No Hp" required />
                            <span class="text-danger"><?= form_error('no_hp') ?></span>
                            <input readonly id="angkatan" name="angkatan" type="text" class="form-control mt-2" placeholder="Angkatan" required />
                            <span class="text-danger"><?= form_error('angkatan') ?></span>
                            <input type="text" id="id_user" hidden name="id_user">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-secondary mt-3 w-100">Daftar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
<?php if (form_error('nisn') || form_error('username') || form_error('password') || form_error('nama_lengkap') || form_error('email') || form_error('no_hp') || form_error('angkatan') || form_error('id_user') != null) {
    $status_page = 1;
    json_encode($status_page);
} else {
    $status_page = 0;
    json_encode($status_page);
} ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var page_error = parseInt(<?= $status_page ?>);
    var aku = document.getElementById("cardcode");
    var dee = document.getElementById("cardregist");

    console.log(page_error);
    if (page_error == 1) {
        aku.style.display = "none";
        dee.style.display = "block";
    }
    document.getElementById("code_regis").addEventListener('submit', function(e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('.txt_csrfname').val();
        var codehash = document.getElementById("code_reg").value;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Register/checkingcode/') ?>",
            data: {
                'hashcode': codehash,
                [csrfName]: csrfHash
            },
            dataType: "JSON",
            success: function(resultData) {
                console.log(resultData);
                $('.txt_csrfname').val(resultData.token);
                // $.each(resultData, function(i, data) {

                // });

                if (!resultData.profile) {
                    swal('Kosong', "Data Tidak Ditemukan", 'error');

                } else {
                    console.log(resultData);

                    var x = document.getElementById("cardcode");
                    var cregis = document.getElementById("cardregist");
                    x.style.display = "none";
                    cregis.style.display = "block";
                    document.getElementById("nisn").value = resultData.profile.nisn;
                    document.getElementById("namalengkap").value = resultData.profile.nama;
                    document.getElementById("no_hp").value = resultData.profile.no_hp;
                    document.getElementById("angkatan").value = resultData.profile.angkatan;
                    $('#id_user').val(resultData.profile.id_user)


                }

            }

        });

        // var x = document.getElementById("cardcode");
        // var cregis = document.getElementById("cardregist");
        // x.style.display = "none";
        // cregis.style.display = "block";
    });
    document.getElementById("daftar").addEventListener('submit', function(e) {
        e.preventDefault();
        var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('.txt_csrfname').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Register/daftar') ?>",
            data: $('#daftar').serialize(),
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