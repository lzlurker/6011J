<?php
	/**
	 *  shopdeliverfee.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-22
	 * @update time
	 * @author        lujiangxia
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
  <title> Delivery fee setting </title>
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
					<h1>Delivery fee and time</h1>
					<div id="introAdd">
						
						<form method="post" action="shop_do.php?act=fee">
						<?php
							$sql="select * from qiyu_deliver";
							$rs=mysql_query($sql);
							$rows=mysql_fetch_assoc($rs);
		
						?>	
						<p><label class='label_140'>Starting fee：</label><input type="text" id="fee" name="fee" class="input input_87" value="<?php echo $rows['deliver_minfee']?>" onblur= "if(!/^[0-9\.]+$/.test(this.value))alert('Must be number! ')"/> Dollar <span>(0 is none)</span></p>
						<p><label class='label_140'>Delivery fee：</label><input type="text" id="deliverFee" name="deliverFee" class="input input_87" value="<?php echo $rows['deliver_fee']?>" onblur= "if(!/^[0-9\.]+$/.test(this.value))alert('Must be number! ')"/> Dollar <span>(0 is free)</span></p>
						<p><label class='label_140'>Committed meal delivery time：</label><input type="text" name="dTime" class="input input270" value="<?php echo $rows['deliver_delivertime']?>"/></p>
						<p style="color:red;"><label class='label_140'></label>The promised meal delivery time is not displayed if not filled in。</p>
						<p><label class='label_140'>Is delivery fee free when starting fee is MAX：</label><input name="isfee" value="0" <?php if ($rows['deliver_isfee']==='0') echo "checked"?> type="radio"> No <input name="isfee" value="1" <?php if ($rows['deliver_isfee']=='1') echo "checked"?> type="radio"> free</p>
						<p><label class='label_140'>&nbsp;</label><input type="image" src="../images/button/submit_t.jpg" onClick="return check()" /></p>
						</form>
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
//<![CDATA[
	$(function(){
	   $("#area").change(function(){
		   var area=$("#area").val();
			$.post("area.ajax.php", { 
						'area_id' :  area,
							'act':'circle'
					}, function (data, textStatus){
							if (data==""){
								$("#circle").html("<option value=''>No circle</option>")
							}else
								$("#circle").html("<option value=''>Chose</option>"+data);
					});
	   })
	})

	$(function(){
	   $("#circle").change(function(){
		   var circle=$("#circle").val();
			$.post("area.ajax.php", { 
						'circle_id' :  circle,
						'act':'spot'
					}, function (data, textStatus){
							if (data==""){
								$("#spot").html("<option value=''>No landmark</option>")
							}else
								$("#spot").html(data);
						
					});
	   })
	})

	function check(){
		if ($("#spot").val()==''){
			alert('Landmark cannot empty');
			return false;
		}
		if ($("#fee").val()==''){
			alert('Starting fee cannot empty');
			return false;
		}
		if ($("#deliverFee").val()==''){
			alert('Delivery fee cannot empty');
			return false;
		}
		
	}

	function delShopTime(id){
		$.post("shop.ajax.php", { 
			'timeid' :  id,
			'act':'delTime'
		}, function (data, textStatus){
							
			$("#spotList").html(data);
		});
	}
//]]>
</script>

</html>
