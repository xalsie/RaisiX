<?php
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
                        <h4 class="mt-4 mb-3">{{settingMap.firstname}} {{settingMap.lastname}}</h4>
                        <p>{{settingMap.description}}</p>
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
                                <input ng-show="editLine5" type="text" class="form-control form-control-sm mb-0 date-input basicFlatpickr flatpickr-input" id="inputWeek" placeholder="Date de naissance" value="" readonly="readonly">
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
                                <select ng-show="editLine6" class="form-control form-control-sm mb-0" id="exampleFormControlSelect1">
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

                        <div class="row align-items-center justify-content-end mb-3">
                            <div class="col-md-auto text-md-right text-left">
                                <button ng-show="btnSave" type="button" class="btn btn-outline-success" data-ng-click="saveSetting()">Enregistrer</button>
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4 pb-3 a-border">Détails de la facturation</h5>
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-8 r-mb-15">
                                <p>Votre prochaine date de facturation est le 19 septembre 2022.</p>
                                <a href="#" class="btn btn-hover">Annuler l'adhésion</a>
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a href="#" class="text-primary slick-arrow">Mettre à jour les informations de paiement</a>
                            </div>
                        </div>
                        <h5 class="mb-3 mt-4 pb-3 a-border">Détails du forfait</h5>
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-8">
                                <p>Prime</p>                                
                            </div>
                            <div class="col-md-4 text-md-right text-left">
                                <a href="pricing-plan.php" class="text-primary slick-arrow">Modifier le Plan</a>
                            </div>
                        </div>
                        <h5 class="mb-3 pb-3 mt-4 a-border">Réglage</h5>
                        <div class="row">
                            <div class="col-12 setting">
                                <a href="#" class="text-body d-block mb-1">Activité récente de diffusion en continu sur l'appareil</a>
                                <a href="#" class="text-body d-block mb-1">Déconnectez-vous de tous les appareils</a>
                                <a href="#" class="text-body d-block">Déconnectez-vous de tous les appareils</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
   <!-- Moment With Locales JavaScript -->
   <script src="/assets/js/moment-with-locales.min.js"></script>
   <script type="text/javascript">moment.locale("fr");</script>

   <!-- Videojs -->
   <link href="/assets/css/video-js.css" rel="stylesheet" />
   <link href="https://vod.dev/dist/videojs-http-source-selector.css" rel="stylesheet" />

   <script src="https://vjs.zencdn.net/7.4.1/video.js"></script>
   <script src="https://vod.dev/dist/videojs-http-source-selector.js"></script>
   <script src="https://vod.dev/dist/videojs-contrib-quality-levels.js"></script>');
?>