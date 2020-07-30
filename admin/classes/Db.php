<?php

class Db{

    private static $_instance = null;

    private $_pdo;

    public function __construct(){
        try{
            $this->_pdo = new PDO("mysql:host=".Config::get("mysql/host")."; dbname=".Config::get("mysql/db"), Config::get("mysql/username"), Config::get("mysql/password"));
        }catch(PDOExemption $e){
             die("connection failed ".$e->getMessage());
        }
    }




    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new Db;
        }
          return self::$_instance;
    }

    public function pdo(){
        return $this->_pdo;
    }


    // end;
}