<?php
	
	require_once("usercheck.php");
	//echo '<pre>';print_R($_POST);
	$shopID=sqlReplace(trim($_GET['shopID']));
	$userSpot=empty($_POST['spotID'])?'0':sqlReplace(trim($_POST['spotID']));
	$shopSpot=empty($_GET['shopSpot'])?'0':sqlReplace(trim($_GET['shopSpot']));
	$shopCircle=empty($_GET['circleID'])?'0':sqlReplace(trim($_GET['circleID']));

	$orderType=empty($_GET['ordertype'])?'':sqlReplace(trim($_GET['ordertype']));
	$orderGroup=empty($_GET['groupID'])?'':sqlReplace(trim($_GET['groupID']));
	$time1=empty($_POST['time1'])?'':sqlReplace($_POST['time1']);
	$time2=empty($_POST['time2'])?'':sqlReplace($_POST['time2']);
	$orderDesc=empty($_POST['desc'])?'':HTMLEncode($_POST['desc']);
	if (!empty($userSpot)) $shopSpot=$userSpot;
	
	if (!empty($_SESSION['qiyu_orderType'])){
		if ($orderType!=$_SESSION['qiyu_orderType']){
			$_SESSION['qiyu_orderType']=$orderType;
		
		}else{
			$orderType=$_SESSION['qiyu_orderType'];
		}
	}else{
		
		$_SESSION['qiyu_orderType']=$orderType;
	}
	if (!empty($_SESSION['qiyu_orderGroup'])){
		if ($_SESSION['qiyu_orderGroup']!=$orderGroup){
			$_SESSION['qiyu_orderGroup']=$orderGroup;
		}else{
			$orderGroup=$_SESSION['qiyu_orderGroup'];
		}
		
	}else{
		
		$_SESSION['qiyu_orderGroup']=$orderGroup;
	}
	
	if (!empty($_SESSION['qiyu_orderTime1'])){
		if ($_SESSION['qiyu_orderTime1']!=$time1){
			$_SESSION['qiyu_orderTime1']=$time1;
		}else{
			$time1=$_SESSION['qiyu_orderTime1'];
		}
	}else{
		
		$_SESSION['qiyu_orderTime1']=$time1;
	}
	if (!empty($_SESSION['qiyu_orderTime2'])){
		
		if ($_SESSION['qiyu_orderTime2']!=$time2){
			$_SESSION['qiyu_orderTime2']=$time2;
		}else{
			$time2=$_SESSION['qiyu_orderTime2'];
		}
	}else{
		
		$_SESSION['qiyu_orderTime2']=$time2;
	}
	if (!empty($_SESSION['qiyu_orderDesc'])) {
		if ($_SESSION['qiyu_orderDesc']!=$orderDesc){
			$_SESSION['qiyu_orderDesc']=$orderDesc;
		}else{
			$orderDesc=$_SESSION['qiyu_orderDesc'];
		}
	}else{
		
		$_SESSION['qiyu_orderDesc']=$orderDesc;
	}

	if (empty($QIYU_ID_USER)){
		Header("Location: userlogin.php?p=order&shopID=".$shopID."&shopSpot=".$shopSpot."&shopCircle=".$shopCircle);
		exit;
	}
	if (!empty($time2)){
		$time_now=time();
		$time_0_str=strtotime($time1.' '.$time2.':00');
		if($time_now>$time_0_str){
			alertInfo("Appointment time cannot be later than the current time","",1);	
		}
	}
	if (!empty($shopSpot)){
		$areaArray=getCircleBySpot($shopSpot);
	}
	$_SESSION['login_url']=getUrl();
	$POSITION_HEADER="Submit Order";
	$sql="select * from qiyu_shop where shop_id=".$shopID." and shop_status='1'";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
	if ($rows){	
		$shop_name=$rows['shop_name'];
		$shop_id2=$rows['shop_id2'];
		$payStr=explode("|",$rows['shop_pay']);
		$shop_pay="|".$rows['shop_pay']."|";
		$payCount=count($payStr);
		$shop_discount=$rows['shop_discount'];
			
	}else{
		alertInfo("Illegal operation");
	}
	$total=0;//菜总价
	$cur_cart_array = explode("///",$_COOKIE['qiyushop_cart']);
	foreach($cur_cart_array as $key => $goods_current_cart){
		$currentArray=explode("|",$goods_current_cart);
		$cookieShopID=$currentArray[0];
		$cookieFoodID=$currentArray[1];
		$cookieFoodCount=$currentArray[2];
		if ($shopID==$cookieShopID){
			$sql="select * from qiyu_food where food_id=".$cookieFoodID." and food_shop=".$cookieShopID;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				if ($orderType=='group')
					$total+=$rows['food_groupprice']*$cookieFoodCount;
				else
					$total+=$rows['food_price']*$cookieFoodCount;
			}

		}
	}
	if (empty($total)){
		alertInfo("You have not added any food yet.","index.php",0);
	}

	//$user_defaultAdd=empty($_POST['addressID'])?'0':sqlReplace($_POST['addressID']);
		
		//得到用户地标下的送餐费
		$sql="select * from qiyu_deliver";
		$rs=mysql_query($sql);
		$row=mysql_fetch_assoc($rs);
		if ($row){
			$isDFee=$row['deliver_isfee'];
			$sendfee=$row['deliver_minfee'];
			$sendfee_r=$sendfee;
			$deliverfee_r=$row['deliver_fee'];
			$deliver_t=true;
		}else{
			$deliver_t=false;
			$isDFee='';
			$sendfee='';
			$sendfee_r=$sendfee;
			$deliverfee_r='';

		}
		
		
		//判断是否满足商家设定的外送消费下限
		if ($total<$sendfee_r && $orderType!='group'){
		
			alertInfo("Your order is not enough for delievery, please increase.","index.php",0);
		}
		
		
		
		//检查是否是饭点商家
		$sqlStr="select * from qiyu_tag where tag_id=9";
		$rs_r=mysql_query($sqlStr);
		$rows=mysql_fetch_assoc($rs_r);
		if ($rows){
			
				$sql="select * from qiyu_shoptag where shoptag_shop=".$shopID." and shoptag_tag=9";
			
			
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			if ($row){
				$isFee=true;
			}else{
				$isFee=false;
			}
		}
		
		//如果>起送费并且 deliver_isfee 为1则免送餐费 
		if ($isDFee=='1' && $total>=$sendfee_r){  
			$deliverfee_r=0;						
		}
		
		//if ($shop_discount!="0.00"){
			//$total_discount=$total*($shop_discount/10);
			//$totalAll=$total_discount+$deliverfee_r;
		//}else{
			$totalAll=$total+$deliverfee_r;
	//	}

			$str="CA$ ". $deliverfee_r;


	if (!empty($QIYU_ID_USER)){
		$sqlStr="select * from qiyu_user where user_id=".$QIYU_ID_USER."";
		$result = mysql_query($sqlStr);
		$row=mysql_fetch_assoc($result);
		if($row){
			$USER_SCORE=$row['user_score'];
			$user_phone=$row['user_phone'];
		}
	}
	
	//查 地标下商圈 区域
	$area_id='';
	$circle_id='';
	$che_sql="select * from qiyu_spot,qiyu_circle where spot_circle=circle_id and spot_id=".$shopSpot;
	$che_rs=mysql_query($che_sql);
	$che_row=mysql_fetch_assoc($che_rs);
	if ($che_row){
		$circle_id=$che_row['circle_id'];
		$a_sql="select * from qiyu_areacircle,qiyu_area where areacircle_area=area_id and areacircle_circle=".$circle_id;
		$a_rs=mysql_query($a_sql);
		$a_row=mysql_fetch_assoc($a_rs);
		if ($a_row){
			$area_id=$a_row['areacircle_area'];
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $imgstr2;?>" type="image/x-icon" />
<script src="js/jquery-1.3.1.js" type="text/javascript"></script> 
<script src="js/address.js" type="text/javascript"></script>
<script src="js/tab.js" type="text/javascript"></script>
<script type="text/javascript" src="js/bxCarousel.js"></script>
<script src="js/addbg.js" type="text/javascript"></script>
<title> Submit Order -<?php echo $SHOP_NAME?> - <?php echo $powered?> </title>
</head>
<body>
  <script type="text/javascript">
 <!--
	function editTel(){
		$("#editTel").css("display","inline");
		$("#editAddress").css("display","inline");
	}
	function showTel(){
		var str="Your phone number： <input type=\"text\" id=\"phone\" class=\"tel_input\"/><img src=\"images/modiPhone.gif\"  class=\"submit\" onClick=\"updatePhone()\"  style='cursor:pointer;' alt=\"\" />";
		$("#phoneDiv").html(str);
	}
	function updatePhone(){
		var tel=$("#phone").val();
		if (tel==''){
			alert('The phone cannot be empty!');
			return false;
		}
		$.post("userorder.ajax.php", { 
			'tel' :  tel,
			'act' :  'editTel'
			}, function (data, textStatus){
				var post = data;
				if (data=='S'){
					$("#phoneDiv").html("Your phone number： "+tel+"<input type=\"hidden\" phone=\""+tel+"\" />");
					return false;
				}else{
					alert('fail to edit!');
					return false;
				}
							
		});

	}

	//单击添加新地址时显示添加表单
$(function(){
		 $("input:radio[name='addressList']").click(function(){
			 var $parent=$(this).parent();
			 var shopCircle=$("#shopCircle").val();
			 var pay=$("input:radio[name='pay']:checked").val();
			if (this.value=='0'){
				$("#addressNew").show();
				$("#submitType").val('2');
				$("#insert").val('1');
			}

					
		 });
});
//点击付款方式计算总金额
$(function(){
	 $("input:radio[name='pay']").click(function(){
			var address=$("input:radio[name='addressList']:checked").val();
			if (address=='0'){
				getPriceBySpot();
			}else{
				
				getPriceByAddress();
				
			}
	 
	 });
});

function getPriceBySpot()
{
			 var spot=$("#spot1").val();
		    var circle=$("#circle1").val();
			var shopCircle=$("#shopCircle").val();
			 var pay=$("input:radio[name='pay']:checked").val();
			$.post("userorder.ajax.php", { 
						'spot' :  spot,
						'circle' :  circle,
						'pay' :  pay,
						'shopCircle' : shopCircle,
						'shop'  : <?php echo $shopID?>,
						'act':'getFee'
					}, function (data, textStatus){
						
							var rs;
							rs=data.split('|');
							if (rs[0]=="N"){
								$('#tips1').hide();
								$("#selever").hide();
								$('#tips2').hide();
								TINY.box.show_spot('The address you choose is not included in this restaurant. Check out the restaurant that can be served as you can, please click <a href="spot.php?spotID='+spot+'&circleID='+circle+'">here</a>。',0,160,60,0,0);
							}else{
								$('#tips').show();
								$('#tips2').show();
								$("#selever").show().html(rs[1]);
								$("#rest").html(rs[2]);
							}
						
					});

}

function getPriceByAddress(){
	var shopCircle=$("#shopCircle").val();
	 var pay=$("input:radio[name='pay']:checked").val();
	var address=$("input:radio[name='addressList']:checked").val();
	$.post("userorder.ajax.php", { 
					'address' :  address,
					'shopID'  : <?php echo $shopID?>,
					'shopCircle' : shopCircle,
					'pay'        : pay,
					'act':  'getSpotByADD'			
					},function(data, textStatus){
						var rs;
							rs=data.split('|');
							if (rs[0]=="N"){
								$('#tips1').hide();
								$('#tips2').hide();
								$("#selever").hide();
								TINY.box.show_spot('The address you choose is not included in this restaurant. Check out the restaurant that can be served as you can, please click <a href="spot.php?spotID='+rs[2]+'&circleID='+rs[1]+'">here</a>',0,160,60,0,0);
							}else{
								$('#tips1').show();
								$('#tips2').show();
								$("#selever").show().html(rs[1]);
								$("#rest").html(rs[2]);
							}
					}
				);
}
	function showAddress(){
		$(".arBox").css("display","block");
		$("#addressIntro").html('Detailed address：');
	}
	function addAddress(){
	
		var name=$("#name").val();
		var phone=$("#phone").val();
		var area=$("#area").val();
		var circle1=$("#circle").val();
		var spot=$("#spot").val();
		var address=$("#address").val();
		if (circle1==''){
			alert('The business district cannot be empty!');
			return false;
		}
		if (spot==''){
			alert('Landmarks cannot be empty!');
			return false;
		}
		if (address==''){
			alert('The address cannot be empty!');
			return false;
		}
		$.post("userorder.ajax.php", { 
							'phone'   :  phone,
							'name'    :  name,
							'area'    :  area,
							'circle'  :  circle1,
							'spot'    :  spot,
							'address' :  address,
							'act'     :  'addAddress'
							}, function (data, textStatus){
							var post = data;
							if (data=='E')

								alert('Add failed!');
							else{
								
								location.reload();
								$("#ajaxAddress").html(data);
								$("#addressAdd").css("display","none");
							}
							
		});
	}
	//还需支付金额
	function rest(score,total){
		if ($("#fee").attr("checked") == true){
			if (score >=total){
				text('CA$').$("#rest");
				$("#feeValue").text("饭点抵扣-"+total);
			}
			if (score<total){
				$("#rest").text('CA$' + total-score);
				$("#feeValue").text("饭点抵扣-"+score);
			}

		}else{
			$("#rest").text('CA$' +total)
		}
	}

function updateAddress(){
	$("#addressNew").show();
}

function checkIsDwliver(deliver,code){
	if (!code){
		alert("Please modify the address within the delivery range of the merchant.");
		return false;
	}
	if (!deliver){
		TINY.box.show_spot('The merchant has not set the delivery fee under the road sign, you can not submit the order temporarily.!',0,160,60,0,10);
		return false;
	}
}

	function checkOrder(){		
		if ($("#submitType").val()=='1'){
			var phone=$("#phone").val();
			var address=$("#address").val();
			if ($("#name").val()==''){
				TINY.box.show('Name cannot be empty!',0,160,60,0,10);
				return false;
			}else{
				var name=$("#name").val();
				var reg=/^[\u0391-\uFFE5]+$/;
				 if(name.match(reg)){

					
				
			}

			if(phone==""){
				TINY.box.show('The phone cannot be empty!',0,160,60,0,10);
				return false;
			}else{
				var reg=/^1[358]\d{9}$/;
				 if(!phone.match(reg)){
							
					TINY.box.show('Incorrect format!',0,160,60,0,10);
					return false;
				}
			}
			if ($("#area").val()==''){
				TINY.box.show('please select the region!',0,160,60,0,10);
				return false;
			}
			if ($("#circle").val()==''){
				TINY.box.show('Please select a business district!',0,160,60,0,10);
				return false;
			}
			if ($("#spot").val()==''){
				TINY.box.show('Please select your placemark.',0,160,60,0,10);
				return false;
			}
			if(address==""){
				TINY.box.show('The address cannot be empty!',0,160,60,0,10);
				return false;
			}



		
		}else if ($("#submitType").val()=='2'){
			var phone1=$("#phone1").val();
		
			var address1=$("#address1").val();
	
			if(phone1==""){
				TINY.box.show('The phone cannot be empty',0,160,60,0,10);
				return false;
			}else{
				var reg=/^1[358]\d{9}$/;
				 if(!phone1.match(reg)){
					TINY.box.show('Incorrect format!',0,160,60,0,10);
					return false;
				}
			}
			if ($("#area").val()==''){
				TINY.box.show('please select the region!',0,160,60,0,10);
				return false;
			}
			if ($("#circle").val()==''){
				TINY.box.show('Please select a business district!',0,160,60,0,10);
				return false;
			}
			if ($("#spot").val()==''){
				TINY.box.show('Please select your placemark.',0,160,60,0,10);
				return false;
			}

			if(address1==""){
				TINY.box.show('The address cannot be empty!',0,160,60,0,10);
				return false;
			}
			

		} 
		/*
		alert('232');
		document.getElementById('ordertijiao').src='images/button/sure_order_0.jpg';        
		document.getElementById('ordertijiao').disabled='disabled';
		document.getElementById('submitForm').submit();
		*/

	}
 //-->
 </script>
 <script type="text/javascript">
//<![CDATA[
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
	   $("#area1").change(function(){
		   var area=$("#area1").val();
			$.post("area.ajax.php", { 
						'area_id' :  area,
							'act':'circle'
					}, function (data, textStatus){
							if (data==""){
								$("#circle1").html("<option value=''>No business district</option>")
							}else
								$("#circle1").html("<option value=''>please choose</option>"+data);
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
								$("#spot").html("<option value=''>please choose</option>"+data);
						
					});
	   })
	})

 $(function(){
	   $("#circle1").change(function(){
		   var circle=$("#circle1").val();
			$.post("area.ajax.php", { 
						'circle_id' :  circle,
						'act':'spot'
					}, function (data, textStatus){
							if (data==""){
								$("#spot1").html("<option value=''>No landmarks</option>")
							}else
								$("#spot1").html("<option value=''>please choose</option>"+data);
						
					});
	   })
	})
	

	 $(function(){
		 
		$("#showIntro").hover(function(e){
			$("#cartBox").show();
		},function(){
			$("#cartBox").hide();
		
		});
		
	 });

	 $(function(){
	   $("#spot").change(function(){
		   var spot=$("#spot").val();
		    var circle=$("#circle").val();
			var shopCircle=$("#shopCircle").val();
			 var pay=$("input:radio[name='pay']:checked").val();
			$.post("userorder.ajax.php", { 
						'spot' :  spot,
						'circle' :  circle,
						'pay' :  pay,
						'shopCircle' : shopCircle,
						'shop'  : <?php echo $shopID?>,
						'act':'getFee'
					}, function (data, textStatus){
							var rs;
							rs=data.split('|');
							if (rs[0]=="N"){
								$('#tips1').hide();
								$('#tips2').hide();
								$("#selever").hide();
								TINY.box.show_spot('The address you choose is not included in this restaurant. View the dining room that can be served as scheduled，please press<a href="spot.php?spotID='+spot+'&circleID='+circle+'">here</a>。',0,160,60,0,0);
							}else{
								$('#tips1').show();
								$('#tips2').show();
								$("#selever").show().html(rs[1]);
								$("#rest").html(rs[2]);
							}
						
					});
	   })
	})
	$(function(){
	   $("#spot1").change(function(){
		   var spot=$("#spot1").val();
		    var circle=$("#circle1").val();
			var shopCircle=$("#shopCircle").val();
			 var pay=$("input:radio[name='pay']:checked").val();
			$.post("userorder.ajax.php", { 
						'spot' :  spot,
						'circle' :  circle,
						'pay' :  pay,
						'shopCircle' : shopCircle,
						'shop'  : <?php echo $shopID?>,
						'act':'getFee'
					}, function (data, textStatus){
						
							var rs;
							rs=data.split('|');
							if (rs[0]=="N"){
								$('#tips1').hide();
								$("#selever").hide();
								$('#tips2').hide();
								TINY.box.show_spot('The address you choose is not included in this restaurant. View the dining room that can be served as scheduled，please press，please press<a href="spot.php?spotID='+spot+'&circleID='+circle+'">here</a>。',0,160,60,0,0);
							}else{
								$('#tips').show();
								$('#tips2').show();
								$("#selever").show().html(rs[1]);
								$("#rest").html(rs[2]);
							}
						
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
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center">
				<div id="orderBox">
					<div class="order_title">Submit Order</div>
					<div class="table" style="position:relative;z-index:100;">
							<div class="returnCart"><a href="index.php">Return to modify shopping cart</a></div>
							<table>
								<tr>
									<td width="135" class="metal">Order time</td>
									<td width="365" class="metal borderLeft">Restaurant name</td>
									<td width="137" class="metal borderLeft">Takeaway dishes</td>
									<td width="100" class="metal borderLeft">Amount</td>
									<td width="177" class="metal borderLeft">Status</td>
		
								</tr>
							<?php
								$time=date("Y-m-d");
								$sql="select shop_name from qiyu_shop where shop_id=".$shopID." and shop_status='1'";
								$rs=mysql_query($sql);
								$row=mysql_fetch_assoc($rs);
								if ($row){
							?>
								<tr>
									<td class="borderBottom borderLeft" ><?php echo $time?></td>
									<td class="borderBottom borderLeft"><?php echo $row['shop_name']?></td>
									<td class="borderBottom borderLeft"><a href="javascript:void();" id="showIntro" class="red" style="">Check detail
										<div class="cartBox" id="cartBox" style="display:none;position:absolute;left:440px;top:47px;z-index:500;">
											<div class="table">
												<table>
													<tr>
														<td width="168">Dis name</td>
														<td width="114">price</td>
														<td width="66">quantity</td>
													</tr>
													<?php
														$cur_cart_array = explode("///",$_COOKIE['qiyushop_cart']);

														foreach($cur_cart_array as $key => $goods_current_cart){
															$currentArray=explode("|",$goods_current_cart);
															$cookieShopID=$currentArray[0];
															$cookieFoodID=$currentArray[1];
															$cookieFoodCount=$currentArray[2];
															if ($shopID==$cookieShopID){
																$sql="select * from qiyu_food where food_id=".$cookieFoodID." and food_shop=".$cookieShopID;
																$rs=mysql_query($sql);
																$rows=mysql_fetch_assoc($rs);
																if ($rows){
																	if ($orderType=="group")
																		$foodPrice=$rows['food_groupprice'];
																	else
																		$foodPrice=$rows['food_price'];
													?>
																	<tr>
																		<td><?php echo $rows['food_name']?></td>
																		<td><?php echo $foodPrice?></td>
																		<td><?php echo $cookieFoodCount?></td>
																	</tr>
													<?php
																}

															}
														}
														
															
														
													?>
													
													<tr>
														
														<td colspan='3' style="border:0;text-align:right;"><a href="index.php">Return to cart</a></td>
													</tr>
												</table>
											</div>
										</div>
														
									
									</a></td>

									<td class="borderBottom borderLeft"><?php echo $total?></td>
									<td class="borderBottom borderRight borderLeft red">
										The order will be placed
									</td>
									
								</tr>
							<?php
								}		
							?>
								
							</table>
							
					</div>
					<form method="post" action="userorder_do.php?shopID=<?php echo $shopID?>&shopSpot=<?php echo $shopSpot?>&circleID=<?php echo $shopCircle?>" id="submitForm">
					<div class="order_title order_title_r" >Your contact：</div>
					<div class="clear"></div>
					<?php
						if (!empty($QIYU_ID_USER) && empty($_SESSION['qiyu_temporary'])){
							
					?>
						<div id="ajaxAddress" >
						<?php
							
							$sql="select * from qiyu_useraddr where  useraddr_user =".$QIYU_ID_USER."  order by useraddr_type asc,useraddr_id desc";
							$rs=mysql_query($sql);
							$count=mysql_num_rows($rs);
							if($count>0){		
								while ($rows=mysql_fetch_assoc($rs)){
						?>
								<div class="order_infor arList"><input type="radio"  name="addressList" value="<?php echo $rows['useraddr_id']?>" <?php if ($rows['useraddr_type']=='0') echo "checked"?>/> <?php echo $rows['useraddr_address']?></div>
						<?php
								}	
							
						?>
						</div>
						<?php
							}else{//登陆后在该地标下无订餐时
								echo'<p style="color:red;margin-top:10px;margin-left:30px;">Your delievery address record</p>';
						?>
						<?php
							}
						?>
						<div class="order_infor arList"><input type="radio" name="addressList" value="0" /> Add new address</div>
						<div id="addressNew" style="display:none;margin-left:30px;" >
						<!--<div class="contact"><label>Your name：</label><input type="text" name="name1" id="name1" class="input" />
						</div>-->
						<div class="contact contact_r" >
								<label>Your phone：</label><input type="text" id="phone1" name="phone1" class="input" value="<?php echo $user_phone?>"/> <span>The phone number will log in as you<?php echo $SHOP_NAME?>web's account，Please enter your usual mobile number</span>
						</div>
						
						<div class="contact"><label>Address：</label><input type="text" id="address1" name="address1" class="input input270"/></div>
						</div>
					<?php
						}else{	
					?>
						<!--一下是没登录的显示-->
						<div class="contact"><label>Your name：</label><input type="text" name="name" id="name" class="input"/></div>
						
						<div class="contact contact_r" >
							<label>Your phone number：</label><input type="text" id="phone" name="phone" class="input"/> <span>The phone number will log in as you<?php echo $SHOP_NAME?>'s account，Please enter your usual mobile number</span>
						</div>
						
						<div class="clear"></div>
						<div class="contact"><label>Address：</label><input type="text" id="address" name="address" class="input input270"/></div>
					<?php
						}	
					?>
					<div class="clear"></div>
					<div class="order_title order_title_r" style="margin-top:30px">Confirm Order Information：</div>
					
					<div class="orderInfor" >Takeaway goods：CA$ <?php echo $total?> <span id='tips1' <?php if (empty($shopSpot) && empty($shopCircle)) echo "style='display:none;'"?>>|</span><span id="selever" >Delievery fee：<?php echo $str;?> </span><?php if (!empty($QIYU_ID_USER)){?><!--<span>|</span><span id="feeValue">饭点抵扣0 </span>--><?php }?><!-- <?php if (strpos($shop_pay,'|1|')!==false){?><span class="red">pay online to get free delievery</span><?php }?>--> </div>
					<!--
					<?php if ($shop_discount!='0.00'){?>
						<div class="orderInfor" >
							Price after discount：CA$ <?php echo $total_discount?> <span style="margin-left:10px;">(Some items such as beverage staples do not participate in the discount, and the final price is subject to the SMS message.)</span>
						</div>
						
					<?php }?> -->
					<div class="orderInfor" id='tips2' >You have to pay for this order. : <b id="rest"> CA$ <?php echo $totalAll;?></b>。</div>
					
					<!--<div class="orderInfor" >Payment method <?php if (strpos($shop_pay,'|1|')!==false){?><input type="radio" name="pay" value='1' <?php if ($payCount==1  || strpos($shop_pay,"|1|")!==false) echo "checked"?>/> Onlie<?php }?> <?php if (strpos($shop_pay,'|0|')!==false){?><input type="radio" name="pay" value='0' <?php if ($payCount==1) echo "checked"?>/> Pay after delievery<?php }?> </div> -->
					<div class="submit">
					<input type="image" id="ordertijiao" src="images/button/sure_order.jpg" OnClick="return checkOrder()"/>
					<input type="hidden" id="insert" name="insert" value="0" />
					<?php 
						if (empty($QIYU_ID_USER))
							echo "<input type=\"hidden\" id=\"submitType\" name=\"submitType\" value=\"1\" />";
						else
							echo "<input type=\"hidden\" id=\"submitType\" name=\"submitType\" value=\"0\" />";
					
					?>
					<input type="hidden" id="ddddddddddddddd" />
					<input type="hidden" id="shopCircle" name="shopCircle" value="<?php echo $shopCircle?>"  />
					</div>
					</form>
				</div>
				
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
<script type="text/javascript">
	$(function(){				
			$("#ordertijiao").hover(function(){
				//alert('23');
				$(this).attr('src','images/button/sure_order_1.jpg');
			 },function(){
				$(this).attr('src','images/button/sure_order.jpg');
		});
		$("#search_button").mousedown(function(){
			 $(this).attr('src','images/button/sure_order.jpg');			  
		});
		

		
})
</script>

