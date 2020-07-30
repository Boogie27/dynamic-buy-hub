


        <!-- NAVIGATION -->
        <section>
                 <div class="navigation">
                      <div class="top-navigation">
                              <div class="container">
                                     <div class="mysection">
                                         <div class="logo">
                                             <a href="#"><img src="images/logo.png" alt="logo"></a>
                                         </div>
                                         <h2>shop hub</h2>
                                         <span>
                                            <a href="cart.php">
                                                <i class="fas fa-shopping-cart">
                                                    <h6 class="badge btn btn-danger" id="cartQty"></h6>
                                                </i>
                                            </a>
                                            <i class="fas fa-bars" id="sidebarOpen"></i>
                                        </span>
                                      </div>
                                     <div class="top-link">
                                          <a href="account.php">My account</a>
                                          <a href="order.php">My order</a>
                                          <a href="cart.php">My cart<i class="badge btn btn-danger cartq"></i></a>
                                          <?php
                                             if(Session::exists(Config::get("session/session_name"))){
                                                   echo  ' <a href="checkout.php" id="checkOutButton">checkout</a>
                                                           <a href="logout.php" class="logUserOut">logout</a>';
                                             }else{
                                                   echo ' <a class="form-action-button loginAction" data-type="login-form">login</a>
                                                          <a class="form-action-button signUpAction" data-type="signup-form">signup</a>';
                                             }
                                          ?>
                                     </div>
                              </div>
                      </div>
                         <!-- SEARCH SECTION -->
                         <div class="search-section">
                                 <div class="container search">
                                     <div class="logo"><a href="index.php"><img src="images/logo.png" alt="logo"></a></div>
                                     
                                        <form action="product.php" method="post" id="searchForm">
                                            <div class="searchForm">
                                                <div class="search-box">
                                                    <input type="text" name="search" id="search" value="<?= Input::get("search");?>" class="search-input" placeholder="Enter brand">
                                                    <button type="submit" name="searchItem" class="search-button"><i class="fas fa-search"></i></button>
                                                </div> 
                                                <div class="search-items" id="search-items">
                                                     <!-- suggestion auto complete here -->
                                                </div>
                                            </div>
                                        </form>
                                 </div>
                         </div>
      
                         <div class="navigation-links">
                              <div class="container-link">
                                      <div class="link">
                                              <a href="index.php" class="activ">Home</a>
                                              <a href="product.php">Products</a>
                                              <a href="newest.php">New products</a>
                                              <a href="#">Contact us</a>
                                              <?php
                                                    if(Session::exists(Config::get("session/session_name"))){
                                                        echo  ' <a href="checkout.php" id="checkOutButton">checkout</a>
                                                                <a href="logout.php" class="logUserOut">logout</a>';
                                                    }else{
                                                        echo ' <a class="form-action-button" data-type="login-form">Login</a>
                                                               <a class="form-action-button" data-type="signup-form">signup</a>';
                                                    }
                                              ?>
                                        </div>
                                        <div class="phone">
                                            <a><i class="fas fa-phone"></i>Call us +2348012345678 </a>
                                        </div>
                              </div>
                         </div>
                 </div>
             </section>
      
       



             <?php
                   
                   function leftSideBar(){ 
                       if(Session::exists(Config::get("session/session_name"))){
                            $user_id = Session::get(Config::get("session/session_name"));
                            $user = new User();
                            $user->get("users", array("id", "=", $user_id));
                            if($user->count()){
                                $name =  explode(" ", $user->first()["name"]);
                                $name = $name[count($name) - 1];
                                $image = $user->first()["image"];
                            }
                            if($image == null){
                                $image = "profile-image/profile-image.png";
                            }
                       }else{
                          $name = "user name" ;
                          $image = "profile-image/profile-image.png";
                       }
                      
                       ?>
                            <div class="account-left-bar">
                                <div class="account-right-bar-image">
                                    <div class="account-side-immage">
                                        <img src="admin/<?= $image ?>" alt="<?= $name?>">
                                        <?php
                                            if(Session::exists(Config::get("session/session_name"))):
                                                echo ' <i class="fas fa-pen form-action-button" data-type="edit-form"></i>';
                                            endif;
                                        ?>
                                       
                                    </div>
                                    <h3 class="image-name"><?= $name; ?></h3>
                                </div>
                                <div class="account-left-links">
                                    <ul>
                                        <li><i class="fas fa-user"></i><a href="account.php"> My Account</a></li>
                                        <li><i class="fas fa-shopping-cart"></i><a href="order.php" class="active-link">My order</a></li>
                                        <li><i class="fas fa-shopping-cart"></i><a href="cart.php"> My Cart</a></li>
                                        <!-- <li><i class="fas fa-address-card"></i><a href="billing.php">Billing Address</a></li> -->
                                        <li><i class="fas fa-lock"></i><a href="#">Privacy</a></li>
                                        <?php
                                             if(Session::exists(Config::get("session/session_name"))){
                                                    echo ' <li><i class="fas fa-cog"></i><a class="form-action-button" data-type="changePassword-form">Change password</a></li>
                                                           <li><i class="fas fa-trash"></i><a  class="form-action-button" data-type="deleteAccount-form">Delete Account</a></li>';
                                             }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                 <?php  } ?>