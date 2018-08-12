<?php

 	require_once("usercheck2.php");
	require_once('../include/function_common.php');
	if($_GET['type']==2){
			include('style_default2.php');
			$str='';		
			$str.="<?php \n";
					
			$str.="\$top_groundColor='$top_groundColor';\n";
			//$str.="\$top_color='$top_color';\n";
			$str.="\$top_aColor='$top_aColor';\n";
			$str.="\$h1_groundColor='$h1_groundColor';\n";
			//$str.="\$h1_color='$h1_color';\n";
			$str.="\$h1_aColor='$h1_aColor';\n";
			$str.="\$h1_borderColor='$h1_borderColor';\n";
			$str.="\$all_color='$all_color';\n";
			$str.="\$all_desColor='$all_desColor';\n";
			$str.="\$all_aColor='$all_aColor';\n";
			$str.="\$all_aUcolor='$all_aUcolor';\n";
			//$str.="\$logo_color='$logo_color';\n";
			//$str.="\$fontSize='$fontSize';\n";
			$str.="\$h2_groundColor='$h2_groundColor';\n";
			//$str.="\$h2_color='$h2_color';\n";
			//$str.="\$h2_aColor='$h2_aColor';\n";
			$str.="\$h2_borderColor='$h2_borderColor';\n";

			$str.="\$key_color='$key_color';\n";
			$str.="\$point_color='$point_color';\n";
			$str.="\$point_aColor='$point_aColor';\n";
			$str.="\$line_color='$line_color';\n";
			//$str.="\$g_groundColor='$g_groundColor';\n";
			//$str.="\$g_color='$g_color';\n";
			//$str.="\$g_aColor='$g_aColor';\n";
			//$str.="\$row_groundColor='$row_groundColor';\n";
					
			$str.="?>";
			$fp=fopen("style_default.php","w+");
			fwrite($fp,$str);
			fclose($fp);
			$str='';

			$str.="/*Set font color*/\n";
			$str.="body{\n";
			$str.="	color:#".$all_color.";\n";
			$str.="}\n";
			$str.="/*Set hyperlink color*/\n";
			$str.="a{\n";
			$str.="	color:#".$all_aColor.";\n";
			$str.="	text-decoration:none;\n";
			$str.="}\n";
			$str.="/*Set keyword color*/\n";
			$str.=".hf a{\n";
			$str.="	color:#".$key_color.";\n";
			$str.="}\n";
			$str.="/*Set description color*/\n";
			$str.=".explain{\n";
			$str.="	color:#".$all_desColor.";\n";
			$str.="}\n";
			$str.="/*Set user hyperlink color*/\n";
			$str.=".user{\n";
			$str.="color:#".$all_aUcolor.";\n";
			$str.="}\n";
			$str.="/*Set notation color*/\n";
			$str.=".point{\n";
			$str.="	color:#".$point_color.";\n";
			$str.="}\n";
			$str.="/*Set word hyperlink color*/\n";
			$str.=".point a{\n";
			$str.="	color:#".$point_aColor.";\n";
			$str.="}\n";
			$str.="/*Set LOGO size*/\n";
			$str.="#container #header{\n";
			$str.="	font-size:".$fontSize1."em;\n";
			$str.="}\n";
			$str.="/*Set background color*/\n";
			$str.="#container .hf{\n";
			$str.="	background-color:#".$top_groundColor.";\n";
			//$str.="	color:#".$top_color.";\n";
			$str.="}\n";
			
			$fp=fopen("../mobile/css/style_config.css","w+");
			fwrite($fp,$str);
			fclose($fp);
			alertInfo('Reset success',"themessite.php",0);
	}else{		
			//checkAdminRight("122",$_SESSION[WiiBBS_ID."admingroup"]);	
			$top_groundColor=sqlReplace(Trim($_POST["top_groundColor"]));;
			//$top_color=sqlReplace(Trim($_POST["top_color"]));
			$top_aColor=sqlReplace(Trim($_POST["top_aColor"]));
			$h1_groundColor=sqlReplace(trim($_POST['h1_groundColor']));
			//$h1_color=sqlReplace(trim($_POST['h1_color']));
			$h1_aColor=sqlReplace(trim($_POST['h1_aColor']));
			$h1_borderColor=sqlReplace(trim($_POST['h1_borderColor']));
			$all_color=sqlReplace(trim($_POST['all_color']));
			$all_desColor=sqlReplace(trim($_POST['all_desColor']));
			$all_aColor=sqlReplace(trim($_POST['all_aColor']));
			$all_aUcolor = sqlReplace(trim($_POST['all_aUcolor']));
			//$logo_color=sqlReplace(trim($_POST['logo_color']));
			//$fontSize=sqlReplace(trim($_POST['fontSize']));
			//$fontSize1=intval($fontSize)/16;

			$h2_groundColor=sqlReplace(trim($_POST['h2_groundColor']));
			//$h2_color=sqlReplace(trim($_POST['h2_color']));
			//$h2_aColor=sqlReplace(trim($_POST['h2_aColor']));
			$h2_borderColor=sqlReplace(trim($_POST['h2_borderColor']));

			$key_color=sqlReplace(trim($_POST['key_color']));
			$point_color=sqlReplace(trim($_POST['point_color']));
			$point_aColor=sqlReplace(trim($_POST['point_aColor']));
			$line_color=sqlReplace(trim($_POST['line_color']));
			//$g_groundColor=sqlReplace(trim($_POST['3g_groundColor']));
			//$g_color=sqlReplace(trim($_POST['3g_color']));
			//$g_aColor=sqlReplace(trim($_POST['3g_aColor']));
			//$row_groundColor=sqlReplace(trim($_POST['row_groundColor']));
			$str='';		
			$str.="<?php \n";
					
			$str.="\$top_groundColor='$top_groundColor';\n";
			//$str.="\$top_color='$top_color';\n";
			$str.="\$top_aColor='$top_aColor';\n";
			$str.="\$h1_groundColor='$h1_groundColor';\n";
			//$str.="\$h1_color='$h1_color';\n";
			$str.="\$h1_aColor='$h1_aColor';\n";
			$str.="\$h1_borderColor='$h1_borderColor';\n";
			$str.="\$all_color='$all_color';\n";
			$str.="\$all_desColor='$all_desColor';\n";
			$str.="\$all_aColor='$all_aColor';\n";
			$str.="\$all_aUcolor='$all_aUcolor';\n";
			//$str.="\$logo_color='$logo_color';\n";
			//$str.="\$fontSize='$fontSize';\n";
			$str.="\$h2_groundColor='$h2_groundColor';\n";
			//$str.="\$h2_color='$h2_color';\n";
			//$str.="\$h2_aColor='$h2_aColor';\n";
			$str.="\$h2_borderColor='$h2_borderColor';\n";

			$str.="\$key_color='$key_color';\n";
			$str.="\$point_color='$point_color';\n";
			$str.="\$point_aColor='$point_aColor';\n";
			$str.="\$line_color='$line_color';\n";
			//$str.="\$g_groundColor='$g_groundColor';\n";
			//$str.="\$g_color='$g_color';\n";
			//$str.="\$g_aColor='$g_aColor';\n";
			//$str.="\$row_groundColor='$row_groundColor';\n";
					
			$str.="?>";
			$fp=fopen("style_default.php","w+");
			fwrite($fp,$str);
			fclose($fp);
			$str='';

			$str.="/*Set font color*/\n";
			$str.="body{\n";
			$str.="	color:#".$all_color.";\n";
			$str.="}\n";
			$str.="/*Set hyperlink color*/\n";
			$str.="a{\n";
			$str.="	color:#".$all_aColor.";\n";
			$str.="	text-decoration:none;\n";
			$str.="}\n";
			$str.="/*Set keyword color*/\n";
			$str.=".hf a{\n";
			$str.="	color:#".$key_color.";\n";
			$str.="}\n";
			$str.="/*Set description color*/\n";
			$str.=".explain{\n";
			$str.="	color:#".$all_desColor.";\n";
			$str.="}\n";
			$str.="/*Set user hyperlink color*/\n";
			$str.=".user{\n";
			$str.="color:#".$all_aUcolor.";\n";
			$str.="}\n";
			$str.="/*Set notation color*/\n";
			$str.=".point{\n";
			$str.="	color:#".$point_color.";\n";
			$str.="}\n";
			$str.="/*Set word hyperlink color*/\n";
			$str.=".point a{\n";
			$str.="	color:#".$point_aColor.";\n";
			$str.="}\n";
			$str.="/*Set LOGO size*/\n";
			$str.="#container #header{\n";
			//$str.="	font-size:".$fontSize1."em;\n";
			$str.="}\n";
			$str.="/*Set background color*/\n";
			$str.="#container .hf{\n";
			$str.="	background-color:#".$top_groundColor.";\n";
			//$str.="	color:#".$top_color.";\n";
			$str.="}\n";

			$fp=fopen("../mobile/css/style_config.css","w+");
			fwrite($fp,$str);
			fclose($fp);
			alertInfo('Set success',"themessite.php",0);
				
	}
	
?>