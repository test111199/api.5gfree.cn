<?php 

// setcookoe('loginStat',1,time()+600);
    if(@$_COOKIE['loginUser'] =='' && @$_COOKIE['loginRole'] < 1){
         header("location:login.html") ;      
    }

    require_once  ("libs/mysql.inc.php");
?>

<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">  
	<title>2DP IoT 管理平台</title>
	<meta name="keywords" content="物联网,IoT,鹏博士,物联网卡" />
	<meta name="description" content="物联网卡管理平台" />
	<meta name="author" content="DrPeng 2DP">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <style type="text/css">
    html, body {
        height: 100%;
    }
    </style>
  </head>
  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a> 
          <a class="brand" href="index.php"><H3>2DP IoT</H3></a>
          <div class="btn-group pull-right">
			<a class="btn" href="my-profile.html"><i class="icon-user"></i> <?php echo @$_COOKIE['loginUser'] ?> </a>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			  <li><a href="my-profile.html">用户资料</a></li>
              <li class="divider"></li>
              <li><a href="doLogout.php">退出</a></li>
            </ul>
          </div>
<!--          
          <div class="nav-collapse">
            <ul class="nav">
			<li><a href="index.php">首页</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-user.html">新建用户</a></li>
					<li class="divider"></li>
					<li><a href="users.html">管理用户</a></li>
				</ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">角色 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-role.html">新建角色</a></li>
					<li class="divider"></li>
					<li><a href="roles.html">管理角色</a></li>
				</ul>
			  </li>
			  <li><a href="stats.html">统计</a></li>
            </ul>
          </div>
-->          
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
<?php  
//    $sqlStr = "SELECT IoT_Menu.menuStr FROM IoT_Menu WHERE menuLevelID IN (SELECT IoT_Role.roleItems from IoT_Role WHERE roleID = @$_COOKIE['loginRole'])";
    $sqlStr = "SELECT IoT_Menu.menuStr FROM IoT_Menu WHERE menuLevelID IN (10,11)";
    $res=mysqli_query($myconn,$sqlStr); 
    $data = mysqli_fetch_array($res);
    print_r($data);
?>
<!--              <li class="nav-header"><i class="icon-wrench"></i> 系统管理</li>
              <li><a href="users.html">用户</a></li>
              <li><a href="roles.html">角色</a></li>
-->
              <li class="nav-header"><i class="icon-signal"></i> 业务管理</li>
              <li class="active"><a href="stats.html">通用</a></li>
              <li><a href="">用户</a></li>
              <li><a href="visitor-stats.html">访问者</a></li>
              <li class="nav-header"><i class="icon-user"></i> 我的账户</li>
              <li><a href="my-profile.html">我的资料</a></li>
			  <li><a href="doLogout.php">退出</a></li> 
            </ul>
          </div>
        </div>
        <div class="span9">
		  <div class="row-fluid">
			<div class="page-header">
				<h1>网站统计 <small></small></h1>
				
			</div>
			<div id="placeholder" style="width:80%;height:300px;"></div>
			<br />
			<div id="visits" style="width:80%;height:300px;"></div>
		  </div>
        </div>
      </div>

      <hr>

      <footer class="well">
        &copy; 2DP IoT 2012 ~ 2108
      </footer>

    </div>

    <script src="js/jquery.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.resize.js"></script>	
	<script src="js/bootstrap.min.js"></script>

    <script>
      function actionFunction (menuAction) {
        document.getElementById("actionFrame").src=menuAction;
      }
    </script>
<!--
	<script>
	$(function () {
		var data = [
		{
			label: 'Page Views',
			data: [[0, 19000], [1, 15500], [2, 11100], [3, 15500]]
		}];
		var dataVisits = [
		{
			label: 'Visits',
			data: [[0, 1980], [1, 1198], [2, 830], [3, 1550]]
		}];
		var options = {
			legend: {
				show: true,
				margin: 10,
				backgroundOpacity: 0.5
			},
			points: {
				show: true,
				radius: 3
			},
			lines: {
				show: true
			},
			grid: {
				borderWidth:1,
				hoverable: true
			},
			xaxis: {
				axisLabel: 'Month',
				ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
				tickDecimals: 0
			},
			yaxis: {
				tickSize:1000,
				tickDecimals: 0
			}
		};
		var optionsVisits = {
			legend: {
				show: true,
				margin: 10,
				backgroundOpacity: 0.5
			},
			bars: {
				show: true,
				barWidth: 0.5,
				align: 'center'
			},
			grid: {
				borderWidth:1,
				hoverable: true
			},
			xaxis: {
				axisLabel: 'Month',
				ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
				tickDecimals: 0
			},
			yaxis: {
				tickSize:1000,
				tickDecimals: 0
			}
		};
		function showTooltip(x, y, contents) {
			$('<div id="tooltip">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5,
				border: '1px solid #D6E9C6',
				padding: '2px',
				'background-color': '#DFF0D8',
				opacity: 0.80
			}).appendTo("body").fadeIn(200);
		}
		var previousPoint = null;
		$("#placeholder, #visits").bind("plothover", function (event, pos, item) {
			if (item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;

					$("#tooltip").remove();
					showTooltip(item.pageX, item.pageY, item.series.label + ": " + item.datapoint[1]);
				}
			}
			else {
				$("#tooltip").remove();
				previousPoint = null;            
			}
		});
		$.plot( $("#placeholder") , data, options );
		$.plot( $("#visits") , dataVisits, optionsVisits );
	});
	</script>
-->	
  </body>
</html>
