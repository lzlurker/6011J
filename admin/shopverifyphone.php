<?php

	require_once("usercheck2.php");
	$phone=sqlReplace(trim($_POST['phone']));
	checkData($phone,'Phone number',1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <title> Verify phone number </title>
 </head>
 <body>
 <script type="text/javascript">
 <!--
	function sendCode(){
		var phone=$('#phone').val();
		$.post("shop.ajax.php", { 
			'phone'      :  phone,
			'act'     : 'sendcode'
			}, function (data, textStatus){
				if (data=="S"){
					alert('验证码已发送到手机，请注意查收');
				}else
					alert('发送失败');
						
		});
	 }

 //-->
 </script>
 <div id="container">
	<?php
		require_once('header.php');
	?>
	<div id="main">
		<div class="main_content main_content_r">
			<div class="main_top"></div>
			<div class="main_center main_center_r">
				<div id="shopLeft">
					<?php
						require_once('left.inc.php');
					?>
				</div>
				<div id="shopRight">
					<h1>Modify phone number</h1>
					<div id="introAdd">
					<form method="post" action="shop_do.php?act=updatePhone">
						
					
						<p><label class="label_214">Phone number：</label><input type="text" id="phone" name="phone" value="<?php echo $phone?>" style="background-color:#e4e4e4;" class="input input179" readonly/> <a href="shopupdatephone.php" class="blue">Change phone number</a></p>
						<p><label class="label_214">&nbsp;</label><img src="../images/button/getcode.gif" alt="" onClick="sendCode()"/></p>
						<p><label class="label_214">Code：</label><input type="text" name="code"   class="input input179" /></p>
						<p><label class="label_214">&nbsp;</label>Not receive code in 3 mins？<a href="javascript:void();" class="blue" onClick="sendCode()">Get code again</a></p>
						<p><label class="label_214">&nbsp;</label><input type="image" src="../images/button/verify.gif" /></p>
					</form>
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
