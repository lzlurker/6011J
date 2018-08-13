<ul>
	<li style="margin-top:0;background:url('../images/take_up.gif') no-repeat 0 50%;">
		<a href="admin.php">Main Page</a>
	</li>
	<li>
		<span>Restaurant management</span>
		<ul>
			<li><a href="shopadd.php">Restaurant information management</a></li>
			<li><a href="shoppic.php">Restaurant picture</a></li>
			<li><a href="shopdelivertime.php">Meal delivery time</a></li>
			<li><a href="shopdeliverfee.php">Meal delivery time limit</a></li>
			<?php
				if ($site_isshowcard=='1'){
			?>
					<li><a href="shopcard.php">Restaurant license</a></li>
			<?php
				}	
			?>
		</ul>
	</li>
	<li>
		<span>Menu information management</span>
		<ul>
			<li><a href="foodtype.php">Menu classification management</a></li>
			<li><a href="food.php">Menu management</a></li>
			<li><a href="shoptop.php">Recommended dish management</a></li>
		</ul>
	</li>
	
	<li>
		<span>Order management</span>
		<ul>
			
			<li><a href="subscribe.php">Reservation order[<?php echo getSubscribeCount();?>]</a></li>
			<li><a href="userorder.php?key=0">New order[<?php echo getOrderNewCountByState(0);?>]</a></li>
			<li><a href="userorder.php?key=1">Confirm order[<?php echo getOrderCountByState(1);?>]</a></li>
			<li><a href="userorder.php?key=4">Finish order[<?php echo getOrderCountByState(4);?>]</a> </li>
			<li><a href="userorder.php?key=2">Owner cancel order[<?php echo getOrderCountByState(2);?>]</a></li>
			<li><a href="userorder.php?key=3">User cancel order[<?php echo getOrderCountByState(3);?>]</a> </li>
			<li><a href="userordersearch.php">Order search</a></li>
		</ul>
		
	</li>
	
	<li>
		<span>User Management</span>
		<ul>
			<li><a href="userlist.php">user list</a></li>
			<!--<li><a href="userconsume.php">User consumption record</a></li>-->
			<?php if($site_isshowcomment==1){?>
				<li><a href="usercomment.php">comment list</a></li>
			<?php }?>
		</ul>
	</li>

	<li>
		<span>Statistical Analysis</span>
		<ul>
			<li><a href="stat_login.php">User login analysis</a></li>
			<li><a href="stat_topuser.php">Consumption ranking analysis</a></li>
			<li><a href="stat_hotfood.php">Popular food analysis</a></li>
			<li><a href="stat_order.php">Order analysis</a></li>
		</ul>
	</li>
	
	<li>
		<span>System Management</span>
		<ul>
			<li><a href="site.php">Website settings</a></li>			
			<li><a href="site_sms.php">SMS settings</a></li>
			<li><a href="site_tmp.php">Template setting</a></li>
			<li><a href="seo.php">SEO</a></li>
			<!-- <li><a href="about.php">Link</a></li> by lz 20180813-->
			<li><a href="other.php">other</a></li>
			<li><a href="yunprint.php">print</a></li>
		</ul>
	</li>
</ul>
<script>
	$(function(){
		$('#leftspan').toggle(
		  function () {
			$('#openli').css('background-image',"url('../images/take_up.gif')");
		  },
		  function () {
			$('#openli').css('background-image',"url('../images/open.gif')");
		  }
		); 
	})
</script>