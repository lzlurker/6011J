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
	$act=$_GET['act'];
	$start=empty($_GET['start'])?'':$_GET['start'];
	$end=empty($_GET['end'])?'':$_GET['end'];
	$name=empty($_GET['name'])?'':$_GET['name'];
	$phone=empty($_GET['phone'])?'':$_GET['phone'];
	$order=empty($_GET['order'])?'':$_GET['order'];
	$url="&start=".$start."&end=".$end."&name=".$name."&phone=".$phone."&order=".$order;
	switch($act)
	{
		
		case 'del':
			$id=sqlReplace(trim($_GET['id']));
			$key=sqlReplace(trim($_GET['key']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_order where order_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('Order not exist','userorder.php?key='.$key.$url,0);
			}else{
				$sql2="delete from qiyu_order where order_id=".$id;
				if(mysql_query($sql2)){
					$sql3="delete from qiyu_orderchange where orderchange_order='".$row['order_id2']."'";
					if(mysql_query($sql3)){
						alertInfo('Deleted','',1);
					}
				}else{
					alertInfo('Failed, check SQL','',1);
				}
			}
			break;
		case "delAll":
			$id_list=$_POST["id_list"];
			$key=sqlReplace(trim($_GET['key']));
		    if(empty($id_list)){
				alertInfo('Selete to delete!','userorder.php?key='.$key,0);
			}else{
				foreach($id_list as $val){
					$sql="select * from qiyu_order where order_id=".$val."";
					$rs=mysql_query($sql);
					$row=mysql_fetch_assoc($rs);
					if($row){
						
						$sqlStr="delete from qiyu_order where order_id=".$val."";
						if(mysql_query($sqlStr)){
							$sql3="delete from qiyu_orderchange where orderchange_order='".$row['order_id2']."'";
							mysql_query($sql3);
						}else{
							alertInfo('Failed, check SQL。',"",1);
						}
					}else{
						alertInfo('Failed, not exist',"",1);
						exit;
					}
				}
				alertInfo('Deleted','',1);
			}
			break;
		case 'qx':
			$id=sqlReplace(trim($_GET['id']));
			$key=sqlReplace(trim($_GET['key']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_order where order_id=".$id." and order_status in(0,1,5)";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			$order_status=$row['order_status'];
			if(!$row){
				alertInfo('Order not exist','',1);
			}else{
				if ($order_status!='2'){
					$order=$row['order_id2'];
					if($key=='0'){
						$sql2="update qiyu_order set order_status='2',order_operator='".$QIYU_ID_SHOP."' where order_id=".$id." and order_status='0'";
					}else{
						$sql2="update qiyu_order set order_status='2' where order_id=".$id." and order_status in(1,5)";
					}
					if(mysql_query($sql2)){
						//添加订单记录
						$orderContent="<span class='greenbg redbg'><span><span>Cancel order</span></span></span>";
						$orderContent.="Canceled。";
						addOrderType($order,HTMLEncode($orderContent));
						alertInfo('Canceled','',1);
					}else{
						alertInfo('Failed, check SQL','',1);
					}
				}else{
					alertInfo('Success','',1);
				}
			}
			break;
		case 'sure':
			$id=sqlReplace(trim($_GET['id']));
			$key=sqlReplace(trim($_GET['key']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_order where order_id=".$id." and order_status='0'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('Order not exist','userorder.php?key='.$key.$url,0);
			}else{
				$order=$row['order_id2'];
				$sql2="update qiyu_order set order_status='1'  where order_id=".$id;
				if(mysql_query($sql2)){
					//添加订单记录
					$orderContent="<span class='greenbg'><span><span>我们正在下单</span></span></span>";
					$orderContent.="Cooking！";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Success','',1);
				}else{
					alertInfo('Failed, check SQL','',1);
				}
			}
			break;	
		case 'finish':
			$id=sqlReplace(trim($_GET['id']));
			$key=sqlReplace(trim($_GET['key']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_order where order_id=".$id." and order_status='1'";
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('Order not exist','',1);
			}else{
				$order=$row['order_id2'];
				$sql2="update qiyu_order set order_status='4'  where order_id=".$id." and order_status='1'";
				if(mysql_query($sql2)){
					//添加订单记录
					$orderContent="<span class='greenbg'><span><span>订单已完成</span></span></span>";
					$orderContent.="Enjoy".$SHOP_NAME."Thanks。";
					addOrderType($order,HTMLEncode($orderContent));
					alertInfo('Setup success','',1);
				}else{
					alertInfo('Failed, check SQL','',1);
				}
			}
			break;
		
		
		

	}

	
?>