<?php


class User extends Category{

     private $_error = null,
              $_data,
              $_isLoggedIn,
              $_sessionName;




     public function __construct($user = null){
        parent::__construct();
        $this->_sessionName = Config::get("session/session_name");
        if($user){
              if($this->find($user)){
                   $this->_isLoggedIn = true;
              }
        }
     }





     public function isLoggedIn(){
        return  $this->_isLoggedIn;
     }
    


     public function signup($name = null, $email = null, $password = null, $confirmPassword = null){
            if(empty($name) || empty($email) || empty($password) || empty($confirmPassword)){
                $this->getError("All fields must be filled");
            }else if(strlen($name) < 2){
                $this->getError("Name must be minimum of two characters long.");
            }else if(strlen($name) > 50){
                $this->getError("Name must be maximum of 50 characters long.");
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->getError("Enter a valid email");
            }else if(self::get("users", array("activate", "=", true), array(["email", "=", $email]))->count()){
                $this->getError("The email ".$email." already exists!");
            }else if(strlen($password) < 6){
                $this->getError("Password must be minimum of 6 characters long.");
            }else if(strlen($password) > 50){
                $this->getError("Password must be maximum of 50 characters long.");
            }else if($password != $confirmPassword){
                $this->getError("Password must be equal to Confirm password.");
            }else if($this->getUser($email)){
                if($this->data()["activate"] == 0){
                    $this->getError("Account was deactivated! Contact the admin.");
                }
            }else{
                $salt = Hash::salt(36);
                $hash= Hash::make($password, $salt);
                 $date = date("Y-m-d H:i:s", strtotime("+30 days"));
                 self::insert("users", array(
                     "name" => $name,
                     "email" => $email,
                     "password" => $hash,
                     "salt" => $salt,
                     "date" => $date,
                 ));

                 if($this->getUser($email)){
                    $id =  $this->_data["id"];
                    Session::put($this->_sessionName, $id);
                 }
                 return true;
            }
            return false;
     }

     public function getError($error = null){
         $this->_error = $error;
     }

     public function alertError(){
        return "<div class='error'>".$this->_error."</div>";
     }


     public function getUser($email){
            $user = self::get("users", array("email", "=", $email));
            if($user->count()){
                $this->_data = $user->first();
                return true;
            }
            return false;
     }




     public function find($user = null){
         if($user){
               $field = (is_numeric($user))? "id" : "name";
               $getUser = self::get("users", array($field, "=", $user), array(["activate", "=", true]));
               if($getUser->count()){
                  $this->_data = $getUser->first();
                  return true;
               }
         }
        return false;
     }



     public function sessionName(){
         return $this->_sessionName;
     }



     public function data(){
         return $this->_data;
     }

   


     public function login($email = null, $password = null){
           
            if(empty($email) || empty($password)){
                $this->getError("All fields must be filled");
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->getError("Enter a valid email");
            }else if(!self::get("users", array("email", "=", $email))->count()){
                $this->getError("The email ".$email." does not exist!");
            }else if(strlen($password) < 6){
                $this->getError("Password must be minimum of 6 characters long.");
            }else if(strlen($password) > 50){
                $this->getError("Password must be maximum of 50 characters long.");
            }else{
                    if($this->getUser($email)){
                         if(!$this->data()["activate"]){
                             $this->getError("Account deactivated! Contact the admin.");
                         }else{
                            $id = $this->data()["id"];
                            if($this->data()["password"] === Hash::make($password, $this->data()["salt"])){
                               Session::put($this->_sessionName, $this->data()["id"]);
                               return true;
                            }else{
                                $this->getError("Wrong Password!, Password does not match.");
                            }
                         }
                    }
            }
            return false;
    }




    public function changePassword($oldPassword, $newPassword, $confirmPassword){
            if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword)){
                $this->getError("All fields must be filled");
            }else if(strlen($oldPassword) < 6){
                $this->getError("Password must be minimum of 6 characters long.");
            }else if(strlen($oldPassword) > 50){
                $this->getError("Password must be maximum of 50 characters long.");
            }else if(strlen($newPassword) < 6){
                $this->getError("New Password must be minimum of 6 characters long.");
            }else if(strlen($newPassword) > 50){
                $this->getError("New Password must be maximum of 50 characters long.");
            }else if(strlen($confirmPassword) < 6){
                $this->getError("Confirm Password must be minimum of 6 characters long.");
            }else if(strlen($confirmPassword) > 50){
                $this->getError("Confirm Password must be maximum of 50 characters long.");
            }else if($newPassword != $confirmPassword){
                $this->getError("Confirm password must match New Password");
            }else{
                $user_id = $this->_data["id"];
                $salt = Hash::salt(32);
                if(self::get("users", array("id", "=", $user_id), array(["password", "=", Hash::make($oldPassword, $this->_data["salt"])]))->count()){
                    self::update("users", array(
                          "password" => Hash::make($newPassword, $salt),
                          "salt" => $salt
                    ), array("id", "=", $user_id));
                    return true;
                }else{
                    $this->getError("Wrong Password! try again.");
                }
            }
            return false;
    }






    public function editProfile($name = null, $email = null, $image = null){
        $user_id = Session::get($this->_sessionName);
        if(self::get("users", array("id", "=", $user_id))->count()){
                if(empty($name) || empty($email)){
                    $this->getError("Name and Email field must be field!");
                }else if(strlen($name) < 2){
                    $this->getError("Name must be minimum of 2 characters long");
                }else if(strlen($name) > 50){
                    $this->getError("Name must be maximum of 50 characters long");
                }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $this->getError("Enter a valid email");
                }else{
                    $imageName = $image["name"];
                    $tmp_name = $image["tmp_name"];
                    $Error = $image["error"];
                    $Type = $image["type"];
                    $Size = $image["size"];

                $fileExt = explode(".", $imageName);
                $fileExt = strTolower(end($fileExt));

                $extensions = ["jpg", "jpeg", "png", "gif"];
                if(in_array($fileExt, $extensions)){
                    if($Error === 0){
                            if($Size <= 1000000){
                                $fileName = "profile_image_".uniqid().".".$fileExt;
                                $fileDestination = "profile_image/".$fileName;

                                $update = self::update("users", array(
                                    "name" => $name,
                                    "email" => $email,
                                    "image" => $fileDestination
                                ), array("id", "=", $user_id));
                                if($update){
                                    move_uploaded_file($tmp_name, $fileDestination);
                                    return true;
                                }
                            }else{
                                $this->getError("File size must be maximum of 10mb");
                            }
                    }else{
                        $this->getError("There was an Error uploading file.");
                    }
                }else{
                    $this->getError("Enter a valid file type!");
                }
                    
                }
            }

       return false;
    }



    public function delete_user_account($password, $id){
        if(Session::exists($this->_sessionName)){
            if(strlen($password) < 6){
                $this->getError("Password must be minimum of 6 characters long.");
            }else if(strlen($password) > 50){
                $this->getError("Password must be maximum of 50 characters long.");
            }else{
               if($this->find($id)){
                    if($this->data()["password"] == Hash::make($password, $this->data()["salt"])){
                         $delete =  self::update("users", array(
                                 "activate" => false
                          ), array("id", "=", $id));
                          if($delete){
                            Session::delete(Config::get("session/session_name"));
                            return true;
                          }
                    }else{
                        $this->getError("Wrong Password!");
                    }
               }else{
                   $this->getError("User does not Exists!");
               }
            }
        }
        return false;
    }













    //  end;

}



     