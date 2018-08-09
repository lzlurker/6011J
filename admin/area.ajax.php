<?php
	/**
	 * area_ajax.php 
	 *
	 * @version       v0.01
	 * @create time   2011-7-27
	 * @update time   
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) Î¢ÆÕ¿Æ¼¼ WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition  
	 */
	require('../include/dbconn.php');

	$str='';
	$act=$_POST['act'];
	if ($act=="circle"){
		$area_id=sqlReplace(trim($_POST['area_id']));
		checkData($area_id,"ÇøÓòID",0);
		$sql="select ac.areacircle_circle,c.circle_name from ".WIIDBPRE."_areacircle ac,".WIIDBPRE."_circle c where ac.areacircle_circle=c.circle_id and areacircle_area=".$area_id;
		$rs=mysql_query($sql);
		while ($rows=mysql_fetch_assoc($rs)){
			$str.="<option value='".$rows['areacircle_circle']."'>".$rows['circle_name']."</option>";
		}
	}
	if ($act=="spot"){
		$circle_id=sqlReplace(trim($_POST['circle_id']));
		$sql="select spot_id,spot_name from ".WIIDBPRE."_spot where spot_circle=".$circle_id;
		$rs=mysql_query($sql);
		while ($rows=mysql_fetch_assoc($rs)){
			$str.="<option value='".$rows['spot_id']."'>".$rows['spot_name']."</option>";
		}
	}
	
	echo $str;	
?>