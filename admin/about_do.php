<?php 

	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "add":
			//echo '<pre>';print_R($_POST);
			$title=sqlReplace(trim($_POST['title']));
			$type=sqlReplace(trim($_POST['about_type']));
			if($type=='1'){
			   $c=$_POST['content'];
			}else{
			   $c=$_POST['about_href'];
			}
			$content=$c;
			$content=str_replace("'","&#39;",$content);
			$content=str_replace("<br />","</p><p>",$content);
			//检验数据的合法性
			checkData($title,'Title',1);
			$sql="select * from qiyu_about where about_title='".$title."'";
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			if ($row){
				alertInfo('Title exist！','',1);
				exit;
			}else{
				$sql_r="insert into qiyu_about(about_title,about_type,about_content) values ('".$title."','".$type."','".$content."')";
				if(mysql_query($sql_r)){
					alertInfo('Add success','about.php',0);
				}else{
					alertInfo('Error, add failed','',1);
				}
			}
		break;
		case 'del':
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$sql="select * from qiyu_about where about_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row)
				alertInfo('data not exist','',1);
			else{
				$sql2="delete from qiyu_about where about_id=".$id;
				if(mysql_query($sql2))
					alertInfo('Delete successful','about.php',0);
				else
					alertInfo('Delete fail, SQL error','',1);
			}
			break;
		
		
		case "edit":
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$title=sqlReplace(trim($_POST['title']));
			$type=sqlReplace(trim($_POST['about_type']));
			if($type=='1'){
				$c=$_POST['about_content']; 		
			}else{
				$c=$_POST['about_href'];
			}
			$content=$c;
			$content=str_replace("'","&#39;",$content);
			$content=str_replace("<br />","</p><p>",$content);
			//检验数据的合法性
			checkData($title,'Title',1);
			$sql="select * from ".WIIDBPRE."_about where about_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row)
				alertInfo('非法操作','about_list.php',0);
			else{
				
				$sql2="update ".WIIDBPRE."_about set about_title='".$title."',about_type='".$type."',about_content='".$content."' where about_id=".$id;
				if(mysql_query($sql2))
					alertInfo('Change success','about.php',0);
				else
					alertInfo('Change fail, SQL error','about.php',0);
			}
			break;
		case "save":
				$i=trim($_POST['i']);
				for($x=1;$x<=$i;$x++){
					$id=$_POST['id'.$x];
					$id=checkData($id,'ID',0);
					$order=$_POST['order'.$x];
					$order=checkData($order,'ID',0);
					$sql="update ".WIIDBPRE."_about set about_order=".$order." where about_id=".$id."";
					mysql_query($sql);
				}
				alertInfo('Saved!',"about.php",0);
			break;
	}
	

	
?>