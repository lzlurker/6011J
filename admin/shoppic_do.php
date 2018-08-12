<?php 

	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case 'add':
			
			//得到提交的数据，并进行过滤
			$shopid1=$SHOPID;
			$shoppics=sqlReplace(trim($_POST['upfile1']));
			checkData($shopid1,'shopID',1);
			checkData($shoppics,'Restaurant picture',1);
			
			$sql="select * from qiyu_shop where shop_id=".$shopid1;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if(!$rows){
				alertInfo('shopID error','',1);
			}else{
				$sql = "insert into ".WIIDBPRE."_shoppics(shoppics_shop,shoppics_url) values (".$shopid1.",'".$shoppics."')";
				$result=mysql_query($sql);
				if($result){

					alertInfo('Restaurant picture added',"",1);
				}else{

					alertInfo('Error, retry',"",1);
				}
			}
			break;
		case 'del':
			$id=sqlReplace(trim($_GET['id']));
			checkData($id,"ID",0);
			$sql="select * from ".WIIDBPRE."_shoppics where shoppics_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){

				alertInfo('No data','',1);
			}else{
				$sql2="delete from ".WIIDBPRE."_shoppics where shoppics_id=".$id;
				if(mysql_query($sql2)){

					alertInfo('Deleted','',1);
				}else{

					alertInfo('Error, retry','',1);
				}
			}
			break;
		
	}
	

	
?>