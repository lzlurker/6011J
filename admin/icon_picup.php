<?php
/**
 * 首页Flash图片上传 flash_picup.php
 *
 * @version       v0.02
 * @create time   2011-5-19
 * @update time   2011-6-3
 * @author        jiangting
 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
 */
header("content-type:text/html;charset=utf-8");
require_once('inc_image.class.php');

	$info = "";
	$fileElementName2 = 'fileToUpload2';
	if(!empty($_FILES[$fileElementName2]['error']))
	{
		switch($_FILES[$fileElementName2]['error'])
		{

			case '1':
				$info = 'E|The uploaded file size exceeds the system limit。';
				break;
			case '3':
				$info = 'E|Upload error。';
				break;
			case '4':
				$info = 'E|No file chose。';
				break;
			case '6':
				$info = 'E|Error, no folder。';
				break;
			case '7':
				$info = 'E|Error, W mistake。';
				break;
			default:
				$info = 'E|Unknow Error';
		}
	}elseif(empty($_FILES[$fileElementName2]['tmp_name']) || $_FILES[$fileElementName2]['tmp_name'] == 'none'){
		echo 'hahhhh'.$_FILES[$fileElementName2]['tmp_name'];die;
		$info = 'E|No file chose。';
	}else{
		$f_name2=$_FILES[$fileElementName2]['name'];
		$f_size2=$_FILES[$fileElementName2]['size'];
		$f_tmpName2=$_FILES[$fileElementName2]['tmp_name'];

		$f_ext2=strtolower(preg_replace('/.*\.(.*[^\.].*)*/iU','\\1',$f_name2));

		$f_extAllowList2="png";

		$f_exts2=$f_extAllowList2;		
		
		if ($f_ext2!==$f_exts2){
			$info = 'E|Must be png。';	
		}else{
			if ($f_size2>100*1024){
				$info = 'E|No exceed 100K。';
			}else{
				$random= rand(100,999); 
				$f_fullname2= time().$random.".".$f_ext2;
				$f_path2="userfiles/icon/".$f_fullname2;

				if (copy($f_tmpName2,"../".$f_path2)){
						
					$info = "S|".$f_path2;
				}else{
					$info = 'E|target folder not exist or has no W permission。';
				}
			}
		}
		@unlink($_FILES[$fileElementName2]);
	}
	echo $info;
?>