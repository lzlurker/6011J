<?php
	/**
	 *  shopcard.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-22
	 * @update time
	 * @author        lujiangxia
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
  <title> License information upload </title>
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
					<h1>Restaurant license</h1>

					<div id="introAdd">
						<div class="moneyTable feeTable" style="width:668px;margin-top:0px;padding-top:0">
							<p style="color:red;margin-top:20px;margin-bottom:20px;">Tips: Set whether displays the restaurant license in the "Website Settings"。</p>
							<table width="100%">
								<tr>
									<td class="center" width='100'>Name</td>
									<td class="center"  width='468'>Photo</td>
									<td class="center"  width='100'>Operation</td>
								</tr>
										
								<tr>
									<td class="center">License</td>
									<td class="center" style='padding:20px 0;'>
									<?php 
										if (empty($SHOP_CERTPIC)){
											echo "<img src='../images/default_cart1.jpg'/>";
										}else{
											echo "<img src='../userfiles/license/small/". $SHOP_CERTPIC."' width='200' height='150'/>";
										}
									?>
									</td>
									<td class="center">
										<a href="shopcardedit.php?type=1">Modify</a> 
									</td>
								</tr>
								<tr>
									<td class="center">Health permit</td>
									<td class="center" style='padding:20px 0;'>
									<?php 
										if (empty($SHOP_LICENSEPIC)){
											echo "<img src='../images/default_cart2.jpg'/>";
										}else{
											 echo "<img src='../userfiles/license/small/". $SHOP_LICENSEPIC."' width='200' height='150'/>";
										}
									?>
									</td>
									<td class="center">
										<a href="shopcardedit.php?type=2">Modify</a> 
									</td>
								</tr>
											
							</table>
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
