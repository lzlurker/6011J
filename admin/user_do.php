<?php 

	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "del":
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$sql="select * from ".WIIDBPRE."_user where user_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('No user','',1);
			}else{
				$sql2="delete from ".WIIDBPRE."_user where user_id=".$id;
				if(mysql_query($sql2)){
					alertInfo('Deleted','',1);
				}else{
					alertInfo('Failed, check SQL','',1);
				}
					
			}
		break;

		case "xxdel"://批量删除
			$idlist= $_POST['idlist'];
			if(!$idlist){
				alertInfo('Select','userlist.php',0);
			}
            foreach ($idlist as $k=>$v){
				$sql="select * from ".WIIDBPRE."_user where user_id=".$v;				
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if(!$v){
					alertInfo('No user','',1);
				}else{
					$sql2="delete from ".WIIDBPRE."_user where user_id=".$v;
					if(!mysql_query($sql2)){
						alertInfo('Failed, check SQL','',1);
					}
						
				}
			}
			alertInfo('Deleted','',1);
		break;


		
	}
	

	
?>