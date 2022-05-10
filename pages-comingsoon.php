<?php
include_once("includes/inc.php");

isConnected(true);

echo Header_HTML("Coming Soon!", "frontend", '<link rel="stylesheet" href="/assets/css/typography_dashboard.css">', '<!-- Moment With Locales JavaScript -->
<script type="text/javascript" src="/assets/js/moment-with-locales.min.js"></script>
<script type="text/javascript">moment.locale("fr");</script>
<script type="text/javascript" src="/assets/js/countdown.min.js"></script>

');
?>

      <!-- loader Start -->
<?php // echo Header_loader(); ?>
      <!-- loader END -->
      <!-- Header -->
<?php echo Header_header(); ?>
      <!-- Header End -->

      <!-- Wrapper Start -->
      <div class="wrapper">
        <div class="" style="padding-top: 150px">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-sm-8 text-center">
                <div class="iq-comingsoon-info">
                  <a href="/">
                    <img src="/assets/images/logo-full.png" class="img-fluid w-25" alt="">
                  </a>
                  <h2 class="mt-4 mb-1">Restez connectés, nous lançons très bientôt</h2>
                  <p>Nous travaillons très dur pour vous offrir la meilleure expérience possible !</p>
                  <ul class="countdown d-flex align-items-center list-inline" data-date="June 08 2022 23:59:59">
                    <li class="col-md-6 col-lg-3">
                      <div class="iq-card">
                        <div class="iq-card-body">
                          <span data-days>0</span>Jours
                        </div>
                      </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                      <div class="iq-card">
                        <div class="iq-card-body">
                          <span data-hours>0</span>Heures
                        </div>
                      </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                      <div class="iq-card">
                        <div class="iq-card-body">
                          <span data-minutes>0</span>Minutes
                        </div>
                      </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                      <div class="iq-card">
                        <div class="iq-card-body">
                          <span data-seconds>0</span>Secondes
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Wrapper END -->

  </body>
</html>