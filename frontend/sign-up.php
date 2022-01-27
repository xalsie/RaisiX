<?php
include_once("../includes/inc.php");

echo Header_HTML("S'inscrire", "");
?>
<!-- loader Start -->
<div id="loading">
   <div id="loading-center">
   </div>
</div>
<!-- loader END -->

<!-- MainContent -->
<section class="sign-in-page">
   <div class="container">
      <div class="row justify-content-center align-items-center height-self-center">
         <div class="col-lg-5 col-md-12 align-self-center">
            <div class="sign-user_card ">
               <div class="sign-in-page-data">
                  <div class="sign-in-from w-100 m-auto">
                     <h3 class="mb-3 text-center">S'inscrire</h3>

                     <?php 
                        if( isset($_SESSION["errorsForm"]) ){
                           foreach ($_SESSION["errorsForm"] as $keyError) {
                              echo "<li style='color:red'>".$listOfErrors[$keyError]."</li>";
                           }
                              unset($_SESSION["errorsForm"]);
                        }
                     ?>

                     <form class="mt-4" method="POST" action="script/saveUser.php">
                        <div class="form-group d-flex flex-md-row flex-column">
                           <input type="text" class="form-control mb-0" id="firstname" name="firstname" placeholder="Entrez votre Prenom" <?php echo (isset($_SESSION["firstname"]))? 'value="'.$_SESSION["firstname"].'"': ""; ?> autocomplete="off" required>
                           <input type="text" class="form-control mb-0" id="lastname" name="lastname" placeholder="Entrez votre Nom" <?php echo (isset($_SESSION["lastname"]))? 'value="'.$_SESSION["lastname"].'"': ""; ?> autocomplete="off" required>
                        </div>
                        <div class="form-group">
                           <input type="email" class="form-control mb-0" id="email" name="email" placeholder="Entrez votre Email" <?php echo (isset($_SESSION["email"]))? 'value="'.$_SESSION["email"].'"': ""; ?> autocomplete="off" required>
                        </div>
                        <div class="form-group">
                           <input type="password" class="form-control mb-0" id="pwd" name="pwd" placeholder="Entrez votre Mot de Passe" required>
                           <input type="password" class="form-control mb-0" id="pwdConfirm" name="pwdConfirm" placeholder="Confirmez votre Mot de Passe" required>
                        </div>  
                        <div class="custom-control custom-checkbox mb-3">
                           <input type="checkbox" class="custom-control-input" id="cgu" name="cgu">
                           <label class="custom-control-label" for="cgu">J'accepte les <a href="#" class="text-primary"> Termes et Conditions</a></label>
                        </div>
                           
                        <button type="submit" class="btn btn-hover">S'inscrire</button>

                     </form>
                  </div>
               </div>    
               <div class="mt-3">
                  <div class="d-flex justify-content-center links">
                  Vous avez déjà un compte ? <a href="login.php" class="text-primary ml-2">S'identifier</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php
   echo Footer_html();
?>