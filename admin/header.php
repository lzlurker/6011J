<?php
	/**
	 *  header.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-6
	 * @update time
	 * @author        lujiangxia
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
?>
	<div id="hearderBox" style="height:90px;">
		<div id="header" >
			
			<div id="login" >
			<?php
				if (!empty($_SESSION['qiyu_shopID'])){
			?>
			<span><span>
			
				
			<?php
				
					$sql="select shop_account from qiyu_shop where shop_id=".$_SESSION['qiyu_shopID'];
					$rs=mysql_query($sql);
					$row=mysql_fetch_assoc($rs);
					if ($row){
			?>
						<?php echo $row['shop_account']?>  <a href="shopupdatepass.php" style='margin-left:10px;'>Change Password</a> <a href="http://iEat" target="_blank">Help</a> <a href="shopquit.php" class="no_bg">Quit</a> 
			<?php
						
					}
				
			?>
				</span></span>
			<?php
				}	
			?>
			</div>
		
			<div class="location" style='left:100px;top:30px;'><a href="admin.php" style="color:#fff;"><?php echo $SHOPNAME_DDMIN?></a></div>
			<p class='shopindex'><a href="../index.php" target='_blank'>Main Page</a></p>
			
		</div>
	</div>
	<script type="text/javascript">
	<!--
		$(document).ready(function(){
			$('#search_input').focus(function(){
				this.value='';
			});
		});
	//-->
	</script>