<?php
	
	require_once("usercheck.php");
	$shopID=sqlReplace(trim($_GET['shopID']));
	$sql="select * from qiyu_shop where shop_id=".$shopID." and shop_status='1'";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
	if (!$rows){
		alertInfo("Error","index.php",0);	
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <script src="js/jquery-1.3.1.js" type="text/javascript"></script>
  <title> Quick Registration - <?php echo $SHOP_NAME?> - <?php echo $powered?> </title>
 </head>
 <body>
 <script type="text/javascript">
//<![CDATA[
$(function(){
         //文本框失去焦点后
	    $('.input').blur(function(){
			 var $parent = $(this).parent();
			 if( $(this).is('#phone') ){
					if( this.value=="" || this.value.length < 11 ||  this.value.length > 11){
					    var errorMsg = 'Please type right phone number.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError');
					}else{
					    var okMsg = 'Type correct.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError');
						
					}
			 }
			  if( $(this).is('#name') ){
					if( this.value==""){
					    var errorMsg = 'Name could not be empty.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError');
					}else{
					    var okMsg = 'Type correct.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError');
					}
			 }
			 if ($(this).is("#area")){
				if( this.value==""){
					    var errorMsg = 'This space cannot be empty.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError');
				}
			 }

			  if( $(this).is('#address') ){
					if( this.value==""){
					    var errorMsg = 'Address cannot be empty.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError');
					}else{
					    var okMsg = 'Type correct.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError');
					}
			 }
		}).keyup(function(){
		   $(this).triggerHandler("blur");
		}).focus(function(){
	  	   $(this).triggerHandler("blur");
		});//end blur

		
		//提交，最终验证。
		 $('#send').click(function(){
				$("form :input.required").trigger('blur');
				var numError = $('form .onError').length;
				if(numError){
					return false;
				} 

				if($("#area").val()==""){
						var $parent = $("#area").parent();
						var errorMsg = 'This space cannot be empty.';
                        $parent.find('.red').text(errorMsg);
	
					    return false;
				}
				if($("#circle").val()==""){
						var $parent = $("#circle").parent();
						var errorMsg = 'Trading area cannot be empty.';
                        $parent.find('.red').text(errorMsg);
	
					    return false;
				}
				if($("#spot").val()==""){
						var $parent = $("#spot").parent();
						var errorMsg = 'Landmark cannot be empty.';
                        $parent.find('.red').text(errorMsg);
	
					    return false;
				}
		 });

		
})

$(function(){
	   $("#area").change(function(){
		   var area=$("#area").val();
			$.post("area.ajax.php", { 
						'area_id' :  area,
							'act':'circle'
					}, function (data, textStatus){
							if (data==""){
								$("#circle").html("<option value=''>No trading area</option>")
							}else
								$("#circle").html("<option value=''>Please choose</option>"+data);
					});
	   })
	})

	$(function(){
	   $("#circle").change(function(){
		   var circle=$("#circle").val();
			$.post("area.ajax.php", { 
						'circle_id' :  circle,
						'act':'spot'
					}, function (data, textStatus){
							if (data==""){
								$("#spot").html("<option value=''>No landmark</option>")
							}else
								$("#spot").html(data);
						
					});
	   })
	})
//]]>
</script>
 <div id="container">
	<?php
		require_once('header_index.php');
	?>
	<div id="main">
		<div id="shadow"><img src="images/shadow.gif" width="955" height="9" alt="" /></div>
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center">
				<div id="tab_box_r" class="inforBox">
				<div class="big_title">Sign in or order directly</div>
					<div id="loginLeft">
					<form method="post" action="userquickreg_do.php?shopID=<?php echo $shopID?>">
						
					
						<div class="addList addList_r loginlist" style="margin-left:38px;margin-bottom:30px;">
							<p style="color:#000000;">Don't want to sign-up?Order directly:</p>
							<p><span>if you don't have account but want to signup later，you can order directly. You only need to provide your phone number and address</span></p>
						</div>
						<div class="addList addList_r loginlist" style="margin-top:0;padding-top:10px;">
							<label>您的手机号：</label><input type="text" name="phone" id="phone" class="input"/> <span class="red"></span>
						</div>
						<div class="addList loginlist">
							<label>&nbsp;</label> <span>Your phone number will be used to login, retrieve password and contact for delivery，<br/> Please Write your phone number </span>
						</div>
						
						<div class="addList addList_r loginlist"><label>Your name：</label><input type="text" id="name" name="name" class="input"/> <span class="red"></span>
						
						</div>
						<div class="addList addList_r loginlist">
							<label>Your address：</label>Montreal <select id="area" name="area" class="select">
							<option value="">Please select</option>
							<?php
								$sql_area = "select * from ".WIIDBPRE."_area";
								$rs_area = mysql_query($sql_area);
								while($row_area = mysql_fetch_assoc($rs_area)){
									echo '<option value="'.$row_area['area_id'].'">'.$row_area['area_name'].'</option>';
								}
							?>
							</select> District <select id="circle" name="circle" class="select">
								<option value="">Please select</option>
							</select> Trade area <span class="red"></span>
						</div>
						<div class="addList addList_r loginlist">
							<label>&nbsp;</label>Select your closest coordinate <select id="spot" class="select" name="spot">
									<option value="">Please select</option>
								</select> <span class="red"></span>
						</div>
						<div class="addList addList_r loginlist">
							<label>Your detailed address：</label><input type="text" id="address" name="address" class="input"/> <span class="red"></span>
						</div>
						<div class="addList loginlist">
							<label>&nbsp;</label> <span> Please provide your address to recieve the order.<br/> Example：1430 rue city councillor</span>
						</div>
					
						<div class="addList loginlist">
							<input type="image" src="images/sure.gif" style="margin-left:199px;" id="send"/>
						</div>
						</form>
					</div><!--leftwan-->
					<div id="loginRight">
						<p>Already have account？ <a href="userlogin.php">Log in right now</a></p>
						<p style="margin-top:50px;">Not have account？ <a href="userreg.php">Signup right now</a></p>
						<p style="margin-top:5px;"><span>Signup an account，and experience fast ordering<br/>， enjoy all the discounts</span></p>
					</div>
					<div class="clear"></div>
				</div><!--tab_box_r-->
				
				
			</div>
			<div class="main_bottom"></div>
		</div><!--main_content完-->
		
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
	 
 </div>
 </body>
</html>
