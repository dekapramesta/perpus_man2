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
                                 <?= $ebook ?>
                                 <embed type="application/pdf" src="http://80.56.13.139/arc/Books%20Magazines%20and%20other%20texts/Please%20Sort/pdf.k0nsl.org/K/k0nsl-pdf/patriot-letter-prince-harry-tsunami-tom-mysieiwicz-joe-bryant-dr-bourke-horst-mahler-and-more.pdf" width="600" height="400"></embed>









                                 <!-- <div class="w-100 mt-2" style="background-color: #f3f4fa;border: solid 2px #cecece">
                                     <div id="adobe-dc-view" style="width:100%;" data-file="<?= $ebook ?>" data-meta="<?= $ebook ?>"></div>
                                 </div> -->
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
             clientId: "be08d0e54da34f3fb7fb78936b84f60b",
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