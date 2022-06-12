  <?php echo $this->session->flashdata('notif'); ?>
  <div class="main-content">
      <section class="section">
          <div class="section-body">
              <div class="row justify-content-center">

                  <div class="col-12 col-md-12 col-lg-10">
                      <div class="card">
                          <div class="card-header">
                              <h4>Tukar Coin</h4>
                          </div>
                          <div class="card-body" id="card_kembali">
                              <form id="tukar_coin" action="#" method="post" enctype="multipart/form-data">
                                  <div class="section-title mt-0">Kode</div>
                                  <div class="form-group">
                                      <input id="kode_render" type="text" name="kode_render" class="form-control">
                                      <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary w-100">Lihat</button>
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
      document.getElementById("tukar_coin").addEventListener('submit', function(e) {
          e.preventDefault();
          var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = $('.txt_csrfname').val();
          let kode_render = document.getElementById('kode_render').value;
          $.ajax({
              type: "POST",
              url: "<?php echo site_url('Admin/TukarCoin/getData') ?>",
              data: {
                  [csrfName]: csrfHash,
                  'kode_render': kode_render

              },
              dataType: "JSON",
              success: function(result) {
                  //  console.log(result)
                  $('.txt_csrfname').val(result.token);
                  if (!result.penukaran) {
                      swal('Tidak Ditemukan', 'Kode Penukaran Tidak Ditemukan', 'error');
                  } else {
                      if (result.penukaran.status_penukaran == '1') {
                          swal('Dilarang', 'Kode Penukaran Sudah Ditukarkan', 'error');
                      } else {
                          $('#siswa').val(result.penukaran.nama)
                          $('#hadiah').val(result.penukaran.nama_item)
                          $('#kode').val(kode_render)
                          $('#modal_coin').appendTo("body").modal('show');


                      }
                  }

              }

          });

      });
  </script>
  <div class="modal fade" id="modal_coin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Kode Penukaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?= base_url('Admin/TukarCoin/TukarHadiah') ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                          <label for="">Siswa</label>
                          <input id="siswa" type="text" class="form-control " readonly>
                      </div>
                      <label for="">Hadiah</label>
                      <div class="form-group">
                          <input id="hadiah" type="text" class="form-control " readonly>
                      </div>
                      <div class="form-group">
                          <label for="">Kode</label>
                          <input id="kode" type="text" name="kode_render" class="form-control " readonly>
                      </div>


                      <div align="right">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                          <button type="submit" name="import" class="btn btn-primary">Tukar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>