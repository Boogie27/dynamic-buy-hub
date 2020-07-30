<?php

class Category extends Product{

    private $_error = false,
            $_data = null,
            $_passed = false,
            $_id = null,
            $_image,
            $_input = null;



    public function __construct(){
        Parent::__construct();
    }
   



    public function check_image($folder = null, $image = null){
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
                                return $fileDestination = $folder."/".$this->_image;
                            }else{
                                $this->_error = "File size must be maximum of 10mb";
                            }
                    }else{
                        $this->_error = "There was an Error uploading file.";
                    }
                }else{
                    $this->_error = "Enter a valid file type!";
                }

         return false;
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



    public function add_new_category($input, $image){
         $this->_input = $input;
         if($this->_input){
               if($this->field_check()){
                   $this->_error = "{$this->_input} already exist!";
               }else{
                   if(!$image["name"]){
                         $this->_error = "Choose an image to upload!";
                   }else{
                        if($fileDestination = $this->check_image("category-image", $image)){
                            move_uploaded_file($image["tmp_name"], $fileDestination);
                            self::insert("categories", array(
                                "name" => $input,
                                "image" => $this->_image
                            ));
                        }
                   } 
               }
         }else{
             $this->_error = "Field must not be empty";
         }
         if(!$this->_error){
             $this->_passed = true;
         }

         return $this;
    }


    
    

    public function deleteCategroy($id){
        $id = escape($id);
        if($id){
            $data = self::get("categories", array("id", "=", $id));
            if($data->count()){
                $fileLocation = "category-image/".$data->first()->image;
                if(!unlink($fileLocation)){
                  $this->_error = "image could not be deleted";
                }else{
                     if($data->delete("categories", array("id", "=", $id))){
                        self::delete("sub_categories", array("categories_id", "=", $id));
                    }
                }
            }else{
                $this->_error = "Category does not exist!";
            }
        }
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }


   public function field_check($id = null){
            $catID = $id ? array(["id", "=", $id]) : null;
            $check = self::get("categories", array("name", "=", $this->_input), $catID);
            if($check->count()){
                $this->_data = $check->first();
                 return true;
            }
       return false;
   }

    public function categoryEdit($id, $input, $image){
        if($id){
            $this->_input = escape($input);


             if($this->_input){
                if($image["name"]){
                    $fileDestination = $this->check_image("category-image", $image);
                    if($fileDestination){
                        // when there there is image and input and input is same as that of the database;
                        if($this->field_check($id)){
                            $name = $this->_input;
                            $imageName = $this->_image;
                              // update 
                        }else{
                            // when there is image and input but the input is not thesame in the database is is not found in the database;
                            if(!$this->field_check()){
                                $name = $this->_input;
                                $imageName = $this->_image;
                                  // update
                            }
                        }
                    }
                    if($this->folder_image_delete($id)){
                        move_uploaded_file($image["tmp_name"], $fileDestination);
                    }else{
                        $this->_error = "Image could not be deleted!";
                    }
                   
                }else{
                     // when there there is no image and input and input is same as that of the database;
                     if($this->field_check($id)){
                        $name = $this->_input;
                        $imageName = $this->data()->image;
                          // update 
                    }
                     // when there is image no and input but the input is not thesame in the database is is not found in the database;
                     if(!$this->field_check()){
                        $check = self::get("categories", array("id", "=", $id));
                        if($check->count()){
                            $this->_data = $check->first();
                            $name = $this->_input;
                            $imageName = $this->data()->image;
                        }
                          // update
                    }
                }
             }else{
                 $this->_error = "Field must not be empty!";
             }
    
        }
        if(!$this->_error){
             self::update("categories", array(
                   "name" => $name,
                   "image" => $imageName
             ), array("id", "=", $id));
            $this->_passed = true;
        }
        return $this;
    }




    public function folder_image_delete($id){
        if($id){
              $check = self::get("categories", array("id", "=", $id));
              if($check->count()){
                  $image = $check->first()->image;
                  $image = "category-image/".$image;
                  if(unlink($image)){
                      return true;
                  }
              }
        }
        return false;
    }




    
    public function add_sub_category($name = null, $brand_id = null, $category_id = null){
        if(empty($brand_id)){
            $this->_error = "Select product brand";
        }else if(empty($name)){
            $this->_error = "Field must not be empty!";
            }else if(strlen($name) < 2){
                  $this->_error = "Field must be a minimum of 2 character!";
            }else if(strlen($name) > 30){
                $this->_error = "Field must be a maximum of 30 character!";
            }else{
                $check = self::get("sub_categories", array("name", "=", $name), array(["categories_id", "=", $category_id]));
                if($check->count()){
                    $this->_error = "The sub category {$name} already exist!";
                }else{
                    self::insert("sub_categories", array(
                          "name" => $name,
                          "categories_id" => $category_id,
                          "brand_id" => $brand_id
                    ));
                }
            }
            if(!$this->_error){
                $this->_passed = true;
            }
        return $this;
    }



    public function edit_sub_category($name, $brand_id, $id){
        if(empty($brand_id)){
            $this->_error = "Select product brand";
        }else if(empty($name)){
            $this->_error = "Field must not be empty!";
            }else if(strlen($name) < 2){
                  $this->_error = "Field must be a minimum of 2 character!";
            }else if(strlen($name) > 30){
                $this->_error = "Field must be a maximum of 30 character!";
            }else{
                $check = self::get("sub_categories", array("name", "=", $name));
                if($check->count()){
                    $this->_error = "The sub category {$name} already exist!";
                }else{
                    self::update("sub_categories", array(
                        "name" => $name,
                        "brand_id" => $brand_id
                  ), array("id", "=", $id));
                }
            }
            if(!$this->_error){
                $this->_passed = true;
            }
        return $this;
    }




    public function featured($table, $id){
        if($id){
             $check = self::get($table, array("id", "=", $id));
             if($check->count()){
                if($check->first()->featured){
                    $state = 0;
                }else{
                    $state = 1;
                }

                self::update($table, array(
                    "featured" => $state
                ), array("id", "=", $id));
             }
             return $state;
        }
        return false;
    }


















    // end;
}