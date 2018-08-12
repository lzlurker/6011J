<?php

	require_once("usercheck2.php");
	$uid=empty($_GET['uid'])?'':$_GET['uid'];
	if($uid){
		$key=empty($_GET['key'])?'0':$_GET['key'];
		$start=empty($_GET['start'])?'':$_GET['start'];
		$end=empty($_GET['end'])?'':$_GET['end'];
		$name=empty($_GET['name'])?'':$_GET['name'];
		$phone=empty($_GET['phone'])?'':$_GET['phone'];
		$order=empty($_GET['order'])?'':$_GET['order'];
		$url="&start=".$start."&end=".$end."&name=".$name."&phone=".$phone."&order=".$order."&uid=".$uid;
	}else{
		$key=empty($_GET['key'])?'0':$_GET['key'];
	}
	
	$id=sqlReplace(trim($_GET['id']));
	$id=checkData($id,"ID",0);
	
	$act=empty($_GET['act'])?'0':$_GET['act'];
	if ($act=="add"){
		$intro=HTMLEncode($_POST['content']);
		$oldinfo=$_POST['info'];
		$info=$oldinfo.$intro;
		$sql="update qiyu_order set order_infor='".$info."' where order_id=".$id;
		mysql_query($sql);
		//添加订单记录
		$orderContent="<span class='greenbg'><span><span>添加备注</span></span></span>".$intro;
		addOrderType($order,HTMLEncode($orderContent));
		//addOrderType($order,$intro);
		alertInfo('Add successful','',1);
	}

	
	if ($act=="next"){//确认下一个订单
		$sql="select order_id from qiyu_order order by order_id asc limit 0,1";
		$rs=mysql_query($sql);
		$row=mysql_fetch_assoc($rs);
		if($row['order_id']>$id)
			alertInfo("Last new order","",1);
		$sql="select * from qiyu_order where order_id=".$id." and order_status=0";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if(!$row){
			//alertInfo('该状态下订单不存在','',1);
		}else{
			$order=$row['order_id2'];
			$sql2="update qiyu_order set order_status='1' where order_id=".$id." and order_status=0";
			if(mysql_query($sql2)){
				//添加订单记录
				$orderContent="<span class='greenbg'><span><span>Ordering</span></span></span>";
				$orderContent.="Cooking！";
				addOrderType($order,HTMLEncode($orderContent));
			}else{
				alertInfo('Failed, check SQL','order.php?key=0',0);
			}
		}
	}
	if ($act=="qr"){//确认订单
		$sql="select * from qiyu_order where order_id=".$id." and order_status=0";
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if(!$row){
			$sta=getOrderKey($id);
			alertInfo('Illegal',"",1);
		}else{
			$order=$row['order_id2'];
			$sql2="update qiyu_order set order_status='1'  where order_id=".$id." and order_status=0";
			if(mysql_query($sql2)){
				//添加订单记录
				$orderContent="<span class='greenbg'><span><span>我们正在下单</span></span></span>";
				$orderContent.="Cooking！";
				addOrderType($order,HTMLEncode($orderContent));
				alertInfo('Confirm！','',1);
			}else{
				alertInfo('Failed, check SQL','userorder.php?key=0',0);
			}
		}
	}
	if ($act=="qx"){//取消订单
			
			$sql="select * from qiyu_order where order_id=".$id." and order_status in(0,1)";
			
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				$sta=getOrderKey($id);
				alertInfo('Illegal operation',"useruserorder.php?key=$sta",0);
			}else{
				$order=$row['order_id2'];
				
				if($key=='0'){
					$sql2="update qiyu_order set order_status='2'  where order_id=".$id." and order_status='0'";
				}else{
					$sql2="update qiyu_order set order_status='2' where order_id=".$id." and order_status='1'";
				}
				
				if(mysql_query($sql2)){
					//添加订单记录
					$orderContent="<span class='greenbg redbg'><span><span>取消订单</span></span></span>";
					$orderContent.="Order canceled。";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Canceled！','',1);
				}else{
					$sta=getOrderKey($id);
					if($sta=='1'){
						alertInfo('Failed, check SQL',"userorder.php?key=1",0);
					}else{
						alertInfo('Failed, check SQL',"userorder.php?key=0",0);
					}
				}
			}
	}
	
	if ($act=="wc"){//完成订单
		$sql="select * from qiyu_order where order_id=".$id." and order_status=1";
		
		$result=mysql_query($sql);
		$row=mysql_fetch_assoc($result);
		if(!$row){
			$sta=getOrderKey($id);
			alertInfo('Illegal operation',"userorder.php?key=$sta",0);
		}else{
			$order=$row['order_id2'];
			$sql2="update qiyu_order set order_status='4'  where order_id=".$id." and order_status=1";
			
			if(mysql_query($sql2)){
					//添加订单记录
				$orderContent="<span class='greenbg'><span><span>订单已完成</span></span></span>";
				$orderContent.="Enjoy".$SHOP_NAME."Thanks。";
				addOrderType($order,HTMLEncode($orderContent));
				alertInfo('Done！','',1);
			}else{
				alertInfo('Failed, check SQL','userorder.php?key=1',0);
			}	
		}
	}
	

	$sql="select * from  qiyu_order  inner join qiyu_useraddr on useraddr_id=order_useraddr and order_id=".$id;
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
	if ($rows){
		$userName=$rows['useraddr_name'];
		$userPhone=$rows['useraddr_phone'];
		$userAddress=$rows['useraddr_address'];
		$spotID=$rows['useraddr_spot'];
		$totalAll=$rows['order_totalprice'];
		$total=$rows['order_price'];
		$deliverfee_r=$rows['order_deliverprice'];
		$order=$rows['order_id2'];

		$orderTime=$rows['order_addtime'];
		$state=$orderState[$rows['order_status']];
		$order_state=$rows['order_status'];
		$ordeText=$rows['order_infor'];
		$text=$rows['order_text'];//餐饮要求
		$address=$rows['order_address'];//订单地址
		$type=$rows['order_type'];//订单地址
		$subtime=$rows['order_time1'].'&nbsp;'.$rows['order_time2'];
		if ($rows['order_ispay']=='1')
			$isPay="Waiting payment";
		else if ($rows['order_ispay']=='2')
			$isPay="Payment successful";
		else
			$isPay='';
	}
	$sql="select order_id from qiyu_order where order_id<".$id." and order_status='0' order by order_id desc  limit 1";
	$rs=mysql_query($sql);
	$row=mysql_fetch_assoc($rs);
	if ($row){
		$nextID=$row['order_id'];
		$last=false;
	}else{
		$last=true;
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript" src="js/shopadd.js"></script>
  <title> Order details</title>
 </head>
 <body>
 <div id="container">
	<?php
		require_once('header.php');
	?>
	<div id="main">
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center main_center_r">
				<div id="shopLeft">
					<?php
						require_once('left.inc.php');
					?>
				</div>
				<div id="shopRight">
					
					
					<h1>Order details</h1>	
					<div id="introAdd">
						<p>Order number：<?php echo $order." ".$isPay?></p>
						<p>Order time：<?php echo $orderTime?></p>
						<p>Order state：<?php echo $state?></p>
						<?php
							if ($type=='1'){
								echo "<p>预约时间：".$subtime."</p>";
							}
						?>
						<p>Requirements：<?php echo $text?></p>
						<p>Notes：<?php echo $ordeText?></p>
						<p>User address：<?php echo $address?> </p>
						<p>User name：<?php echo $userName?></p>
						<p>User phone number：<?php echo $userPhone?></p>
						<p>
						<?php
						
								
							if($order_state=='0'){
								echo "<input type=\"submit\" value=\"Confirm order\" onClick=\"location.href='userordercontent.php?key=".$key."&id=".$id."&act=qr';return false;\" />&nbsp;";
							}
							if($key=='0'){
								echo "<input type=\"submit\" onClick=\"location.href='userordercontent.php?key=".$key."&id=".$nextID."&act=next';return false;\"   value=\"Next order\"/>&nbsp;";
							}
							if($order_state=='0'||$order_state=='1'){
								echo "<input type=\"submit\" value=\"Cancel order\" onClick=\"location.href='userordercontent.php?key=".$key."&id=".$id."&act=qx';return false;\" />&nbsp;";
							}
							
							if($order_state=='1'){
								echo "<input type=\"submit\" value=\"Done\" onClick=\"location.href='userordercontent.php?key=".$key."&id=".$id."&act=wc';return false;\" />&nbsp;";
							}
							
							
						
						?>
						</p>
						
						
					</div>
					<div class="moneyTable feeTable" style="width:668px;">
							<table width="100%">
								<tr>
									<td class="center">Name</td>
									<td class="center">Price</td>
									<td class="center">Amount</td>
									<td class="center">Note</td>
									<td class="center">Operation</td>
								</tr>
								<?php
					$sql="select * from qiyu_cart inner join qiyu_food on food_id=cart_food and cart_order='".$order."' and cart_status='1'";
					$rs=mysql_query($sql);
					while ($rows=mysql_fetch_assoc($rs)){
						//$total+=$rows['cart_price']*$rows['cart_count'];
				?>
						<tr>
							<td class='padding-left'><?php echo $rows['food_name']?></td>
							<td class='padding-left'><?php echo $rows['cart_price']?></td>
							<td class='padding-left'><?php echo $rows['cart_count']?></td>
							<td class='padding-left'><?php echo $rows['cart_desc']?></td>
							<td></td>
						</tr>
				<?php
					}
				
					
					//消费的积分
					$sql="select * from qiyu_rscore where rscore_order='".$order."' and (rscore_type='0' or rscore_type='1')";
					$rs=mysql_query($sql);
					$rows=mysql_fetch_assoc($rs);
					if ($rows){
						$score=$rows['rscore_spendvalue'];
					}
					else
						$score=0;
				?>
						<tr>
							<td colspan='5' style="text-align:right;padding-right:100px;height:30px; font-size:15px; color:red">Total price：<?php echo $totalAll?>Dollar</td>
						</tr>
						<tr>	
							<td colspan='5' style="text-align:right;padding-right:100px;height:30px; font-size:15px; color:red">Dish price：<?php echo $total?>Dollar</td>
						</tr>
						<tr>	
							<td colspan='5' style="text-align:right;padding-right:100px;height:30px; font-size:15px; color:red">Delivery fee：<?php echo $deliverfee_r?>Dollar</td>
						</tr>
						<?php if ($score>0){?>
						<tr>	
							<td colspan='5' style="text-align:right;padding-right:100px;height:30px; font-size:15px; color:red">Consume：<?php echo $score?></td>
						</tr>
						<?php
							}
						?>
						<tr>	
							<td colspan='5' style="text-align:right;padding-right:100px;height:30px; font-size:15px; color:red">To pay：<?php echo $totalAll-$score?>Dollar</td>
						</tr>
							</table>

							<p style="margin-top:10px;">
								<a href="javascript:void();" onclick="$('#editBox').css('display','block');"><img src="../images/button/update_order.jpg" alt="Modify order" /></a> <img src="../images/button/return.jpg" alt="return" style='cursor:pointer' onClick="javascript:history.back();"/>
							</p>
						
						</div>

						
						<div id="editBox" style="display:none;">
							<form method="post" action="userordercontent.php?id=<?php echo $id?>&act=add&key=<?php echo $key?>&changetype=<?php echo changetype?>&hurry=<?php echo $hurry?>">
							
						
							<p style='margin-top:17px;margin-left:10px;'>Add notes</p>
							<input type="hidden" id="info" name="info" value="<?php echo $ordeText;?>" />
							<p style='margin-top:10px;margin-left:10px;'><textarea name="content" style="width:350px;height:100px;"></textarea></p>
							<p  style='margin-top:10px;margin-left:10px;'><input type="image" src="../images/button/submit_t.jpg" /></p>
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
