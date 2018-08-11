<?php
	
?>					
					<input type="hidden" id="orderid" name="orderid" value="<?php echo $row_n['order_id']?>" />
					<input type="hidden" id="orderkey" name="orderkey" value="<?php echo $key?>" />
					<h1 class="order_h1">All orders</h1>
				<?php
					if ($orderAllCount>0){
						if ($key=="all"){
					?>
						<div class="table orderTable">
							<table>
								<tr>
									<td width="150" class="metal">Order time</td>
									<td width="130" class="metal borderLeft">order number</td>
									<td width="75" class="metal borderLeft">Amount</td>
									<td width="84" class="metal borderLeft">status</td>
									<td width="84" class="metal borderLeft">Appointment</td>
									<td width="150" class="metal borderLeft">Appointment</td>
									<td width="100"  class="metal borderLeft">operating</td>
								</tr>
					<?php
								
								$sql="select order_addtime,shop_name,shop_id,order_totalprice,order_status,order_id,order_id2,order_type,order_time1,order_time2 from qiyu_order,qiyu_shop where (shop_id2=order_shop or shop_id=order_shopid) and order_user=".$QIYU_ID_USER." and shop_status='1' order by order_addtime desc limit 10";
								$rs=mysql_query($sql);
								while ($rows=mysql_fetch_assoc($rs)){
									$type=$rows['order_type'];
									$time1=$rows['order_time1'];
									$time2=substr($rows['order_time2'],0,5);
									if ($type=='1')
										$str='Yes';
									else
										$str='No';
					?>
									<tr>
										<td class="borderBottom borderLeft" width="86"><?php echo $rows['order_addtime']?></td>
										<td class="borderBottom borderLeft" align='center'><a href="userorderintro.php?id=<?php echo $rows['order_id']?>&key=all" style="color:red;"><?php echo $rows['order_id2']?></a></td>
										<td class="borderBottom borderLeft" align='center'><?php echo $rows['order_totalprice']?> Dollars</td>
										<td class="borderBottom borderLeft" align='center'><?php echo $orderState[$rows['order_status']]?></td>
										<td class="borderBottom borderLeft" align='center'><?php echo $str?></td>
										<td class="borderBottom borderLeft"><?php echo $time1." ".$time2?></td>
										<td class="borderBottom borderRight borderLeft" width="91" align='center'><?php if ($rows['order_status']=='0'){?><a href="javascript:void()" onClick="orderCancel(<?php echo $rows['order_id']?>)">cancel order</a><?php }?></td>
										
									</tr>
				<?php
								}	
				?>
								
							</table>
						</div>
				<?php
						}
					}else{
						echo "<p style='text-align:center;font-size:18px;padding-top:50px;padding-bottom:30px;'>You don't have any order information yet</p>";
					}
				?>
