<?php require_once "includes/header.php"; ?>
<?php
   if(Input::exists("get")){
        $id = escape(Input::get("order"));
        $order = new Order();
        $order->get("paid_order", array("id", "=", $id));
?>


    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                    <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                         <div class="main-content-home-logo"><i class="fas fa-shopping-cart"></i>Order Detail</div>
                         <div class="order-details-header">
                         <?php
                              $user_id = $order->first()->user_id;
                              $person = new User();
                              $user = $person->get("users", array("id", "=",  $user_id))->first();
                         ?>
                             <img src="<?= $user->image; ?>" alt="<?= $user->name;?>"> <?=$user->name; ?>
                              <form action="" method="post">
                                  <button><i class="fa fa-trash"></i></button>
                              </form>
                        </div>
                        <div class="order-detail-cont">
                         <?php
                            if($orders = $order->count()){
                               $userDetails = $order->first();
                                $itemArray = json_decode($order->first()->items, true);
                               foreach($itemArray["items"] as $values){
                                   $id = $values["item_id"];
                                   $product = $order->get("products", array("id", "=", $id));
                                   if($product->count()){
                                       $product = $product->first();
                                       $image = explode(",", $product->image)[0];
                                       $category = $order->get("categories", array("id", "=", $product->categories))->first()
                                       ?>
                                        <div class="order-detail-container" id="order-detail">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                                                        <div class="order-image-container"><a href="product_detail.php"><img src="images/<?= $image;?>" alt="madden-20"></a></div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6" id="order-detail-info">
                                                        <div class="order-detail-info">
                                                            <ul>
                                                                <li><b>Name:</b> <span><?= $product->name; ?></span></li>
                                                                <li><b>Make:</b> <span>Sonny</span></li>
                                                                <li><b>Category:</b> <span><?= $category->name; ?></span></li>
                                                                <li><b>Quantity:</b> <span><?= $values["quantity"]; ?></span></li>
                                                                <li><b>Price:</b> <span class="text-success"><b><?= Input::money($product->price); ?></b></span></li>
                                                                <li><b>Ratings:</b> 
                                                                    <i class="far fa-star rate"></i>
                                                                    <i class="far fa-star rate"></i>
                                                                    <i class="far fa-star rate"></i>
                                                                    <i class="far fa-star"></i>
                                                                    <i class="far fa-star"></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-2 col-12">
                                                        <ul>
                                                            <li class="right"><span class="text-danger"><b><?= Input::money($values["quantity"] * $product->price); ?></b></span></li>
                                                        </ul>
                                                    </div>
                                                    <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-12">
                                                        <form action="" method="post" class="orderDetailDelete">
                                                            <button type="submit" name="orderDetailDelete">Delete</button>
                                                        </form>
                                                    </div> -->
                                                </div>
                                            </div>
                                <?php   }
                               }
                            }
                         ?>

                        <div class="col-lg-12">
                            <div class="order-total">
                                <li><b> Total Qty: </b><?= $itemArray["totalQty"];?> <b> Total: </b><?= Input::money($itemArray["totalPrice"]);?></li>
                            </div>
                        </div>
                        
                        <div class="order-detail-info">
                                <div class="order-details-header">Order Details / Address</div>
                                <div class="order-activity-container">
                                     <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="order-activity-cont">
                                            <ul class="order-user">
                                                <li><b>Name:</b> <?= $user->name; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <ul class="order-user">
                                                    <li><b>Phone:</b> <?= $userDetails->phone; ?></li>
                                                </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6" id="order-activity-cont">
                                            <ul class="order-user">
                                                <li><b>Date:</b> <?= Input::date($userDetails->date); ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <ul class="order-user">
                                                <li><b>Shipped Status:</b> <i class="text-success">shipped</i></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <ul class="order-user">
                                                <li><b>Delivered:</b> <i class="text-warning">pending</i></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <ul class="order-user">
                                                <li><b>Billing Address:</b><?= $userDetails->address; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12" id="order-activity-cont">
                                            <ul class="order-user">
                                                <li><b>Shipping Address:</b><?= $userDetails->shipping_address; ?></li>
                                            </ul>
                                        </div>
                                     </div>
                                </div>
                        </div>
                    </div>
                </div>
             </div>
    </section>



 <?php 
   }

 require_once "includes/footer.php"; ?>