<?php
	/**
	 *  foodtype.php  
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
  <title> Menu category </title>
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
					<h1>Menu Category</h1>
					<div id="introAdd">
						<form method="post" action="shop_do.php?act=addfoodtype">
						
						<p style='position:relative;'><label>Foodtype</label><input type="text" id="foodtype" name="foodtype" class="input input_87"/><span>&nbsp;(example: chinese)</span> <input type="submit" value="Add" onClick="return check()" style="position:absolute;left:310px;"/></p>
						</form>
						<div class="moneyTable feeTable" style="width:668px;">
							<form name="listForm" id="listForm" method="post" action="shop_do.php?act=savefoodtype">
							<table>
								<tr>
									<td class='center'>Category name</td>
									<td class="center">Sort</td>
									<td  class='center'>Operation</td>
								</tr>
						<?php
						$sql="select * from ".WIIDBPRE."_foodtype where foodtype_shop=".$QIYU_ID_SHOP." order by foodtype_order asc,foodtype_id desc";
						$rs=mysql_query($sql);
						$count=mysql_num_rows($rs);
						if($count=='0'){
							echo '<tr><td colspan="3"  class="center">No info</td></tr></table>';
						}else{
							$i=0;
							while($rows=mysql_fetch_assoc($rs)){
								$i++;
						?>
							<tr>
								<input type="hidden"  name="id<?php echo $i?>" value="<?php echo $rows['foodtype_id']?>" />
								<td class="center"><input type="text" name="foodtypename<?php echo $i?>" value="<?php echo $rows['foodtype_name']?>" /></td>
								<td class="center"><input type="text" size="4" name="order<?php echo $i?>" value="<?php echo $rows['foodtype_order']?>" /></td>
								<td class="center" style='padding:5px 0;'><a href="food.php?foodtype=<?php echo $rows['foodtype_id']?>">check menu</a>&nbsp;&nbsp;<a href="javascript:if(confirm('Confirm delete?')){location.href='shop_do.php?act=delfoodtype&id=<?php echo $rows['foodtype_id'];?>'}">Deleted</a></td>
							</tr>
						<?php
							}
						?>
						
						</table><input name="i" type="hidden" value="<?php echo $i ?>">
						<?php
						}	
						?>
						<p><input type="submit" value="Confirm"/></a></p>
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
  <script type="text/javascript">
	function check(){
		var f=$('#foodtype').val();
		if(f=="")
		{
			alert('Category can not be empty');
			$('#foodtype').focus();
			return false;
		}
	}
</script>

</html>
