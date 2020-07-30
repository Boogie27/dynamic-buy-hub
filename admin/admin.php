<?php require_once "includes/header.php"; ?>


     <!-- MODAL SECTION -->
     <div class="modal-dropdown adminAddNewForm" id="modalBox">
            <div class="modal-header"><h3>Add Memeber</h3> <span><i class="fa fa-times modalBoxCancle"></i></span></div>
            <div class="modal-body">
            <div class="text-center" id="alertForm"></div><br>
                <form action="" method="post">
                    <div class="fomr-group">
                        <label for="">Name:</label>
                        <input type="text" name="adminName" class="form-control" required>
                    </div>
                    <div class="fomr-group">
                        <label for="">Email:</label>
                        <input type="email" name="adminEmail" class="form-control" required>
                        <!-- when an admin is being added , an email message notification containing user password should be sent to the user email -->
                    </div>
                    <div class="fomr-group">
                        <label for="">Password:</label>
                        <input type="password" name="adminPassword" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <select name="adminPosition" id="" class="form-control" required>
                            <option value="">Select</option>
                            <option value="admin">Admin</option>
                            <option value="customer care">Custor service</option>
                            <option value="developer">Developer</option>
                            <option value="marketer">Marketer</option>
                            <option value="admin/manager">Manager/admin</option>
                        </select>
                    </div>
                    <div class="form-group actionBtn text-right">
                        <button type="submit" class="">Add Member</button>
                        <a href="#" class="modal-close modalBoxCancle" id="modalBoxCancle">Cancle</a>
                    </div>
                </form>
            </div>
        </div> <!--end-->





    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                    <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding"  id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header" id="admin"><i class="fa fa-users"></i>Admin</i></div>
                         <div class="message-alert">
                          <?php  
                              if(Session::exists("alert")){
                                  echo Session::flash("alert");
                              }
                          ?>
                          </div>
                         <div class="products-items-container">
                             <?php
                                $user = new User();
                                $user->get("admin");
                                if($user->count()){
                               ?>
                               <div class="products-items-header">
                                   <ul>
                                       <li class="product-item-Delete"> <i class="fa fa-users"></i>Users <b>(<?= $user->count();?>)</b></li>
                                       <li class="addNewProduct newCategory openModal-box"><a href="#"><i class="fa fa-plus"></i>New Member</a></li>
                                   </ul>
                               </div>
                               <div class="sold-products-table">
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>Admin</th>
                                               <th>Admin ID</th>
                                               <th>Email</th>
                                               <th>Role</th>
                                               <th>Active</th>
                                               <th>Date</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                         <?php
                                          $x= 1;
                                         foreach($user->result() as $values){ ?>
                                             <tr class="table-parent">
                                               <form action="" method="post" class="productTableForm">
                                                   <td><li class="data"><?= $x; ?></li></td>
                                                   <td>
                                                       <ul>
                                                           <li>
                                                                <a href="admin_profile.php?admin=<?=$values->id; ?>" class="main-anchor user">
                                                                    <img src="admin-image/<?= $values->image? $values->image : "profile-image.png"; ?>" alt="<?= $values->name; ?>"><?= $values->name;?>
                                                                    <i class="fa fa-circle <?= $values->online ? "text-success" : "text-danger";?>"></i>
                                                                </a>
                                                            </li>
                                                       </ul>
                                                   </td>
                                                   <td><li class="data"><?= $values->id;?></li></td>
                                                   <td><li class="data"><?= $values->email; ?></li></td>
                                                   <td><li class="data" id="hash"><?= $values->position; ?></li></td>
                                                   <td class="table-option parent">
                                                       <?php
                                                          if($values->id != 1):
                                                       ?>
                                                       <li class="data" id="<?= $values->id; ?>"><i class="adminActivateBtn fa <?= $values->activate ? "fa-check text-success" : "fa-times text-danger";?>"></i></li><i class="fa fa-ellipsis-h actionButton"></i>
                                                        <ul class="product-dropDown childDropDown" style="top: 0px;" id="<?= $values->id?>">
                                                            <li><a href="admin_profile.php?admin=<?=$values->id; ?>"><i class="fa fa-info i"></i>Show Details</a></li><br>
                                                             <li><a href="#" class="adminDeactivateBtn"><i class="fa fa-user e"></i>Deactivate</a></li><br>
                                                            <li><a href="#" class="adminDeleteBtn"><i class="fa fa-trash t"></i>Delete</a></li>
                                                        </ul>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td><li class="data"><?= Input::date($values->date);?></li></td>
                                               </form>
                                           </tr>
                                       <?php
                                        $x++;
                                    }  ?>
                                       </tbody>
                                   </table>
                                </div>
                            <?php
                                     }else{
                                        echo '<div class="alert alert-danger text-danger">There are no users yet</div>';
                                     }
                                     ?>
                           </div>
                         </div>
                    </div>
                </div>
             </div>
    </section>




       <?php require_once "includes/footer.php";?>