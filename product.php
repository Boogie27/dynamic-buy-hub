<?php
    require_once "includes/header.php";
    $cartQty = 0;
    if(Session::exists(Config::get("session/session_name")) && Session::exists("cart")){
        $cart = Session::get("cart");
        $user_id = Session::get(Config::get("session/session_name"));
      
        $cartQty = $cart["totalQty"];
    }

    // ===================================================================================
// Function that operates the product sort items form and navigation search field 
// ===================================================================================

$productOBJ = new Category();
if(Input::exists("POST")){
   
    $search = escape(Input::get("search"));
    $from = escape(Input::get("from"));
    $to = escape(Input::get("to"));
    $byName = escape(Input::get("sortName"));
    $slug = escape(Input::get("slug"));
    $categoryId = escape(Input::get("category"));
    $rangeFrom = null;  $rangeTo = null; $rangeByName = null; $category = null; $slugCategory = null; $searchItems = null;

    if(!empty($categoryId)){
        $category = array("categories", "=", $categoryId);
    }
    if(!empty($slug)){
        $slugCategory = array("slug", "=", $slug);
    }
    if(!empty($search)){
        $searchItems = array("brand", "=", $search);
    }
    if(!empty($from)){
        $rangeFrom = array("price", ">=", $from);
    }
    if(!empty($to)){
        $rangeTo = array("price", "<=", $to);
    }
    if(!empty($byName)){
        $rangeByName = array("name", "RLIKE", "^[{$byName}].*$"); 
    }
    
        $products = $productOBJ->get("products", array("featured", "=", 1), [$searchItems, $slugCategory, $category, $rangeByName, $rangeFrom, $rangeTo]);
        $featured = "Shop Hub's products";
}
?>
      
       
      
             <!-- MAIN CONTENT  -->
             <section class="sidebar-section">
              
                      <!-- side bar -->
                      <div class="container">
                         
                          <div class="row">
                              <div class="side col-lg-3 col-md-3">
                                  <?php
                                       require_once "includes/sidebar.php";
                                  ?>
      
                                  <!-- PRICE  SORT -->
                                  <div class="sort">
                                      <div class="sort-header"><h2>item sort</h2></div>
                                      <form action="" method="POST">
                                            <h3>sort by price</h3>
                                            <input type="number" name="from" min="0" class="range" value="<?= Input::get("from")?>"><span>TO</span>
                                            <input type="number" name="to" min="0" class="range" value="<?= Input::get("to")?>">
                                            <br><br>
                                            <h3>sort by name</h3>
                                            <select name="sortName" id="sortNAme">
                                                <option value="<?= Input::get("sortName")? Input::get("sortName") : ""; ?>"><?= Input::get("sortName")? Input::get("sortName") : "select"; ?></option>
                                                <option value="A-Z">A - Z</option>
                                                <option value="A-E">A - E</option>
                                                <option value="F-J">F - J</option>
                                                <option value="K-O">K - O</option>
                                                <option value="P-Q">P - Q</option>
                                                <option value="R-Z">R - z</option>
                                            </select>
                                            <button type="submit" name="checkPrice">Sort Items</button>
                                      </form>
                                  </div>
      
                                  <!-- SPECIAL DEALS -->
                                  <div class="special-deal slideContainer">
                                      <div class="special-header"><h2>special deals</h2></div>
                                      <?php
                                          $special = new Category();
                                         if($special->rand("products", array("featured", "=", true), 4)->count()){
                                                foreach($special->result() as $values){ 
                                                    $images = Input::json_decode($values["image"]);
                                                    ?>
                                                        <div class="special-item slideItem">
                                                            <a href="detail.php"><img src="images/<?= $images[0]; ?>" alt="laptop"></a>
                                                            <ul>
                                                                <li><?= $values["name"]; ?></li>
                                                                <li><?= Input::money($values["price"]); ?></li>
                                                                <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                            </ul>
                                                        </div>
                                                <?php }
                                         }
                                      ?>
                              </div> <!--end of special featured-->
                       </div>

                       
                              <!-- MAIN PAGE IMAGES -->
                                          <div class="col-lg-9 col-md-9 main">
                                              <div class="row">
                                                    <div class="col-lg-9 col-md-12 expland">
                                                      <div class="main-images slideContainer">
                                                          <div class="slide slideItem">
                                                              <img src="images/main-image_1.jpg" alt="main-image-1" class="main-img">
                                                               <div class="tag">
                                                                  <h2>gifts at every price</h2>
                                                               </div>
                                                          </div>
                                                          <div class="slide slideItem" style="display: block;">
                                                              <img src="images/main-image-5.jpg" alt="main-image-2" class="main-img">
                                                              <div class="tag">
                                                                <h2>free online shopping</h2>
                                                                <a href="">explore</a>
                                                             </div>
                                                          </div>
                                                          <div class="slide slideItem">
                                                              <img src="images/main-image-3.jpg" alt="main-image-3" class="main-img">
                                                              <div class="tag">
                                                                <h2>get upto 30% off <br>new arivals</h2>
                                                             </div>
                                                          </div>
                                                               <div class="courosel">
                                                                   <span class="dot" current="1"></span>
                                                                   <span class="dot active" current="2"></span>
                                                                   <span class="dot" current="3"></span>
                                                               </div>
                                                        </div>
                                                    </div>
                                                    <!-- RIGHT BAR -->
                                                    <div class="col-lg-3 col-md-12">
                                                          <div class="right-bar">
                                                              <div class="col-lg-12 col-md-3 col-sm-3 myCart">
                                                                  <div class="myCart-header">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                        <span>my cart (<span class="cartQty"></span>)</span>
                                                                  </div>
                                                                  <ul class="cartItems">
                                                            <!--                                                                      
                                                                      <li><a href="#"><img src="images/watch_1.png" alt="watch_1">metro watch (1)</a></li>
                                                                      <li><a href="#"><img src="images/watch_1.png" alt="watch_1">metro watch (1)</a></li> -->
                                                                  </ul>
                                                                   <div class="visit-cart"><a href="cart.php">visit cart</a></div>
                                                              </div>
                                                              <div class="col-lg-12 col-md-3 col-sm-3 freeShop">
                                                                  <div class="free-header">
                                                                      <i class="fas fa-truck"></i>
                                                                      <span>free shipping</span>
                                                                  </div>
                                                                  <a href="#">free on all products</a>
                                                              </div>
                                                              <div class="col-lg-12 col-md-3 col-sm-3 order-online">
                                                                  <div class="order-header">
                                                                      <i class="fas fa-laptop"></i>
                                                                      <span>Order Online</span>
                                                                  </div>
                                                                  <a href="#">order online</a>
                                                              </div>
                                                              <div class="col-lg-12 col-md-3 col-sm-3 money-back">
                                                                  <div class="moneyBack-header">
                                                                      <i class="fas fa-money-bill-wave"></i>
                                                                      <span>money back</span>
                                                                  </div>
                                                                   <a href="#">money back</a>
                                                              </div>
                                                          </div>
                                                    </div>
                                              </div>
      
                                                 <!-- HOT SALE -->
                                                     <div class="hot-sale">
                                                          <div class="hot-sale-header"><h2>hot sale</h2></div>
                                                      <div class="images-swipe" id="swipe-frame">
                                                          <!-- <div class="hot-sale-image" id="swipe">
                                                                    <div class="new" id="tag">New</div>
                                                                    <a href="#"> <img src="images/watch_1.png" alt=""></a>
                                                                    <ul>
                                                                        <li>watch</li>
                                                                    </ul>
                                                                </div> -->
                                                      </div>
                                                      <div class="swipe-button">
                                                              <i class="fas fa-angle-double-left prev"></i>
                                                              <i class="fas fa-angle-double-right next"></i>
                                                      </div>
                                                </div>
                                                
                                                     
                                             <!-- NEWEST PRODUCT -->
                                        <?php
                                        if(!Input::exists("POST") && !Input::get("slug")){  
                                            include "includes/new.php";
                                        ?>
                                            
                                        <?php } ?>
                                             
                                                 
                                                 
                                              <!-- WEEKLY DEAL FOR MOBILE DEVICE DISPLAY -->
                                             <?php
                                                  require_once "includes/weekly_deal.php";
                                             ?>

      
                                                  
                                        <?php

                                        if(is_numeric(Input::get("slug"))){    
                                               if(!Input::exists("POST")){
                                                    $slug = escape(Input::get("slug"));
                                                    $featured = $productOBJ->first()["name"];
                                                    $products = $productOBJ->get("products", array("slug", "=", $slug));
                                               }else{
                                                if($productOBJ->count()){
                                                    $featured = $productOBJ->first()["name"]." products";
                                                    $products = $productOBJ->get("products", array("featured", "=", 1), [$searchItems, $slugCategory, $category, $rangeByName, $rangeFrom, $rangeTo]);   
                                                }                                               
                                               }
                                            }else if(is_numeric(Input::get("category"))){
                                                       if(!Input::exists("POST")){
                                                            $featured = $productOBJ->first()["name"]." products";
                                                            $products = $productOBJ->get("products", array("categories", "=", Input::get("category")));
                                                       }else{
                                                        if($productOBJ->count()){
                                                            $featured = $productOBJ->first()["name"]." products";
                                                            $products = $productOBJ->get("products", array("featured", "=", 1), [$searchItems, $slugCategory, $category, $rangeByName, $rangeFrom, $rangeTo]);
                                                        }
                                                       }
                                            }else{
                                                if(!Input::exists("POST")){
                                                    $products = $productOBJ->get("products", array("featured", "=", true));
                                                    $featured = "Featured products";
                                                }else{
                                                    if($productOBJ->count()){
                                                        $featured = $productOBJ->first()["brand"]." products";
                                                        $products = $productOBJ->get("products", array("featured", "=", 1), [$searchItems, $slugCategory, $category, $rangeByName, $rangeFrom, $rangeTo]);
                                                    }
                                                }
                                            } ?>
                                                <!-- FEAUTURED SECTION -->
                                                <div class="featured">    
                                                    <div class="featured-header"><h2><?= $featured; ?></h2></div>
                                                        <div class="row">
                                                       <?php    
                                                         if($products->count() > 0){
                                                                foreach($products->result() as $featured){ 
                                                                    $image = Input::json_decode($featured["image"]);
                                                                    ?>
                                                                    <div class="col-md-3 col-sm-4 col-4">
                                                                        <div class="featured-item">
                                                                            <a href="detail.php?product=<?= $featured["id"];?>&slug=<?= $featured["slug"];?>"><img src="images/<?= $image[0]; ?>" alt="<?= $featured["name"]; ?>"></a>
                                                                           
                                                                                <ul>
                                                                                    <li class="percentage">-3%</li>
                                                                                    <li><?= $featured["name"]; ?></li>
                                                                                    <li class="price"><?= Input::money($featured["price"]); ?> <strike><?= Input::money($featured["old_price"]); ?></strike></li>
                                                                                    <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                                                <form action="" method="post" class="addToCartFrom">
                                                                                    <input type="hidden" name="itemID" class="itemID" value="<?= $featured["id"]; ?>">
                                                                                    <button type="submit" name="addToCart" class="add-to-cart addToCart"><i class="fas fa-shopping-cart cart"></i>add to cart</button>
                                                                                 </form>
                                                                                </ul>
                                                                        </div>
                                                                    </div>

                                                          <?php   }
                                                             }else{
                                                                 echo '<div class="category-alert text-danger">There are no item</div>';
                                                             }
                                                          ?>
                                                     </div>
                                                     <!-- PAGINATION SECTION -->
                                                     <?php
                                                          if($products->count() > 20){ ?>
                                                                <div class="pagination">
                                                                    <a href="#">«</a>
                                                                    <a href="#">1</a>
                                                                    <a href="#" class="active-pag">2</a>
                                                                    <a href="#">3</a>
                                                                    <a href="#">4</a>
                                                                    <a href="#">»</a>
                                                                </div>
                                                        <?php  } 
                                                     ?>
                                              </div>
                                          </div>
                                          <!-- end of main -->
                                              
                                          </div>
                                      </div>
                          </section>
      



                          <!-- FOOTER SECTION -->
                          <section class="footer">
                               <?php
                                    require_once "footer.php";
                                ?>
                          </section>
            
      
