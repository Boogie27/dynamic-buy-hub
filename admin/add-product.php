<?php require_once "core/init.php"; ?>


<?php
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
            $product = new Product();
            $products = $product->add_product(
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
               Redirect::to("products.php", ["success", "product added successfully!"]);
            }
        }
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
                    ?>
                         <div class="products-header"><i class="far fa-folder"></i>Products</i> <a href="products.php" class="cancle">Cancle</a></div>
                         <div class="products-items-container">
                               <div class="sold-products-table">
                                     <form action="add-product.php" method="post" enctype="multipart/form-data">
                                         <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" class="form-control" value="<?= Input::get("name");?>" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Brand:</label>
                                                    <select name="selectBrand" id="" class="form-control" required>
                                                        <option value="">Select</option>
                                                        <?php
                                                            $brand = new Brand();
                                                            $brands = $brand->get("brand");
                                                            if($brands->count()){
                                                                foreach($brands->result() as $values){
                                                                     echo ' <option value="'.$values->brand.'">'.$values->brand.'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">category:</label>
                                                    <select name="selectCategories" id="productCategories" class="form-control" required>
                                                        <option value="">select</option>
                                                        <?php
                                                            $category = new Category();
                                                            $categories = $category->get("categories");
                                                            if($categories->count()){
                                                                foreach($categories->result() as $values){ ?>
                                                                      <option value="<?=$values->id ?>"><?=$values->name ?></option>
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
                                                    <input type="number" name="price" class="form-control" value="<?= Input::get("price");?>" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Old Price:</label>
                                                    <input type="number" name="oldPrice" class="form-control" value="<?= Input::get("oldPrice");?>" min="0" >
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Quantity:</label>
                                                    <input type="number" name="qty" class="form-control" value="<?= Input::get("qty");?>" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="detail">Detail:</label>
                                                    <input type="text" name="detail" class="form-control" value="<?= Input::get("detail");?>" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="image">Images:</label><br>
                                                    <input type="file" name="image" class="image" value="" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                   <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="text here..." required><?= Input::get("description");?></textarea>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group text-right">
                                                  <button class="btn btn-primary">Add Product</button>
                                                </div>
                                             </div>
                                         </div>
                                     </form>
                               </div>
                         </div>
                    </div>
                </div>
             </div>
    </section>




       <?php require_once "includes/footer.php";?>