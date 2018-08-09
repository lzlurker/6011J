<?php

/**
 * install.php
 *
 * @version       v0.01
 * @create time   2011-5-30
 * @update time   
 * @author        wiipu
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. ( http://www.wiipu.com)
 * @informaition  

 * Update Record:
 *
 */ session_start();
require_once('config.php');
require_once('../lang/'.$language.'/install.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
 <head>
   <meta name="Author" content="微普科技http://www.wiipu.com"/>
   <meta http-equiv="Content-Type" content="html/text; charset=utf-8" />
   <link rel="stylesheet" href="style.css" type="text/css"/>
   <script type="text/javascript" src="install.js"></script>
  <title> <?php echo $_['header_initialization']." - ".$_['text_title']?> </title>
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
					<?php echo $_['text_step3_title']?>
				</div>
				<div id="rightintor">
					<?php
						error_reporting(0);
						$db_host=trim($_POST['db_host']);
						$db_user=trim($_POST['db_user']); 
						$db_password=trim($_POST['db_password']);
						$db_name=trim($_POST['db_name']);
						$db_prefix=trim($_POST['db_prefix']);
						
	
						if(!mysql_connect($db_host,$db_user,$db_password)){
							
							echo("<p class='error'>".$_['error_database_connect']."</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='".$_['alt_pre']."' /></a></p>");
						}else{
							if(mysql_get_server_info()<'5.0.0'){
								echo("<p class='error'>".$_['error_mysql']."</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='".$_['alt_pre']."' /></a></p>");
								exit;
							}
							if($_SESSION['test']!="diancan")
							{
								echo("<p class='error'>".$_['error_session']."</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='".$_['alt_pre']."' /></a></p>");
								exit;
							}
							mysql_query("set names utf8");
							$sql="create database IF not EXISTS $db_name";
							mysql_query($sql) or dir($_['error_creat_fail']) ;
							if(!mysql_select_db($db_name)){
								echo("<p class='error'>".$_['error_noDatabase'] ."</p><p><a href='install_db.php'><img src='images/bt_prev.gif' width='68' height='26' alt='".$_['alt_pre']."' /></a></p>");
							}else{
								$files="../include/configue.php";
								if(!fopen($files,"a+")){
									echo("<p class='error'>".$_['error_root_limit']."</p>");
								}else{
									$install = "../install";
									$admin = "../admin";
									if(!is_readable($install)){
										die ("<p class='error'>".$_['error_install_limit']."</p>");
									}elseif(!is_readable($admin)){
										die ("<p class='error'>".$_['error_admin_limit']."</p>");
									}
									$config_str = "<?php";
									$config_str .= "\n";
									$config_str .="define('WIIDBHOST', '".$db_host."');";
									$config_str .= "\n";
									$config_str .="define('WIIDBUSER', '".$db_user."');";
									$config_str .= "\n";
									$config_str .="define('WIIDBPASS', '".$db_password."');";
									$config_str .= "\n";
									$config_str .="define('WIIDBNAME', '".$db_name."');";

									$config_str .= "\n";
									$config_str .="define('WIIDBPRE', '".$db_prefix."');";
									$config_str .= "\n";
									$config_str .= '?>';
									$fp=fopen($files,"a");
									fwrite($fp,$config_str);
									fclose($fp);

									echo '<div id="container"><div class="box">';
									echo '<table width="90%">';
									echo '<tr><th width="80%">'.$_['text_initialization_title1'].'</th><th>'.$_['text_initialization_title2'].'</th></tr>';
									echo '<tr><td>1. '.$_['text_initialization1'].'</td><td><span class="red" id="table0"></span></td></tr>';
									//根据自己的数据库表修改这儿
									echo '<tr><td>2. '.$_['text_initialization2'].'['.$db_prefix.'_about]</td><td><span class="red" id="table1"></span></td></tr>';
									echo '<tr><td>3. '.$_['text_initialization2'].'['.$db_prefix.'_admingroup]</td><td><span class="red" id="table2"></span></td></tr>';
									echo '<tr><td>4. '.$_['text_initialization2'].'['.$db_prefix.'_admin]</td><td><span class="red" id="table3"></span></td></tr>';
									echo '<tr><td>5. '.$_['text_initialization2'].'['.$db_prefix.'_adpic]</td><td><span class="red" id="table4"></span></td></tr>';
									echo '<tr><td>6. '.$_['text_initialization2'].'['.$db_prefix.'_area]</td><td><span class="red" id="table5"></span></td></tr>';
									echo '<tr><td>7. '.$_['text_initialization2'].'['.$db_prefix.'_areacircle]</td><td><span class="red" id="table6"></span></td></tr>';
									echo '<tr><td>8. '.$_['text_initialization2'].'['.$db_prefix.'_brand]</td><td><span class="red" id="table7"></span></td></tr>';
									echo '<tr><td>9. '.$_['text_initialization2'].'['.$db_prefix.'_brandshop]</td><td><span class="red" id="table8"></span></td></tr>';
									echo '<tr><td>10. '.$_['text_initialization2'].'['.$db_prefix.'_button]</td><td><span class="red" id="table9"></span></td></tr>';
									echo '<tr><td>11. '.$_['text_initialization2'].'['.$db_prefix.'_cart]</td><td><span class="red" id="table10"></span></td></tr>';
									echo '<tr><td>12. '.$_['text_initialization2'].'['.$db_prefix.'_circle]</td><td><span class="red" id="table11"></span></td></tr>';
									echo '<tr><td>13. '.$_['text_initialization2'].'['.$db_prefix.'_circlecolumn]</td><td><span class="red" id="table12"></span></td></tr>';
									echo '<tr><td>14. '.$_['text_initialization2'].'['.$db_prefix.'_comment]</td><td><span class="red" id="table13"></span></td></tr>';
									echo '<tr><td>15. '.$_['text_initialization2'].'['.$db_prefix.'_deliver]</td><td><span class="red" id="table14"></span></td></tr>';
									echo '<tr><td>16. '.$_['text_initialization2'].'['.$db_prefix.'_deliverbycircle]</td><td><span class="red" id="table15"></span></td></tr>';
									echo '<tr><td>17. '.$_['text_initialization2'].'['.$db_prefix.'_delivertime]</td><td><span class="red" id="table16"></span></td></tr>';
									echo '<tr><td>18. '.$_['text_initialization2'].'['.$db_prefix.'_demand]</td><td><span class="red" id="table17"></span></td></tr>';
									echo '<tr><td>19. '.$_['text_initialization2'].'['.$db_prefix.'_fav]</td><td><span class="red" id="table18"></span></td></tr>';
									echo '<tr><td>20. '.$_['text_initialization2'].'['.$db_prefix.'_food]</td><td><span class="red" id="table19"></span></td></tr>';
									echo '<tr><td>21. '.$_['text_initialization2'].'['.$db_prefix.'_foodbylable]</td><td><span class="red" id="table20"></span></td></tr>';

									echo '<tr><td>22. '.$_['text_initialization2'].'['.$db_prefix.'_foodlable]</td><td><span class="red" id="table21"></span></td></tr>';
									echo '<tr><td>23. '.$_['text_initialization2'].'['.$db_prefix.'_foodtype]</td><td><span class="red" id="table22"></span></td></tr>';
									echo '<tr><td>24. '.$_['text_initialization2'].'['.$db_prefix.'_group]</td><td><span class="red" id="table23"></span></td></tr>';
									echo '<tr><td>25. '.$_['text_initialization2'].'['.$db_prefix.'_groupcount]</td><td><span class="red" id="table24"></span></td></tr>';
									echo '<tr><td>26. '.$_['text_initialization2'].'['.$db_prefix.'_indexfoodhot]</td><td><span class="red" id="table25"></span></td></tr>';
									echo '<tr><td>27. '.$_['text_initialization2'].'['.$db_prefix.'_indexrmd]</td><td><span class="red" id="table26"></span></td></tr>';
									echo '<tr><td>28. '.$_['text_initialization2'].'['.$db_prefix.'_indexshop]</td><td><span class="red" id="table27"></span></td></tr>';
									echo '<tr><td>29. '.$_['text_initialization2'].'['.$db_prefix.'_indexshophot]</td><td><span class="red" id="table28"></span></td></tr>';
									echo '<tr><td>30. '.$_['text_initialization2'].'['.$db_prefix.'_indexteachfood]</td><td><span class="red" id="table29"></span></td></tr>';
									echo '<tr><td>31. '.$_['text_initialization2'].'['.$db_prefix.'_indexteachfood]</td><td><span class="red" id="table30"></span></td></tr>';
									echo '<tr><td>32. '.$_['text_initialization2'].'['.$db_prefix.'_like]</td><td><span class="red" id="table31"></span></td></tr>';
									echo '<tr><td>33. '.$_['text_initialization2'].'['.$db_prefix.'_log]</td><td><span class="red" id="table32"></span></td></tr>';
									echo '<tr><td>34. '.$_['text_initialization2'].'['.$db_prefix.'_message]</td><td><span class="red" id="table33"></span></td></tr>';
									echo '<tr><td>35. '.$_['text_initialization2'].'['.$db_prefix.'_notice]</td><td><span class="red" id="table34"></span></td></tr>';
									echo '<tr><td>36. '.$_['text_initialization2'].'['.$db_prefix.'_order]</td><td><span class="red" id="table35"></span></td></tr>';
									
									echo '<tr><td>37. '.$_['text_initialization2'].'['.$db_prefix.'_orderchange]</td><td><span class="red" id="table36"></span></td></tr>';
									echo '<tr><td>38. '.$_['text_initialization2'].'['.$db_prefix.'_rmd]</td><td><span class="red" id="table37"></span></td></tr>';
									echo '<tr><td>39. '.$_['text_initialization2'].'['.$db_prefix.'_rmdsort]</td><td><span class="red" id="table38"></span></td></tr>';
									echo '<tr><td>40. '.$_['text_initialization2'].'['.$db_prefix.'_rscore]</td><td><span class="red" id="table39"></span></td></tr>';
									echo '<tr><td>41. '.$_['text_initialization2'].'['.$db_prefix.'_seo]</td><td><span class="red" id="table40"></span></td></tr>';
									echo '<tr><td>42. '.$_['text_initialization2'].'['.$db_prefix.'_shop]</td><td><span class="red" id="table41"></span></td></tr>';
									echo '<tr><td>43. '.$_['text_initialization2'].'['.$db_prefix.'_shopbycirclermd]</td><td><span class="red" id="table42"></span></td></tr>';
									echo '<tr><td>44. '.$_['text_initialization2'].'['.$db_prefix.'_shopbysort]</td><td><span class="red" id="table43"></span></td></tr>';
									echo '<tr><td>45. '.$_['text_initialization2'].'['.$db_prefix.'_shopbysortbycircle]</td><td><span class="red" id="table44"></span></td></tr>';
									echo '<tr><td>46. '.$_['text_initialization2'].'['.$db_prefix.'_shopcircle]</td><td><span class="red" id="table45"></span></td></tr>';
									echo '<tr><td>47. '.$_['text_initialization2'].'['.$db_prefix.'_shophot]</td><td><span class="red" id="table46"></span></td></tr>';
									echo '<tr><td>48. '.$_['text_initialization2'].'['.$db_prefix.'_shoppics]</td><td><span class="red" id="table47"></span></td></tr>';
									echo '<tr><td>49. '.$_['text_initialization2'].'['.$db_prefix.'_shoprmd]</td><td><span class="red" id="table48"></span></td></tr>';
									echo '<tr><td>50. '.$_['text_initialization2'].'['.$db_prefix.'_shopsort]</td><td><span class="red" id="table49"></span></td></tr>';
									echo '<tr><td>51. '.$_['text_initialization2'].'['.$db_prefix.'_shopspot]</td><td><span class="red" id="table50"></span></td></tr>';
									echo '<tr><td>52. '.$_['text_initialization2'].'['.$db_prefix.'_shopstyle]</td><td><span class="red" id="table51"></span></td></tr>';
									echo '<tr><td>53. '.$_['text_initialization2'].'['.$db_prefix.'_shoptag]</td><td><span class="red" id="table52"></span></td></tr>';
									echo '<tr><td>54. '.$_['text_initialization2'].'['.$db_prefix.'_shoptagbycircle]</td><td><span class="red" id="table53"></span></td></tr>';
									echo '<tr><td>55. '.$_['text_initialization2'].'['.$db_prefix.'_site]</td><td><span class="red" id="table54"></span></td></tr>';
									echo '<tr><td>56. '.$_['text_initialization2'].'['.$db_prefix.'_sortbytab]</td><td><span class="red" id="table55"></span></td></tr>';
									echo '<tr><td>57. '.$_['text_initialization2'].'['.$db_prefix.'_specialact]</td><td><span class="red" id="table56"></span></td></tr>';
									echo '<tr><td>58. '.$_['text_initialization2'].'['.$db_prefix.'_spot]</td><td><span class="red" id="table57"></span></td></tr>';
									echo '<tr><td>59. '.$_['text_initialization2'].'['.$db_prefix.'_style]</td><td><span class="red" id="table58"></span></td></tr>';
									echo '<tr><td>60. '.$_['text_initialization2'].'['.$db_prefix.'_tag]</td><td><span class="red" id="table59"></span></td></tr>';
									echo '<tr><td>61. '.$_['text_initialization2'].'['.$db_prefix.'_user]</td><td><span class="red" id="table60"></span></td></tr>';
									echo '<tr><td>62. '.$_['text_initialization2'].'['.$db_prefix.'_useraddr]</td><td><span class="red" id="table61"></span></td></tr>';
									echo '<tr><td>63. '.$_['text_initialization2'].'['.$db_prefix.'_userscore]</td><td><span class="red" id="table62"></span></td></tr>';
									echo '<tr><td>64. '.$_['text_initialization2'].'['.$db_prefix.'_file]</td><td><span class="red" id="table63"></span></td></tr>';
									



									echo '<tr><td>65. '.$_['text_initialization3'].'</td><td><span class="red" id="table64"></span></td></tr>';
									echo "</table>";
									echo '<div id="success"></div>';
									echo "<script language='javascript'>";
									echo 'var x=0,j=1,t=64;';
									echo "var databaseIP='".$db_host."';";
									echo "var databaseName='".$db_name."';";
									echo "var databaseUser='".$db_user."';";
									echo "var databasePWD='".$db_password."';";
									echo "var tablePrefix='".$db_prefix."';";
									echo "act();";
									echo "</script>";
									echo "</div></div>";
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