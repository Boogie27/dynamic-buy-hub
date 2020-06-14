<?php
 $user_id = Session::get(Config::get("session/session_name"));
 $user = new User();
 $user->get("users", array("id", "=", $user_id));
 if($user->count()){
    $name =  explode(" ", $user->first()["name"]);
    $name = $name[count($name) - 1];
    $email = $user->first()["email"];
    $image = $user->first()["image"];
    if($image == null){
        $image = "profile_image/profile-image.png";
    }
 }else{
    $name = "user name" ;
    $image = "profile_image/profile-image.png";
    $email = "example@gmail.com";
 }

?>

           <section class="profile-section">
                  <div class="profile">
                          <i class="fas fa-times" id="sideBarClose"></i>
                          <div class="profile-head">
                              <div class="profile-img">
                                  <img src="<?= $image; ?>" alt="<?= $name?>">
                                   <?php
                                        if(Session::exists(Config::get("session/session_name"))):
                                              echo ' <i class="fas fa-pen form-action-button" data-type="edit-form"></i>';
                                        endif;
                                   ?>
                              </div>
                               <ul>
                                   <li class="username"><?= $name; ?></li>
                                   <li class="email"><?=$email ?></li>
                               </ul>
                          </div>
                          <div class="profile-link">
                              <ul>
                                  <li><a href="index.php">Home</a></li>
                                  <li><a href="product.php">Products</a></li>
                                  <li><a href="#">New Products</a></li>
                                  <li class="category">Category <i class="fas fa-angle-right"></i></li>
                                  <li class="details">Details <i class="fas fa-angle-right"></i></li>
                                  <li class="account-info">Account Info</li>
                                  <li><a href="account.php">My Account</a></li>
                                  <li><a href="order.php">My Order</a></li>
                                  <li><a href="cart.php">My Cart</a></li>
                                  <li><a href="billing.php">Billing Address</a></li>
                                  <li><a href="#">Account Privacy</a></li>
                                  <?php
                                      if(Session::exists(Config::get("session/session_name"))){
                                          echo  ' <li><a class="form-action-button" data-type="changePassword-form">Change Password</a></li>
                                                  <li><a href="checkout.php">Check Out</a></li>';
                                      }
                                  ?>
                                  <li><a href="#">About Us</a></li>
                                  <li><a href="#">Contact</a></li>
                                  <?php
                                      if(Session::exists(Config::get("session/session_name"))){
                                          echo  ' <li><a href="logout.php" class="logout logUserOut">logout</a></li>';
                                      }else{
                                          echo '<li><a class="form-action-button" data-type="login-form">Login</a></li>
                                                <li><a class="signup form-action-button" data-type="signup-form">Sign Up</a></li>';
                                      }
                                  ?>
                              </ul>
                          </div>
                     </div>
      
                     <!-- category sub menu -->
                     <div class="category-Items catActive pageClose">
                         <div class="category-header">
                                  <i class="fas fa-arrow-left"></i>
                                  <h2>Category</h2>
                          </div>
                          <ul class="sideLink">
                          <?php
                                    foreach($categories->result() as $items){ ?>
                                            <li class="link"><?= $items["name"]; ?> 
                                        <?php  
                                            $feature = array("featured", "=", true);
                                            $dropDown = new Category();
                                            if($dropDown->get("sub_categories", array("categories_id", "=", $items["id"]), [$feature])->count() > 0){ ?>
                                                <div class="dropdown">
                                                        <ul>
                                                          <?php  foreach($dropDown->result() as $values){ ?>
                                                            <li><a href="product.php?name=<?=$values["name"];?>&slug=<?=$values["id"];?>"> <?=$values["name"];?></a></li>
                                                         <?php   }  ?>
                                                         </ul>  
                                                    </div>
                                         <?php   }  ?>
                                            </li>
                                    <?php }  ?>
                              </ul>
                      </div>
                      <!-- end -->
      
                       <!-- details for mobile side bar-->
                  <div class="mobile-right-bar pageClose">
                          <div class="detal-header">
                                  <i class="fas fa-arrow-left"></i>
                                  <h2>Details</h2>
                          </div>
                          <div class="details-items">
                                  <div class="col-sm-12 myCart">
                                          <div class="myCart-header display-detail-cart">
                                              <i class="fas fa-shopping-cart"></i>
                                              <span>my cart (4)</span>
                                              <i class="fas sign fa-angle-down"></i>
                                          </div>
                                          <ul class="cartImages" id="display-detail-cart-open">
                                              <!-- <li><a href="#"><img src="images/shirt_3.jpg" alt="shirt_3">T-shirt (1)</a></li>
                                              <li><a href="#"><img src="images/watch_1.png" alt="watch_1">metro watch (1)</a></li>
                                              <li><a href="#"><img src="images/blue_shoe.jpg" alt="blue_shoe">T-shirt (1)</a></li>
                                              <li><a href="#"><img src="images/watch_1.png" alt="watch_1">metro watch (1)</a></li> -->
                                          </ul>
                                  </div>
                                  <div class="col-sm-12 freeShop">
                                      <div class="free-header">
                                          <i class="fas fa-truck"></i>
                                          <span>free shipping</span>
                                      </div>
                                      <a href="#">free on all products</a>
                                  </div>
                                  <div class="col-sm-12 order-online">
                                      <div class="order-header">
                                          <i class="fas fa-laptop"></i>
                                          <span>Order Online</span>
                                      </div>
                                      <a href="#">order online</a>
                                  </div>
                                  <div class="col-sm-12 money-back">
                                      <div class="moneyBack-header">
                                          <i class="fas fa-money-bill-wave"></i>
                                          <span>money back</span>
                                      </div>
                                      <a href="#">money back</a>
                                  </div>
                          </div>
                      </div>
                      <!-- end -->
          </section>