<?php
   require_once "includes/header.php"; 
   if(Session::exists("error")){
       echo Session::flash("error");
   }
?>

  


      
             <!-- MAIN CONTENT  -->
             <section class="sidebar-section">
              
                      <!-- side bar -->
                      <div class="container">
                          <div class="row">
                              <div class="side col-lg-3 col-md-3">
                                 <?php
                                       require_once "includes/sidebar.php";
                                 ?>                              
                       </div>
                              <!-- MAIN PAGE IMAGES -->
                                          <div class="col-lg-9 col-md-9 main">
                                              <div class="row">
                                                    <div class="col-lg-12 col-md-12 expland">
                                                      <div class="main-images slideContainer">
                                                          <div class="slide slideItem">
                                                              <img src="images/main-image_1.jpg" alt="main-image-1" class="main-img">
                                                               <div class="tag">
                                                                  <h2>gifts at every price</h2>
                                                               </div>
                                                          </div>
                                                          <div class="slide slideItem" style="display: block;">
                                                              <img src="images/index-slide-2.jpg" alt="index-slide-2" class="main-img">
                                                              <div class="tag">
                                                                <h2>free online shopping</h2>
                                                                <a href="">explore</a>
                                                             </div>
                                                          </div>
                                                          <div class="slide slideItem">
                                                              <img src="images/index-slide-3.jpg" alt="index-slide-3" class="main-img">
                                                              <div class="tag">
                                                                <h2>get upto 30% off <br>new arivals</h2>
                                                             </div>
                                                          </div>
                                                               <div class="courosel">
                                                                   <span class="dot" current="1"></span>
                                                                   <span class="dot active" current="2"></span>
                                                                   <span class="dot" current="3"></span>
                                                               </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                   
      
                                            
                                             
                                            <!-- MOBILE DEVICE WEEKLY DEALS -->
                                            <?php 
                                                   require_once "includes/weekly_deal.php";
                                            ?>


                                        

                                                 <div class="items-category-container myScroll" data-action="slide" data-delay="0.5s" data-bottom="120">
                                                      <div class="cat-header">
                                                           <h2>Items categories</h2>
                                                      </div>
                                                      <div class="row">
                                                       <?php
                                                             foreach($categories->result() as $items){ ?>
                                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                                        <div class="cat-item myScrollItem">
                                                                                <a href="product.php?item=<?= $items["name"]?>&category=<?= $items["id"]?>"><img src="images/<?= $items["image"]; ?>" alt="main-image-3"></a>
                                                                                <h4><?= $items["name"]?></h4>
                                                                                <p>Best sellers there is in online clothing market.</p>
                                                                        </div>
                                                                    </div>
                                                      <?php } ?>
                                                   </div>
                                                 </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- end of main -->
                                          </div>
                                      </div>
                                    
                          </section>
      









                          <!-- FOOTER SECTION -->
                          <section class="footer">
                               <?php require_once "footer.php"; ?>
                          </section>
      