<?PHP

//    echo "This is a test</br>"; 
    $mysql_server_name="115.32.41.98"; //数据库服务器名称
//    $mysql_port=6033;
    $mysql_username="root"; // 连接数据库用户名
    $mysql_password="2DP2IoT"; // 连接数据库密码
    $mysql_database="2DPIot"; // 数据库的名字
    $PWsalt = "IoT2DP";
    GLOBAL $PWsalt;
    
    // 连接到数据库
    $myconn=mysqli_connect($mysql_server_name, $mysql_username,$mysql_password,$mysql_database);
    if (mysqli_connect_errno($myconn))
    {
        die('Could not connect Database: ' . mysqli_connect_error());
    }
        
?>
