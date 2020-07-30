<?php require_once "includes/header.php"; 
 if(Session::exists(Config::get("session/session_name")) && Input::exists("get")){  
$user_id = escape(Input::get("admin"));
$profile = new User();
$profile->get("admin", array("id", "=", $user_id));
$user_profile = $profile->first();

 }
?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                     <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="profile-banner"> <img src="admin-image/<?= $user_profile->image ? $user_profile->image : "" ?>" alt="<?= $user_profile->name?>"></div>
                    <div class="main-container" id="profile">
                         <div class="main-container-header" id="user"><i class="far fa-user"></i>Profile</i></div>
                         <div class="main-items-container">
                             <div class="profile-container">
                               <?php
                                    if(Session::exists(Config::get("session/session_name")) && Input::exists("get")){  
                                ?>
                              <div class="profile-image-cont">
                                <div class="profile-image">
                                        <img src="admin-image/<?= $user_profile->image ? $user_profile->image : "profile-image.png" ?>" alt="<?= $user_profile->name?>">
                                </div>
                              </div>
                                <ul class="user-profile">
                                    <li class=""><?= $user_profile->name; ?></li>
                                    <li class="second"><?= $user_profile->position;?></li>
                                    <li class="third <?= $user_profile->online ? 'text-success' : "text-danger"?>"><?= $user_profile->online ? 'online' : "offline"?></li>
                                </ul>
                             </div>
                             <div class="profile-details">
                                 <div class="profile-details-header">Details</div>
                                 <ul class="details">
                                     <div class="row">
                                        <li class="col-lg-4 col-md-4 col-sm-6 col-6"><b>Email:</b> <br> <span><?= $user_profile->email?></span></li>
                                        <li class="col-lg-4 col-md-4 col-sm-6 col-6"><b>Date Joined:</b> <br> <span><?= Input::date($user_profile->date);?></span></li>
                                        <li class="col-lg-4 col-md-4 col-sm-6 col-6"><b>Activate:</b> <br> <i class="fa <?= $user_profile->activate ? 'fa-check text-success' : 'fa-times text-danger'; ?>"></i></li>
                                        <li class="col-lg-4 col-md-4 col-sm-6 col-6"><b>Phone:</b> <br> <span><?= $user_profile->phone; ?></span></li>
                                        <li class="col-lg-6 col-md-6 col-sm-6 col-12"><b>Address:</b> <br> <span><?= $user_profile->address; ?></span></li>
                                        <li class="col-lg-6 col-md-8 col-sm-10 col-12"><b>Bio:</b> <br><span><?= $user_profile->bio; ?></span></li>
                                     </div>
                                 </ul>
                              
                             </div>
                             <?php }else{
                                    echo '<div class="alert alert-danger text-danger">Something went wrong!</div>';
                                }
                            ?>
                         </div>
                    </div>
                </div>
             </div>
    </section>

  

  <!-- footer -->
  <?php require_once "includes/footer.php"; ?>