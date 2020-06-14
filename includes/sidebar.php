                                <div class="side-bar">
                                     <div class="bar-header"><i class="fas fa-bars"></i><span>Categories</span></div> 
                                     <div class="category-links sidebarActive">
                                        <ul class="sideLink">
                                                <?php
                                                    foreach($categories->result() as $items){ ?>
                                                            <li class="link"><?= $items["name"]; ?> 
                                                        <?php  
                                                            $feature = array("featured", "=", true);
                                                            $dropDown = new Category();
                                                            if($dropDown->get("sub_categories", array("categories_id", "=", $items["id"]), [$feature])->count() > 0){ ?>
                                                                <div class="dropdown">
                                                                        <ul>
                                                                        <?php  foreach($dropDown->result() as $values){ ?>
                                                                            <li><a href="product.php?name=<?=$values["name"];?>&slug=<?=$values["id"];?>"> <?=$values["name"];?></a></li>
                                                                        <?php   }  ?>
                                                                        </ul>  
                                                                    </div>
                                                        <?php   }  ?>
                                                            </li>
                                                 <?php }  ?>
                                         </ul>
                                      </div>
                                </div>





                                  
                                <!-- WEEKLY FEATURED to be set to none on mobile view-->
                              <div class="week">
                                  <?php
                                   $date = date("Y-m-d H:i:s", time() - (7 * 86400));
                                   $weekly = new Category();
                                   $weekly->rand("products", array("date", ">=", $date), 4);
                                  if($weekly->count()){
                                     echo' <div class="week-header"><h2>weekly featured</h2></div>';
                                        foreach($weekly->result() as $values){ 
                                            $images = Input::json_decode($values["image"]);
                                            ?>
                                                <div class="weekly-item">
                                                    <a href="detail.php?product=<?= $values["id"];?>&slug=<?= $values["slug"];?>"><img src="images/<?= $images[0]; ?>" alt="women_shoe"></a>
                                                    <ul>
                                                        <li><?= $values["name"]; ?></li>
                                                        <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                        <li><?= Input::money($values["price"]); ?></li>
                                                        <li><a href="detail.php?product=<?= $values["id"];?>&slug=<?= $values["slug"];?>" class="show-detail-btn">Show Details</a></li>
                                                    </ul>
                                                </div>
                                    <?php    }
                                  }
                                  ?>
                              </div>