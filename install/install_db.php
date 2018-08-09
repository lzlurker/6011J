<?php

/**
 * install_db.php
 *
 * @version       v0.01
 * @create time   2011-5-30
 * @update time   
 * @author        wiipu
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. ( http://www.wiipu.com)
 * @informaition  

 * Update Record:
 *
 */
	require_once('config.php');
	require_once('../lang/'.$language.'/install.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $_['header_database']." - ".$_['text_title']?> </title>
  </head>
 <body>
	<div id="content">
		<div id="header">
			<?php require_once("header.php")?>
		</div>
		<div id="intor">
			<div id="left">
				<div id="leftheader">
					<?php echo $_['text_install_step']?>
				</div>
				<div id="leftintor">
					<ul>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" /><?php echo $_['text_step1_title']?>
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" /><?php echo $_['text_step2_title']?>
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" /><?php echo $_['text_step3_title']?>
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" /><?php echo $_['text_step4_title']?>
						</li>
						<li>
							<img src="images/li_bg2.gif" width="10" height="11" alt="" /><?php echo $_['text_step5_title']?>
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
					<?php echo $_['text_step2_title']?>
				</div>
				<div id="rightintor">
					<p><?php echo $_['text_database_intro']?></p>
					<form action="install.php" method="POST" name="set" id="set">
						  <p><?php echo $_['text_databaseparam1_title']?>：<input type="text" name="db_host" id="db_host" value="localhost"/></p>
						  <p><?php echo $_['text_databaseparam2_title']?>：<input type="text" name="db_user" id="db_user" value="root"/></p>
						  <p><?php echo $_['text_databaseparam3_title']?>：<input type="text" name="db_password" id="db_password" value="root"/></p>
						  <p><?php echo $_['text_databaseparam4_title']?>：<input type="text" name="db_name" id="db_name" value="diancan"/></p>
						  <!--<p><?php echo $_['text_databaseparam5_title']?>：<input type="text" name="db_prefix" id="db_prefix" value="qiyu_"/></p>-->
						  <input type="hidden" name="db_prefix" id="db_prefix" value="qiyu"/>
						  <input class="input1" type="image" src="images/next.gif"/>
					</form>
				</div>
			</div>
			<div style="clear:both">
		</div>
		<div id="footer">
			<?php require_once("footer.php")?>
		</div>
	</div>
 </body>
</html>
