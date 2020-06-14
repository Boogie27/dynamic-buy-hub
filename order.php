<?php
        require_once "includes/header.php";
?>


             <!-- ACCOUNT SECTION -->
             <section class="account-section">
                      <div class="container">
                             <div class="row">
                                 <div class="col-lg-3 col-md-4 order-naviagtion">
                                     <?php
                                        // left side bar
                                         leftSideBar();
                                     ?>
                                 </div>
                                 <div class="col-lg-9 col-12">
                                     <div class="order-item-header">
                                         <i class="fas fa-bars"></i>
                                         <h2>My Order</h2>
                                         <span>
                                              <i class="fas fa-circle text-success"></i>Shipped
                                               <i class="fas fa-circle text-danger"></i>Not Shipped
                                        </span>
                                     </div>
                                     <?php
                                           if(Session::exists(Config::get("session/session_name"))){
                                                 $paidOrder = new Category();
                                                 if($paidOrder->get("paid_order", array("user_id", "=", $user_id))->count()){ 
                                                     $x = 1;
                                                     foreach($paidOrder->result() as $values){ 
                                                             $items = Input::json_decode($values["items"]); 
                                                         ?>  
                                     <div class="table-section">
                                         <span class="badge btn-warning number"><?= $x; ?></span>
                                         <?php
                                                foreach( $items["items"] as $keys){ 
                                                $paidOrder->get("products", array("id", "=", $keys["item_id"])); 
                                                $items = $paidOrder->first();
                                                $images = Input::json_decode($items["image"]);
                                                ?>
                                                    <div class="table-items">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-8">
                                                                <div class="order-item">
                                                                    <a href="detail.php?product=<?= $items["id"];?>&slug=<?= $items["slug"];?>"><img src="images/<?= $images[0]; ?>" alt="crash-nitro-fueld"></a>
                                                                    <ul class="order-detail-one">
                                                                        <li><b>Item Name: </b><?= $items["name"]; ?></li>
                                                                        <li><b>Quantity: </b><span class="badge btn-warning"><?= $keys["quantity"]; ?></span></li>
                                                                        <li><b>Order Number: </b>#56789876534</li>
                                                                        <li class="text-danger"><b>Price: </b><?= Input::money($items["price"]); ?></li>
                                                                        <li class="order-address"><b>Address: </b><?= $values["address"]; ?></li>
                                                                        <li class="order-action"><i class="fas fa-angle-right orderAction"></i></li>
                                                                    </ul>                                                   
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-4 order-mobile">
                                                                <ul class="order-status">
                                                                    <li><b>Shipping Date: </b>15, march 2020</li>
                                                                    <li><b>Shipping status: </b><i class="fas fa-check text-success"></i></li>
                                                                    <li><b>Delivered: </b><span class="text-warning">Pending</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 order-mobile">
                                                                <ul class="order-cont">
                                                                    <li><b>Date Arrived: </b><span class="text-warning">Pending</span></li>
                                                                    <li class="order-toatl"><b class="text-warning">Total: </b><?= Input::money($keys["price"]); ?></li>
                                                                </ul>
                                                                <a href="detail.php?product=<?= $items["id"];?>&slug=<?= $items["slug"];?>" class="order-view-details">View Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                  <?php     }  ?>
                                            </div>

                                            <?php                 
                                                $x++;  }    
                                              }else{
                                                  echo ' <div class="empty alert bg-warning">
                                                            <div class="emptyMessage">There are no ordered Items!</div>
                                                        </div>';
                                              }
                                           }else{ ?>
                                               <div class="empty alert bg-warning">
                                                     <div class="emptyMessage">There are no ordered Items!</div>
                                               </div>
                                        <?php   }  ?>
                                    
                                        </div>
                                 </div>
                             </div>
                      </div>            
</section>








<?php
 if(Session::exists(Config::get("session/session_name")) && $paidOrder->get("paid_order", array("user_id", "=", $user_id))->count()){ 
       
    ?>

<section>
    <div class="shipping-item-address">
        <div class="container">
            <div class="cart-header order">
                <h2>Delivery address</h2>
            </div>
            <?php
                    if($paidOrder->get("paid_order", array("user_id", "=", $user_id))->count()){
                         foreach($paidOrder->result() as $values){ ?>
                                <div class="addresses">
                                    <span class="badge btn-warning">1</span>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <ul class="ship-address">
                                            <li class="ship-head">Shipping Method: </li>
                                            <li class="ship-add text-warning">standard 3 - 6 Working days</li>
                                            <li class="ship-add">Name: alonge</li>
                                            <li class="ship-add">Contact: <?= $values["phone"]; ?></li>
                                        </ul>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <ul class="ship-address">
                                                <li class="ship-head">Billing Address: </li>
                                                <li class="ship-add"><?= $values["address"]; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <ul class="ship-address">
                                                <li class="ship-head">Shipping Address: </li>
                                                <li class="ship-add"><?= $values["shipping_address"]; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                     <?php    }
                    }
            ?>
        </div>
    </div>
</section>

    <?php }  ?>



             <!-- FOOTER SECTION -->
             <section class="footer">
                   <?php
                         require_once "footer.php";
                   ?>
              </section>
            

            
