<?php 


			require_once("usercheck2.php");
			$pw=sqlReplace(trim($_POST['pw']));
			$newpw=sqlReplace(trim($_POST['newpw']));
			$repw=sqlReplace(trim($_POST['repw']));
			checkData($pw,'Original Password',1);
			checkData($newpw,'New Password',1);
			if($newpw!=$repw){
				alertInfo("The password entered 2 times are not the same","",1);
			} 
			
			$check_sql = "select user_password,user_salt from ".WIIDBPRE."_user where user_id=".$QIYU_ID_USER;
			$check_rs = mysql_query($check_sql);
			$check_row = mysql_fetch_assoc($check_rs);
			if(!$check_row){
				alertInfo('Illegal user','',1);
			}else{
				$oldpw=md5(md5($pw.$check_row['user_salt']));
				if($oldpw!=$check_row['user_password']){
					alertInfo('Original password is wrong','',1);
				}else{
					$upd_sql = "update ".WIIDBPRE."_user set user_password='".md5(md5($newpw.$check_row['user_salt']))."' where user_id=".$QIYU_ID_USER;
					if(mysql_query($upd_sql)){
						alertInfo('Password change succeed','usercenter.php',0);
					}else{
						alertInfo('Password change fail','',1);
					}
				}
				
			}
?>