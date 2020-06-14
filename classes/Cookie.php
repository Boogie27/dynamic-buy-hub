<?php


   class Cookie{
       


       public function exists($name){
           return (isset($_COOKIE[$name]))? true : false;
       }

       public function get($name){
           if(self::exists($name)){
               return $_COOKIE[$name];
           }
           return false;
       }

       public function put($name = null, $value = null, $expiry = null){
           if($name){
               if(  setcookie($name, $value, time() + $expiry, "/")){
                   return true;
               }
           }
          return false;
       }

       





    // end;
   }