<?php
	
?>

						<h1 class="order_h1">change Password</h1>
						<div class="addList newAddList listUpdate" style='margin-top:34px;'>
							<label>Enter your current password：</label><input type="password" id="old" name="phone" class="input"/> <span class="red errormt"></span>
						</div>
						<div class="addList newAddList listUpdate">
							<label>Enter a new password：</label><input type="password" name="name" id="pw1" class="input"/> <span class="red errormt"></span>
						</div>
						<div class="addList newAddList listUpdate">
							<label>Enter the new password again：</label><input type="password" name="name" id="pw2" class="input"/> <span class="red errormt"></span>
						</div>
						<div class="clear"></div>
						<div class="addList newAddList" style="height:40px; margin-top:43px;">
							<img src="images//button/save.jpg" class="button" style="position:absolute;top:5px;left:340px;" id="addAddress2" onclick="return updatePWD();" />
						</div>
						<div class="clear"></div>
						
<script type="text/javascript">

$(function(){				
			$("#addAddress2").hover(function(){
							 $(this).attr('src','images/button/save_1.jpg');
					 },function(){
							 $(this).attr('src','images/button/save.jpg');
			});
			$("#addAddress2").mousedown(function(){
			  $(this).attr('src','images/button/save_2.jpg');
			  
			});
		})

	
function updatePWD(){
	var old=$("#old").val();
	var pw1=$("#pw1").val();
	var pw2=$("#pw2").val();
	if (old==''){
		 TINY.box.show('The current password cannot be empty!',0,160,60,0,10);
	}
	if (pw1==''){
		 TINY.box.show('The new password cannot be empty!',0,160,60,0,10);
	}else if(pw1.length<6){
		 TINY.box.show('The new password is at least 6 digits!',0,160,60,0,10);
	}else if(pw2==''){
		 TINY.box.show('confirm password cannot be blank!',0,160,60,0,10);
	}else if(pw2.length<6){
		 TINY.box.show('Confirmation code is at least 6 digits!',0,160,60,0,10);
	}else if (pw1!=pw2){
		TINY.box.show('The confirmation code is different from the new password!',0,160,60,0,10);
	}
	$.post("usercenter.ajax.php", { 
		'old' : old,
		'pw1'  : pw1,
		'pw2'  : pw2,
		'act'  : 'updatePW'
		}, function (data, textStatus){
			if (data=='OLD'){
				TINY.box.show('Current password cannot be empty!',0,160,60,0,10);
			}else if(data=='PW1'){
				 TINY.box.show('New password cannot be empty!',0,160,60,0,10);
			}else if(data=='pw2'){
				 TINY.box.show('confirm password cannot be blank!',0,160,60,0,10);
			}else if (data=='N'){
				TINY.box.show('The confirmation code is different from the new password!',0,160,60,0,10);
			}else if (data=='PW_E'){
				TINY.box.show('The current password is incorrect!',0,160,60,0,10);
			}else if (data=='S'){
				TINY.box.show('Your password was successfully modified，Coming back to the home page',0,160,60,0,10);
				setTimeout("location.href='index.php'",2000);
			}else if (data=='E'){
				TINY.box.show('fail to edit!',0,160,60,0,10);
			}
	});
}
 

</script>
 
