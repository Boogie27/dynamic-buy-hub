<?php     require_once "core/init.php";
          require_once "includes/script.php";
      
 $categories = Db::getInstance()->get("categories", array("featured", "=", true));
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>home page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="css/queries.css">
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
    </head>
<body>


        <!-- side bar navigation for mobile devices -->
        <?php
                require_once "mobile_sidebar.php";
        ?>
         <!-- end  -->
      
      
       <!-- SIGNUP SECTION -->
      <section class="activeSkin-container">
          <!-- signup form -->
             <?php
                  require_once "./signup.php";
             ?>

            <!-- login form -->
            <?php
                require_once "./login.php";
            ?>

                
            <!-- change password form -->
            <?php
                require_once "./change_password.php";
            ?>

             <!-- login form -->
             <?php
                require_once "./edit.php";
            ?>

             <!-- delete account form -->
             <?php
                require_once "./delete_account.php";
            ?>

        </section>

        <!--AJAX ALERT MESSAGES-->
        <section class="alert-container">
             <div class="cartAlert">

            </div>
        </section>



      

   
          <!-- NAVIGATION -->
          <section>
                <?php   require_once "navigation.php"; ?>
          </section>


<?php
if(Session::exists("cart") || !Session::exists("cart")){
    if(Session::exists("success")){
        echo Session::flash("success");
     }else if(Session::exists("error")){
        echo Session::flash("error");
    }
}
?>
