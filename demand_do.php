<?php
	/**
	 * demand.php     提交需求
	 *
	 * @version       v0.01
	 * @create time   2011-9-19
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
			require('include/dbconn.php');

			$content=sqlReplace(trim($_GET['content']));
			checkData($content,'内容',1);
			$ip=$_SERVER['REMOTE_ADDR'];
			$sql="insert into ".WIIDBPRE."_demand(demand_content,demand_addtime,demand_ip) values('".$content."',now(),'".$ip."')";
			$rs=mysql_query($sql);
			if(!$rs)
				//alertInfo('此收藏已不存在',"usercenter.php?tab=4",0);
				echo '未知原因，提交失败';
			else{
				echo '感谢您的关注，我们会尽快开发您周边的餐厅';
			}
?>