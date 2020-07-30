<?php

class Product{
     

    private $_pdo,
            $_query,
            $_result,
            $_count,
            $_error = false,
            $_passed = false;


    public function __construct(){
         $this->_pdo = Db::getInstance()->pdo(); 
    }



    
    public function query($sql, $params = array()){
        $this->_error = false;
         if($this->_query = $this->_pdo->prepare($sql)){
              if(count($params)){
                  $x = 1;
                  foreach($params as $param){
                      $this->_query->bindValue($x, $param);
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
      return $this;
    }


    

    public function action($action, $table, $where = null, $params = null){
       if($table){
            $sql = "{$action} FROM {$table}";
            $operators = [">", "<", ">=", "<=", "="];
            $queryValue = array();

            if($where && count($where) == 3){
                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];

                if(in_array($operator, $operators)){
                     $sql .= " WHERE {$field} {$operator} ? ";
                     $queryValue[] = $value;
                }

                if($params && count($params)){
                    foreach($params as $param){
                        if(count($param) == 3){
                            $field2 = $param[0];
                            $operator2 = $param[1];
                            $value2 = $param[2];
                            
                            if(in_array($operator2, $operators)){
                                $sql .= "AND {$field2} {$operator2} ? ";
                                $queryValue[] = $value2;
                            }
                        }
                    }
                }
            }
           if(!$this->query($sql, $queryValue)->error()){
               return $this;
           }
       }
       return false;
    }


    public function get($table, $where = null, $params = null){
        return $this->action("SELECT *", $table, $where, $params);
 }




    public function insert($table, $params = array()){
        if($table){
            $value = "";
            $keys = array_keys($params);
            $x = 1;
            foreach($params as $param => $key){
                $value .= "?";
                if($x < count($params)){
                    $value .= ", ";
                }
                $x++;
            }
            $sql = "INSERT INTO {$table} (`".implode("`,`", $keys)."`) VALUE({$value})";
            if(!$this->query($sql, $params)->error()){
                return true;
            }
        }
         return false;
    }





    public function update($table, $params = array(), $where = array()){
        if(count($params)){
            $values = "";
            $itemsValue = array();
            $x = 1;
            foreach($params as $param => $keys){
                $values .= "{$param} = ?";
                if($x < count($params)){
                    $values .= ", ";
                }
                $x++;
                $itemsValue[] = $keys;
            }
        

        if(count($where) == 3){
              $operators = [">", "<", ">=", "<=", "=", "RLIKE"];
              $field = $where[0];
              $operator = $where[1];
              $value   = $where[2];
              if(in_array($operator, $operators)){
                  $itemsValue[] = $value;
                  $sql = "UPDATE {$table} SET {$values} WHERE {$field} {$operator} ?";
                  if(!$this->query($sql, $itemsValue)->error()){
                       return true;
                  }
              }
        }
      }
      return false;
 }




 public function delete($table, $where){
     return $this->action("DELETE", $table, $where);
 }






    public function error(){
        return $this->_error;
    }


    public function result(){
        return $this->_result;
    }

    public function first(){
        return $this->result()[0];
    }


    public function count(){
        return $this->_count;
    }


    public function passed(){
        return $this->_passed;
    }






    // end;
}