<?php

class Input{


            public function exists($path = "post"){
                $path = strtolower($path);
                switch($path){
                     case "post":
                           return (!empty($_POST))? true : false;
                     break;
                     case "get":
                          return (!empty($_GET))? true : false;
                     break;
                     default:
                           return false;
                     break;
                }
            }


           public function get($params = null){
               if($params){
                    if(isset($_POST[$params])){
                        return $_POST[$params];
                    }else if(isset($_GET[$params])){
                        return $_GET[$params];
                    }
                }
             return false;
           }


           public function onclick($click = null){
                if($click){
                      if(isset($_POST[$click])){
                          return true;
                      }
                }
                return false;
           }



           public function json_decode($string){
                 return json_decode($string, true);
           }




           public function money($string = null){
               if($string){
                    $sign = "&#8358;";
                    return $sign.number_format($string);
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