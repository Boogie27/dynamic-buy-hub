<?php

class Redirect {


    public function to($location = null, $message = null){
        if($location){
            if(is_numeric($location)){
                switch($location){
                    case "404":
                          header("HTTP/1.0 404 Not found");
                          include "error/404.php";
                          exit();
                    break;
                }
            }
            if($message && count($message) == 2){
                  $name = $message[0];
                  $string = $message[1];
                  Session::flash($name, $string);
            }
            header("Location: ".$location);
        }
    }
}