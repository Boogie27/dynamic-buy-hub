

                                              <!-- WEEKLY DEAL FOR MOBILE DEVICE DISPLAY -->
                             <?php
                                   $date = date("Y-m-d H:i:s", time() - (7 * 86400));
                                   $weekly = new Category();
                                   $weekly->rand("products", array("date", ">=", $date), 4);
                                  if($weekly->count()){ ?>
                                         <div class="week weekly-for-mobile myScroll" data-top="" data-delay="2s" data-action="fade">
                                            <div class="week-header"><h2>weekly featured</h2></div>
                                            <div class="row">
                                           <?php
                                            foreach($weekly->result() as $values){ 
                                                $images = Input::json_decode($values["image"]);
                                                ?>
                                                        <div class="col-sm-4 col-6">
                                                              <div class="weekly-item myScrollItem">
                                                                  <a href="detail.html"><img src="images/<?= $images[0]; ?>" alt="women_shoe"></a>
                                                                  <ul>
                                                                      <li><?= $values["name"]; ?></li>
                                                                      <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                                      <li><?= Input::money($values["price"]); ?></li>
                                                                      <li><a href="detail.html" class="show-detail-btn">Show Details</a></li>
                                                                  </ul>
                                                              </div>
                                                        </div>
                                            <?php   }  ?>
                                            </div>
                                       </div>
                                 <?php   } ?>
                                             