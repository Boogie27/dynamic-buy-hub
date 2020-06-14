<?php
    session_start();
   


    $GLOBALS["config"] = array(
        "mysql" => array(
            "host" => "127.0.0.1",
            "username" => "root",
            "password" => "",
            "db" => "shop_hub"
        ),
        "session" => array(
            "session_name" => "id",
            "token_name" => "token",
        ),
        "remember" => array(
            "cookie_name" => "hash",
            "cart_hash" => "items",
            "cookie_expire" => 86400
        ),
        "money" => array(
            "tax" => 0.087
        )
    );

    spl_autoload_register(function($classes){
        require_once "classes/".$classes.".php";
    });


    require_once "functions/sanitize.php";
   
    // =========================================================================
    // FUNCTION THAT DELETES SAVE TO CART ITEMS AUTOMATICALL WHEN COOKIE EXPIRES
    // ========================================================================

    if(Session::exists(Config::get("session/session_name"))){
        $user_id = Session::get(Config::get("session/session_name"));
        if(!Cookie::exists(Config::get("remember/cart_hash"))){
            $cart = new Cart();
            if($cart->get("cart", array("user_id", "=", $user_id))->count()){
                $cart->delete("cart", array("user_id", "=", $user_id)); 
            }
            
        }
    }
    
    // =========================================================================
    // FUNCTION THAT DELETES CART AUTOMATICALLY
    // ========================================================================

    if(Session::exists("cart")){
        $oldCart = Session::get("cart");
        $cartItem = new Cart($oldCart); 
        $cartItem->auto_cart_delete();
    }

    
      // =========================================================================
    // FUNCTION THAT AUTOMATICALLY DELETESUSER IF USER SESSION EXISTS BUT USER IS NOT FOUND IN DATABASE
    // ========================================================================
    if(Session::exists(Config::get("session/session_name"))){
        $user_id = Session::get(Config::get("session/session_name"));
          $user = new User($user_id);
          if(!$user->isLoggedIn()){
              Session::delete(Config::get("session/session_name"));
          }
    }
