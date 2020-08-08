<?php require_once "includes/header.php";

$orders = new Order();
$orders->get("paid_order");
?>


    <!-- DASH BOARD SECTION-->
    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
            <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                <div class="col-lg-10  removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                         <div class="main-content-home-logo"><i class="fas fa-cubes"></i>Top Selling Products</div>
                          <div class="main-content-container"><br>
                                <!-- top sales -->
                                <div class="col-lg-12">
                                    <div class="top-sales">
                                          <div class="top-sale-header">Top Selling</div>
                                          <?php
                                                $topSelling = new Product();
                                                $topSelling->select("products", array("sold"));
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
                                                            <li class="saleAmount"><?= Input::money($values->price * $values->sold);?><div>Sales <span class="text-warning">(<?= $values->sold;?>)</span></div></li>
                                                        </ul>
                                                    </div>
                                             <?php }
                                            ?>
                                    </div>
                                </div> <!--end-->

                            </div>
                          </div>
                    </div>
                </div> <!-- end-->
            </div>
    </section>
    

  <!-- footer -->
  <?php require_once "includes/footer.php"; ?>