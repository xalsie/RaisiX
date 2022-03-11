<?php
include_once("includes/inc.php");

isConnected(true);

echo Header_HTML("Movie", "frontend", "<link href='/assets/css/video-js.css' rel='stylesheet'/> <link href='/assets/css/videojs-http-source-selector.css' rel='stylesheet' />", "<!-- Videojs -->
   <script src='/assets/js/videojs.min.js'></script>
   <script src='/assets/js/videojs-contrib-quality-levels.js'></script>
   <script src='/assets/js/videojs-http-source-selector.js'></script>
   
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
   <script src='/assets/js/flatpickr.min.js'></script>", "appMovieDetail");
?>

      <!-- loader Start -->
<?php echo Header_loader(); ?>
      <!-- loader END -->
      <!-- Header -->
<?php echo Header_header(); ?>
      <!-- Header End -->

   <!-- Banner Start -->
   <div class="video-container iq-main-slider video-js skin-1 video-1-dimensions vjs-controls-enabled vjs-workinghover vjs-v7 vjs-paused vjs-user-inactive">
      <video id="my-video"
            class="vjs-tech"
            controls
            playsinline>

         <source src="/assets/video/uncharted_2022/bmw_4k_master.m3u8" type='application/x-mpegURL'/>
      </video>
   </div>
   <!-- Banner End -->

   <!-- MainContent -->
   <div class="main-content movi">
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
                     <h4 class="main-title">Upcoming Movies</h4>
                     <a href="movie-category.html" class="text-primary">View all</a>
                  </div>
                  <div class="upcoming-contens">
                     <ul class="favorites-slider list-inline  row p-0 mb-0">
                        <li class="slide-item">
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/upcoming/01.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>The Last Breath</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">5+</div>
                                       <span class="text-white">2h 30m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/upcoming/02.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Last Night</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">22+</div>
                                       <span class="text-white">2h 15m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/upcoming/03.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>1980</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">25+</div>
                                       <span class="text-white">3h</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/upcoming/04.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Looters</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">11+</div>
                                       <span class="text-white">2h 45m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
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
                           <a href="movie-details.html">
                              <div class="block-images position-relative">
                                 <div class="img-box">
                                    <img src="/assets/images/upcoming/05.jpg" class="img-fluid" alt="">
                                 </div>
                                 <div class="block-description">
                                    <h6>Vugotronic</h6>
                                    <div class="movie-time d-flex align-items-center my-2">
                                       <div class="badge badge-secondary p-1 mr-2">9+</div>
                                       <span class="text-white">2h 30m</span>
                                    </div>
                                    <div class="hover-buttons">
                                       <span class="btn btn-hover">
                                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
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
      </section>
   </div>

<?php
   echo Footer_html("frontend",'<!-- Moment With Locales JavaScript -->
   <script src="/assets/js/moment-with-locales.min.js"></script>
   <script type="text/javascript">moment.locale("fr");</script>');
?>