<?php require_once "includes/header.php"; ?>
<?php
    if(Input::exists("get")){
        $productID =  Input::get("product");
        $product = new Product();
        $product->get("products", array("id", "=", $productID));
        $productItems = $product->first();
    }
?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product" id="product-detail">
                         <div class="products-header"><i class="fa fa-cubes"></i>Product Detail</i></div>
                         <div class="products-items-container">
                            <div class="profile-details-header" style="text-transform: uppercase;"><?= $productItems->name; ?></div>
                            <div class="product-detail-cont">
                                 <div class="row">
                                     <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                        <div class="frame-container swipperFrame">
                                            <div class="frame swipper">
                                                <?php
                                                    $productImage = explode(",",$productItems->image);
                                                     foreach($productImage as $images){ ?>
                                                        <div class="frame-item">
                                                            <img src="images/<?= $images; ?>" alt="<?= $images; ?>">
                                                        </div>
                                                 <?php 
                                                  }
                                                ?>
                                            </div>
                                            <div class="direction">
                                                <i class="fa fa-angle-left 3"></i>
                                                <i class="fa fa-angle-right 4"></i>
                                            </div>
                                        </div><br>
                                     </div>
                                     <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                         <div class="detail-mirror">
                                              <div class="deatail-mirror-header">
                                                    <h2><?= $productItems->brand; ?></h2>
                                                   <ul>
                                                       <li><?php
                                                           $ratings = new Ratings($productID);
                                                           $ratings->star_ratings();   
                                                       ?></li>
                                                   </ul>
                                             </div>
                                             <div class="row mirrorContainer">
                                             <?php
                                                  if($product->count()){
                                                    $productItems = $product->first();
                                                    $productImage = explode(",",$productItems->image);
                                                     foreach($productImage as $images){ ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-2 col-2">
                                                            <div class="mirror-items mirror">
                                                                <img src="images/<?= $images; ?>" alt="<?= $images; ?>">
                                                            </div>
                                                        </div>
                                                 <?php }
                                                  }
                                                ?>
                                             </div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <ul class="detail-details">
                                                    <li><b>Name: </b> <span><?= $productItems->name; ?></span></li>
                                                    <li><b>Price: </b> <span class="text-danger"><?= Input::money($productItems->price); ?></span></li>
                                                    <li><b>Make: </b> <span class="text-primary">playstation</span></li>
                                                    <li><b>Brand: </b> <span><?= $productItems->brand; ?></span></li>
                                                    <li class="text-warning productQty"><b>Quantity: </b> <span><?= $productItems->quantity; ?></span></li>
                                                </ul>
                                         </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                         <div class="detail-description-container">
                                             <div class="description-header">Product Details</div>
                                             <div class="description-body" id="description-body">
                                                 <p><?= nl2br($productItems->description); ?></p>
                                             </div>
                                            
                                         </div>
                                     </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="detail-description-container">
                                                    <div class="description-header">Specification</div>
                                                    <div class="description-body" id="specification-body">
                                                        <ul>
                                                            <li><b> SKU:</b> 2K009EL1EN81MNAFAMZ</li>
                                                            <li><b> Color:</b> PS4</li>
                                                            <li><b> Main Material:</b> CD</li>
                                                            <li> <b>Model:</b> PS4</li>
                                                            <li><b> Product Line:</b> Chibyke Merchandize Networks</li>
                                                            <li><b>Weight (kg):</b> 0.2</li>
                                                        </ul>
                                                </div>
                                            </div>
                                     </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="detail-description-container">
                                                    <div class="description-header">Customer Feedback <span><a href="#">see all</a></span></div>
                                                    <div class="description-body">
                                                       <div class="row">
                                                            <div class="col-lg-4 col-md-4">
                                                                <div class="product-ratings-container">
                                                                    <div class="product-ratings-header">Product Ratings (1550)</div>
                                                                    <div class="prodcut-ratings-body">
                                                                        <div class="col-lg-12 rating-banner">
                                                                            <ul>
                                                                                <?php
                                                                                    $stars =  $ratings = new Ratings($productID); 
                                                                                    $stars->percentage(5);
                                                                                ?>
                                                                                <li class="banner-header text-warning"><b><?= $ratings->rate(); ?></b>/5</li>
                                                                                <li><?= $stars->star_ratings(); ?></li>
                                                                                <li>Ratings (<?= $stars->total_count();?>)</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-lg-12 ratings-bars">
                                                                            <ul class="bars product-detail-star-ratings" data-direction="width" data-top="200" data-type="count">
                                                                                <li><div class="bar bg-warning" data-percentage="<?= $stars->percentage(5);?>" ></div><span> <b>5</b>  <i class="far fa-star text-warning"></i>(<?= $stars->rate_count(5);?>)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="<?= $stars->percentage(4);?>" ></div><span> <b>4</b>  <i class="far fa-star text-warning"></i>(<?= $stars->rate_count(4);?>)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="<?= $stars->percentage(3);?>" ></div><span> <b>3</b>  <i class="far fa-star text-warning"></i>(<?= $stars->rate_count(3);?>)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="<?= $stars->percentage(2);?>" ></div><span> <b>2</b>  <i class="far fa-star text-warning"></i>(<?= $stars->rate_count(2);?>)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="<?= $stars->percentage(1);?>" ></div><span> <b>1</b>  <i class="far fa-star text-warning"></i>(<?= $stars->rate_count(1);?>)</span></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8">
                                                                <div class="product-review-container">
                                                                <?php
                                                                    $user = new User();
                                                                    $user->get("comment", array("product_id", "=", $productItems->id));
                                                                ?>
                                                                    <div class="product-review-header">Product Review (<?= $user->count() ?>)</div>
                                                                    <div class="product-review-body">
                                                                    <?php
                                                                        if($user->count()){ 
                                                                            foreach($user->result() as $values){ ?>
                                                                                <ul>
                                                                                    <li>
                                                                                        <span>By sharon</span> 
                                                                                        <?php
                                                                                           Ratings::user_rate($values->ratings);
                                                                                        ?>
                                                                                    </li>
                                                                                    <li class="review-title"><?= $values->title; ?></li>
                                                                                    <li class="review-paragraph"><?= $values->comment; ?></li>
                                                                                    <li>
                                                                                        <span class=""><?= Input::date($values->date); ?></span>
                                                                                        <span class="verified <?= $values->verified ? "text-success" : "text-danger";?>"><i class="fa <?= $values->verified ? "fa-check" : "fa-times"?>"></i><?= $values->verified ? "verified purchase" : "Not verified";?></span>
                                                                                    </li>
                                                                                </ul>
                                                                        <?php }
                                                                        ?>   
                                                                    <?php }else{
                                                                        echo '<div class="alert alert-danger" style="margin-top: 50px;">There are no user comments!</div>';
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
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




   <!-- footer -->
   <?php require_once "includes/footer.php"; ?>