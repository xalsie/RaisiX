<?php
include_once("includes/inc.php");

isConnected(true);

echo Header_HTML("Home", "frontend", "", '<!-- Slick JS -->
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

      <!-- loader Start -->
<?php // echo Header_loader(); ?>
      <!-- loader END -->
      <!-- Header -->
<?php echo Header_header(); ?>
      <!-- Header End -->
    <!-- MainContent -->
    <section class="m-profile" data-ng-controller="appPricing">
        <div class="container" data-ng-show="!princingChoise">
            <h4 class="main-title mb-4">Forfaits et tarifs</h4>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="sign-user_card">
                        <div class="table-responsive pricing pt-2">
                            <table id="my-table" class="table text-light">
                                <thead>
                                    <tr>
                                        <th class="text-center prc-wrap"></th>
                                        <th class="text-center prc-wrap">
                                            <div class="prc-box">
                                                <div class="h3 pt-4 text-white">19 €<small> / Par mois</small></div>
                                                <span class="type">Basic</span>
                                            </div>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="prc-box active">
                                                <div class="h3 pt-4 text-white">39 €<small> / Par mois</small></div>
                                                <span class="type">Standard</span>
                                            </div>
                                        </th>
                                        <th class="text-center prc-wrap">
                                            <div class="prc-box">
                                                <div class="h3 pt-4 text-white">119 €<small> / Par mois</small></div>
                                                <span class="type">Premium</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row">Accès au Films</th>
                                        <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Accès au Séries</th>
                                        <td class="text-center child-cell"><i class="ri-close-line i_close"></i></td>
                                        <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Nombre d'écrans disponibles en simultané</th>
                                        <td class="text-center child-cell">1</i></td>
                                        <td class="text-center child-cell active">2</td>
                                        <td class="text-center child-cell">4</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Qualité disponible</th>
                                        <td class="text-center child-cell">SD (480p)</td>
                                        <td class="text-center child-cell active">HD (720p)</td>
                                        <td class="text-center child-cell">4K (2160p)</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Pas de plucité</th>
                                        <td class="text-center child-cell"><i class="ri-close-line i_close"></i></td>
                                        <td class="text-center child-cell active"><i class="ri-close-line i_close"></i></td>
                                        <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=1">Acheté</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=2">Acheté</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=3">Acheté</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-0" data-ng-show="princingChoise">
            <div class="wrapper">
                    <div class="card sign-user_card px-4">
                    <p class="h8 py-3">Configurez votre carte de paiement</p>
                    <div class="row gx-3">
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Nom / Prénom</p>
                                <input class="form-control mb-3" type="text" data-ng-model="remember_cart_name" placeholder="Nom / Prénom" value="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Numéro de carte</p>
                                <input class="form-control mb-3" data-ng-model="remember_cart_num_cart" placeholder=".... .... .... ...." data-slots="." data-accept="\d" size="19">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Date d'expiration (MM/YY)</p>
                                <input class="form-control mb-3" type="text" data-ng-model="remember_cart_date" placeholder="MM/YY">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Cryptogramme (CVV)</p>
                                <input class="form-control mb-3 pt-2" type="password" placeholder="***" size="3">
                            </div>
                        </div>
                        <div class="col-12 text-right pb-2">
                            <div class="custom-control custom-checkbox d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="remember_cart" name="remember_cart" data-ng-model="remember_cart">
                                <label class="custom-control-label" for="remember_cart">Se souvenir de la carte</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert text-light" role="alert">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col"><p class="font-weight-bold">{{pricingOption[princingChoise][0]}}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p class="font-weight-light">Forfait {{pricingOption[princingChoise][1]}}</p></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 align-self-sm-center"><button type="button" class="btn text-right text-light" data-ng-click="princingChoise=0">Changer</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pb-3 pt-2">
                            <p class="text-muted">
                                En cliquant sur le bouton "Activer mon abonnement payant" ci-dessous, vous acceptez nos Conditions d'utilisation, reconnaissez avoir plus de 18 ans et prenez acte de la Déclaration de confidentialité. Vous acceptez que votre abonnement commence immédiatement et renoncez à votre droit de rétractation. Netflix renouvelle automatiquement votre abonnement et prélève les frais correspondants (actuellement {{pricingOption[princingChoise][0]}}) via le mode de paiement choisi, sauf résiliation de votre part. Vous pouvez annuler votre abonnement à tout moment pour éviter tout prélèvement ultérieur.
                            </p>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mb-3" data-ng-click="test()">
                                <span class="ps-3">Activer mon abonnement payant</span>
                                <span class="fas fa-arrow-right"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
                    const pattern = el.getAttribute("placeholder"),
                        slots = new Set(el.dataset.slots || "_"),
                        prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
                        first = [...pattern].findIndex(c => slots.has(c)),
                        accept = new RegExp(el.dataset.accept || "\\d", "g"),
                        clean = input => {
                            input = input.match(accept) || [];
                            return Array.from(pattern, c =>
                                input[0] === c || slots.has(c) ? input.shift() || c : c
                            );
                        },
                        format = () => {
                            const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                                i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                                return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                            });
                            el.value = clean(el.value).join``;
                            el.setSelectionRange(i, j);
                            back = false;
                        };
                    let back = false;
                    el.addEventListener("keydown", (e) => back = e.key === "Backspace");
                    el.addEventListener("input", format);
                    el.addEventListener("focus", format);
                    el.addEventListener("blur", () => el.value === pattern && (el.value=""));
                }
            });
        </script>
    </section>

<?php
   echo Footer_html("frontend");
?>