<?php 
    error_reporting(E_ALL & ~E_NOTICE); 
      
    if($_COOKIE['loginRole'] >0){
        setcookie('loginRole','');
        setcookie('loginUser','');
        header("Location:login.html");
        mysqli_close($myconn);  
    }
    else{
        echo"<script>alert('已经登出！')</script>";
    }
?>