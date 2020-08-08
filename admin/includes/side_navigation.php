<?php
  $filePath = explode("/", $_SERVER["REQUEST_URI"]);
  $pageName =  $filePath[count($filePath) - 1];
?>

<?php
 if(Session::exists(Config::get("session/session_name"))){  
    $user_id = Session::get(Config::get("session/session_name"));
    $profile = new User();
    $profile->get("admin", array("id", "=", $user_id)); 
    $admin = $profile->first();
    }
?>

<!-- SIDE NAVIGATION-->
<div class="col-lg-2 col-md-4 navi" id="sideNavigation">
   <div class="sideBar-nav-container" id="stickySideNavigation">
        <div class="side-navigation">
            <div class="side-nav-header">
               <a href="profile.php"><img src="admin-image/<?= $admin->image ? $admin->image : "profile-image.png" ?>" alt="<?= $admin->name?>"></a>
                <ul class="sizeBar-nav">
                    <li><?= $admin->name;?></li>
                    <li class="position"><?= $admin->position;?></li>
                    <i class="fas fa-times" id="sideNavCloseButton"></i>
                </ul>
            </div>
            <div class="side-nav-content">
                <ul>
                    <li class="<?= $pageName == "index.php" ? "active" : "" ?>"><a href="index.php">Dash Board <i class="fas fa-home"></i></a></li>
                    <li class="<?= $pageName == "products.php" ? "active" : "" ?>"><a href="products.php">Produts <i class="far fa-folder"></i></a></li>
                    <li class="<?= $pageName == "brand.php" ? "active" : "" ?>"><a href="brand.php">Brands <i class="fa fa-cube"></i></a></li>
                    <li class="<?= $pageName == "category.php" ? "active" : "" ?>"><a href="category.php">Categories <i class="fa fa-cubes"></i></a></li>
                    <li class="<?= $pageName == "orders.php" ? "active" : "" ?>"><a href="orders.php">Orders <i class="fas fa-shopping-cart"></i></a></li>
                    <li class="<?= $pageName == "users.php" ? "active" : "" ?>"><a href="users.php">Users <i class="far fa-user"></i></a></li>
                    <li class="<?= $pageName == "admin.php" ? "active" : "" ?>"><a href="admin.php">Admin <i class="fas fa-users"></i></a></li>
                    <li class="<?= $pageName == "profile.php" ? "active" : "" ?>"><a href="profile.php">Profile <i class="fas fa-user-tie"></i></a></li>
                    <li class="<?= $pageName == "settings.php" ? "active" : "" ?>"><a href="#">Settings <i class="fas fa-cog"></i></a></li>
                   <!-- <li><a href="login.php">Login <i class="fas"></i></a></li>'; -->
                    <li><a href="logout.php">Logout <i class="fas fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
   </div>
</div>