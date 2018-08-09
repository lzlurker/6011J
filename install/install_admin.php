<?php

/**
 * install_admin.php
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
  <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
   <script type="text/javascript" src="install.js"></script>
  <title> <?php echo $_['header_admin']." - ".$_['text_title']?> </title>
  </head>
 <body>
<?php
		$AdminFolderNameOld="admin";
		$Host="http://../".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
		$count=strpos($Host,"install_admin.php");
		$Host=substr_replace($Host,"",$count,17);
		$Host1=str_replace('../','',$Host);
		$count1=strpos($Host1,"/install");
		$Host2=substr_replace($Host1,"",$count1,9);
		$db_name=$_GET["dabasename"];
		$db_host=$_GET["dataaddress"];
		$db_user=$_GET["datauser"];
		$db_password=$_GET["datapwd"];
		$db_prefix=$_GET["prefix"];
	?>
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
							<img src="images/li_bg2.gif" width="10" height="11" alt="" /><?php echo $_['text_step5_title']?>
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<div id="rightheader">
					<?php echo $_['text_step4_title']?>
				</div>
				<div id="rightintor">
					<form id="edit" name="edit" method="post" action="install_finish.php">
						<p>　<?php echo $_['text_adminParam1_title']?>：<input class='input2' type='text' name='address' value='<?php echo $Host2;?>'/><span class='red'> * <?php echo $_['text_subject1']?></span></p>
						<p>　<?php echo $_['text_adminParam2_title']?>：<input id="edtAdminFolderName" name="edtAdminFolderName"  value="<?php echo $AdminFolderNameOld;?>" class='input2'/><span class='red'> * <?php echo $_['text_subject2']?></span><input type="hidden" name="Host" value="<?php echo $Host;?>"/></p>
						<p><?php echo $_['text_adminParam3_title']?>： <input id="edtAdminUserName" name="edtAdminUserName" class="input2" type="text"/><span class='red'> *</span></p>
						<p><?php echo $_['text_adminParam4_title']?>：
						<input id="edtAdminPassWord" name="edtAdminPassWord"   class="input2" type="password"/><span class='red'> *</span></p>
						<p>　<?php echo $_['text_adminParam5_title']?>：
						<input id="edtAdminPassWord2" name="edtAdminPassWord2"   class="input2" type="password"/><input type="hidden" name="db_host" value="<?php echo $db_host;?>"/><input type="hidden" name="db_name" value="<?php echo $db_name;?>"/><input type="hidden" name="db_user" value="<?php echo $db_user;?>"/><input type="hidden" name="db_password" value="<?php echo $db_password;?>"/><input type="hidden" name="prefix" value="<?php echo $db_prefix?>"><span class='red'> *</span></p>
						<input class="input1" type="image" src="images/next.gif" onclick="return check();" id="btnPost"/>
						<script language="JavaScript" type="text/javascript">
							function check(){
								if((document.getElementById("edtAdminFolderName").value)=="admin"){
										document.getElementById("edtAdminFolderName").focus();
										alert("<?php echo $_['error_admin_folder']?>");
										return false;
								}
								if((document.getElementById("edtAdminFolderName").value).length<2){
										alert("<?php echo $_['error_admin_length']?>");
										return false;
								}
								if((document.getElementById("edtAdminUserName").value).length<3){
										alert("<?php echo $_['error_account_length']?>");
										return false;
								}
								if((document.getElementById("edtAdminPassWord").value).length<6){
										alert("<?php echo $_['error_pwd_length']?>");
										return false;
								}
								if((document.getElementById("edtAdminPassWord").value!==document.getElementById("edtAdminPassWord2").value)){
										alert("<?php echo $_['error_pwd2']?>");
										return false;
								}
							}
						</script>
					</form>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div id="footer">
			<?php require_once("footer.php")?>
		</div>
	</div>
 </body>
</html>
