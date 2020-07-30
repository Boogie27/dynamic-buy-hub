<?php require_once "includes/header.php"; ?>


    <!-- DASH BOARD SECTION-->
    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
            <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                <div class="col-lg-10  removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                         <div class="main-content-home-logo"><i class="fas fa-shopping-cart"></i>Order</div>
                          <div class="main-content-container">
                              
                              

                                <!--  ORDER ACTIVITY-->
                                <div class="col-lg-12">
                                    <div class="order-activity">
                                        <div class="order-activity-header">Order Activity</div>
                                        <div class="col-lg-12">
                                            <?php
                                                  $orders = new Order();
                                                  $orders->get("paid_order");
                                                  if($orders->count()){
                                                      foreach($orders->result() as $values){ 
                                                          $user = $orders->get("users", array("id", "=", $values->user_id));
                                                          if($user->count()){
                                                            $image = "profile_image/profile-image.png";
                                                              if($user->first()->image){
                                                                $image = $user->first()->image;
                                                              } 
                                                          }
                                                          ?>
                                                             <div class="order-activity-container">
                                                                <div class="order-activity-drop-down parent">
                                                                    <i class="fa fa-ellipsis-h actionButton"></i>
                                                                    <ul class="order-dropdown childDropDown">
                                                                        <li><a href="order-detail.php?order=<?= $values->id; ?>"><i class="fa fa-info"></i>Show Order</a></li>
                                                                        <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-lg-7" id="order-activity-cont">
                                                                        <a href="client.php?user_profile=<?= $user->first()->id?>" class="order-act-image"><img src="<?= $image; ?>" alt="<?= $user->first()->name;?>"></a>
                                                                        <ul class="order-user">
                                                                            <li class="order-act-name"><a href="client.php?user_profile=<?= $user->first()->id?>"><?= $user->first()->name; ?></a></li>
                                                                            <li><?=$values->address; ?></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-lg-5" id="order-activity-image">
                                                                        <?php
                                                                          $orderItems = json_decode($values->items, true);
                                                                          foreach($orderItems["items"] as $values){
                                                                              $id = $values["item_id"];
                                                                             $products = $orders->get("products", array("id", "=", $id));
                                                                             if($products->count()){
                                                                                 $image = json_decode($products->first()->image, true)[0];
                                                                                  echo '<a href="product_detail.php?product='.$id.'"><img src="images/'.$image.'" alt="'.$products->first()->name.'"></a>';
                                                                             }  
                                                                          }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php  }
                                                  }

                                             ?>
                                        </div>
                                    </div>
                                    <br><br><br>
                                </div> <!--end of order activity-->
                            </div>
                          </div>
                    </div>
                </div> <!-- end-->
            </div>
    </section>
    

  <!-- footer -->
  <?php require_once "includes/footer.php"; ?>