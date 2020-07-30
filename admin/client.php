<?php require_once "includes/header.php"; 
 if(Session::exists(Config::get("session/session_name")) && Input::exists("get")){  
$user_id = escape(Input::get("user_profile"));
$profile = new User();
$profile->get("users", array("id", "=", $user_id));
$user_profile = $profile->first();

 }
?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                     <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="profile-banner"><img src="<?= $user_profile->image ? $user_profile->image : ""; ?>" alt="<?= $user_profile->name; ?>"></div>
                    <div class="main-container" id="profile">
                         <div class="main-container-header" id="user"><i class="far fa-user"></i>Profile</i></div>
                         <div class="main-items-container">
                             <div class="profile-container">
                               <?php
                                    if(Session::exists(Config::get("session/session_name")) && Input::exists("get")){  
                                ?>
                              <div class="profile-image-cont">
                                <div class="profile-image">
                                        <img src="<?= $user_profile->image ? $user_profile->image : "profile-image/profile-image.png" ?>" alt="<?= $user_profile->name?>">
                                </div>
                              </div>
                                <ul class="user-profile">
                                    <li class=""><?= $user_profile->name; ?></li>
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
                                         <?php
                                            $order = new Order();
                                            $user_order = $order->get("paid_order", array("user_id", "=", $user_profile->id));
                                         ?>
                                        <li class="col-lg-4 col-md-4 col-sm-6 col-6"><b>Phone:</b> <br> <span><?= $user_order->count() ? $user_order->first()->phone : "unknown"; ?></span></li>
                                        <li class="col-lg-6 col-md-6 col-sm-6 col-12"><b>Address:</b> <br> <span><?= $user_order->count() ? $user_order->first()->shipping_address : "unknown"; ?></span></li>
                                     </div>
                                 </ul>
                                 <!--  ORDER ACTIVITY-->
                                 <div class="col-lg-12 profile-order-container">
                                        <div class="order-activity profile-order">
                                            <div class="order-activity-header">Order Activity</div>
                                        </div>
                                        <div class="col-lg-12 main-profile">
                                            <?php
                                            if($order->count()){
                                                  foreach($order->result() as $values){ ?>
                                                             <div class="order-activity-container">
                                                                    <div class="order-activity-drop-down parent">
                                                                        <i class="fa fa-ellipsis-h actionButton"></i>
                                                                        <ul class="order-dropdown childDropDown">
                                                                            <li><a href="order-detail.php"><i class="fa fa-info i"></i>Show Details</a></li>
                                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="order-activity-cont">
                                                                            <ul class="order-user">
                                                                                <li><b>Name: </b><?= $user_profile->name; ?></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                            <ul class="order-user">
                                                                                <li><b>Phone: </b><?= $values->phone; ?></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="order-activity-cont">
                                                                            <ul class="order-user">
                                                                                <li><b>Date: </b><?= Input::date($values->date);?></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                                <ul class="order-user">
                                                                                    <li><b>Shipped Status:</b> <i class="<?= $values->shipped ? "text-success" : "text-danger";?>"><?= $values->shipped ? "Shipped" : "Not shipped"?></i></li>
                                                                                </ul>
                                                                        </div>
                                                                        <div class="col-lg-12" id="profile-activity-image">
                                                                        <div class="header-items">Items: </div>
                                                                            <?php
                                                                               $items = json_decode($values->items, true)["items"];
                                                                               foreach($items as $value){
                                                                                     $products = new Product();
                                                                                     $products->get("products", array("id", "=",  $value["item_id"]));
                                                                                     if($products->count()){
                                                                                          $image = json_decode($products->first()->image, true)[0];
                                                                                          echo ' <a href="product_detail.php?product='.$products->first()->id.'"><img src="images/'.$image.'" alt="'.$products->first()->name.'"></a>';
                                                                                     }
                                                                               }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                             <?php }
                                             }else{
                                                  echo '<div class="alert alert-danger text-danger text-center">User has not made any transaction yet!</div>';
                                                  
                                             }
                                            ?>
                                            </div>
                                 </div> <!--end of order activity-->
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