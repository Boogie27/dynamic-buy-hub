<?php require_once "includes/header.php"; ?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                    <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header"><i class="far fa-folder"></i>Edit Products</i> <a href="products.html" class="cancle">Cancle</a></div>
                         <div class="products-items-container">
                               <div class="sold-products-table">
                                     <form action="" method="post">
                                         <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Brand:</label>
                                                    <select name="selectBrand" id="" class="form-control">
                                                        <option value="">select</option>
                                                        <option value="">Sony</option>
                                                        <option value="">Levi</option>
                                                        <option value="">Addidass</option>
                                                        <option value="">Shantel</option>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">category:</label>
                                                    <select name="selectBrand" id="" class="form-control">
                                                        <option value="">select</option>
                                                        <option value="">Game</option>
                                                        <option value="">Kitchen</option>
                                                        <option value="">men</option>
                                                        <option value="">women</option>
                                                        <option value="">accessories</option>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Sub Categroy:</label>
                                                    <select name="selectBrand" id="" class="form-control">
                                                        <option value="">select</option>
                                                        <option value="">playstation</option>
                                                        <option value="">men shoes</option>
                                                        <option value="">babies cloths</option>
                                                        <option value="">women skirts</option>
                                                        <option value="">accessories</option>
                                                    </select>
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="price">price:</label>
                                                    <input type="number" name="price" class="form-control" value="" min="1">
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Old Price:</label>
                                                    <input type="number" name="oldPrice" class="form-control" value="" min="1">
                                                </div>
                                             </div>
                                             <div class="col-lg-4 col-6">
                                                <div class="form-group">
                                                    <label for="name">Quantity:</label>
                                                    <input type="number" name="qty" class="form-control" value="" min="1">
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="detail">Detail:</label>
                                                    <input type="text" name="detail" class="form-control" value="">
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="description">Images:</label><br>
                                                    <input type="file" name="image" class="image" value="">
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                    <div class="editImage-container swipperFrame">
                                                        <div class="editImage-frame swipper">
                                                            <div class="frame-item">
                                                                <img src="images/nba_2k19.jpg" alt="nba_2k19">
                                                                <form action="" method="post">
                                                                    <button type="submit" class="edit-delete-button"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                            <div class="frame-item">
                                                                <img src="images/women2.jpg" alt="women2">
                                                                <form action="" method="post">
                                                                    <button type="submit" class="edit-delete-button"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                            <div class="frame-item">
                                                                <img src="images/crash-nitro-fueld.jpg" alt="crash-nitro-fueld">
                                                                <form action="" method="post">
                                                                    <button type="submit" class="edit-delete-button"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                   <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="text here..."></textarea>
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



                <!--   footer -->
                <?php require_once "includes/foter.php"; ?>