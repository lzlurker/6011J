<?php

/**
 * install_finish.php
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
	require_once('../include/function_common.php');
	require_once('../lang/'.$language.'/install.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $_['header_finish']." - ".$_['text_title']?> </title>
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
							<img src="images/li_bg1.gif" width="10" height="11" alt="" /><?php echo $_['text_step3_title']?>
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" /><?php echo $_['text_step4_title']?>
						</li>
						<li>
							<img src="images/li_bg1.gif" width="10" height="11" alt="" /><?php echo $_['text_step5_title']?>
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
				<?php echo $_['header_finish']?>
				</div>
				<div id="rightintor">
					<?php
						error_reporting(0);
						$AdminUserName=trim($_POST["edtAdminUserName"]);
						$AdminPassWord=trim($_POST["edtAdminPassWord"]);
						$foldername=trim($_POST["edtAdminFolderName"]);
						$AdminFolderName='../'.$foldername;
						$salt=getRndCode(6);
						$AdminPassWord2=md5(md5($AdminPassWord).$salt);
						$db_host=trim($_POST["db_host"]);
						$db_user=trim($_POST["db_user"]);
						$db_name=trim($_POST["db_name"]);
						$db_password=trim($_POST["db_password"]);
						$db_prefix=trim($_POST["prefix"]);
						$address=trim($_POST['address']);
						if(!mysql_connect($db_host,$db_user,$db_password)){
							echo("<p class='error'>".$_['error_finish_connect']."</p>");
						}else{
							mysql_query("set names utf8");
							if(!mysql_select_db($db_name)){
								echo("<p class='error'>".$_['error_finish_database']."</p>");
							}else{
								$ID=md5(uniqid(rand(),true));
								rename("../admin",$AdminFolderName);
								$files="../include/configue.php";
								$config_str  = "\n";
								$config_str .= "<?php";
								$config_str .= "\n";
								$config_str .= '$admin_dir= "'.$foldername.'";';
								$config_str .= "\n";
								$config_str.="define('DIANCAN_ID','".$ID."');";
								$config_str.="\n";
								$config_str .="define('NETURL','".$address."');";
								$config_str .= "\n";
								$config_str .= '?>';
								$fp=fopen($files,"a");
								fwrite($fp,$config_str);
								fclose($fp);
								$sql="update ".$db_prefix."_shop set shop_account='".$AdminUserName."',shop_password='".$AdminPassWord2."',shop_salt='".$salt."'";
								if(!mysql_query($sql)){
									echo("<p class='error'>".$_['error_finish_insertAdmin']."</p>");
								}else{
									echo "<h2>".$_['text_success']."</h2>";
									echo "<p class='red'><strong>".$_['text_notice']."：</strong></p>";
									echo "<p>".$_['text_adminUrl'] ."：<span class='red'>". $address."/".$foldername."/index.php</span></p>";
									echo "<p>".$_['text_adminParam3_title']."：<span class='red'>".$AdminUserName."</span></p>";
									echo "<p>".$_['text_adminParam4_title']."：<span class='red'>".$AdminPassWord."</span></p>";
									echo "<p><a href='".$address."/index.php' target='_blank'>".$_['text_inIndex']."</a></p>";
									echo "<p><a href='".$address."/".$foldername."/index.php' target='_blank'>".$_['text_inAdmin']."</a></p>";
									echo "<p><a href='".$address."/index.php'><img src='images/bt_finish.gif' width='68' height='26' alt='".$_['alt_finish']."' /></a></p>";
								}
							}
						}
					?>
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
