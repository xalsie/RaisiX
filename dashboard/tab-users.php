<?php
include_once("../includes/inc.php");

isConnected(true);
verifniv(15,false,false);

echo Header_HTML("Tableau de bord - Liste des utilisateurs", "dashboard", '<link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
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
                  <li class="active active-menu"><a href="./tab-users.php" class="iq-waves-effect"><i class="las la-user-friends"></i><span>Utilisateur</span></a></li>
                  <li><a href="movie-request.php" class="iq-waves-effect"><i class="las la-plus"></i><span>Demande de film</span></a></li>
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
                           <h4 class="card-title">Liste des utilisateurs</h4>
                        </div>
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
                              data-page-size="10"

                              data-url="/assets/js/app-server.php"
                              data-method="post"
                              data-query-params="postQueryParams"
                              data-content-type="application/x-www-form-urlencoded">
                              <thead>
                                 <tr>
                                    <th data-field="action" data-width="70" data-halign="center" data-align="center" data-formatter="actionFormatter" data-events="actionEvents">Actions</th>

                                    <th data-field="id" data-width="100" data-sortable="true" data-halign="center" data-visible="false">ID</th>
                                    <th data-field="date_create" data-sortable="true" data-halign="center" data-visible="false">date de création</th>
                                    <th data-field="date_modification" data-sortable="true" data-halign="center" data-visible="false">date de modification</th>
                                    <th data-field="firstname" data-sortable="true" data-halign="center" data-align="center">Prenom</th>
                                    <th data-field="lastname" data-sortable="true" data-halign="center" data-align="center">Nom</th>
                                    <th data-field="email" data-width="100" data-sortable="true" data-halign="center">Mail</th>
                                    <th data-field="check_email" data-sortable="true" data-halign="center" data-align="center" data-formatter="toCheckbox">Mail confirmé</th>
                                    <th data-field="date_modification_pw" data-sortable="true" data-halign="center" data-visible="false">date de modification du MDP</th>
                                    <th data-field="role" data-sortable="true" data-halign="center">Role</th>
                                    <th data-field="auth_fa" data-sortable="true" data-halign="center" data-align="center" data-formatter="toCheckbox">2FA</th>

                                    <th data-field="date_modification" data-sortable="true" data-halign="center" data-visible="false">date de modification du profil</th>
                                    <th data-field="pseudo" data-sortable="true" data-halign="center">Pseudo</th>
                                    <th data-field="avatar" data-sortable="true" data-halign="center" data-align="center" data-formatter="imgView">Avatar</th>
                                    <th data-field="langue" data-sortable="true" data-halign="center" data-visible="false">Langue</th>
                                    <th data-field="date_naissance" data-sortable="true" data-halign="center" data-visible="false">date de naissance</th>
                                    <th data-field="description" data-sortable="true" data-halign="center" data-visible="false">Description de l'utilisateur</th>
                                    <th data-field="payment_date" data-sortable="true" data-halign="center">Dernier prélèvement</th>
                                    <th data-field="payment_choise" data-sortable="true" data-halign="center" data-align="center" data-formatter="toPayment">Statut du compte</th>
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

   <div class="modal fade" id="modalActionUsers" tabindex="-1" aria-labelledby="modalActionUsers" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalActionUsersLabel">Action sur un compte utilisateur</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <i class="fa-solid fa-xmark-large"></i>
               </button>
            </div>
            <div class="modal-body">
               <div>
                  <div class="action" style="display: none;">
                     <input type="text" name="formControlIndex" id="formControlIndex" disabled>
                  </div>

                  <div class="row align-items-center">
                     <div class="col">
                        <div class="form-group text-center">
                           <label>Edité</label>

                           <button type="submit" class="btn btn-primary form-control btn-edit" data-toggle="modal" data-target="#modalEditUsers">Edité <i class="ri-pencil-line"></i></button>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group text-center">
                           <label>Supprimé</label>

                           <button type="submit" class="btn btn-primary form-control btn-remove" data-toggle="modal" data-target="#modalDeleteUsers">Supprimé ! <i class="ri-delete-bin-line"></i></button>
                        </div>
                     </div>
                  </div>
                  <div class="row align-items-center">
                     <div class="col">
                        <div class="form-group text-center">
                           <label>Renvoyé le mail de confirmation</label>

                           <button type="submit" id="btn-send-mail" class="btn btn-primary form-control">Renvoyé ! <i class="ri-delete-bin-line"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalDeleteUsers" tabindex="-1" aria-labelledby="modalDeleteUsers" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalDeleteUsersLabel">Suppression du compte</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <i class="fa-solid fa-xmark-large"></i>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="/assets/js/app-server.php">
                  <div class="action" style="display: none;">
                     <input type="text" name="formControlAction" class="formControlAction" disabled>
                     <input type="text" name="formControlId" class="formControlId" disabled>
                  </div>
                  <div class="form-group">
                     <label for="formControlFirstname">Prenom</label>
                     <input type="text" class="form-control" name="formControlFirstname" id="formControlFirstname" disabled>
                  </div>
                  <div class="form-group">
                     <label for="formControlLastname">Nom</label>
                     <input type="text" class="form-control" name="formControlLastname" id="formControlLastname" disabled>
                  </div>
                  <div class="form-group">
                     <label for="formControlEmail">Mail</label>
                     <input type="text" class="form-control" name="formControlEmail" id="formControlEmail" disabled>
                  </div>

                  <button type="submit" class="btn btn-block btn-primary">Supprimé !</button>
               </form>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modalEditUsers" tabindex="-1" aria-labelledby="modalEditUsers" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalEditUsersLabel">Edition du compte</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <i class="fa-solid fa-xmark-large"></i>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="/assets/js/app-server.php">
                  <div class="action" style="display: none;">
                     <input type="text" name="formControlAction" class="formControlAction" disabled>
                     <input type="text" name="formControlId" class="formControlId" disabled>
                  </div>
                  <div class="form-row ml-0 mr-0">
                     <div class="col-md-6 order-md-1">
                        <div class="form-row">
                           <label for="formControlEditLastname">Nom</label>
                           <input type="text" class="form-control" id="formControlEditLastname" name="formControlEditLastname">
                        </div>
                        <div class="form-row">
                           <label for="formControlEditFirstname">Prenom</label>
                           <input type="text" class="form-control" id="formControlEditFirstname" name="formControlEditFirstname">
                        </div>
                     </div>
                     <div class="col-md-6 order-md-2">
                        <div class="form-group mb-0 text-center">
                           <button type="button" class="btn btn-sm btn-warning btn-delete-avatar mb-2">Supprimé <i class="fa-solid fa-xmark-large"></i></button>
                           <img id="formControlEditImg" name="formControlEditImg" width="200" class="rounded mx-auto d-block" alt="dev">
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="formControlEditPseudo">Pseudo</label>
                     <input type="text" class="form-control" id="formControlEditPseudo" name="formControlEditPseudo" placeholder="">
                  </div>
                  <div class="form-group">
                     <label for="formControlEditMail">Email</label>
                     <input type="email" class="form-control" id="formControlEditMail" name="formControlEditMail" placeholder="">
                  </div>
                  <div class="form-group">
                     <label for="formControlEditDescription">Description</label>
                     <textarea class="form-control" id="formControlEditDescription" name="formControlEditDescription" placeholder=""></textarea>
                  </div>

                  <div class="align-items-center form-row">
                     <div class="col-md-6 text-center">
                        <button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal" aria-label="Close">Annulé</button>
                     </div>
                     <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-block btn-primary">Enregistré</button>
                     </div>
                  </div>
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
            params.action = "getListUsers";
            return params;
      }

      function actionFormatter(value, row, index) {
         return '<div class="flex align-items-center list-user-action">'+
               '      <a class="iq-bg-success btn-action" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="fa-regular fa-user-gear"></i></a>'+
               '   </div>';
      }

      function toCheckbox(value, row, index) {
         if (value == "1")
            return '<i class="far fa-check me-1" style="color:green"></i>';
         else
            return '<i class="far fa-ban me-1" style="color:Tomato"></i>';
      }

      function toPayment(value, row, index) {
         $rtn = "";
         switch (value) {
            case '0':
               $rtn = "Free";
               break;
            case '1':
               $rtn = "Basic";
               break;
            case '2':
               $rtn = "Standard";
               break;
            case '3':
               $rtn = "Premium";
               break;
            default:
               $rtn = "Free";
               break;
         }

         return $rtn;
      }

      function imgView(value, row, index) {
         if (value)
            return '<img src="/assets/images/user/'+value+'" class="rounded" width="64" alt="Image user '+row["id"]+'">';
         else
            return '<i class="far fa-ban me-1" style="color:Tomato"></i>';
      }

      window.actionEvents = {
         'click .btn-action': function (e, value, row, index) {
            //   ShowEditUser(row);
            var modal = $('#modalActionUsers')
               modal.modal('show')
               modal.find('#formControlIndex').val(index)
         }
      };

      $('.btn-remove').click(() => {
         var row = $("#table").bootstrapTable("getData")[$("#formControlIndex").val()];

         var modal = $('#modalDeleteUsers')
            modal.modal('show')
            modal.find('.formControlAction').val("deleteUser")
            modal.find('.formControlId').val(row["id"])
            modal.find('#formControlFirstname').val(row["firstname"])
            modal.find('#formControlLastname').val(row["lastname"])
            modal.find('#formControlEmail').val(row["email"])
      })

      $(".btn-edit").click(() => {
         var row = $("#table").bootstrapTable("getData")[$("#formControlIndex").val()];

         var modal = $('#modalEditUsers')
            modal.modal('show')
            modal.find('.formControlAction').val("editUser")
            modal.find('.formControlId').val(row["id"])

            modal.find('#formControlEditFirstname').val(row["firstname"])
            modal.find('#formControlEditLastname').val(row["lastname"])
            modal.find('#formControlEditMail').val(row["email"])
            modal.find('#formControlEditPseudo').val(row["pseudo"])
            modal.find('#formControlEditDescription').val(row["description"])

            if (row["avatar"]) modal.find('#formControlEditImg').attr('src', "/assets/images/user/"+row["avatar"]).attr("data-avatar", row["avatar"])
               else modal.find('#formControlEditImg').attr('src', "//dummyimage.com/200x200/363636/fff").attr("data-avatar", "user.jpg")
      })

      $(".btn-delete-avatar").click(() => {
         var modal = $('#modalEditUsers')
            modal.find('#formControlEditImg').attr('src', "/assets/images/user/user.jpg").attr("data-avatar", "user.jpg")
      })

      $("#btn-send-mail").click(() => {
         var row = $("#table").bootstrapTable("getData")[$("#formControlIndex").val()];

         var send=$.ajax({
               method: 'POST',
               url:'/assets/js/app-server.php',
               data: {
                  autofunc: false,
                  action: 'sendMail',
                  id: row["id"],
                  email: row["email"]
               }
            })
      })

      $(() => {
         initTable();

         $("form").submit(function(event) {
            event.preventDefault();
            var param = {};
            
            if ($(this).find(".formControlAction").val() == 'deleteUser') {
               param = {
                  autofunc: false,
                  action: 'deleteUser',
                  id: $(this).find('.formControlId').val().trim()
               }
            } else if ($(this).find(".formControlAction").val() == 'editUser') {
               param = {
                  autofunc: false,
                  action: 'editUser',
                  id: $(this).find('.formControlId').val().trim(),

                  firstname: $(this).find('#formControlEditFirstname').val().trim(),
                  lastname: $(this).find('#formControlEditLastname').val().trim(),
                  email: $(this).find('#formControlEditMail').val().trim(),
                  pseudo: $(this).find('#formControlEditPseudo').val().trim(),
                  description: $(this).find('#formControlEditDescription').val().trim(),
                  avatar: $(this).find('#formControlEditImg').attr("data-avatar").trim()
               }
            }

            var send=$.ajax({
               method: 'POST',
               url:'/assets/js/app-server.php',
               data: param
            }).done(function(html){
               if(html[0]) {
                  $('#table').bootstrapTable('refresh');

                  $('#modalDeleteUsers').modal('hide');
                  $('#modalEditUsers').modal('hide');
                  $('#modalActionUsers').modal('hide');
               } else {
                  console.log(html[1]);
               }
            }).fail(function(){
               console.log("Une erreur s'est produite lors de l'execution de la tache. Contacter le support.");
            });
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


   <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
   <script src='https://unpkg.com/bootstrap-table@1.20.2/dist/extensions/export/bootstrap-table-export.min.js'></script>

<?php
   echo footer_css("dashboard");
?>