<?php

class Cart extends Category{

     private $_items = null,
             $_totalPrice = 0,
             $_totalQty = 0,
             $_cart = null;
    
    private $_error = false,
            $_availableQuantity = 0;

    private  $_saveItems = null,
             $_savePrice = 0,
             $_saveQty = 0,
             $_save = null;
    
    

    public function __construct($oldCart = null, $oldSave = null){
        parent::__construct();
        if($oldCart){
            $this->_items = $oldCart["items"];
            $this->_totalPrice = $oldCart["totalPrice"];
            $this->_totalQty = $oldCart["totalQty"];
        }

        if($oldSave){
            $this->_saveItems = $oldSave["items"];
            $this->_savePrice = $oldSave["savePrice"];
            $this->_saveQty = $oldSave["saveQty"];
        }
    }





  
    public function update_quantity($id, $Qty = array()){
           if($productQty = self::get("products", array("id", "=", $id))){
               $id = $productQty->first()["id"];
               if(!$Qty[1]){
                   if($productQty->first()["quantity"] < 0 || ($productQty->first()["quantity"] -= $Qty[0]) < 0){
                           $this->_availableQuantity = 0;
                   }else{
                        $quantity = $productQty->first()["quantity"] -= $Qty[0];
                        self::update("products", array(
                            "quantity" => $quantity
                        ), array("id", "=", $id));
                   }
                       
                }else{
                    $quantity = $productQty->first()["quantity"] += $Qty[0];
                     self::update("products", array(
                            "quantity" => $quantity
                        ), array("id", "=", $id));
                }
                
                return true;
           }
         
          return false;
    }


    public function update_sold($id, $quantity){
        if($id){
            $check = self::get("products", array("id", "=", $id));
            if($check->count()){
                $sold = $check->first()["sold"];
                $sold += $quantity;
                $item = self::update("products", array(
                    "sold" => $sold
                ), array("id", "=", $id));
                return true;
            }
        }
        return false;
    }


    public function available_qunatity(){
        return $this->_availableQuantity;
    }




    public function add_to_cart($id, $qty = null){
       if(Self::get("products", array("id", "=", $id), array(["quantity", ">", 0]))->count()){
            if($id){
                    $product = self::get("products", array("id", "=", $id))->first();
                    $cartProduct = ["quantity" => 0, "price" => $product["price"], "item_id" => $product["id"] ];

                    

                    if($this->_items){
                        if(array_key_exists($id, $this->_items)){
                            $cartProduct = $this->_items[$id];
                        }
                    }
                   
                   

                    if(!empty($qty)){
                        $this->update_quantity($id, array($qty, false));
                        $cartProduct["quantity"] += $qty;
                        $cartProduct["price"] = $cartProduct["quantity"] * $product["price"];
                        $this->_totalPrice +=  $cartProduct["price"];
                        $this->_totalQty += $qty;
                    }else{
                        $qty = 1;
                        $this->update_quantity($id, array($qty, false));
                        $cartProduct["quantity"]++;
                        $cartProduct["price"] = $cartProduct["quantity"] * $product["price"];
                        $this->_totalPrice += $product["price"];
                        $this->_totalQty++;
                    }

                
                
                    $this->_items[$id] = $cartProduct;
                    $this->_cart = ["items" => $this->_items, "totalPrice" =>  $this->_totalPrice, "totalQty" => $this->_totalQty];
                }
                if($this->_cart){
                    return $this;
                }
       }
        return false;
    }





    public function get_cart(){
        return $this->_cart;
    }


  


    public function save_action($id = null){
          if(Session::get("cart")){     
               if($this->_items){
                   if(array_key_exists($id, $this->_items)){
                        $_SESSION["cart"]["totalPrice"] -= $this->_items[$id]["price"];
                        $_SESSION["cart"]["totalQty"]  -= $this->_items[$id]["quantity"];
                        
                        $this->update_quantity($id, array($this->_items[$id]["quantity"], true));

                        unset( $_SESSION["cart"]["items"][$id] );
                        if(Session::get("cart")["totalQty"] == 0){
                            Session::delete("cart");
                        }
                        

                   }
               }
            return true;
          }
        return false;
    }



    public function add_save($id = null){
        $this->_error = false;
         if($id){
            if($this->_saveItems){
                if(!array_key_exists($id, $this->_saveItems)){
                    $this->save_item_array($id,  $this->_items);
                   $this->save_action($id);
                }else{
                    $this->_error = true;
                }
            }
            if($this->_items && !$this->_saveItems){
                if(array_key_exists($id, $this->_items)){
                    $this->save_item_array($id, $this->_items);
                    $this->save_action($id);
                }else{
                    $this->_error = true;
                }
            }
            return $this;
         }
        return false;
    }

  

    public function error(){
        return $this->_error;
    }




     public function save_item_array($id, $items){
       if($id){
            $item = $items[$id];
            $saveProduct = ["quantity" => $item["quantity"], "price" => $item["price"], "item_id" => $id ];

            $this->_saveItems[$id] = $saveProduct;
            $this->_savePrice += $saveProduct["price"]; 
            $this->_saveQty += $saveProduct["quantity"]; 
            $this->_save = ["items" => $this->_saveItems, "savePrice" =>  $this->_savePrice, "saveQty" => $this->_saveQty];

            return $this->_save;
       }

        return false;
     }


     public function get_save(){
         return $this->_save;
     }




    public function save_for_later($id){
         if(!$this->add_save($id)->error()){
             $user_id = Session::get(Config::get("session/session_name"));
             $item = json_encode($this->get_save());
             $date = date("Y-m-d H:i:s", strtotime("+30 days"));
             $cart = self::get("cart", array("user_id", "=", $user_id));
             $hash = $cart->first()["hash"];
             if($cart->count()){
                $cart->update("cart", array(
                    "hash" => $hash,
                    "item" => $item,
                    "expire_date" => $date
            ), array("user_id", "=", $user_id));
             }else{
                  $hash = Hash::unique();
                  $cart->insert("cart", array(
                          "hash" => $hash,
                          "item" => $item,
                          "user_id" => $user_id,
                          "expire_date" => $date
                  ));
             }
             Cookie::put(Config::get("remember/cart_hash"), $hash, Config::get("remember/cookie_expire"));
              return true;
         }
        return false;
    }






    public function deleteCart($id){
       if($this->save_action($id)){
           return true;
       }
       return false;
    }



    public function addSave_toCart($id = null){
              if($id){
                 if($this->_saveItems){
                       $_SESSION["cart"]["items"][$id] = $this->_saveItems[$id];
                       $_SESSION["cart"]["totalPrice"] += $this->_saveItems[$id]["price"];
                       $_SESSION["cart"]["totalQty"]  += $this->_saveItems[$id]["quantity"];
                       return true;
                 }
              }
              return false;
    }




    public function return_action($id = null){
        $this->_error = false;
           if($id){
               if($this->_saveItems && !$this->_items){
                   if(array_key_exists($id, $this->_saveItems)){
                        $this->addSave_toCart($id);
                        $this->delete_action($id);    
                   }
               }
               if($this->_items && $this->_saveItems){
                   if(array_key_exists($id, $this->_saveItems)){
                        $this->addSave_toCart($id); 
                        $this->delete_action($id);   
                   }
               }
               return true;
           }
           return false;
    }




    public function delete_action($id = null){
          if($id){
               if($this->_saveItems){
                        if(array_key_exists($id, $this->_saveItems)){
                                 $this->_saveQty -= $this->_saveItems[$id]["quantity"];
                                 $this->_savePrice -= $this->_saveItems[$id]["price"];
                                 unset($this->_saveItems[$id]);
                                 $this->_save = ["items" => $this->_saveItems, "savePrice" => $this->_savePrice, "saveQty" => $this->_saveQty];
                        } 
                        if($this->_saveQty == 0){
                            $user_id = escape(Session::get(Config::get("session/session_name")));
                            self::delete("cart", array("user_id", "=", $user_id));
                        }          
                    } 
                
                return true;
          }
          return false;
    }

    
    public function return_save($id){
          if($this->return_action($id)){
                $user_id = Session::get(Config::get("session/session_name"));
                $oldSave = self::get("cart", array("user_id", "=", $user_id));
                if($oldSave->count()){
                    $saveUpdate = json_encode($this->_save);
                    $date = date("Y-m-d H:i:s", strtotime("+ 30 days"));
                    $hash = $oldSave->first()["hash"];
                    $oldSave->update("cart", array(
                        "hash" => $hash,
                        "item" => $saveUpdate,
                        "expire_date" => $date
                    ), array("user_id", "=", $user_id)); 
                    Cookie::put(Config::get("remember/cart_hash"), $hash, Config::get("remember/cookie_expire"));
                }
                return true;
            }
        return false;
    }



    public function saveForLaterDelete($id){
         if($id){
             if($this->delete_action($id)){
                $user_id = Session::get(Config::get("session/session_name"));
                $oldSave = self::get("cart", array("user_id", "=", $user_id));
                if($oldSave->count()){
                    $saveUpdate = json_encode($this->_save);
                    $date = date("Y-m-d H:i:s", strtotime("+ 30 days"));
                    $oldSave->update("cart", array(
                        "hash" => "hash",
                        "item" => $saveUpdate,
                        "expire_date" => $date
                    ), array("user_id", "=", $user_id)); 
                }
                return true;
             }
         }
         return false;
    }








    public function cart_qty_increase($id){
        if($this->add_to_cart($id)){
            Session::put("cart", $this->_cart);
            return true;
        }
        return false;
    }




    public function remove_cart($id){
        if($id){
            $products = self::get("products", array("id", "=", $id), array(["quantity", ">=", 0]));
            if($products->count()){
                $product = $products->first();
                $cartProduct = ["quantity" => 0, "price" => $product["price"], "item_id" => $product["id"] ];

                if($this->_items){
                    if(array_key_exists($id, $this->_items)){
                        $cartProduct = $this->_items[$id];
                    }
                }
                $qunatity = 1;
                $this->update_quantity($id, array($qunatity, true));

                $cartProduct["quantity"]--;
                $cartProduct["price"] = $cartProduct["quantity"] * $product["price"];
                $this->_items[$id] = $cartProduct;
                $this->_totalPrice -= $product["price"];
                $this->_totalQty--;

                if($this->_items[$id]["quantity"] <= 0){
                    unset($this->_items[$id]);
                }

                $this->_cart = ["items" => $this->_items, "totalPrice" =>  $this->_totalPrice, "totalQty" => $this->_totalQty];
                return true;
            }
    }
       
        return false;
    }
    
    public function cart_qty_decrease($id){
      if( $this->remove_cart($id)){
             Session::put("cart", $this->_cart);
             if($this->_totalQty == 0){
                 Session::delete("cart");
             }
             return true;
      }
        return false;
    }


  public function auto_cart_delete(){
      if(empty($this->_items) || $this->_totalQty <= 0){
          Session::delete("cart");
          Redirect::to("cart.php");
      }
  }




  public function find_product($id = null, $quantity = null){
    if($id){
            $product = self::get("products", array("id", "=", $id), array(["quantity", ">", 0]));
           if($product->count()){
                $availQty = $product->first()["quantity"] -= $quantity;
               if($availQty >= 0){
                   if($this->add_to_cart($id)){
                        Session::put("cart", $this->_cart);
                        return true;
                   }
               }
           }
    }
    return false;
}


   
    // end;
}