<?php
	
?>
						<!--修改姓名-->
						<h1 class="order_h1">Edit your name</h1>
						
						<div class="addList newAddList">
							<label>Your Name：</label><input type="text" id="user_name" name="user_name" class="input" value="<?php echo $row['user_name'];?>"/><!--   <span class="red errormt2"></span>-->
						</div>
						<div class="addList newAddList">
							<label>&nbsp;</label> <span>This name is the name displayed on the head of the website</span>
						</div>
						<div class="clear"></div>
						<div class="addList newAddList" style="height:40px;margin-bottom:30px;">
							<img src="images//button/save.jpg" class="button" style="position:absolute;top:5px;left:260px;" onclick="return updateusername();" />
						</div>
						<div class="clear"></div>
						
						<!--新增地址和联系方式-->
						<h1 class="order_h1">Add address and contact information</h1>
						
						<div class="addList newAddList">
							<label>Your mobile number：</label><input type="text" id="phone" name="phone" class="input"/> <span class="red errormt"></span>
						</div>
						<div class="addList newAddList">
							<label>Your Name：</label><input type="text" name="name" id="name" class="input"/> <span class="red errormt"></span>
						</div>
						
						<div class="addList newAddList">
							<label>your address in detail：</label><input type="text" id="address" name="address" class="input"/> <span class="red errormt"></span>
						</div>
						<div class="addList newAddList">
							<label>&nbsp;</label> <span>Please fill in your exact address，In order to receive meals in time. 1430 rue city councillor</span>
						</div>
						<div class="clear"></div>
						<div class="addList newAddList" style="height:40px;">
							<img src="images//button/save.jpg" class="button" style="position:absolute;top:5px;left:260px;" id="addAddress1" onclick="return alertadd('addaddress');" />
						</div>
						<div class="clear"></div>
						<h1 class="order_h1" style="margin-top:20px;">Saved address and contact information</h1>
						<div class="table orderTable">
							<table>
								<tr>
									<td width="220" class="metal">delivery address</td>
									<td width="100" class="metal borderLeft">Name</td>
									<td width="100" class="metal borderLeft">Contact information</td>
									<td width="300" class="metal borderLeft" colspan='2'>operating</td>		
								</tr>
							<?php
								$sql="select * from qiyu_useraddr where useraddr_user=".$QIYU_ID_USER." order by useraddr_type asc";
								$rs=mysql_query($sql);
								while ($rows=mysql_fetch_assoc($rs)){
							?>
								<tr id="table<?php echo $rows['useraddr_id']?>">
									<td class="borderBottom borderLeft"><?php echo $rows['useraddr_address']?></td>
									<td class="borderBottom borderLeft"><?php echo $rows['useraddr_name']?></td>
									<td class="borderBottom borderLeft"><?php echo $rows['useraddr_phone']?></td>
									<td class="borderBottom borderLeft"><span class="red"><?php if ($rows['useraddr_type']=='0') echo "Current Default Address";?></span></td>
									<td class="borderBottom borderRight borderLeft red">
										<a href="javascript:void();" onClick="updateAddress(<?php echo $rows['useraddr_id']?>)">modify</a> | <span onclick="alert1('deladdress','<?php echo $rows['useraddr_id']?>');" style="cursor:pointer;">delete</span> <?php if ($rows['useraddr_type']!='0'){?> | <span onclick="setaddress('setaddress','<?php echo $rows['useraddr_id']?>');" style="cursor:pointer;">set as Default</a><?php }?>
									</td>
									
								</tr>
							<?php
								}	
							?>
								
							</table>
						</div>
<script type="text/javascript">

$(function(){				
			$("#addAddress1").hover(function(){
							 $(this).attr('src','images/button/save_1.jpg');
					 },function(){
							 $(this).attr('src','images/button/save.jpg');
			});
			$("#addAddress1").mousedown(function(){
			  $(this).attr('src','images/button/save_2.jpg');
			  
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
								$("#circle").html("<option value=''>No business district</option>")
							}else
								$("#circle").html("<option value=''>please choose</option>"+data);
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
								$("#spot").html("<option value=''>No landmarks</option>")
							}else
								$("#spot").html(data);
						
					});
	   })
	})

 

</script>
 <script type="text/javascript">
 
	function updateAddress(ID){
		$.post("usercenter.ajax.php", { 
			'id'      :  ID,
			'act'     : 'getAddress'
			}, function (data, textStatus){
				$('.addtr').remove();
				$(data).insertAfter('#table'+ID);
						
		});
		
	}
	function checkphone(){
		var phone=$("#phone_r").val();
		if (phone==''){
			$("#spanphone").html('Phone number cannot be empty');
			return false;
		}else{
			var reg=/^\d+$/i;
			if(phone.match(reg)){
				$("#spanphone").html('<img src="images/ok.gif" />');
				return true;
			}else{
				$("#spanphone").html('Phone number format is not correct');
				return false;
			}
		}
	}
	function checkname(){
		var name=$("#name_r").val();
		if (name==''){
			$("#spanname").html('Name cannot be empty');
			return false;
		}else{
			var reg=/^[\u0391-\uFFE5]+$/;
			
				if(name.length>40){
					$("#spanname").html('Name cannot exceed 40 characters');
					return false;
				}else{
					$("#spanname").html('<img src="images/ok.gif" />');
					return true;
				}
			
		}
	}
	function checkaddr(){
		var address=$("#address_r").val();
		if (address==''){
			$("#spanaddr").html('Detailed address cannot be empty');
			return false;
		}else{
			$("#spanaddr").html('<img src="images/ok.gif" />');
			return true;
		}
	}
	function checkcircle(){
		var area=$("#area_r").val();
		var circle=$("#circle_r").val();
		var spot=$("#spot_r").val();
		if (area==''||circle==''||spot==''){
			$("#spancircle").html('Address cannot be empty');
			return false;
		}else{
			$("#spancircle").html('<img src="images/ok.gif" />');
			return true;
		}
	}
	function submitAddress(id){
		var phone=$("#phone_r").val();
		var name=$("#name_r").val();
		
		var address=$("#address_r").val();
		checkphone();
		checkname();

		checkaddr();
		if(!checkphone()){return false;}
		if(!checkname()){return false;}
		
		if(!checkaddr()){return false;}

		$.post("usercenter.ajax.php", { 
			'id'      :  id,
			'phone' :  phone,
			'name' :  name,
			
			'address' :  address,
			'act'     : 'updateAddress'
			}, function (data, textStatus){
				if (data=="S"){
					TINY.box.show('Change made',0,160,60,0,10);
					setTimeout('location.href="usercenter.php?tab=5"',2000) ;
				}else
					TINY.box.show('Change made',0,160,60,0,10);
					setTimeout('location.href="usercenter.php?tab=5"',1000);
						
		});
	}
	 
	</script>
	<script type="text/javascript">
		function alert1(act,useraddrid){//用户地址、删除设置为默认
			if(confirm('Are you sure you want to delete it?')){
				$.ajax({
				   type: "GET",
				   url: "usercenter_do.php?act="+act+"&id="+useraddrid,
				   data: "",
				   success: function(msg){
					 TINY.box.show(msg,0,160,60,0,10);
					 setTimeout('location.href="usercenter.php?tab=5"',1000)
				   }
				});
			}
		}

		function setaddress(act,useraddrid){
			$.ajax({
				   type: "GET",
				   url: "usercenter_do.php?act="+act+"&id="+useraddrid,
				   data: "",
				   success: function(msg){
					 TINY.box.show(msg,0,160,60,0,10);
					 setTimeout('location.href="usercenter.php?tab=5"',1000)
				   }
			});
		}
	</script>