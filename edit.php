

<?php
    if(Session::exists(Config::get("session/session_name"))){
        $user_id = Session::get(Config::get("session/session_name"));
        $user = new User();
        $user->get("users", array("id", "=", $user_id));
        $user = $user->first();
    }
     $name = Session::exists(Config::get("session/session_name")) ? $user["name"] : "Enter Name";
     $email = Session::exists(Config::get("session/session_name")) ? $user["email"] : "Enter Email";
?>


                <div class="edit-section">
                        <div class="form-container">
                            <div class="login-header">
                                <h2>Edit Profile</h2>
                                <i class="fas fa-times" id="closeEdit"></i>
                                <div class="signupFormError"></div>
                            </div>
                            <form action="edit.php" method="post" enctype="multipart/form-data" class="editForm">
                                <div class="form-group">
                                    <label for="name">Name <b class="text-danger">*</b> </label>
                                    <input type="text" class="form-control" name="editName"  id="editName" value="<?= $name?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <b class="text-danger">*</b> </label>
                                    <input type="email" class="form-control" name="editEmail" id="editEmail" value="<?= $email?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile Image: <b class="text-danger">*</b> </label>
                                    <input type="file" class="form-control edit-image" name="editImage" id="editImage" value="" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn editAction">Edit Profile</button>
                                </div>
                            </form>
                        </div>
                </div>

