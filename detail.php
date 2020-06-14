<?php
     require_once "includes/header.php";
?>


       <!-- DETAIL SECTION -->
<?php
$productOBJ = new Category();
if(is_numeric(Input::get("product")) && $productOBJ->get("products", array("slug", "=", Input::get("slug")))->count()){ 
  // echo $cateoryID = $productOBJ->get("categories", array("id", "=", Input::get("product")))->first()["id"];
    $productOBJ->get("products", array("id", "=", Input::get("product")))->first();
?>
      

<section class="detail-body">
       <div class="container">
        <div class="inner-detail-body">
                <div class="detail-container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                             <div class="detail-header">
                                 <h1><?= $productOBJ->first()["name"];?></h1>
                                 <ul>
                                     <li class="item-name">native</li>
                                     <li><i class="fas fa-star star-detail"></i><i class="fas fa-star star-detail"></i><i class="fas fa-star star-detail"></i><i class="fas fa-star star-detail"></i><i class="fas fa-star star-detail"></i> <span>69 Ratings</span></li>
                                 </ul>
                             </div>
                             <div class="detail-images">
                                   <div class="detail-slide-frame swiper-container">
                                         <div class="main-detail-image swiper-track">
                                         <?php
                                              $image = Input::json_decode($productOBJ->first()["image"]);
                                              foreach($image as $imageValues){ ?>
                                                    <div class="detailImages">
                                                        <img src="images/<?= $imageValues?>" alt="<?= $productOBJ->first()["name"]?>">
                                                    </div>
                                         <?php  }  ?>
                                          </div>
                                   </div>
                                 <div class="detail-sub-image">
                                            <div class="subImage-container swiper-container">
                                                <div class="subImage-frame swiper-track">
                                                  <?php
                                                       $subImageOBJ = new Category();
                                                       $slug = $productOBJ->first()["slug"];
                                                       $id = $productOBJ->first()["id"];
                                                       $items = $subImageOBJ->get("products", array("slug", "=", $slug))->result();
                                                      foreach($items as $subItems){ 
                                                            $subImages = Input::json_decode($subItems["image"]);
                                                          ?>
                                                            <div class="sub-image <?= Input::get("product") == $subItems["id"]? "active-image" : ""?>">
                                                              <a href="detail.php?product=<?= $subItems["id"];?>&slug=<?= $subItems["slug"];?>"><img src="images/<?= $subImages[0]; ?>" alt="<?= $items["name"]?>"></a>
                                                            </div>
                                                    <?php  } ?>
                                            </div>
                                            <div class="angle swipper-direction">
                                                <i class="fas fa-angle-left"></i>
                                                <i class="fas fa-angle-right"></i>
                                            </div>
                                         </div>
                                 </div>
                                 <div class="direction swipper-direction">
                                     <i class="fas fa-angle-left"></i>
                                     <i class="fas fa-angle-right"></i>
                                 </div>
                                 <div class="carousel">
                                     <!-- <span class="active-detail-image"></span> -->
                                 </div>
                             </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                               <div class="detail-side-bar">
                                     <div class="detail-price">
                                         <h2><?= Input::money($productOBJ->first()["price"]); ?></h2>
                                         <ul>
                                              <li><b>Color:</b> <span>black Native</span></li>
                                         </ul>
                                     </div>
                                      <div class="detail-thumb-container">
                                             <div class="row">
                                             <?php
                                                $image = Input::json_decode($productOBJ->first()["image"]);
                                                foreach($image as $imageValues){ ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-3 col-4 detail-thumb">
                                                                <div class="detail-thumb-image">
                                                                    <img src="images/<?= $imageValues; ?>" alt="<?= $productOBJ->first()["name"]?>">
                                                                </div>
                                                        </div>
                                             <?php  }  ?>
                                             </div>
                                      </div>
                                      <div class="quantity">
                                          <ul>
                                              <li><b>Quantity Available: </b><?=  $productOBJ->first()["quantity"] == 0 ? "<span>out of stock</span>" :  '('.$productOBJ->first()["quantity"].')' ;?></li>
                                          </ul>
                                      </div>
                                     <div class="size">
                                        <form action="" method="post" class="">
                                             <div class="form-group">
                                                 <label for="quantity">Quantity: </label>
                                                 <input type="number" name="itemQuantity" class="form-control itemQuantity" min="1" value="1">
                                             </div>
                                             <p>Delivery: 3-5 working days </p>
                                             <p>Shipping fee: ₦1300</p>
                                             <input type="hidden" name="itemID" value="<?= $productOBJ->first()["id"]; ?>">
                                             <input type="submit" name="addToCart"  class="form-control submit-item" value="Add To Cart">
                                             <input type="submit" name="buyNow" class="form-control save-to-cart" value="Buy Now">
                                        </form>
                                     </div> 
                               </div>
                        </div>
                    </div>
                </div>
      
                 <!--  PRODUCT DETAILS -->
                <div class="product-details">
                          <div class="row">
                                <div class="col-lg-8 col-md-8">
                                     <div class="product-detail-header">
                                         <h2>Product Detail</h2>
                                     </div>
                                     <div class="product-detail-body">
                                         <h2>Description:</h2>
                                         <p>Mens africanclothing tribal dashiki traditional maxi stand collar long sleeves dress shirt plus size.</p>
                                         <h2>feautures:</h2>
                                         <p>African style, Long Sleeves, Tribal Print, Stand Collar, Slim fit, Lightweight, Dress pullover tops.</p>
                                         <h2>Notice:</h2>
                                         <p>If you have any question, please do not hesitate to contact us, we solve your problem as soon as possible until your are satisfied.</p>
                                     </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- FREQUENT BOUGHT SECTION  -->
                                    <div class="frequently-bought">
                                        <h2>Frequent bought together</h2>
                                        <div class="frequently-bought-body sliderFrame">
                                            <?php
                                                $subImageOBJ = new Category();
                                                $slug = $productOBJ->first()["slug"];
                                                $id = $productOBJ->first()["id"];
                                                $items = $subImageOBJ->rand("products", array("slug", "=", $slug), 4)->result();
                                                foreach($items as $subItems){ 
                                                    $subImages = Input::json_decode($subItems["image"]);
                                                    ?>
                                                    <div class="frequently-bought-item slider">
                                                            <div class="ratings">
                                                                    <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                                    <span>85%</span>
                                                            </div>
                                                            <a href="detail.php?product=<?= $subItems["id"];?>&slug=<?= $subItems["slug"];?>"><img src="images/<?= $subImages[0]?>" alt="image-detail-3"></a>
                                                            <h3><?= $subItems["name"]?></h3>
                                                            <ul>
                                                                <li><?= $subItems["description"]?></li>
                                                                <li class="text-danger"><?= Input::money($subItems["price"]);?></li>
                                                            </ul>
                                                    </div>
                                            <?php  } ?>
                                            <div class="direction action">
                                                <i class="fas fa-angle-left"></i>
                                                <i class="fas fa-angle-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                </div>
          </div>
        </div>
</section>
  


        <!-- CUSTOMER VIEWS -->
        <section>
            <div class="customer-view">
                  <div class="customer-view-header">
                      <h2>Customers who viewed this items also viewed</h2>
                      <div class="customer-viewed-body swiper-container">
                          <div class="viewed-container swiper-track">
                               <?php
                                    $subImageOBJ = new Category();
                                    $slug = $productOBJ->first()["slug"];
                                    $id = $productOBJ->first()["id"];
                                    $items = $subImageOBJ->rand("products", array("slug", "=", $slug), 5)->result();
                                    foreach($items as $subItems){ 
                                        $subImages = Input::json_decode($subItems["image"]);
                                        ?>
                                         <div class="viewed-items">
                                            <a href="detail.php?product=<?= $subItems["id"]?>&slug=<?= $subItems["slug"]; ?>"><img src="images/<?= $subImages[0]?>" alt=""></a>
                                            <ul>
                                                <li><?= $subItems["description"]; ?></li>
                                                <li><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></li>
                                                <li class="text-danger price"><?= Input::money($subItems["price"])?></li>
                                            </ul>
                                        </div>
                                <?php  } ?>
                          </div>
                          <div class="view direction swipper-direction">
                              <i class="fas fa-angle-left"></i>
                              <i class="fas fa-angle-right"></i>
                          </div>
                      </div>
                  </div>
            </div>
        </section>
    
        <?php      } ?>
        
    <!-- QUESTION SECTION -->
    <section class="question-container">
             <div class="container">
                <div class="question">
                    <div class="question-header">
                        <h2>Customers Question & answers</h2>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control" value="" placeholder="Have a question?">
                            <button  type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                    <div class="customers">
                        <div class="customer-images">
                            <img src="images/profile-image.png" alt="profile-image">
                            <h3>Morgan Morer</h3>
                            <h4>february 17, 2020</h4>
                        </div>
                        <div class="customers-question">
                              <ul>
                                  <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                                  <li class="custommers-text">this is a very nice peice of traditional wear i love it so much and it fits just perfectly. it 
                                      is cheap and smooth , i got a lot of compliment at the party..
                                  </li>
                                  <li class="delete"><a href="#">Delete</a></li>
                                  <li class="comment"><a href="#">Comment</a></li>
                                  <li class="report"><a href="#">Report Abuse</a></li>
                              </ul>
                        </div>
                   </div>

                   <div class="customers">
                    <div class="customer-images">
                        <img src="images/profile-image.png" alt="profile-image">
                        <h3>Freeman chikason</h3>
                        <h4>february 17, 2020</h4>
                    </div>
                    <div class="customers-question">
                          <ul>
                                <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                                <li class="custommers-text">this is a very nice peice of traditional wear i love it so much and it fits just perfectly. it 
                                    is cheap and smooth , i got a lot of compliment at the party..
                                </li>
                                    <li class="delete"><a href="#">Delete</a></li>
                                    <li class="comment"><a href="#">Comment</a></li>
                                    <li class="report"><a href="#">Report Abuse</a></li>
                                </ul>
                            </div>
                     </div>

                <div class="customers">
                        <div class="customer-images">
                            <img src="images/profile-image.png" alt="profile-image">
                            <h3>Sharon Welfred</h3>
                            <h4>february 17, 2020</h4>
                        </div>
                        <div class="customers-question">
                            <ul>
                                <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                                <li class="custommers-text">this is a very nice peice of traditional wear i love it so much and it fits just perfectly. it 
                                    is cheap and smooth , i got a lot of compliment at the party..
                                </li>
                                <li class="delete"><a href="#">Delete</a></li>
                                <li class="comment"><a href="#">Comment</a></li>
                                <li class="report"><a href="#">Report Abuse</a></li>
                            </ul>
                        </div>
                    </div>
                 </div>
             </div>
    </section>
       




     <!-- ADVERT SECTION -->
    <section class="advertisement">
              <div class="container">
                     <div class="advert-header">
                            <h2>Customers who bought this item also bought</h2>
                     </div>
                     <div class="advert-body">
                         <div class="row">
                               <?php
                                    $subImageOBJ = new Category();
                                    $slug = $productOBJ->first()["slug"];
                                    $categories = $productOBJ->first()["categories"];
                                  
                                    $items = $subImageOBJ->rand("products", array("categories", "=", $categories), 6)->result();
                                    foreach($items as $subItems){ 
                                        $subImages = Input::json_decode($subItems["image"]);
                                        ?>
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                            <div class="advert">
                                            <a href="detail.php?product=<?= $subItems["id"]?>&slug=<?= $subItems["slug"]; ?>"><img src="images/<?= $subImages[0]?>" alt="female-native-3"></a>
                                                <ul>
                                                    <li><?= $subItems["description"]?> <span> ( <?= $subItems["name"]?> ) </span></li>
                                                    <li><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                <?php  } ?>
                         </div>
                     </div>
              </div>
    </section>










<!-- FOOTER SECTION -->
<section class="footer">
      <?php require_once "footer.php"; ?>
  </section>








