<?php
include_once("../includes/inc.php");

if (!isset($_GET["uuid"]) && !isset($_GET["email"]) && empty($_GET["uuid"]) && empty($_GET["email"]))
   header("Location: /");

$SQL = "UPDATE `users` SET `date_modification` = now(), `check_email` = 1 WHERE `token_check_email` = '".db_escape($_GET["uuid"])."' AND `email` = '".db_escape($_GET["email"])."';";
   // $result = db_execute($SQL);

echo Header_HTML("Confirme email", "");
?>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Sign in Start -->
      <section class="sign-in-page">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-md-6 col-sm-12 col-12 ">
                  <div class="sign-user_card ">
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <img src="assets/images/login/mail.png" width="80"  alt="">
                           <h3 class="mt-3 mb-0">Succès !</h3>
                           <p class="text-white">L'adresse mail <a class="__cf_email__">[<?php echo $_GET["email"]; ?>]</a> à été vérifié avec succès !</p>
                           <div class="d-inline-block w-100">
                              <a href="/" class="btn btn-primary mt-3">Back to Home</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Sign in END -->
   <!-- Import JS -->
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/jquery.dataTables.min.js"></script>
   <script src="assets/js/dataTables.bootstrap4.min.js"></script>
   <!-- Appear JavaScript -->
   <script src="assets/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="assets/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="assets/js/waypoints.min.js"></script>
   <script src="assets/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="assets/js/wow.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="assets/js/smooth-scrollbar.js"></script>
   <!-- apex Custom JavaScript -->
   <script src="assets/js/apexcharts.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="assets/js/chart-custom.js"></script>
   <!-- jQuery, Popper JS -->
   <script src="assets/js/jquery-3.4.1.min.js"></script>
   <script src="assets/js/popper.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- Slick JS -->
   <script src="assets/js/slick.min.js"></script>
   <!-- owl carousel Js -->
   <script src="assets/js/owl.carousel.min.js"></script>
   <!-- select2 Js -->
   <script src="assets/js/select2.min.js"></script>
   <!-- Magnific Popup-->
   <script src="assets/js/jquery.magnific-popup.min.js"></script>
   <!-- Slick Animation-->
   <script src="assets/js/slick-animation.min.js"></script>
   <!-- Flatpickr JavaScript -->
   <script src="assets/js/flatpickr.min.js"></script>
   <!-- Custom JS-->
   <script src="assets/js/custom.js"></script>
   <!-- AngularJS Core -->
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
   <!-- AngularJS Script-->
   <script src="/frontend/assets/js/app-angular.js"></script>
  </body>
</html>