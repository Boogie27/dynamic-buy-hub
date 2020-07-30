<?php
 require_once "core/init.php";




 if(Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        "name" => array(
            "required" => true,
            "min" => 2,
            "max" => 50,
            "name" => "name"
        ),
        "email" => array(
            "required" => true,
            "unique" => "users",
            "name" => "email"
        ),
        "position" => array(
            "required" => true,
            "name" => "position"
        ),
        "password" => array(
            "required" => true,
            "min" => 6,
            "max" => 20,
            "name" => "password"
        ),
        "confirm_password" => array(
            "required" => true,
            "match" => "password",
            "name" => "confirm password"
        ),
    ));



    if(!$validation->passed()){
        print_r($validation->error());
   }else{
       echo "correct";
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
                              <div class="form-header"><h3 class="formbutton" id="signup">Signup</h3><h3 class="formbutton"id="login">Login</h3></div>
                                <form action="" method="post" id="loginForm">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" name="name" class="form-control" value="<?= Input::get("name");?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" class="form-control" value="<?= Input::get("email");?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="position">Position:</label>
                                               <select name="position" id="" class="form-control">
                                                   <option value="<?= Input::get("position");?>"><?= Input::get("position")? Input::get("position") : "Select";?></option>
                                                   <option value="admin">Admin</option>
                                                   <option value="customer_care">Customer Care</option>
                                                   <option value="seller">Seller</option>
                                                   <option value="manager">Manager</option>
                                               </select>
                                            </div>
                                        </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" class="form-control" value="<?= Input::get("password");?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password:</label>
                                            <input type="password" name="confirm_password" class="form-control" value=<?= Input::get("confirm_password");?>"">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit" name="signin" class="form-control">Signup</button>
                                            <p class="text-primary text-center">Not a user Signup</p>
                                        </div>
                                    </div>
                                </form>
                                <!-- end of signup form -->

                                <!-- login form -->
                                <form action="" method="post" id="loginForm">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" name="password" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="button" name="login" class="form-control">Login</button>
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