<?php

  $filePath = explode("/", $_SERVER["REQUEST_URI"]);
  $pageName =  $filePath[count($filePath) - 1];
  $path = ["indexx.php", "profile.php", "product_detail.php"];
  if(in_array($pageName, $path)){ ?>
    <section id="preloader">
        <div class="preloader-dark-skin"></div>
        <div class="preloader main-page-preloader">
            <div class="loader first"></div>
            <div class="loader second"></div>
            <div class="loader third"></div>
        </div>
    </section>
 <?php }


?>







<!--   LIGHT PRELOADER-->
 <!-- <section id="lightPreloader">
    <div class="preloader-dark-skin"></div>
    <div class="light-preloader">
</section>  -->