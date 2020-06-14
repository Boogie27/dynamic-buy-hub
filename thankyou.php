<?php     require_once "core/init.php";
          require_once "includes/script.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>checkout</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="css/queries.css">
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
    </head>

    <body class="thankYouBody">

<?php

          if(Session::exists(Config::get("session/session_name"))){
              if(!Session::exists("cart")){
                $user_id = Session::get(Config::get("session/session_name"));
                $user = new User();
               if( $user->get("users", array("id", "=", $user_id))->count()){ 
                  $username = explode(" ", $user->first()["name"])[0];
                  ?>
                  <div class="thankyouSection">
                       <div class="container">
                            <div class="imagesContainer">
                                <div class="thankyou">
                                    <ul>
                                    <li class="text-warning first">Thank you <?= $username;?></li>
                                    <li class="text-warning first">for</li>
                                    <li class="second text-warning">Shopping with us!  <a href="index.php">Continue Shopping</a></li>
                                    </ul>
                                </div>
                                <div class="images">
                                   <a href="index.php"><img src="thankyou-images/images22.jpg" alt="images22"></a>
                                </div>
                            </div>
                        </div>
                 </div>   

         <?php    
               }else{
                Redirect::to("index.php");
               }
        }else{
             Redirect::to("index.php");
            }
        }else{
            Redirect::to("index.php");
        }
?>


   


    <script>
       
       
       $(window).ready(function(){
            
          function animate(){
                var images = $(".images");
            $(images).addClass("imageAnimate");
          }
          animate();
           
                 
       });



    </script>
    </body>
</html>