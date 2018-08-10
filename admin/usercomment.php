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
  <title> User Comments </title>
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
					<h1>User Comments</h1>
					<div id="introAdd">
						<form  name="listForm" method="post" action="" id="listForm">
						<div class="moneyTable feeTable" style="width:668px;margin-top:0px;padding-top:0" >
						<p style="color:red;">Tip：</p>
						<p style="color:red;margin-left:30px;margin-top:10px;">1、Use setup to display comments。</p>
						<p style="margin-bottom:30px;color:red;margin-left:30px;margin-top:10px;">2、Comments time is editable。</p>
							<table width="100%">
								<tr>
									<td class='center'>User</td>
									<td class='center'>Content</td>
									<td class='center'>Time</td>
									<td class='center'>State</td>
									<td class='center'>Operation</td>
								</tr>
								<?php
									$pagesize=10;
										$startRow=0;
										$sql="select * from qiyu_comment,qiyu_user where comment_user=user_id";
										$rs = mysql_query($sql) or die ("Failed, check SQL。");
										$rscount=mysql_num_rows($rs);
										if ($rscount%$pagesize==0)
											$pagecount=$rscount/$pagesize;
										else
											$pagecount=ceil($rscount/$pagesize);

										if (empty($_GET['page'])||!is_numeric($_GET['page']))
											$page=1;
										else{
											$page=$_GET['page'];
											if($page<1) $page=1;
											if($page>$pagecount) $page=$pagecount;
											$startRow=($page-1)*$pagesize;
										}
										
										$sql="select * from qiyu_comment,qiyu_user where comment_user=user_id  order by comment_addtime desc limit $startRow,$pagesize";
										$rs=mysql_query($sql);
										if ($rscount==0){ 
											echo "<tr><td colspan='5' class='center'>No info</td></tr></table>";
										}else{
											$i=0;
											while($rows=mysql_fetch_assoc($rs)){
												$i++;
												$type=$rows['comment_type'];
												if($type=='0'){
													$type='Unreviewed';
													$link='<a href="usercomment_do.php?act=type&id='.$rows['comment_id'].'">Reviewed</a>';
												}
												if($type=='1'){
													$type='Reviewed';
													//$link='<a href="comment_do.php?id='.$rows['comment_id'].'">未审核</a>';
													$link='';
												}
												
										
									?>
								<tr>
									<td class='center'><a href="userintro.php?id=<?php echo $rows['user_id']?>"><?php echo $rows['user_name']?></a></td>
									<td ><?php echo $rows['comment_content']?></td>
									<td class='center'>
											<input name="id<?php echo $i;?>" type="hidden" value="<?php echo $rows["comment_id"];?>" />
											<input name="time<?php echo $i;?>" type="text" size="20" value="<?php echo $rows["comment_addtime"];?>" />
									</td>
									<td  class='center'><?php echo $type?></td>
									<td class='center' style='padding:5px 0;'> <a href="javascript:if(confirm('Confirm delete？')){location.href='usercomment_do.php?act=del&id=<?php echo $rows['comment_id'];?>'}">Delete</a>&nbsp;&nbsp;<?php echo $link?></td>
								</tr>
									<?php
											}
									}
									?>					
							</table>
							<p style="margin-bottom:10px;">
								<a href="javascript:document.listForm.action='usercomment_do.php?act=savetime';document.listForm.submit();"><img src="../images/button/timeadd.jpg" alt="" /></a>
							</p>
							<input name="i" type="hidden" value="<?php echo $i;?>">
						<?php 
							if ($rscount>=1){
								echo showPage_admin('usercomment.php',$page,$pagesize,$rscount,$pagecount);
							}
						?>
							
						</div>
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
  <script type="text/javascript">
	function check(){
		var f=$('#foodtype').val();
		if(f=="")
		{
			alert('Menu class cannot be empty');
			$('#foodtype').focus();
			return false;
		}
	}
</script>

</html>
