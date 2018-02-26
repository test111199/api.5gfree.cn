<!DOCTYPE html>
<html>
  <head>
  	<title>2DP IoT USIM service</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Manufactory Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
      function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".scroll").click(function(event){		
          event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
      });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700" rel="stylesheet" type="text/css">
  </head>
  <body>
  	<div class="banner">
		<div class="container">
			<div class="header">
				<div class="banner-left"><!-- <a href="https://www.5gfree.cn/" class="logo"> -->
                    <img src="img/2DP_logo.png" height="30px">  <!--  </a>  -->
                </div>
            </div>
            <div class="banner-info">
                <div class="banner-info-left">
                    <h3>物联网卡原始数据登记</h3>    
                </div>
                
<?PHP
    error_reporting(E_ALL & ~E_NOTICE); 
    
    require_once  ("libs/mysql.inc.php");
    require_once  ("libs/execlFunction.php");
    require_once  ("libs/regUsimFunction.php");

/*    
    $fuctionID = $_POST['sndFuction_ID'];
    $fuctionID = 1;
    $userAccount = '13901161496';
    $simIccid = '89860617040009783269';    
*/
    $userAccount = $_POST['accMobile'];
//  var_dump($_FILES);
//echo "<h3>".$userAccount. "+".$simIccid."</h3>";
//   $simIccid = "143DF290720F";    
    
// echo "功能类型：".$fuctionID."-".$userAccount."-查询ICCID：".$simIccid;
 // res_domy_box_inst 表中，manage_state=1未开通  2开通 sale_status=0 未销售   
//sim_card_inst 表，manage_state 1待开卡 2 已开卡未使用 3 正在使用 4 已销卡
// $return_msg 0/1/2/3/4
    $return_msg = array("ok|0000",
                                    "错误码1-您还不是我们的用户，请联系客服人员！",
                                    "错误码2-您输入的物联网卡ICCID未查询到，请联系客服人员！",
                                    "错误码3-您输入的物联网卡ICCID存在问题，请联系客服人员！",
                                    "JapserData"                                 
                                    );
    
    $strsql = "SELECT userID,userOrgID,userLevel FROM IoT_User  WHERE userAccount = '$userAccount' ";
    list($userStatus,$userID,$userOrgID,$userLevel) = checkUser($strsql);
 
// echo "<h3>得到CheckUser结果 ".$userStatus."+".$userID."+".$userOrgID."+".$userLevel."</h3>";
    
    if($userStatus == '0'){
        echo "<h3>". $return_msg [1]."</h3>";
        mysql_close($myconn);
        exit;
    }

    if (!$_FILES['file']['error']){
		if ($_FILES['file']['type'] == 'application/vnd.ms-excel' or $_FILES['file']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
//        if ($_FILES['file']['size']<200000){
//文件传到文件夹中，可以拼接时间戳，用户名等防止文件名重复
             $file_name = "upload/".$_FILES['file']['name'];
             if (!file_exists($file_name)){
                move_uploaded_file($_FILES['file']['tmp_name'],$file_name);
//    $filename=iconv("UTF-8","",$file_name);
				}
				else{
                $getExeclData = array();
                $getExeclData = importExecl($file_name, 0);
//var_dump($getExeclData[1][1]);
//echo "<br> echo二维数组值：".$getExeclData[1]["A"];
                $dataLenght = count($getExeclData,COUNT_NORMAL);

                for($i = 1;$i < $dataLenght;$i++){
                   
						echo "数组：".$i."-";
                		$returnNum = checkIccidExists($getExeclData,$i);
                		echo "-".$returnNum."<br>\n";
             
                }
                
                 echo "<br> 已经上传过该文件".$file_name."<br>"; 
	            
             }
//            }
//            else{
//                echo "文件过大".$_FILES['file']['size'];
                
//            }
        }
        else{
            echo "文件格式错误!".$_FILES['file']['type'];
            
       }
    }
    else{
        echo"这里是上传文件错误代码：".$_FILES['file']['error'];
    }

/*
    $strsql = "SELECT simStatus FROM IoT_USIM  WHERE simICCID LIKE '$simIccid%' ";
    list($simStatus,$simICCID,$simUserID,$simOrgID) = checkUsim($strsql);
    
    if($simStatus = 0){
        echo $return_msg [2];
        mysql_close($myconn);
        exit;
    }
    
    if($userLevel != 9){
        if($simUserID != $userID && $simOrgID != $userOrgID){
            echo $return_msg [3];
            mysql_close($myconn);
            exit;
        }
        else{
            
        }
    }
    else{
        $fuctionSelect = $fuctionID;  
    }
 
 */   

    mysql_close($myconn);  
    
 
//  var_dump(0);
//exit;
    
 // 查询数据库用户是否存在，如果存在返回userID和userOrgID；
    function checkUser($sqlStr)
    {
        $res=mysql_query($sqlStr); 
        if(mysql_num_rows($res)>0)
        {
            $data = mysql_fetch_array($res);
            $res_userID = $data['userID'];
            $res_userOrgID = $data['userOrgID'];
            $res_userLevel = $data['userLevel'];
            $res_status = 1;
        }else
        {
            $res_status = 0;
        }
//echo "进入用户检验程序，得到结果".$res_status."！";
        return array($res_status,$res_userID,$res_userOrgID,$res_userLevel);
    }

//查询用户输入ICCID在数据库中状态, 并返回ICCID状态和所属用户及组织
    function checkUsim($sqlStr)
    {
        $res=mysql_query($sqlStr); 
        if(mysql_num_rows($res)>0){
            $data = mysql_fetch_array($res);
            $res_simStatus = $data['simStatus'];
            $res_simUserID = $data['simUserID'];
            $res_simOrgID = $data['simOrgID'];
            $res_simICCID = $data['simICCID'];
            $res_status = 1;
        }else{
             $res_status = 0;
        }
        return array($res_status,$res_simICCID,$res_simUserID,$res_simOrgID);
    }
?>

                <div class="banner-info-right">
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="footer-left">
			    <p>Copyright &copy; 2018. 2DP-IoT Project team  All rights reserved.</p>
			</div>
			<div class="footer-right">
			</div>
        </div>
    </div>
  </body>	
</html>    