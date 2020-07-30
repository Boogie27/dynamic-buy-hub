<?php require_once "includes/header.php"; ?>
<?php
     $brand = new Brand();
     $brand->get("brand");
   
?>

    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                   <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                
                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header"><i class="fa fa-cube"></i>Brands</i></div>
                         <div class="message-alert">
                          <?php  
                              if(Session::exists("alert")){
                                  echo Session::flash("alert");
                              }
                          ?>
                          </div>
                         <div class="main-items-container">
                            <div class="main-items-container-header">
                                <ul>
                                    <div class="row">
                                        <div class="col-lg-3">
                                                <li class="product-item-Delete"><b>(<span id="checkQty">2</span>)</b></b>Selected items <i class="fa fa-trash" id="productItemDelete"><span>Delete</span></i></li>
                                        </div>
                                        <div class="col-lg-9 col-12">
                                            <li class="addBrand">
                                                <form action="brand.php" method="post">
                                                    <input type="text" name="brand" class="brandInput">
                                                    <button type="submit" id="newBrand"><i class="fa fa-plus"></i>New Brand</a></button>
                                                </form>
                                            </li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                           
                            <div class="sold-products-table">
                            <?php  if($brand->count()){ ?>
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered" id="brandTable">
                                       <thead>
                                           <tr>
                                               <th><input type="checkbox" class="check-all" id="checkAll" value="all"></th>
                                               <th>Product Brand</th>
                                               <th>Product Brand ID</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                       <?php
                                           if($brand->count()){
                                            $brandTotal = 0;
                                               foreach($brand->result() as $values){ ?>
                                                    <tr class="table-parent">
                                                        <form action="" method="post" class="productTableForm">
                                                            <td><li class="data"><input type="checkbox" name="" class="brandCheck" value="<?= $values->id; ?>"></li></td>
                                                            <td>
                                                                <ul>
                                                                    <li><a href="#" class="brand-name"><?= $values->brand; ?></a></li>
                                                                </ul>
                                                            </td>
                                                            <td><li class="data data-number"><?= $values->id; ?></li></td>
                                                            <td><li class="data">
                                                                    <input type="hidden" class="brandID" value="<?= $values->id; ?>">
                                                                    <a href="#" class="btn btn-success table-btn brandEditbutton">Edit</a>
                                                                    <a href="#" class="btn btn-danger table-btn brandDeleteButton">Delete</a>
                                                                </li>
                                                            </td>
                                                        </form>
                                                    </tr>
                                            <?php  $brandTotal++;
                                             }
                                           }
                                       ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    }else{
                                          echo '<div class="alert alert-danger text-danger text-center">There are no Brands Available!</div>';
                                    }

                                ?>
                            </div>
                         </div>
                         <!-- AMOUNT AND PAGINATION -->
                         <div class="row">
                            <?php
                                 if($brand->count()){ ?>
                                     <div class="col-md-3">
                                         <div class="brand-total"><b>Total:</b> <span><?= $brandTotal; ?></span></div>
                                    </div>
                                    <div class="col-md-3">Pagination</div>
                               <?php  }
                            ?>
                         </div>
                    </div>
                </div>
             </div>
    </section>





<!-- BRAND DROP DOWN BOX-->
<section>
    <div class="dialogbox" id="dialogbox">
           <form action="brand" method="post">
               <div class="text-right"><i class="fa fa-times text-danger" id="brandCancle"></i></div>
               <div class="text-center" id="alertForm"></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 dialogboxitems">
                             <input type="text" name="editBrand" class="form-control" id="editBrandValue" value="">
                        </div>
                        <div class="col-md-3 col-sm-3 col-12 text-right dialogboxitems">
                             <input type="hidden" class="brandID" id="brandID" value="">
                             <button type="submit" name="brandEdit" class="form-control btn btn-primary" id="brandEdit">Edit Brand</button>
                        </div>
                    </div>
                </div>
           </form>
    </div>
</section>

        <?php  require_once "includes/footer.php";?>
 