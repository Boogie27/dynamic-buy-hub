<?php
 require_once "core/init.php";
 require_once "includes/helper.php";
 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>home page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="css/queries.css">
        <link rel="stylesheet" href="font-awesome/all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
    </head>
<body>



<!-- DARK SKIN -->
<section>
    <div class="dark-skin"></div>
    <div class="light-preloader"></div>
</section>




 <!-- PRELOADER -->
<?php


require_once "includes/preloader.php";

    // $alertMessage = '<div class="alert text-center alert-success text-success" style="margin-top: 10px;" id="alertMessage">Brand added Successfuly!</div>';
    // Session::flash("success", $alertMessage);
?>
    



  
   <!-- NAVIGATION -->
<?php require_once "includes/navigation.php"; ?>