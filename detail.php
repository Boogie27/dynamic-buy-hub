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
                                     <li class="item-name"><?=$productOBJ->first()["brand"]; ?></li>
                                     <li>
                                     <?php
                                        $ratings = new Ratings($productOBJ->first()["id"]);
                                        $ratings->star_ratings();   
                                    ?>
                                 </ul>
                             </div>
                             <div class="detail-images">
                                   <div class="detail-slide-frame swiper-container">
                                         <div class="main-detail-image swiper-track">
                                         <?php
                                              $image = explode(",", $productOBJ->first()["image"]);
                                              foreach($image as $imageValues){ ?>
                                                    <div class="detailImages">
                                                        <img src="admin/images/<?= $imageValues?>" alt="<?= $productOBJ->first()["name"]?>">
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
                                                            $subImages = explode(",", $subItems["image"]);
                                                          ?>
                                                            <div class="sub-image <?= Input::get("product") == $subItems["id"]? "active-image" : ""?>">
                                                              <a href="detail.php?product=<?= $subItems["id"];?>&slug=<?= $subItems["slug"];?>"><img src="admin/images/<?= $subImages[0]; ?>" alt="<?= $items["name"]?>"></a>
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
                                                $image = explode(",", $productOBJ->first()["image"]);
                                                foreach($image as $imageValues){ ?>
                                                        <div class="col-lg-4 col-md-4 col-sm-3 col-4 detail-thumb">
                                                                <div class="detail-thumb-image">
                                                                    <img src="admin/images/<?= $imageValues; ?>" alt="<?= $productOBJ->first()["name"]?>">
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
                                         <p><?= nl2br($productOBJ->first()["description"]);?></p>
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
                                                    $subImages = explode(",", $subItems["image"]);
                                                    ?>
                                                    <div class="frequently-bought-item slider">
                                                            <div class="ratings">
                                                            <?php
                                                                $ratings = new Ratings($subItems["id"]);
                                                                $ratings->star_ratings();   
                                                            ?>
                                                            </div>
                                                            <a href="detail.php?product=<?= $subItems["id"];?>&slug=<?= $subItems["slug"];?>"><img src="admin/images/<?= $subImages[0]?>" alt="image-detail-3"></a>
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
                                        $subImages = explode(",", $subItems["image"]);
                                        ?>
                                         <div class="viewed-items">
                                            <a href="detail.php?product=<?= $subItems["id"]?>&slug=<?= $subItems["slug"]; ?>"><img src="admin/images/<?= $subImages[0]?>" alt=""></a>
                                            <ul>
                                                <li><?= $subItems["details"]; ?></li>
                                                <li> <?php
                                                        $ratings = new Ratings($subItems["id"]);
                                                        $ratings->star_ratings();   
                                                    ?></li>
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
                    <?php
                        $user = new User();
                        $user->get("comment", array("product_id", "=", $productOBJ->first()["id"]));
                        if($user->count()){ 
                            foreach($user->result() as $values){
                                $userInfo = $user->get("users", array("id", "=", $values["user_id"]))->first();
                                ?>
                                <div class="customers">
                                    <div class="customer-images">
                                        <img src="admin/<?= $userInfo["image"];?>" alt="<?= $userInfo["image"];?>">
                                        <h3><?= $userInfo["name"];?></h3>
                                        <h4 class="text-danger"><?=Input::date($userInfo["date"]); ?></h4>
                                    </div>
                                    <div class="customers-question">
                                        <ul>
                                            <li><?=  Ratings::user_rate($values["ratings"]);?></li>
                                            <li class="custommers-text"><?=nl2br($values["comment"]); ?>
                                            </li>
                                            <li class="delete"><a href="#">Delete</a></li>
                                            <li class="comment"><a href="#">Comment</a></li>
                                            <li class="report"><a href="#">Report Abuse</a></li>
                                        </ul>
                                     </div>
                                </div>
                            <?php
                            }
                      }
                    ?>
                 </div>
                 <form action="detail.php?product=<?=$productOBJ->first()["id"] ?>&slug=<?= $productOBJ->first()["slug"]?>" method="post">
                    <div class="form-group">
                        <label for="title" style="font-size: 80%;">Title:</label>
                        <input type="text" class="form-control col-md-6" value="">
                    </div>
                    <div class="form-group">
                        <label for="title" style="font-size: 80%;">Comment:</label>
                        <textarea name="comment" id="" class="form-control col-md-6" cols="10" rows="2"></textarea>
                    </div>
                    <button  type="submit" class="btn btn-primary" style="font-size: 60%;">Send</button>
                </form>
             </div>
             <br><br>
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
                                        $subImages = explode(",",$subItems["image"]);
                                        ?>
                                        <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                            <div class="advert">
                                            <a href="detail.php?product=<?= $subItems["id"]?>&slug=<?= $subItems["slug"]; ?>"><img src="images/<?= $subImages[0]?>" alt="female-native-3"></a>
                                                <ul>
                                                    <li><?= $subItems["details"]?> <span> ( <?= $subItems["name"]?> ) </span></li>
                                                    <li> <?php
                                                        $ratings = new Ratings($subItems["id"]);
                                                        $ratings->star_ratings();   
                                                    ?></li>
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








