<?php
      require_once "includes/header.php";
?>


             <!-- ACCOUNT SECTION -->
             <section class="account-section">
                      <div class="container">
                             <div class="row">
                                 <div class="col-lg-3 col-md-3 col-sm-12 col-12 account-bar">
                                     <?php leftSideBar(); ?>
                                 </div>
                                 <!-- ACCOUNT CONTENT -->
                                 <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                    <div class="account-details">
                                            <div class="account-header">
                                                <h2>Account Details</h2>
                                            </div>
                                            <div class="account-body">
                                                <div class="row">
                                                   <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                        <div class="account-items">
                                                             <a href="order.php"><img src="admin/logo/order-image.jpeg" alt="order-image"></a>
                                                             <h3>check orders</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                        <div class="account-items">
                                                                <a href="cart.php"><img src="admin/logo/order-cart.jpeg" alt="order-cart"></a>
                                                                <h3>Cart Information</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                        <div class="account-items">
                                                                <a><img src="admin/logo/order-password.jpeg" alt="order-password" class="form-action-button" data-type="changePassword-form"></a>
                                                                <h3>Change password</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                        <div class="account-items">
                                                            <a href="privacy.php"><img src="admin/logo/order-privacy.jpg" alt="order-privacy"></a>
                                                            <h3>Account Privacy</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                                        <div class="account-items">
                                                                 <a><img src="admin/logo/account-image-delete.jpeg" alt="account-image-delete"  class="form-action-button" data-type="deleteAccount-form"></a>
                                                                <h3>Delete Account</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                 </div>
                             </div>
                      </div>
             </section>





            <!-- FOOTER SECTION -->
            <section class="footer">
                <?php require_once "footer.php"; ?>
            </section>