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
	$tel=empty($_GET['tel'])?'':sqlReplace(trim($_GET['tel']));
	$username=empty($_GET['username'])?'':sqlReplace(trim($_GET['username']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
<head>
<meta name="Author" content="iEat"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css"/>
<script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
<script src="../js/tree.js" type="text/javascript"></script>
<script type="text/javascript" src="js/upload.js"></script>
<title> User list </title>
<script type="text/javascript">  
function check_all(obj,cName){  
    var checkboxs = document.getElementsByName(cName);  
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}  
}  
</script>
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
					<h1>User list</h1>
					<div id="introAdd">
						
						<form method="get" action="userlist.php">
							<p style="margin-left:-25px;float:left;"><label>Name</label><input type="text" name="username" class="input"/></p>
							<p style="float:left;margin-left:10px;"><label>Phone number</label><input type="text" name="tel" class="input"/></p>
							<p style="float:left;margin-left:10px;"><input  type="submit" value="Search"/></p>
						</form><br/>
						<form id="listForm" name="listForm" method="post" >
							<div class="moneyTable feeTable" style="width:668px;">
								<table width="100%">
									<tr>
									    <td style="width:8%;text-align:left; padding:6px 1%;" class="center">
										    <input type="checkbox" value="Select All"  onclick="check_all(this,'idlist[]')">Select All
										</td>
										<td class="center">Name</td>
										<td class="center">Phone number</td>
										<td class="center">Login times</td>
										<td class="center">Check order</td>
										<td class="center">Check details</td>
										<td class="center">Delete</td>
									</tr>
									<?php
										$pagesize=20;
										$startRow=0;
										$where='';
										if (!empty($tel)){
											$where=" and user_phone='".$tel."'";
										}
										if (!empty($username)){
											$where=" and user_phone='".$username."' or user_name='".$username."'";
										}
										$sql="select * from ".WIIDBPRE."_user where 1=1".$where;
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
										
										$sql="select user_id,user_name,user_phone,user_score,user_logincount from ".WIIDBPRE."_user where 1=1".$where." order by user_time desc limit $startRow,$pagesize";
										$rs=mysql_query($sql);
										if ($rscount==0){ 
											echo "<tr><td colspan='7' align='center'>No info</td></tr></table>";
										}else{

											while($rows=mysql_fetch_assoc($rs)){
											
										?>
									<tr>
										<td class="center"><input type="checkbox" class="ipt" name="idlist[]" id="idlist[]" value="<?php echo $rows["user_id"]?>" ?></td> 
										<td class="center" name="user_name"><a href="userintro.php?id=<?php echo $rows['user_id']?>&tel=<?php echo $tel?>&page=<?php echo $page?>"><?php echo $rows['user_name']?></a></td>
										<td class="center" name="user_phone"><?php echo $rows['user_phone']?></td>
										<td class="center"><?php echo $rows['user_logincount']?></td>
										<td class="center"><a href="userorder.php?uid=<?php echo $rows['user_id']?>&key=all">Check</a></td>
										<td class="center"><a href="userintro.php?id=<?php echo $rows['user_id']?>">Check</a></td>
										<td class="center" style='padding:5px 0;'><a href="javascript:if(confirm('Confirm delete？')){location.href='user_do.php?act=del&id=<?php echo $rows['user_id'];?>'}">Delete</a>
										</td>
									</tr>
										<?php
												}
										}
										?>	
										
										
								</table>
							
								
							</div>
							<?php if($rscount>=1){?>
							<p style="margin-right:20px;margin-left:15px;float:left;">							 
							  <a href="javascript:if(confirm('Confirm delete？')){document.listForm.action='user_do.php?&act=xxdel';document.listForm.submit();}"   title="delete"><img  src="../images/button/delete.gif" name="btnSave" /></a>
						    </p>
							<p style="float:left;">
						      <a href="javascript:if(confirm('Send text？')){location.href='sendsms.php'}"  title="SMS"><input type="image" src="../images/button/sms.gif" name="btnSave" value="SMS"  onclick="sms();"></a>			
						    </p><br/>	
							<?php }?>
							
						</form>
						<script type="text/javascript">
								function del(){
									document.listForm.action="user_do.php?act=xxdel"
									document.listForm.submit()
								}


								function sms(){
									document.listForm.action="sendsms.php?act=yes"
									document.listForm.submit()
								}
                            </script>
							<?php 
								if ($rscount>=1){
									echo showPage_admin('userlist.php',$page,$pagesize,$rscount,$pagecount);
								}
							?>
						
					</div>
					
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="main_bottom"></div>
		</div><!--main_content完-->
		
	
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
