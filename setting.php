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

isConnected(true);

echo Header_HTML("Réglage du compte", "frontend", "", '<!-- Slick JS -->
<script src="/assets/js/slick.min.js"></script>
<!-- owl carousel Js -->
<script src="/assets/js/owl.carousel.min.js"></script>
<!-- select2 Js -->
<script src="/assets/js/select2.min.js"></script>
<!-- Magnific Popup-->
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Slick Animation-->
<script src="/assets/js/slick-animation.min.js"></script>
<!-- Flatpickr JavaScript -->
<script src="/assets/js/flatpickr.min.js"></script>
<!-- Moment With Locales JavaScript -->
<script src="/assets/js/moment-with-locales.min.js"></script>
<script type="text/javascript">moment.locale("fr");</script>');
?>

<?php echo Header_loader(); ?>
    <!-- Header -->
<?php echo Header_header(); ?>
    <!-- Header End -->
    <!-- MainContent -->
    <section class="m-profile setting-wrapper" ng-controller="appSetting">
        <div class="container">
            <h4 class="main-title mb-4">Réglage du compte</h4>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="sign-user_card text-center">
                        <label class="edit-icon text-primary slick-arrow" for="customFile">Modifier</label>
                            <input type="file" class="custom-file-input" accept="image/*" onchange="angular.element(this).scope().SelectFile(event)" style="display:none;" id="customFile">
                        <img ng-src="{{PreviewImage}}" class="rounded-circle img-fluid d-block avatar-150 cover mx-auto mb-3" alt="Avatar user">
                        <a ng-show="PreviewImageSave" class="save-icon text-success slick-arrow" data-ng-click="sendPicture();">Enregistrer</a>

                        <h4 class="mt-4 mb-3" data-ng-hide="settingMap.pseudo">{{settingMap.firstname}} {{settingMap.lastname}}</h4>
                        <h4 class="mt-4 mb-3" data-ng-show="settingMap.pseudo">{{settingMap.pseudo}}</h4>

                        <!-- <p>{{settingMap.description}}</p> -->

                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-12">
                                <span class="text-light font-size-13">Description</span>
                                <textarea ng-show="!editLine8" class="form-control form-control-sm mb-0" ng-model="settingMap.description" placeholder="Description" rows="6" readonly style="background-color: var(--iq-body-bg);height: 160px;">{{settingMap.description}}</textarea>
                                <textarea ng-show="editLine8" class="form-control" ng-model="settingMap.description" name="formControlEditDescription" placeholder="Description" rows="6"></textarea>
                            </div>
                            <div class="col-12 text-md-right text-left">
                                <button type="button" ng-show="!editLine8" class="text-body btn-outline-primary btn-sm mt-1 mb-1 text-primary slick-arrow" data-ng-click="editLine8 = !editLine8;">Modifier</button>
                                <button type="button" ng-show="editLine8" class="text-body btn-outline-primary btn-sm mt-1 mb-1 text-primary slick-arrow" data-ng-click="editLine8 = !editLine8;saveLine()">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="sign-user_card">
                        <h5 class="mb-3 pb-3 a-border">Détails personnels</h5>
                        
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Prenom</span>
                                <p ng-show="!editLine1" class="mb-0">{{settingMap.firstname}}</p>
                                <input ng-show="editLine1" type="text" ng-model="settingMap.firstname" class="form-control form-control-sm mb-0" placeholder="Prenom">
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine1" class="text-primary slick-arrow" data-ng-click="editLine1 = !editLine1;">Modifier</a>
                                <a ng-show="editLine1" class="text-success slick-arrow" data-ng-click="editLine1 = !editLine1;saveLine()">Enregistrer</a>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Nom</span>
                                <p ng-show="!editLine2" class="mb-0">{{settingMap.lastname}}</p>
                                <input ng-show="editLine2" type="text" ng-model="settingMap.lastname" class="form-control form-control-sm mb-0" placeholder="Nom">
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine2" class="text-primary slick-arrow" data-ng-click="editLine2 = !editLine2;">Modifier</a>
                                <a ng-show="editLine2" class="text-success slick-arrow" data-ng-click="editLine2 = !editLine2;saveLine()">Enregistrer</a>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Pseudo</span>
                                <p ng-show="!editLine7" class="mb-0">{{settingMap.pseudo}}</p>
                                <input ng-show="editLine7" type="text" ng-model="settingMap.pseudo" class="form-control form-control-sm mb-0" placeholder="Pseudo">
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine7" class="text-primary slick-arrow" data-ng-click="editLine7 = !editLine7;">Modifier</a>
                                <a ng-show="editLine7" class="text-success slick-arrow" data-ng-click="editLine7 = !editLine7;saveLine()">Enregistrer</a>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Email</span>
                                <p ng-show="!editLine3" class="mb-0">[courriel protégé]</p>
                                <input ng-show="editLine3" type="text" ng-model="settingMap.email" class="form-control form-control-sm mb-0" placeholder="Email">
                            </div>   
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine3" class="text-primary slick-arrow" data-ng-click="editLine3 = !editLine3;">Modifier</a>
                                <a ng-show="editLine3" class="text-success slick-arrow" data-ng-click="editLine3 = !editLine3;saveLine()">Enregistrer</a>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Mot de passe</span>
                                <p ng-show="!editLine4" class="mb-0">**********</p>
                                <div ng-show="editLine4" class="row">
                                    <div class="col">
                                        <input type="password" class="form-control form-control-sm mb-0" placeholder="Mot de passe">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control form-control-sm mb-0" placeholder="Confimer le Mot de passe">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine4" class="text-primary slick-arrow" data-ng-click="editLine4 = !editLine4;">Modifier</a>
                                <a ng-show="editLine4" class="text-success slick-arrow" data-ng-click="editLine4 = !editLine4;saveLine()">Enregistrer</a>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-3">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Date de naissance</span>
                                <p ng-show="!editLine5" class="mb-0">{{settingMap.date_naissance}}</p>
                                <input ng-show="editLine5" type="text" class="form-control form-control-sm mb-0 date-input basicFlatpickr flatpickr-input" id="inputWeek" ng-model="settingMap.date_naissance" placeholder="Date de naissance" value="" readonly="readonly">
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine5" class="text-primary slick-arrow" data-ng-click="editLine5 = !editLine5;">Modifier</a>
                                <a ng-show="editLine5" class="text-success slick-arrow" data-ng-click="editLine5 = !editLine5;saveLine()">Enregistrer</a>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-8">
                                <span class="text-light font-size-13">Langue</span>
                                <p ng-show="!editLine6" class="mb-0">{{settingMap.langue}}</p>
                                <select ng-show="editLine6" class="form-control form-control-sm mb-0" ng-model="settingMap.langue" id="exampleFormControlSelect1">
                                    <option selected disabled>Choisisez votre langue</option>
                                    <option value="francais">Français</option>
                                    <option value="anglais">Anglais</option>
                                 </select>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a ng-show="!editLine6" class="text-primary slick-arrow" data-ng-click="editLine6 = !editLine6;">Modifier</a>
                                <a ng-show="editLine6" class="text-success slick-arrow" data-ng-click="editLine6 = !editLine6;saveLine()">Enregistrer</a>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-end mb-3 mt-3">
                            <div class="col-md-auto text-md-right text-left">
                                <button type="button" ng-show="btnSave" class="btn-outline-success btn-sm btn-success d-block mb-1 mt-1 slick-arrow text-body" data-ng-click="saveSetting()">Enregistrer</button>
                                
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4 pb-3 a-border">Authentification a 2 facteurs (2FA)</h5>
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-12 r-mb-15">
                                <p>L'authentification à deux facteurs est actuellement <span data-ng-show="settingMap.auth_fa == 1">activée</span><span data-ng-show="settingMap.auth_fa == 0">désactivée</span> sur votre compte.</p>

                                <button type="button" class="btn btn-hover mt-1" data-toggle="modal" data-target="#modalEnable2FA" data-ng-show="settingMap.auth_fa == 0" data-ng-click="GetAuthPairing2fa()">
                                    Activer
                                </button>
                                <button type="button" class="btn btn-hover mt-1" data-toggle="modal" data-target="#modalDisable2FA" data-ng-show="settingMap.auth_fa == 1">
                                    Désactiver
                                </button>
                            </div>
                        </div>

                        <h5 data-ng-hide="settingMap.payment_choise==0" class="mb-3 mt-4 pb-3 a-border">Détails de la facturation</h5>
                        <div data-ng-hide="settingMap.payment_choise==0" class="row justify-content-between mb-3">
                            <div class="col-md-8 r-mb-15">
                                <p>Votre prochaine date de facturation est le {{settingMap.payment_date | addMonth}}.</p>
                                <a href="#" class="btn btn-hover mt-1">Annuler l'adhésion</a>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a href="/pricing-plan.php" class="text-primary slick-arrow">Mettre à jour les informations de paiement</a>
                            </div>
                        </div>
                        <h5 class="mb-3 mt-4 pb-3 a-border">Détails du forfait</h5>
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-8">
                                <p data-ng-show="settingMap.payment_choise==0">Free</p>
                                <p data-ng-show="settingMap.payment_choise==1">Basic</p>
                                <p data-ng-show="settingMap.payment_choise==2">Standard</p>
                                <p data-ng-show="settingMap.payment_choise==3">Premium</p>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a href="/pricing-plan.php" class="text-primary slick-arrow">Modifier le Plan</a>
                            </div>
                        </div>
                        <h5 class="mb-3 pb-3 mt-4 a-border">Réglage</h5>
                        <div class="row">
                            <div class="col-12 setting">
                                <!-- <a href="#" class="text-body d-block mb-1">Activité récente de diffusion en continu sur l'appareil</a> -->
                                <button type="button" class="text-body btn-sm btn-hover d-block mt-1 mb-1" data-toggle="modal" data-target="#modalSignOutAll">Déconnectez-vous de tous les appareils</button>
                                <!-- <a href="#" class="text-body d-block">Déconnectez-vous de tous les appareils</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Modal 2FA -->
        <div class="modal fade" id="modalEnable2FA" tabindex="-1" role="dialog" aria-labelledby="Authenticator as a two-factor" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Authentification a 2 facteurs (2FA)</h5>
                    <button type="button" class="btn-btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div id="qrPairing" class="form-group qr-auth">

                        </div>
                        <div class="form-group text-justify">
                            <span>Ouvrez votre application Google Authenticator, appuyez sur l'icône "+" en haut à droite, puis appuyez sur "Scanner le code-barres".</span>
                        </div>

                        <div class="form-group text-justify">
                            <span class="text-danger" data-ng-show="authValidateError">{{errorText}}</span>
                            <input type="text" id="qrCodeValidate" class="form-control form-control-sm mb-0" minlength="6" maxlength="7" required data-ng-model="validate">
                            <span>Saisissez le code de votre dispositif d'authentification après avoir scanné l'image QR.</span>
                        </div>

                        <button type="button" aria-label="Activer" data-ng-click="GetAuthValidation2fa()" class="btn btn-block btn-primary">Activer <i class="fa-duotone fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('qrCodeValidate').addEventListener('input', function (e) {
                e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{3})/g, '$1 ').trim();
            });
        </script>

        <div class="modal fade" id="modalDisable2FA" tabindex="-1" role="dialog" aria-labelledby="Authenticator as a two-factor" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Authentification a 2 facteurs (2FA)</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group text-justify">
                            <span class="text-danger" data-ng-show="authValidateError">{{errorText}}</span>
                            <input type="password" id="UserCodeValidate" class="form-control form-control-sm mb-0" required data-ng-model="userPwd">
                            <span>Saisissez votre mot de passe afin de désactiver le dispositif d'authentification a 2 facteurs. (2FA)</span>
                        </div>

                        <button type="button" aria-label="Activer" data-ng-click="Disable2FA()" class="btn btn-block btn-primary">Désactiver <i class="fa-regular fa-xmark"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSignOutAll" tabindex="-1" role="dialog" aria-labelledby="Authenticator as a two-factor" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Déconnectez-vous de tous les appareils</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group text-justify">
                            <span class="text-danger" data-ng-show="authValidateError">{{errorText}}</span>
                            <input type="password" id="UserCodeValidate" class="form-control form-control-sm mb-0" required data-ng-model="userPwd">
                            <span>Saisissez votre mot de passe afin de vous déconnectez de tous les appareils.</span>
                        </div>

                        <button type="button" aria-label="Activer" data-ng-click="SignOutAll()" class="btn btn-block btn-primary">Déconnectez <i class="fa-solid fa-skull-crossbones"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal 2FA -->
    </section>

<?php
   echo Footer_html("frontend", '<!-- Slick JS -->
   <script src="/assets/js/slick.min.js"></script>
   <!-- owl carousel Js -->
   <script src="/assets/js/owl.carousel.min.js"></script>
   <!-- select2 Js -->
   <script src="/assets/js/select2.min.js"></script>
   <!-- Magnific Popup-->
   <script src="/assets/js/jquery.magnific-popup.min.js"></script>
   <!-- Slick Animation-->
   <script src="/assets/js/slick-animation.min.js"></script>
   <!-- Flatpickr JavaScript -->
   <script src="/assets/js/flatpickr.min.js"></script>

   <!-- Videojs -->
   <link href="/assets/css/video-js.css" rel="stylesheet" />
   <link href="https://vod.dev/dist/videojs-http-source-selector.css" rel="stylesheet" />

   <script src="https://vjs.zencdn.net/7.4.1/video.js"></script>
   <script src="https://vod.dev/dist/videojs-http-source-selector.js"></script>
   <script src="https://vod.dev/dist/videojs-contrib-quality-levels.js"></script>');
   ob_end_flush();