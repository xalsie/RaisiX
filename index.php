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
<?php echo Header_loader(); ?>
      <!-- loader END -->
      <!-- Header -->
<?php echo Header_header(); ?>
      <!-- Header End -->
         <!-- Slider Start -->

      <style>
         .fade {
            animation-name: fade;
            animation-duration: 2s;
         }

         @keyframes fade {
            from {
               opacity: 0;
            }
            to {
               opacity: 1;
            }
         }

         section#home,
         div#home-slider {
            min-height: 550px;
            /* max-height: 550px; */
            background-color: var(--iq-body-bg);
         }
      </style>

      <!-- Angularjs slick - http://vasyabigi.github.io/angular-slick/ -->
      <style>
         [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
            display: none !important;
         }
      </style>
      <section id="home" class="iq-main-slider p-0 fade show" data-ng-init="getDatasSlider()" data-ng-cloak>
         <div id="home-slider" class="slider m-0 p-0 fade show" ng-show="slideLoaded">

         <!-- slider section repeat -->
            <div class="slide slick-bg margin-nav" style="background-image: url(/assets/images/movie-backdrop{{movie.backdrop_path}});" ng-repeat="movie in sliderMap.datas">
               <div class="container-fluid position-relative h-100">
                  <div class="slider-inner h-100">
                     <div class="row align-items-center h-100">
                        <div class="col-xl-8 col-lg-12 col-md-12">
                           <!-- <a href="javascript:void(0);">
                              <div class="channel-logo" data-animation-in="fadeInLeft" data-delay-in="0.5">
                                 <img data-lazy="/assets/images/logo-full.png" class="c-logo" alt="RaisiX">
                              </div>
                           </a> -->
                           <div style="width: 0;height: 15vh;"></div>
                           <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft" data-delay-in="0.6">{{movie.title}}</h1>
                           <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                              <!-- <span class="badge badge-secondary p-2">18+</span> -->
                              <span class="badge badge-secondary p-2">{{movie.vote_average}}</span>
                              <!-- <span class="ml-3">2 Seasons</span> -->
                              <span class="ml-3">{{movie.runtime | formatTime}}</span>
                              <span class="ml-3">{{displayGenres(movie.genres, ', ')}}</span>
                           </div>
                           <p class="slider-overview" data-animation-in="fadeInUp" data-delay-in="1.2">{{movie.overview | limitTo: 255}}...</p>
                           <div data-ng-show="movie.status == 2" class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp" data-delay-in="1.5">
                              <a data-ng-href="/movie-details.php?id={{movie.id}}" class="btn btn-hover"><i class="fa fa-play mr-2"
                                 aria-hidden="true"></i>Voir maintenant</a>
                              <a data-ng-href="/movie-details.php?id={{movie.id}}" class="btn btn-link">Plus de détails</a>
                           </div>
                           <div data-ng-show="movie.status == 1" class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp" data-delay-in="1.5">
                              <a data-ng-href="/movie-details.php?id={{movie.id}}" class="btn btn-link">Bientot Disponnible.</a>
                           </div>
                        </div>
                     </div>
                     <div class="trailor-video" ng-if="movie.video">
                        <a data-ng-href="{{movie.video | iframeVideoYtb}}" class="video-open playbtn">
                           <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                              x="0px" y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7"
                              enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                              <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-miterlimit="10"
                                 points="73.5,62.5 148.5,105.8 73.5,149.1 " />
                              <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8" r="103.3" />
                           </svg>
                           <span class="w-trailor">Voir la bande-annonce</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         <!-- END slider -->
         </div>

         <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
               fill="none" stroke="currentColor">
               <circle r="20" cy="22" cx="22" id="test"></circle>
            </symbol>
         </svg>
      </section>
      <!-- Slider End -->
      <!-- MainContent -->
      <div class="main-content">
         <!-- <section data-ng-hide="true" id="iq-favorites">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Vos favoris</h4>
                        <a href="movie-category.php" class="text-primary">Voir tous</a>
                     </div>
                     <div class="favorites-contens" data-ng-init="">
                        <ul class="favorites-slider list-inline  row p-0 mb-0">
                           <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/favorite/01.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Champions</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">13+</div>
                                          <span class="text-white">2h 30m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/favorite/02.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Last Race</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">7+</div>
                                          <span class="text-white">2 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/favorite/03.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Boop Bitty</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">15+</div>
                                          <span class="text-white">2h 30m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/favorite/04.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Dino Land</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">18+</div>
                                          <span class="text-white">3 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/favorite/05.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Jaction action</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">10+</div>
                                          <span class="text-white">1 Season</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->
         <section id="iq-upcoming-movie">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Films à venir</h4>
                        <a href="movie-category.php" class="text-primary">Voir tous</a>
                     </div>
                     <div class="upcoming-contens" data-ng-init="getUpcomingMovies()">
                        <ul class="favorites-slider list-inline row p-0 mb-0">
                           <!-- <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img src="/assets/images/upcoming/01.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>The Last Breath</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">5+</div>
                                          <span class="text-white">2h 30m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li> -->
                           <li class="slide-item" ng-repeat="movie in upComingMovies.datas">
                              <a data-ng-href="/movie-details.php?id={{movie.id}}">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/movie-backdrop{{movie.backdrop_path}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>{{movie.title | limitTo: 25}}</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-2 me-2">{{movie.vote_average}}</div>
                                          <span class="text-white ml-3">{{movie.runtime | formatTime}}</span>
                                       </div>
                                       <!-- <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div> -->
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <!-- <li><span><i class="ri-volume-mute-fill"></i></span></li> -->
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- <section data-ng-hide="true" id="iq-topten">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title topten-title-sm">Top 10 in India</h4>
                     </div>
                     <div class="topten-contens">
                        <h4 class="main-title topten-title">Top 10 in India</h4>
                        <ul id="top-ten-slider" class="list-inline p-0 m-0  d-flex align-items-center">
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/01.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/02.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/03.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/04.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/05.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                           <li>
                              <a href="movie-details.php">
                              <img src="/assets/images/top-10/06.jpg" class="img-fluid w-100" alt="">
                              </a>
                           </li>
                        </ul>
                        <div class="vertical_s">
                           <ul id="top-ten-slider-nav" class="list-inline p-0 m-0  d-flex align-items-center">
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/01.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>The Illusion</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">10+</div>
                                          <span class="text-white">3h 15m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/02.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>Burning</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">13+</div>
                                          <span class="text-white">2h 20m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/03.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>Hubby Kubby</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">9+</div>
                                          <span class="text-white">2h 40m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/04.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>Open Dead Shot</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">16+</div>
                                          <span class="text-white">1h 40m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/05.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>Jumbo Queen</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">15+</div>
                                          <span class="text-white">3h</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <div class="block-images position-relative">
                                    <a href="movie-details.php">
                                    <img src="/assets/images/top-10/06.jpg" class="img-fluid w-100" alt="">
                                    </a>
                                    <div class="block-description">
                                       <h5>The Lost Journey</h5>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">20+</div>
                                          <span class="text-white">2h 15m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <a href="movie-details.php" class="btn btn-hover" tabindex="0">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i> Play Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->
         <section id="iq-movie">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Films disponible</h4>
                        <a href="movie-category.php" class="text-primary">Voir tous</a>
                     </div>
                     <div class="movie-list-contens" data-ng-init="getMovies()">
                        <ul class="movie-list-slider favorites-slider list-inline row p-0 mb-0">
                           <li class="slide-item" ng-repeat="movie in moviesList.datas">
                              <a data-ng-href="/movie-details.php?id={{movie.id}}">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/movie-backdrop{{movie.backdrop_path}}" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>{{movie.title | limitTo: 25}}</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-2 me-2">{{movie.vote_average}}</div>
                                          <span class="text-white ml-3">{{movie.runtime | formatTime}}</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover">
                                          <i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now
                                          </span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <!-- <li><span><i class="ri-volume-mute-fill"></i></span></li> -->
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="iq-suggestede" class="s-margin">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Suggestions pour vous</h4>
                        <a href="show-category.php" class="text-primary">Voir tous</a>
                     </div>
                     <div class="suggestede-contens">
                        <ul class="list-inline favorites-slider row p-0 mb-0">
                           <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/suggested/01.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Blood Block</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">11+</div>
                                          <span class="text-white">2h 30m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/suggested/02.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Mission Moon</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">9+</div>
                                          <span class="text-white">2 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/suggested/03.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Unknown Land</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">17+</div>
                                          <span class="text-white">2h 30m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/suggested/04.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Friends</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">19+</div>
                                          <span class="text-white">3 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="movie-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/suggested/05.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Inside the Sea</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">13+</div>
                                          <span class="text-white">2h 40m</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="parallex" class="parallax-window">
            <div class="container-fluid h-100">
               <div class="row align-items-center justify-content-center h-100 parallaxt-details">
                  <div class="col-lg-4 r-mb-23">
                     <div class="text-left">
                        <a href="javascript:void(0);">
                        <img src="/assets/images/parallax/parallax-logo.png" class="img-fluid" alt="bailey">
                        </a>
                        <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                           <ul
                              class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                              <li>
                                 <a href="javascript:void(0);" class="text-primary">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void(0);" class="text-primary">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void(0);" class="text-primary">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void(0);" class="text-primary">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void(0);" class="pl-2 text-primary">
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                 </a>
                              </li>
                           </ul>
                           <span class="text-white ml-3">9.2 (lmdb)</span>
                        </div>
                        <div class="movie-time d-flex align-items-center mb-3">
                           <div class="badge badge-secondary me-3">13+</div>
                           <h6 class="text-white">2h 30m</h6>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
                        <div class="parallax-buttons">
                           <a href="movie-details.php" class="btn btn-hover">Play Now</a>
                           <a href="movie-details.php" class="btn btn-link">More details</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="parallax-img">
                        <a href="movie-details.php">
                           <img src="/assets/images/parallax/p1.jpg" class="img-fluid w-100" alt="bailey">
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="iq-tvthrillers" class="s-margin">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 overflow-hidden">
                     <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Séries TV</h4>
                        <a href="show-category.php" class="text-primary">Voir tous</a>
                     </div>
                     <div class="tvthrillers-contens">
                        <ul class="favorites-slider list-inline row p-0 mb-0">
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-/assets/images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/tvthrillers/01.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Day of Darkness</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">15+</div>
                                          <span class="text-white">2 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/tvthrillers/02.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>My True Friends</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">7+</div>
                                          <span class="text-white">2 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/tvthrillers/03.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Arrival 1999</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">11+</div>
                                          <span class="text-white">3 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/tvthrillers/04.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>Night Mare</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">18+</div>
                                          <span class="text-white">3 Seasons</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                           <li class="slide-item">
                              <a href="show-details.php">
                                 <div class="block-images position-relative">
                                    <div class="img-box">
                                       <img data-lazy="/assets/images/tvthrillers/05.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="block-description">
                                       <h6>The Marshal King</h6>
                                       <div class="movie-time d-flex align-items-center my-2">
                                          <div class="badge badge-secondary p-1 me-2">17+</div>
                                          <span class="text-white">1 Season</span>
                                       </div>
                                       <div class="hover-buttons">
                                          <span class="btn btn-hover"><i class="fa fa-play me-1" aria-hidden="true"></i>
                                          Play Now</span>
                                       </div>
                                    </div>
                                    <div class="block-social-info">
                                       <ul class="list-inline p-0 m-0 music-play-lists">
                                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                          <li><span><i class="ri-heart-fill"></i></span></li>
                                          <li><span><i class="ri-add-line"></i></span></li>
                                       </ul>
                                    </div>
                                 </div>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>

<?php
   echo Footer_html("frontend");
   ob_end_flush();
?>