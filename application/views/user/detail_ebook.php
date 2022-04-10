 <main id="main" data-aos="fade-in">

     <!-- ======= Breadcrumbs ======= -->
     <div class="breadcrumbs">
         <div class="container text-start">
             <h2>Detail E-Book</h2>
             <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
         </div>
     </div>

     <!-- ======= Courses Section ======= -->
     <section id="courses" class="courses">
         <div class="container" data-aos="fade-up">

             <div class="row" data-aos="zoom-in" data-aos-delay="100">
                 <div class="col-lg-9">
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-12 ">
                             <div class="course-item">
                                 <div class="course-content">


                                     <h3><a href="course-details.html"><?= $ebook->judul_ebook ?></a></h3>
                                     <p><?= $ebook->deskripsi ?></p>
                                     <div class="trainer d-flex justify-content-between align-items-center">
                                         <div class="trainer-profile d-flex align-items-center">
                                             <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                             <div class="d-flex justify-content-between align-items-center mb-3">
                                                 <?php $ktg = explode(",", $ebook->kategori);
                                                    foreach ($ktg as $kt) { ?>
                                                     <h4 class="ms-1"><?= $kt ?></h4>
                                                 <?php }  ?>
                                             </div>
                                         </div>
                                         <!-- <div class="trainer-rank d-flex align-items-center"><i class="bx bx-user"></i>&nbsp;50 &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;65</div> -->
                                     </div>
                                     <div class="trainer d-flex justify-content-between align-items-center">
                                         <div class="trainer-profile d-flex align-items-center">
                                             <!-- <img src="<?= base_url('assets/img/trainers/trainer-1.jpg') ?>" class="img-fluid" alt="" /> -->
                                             <span>Penulis : <?= $ebook->penulis ?></span>

                                         </div>

                                         <div class="trainer-rank d-flex align-items-center"><i class="bx bx-receipt"></i>&nbsp;50 &nbsp;&nbsp; </div>
                                     </div>
                                 </div>
                                 <div class="w-100 mt-2" style="background-color: #f3f4fa;border: solid 2px #cecece">
                                     <div id="adobe-dc-view" style="width:100%;" data-file="<?= base_url() ?>assets/pdf/wadwd.pdf" data-meta="wadwd.pdf"></div>
                                 </div>
                             </div>

                         </div>



                     </div>
                 </div>
                 <div class="col">
                     <div class="course-item">
                         <div class="course-content text-center">
                             <h3 id="ktg">Kategori</h3>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                         <div class="trainer d-flex justify-content-between align-items-center ">
                             <div class="trainer-profile d-flex align-items-center">
                                 <span class="mb-3">Fiksi </span>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </div>
     </section><!-- End Courses Section -->

 </main><!-- End #main -->
 <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
 <script type="text/javascript">
     document.addEventListener("adobe_dc_view_sdk.ready", function() {
         var adobeDCView = new AdobeDC.View({
             clientId: "e66f04ef460b4e18a90b5b30b8b26adb",
             divId: "adobe-dc-view"
         });
         const url = $('#adobe-dc-view').data("file");
         const meta = $('#adobe-dc-view').data("meta");
         adobeDCView.previewFile({
             content: {
                 location: {
                     url: url
                 }
             },
             metaData: {
                 fileName: meta
             }
         }, {
             embedMode: "IN_LINE",
             showDownloadPDF: false,
             showPrintPDF: false
         });
     });
 </script>