<?php

	require_once("usercheck.php");
	$phone= sqlReplace($_POST['phone']);
	
	
	if($phone=='')
		alertInfo("Illegal operation","",1);
	if ($site_sms=='1'){
		$code= sqlReplace($_POST['code']);
		$s_code=$_SESSION['sms_code'];
		if($code=='') alertInfo("Illegal operation","",1);
	
		if ($s_code!=$code){
			
			alertInfo("Verification code does not match","userpw.php",0);
		}
		$_SESSION['sms_code']='';
		$_SESSION['sms_sendTime']='';
	}
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<script src="js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="js/userpw.js" type="text/javascript"></script>
<script src="js/tab.js" type="text/javascript"></script>
<title> Retrieve password - <?php echo $SHOP_NAME?> - <?php echo $powered?> </title>
</head>
 <body> 
 <div id="container">
	<?php
		require_once('header_index.php');
	?>
	<div id="main">
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center">
				<div id="orderBox" class="loginBox">
					<div class="order_title login_title">Retrieve password</div>
					<form method="post" action="userpw_do.php?act=update">
					
				
					<div style="padding-top:30px;padding-bottom:50px;">
						<div class="addList" >
							<div class="tip tip_r">
								<span>Set a new login password</span>
								<p>You have applied for a password change. To protect your account, please change it to your new password.</p>
							</div>
						</div><input type="hidden" name="phone" value="<?php echo $phone?>"/>
						<div class="addList addList_r forget"><label>New password：</label><input type="password" id="pw" class="input" name="pw" /> 
						<span class="errormt"></span> 
						</div>
						<div class="addList addList_r forget"><label>Confirm new password：</label><input type="password" id="repw" class="input" name="repw" /> 
						<span class="errormt"></span> 
						</div>
						<div class="addList">
							<label>&nbsp;</label> <input type="image" src="images/button/submit5.gif" id="send" onClick="return checkPWD();"/>
						</div>
						
						<div class="clear"></div>
					</div><!--tab1-->
					</form>
				</div>
			</div>
			<div class="main_bottom"></div>
		</div><!--main_content完-->
		
	
	</div>
	
	<?php
		include("footer.php");
	?>
 </div>
 </body>
</html>
