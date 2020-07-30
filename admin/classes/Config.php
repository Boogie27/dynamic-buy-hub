<?php

class Config{


    public static function get($path = null){
        if($path){
            $config = $GLOBALS["config"];
            $path = explode("/", $path);
            foreach($path as $values){
                if(isset($config[$values])){
                   $config = $config[$values];
                }
            }
            return $config;
        }
        return false;
    }


}