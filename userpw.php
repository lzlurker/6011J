<?php

	require_once("usercheck.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<script src="js/jquery-1.3.1.js" type="text/javascript"></script>
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
					<form method="post" action="userpw2.php">
					
				
					<div style="padding-top:30px;padding-bottom:50px;">
					<?php
						if ($site_sms=='1'){
					?>
							<div class="addList" >
								<div class="tip"><img src="images/icon3.gif" alt="" />In order to protect your account security, please verify your phone first.</div>
							</div>
					
							<div class="addList addList_r forget" style="position:relative;">
								<label>Phone number：</label><input type="text" id="phone1" class="input" name="phone" /> <span class="errormt" id="phoneTip"></span>		
							</div>
							<div class="addList" id="sendCode">
								<label>&nbsp;</label>
								<?php
									$sendTime=$_SESSION['sms_sendTime'];
									$time=date('Y-m-d H:i:s');
									if (!empty($sendTime)){
										
										if (round((strtotime($time)-strtotime($sendTime))/60)>20){
											$_SESSION['sms_sendTime']='';
											$_SESSION['sms_code']='';
											echo '<img src="images/button/getcode.gif" alt="Get" onclick="sendcode()" />';
										}else
											echo '<img src="images/button/getcode_r.gif" alt=""  style="cursor:auto;"/>';
									}else{
										echo '<img src="images/button/getcode.gif" alt="Get" onclick="sendcode()" />';
									}
								?>
								
							</div>
							<div class="addList" id="codeTip" style="display:none;">
								<label>&nbsp;</label> <span class="habebg red">The verification code has been sent, please check it!</span>
							</div>
							<div class="addList addList_r forget"><label>Verification code：</label><input type="text" id="code" class="input" name="code" /> 
								<input type="hidden" id="a" value="" /><!--隐藏字段-->
							</div>
							<div class="addList">
								<label>&nbsp;</label> <input type="image" src="images/button/submit3.gif" id="send" onClick="return check();" />
							</div>
					<?php
						}else{
					?>
							<div class="addList addList_r forget" style="position:relative;">
								<label>Phone number：</label><input type="text" id="phone1" class="input" name="phone" /> <span class="errormt" id="phoneTip"></span>	
							</div>
							<div class="addList" style='margin-top:20px;'>
								<label>&nbsp;</label> <input type="image" src="images/button/submit3.gif" id="send" onClick="return check_r();" />
							</div>
					<?php
						}
					?>	
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
<SCRIPT LANGUAGE="JavaScript">
<!--
	function sendcode(){
		var phone=$("#phone1").val();
		if(phone==''){
			$("#phoneTip").html("Phone number can not be empty");
			return false;
		}else{
			var reg=/^1[358]\d{9}$/;
			if(phone.match(reg)){
				 $.get("userpw_do.php", { 
						'act'   :  "check",
						'phone' :  $('#phone1').val()
						}, function (data, textStatus){
								if (data=="S")
								{
									$("#phoneTip").html("<img src=images/ok.gif />");
									
									 $.get("userpw_do.php", { 
											'act'   :  "send",
											'phone' :   phone
											}, function (data, textStatus){
											if (data=="S"){
												//成功
												$("#codeTip").css('display','block');
												$("#a").val("1");
												window.setTimeout("checkTime()",1000);
												
												
												return true;
											}else{
												alert("Unknown reason, failed to send");
												$("#codeTip").css('display','none');
												return false;
											}	
									
										});
								}else{
									$("#phoneTip").html("Mobile number does not exist");
									$("#codeTip").css('display','none');
									return false;
								}
				});
			}else{
				$("#phoneTip").html("Phone number format is incorrect");
				$("#codeTip").css('display','none');
				return false;
			}
		}

	}

	function checkTime(){
		 $.get("userpw_do.php", { 
			'act'   :  "checkCodeTime"
				}, function (data, textStatus){
					$('#sendCode').html(data);
									
		});
	}
//-->
</SCRIPT>
<script type="text/javascript">
	function check(){
		var a=$("#a").val();
		var code=$("#code").val();
		
		if(code==''){
			alert("please enter verification code")
			return false;
		}
	}
	function check_r(){
		var phone=$("#phone1").val();
		
		
		if(phone==''){
			$("#phoneTip").html("Phone number can not be blank");
			return false;
		}else{
			var reg=/^1[358]\d{9}$/;
			if(!phone.match(reg)){
				$("#phoneTip").html("Phone number format is incorrect");
				return false;
			}
		}
	}
</script>
