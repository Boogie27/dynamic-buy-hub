<?php

// ===================================================================================
// Function that operates the product sort items form and navigation search field 
// ===================================================================================

$productOBJ = new Category();
if(Input::exists("POST")){
   
    $search = escape(Input::get("search"));
    $from = escape(Input::get("from"));
    $to = escape(Input::get("to"));
    $byName = escape(Input::get("sortName"));
    $slug = escape(Input::get("slug"));
    $categoryId = escape(Input::get("category"));
    $rangeFrom = null;  $rangeTo = null; $rangeByName = null; $category = null; $slugCategory = null; $searchItems = null;

    if(!empty($categoryId)){
        $category = array("categories", "=", $categoryId);
    }
    if(!empty($slug)){
        $slugCategory = array("slug", "=", $slug);
    }
    if(!empty($search)){
        $searchItems = array("brand", "=", $search);
    }
    if(!empty($from)){
        $rangeFrom = array("price", ">=", $from);
    }
    if(!empty($to)){
        $rangeTo = array("price", "<=", $to);
    }
    if(!empty($byName)){
        $rangeByName = array("name", "RLIKE", "^[{$byName}].*$"); 
    }
    
        $products = $productOBJ->get("products", array("featured", "=", 1), [$searchItems, $slugCategory, $category, $rangeByName, $rangeFrom, $rangeTo]);
        $featured = "Shop Hub's products";
}









// ========================================================================
// FUNCTION THAT ADDS ITEMS TO CART 
// ========================================================================
if( Input::exists("post") && Input::onclick("addToCart")){
    $itemID = escape(Input::get("itemID"));
    $qty = escape(Input::get("itemQuantity"));
        
    $oldCart = Session::exists("cart")? Session::get("cart") : null;
    $cart = new Cart($oldCart);
    $cart->get("products", array("id", "=", $itemID), array(["quantity", ">", 0]));
    if($cart->count()){
          $itemProduct = $cart->first();
        if(($itemProduct["quantity"] -= $qty) >= 0){
            
            if($items = $cart->add_to_cart($itemID, $qty)->get_cart()){
                if(Session::put("cart", $items)){
                  $slug = $itemProduct["slug"];
                    $alert = '<section class="error-alert">
                                <div class="cartAlert">
                                    <span class="alert-logo"><i class="fas fa-check"></i></span>
                                    <span class="error-alertContent">Item has been added to Cart!</span>
                                </div>
                            </section>';
                            Redirect::to("detail.php?product={$itemID}&slug={$slug}", ["success", $alert]);
                }
               
            }
        }
    }
}



// ========================================================================
// FUNCTION THAT SAVES ITEM FOR LATER 
// ========================================================================

if( Input::exists("post") && Input::onclick("save-for-later")){
    if(Session::exists("cart") && Session::exists(Config::get("session/session_name"))){
         $itemID = Input::get("cart_id");
         $user_id = Session::get(Config::get("session/session_name"));
         $oldCart = Session::get("cart");
         $Save = new Cart();
         $oldSaveItem = $Save->get("cart", array("user_id", "=", $user_id));
         if($oldSaveItem->count()){
            $oldSave  = Input::json_decode($oldSaveItem->first()["item"]);
         }else{
            $oldSave = null;
         }
         $cart = new Cart($oldCart, $oldSave);
         if(!$cart->save_for_later($itemID)){ 
               $alert = '<section class="error-alert">
                            <div class="cartAlert">
                                <span class="alert-logo"><i class="fas fa-times"></i></span>
                                <span class="error-alertContent">Item already exists!</span>
                            </div>
                        </section>';
            Redirect::to("cart.php", ["error", $alert]);
        
         }else{
            $alert = '<section class="error-alert">
                        <div class="cartAlert">
                            <span class="alert-logo"><i class="fas fa-check"></i></span>
                            <span class="error-alertContent">Item has been saved for later!</span>
                        </div>
                    </section>';
            Redirect::to("cart.php", ["success", $alert]);
         }
    }else{
        $alert = '<section class="error-alert">
                        <div class="cartAlert">
                            <span class="alert-logo"><i class="fas fa-check"></i></span>
                            <span class="error-alertContent">login or signup to save cart items!</span>
                        </div>
                    </section>';
            Redirect::to("cart.php", ["success", $alert]);
    }
}




// ========================================================================
// FUNCTION THAT DELETES ITEM FROM CART
// ========================================================================

if(Input::exists("post") && Input::onclick("delete-cart")){
     $itemID = Input::get("cart_id");
    if(Session::exists("cart")){
        $oldCart = Session::exists("cart")? Session::get("cart") : null;
        $cartDelete = new Cart($oldCart);
        if($cartDelete->deleteCart($itemID)){
            $alert = '<section class="error-alert">
                        <div class="cartAlert">
                            <span class="alert-logo"><i class="fas fa-times"></i></span>
                            <span class="error-alertContent">Item has been deleted!</span>
                        </div>
                    </section>';
            Redirect::to("cart.php", ["success", $alert]);
        }
    }
}




// ========================================================================
// FUNCTION THAT ADDS SAVE FOR LATER ITEMS BACK TO CART
// ========================================================================
if(Input::exists("post") && Input::onclick("save-return")){
      $itemID = escape(Input::get("saveID"));
      $user_id = Session::get(Config::get("session/session_name"));
      $saved = new Cart();
      if($saved->get("cart", array("user_id", "=", $user_id))->count()){     
            $oldSaved = Input::json_decode($saved->first()["item"]);
            $oldCart = Session::exists("cart")? Session::get("cart") : null;
            $saveReturn = new Cart($oldCart, $oldSaved);
            if( $saveReturn->return_save($itemID)){
                $alert = '<section class="error-alert">
                            <div class="cartAlert">
                                <span class="alert-logo"><i class="fas fa-check"></i></span>
                                <span class="error-alertContent">Item has been added back to cart!</span>
                            </div>
                        </section>';
                Redirect::to("cart.php", ["success", $alert]);
            }
      }
}




// ========================================================================
// FUNCTION THAT DELETES ITEM FROM SAVE FOR LATER
// ========================================================================
if(Input::exists("post") && Input::onclick("delete-save")){
    if(Session::exists(Config::get("session/session_name"))){
        $itemID = escape(Input::get("saveID"));
        $user_id = Session::get(Config::get("session/session_name"));
        $saved = new Cart();
        if($saved->get("cart", array("user_id", "=", $user_id))->count()){     
              $oldSaved = Input::json_decode($saved->first()["item"]);
              $oldCart = Session::exists("cart")? Session::get("cart") : null;
              $saveReturn = new Cart($oldCart, $oldSaved);
              if($saveReturn->saveForLaterDelete($itemID)){
                  Redirect::to("cart.php");
              }
        }
    }
}




// ========================================================================
// FUNCTION THAT INCREASE OR DECREASE ITEM QUANTITY IN CART
// ========================================================================
 if(Input::exists("post") && (Input::onclick("increaseQty") || Input::onclick("decreaseQty"))){
       if(Session::exists("cart")){
        $itemID = escape(Input::get("itemID"));
        $oldCart = Session::get("cart");

            $cartQty = new Cart($oldCart);
                if(Input::onclick("increaseQty")){
                    if($cartQty->cart_qty_increase($itemID)){
                       Redirect::to("cart.php");
                    }
                }
                if(Input::onclick("decreaseQty")){
                    if($cartQty->cart_qty_decrease($itemID)){
                        Redirect::to("cart.php");
                    }
                }
       }
 }







// ========================================================================
// FUNCTION THAT CLEARS ALL ITEMS IN CART
// ========================================================================
if(Input::exists("post") && Input::onclick("clearCart")){
        if(Session::exists("cart")){
            $cart = Session::get("cart");
            foreach($cart["items"] as $values){
                $oldCart = new Cart();
                 $oldCart->update_quantity($values["item_id"], array($values["quantity"], true));   
            }
            Session::delete("cart");
            Redirect::to("cart.php");
        }
}




// ========================================================================
// BUY NOW FUNTION IN THE DETAIL PAGE
// ========================================================================
if(Input::exists("post") && Input::onclick("buyNow")){
     $quantity = escape(Input::get("itemQuantity"));
     $itemID =  escape(Input::get("itemID"));
     if(Session::exists(Config::get("session/session_name"))){
        $olCart = Session::exists("cart")? Session::get("cart") : null;
         $product = new Cart($olCart);
         $slug = $product->get("products", array("id", "=", $itemID))->first()["slug"];
         if($product->find_product($itemID, $quantity)){
             Redirect::to("checkout.php");
         }else{
            $alert = '<section class="error-alert">
                        <div class="cartAlert">
                            <span class="alert-logo"><i class="fas fa-times"></i></span>
                            <span class="error-alertContent">Item is out of stock!</span>
                        </div>
                    </section>';
                Redirect::to("detail.php?product={$itemID}&slug={$slug}", ["success", $alert]);
         }


       
      

     }else{
        $alert = '<section class="error-alert">
                    <div class="cartAlert">
                        <span class="alert-logo"><i class="fas fa-times"></i></span>
                        <span class="error-alertContent">login or signup to purchase this item!</span>
                    </div>
                </section>';
                Redirect::to("detail.php?product={$itemID}&slug={$slug}", ["success", $alert]);
     }
     

}




// ========================================================================
//  FUNCTION THAT DELETES ITEM FROM CHECKOUT 
// ========================================================================
if(Input::exists("post") && Input::onclick("deleteCheckoutItem")){
    $itemID = escape(Input::get("itemId"));
    if(Session::exists("cart")){
        $oldCart = Session::get("cart");
        $cart = new Cart($oldCart);
        if($cart->deleteCart($itemID)){
           Redirect::to("checkout.php");
        }
    }
}


























//  end;
?>