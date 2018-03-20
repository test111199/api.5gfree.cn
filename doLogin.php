<?php 
    error_reporting(E_ALL & ~E_NOTICE); 
    
    require_once  ("libs/mysql.inc.php");
    
    $userAccount = $_POST['userAccount'];
    $userPassword = $_POST['password'];
    
    
    $savePassword = base64_encode($PWSalt.$userPassword);
    $sqlStr = "SELECT * FROM IoT_User WHERE userAccount = '$userAccount' AND userPassword = '$savePassword' ";
    $res=mysqli_query($myconn,$sqlStr); 
 echo   $sqlStr; 
 var_dump($res);
    if($data = mysqli_fetch_array($res)){
//        $data = mysqli_fetch_array($res);
        $userName = $data['userName'];
        $userRole = $data['userRole'];
        setcookie('loginUser',$userName,time()+600);
        setcookie('loginRole',$userRole,time()+600);
        header("Location:index.php");
    }
    else{
        echo"<script>alert('输入用户名密码错误！')</script>";
        sleep(1);
        header("Location:login.html");
    }
?>