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
        "session_name" => "admin_id",
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



spl_autoload_register(function($class){
     require_once "classes/".$class.".php";
    
});



require_once "functions/sanitize.php";

if(Session::exists(Config::get("session/session_name"))){
    $id = Session::get(Config::get("session/session_name"));
    $user = new User();
    $userInfo = $user->find($id);
    if($id != $userInfo->data()->id){
        Redirect::to("signup.php"); 
    }
}