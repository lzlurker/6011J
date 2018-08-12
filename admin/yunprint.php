<?php

	require_once("usercheck2.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
<head>
<meta name="Author" content="iEat"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"/>
<script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../js/tree.js" type="text/javascript"></script>
<script src="../js/usercartdel.js" type="text/javascript"></script>
<script type="text/javascript" src="js/upload.js"></script>
<title> Website settings </title>

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
					<h1>Print Settings</h1>
					<div id="introAdd">
						<form method="post" action="site_do.php?act=print">
							<p style="margin-bottom:10px;margin-top:10px;margin-left:30px;lien-height:20px;color:red">Order success, for receipt goto <a href="http://iEat" target='_blank' style='text-decoration:underline;color:red;'></a>。
							</p>							
							<p class="clear">
								<label>DTU_ID：</label>
								<input style="width:227px" type="text" id="yunprint" name="yunprint" class="input input270" value="<?php echo  $site_yunprint?>"/> ( input 12 digit DTU_ID account)  
							</p>
							<p class="clear">
								<label style="width:120px;text-align:left;padding-left:35px;"> number of copies：</label>
								<input style="width:27px;text-align:center;" type="text" id="yunprint" name="yunprintnum" class="input input270" value="<?php echo  $site_yunprintnum?>"/> ( number of copies ) 
							</p>	
							<p><label >&nbsp;</label><input  type="image" src="../images/button/submit_t.jpg"  /></p>
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
