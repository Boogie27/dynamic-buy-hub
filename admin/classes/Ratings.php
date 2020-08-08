<?php

class Ratings extends Product{

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


    public function rate(){
        if($this->compute_star()){
            return $this->_rate;
        } 
        return false;
    }


    public function compute_star(){
        if($this->data() && $this->data()->product_id){
            $ratings = json_decode($this->data()->rating, true);
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
            $this->_star = " rate";
        }
        echo '<i class="far fa-star '.$this->_star.'"></i>';
        $this->_start++;
       }
    }


    public function total_count(){
        if($this->data()){
            $ratings = json_decode($this->data()->rating, true);
            return count($ratings);
        }
       return  "0";
    }




    public function rate_count($rate){
        if($rate && $this->data()){
            $ratings = json_decode($this->data()->rating, true);
            if($ratings && in_array($rate, $ratings)){
                $ratings = array_count_values($ratings);
               return $ratings[$rate];
            }
        }
        return "0";
    }


    public function percentage($percent){
       if($ratings = $this->rate_count($percent)){
            $percentage = ( $ratings / $this->_total) * 100;
            return $percentage;
       }
       return "0";
    }


    public static  function user_rate($rate){
        $start = 0;
        if($rate){
            for($x = 0; $x < 5; $x++){
                $star = "";
                if($start < $rate){
                    $star = " rate";
                }
                echo '<i class="far fa-star '.$star.'"></i>';
                $start++; 
            } 
        }
    }




















    

// end;
}

