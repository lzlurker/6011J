<?php

	require_once("usercheck2.php");
	$tel=empty($_GET['tel'])?'':sqlReplace(trim($_GET['tel']));

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <title> Order analysis</title>
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
					<?php
						echo "Order analysis";

					?>
					</h1>
					<div id="introAdd">
						<div class="moneyTable feeTable" style="width:668px;">
						
						
							
							<table width="100%">
								<tr>
									<td class="center" width='10%' height="30px;">date</td>
									<td class="center" width='10%' height="30px;">today</td>
									<td class="center" width='10%'>this week</td>
									<td class="center" width='5%'>this month</td>
								</tr>
								 <?php 
								    //当天的订单情况(包含预约订单数)
									function getRd($a){
										$sql="select count(order_id2) as c, order_status from  qiyu_order where order_status=".$a." and date(order_addtime) = curdate()";
										$rs=mysql_query($sql);
										$rows=mysql_fetch_assoc($rs);
										return $rows['c'];
									}
                                    //当天的预约订单数
									function getRdsub($a){
										$subsql="select count(order_id2) as c, order_status from  qiyu_order where order_type='1' and order_status=".$a." and date(order_addtime) = curdate()";
										$subrs=mysql_query($subsql);
										$subrows=mysql_fetch_assoc($subrs);
										return $subrows['c'];
									}
									  //计算今天的订单总额
									  $sql="select sum(order_totalprice) as s from qiyu_order where date(order_addtime) = curdate()";
									  $rs=mysql_query($sql);
									  $rds=mysql_fetch_assoc($rs);
                                      
									  //最近7天的订单情况(包含预约订单数)
									  function getRw($a){										
										$sql="select count(order_id2) as c, order_status from  qiyu_order where order_status=".$a." and   YEARWEEK(date_format(order_addtime,'%Y-%m-%d')) = YEARWEEK(now())"; 
										//echo $sql;
										$rs=mysql_query($sql);
										$rows=mysql_fetch_assoc($rs);
										return $rows['c'];
									  }	

                                      //最近7天的预约订单数
									   function getRwsub($a){
										$sql="select count(order_id2) as c, order_status from  qiyu_order where order_type='1' and order_status=".$a." and YEARWEEK(date_format(order_addtime,'%Y-%m-%d')) = YEARWEEK(now())";
										$rs=mysql_query($sql);
										$rows=mysql_fetch_assoc($rs);
										return $rows['c'];
									  }	
									  //计算最近7天的订单总额
									  $sql2="select sum(order_totalprice) as s from qiyu_order where YEARWEEK(date_format(order_addtime,'%Y-%m-%d')) = YEARWEEK(now())";
									  $rs2=mysql_query($sql2);
									  $rws=mysql_fetch_assoc($rs2);
                                      

									  //最近30天的订单情况(包含预约订单数)
									  function getRm($a){
										$sql3="select count(order_id2) as c, order_status from  qiyu_order where order_status=".$a." and  date_format(order_addtime,'%Y-%m')=date_format(now(),'%Y-%m')";
										$rs3=mysql_query($sql3);
										$rows=mysql_fetch_assoc($rs3);
										return $rows['c'];
									   }

									   //最近30天的预约订单数									   
									  function getRmsub($a){
										$sql3="select count(order_id2) as c, order_status from  qiyu_order where order_type='1' and order_status=".$a." and date_format(order_addtime,'%Y-%m')=date_format(now(),'%Y-%m')";
										$rs3=mysql_query($sql3);
										$rows=mysql_fetch_assoc($rs3);
										return $rows['c'];
									   }

									  //计算最近30天的订单总额 
									  $sql3="select sum(order_totalprice) as s from qiyu_order where date_format(order_addtime,'%Y-%m')=date_format(now(),'%Y-%m')";
									  $rs3=mysql_query($sql3);
									  $rms=mysql_fetch_assoc($rs3);
								 ?>
								<tr>
								    <td class="center" style="height:30px;">Number of orders cancelled by owner</td>
									<td class="center" style="height:30px;"><?php echo getRd(2);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(2);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(2);?></td>
							    </tr>
								<tr>
								    <td class="center" style="height:30px;">Number of orders cancelled by user</td>
									<td class="center" style="height:30px;"><?php echo getRd(3);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(3);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(3);?></td>
							    </tr>
							    <tr>
									<td class="center" style="height:30px;">Confirmed orders</td>
									<td class="center" style="height:30px;"><?php echo getRd(1);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(1);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(1);?></td>
								</tr>
								<tr>
									<td class="center" style="height:30px;">Finished orders</td>
									<td class="center" style="height:30px;"><?php echo getRd(4);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(4);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(4);?></td>
								</tr>
								<tr>
									<td class="center" style="height:30px;">Booked orders</td>
									<td class="center" style="height:30px;"><?php echo getRdsub(0);?></td>
									<td class="center" style="height:30px;"><?php echo getRwsub(0);?></td>
									<td class="center" style="height:30px;"><?php echo getRmsub(0);?></td>
								</tr>
								<tr>
									<td class="center" style="height:30px;">New orders</td>
									<td class="center" style="height:30px;"><?php echo getRd(0)-getRdsub(0);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(0)-getRwsub(0);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(0)-getRmsub(0);?></td>
								</tr>
								
								<tr>
									<td class="center" style="height:30px;">Total orders</td>
									<td class="center" style="height:30px;"><?php echo getRd(0)+getRd(1)+getRd(2)+getRd(3)+getRd(4);?></td>
									<td class="center" style="height:30px;"><?php echo getRw(0)+getRw(1)+getRw(2)+getRw(3)+getRw(4);?></td>
									<td class="center" style="height:30px;"><?php echo getRm(0)+getRm(1)+getRm(2)+getRm(3)+getRm(4);?></td>
								</tr>
								<tr>
									<td class="center" style="height:30px;">Total amounts</td>
									<td class="center" style="height:30px;"> <?php echo $rds['s'];?></td>
									<td class="center" style="height:30px;"> <?php echo $rws['s'];?></td>
									<td class="center" style="height:30px;"> <?php echo $rms['s'];?></td>
								</tr>
											
							</table>
						
						</div>
												
						
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
