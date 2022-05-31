<?php
include_once("../includes/inc.php");

isConnected(true);
   
echo Header_HTML("Tableau de bord - Ajouter film", "dashboard", '<link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">');
?>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <!-- Wrapper Start -->
   <div class="wrapper">
      <!-- Sidebar  -->
      <div class="iq-sidebar">
         <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="/" class="header-logo">
               <img src="/assets/images/logo.png" class="rounded-normal" alt="logo image raisix">
            </a>
            <div class="iq-menu-bt-sidebar">
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="las la-bars"></i></div>
                  </div>
               </div>
            </div>
         </div>
         <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  <li><a href="./dashboard.php" class="iq-waves-effect"><i class="las la-home iq-arrow-left"></i><span>Tableau de bord</span></a></li>
                  <li><a href="rating.html" class="iq-waves-effect"><i class="las la-star-half-alt"></i><span>Notation</span></a></li>
                  <li><a href="comment.html" class="iq-waves-effect"><i class="las la-comments"></i><span>Commenter</span></a></li>
                  <li><a href="./tab-users.php" class="iq-waves-effect"><i class="las la-user-friends"></i><span>Utilisateur</span></a></li>
                  <li><a href="movie-request.php" class="iq-waves-effect"><i class="las la-plus"></i><span>Demande de film</span></a></li>
                  <li>
                     <a href="#category" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-list-ul"></i><span>Catégorie</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="add-category.html"><i class="las la-user-plus"></i>Ajouter une catégorie</a></li>
                        <li><a href="category-list.html"><i class="las la-eye"></i>Liste des catégories</a></li>
                     </ul>
                  </li>
                  <li class="active active-menu">
                     <a href="#movie" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="true"><i class="las la-film"></i><span>Films</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="movie" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                        <li class="active"><a href="movie-add.php"><i class="las la-user-plus"></i>Ajouter un film</a></li>
                        <li><a href="movie-list.php"><i class="las la-eye"></i>Liste des films</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="#show" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-film"></i><span>Séries</span><i class="ri-arrow-right-s-line iq-arrow-right"></i>
                     </a>
                     <ul id="show" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="add-show.html"><i class="las la-user-plus"></i>Ajouter une séries</a></li>
                        <li><a href="show-list.html"><i class="las la-eye"></i>Liste une séries</a></li>
                     </ul>
                  </li>
                  <li><a href="pages-pricing.html" class="iq-waves-effect"><i class="ri-price-tag-line"></i><span>Tarification</span></a></li>
               </ul>
            </nav>
         </div>
      </div>
      <!-- TOP Nav Bar -->
      <div class="iq-top-navbar">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="iq-search-bar ml-auto">
                  <form action="#" class="searchbox">
                     <input type="text" class="text search-input" placeholder="Search Here...">
                     <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                  </form>
               </div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto navbar-list">
                     <li class="nav-item nav-icon search-content">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-search-line"></i>
                        </a>
                        <form action="#" class="search-box p-0">
                           <input type="text" class="text search-input" placeholder="Type here to search...">
                           <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        </form>
                     </li>
                     <li class="nav-item nav-icon">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-notification-2-line"></i>
                           <span class="bg-primary dots"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">All Notifications<small
                                          class="badge  badge-light float-right pt-1">4</small></h5>
                                 </div>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/01.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Emma Watson Barry</h6>
                                          <small class="float-right font-size-12">Just Now</small>
                                          <p class="mb-0">95 MB</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/02.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">New customer is join</h6>
                                          <small class="float-right font-size-12">5 days ago</small>
                                          <p class="mb-0">Cyst Barry</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/03.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Two customer is left</h6>
                                          <small class="float-right font-size-12">2 days ago</small>
                                          <p class="mb-0">Cyst Barry</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/04.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">New Mail from Fenny</h6>
                                          <small class="float-right font-size-12">3 days ago</small>
                                          <p class="mb-0">Cyst Barry</p>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="nav-item nav-icon dropdown">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                           <i class="ri-mail-line"></i>
                           <span class="bg-primary dots"></span>
                        </a>
                        <div class="iq-sub-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">All Messages<small
                                          class="badge  badge-light float-right pt-1">5</small></h5>
                                 </div>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/01.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Barry Emma Watson</h6>
                                          <small class="float-left font-size-12">13 Jun</small>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/02.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                          <small class="float-left font-size-12">20 Apr</small>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/03.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Why do we use it?</h6>
                                          <small class="float-left font-size-12">30 Jun</small>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/04.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Variations Passages</h6>
                                          <small class="float-left font-size-12">12 Sep</small>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="#" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <div class="">
                                          <img class="avatar-40 rounded" src="../assets/images/user/05.jpg" alt="">
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                          <small class="float-left font-size-12">5 Dec</small>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="line-height pt-3">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                           <img src="../assets/images/user/1.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello Barry Tech</h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div>
                                 <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                          <p class="mb-0 font-size-12">View personal profile details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                          <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-lock-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Privacy Settings</h6>
                                          <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign out<i
                                          class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
      <!-- Page Content  -->
      <div id="content-page" class="content-page" ng-controller="appAddMovie">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Ajouter un film</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                           <a href="./movie-list.php" class="btn btn-primary">Liste des films</a>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="row mb-4">
                           <div class="col-lg-7">
                              <div class="row">
                                 <div class="col-12 form-group input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Saisir le titre du film" ng-model="tmdbData" aria-label="Saisir le titre du film" aria-describedby="title-movie">

                                    <div class="input-group-text">
                                       <button class="btn btn-outline-secondary" data-ng-click="tmdb_search()" type="button">Recherche</button>
                                    </div>
                                 </div>

                                 <div class="col-12 form-group input-group mb-3" ng-show="tmdbDetailsResult">
                                    <select class="form-control" id="exampleFormControlSelect1" ng-model="tmdbDataSelect">
                                       <option ng-cloak ng-repeat="details in tmdbDetailsResult" value="{{details.id}}">{{details.original_title}}</option>
                                    </select>
                                 </div>

                                 <div class="col-12 form-group" ng-show="tmdbDetailsResult">
                                    <button type="button" class="btn btn-info btn-block" data-ng-click="getInfoMovie()">Valide</button>
                                 </div>

                              </div>
                              <div class="row" ng-show="tmdbDetailsShow">
                                 <div class="col-md-6 form-group">
                                    <select class="form-control" id="formSelectGenres" multiple>
                                       <option disabled>Genres</option>
                                       <option ng-repeat="genres in tmdbDetails.info.genres" value="{{genres.id}}" disabled selected>{{genres.name}}</option>
                                    </select>
                                 </div>
                                 
                                 <div class="col-sm-6 form-group">
                                    <input type="text" class="form-control" placeholder="Année de sortie" value="{{todatefr(tmdbDetails.info.release_date)}}">
                                 </div>

                                 <div class="col-12 form-group">
                                    <textarea id="text" name="text" rows="5" class="form-control"
                                       placeholder="Description">{{tmdbDetails.info.overview}}</textarea>
                                 </div>

                                 <div class="col-12 form-group">
                                    <div class="col-sm form-group">
                                       <select class="form-control" id="formSelectVideo" ng-model="videoSelect">
                                          <option disabled selected>Bande-annonce</option>
                                          <option ng-repeat="video in tmdbDetails.videos.results" value="{{video.key}}">{{video.name}} - {{video.site}}</option>
                                       </select>
                                    </div>

                                    <div class="col-12">
                                       <iframe width="560" height="315" ng-src="{{videoSelect | iframeVideoYtb}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>

                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-5" ng-show="tmdbDetailsShow">
                              <div class="col-sm form-group">
                                 <select class="form-control" id="formSelectPoster" ng-model="posterSelected">
                                    <option disabled selected>Affiches</option>
                                    <option ng-repeat="poster in tmdbDetails.images.posters" value="{{poster.file_path}}">[{{poster.iso_639_1}}] - {{poster.width}}x{{poster.height}} - {{poster.file_path}}</option>
                                 </select>
                              </div>
                              <div class="d-block position-relative mb-3">
                                 <div class="form_video-upload" style="position: relative; text-align: center;">
                                    <img ng-src="{{tmdbConf.images_uri}}{{posterSelected}}" class="img-fluid" alt="tmdb info picture" style="width: 80%;">
                                 </div>
                              </div>

                              <div class="col-sm form-group">
                                 <select class="form-control" id="formSelectBackdrop" ng-model="backdropSelected">
                                    <option disabled selected>Toiles de fond</option>
                                    <option ng-repeat="backdrop in tmdbDetails.images.backdrops" value="{{backdrop.file_path}}">[{{backdrop.iso_639_1}}] - {{poster.width}}x{{poster.height}} - {{backdrop.file_path}}</option>
                                 </select>
                              </div>
                              <div class="d-block position-relative">
                                 <div class="form_video-upload" style="position: relative; text-align: center;">
                                    <img ng-src="{{tmdbConf.images_uri}}{{backdropSelected}}" class="img-fluid" alt="tmdb info picture" style="width: 80%;">
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row" data-ng-show="tmdbDetailsShow">
                           <div class="col-12 mb-4" id="listActors">
                              <div class="row">


                                 <div class="col-lg-2 col-md-6 col-12 mt-4" data-ng-repeat="actor in tmdbDetails.credits.cast | limitTo: 15">
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


                           <div class="col-sm form-group">
                              <select class="form-control" id="formSelectQualite" multiple ng-model="qualiteSelected">
                                 <option disabled>Qualités</option>
                                 <option value="1">SD - 480p</option>
                                 <option value="2">HD - 720p</option>
                                 <option value="3">BluRay - 1080p</option>
                                 <option value="4">2K - 1440p</option>
                                 <option value="4">4K - 2160p</option>
                              </select>
                           </div>
                           <div class="col-sm form-group">
                              <select class="form-control" id="formSelectStatus" ng-model="statusSelected">
                                 <option disabled selected>Statut</option>
                                 <option value="1">A venir</option>
                                 <option value="2">Publié</option>
                              </select>
                           </div>
                           <div class="col-sm form-group">
                              <select class="form-control" id="formSelectLanguage" multiple ng-model="languageSelected">
                                 <option disabled>Langue</option>
                                 <option value="1">English</option>
                                 <option value="2">Francais</option>
                              </select>
                           </div>


                           <div class="col-sm-12 form-group">
                              <select class="form-control" id="formSelectPathFile" multiple ng-model="pathFileSelected">
                                 <option disabled selected>Dossier du film</option>
                                 <option ng-repeat="pathmovie in tmdbDetails.path" value="{{pathmovie}}">{{pathmovie}}</option>
                              </select>
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-12 form-group ">
                              <button type="button" data-ng-click="submitMovie()" class="btn btn-primary" ng-show="tmdbDetailsShow">Submit</button>
                              <button type="reset" data-ng-click="resetMovie()" class="btn btn-danger">cancel</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Wrapper END -->

   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="privacy-policy.html" target="blank">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="terms-of-service.html" target="blank">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">Copyright 2022 <a href="/" target="blank">RaisiX</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
   <!-- Footer END -->

<?php
   echo Footer_css("dashboard");