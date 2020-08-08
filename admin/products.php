<?php require_once "includes/header.php"; ?>
<?php
   if(Input::exists("get")){
     $page = Input::get("page");
   }else{
     $page = 1;
   }
   $numberPage = 10;
   $start = ($page - 1) * $numberPage;
?>
      



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                 <!-- side bar -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                    <?php  
                        if(Session::exists("success")){
                            echo '<div class="alert alert-success">';
                                    echo Session::flash("success");
                            echo '</div>';
                        }
                    ?>
                         <div class="products-header"><i class="far fa-folder"></i>Products</i></div>
                         <div class="products-items-container">
                               <div class="products-items-header">
                               <?php
                                    $product = new Product();
                                    $product->limit("products", array($start, $numberPage));
                               ?>
                                   <ul>
                                       <li class="product-item-Delete">Products <b>(<?= $product->count(); ?>)</b> <i class="fa fa-folder text-warning"></i></li>
                                       <li class="addNewProduct"><a href="add-product.php"><i class="fa fa-plus"></i>New Product</a></li>
                                   </ul>
                               </div>
                               <div class="sold-products-table">
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered">
                                       <thead>
                                           <tr>
                                               <th>#</th>
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
                                        
                                         if($product->count()){
                                             foreach($product->result() as $values){ 
                                                $start++;
                                                 $image = explode(",", $values->image)[0];
                                                 ?>
                                                  <tr class="table-parent">
                                                    <form action="" method="post" class="productTableForm">
                                                        <td><li class="data"><?= $start ?></li></td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="product_detail.php?product=<?=$values->id; ?>"><img src="images/<?= $image; ?>" alt="<?= $values->name; ?>"></a></li>
                                                                <li><?= $values->name?></li>
                                                            </ul>
                                                        </td>
                                                        <td><li class="data"><?= $values->id?></li></td>
                                                        <td><li class="data"><?= Input::money($values->price); ?></li></td>
                                                        <td><li class="data text-danger"><?= $values->old_price ? Input::money($values->old_price) : Input::money("0.0").".00"; ?></li></td>
                                                        <td><li class="data"><?= $values->quantity - $values->sold;?></li></td>
                                                        <td class="table-option parent"><li class="data"><?= $values->sold;?> </li><i class="fa fa-ellipsis-h actionButton"></i>
                                                                <ul class="product-dropDown childDropDown" style="top: 0px;">
                                                                    <li><a href="product_detail.php?product=<?=$values->id; ?>"><i class="fa fa-info i"></i>Show Details</a></li><br>
                                                                    <li><a href="edit_product.php?product=<?= $values->id; ?>"><i class="fa fa-edit e"></i>Edit</a></li><br>
                                                                    <li><a href="#" class="productDeleteBtn" id="<?= $values->id; ?>"><i class="fa fa-trash"></i>Delete</a></li>
                                                                </ul>
                                                            </td>
                                                    </form>
                                                </tr>
                                           <?php
                                             }
                                         }
                                        ?>
                                       </tbody>
                                   </table>
                                </div>
                                <div class="text-center">
                                <?php
                                    $product = new Product();
                                    $product->get("products");
                                  
                                    if($product->count()){
                                       $button = ceil($product->count()/$numberPage);
                                       if($page > 1){
                                        echo '<a href="products.php?page='.($page - 1).'" class="btn btn-success">Previous</a>';
                                       }

                                       for($x = 1; $x <= $button; $x++){
                                           echo '<a href="products.php?page='.$x.'" class="btn btn-success">'.$x.'</a>';
                                       }

                                       if($page < $button){
                                         echo '<a href="products.php?page='.($page + 1).'" class="btn btn-success">Next</a>';
                                       }
                                    }

                               ?>
                                </div>
                           </div>
                         </div>
                    </div>
                </div>
             </div>
    </section>

    



    <!-- footer -->
    <?php require_once "includes/footer.php";?>