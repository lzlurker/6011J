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
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$info = 'E|Over limitation。';
				break;
			case '3':
				$info = 'E|Error uploading。';
				break;
			case '4':
				$info = 'E|no file chose。';
				break;
			case '6':
				$info = 'E|Error, no folder。';
				break;
			case '7':
				$info = 'E|Writing Error。';
				break;
			default:
				$info = 'E|Unknow error';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none'){
		$info = 'E|no chose file。';
	}else{
		$f_name=$_FILES[$fileElementName]['name'];
		$f_size=$_FILES[$fileElementName]['size'];
		$f_tmpName=$_FILES[$fileElementName]['tmp_name'];

		$f_ext=strtolower(preg_replace('/.*\.(.*[^\.].*)*/iU','\\1',$f_name));
		$f_extAllowList="png|jpg|gif";

		$f_exts=explode("|",$f_extAllowList);
		$checkExt=true;
		foreach ($f_exts as $v){
			if ($f_ext==$v){
				$checkExt=false;
				break;
			}
		}

		if ($checkExt){
			$info = 'E|Must be jpg、png、gif。';
		}else{
			if ($f_size>500*1024){
				$info = 'E|No exceed 500K。';
			}else{
				$random= rand(100,999); 
				$f_fullname= time().$random.".".$f_ext;
				$f_path="userfiles/logo/".$f_fullname;

				if (copy($f_tmpName,"../".$f_path)){
						
					$info = "S|".$f_path;
				}else{
					$info = 'E|No folder。';
				}
			}
		}
		@unlink($_FILES[$fileElementName]);
	}
	echo $info;
?>