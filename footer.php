<?php
	/**
	 *  footer.php  
	 *
	 * @version       v0.01
	 * @create time   2011-8-6
	 * @update time
	 * @author        lujiangxia
	 * @copyright     Copyright (c) 微普科技 WiiPu Tech Inc. (http://www.wiipu.com)
	 * @informaition
	 */
?>
	<div id="footer">
		<div id="footer_main">
			<p class="center">
				
					<?php
						$sql="select * from ".WIIDBPRE."_about  order by about_order asc,about_id desc";
						$rs=mysql_query($sql);
						$num=mysql_num_rows($rs);
						$i=1;
						while($rows=mysql_fetch_assoc($rs)){							
						    $type=$rows['about_type'];

							if ($type=='1'){
								if ($site_isshowadminindex=='1' || $site_isshowcard=='1'){
									$class="class='li'";
								}else{
									$class="class='li no-bg'";
								}
								
								echo "<a href='about.php?id=".$rows['about_id']."' ".$class.">".$rows['about_title']."</a>";//内容	
							}else{						
								echo "<a href='".$rows['about_content']."' class='li'>".$rows['about_title']."</a>";//链接
							}
							$i++;
						}
						if ($site_isshowadminindex=='1'){
							$class="class='li'";
							$manage=" <a href='".$admin_dir."/index.php' class='li no-bg,li' target='_blank'>管理后台</a>";
						}else{
							$class="class='li no-bg'";
							$manage='';
						}
						if ($site_isshowcard=='1') echo "<a href='certificate.php' ".$class.">餐厅证照</a>";
						echo $manage;
					?>
					
					
				
			</p>
			<p class='center' style="margin-top:5px;text-align:Center;margin-top:10px;">版权所有 <a href="http://www.wiipu.com" target="_blank" class='center'>北京微普科创科技有限公司</a> Powered By <a href='http://www.diancan365.com' >微普外卖点餐系统</a> <?php echo $version?> </p>
			<div>
			
			
		</div>
		
	</div>