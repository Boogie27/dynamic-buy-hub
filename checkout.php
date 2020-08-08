<?php     require_once "core/init.php";
          require_once "includes/script.php";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>checkout</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="css/queries.css">
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
    </head>
    <body class="checkoutBody">

<?php
if(Session::exists(Config::get("session/session_name"))){
    if(Session::exists("cart")){
        $user_id = Session::get(Config::get("session/session_name")); 
        $tax = Config::get("money/tax") * Session::get("cart")["totalPrice"];
        $totalPrice = $tax + Session::get("cart")["totalPrice"];
        $user = new User();
        $user = $user->get("users", array("id", "=", $user_id))->first();

        ?>

     <section class="checkoutContainer">
     <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="checkOutPayment">
                        <div class="text-right"><span class="text-success" style="font-weight: 500;"><?= $user["email"]; ?></span></div>
                        <div class="payheader">
                            <h3>checkout form</h3>
                            <div class="signupFormError"></div>
                        </div>
                        <form action="checkout.php" method="post" id="checkoutForm">
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <div class="form-group">
                                <label for="name">Name: <b class="text-danger">*</b></label>
                                <input type="text"  id="name" class="form-control" value="<?= $user["name"]; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-8">
                                        <div class="form-group">
                                            <label for="name">Email: <b class="text-danger">*</b></label>
                                            <input type="text" id="email" class="form-control" value="<?= $user["email"]; ?>" required>
                                        </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4">
                                        <div class="form-group">
                                            <label for="name">Phone: <b class="text-danger">*</b></label>
                                            <input type="text" id="phone" class="form-control" value="" required>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Billing Address: <b class="text-danger">*</b></label>
                                <input type="text" id="address_one" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Shipping Address: <b class="text-danger">*</b></label>
                                <input type="text" id="address_two" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <button id="amount" class="form-control amount" value="<?= round($totalPrice); ?>" disabled><?= Input::money(round($totalPrice));?></button>
                            </div>
                            <button type="button" class="form-control" onclick="payNow()">Pay Now</button>
                            <a href="index.php" class="checkAnchorButton">Cancle</a>
                            <a href="cart.php" class="checkAnchorButton">View Cart</a>
                        </form>
                    </div>
                </div>  <!-- end of checkout form-->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="checkout_items_container">
                    <div style="margin-bottom: 15px;" class="text-right"><span class="text-success" style="font-weight: 500; padding-right: 15px; font-size: 80%;">Total: <?= Input::money($totalPrice); ?></span></div>
                     <div class="checkout_items_header">
                         <h3>Checkout Items</h3>
                     </div>
                     <div class="checkoutItems">
                            <?php
                                $cartItems = Session::get("cart")["items"];
                               
                                foreach($cartItems as $values){
                                    $cart = new Cart();
                                    $id = $values["item_id"];
                                   if($cart->get("products", array("id", "=", $id))->count()){
                                        $item = $cart->first();
                                        $image = explode(",", $item["image"]);
                                       ?>
                                        <ul class="itemsCont">
                                            <div class="row">
                                                <li><a href="detail.php?product=<?= $item["id"];?>&slug=<?= $item["slug"];?>"><img src="admin/images/<?= $image[0]; ?>" alt="<?= $item["name"]; ?>"></a></li>
                                                <li class="checkoutItemInfo">
                                                    <ul>
                                                        <li><?= $item["name"]; ?></li>
                                                        <li>Quyantity: <b class="badge bg-warning"><?= $values["quantity"]; ?></b></li>
                                                        <li >price: <i class="text-danger"><?= Input::money($values["price"]); ?></i></li>
                                                    </ul>
                                                </li>
                                            </div>
                                            <li class="deleteButton">
                                                <form action="checkout.php" method="post" class="checkoutDelete">
                                                    <input type="hidden" name="itemId" value="<?= $item["id"]; ?>">
                                                    <button type="submit" name="deleteCheckoutItem" class=""><i class="fas fa-trash"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                <?php   }

                                }
                            ?>
                     </div>
                    </div>
                </div> <!-- end of checkout items-->
         </div>
     </div>
     </section>



    <?php  }else{
         $errorAlert = '<section class="error-alert">
                            <div class="cartAlert">
                                <span class="alert-logo"><i class="fas fa-times"></i></span>
                                <span class="error-alertContent">There are no items in cart!</span>
                            </div>
                        </section>';
                    Redirect::to("index.php", ["error", $errorAlert]);
    }

}else{
    $errorAlert = '<section class="error-alert">
                <div class="cartAlert">
                    <span class="alert-logo"><i class="fas fa-times"></i></span>
                    <span class="error-alertContent">login or register to access that page!</span>
                </div>
            </section>';
    Redirect::to("cart.php", ["error", $errorAlert]);
} ?>














     <script>
      
           //  PAYMENT FORM CHECK
            function payNow(){
                var signupFormError = $(".signupFormError");
                var name, email, address_one, address_two, phone, amount, fields;
                 name = $("#name").val();
                 email = $("#email").val();
                 address_one = $("#address_one").val();
                 address_two = $("#address_two").val();
                 phone = $("#phone").val();
                 amount = $("#amount").val();

                $.ajax({
                       url:"ajax.php",
                       method: "post",
                       data: {
                            paystack: "paystack",
                            name : name,
                            email : email,
                            address_one : address_one,
                            address_two : address_two,
                            phone : phone,
                            amount : amount
                       },
                       success: function(response){
                          if(response == "correct"){
                               payWithPaystack(name, email, address_one, address_two, amount, phone);
                          }else{
                            $(signupFormError).html(response);
                          }
                       }
                });
            }




           //  PAY STACK PAYMENT INTEGRATION 
            function payWithPaystack(name, email, address_one, address_two, amount, phone){
                $(".signupFormError").html("");
    
                var handler = PaystackPop.setup({
                key: 'pk_test_42550ade26808bb2d47dde8ab5f2f897fce81eea',
                email: email,
                amount: amount * 100,
                currency: "NGN",
               ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                metadata: {
                    custom_fields: [
                        {
                            display_name: "Mobile Number",
                            variable_name: "mobile_number",
                            value: phone
                        }
                    ]
                },
                callback: function(response){
                    // alert('success. transaction ref is ' + response.reference);
                    $.ajax({
                       url:"ajax.php",
                       method: "post",
                       data: {
                            paystackPayment: "paystackPayment",
                            name : name,
                            email : email,
                            address_one : address_one,
                            address_two : address_two,
                            phone : phone,
                            amount : amount
                       },
                       success: function(response){
                          location.reload();
                       }
                });
                },
                onClose: function(){
                    alert('window closed');
                }
                });
                handler.openIframe();
            }
    </script>
    </body>
</html>