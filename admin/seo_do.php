<?php

	require_once("usercheck2.php");
	$act=$_GET['act'];
	
	switch($act)
	{
		case "index":
			$title=sqlReplace($_POST['title']);
			$keywords=HTMLEncode($_POST['keywords']);
			$description=HTMLEncode($_POST['description']);
				
			$sql="update ".WIIDBPRE."_seo set seo_title='".$title."',  seo_keywords='".$keywords."',seo_description='".$description."' where seo_type=1";	
			if(!mysql_query($sql)){
				alertInfo('unknow fail to save! ',"",1);
			}else{
				alertInfo('Saved!',"seo.php",0);
			}
			
		break;
		

	}
?>
