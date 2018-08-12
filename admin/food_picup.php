<?php

header("content-type:text/html;charset=utf-8");
require_once('inc_image.class.php');

	$info = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$info = 'E|uploaded exceeds limit。';
				break;
			case '3':
				$info = 'E|upload error。';
				break;
			case '4':
				$info = 'E|no file chose。';
				break;
			case '6':
				$info = 'E|error:no folder。';
				break;
			case '7':
				$info = 'E|writing error。';
				break;
			default:
				$info = 'E|unknow error';
		}
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none'){
		$info = 'E|No file selected。';
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
			$info = 'E|must jpg、png、gif。';
		}else{
			if ($f_size>100*1024){
				$info = 'E|no exceed 100K。';
			}else{
				$random= rand(100,999); 
				$f_fullname= time().$random.".".$f_ext;
				$f_path="userfiles/food/".$f_fullname;
				$f_path_s="userfiles/food/origin/".$f_fullname;

				if (copy($f_tmpName,"../".$f_path)){
					/*$t = new ThumbHandler();
					$t->setSrcImg($f_path_s);
					$t->setDstImg($f_path);
					$t->setMaskImg("mark.gif");
					$t->setMaskPosition(4);
					$t->setImgDisplayQuality(100);
					$t->setImgCreateQuality(100);
					$t->createImg(229,214);*/
					$info = "S|".$f_path;
				}else{
					$info = 'E|target folder not exist or W permission。';
				}
			}
		}
		@unlink($_FILES[$fileElementName]);
	}
	echo $info;
?>