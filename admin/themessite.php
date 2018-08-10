<?php
	/**
	 *  手机模板设置 
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");
	require_once("inc/configue.php");
	require_once("style_default.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <link rel="stylesheet" href="style2.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/lightbox/js/jquery.lightbox-0.5.js"></script>
  <script type="text/javascript" src="js/jscolor/jscolor.js"></script>
  <link rel="stylesheet" href="js/lightbox/css/jquery.lightbox-0.5.css" type="text/css" />
  <title> Phone template settings</title>
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
		<div class="listintor">		
			<div class="header2"><span style="font-size:18px">Phone template settings</span>
			</div>
			<div class="fromcontent">
				<form id="form2" name="addForm" method="post" action="themessite_do.php" >
					<p><label>Whole station：</label>text color <input class="color" name="all_color"  value="<?php echo $all_color?>"> description color <input class="color" name="all_desColor" value="<?php echo $all_desColor?>"> hyperlink color <input class="color" name="all_aColor"  autocomplete="off" class="color" value="<?php echo $all_aColor?>">hyperlink user color<input class="color" name="all_aUcolor"  autocomplete="off" class="color" value="<?php echo $all_aUcolor?>"></p>							
					<p><label>&nbsp;</label><input type="image" src="images/submit1.gif" width="56" height="20" alt="Submit"/><a href=themessite_do.php?type=2><img src="images/reset1.gif" style="position:static;padding-left:10px" alt="Submit"/></a>
					</p>					
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
			alert('Menu class cannot be empty');
			$('#foodtype').focus();
			return false;
		}
	}
	$(function() {
		$('#introAdd a').lightBox();
	});
</script>
</html>
