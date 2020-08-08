<?php
 require_once "core/init.php";




 if(Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        "email" => array(
            "required" => true,
            "name" => "email"
        ),
        "password" => array(
            "required" => true,
            "min" => 6,
            "max" => 20,
            "name" => "password"
        ),
    ));



    if(!$validation->passed()){
         Session::flash("alert", $validation->error());
   }else{
        $user = new User();
        $login = $user->login(Input::get("email"), Input::get("password"));
        if(!$login->passed()){
             Session::flash("alert", array($login->error()));
        }else{
            Redirect::to("index.php", ["success", "You have been logged in!"]);
        }
   }
 }


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
    <body class="login-body">
        <!-- PRELOADER -->
       <!-- <section id="preloader">
            <div class="preloader-dark-skin"></div>
            <div class="preloader">
                <div class="loader first"></div>
                <div class="loader second"></div>
                <div class="loader third"></div>
            </div>
       </section> -->

            <section class="form" id="formContainer">
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-8 disappear">
                              <div class="banner">
                                  <img src="logo/1.jpg" alt="1">
                                  <div class="banner-font">
                                      <h1>Welcome to buy hub</h1>
                                      <h1>Admin Panel Section...</h1>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4 responsive">
                              <!-- signup form -->
                              <div class="form-header"><h3 class="" id="signup"><a href="signup.php">Signup</a></h3><h3 class="formbutton inview"id="login"><a href="login.php">Login</a></h3></div>
                                <?php  
                                    if(Session::exists("alert")){
                                        echo '<div class="alert alert-danger text-center" style="font-size: 75%;">';
                                        foreach(Session::flash("alert") as $values){
                                            echo $values."<br>";
                                        }
                                        echo '</div>';
                                    }
                                ?>
                                <!-- end of signup form -->

                                <!-- login form -->
                                <form action="login.php" method="post" id="loginForm">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" id="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" name="login" class="form-control">Login</button>
                                            <div class="forgot-password">
                                                    <a href="#" class="">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- end of login form -->
                          </div>
                      </div>
                  </div>
            </section>



            <script src="js/script.js"></script>
    </body>
</html>