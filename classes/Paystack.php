<?php


class Paystack extends User{
      
      private $_paid = false,
              $error = false,
              $_session,
              $_fields = array();


    public function __construct(){
        parent::__construct();
        $this->_session = Session::get(Config::get("session/session_name"));
    }

    public function paymentCheck($name, $email, $address_one, $address_two, $phone, $amount){
       
        if(empty($name) || empty($email) ||empty($address_one) || empty($address_two) ||empty($phone) || empty($amount)) {
            $this->getError("All fields must be filled!");
        }else if(strlen($name) < 2){
            $this->getError("Name must be minimum of two characters long.");
        }else if(strlen($name) > 50){
            $this->getError("Name must be maximum of 50 characters long.");
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->getError("Enter a valid email");
        }else{
                 $this->_fields  = array($name, $email, $address_one, $address_two, $phone, $amount);
                 return true;
        } 
        return false;
    }


    public function payNow($name, $email, $address_one, $address_two, $phone, $amount){
        $this->_paid = false;
        if(!$this->_paid){
            $items = json_encode(Session::get("cart"));
            $date = date("Y-m-d H:i:s", strtotime("+30 days"));
            self::insert("paid_order", array(
                    "items" => $items,
                    "user_id" => $this->_session,
                    "address" => $address_one,
                    "shipping_address" => $address_two,
                    "phone" => $phone,
                    "date" => $date
            ));
            
            $cart = new Cart();
            $caritems = Session::get("cart")["items"];
            foreach($caritems as $values){
                $itemID = $values["item_id"];
                $quantity = $values["quantity"];
                $cart->update_quantity($itemID, array($quantity, false)); 
            }
            
            $this->_paid = true;
        }

        if($this->_paid){
            return $this;
        }
        return false;
    }


    public function paid(){
        return $this->_paid;
    }


    


    // end;
}