<?php
	/**
	 * userorderchange.php
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript" >
	msg2();
	　var int=self.setInterval("msg2()",5000);
		function msg2(){
			$.ajax({
			   type: "POST",
			   url: "msg2.php",
			   data: "",
			   success: function(msg){
					if(msg){
						$("#neworder2").html("("+msg+")");
					}else{
						$("#neworder2").html("");
					}
			   }
			});
		}
	
	</script>
  <title> Quick order</title>
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
					<h1>
						Quick order
					</h1>
					
					<div id="introAdd">
						<p style="margin-left:14px;margin-bottom:-14px;_margin-bottom:-20px;_margin-top:10px;"><a href="userorderchange.php"><span style="color:red;" id="neworder2"></span></a></p>
						<div class="moneyTable feeTable" style="width:668px;">
							<table width="100%">
								<tr>
									<td class="center" width='10%'>Order number</td>
									<td class="center" width='10%'>User phone number</td>
									<td class="center" width='10%'>Order time</td>
									<td class="center" width='10%'>Total amount</td>
									<td class="center" width='10%'>Order state</td>
									<td class="center" width='10%'>Time from now</td>
									<td class="center" width='10%'>State</td>
									<td class="center">Operation</td>
								</tr>
								<?php
									$where='';
									$pagesize=20;
									$startRow=0;
									
									
									$sql="select * from qiyu_order,qiyu_orderchange where orderchange_order=order_id2 and orderchange_type='1' and order_status='5' and roderchange_typechange is NULL ";
									
									$rs = mysql_query($sql) or die ("Failed, check SQL。");
									$rscount=mysql_num_rows($rs);
									if ($rscount%$pagesize==0)
										$pagecount=$rscount/$pagesize;
									else
										$pagecount=ceil($rscount/$pagesize);

									if (empty($_GET['page'])||!is_numeric($_GET['page']))
										$page=1;
									else{
										$page=$_GET['page'];
										if($page<1) $page=1;
										if($page>$pagecount) $page=$pagecount;
										$startRow=($page-1)*$pagesize;
									}
									
									$sql="select * from qiyu_order,qiyu_orderchange where orderchange_order=order_id2 and orderchange_type='1' and order_status='5' and roderchange_typechange is NULL order by order_id limit $startRow,$pagesize";
									
									$rs=mysql_query($sql);
									if ($rscount=='0'){ 
										echo "<tr><td colspan='9' class='center'>No info</td></tr>";
									}else{
									$i=0;
									date_default_timezone_set('PRC');
									while($rows=mysql_fetch_assoc($rs)){
										$i++;
										$onLine=$rows['order_ispay'];
										if ($rows['order_ispay']=='1')
											$isPay="Waiting for payment";
										else if ($rows['order_ispay']=='2')
											$isPay="Payment success";
										else
											$isPay='';
										//查询商家名称
										if($rows['order_shopid'])
											$sql_o="select shop_name,shop_type from qiyu_shop where shop_id=".$rows['order_shopid'];
										else
											$sql_o="select shop_name,shop_type from qiyu_shop where shop_id2='".$rows['order_shop']."'";
										$rs_o=mysql_query($sql_o);
										$row_o=mysql_fetch_assoc($rs_o);
										if($row_o){
											$shop_name=$row_o['shop_name'];
											$shop_type=$row_o['shop_type'];
											if($shop_type=='0')
												$shop_type='Sign';
											if($shop_type=='1')
												$shop_type='Not Sign';
										}else{
											$shop_name='---';
											$shop_type='---';
										}
										//查询用户手机
										$sql_p="select useraddr_phone from qiyu_useraddr where useraddr_id=".$rows['order_useraddr'];
										$rs_p=mysql_query($sql_p);
										$row_p=mysql_fetch_assoc($rs_p);
										if($row_p)
											$user_phone=$row_p['useraddr_phone'];
										else
											$user_phone='---';
										date_default_timezone_set('PRC');
										$diff = time() - strtotime($rows['order_addtime']);//下单时间距离现在的时间
										$time = floor($diff/60);
										$state=$rows['order_status'];
										$userphone=$rows['order_userphone'];
										if($userphone=='')
											$userphone=$user_phone;
										$hurry = $rows['orderchange_hurry'];
										if($hurry=='0'){
											$hurry='30 mins';
										}else if($hurry=='1'){
											$hurry='45 mins';
										}else if($hurry=='2'){
											$hurry='60 mins';
										}else{
											$hurry='---';
										}
										$orderoperator=$rows['order_operator'];//订单操作人员
										$orderpricechange=$rows['order_pricechange'];//订单价格变更
										$ordertype=$rows['order_type'];//订单类型
										if($ordertype=='1'){
											$ordertype='(Book)';
										}else{
											$ordertype='';
										}

										if(!empty($orderpricechange) && $orderpricechange!='0.00'){
												//$totalprice=$orderpricechange;
										}else{
												$orderpricechange='NA';
										}
									?>
								<tr>
									<td class="center"><a href="userordercontent.php?id=<?php echo $rows['order_id']?>&key=<?php echo $rows['order_status']?>&changetype=<?php echo $rows['orderchange_type']?>&hurry=<?php echo $rows['orderchange_hurry']?>"><?php echo $rows['order_id2']?></a></td>
								<td class="center"><?php echo $rows['order_userphone']?></td>
								<td class="center"><?php echo $rows['order_addtime']?></td>
								<td class="center"><?php echo $rows['order_totalprice']?></td>
								<td class="center"><?php echo $orderState[$rows['order_status']]?></td>
								<td class="center"><?php echo $time?></td>
								<td class="center"><?php echo $hurry?></td>
								<td class="center">
									<?php if ($state=='0' || $state=='1'){?><a href="javascript:if(confirm('Confirm cancel？')){location.href='userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=qx'}">Cancel order</a><?php }?> 
									<?php if ($state=='0'){?><a href="userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=sure">Order confirm</a><?php }?> 
									<?php if ($state=='1'){?><a href="userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=finish">Order finish</a><?php }?>
									<?php
										if ($state=='0' || $state=='4' || $state=='2' || $state=='3'){	
									?>
									<a href="javascript:if(confirm('Confirm delete？')){location.href='userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=del'}">Delete</a> 
									<?php
										}	
									?>
								</td>
								</tr>
									<?php
											}
									}
									?>					
							</table>
						<?php 
							if ($rscount>=1){
								echo showPage_admin('userorderchange.php',$page,$pagesize,$rscount,$pagecount);
							}
						?>
							
						</div>
						
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
