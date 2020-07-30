<?php

class Redirect {


    public function to($location = null, $message = null){
        if($location){
            if($message && count($message) == 2){
                  $name = $message[0];
                  $string = $message[1];
                  Session::flash($name, $string);
            }
            header("Location: ".$location);
        }
    }
}