<?php

class Category{
    private $_db,
            $_result,
            $_items,
            $_count,
            $_error = false;
            
    


    public function __construct(){
        $this->_db = Db::getInstance()->pdo(); 
    }


   public function count(){
       return $this->_count;
   }

   public function first(){
       return $this->result()[0];
   }

   public function result(){
       return json_decode(json_encode($this->_result), true);
   }


   public function error(){
       return $this->_error;
   }



   public function query($sql, $params = array()){
        $this->_error = false;
        if($this->_items = $this->_db->prepare($sql)){
            if(count($params)){
               $x = 1;
               foreach($params as $param){
                   $this->_items->bindValue($x, $param);
                   $x++;

               }
            }
            if($this->_items->execute()){
                $this->_result = $this->_items->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_items->rowCount();
                
          }else{
              $this->_error = true;
          }
        }
        return $this;
   }





  public function action($action,$table, $where, $parameters){
        if($table){
            $operators = [">", "<", ">=", "<=", "=", "RLIKE"];
            $sql = "{$action} FROM {$table}";
        
            $field = $where[0];
            $opera = $where[1];
            $val   = $where[2];
            if(in_array($opera, $operators)){
                $sql .= " WHERE {$field} {$opera} ?";
            }
            $values[] = $val;
            
            if($parameters && count($parameters)){
                foreach($parameters as $parameter){
                    if($parameter){
                        foreach($parameter as $keys){
                            $fields = $parameter[0];
                            $operator = $parameter[1];
                            $value = $parameter[2];
                            if(in_array($keys, $operators)){
                                $sql .= " AND {$fields} {$operator} ?";
                                $values[] = $value;
                            }
                        }
                    }
                }
            }
        
            if(!$this->query($sql, $values)->error()){
                return $this;
            }  
        }
        return false;
  }



  public function get($table = null, $where = null, $parameters = null){
      return $this->action("SELECT *", $table, $where, $parameters);
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



   public function delete($table, $where = null, $parameters = null){
        return $this->action("DELETE ", $table, $where, $parameters);
   }



    public function rand($table, $where = array(), $limit = null){
           $fields = $where[0];
           $operator = $where[1];
           $value = escape($where[2]);

           $operators = ["=", "<", ">", ">=", "<="];
           if(in_array($operator, $operators)){
               $sql = "SELECT * FROM {$table} WHERE {$fields} {$operator} ? ORDER BY RAND() LIMIT {$limit}"; 
               if(!$this->query($sql, array($value))->error()){
                   return $this;
               }
           }
           return false;
    }


    public function limit($table, $where = array(), $limit = null){
            $fields = escape($where[0]);
            $operator = $where[1];
            $value = escape($where[2]);

            $limit = escape($limit);

            $operators = ["=", "<", ">", ">=", "<="];
            if(in_array($operator, $operators)){
                $sql = "SELECT * FROM {$table} WHERE {$fields} {$operator} ? ORDER BY id LIMIT {$limit}"; 
                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }else{
                    echo "error";
                }
            }
            return false;
    }
    


    public function count_duplicate($table, $field){
        $sql = "SELECT * FROM {$table} GROUP BY {$field} HAVING COUNT($field) > 1";
        if(!$this->query($sql)->error()){
            return $this;
        }
    }


    












// end
}