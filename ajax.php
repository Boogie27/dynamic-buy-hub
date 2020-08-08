<?php
include "core/init.php";

if(Input::get("action")){
    $brand = escape(Input::get("action"));
    $object = new Category();
    if(preg_match("/[a-z]/", $brand)){
        $brandItem = array("brand", "RLIKE", "^[{$brand}].*$");
        $object->limit("products", $brandItem, 15);
        $echo = null;
    
        $echo .= '<ul>';
         if($object->count() > 0){
            foreach($object->result() as $values){
                $echo .= ' <li>'.$values["brand"].'</li>';
            }
         }else{
            $echo .= "<li>no brands available</li>";
         }
         $echo .= '</ul>';
         echo $echo;
    }
    $items = $object->count_duplicate("products", "brand")->result();
    foreach($items as $values){
         foreach($values as $keys){
              echo $keys;
         }
    }
   
}


// ======================================================================
//FUNCTION THAT ADDS ITEMS TO CART 
// this is a json call
//========================================================================

if(Input::get("itemID")){
    $id = escape(Input::get("itemID"));

    $qty = escape(Input::get("qty")) ?  escape(Input::get("qty")) : null;
        
    $oldCart = Session::exists("cart")? Session::get("cart") : null;
    $cart = new Cart($oldCart);
    $cart->get("products", array("id", "=", $id), array(["quantity", ">", 0]));
    if($cart->count()){
        
        if(($cart->first()["quantity"] -= $qty) >= 0){
            if($items = $cart->add_to_cart($id, $qty)->get_cart()){
                if(Session::put("cart", $items)){
                    echo "success";
                }  
            }
        }
    }else{
        echo "outOfStock";
    }
}


// ======================================================================
// function that retrieves the cart quantity;
// ======================================================================
if(Input::get("cartQty")){
    $cart = Session::get("cart");
   if($cart["totalQty"] > 0){
        echo $cart["totalQty"];
   }else{
       echo "0";
   }
}







// ======================================================================
// function that retrieves the cart items
// ======================================================================
if(Input::get("cartItem")){
     if(Session::exists("cart")){
          $cartItems = Session::get("cart")["items"];
          foreach($cartItems as $values){
                  $itemID = $values["item_id"];
                  $product = new Cart();
                  if($product->get("products", array("id", "=", $itemID))->count()){
                        $productItem = $product->first();
                        $image = explode(",", $productItem["image"]);
                        echo ' <li><a href="detail.php?product='.$productItem['id'].'&slug='.$productItem['slug'].'"><img src="admin/images/'.$image[0].'" alt="'.$productItem["name"].'">'.$productItem['name'].' ( '.$values['quantity'].' )</a></li>';
                  }
          }
     }else{
         echo '<span style="padding-left: 20px;">Cart Is Empty</span>';
     }
}





// ======================================================================
// function that signup a user
// ======================================================================
if(Input::get("signupButton")){
    $signup = new User();
    $name = escape(Input::get("name"));
    $email = escape(Input::get("email"));
    $password= escape(Input::get("password"));
    $confirmPassword = escape(Input::get("confimPassword"));


    if(!$signup->signup($name, $email, $password, $confirmPassword)){
        echo $signup->alertError();  
    }else{
        echo "passed";
    }
   

}






// ======================================================================
// function that logs a user in
// ======================================================================
if(Input::get("loginButton")){
    $email = escape(Input::get("email"));
    $password = escape(Input::get("password"));
    $login = new User();
    if(!$login->login($email, $password)){
        echo $login->alertError();  
    }else{
        echo "loggedIn";
    }
}





// ======================================================================
// function that logs a user out
// ======================================================================
if(Input::get("logUserOut")){
    if(Session::exists(Config::get("session/session_name"))){
       
        $logout = new User();
        if(!$logout->logout()){
           echo "something went wrong!";
        }else{
            Session::delete(Config::get("session/session_name"));
            echo "loggedOut";
        }
    }
}




if(Input::get("changePasswordForm")){
    if(Session::exists(Config::get("session/session_name"))){
             $user_id = Session::get(Config::get("session/session_name"));
             $oldPassword = escape(Input::get("oldPassword"));
             $newPassword = escape(Input::get("newPassword"));
             $confirmPassword = escape(Input::get("confirmPassword"));

             $user = new User($user_id);
            if(!$user->changePassword($oldPassword, $newPassword, $confirmPassword)){
                echo $user->alertError();
            }else{
                Session::flash("success", "Password changed successfully!");
                echo "passwordChanged";
            }

    }else{
        echo '<div class="error">Login or Signup to change Password!</div>';
    }
}






// ======================================================================
// function to be executed after paystack payment was successfull;
// ======================================================================
if(Input::get("paystack")){
    $name = escape(Input::get("name"));
    $email = escape(Input::get("email"));
    $address_one = escape(Input::get("address_one"));
    $address_two = escape(Input::get("address_two"));
    $phone = escape(Input::get("phone"));
    $amount = escape(Input::get("amount"));

    $pay = new Paystack();
    $itemID = Session::get("cart")["items"][1]["item_id"];
    $quantity = Session::get("cart")["items"][1]["quantity"];
    if(!$pay->paymentCheck($name, $email, $address_one, $address_two, $phone, $amount)){
        echo $pay->alertError();
    }else{
        echo "correct";
    }
}


if(Input::get("paystackPayment")){
    $name = escape(Input::get("name"));
    $email = escape(Input::get("email"));
    $address_one = escape(Input::get("address_one"));
    $address_two = escape(Input::get("address_two"));
    $phone = escape(Input::get("phone"));
    $amount = escape(Input::get("amount"));

    $payment = new Paystack();
    if($payment->payNow($name, $email, $address_one, $address_two, $phone, $amount)->paid()){
        Session::delete("cart");
        echo "paymentCompleted";
    }else{
        echo "not completed";
    }
}




                
// ============================================================================
//      FUNCTION THAT EDIT USER PROFILE                          
// ============================================================================
if(Input::get("editName")){
     if(Session::exists(Config::get("session/session_name"))){
        $name = Input::get("editName");
        $email = Input::get("editEmail");
        $image = $_FILES["editImage"];
    
        $user = new User();
        if(!$user->editProfile($name, $email, $image)){
            echo $user->alertError();
        }else{
            echo "uploaded";
        }
    
     }

}


         
// ============================================================================
//      FUNCTION THAT DELETES ACCOUNT                         
// ============================================================================
if(Input::get("deleteAccount")){
    if(Session::exists(Config::get("session/session_name"))){
       $password = escape(Input::get("deletePassword"));
       $id = Session::get(Config::get("session/session_name"));
       $user = new User();
       if(!$user->delete_user_account($password, $id)){
        echo $user->alertError();
       }else{
           echo "accountDeleted";
       }
    }else{
        echo '<div class="error">Login or Signup to delete account!</div>';
    }
}















?>
