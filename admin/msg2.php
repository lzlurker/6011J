<?php
/**
 * 提示催餐订单信息		msg.php
 *
 * @version       v0.01
 * @create time   2011-9-10
 * @update time   
 * @author        liuxiaohui
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
 * @informaition  
 */
	require_once("usercheck2.php");
	
	$sql="select order_id2,orderchange_type,orderchange_hurry from qiyu_order,qiyu_orderchange where orderchange_order=order_id2 and orderchange_type='1' and order_status='5' and roderchange_typechange is NULL";
	
	$rs = mysql_query($sql);
	$count = mysql_num_rows($rs);
	$row = mysql_fetch_assoc($rs);
	if($row){
		echo $count;
	}else{
		echo '';
	}
?>