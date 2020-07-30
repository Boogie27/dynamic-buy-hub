<?php

class Brand extends Product{

    private $_error = false,
            $_passed = false,
            $_data;
    

    public function __construct(){
        Parent::__construct();
    }



    public function find($string = null){
        if($string){
            $field = is_numeric($string) ? "id" : "brand";
             $items = self::get("brand", array($field, "=", $string));
             if($items->count()){
                 $this->_data = $items->first();
             }
             return true;
        }
        return true;
    }





    public function brand($id){
        if($this->find($id)){
            echo $this->data()->brand;
        }
    }



    public function check($input = null){
        if($input){
           if(strlen($input) > 50){
                $this->_error = "field must be maximum of 50 characters long!";
            }else if(strlen($input) < 2){
                $this->_error = "field must be minimum of 2 characters long!";
            }else if(self::get("brand", array("brand", "=", $input))->count()){
                    $this->_error = "The Brand {$input} already exists!";
            }else{
                return true;
            }
        }
        return false;
    }


    public function editBrand($input = null, $id = null){
            $input = trim(escape($input));
            if(empty($input)){
                $this->_error = "Field must not be empty!";
            }else if($this->check($input)){
                    $upade =  $this->update("brand", array(
                        "brand" => $input
                ), array("id", "=", $id));
             } 
             if(!$this->_error){
                 $this->_passed = true;
             }  
        return $this;
    }



    public function newBrand($input){
        $input = trim(escape($input));
        if(empty($input)){
            $this->_error = "Field must not be empty!";
        }else  if($this->check($input)){
             $date = date("Y-m-d H:i:s", strtotime("+30days"));
             $insert = $this->insert("brand", array(
                   "brand" => $input,
                   "date" => $date
             ));
        }
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }


    public function deleteBrand($id){
        $id = escape($id);
        if($this->find($id)){
           self::delete("brand", array("id", "=", $id));
        }
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }



    public function getError(){
         return $this->_error;
    }
    


    public function passed(){
        return $this->_passed;
    }



    public function data(){
        return $this->_data;
    }





    // end;
}