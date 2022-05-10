<?php
include_once("includes/inc.php");

isConnected(true);

echo Header_HTML("Movie", "frontend", "<link href='/assets/css/video-js.css' rel='stylesheet'/> <link href='/assets/css/video-js-netflix.css' rel='stylesheet'/> <link href='/assets/css/videojs-http-source-selector.css' rel='stylesheet' />", "<!-- Videojs -->
   <script src='/assets/js/videojs.min.js'></script>
   <script src='/assets/js/videojs-contrib-hls.js'></script>
   <script src='/assets/js/videojs-contrib-quality-levels.js'></script>
   <script src='/assets/js/videojs-http-source-selector.js'></script>

   <script src='/assets/js/videojs-event-tracking.js'></script>
   
   <!-- Slick JS -->
   <script src='/assets/js/slick.min.js'></script>
   <!-- owl carousel Js -->
   <script src='/assets/js/owl.carousel.min.js'></script>
   <!-- select2 Js -->
   <script src='/assets/js/select2.min.js'></script>
   <!-- Magnific Popup-->
   <script src='/assets/js/jquery.magnific-popup.min.js'></script>
   <!-- Slick Animation-->
   <script src='/assets/js/slick-animation.min.js'></script>
   <!-- Flatpickr JavaScript -->
   <script src='/assets/js/flatpickr.min.js'></script>
   <!-- Moment With Locales JavaScript -->
   <script src='/assets/js/moment-with-locales.min.js'></script>
   <script type='text/javascript'>moment.locale('fr');</script>", "appMovieDetail");
?>

      <!-- loader Start -->
<?php echo Header_loader(); ?>
      <!-- loader END -->
      <!-- Header -->
<?php echo Header_header(); ?>
      <!-- Header End -->

   <!-- Banner Start -->
   <!-- <div class="video-container"> -->
   <section class="pt-6 instructions">
      <video id="my-video"
            class="video-js vjs-default-skin"
            controls
            preload="none"
            height="500">
         <source src="/assets/video/intro_2022/master.m3u8" type='application/x-mpegURL'/>
      </video>
   </section>
   <!-- Banner End -->

   <!-- MainContent -->
   <div class="main-content movie">
      <section class="movie-detail container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="trending-info g-border">
                  <h1 class="trending-text big-title text-uppercase mt-0">{{responseMap.original_title}}</h1>
                  <div class="d-flex align-items-center text-white text-detail">
                     <span class="ml-3">{{displayGenres(responseMap.genres, ', ')}}</span>
                  </div>
                  <div class="d-flex align-items-center text-white text-detail">
                     <span class="badge badge-secondary p-3">{{responseMap.vote_average}}</span>
                     <span class="ml-3">{{responseMap.runtime | formatTime}}</span>
                     <span class="trending-year">{{responseMap.release_date | limitTo: 4}}</span>

                  </div>
                  <!-- <div class="d-flex align-items-center series mb-4">
                     <a href="javascript:void();"><img src="/assets/images/trending/trending-label.png" class="img-fluid"
                           alt=""></a>
                     <span class="text-gold ml-3">#2 in Series Today</span>
                  </div> -->
                  <p class="trending-dec w-100 mb-0">{{responseMap.overview}}</p>
                  <ul class="list-inline p-0 mt-4 share-icons music-play-lists">
                     <li><span><i class="ri-add-line"></i></span></li>
                     <li><span><i class="ri-heart-fill"></i></span></li>
                     <li class="share">
                        <span><i class="ri-share-fill"></i></span>
                        <div class="share-box">
                           <div class="d-flex align-items-center">
                              <a href="#" class="share-ico"><i class="ri-facebook-fill"></i></a>
                              <a href="#" class="share-ico"><i class="ri-twitter-fill"></i></a>
                              <a href="#" class="share-ico"><i class="ri-links-fill"></i></a>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>

            <div class="col-12 mb-4" id="listActors">
               <div class="row">

                  <div class="col-lg-2 col-md-6 col-12 mt-4" data-ng-repeat="actor in credits.cast | limitTo: 15">
                     <div class="team text-center rounded p-1">
                        <img ng-src="https://image.tmdb.org/t/p/w185{{actor.profile_path}}" class="img-fluid avatar avatar-120 shadow rounded-pill" alt="">
                        <div class="content mt-2">
                              <h4 class="title mb-0">{{actor.character}}</h4>
                              <p class="text-muted">{{actor.name}}</p>
                        </div>
                     </div>
                  </div><!--end col-->

               </div><!--end row-->
            </div>
         </div>
      </section>
      <section id="iq-favorites" class="s-margin">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12 overflow-hidden">
                  <div class="iq-main-header d-flex align-items-center justify-content-between">
                     <h4 class="main-title">More Like This</h4>
                     <a href="movie-category.html" class="text-primary">View all</a>
                  </div>
                  <div class="favorites-contens">
                     <ul class="list-inline favorites-slider row p-0 mb-0">
                        <li class="slide-item">
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/movies/06.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>The Lost Journey</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">20+</div>
                                       <span class="text-white">2h 15m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/movies/07.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Boop Bitty</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">11+</div>
                                       <span class="text-white">2h 30m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/movies/08.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Unknown Land</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">17+</div>
                                       <span class="text-white">2h 30m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/movies/09.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Blood Block</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">13+</div>
                                       <span class="text-white">2h 40m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/movies/10.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Champions</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">13+</div>
                                       <span class="text-white">2h 30m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                          Play
                                          Now</span>
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
   </div>

<?php
   echo Footer_html("frontend",'<!-- Moment With Locales JavaScript -->
   <script src="/assets/js/moment-with-locales.min.js"></script>
   <script type="text/javascript">moment.locale("fr");</script>');
?>