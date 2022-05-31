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

if (isConnected())
   header("Location: /index.php");

echo Header_HTML("S'inscrire", "frontend");
?>

<style>
.list-group-item{position:relative;display:block;padding:5px;background-color:#0000;border:0}form.mt-4 .btn{padding:.375rem .75rem}input.input-success,input.input-success:focus{color:#28a745!important;border-color:#28a745!important;border:3px solid #28a745!important}input.input-danger,input.input-danger:focus{color:#dc3545!important;border-color:#dc3545!important;border:3px solid #dc3545!important}
</style>
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
                        <div class="row">
                           <div class="form-group col-sm-12 col-md-6">
                              <input type="text" class="form-control mb-0" id="firstname" name="firstname" placeholder="Entrez votre Prenom" minlength="3" maxlength="45" <?php echo (isset($_SESSION["postForm"]["firstname"]))? 'value="'.$_SESSION["postForm"]["firstname"].'"': ""; ?> autocomplete="off" onkeyup="checkSubmit()" required>
                              <small id="passwordHelpInline" class="text-muted">
                                 La longueur doit être de 3 à 45 caractères.
                              </small>
                           </div>
                           <div class="form-group col-sm-12 col-md-6">
                              <input type="text" class="form-control mb-0" id="lastname" name="lastname" placeholder="Entrez votre Nom" minlength="3" maxlength="45" <?php echo (isset($_SESSION["postForm"]["lastname"]))? 'value="'.$_SESSION["postForm"]["lastname"].'"': ""; ?> autocomplete="off" onkeyup="checkSubmit()" required>
                              <small id="passwordHelpInline" class="text-muted">
                                 La longueur doit être de 3 à 45 caractères.
                              </small>
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="email" class="form-control mb-0" id="email" name="email" placeholder="Entrez votre Email" <?php echo (isset($_SESSION["postForm"]["email"]))? 'value="'.$_SESSION["postForm"]["email"].'"': ""; ?> autocomplete="off" onkeyup="checkSubmit()" required>
                        </div>

                        <div class="form-group">
                           <div class="input-group mb-1">
                              <input type="password" class="form-control mb-0" id="pwd" name="pwd" placeholder="Entrez votre Mot de Passe" minlength="8" onkeyup="getPassword()" required>
                              <div class="input-group-text">
                                 <button class="btn btn-outline-secondary" type="button" data-id="pwd" onclick="togglePassword(this)">👀</button>
                              </div>
                           </div>

                           <div class="input-group">
                              <input type="password" class="form-control mb-0" id="pwdConfirm" name="pwdConfirm" placeholder="Confirmez votre Mot de Passe" minlength="8" maxlength="25" onkeyup="checkConfirmPwd()" required>
                              <div class="input-group-text">
                                 <button class="btn btn-outline-secondary" type="button" data-id="pwdConfirm" onclick="togglePassword(this)">👀</button>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <ul class="list-group" id="requirements">
                              <li id="length" class="list-group-item">Au moins 12 caractères</li>
                              <li id="lowercase" class="list-group-item">Au moins 1 lettre minuscule</li>
                              <li id="uppercase" class="list-group-item">Au moins 1 lettre majuscule</li>
                              <li id="number" class="list-group-item">Au moins 1 chiffre</li>
                              <li id="special" class="list-group-item">Au moins 1 caractère spécial</li>
                           </ul>
                        </div>

                        <div class="form-check mb-3">
                           <input type="checkbox" class="custom-control-input" id="cgu" onclick="checkSubmit()" name="cgu">
                           <label class="custom-control-label" for="cgu">J'accepte les <a href="#" class="text-primary"> Termes et Conditions</a></label>
                        </div>
                           
                        <button type="submit" id="btnSubmit" class="btn btn-block btn-secondary" disabled>S'inscrire</button>
                     </form>
                  </div>
               </div>    
               <div class="mt-3">
                  <div class="d-flex justify-content-center links">
                  Vous avez déjà un compte ? <a href="/login.php" class="text-primary ml-2">S'identifier</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
      function getPassword() {
         var elem = document.getElementById('pwd');
         var text = elem.value;
         // if (text == "") return;
         var pwdChecked = false;

         var length     = document.getElementById('length');
         var lowercase  = document.getElementById('lowercase');
         var uppercase  = document.getElementById('uppercase');
         var number     = document.getElementById('number');
         var special    = document.getElementById('special');

         if (checkIfEightChar(text))      {length.classList.add('list-group-item-success');    pwdChecked = true;} else {length.classList.remove('list-group-item-success');    pwdChecked = false;}
         if (checkIfOneLowercase(text))   {lowercase.classList.add('list-group-item-success'); pwdChecked = true;} else {lowercase.classList.remove('list-group-item-success'); pwdChecked = false;}
         if (checkIfOneUppercase(text))   {uppercase.classList.add('list-group-item-success'); pwdChecked = true;} else {uppercase.classList.remove('list-group-item-success'); pwdChecked = false;}
         if (checkIfOneDigit(text))       {number.classList.add('list-group-item-success');    pwdChecked = true;} else {number.classList.remove('list-group-item-success');    pwdChecked = false;}
         if (checkIfOneSpecialChar(text)) {special.classList.add('list-group-item-success');   pwdChecked = true;} else {special.classList.remove('list-group-item-success');   pwdChecked = false;}

         checkConfirmPwd()
         checkSubmit()

         if (pwdChecked) {
            elem.classList.add('input-success');
         } else {
            elem.classList.remove('input-success');
         }
      }

      function checkIfEightChar(text){
         return text.length >= 12;
      }

      function checkIfOneLowercase(text) {
         return /[a-z]/.test(text);
      }

      function checkIfOneUppercase(text) {
         return /[A-Z]/.test(text);
      }

      function checkIfOneDigit(text) {
         return /[0-9]/.test(text);
      }

      function checkIfOneSpecialChar(text) {
         return /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(text);
      }

      function validateEmail(email) {
         const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return re.test(String(email).toLowerCase());
      }

      function checkCGU() {
         return document.getElementById('cgu').checked;
      }

      function checkConfirmPwd() {
         if (document.getElementById('pwd').value == document.getElementById('pwdConfirm').value) {
            document.getElementById('pwdConfirm').classList.add('input-success');
            document.getElementById('pwdConfirm').classList.remove('input-danger');
         } else {
            document.getElementById('pwdConfirm').classList.remove('input-success');
            document.getElementById('pwdConfirm').classList.add('input-danger');
         }

         checkSubmit()
      }

      function checkSubmit() {
         var btnSubmit = document.getElementById('btnSubmit');
         var submitSuccess = false;

         if (document.getElementById('firstname').value.length > 2 &&
         document.getElementById('lastname').value.length > 2 &&
         validateEmail(document.getElementById('email').value) &&
         document.getElementById('pwd').value.length >= 8 &&
         document.getElementById('pwd').value == document.getElementById('pwdConfirm').value &&
         checkCGU())
            submitSuccess = true;
         else
            submitSuccess = false;


         if (submitSuccess) {
            btnSubmit.disabled = false;
            btnSubmit.classList.add('btn-hover');
            btnSubmit.classList.remove('btn-secondary');
         } else {
            btnSubmit.disabled = true;
            btnSubmit.classList.add('btn-secondary');
            btnSubmit.classList.remove('btn-hover');
         }
      }

      function togglePassword(elem) {
         var parent = elem.closest('.input-group');
         var passInput = parent.querySelector('input');

         passInput.type === "password" ? passInput.type = "text" : passInput.type = "password";
         elem.textContent === "👀" ? elem.textContent = "🔒" : elem.textContent = "👀";
      }
   </script>

<?php
   echo Footer_css("frontend");
   ob_end_flush();