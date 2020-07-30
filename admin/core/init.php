<?php
session_start();

$_SESSION["id"] = 1;

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



spl_autoload_register(function($class){
     require_once "classes/".$class.".php";
    
});



require_once "functions/sanitize.php";