<?php
	/**
	 *  网站基本设置 
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
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
<script type="text/javascript" src="js/upload.js"></script>
<title> Web Setup </title>
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
					<h1>Web Setup</h1>
					<div id="introAdd" >
						<form method="post" action="site_do.php?act=other">
							
							<p class="clear">
								<label>CS contact number</label>
								<input style="width:215px" type="text" id="icp" name="onlinechat" class="input input270" value="<?php echo $site_onlinechat?>"/> (input CS contact number) &nbsp;&nbsp;
							</p>
							<p class="clear">
							   <label>Webmaster Statistics:</label>
							   <textarea cols="23" rows="4" name="stat"><?php echo $site_stat?></textarea> (Enter the webmaster stats code) 
							</p>
							<p style="margin-left:15px;">
							  Open the item note for adding a shopping cart：
							   <input type="radio" name="iscartfoodtag" value="1" <?php if($site_iscartfoodtag=='1') echo 'checked';?>>&nbsp;Yes&nbsp;&nbsp;
							   <input type="radio" name="iscartfoodtag" value="2" <?php if($site_iscartfoodtag=='2') echo 'checked';?>>&nbsp;No
							</p>
							<p class="clear">
							   <label>Meal note: (need to open)</label>
							</p>
							<p><textarea name="cartfoodtag" cols="23" rows="4"><?php echo $site_cartfoodtag;?></textarea> (Please separate by ;)</p>											
							<p><label >&nbsp;</label><input type="image" src="../images/button/submit_t.jpg"  /></p>
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
