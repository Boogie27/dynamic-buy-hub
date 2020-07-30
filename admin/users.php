<?php require_once "includes/header.php"; ?>



    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                    <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>

                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-product">
                         <div class="products-header" id="user"><i class="far fa-user"></i>Users</i></div>
                         <div class="products-items-container">
                               <div class="sold-products-table">
                               <?php
                                    $users = new User();
                                    $userProfile = $users->get("users");
                                    if($userProfile->count()){
                                        $x = 1;
                                ?>
                                <div class="table-responsive">
                                   <table class="table table-striped table-bordered">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>Users</th>
                                               <th>User ID</th>
                                               <th>Email</th>
                                               <th>Active</th>
                                               <th>Date</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                       <?php
                                                 foreach($userProfile->result() as $values){ ?>
                                                        <tr class="table-parent">
                                                        <form action="" method="post" class="productTableForm">
                                                            <td><li class="data"><?= $x?></li></td>
                                                            <td>
                                                                <ul>
                                                                    <li><a href="client.php?user_profile=<?= $values->id;?>" class="main-anchor user"><img src="<?= $values->image;?>" alt="profile-image-2"><?= $values->name;?> <i class="online fa fa-circle <?= $values->online ? "text-success" : "text-danger";?>" id="<?= $values->id ?>"></i></a></li>
                                                                </ul>
                                                            </td>
                                                            <td><li class="data"><?= $values->id; ?></li></td>
                                                            <td><li class="data"><?= $values->email; ?></li></td>
                                                            <td class="table-option parent"><li class="data" id="<?= $values->id; ?>"><i class="user-activate fa <?= $values->activate ? "fa-check text-success" : "fa-times text-danger"?>"></i></li><i class="fa fa-ellipsis-h actionButton"></i>
                                                                    <ul class="product-dropDown childDropDown" style="top: 0px;">
                                                                        <li><a href="client.php?user_profile=<?= $values->id;?>"><i class="fa fa-info i"></i>Show Details</a></li><br>
                                                                        <li id="<?= $values->id;?>"><a href="#" class="deactivate-user"><i class="fa fa-user"></i>Deactivate</a></li><br>
                                                                        <li><a href="#"><i class="fa fa-trash t"></i>Delete</a></li>
                                                                    </ul>
                                                                </td>
                                                                <td><li class="data"><?= Input::date($values->date);?></li></td>
                                                        </form>
                                                    </tr>
                                             <?php $x++;   }
                                       ?>
                                       </tbody>
                                   </table>
                                </div>
                               <div class="row">
                                  <div class="col-md-4"><b> Number of users:</b> (<?= $userProfile->count() ?>) </div>
                                  <div class="col-md-8">pagination</div>
                               </div>
                               <?php }else{
                                   echo '<div class="alert alert-danger text-danger">There are no users yet!</div>';
                               } ?>
                           </div>
                         </div>
                    </div>
                </div>
             </div>
    </section>




 <!-- footer -->
 <?php require_once "includes/footer.php"; ?>