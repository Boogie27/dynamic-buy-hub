<?php

class Ratings extends Category{

    private $_error = false,
            $_passed = false,
            $_data = null,
            $_rate = 0,
            $_start = 0,
            $_star,
            $_total = 10;
    

    public function __construct($id){
        Parent::__construct();
        if($id){
            $check = self::get("ratings", array("product_id", "=", $id));
            if($check->count()){
                $this->_data = $check->first();
            }
        }
    }


    public function data(){
        return $this->_data;
    }



    public function compute_star(){
        if($this->data() && $this->data()["product_id"]){
            $ratings = json_decode($this->data()["rating"], true);
            $count = count($ratings);
            $totalRate = 0;
            foreach($ratings as $values){
                $totalRate += $values;
            }
           $this->_rate = round($totalRate / $count);
        }
      return $this;
    }



    public function star_ratings(){
        $this->compute_star();
        for($x = 0; $x < 5; $x++){
        $this->_star = "";
        if($this->_start < $this->_rate){
            $this->_star = " text-warning";
        }
        echo '<i class="far fa-star '.$this->_star.'" style="color: #ccc;"></i>';
        $this->_start++;
       }
    }
  


    public static  function user_rate($rate){
        $start = 0;
        if($rate){
            for($x = 0; $x < 5; $x++){
                $star = "";
                if($start < $rate){
                    $star = " text-warning";
                }
                echo '<i class="far fa-star '.$star.'" style="color: #ccc;"></i>';
                $start++; 
            } 
        }
    }




















    

// end;
}

