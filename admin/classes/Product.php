<?php

class Product{
     

    private $_pdo,
            $_query,
            $_result,
            $_count,
            $_error = false,
            $_passed = false,
            $_data = null;


    public function __construct($id = null){
         $this->_pdo = Db::getInstance()->pdo(); 
            $field = $id ? array("id", "=", $id) : null;
            $check = self::get("products", $field);
            if($check->count()){
                $this->_data = $id ? $check->first() : $check->result();
            }
    }


    public function data(){
        return $this->_data;
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



 public function limit($table, $limit = array()){
       if($table){
           if(count($limit) == 2){
               $start = $limit[0];
               $end = $limit[1];
               $values = array($start, $end);
           }
           $sql = "SELECT * FROM {$table} Limit {$start}, {$end}"; 
           if(!$this->query($sql)->error()){
               return $this;
           }
       }
 return false;
}


public function select($table, $params){
    if($table){
        $value = null;
        if(count($params) == 2){
            $field = $params[0];
            $limit = $params[1];
            $value = " limit {$limit}";
        }
        if(count($params) == 1){
            $field = $params[0];
        }
    $sql = "SELECT * FROM {$table} order by {$field} desc {$value}";
        if(!$this->query($sql)->error()){
            return $this;
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



    public function check_image($image = null){

        if($image["name"]){
            $imageName = $image["name"];
            $tmp_name = $image["tmp_name"];
            $error = $image["error"];
            $type = $image["type"];
            $size = $image["size"];
    
            $fileExt = explode(".", $imageName);
            $fileExt = strtolower(end($fileExt));
    
            $extension = ["jpg", "jpeg", "png", "gif", "png"];
            if(in_array($fileExt, $extension)){
                if($error === 0){
                        if($size <= 1000000){
                            $fileName = "image_".uniqid().".".$fileExt;
                            $this->_image = $fileName;
                        }else{
                            $this->_error = "File size must be maximum of 10mb";
                        }
                }else{
                    $this->_error = "There was an Error uploading file.";
                }
            }else{
                $this->_error = "Enter a valid file type!";
            }
        }
        
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }




    public function add_product($name, $brand, $category, $sub_category, $price, $oldprice, $qty, $detail, $description, $image){
          if($this->check_image($image)){
            if(move_uploaded_file($image["tmp_name"], "images/".$this->_image)){
                self::insert("products", array(
                    "name" => $name,
                    "price" => $price,
                    "old_price" => $oldprice,
                    "brand" => $brand,
                    "slug" => $sub_category,
                    "categories" => $category,
                    "details" => $detail,
                    "description" => $description,
                    "image" => $this->_image,
                    "quantity" => $qty,
                ));
            } 
             
          }
          if(!$this->_error){
              $this->_passed = true;
          }
          return $this;
    }
    


    public function edit_product($name, $brand, $category, $sub_category, $price, $oldprice, $qty, $detail, $description, $image){
          
         if($image["name"]){
             if($this->check_image($image)){
                move_uploaded_file($image["tmp_name"], "images/".$this->_image); 
                $this->data()->image = $this->data()->image.",".$this->_image;
             }
         }
                self::update("products", array(
                    "name" => $name,
                    "price" => $price,
                    "old_price" => $oldprice,
                    "brand" => $brand,
                    "slug" => $sub_category,
                    "categories" => $category,
                    "details" => $detail,
                    "description" => $description,
                    "image" => $this->data()->image,
                    "quantity" => $qty,
                ), array("id", "=", $this->data()->id));
            
        if(!$this->_error){
            $this->_passed = true;
        }
        return $this;
    }




    public function delete_image($id = null,  $index){
        if($id){
             $images = explode(",", $this->data()->image);
             foreach($images as $values => $keys){
                   if($values == $index){
                       if(unlink("images/".$keys)){
                            unset($images[$index]);
                            array_values($images);
                            $this->data()->image =  implode(",", $images); 
                            self::update("products", array(
                                "image" => $this->data()->image
                            ), array("id", "=", $id));
                            return true;  
                       }
                   }
             }
        }
        return false;
    }


    public function delete_product(){
        if($this->data()->id){
             $saved_images = explode(",", $this->data()->image);
             foreach($saved_images as $values){
                 unlink("images/".$values);
             }
            return true;
        }
        return false;
    }


    public function price(){
        $amount = 0;
        foreach($this->data() as $values){
            $amount += $values->price;
        }
        return $amount;
    }

    public function sales($sold = null){
        $sales = 0;
        if($sold){
            $sales = $sold->price * $sold->sold;
        }else{
            foreach($this->result() as $values){

            }
        }
       return $sales;
    }


//     One thing is quite obvious from taking a look at the term itself – it is a fusion of two terms; Photography and Journalism.  
// Photography, as we discussed last class, refers to the process of drawing with the use of light. This process has been made po

    // end;
}