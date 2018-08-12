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
  <script type="text/javascript" src="js/shoptop.js"></script>
  <title> Order search </title>
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
					<h1>Order search</h1>
					<div id="introAdd">
						<form  name="listForm" method="get" action="userorder.php"  id="listForm">
							<p><label>Start</label> <input type="text" name="start"  class="in1"/> Format：2018-09-12</p>
							<p><label>End</label> <input type="text" name="end"  class="in1"/> Format：2018-09-12</p>
							<p><label>Name</label> <input type="text" name="name"  class="in1"/></p>
							<p><label>Phone number</label> <input type="text" name="phone"  class="in1"/></p>
							<p><label>Order number</label> <input type="text" name="order"  class="in1"/></p>
							<p><label>Order state</label> <select name="key">
								<option value="all">All</option>
								<option value="0">Unconfirm</option>
								<option value="1">Confirmed</option>
								<option value="2">Owner cancel</option>
								<option value="3">User cancel</option>
								<option value="4">Done</option>
								<option value="5">Modified</option>
							</select></p>
							<p style="margin-left:94px;"><input type="image" src="../images/button/search.gif" /></p>
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
