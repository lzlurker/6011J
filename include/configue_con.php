<?php
/**
 * 基本参数设置
 */

	error_reporting(0);    //网站开发必须关闭此处，网站上线必须打开此处
	header("content-type:text/html;charset=utf-8");
	date_default_timezone_set('Asia/Chongqing');
	session_start();
	ob_start();
	

	/**tab标识**/
	$CIRCLE_TAB="";
	$STYLE_TAB="";
	$FOOD_TAB="";
	$orderState=array('New order','Confirm order','Owner cancel','User cancel','Done','Preparing','Change order');
	$FOODSPECIALCOUNT=5; //置顶的数量
	$SCORETOTAL=array('','','Dissatisfied','','Not so satisfied','','General','','Good','','Very Good');
	$SCORETEST=array('','','Bad ','','Not good ','','General','','Good','','Very Good ');
	$SCORESPEED=array('','','Slow','','Not so fast','','Ok ','','Fast','','Super');
	$columnCircle=array('Family','Customized','Popular','Special','Discount');

	$SHOPID=1;

	$SHOPNAME_DDMIN='iEat';

	$version='v1.0';
	$updateTime='2018-08-13';
	$subversion='2018001';

	$powered='Powered By iEat'.$version;

	

?>