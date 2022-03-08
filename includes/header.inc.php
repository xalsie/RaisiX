<?php
//àéè
defined('v1Secureraisix') or header('Location: /');

function Header_HTML($Title="", $panel=false, $IncludeHeader="", $IncludeFooter="", $controller = "appHeader") {
   $git = getGitVersion();

   $ret='<!doctype html>
<html lang="fr" ng-app="appRoot">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <title>Raisix - '.$Title.'</title>

      <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      RaisiX   -  Responsive Bootstrap 4
                                             Updated: '.$git[1].'

      Author                  : LeGrizzly#0341 - StarBeard#1310 - Ma4yGaHiH#1268
      Design and Developed by : LeGrizzly#0341 - StarBeard#1310 - Ma4yGaHiH#1268

      Support: https://discord.gg/YTxEJN3jxk
       _                _____          _               _         
      | |              / ____|        (_)             | |        
      | |        ___  | |  __   _ __   _   ____  ____ | |  _   _ 
      | |       / _ \ | | |_ | | \'__| | | |_  / |_  / | | | | | |
      | |____  |  __/ | |__| | | |    | |  / /   / /  | | | |_| |
      |______|  \___|  \_____| |_|    |_| /___| /___| |_|  \__, |
                                                            __/ |
                                                            |___/
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-K01N3EFBW2"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag("js", new Date());

         gtag("config", "G-K01N3EFBW2");
      </script>

      <!-- Import CSS -->
      '.$IncludeHeader.'

      <!-- Import JS -->
      '.Header_css($panel, $IncludeFooter).'

   </head>
<body ng-controller="'.$controller.'">';
  return $ret;
}

function Header_css($panel, $IncludeFooter = "") {
   $frontend = '<!-- Favicon -->
   <link rel="shortcut icon" href="/assets/images/favicon.ico" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
   <!-- Typography CSS -->
   <link rel="stylesheet" href="/assets/css/typography_frontend.css">
   <!-- Style -->
   <link rel="stylesheet" href="/assets/css/style_frontend.css" />
   <!-- Responsive -->
   <link rel="stylesheet" href="/assets/css/responsive_frontend.css" />
   
   <!-- jQuery, Popper JS -->
   <script src="/assets/js/jquery.min.js"></script>
   <script src="/assets/js/popper.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="/assets/js/bootstrap.min.js"></script>
   
   <!-- Import JS -->
   '.$IncludeFooter.'

   <!-- AngularJS Core -->
   <script src="/assets/js/angular.min.js"></script>
   <!-- AngularJS Script-->
   <script src="/assets/js/app-angular.js"></script>

   <!-- Custom JS-->
   <script src="/assets/js/custom_frontend.js"></script>
   ';
 
   $dashboard = '<!-- Favicon -->
   <link rel="shortcut icon" href="/assets/images/favicon.ico" />
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
   <!-- Typography CSS -->
   <link rel="stylesheet" href="/assets/css/typography_dashboard.css">
   <!-- Style -->
   <link rel="stylesheet" href="/assets/css/style_dashboard.css" />
   <!-- Responsive -->
   <link rel="stylesheet" href="/assets/css/responsive_dashboard.css" />
   <!-- Bootstrap Table -->
   <link rel="stylesheet" href="/assets/css/bootstrap-table.min.css">

   <!-- jQuery, Popper JS -->
   <script src="/assets/js/jquery.min.js"></script>
   <script src="/assets/js/popper.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="/assets/js/bootstrap.min.js"></script>
   <!-- Slick JS -->
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
   <!-- Custom JS-->
   <script src="/assets/js/custom_dashboard.js"></script>

   <!-- Import JS -->
   '.$IncludeFooter.'

   <!-- AngularJS Core -->
   <script src="/assets/js/angular.min.js"></script>
   <!-- AngularJS Script-->
   <script src="/assets/js/app-angular.js"></script>
   <!-- Moment With Locales JavaScript -->
   <script src="/assets/js/moment-with-locales.min.js"></script>
   <script type="text/javascript">moment.locale("fr");</script>

   <!-- Appear JavaScript -->
   <script src="/assets/js/jquery.appear.js"></script>
   <!-- Countdown JavaScript -->
   <script src="/assets/js/countdown.min.js"></script>
   <!-- Counterup JavaScript -->
   <script src="/assets/js/waypoints.min.js"></script>
   <script src="/assets/js/jquery.counterup.min.js"></script>
   <!-- Wow JavaScript -->
   <script src="/assets/js/wow.min.js"></script>
   <!-- Smooth Scrollbar JavaScript -->
   <script src="/assets/js/smooth-scrollbar.js"></script>
   <!-- apex Custom JavaScript -->
   <script src="/assets/js/apexcharts.js"></script>
   <!-- Chart Custom JavaScript -->
   <script src="/assets/js/chart-custom.js"></script>
   <!-- Bootstrap Table -->
   <script src="/assets/js/bootstrap-table.min.js"></script>
   <script src="/assets/js/bootstrap-table-locale-all.min.js"></script>
   ';
 
   if ($panel == "frontend") {
     return $frontend;
   } else if ($panel == "dashboard") {
     return $dashboard;
   }
}

function nav_bar_user() {
$rtn = '';
return $rtn;
}

function Header_header() {
  $rtn = '<header id="main-header" ng-controller="getAvatar">
   <div class="main-header">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <a href="#" class="navbar-toggler c-toggler" data-toggle="collapse"
                     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                     aria-expanded="false" aria-label="Toggle navigation">
                     <div class="navbar-toggler-icon" data-toggle="collapse">
                        <span class="navbar-menu-icon navbar-menu-icon--top"></span>
                        <span class="navbar-menu-icon navbar-menu-icon--middle"></span>
                        <span class="navbar-menu-icon navbar-menu-icon--bottom"></span>
                     </div>
                  </a>
                  <a class="navbar-brand" href="index.php"> <img class="img-fluid logo" src="/assets/images/logo.png"
                     alt="RaisiX logo" /> </a>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <div class="menu-main-menu-container">
                        <ul id="top-menu" class="navbar-nav ms-auto">
                           <li class="menu-item">
                              <a href="index.php">Accueil</a>
                           </li>
                           <li class="menu-item">
                           <a href="movie-category.php">Films</a>
                           </li>
                           <li class="menu-item">
                              <a href="show-category.php">Séries Tv</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="mobile-more-menu">
                     <a href="javascript:void(0);" class="more-toggle" id="dropdownMenuButton"
                        data-toggle="more-toggle" aria-haspopup="true" aria-expanded="false">
                     <i class="ri-more-line"></i>
                     </a>
                     <div class="more-menu" aria-labelledby="dropdownMenuButton">
                        <div class="navbar-right position-relative">
                           <ul class="d-flex align-items-center justify-content-end list-inline m-0">
                              <li>
                                 <a href="#" class="search-toggle">
                                 <i class="ri-search-line"></i>
                                 </a>
                                 <div class="search-box iq-search-bar">
                                    <form action="#" class="searchbox">
                                       <div class="form-group position-relative">
                                          <input type="text" class="text search-input font-size-12"
                                             placeholder="type here to search...">
                                          <i class="search-link ri-search-line"></i>
                                       </div>
                                    </form>
                                 </div>
                              </li>
                              <li class="nav-item nav-icon">
                                 <a href="#" class="search-toggle position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22"
                                       height="22" class="noti-svg">
                                       <path fill="none" d="M0 0h24v24H0z" />
                                       <path
                                          d="M18 10a6 6 0 1 0-12 0v8h12v-8zm2 8.667l.4.533a.5.5 0 0 1-.4.8H4a.5.5 0 0 1-.4-.8l.4-.533V10a8 8 0 1 1 16 0v8.667zM9.5 21h5a2.5 2.5 0 1 1-5 0z" />
                                    </svg>
                                    <span class="bg-danger dots"></span>
                                 </a>
                                 <div class="iq-sub-dropdown">
                                    <div class="iq-card shadow-none m-0">
                                       <div class="iq-card-body">
                                          <a href="#" class="iq-sub-card">
                                             <div class="media align-items-center">
                                                <img src="/assets/images/notify/thumb-1.jpg" class="img-fluid me-3"
                                                   alt="RaisiX" />
                                                <div class="media-body">
                                                   <h6 class="mb-0 ">Boop Bitty</h6>
                                                   <small class="font-size-12"> just now</small>
                                                </div>
                                             </div>
                                          </a>
                                          <a href="#" class="iq-sub-card">
                                             <div class="media align-items-center">
                                                <img src="/assets/images/notify/thumb-2.jpg" class="img-fluid me-3"
                                                   alt="RaisiX" />
                                                <div class="media-body">
                                                   <h6 class="mb-0 ">The Last Breath</h6>
                                                   <small class="font-size-12">15 minutes ago</small>
                                                </div>
                                             </div>
                                          </a>
                                          <a href="#" class="iq-sub-card">
                                             <div class="media align-items-center">
                                                <img src="/assets/images/notify/thumb-3.jpg" class="img-fluid me-3"
                                                   alt="RaisiX" />
                                                <div class="media-body">
                                                   <h6 class="mb-0 ">The Hero Camp</h6>
                                                   <small class="font-size-12">1 hour ago</small>
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <a href="#" class="iq-user-dropdown search-toggle d-flex align-items-center">
                                 <img ng-src="/assets/images/user/{{avatar}}" class="img-fluid avatar-40 cover rounded-circle"
                                    alt="user">
                                 </a>
                                 <div class="iq-sub-dropdown iq-user-dropdown">
                                    <div class="iq-card shadow-none m-0">
                                       <div class="iq-card-body p-0 pl-3 pr-3">
                                          <a href="/dashboard/dashboard.php" class="iq-sub-card setting-dropdown">
                                             <div class="media align-items-center">
                                                <div class="right-icon">
                                                   <i class="ri-settings-4-line text-primary"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0 ">Tableau de bord</h6>
                                                </div>
                                             </div>
                                          </a>
                                          <a href="/setting.php" class="iq-sub-card setting-dropdown">
                                             <div class="media align-items-center">
                                                <div class="right-icon">
                                                   <i class="ri-settings-4-line text-primary"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0 ">Réglage du compte</h6>
                                                </div>
                                             </div>
                                          </a>
                                          <a href="/pricing-plan.php" class="iq-sub-card setting-dropdown">
                                             <div class="media align-items-center">
                                                <div class="right-icon">
                                                   <i class="ri-settings-4-line text-primary"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0 ">Pricing Plan</h6>
                                                </div>
                                             </div>
                                          </a>
                                          <a href="/login.php?logout" class="iq-sub-card setting-dropdown">
                                             <div class="media align-items-center">
                                                <div class="right-icon">
                                                   <i class="ri-logout-circle-line text-primary"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                   <h6 class="mb-0">Se déconnecter</h6>
                                                </div>
                                             </div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="navbar-right menu-right">
                     <ul class="d-flex align-items-center list-inline m-0">
                        <li class="nav-item nav-icon">
                           <a href="#" class="search-toggle device-search">
                           <i class="ri-search-line"></i>
                           </a>
                           <div class="search-box iq-search-bar d-search">
                              <form action="#" class="searchbox">
                                 <div class="form-group position-relative">
                                    <input type="text" class="text search-input font-size-12"
                                       placeholder="type here to search...">
                                    <i class="search-link ri-search-line"></i>
                                 </div>
                              </form>
                           </div>
                        </li>
                        <li class="nav-item nav-icon">
                           <a href="#" class="search-toggle" data-toggle="search-toggle">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22"
                              class="color-svg"
                              ng-class="{\'noti-svg\': notifMap._count}">
                                 <path fill="none" d="M0 0h24v24H0z" />
                                 <path
                                    d="M18 10a6 6 0 1 0-12 0v8h12v-8zm2 8.667l.4.533a.5.5 0 0 1-.4.8H4a.5.5 0 0 1-.4-.8l.4-.533V10a8 8 0 1 1 16 0v8.667zM9.5 21h5a2.5 2.5 0 1 1-5 0z" />
                              </svg>
                              <span class="bg-danger" ng-class="{\'dots\': notifMap._count}"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body">
                                    <a href="/movie-details.php?id={{row.id}}" id="{{row.id}}" class="iq-sub-card" ng-repeat="row in notifMap.datas">
                                       <div class="media align-items-center">
                                          <div class="noti-img">
                                             <img ng-src="{{tmdbConf.images_uri}}{{row.poster_path}}" class="img-fluid me-3" alt="RaisiX" />
                                          </div>
                                          <div class="media-body ml-2">
                                             <h6 class="mb-0 ">{{row.title}}</h6>
                                             <small class="font-size-12">{{row.date_create | fromNow}}</small>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li class="nav-item nav-icon">
                           <a href="#" class="iq-user-dropdown search-toggle p-0 d-flex align-items-center"
                              data-toggle="search-toggle">
                           <img ng-src="/assets/images/user/{{avatar}}" class="img-fluid avatar-40 cover rounded-circle" alt="user">
                           </a>
                           <div class="iq-sub-dropdown iq-user-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 pl-3 pr-3">
                                    <a href="/dashboard/dashboard.php" class="iq-sub-card setting-dropdown">
                                       <div class="media align-items-center">
                                          <div class="right-icon">
                                             <i class="ri-settings-4-line text-primary"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Tableau de bord</h6>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="setting.php" class="iq-sub-card setting-dropdown">
                                       <div class="media align-items-center">
                                          <div class="right-icon">
                                             <i class="ri-settings-4-line text-primary"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Réglage du compte</h6>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="pricing-plan.php" class="iq-sub-card setting-dropdown">
                                       <div class="media align-items-center">
                                          <div class="right-icon">
                                             <i class="ri-settings-4-line text-primary"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Pricing Plan</h6>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="login.php?logout" class="iq-sub-card setting-dropdown">
                                       <div class="media align-items-center">
                                          <div class="right-icon">
                                             <i class="ri-logout-circle-line text-primary"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Se déconnecter</h6>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>
               <div class="nav-overlay"></div>
            </div>
         </div>
      </div>
   </div>
   </header>';
  return $rtn;
}

function Header_loader() {
  $rtn = '<div id="loading">
      <div id="loading-center">
      </div>
   </div>';
  return $rtn;
}

function Footer_HTML($panel=false, $IncludeFooter="") {
  $ret = '<footer class="mb-0">
      <div class="container-fluid">
        <div class="block-space">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                  <ul class="f-link list-unstyled mb-0">
                    <li><a href="#">About Us</a></li>
                    <li><a href="movie-category.php">Movies</a></li>
                    <li><a href="show-category.php">Tv Shows</a></li>
                    <li><a href="#">Coporate Information</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 col-md-4">
                  <ul class="f-link list-unstyled mb-0">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Help</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 col-md-4">
                  <ul class="f-link list-unstyled mb-0">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Cotact Us</a></li>
                    <li><a href="#">Legal Notice</a></li>
                  </ul>
              </div>
              <div class="col-lg-3 col-md-12 r-mt-15">
                  <div class="d-flex">
                    <a href="#" class="s-icon">
                    <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="#" class="s-icon">
                    <i class="ri-skypr-fill"></i>
                    </a>
                    <a href="#" class="s-icon">
                    <i class="ri-linkedin-fill"></i>
                    </a>
                    <a href="#" class="s-icon">
                    <i class="ri-whatsapp-fill"></i>
                    </a>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <div class="copyright py-2">
        <div class="container-fluid">
            <p class="mb-0 text-center font-size-14 text-body">RaisiX - 2020 All Rights Reserved</p>
        </div>
      </div>
  </footer>
  <!-- MainContent End-->
  <!-- back-to-top -->
  <div id="back-to-top">
      <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
  </div>
  <!-- back-to-top End -->

  '.footer_css($panel, $IncludeFooter).'

  </body>
</html>';
  return $ret;
}

function footer_css($panel, $IncludeFooter = "") {
   $frontend = '';
 
   $dashboard = '';

   if ($panel == "frontend") {
     return $frontend;
   } else if ($panel == "dashboard") {
     return $dashboard;
   }
}

function getGitVersion() {
   $version = trim(exec('git log --pretty="%h" -n1 HEAD'));
   $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
     $date = $commitDate->setTimezone(new \DateTimeZone('UTC'))->add(new DateInterval("PT2H"))->format('d-m H:i');
   
   return array($version, $date);
 }