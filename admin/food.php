<?php
	/**
	 *  food.php  
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");
	$foodtype=empty($_GET['foodtype'])?'':sqlReplace(trim($_GET['foodtype']));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript" src="js/checkfood.js"></script>
  <title> Menu Management-iEat </title>
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
					<h1>Menu Management
					
					    <?php 
						     if($foodtype!=''){
								$sql="select * from ".WIIDBPRE."_foodtype where foodtype_id=".$foodtype;
								$rs=mysql_query($sql);
								$rows=mysql_fetch_assoc($rs);
								echo '&gt;&gt;'.$rows['foodtype_name'];
								
								/*
								if($rows){
									return $rows;
								}else{
									return 'kong';
								}
                               */
							 }
						   ?></h1>
					<div id="introAdd">
						<div class="moneyTable feeTable" style="width:668px;margin-top:-14px;" >
						<form name="listForm" id="listForm" method="post" action="shop_do.php?act=savefood">
						<p style="margin-bottom:10px;color:red;">Tip: Enter a number in the sort box and click the Save Sort button to sort the menu. </p>
						<p style="margin-bottom:10px;">
						   <a href="foodadd.php?foodtype=<?php echo $foodtype;?>"><img src="../images/button/foodadd.jpg"></a>
						   
						</p>
							<table width="100%">
					<tr>
						<td style="width:8%;text-align:left; padding:6px 1%;"><input type="checkbox" value="全选" onClick="selectBox('reverse')"/><lable><span style="padding-left:6%;">全选</span></lable></td>
						<td class="center">Name</td>
						<td class="center">Price</td>
						<td class="center">Category</td>
						<td class="center">Description</td>
						<td class="center">State</td>
						<td class="center">Sort</td>
						<td class="center">Operation</td>
					</tr>
					<?php
							$where='';
							if (!empty($foodtype)) $where=" and food_foodtype=".$foodtype;
							$pagesize=20;
							$startRow=0;
							$sql="select * from ".WIIDBPRE."_food where food_special is NULL and food_shop=".$QIYU_ID_SHOP.$where;
							$rs = mysql_query($sql) or die ("Fail, check SQL。");
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
							$sql="select * from ".WIIDBPRE."_food where food_shop=".$QIYU_ID_SHOP.$where." and  food_special is NULL order by food_order asc,food_id desc limit $startRow,$pagesize";
							$rs=mysql_query($sql);
							if ($rscount==0){ 
								echo "<tr><td colspan='8' class='center'>暂无信息</td></tr></table>";
							}else{
								$i=0;
								while($rows=mysql_fetch_assoc($rs)){
									$i++;
									//菜所属的大类
									$sql_type = "select foodtype_name from ".WIIDBPRE."_foodtype where foodtype_id=".$rows['food_foodtype']." and foodtype_shop=".$QIYU_ID_SHOP;
									$re_type = mysql_query($sql_type);
									$rows_type = mysql_fetch_assoc($re_type);
							
							
						?>
					<tr>
						<td style="width:8%;text-align:center; padding:4px 1%"><input type="checkbox"  name="delid[]" value="<?php echo $rows['food_id']?>" /></td>
						<td class="padding-left"><a href="foodedit.php?id=<?php echo $rows['food_id']?>&page=<?php echo $page?>"><?php echo $rows['food_name']?></a></td>
						<td class="center"><?php echo $rows['food_price']?></td>
						<td class="center"><?php echo $rows_type['foodtype_name']?></td>
						<td class="center"><?php echo $rows['food_intro']?></td>
						<td class="center"><?php if($rows['food_status']=="0"){echo "Available";}else{echo "NotAvailable";}?></td>
						<td class="center"><input type="text" size="4" name="order<?php echo $i?>" value="<?php echo $rows['food_order']?>" /></td>
						<td class="center" style='padding:5px 0;'> <a href="foodedit.php?id=<?php echo $rows['food_id']?>&page=<?php echo $page?>">update</a> <a href="javascript:if(confirm('您确定要删除吗？')){location.href='shop_do.php?act=delfood&id=<?php echo $rows['food_id'];?>'}">delete</a></td>
					</tr>
						<?php
								}
						?>					
				</table>		
				<p style="margin-bottom:10px;"><input type="image" src="../images/button/save.gif"/><input type="image" src="../images/button/delete.gif" name="btnSave" value="delete" style="margin-left:10px;" onclick="if(!confirm('confirm delete？'))return false;"/></p>
				<input name="i" type="hidden" value="<?=$i?>">
						<?php 
								if ($rscount>=1){
									echo showPage_admin('food.php',$page,$pagesize,$rscount,$pagecount);
								}
							}
						?>
							</form>							
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
