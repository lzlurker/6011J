<?php 

	require_once("../include/dbconn.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "login":
			$account=sqlReplace(trim($_POST['account']));
			$pwd=sqlReplace(trim($_POST['pw']));
			checkData($account,'User name',1);
			checkData($pwd,'password',1);
			$code=sqlReplace(trim($_POST["imgcode"]));//验证码
			if(empty($code)){
				alertInfo('verification code must be filled',"",1);
			}
			if($code!=$_SESSION['imgcode']){
				alertInfo('code incorrect！',"",1);
			}

			$sql="select * from qiyu_shop where shop_account='".$account."'";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$salt=$rows['shop_salt'];
				$pw=md5(md5($pwd).$salt);
				$sqlStr="select * from qiyu_shop where shop_account='".$account."' and shop_password='".$pw."'";
				$rs_r=mysql_query($sqlStr);
				$row=mysql_fetch_assoc($rs_r);
				if ($row){
					setcookie("QIYUSHOP",$rows['shop_account'],time()+60*60*24*7);
					setcookie("QIYUSHOPVERD",md5($pw.$salt),time()+60*60*24*7);
					$_SESSION['qiyu_shopID']=$rows['shop_id'];
					Header("Location: admin.php");
				}else{
					alertInfo("Password wrong","",1);
				}
			}else{
				alertInfo("No such user","",1);
			}
		break;
		
	}
	

	
?>