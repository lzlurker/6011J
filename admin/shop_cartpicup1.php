<?php

	header("content-type:text/html;charset=utf-8");
	require_once('inc_image.class.php');
	require_once("usercheck2.php");

	$info = "";
	$fileElementName = 'fileToUpload';
	$f_fullname='';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$info = 'E|The uploaded file size exceeds the system limit。';
				break;
			case '3':
				$info = 'E|Error uploading file。';
				break;
			case '4':
				$info = 'E|No file selected。';
				break;
			case '6':
				$info = 'E|System error: no temporary folder exists。';
				break;
			case '7':
				$info = 'E|System error: Error writing to file。';
				break;
			default:
				$info = 'E|unknown mistake';
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
			$info = 'E|Must be jpg、png、gif。';
		}else{
			if ($f_size>2000*1024){
				$info = 'E|No more than 2M。';
			}else{
				$random= rand(100,999); 
				$f_fullname= time().$random.".".$f_ext;
				$f_path="userfiles/license/".$f_fullname;
				$f_path_s="userfiles/license/small/".$f_fullname;

				if (copy($f_tmpName,"../".$f_path)){
					if($f_ext=="jpg"){
						$t = new ThumbHandler();
						$t->setSrcImg("../".$f_path);
						//$t->setCutType(1);
						$t->setDstImg("../".$f_path_s);
						$t->createImg(200,150);
						$f_path=$f_path_s;
					}else{
						copy("../".$f_path,"../".$f_path_s);
					}
					$info = "S|".$f_fullname;
				}else{
					$info = 'E|target folder not exist or no write permission。';
				}
			}
		}
		@unlink($_FILES[$fileElementName]);
	}
	echo $info;
?>