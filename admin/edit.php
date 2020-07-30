
<?php require_once "core/init.php"; ?>

<?php
 if(Session::exists(Config::get("session/session_name")) && Input::exists("get")){  
    $user_id = escape(Input::get("profile"));
    $profile = new User();
    $profile->get("admin", array("id", "=", $user_id));
    $user_profile = $profile->first();
    
     }





   if(Input::exists("post")){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            "email" => array(
                "required" => true,
                "name" => "Email"
            ),
            "name" => array(
                "required" => true,
                "min" => 2,
                "max" => 50,
                "name" => "Name"
            ),
            "phone" => array(
                "required" => true,
                "min" => 11,
                "max" => 11,
                "phone" => true,
                "name" => "Phone"
            ),
            "bio" => array(
                "required" => true,
                "min" => 20,
                "max" => 300,
                "name" => "Bio"
            ),
            "address" => array(
                "required" => true,
                "min" => 10,
                "max" => 50,
                "name" => "Address"
            )
        ));


        if(!$validation->passed()){
            Session::flash("alert", $validation->error());
        }else{
           $user = new User($user_profile->id);
           $userDetail = $user->admin_profile_edit(
                    escape(Input::get("email")), 
                    escape(Input::get("name")), 
                    escape(Input::get("adminPosition")),
                    escape(Input::get("phone")),
                    escape(Input::get("bio")),
                    escape(Input::get("address")),
                    $_FILES["image"]
                );
            if(!$userDetail->passed()){
                 Session::flash("alert", array($userDetail->error())); 
            }else{
                 Redirect::to("profile.php", ["success", "profile edited successfully!"]);
            }
        }
     
   }
?>
<?php require_once "includes/header.php";  ?>


    <section class="products-container cont" id="stickyTopNavPosition" data-top="50">
             <div class="row">
                     <!-- side bar section -->
                <?php require_once "includes/side_navigation.php"; ?>
                <!-- start -->
                <div class="col-lg-10 removePadding" id="sideNavStickyPosition">
                    <div class="main-container" id="profile">
                    
                          <?php  
                              if(Session::exists("alert")){
                                  echo '<div class="alert alert-danger">';
                                  foreach(Session::flash("alert") as $values){
                                      echo $values."<br>";
                                  }
                                  echo '</div>';
                              }
                          ?>
                          
                             <form action="edit.php?profile=<?=$user_profile->id; ?>" method="post" class="admin-profile-edit" enctype="multipart/form-data">
                                 <div class="form-group">
                                     <label for="name">Name: </label>
                                     <input type="text" class="form-control" name="name" value="<?= $user_profile->name? $user_profile->name : Input::get("name"); ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="email">Email: </label>
                                     <input type="email" class="form-control" name="email" value="<?= $user_profile->email? $user_profile->email : Input::get("email"); ?>" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="position">Position: </label>
                                    <select name="adminPosition" id="" class="form-control" required>
                                        <option value="<?= $user_profile->position? $user_profile->position : "Select"?>"><?= $user_profile->position? $user_profile->position : "Select"?></option>
                                        <option value="admin">Admin</option>
                                        <option value="customer care">Custor service</option>
                                        <option value="developer">Developer</option>
                                        <option value="marketer">Marketer</option>
                                        <?php
                                             if($user_profile->id == 1){
                                                   echo ' <option value="admin/manager">Manager/admin</option>';
                                             }
                                        ?>
                                       
                                    </select>
                                 </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone: </label>
                                            <input type="text" class="form-control" name="phone" value="<?= $user_profile->phone ? $user_profile->phone : Input::get("phone"); ?>" required>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image: </label><br>
                                            <input type="file" class="text-danger" name="image" value="">
                                        </div>
                                   </div>
                                </div>
                                <div class="form-group">
                                     <label for="address">Address: </label>
                                     <input type="text" class="form-control" name="address" value="<?= $user_profile->address ? $user_profile->address : Input::get("address"); ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="bio">Bio: </label>
                                    <textarea name="bio" class="form-control" cols="30" rows="10" placeholder="Enter text..."><?= $user_profile->bio ? $user_profile->bio : Input::get("bio"); ?></textarea>
                                 </div>
                                 <div class="form-group text-right">
                                     <button type="submit" class="btn btn-info">Edit...</button>
                                     <a href="profile.php" class="btn btn-outline-secondary">Cancle</a>
                                 </div>
                             </form>
                    </div>
                </div>
                <!-- end -->
             </div>
    </section>

  

  <!-- footer -->
  <?php require_once "includes/footer.php"; ?>