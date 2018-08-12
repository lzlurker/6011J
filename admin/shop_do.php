<?php 


	require_once("usercheck2.php");
	$act=sqlReplace(trim($_GET['act']));
	switch ($act){
		case "base":
			$name=sqlReplace(trim($_POST['name']));
			
			$address=sqlReplace(trim($_POST['address']));
			if($address=='add address'){$address='';}
		
			$tel=sqlReplace(trim($_POST['tel']));
			$opentime=sqlReplace(trim($_POST['opentime']));
			$endtime=sqlReplace(trim($_POST['endtime']));
			
			$mainfood=sqlReplace(trim($_POST['mainfood']));
			$discount=empty($_POST['discount'])?'0.00':sqlReplace(trim($_POST['discount']));//折扣
			
			$buycount=empty($_POST['buycount'])?'0':sqlReplace(trim($_POST['buycount']));//购买总数
			$intro=HTMLEncode(trim($_POST['intro']));
			if($intro=='200 words'){$intro='';}
			
			checkData($name,'Restaurant name',1);
			checkData($address,'Restaurant address',1);
			checkData($tel,'Restaurant phone number',1);
			checkData($opentime,'Restaurant opening time',1);
			checkData($endtime,'Restaurant closed time',1);
			checkData($mainfood,'Restaurant main food',1);
			checkData($intro,'Restaurant introduction',1);
			$sql="update qiyu_shop set shop_discount='".$discount."',shop_buycount='".$buycount."',shop_name='".$name."',shop_address='".$address."',shop_tel='".$tel."',shop_openstarttime='".$opentime."',shop_openendtime='".$endtime."',shop_intro='".$intro."',shop_status='1',shop_addtime=now(),shop_mainfood='".$mainfood."',shop_type='1' where shop_id=".$QIYU_ID_SHOP;
			if (mysql_query($sql)){
				alertInfo("Edit success","",1);
				Header("Location: shopadd.php");
			}else
				alertInfo("Edit failed","",1);
		break;
		case "addtime":
			$name=sqlReplace(trim($_POST['name']));
			$t1=sqlReplace(trim($_POST['t1']));
			$s1=sqlReplace(trim($_POST['s1']));
			$t2=sqlReplace(trim($_POST['t2']));
			$s2=sqlReplace(trim($_POST['s2']));
			checkData($name,'Time period name',1);
			$value1=$t1.":".$s1;
			$value2=$t2.":".$s2;
			
			$sqlStr="insert into qiyu_delivertime(delivertime_name,delivertime_shop,delivertime_starttime,delivertime_endtime) values ('".$name."',".$QIYU_ID_SHOP.",'".$value1."','".$value2."')";
			if (mysql_query($sqlStr)){
				alertInfo("Add success","",1);
			}else{
				alertInfo("Add failed","",1);
			}
			
		break;
		case "fee":
			$fee=sqlReplace(trim($_POST['fee']));
			$deliverFee=sqlReplace(trim($_POST['deliverFee']));
			$dTime=sqlReplace(trim($_POST['dTime']));
			$isfee=sqlReplace(trim($_POST['isfee']));
			if(empty($fee)){
				if($fee=='0'){
					
				}else{
					alertInfo('The starting fee cannot be empty','',1);
				}
			}else{
				if(!is_numeric($fee)){
					alertInfo('The starting fee must be a number','',1);
				}
			}
			if(empty($deliverFee)){
				if($deliverFee=='0'){
					
				}else{
					alertInfo('Delivery fee cannot be empty','',1);
				}
			}else{
				if(!is_numeric($deliverFee)){
					alertInfo('The meal delivery fee must be a number','',1);
				}
			}
			
			$sql_select="select deliver_id from qiyu_deliver";
			$rs_select=mysql_query($sql_select);
			$rows_select=mysql_fetch_assoc($rs_select);
			if ($rows_select){
				$sql_str="update qiyu_deliver set deliver_fee=".$deliverFee.",deliver_minfee=".$fee.",deliver_delivertime='".$dTime."',deliver_isfee=".$isfee;
				mysql_query($sql_str);
				alertInfo('Successful fee setting','',1);
			}else{
				$sql_str="insert into qiyu_deliver(deliver_fee,deliver_minfee,deliver_delivertime,deliver_shop,deliver_isfee) values(".$deliverFee.",".$fee.",'".$dTime."',".$QIYU_ID_SHOP.",".$isfee.")";
				if (mysql_query($sql_str)){
					alertInfo('Successful fee setting','',1);
				}else{
					alertInfo('Fee setting failed','',1);
				}	
			}
			
		break;
		case 'savefee':
			$i=trim($_POST['i']);
			for($x=1;$x<=$i;$x++){
				$id=$_POST['id'.$x];
				$deliverfee=$_POST['deliverbycircle_fee'.$x];
				$sendfee=$_POST['deliverbycircle_minfee'.$x];
				$delivertime=$_POST['deliverbycircle_delivertime'.$x];
				$isfee=$_POST['isfee'.$x];
				if($deliverfee=='无'){
					$deliverfee='0';
				}
				if($sendfee=='free'){
					$sendfee='0';
				}
				
				$sql="update ".WIIDBPRE."_deliverbycircle set deliverbycircle_isfee='".$isfee."',  deliverbycircle_fee=".$deliverfee.",deliverbycircle_minfee=".$sendfee.",deliverbycircle_delivertime='".$delivertime."' where deliverbycircle_id=".$id;	
				if(!mysql_query($sql)){
					alertInfo('Save failed! ',"",1);
				}
			}
			alertInfo('Saved!',"",1);
		break;
		case "delfee":
			$id=sqlReplace(trim($_GET['id']));
			$circleid=sqlREplace(trim($_GET['circleid']));
			$sql="delete from qiyu_shopcircle where shopcircle_circle=".$circleid." and shopcircle_shop=".$QIYU_ID_SHOP;//删除商家商圈
			mysql_query($sql);
			$sql="delete from qiyu_deliverbycircle where deliverbycircle_id=".$id;//删除商圈下费用
			mysql_query($sql);
			alertInfo('Deleted','',1);
			
		break;
		case "addstyle":
			$style=sqlReplace(trim($_POST['style']));
			$sqlStr="select * from qiyu_shopstyle where shopstyle_style=".$style." and shopstyle_shop=".$QIYU_ID_SHOP;
			$rs=mysql_query($sqlStr);
			$row=mysql_fetch_assoc($rs);
			if ($row){
				alertInfo('Added','',1);
			}else{
				$sql="insert into qiyu_shopstyle(shopstyle_style,shopstyle_shop) values (".$style.",".$QIYU_ID_SHOP.")";
				if(mysql_query($sql)){
					alertInfo('Restaurant cuisine added successfully','',1);
				}else{
					
					alertInfo('Restaurant cuisine added failed','',1);
				}
			}
		break;
		case 'delstyle':
			$styleid=sqlReplace(trim($_GET['styleid']));
			$sql="delete from qiyu_shopstyle where shopstyle_id=".$styleid;
			if(mysql_query($sql)){
				alertInfo('Deleted','',1);
			}else{
				alertInfo('Delete failed','',1);
			}
		break;
		case 'addfoodtype':
			//得到提交的数据，并进行过滤
			$foodtype=sqlReplace(trim($_POST['foodtype']));

			//检验数据的合法性
			checkData($foodtype,'foodtype',1);
			
			$sql="select count(*) from ".WIIDBPRE."_foodtype where foodtype_name='".$foodtype."' and foodtype_shop=".$QIYU_ID_SHOP;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if($rows['count(*)']>0){
				alertInfo('The menu is repeated! Please take another name','',1);
			}else{
				$sql = "insert into ".WIIDBPRE."_foodtype(foodtype_name,foodtype_shop) values ('".$foodtype."','".$QIYU_ID_SHOP."')";
				$result=mysql_query($sql);
				if($result){
					alertInfo('Add success',"",1);
				}else{
					alertInfo('Error, retry',"",1);
				}
			}
		break;
		case 'delfoodtype':
			$id=sqlReplace(trim($_GET['id']));
			checkData($id,"FYID",0);
			$sql="select * from qiyu_foodtype where foodtype_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row)
				alertInfo('data no found','',1);
			else{
				$sql="select * from qiyu_food where food_foodtype=".$id." and food_shop=".$QIYU_ID_SHOP;
				$rs=mysql_query($sql);
				$row=mysql_fetch_assoc($rs);
				if($row){
					alertInfo("There are also menus under this category, please delete the menu details first！",'',1);
				}else{
					$sql="delete from qiyu_foodtype where foodtype_id=".$id;
					if(mysql_query($sql)){
						alertInfo("Deleted",'',1);
					}else{
						alertInfo("Failed, retry","",1);
					}
				}
			}
		break;
		case 'savefoodtype':
			$i=trim($_POST['i']);
			for($x=1;$x<=$i;$x++){
				$id=$_POST['id'.$x];
				$foodtypename=$_POST['foodtypename'.$x];
				$order=$_POST['order'.$x];
				checkData($foodtypename,'',1);
				$sql="select * from ".WIIDBPRE."_foodtype where foodtype_id=".$id;
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				if(!$row)
					alertInfo('menu does not exist',"",1);
				else{
					$sql2="select count(*) from ".WIIDBPRE."_foodtype where foodtype_name='".$foodtypename."' and foodtype_shop=".$QIYU_ID_SHOP." and foodtype_id<>".$id;
					$res=mysql_query($sql2);
					$count=mysql_fetch_assoc($res);
					if($count['count(*)']>0)
						alertInfo('The menu category has the same name, please change the name.','foodtype.php',0);
					else{
						$sql3="update ".WIIDBPRE."_foodtype set foodtype_name='".$foodtypename."',foodtype_order=".$order." where foodtype_id=".$id;
						if(mysql_query($sql3)){
							//alertInfo('菜单大类修改成功',"",1);
						}else{
							alertInfo('Error, retry','',1);
						}
					}
				}
			}
			alertInfo('Success!',"foodtype.php",0);
		break;
		case 'savefood':
			//批量删除功能开始
			if($_POST['delid']){			
						$id=implode(",",$_POST['delid']);
							$sql2="delete from ".WIIDBPRE."_food where food_id in($id)";
							if(mysql_query($sql2)){
								alertInfo('Deleted',"",1);
							}									
			}else{
					if(!isset($_POST[delid]) and ($_POST[btnSave]=='删除')){
						alertInfo('Please select the menu to delete',"",1);
					}else{
						$i=trim($_POST['i']);
						for($x=1;$x<=$i;$x++){
						$id=$_POST['id'.$x];
						$order=$_POST['order'.$x];
						$sql="select * from ".WIIDBPRE."_food where food_id=".$id;
						$result=mysql_query($sql);
						$row=mysql_fetch_assoc($result);
						if(!$row)
							alertInfo('No data',"food.php",0);
						else{
							
							$sql3="update ".WIIDBPRE."_food set food_order=".$order." where food_id=".$id;
							if(mysql_query($sql3)){
								//alertInfo('菜单大类修改成功',"",1);
					}else{
						alertInfo('Error, retry','food.php',0);
						}
					}
				}
			}
			}
			alertInfo('Sort success!',"food.php",0);
		break;
		case 'addfood':
			//得到提交的数据，并进行过滤
			$name=sqlReplace(trim($_POST['name']));
			$price=sqlReplace(trim($_POST['price']));
			$food_status=sqlReplace(trim($_POST['food_status']));
			$type=sqlReplace(trim($_POST['type']));
			$intro=sqlReplace(trim($_POST['intro']));
			$pic= empty($_POST['upfile1'])?'':sqlReplace(trim($_POST['upfile1']));

			//检验数据的合法性
			checkData($name,'Name',1);
			if($price==''){
				alertInfo('The price of the dish cannot be empty！','',1);
			}
			if(!is_numeric($price)){
				alertInfo('The price of the dish must be number！','',1);
			}
			if (empty($type)){
				alertInfo('The classification of dishes cannot be empty！','foodtype.php',0);
			}
			
			$sql="select count(*) from ".WIIDBPRE."_food where food_name='".$name."' and food_shop=".$QIYU_ID_SHOP;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if($rows['count(*)']>0){
				alertInfo('Existing name, try another','',1);
			}else{				
				$sql2 = "insert into qiyu_food(food_name,food_shop,food_price,food_foodtype,food_intro,food_status,food_order,food_pic) values ('".$name."','".$QIYU_ID_SHOP."','".$price."','".$type."','".$intro."','".$food_status."',999,'".$pic."')";
				$result=mysql_query($sql2);
				if($result){
					$id = mysql_insert_id();//取得刚刚插入数据库的这条记录的自增id  请菜的标签信息插入到菜与标签的关系表里
					if(!empty($_POST['lable'])){
						foreach($_POST['lable'] as $lable){
							$sql3 = "insert into ".WIIDBPRE."_foodbylable(foodbylable_food,foodbylable_foodlable) values ('".$id."','".$lable."')";
							mysql_query($sql3);
						}
					}
					  alertInfo('Add success',"food.php",0);
				}else{
					alertInfo('Error, retry',"",1);
				}
			}
		break;
		case 'editfood':
			$id=sqlReplace(trim($_GET['id']));
			$page=$_GET['page'];
			$name=sqlReplace(trim($_POST['name']));
			$price=sqlReplace(trim($_POST['price']));
			$intro=sqlReplace(trim($_POST['intro']));
			$food_status=sqlReplace(trim($_POST['food_status']));
			$type=sqlReplace(trim($_POST['type']));
			$pic= empty($_POST['upfile1'])?'':sqlReplace(trim($_POST['upfile1']));
			$lable = $_POST['lable'];//修改提交后的标签数组
			$rb=array();
			if (empty($lable)) $lable=array();
			//检验数据的合法性
			checkData($name,'name',1);
			if($price==''){
				alertInfo('The price of the dish cannot be empty','',1);
			}
			if(!is_numeric($price)){
				alertInfo('The price of the dish must be number','',1);
			}
			$id=checkData($id,"ID",0);

			$sql="select * from ".WIIDBPRE."_food where food_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('This dish name does not exist',"",1);
			}else{
					$sql="select * from ".WIIDBPRE."_food where food_name='".$name."' and food_shop=".$QIYU_ID_SHOP." and food_id not in(".$id.") and food_special is NULL";
					$rs=mysql_query($sql);
					$rows=mysql_fetch_assoc($rs);
					if($rows){
						alertInfo('Duplicate dish name!','',1);
					}else{
						$sql3="update ".WIIDBPRE."_food set food_name='".$name."',food_price='".$price."',food_status='".$food_status."',food_foodtype='".$type."',food_intro='".$intro."',food_pic='".$pic."' where food_id=".$id." and food_shop=".$QIYU_ID_SHOP;
						if(mysql_query($sql3)){
							$sql4 = "select foodbylable_foodlable from ".WIIDBPRE."_foodbylable where foodbylable_food=".$id;
							$lab=mysql_query($sql4);
							$j=0;
							while($rowlab=mysql_fetch_assoc($lab)){
								$j++;
								$rb[$j] = $rowlab['foodbylable_foodlable'];
							}//得到没有修改前菜的标签数组
							$insert = array_diff($lable,$rb);//将修改前后菜的标签数组进行比较取差集 进行插入、删除操作
							$delete = array_diff($rb,$lable);
							if($insert){
								foreach($insert as $in){
									$in_sql = "insert into qiyu_foodbylable(foodbylable_food,foodbylable_foodlable) values ('".$id."','".$in."')";
									mysql_query($in_sql);
								}
							}
							if($delete){
								foreach($delete as $del){
									$del_sql="delete from ".WIIDBPRE."_foodbylable where foodbylable_food=".$id." and foodbylable_foodlable=".$del;
									mysql_query($del_sql);
								}
							}
							alertInfo('Change success',"food.php?page=".$page,0);
						}else{
							alertInfo('Error, retry','',1);
						}
					}
			}
		break;
		case 'delfood':
			$id=sqlReplace(trim($_GET['id']));
			$id=checkData($id,"ID",0);
			$sql="select * from ".WIIDBPRE."_food where food_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('No data','',1);
			}else{
				$sql2="delete from ".WIIDBPRE."_food where food_id=".$id;
				if(mysql_query($sql2)){
					$sql3 = "delete from ".WIIDBPRE."_foodbylable where foodbylable_food=".$id;
					if(mysql_query($sql3)){
						alertInfo('Deleted',"",1);
					}
				}else{
					alertInfo('Failed, check SQL','',1);
				}
					
			}
		break;
		case "shopTag":
			$tag=sqlReplace(trim($_POST['tag']));
			$spot=empty($_POST['spot'])?0:sqlReplace(trim($_POST['spot']));
			
			$sql="insert into qiyu_shoptag(shoptag_spot,shoptag_shop,shoptag_tag) values (".$spot.",".$QIYU_ID_SHOP.",".$tag.")";
			mysql_query($sql);
			alertInfo('Add success','',1);
		break;
		case "delTag":
			$id=sqlReplace(trim($_GET['id']));
			
			$sql="select * from qiyu_shoptag where shoptag_id=".$id;
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			if (!$row)
				alertInfo("illegal","",1);
			else{
				$sqlStr="delete from qiyu_shoptag where shoptag_id=".$id;
				if (mysql_query($sqlStr)){
					alertInfo("Deleted","",1);
				}else{
					alertInfo("Delete failed","",1);
				}
			}
		break;
		case "topadd":
			$name=sqlReplace(trim($_POST['name']));
			$price1=sqlReplace(trim($_POST['price1']));
			$price2=sqlReplace(trim($_POST['price2']));
			$pic=sqlReplace(trim($_POST['upfile1']));
			
			$sql="select count(food_id) as c from qiyu_food where food_special='1' and food_status='0' and food_shop=".$QIYU_ID_SHOP;
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			$count=$row['c'];
			if ($count>$FOODSPECIALCOUNT){
				alertInfo("The restaurant has a maximum of 5 recommended dishes.","shoutop.php",0);
			}else{
				$sqlStr="insert into qiyu_food(food_name,food_shop,food_price,food_special,food_pic,food_oldprice,food_isshow,food_status,food_check) values ('".$name."',".$QIYU_ID_SHOP.",".$price2.",'1','".$pic."',".$price1.",'0','0','0')";
				if (mysql_query($sqlStr)){
					alertInfo("Add success","shoptop.php",0);
				}else{
					alertInfo("Error","",1);
				}
			}
			
		break;
		case "hidetop":
			$id=sqlReplace(trim($_GET['id']));
			$sql="update qiyu_food set food_isshow='1' where food_id=".$id." and food_shop=".$QIYU_ID_SHOP;
			if (mysql_query($sql))
				alertInfo("Success","",1);
			else
				alertInfo("Failed","",1);
		break;
		case "showtop":
			$id=sqlReplace(trim($_GET['id']));
			$sql="update qiyu_food set food_isshow='0' where food_id=".$id." and food_shop=".$QIYU_ID_SHOP;
			if (mysql_query($sql))
				alertInfo("Success","",1);
			else
				alertInfo("Failed","",1);
		break;
		case "topedit":
			$name=sqlReplace(trim($_POST['name']));
			$id=sqlReplace(trim($_GET['id']));
			$price1=sqlReplace(trim($_POST['price1']));
			$price2=sqlReplace(trim($_POST['price2']));
			$pic=sqlReplace(trim($_POST['upfile1']));
			$sql="update qiyu_food set food_name='".$name."',food_pic='".$pic."',food_price=".$price2.",food_oldprice=".$price1." where food_id=".$id;
			if (mysql_query($sql))
				alertInfo("Success","shoptop.php",0);
			else
				alertInfo("Failed","",1);
		break;
		case 'topdel':
			$id=sqlReplace(trim($_GET['id']));
			checkData($id,"ID",0);
			$sql="select * from qiyu_food where food_id=".$id;
			$result=mysql_query($sql);
			$row=mysql_fetch_assoc($result);
			if(!$row){
				alertInfo('No data','',1);
			}else{
				$sql2="delete from qiyu_food where food_id=".$id;
				if(mysql_query($sql2)){
					alertInfo('Deleted','',1);
				}else{
					alertInfo('Error, retry','',1);
				}
			}
			break;
		case "editPass":
			$old=sqlReplace(trim($_POST['old']));
			$new1=sqlReplace(trim($_POST['new1']));
			$new2=sqlReplace(trim($_POST['new2']));
			if ($new1!=$new2) alertInfo("The password entered twice is different","",1);
			$sql="select * from qiyu_shop where shop_id=".$QIYU_ID_SHOP."";
			$rs=mysql_query($sql);
			$row=mysql_fetch_assoc($rs);
			if ($row){
				$salt=$row['shop_salt'];
				$pw=md5(md5($old).$salt);
				$newpw=md5(md5($new1).$salt);
				if ($pw==$row['shop_password']){
					$sqlStr="update qiyu_shop set shop_password='".$newpw."' where shop_id=".$QIYU_ID_SHOP."";
					if (mysql_query($sqlStr))
						alertInfo("Change success","",1);
					else
						alertInfo("Change failed","",1);
				
				}else{
					alertInfo("The password is wrong","",1);
				}
			}
			
		break;
		case "updatePhone":
			$phone=sqlReplace(trim($_POST['phone']));
			$code=sqlReplace(trim($_POST['code']));
			$sqlStr="select * from qiyu_shop where shop_id=".$QIYU_ID_SHOP."";
			$result = mysql_query($sqlStr);
			$row=mysql_fetch_assoc($result);
			if ($row){
				if ($code==$row['shop_code']){
					$sql="update qiyu_shop set shop_phone='".$phone."',shop_code='' where shop_id=".$QIYU_ID_SHOP."";
					if (mysql_query($sql))
						alertInfo("Change success","shopupdatephone.php",0);
					else
						alertInfo("Change failed","",1);
				}else{
					alertInfo("Verification code error","",1);
				}
			}
		break;
		case "addspecial";
			//得到提交的数据，并进行过滤
			$sp_id=$QIYU_ID_SHOP;
			$name=sqlReplace(trim($_POST['name']));
			$price=sqlReplace(trim($_POST['price']));
			$oldprice=sqlReplace(trim($_POST['oldprice']));
			$pic=sqlReplace(trim($_POST['upfile1']));
			
			//检验数据的合法性
			checkData($name,'Name',1);
			checkData($price,'After discount',1);
			checkData($oldprice,'Before discount',1);
						
			$sql2 = "insert into qiyu_food(food_name,food_shop,food_price,food_oldprice,food_pic,food_special,food_order) values ('".$name."','".$sp_id."','".$price."','".$oldprice."','".$pic."',1,999)";
			echo $sql2;
			$result=mysql_query($sql2);
			if($result){
				alertInfo('Add success',"foodspecial_list.php",0);
			}else{
				alertInfo('Error, retry',"",1);
			}
		break;
		case "editspecial";
			//得到提交的数据，并进行过滤
			$id=sqlReplace(trim($_GET['id']));
			$name=sqlReplace(trim($_POST['name']));
			$price=sqlReplace(trim($_POST['price']));
			$oldprice=sqlReplace(trim($_POST['oldprice']));
			$pic=sqlReplace(trim($_POST['upfile1']));
			
			//检验数据的合法性
			checkData($id,'ID',0);
			checkData($name,'Name',1);
			checkData($price,'After discount',1);
			checkData($oldprice,'Before discount',1);
						
			$sql="select food_id from ".WIIDBPRE."_food where food_id=".$id;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if(!$rows){
				alertInfo('Illegal operation','',1);
			}else{				
				$sql2 = "update ".WIIDBPRE."_food set food_name='".$name."',food_price='".$price."',food_oldprice='".$oldprice."',food_pic='".$pic."' where food_id=".$id;
				$result=mysql_query($sql2);
				if($result){
					alertInfo('Successfully modified',"foodspecial_list.php",0);
				}else{
					alertInfo('Error, retry',"",1);
				}
			}
		break;
		case "delfoodspecial":
			$id=sqlReplace(trim($_GET['id']));
			checkData($id,'ID',0);
			$sql="select food_id from ".WIIDBPRE."_food where food_id=".$id;
			$rs=mysql_query($sql);
			$rows=mysql_fetch_assoc($rs);
			if(!$rows){
				alertInfo('Illegal operation','',1);
			}else{				
				$sql2 = "delete from ".WIIDBPRE."_food where food_id=".$id;
				$result=mysql_query($sql2);
				if($result){
					alertInfo('successfully deleted',"foodspecial_list.php",0);
				}else{
					alertInfo('Error, retry',"",1);
				}
			}
		break;
		case "savefoodspecail":
			$i=trim($_POST['i']);
			for($x=1;$x<=$i;$x++){
				$id=$_POST['id'.$x];
				$order=$_POST['order'.$x];
				$sql="update ".WIIDBPRE."_food set food_order=".$order." where food_id=".$id;	
				if(!mysql_query($sql)){
					alertInfo('Unknown reason to save failed! ',"foodspecial_list.php",0);
				}
			}
			alertInfo('Saved!',"",1);
		break;
		case "card1":
			$upfile1=sqlReplace(trim($_POST['upfile']));
			checkData($upfile1,'business license',1);

			$sql="update qiyu_shop set shop_certpic='".$upfile1."',shop_certtime=now() where shop_id=".$QIYU_ID_SHOP;
			if (mysql_query($sql)){
				alertInfo("Uploaded","shopcard.php",0);
			}else{
				alertInfo("Upload failed","",1);
			}
		break;
		case "card2":
			$upfile2=sqlReplace(trim($_POST['upfile']));
			checkData($upfile2,'Health permit',1);

			$sql="update qiyu_shop set shop_licensepic='".$upfile2."',shop_licensetime=now() where shop_id=".$QIYU_ID_SHOP;
			if (mysql_query($sql)){
				alertInfo("Uploaded","shopcard.php",0);
			}else{
				alertInfo("Upload failed","",1);
			}
		break;
	}
	

	
?>