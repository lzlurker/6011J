<?php
/**
 * 提示新订单信息		msg.php
 *
 * @version       v0.01
 * @create time   2011-9-10
 * @update time   
 * @author        liuxiaohui
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
 * @informaition  
 */
	require_once("usercheck2.php");
	//receiveCode();
	$diftime=date('Y-m-d',time());
	$sql = "select * from  qiyu_order where order_status=0 and (order_time1 is NULL or order_time1='".$diftime."') and order_shopid=".$QIYU_ID_SHOP;
//	$sql="select * from qiyu_shop inner join qiyu_order on order_shop=shop_id2 inner join qiyu_useraddr on useraddr_id=order_useraddr and order_status=0 order by order_id desc ";
	$rs = mysql_query($sql);
	$count = mysql_num_rows($rs);
	$row = mysql_fetch_assoc($rs);
	if($row){
		echo $count;
	}else{
		echo '';
	}
?>