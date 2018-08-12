<?php

	require_once("usercheck2.php");
	$tel=empty($_GET['tel'])?'':sqlReplace(trim($_GET['tel']));

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://iEat">
 <head>
  <meta name="Author" content="iEat"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../style.css" type="text/css"/>
  <script src="../js/jquery-1.3.1.js" type="text/javascript"></script>
  <script src="../js/tree.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <title> Consumption ranking analysis </title>
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
					<h1>
					<?php
						echo "Consumption ranking analysis";

					?>
					</h1>
					<div id="introAdd">
						<div class="moneyTable feeTable" style="width:668px;">
						
							<table width="100%"><p style="color:red;margin-bottom:10px;">Top 50 users</p>
								<tr>
									<td class="center" width='10%' height="30px;">Name</td>
									<td class="center" width='10%'>Consumption amount</td>
									<td class="center" width='5%'>Total points</td>									
									<td class="center" width='5%'>Loyalty</td>									
									<td class="center" width='5%'>Total order</td>
								</tr>
								<?php
									$where='';
									$pagesize=20;
									$startRow=0;
									
									

									$sql="select user_id,user_name, user_score, user_experience,count(order_id2) as d from qiyu_user, qiyu_order where user_id = order_user and order_status =4 group by user_name order by user_score desc";

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
									
									
									$sql="select user_id,user_name, user_score, user_experience,count(order_id2) as d from qiyu_user, qiyu_order where user_id = order_user and order_status =4 group by user_name order by user_score desc limit $startRow,50";

									
									$rs=mysql_query($sql);
									if ($rscount==0){ 
										echo "<tr><td colspan='8' class='center'>No info</td></tr>";
									}else{
										while($rows=mysql_fetch_assoc($rs)){
											
										
									?>
								<tr>
								<td class="center"><a href="userintro.php?id=<?php echo $rows['user_id']?>&tel=<?php echo $tel?>&page=<?php echo $page?>"><?php echo $rows['user_name']?></a></td>
								<td class="center" height="30px;"><?php echo $rows['user_score']?></td>
								<td class="center"><?php echo $rows['user_score']?></td>
								<td class="center"><?php echo $rows['user_experience']?></td>
								<td class="center"><?php echo $rows['d']?></td>
								<!---->
								
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
