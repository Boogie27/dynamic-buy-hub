<?php require_once "includes/header.php";?>
<?php
   if(Input::exists("get")){
     $page = Input::get("page");
   }else{
     $page = 1;
   }
   $numberPage = 5;
   $start = ($page - 1) * $numberPage;

   $orders = new Order();
   $orders->limit("paid_order", array($start, $numberPage));
?>


    <!-- DASH BOARD SECTION-->
    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
            <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                <div class="col-lg-10  removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                         <div class="main-content-home-logo"><i class="fas fa-shopping-cart"></i>Order</div>
                          <div class="main-content-container">
                          <div class="products-items-header">
                                   <ul>
                                       <li class="product-item-Delete"> Orders <i class="fa fa-shopping-cart text-warning"></i>  <b>(<?= $orders->count(); ?>)</b></li>
                                   </ul>
                               </div>
                              

                                <!--  ORDER ACTIVITY-->
                                <div class="col-lg-12">
                                    <div class="order-activity">
                                        <div class="order-activity-header">Order Activity</div>
                                        <div class="col-lg-12">
                                            <?php
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
                                                                                 $image = explode(",",$products->first()->image)[0];
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
                                    </div><br>
                                    <div class="text-center">
                                        <?php
                                            $order = new Order();
                                            $order->get("paid_order");
                                        
                                            if($order->count()){
                                            $button = ceil($order->count()/$numberPage);
                                            if($page > 1){
                                                echo '<a href="orders.php?page='.($page - 1).'" class="btn btn-success">Previous</a>';
                                            }

                                            for($x = 1; $x <= $button; $x++){
                                                echo '<a href="orders.php?page='.$x.'" class="btn btn-success">'.$x.'</a>';
                                            }

                                            if($page < $button){
                                                echo '<a href="orders.php?page='.($page + 1).'" class="btn btn-success">Next</a>';
                                            }
                                            }

                                    ?>
                                </div>
                                </div> <!--end of order activity-->
                            </div>
                          </div>
                    </div>
                </div> <!-- end-->
            </div>
    </section>
    

  <!-- footer -->
  <?php require_once "includes/footer.php"; ?>