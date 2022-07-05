 <?php if ($this->session->flashdata('admin_pdf')) {
        echo $this->session->flashdata('admin_pdf');
        $this->session->set_flashdata(
            'admin_pdf',
            ''
        );
    } ?>
 <div class="main-content">
     <section class="section">
         <div class="section-body">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <div class="col">
                                 <div class="row ">
                                     <div class="col">
                                         <h4>E-Book</h4>
                                     </div>
                                     <div class="col text-right">
                                         <button onclick="modal_pdf()" type="button" class="btn btn-primary" href="">Tambah Data</button>


                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped" id="table-1">
                                     <thead>
                                         <tr>
                                             <th>
                                                 #
                                             </th>
                                             <th>Judul Ebook</th>
                                             <th>Penulis</th>
                                             <th>Aksi</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php $no = 0;
                                            foreach ($getAllPdf as $pdf) : $no++ ?>
                                             <tr>
                                                 <td><?= $no ?></td>
                                                 <td><?= $pdf['judul_ebook'] ?></td>
                                                 <td><?= $pdf['penulis'] ?></td>




                                                 <td class="text-center">
                                                     <div class="dropdown">
                                                         <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle w-75">Options</a>
                                                         <div class="dropdown-menu">
                                                             <a href="<?= base_url('Admin/InventoryPdf/DetailPdf/' . $pdf['id_ebook']) ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                                             <a href="#" onclick="deletePdf('<?= $pdf['id_ebook'] ?>')" class="dropdown-item has-icon"><i class="far fa-trash-alt"></i> Delete</a>
                                                         </div>
                                                     </div>
                                                 </td>
                                             </tr>
                                         <?php endforeach; ?>

                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="upload_pdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Tambah Pdf</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form action="<?php echo base_url('Admin/InventoryPdf/save_pdf') ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <input id="judul" placeholder="Judul" type="text" name="judul" class="form-control " required="">
                             </div>
                             <div class="form-group">
                                 <input id="penulis" placeholder="Penulis" type="text" name="penulis" class="form-control " required="">
                             </div>
                             <div class="form-group">
                                 <input id="halaman" placeholder="Halaman" type="text" name="halaman" class="form-control " required="">
                             </div>
                             <div class="form-group">
                                 <textarea id="desc" placeholder="Deskripsi" type="text" name="deskripsi" class="form-control " required=""></textarea>
                             </div>
                             <div class="form-group">
                                 <label for="">Kategori Pdf</label><br>
                                 <select name="kategori_pdf[]" class="form-control selectric" multiple="">
                                     <?php foreach ($category_pdf as $ct) { ?>
                                         <option value="<?= $ct['nama_kategori'] ?>"><?= $ct['nama_kategori'] ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label for="">File Pdf</label><br>

                                 <input hidden type="text" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                 <input type="file" name="file_pdf" required>
                                 <!-- <input id="nisn" placeholder="NISN" type="text" name="nisn" class="form-control " required=""> -->
                             </div>

                             <div align="right">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                 <button type="submit" name="import" class="btn btn-primary">Simpan</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <script>
             function modal_pdf() {
                 $(".select2").select2();

                 $('#upload_pdf').appendTo("body").modal('show');
             }

             function deletePdf(id) {
                 var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                 var csrfHash = $('.txt_csrfname').val();
                 swal({
                         title: 'Delete Ebook',
                         text: 'Yakin ingin Mengdelete E-Book?',
                         icon: 'warning',
                         buttons: true,
                         dangerMode: true,
                     })
                     .then((willDelete) => {
                         if (willDelete) {
                             $.ajax({
                                 type: "POST",
                                 url: "<?php echo site_url('Admin/InventoryPdf/deletePdf') ?>",
                                 data: {
                                     [csrfName]: csrfHash,
                                     'id_ebook': id,
                                 },
                                 dataType: "JSON",
                                 success: function(resultData) {
                                     $('.txt_csrfname').val(resultData.token);
                                     console.log(resultData);
                                     $(document).ajaxStop(function() {
                                         if (resultData.status == 0) {
                                             swal('Gagal', 'Gagal Menghapus', 'error');

                                         } else {
                                             swal('Success', 'Sukses Menghapus', 'success').then((ok) => {
                                                 window.location.reload();

                                             });

                                         }
                                     });

                                 }

                             });
                         } else {
                             swal('Dibatalkan!');
                         }
                     });
             }
         </script>