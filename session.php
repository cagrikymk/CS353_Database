<?php
   session_start();
   
   $user_check = $_SESSION['user_name'];
   
    $numOfApps = 0;
   $username = $_SESSION['user_name'];
   $fullname = $_SESSION['name'] . " " . $_SESSION['surname'] ;
   $user_id = $_SESSION['user_id'];
   $usertype = $_SESSION['user_type'];
   
   if(!isset($_SESSION['user_name'])){
      header("location:login.php");
   }
?>
