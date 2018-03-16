<?php 
    error_reporting(E_ALL & ~E_NOTICE); 
    
    require_once  ("libs/mysql.inc.php");
    
    $userAccount = $_POST['userAccount'];
    $userPassword = $_POST['password'];

    setcookie('loginStat',1,time()+600);
    setcookie('loginUser','Test',time()+600);

    header("Location:index.php");;

?>