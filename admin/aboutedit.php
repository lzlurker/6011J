<?php
	/**
	 *  shopadd.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-22
	 * @update time
	 * @author        lujiangxia
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");
	$id=sqlReplace(trim($_GET['id']));
	checkData($id,"ID",0);
	$sql="select * from ".WIIDBPRE."_about where about_id=".$id;
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	if(!$row){
		alertInfo('Illegal operation','about_list.php',0);
	}else{
		$title = $row['about_title'];
		$type = $row['about_type'];
		$content = $row['about_content'];
	}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
<meta name="Author" content="iEat"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"/>
<script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../js/tree.js" type="text/javascript"></script>
<script type="text/javascript" src="js/upload.js"></script>
<script type="text/javascript" src="js/shopadd.js"></script>
<script type="text/javascript">
	function radioShow(){
		var myradio=document.getElementsByName("about_type");  //
		var div=document.getElementById("about").getElementsByTagName("div");
		for(i=0;i<div.length;i++){
			if(myradio[i].checked){
				div[i].style.display="block";
			}else{
				div[i].style.display="none";
			}
		}
	}
</script>
  <title> link iEat </title>
 </head>
 <body>
 <div id="container">
	<?php
		require_once('header.php');
	?>
	<div id="main">
		<div class="main_content">
			<div class="main_top"></div>
			<div class="main_center main_center_r">
				<div id="shopLeft">
					<?php
						require_once('left.inc.php');
					?>
				</div>
				<div id="shopRight">
					<h1><a href="about.php">link</a> &gt;&gt; change link</h1>
					<div id="introAdd">
						<form method="post" action="about_do.php?act=edit&id=<?php echo $id?>">
						<p>title：<input type="text" id="title" name="title" class="input input270" value="<?php echo $title?>" /> *</p>
						<p>type：<input type="radio" name="about_type" value="1" <?php if($type=='1'){echo 'checked';}?>  onclick="radioShow();"/> contain   <input type="radio" name="about_type" value="2" <?php if($type=='2'){echo 'checked';}?> onclick="radioShow();"/> link						   
						</p>
						<div id="about">
						    <div class="about1" name="about"  style="<?php if($type=='2'){echo 'display:none';}?>">
								<p>contain：</p>
								<p style='margin-top:20px;'>								
									<?php   include("fckeditor/fckeditor.php");
										$oFCKeditor = new FCKeditor('content') ;
										$oFCKeditor->BasePath	= "fckeditor/" ;
										$oFCKeditor->Value		= $content ;
										$oFCKeditor->Width		= '680px' ;
										$oFCKeditor->ToolbarSet		= 'Basic' ;
										$oFCKeditor->Create() ;
								 ?>
								</p>
						    </div>

							<div class="about2"  name="about" style="<?php if($type=='2'){echo '';}?>" >
								<p>link：<input type="text" name="about_href" class="input input270" value="<?php echo $content;?>">(http://start)</p>
						    </div>
						</div>
						

						
						<p style='text-align:center'><input type="image" src="../images/button/submit_t.jpg" onClick="return check_about();"/></p>
						</form>
					</div>
					
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="main_bottom"></div>
		</div><!--main_content-->
		
	
	</div>
	
	<?php
		require_once('footer.php');
	?>
 </div>
 </body>
</html>
