<?php 
	/**
	 *  shop_do.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-22
	 * @update time
	 * @author        lujiangxia
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "sure":
			$key=sqlReplace(trim($_GET['key']));
			$id=sqlReplace(trim($_GET['id']));
			$keyword=empty($_GET['keyword'])?'':sqlReplace(trim($_GET['keyword']));
			$start=empty($_GET['start'])?'':sqlReplace(trim($_GET['start']));
			$end=empty($_GET['end'])?'':sqlReplace(trim($_GET['end']));
			$url="?key=".$key."&keyword=".$keyword."&start=".$start."&end=".$end;
			$sql="select * from qiyu_order where order_id=".$id." and order_shopid='".$QIYU_ID_SHOP."' and order_status='0'";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$order=$rows['order_id2'];
				$sql2="update qiyu_order set order_status='1'  where order_id=".$id;
				if(mysql_query($sql2)){
					//添加订单记录
					//addOrderType($order,'商家正在为你下单');
					$orderContent="<span class='greenbg'><span><span>Ordering</span></span></span>";
					$orderContent.="Cooking！";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Success','shoporder.php'.$url,0);
				}else
					alertInfo('Failed, SQL error','shoporder.php'.$url,0);
			}else
				alertInfo("Accident","",1);
		break;
		case "qx":
			$key=sqlReplace(trim($_GET['key']));
			$id=sqlReplace(trim($_GET['id']));
			$keyword=empty($_GET['keyword'])?'':sqlReplace(trim($_GET['keyword']));
			$start=empty($_GET['start'])?'':sqlReplace(trim($_GET['start']));
			$end=empty($_GET['end'])?'':sqlReplace(trim($_GET['end']));
			$url="?key=".$key."&keyword=".$keyword."&start=".$start."&end=".$end;
			$sql="select * from qiyu_order where order_id=".$id." and order_shopid='".$QIYU_ID_SHOP."' and order_status in(0,1,5)";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$order=$rows['order_id2'];
				$sql2="update qiyu_order set order_status='2'  where order_id=".$id;
				if(mysql_query($sql2)){
					//添加订单记录
					//addOrderType($order,'商家取消订单');
					$orderContent="<span class='greenbg redbg'><span><span>Cancel order </span></span></span>";
					$orderContent.="Order canceled。";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Canceled','shoporder.php'.$url,0);
				}else
					alertInfo('Failed, SQL error','shoporder.php'.$url,0);
			}else
				alertInfo("Accident","",1);
		break;
		case "bc":
			$key=sqlReplace(trim($_GET['key']));
			$id=sqlReplace(trim($_GET['id']));
			$keyword=empty($_GET['keyword'])?'':sqlReplace(trim($_GET['keyword']));
			$start=empty($_GET['start'])?'':sqlReplace(trim($_GET['start']));
			$end=empty($_GET['end'])?'':sqlReplace(trim($_GET['end']));
			$url="?key=".$key."&keyword=".$keyword."&start=".$start."&end=".$end;
			$sql="select * from qiyu_order where order_id=".$id." and order_shopid='".$QIYU_ID_SHOP."' and order_status=1";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$order=$rows['order_id2'];
				$sql2="update qiyu_order set order_status='5'  where order_id=".$id;
				if(mysql_query($sql2)){
					//添加订单记录
					//addOrderType($order,'商家开始备餐');
					$orderContent="<span class='greenbg'><span><span>Order accepted</span></span></span>";
					$orderContent.="Dear,".$rows['order_addtime']."Order send！";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Operation success','shoporder.php'.$url,0);
				}else
					alertInfo('Operation failed, SQL error','shoporder.php'.$url,0);
			}else
				alertInfo("Accident","",1);
		break;
		case "finish":
			$key=sqlReplace(trim($_GET['key']));
			$id=sqlReplace(trim($_GET['id']));
			$keyword=empty($_GET['keyword'])?'':sqlReplace(trim($_GET['keyword']));
			$start=empty($_GET['start'])?'':sqlReplace(trim($_GET['start']));
			$end=empty($_GET['end'])?'':sqlReplace(trim($_GET['end']));
			$url="?key=".$key."&keyword=".$keyword."&start=".$start."&end=".$end;
			$sql="select * from qiyu_order where order_id=".$id." and order_shopid='".$QIYU_ID_SHOP."' and order_status='5'";
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if ($rows){
				$order=$rows['order_id2'];
				$sql2="update qiyu_order set order_status='4'  where order_id=".$id;
				if(mysql_query($sql2)){
					//添加订单记录
				//	addOrderType($order,'订单已完成');
					$orderContent="<span class='greenbg'><span><span>Order finish</span></span></span>";
					$orderContent.="Welcome back to<?php echo $SHOP_NAME?>";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Operation success','shoporder.php'.$url,0);
				}else
					alertInfo('Operation failed, SQL error','shoporder.php'.$url,0);
			}else
				alertInfo("Accident","",1);
		break;
		
	}
	

	
?>