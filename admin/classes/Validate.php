<?php

class Validate extends Product{

    private $_passed = false,
            $_error = array();



    public function __construct(){
        Parent::__construct();
    }



    public function check($post, $params = array()){
          foreach($params as $values => $keys){
                $name = $keys["name"];
                foreach($keys as $rules => $value){
                    $action = trim(escape($post[$values]));
                     if($rules === "required" && empty($action)){
                         $this->addError("{$name} is required");
                     }else if(!empty($action)){
                          switch($rules){
                              case "min":
                                    if(strlen($action) < $value){
                                        $this->addError("{$name} must be a minimum of {$value} characters!");
                                    }
                              break;
                              case "max":
                                    if(strlen($action) > $value){
                                        $this->addError("{$name} must be a maximum of {$value} characters!");
                                    }
                              break;
                              case "match":
                                     if($action != $post[$value]){
                                        $this->addError("{$name} must match {$value}!");
                                     }
                              break;
                              case "unique":
                                      $check = self::get($value, array($values, "=", $action));
                                      if($check->count()){
                                          $this->addError("The {$name} {$action} already exists!");
                                      }
                               break;
                               case "phone":
                                     if(!is_numeric($action)){
                                        $this->addError("Invalid {$name} number!");
                                     }
                               break;
                          }
                     }
                }
          }

          if(empty($this->_error)){
              $this->_passed = true;
          }
          return $this;
    }


    public function addError($error){
         $this->_error[] = $error;
    }


    public function error(){
        return $this->_error;
    }



    public function passed(){
        return $this->_passed;
    }






    // end;
}