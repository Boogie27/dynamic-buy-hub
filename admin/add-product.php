<?php require_once "core/init.php"; ?>


<?php require_once "includes/header.php"; ?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                     <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header"><i class="far fa-folder"></i>Products</i> <a href="products.php" class="cancle">Cancle</a></div>
                         <div class="products-items-container">
                               <div class="sold-products-table">
                                     <form action="" method="post">
                                         <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Brand:</label>
                                                    <select name="selectBrand" id="" class="form-control" required>
                                                        <option value="">select</option>
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
                                                    <select name="selectBrand" id="productCategories" class="form-control" required>
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
                                                    <select name="selectBrand" id="productSubCategroies" class="form-control" required>
                                                
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="price">price:</label>
                                                    <input type="number" name="price" class="form-control" value="" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Old Price:</label>
                                                    <input type="number" name="oldPrice" class="form-control" value="" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Quantity:</label>
                                                    <input type="number" name="qty" class="form-control" value="" min="1" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="detail">Detail:</label>
                                                    <input type="text" name="detail" class="form-control" value="" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="description">Images:</label><br>
                                                    <input type="file" name="image" class="image" value="" required>
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                   <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="text here..." required></textarea>
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