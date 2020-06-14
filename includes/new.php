
<?php
     $newest = new Category();
     $date = date("Y-m-d H:i:s", time() - (28 * 86400));
     if($newest->get("products", array("featured", "=", true), array(["date", ">=", $date]))->count()){
?>


                                            <div class="new-deals">
                                                  <div class="new-deal-header">
                                                      <h2>newest deals</h2>
                                                      <div class="new-menu">Menu
                                                          <ul class="subMenu">
                                                              <?php
                                                                if($newest->get("categories", array("featured", "=", true))->count()){
                                                                   foreach( $newest->result() as $values){ 
                                                                          $id = $values["id"];
                                                                       ?>
                                                                        <li>
                                                                            <a href="newest.php?item=<?=$values["id"];?>" class="subMenu-item"><?= $values["name"]; ?></a>
                                                                            <?php
                                                                                if( $newest->get("sub_categories", array("categories_id", "=", $id), array(["featured", "=", true]))->count()){ ?>
                                                                                    <ul class="subMenu-one">
                                                                                        <?php
                                                                                            foreach($newest->result() as $keys){ ?>
                                                                                                <li><a href="newest.php?product=<?=$keys["id"];?>"><?= $keys["name"]; ?></a></li>
                                                                                        <?php  }
                                                                                        ?>
                                                                                    </ul>
                                                                            <?php  }
                                                                            ?>
                                                                        </li>
                                                                 <?php  }
                                                                }
                                                              ?>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                  
                                                  <div class="new-item">
                                                      <div class="row">
                                                        <?php
                                                         $date = date("Y-m-d H:i:s", time() - (28 * 86400));
                                                         $newest->limit("products", array("date", ">=", $date), 8);
                                                          foreach($newest->result() as $value){ 
                                                                  $images = Input::json_decode($value["image"]);
                                                                  ?>
                                                                 <div class="col-md-3 col-sm-3 col-4">
                                                                        <div class="item-new">
                                                                            <a href="detail.php?product=<?= $value["id"];?>&slug=<?= $value["slug"];?>"><img src="images/<?= $images[0]; ?>" alt="<?= $value["name"]?>"></a>
                                                                        <ul>
                                                                            <li><?= $value["name"]; ?></li>
                                                                            <li><i class="fas fa-star star"></i><i class="fas fa-star star"></i><i class="fas fa-star star"></i></li>
                                                                            <li class="price"><?= Input::money($value["price"]); ?></li>
                                                                        </ul>
                                                                        </div>
                                                                </div>
                                                        <?php  }

                                                        ?>
                                                      </div>
                                                  </div>
                                    </div>   <!--end-->

     <?php } ?>