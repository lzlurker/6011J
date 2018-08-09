<?php

/**
 * install_ajax.php
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
$t=intval($_POST["t"]);
$db_name=$_POST["dabasename"];
$db_host=$_POST["dataaddress"];
$db_user=$_POST["datauser"];
$prefix=$_POST["prefix"];
$db_password=$_POST["datapwd"];
require_once 'install_sql.php';
$conn=mysql_connect($db_host,$db_user,$db_password) or die($_['error_ajax_connect']);
mysql_select_db($db_name) or die($_['error_ajax_noDatabase']);
mysql_query("set names utf8") or die($_['error_finish_fail']);
if ($t==0){  //检测数据库环境
	for($i=0;$i<=62;$i++){
		//wait
		if(!mysql_query($sqlstr[$i]))die($_['error_finish_fail']);
	}
}elseif($t>0 && $t<=63){   //创建表
	if(!mysql_query($sqlstr[$t+61]))die($_['error_finish_fail']);
}else{ //初始化数据库数据
	if(!mysql_query($sqlstr[126]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[127]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[128]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[129]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[130]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[131]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[132]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[133]))die($_['error_finish_fail']);
	if(!mysql_query($sqlstr[134]))die($_['error_finish_fail']);
}
echo("S");
?>