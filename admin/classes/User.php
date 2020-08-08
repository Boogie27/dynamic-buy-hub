<?php

class User extends Product{
    
    private $_error = false,
            $_data = null,
            $_passed = false,
            $_image = null;


    public function __construct($user = null){
        Parent::__construct();
        if($user){
           $this->find($user);
        }
    }



    public function find($user){
        if($user){
            $userField = is_numeric($user) ? "id" : "email";
            $check = self::get("admin", array($userField, "=", $user));
            if($check->count()){
                $this->_data = $check->first();
                return $this;
            }
        }
        return false;
    }


     public function activate($table, $id){
         if($id && $table){
             $check = self::get($table, array("id", "=", $id));
             if(!$check->count()){
                  $this->_error = "User does not exist in the data base";
             }else{
                if(!$check->first()->activate){
                     $state = 1;
                }else{
                    $state = 0;
                }
                self::update($table, array(
                     "activate" => $state,
                     "online" => 0
                ), array("id", "=", $id));


                return true;
             }
         }else{
            $this->_error = "Something went wrong!";
         }
        return false;
     }
   


     public function deactivate($table, $id){
         if($table && $id){
            $check = self::get($table, array("id", "=", $id));
            if(!$check->count()){
                $this->_error = "User does not exist in the data base";
           }else{
            self::update($table, array(
                "activate" => 0,
                "online" => 0
           ), array("id", "=", $id));
           return true;
           }
         }else{
             $this->_error = "Something went wrong!";
         }
        return false;
     }

    

    

  public function admin_activate($table, $id){
      return $this->activate($table, $id);
  }


   public function admin_deactivate($table, $id){
       return $this->deactivate($table, $id);
   }


    public function error(){
        return $this->_error;
    }


    public function passed(){
        return $this->_passed;
    }


    public function data(){
        return $this->_data;
    }




    public function check_admin($name, $email, $password, $position){
        if(empty($name) || empty($email) || empty($password) || empty($position)){
                 $this->_error = "All fields must be filled!";
        }else if(strlen($name) < 2){
            $this->_error = "Name must be a minimum of 2 characters!";
        }else if(strlen($name) > 50){
            $this->_error = "Name must be a maximum of 50 characters!";
        }else if(strlen($password) < 6){
            $this->_error = "Password must be a minimum of 6 characters!";
        }else if(strlen($password) > 20){
            $this->_error = "Name must be a maximum of 20 characters!";
        }

        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }


    public function admin_delete($table, $id){
        if($table && $id){
            $check = self::get($table, array("id","=", $id ));
            if($check->count()){
                self::delete($table, array("id", "=", $id));
                return true;
            }
        }
        return false;
    }




    
    public function check_image($image = null){
        if($image["name"]){
            $imageName = $image["name"];
            $tmp_name = $image["tmp_name"];
            $error = $image["error"];
            $type = $image["type"];
            $size = $image["size"];
    
            $fileExt = explode(".", $imageName);
            $fileExt = strtolower(end($fileExt));
    
            $extension = ["jpg", "jpeg", "png", "gif", "png"];
            if(in_array($fileExt, $extension)){
                if($error === 0){
                        if($size <= 1000000){
                            $fileName = "image_".uniqid().".".$fileExt;
                            $this->_image = $fileName;
                        }else{
                            $this->_error = "File size must be maximum of 10mb";
                        }
                }else{
                    $this->_error = "There was an Error uploading file.";
                }
            }else{
                $this->_error = "Enter a valid file type!";
            }
        }
        
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }





    public function admin_profile_edit($email, $name, $position, $phone, $bio, $address, $image){
         if($email != $this->data()->email && self::get("admin", array("email", "=", $email))->count()){
            $this->_error = "The email ".$email." already exist!";
         }else{
            if($this->check_image($image)->image()){
               unlink("admin-image/".$this->data()->image);
               move_uploaded_file($image["tmp_name"], "admin-image/".$this->_image);
               $this->data()->image = $this->_image;
            }
            self::update("admin", array(
                 "name" => $name,
                 "email" => $email,
                 "position" => $position,
                 "phone" => $phone,
                 "bio" => $bio,
                 "address" => $address,
                 "image" => $this->data()->image
            ), array("id", "=", $this->data()->id));
         }
         if(!$this->_error){
            $this->_passed = true;
         }
        return $this;
    }

    public function image(){
        return $this->_image;
    }



    public function signup($field = array()){
        if(!self::insert("admin",$field )){
            $this->_error = "There was a problem signing up";
        }else{
            $check = self::get("admin", array("email", "=", $field["email"]));
            if($check->count()){
                Session::put(Config::get("session/session_name"), $check->first()->id);
            }
        }
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }


    public function login($email, $password){
         if(!$this->find($email)){
            $this->_error = "The email {$email} does not exist!";
         }else if($this->data()->password != Hash::make($password, $this->data()->salt)){
            $this->_error = "Wrong password!";
         }else{
             self::update("admin", array(
                 "online" => 1
             ), array("id", "=", $this->data()->id));
            Session::put(Config::get("session/session_name"), $this->data()->id);
         }
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }


    // end;
}