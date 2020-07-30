<?php

class Session{


      public static function put($name, $string){
          return $_SESSION[$name] = $string;
      }



      public static function exists($name){
          return (isset($_SESSION[$name]))? true : false;
      }

      public static function get($name){
              return $_SESSION[$name];
      }

      public static function delete($name){
          if(self::exists($name)){
              unset($_SESSION[$name]);
          }
      }


      


      public static function flash($name, $message = null){
          if(self::exists($name)){
              $flash = self::get($name);
              self::delete($name);
              return $flash;
          }else{
              self::put($name, $message);
          }
          return false;
      }


    //   end;
}