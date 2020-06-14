<?php

class Session{


      public function put($name, $string){
          return $_SESSION[$name] = $string;
      }



      public function exists($name){
          return (isset($_SESSION[$name]))? true : false;
      }

      public function get($name){
          if(self::exists($name)){
              return $_SESSION[$name];
          }
          return false;
      }

      public function delete($name){
          if(self::exists($name)){
              unset($_SESSION[$name]);
              return true;
          }
          return false;
      }


      


      public function flash($name, $message = null){
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