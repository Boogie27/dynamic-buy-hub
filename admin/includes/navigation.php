<?php
 if(Session::exists(Config::get("session/session_name"))){  
    $user_id = Session::get(Config::get("session/session_name"));
    $profile = new User();
    $profile->get("admin", array("id", "=", $user_id)); 
    $admin = $profile->first();
    }
?>

<!--STICKY NAVIAGTION SECTION -->
<section class="navigation" id="stickyTopNavigation">
        <div class="nav-container">
             <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                      <div class="logo">buy Hub</div>
                  </div>
                  <div class="col-lg-5 col-md-6 col-sm-9 col-12 mobile-nav-content">
                      <div class="profile">
                          <ul class="ul-nav">
                              <li class="profileImage">
                                  <img src="admin-image/<?= $admin->image ? $admin->image : "profile-image.png" ?>" alt="<?= $admin->name?>">
                                  <i class="fa fa-circle"></i>
                                  <span><?= $admin->name; ?></span>
                              </li>
                              <li><a href="#"><i class="far fa-envelope"></i> <i class="fa fa-circle message"></i></a></li>
                              <li><a href="#"><i class="far fa-bell"></i> <i class="fa fa-circle notification"></i></a></li>
                              <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                              <li><i class="fas fa-bars" id="sideNavOpenButton"></i></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-12 desktop-nav-content">
                      <div class="profile">
                          <ul class="ul-nav">
                              <li class="profileImage">
                                  <img src="admin-image/<?= $admin->image ? $admin->image : "profile-image.png" ?>" alt="<?= $admin->name?>">
                                  <i class="fa fa-circle"></i>
                                  <span><?= $admin->name; ?></span>
                              </li>
                              <li><a href="#"><i class="far fa-envelope"></i> <i class="fa fa-circle message"></i></a></li>
                              <li><a href="#"><i class="far fa-bell"></i> <i class="fa fa-circle notification"></i></a></li>
                              <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                              <li><i class="fas fa-bars" id="sideNavOpenButton"></i></li>
                          </ul>
                      </div>
                  </div>
             </div>
        </div>
  </section>



<!-- NAVIAGTION SECTION -->
   <section class="navigation">
          <div class="nav-container">
               <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                        <div class="logo">buy Hub</div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-9 col-12 mobile-nav-content">
                        <div class="profile">
                            <ul class="ul-nav">
                                <li class="profileImage">
                                    <img src="admin-image/<?= $admin->image ? $admin->image : "profile-image.png" ?>" alt="<?= $admin->name?>">
                                    <i class="fa fa-circle"></i>
                                    <span><?= $admin->name; ?></span>
                                </li>
                                <li><a href="#"><i class="far fa-envelope"></i> <i class="fa fa-circle message"></i></a></li>
                                <li><a href="#"><i class="far fa-bell"></i> <i class="fa fa-circle notification"></i></a></li>
                                <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                                <li><i class="fas fa-bars" id="sideNavOpenButton"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-4 navSearch">
                         <form action="" method="post">
                             <input type="text" name="" value="" class="form-control" placeholder="Search...">
                             <button type="" name=""><i class="fa fa-search"></i></button>
                         </form>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-9 col-12 desktop-nav-content">
                        <div class="profile">
                            <ul class="ul-nav">
                                <li class="profileImage">
                                    <img src="admin-image/<?= $admin->image ? $admin->image : "profile-image.png" ?>" alt="<?= $admin->name?>">
                                    <i class="fa fa-circle"></i>
                                    <span><?= $admin->name; ?></span>
                                </li>
                                <li><a href="#"><i class="far fa-envelope"></i> <i class="fa fa-circle message"></i></a></li>
                                <li><a href="#"><i class="far fa-bell"></i> <i class="fa fa-circle notification"></i></a></li>
                                <li><a href="logout.php"><i class="fas fa-power-off"></i></a></li>
                                <li><i class="fas fa-bars" id="sideNavOpenButton"></i></li>
                            </ul>
                        </div>
                    </div>
               </div>
          </div>
    </section>






 