<?php require_once "core/init.php"; ?>


<?php

if(Input::exists("get")){
    $id = Input::get("product");
    $product = new Product();
    $product->get("products", array("id", "=", $id));
    $item_product = $product->first();

      if(Input::exists()){
         $validate = new Validate();
         $validation = $validate->check($_POST, array(
                "name" => array(
                    "required" => true,
                    "name" => "Name",
                    "min" => 2,
                    "max" => 50
                ),
                "selectBrand" => array(
                    "required" => true,
                    "name" => "Brand",
                ),
                "selectCategories" => array(
                    "required" => true,
                    "name" => "Category",
                ),
                "selectSubCategories" => array(
                    "required" => true,
                    "name" => "Sub Category",
                ),
                "price" => array(
                    "required" => true,
                    "name" => "Price",
                    "min" => 3,
                    "max" => 6
                ),
                "oldPrice" => array(
                    "required" => true,
                    "name" => "Old Price",
                    "min" => 3,
                    "max" => 6
                ),
                "qty" => array(
                    "required" => true,
                    "name" => "Quantity",
                    "min" => 1,
                    "max" => 20
                ),
                "detail" => array(
                    "required" => true,
                    "name" => "Detail",
                    "min" => 2,
                    "max" => 50
                ),
                "description" => array(
                    "required" => true,
                    "name" => "Description",
                    "min" => 20,
                    "max" => 1000
                )
         ));


        if(!$validation->passed()){
            Session::flash("alert", $validation->error());
        }else{
            $product = new Product($item_product->id);
            $products = $product->edit_product(
                        Input::get("name"),
                        Input::get("selectBrand"),
                        Input::get("selectCategories"),
                        Input::get("selectSubCategories"),
                        Input::get("price"),
                        Input::get("oldPrice"),
                        Input::get("qty"),
                        Input::get("detail"),
                        Input::get("description"),
                        $_FILES["image"]
                    );
            if(!$products->passed()){
                Session::flash("alert", array($products->error()));
            }else{
               Redirect::to("products.php", ["success", "product Edited successfully!"]);
            }
        }
      }
    }else{
         Redirect::to("products.php");
    }
?>

<?php require_once "includes/header.php"; ?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                     <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                    <?php  
                        if(Session::exists("alert")){
                            echo '<div class="alert alert-danger">';
                            foreach(Session::flash("alert") as $values){
                                echo $values."<br>";
                            }
                            echo '</div>';
                        }
                        if(Input::exists("get")){
                    ?>
                         <div class="products-header"><i class="far fa-folder"></i>Products</i> <a href="products.php" class="cancle">Cancle</a></div>
                         <div class="products-items-container">
                               <div class="sold-products-table">
                                     <form action="edit_product.php?product=<?= $item_product->id; ?>" method="post" enctype="multipart/form-data">
                                         <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" class="form-control" value="<?= $item_product->name;?>" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                 <?php
                                                     $brand = new Brand();
                                                     $brand->get("brand");
                                                 ?>
                                                    <label for="name">Brand:</label>
                                                    <select name="selectBrand" id="" class="form-control" required>
                                                        <?php
                                                        if($brand->count()){
                                                            foreach($brand->result() as $values){ ?>
                                                                <option value="<?=$values->brand ?>" <?= $values->brand == $item_product->brand ? "selected" : "";?>><?=$values->brand; ?></option>
                                                        <?php }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">category:</label>
                                                    <select name="selectCategories" id="productCategories" class="form-control" required>
                                                    <?php
                                                        $category = new Category();
                                                        $categories = $category->get("categories");
                                                        if($categories->count()){
                                                            foreach($categories->result() as $values){ ?>
                                                                    <option value="<?=$values->id ?>" <?= $values->id == $item_product->categories ? "selected" : "";?>><?=$values->name; ?></option>
                                                            <?php   }
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Sub Categroy:</label>
                                                    <select name="selectSubCategories" id="productSubCategroies" class="form-control" required>
                                                             <!-- sub categories is added here using ajax -->
                                                             <option value="">Select</option>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="price">price:</label>
                                                    <input type="number" name="price" class="form-control" value="<?= $item_product->price; ?>" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Old Price:</label>
                                                    <input type="number" name="oldPrice" class="form-control" value="<?= $item_product->old_price; ?>" min="0" >
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Quantity:</label>
                                                    <input type="number" name="qty" class="form-control" value="<?= $item_product->quantity; ?>" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="detail">Detail:</label>
                                                    <input type="text" name="detail" class="form-control" value="<?= $item_product->details; ?>" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="image">Images:</label><br>
                                                    <input type="file" name="image" class="image" value="">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                    <div class="editImage-container swipperFrame">
                                                        <div class="editImage-frame swipper" id="<?= $item_product->id?>">
                                                                <!-- product images is being added using ajax -->
                                                        </div>
                                                    </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                   <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="text here..." required><?= $item_product->description;?></textarea>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group text-right">
                                                  <button class="btn btn-primary">Edit Product</button>
                                                </div>
                                             </div>
                                         </div>
                                     </form>
                               </div>
                         </div>
                         <?php
                        } else{
                            echo '<div class="alert alert-danger">Something went wrong</div>';
                        }
                         ?>
                    </div>
                </div>
             </div>
    </section>




       <?php require_once "includes/footer.php";?>