<?php require_once "includes/header.php"; ?>
<?php
    if(Input::exists("get")){
        $productID =  Input::get("product");
        $product = new Product();
        $product->get("products", array("id", "=", $productID));
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
                            <div class="profile-details-header">NBA 2k19</div>
                            <div class="product-detail-cont">
                                 <div class="row">
                                     <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                        <div class="frame-container swipperFrame">
                                            <div class="frame swipper">
                                                <?php
                                                  if($product->count()){
                                                    $productItems = $product->first();
                                                    $productImage = Input::json_decode($productItems->image);
                                                     foreach($productImage as $images){ ?>
                                                        <div class="frame-item">
                                                            <img src="images/<?= $images; ?>" alt="<?= $images; ?>">
                                                        </div>
                                                 <?php }
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
                                                    <h2>Playstation</h2>
                                                   <ul>
                                                       <li> <i class="far fa-star rate"></i>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i></li>
                                                   </ul>
                                             </div>
                                             <div class="row mirrorContainer">
                                             <?php
                                                  if($product->count()){
                                                    $productItems = $product->first();
                                                    $productImage = Input::json_decode($productItems->image);
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
                                                 <p>
                                                        2K continues to deliver what's possible in sports gaming with NBA 2K20, featuring best in class graphics & gameplay, ground breaking game modes, and unparallel player control and customization.

                                                        NBA 2K has evolved into much more than a basketball simulation. 2K continues to deliver what's possible in sports gaming with NBA 2K20, featuring best in class graphics & gameplay, ground breaking game modes, and unparallel player control and customization. Plus, with its immersive open world Neighborhood, NBA 2K20 is a platform for gamers and ballers to come together and create what's next in basketball culture.
                                                        
                                                        Pre Order NBA 2K20 now to receive bonus in game content!
                                                 </p>
                                                 <ul>
                                                     <li>5,000 Virtual Currency</li>
                                                     <li>5,000 MyTEAM Points</li>
                                                     <li>5 MyCAREER Skill Boosts</li>
                                                     <li>MyPLAYER Clothing Capsule</li>
                                                     <li>10 MyTEAM League packs (delivered one a week)</li>
                                                     <li>5 Heat Check packs (delivered one a week beginning at the start of the NBA season)</li>
                                                 </ul>
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
                                                                                <li class="banner-header text-warning"><b>4</b>/5</li>
                                                                                <li> <i class="far fa-star text-warning"></i>
                                                                                    <i class="far fa-star text-warning"></i>
                                                                                    <i class="far fa-star text-warning"></i>
                                                                                    <i class="far fa-star text-warning"></i>
                                                                                    <i class="far fa-star"></i>
                                                                                </li>
                                                                                <li>Ratings (1550)</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-lg-12 ratings-bars">
                                                                            <ul class="bars product-detail-star-ratings" data-direction="width" data-top="200" data-type="count">
                                                                                <li><div class="bar bg-warning" data-percentage="80" ></div><span> <b>5</b>  <i class="far fa-star text-warning"></i>(1550)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="60" ></div><span> <b>4</b>  <i class="far fa-star text-warning"></i>(1200)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="40" ></div><span> <b>3</b>  <i class="far fa-star text-warning"></i>(650)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="20" ></div><span> <b>2</b>  <i class="far fa-star text-warning"></i>(300)</span></li>
                                                                                <li><div class="bar bg-warning" data-percentage="10" ></div><span> <b>1</b>  <i class="far fa-star text-warning"></i>(100)</span></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8">
                                                                <div class="product-review-container">
                                                                    <div class="product-review-header">Product Review (23)</div>
                                                                    <div class="product-review-body">
                                                                        <ul>
                                                                            <li>
                                                                                <span>By sharon</span> 
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star"></i>
                                                                                <i class="far fa-star"></i> 
                                                                            </li>
                                                                            <li class="review-title">i love the product</li>
                                                                            <li class="review-paragraph">this is the most wonderful tranaction i have ever made , i love buy hub.</li>
                                                                            <li>
                                                                                <span class="">28-12-2020</span>
                                                                                <span class="verified text-success"><i class="fa fa-check"></i>Verified purchase</span>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <span>By maxwell</span> 
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star"></i>
                                                                                <i class="far fa-star"></i> 
                                                                            </li>
                                                                            <li class="review-title">lovely product</li>
                                                                            <li class="review-paragraph">this is the most wonderful tranaction i have ever made , i love buy hub.</li>
                                                                            <li>
                                                                                <span class="">28-12-2020</span>
                                                                                <span class="verified text-success"><i class="fa fa-check"></i>Verified purchase</span>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <span>By blessing</span> 
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star"></i> 
                                                                            </li>
                                                                            <li class="review-title">i like this product</li>
                                                                            <li class="review-paragraph">this is the most wonderful tranaction i have ever made , i love buy hub.</li>
                                                                            <li>
                                                                                <span class="">28-12-2020</span>
                                                                                <span class="verified text-success"><i class="fa fa-check"></i>Verified purchase</span>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <span>By toyin</span> 
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i> 
                                                                            </li>
                                                                            <li class="review-title">i love the product</li>
                                                                            <li class="review-paragraph">this is the most wonderful tranaction i have ever made , i love buy hub.</li>
                                                                            <li>
                                                                                <span class="">28-12-2020</span>
                                                                                <span class="verified text-success"><i class="fa fa-check"></i>Verified purchase</span>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <span>By chima</span> 
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star rate"></i>
                                                                                <i class="far fa-star"></i>
                                                                                <i class="far fa-star"></i>
                                                                                <i class="far fa-star"></i> 
                                                                            </li>
                                                                            <li class="review-title">awesomeproduct</li>
                                                                            <li class="review-paragraph">this is the most wonderful tranaction i have ever made , i love buy hub.</li>
                                                                            <li>
                                                                                <span class="">28-12-2020</span>
                                                                                <span class="verified text-success"><i class="fa fa-check"></i>Verified purchase</span>
                                                                            </li>
                                                                        </ul>
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