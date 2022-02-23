<?php
include_once("../includes/inc.php");

isConnected(true);

echo Header_HTML("RaisiX - Erreur 500", "dashboard");
?>
        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>
        <!-- loader END -->
        <!-- Wrapper Start -->
        <div class="wrapper">
            <div class="container pt-5">
                <div class="row no-gutters height-self-center">
                    <div class="col-sm-12 text-center align-self-center">
                        <div class="iq-error position-relative">
                            <img src="/assets/images/error/500.png" class="img-fluid iq-error-img" alt="">
                            <h1 class="text-in-box">500</h1>
                            <h2 class="mb-0">Oups! Cette page ne fonctionne pas.</h2>
                            <p>La demande est une erreur de serveur interne.</p>
                            <a class="btn btn-block btn-danger mt-3" href="/index.php"><i class="ri-home-4-line" style="vertical-align: bottom;"></i>Retourner à l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wrapper END -->

<?php
   echo Footer_css("dashboard");
?>