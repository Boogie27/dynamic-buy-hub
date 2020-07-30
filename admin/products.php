<?php require_once "includes/header.php"; ?>

      



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                 <!-- side bar -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header"><i class="far fa-folder"></i>Products</i></div>
                         <div class="products-items-container">
                               <div class="products-items-header">
                                   <ul>
                                       <li class="product-item-Delete"><b>(2)</b></b>Selected items <i class="fa fa-trash" id="productItemDelete"><span>Delete</span></i></li>
                                       <li class="addNewProduct"><a href="add-product.php"><i class="fa fa-plus"></i>New Product</a></li>
                                   </ul>
                               </div>
                               <div class="sold-products-table">
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered">
                                       <thead>
                                           <tr>
                                               <th><input type="checkbox" value="all"></th>
                                               <th>Products</th>
                                               <th>Product ID</th>
                                               <th>Price</th>
                                               <th>Discount</th>
                                               <th>Stock</th>
                                               <th>Sold</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                        <?php
                                         $product = new Product();
                                         $product->get("products", array("featured", "=", true));
                                         if($product->count()){
                                             foreach($product->result() as $values){ 
                                                 $image = Input::json_decode( $values->image);
                                                 ?>
                                                  <tr class="table-parent">
                                                    <form action="" method="post" class="productTableForm">
                                                        <td><li class="data"><input type="checkbox" name="" value="id"></li></td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="product_detail.php?product=<?=$values->id; ?>"><img src="images/<?= $image[0]; ?>" alt="<?= $image[0]; ?>"></a></li>
                                                                <li><?= $values->name?></li>
                                                            </ul>
                                                        </td>
                                                        <td><li class="data"><?= $values->id?></li></td>
                                                        <td><li class="data"><?= Input::money($values->price); ?></li></td>
                                                        <td><li class="data text-danger"><?= $values->old_price ? Input::money($values->old_price) : Input::money("0.0").".00"; ?></li></td>
                                                        <td><li class="data"><?= $values->quantity?></li></td>
                                                        <td class="table-option parent"><li class="data">6 </li><i class="fa fa-ellipsis-h actionButton"></i>
                                                                <ul class="product-dropDown childDropDown">
                                                                    <li><a href="product_detail.php?product=<?=$values->id; ?>"><i class="fa fa-info i"></i>Show Details</a></li><br>
                                                                    <li><a href="edit_product.php"><i class="fa fa-edit e"></i>Edit</a></li><br>
                                                                    <li><a href="#"><i class="fa fa-trash t"></i>Delete</a></li>
                                                                </ul>
                                                            </td>
                                                    </form>
                                                </tr>
                                           <?php }
                                         }
                                        ?>
                                       </tbody>
                                   </table>
                                </div>
                           </div>
                         </div>
                    </div>
                </div>
             </div>
    </section>



    <!-- footer -->
    <?php require_once "includes/footer.php";?>