<?php
include_once("includes/inc.php");

isConnected(true);

echo Header_HTML("Forfaits et tarifs", "frontend", "<link rel='stylesheet' href='/assets/css/animated-success.css'/>", '<!-- Slick JS -->
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

    <style>
        .main-container {
            font-size: 24px;
            width: 100%;
            /* height: 100vh; */
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }
        .check-container {
            width: 6.25rem;
            height: 7.5rem;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: space-between;
        }
        .check-container .check-background {
            width: 100%;
            height: calc(100% - 1.25rem);
            background: linear-gradient(to bottom right, #5de593, #41d67c);
            box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            transform: scale(0.84);
            border-radius: 50%;
            animation: animateContainer 0.75s ease-out forwards 0.75s;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
        }
        .check-container .check-background svg {
            width: 65%;
            transform: translateY(0.25rem);
            stroke-dasharray: 80;
            stroke-dashoffset: 80;
            animation: animateCheck 0.35s forwards 1.25s ease-out;
        }

        @keyframes animateContainer {
            0% {
                opacity: 0;
                transform: scale(0);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }
            25% {
                opacity: 1;
                transform: scale(0.9);
                box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }
            43.75% {
                transform: scale(1.15);
                box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
            }
            62.5% {
                transform: scale(1);
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
            }
            81.25% {
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }
            100% {
                opacity: 1;
                box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
            }
        }
        @keyframes animateCheck {
            from {
                stroke-dashoffset: 80;
            }
            to {
                stroke-dashoffset: 0;
            }
        }
        @keyframes animateShadow {
            0% {
                opacity: 0;
                width: 100%;
                height: 15%;
            }
            25% {
                opacity: 0.25;
            }
            43.75% {
                width: 40%;
                height: 7%;
                opacity: 0.35;
            }
            100% {
                width: 85%;
                height: 15%;
                opacity: 0.25;
            }
        }
    </style>

    <section class="m-profile" data-ng-controller="appPricing">
        <div class="container" data-ng-show="princingPlan">
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
                                        <th class="text-center" scope="row">Accès au Films /<br> Accès au Séries</th>
                                        <td class="text-center child-cell align-middle"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell align-middle active"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell align-middle"><i class="ri-check-line ri-2x"></i></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Plucité sur le site</th>
                                        <td class="text-center child-cell align-middle"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell align-middle active"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell align-middle"><i class="ri-close-line i_close"></i></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Plucité au début de la vidéo</th>
                                        <td class="text-center child-cell align-middle"><i class="ri-check-line ri-2x"></i></td>
                                        <td class="text-center child-cell align-middle active"><i class="ri-close-line i_close"></i></td>
                                        <td class="text-center child-cell align-middle"><i class="ri-close-line i_close"></i></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Qualité disponible</th>
                                        <td class="text-center child-cell align-middle">SD (480p)</td>
                                        <td class="text-center child-cell align-middle active">HD (720p)</td>
                                        <td class="text-center child-cell align-middle">4K (2160p)</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">Nombre d'écrans <br> disponibles en simultané</th>
                                        <td class="text-center child-cell align-middle">2</i></td>
                                        <td class="text-center child-cell align-middle active">3</td>
                                        <td class="text-center child-cell align-middle">5</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=1; princingPlan=fasle; princingCart=true">Acheté</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=2; princingPlan=fasle; princingCart=true">Acheté</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-hover mt-3" data-ng-click="princingChoise=3; princingPlan=fasle; princingCart=true">Acheté</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-0" data-ng-show="princingCart">
            <div class="wrapper">
                <div class="card sign-user_card px-4">
                    <p class="h8 py-3">Configurez votre carte de paiement</p>

                    <div class="row gx-3" data-ng-show="objectCart" data-ng-init="displayCartLocal()">
                        <div class="col-12">
                            <p class="py-3">Carte de crédit enregistrer.</p>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-color text-light" role="alert" data-ng-repeat="(key, cart) in objectCart">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col"><p class="font-weight-bold">{{cart.name}}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="font-weight-light">{{cart.number}} - {{cart.date}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 align-self-sm-center">
                                        <button type="button" class="btn text-right text-light p-0 pb-1" data-toggle="modal" data-target="#modalCartConfirmCVV" data-ng-click="utilCart(cart.id, key)">Utiliser</button>
                                        <button type="button" class="btn text-right text-light p-0" data-ng-click="toSuppCart(cart.id, key)">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gx-3">
                        <div class="col-12">
                            <p class="py-3">Ajouter une Carte de crédit.</p>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Nom / Prénom</p>
                                <input class="form-control mb-3" type="text" data-ng-model="pricing_cart_name" placeholder="Nom / Prénom" value="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Numéro de carte</p>
                                <input class="form-control mb-3" data-ng-model="pricing_cart_num_cart" placeholder=".... .... .... ...." data-slots="." data-accept="\d" size="19">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Date d'expiration (MM/YY)</p>
                                <input class="form-control mb-3" type="text" data-ng-model="pricing_cart_date" placeholder="MM/YY">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Cryptogramme (CVV)</p>
                                <input class="form-control mb-3 pt-2" type="password" placeholder="***" size="3">
                            </div>
                        </div>
                        <div class="col-12 text-right pb-2">
                            <div class="form-check d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="pricing_remember_cart" name="pricing_remember_cart" data-ng-model="pricing_remember_cart">
                                <label class="custom-control-label" for="pricing_cart">Se souvenir de la carte</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-color text-light" role="alert">
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
                            <button type="button" class="btn btn-primary mb-3" data-ng-click="toPay()">
                                <span class="ps-3">Activer mon abonnement payant</span>
                                <span class="fas fa-arrow-right"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container p-0 success-payment" data-ng-show="successPayment">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-4">Paiement Réussi</h1>
                <div class="main-container">
                    <div class="check-container">
                        <div class="check-background">
                            <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <!-- <div class="check-shadow"></div> -->
                    </div>
                </div>
                <p class="lead">Merci ! Votre paiement est terminé et un e-mail de confirmation de paiement a été envoyé à votre adresse e-mail enregistrée.</p>
            </div>
        </div>

        <div class="modal fade" id="modalCartConfirmCVV" tabindex="-1" role="dialog" aria-labelledby="Authenticator as a two-factor" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmer le cryptogramme (CVV) de votre carte</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="col-12">
                            <div class="alert" data-ng-show="error">
                                <li style='color:red'>{{errorText}}</li>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-color text-light" role="alert">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col"><p class="font-weight-bold">{{utilCartName}}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="font-weight-light">{{utilCartNumber}} - {{utilCartDate}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 align-self-sm-center">
                                        <button type="button" class="btn text-right text-light p-0 pb-1" data-dismiss="modal" aria-label="Close">Changer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-column">
                                <p class="text mb-1">Cryptogramme (CVV)</p>
                                <input class="form-control mb-3 pt-2" type="password" data-ng-model="pricing_modal_cvv" placeholder="***" size="3">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-color text-light" role="alert">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col"><p class="font-weight-bold">{{pricingOption[princingChoise][0]}}</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><p class="font-weight-light">Forfait {{pricingOption[princingChoise][1]}}</p></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 align-self-sm-center"><button type="button" class="btn text-right text-light" data-dismiss="modal" aria-label="Close" data-ng-click="princingChoise=0">Changer</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mb-3" data-ng-click="toPay(true)">
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
   ob_end_flush();
?>