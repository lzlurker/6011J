<?php

/**
 * index.php
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
 header("content-type:text/html;charset=utf-8");
 session_start();
require_once('config.php');
require_once('../lang/'.$language.'/install.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
  <title> <?php echo $_['header_index']." - ".$_['text_title']?> </title>
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
							<img src="images/li_bg2.gif" width="10" height="11" alt="" /><?php echo $_['text_step2_title']?>
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
					<?php echo $_['text_step1_title']?>
				</div>
				<div id="rightintor">
					
					<p><?php echo $_['text_step2_intro1']?></p>
					<h2><?php echo $_['text_step3_intro1']?></h2>
					<p><?php echo $_['text_step4_intro1'] ?></p>
					<table width="80%">
						<tr>
							<th width="30%"><?php echo $_['text_param1_title']?></th>
							<th width="35%"><?php echo $_['text_param2_title']?></th>
							<th width="35%"><?php echo $_['text_param3_title']?></th>
						</tr>
						<tr>
							<td><?php echo $_['text_param1']?></td>
							<td><?php echo $_['text_param1_value']?></td>
							<td><?php echo PHP_VERSION; if(PHP_VERSION>'5.0.0') echo "<img src='images/yes.png' width='16' height='16' alt='' />";?></td>
						</tr>
						<tr>
							<td><?php echo $_['text_param2']?></td>
							<td><?php echo $_['text_param2_value']?></td>
							<td><?php echo $_['text_check']?></td>
						</tr>
						<tr>
							<td>install<?php echo $_['text_folderLimit']?></td>
							<td><?php echo $_['text_edit']."、".$_['text_write']?></td>
							<td><?php if (is_writable('../install')) echo "<img src='images/yes.png' width='16' height='16' alt='' />";?></td>
						</tr>
						<tr>
							<td>admin<?php echo $_['text_folderLimit']?></td>
							<td><?php echo $_['text_edit']."、".$_['text_write']?></td>
							<td><?php if (is_writable('../admin')) echo "<img src='images/yes.png' width='16' height='16' alt='' />";?></td>
						</tr>
						<tr>
							<td>include<?php echo $_['text_folderLimit']?></td>
							<td><?php echo $_['text_write']?></td>
							<td><?php if (is_writable('../include')) echo "<img src='images/yes.png' width='16' height='16' alt='' />";?></td>
						</tr>
						
						
					</table>
					<?php if(PHP_VERSION>'5.0.0'){ 
						$_SESSION['test']="diancan";
						?>
						<?php if(function_exists('mb_substr')){ ?>
						<p><a href="install_db.php"><img src="images/next.gif" width="68" height="26" alt="<?php echo $_['alt_next']?>" /></a></p>
						<?php }else { ?>
						<p><?php echo $_['error_mb_string'] ?></p>
						<?php } ?>
					<?php }else{ ?>
					<p><?php echo $_['error_php']?></p>
					<?php } ?>
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
