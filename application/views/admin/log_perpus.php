  <div class="main-content">
      <section class="section">
          <div class="section-body">
              <div class="row justify-content-center">

                  <div class="col-12 col-md-12 col-lg-10">
                      <div class="card">
                          <div class="card-header">
                              <h4>Log Perpus</h4>
                          </div>
                          <div class="card-body" id="card_kembali">
                              <form id="form_log" action="#" method="post" enctype="multipart/form-data">
                                  <div class="section-title mt-0">Kode</div>
                                  <div class="form-group">
                                      <input id="code" type="text" name="kode_render" class="form-control">
                                      <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary w-100">Maasuk</button>
                                  </div>
                              </form>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </section>
  </div>
  <script>
      document.getElementById("form_log").addEventListener('submit', function(e) {
          e.preventDefault();
          var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = $('.txt_csrfname').val();
          let code = document.getElementById('code').value;
          $.ajax({
              type: "POST",
              url: "<?php echo site_url('Admin/LogPerpus/PostData') ?>",
              data: {
                  [csrfName]: csrfHash,
                  'code': code

              },
              dataType: "JSON",
              success: function(result) {
                  $('.txt_csrfname').val(result.token);

                  if (result.status == 1) {
                      swal('Berhasil', result.message, 'success');

                  } else if (result.status == 0) {
                      swal('Tidak Ditemukan', result.message, 'error');

                  }

              }

          });

      });
  </script>