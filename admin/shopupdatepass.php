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
  <title> Change Password </title>
 </head>
 <body>
 <div id="container">
	<?php
		require_once('header.php');
	?>
	<div id="main">
		
		<div class="main_content main_content_r">
			<div class="main_top"></div>
			<div class="main_center main_center_r">
				<div id="shopLeft">
					<?php
						require_once('left.inc.php');
					?>
				</div>
				<div id="shopRight">
					<h1>Change Password</h1>
					<div id="introAdd">
						<p style="margin-bottom:50px;">&nbsp;</p>
						<form method="post" action="shop_do.php?act=editPass">
							<p><label class="label_280">Old Password：</label><input type="password" name="old" class="input input179"/></p>
							<p><label class="label_280">New Password：</label><input type="password" name="new1" class="input input179"/></p>
							<p><label class="label_280">Confirm Password：</label><input type="password" name="new2" class="input input179"/></p>
							<p><label class="label_280">&nbsp;</label><input type="image" src="../images/button/updatepass.gif" /></p>
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
