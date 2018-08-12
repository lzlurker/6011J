<?php 

	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case 'del':
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_comment where comment_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('No user','',1);
			}else{
				
				$sql2="delete from qiyu_comment where comment_id=".$id;
				if(mysql_query($sql2)){
					alertInfo('Deleted','',1);
				}else{
					alertInfo('Failed, check SQL','',1);
				}
			}
			break;
		case 'type':
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_comment where comment_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('no data','',1);
			}else{
				$sql2="update qiyu_comment set comment_type='1' where comment_id=".$id;
				if(mysql_query($sql2)){
					alertInfo('Success','',1);
				}else{
					alertInfo('Failed, check SQL','',1);
				}
			}
			break;
		case "savetime":
			$i=trim($_POST['i']);
			for($x=1;$x<=$i;$x++){
				$id=$_POST['id'.$x];
				$id=checkData($id,'ID',0);
				$time=$_POST['time'.$x];
				$sql="update ".WIIDBPRE."_comment set comment_addtime='".$time."' where comment_id=".$id;
				
				mysql_query($sql);
			}
			alertInfo('Saved!',"",1);
		break;

		
	}
	

	
?>