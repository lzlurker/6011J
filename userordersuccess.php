<?php
	
	require_once("usercheck2.php");
	$id=sqlReplace(trim($_GET['id']));
	$POSITION_HEADER="Submit Order";
	$sql="select * from qiyu_order where order_id2='".$id."'";
	$rs=mysql_query($sql);
	$row=mysql_fetch_assoc($rs);
	if ($row){
		$total=$row['order_totalprice'];
		$orderid=$row['order_id'];
	}else{
		alertInfo("Illegal","index.php",0);
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
<script src="js/addbg.js" type="text/javascript"></script>
<script src="js/tab.js" type="text/javascript"></script>
<title> Submit Order - <?php echo $SHOP_NAME?> - <?php echo $powered?> </title>
</head>
<body>
 <div id="container">
	<?php
		require_once('header_index.php');
	?>
	<div id="main">
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center">
				<div id="orderBox">
					<div class="order_title">Submit order successfully</div>
					<div class="success">
						<p><img src="images/ok.jpg" width="28" height="25" alt="" /> Your order has been submitted successfully.</p>
						<p>order number：<?php echo $id?>   The order amount is：$<span class="red"><?php echo $total?></span></p>
						<p><img src="images/line_541.jpg" alt="" /></p>
						<p class="gray"> We are placing an order for you, please be patient. </p>
						<p class="gray">Want to know the progress of the order at any time, please click to view</p>
						<?php
							if(empty($_SESSION['qiyu_uid'])){
								echo '<p><a href="usercentertab2_n.inc.php"><img src="images/button/see.jpg" width="102" height="27" alt="" /></a></p>';
							}else{
								echo '<p><a href="userorderintro.php?id='.$orderid.'&key=new"><img src="images/button/see.jpg" width="102" height="27" alt="" /></a></p>';
							}
						?>
					</div>
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
