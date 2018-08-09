<?php

/**
 * install_sql.php
 *
 * @version       v0.01
 * @create time   2011-5-30
 * @update time   
 * @author        wiipu
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. ( http://www.wiipu.com)
 * @informaition  

 * Update Record:
 *
 */
$sqlstr[0]="DROP TABLE IF EXISTS ".$prefix."_about";
$sqlstr[1]="DROP TABLE IF EXISTS ".$prefix."_admingroup";
$sqlstr[2]="DROP TABLE IF EXISTS ".$prefix."_admin";
$sqlstr[3]="DROP TABLE IF EXISTS ".$prefix."_adpic";
$sqlstr[4]="DROP TABLE IF EXISTS ".$prefix."_area";
$sqlstr[5]="DROP TABLE IF EXISTS ".$prefix."_areacircle";
$sqlstr[6]="DROP TABLE IF EXISTS ".$prefix."_brand";
$sqlstr[7]="DROP TABLE IF EXISTS ".$prefix."_brandshop";
$sqlstr[8]="DROP TABLE IF EXISTS ".$prefix."_button";
$sqlstr[9]="DROP TABLE IF EXISTS ".$prefix."_cart";
$sqlstr[10]="DROP TABLE IF EXISTS ".$prefix."_circle";
$sqlstr[11]="DROP TABLE IF EXISTS ".$prefix."_circlecolumn";
$sqlstr[12]="DROP TABLE IF EXISTS ".$prefix."_comment";
$sqlstr[13]="DROP TABLE IF EXISTS ".$prefix."_deliver";
$sqlstr[14]="DROP TABLE IF EXISTS ".$prefix."_deliverbycircle";
$sqlstr[15]="DROP TABLE IF EXISTS ".$prefix."_delivertime";
$sqlstr[16]="DROP TABLE IF EXISTS ".$prefix."_demand";
$sqlstr[17]="DROP TABLE IF EXISTS ".$prefix."_fav";
$sqlstr[18]="DROP TABLE IF EXISTS ".$prefix."_food";
$sqlstr[19]="DROP TABLE IF EXISTS ".$prefix."_foodbylable";
$sqlstr[20]="DROP TABLE IF EXISTS ".$prefix."_foodlable";
$sqlstr[21]="DROP TABLE IF EXISTS ".$prefix."_foodtype";
$sqlstr[22]="DROP TABLE IF EXISTS ".$prefix."_group";
$sqlstr[23]="DROP TABLE IF EXISTS ".$prefix."_groupcount";
$sqlstr[24]="DROP TABLE IF EXISTS ".$prefix."_indexfoodhot";
$sqlstr[25]="DROP TABLE IF EXISTS ".$prefix."_indexrmd";
$sqlstr[26]="DROP TABLE IF EXISTS ".$prefix."_indexshop";
$sqlstr[27]="DROP TABLE IF EXISTS ".$prefix."_indexshophot";
$sqlstr[28]="DROP TABLE IF EXISTS ".$prefix."_indexteachfood";
$sqlstr[29]="DROP TABLE IF EXISTS ".$prefix."_indexteachfood";
$sqlstr[30]="DROP TABLE IF EXISTS ".$prefix."_like";
$sqlstr[31]="DROP TABLE IF EXISTS ".$prefix."_log";
$sqlstr[32]="DROP TABLE IF EXISTS ".$prefix."_message";
$sqlstr[33]="DROP TABLE IF EXISTS ".$prefix."_notice";
$sqlstr[34]="DROP TABLE IF EXISTS ".$prefix."_order";
$sqlstr[35]="DROP TABLE IF EXISTS ".$prefix."_orderchange";
$sqlstr[36]="DROP TABLE IF EXISTS ".$prefix."_rmd";
$sqlstr[37]="DROP TABLE IF EXISTS ".$prefix."_rmdsort";
$sqlstr[38]="DROP TABLE IF EXISTS ".$prefix."_rscore";
$sqlstr[39]="DROP TABLE IF EXISTS ".$prefix."_seo";
$sqlstr[40]="DROP TABLE IF EXISTS ".$prefix."_shop";
$sqlstr[41]="DROP TABLE IF EXISTS ".$prefix."_shopbycirclermd";
$sqlstr[42]="DROP TABLE IF EXISTS ".$prefix."_shopbysort";
$sqlstr[43]="DROP TABLE IF EXISTS ".$prefix."_shopbysortbycircle";
$sqlstr[44]="DROP TABLE IF EXISTS ".$prefix."_shopcircle";
$sqlstr[45]="DROP TABLE IF EXISTS ".$prefix."_shophot";
$sqlstr[46]="DROP TABLE IF EXISTS ".$prefix."_shoppics";
$sqlstr[47]="DROP TABLE IF EXISTS ".$prefix."_shoprmd";
$sqlstr[48]="DROP TABLE IF EXISTS ".$prefix."_shopsort";
$sqlstr[49]="DROP TABLE IF EXISTS ".$prefix."_shopspot";
$sqlstr[50]="DROP TABLE IF EXISTS ".$prefix."_shopstyle";
$sqlstr[51]="DROP TABLE IF EXISTS ".$prefix."_shoptag";
$sqlstr[52]="DROP TABLE IF EXISTS ".$prefix."_shoptagbycircle";
$sqlstr[53]="DROP TABLE IF EXISTS ".$prefix."_site";
$sqlstr[54]="DROP TABLE IF EXISTS ".$prefix."_sortbytab";
$sqlstr[55]="DROP TABLE IF EXISTS ".$prefix."_specialact";
$sqlstr[56]="DROP TABLE IF EXISTS ".$prefix."_spot";
$sqlstr[57]="DROP TABLE IF EXISTS ".$prefix."_style";
$sqlstr[58]="DROP TABLE IF EXISTS ".$prefix."_tag";
$sqlstr[59]="DROP TABLE IF EXISTS ".$prefix."_user";
$sqlstr[60]="DROP TABLE IF EXISTS ".$prefix."_useraddr";
$sqlstr[61]="DROP TABLE IF EXISTS ".$prefix."_userscore";
$sqlstr[62]="DROP TABLE IF EXISTS ".$prefix."_file";




$sqlstr[63]="CREATE TABLE `".$prefix."_about` (
  `about_id` int(4) NOT NULL AUTO_INCREMENT,
  `about_title` varchar(100) DEFAULT NULL,
  `about_content` text,
  `about_order` int(4) DEFAULT '999',
  PRIMARY KEY (`about_id`)
)   DEFAULT CHARSET=utf8 ;";
									
$sqlstr[64]="CREATE TABLE `".$prefix."_admin` (
  `admin_id` int(4) NOT NULL AUTO_INCREMENT,
  `admin_account` varchar(50) DEFAULT NULL,
  `admin_password` varchar(50) DEFAULT NULL,
  `admin_logintime` datetime DEFAULT NULL,
  `admin_loginip` varchar(100) DEFAULT NULL,
  `admin_logincount` int(10) DEFAULT '0',
  `admin_group` int(4) NOT NULL,
  `admin_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
)  DEFAULT CHARSET=utf8;";
					
$sqlstr[65]="CREATE TABLE `".$prefix."_admingroup` (
  `admingroup_id` int(4) NOT NULL AUTO_INCREMENT,
  `admingroup_name` varchar(50) NOT NULL,
  `admingroup_power` varchar(400) DEFAULT NULL,
  `admingroup_order` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admingroup_id`)
)  DEFAULT CHARSET=utf8;";


$sqlstr[66]="CREATE TABLE `".$prefix."_adpic` (
  `adpic_id` int(11) NOT NULL AUTO_INCREMENT,
  `adpic_type` char(1) NOT NULL,
  `adpic_url` varchar(200) DEFAULT NULL,
  `adpic_link` varchar(200) DEFAULT NULL,
  `adpic_text` varchar(200) DEFAULT NULL,
  `adpic_order` int(4) NOT NULL DEFAULT '0',
  `adpic_circle` int(4) DEFAULT NULL,
  `adpic_spot` int(10) DEFAULT NULL,
  `adpic_title2` varchar(50) DEFAULT NULL,
  `adpic_addtype` char(1) DEFAULT '1',
  PRIMARY KEY (`adpic_id`)
)  DEFAULT CHARSET=utf8 ; ";

$sqlstr[67]="CREATE TABLE `".$prefix."_area` (
  `area_id` int(10) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) NOT NULL,
  `area_order` int(10) NOT NULL DEFAULT '999',
  PRIMARY KEY (`area_id`)
)  DEFAULT CHARSET=utf8  ;";

$sqlstr[68]="CREATE TABLE `".$prefix."_areacircle` (
  `areacircle_id` int(10) NOT NULL AUTO_INCREMENT,
  `areacircle_area` int(10) NOT NULL,
  `areacircle_circle` int(10) NOT NULL,
  PRIMARY KEY (`areacircle_id`)
)  DEFAULT CHARSET=utf8  ;";

$sqlstr[69]="CREATE TABLE IF NOT EXISTS `".$prefix."_file` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_topic` int(10) unsigned NOT NULL,
  `file_addtime` datetime DEFAULT NULL,
  `file_url` varchar(100) DEFAULT NULL,
  `file_type` varchar(8) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `file_size` varchar(20) DEFAULT NULL,
  `file_sort` char(1) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[70]="CREATE TABLE `".$prefix."_brand` (
  `brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) DEFAULT NULL,
  `brand_pic` varchar(100) DEFAULT NULL,
  `brand_order` int(4) unsigned DEFAULT '999',
  `brand_rmd` char(1) DEFAULT NULL,
  `brand_pic2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
)  DEFAULT CHARSET=utf8  ;";

$sqlstr[71]="CREATE TABLE `".$prefix."_brandshop` (
  `brandshop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandshop_brand` int(10) unsigned DEFAULT NULL,
  `brandshop_shop` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`brandshop_id`)
)  DEFAULT CHARSET=utf8  ;";

$sqlstr[72]="CREATE TABLE `".$prefix."_button` (
  `button_id` int(11) NOT NULL AUTO_INCREMENT,
  `button_color` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `button_bttext` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `button_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `button_content` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`button_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[73]="CREATE TABLE `".$prefix."_cart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_order` varchar(50) DEFAULT NULL,
  `cart_shop` varchar(50) DEFAULT NULL,
  `cart_user` int(10) unsigned DEFAULT NULL,
  `cart_food` int(10) unsigned DEFAULT NULL,
  `cart_price` decimal(10,2) DEFAULT '0.00',
  `cart_count` int(4) unsigned DEFAULT NULL,
  `cart_status` char(1) DEFAULT NULL,
  `cart_session` varchar(50) DEFAULT NULL,
  `cart_type` char(1) DEFAULT NULL,
  `cart_desc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[74]="CREATE TABLE `".$prefix."_circle` (
  `circle_id` int(10) NOT NULL AUTO_INCREMENT,
  `circle_name` varchar(100) NOT NULL,
  `circle_order` int(4) NOT NULL DEFAULT '999',
  `circle_recommend` char(1) DEFAULT NULL,
  `circle_online` char(1) DEFAULT '0',
  PRIMARY KEY (`circle_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[75]="CREATE TABLE `".$prefix."_circlecolumn` (
  `circlecolumn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `circlecolumn_name` char(1) DEFAULT NULL,
  `circlecolumn_circle` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`circlecolumn_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[76]="CREATE TABLE `".$prefix."_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_user` int(10) unsigned DEFAULT NULL,
  `comment_shop` int(10) unsigned DEFAULT NULL,
  `comment_addtime` datetime DEFAULT NULL,
  `comment_type` char(1) DEFAULT '0',
  `comment_content` text,
  PRIMARY KEY (`comment_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[77]="CREATE TABLE IF NOT EXISTS `".$prefix."_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_content` text,
  `reply_user` varchar(50) DEFAULT NULL,
  `reply_posttime` datetime DEFAULT NULL,
  `reply_edittime` datetime DEFAULT NULL,
  `reply_topic` int(11) DEFAULT NULL,
  `reply_board` int(11) DEFAULT NULL,
  `reply_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`reply_id`)
) DEFAULT CHARSET=utf8 ;";

$sqlstr[78]="CREATE TABLE `".$prefix."_deliver` (
  `deliver_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deliver_fee` int(4) DEFAULT NULL,
  `deliver_spot` int(4) DEFAULT NULL,
  `deliver_minfee` int(4) DEFAULT NULL,
  `deliver_delivertime` varchar(70) DEFAULT NULL,
  `deliver_shop` int(10) unsigned DEFAULT NULL,
  `deliver_isfee` char(1) DEFAULT '0',
  PRIMARY KEY (`deliver_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[79]="CREATE TABLE `".$prefix."_deliverbycircle` (
  `deliverbycircle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deliverbycircle_fee` int(4) unsigned DEFAULT NULL,
  `deliverbycircle_minfee` int(4) unsigned DEFAULT NULL,
  `deliverbycircle_circle` int(10) unsigned DEFAULT NULL,
  `deliverbycircle_delivertime` varchar(50) DEFAULT NULL,
  `deliverbycircle_shop` int(10) unsigned DEFAULT NULL,
  `deliverbycircle_isfee` char(1) DEFAULT NULL,
  PRIMARY KEY (`deliverbycircle_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[80]="CREATE TABLE `".$prefix."_delivertime` (
  `delivertime_id` int(10) NOT NULL AUTO_INCREMENT,
  `delivertime_name` varchar(50) DEFAULT NULL,
  `delivertime_shop` int(10) DEFAULT NULL,
  `delivertime_starttime` time DEFAULT NULL,
  `delivertime_endtime` time DEFAULT NULL,
  PRIMARY KEY (`delivertime_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[81]="CREATE TABLE `".$prefix."_demand` (
  `demand_id` int(11) NOT NULL AUTO_INCREMENT,
  `demand_content` varchar(100) NOT NULL,
  `demand_addtime` datetime NOT NULL,
  `demand_ip` varchar(30) NOT NULL,
  PRIMARY KEY (`demand_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[82]="CREATE TABLE `".$prefix."_fav` (
  `fav_id` int(10) NOT NULL AUTO_INCREMENT,
  `fav_user` int(10) NOT NULL,
  `fav_shop` int(10) NOT NULL,
  `fav_time` varchar(30) NOT NULL,
  PRIMARY KEY (`fav_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[83]="CREATE TABLE `".$prefix."_food` (
  `food_id` int(10) NOT NULL AUTO_INCREMENT,
  `food_foodtype` int(10) DEFAULT NULL,
  `food_shop` int(10) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_price` decimal(10,2) DEFAULT '0.00',
  `food_status` char(1) NOT NULL DEFAULT '0',
  `food_intro` varchar(300) DEFAULT NULL,
  `food_pic` varchar(200) DEFAULT NULL,
  `food_special` char(1) DEFAULT NULL,
  `food_order` int(4) NOT NULL DEFAULT '0',
  `food_oldprice` smallint(10) DEFAULT '0',
  `food_check` char(1) DEFAULT '0',
  `food_groupprice` decimal(10,2) DEFAULT '0.00',
  `food_isshow` char(1) DEFAULT '0',
  `food_count` int(4) DEFAULT '0',
  PRIMARY KEY (`food_id`)
)   DEFAULT CHARSET=utf8 ;";
$sqlstr[84]="CREATE TABLE `".$prefix."_foodbylable` (
  `foodbylable_id` int(10) NOT NULL AUTO_INCREMENT,
  `foodbylable_foodlable` int(10) NOT NULL,
  `foodbylable_food` int(10) NOT NULL,
  PRIMARY KEY (`foodbylable_id`)
)  DEFAULT CHARSET=utf8 ;";
$sqlstr[85]="CREATE TABLE `".$prefix."_foodlable` (
  `foodlable_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodlable_name` varchar(50) DEFAULT NULL,
  `foodlable_icon` varchar(50) DEFAULT NULL,
  `foodlable_order` int(11) NOT NULL DEFAULT '999',
  PRIMARY KEY (`foodlable_id`)
)   DEFAULT CHARSET=utf8 ;";
$sqlstr[86]="CREATE TABLE `".$prefix."_foodtype` (
  `foodtype_id` int(10) NOT NULL AUTO_INCREMENT,
  `foodtype_name` varchar(50) NOT NULL,
  `foodtype_shop` int(10) NOT NULL,
  `foodtype_order` int(10) NOT NULL DEFAULT '999',
  PRIMARY KEY (`foodtype_id`)
)   DEFAULT CHARSET=utf8;";
$sqlstr[87]="CREATE TABLE `".$prefix."_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_order` int(4) unsigned DEFAULT '999',
  `group_circle` int(10) unsigned DEFAULT NULL,
  `group_spot` int(10) unsigned DEFAULT NULL,
  `group_shop` int(10) unsigned DEFAULT NULL,
  `group_food` int(10) unsigned DEFAULT NULL,
  `group_target` int(4) unsigned DEFAULT '0',
  `group_reserve` int(4) unsigned DEFAULT '0',
  `group_type` char(1) DEFAULT NULL,
  `group_online` char(1) DEFAULT '0',
  PRIMARY KEY (`group_id`)
)  DEFAULT CHARSET=utf8;";
$sqlstr[88]="CREATE TABLE `".$prefix."_groupcount` (
  `groupcount_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupcount_group` int(10) unsigned DEFAULT NULL,
  `groupcount_user` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`groupcount_id`)
)  DEFAULT CHARSET=utf8 ;";
$sqlstr[89]="CREATE TABLE `".$prefix."_indexfoodhot` (
  `indexfoodhot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indexfoodhot_order` int(4) unsigned DEFAULT '999',
  `indexfoodhot_circle` int(10) unsigned DEFAULT NULL,
  `indexfoodhot_shop` int(10) unsigned DEFAULT NULL,
  `indexfoodhot_food` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`indexfoodhot_id`)
)  DEFAULT CHARSET=utf8;";
$sqlstr[90]="CREATE TABLE `".$prefix."_indexrmd` (
  `indexrmd_id` int(10) NOT NULL AUTO_INCREMENT,
  `indexrmd_circle` int(4) DEFAULT NULL,
  `indexrmd_spot` int(4) DEFAULT NULL,
  `indexrmd_shop` int(4) DEFAULT NULL,
  `indexrmd_title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `indexrmd_type` char(1) CHARACTER SET utf8 DEFAULT '0',
  `indexrmd_info` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `indexrmd_index` char(1) CHARACTER SET utf8 DEFAULT '0',
  `indexrmd_url` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `indexrmd_rmd` char(1) CHARACTER SET utf8 DEFAULT '1',
  `indexrmd_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`indexrmd_id`)
)  DEFAULT CHARSET=utf8;";
$sqlstr[91]="CREATE TABLE `".$prefix."_indexshop` (
  `indexshop_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indexshop_circle` int(10) unsigned DEFAULT NULL,
  `indexshop_shop` int(10) unsigned DEFAULT NULL,
  `indexshop_pic` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `indexshop_order` int(4) unsigned DEFAULT '999',
  `indexshop_type` char(1) CHARACTER SET utf8 DEFAULT NULL,
  `indexshop_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`indexshop_id`)
)  DEFAULT CHARSET=utf8;";
$sqlstr[92]="CREATE TABLE `".$prefix."_indexshophot` (
  `indexshophot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indexshophot_order` int(4) unsigned DEFAULT '999',
  `indexshophot_circle` int(4) unsigned DEFAULT NULL,
  `indexshophot_shop` int(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`indexshophot_id`)
)  DEFAULT CHARSET=utf8;";


$sqlstr[93]="CREATE TABLE `".$prefix."_indexteachfood` (
  `teachfood_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teachfood_title` varchar(100) DEFAULT NULL,
  `teachfood_desc` varchar(100) DEFAULT NULL,
  `teachfood_content` text,
  `teachfood_addtime` datetime DEFAULT NULL,
  `teachfood_pic` varchar(100) DEFAULT NULL,
  `teachfood_order` int(4) unsigned DEFAULT '999',
  `teachfood_type` char(1) DEFAULT NULL,
  PRIMARY KEY (`teachfood_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[94]="CREATE TABLE `".$prefix."_like` (
  `like_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `like_shop` int(10) unsigned DEFAULT NULL,
  `like_user` int(10) unsigned DEFAULT NULL,
  `like_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`like_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[95]="CREATE TABLE `".$prefix."_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `log_title` varchar(300) NOT NULL,
  `log_order` int(10) NOT NULL DEFAULT '999',
  `log_addtime` datetime NOT NULL,
  `log_index` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`)
)  DEFAULT CHARSET=utf8;";
$sqlstr[96]="CREATE TABLE `".$prefix."_message` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `message_order` varchar(50) DEFAULT NULL,
  `message_phone` varchar(50) DEFAULT NULL,
  `message_content` varchar(100) DEFAULT NULL,
  `message_time` datetime DEFAULT NULL,
  `message_type` char(1) DEFAULT NULL,
  `message_look` char(1) DEFAULT '1',
  PRIMARY KEY (`message_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[97]="CREATE TABLE `".$prefix."_notice` (
  `notice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notice_content` varchar(300) DEFAULT NULL,
  `notice_circle` int(10) unsigned DEFAULT NULL,
  `notice_spot` int(10) unsigned DEFAULT NULL,
  `notice_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`notice_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[98]="CREATE TABLE `".$prefix."_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id2` varchar(50) NOT NULL,
  `order_shop` varchar(50) DEFAULT NULL,
  `order_user` int(10) unsigned DEFAULT NULL,
  `order_addtime` datetime DEFAULT NULL,
  `order_totalprice` decimal(10,2) DEFAULT '0.00',
  `order_price` decimal(10,2) DEFAULT '0.00',
  `order_deliverprice` int(4) unsigned DEFAULT '0',
  `order_status` char(1) DEFAULT '0',
  `order_comment` int(4) unsigned DEFAULT NULL,
  `order_cmttaste` int(4) unsigned DEFAULT NULL,
  `order_cmtpackage` int(4) unsigned DEFAULT NULL,
  `order_cmtspeed` int(4) unsigned DEFAULT NULL,
  `order_infor` varchar(300) DEFAULT NULL,
  `order_useraddr` int(10) unsigned DEFAULT NULL,
  `order_text` varchar(300) DEFAULT NULL,
  `order_address` varchar(300) DEFAULT NULL,
  `order_username` varchar(50) DEFAULT NULL,
  `order_userphone` varchar(50) DEFAULT NULL,
  `order_shopid` int(10) unsigned DEFAULT NULL,
  `order_area` varchar(100) DEFAULT NULL,
  `order_circle` varbinary(100) DEFAULT NULL,
  `order_spot` varbinary(100) DEFAULT NULL,
  `order_build` varchar(100) DEFAULT NULL,
  `order_operator` varchar(100) DEFAULT NULL,
  `order_pricechange` decimal(10,2) DEFAULT '0.00',
  `order_type` char(1) DEFAULT '0',
  `order_time1` date DEFAULT NULL,
  `order_time2` time DEFAULT NULL,
  `order_ispay` char(1) DEFAULT '0',
  PRIMARY KEY (`order_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[99]="CREATE TABLE `".$prefix."_orderchange` (
  `orderchange_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderchange_order` varchar(50) DEFAULT NULL,
  `orderchange_addtime` datetime DEFAULT NULL,
  `orderchange_name` varchar(500) DEFAULT NULL,
  `orderchange_hurry` char(1) DEFAULT NULL,
  `orderchange_type` char(1) DEFAULT '0',
  `roderchange_typechange` char(1) DEFAULT NULL,
  PRIMARY KEY (`orderchange_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[100]="CREATE TABLE `".$prefix."_rmd` (
  `rmd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rmd_spot` int(10) unsigned DEFAULT NULL,
  `rmd_circle` int(10) unsigned DEFAULT NULL,
  `rmd_type` char(1) CHARACTER SET utf8 DEFAULT NULL,
  `rmd_shop` int(10) unsigned DEFAULT NULL,
  `rmd_rmdsort1` int(10) unsigned DEFAULT NULL,
  `rmd_rmdsort2` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`rmd_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[101]="CREATE TABLE `".$prefix."_rmdsort` (
  `rmdsort_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rmdsort_name` varchar(50) DEFAULT NULL,
  `rmdsort_parent` int(10) unsigned DEFAULT NULL,
  `rmdsort_level` int(4) unsigned DEFAULT NULL,
  `rmdsort_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`rmdsort_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[102]="CREATE TABLE `".$prefix."_rscore` (
  `rscore_id` int(10) NOT NULL AUTO_INCREMENT,
  `rscore_user` int(10) NOT NULL,
  `rscore_order` varchar(50) NOT NULL,
  `rscore_shop` int(10) unsigned DEFAULT NULL,
  `rscore_spendvalue` decimal(6,2) unsigned DEFAULT '0.00',
  `rscore_type` char(1) DEFAULT NULL,
  `rscore_getvalue` decimal(6,2) unsigned DEFAULT '0.00',
  `rscore_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`rscore_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[103]="CREATE TABLE `".$prefix."_seo` (
  `seo_id` int(10) NOT NULL AUTO_INCREMENT,
  `seo_title` varchar(300) DEFAULT NULL,
  `seo_keywords` varchar(300) DEFAULT NULL,
  `seo_description` varchar(600) DEFAULT NULL,
  `seo_type` char(1) NOT NULL,
  `seo_spot` int(11) DEFAULT NULL,
  `seo_circle` int(11) DEFAULT NULL,
  `seo_shop` int(11) DEFAULT NULL,
  PRIMARY KEY (`seo_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[104]="CREATE TABLE `".$prefix."_shop` (
  `shop_id` int(10) NOT NULL AUTO_INCREMENT,
  `shop_id2` varchar(50) DEFAULT NULL,
  `shop_name` varchar(100) DEFAULT NULL,
  `shop_headpic1` varchar(100) DEFAULT NULL,
  `shop_headpic2` varchar(100) DEFAULT NULL,
  `shop_sendfee` int(4) DEFAULT '0',
  `shop_ordernum` int(10) DEFAULT '1000001',
  `shop_tagfree` char(1) DEFAULT NULL,
  `shop_tagdeliver` int(4) DEFAULT NULL,
  `shop_tagcert` char(1) DEFAULT '0',
  `shop_taghot` char(1) DEFAULT '0',
  `shop_tagreturn` char(1) DEFAULT '0',
  `shop_address` varchar(200) DEFAULT NULL,
  `shop_tel` varchar(50) DEFAULT NULL,
  `shop_email` varchar(50) DEFAULT NULL,
  `shop_deliverfee` int(4) DEFAULT '0',
  `shop_delivertime` varchar(50) DEFAULT NULL,
  `shop_deliverscope` text,
  `shop_map` varchar(400) DEFAULT NULL,
  `shop_openstarttime` TIME DEFAULT NULL,
  `shop_openendtime` TIME DEFAULT NULL,
  `shop_intro` text,
  `shop_status` char(1) DEFAULT NULL,
  `shop_addtime` datetime DEFAULT NULL,
  `shop_certpic` varchar(100) DEFAULT NULL,
  `shop_speedscore` int(4) DEFAULT '0',
  `shop_tastescore` int(4) DEFAULT '0',
  `shop_totalscore` int(4) DEFAULT '0',
  `shop_creatway` char(1) DEFAULT NULL,
  `shop_creator` varchar(30) DEFAULT NULL,
  `shop_order` int(4) unsigned DEFAULT '999',
  `shop_mainfood` varchar(500) DEFAULT NULL,
  `shop_type` char(1) DEFAULT NULL,
  `shop_phone` varchar(45) DEFAULT NULL,
  `shop_account` varchar(50) DEFAULT NULL,
  `shop_password` varchar(50) DEFAULT NULL,
  `shop_busy` char(1) DEFAULT '1',
  `shop_signtime` datetime DEFAULT NULL,
  `shop_signtype` varchar(50) DEFAULT NULL,
  `shop_salt` varchar(20) DEFAULT NULL,
  `shop_area` int(10) unsigned DEFAULT NULL,
  `shop_circle` int(10) unsigned DEFAULT NULL,
  `shop_spot` int(10) unsigned DEFAULT NULL,
  `shop_computer` char(1) DEFAULT NULL,
  `shop_contactname` varchar(50) DEFAULT NULL,
  `shop_contactphone` varchar(50) DEFAULT NULL,
  `shop_licensepic` varchar(100) DEFAULT NULL,
  `shop_licensetime` datetime DEFAULT NULL,
  `shop_certtime` datetime DEFAULT NULL,
  `shop_code` varchar(45) DEFAULT NULL,
  `shop_prefer` int(10) unsigned DEFAULT '0',
  `shop_visit` int(10) unsigned DEFAULT '0',
  `shop_busytime` datetime DEFAULT NULL,
  `shop_face` char(1) DEFAULT '0',
  `shop_shopsort` int(10) unsigned DEFAULT NULL,
  `shop_pay` varchar(10) DEFAULT '0',
  `shop_lng` double(10,6) DEFAULT '0.000000',
  `shop_lat` double(10,6) DEFAULT '0.000000',
  `shop_feature` varchar(200) DEFAULT NULL,
  `shop_discount` decimal(10,1) DEFAULT '0.0',
  `shop_average` varchar(50) DEFAULT NULL,
  `shop_hot` char(1) DEFAULT NULL,
  `shop_buycount` int(10) unsigned DEFAULT '0',
  `shop_telclickcount` int(10) unsigned DEFAULT '0',
  `shop_istakeaway` char(1) DEFAULT '0',
  PRIMARY KEY (`shop_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[105]="CREATE TABLE `".$prefix."_shopbycirclermd` (
  `shopbycirclermd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopbycirclermd_shop` int(10) unsigned DEFAULT NULL,
  `shopbycirclermd_circle` int(10) unsigned DEFAULT NULL,
  `shopbycirclermd_pic` varchar(100) DEFAULT NULL,
  `shopbycirclermd_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`shopbycirclermd_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[106]="CREATE TABLE `".$prefix."_shopbysort` (
  `shopbysort_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopbysort_shopsort` int(10) unsigned DEFAULT NULL,
  `shopbysort_circle` int(10) unsigned DEFAULT NULL,
  `shopbysort_spot` int(10) unsigned DEFAULT NULL,
  `shopbysort_shop` int(10) unsigned DEFAULT NULL,
  `shopbysort_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`shopbysort_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[107]="CREATE TABLE `".$prefix."_shopbysortbycircle` (
  `shopbysortbycircle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopbysortbycircle_shopsort` int(10) unsigned DEFAULT NULL,
  `shopbysortbycircle_circle` int(10) unsigned DEFAULT NULL,
  `shopbysortbycircle_shop` int(10) unsigned DEFAULT NULL,
  `shopbysortbycircle_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`shopbysortbycircle_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[108]="CREATE TABLE `".$prefix."_shopcircle` (
  `shopcircle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopcircle_circle` int(10) unsigned DEFAULT NULL,
  `shopcircle_shop` int(10) unsigned DEFAULT NULL,
  `shopcircle_order` int(4) unsigned DEFAULT '999',
  PRIMARY KEY (`shopcircle_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[109]="CREATE TABLE `".$prefix."_shophot` (
  `shophot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shophot_order` int(4) unsigned DEFAULT '999',
  `shophot_circle` int(10) unsigned DEFAULT NULL,
  `shophot_spot` int(10) unsigned DEFAULT NULL,
  `shophot_shop` int(10) unsigned DEFAULT NULL,
  `shophot_type` char(1) DEFAULT NULL,
  PRIMARY KEY (`shophot_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[110]="CREATE TABLE `".$prefix."_shoppics` (
  `shoppics_id` int(10) NOT NULL AUTO_INCREMENT,
  `shoppics_shop` int(10) DEFAULT NULL,
  `shoppics_url` varchar(50) DEFAULT NULL,
  `shoppics_order` int(10) DEFAULT '999',
  PRIMARY KEY (`shoppics_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[111]="CREATE TABLE `".$prefix."_shoprmd` (
  `shoprmd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shoprmd_spot` int(10) DEFAULT NULL,
  `shoprmd_shop` int(10) unsigned DEFAULT NULL,
  `shoprmd_style` int(10) unsigned DEFAULT NULL,
  `shoprmd_circle` int(10) unsigned DEFAULT NULL,
  `shoprmd_level` char(1) DEFAULT NULL,
  PRIMARY KEY (`shoprmd_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[112]="CREATE TABLE `".$prefix."_shopsort` (
  `shopsort_id` int(10) NOT NULL AUTO_INCREMENT,
  `shopsort_shop` int(10) DEFAULT NULL,
  `shopsort_name` varchar(100) DEFAULT NULL,
  `shopsort_order` int(11) DEFAULT '999',
  `shopsort_circle` int(10) DEFAULT NULL,
  `shopsort_spot` int(10) DEFAULT NULL,
  `shopsort_type` char(1) DEFAULT '1',
  `shopsort_position` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`shopsort_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[113]="CREATE TABLE `".$prefix."_shopspot` (
  `shopspot_id` int(10) NOT NULL AUTO_INCREMENT,
  `shopspot_spot` int(10) DEFAULT NULL,
  `shopspot_shop` int(10) DEFAULT NULL,
  `shopspot_order` int(10) NOT NULL DEFAULT '999',
  `shopspot_new` char(1) DEFAULT '2',
  PRIMARY KEY (`shopspot_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[114]="CREATE TABLE `".$prefix."_shopstyle` (
  `shopstyle_id` int(10) NOT NULL AUTO_INCREMENT,
  `shopstyle_style` int(10) DEFAULT NULL,
  `shopstyle_shop` int(10) DEFAULT NULL,
  PRIMARY KEY (`shopstyle_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[115]="CREATE TABLE `".$prefix."_shoptag` (
  `shoptag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shoptag_spot` int(10) DEFAULT NULL,
  `shoptag_shop` int(10) DEFAULT NULL,
  `shoptag_tag` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`shoptag_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[116]="CREATE TABLE `".$prefix."_shoptagbycircle` (
  `shoptagbycircle_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shoptagbycircle_circle` int(10) unsigned DEFAULT NULL,
  `shoptagbycircle_shop` int(10) unsigned DEFAULT NULL,
  `site_protocol` text,
  `shoptagbycircle_tag` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`shoptagbycircle_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[117]="CREATE TABLE `".$prefix."_site` (
  `site_logo` varchar(100) DEFAULT NULL,
  `site_wiiyunsalt` varchar(100) DEFAULT NULL,
  `site_wiiyunaccount` varchar(50) DEFAULT NULL,
  `site_icp` varchar(100) DEFAULT NULL,
  `site_protocol` text,
  `site_isshowprotocol` char(1) DEFAULT 1,
  `site_isshowadminindex` char(1) DEFAULT 1,
  `site_sms` char(1) DEFAULT 1,
  `site_isshowcard` char(1) DEFAULT 1,
  `site_tmp` int(4) DEFAULT 1,
  `site_isshowcomment` char(1) DEFAULT 1,
  `site_onlinechat` varchar(50) DEFAULT NULL,
  `site_icon` varchar(100) DEFAULT NULL,
  `site_stat` varchar(100) DEFAULT NULL,
  `site_iscartfoodtag` char(1) DEFAULT 1,
  `site_cartfoodtag` varchar(100) DEFAULT NULL,
  `site_yunprint` varchar(100) DEFAULT NULL,
  `site_yunprintnum` varchar(100) DEFAULT 1
)  DEFAULT CHARSET=utf8;";

$sqlstr[118]="CREATE TABLE `".$prefix."_sortbytab` (
  `sortbytab_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sortbytab_shopsort` int(10) unsigned DEFAULT NULL,
  `sortbytab_circle` int(10) unsigned DEFAULT NULL,
  `sortbytab_spot` int(10) unsigned DEFAULT NULL,
  `sortbytab_pic` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sortbytab_title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sortbytab_type` char(1) DEFAULT NULL,
  `sortbytab_order` int(11) DEFAULT '999',
  `sortbytab_url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`sortbytab_id`)
)  DEFAULT CHARSET=utf8;";

$sqlstr[119]="CREATE TABLE `".$prefix."_specialact` (
  `specialact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `specialact_circle` int(10) unsigned DEFAULT NULL,
  `specialact_spot` int(10) unsigned DEFAULT NULL,
  `specialact_order` int(4) unsigned DEFAULT '999',
  `specialact_instro` varchar(200) DEFAULT NULL,
  `specialact_pic` varchar(100) DEFAULT NULL,
  `specialact_url` varchar(100) DEFAULT NULL,
  `specialact_type` char(1) DEFAULT NULL,
  `specialact_food` int(10) unsigned DEFAULT NULL,
  `specialact_shop` int(10) unsigned DEFAULT NULL,
  `specialact_title2` varchar(200) DEFAULT NULL,
  `specialact_identifying` char(1) DEFAULT '0',
  PRIMARY KEY (`specialact_id`)
)  DEFAULT CHARSET=utf8 ;";

$sqlstr[120]="CREATE TABLE `".$prefix."_spot` (
  `spot_id` int(10) NOT NULL AUTO_INCREMENT,
  `spot_name` varchar(100) NOT NULL,
  `spot_order` int(4) NOT NULL DEFAULT '999',
  `spot_circle` int(11) DEFAULT NULL,
  `spot_id2` varchar(20) DEFAULT NULL,
  `spot_letter` char(1) DEFAULT NULL,
  `spot_new` char(1) DEFAULT '2',
  PRIMARY KEY (`spot_id`)
)  DEFAULT CHARSET=utf8;";


$sqlstr[121]="CREATE TABLE `".$prefix."_style` (
  `style_id` int(10) NOT NULL AUTO_INCREMENT,
  `style_name` varchar(100) NOT NULL,
  `style_order` int(4) NOT NULL DEFAULT '999',
  PRIMARY KEY (`style_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[122]="CREATE TABLE `".$prefix."_tag` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) DEFAULT NULL,
  `tag_isspot` char(1) DEFAULT NULL,
  `tag_score` int(4) DEFAULT NULL,
  `tag_pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
)   DEFAULT CHARSET=utf8;";

$sqlstr[123]="CREATE TABLE `".$prefix."_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_account` varchar(100) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_mail` varchar(100) DEFAULT NULL,
  `user_type` char(1) DEFAULT '0',
  `user_logintime` datetime DEFAULT NULL,
  `user_loginip` varchar(100) DEFAULT NULL,
  `user_logincount` int(10) DEFAULT '0',
  `user_name` varchar(50) DEFAULT NULL,
  `user_phone` varchar(30) DEFAULT NULL,
  `user_time` datetime DEFAULT NULL,
  `user_status` char(1) DEFAULT '0',
  `user_vcode` varchar(20) DEFAULT NULL,
  `user_score` int(10) DEFAULT '0',
  `user_salt` varchar(20) DEFAULT NULL,
  `user_sinauid` varchar(100) DEFAULT NULL,
  `user_sinanick` varchar(50) DEFAULT NULL,
  `user_regtype` char(1) DEFAULT NULL,
  `user_experience` int(10) DEFAULT '0',
  PRIMARY KEY (`user_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[124]="CREATE TABLE `".$prefix."_useraddr` (
  `useraddr_id` int(10) NOT NULL AUTO_INCREMENT,
  `useraddr_user` int(10) NOT NULL,
  `useraddr_phone` varchar(30) DEFAULT NULL,
  `useraddr_name` varchar(50) DEFAULT NULL,
  `useraddr_area` int(10) DEFAULT NULL,
  `useraddr_spot` int(10) DEFAULT NULL,
  `useraddr_address` varchar(50) DEFAULT NULL,
  `useraddr_circle` int(10) DEFAULT NULL,
  `useraddr_type` char(1) DEFAULT '0',
  `useraddr_totaladdr` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`useraddr_id`)
)   DEFAULT CHARSET=utf8 ;";

$sqlstr[125]="CREATE TABLE `".$prefix."_userscore` (
  `userscore_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userscore_shop` int(10) DEFAULT NULL,
  `userscore_user` int(10) DEFAULT NULL,
  `userscore_speed` int(10) DEFAULT '0',
  `userscore_test` int(10) DEFAULT '0',
  `userscore_total` int(10) DEFAULT '0',
  `userscore_order` varchar(50) DEFAULT NULL,
  `userscore_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`userscore_id`)
)  DEFAULT CHARSET=utf8;";






	
	$sqlstr[126]="INSERT INTO `".$prefix."_button` (`button_id`, `button_color`, `button_bttext`, `button_title`, `button_content`) VALUES
(3, '1', '送餐范围变更', '商家送餐范围变更', ''),
(4, '1', '无法送餐', '商家暂时无法送餐', ''),
(5, '1', '无此餐品', '商家无此餐品', ''),
(6, '2', '30分钟催餐', '我饿了', ''),
(7, '2', '45分钟催餐', '我真的饿了', ''),
(8, '2', '菜价变更', '商家菜价变更', ''),
(9, '2', '电话无人接听', '正在与商家联系', ''),
(10, '1', '取消', '订单取消', '亲，您在XXX年XX月xx日所订美味餐品已取消。'),
(11, '2', '预约订单短信', '预约订单', ''),
(12, '2', '是否收到餐', '吃了吗您呐', '');";

$sqlstr[127]="INSERT INTO `".$prefix."_foodlable` (`foodlable_id`, `foodlable_name`, `foodlable_icon`, `foodlable_order`) VALUES
(2, '人气', '', 1),
(3, '辣', '', 2),
(4, '素菜', '', 3),
(5, '多人特惠套餐', '', 999);";

$sqlstr[128]="INSERT INTO `".$prefix."_seo` (`seo_id`, `seo_title`, `seo_keywords`, `seo_description`, `seo_type`, `seo_spot`, `seo_circle`, `seo_shop`) VALUES
(1, ' 让外卖如约而至', '北京外卖,北京快餐,北京网上订餐,送餐,外卖菜单,北京送餐网,', '北京外卖网上订餐平台，为您提供最贴心的网上订餐送餐服务，呈现即可如约送达的北京外卖菜单，用户选填地址后看到的外卖菜单都是可以在约定时间内送达的快餐，让您足不出户尽享身边美食。', '1', NULL, NULL, NULL);";

$sqlstr[129]="INSERT INTO `".$prefix."_shop` (`shop_id`,`shop_status`, `shop_type`,  `shop_account`, `shop_password`, `shop_busy`, `shop_code`, `shop_hot`, `shop_buycount`, `shop_telclickcount`, `shop_istakeaway`, `shop_openstarttime`, `shop_openendtime`, `shop_address`, `shop_tel`, `shop_name`, `shop_intro`, `shop_mainfood`) VALUES
(1,  '1', '1', 'admin', '61d83593756977d3b13c252749af79be', '1', 'QYG83H',  '3', 0, 0, '0', '08:00:00', '22:30:00', '餐厅地址', '8888888', '餐厅名称', '畅享品质生活，来试试微普家常菜！', '盖饭、炒菜、砂锅');";

$sqlstr[130]="INSERT INTO `".$prefix."_site` (`site_logo`, `site_icp`, `site_isshowprotocol`, `site_isshowcomment`, `site_sms`, `site_isshowadminindex`,`site_iscartfoodtag`,`site_yunprintnum`,`site_cartfoodtag`) VALUES
('', 'Copyright © 2011 diancan365.com All right reserved 京ICP11029727','1','1','2','1','1','1','甜一点;酸酸的;要辣椒;要香菜');";

$sqlstr[131]="INSERT INTO `".$prefix."_deliver` (`deliver_fee`, `deliver_minfee`) VALUES (0, 0);";

$sqlstr[132]="INSERT INTO `".$prefix."_tag` (`tag_id`, `tag_name`, `tag_isspot`, `tag_score`, `tag_pic`) VALUES
(1, '免送餐费', '1', 6, ''),
(5, '40分钟送达', '1', 2, ''),
(6, '30分钟送达', '1', 3, ''),
(7, '已认证标签', '0', 1, NULL),
(8, '火爆标签', '0', 1, ''),
(9, '返点标签', '0', 1, '');";

$sqlstr[132]="INSERT INTO `".$prefix."_foodtype` (`foodtype_id`, `foodtype_name`, `foodtype_shop`, `foodtype_order`) VALUES
(1, '盖饭', 1, 999),
(2, '炒菜', 1, 999);";

$sqlstr[133]="INSERT INTO `".$prefix."_food` (`food_id`, `food_foodtype`, `food_shop`, `food_name`, `food_price`, `food_status`, `food_intro`, `food_pic`, `food_special`, `food_order`, `food_oldprice`, `food_check`, `food_groupprice`, `food_isshow`,`food_count`) VALUES
(1, 2, 1, '家常豆腐', 10.00, '0', '软嫩可口', 'userfiles/food/doufu.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(2, 1, 1, '四季豆', 15.00, '0', '健康美食', 'userfiles/food/sijidou.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(3, 2, 1, '番茄炒蛋', 10.00, '1', '美味', 'userfiles/food/jidan.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(4, 1, 1, '鲶鱼炖茄子', 30.00, '0', '特色', 'userfiles/food/nianyu.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(5, 1, 1, '鱼香肉丝', 12.00, '0', '美味', 'userfiles/food/yuxiang.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(6, 2, 1, '瓦罐酥鱼头', 20.00, '0', '鲜香', 'userfiles/food/yutou.jpg', NULL, 999, 0, '0', 0.00, '0','0'),
(7, NULL, 1, '螺狮粉', 15.00, '0', NULL, 'userfiles/food/1352875153650.jpg', '1', 0, 18, '0', 0.00, '0','0'),
(8, NULL, 1, '鱼香肉丝盖饭', 12.00, '0', NULL, 'userfiles/food/1352875189516.jpg', '1', 0, 14, '0', 0.00, '0','0'),
(9, NULL, 1, '油泼面', 7.00, '0', NULL, 'userfiles/food/1352875216271.jpg', '1', 0, 8, '0', 0.00, '0','0');";

$sqlstr[134]="INSERT INTO `".$prefix."_delivertime` (`delivertime_id`, `delivertime_name`, `delivertime_shop`, `delivertime_starttime`, `delivertime_endtime`) VALUES (6, '全天', 1, '00:00:00', '23:59:00');";
?>