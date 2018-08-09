<?php 
	require_once("usercheck.php");
?>
<script src="js/jquery-1.3.1.js" type="text/javascript"></script>
<?php
	
	$phone = sqlReplace($_POST['phone']);
	$pw = sqlReplace($_POST['pw']);
	$repw = sqlReplace($_POST['repw']);
	$vCode = sqlReplace($_POST['vcode']);
	//$code = sqlReplace($_POST['a']);
	$agree=sqlReplace($_POST['agree']);
	$p=empty($_GET['p'])?'':sqlReplace(trim($_GET['p'])); //从订单页来的标示
	$shopID=empty($_GET['shopID'])?'0':sqlReplace(trim($_GET['shopID']));
	$shopSpot=empty($_GET['shopSpot'])?'0':sqlReplace(trim($_GET['shopSpot']));
	$shopCircle=empty($_GET['shopCircle'])?'0':sqlReplace(trim($_GET['shopCircle']));
	$savesession=$phone.','.$agree;//存session
	$_SESSION['reginfo1']=$savesession;
	checkData($phone,'User name',1);
	checkData($pw,'Password',1);
	checkData($repw,'Confirm Password',1);
	if ($pw!=$repw){
		alertInfo("Password entered two times is not same","userreg.php",0);
	}
	/*
	if ($vCode!=$code){
		alertInfo("验证码错误","",1);
	} */

	if ($vCode!=$_SESSION["imgcode"]){
		alertInfo("Verification code wrong","",1);
	}
	if (empty($agree) && $site_isshowprotocol=='1') alertInfo("Please accept the agreement","",1);
	//检查手机的存在
	$sqlStr="select user_id from qiyu_user where user_phone='".$phone."'";
	$rs=mysql_query($sqlStr);
	$row=mysql_fetch_assoc($rs);
	if ($row){
		alertInfo("This phone number is already registered","",1);
	}
	$_SESSION['phone']=$phone;
	$_SESSION['pw']=$pw;
	Header("Location: userregnew2.php?p=".$p."&shopID=".$shopID."&shopSpot=".$shopSpot."&shopCircle=".$shopCircle);
?>