<?php

  class Input{


    public static function json_decode($string){
        return json_decode($string, true);
    }



    public static function money($string){
        if($string){
            $sign = "&#8358;";
            return $sign.number_format($string);
        }
    }


    public static function get($string = null){
        if($string){
            if(isset($_POST[$string])){
                return $_POST[$string];
            }else if(isset($_GET[$string])){
                return $_GET[$string];
            }
        }
        return false;
    }


    public static function exists($string = "post"){
        $string = strtolower($string);
        switch($string){
            case "post":
                  return (!empty($_POST)) ? true : false;
            break;
            case "get":
                  return (!empty($_GET)) ? true : false;
            break;
            default:
                  return false;
            break;
        }
    }


    public function date($string){
        if($string){
            return explode(" ", $string)[0];
        }
        return false;
    }

    


    // end;
  }