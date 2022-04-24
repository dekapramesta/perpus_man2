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
                              <form action="<?= base_url('Admin/TukarCoin/TukarHadiah') ?>" method="post" enctype="multipart/form-data">
                                  <div class="section-title mt-0">Kode</div>
                                  <div class="form-group">
                                      <input type="text" name="kode_render" class="form-control">
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