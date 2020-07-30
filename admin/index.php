<?php require_once "includes/header.php"; ?>

    

    <!-- DASH BOARD SECTION-->
    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
            <div class="row">
                <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                
                <div class="col-lg-10  removePadding" id="sideNavStickyPosition">
                    <div class="main-content">
                         <div class="main-content-home-logo"><i class="fas fa-home"></i>Dashboard</div>
                          <div class="main-content-container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="main-content-thumb one">
                                            <ul>
                                                <li class="thumb-header">Weekly Sales <i class="fas fa-chart-bar"></i></li>
                                                <li class="thumb-money">₦50,000</li>
                                                <li class="thumb-rate">increase by 60%</li>
                                            </ul>
                                        </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="main-content-thumb two">
                                        <ul>
                                            <li class="thumb-header">Weekly Orders <i class="fas fa-calculator"></i></li>
                                            <li class="thumb-money">24,000</li>
                                            <li class="thumb-rate">increase by 60%</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="main-content-thumb three">
                                        <ul>
                                            <li class="thumb-header">Online Visitors <i class="fas fa-globe"></i></li>
                                            <li class="thumb-money">55,000</li>
                                            <li class="thumb-rate">increase by 60%</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="bar-chart">
                                         <div class="bar-chart-header">Total Income</div>
                                          <ul class="stats">
                                                <li class="">₦28,000 <div>products</div></li>
                                                <li class="stats-item">₦78,000 <div>Sales</div></li>
                                                <li class="">₦48,000 <div>Cost</div></li>
                                                <li class="">₦98,000 <div>Revenue</div></li>
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
                                          <div class="top-sale-header">Top Salling Products <span><a href="#">view more</a></span></div>
                                          <div class="top-sales-items">
                                            <ul class="sale-image">
                                                <li><a href="product_detail.php"><img src="images/bag_1.jpg" alt="bag_1"></a></li>
                                            </ul>
                                            <ul class="sale-info">
                                                <li class="sale-name">black bag</li>
                                                <li>levis</li>
                                                <li>
                                                    <i class="far fa-star rate"></i>
                                                    <i class="far fa-star rate"></i>
                                                    <i class="far fa-star rate"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </li>
                                            </ul>
                                            <ul class="sales-amount">
                                                <li class="saleAmount">₦98,000 <div>Sales</div></li>
                                            </ul>
                                        </div>
                                        <div class="top-sales-items">
                                                <ul class="sale-image">
                                                    <li><a href="product_detail.php"><img src="images/crash-nitro-fueld.jpg" alt="crash-nitro-fueld"></a></li>
                                                </ul>
                                                <ul class="sale-info">
                                                    <li class="sale-name">Crash nitro-fueld</li>
                                                    <li>levis</li>
                                                    <li>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </li>
                                                </ul>
                                                <ul class="sales-amount">
                                                  <li class="saleAmount">₦108,000 <div>Sales</div></li>
                                                </ul>
                                         </div>
                                            <div class="top-sales-items">
                                                <ul class="sale-image">
                                                    <li><a href="product_detail.php"><img src="images/camera.jpg" alt="camera"></a></li>
                                                </ul>
                                                <ul class="sale-info">
                                                    <li class="sale-name">Camera</li>
                                                    <li>Addidass</li>
                                                    <li>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star rate"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </li>
                                                </ul>
                                                <ul class="sales-amount">
                                                    <li class="saleAmount">₦78,000 <div>Sales</div></li>
                                                </ul>
                                            </div>
                                    </div>
                                </div> <!--end-->

                                <!--  ORDER ACTIVITY-->
                                <div class="col-lg-12">
                                    <div class="order-activity">
                                        <div class="order-activity-header">Order Activity <span><a href="#">view more</a></span></div>
                                        <div class="col-lg-12">
                                                <div class="order-activity-container">
                                                    <div class="order-activity-drop-down parent">
                                                        <i class="fa fa-ellipsis-h actionButton"></i>
                                                        <ul class="order-dropdown childDropDown">
                                                            <li><a href="order-detail.php"><i class="fa fa-info"></i>Show Order</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                        </ul>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-lg-7" id="order-activity-cont">
                                                            <a href="profile.php" class="order-act-image"><img src="profile-image/andrea.jpg" alt="andrea"></a>
                                                            <ul class="order-user">
                                                                <li class="order-act-name"><a href="#">Boogie Saun</a></li>
                                                                <li>10 andrea alonzo avenue outta space close to jupiter</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-5" id="order-activity-image">
                                                            <a href="product_detail.php"><img src="images/chair_1.jpg" alt="chair_1"></a>
                                                            <a href="product_detail.php"><img src="images/console_2.jpg" alt="console_2"></a>
                                                            <a href="product_detail.php"><img src="images/blue-shirt.jpg" alt="blue-shirt"></a>
                                                        </div>
                                                     </div>
                                                </div>
                                                <div class="order-activity-container">
                                                    <div class="order-activity-drop-down parent">
                                                        <i class="fa fa-ellipsis-h actionButton"></i>
                                                        <ul class="order-dropdown childDropDown">
                                                            <li><a href="order-detail.php"><i class="fa fa-info"></i>Show Order</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                        </ul>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-7" id="order-activity-cont">
                                                            <a href="profile.php" class="order-act-image"><img src="profile-image/profile-image-2.jpg" alt="profile-image-2"></a>
                                                            <ul class="order-user">
                                                                <li class="order-act-name"><a href="#">Boogie Saun</a></li>
                                                                <li>10 andrea alonzo avenue outta space close to jupiter</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-5" id="order-activity-image">
                                                            <a href="product_detail.php"><img src="images/women_shoe.jpg" alt="women_shoe"></a>    
                                                            <a href="product_detail.php"><img src="images/nba_2k19.jpg" alt="nba_2k19"></a>    
                                                            <a href="product_detail.php"><img src="images/laptop.jpg" alt="laptop"></a>    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-activity-container">
                                                    <div class="order-activity-drop-down parent">
                                                        <i class="fa fa-ellipsis-h actionButton"></i>
                                                        <ul class="order-dropdown childDropDown">
                                                            <li><a href="order-detail.php"><i class="fa fa-info"></i>Show Order</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                        </ul>
                                                        
                                                    </div>
                                                        <div class="row">
                                                        <div class="col-lg-7" id="order-activity-cont">
                                                            <a href="profile.php" class="order-act-image"><img src="profile-image/manderez.jpg" alt="manderez"></a>
                                                            <ul class="order-user">
                                                                <li class="order-act-name"><a href="#">Boogie Saun</a></li>
                                                                <li>10 andrea alonzo avenue outta space close to jupiter</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-5" id="order-activity-image">
                                                            <a href="product_detail.php"><img src="images/madden-20.jpg" alt="madden-20"></a>
                                                            <a href="product_detail.php"><img src="images/callofduty_modern-warfare.jpg" alt="callofduty_modern-warfare"></a>
                                                            <a href="product_detail.php"><img src="images/green-watch.jpg" alt="green-watch"></a></a>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="order-activity-container">
                                                    <div class="order-activity-drop-down parent">
                                                        <i class="fa fa-ellipsis-h actionButton"></i>
                                                        <ul class="order-dropdown childDropDown">
                                                            <li><a href="order-detail.php"><i class="fa fa-info"></i>Show Order</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete Order</a></li>
                                                        </ul>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-7" id="order-activity-cont">
                                                            <a href="profile.php" class="order-act-image"><img src="profile-image/profile-image-3.jpg" alt="profile-image-3"></a>
                                                            <ul class="order-user">
                                                                <li class="order-act-name"><a href="#">Boogie Saun</a></li>
                                                                <li>10 andrea alonzo avenue outta space close to jupiter</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-lg-5" id="order-activity-image">
                                                           <a href="product_detail.php"><img src="images/crash-nitro-fueld.jpg" alt="crash-nitro-fueld"></a>   
                                                           <a href="product_detail.php"><img src="images/console_2.jpg" alt="console_2"></a>   
                                                           <a href="product_detail.php"><img src="images/women2.jpg" alt="women2"></a>   
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                    </div>
                                </div> <!--end of order activity-->
                                <div class="col-lg-12">
                                    <div class="sold-product-container">
                                        <div class="sold-products-header">Sold Products <span><a href="#"><i class="fas fa-desktop"></i></a></i><i class="fas fa-trash"></i></span></div>
                                        <div class="sold-products-table">
                                             <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" value="all"></th>
                                                            <th>Products</th>
                                                            <th>Price</th>
                                                            <th>Sold</th>
                                                            <th>Discount</th>
                                                            <th>Available Qty</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <form action="" method="post">
                                                                <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                <td>
                                                                    <ul>
                                                                        <li><a href="product_detail.php"><img src="images/crash-nitro-fueld.jpg" alt="crash-nitro-fueld"></a></li>
                                                                        <li>Crash Bandicoot</li>
                                                                    </ul>
                                                                </td>
                                                                <td><li class="data">₦15,000</li></td>
                                                                <td><li class="data">2</li></td>
                                                                <td><li class="data">₦1,000</li></td>
                                                                <td><li class="data">4</li></td>
                                                                <td>
                                                                    <li class="data soldDelete">
                                                                        <input type="hidden" value="id">
                                                                        <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                    </li>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                        <tr>
                                                                <form action="" method="post">
                                                                    <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                    <td>
                                                                        <ul>
                                                                            <li><a href="product_detail.php"><img src="images/blue-shirt.jpg" alt="blue-shirt"></a></li>
                                                                            <li>Blue Shirt</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td><li class="data">₦6,000</li></td>
                                                                    <td><li class="data">2</li></td>
                                                                    <td><li class="data">₦500</li></td>
                                                                    <td><li class="data">2</li></td>
                                                                    <td>
                                                                        <li class="data soldDelete">
                                                                            <input type="hidden" value="id">
                                                                            <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                        </li>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                            <tr>
                                                            <form action="" method="post">
                                                                <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                <td>
                                                                    <ul>
                                                                        <li><a href="product_detail.php"><img src="images/green-watch.jpg" alt="green-watch"></a></li>
                                                                        <li>Metro Watch</li>
                                                                    </ul>
                                                                </td>
                                                                <td><li class="data">₦25,000</li></td>
                                                                <td><li class="data">1</li></td>
                                                                <td><li class="data">₦5,000</li></td>
                                                                <td><li class="data">8</li></td>
                                                                <td>
                                                                    <li class="data soldDelete">
                                                                        <input type="hidden" value="id">
                                                                        <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                    </li>
                                                                </td>
                                                            </form>
                                                            </tr>
                                                            <tr>
                                                                <form action="" method="post">
                                                                    <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                    <td>
                                                                        <ul>
                                                                            <li><a href="product_detail.php"><img src="images/madden-20.jpg" alt="madden-20"></a></li>
                                                                            <li>Madden</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td><li class="data">₦8,000</li></td>
                                                                    <td><li class="data">1</li></td>
                                                                    <td><li class="data">₦2,000</li></td>
                                                                    <td><li class="data">5</li></td>
                                                                    <td>
                                                                        <li class="data soldDelete">
                                                                            <input type="hidden" value="id">
                                                                            <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                        </li>
                                                                    </td>
                                                                </form>
                                                            </tr>
                                                            <tr>
                                                                <form action="" method="post">
                                                                    <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                    <td>
                                                                        <ul>
                                                                            <li><a href="product_detail.php"><img src="images/laptop.jpg" alt="laptop"></a></li>
                                                                            <li>Laptop</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td><li class="data">₦120,000</li></td>
                                                                    <td><li class="data">1</li></td>
                                                                    <td><li class="data">₦2,000</li></td>
                                                                    <td><li class="data">5</li></td>
                                                                    <td>
                                                                        <li class="data soldDelete">
                                                                            <input type="hidden" value="id">
                                                                            <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                        </li>
                                                                    </td>
                                                                </form>
                                                             </tr>
                                                             <tr>
                                                                <form action="" method="post">
                                                                    <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                                    <td>
                                                                        <ul>
                                                                            <li><a href="product_detail.php"><img src="images/camera.jpg" alt="camera"></a></li>
                                                                            <li>Camera</li>
                                                                        </ul>
                                                                    </td>
                                                                    <td><li class="data">₦98,000</li></td>
                                                                    <td><li class="data">1</li></td>
                                                                    <td><li class="data">₦7,000</li></td>
                                                                    <td><li class="data">9</li></td>
                                                                    <td>
                                                                        <li class="data soldDelete">
                                                                            <input type="hidden" value="id">
                                                                            <button type="submit" name="soldDelete" class="soldDelete">Delete</button>
                                                                        </li>
                                                                    </td>
                                                                </form>
                                                             </tr>
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
