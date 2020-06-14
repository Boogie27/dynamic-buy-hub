<?php

class Config{

     public function get($path = null){
           if($path){
                $config =  $GLOBALS["config"];
                $path = explode("/", $path);
                foreach($path as $keys){
                    if(isset($config[$keys])){
                         $config = $config[$keys];
                    }
                }
                return $config;
           }
           return false;
     }
}