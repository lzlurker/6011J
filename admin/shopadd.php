<?php

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
  <script type="text/javascript" src="js/shopadd.js"></script>
  <title> Restaurant information management </title>
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
					<h1>Restaurant information management</h1>
					<div id="introAdd">
						
						<form method="post" action="shop_do.php?act=base">
						<p><label>Restaurant name:</label><input type="text" id="name" name="name" class="input input270" value="<?php echo 'iEat'?>" /></p>
						
						<p>
							<label>Restaurant address:</label>
							 <input type="text" id="address" name="address" class="input input270" value="<?php if(empty($SHOP_INFOS['shop_address'])){echo 'Please enter your store address';}else{echo $SHOP_INFOS['shop_address'];}?>"/> *
						</p>
						
						<p><label>Restaurant phone number:</label><input type="text" id="tel" name="tel" class="input input179" value="<?php echo $SHOP_INFOS['shop_tel']?>"/> *</p>
						<p><label>Business start time:</label><input type="text" id="opentime" name="opentime" class="input input179" value="<?php echo substr($SHOP_INFOS['shop_openstarttime'],0,5)?>"/> * (Ex：09:00)</p>
						<p><label>Business end time:</label><input type="text" id="endtime" name="endtime" class="input input179" value="<?php echo substr($SHOP_INFOS['shop_openendtime'],0,5)?>"/> * (Ex：22:30)</p>
						<p><label>Main food：</label><input class="input input179" type="text" id="mainfood" name="mainfood" maxlength="16" value="<?php echo $SHOP_INFOS['shop_mainfood']?>"/> （Max 16 characters）*</p>

						
						<p><label>Restaurant introduction:</label><textarea id="intro" name="intro" class="input input578" style="height:53px;resize:none;"><?php if(empty($SHOP_INFOS['shop_intro'])){echo 'Within 200 words';}else{echo $SHOP_INFOS['shop_intro'];}?></textarea> *</p>
						
						<p><label>&nbsp;</label><input type="image" src="../images/button/submit_t.jpg"  onClick="return check()"/></p>
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
