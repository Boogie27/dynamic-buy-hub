<?php require_once "includes/header.php"; ?>




  <!-- MODAL SECTION -->
  <div class="modal-dropdown" id="modalBox">
        <div class="modal-header"><h3>Add Category</h3> <span><i class="fa fa-times modalBoxCancle"></i></span></div>
        <div class="modal-body">
        <div class="text-center" id="alertForm"></div><br>
            <form action="category.php" method="post" id="CategoryForm">
                <div class="fomr-group">
                    <label for="name">Category Name:</label>
                    <input type="text" name="CategoryName" class="form-control" id="categoryInput" required>
                </div>
                <div class="fomr-group"><br>
                    <label for="image">Image:</label><br>
                    <input type="file" name="categoryImage" class="" id="categoryImage">
                </div>
                <div class="form-group actionBtn text-right">
                    <button type="submit" class="categoryBtn">Add Category</button>
                    <a href="#" class="modal-close modalBoxCancle" id="modalBoxCancle">Cancle</a>
                </div>
            </form>
        </div>
    </div> <!--end-->



  <!-- CATEGORY EDIT MODAL SECTION -->
  <div class="modal-dropdown" id="catEditModalBox">
        <div class="modal-header"><h3>Edit Category</h3> <span><i class="fa fa-times modalBoxCancle"></i></span></div>
        <div class="modal-body">
        <div class="text-center" id="alertForm"></div><br>
            <form action="category.php" method="post" class="CategoryEditForm" enctype="multi-part/form-data">
                <div class="fomr-group">
                    <label for="name">Category Name:</label>
                    <input type="text" name="CategoryEditName" class="form-control" id="categoryEditInput" >
                </div>
                <div class="fomr-group"><br>
                    <label for="image">Image:</label><br>
                    <input type="file" name="categoryEditImage" class="" id="categoryEditImage">
                </div>
                <div class="form-group actionBtn text-right">
                    <input type="hidden" name="catEditID" value="" class="catID">
                    <button type="submit" class="">Edit Category</button>
                    <a href="#" class="modal-close modalBoxCancle" id="modalBoxCancle">Cancle</a>
                </div>
            </form>
        </div>
    </div> <!--end-->

        <!-- SUB CATEGORY  MODAL SECTION -->
        <div class="modal-dropdown sub-categories-dropDown" id="subCategoryModalBox">
            <div class="modal-header"><h3>Add Category</h3> <span><i class="fa fa-times modalBoxCancle"></i></span></div>
                <div class="modal-body">
                <div class="text-center" id="alertForm"></div><br>
                    <form action="category.php" method="post" id="subCategory">
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <select name="selectBrand" class="form-control subCategoryBrand">
                               <option value="0">Select</option>
                            <?php
                             $subCategory = new Brand();
                             $subCategory->get("brand");
                             if($subCategory->count()){
                                 foreach($subCategory->result() as $values){
                                         echo '<option value="'.$values->id.'">'.$values->brand.'</option>';
                                 }
                             }
                            ?>
                            </select>
                        </div>
                        <div class="fomr-group">
                            <label for="">Category Name:</label>
                            <input type="text" name="name" class="form-control subCategoryName">
                            <input type="hidden" class="categoryID" value="">
                        </div>
                        <div class="form-group actionBtn text-right">
                            <button type="submit" class="">Add Sub Category</button>
                            <a href="#" class="modal-close modalBoxCancle" id="modalBoxCancle">Cancle</a>
                        </div>
                    </form>
                </div>
            </div>
                    

                    <!-- SUB CATEGORY  EDIT MODAL SECTION -->
        <div class="modal-dropdown sub-categories-dropDown" id="subCategoryEdit">
            <div class="modal-header"><h3>Edit Sub Category</h3> <span><i class="fa fa-times modalBoxCancle"></i></span></div>
                <div class="modal-body">
                <div class="text-center" id="alertForm"></div><br>
                    <form action="category.php" method="post" id="subCategoryEditForm">
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <select name="selectBrand" class="form-control subCategoryBrand">
                               <option value="0">Select</option>
                               <?php
                                    $subCategory = new Brand();
                                    $subCategory->get("brand");
                                    if($subCategory->count()){
                                        foreach($subCategory->result() as $values){
                                                echo '<option value="'.$values->id.'">'.$values->brand.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="fomr-group">
                            <label for="">Category Name:</label>
                            <input type="text" name="name" class="form-control subCategoryEditName">
                            <input type="hidden" class="categoryID" value="">
                        </div>
                        <div class="form-group actionBtn text-right">
                            <button type="submit" class="">Edit Sub Category</button>
                            <a href="#" class="modal-close modalBoxCancle" id="modalBoxCancle">Cancle</a>
                        </div>
                    </form>
                </div>
            </div>
                    


<?php

    $categories = new Category();
    $categories->get("categories");
?>
        


    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                    <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header"><i class="fa fa-cubes"></i>Category</i></div>
                         <div class="message-alert">
                          <?php  
                              if(Session::exists("alert")){
                                  echo Session::flash("alert");
                              }
                          ?>
                          </div>
                         <div class="products-items-container">
                               <div class="products-items-header">
                                   <ul>
                                       <li class="product-item-Delete"><i class="fa fa-cubes text-primary"></i> Categories <b>(<?= $categories->count(); ?>)</b></li>
                                       <li class="addNewProduct newCategory openModal-box"><a href="#"><i class="fa fa-plus"></i>New Category</a></li>
                                   </ul>
                               </div>
                               <div class="sold-products-table">
                                <div class="table-responsive">
                                   <table class="table table-bordered categoryPage">
                                       <thead>
                                           <tr>
                                               <th></th>
                                               <th>Product Category</th>
                                               <th>Category ID</th>
                                               <th>Brand</th>
                                               <th>Featured</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                       <?php
                                            if($categories->count()){
                                                $x = 1;
                                                foreach($categories->result() as $values){ ?>
                                                    <tr class="table-parent">
                                                        <form action="" method="post" class="productTableForm">
                                                            <td><li class="data"><?= $x; ?></li></td>
                                                            <td>
                                                                <ul>
                                                                    <li><a href="#" class="main-anchor"><img src="category-image/<?= $values->image; ?>" alt="<?= $values->image;?>"></a></li>
                                                                    <li><?= $values->name?></li>
                                                                </ul>
                                                            </td>
                                                            <td><li class="data"><b><?= $values->id?></b></li></td>
                                                            <td><li class="data"><b>Brand</b></li></td>
                                                            <td><li class="data"><i class="fa <?= $values->featured ? "fa-check text-success" : "fa-times text-danger"; ?> categoryFeaturedBtn"></i></li></td>
                                                            <td><li class="data">
                                                                        <input type="hidden" class="catID" value="<?= $values->id?>">
                                                                        <a href="#" class="btn btn-info table-btn catAdd">Add Item</a>
                                                                        <a href="#" class="btn btn-success table-btn catEdit">Edit</a>
                                                                        <a href="#" class="btn btn-danger table-btn catDelete">Delete</a>
                                                                </li>
                                                                </td>
                                                        </form>
                                                    </tr>
                                            <?php
                                            $x++;
                                            $categories->get("sub_categories", array("categories_id", "=", $values->id));
                                            if($categories->count()){
                                                foreach($categories->result() as $subValues){ 
                                                    $brand = $categories->get("brand", array("id", "=", $subValues->brand_id));
                                                    $brands = "";
                                                    if($brand->count()){
                                                        $brands = $brand->first()->brand;
                                                    }
                                                    ?>
                                                    <!-- table child start -->
                                                    <tr class="table-child">
                                                        <form action="" method="post" class="">
                                                            <td><li class="data"></li></td>
                                                            <td>
                                                                <ul>
                                                                    <li><a href="#" class="main-anchor"><?= $subValues->name; ?></a></li>
                                                                </ul>
                                                            </td>
                                                            <td><li class="data"><?= $subValues->id; ?></li></td>
                                                            <td><li class="data"><?= $brands; ?></li></td>
                                                            <td><li class="data"><i class="fa <?=$subValues->featured ? "fa-check text-success" : "fa-times text-danger"; ?> subCategoryFeaturedBtn"></i></li></td>
                                                            <td><li class="data">
                                                                    <input type="hidden" class="catEditID" value="<?= $subValues->id; ?>">
                                                                    <a href="" class="btn text-success table-btn"><i class="fa fa-edit sub_cat_edit" id="<?= $subValues->id; ?>"></i></a>
                                                                    <a href="" class="btn text-danger table-btn"><i class="fa fa-trash sub_cat_delete"></i></a>
                                                                </li>
                                                            </td>
                                                        </form>
                                                    </tr>
                                            <?php 
                                            }
                                          }
                                        }
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



       <?php require_once "includes/footer.php"; ?>