<?php
    require_once "core/init.php";
    if(Session::exists(Config::get("session/session_name"))){  
        $user_id = Session::get(Config::get("session/session_name"));
        $profile = new User();
        $profile->update("admin", array(
            "online", "=", 0
        ), array("id", "=", $user_id)); 
        Session::delete(Config::get("session/session_name")); 
        Redirect::to("signup.php");
    }
?>