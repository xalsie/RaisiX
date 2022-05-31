<?php
ob_start("minifier");
function minifier($code) {
    $search = array(

        // Remove whitespaces after tags
        '/\>[^\S ]+/s',
          
        // Remove whitespaces before tags
        '/[^\S ]+\</s',
          
        // Remove multiple whitespace sequences
        '/(\s)+/s',
          
        // Removes comments
        '/<!--(.|\s)*?-->/'
    );
    $replace = array('>', '<', '\\1');
    $code = preg_replace($search, $replace, $code);
    return $code;
}

include_once("../includes/inc.php");

if (!isset($_GET["uuid"]) && !isset($_GET["email"]) && empty($_GET["uuid"]) && empty($_GET["email"]))
   header("Location: /");

$SQL = "SELECT `id`, `email` FROM `users` WHERE `email` = '".db_escape($_GET["email"])."' AND `token_check_email` = '".db_escape($_GET["uuid"])."' AND `check_email` = '0';";
   $result = db_query($SQL);

   if ($result[0]['email'] == db_escape($_GET["email"])) {
      $SQL = "UPDATE `users` SET `date_modification` = now(), `check_email` = '1' WHERE `token_check_email` = '".db_escape($_GET["uuid"])."' AND `email` = '".db_escape($_GET["email"])."';";
         $result = db_execute($SQL);
   } else {
      header("Location: /");
   }

echo Header_HTML("Confirme email", "frontend");
?>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->

   <style>
      .main-container{font-size:24px;width:100%;display:flex;flex-flow:column;justify-content:center;align-items:center}.check-container{width:6.25rem;height:7.5rem;display:flex;flex-flow:column;align-items:center;justify-content:space-between}.check-container .check-background{width:100%;height:calc(100% - 1.25rem);background:linear-gradient(to bottom right,#5de593,#41d67c);box-shadow:0 0 0 65px rgba(255,255,255,.25) inset,0 0 0 65px rgba(255,255,255,.25) inset;transform:scale(.84);border-radius:50%;animation:animateContainer .75s ease-out forwards .75s;display:flex;align-items:center;justify-content:center;opacity:0}.check-container .check-background svg{width:65%;transform:translateY(.25rem);stroke-dasharray:80;stroke-dashoffset:80;animation:animateCheck .35s forwards 1.25s ease-out}@keyframes animateContainer{0%{opacity:0;transform:scale(0);box-shadow:0 0 0 65px rgba(255,255,255,.25) inset,0 0 0 65px rgba(255,255,255,.25) inset}25%{opacity:1;transform:scale(.9);box-shadow:0 0 0 65px rgba(255,255,255,.25) inset,0 0 0 65px rgba(255,255,255,.25) inset}43.75%{transform:scale(1.15);box-shadow:0 0 0 43.334px rgba(255,255,255,.25) inset,0 0 0 65px rgba(255,255,255,.25) inset}62.5%{transform:scale(1);box-shadow:0 0 0 0 rgba(255,255,255,.25) inset,0 0 0 21.667px rgba(255,255,255,.25) inset}81.25%{box-shadow:0 0 0 0 rgba(255,255,255,.25) inset,0 0 0 0 rgba(255,255,255,.25) inset}100%{opacity:1;box-shadow:0 0 0 0 rgba(255,255,255,.25) inset,0 0 0 0 rgba(255,255,255,.25) inset}}@keyframes animateCheck{from{stroke-dashoffset:80}to{stroke-dashoffset:0}}@keyframes animateShadow{0%{opacity:0;width:100%;height:15%}25%{opacity:.25}43.75%{width:40%;height:7%;opacity:.35}100%{width:85%;height:15%;opacity:.25}}
   </style>

   <!-- Sign in Start -->
   <section class="sign-in-page">
      <div class="container h-100">
         <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6 col-sm-12 col-12 ">
               <div class="sign-user_card ">
                  <div class="sign-in-page-data">
                     <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                        <h1 class="display-4">Succès !</h1>
                        <div class="main-container">
                           <div class="check-container">
                              <div class="check-background">
                                 <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                              </div>
                           </div>
                        </div>
                        <p class="lead">L'adresse mail <a class="__cf_email__">[<?php echo $_GET["email"]; ?>]</a> à été vérifié avec succès !</p>

                        <div class="d-inline-block w-100">
                           <a href="/" class="btn btn-primary mt-3">Retourner à l'accueil</a>
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
   <script src="/assets/js/jquery.min.js"></script>
   <!-- jQuery, Popper JS -->
   <script src="/assets/js/jquery-3.4.1.min.js"></script>
   <script src="/assets/js/popper.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="/assets/js/bootstrap.min.js"></script>
   <!-- Custom JS-->
   <script src="/assets/js/custom.js"></script>
   <!-- AngularJS Core -->
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
   <!-- AngularJS Script-->
   <script src="/assets/js/app-angular.js"></script>
  </body>
</html>

<?php
   ob_end_flush();