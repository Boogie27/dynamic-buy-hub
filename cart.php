<?php
    require_once "includes/header.php";

  if(Session::exists("cart")){
       $cartItems = Session::get("cart");
       $tax = Config::get("money/tax") * Session::get("cart")["totalPrice"];
?>

<!-- CART SECTION -->
<section class="cart-section">
    <div class="container">
       <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="main-cart">
                       <div class="cart-header">
                           <h2>Your Cart (<?= Session::get("cart")["totalQty"]; ?>) <form action="cart.php" method="post"><button type="submit" name="clearCart" class="clearCart">Clear Cart</button></form></h2>
                           <i class="fas fa-bars" id="sideBarOpen"></i>
                       </div>
                         <?php
                        //  Session::delete("cart");
                        
                            foreach($cartItems["items"] as $values){
                                $ID = escape($values["item_id"]);
                                $cart = new Category();
                                $cartItem = $cart->get("products", array("id", "=", $ID));
                                if($cartItem->count()){ 
                                    $items = $cartItem->first();
                                    $itemImages = Input::json_decode($items["image"]);
                                    ?>
                                        <div class="cart-main-items">
                                            <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                        <div class="cart-image">
                                                           <a href="detail.php?product=<?= $items["id"];?>&slug=<?= $items["slug"];?>"><img src="images/<?= $itemImages[0]; ?>" alt="female-native-4"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                        <div class="cart-details">
                                                            <ul>
                                                                <li class="cart-name"><?= $items["name"]; ?><span><?= Input::money($items["price"]); ?></span></li>
                                                                <li><b>model: </b> Ghanian</li>
                                                                <li><b>make: </b><?= $items["brand"]; ?></li>
                                                                <li><b>Style: </b> short</li>
                                                                <li class="cart-quantity"><b>Quantity:</b> <?= $items["quantity"] == 0 ? "<b class='text-danger'>".$values["quantity"]." max</b>" :  $values["quantity"];?>
                                                                    <form action="" method="post" class="qty-action">
                                                                        <span>
                                                                            <input type="hidden" name="itemID" class="itemID" value="<?= $items["id"]; ?>">
                                                                            <button type="submit" name="decreaseQty" class="decreaseQty"><i class="fas fa-angle-left"></i></button>
                                                                            <button  type="submit" name="increaseQty" class="increaseQty"><i class="fas fa-angle-right"></i></button>
                                                                        </span>
                                                                    </form>
                                                                </li>
                                                                <li><b class="text-warning">Total Price: </b> <?= Input::money($values["price"]); ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                               <form action="" method="post">
                                                   <div class="cart-action">
                                                        <input type="hidden" name="cart_id" value="<?= $items["id"]; ?>">
                                                        <button  type="submit" name="delete-cart" class="cart-delete">Delete</button>
                                                        <button type="submit" name="save-for-later" class="save-for-later">save for later</button>
                                                    </div>
                                               </form>
                                        </div>
                           <?php     }
                            }
                          ?>
                </div>
            </div>

            
            <!-- CART SUMMARY -->
            <div class="col-lg-4 summary-section">
                    <div class="col-lg-12 col-md-6 col-sm-6 col-10 cart-summary-container" id="itemToOpen">
                        <div class="cart-summary">
                            <div class="cart-summary-card">
                                <i class="fas fa-times" id="close"></i>
                                <div class="summary-header">
                                    <h2>cart summary</h2>
                                </div>
                                <div class="cart-help">
                                        <div class="cart-help-header">
                                            <h2>help with your order</h2>
                                        </div>
                                        <div class="live-chart">
                                        <form action="">
                                                <div class="form-group">
                                                    <label for="live-chart">live chart</label>
                                                    <button class="form-control" id="liveChart"><i class="fas fa-comment-alt"></i>  Start live chart</button>
                                                </div>
                                                <div class="form-group">
                                                    <label for="call-me-back">call me back</label>
                                                    <button class="form-control" id="call-me-back"><i class="fas fa-phone"></i> call me back</button>
                                                </div>
                                        </form>
                                        <p>If you have any queries or rather need further assistance, please <a href="#">Contact Us</a></p>
                                        </div>
                                </div>
                                <!-- Return  section -->
                                <div class="return-container">
                                        <div class="item-return">
                                            <div class="return-header">
                                                <h2>free returns world wide</h2>
                                            </div>
                                            <div class="return-body">
                                                <ul>
                                                    <li>Shop with Confidence with <a href="#">Free Returns</a></li>
                                                    <li>More details about our <a href="#">Shippings</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                <!-- Subtotal -->
                                <div class="subtotal">
                                    <div class="subtotal-header">subtotal <i class="fa fa-circle"></i> <span><span><?= Input::money(Session::get("cart")["totalPrice"]); ?></span></div>
                                    <div class="shipping">
                                            <ul>
                                                <div class="estimate">
                                                        <li>ESTIMATED SHIPPING & HANDLING <span>&#8358;0.00</span></li>
                                                        <li>Standard: Free Arival 25 - 30 Days</li>
                                                </div>
                                                <li class="tax">TAX <i class="fa fa-circle"></i><span><?= Input::money($tax); ?></span></li>
                                                <li class="tax">Total Quantity <i class="fa fa-circle"></i><span>( <?= Session::get("cart")["totalQty"]; ?> )</span></li>
                                                <li class="total">Total <span><?= Input::money($tax + Session::get("cart")["totalPrice"]); ?></span></li>
                                            </ul>
                                            <div class="checkout">
                                                <a href="checkout.php" class="form-control checkout-button" id="checkOutButton">Checkout</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
</section>


  <?php }else{  ?>


     <section class="empty-cart-section">
           <div class="container">
                <div class="cart-empty">
                     <img src="logo-image/empty-cart.svg" class="empty-cart" alt="">
                </div>
                <div class="empty-cart-link">
                    <li>There are no items in your cart. <a href="product.php">Continue shopping</a></li>
                </div>
           </div>
     </section>

<?php
  }
?>




<!-- SAVE FOR LATER SECTION -->
<?php
 if(Session::exists(Config::get("session/session_name"))){
    $user_id = Session::get(Config::get("session/session_name"));
    $save = new Cart();
    $save->get("cart", array("user_id", "=", $user_id));
       if($save->count()){
          $savedItems = Input::json_decode( $save->first()["item"]);
        ?>
<section class="saveForLater">
       <div class="container">
            <div class="saveForLater-header">
                <h2>saved items (<?= $savedItems["saveQty"]; ?>)</h2>
                <p>Items are saved and bought later...</p>
            </div>
        <?php
          foreach($savedItems["items"] as $value){
                   $item_id = $value["item_id"];
                   $Saved = new Cart();
                  
                   $itemSaved = $Saved->get("products", array("id", "=", $item_id));
                   if($itemSaved->count()){  
                     $saveItem = $itemSaved->first();
                     $saveImage = Input::json_decode($saveItem["image"]);
                       ?>
                       <div class="saveForLater-container">
                        <div class="saveForLater-items">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                    <div class="saveForLater-image">
                                    <a href="detail.php?product=<?= $saveItem["id"];?>&slug=<?= $saveItem["slug"];?>"><img src="images/<?= $saveImage[0]; ?>" alt="nba_2k20"></a>                                
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                   <ul class="saveForLater-details">
                                       <li class="saved-name-qty">
                                           <div class="saved-item name"><b>name: </b> <?= $saveItem["name"]; ?></div>
                                           <div class="saved-item qty"><b>Quantity: </b><?=$value["quantity"]; ?></div>
                                       </li>
                                       <li><b>model: </b> Ghanian</li>
                                       <li><b>make: </b><?= $saveItem["brand"]; ?></li>
                                       <li><b>Style: </b> short</li>
                                       <li class="text-danger"><b>price: </b> <?= Input::money($saveItem["price"]); ?></li>
                                   </ul>
                                </div>
                            </div>
                            <div class="savedForLater-action">
                                <form action="" method="post">
                                    <input type="hidden" name="saveID" value="<?= $saveItem["id"]; ?>">
                                    <button  type="submit" name="delete-save" class="">Delete</button>
                                    <button type="submit" name="save-return" class="">Add to Chart</button>
                                </form>
                            </div>
                        </div>
                  <?php }
          }

?>
                   
                        <div class="savedForLater-totel">
                             <ul>
                                 <li class="saved-tax"><b>tax: </b>&#8358;500.00</li>
                                 <li class="saved-total"><b>Total: </b><?=  Input::money($savedItems["savePrice"]); ?></li>
                             </ul>
                        </div>
                    </div>
       </div>
</section>
       <?php } 
 }
       ?>



<?php 
     $mightLikeObject = new Category();
     $mightLikeObject->rand("products", array("featured", "=", true), 10);
?>
<!-- MIGHT LIKE SECTION -->
<section class="might-like">
          <div class="container">
               <div class="might-like-header">
                    <h2>items you might also like...</h2>
               </div>
                <div class="might-like-container swiper-container">
                     <div class="might-like-frame swiper-track">
                        <?php
                             foreach($mightLikeObject->result() as $mightLikeItems){ 
                                     $mightLikeImage = Input::json_decode($mightLikeItems["image"]);
                                 ?>
                                <div class="might-like-item">
                                <a href="detail.php?product=<?= $mightLikeItems["id"];?>&slug=<?= $mightLikeItems["slug"];?>"><img src="images/<?= $mightLikeImage[0];?>" alt="female-native-4"></a>
                                    <ul>
                                        <li>dansiki women</li>
                                        <li class="by"><b>made by</b> <?= $mightLikeItems["brand"];?></li>
                                        <li><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                                        <li class="price"><?= Input::money($mightLikeItems["price"]);?></li>
                                    </ul>
                                    <div class="addtocart">
                                       <form action="" method="post" class="addToCartFrom">
                                            <input type="hidden" name="itemID" class="itemID" value="<?= $mightLikeItems["id"]; ?>">
                                            <button type="submit" name="addToCart" class="addToCart"><i class="fas fa-shopping-cart cart"></i>Add To Cart</button>
                                        </form>
                                    </div>
                                </div>
                           <?php  } ?>
                     </div>
                     <div class="direction swipper-direction">
                        <i class="fas fa-angle-left"></i>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
          </div>
</section>





<!-- FOOTER SECTION -->
<section class="footer">
    <?php
         require_once "footer.php";
    ?>
</section>

