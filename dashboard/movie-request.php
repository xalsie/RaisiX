<?php
include_once("../includes/inc.php");

isConnected(true);
verifniv(15,false,array(2,3));

echo Header_HTML("Tableau de bord - Liste des demandes films", "dashboard", '<link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">', "", 'appHeader');
?>
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   <style>
   .table-hover tbody tr:hover {
      color: var(--iq-primary);
      background-color: #00000013;
   }
   </style>
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
                  <li class="active active-menu"><a href="movie-request.php" class="iq-waves-effect"><i class="las la-plus"></i><span>Demande de film</span></a></li>
                  <li>
                     <a href="#category" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-list-ul"></i><span>Catégorie</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="add-category.html"><i class="las la-user-plus"></i>Ajouter une catégorie</a></li>
                        <li><a href="category-list.html"><i class="las la-eye"></i>Liste des catégories</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="#movie" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-film"></i><span>Films</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                     <ul id="movie" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li><a href="movie-add.php"><i class="las la-user-plus"></i>Ajouter un film</a></li>
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

      <!-- TOP Nav Bar START -->
      <?php
         echo Header_header('dashboard');
      ?>
      <!-- TOP Nav Bar END -->

      <!-- Page Content  -->
      <div id="content-page" class="content-page">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Liste des demandes de films</h4>
                        </div>
                     </div>
                     <div id="toolbar">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           + Proposer un film
                        </button>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-view">
                           <table class="data-tables table-striped table-borderless table-sm table-responsive-sm"
                              data-toggle="table"
                              id="table"
                              data-toolbar="#toolbar"
                              data-search="true"
                              data-show-refresh="true"
                              data-show-columns="true"
                              data-show-columns-toggle-all="true"
                              data-show-export="true"
                              data-detail-formatter="detailFormatter"
                              data-minimum-count-columns="2"
                              data-id-field="id"

                              data-silent-sort="true"

                              data-pagination="true"
                              data-page-list="[5, 10, 25, 50, 100, all]"
                              data-page-size="5"

                              data-url="/assets/js/app-server.php"
                              data-method="post"
                              data-query-params="postQueryParams"
                              data-content-type="application/x-www-form-urlencoded">
                              <thead>
                                 <tr>
                                    <th data-field="id" data-width="100" data-sortable="true" data-halign="center" data-visible="false">ID</th>
                                    
                                    <th data-field="name" data-sortable="true" data-halign="center">Nom du film</th>
                                    <th data-field="date-release" data-sortable="true" data-halign="center">Date</th>
                                    <th data-field="langage" data-sortable="true" data-halign="center" data-formatter="languageFormatter">langage</th>

                                    <th data-field="pseudo" data-sortable="true" data-halign="center">Demandeur</th>
                                    <th data-field="pseudo" data-sortable="true" data-halign="center">Nombre de vote</th>
                                    
                                    <th data-field="action" data-width="150" data-halign="center" data-align="center" data-formatter="actionFormatter" data-events="actionEvents">Actions</th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="/assets/js/app-server.php">
                  <div class="form-group">
                     <label for="exampleFormControlInput1">Nom du film</label>
                     <input type="text" class="form-control" name="exampleFormControlInput1" id="exampleFormControlInput1" placeholder="Venom">
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlInput1">Date de sortie</label>
                     <input type="text" class="form-control" name="exampleFormControlInput2" id="exampleFormControlInput2" placeholder="2018">
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlSelect2">Language Souhaité</label>
                     <select class="form-control" multiple name="exampleFormControlSelect1" id="exampleFormControlSelect1">
                        <option>Francais</option>
                        <option>Anglais</option>
                        <option>VO</option>
                        <option>VOSTFR</option>
                     </select>
                  </div>

                  <button type="submit" class="btn btn-block btn-primary">Save changes</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Wrapper END -->

   <script>
      // var $ = jQuery;

      function initTable() {
         var $table = $('#table');

         $table.bootstrapTable('destroy').bootstrapTable({
            locale: "fr-FR"
         })
      }

      function postQueryParams(params) {
            params.action = "getListRequestMovie";
            return params;
      }

      function actionFormatter(value, row, index) {
         return '<div class="flex align-items-center list-user-action">'+
               '      <a class="iq-bg-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>'+
               '      <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>'+
               '   </div>';
      }

      function posterFormatter(value, row, index) {
         return '<div class="iq-movie">'+
               '  <img src="/assets/images/movie-poster'+row["poster_path"]+'" class="img-border-radius avatar-40 img-fluid" alt="">'+
               '</div>';
      }

      function titleFormatter(value, row, index) {
         return '<div class="media-body text-left ml-3">'+
               '   <p class="mb-0">'+row["original_title"]+'</p>'+
               '   <small>'+row["vote_average"]+' - '+formatTime(row["runtime"])+'</small>'+
               '</div>';
      }

      function qualityFormatter(value, row, index) {
         
      }

      function languageFormatter(value, row, index) {

      }

      function genresFormatter(value, row, index) {
         return displayGenres(value, ", ");
      }

      function overviewFormatter(value, row, index) {
         return "<small>"+value.substr(0, 75)+"...</small>";
      }

      function displayGenres(genres, separator) {
         if (genres == undefined) return "";
         const obj = JSON.parse(genres);
         const count = Object.keys(obj).length;
         var _rtn = "";
         for (var key in obj) {
            if (key != count-1)
               _rtn += obj[key].name+separator;
            else
               _rtn += obj[key].name;
         }
         return _rtn;
      }

      function formatTime(date) {
         if (date == undefined) return "";
         const h = Math.floor(date / 60);
         const m = Math.round(date % 60)
         return [
         h, "h ",
         m > 9 ? m : (h ? '0' + m : m || '0'), "m"
         ].filter(Boolean).join("");
      }

      function formNow(x) {
         return moment(x, "YYYY-MM-DD hh:mm:ss").fromNow();
      }

      window.actionEvents = {
         'click .btn-remove': function (e, value, row, index) {
            // console.log("Remove : "+row["login"]);
            console.log(row);
            //   ShowDeleteUser(row);
         },'click .btn-edit': function (e, value, row, index) {
            console.log("Edit : "+row["id"]);
            //   ShowEditUser(row);
         }
      };

      $("#btn-add").click(function () {
         console.log();
      });

      $('#table').on('dbl-click-row.bs.table', function (e, row, element, field) {
         console.log(row);
      });

      $(() => {
         initTable();

         $("form").submit(function(event) {
            var send=$.ajax({
               method: 'POST',
               url:'/assets/js/app-server.php',
               data: {
                  autofunc: false,
                  action: 'saveMovieRequest',
                  nameMovie: $("#exampleFormControlInput1").val(),
                  dateRelease: $("#exampleFormControlInput2").val(),
                  langage: $("#exampleFormControlSelect1").val()
               }
            }).done(function(html){
               if(html != 'OK') {
                  $('#exampleModal').modal('hide')
                  console.log('Une erreur s\'est produite lors de l\'enregistrement de la demande de film !');
               } else {
                  $('#exampleModal').modal('hide')
                  $('#table').bootstrapTable('refresh');
               }
            }).fail(function(){
               console.log('Une erreur s\'est produite lors de l\'enregistrement de la demande de film !');
            });

            event.preventDefault();
         });
      })
   </script>

   <!-- Footer -->
   <footer class="iq-footer">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6">
               <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
               </ul>
            </div>
            <div class="col-lg-6 text-right">
               Copyright 2022 <a href="./">RaisiX</a> All Rights Reserved.
            </div>
         </div>
      </div>
   </footer>
   <!-- Footer END -->

<?php
   echo footer_css("dashboard");
?>