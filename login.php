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

include_once("includes/inc.php");

if(isset($_GET['logout'])) {
   // destroy session
   session_destroy();
   $cookieOptions = array (
      'expires' => '1',
      'path' => '/',
      'domain' => $_SERVER["SERVER_NAME"]
   );
   setcookie("remember", "", $cookieOptions);
} else if (isConnected())
   header("Location: /index.php");

echo Header_HTML("S'identifier", "frontend", "", "");
?>
      <!-- MainContent -->
      <style>
         [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
            display: none !important;
         }
      </style>
      <section class="sign-in-page" data-ng-cloak data-ng-controller="appSignIn">
         <div class="container">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-lg-5 col-md-12 align-self-center">
                  <div class="sign-user_card" data-ng-hide="cardAuthValidation2fa">
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <h3 class="mb-3 text-center">S'identifier</h3>

                           <div class="alert" data-ng-show="error">
                              <li style='color:red'>{{errorText}}</li>
                           </div>
                           
                           <div class="alert" data-ng-init="alertLogOut()" data-ng-show="alertLogOutShow">
                              <li style='color:green'>Vous avez été déconnecté.</li>
                           </div>

                           <form class="mt-4" method="POST" action="/script/login.php">
                              <div class="form-group">
                                 <input type="email" class="form-control mb-0" id="email" name="email" data-ng-model="login_email" placeholder="Entrez votre Email" autocomplete="on" required>
                              </div>
                              <div class="form-group">
                                 <input type="password" class="form-control mb-0" id="pwd" name="pwd" data-ng-model="login_pwd" placeholder="Entrez votre Mot de Passe" autocomplete="on" required>
                              </div>

                              <div class="form-group">
                                 <div class="form-row">

                                    <div class="col-md-6">
                                       <div class="form-label-group">
                                          <img data-ng-src="{{srcCaptcha}}" onclick="this.src='/script/captcha_new.php?rand='+Math.random();" style="width: -webkit-fill-available;">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-label-group">
                                          <input type="text" class="form-control mb-0" id="captcha" name="login_captcha" data-ng-model="login_captcha" placeholder="Entrez le captcha" autocomplete="off" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="sign-info">
                                 <button type="button" class="btn btn-hover" data-ng-click="toSignIn()">S'identifier</button>
                                 <div class="form-check d-inline-block">
                                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me" data-ng-model="login_remember_me">
                                    <label class="custom-control-label" for="remember_me">Se souvenir de moi</label>
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

                  <div class="sign-user_card" data-ng-hide="!cardAuthValidation2fa">
                     <div class="sign-in-page-data">
                        <div class="sign-in-from w-100 m-auto">
                           <h3 class="mb-3 text-center">Authentification a 2 facteurs (2FA)</h3>

                           <div class="alert" data-ng-show="error">
                              <li style='color:red'>{{errorText}}</li>
                           </div>

                           <div class="mt-4">
                              <div class="form-group">
                                 <input type="text" class="form-control mb-0" id="auth2fa" name="auth2fa" data-ng-model="login_auth2fa" autocomplete="off" required>
                                 <label for="auth2fa" class="text-muted">Saisissez le jeton à deux facteurs généré par votre appareil.</label>
                              </div>

                              <div class="sign-info">
                                 <button type="button" class="btn btn-hover btn-block" data-ng-click="GetAuthValidation2fa()">Valider</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="mt-3">
                        <div class="d-flex justify-content-center links">
                           <a type="button" class="f-link" data-ng-click="returnToLogin()">Retour au login</a>
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

<?php
   ob_end_flush();