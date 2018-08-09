<?php
	/**
	 *  管理首页
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
  <title> ManageMainPage - iEat </title>
  <style>
	#main #introAdd li{
		width:100%;
		margin-left:20px;
	}
	#main #introAdd li a{
		color:#000;
	}
	#main #introAdd li span{
		position:absolute;
		left:550px;
		top:0;

	}
  </style>
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
					<h1>ManageMainPage</h1>
					
					<div id="introAdd">
					
							<?php
								$isShow=false;
								if (empty($SHOP_NAME) || empty($SHOP_TEL) || empty($SHOP_OPENSTARTTIME) || empty($SHOP_OPENENDTIME) || empty($SHOP_MAINFOOD) || empty($SHOP_ADDRESS)){
									$isShow='true';
								}
								if (!$isShow && empty($logo)){
									$isShow='true';
								}
								if (!$isShow){
									$sql1="select * from  qiyu_delivertime";
									$rs=mysql_query($sql1);
									$rows=mysql_fetch_assoc($rs);
									if (!$rows){
										$isShow='true';
									}
								}
								if (!$isShow){
									if ((empty($site_wiiyunsalt) || empty($site_wiiyunaccount) || empty($SHOP_PHONE)) && $site_sms=='1'){
										$isShow='true';
									}
								}

								if ($isShow){
							?>
									<h2 class='h2_small warning'>Following must be done！</h2>
							
							<?php
								}
								if (empty($SHOP_NAME) || empty($SHOP_TEL) || empty($SHOP_OPENSTARTTIME) || empty($SHOP_OPENENDTIME) || empty($SHOP_MAINFOOD) || empty($SHOP_ADDRESS)){
									echo "<p><a href='shopadd.php'>Setup basic info</a></p>";
								}
								if (empty($logo)){
									echo "<p><a href='site.php'>Set LOGO</a></p>";
								}
								$sql1="select * from  qiyu_delivertime";
								$rs=mysql_query($sql1);
								$rows=mysql_fetch_assoc($rs);
								if (!$rows){
									echo "<p><a href='shopdelivertime.php'>Set deliver time</a></p>";
								}
								if ((empty($site_wiiyunsalt) || empty($site_wiiyunaccount) || empty($SHOP_PHONE)) && $site_sms=='1'){
									echo "<p><a href='site_sms.php'>Set text</a></p>";
								}
							?>

                            

							<h2 class='h2_small' style='margin:50px auto 20px;'>fast search</h2>							  
							  <form  name="listForm" method="get" action="userlist.php"  id="listForm">
							      <input name="username" class="in1" type="text" style="width:190px; height:16px; color:#DFDFDF;margin-bottom:5px;float:left" value="input userName or phoneNum" onfocus="if(this.value=='input userName or phoneNum'){this.value=''};this.style.color='black';" 
								  onblur="if(this.value==''||this.value=='input userName or phoneNum'){this.value='input userName or phoneNum';this.style.color='#DFDFDF';}">
								  <input style="margin-left:10px;float:left;" type="image" src="../images/button/search.gif" />	  
							  </form><br/><br/>

                              <form  name="listForm" method="get" action="userorder.php"  id="listForm">
							      <input name="order" class="in1" type="text" style="width:190px; height:16px; color:#DFDFDF;float:left;" value="input user orderNum" onfocus="if(this.value=='input user orderNum'){this.value=''};this.style.color='black';" onblur="if(this.value==''||this.value=='input user orderNum'){this.value='input user orderNum';this.style.color='#DFDFDF';}">
								  <p style="display:none">								   
								    <select name="key" style="display:none">
										<option value="all">all</option>
										<option value="0">unConfirm</option>
										<option value="1">Confirm</option>
										<option value="2">Owner Cancel</option>
										<option value="3">User Cancel</option>
										<option value="4">Done</option>
										<option value="5">Updated</option>
							        </select>
									</p>
								  <input style="margin-left:10px;mrgin-top:-10px;float:left;" type="image" src="../images/button/search.gif" />		  
							  </form>

							<h2 class='h2_small' style='margin-top:50px;'>Statistics</h2>
							<p><a href="userorder.php?key=0">New Order(<?php echo getOrderNewCountByState(0);?>)</a></p>
							<p><a href="subscribe.php">Book Order(<?php echo getSubscribeCount()?>)</a></p>
							<h2 class='h2_small' style='margin-top:50px;'>System info</h2>
							<p>version：<?php echo $version.'('.$subversion.')'?></p>
							<p>updateTime：<?php echo $updateTime?></p>
							<h2 class='h2_small' style='margin-top:50px;'>software state</h2>
							<ul>
								<script language='javascript' src="http://www.wiipu.com/news/diancan.php"></script>
							</ul>
							
						
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
			alert('Menu can not be empty');
			$('#foodtype').focus();
			return false;
		}
	}
</script>

</html>
