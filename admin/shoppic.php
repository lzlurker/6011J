<?php
	/**
	 *  food.php  
	 *
	 * @version       v0.01
	 * @create time   2012-3-21
	 * @update time
	 * @author        liuxiaohui
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
	require_once("usercheck2.php");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script type="text/javascript">
  <!--
	function ajaxFileUpload()
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'shop_picup4.php',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					data=data.replace('<pre>','');
					data=data.replace('</pre>','');
					var info=data.split('|');
					if(info[0]=="E")
						alert(info[1]);
					else{
						document.getElementById('upinfo').innerHTML=info[1];
						document.getElementById('upfile1').value=info[1];
						
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		return false;
	}
  //-->
  </script>
  <title> Restaurant picture </title>
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
					<h1>Restaurant picture</h1>
					<div id="introAdd">
						<form method="post" action="shoppic_do.php?act=add">
							<p style="margin-left:42px;margin-bottom:10px;color:red;">Restaurant picture is on the left。</p>
							<p>
								<label>Restaurant picture</label><span id="loading" style="display:none;"><img src="../images/loading.gif" width="16" height="16" alt="loading" /></span><span id="upinfo" style="color:blue;"></span><input id="upfile1" name="upfile1" value="<?php echo $SHOP_INFOS['shop_headpic1']?>" type="hidden"/><input id="fileToUpload" type="file" name="fileToUpload" style="height:24px;"/> <input type="button" onclick="return ajaxFileUpload();" value="upload"/> size 275*215
							</p>
							<p><label>&nbsp;</label><input type="image" src="../images/button/submit_t.jpg" /></p>
						</form>

						<div class="moneyTable feeTable" style="width:668px;">
							<table width="100%">
								<tr>
									<td class="center">image</td>
									<td class="center">operation</td>
								</tr>
								<?php
									$sql="select * from ".WIIDBPRE."_shoppics order by shoppics_order asc,shoppics_id desc";
									$rs=mysql_query($sql);
									$rscount=mysql_num_rows($rs);
									if ($rscount==0){ 
										echo "<tr><td colspan='2' class='center'>No info</td></tr></table>";
									}else{
										while($rows=mysql_fetch_assoc($rs)){
									?>
											<tr>
												<td class="center" style='padding:20px 0;'><img src="../<?php echo $rows['shoppics_url']?>" width="275px;" height="215px;" /></td>
												<td class="center">
													<a href="javascript:if(confirm('Confirm delete？')){location.href='shoppic_do.php?act=del&id=<?php echo $rows['shoppics_id'];?>'}">Delete</a> 
												</td>
											</tr>
									<?php
											}
									}
									?>
							</table>
						</div>
						
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
