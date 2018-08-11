	//取消订单
	function orderCancel(id){
		if(confirm('Are you sure to cancel the order？')){
			$.post("userorder.ajax.php", { 
				'id'     :  id,
				'act'    :  'qxOrder'
				}, function (data, textStatus){
					var post = data;
					if (post=="S"){
						alert('Cancel Successful');
						//TINY.box.show('取消成功',0,160,60,0,2);
						location.href='usercenter.php?tab=2&key=all';
					}
					if (post=="E"){
						alert('The order does not exist');
						location.href='usercenter.php?tab=2&key=all';
					}
					if (post=="Q"){
						alert('Order recieved!!! And not cancelable');
						location.href='usercenter.php?tab=2&key=all';
					}
					if (post=="N"){
						alert('Cancelation fail because unexpected error');
						location.href='usercenter.php?tab=2key=all';
					}
				});
		}
	}
	function orderFinish(id){
		$.post("userorder.ajax.php", { 
			'id'     :  id,
			'act'    :  'finishOrder'
			}, function (data, textStatus){
				var post = data;
				if (post=="S"){
					location.href='usercenter.php?tab=2&key=all';
				}else if(post=="N"){
					location.href='usercentertab2_n.inc.php';
				}else{
					alert("Operation failed");
				}
			});

	}