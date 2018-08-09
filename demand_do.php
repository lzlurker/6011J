<?php
	
			require('include/dbconn.php');

			$content=sqlReplace(trim($_GET['content']));
			checkData($content,'Content',1);
			$ip=$_SERVER['REMOTE_ADDR'];
			$sql="insert into ".WIIDBPRE."_demand(demand_content,demand_addtime,demand_ip) values('".$content."',now(),'".$ip."')";
			$rs=mysql_query($sql);
			if(!$rs)
				//alertInfo('此收藏已不存在',"usercenter.php?tab=4",0);
				echo 'Unknown reason, submission failed';
			else{
				echo 'Thank you for your attention, we will develop the restaurants around you as soon as possible.';
			}
?>