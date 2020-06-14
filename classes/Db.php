<?php


class Db{


       private static $_instance = null;
       private $_pdo,
               $_error = false,
               $_passed = false,
               $_count,
               $_result,
               $_query;



        private function __construct(){
            try{
                $this->_pdo = new PDO("mysql:host=".Config::get("mysql/host")."; dbname=".Config::get("mysql/db"), Config::get("mysql/username"), Config::get("mysql/password"));
            }catch(PDOException $e){
                    die("connection failed ".$e->getmessage());
            }
        }


        public function pdo(){
            return $this->_pdo;
        }


        public static function getInstance(){
            if(!isset(self::$_instance)){
               self::$_instance = new Db();
            }
            return self::$_instance;
        }



        public function query($sql, $params = array()){
              $this->_error = false;
              if($this->_query = $this->_pdo->prepare($sql)){
                  if(count($params)){
                      $x = 1;
                      foreach($params as $keys){
                          $this->_query->bindValue($x, $keys);
                          $x++;
                      }
                  }
                  if($this->_query->execute()){
                       $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                       $this->_count = $this->_query->rowCount();
                  }else{
                      $this->_error = true;
                  }
              }
              if(empty($this->error())){
                  $this->_passed = true;
              }
              return $this;
        }

        public function error(){
            return $this->_error;
        }

        public function count(){
            return $this->_count;
        }

        public function result(){
           return  $items = json_decode(json_encode($this->_result), true);
        }


        public function first(){
            return $this->result()[0];
        }


        public function passed(){
            return $this->_passed;
        }


        public function action($action, $table, $where = array()){
                 if(count($where) == 3){
                     $field = $where[0];
                     $operator = $where[1];
                     $value = $where[2];

                     $operators = ["=", "<", ">", "=>", "<="];
                     if(in_array($operator, $operators)){
                          $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                          if(!$this->query($sql, array($value))->error()){
                             return $this;
                          }
                     }
                 }
                 return false;
        }

        public function get($table, $where){
             return $this->action("SELECT *", $table, $where);
        }













        // end
}