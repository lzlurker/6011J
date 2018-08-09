<?php
	/**
	 *  userquit.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-6
	 * @update time
	 * @author        lujiangxia
	 * @copyright     Copyright (c) ΢�տƼ� WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	 require('../include/dbconn.php');
	setcookie("QIYUSHOP","",time()+60*60*24*7);
	setcookie("QIYUSHOPVERD","",time()+60*60*24*7);
	session_unset();
	session_destroy();
	Header("Location:index.php");
?>