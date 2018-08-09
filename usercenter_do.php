<?php 
	
	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "delOrder":
			$url=$_SESSION['order_url'];
			$tab=sqlReplace(trim($_GET['tab']));
			$id=sqlReplace(trim($_GET['id']));
			$sql="delete from qiyu_order where order_id=".$id." and order_user=".$QIYU_ID_USER;
			mysql_query($sql);
			alertInfo('successfully deleted',$url,0);
		break;
		case "addaddress":
		//	$url=$_SESSION['order_url'];
			//$tab=sqlReplace(trim($_GET['tab']));
			$name = sqlReplace($_POST['name']);
			
			$phone = sqlReplace($_POST['phone']);
			$address = sqlReplace($_POST['address']);
			checkData($phone,'phone number',1);
			checkData($name,'username',1);
			
			checkData($address,'Address',1);
			$sql="insert into qiyu_useraddr(useraddr_user,useraddr_phone,useraddr_name,useraddr_address,useraddr_type) values (".$QIYU_ID_USER.",'".$phone."','".$name."','".$address."','1')";
			if(mysql_query($sql))
				echo 'Added successfully';
			else 
				echo 'failed';
		break;
		case "deladdress":
	
			$id=sqlReplace(trim($_GET['id']));
			$sql="select * from qiyu_useraddr where useraddr_id=".$id;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$sqlStr="delete from qiyu_useraddr where useraddr_id=".$id;
				mysql_query($sqlStr);
				echo 'successfully deleted';
			}else{
				echo 'Delete failed, no such address';
			}
		break;
		case "setaddress":
			$id=sqlReplace(trim($_GET['id']));
			$sql="select * from qiyu_useraddr where useraddr_id=".$id." and useraddr_user=".$QIYU_ID_USER;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$sqlStr="update qiyu_useraddr set useraddr_type='1' where useraddr_user=".$QIYU_ID_USER." and useraddr_type='0'";
				mysql_query($sqlStr);
				$sqlStr="update qiyu_useraddr set useraddr_type='0' where useraddr_id=".$id." and useraddr_user=".$QIYU_ID_USER;
				mysql_query($sqlStr);
				echo 'Set successfully';
			}else{
				echo 'Setup failed, no such address';
			}
		break;
		case "scoreAdd":
	
			$id=sqlReplace(trim($_GET['id']));
			$total=sqlReplace(trim($_POST['total']));
			$test=sqlReplace(trim($_POST['test']));
			$speed=sqlReplace(trim($_POST['speed']));
			$sql="select shop_id,order_id2 from qiyu_order,qiyu_shop where (shop_id2=order_shop or shop_id=order_shopid) and order_id=".$id;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$sqlStr="insert into qiyu_userscore(userscore_shop,userscore_user,userscore_total,userscore_test,userscore_speed,userscore_order,userscore_addtime) values (".$rows['shop_id'].",".$QIYU_ID_USER.",".$total.",".$test.",".$speed.",'".$rows['order_id2']."',now())";
				if (mysql_query($sqlStr)){
					
					
					Header("Location: userorderscore2.php?id=".$id);
				}else{
					alertInfo('Unexpected error','',1);
				}
			}else{
				alertInfo('illegal','usercenter.php?tab=5',0);
			}
		break;

		case "updateusername"://修改用户姓名
			$user_name=sqlReplace(trim($_POST['user_name']));
			$sql="select * from qiyu_user where user_id=".$QIYU_ID_USER;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$sqlStr="update qiyu_user set user_name='".$user_name."' where user_id=".$QIYU_ID_USER;
				mysql_query($sqlStr);
				echo 'Saved successfully';
			}else{
				echo 'Save failed';
			}
		break;
		
	}
	

	
?>