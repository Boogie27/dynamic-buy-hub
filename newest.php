<?php
    require_once "includes/header.php";
    $cartQty = 0;
    if(Session::exists(Config::get("session/session_name")) && Session::exists("cart")){
        $cart = Session::get("cart");
        $user_id = Session::get(Config::get("session/session_name"));
      
        $cartQty = $cart["totalQty"];
    }






    $newestProduct = new Category();
    if(Input::exists("post") && Input::onclick("checkPriceItems")){
         $product = escape(Input::get("product"));
         $item = escape(Input::get("item"));
         $from = escape(Input::get("from"));
         $to = escape(Input::get("to"));
         $sortName = escape(Input::get("sortName"));
         $itemFrom = null;
         $itemto = null;
         $itemProduct = null;
         $itemItem = null;
         $itemsortName = null;

        if(!empty($form)){
            $itemFrom = array("price", ">=", $from);
        }
        if(!empty($item)){
            $itemItem = array("categories", "=", $item);
        }
        if(!empty($product)){
            $itemProduct = array("slug", "=", $product);
        }
        if(!empty($to)){
            $itemto = array("price", "<=", $to);
        }
        if(!empty($sortName)){
            $itemsortName = array("name", "RLIKE", "^[{$sortName}].*$"); 
        }

        $date = date("Y-m-d H:i:s", time() - (7 * 86400));
        $dateTime = array("date", ">=", $date);

        $newestProduct->get("products", array("featured", "=", true), array($itemFrom, $itemto, $itemsortName, $itemItem, $itemProduct, $dateTime));
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
                                            <button type="submit" name="checkPriceItems">Sort Items</button>
                                      </form>
                                  </div>
                       </div>

                       
                              <!-- MAIN PAGE IMAGES -->
                                          <div class="col-lg-9 col-md-9 main">
                                              <div class="row">
                                                    <div class="col-lg-9 col-md-12 expland">
                                                      <div class="main-images slideContainer">
                                                          <div class="slide slideItem">
                                                              <img src="admin/logo/index-slide-2.jpg" alt="main-image-1" class="main-img">
                                                               <div class="tag">
                                                                  <h2>gifts at every price</h2>
                                                               </div>
                                                          </div>
                                                          <div class="slide slideItem" style="display: block;">
                                                              <img src="admin/logo/main-image-5.jpg" alt="main-image-2" class="main-img">
                                                              <div class="tag">
                                                                <h2>free online shopping</h2>
                                                                <a href="">explore</a>
                                                             </div>
                                                          </div>
                                                          <div class="slide slideItem">
                                                              <img src="admin/logo/main-image-3.jpg" alt="main-image-3" class="main-img">
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
                                                                        <span>my cart (<span class="cartQty">7</span>)</span>
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

                                               <!-- $product = new Product();
                                                        $product->select("products", array("id", 8)); -->
      
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
                                                
                                             
                                                 
                                    
      
                                                  
                                      
                                                <!-- NEWEST SECTION -->
                                                <?php
                                                        
                                                         $date = date("Y-m-d H:i:s", time() - (7 * 86400));
                                                        if(!Input::exists("post") && is_numeric(Input::get("item"))){
                                                            $itemID = escape(Input::get("item"));
                                                            $feautured = $newestProduct->get("categories", array("id", "=", $itemID))->first()["name"];
                                                            $newestProduct->get("products", array("featured", "=", true), array(["date", ">=", $date], ["categories", "=", $itemID]));
                                                        }else if(!Input::exists("post") && is_numeric(Input::get("product"))){
                                                            $itemID = escape(Input::get("product"));
                                                            $feautured = $newestProduct->get("sub_categories", array("id", "=", $itemID))->first()["name"];
                                                            $newestProduct->get("products", array("featured", "=", true), array(["date", ">=", $date], ["slug", "=", $itemID]));
                                                        }else{
                                                            if(Input::exists("post")){
                                                               $newestProduct->get("products", array("featured", "=", true), array($itemFrom, $itemto, $itemsortName, $itemItem, $itemProduct, $dateTime));    
                                                            }else{
                                                                $newestProduct->get("products", array("featured", "=", true), array(["date", ">=", $date]));                                                                
                                                            }
                                                            $feautured = "Newest Item";
                                                        }
                                                        

                                                            if($newestProduct->count()){ ?>
                                                                <div class="featured">    
                                                                    <div class="featured-header"><h2><?= $feautured." products"; ?></h2></div>
                                                                        <div class="row">
                                                                          <?php
                                                                             foreach($newestProduct->result() as $values){
                                                                                 $images = explode(",", $values["image"]);
                                                                          ?>
                                                                            <div class="col-md-3 col-sm-4 col-4">
                                                                                <div class="featured-item">
                                                                                    <a href="detail.php?product=<?= $values["id"];?>&slug=<?= $values["slug"];?>"><img src="admin/images/<?= $images[0]; ?>" alt=""></a>
                                                                                        <ul>
                                                                                            <li class="percentage">-3%</li>
                                                                                            <li><?=$values["name"]; ?></li>
                                                                                            <li class="price"><?= Input::money($values["price"]); ?> <strike><?= Input::money($values["old_price"]); ?></strike></li>
                                                                                            <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                                                        <form action="" method="post" class="addToCartFrom">
                                                                                            <input type="hidden" name="itemID" class="itemID" value="<?= $values["id"]; ?>">
                                                                                            <button type="submit" name="addToCart" class="add-to-cart addToCart"><i class="fas fa-shopping-cart cart"></i>add to cart</button>
                                                                                        </form>
                                                                                        </ul>
                                                                                </div>
                                                                            </div>
                                                                             <?php } ?>
                                                                    </div>
                                                          <?php  }else{
                                                              echo '<br><br><br><div class="category-alert text-danger">There are no item</div>';
                                                          }
                                                ?>
                                               
                                                     <!-- PAGINATION SECTION -->
                                                    
                                                                <div class="pagination">
                                                                    <a href="#">«</a>
                                                                    <a href="#">1</a>
                                                                    <a href="#" class="active-pag">2</a>
                                                                    <a href="#">3</a>
                                                                    <a href="#">4</a>
                                                                    <a href="#">»</a>
                                                                </div>
                                                    
                                              </div>
                                          </div>
                                          <!-- end of main -->
                                              
                                          </div>
                                      </div>
                                      <br><br>
                          </section>
      



                          <!-- FOOTER SECTION -->
                          <section class="footer">
                               <?php
                                    require_once "footer.php";
                                ?>
                          </section>
            
      
