<?php
	
	require_once("usercheck2.php");
	$uid=empty($_GET['uid'])?'':$_GET['uid'];
	$key=empty($_GET['key'])?'0':$_GET['key'];
	$start=empty($_GET['start'])?'':$_GET['start'];
	$end=empty($_GET['end'])?'':$_GET['end'];
	$name=empty($_GET['name'])?'':$_GET['name'];
	$phone=empty($_GET['phone'])?'':$_GET['phone'];
	$order=empty($_GET['order'])?'':$_GET['order'];

	$url="&start=".$start."&end=".$end."&name=".$name."&phone=".$phone."&order=".$order."&uid=".$uid;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
						if ($key!='all'){
							switch ($key)
							{
								case 0:
									echo "New order";
									break;
								case 1:
									echo "Confirm order";
									break;
								case 2:
									echo "Owner cancel order";
									break;
								case 3:
									echo "User cancel order";
									break;
								case 4:
									echo "Finish order";
									break;
								default:
									echo "No item";
							}
							//echo $orderState[$key]; //by lz 20180811
						}else if (!empty($uid)){
							$list=getUser($uid);
							echo $list['user_name']." 's all order";
						}else{
							echo "All order";
						}
					?>
					</h1>
					<div id="introAdd">
					    
						<div class="moneyTable feeTable" style="width:668px;">
						
						<form id="listForm" name="listForm" method="post" >
							<table width="100%" id="listForm" >
								<tr>
									<td class="center" style="width:8%;text-align:left; padding:6px 1%;">
									<input type="checkbox" value="Select all"  onclick="check_all(this,'idlist[]')">Select all
									</td>
									<td class="center">Order number</td>
									<td class="center">User phone number</td>
									<td class="center">Order time</td>
									<td class="center">Total price</td>
									<td class="center">Dish price</td>
									<td class="center">Delivery fee</td>
									<td class="center">Order state</td>
									<td class="center">Operation</td>
								</tr>
								<?php
									$where='';
									/*
									if ($key!="all")
										$where=" and order_status='".$key."'";
								    */
									if ($key!=='0'&&$key!='all')//只要不是新订单，就这样显示
										$where=" and order_status='".$key."'" ;
									if ($key=='0'&&$key!='all')//如果是新订单，就这样显示
										$where=" and order_type!='1' and order_status='".$key."'" ;
									if (!empty($name))
										$where.=" and order_username='".$name."'";
									if (!(empty($start) || empty($end)))
										 $where.=" and date(order_addtime) >= '".$start."' and date(order_addtime) <= '".$end."'";
									elseif (!empty($start) && empty($end))
										$where.=" and date(order_addtime) >= '".$start."'";
									elseif (empty($start) && !empty($end))
										$where.=" and date(order_addtime) <= '".$end."'";
									if (!empty($order))
										$where.=" and order_id2 = '".$order."'";
									if (!empty($phone))
										$where.=" and order_userphone = '".$phone."'";
									if (!empty($uid))
										$where.=" and order_user = ".$uid;
				
									$pagesize=20;
									$startRow=0;
									$sql="select * from qiyu_order where 1=1".$where;
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
									
									$sql="select * from qiyu_order where 1=1".$where."   order by order_id desc limit $startRow,$pagesize";
									$rs=mysql_query($sql);
									if ($rscount==0){ 
										echo "<tr><td colspan='9' class='center'>No info</td></tr>";
									}else{
										//$i=0;
										while($rows=mysql_fetch_assoc($rs)){
											//$i++;
											$state=$rows['order_status'];
											if ($rows['order_ispay']=='1')
												$isPay="Wait for payment";
											else if ($rows['order_ispay']=='2')
												$isPay="Payment successful";
											else
												$isPay='';
										
									?>
								<tr>
									<td class="center" ><input type="checkbox" class="ipt" name="idlist[]" id="idlist[]" value="<?php echo $rows["order_id"]?>" ?></td> 
									<td class="center"><a href="userordercontent.php?id=<?php echo $rows['order_id']?>&key=<?php echo $key?><?php echo $url?>">
									<?php echo $rows['order_id2']?></a></td>
									<td class="center"><?php echo $rows['order_userphone']?></td>
									<td class="center"><?php echo $rows['order_addtime']?></td>
									<td class="center"><?php echo $rows['order_totalprice']?></td>
									<td class="center"><?php echo $rows['order_price']?></td>
									<td class="center"><?php echo $rows['order_deliverprice']?></td>
									<td class="center"><?php echo $orderState[$rows['order_status']]?></td>
									<td class="center">
										<?php if ($state=='0' || $state=='1'){?><a href="javascript:if(confirm('Confirm cancel？')){location.href='userorder_do.php?id=<?php echo $rows['order_id']?>&act=qx&key=<?php echo $key?><?php echo $url?>'}">Order canceled</a><?php }?> 
										<?php if ($state=='0'){?><a href="userorder_do.php?id=<?php echo $rows['order_id']?>&act=sure&key=<?php echo $key?><?php echo $url?>">Order confirmed</a><?php }?> 
										<?php if ($state=='1'){?><a href="userorder_do.php?id=<?php echo $rows['order_id']?>&act=finish&key=<?php echo $key?><?php echo $url?>">Order finished</a><?php }?> 
										<?php
											if ($state=='0' || $state=='4' || $state=='2' || $state=='3'){	
										?>
										<a href="javascript:if(confirm('Confirm delete？')){location.href='userorder_do.php?id=<?php echo $rows['order_id']?>&act=del&key=<?php echo $key?><?php echo $url?>'}">Deleted</a> 
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
							<?php if ($state=='0' || $state=='1' ){?>
							<p style="margin-right:15px;float:left;">
								<a href="javascript:if(confirm('Confirm cancel？')){document.listForm.action='userorder_do.php?&act=xxqx&key=<?php echo $key.$url?>';document.listForm.submit();}"  title="Cancel"><img src="../images/button/qx.gif" name="btnSave" /></a>
							</p>
							<?php }?>
							<?php if ($state=='0'){?>
							<p style="margin-right:15px;float:left;">
								<a href="javascript:if(confirm('Confirm？')){document.listForm.action='userorder_do.php?&act=xxsure&key=<?php echo $key.$url?>';document.listForm.submit();}"   title="Confirm"><img src="../images/button/sure.gif" name="btnSave" /></a>
							</p>
							<?php }?>
							<?php if ($state=='1'){?>
							<p style="margin-right:20px;float:left;">
								<a href="javascript:if(confirm('Confirm finish？')){document.listForm.action='userorder_do.php?&act=xxfinish&key=<?php echo $key.$url?>';document.listForm.submit();}"    title="Done"><img src="../images/button/wancheng.gif" name="btnSave" /></a>
							</p><br/>
							<?php }?>
							<?php if ($state=='0' || $state=='2' || $state=='3' || $state=='4'){?>

							<p>
								<a href="javascript:if(confirm('Confirm delete？')){document.listForm.action='userorder_do.php?&act=xxdel&key=<?php echo $key.$url?>';document.listForm.submit();}"   title="Deleted"><img  src="../images/button/delete.gif" name="btnSave" /></a>			 

								
							</p>
							<?php }?>						
				                <!--<input name="i" type="hidden" value="<?=$i?>">-->							
							</form>
							
							
						<?php 

							if ($rscount>=1){
								echo showPage_admin('userorder.php?key='.$key.$url,$page,$pagesize,$rscount,$pagecount);
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
 <!--
 <script type="text/javascript">
	function check(){
		var f=$('#foodtype').val();
		if(f=="")
		{
			alert('菜单大类不能为空');
			$('#foodtype').focus();
			return false;
		}
	}
	$(function(){
		$("#quxiao").click(function(){
			var ids = '';
			$(".ipt").filter(function(){
				return $(this).attr("checked");
			}).each(function(){
				ids += $(this).val()+",";
			});
			var key = $(this).attr("key");
			if(confirm('您确定要取消吗？')){
       			//alert('userorder_do.php?id='+ids+'&act=qxA&key='+key);return false;
				location.href='userorder_do.php?id='+ids+'&act=qx&key='+key;
				document.listForm.submit();
			}
			return false;
		});
	})
</script>-->

</html>
