<?php 
	
?>
						<div class="cartbox">
						<form method="post" action="userorder.php?shopID=<?php echo $shopID?>&shopSpot=<?php echo $spotID?>&circleID=<?php echo $circleID?>" id="cartForm">
							<div><img src="images/cart_top.jpg" width="227" height="41" alt="" /></div>
							<div class="tableMain">
							<div class='cart_h1'  style='display:none'>
								地址：<!--以后要把spotID1 改为spotID -->
								<div class='defaultAddress' style='display:none;'>
								<?php
									if (!empty($_SESSION['qiyu_uid'])){
									//得到默认地址
									$defaultAddress=getDefaultAddress($_SESSION['qiyu_uid']);
									echo "<div id='defaultAddress1' >".$defaultAddress['address']."</div>";
									//echo "<input type=\"hidden\" id=\"spotID\" name='spotID' value='".$defaultAddress['spot']."'/>";
									echo "<input type=\"hidden\" id=\"spotID\" name='spotID' value='".$spotID."'/>";
									echo "<input type=\"hidden\" id=\"addressID\" name='addressID' value='".$defaultAddress['id']."'/>";
									}else{
										echo "<a href='userlogin.php' style='text-decoration:underLine;'>You have not submitted an address yet</a>";
										echo "<input type=\"hidden\" id=\"spotID\" name='spotID' value='".$spotID."'/>";
									echo "<input type=\"hidden\" id=\"addressID\" name='addressID' value='0'/>";
									}
								?>
									
								
								</div>
								<span><a href='javascript:void()' onClick='showAddressCart()'>edit</a></span>
							</div>
							<?php if (!empty($_SESSION['qiyu_uid'])){?>
							
							<div id='addressShow' style='display:none;'>
							
								
								<div id='addressAll'>
							<?php
							if (!empty($spotID))
								$sql="select * from qiyu_useraddr,qiyu_circle,qiyu_spot,qiyu_area where useraddr_area=area_id and useraddr_circle=circle_id and useraddr_spot=spot_id and useraddr_user =".$QIYU_ID_USER." and useraddr_spot='".$spotID."'  order by useraddr_type asc,useraddr_id desc";
							else
								$sql="select * from qiyu_useraddr,qiyu_circle,qiyu_spot,qiyu_area where useraddr_area=area_id and useraddr_circle=circle_id and useraddr_spot=spot_id and useraddr_user =".$QIYU_ID_USER."  order by useraddr_type asc,useraddr_id desc";
							$rs=mysql_query($sql);
							$count=mysql_num_rows($rs);
							if($count>0){
								echo "<div class='haveAddress'>";
								echo "<p class='title'>The address you already have：</p>";
								$j=1;
								while ($rows=mysql_fetch_assoc($rs)){
									
						?>
								<div class='cart_addlist'>
									<div class='c_left'>
										<input type="radio"  name="addressList" value="<?php echo $rows['useraddr_id']?>" <?php if ($j=='1') echo "checked"?>/>
									</div> 
									<div class='c_right'>
										<?php echo $rows['area_name'].$rows['circle_name'].$rows['spot_name'].$rows['useraddr_address']?>
									</div>
									<div class='clear'></div>
								</div>
						<?php
										$j++;
								}
								echo "</div>";
							}
							
							
						?>
								
							</div>
							<div class='clear'></div>
							<div class='haveAddress'>
								<p class='title'>I want to add a new address+</p>
								<div class='cart_list'><label>北京市</label><select id="area1" name="area1" class='select'>
								<option value="">please choose</option>
									<?php
										$selecte="";
										$sql_area = "select * from ".WIIDBPRE."_area";
										$rs_area = mysql_query($sql_area);
										while($row_area = mysql_fetch_assoc($rs_area)){
											if ($area_id==$row_area['area_id'])
												$selecte="selected";
											else
												$selecte='';
											echo '<option value="'.$row_area['area_id'].'" '.$selecte.'>'.$row_area['area_name'].'</option>';
										}
									?>
								</select> <select id="circle1" name="circle1" class='select select_84'>
									<option value="">please choose</option>
							<?php
								if (!empty($area_id)){
									$selecte="";
									$sql_area = "select ac.areacircle_circle,c.circle_name from ".WIIDBPRE."_areacircle ac,".WIIDBPRE."_circle c where ac.areacircle_circle=c.circle_id and areacircle_area=".$area_id;
									$rs_area = mysql_query($sql_area);
									while($row_area = mysql_fetch_assoc($rs_area)){
										if ($circle_id==$row_area['areacircle_circle'])
											$selecte="selected";
										else
											$selecte='';
										echo '<option value="'.$row_area['areacircle_circle'].'" '.$selecte.'>'.$row_area['circle_name'].'</option>';
									}
								}
								
							?>
								</select><div class='clear'></div></div>
								<div class='cart_list'><select id="spot1" name="spot1" class='select select_84' style='margin-left:118px;'>
									<option value="">please choose</option>
							<?php
								if (!empty($circle_id)){
									$selecte="";
									$sql_area = "select spot_id,spot_name from ".WIIDBPRE."_spot where spot_circle=".$circle_id;
									$rs_area = mysql_query($sql_area);
									while($row_area = mysql_fetch_assoc($rs_area)){
										if ($spotID==$row_area['spot_id'])
											$selecte="selected";
										else
											$selecte='';
										echo '<option value="'.$row_area['spot_id'].'" '.$selecte.'>'.$row_area['spot_name'].'</option>';
									}
								}
							?>
								</select></div>
							<?php
								$userStr=getUser($QIYU_ID_USER);
							?>
								<input type="hidden" id="phone" value='<?php echo $userStr['user_phone']?>'/>
								<input type="hidden" id="name" value='<?php echo $userStr['user_name']?>'/>
								<div class='cart_list'><label style='width:64px;'>Detailed house number</label><input type="text" id="address" name="address" class='input'/><div class='clear'></div></div>
								<div class='cart_list' style='text-align:right;margin-right:4px;'><a href='javascript:void();' style='color:#fe5b02;' onClick='addAddress_cart()'>confirm</a></div>
							</div>
							</div>
							<?php
								}
							?>
							
							<div class='haveAddress' style='border:0;'>
								<p>Take-out time requirement：</p>
								<div class='cart_list'><select id="time1" name='time1' class='select' style='width:107px;color:#fe5b02;'>
								<?php
									
									
									for ($s=0;$s<7;$s++){
										$today=time()+24*3600*$s;
										$today1=date('Y-m-d',time()+24*3600*$s);
										$ss=getdate($today);
										if ($s==0)
											$dayStr="Today".$ss['mon']."month".$ss['mday']."day";
										else
											$dayStr=$ss['mon']."month".$ss['mday']."day";
								?>
									<option value="<?php echo $today1?>" ><?php echo $dayStr?></option>
								<?php
									}	
								?>
								</select> <select id="time2" name='time2' class='select' style='width:86px;color:#fe5b02;'>
									
								<?php
									if (checkDeliverTime($shopID)) echo "<option value=\"\">Deliver as soon as possible</option>";
									$tt=1;
									$sql="select * from qiyu_delivertime where delivertime_shop=".$shopID." order by delivertime_starttime asc";
									$rs=mysql_query($sql);
									while ($rows=mysql_fetch_assoc($rs)){
										$start=strtotime($rows['delivertime_starttime']);
										$end=strtotime($rows['delivertime_endtime']);
										
										for($i=$start;$i<=$end;$i+=1800){
											$today=date('H:i',time());
											$result=date('H:i',$i);
											if ($result>$today){
												if ($tt>2)
													echo "<option value='".$result."'>".$result."</option>";
												$tt++;
											}
											
											
										}
									}
								?>
								</select></div>
							</div>
							<div style='margin-top:14px;'><img src="images/line_c.jpg" alt="" /></div>
							
								<table>
								<?php
									$i=0;
									$total=0;
									if (strstr($cur_cart_array,"||")!==false) setcookie("qiyushop_cart","",time()+60*60*24*7);
									$cur_cart_array = explode("///",$cur_cart_array);
									foreach($cur_cart_array as $key => $goods_current_cart){
										$currentArray=explode("|",$goods_current_cart);
										$cookieShopID=$currentArray[0];
										$cookieFoodID=$currentArray[1];
										$cookieFoodCount=$currentArray[2];
										if ($shopID==$cookieShopID){
											$sql="select * from qiyu_food where food_id=".$cookieFoodID." and food_shop=".$cookieShopID;
											$rs=mysql_query($sql);
											$rows=mysql_fetch_assoc($rs);
											if ($rows){
												$total+=$rows['food_price']*$cookieFoodCount;
								?>
												<tr id='<?php echo $key?>cart'>
													<td width="117" class="padding"><?php echo $rows['food_name']?></td>
													<td width="12" ><img class="addImg" src="images/add.jpg" alt="" style='cursor:pointer;' onClick="addCart_c(<?php echo $cookieShopID?>,<?php echo $cookieFoodID?>)"/></td>
													<td width="12" ><input type="text" class="cutInput" readonly value="<?php echo $cookieFoodCount?>"/></td>
													<td width="22" ><img class="subtractImg"  src="images/cut.jpg" alt="" style='cursor:pointer;' onClick="subtractCart(<?php echo $cookieShopID?>,<?php echo $cookieFoodID?>)"/></td>
													<td width="33" class="center"><?php echo $rows['food_price']*$cookieFoodCount ?></td>
													<td width="21" ><img src="images/del.gif" alt="删除" onClick="delCart(<?php echo $key?>,<?php echo $shopID?>,<?php echo $rows['food_id']?>,<?php echo $spotID?>)"  style="cursor:pointer;" class="delImg"/></td>
												</tr>
								<?php
												$i+=1;
											}

										}
									}

									if ($i==0)			
										echo "<div style=\"padding-left:10px;\"> Shopping cart is empty </div>";
										
								?>
									
								<?php
								
									if ($i>0){
										
										if ($deliver_isfee=='1' && $total>=$sendfee_r) $deliverfee_r=0;
										
										
								?>	
									
									<tr>
										<td colspan='6' class="red padding" width="220">Total order：<span id="total">CA$<?php echo $total?></span></td> 
									
													
									</tr>
									
									
								<?php
									//if ($discount!="0.0"){	
										//$total=$total*($discount/10);
								?>
									<!--<tr>
										<td colspan='6' class="red padding" width="220">折扣后价格：<span id="total"><?php echo $total?></span>元</td> 
									
													
									</tr>-->
								<?php
									//}	
								?>
									
									<tr id='selever' >
										<td colspan='6' class="gray padding" width="220"><span id="deliverfee">Meal delivery：CA$<?php echo $deliverfee?></span><span style="margin-left:13px;" id='sendfee'>
										
										<?php

										if ($deliver_isfee=='1') echo "full".$sendfee_r."dollar free meal";
										echo "Minimum delivery".$sendfee_r."CA$";
										
									?>	
										
										
										
										</span></td> 
									
													
									</tr>
									<tr id='selever2' >
										<td colspan='6' class="padding" width="220">total：<span id="totalAll"><?php echo $total+$deliverfee_r?>CA$</span></td> 
									
													
									</tr>
							
									<tr>
										<td colspan='6' class="gray padding" width="220">order notes</td> 
									
													
									</tr>
									<tr>
										<td colspan='6' class="gray padding" width="220" style='padding-left:7px;'><textarea id="desc"  name="desc" class='textInput'></textarea></td> 
									
													
									</tr>
									<?php
										if ($total>=$sendfee_r || $total==0)	{
									?>
									<tr >
										<td colspan='6' align='right' style="border:0;padding-right:5px;" id="allSend"><img src="images/button/send.gif" id="send_button"  alt="" onClick="return checkout(<?php echo $total?>,<?php echo $shopID?>)" style='cursor:pointer;' /> </td> 			
									</tr>
									<?php
									}else{
									
									?>
										<tr >
										<td colspan='6' align='right' style="border:0;padding-right:5px;" id="allSend"> <img src="images/button/submit_2_0.jpg" id="send_button_44"  alt="" onClick="return checkout(<?php echo $total?>,<?php echo $shopID?>)" style='cursor:pointer;' /></td> 			
									</tr>
									<?php
									}	
									?>
									
									<input type="hidden" id="send_fee" name='send_fee' value='<?php echo $sendfee_r?>' />
								<?php
									}	
								?>
								</table>
								<input type="hidden" id="uid" value='<?php echo $QIYU_ID_USER?>'/>
							</div><input type="hidden" id="shopID"  value='<?php echo $shopID?>'/>
							<input type="hidden" id="circleID" name="circleID"  value='<?php echo $circleID?>'/>
							</form>
							<div><img src="images/shade.jpg" width="226" height="8" alt="" /></div>
						</div><!--cartbox完-->