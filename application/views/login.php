<section class="my-5">
    <div class="container">
        <div class="col text-center">
            <h2 style="color: black">Login</h2>
        </div>
        <?php if ($this->session->flashdata('pass_forgot')) {
            echo $this->session->flashdata('pass_forgot');
            $this->session->set_flashdata(
                'pass_forgot',
                ''
            );
        } ?>
        <?php echo $this->session->flashdata('pesan');
        $this->session->set_flashdata(
            'pesan',
            ''
        );  ?>
        <div class="d-flex justify-content-center">
            <div class="col col-md-8 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('Login/login_user') ?>" method="post" enctype="multipart/form-data">
                            <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type="text" name="username" class="form-control" placeholder="username" required />
                            <input type="password" name="password" class="form-control mt-2" placeholder="Password" required />
                            <div class="col-12 ">
                                <button type="submit" class="btn btn-outline-light mt-3 w-100" style="background-color: #3ac162;">Masuk</button>
                            </div>
                            <div class="d-flex justify-content-between pt-2">
                                <div class="col-6 px-1">
                                    <button type="button" onclick="LupaPass()" class="btn btn-sm col-12 text-white" style="background-color: #5AC347;">Lupas Password</button>
                                </div>
                                <div class="col-6 px-1">
                                    <a href="<?= base_url('Register') ?>" class=" btn btn-secondary btn-sm col-12">Daftar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function LupaPass() {
        Swal.fire({
            title: 'Masukan Username',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val();
                // var codehash = document.getElementById("code_reg").value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Login/SendToken/') ?>",
                    data: {
                        'username': login,
                        [csrfName]: csrfHash
                    },
                    dataType: "JSON",
                    success: function(resultData) {
                        console.log(resultData);
                        $('.txt_csrfname').val(resultData.token);
                        // $.each(resultData, function(i, data) {

                        // });

                        if (resultData.status == 0) {
                            Swal.fire(
                                'Error',
                                resultData.data,
                                'error'
                            )
                        } else if (resultData.status == 1) {
                            if (resultData.data.role_id == 1) {
                                Swal.fire(
                                    'Succes',
                                    `Cek pesan Di Nomor ${resultData.data.hp_siswa}`,
                                    'success'
                                )
                            } else if (resultData.data.role_id == 2) {
                                Swal.fire(
                                    'Succes',
                                    `Cek pesan Di Nomor ${resultData.data.hp_guru}`,
                                    'success'
                                )
                            }



                        }

                    }

                });
                // return fetch(`//api.github.com/users/${login}`)
                //     .then(response => {
                //         console.log(response);
                //         if (!response.ok) {
                //             throw new Error(response.statusText)
                //         }
                //         return response.json()
                //     })
                //     .catch(error => {
                //         Swal.showValidationMessage(
                //             `Request failed: ${error}`
                //         )
                //     })
            },
            allowOutsideClick: () => !Swal.isLoading()
        })

    }
</script>