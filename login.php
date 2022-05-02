<?php
include_once("includes/inc.php");

$domain = 'raisix';

if(isset($_GET['logout'])) {
   // destroy session
   session_destroy();
   $cookieOptions = array (
      'expires' => 'Session',
      'path' => '/',
      'domain' => $domain
   );
   setcookie("remember", "", $cookieOptions);
} else if (isConnected())
   header("Location: /index.php");

echo Header_HTML("S'identifier", "frontend", "", "");
?>
      <!-- MainContent -->
      <section class="sign-in-page">
         <div class="container">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-lg-5 col-md-12 align-self-center">
                  <div class="sign-user_card ">
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <h3 class="mb-3 text-center">S'identifier</h3>

                           <?php 
                              if(isset($_SESSION["errorsForm"])) {
                                 foreach ($_SESSION["errorsForm"] as $keyError) {
                                    echo "<li style='color:red'>".$listOfErrors[$keyError]."</li>";
                                 }
                                    unset($_SESSION["errorsForm"]);
                              }
                           ?>

                           <?php
                              if(isset($_GET['logout'])) echo "Vous avez été déconnecté.";
                           ?>

                           <form class="mt-4" method="POST" action="/script/login.php">
                              <div class="form-group">
                                 <input type="email" class="form-control mb-0" id="email" name="email" <?php echo (isset($_SESSION["postForm"]["email"]))? 'value="'.$_SESSION["postForm"]["email"].'"': " "; ?> placeholder="Entrez votre Email" autocomplete="off" required>
                              </div>
                              <div class="form-group">
                                 <input type="password" class="form-control mb-0" id="pwd" name="pwd" <?php echo (isset($_SESSION["postForm"]["pwd"]))? 'value="'.$_SESSION["postForm"]["pwd"].'"': " "; ?> placeholder="Entrez votre Mot de Passe" required>
                              </div>

                              <div class="form-group">
                                 <div class="form-row">

                                    <div class="col-md-6">
                                       <div class="form-label-group">
                                          <img src="/script/captcha_new.php" onclick="this.src='/script/captcha_new.php?rand='+Math.random();" style="width: -webkit-fill-available;">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-label-group">
                                          <input type="text" class="form-control mb-0" id="captcha" name="captcha" placeholder="Entrez le captcha" autocomplete="off" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="sign-info">
                                 <button type="submit" class="btn btn-hover">S'identifier</button>
                                 <div class="custom-control custom-checkbox d-inline-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="customCheck">
                                    <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                                 </div>
                              </div>

                           </form>
                        </div>
                     </div>
                     <div class="mt-3">
                        <div class="d-flex justify-content-center links">
                           Vous n'avez pas de compte ? <a href="/sign-up.php" class="text-primary ml-2">S'inscrire</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                           <a href="reset-password.php" class="f-link">Mot de passe oublié ?</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- MainContent End-->

      <?php
         echo Footer_css("frontend");
      ?>
   </body>
</html>