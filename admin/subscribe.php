<?php
	/**
	 * subscribe.php
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");
	$ao=empty($_GET['ao'])?'':$_GET['ao'];
	$page=empty($_GET['page'])?'':$_GET['page'];
	
	$uid=empty($_GET['uid'])?'':$_GET['uid'];
	$start=empty($_GET['start'])?'':$_GET['start'];
	$end=empty($_GET['end'])?'':$_GET['end'];
	$name=empty($_GET['name'])?'':$_GET['name'];
	$phone=empty($_GET['phone'])?'':$_GET['phone'];
	$order=empty($_GET['order'])?'':$_GET['order'];
	$url="&start=".$start."&end=".$end."&name=".$name."&phone=".$phone."&order=".$order."&uid=".$uid;
     
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
<meta name="Author" content="iEat"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"/>
<script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../js/tree.js" type="text/javascript"></script>
<script type="text/javascript" src="js/upload.js"></script>
<title> User order </title>
<script type="text/javascript"> 
  function check_all(obj,cName){  
    var checkboxs = document.getElementsByName(cName);  
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}  
}  
</script>
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
						echo "Booked order";

					?>
					</h1>
					<div id="introAdd">
						<div class="moneyTable feeTable" style="width:668px;">
						<form id="listForm" name="listForm" method="post" >
							<table width="100%">
								<tr>
								    <td class="center" style="width:8%;text-align:left; padding:6px 1%;" class="center">
										<input type="checkbox" value="Select all"  onclick="check_all(this,'idlist[]')">Select all
									</td>
									<td class="center" width='10%'>Order number</td>
									<td class="center" width='10%'>Phone number</td>
									<td class="center" width='5%'>Booked time</td>
									<td class="center" width='5%'>Order time</td>									
									<td class="center" width='10%'>Total amount</td>
									<td class="center" width='10%'>Total price</td>
									<td class="center" width='10%'>Order state</td>
									<td class="center" width='40%'>Operation</td>
								</tr>
								<?php
									$where='';
									$pagesize=20;
									$startRow=0;
									
									$sql="select * from qiyu_order where order_type='1' and order_status='0'";
									
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
									
									$sql="select * from qiyu_order where order_type='1' and order_status='0'  order by order_id desc limit $startRow,$pagesize";
									
									$rs=mysql_query($sql);
									if ($rscount==0){ 
										echo "<tr><td colspan='9' class='center'>No info</td></tr>";
									}else{
										while($rows=mysql_fetch_assoc($rs)){
											$onLine=$rows['order_ispay'];
											if ($rows['order_ispay']=='1')
												$isPay="Waiting payment";
											else if ($rows['order_ispay']=='2')
												$isPay="Payment successful";
											else
												$isPay='';
											
											if($rows['order_shopid'])//shopid 不为空
												$sql_s="select * from qiyu_shop where shop_id=".$rows['order_shopid'];
											else                       //shopid 为空
												$sql_s="select * from qiyu_shop where shop_id2='".$rows['order_shop']."'";
											$rs_s=mysql_query($sql_s);
											$row_s=mysql_fetch_assoc($rs_s);
											$count_s=mysql_num_rows($rs_s);
											if($row_s){
												$shopname=$row_s['shop_name'];
												$shoptype=$row_s['shop_type'];
												if($shoptype=='1')
													$shoptype='Unsign';
												if($shoptype=='0')
													$shoptype='Signed';
											}else{
												$shopname='---';
												$shoptype='---';
											}
											//查询用户
											$sql_u="select * from qiyu_useraddr where useraddr_id=".$rows['order_useraddr'];
											$rs_u=mysql_query($sql_u);
											$row_u=mysql_fetch_assoc($rs_u);
											if($row_u){
												$userphone=$row_u['useraddr_phone'];
											}else{
												$userphone='---';
											}
											$state=$rows['order_status'];// 订单状态
											$orderid=$rows['order_id'];
											$orderid2=$rows['order_id2'];
											$subtime=$rows['order_time1'].'<br/>'.$rows['order_time2'];
											$orderaddtime=$rows['order_addtime'];
											$ordertotalprice=$rows['order_totalprice'];
											$orderfoodprice=$rows['order_price'];
											$orderdeliverprice=$rows['order_deliverprice'];
											$orderuserphone=$rows['order_userphone'];
											$orderpricechange=$rows['order_pricechange'];//变更价格
											$orderoperator=$rows['order_operator'];//操作员
											if(!empty($orderpricechange) && $orderpricechange!='0.00'){
												//	$totalprice=$orderpricechange;
											}else{
													$orderpricechange='NA';
											}
											if($orderuserphone=='')
												$orderuserphone=$userphone;
										
									?>
									
								<tr>
                                <td class="center"><input type="checkbox" class="ipt" name="idlist[]" id="idlist[]" value="<?php echo $rows['order_id'];?>"></td>
								<td class="center"><a href="userordercontent.php?id=<?php echo $rows['order_id']?><?php echo $url?>"><?php echo $rows['order_id2']?></a></td>
								<td class="center"><?php echo $rows['order_userphone']?></td>
								<td  class="center" ><?php echo $subtime?></td>
								<td class="center" ><?php echo $rows['order_addtime']?></td>
								<td class="center"><?php echo $rows['order_totalprice']?></td>
								<td class="center"><?php echo $rows['order_price']?></td>
								<td class="center"><?php echo $orderState[$rows['order_status']]?></td>
								<td class="center">
									<?php if ($state=='0' || $state=='1'){?><a href="javascript:if(confirm('您确定要取消该订单吗？')){location.href='userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=qx&ao=<?php echo $ao?>'}">Cancel order</a><?php }?> 
									<?php if ($state=='0'){?><a href="userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=sure&ao=<?php echo $ao?>"><br/>Order confirm</a><?php }?> <?php if ($state=='1'){?><a href="userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=bc&totalprice=<?php echo $rows['order_totalprice']?>&key=<?php echo $key?><?php echo $url?>">备餐订单</a><?php }?>
									<?php if ($state=='5'){?><a href="userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=finish&ao=<?php echo $ao?>"><br/>Order finish</a><?php }?><br/>
									<?php
										if ($state=='0' || $state=='4' || $state=='2' || $state=='3'){	
									?>
									<a href="javascript:if(confirm('Confirm delete')){location.href='userorder_subscribe_do.php?id=<?php echo $rows['order_id']?>&act=del&ao=<?php echo $ao?>'}">Delete</a> 
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
							<?php if(!empty($orderid)){?>
							<p style="margin-right:15px;float:left;">
							    <a href="javascript:if(confirm('Confirm cancel？')){document.listForm.action='userorder_do.php?&act=subqx<?php echo $url?>';document.listForm.submit();}"  title="Cancel"><img src="../images/button/qx.gif" name="btnSave" /></a>
							</p>
							<p style="margin-right:20px;margin-right:20px;float:left;">
								<a href="javascript:if(confirm('Confirm？')){document.listForm.action='userorder_do.php?&act=subsure<?php echo $url?>';document.listForm.submit();}"   title="Confirm"><img src="../images/button/sure.gif" name="btnSave" /></a>
							</p>
							
							<p style="margin-left:15px;">
							    <a href="javascript:if(confirm('Confirm delete?')){document.listForm.action='userorder_do.php?&act=subdel<?php echo $url?>';document.listForm.submit();}"   title="Delete"><img  src="../images/button/delete.gif" name="btnSave" /></a>						
							</p>
						    <?php }?>
				                <!--<input name="i" type="hidden" value="<?=$i?>">-->
							
							</form>
							
							

						<?php 
							if ($rscount>=1){
								echo showPage_admin('subscribe.php?ao='.$ao,$page,$pagesize,$rscount,$pagecount);
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
