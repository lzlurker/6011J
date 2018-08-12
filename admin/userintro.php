<?php

	require_once("usercheck2.php");
	$id=sqlReplace(trim($_GET['id']));
	$tel=empty($_GET['tel'])?'':sqlReplace(trim($_GET['tel']));
	$page=empty($_GET['page'])?'':sqlReplace(trim($_GET['page']));
	$id=checkData($id,"ID",0);
	$sql="select * from ".WIIDBPRE."_user where user_id=".$id;
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	if(!$row){		
		alertInfo('No user','',1);
	}else{
		$account=$row['user_account'];
		$name=$row['user_name'];
		$mail=$row['user_mail'];
		$type=$row['user_type'];
		$logintime=$row['user_logintime'];
		$loginip=$row['user_loginip'];
		$logincount=$row['user_logincount'];
		$phone=$row['user_phone'];
		$time=$row['user_time'];
		$score=$row['user_score'];
		$experience=$row['user_experience'];
	}
	//原版
	//$url="&start=".$start."&end=".$end."&name=".$name."&phone=".$phone."&order=".$order."&uid=".$id;
	$url="&name=".$name."&phone=".$phone."&uid=".$id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript" src="js/shopadd.js"></script>
  <title> User details </title>
 </head>
 <body>
 <div id="container">
	<?php
		require_once('header.php');
	?>
	<div id="main">
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center main_center_r">
				<div id="shopLeft">
					<?php
						require_once('left.inc.php');
					?>
				</div>
				<div id="shopRight">

					<h1><a href="userlist.php?tel=<?php echo $tel?>&page=<?php echo $page?>">User list</a> &gt;&gt; User details</h1>

					<div id="introAdd">
						<p>Account：<?php echo $account?></p>
						<p>User name：<?php echo $name?></p>
						<p>User email：<?php echo $mail?></p>
						<p>User points：<?php echo $score?> </p>
						<p>User loyalty：<?php echo $experience?> </p>
						<p>Register time：<?php echo $time?></p>
						<p>Last login IP：<?php echo $loginip?> </p>
						<p>Last login time：<?php echo $logintime?> </p>
						<p>Login times：<?php echo $logincount?> </p>
						<p>Total order：</p>
						<p><a href="userorder.php?uid=<?php echo $id?>&key=all"><img src="../images/button/look_order.jpg"  alt="" /></a> <img src="../images/button/return.jpg" alt="Return" style='cursor:pointer' onClick="javascript:history.back();"/></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="main_bottom"></div>
		</div><!--main_content-->
		
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
 </div>
 </body>
</html>
