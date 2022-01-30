<?php
include_once("includes/inc.php");

echo Header_HTML("Dashboard lock", "dashboard");
?>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-md-6 col-sm-12 col-12 ">
                  <div class="sign-user_card ">
                    <div class="sign-in-page-data">
                      <div class="sign-in-from w-100 m-auto">
                         <h4 class="mt-3 text-white mb-0 text-center">Hi ! Michael Smith</h4>
                         <p class="text-white text-center">Enter your password to access the admin.</p>
                         <form class="mt-4">
                            <div class="form-group">
                              <input type="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Password" autocomplete="off" required>
                            </div>
                            <div class="d-inline-block w-100">
                               <a href="sign-in.html" class="btn btn-primary float-right">Log In</a>
                            </div>
                         </form>
                      </div>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

<?php
   echo Footer_css("dashboard");
?>