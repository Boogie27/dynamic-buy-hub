<?php require_once "includes/header.php"; ?>
<?php
    $object = new User();
    $date = date("Y-m-d H:i:s", time() - (7 * 86400));
?>

    

    <!-- DASH BOARD SECTION-->
    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
            <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                
                <div class="col-lg-10  removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                        <?php  
                            if(Session::exists("success")){
                                echo '<div class="alert alert-success">';
                                        echo Session::flash("success");
                                echo '</div>';
                            }
                        ?>
                         <div class="main-content-home-logo"><i class="fas fa-home"></i>Dashboard</div>
                          <div class="main-content-container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="main-content-thumb one">
                                        <?php
                                             $order = $object->get("paid_order", array("date", ">", $date));
                                             $totalPrice = 0;
                                             foreach($order->result() as $values){
                                                $price = json_decode($values->items, true)["totalPrice"];
                                                $totalPrice += $price;
                                             }
                                        ?>
                                            <ul>
                                                <li class="thumb-header">Weekly Sales <i class="fas fa-chart-bar"></i></li>
                                                <li class="thumb-money"><?= Input::money($totalPrice) ? Input::money($totalPrice) : "0";?></li>
                                                <li class="thumb-rate">increase by 60%</li>
                                            </ul>
                                        </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="main-content-thumb two">
                                        <ul>
                                            <li class="thumb-header">Weekly Orders <i class="fas fa-calculator"></i></li>
                                            <li class="thumb-money"><?= $object->get("paid_order", array("date", ">", $date))->count();?></li>
                                            <li class="thumb-rate">increase by 60%</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="main-content-thumb three">
                                        <ul>
                                            <li class="thumb-header">Online Visitors <i class="fas fa-globe"></i></li>
                                            <li class="thumb-money"><?= $object->get("users", array("online", "=", true))->count();?></li>
                                            <li class="thumb-rate">increase by 60%</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                   <?php
                                    $object = new Product();
                                    
                                   ?>
                                    <div class="bar-chart">
                                         <div class="bar-chart-header">Total Income</div>
                                          <ul class="stats">
                                                <li class=""><?= Input::money($object->price());?><div>products</div></li>
                                                <li class="">₦78,000 <div>Sales</div></li>
                                                <li class="">₦48,000 <div>Cost</div></li>
                                                <li class="">₦98,000 <div>Revenue</div></li>
                                                <?php
                                                    // $sales = $object->get("products");
                                                    // foreach($sales->result() as $values){
                                                    //     echo '<li><div class="bar" data-percentage="'.$object->sales($values).'"></div><span>'.$object->sales($values).'</span></li>';
                                                        
                                                    // }

                                                ?>
                                          </ul>
                                          <ul class="bars" data-direction="height" data-type="percentage" data-top="250">
                                              <li><div class="bar" data-percentage="10"></div><span>jan</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>feb</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>mar</span></li>
                                              <li><div class="bar" data-percentage="80"></div><span>apr</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>may</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>june</span></li>
                                              <li><div class="bar" data-percentage="10"></div><span>july</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>augt</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>sept</span></li>
                                              <li><div class="bar" data-percentage="100"></div><span>oct</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>nov</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>dec</span></li>
                                          </ul> 
                                          <ul class="bars" data-direction="height" data-type="percentage" data-top="250">
                                              <li><div class="bar" data-percentage="10"></div><span>jan</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>feb</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>mar</span></li>
                                              <li><div class="bar" data-percentage="80"></div><span>apr</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>may</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>june</span></li>
                                              <li><div class="bar" data-percentage="10"></div><span>july</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>augt</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>sept</span></li>
                                              <li><div class="bar" data-percentage="100"></div><span>oct</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>nov</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>dec</span></li>
                                          </ul> 
                                          <ul class="bars" data-direction="height" data-type="percentage" data-top="250">
                                              <li><div class="bar" data-percentage="10"></div><span>jan</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>feb</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>mar</span></li>
                                              <li><div class="bar" data-percentage="80"></div><span>apr</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>may</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>june</span></li>
                                              <li><div class="bar" data-percentage="10"></div><span>july</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>augt</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>sept</span></li>
                                              <li><div class="bar" data-percentage="100"></div><span>oct</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>nov</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>dec</span></li>
                                          </ul>
                                           <ul class="bars" data-direction="height" data-type="percentage" data-top="250">
                                              <li><div class="bar" data-percentage="10"></div><span>jan</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>feb</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>mar</span></li>
                                              <li><div class="bar" data-percentage="80"></div><span>apr</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>may</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>june</span></li>
                                              <li><div class="bar" data-percentage="10"></div><span>july</span></li>
                                              <li><div class="bar" data-percentage="20"></div><span>augt</span></li>
                                              <li><div class="bar" data-percentage="15"></div><span>sept</span></li>
                                              <li><div class="bar" data-percentage="100"></div><span>oct</span></li>
                                              <li><div class="bar" data-percentage="60"></div><span>nov</span></li>
                                              <li><div class="bar" data-percentage="45"></div><span>dec</span></li>
                                          </ul>    
                                    </div>
                                </div>
                                <!-- top sales -->
                                <div class="col-lg-5">
                                    <div class="top-sales">
                                          <div class="top-sale-header">Top Selling Products <span><a href="top_selling.php">view more</a></span></div>
                                          <?php
                                                $topSelling = new Product();
                                                $topSelling->select("products", array("sold", 4));
                                                foreach($topSelling->result() as $values){ 
                                                    $images = explode(",", $values->image)[0];
                                                    ?>
                                                    <div class="top-sales-items">
                                                        <ul class="sale-image">
                                                            <li><a href="product_detail.php?product=<?= $values->id;?>"><img src="images/<?= $images; ?>" alt="<?= $images?>"></a></li>
                                                        </ul>
                                                        <ul class="sale-info">
                                                            <li class="sale-name"><a href="product_detail.php?product=<?= $values->id;?>" style="color: #555;"><?= $values->name; ?></a></li>
                                                            <li><?= $values->brand; ?></li>
                                                            <li>
                                                                <i class="far fa-star rate"></i>
                                                                <i class="far fa-star rate"></i>
                                                                <i class="far fa-star rate"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </li>
                                                        </ul>
                                                        <ul class="sales-amount">
                                                            <li class="saleAmount"><?= Input::money($values->price * $values->sold);?><div>Sales<span class="text-warning">(<?= $values->sold;?>)</span></div></li>
                                                        </ul>
                                                    </div>
                                             <?php }
                                            ?>
                                    </div>
                                </div> <!--end-->

                                <!--  ORDER ACTIVITY-->
                                <div class="col-lg-12">
                                    <div class="order-activity">
                                        <div class="order-activity-header">Order Activity <span><a href="orders.php">view more</a></span></div>
                                        <div class="col-lg-12">
                                        <?php
                                                  $orders = new Order();
                                                  $orders->select("paid_order", array("id", 4));
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
                                    </div>
                                </div> <!--end of order activity-->
                                <div class="col-lg-12">
                                    <div class="sold-product-container">
                                        <div class="sold-products-header">Sold Products <span><a href="products.php">show more</a></span></div>
                                        <div class="sold-products-table">
                                             <div class="table-responsive">
                                             <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Products</th>
                                                            <th>Product ID</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Stock</th>
                                                            <th>Sold</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $product = new Product();
                                                        $product->select("products", array("id", 8));
                                                        if($product->count()){
                                                            $x = 1;
                                                            foreach($product->result() as $values){ 
                                                                $image = explode(",", $values->image)[0];
                                                                ?>
                                                                <tr class="table-parent">
                                                                    <form action="" method="post" class="productTableForm">
                                                                        <td><li class="data"><?= $x; ?></li></td>
                                                                        <td>
                                                                            <ul>
                                                                                <li><a href="product_detail.php?product=<?=$values->id; ?>"><img src="images/<?= $image; ?>" alt="<?= $values->name; ?>"></a></li>
                                                                                <li><?= $values->name?></li>
                                                                            </ul>
                                                                        </td>
                                                                        <td><li class="data"><?= $values->id?></li></td>
                                                                        <td><li class="data"><?= Input::money($values->price); ?></li></td>
                                                                        <td><li class="data text-danger"><?= $values->old_price ? Input::money($values->old_price) : Input::money("0.0").".00"; ?></li></td>
                                                                        <td><li class="data"><?= $values->quantity - $values->sold;?></li></td>
                                                                        <td class="table-option parent"><li class="data"><?= $values->sold?></li></td>
                                                                    </form>
                                                                </tr>
                                                        <?php
                                                            $x++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                </div> <!-- end-->
            </div>
    </section>
    
 <?php require_once "includes/footer.php";?>
