$(document).ready(function(){
	    $(".input").blur(function(){
			 var $parent = $(this).parent();
			 if( $(this).is('#phone') ){
					if( this.value==""){
					    var errorMsg = 'Phone number could not be empty';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else{
						var name=$("#phone").val();
							var reg=/^1[358]\d{9}$/;
						 if(name.match(reg)){
							$.get("userpw_do.php", { 
							'act'   :  "check",
							'phone' :  $('#phone').val()
							}, function (data, textStatus){
									if (data=="S")
									{
										var errorMsg = 'This phone number already exist';
										$parent.find('.errormt').text(errorMsg);
										$parent.find('.errormt').addClass('onError');
										return false;
									}else{
										var okMsg = "<img src='images/ok.gif' />";
										$parent.find('.errormt').html(okMsg);
										$parent.find('.errormt').removeClass('onError')
										return true;
									}
							});
						 }else{
							  var errorMsg = 'The format is not correct.';
								$parent.find('.errormt').text(errorMsg);
								$parent.find('.errormt').addClass('onError')
						}
					}
			 }
			  //if( $(this).is('#name') ){
					//if( this.value==""){
					 //   var errorMsg = '可输入2~4个中文.';
                     //   $parent.find('.errormt').text(errorMsg);
					//	$parent.find('.errormt').addClass('onError')
				//	}else{
				//			var name=$("#name").val();
				//			var reg=/^[\u0391-\uFFE5]+$/;
					//	 if(name.match(reg)){

					//		  if (this.value.length>4){
						//		 var errorMsg = '不能超过4个中文.';
						//			$parent.find('.errormt').text(errorMsg);
						//			$parent.find('.errormt').addClass('onError'); 
							//  }else{
						//		 var okMsg = "<img src='images/ok.gif' />";
						//		 $parent.find('.errormt').html(okMsg);
						//		 $parent.find('.errormt').removeClass('onError');
						//	}
						
						// }else{
							// var errorMsg = '姓名只能是中文.';
							//	$parent.find('.errormt').text(errorMsg);
							//	$parent.find('.errormt').addClass('onError'); 
						 //}
					   
					}
			 }
			  if( $(this).is('#address') ){
					if( this.value==""){
					    var errorMsg = 'The address cannot be blank.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError');
					}else{
					    var okMsg = "<img src='images/ok.gif' />";
					     $parent.find('.errormt').html(okMsg);
						 $parent.find('.errormt').removeClass('onError');
					}
			 }

			
			 if( $(this).is('#email') ){
				 if (this.value!=''){
					if( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) ){
						  var errorMsg = 'Please write correct E-mail address.';
						 $parent.find('.errormt').text(errorMsg);
						 $parent.find('.errormt').addClass('onError')
					}else{
						 var okMsg = "<img src='images/ok.gif' />";
						   $parent.find('.errormt').html(okMsg);
						   $parent.find('.errormt').removeClass('onError')
					}
				 }
			 }
			  if( $(this).is('#pw') ){
					if( this.value==""){
					    var errorMsg = 'Password should exceed 6 digits';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else if (this.value.length < 6){
						var errorMsg = 'Password minimum has 6 digits';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else{
					    var okMsg = "<img src='images/ok.gif' />";
					     $parent.find('.errormt').html(okMsg);
						 $parent.find('.errormt').removeClass('onError')
					}
			 }
			 if( $(this).is('#repw') ){
					if( this.value==""){
					    var errorMsg = 'Confirmation password cannot be empty.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else if ($('#pw').val()!=this.value){
					
					     var errorMsg = 'The password typed 2 times should not be the same.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
						
					}else{
						var okMsg = "<img src='images/ok.gif' />";
					     $parent.find('.errormt').html(okMsg);
						 $parent.find('.errormt').removeClass('onError')
					}
			 }

			
		});//end blur
		$(".select").change(function(){
			 if( $(this).is('#area') ){
					if( this.value==""){
					   	$("#tipSelect span").html(errorMsg);
						$("#tipSelect span").addClass('onError');
					
					}else{
					    var okMsg = "<img src='images/ok.gif' />";
					     $("#tipSelect span").html(okMsg);
						 $("#tipSelect span").removeClass('onError');
					}
			 }
			  if( $(this).is('#circle') ){
					if( this.value==""){
					   	$("#tipSelect span").html(errorMsg);
						$("#tipSelect span").addClass('onError');
					
					}else{
					    var okMsg = "<img src='images/ok.gif' />";
					     $("#tipSelect span").html(okMsg);
						 $("#tipSelect span").removeClass('onError');
					}
			 }
			  if( $(this).is('#spot') ){
					if( this.value==""){
					   	$("#tipSpot span").html(errorMsg);
						$("#tipSpot span").addClass('onError');
					
					}else{
					    var okMsg = "<img src='images/ok.gif' />";
					     $("#tipSpot span").html(okMsg);
						 $("#tipSpot span").removeClass('onError');
					}
			 }
		});//end blur

		//添加新地址。
		 $('#addAddress').click(function(){

				
				 if ($("#area").val()=='' || $("#circle").val()=='' || $("#spot").val()==''){
					
					var errorMsg = '请选择您的地址';
					$("#tipSelect span").html(errorMsg);
					$("#tipSelect span").addClass('onError');
					
				 }
			
			
				$(".input").trigger('blur');
				var numError = $('.onError').length;
				if(numError){
					return false;
				} 
		 });
	});

	function checkReg(){
		 if ($("#area").val()=='' || $("#circle").val()==''){
					
					var errorMsg = '请选择您的地址';
					$("#tipSelect span").html(errorMsg);
					$("#tipSelect span").addClass('onError');
					
		 }
		if ($("#spot").val()==''){
					
					var errorMsg = '请选择地标';
					$("#tipSpot span").html(errorMsg);
					$("#tipSpot span").addClass('onError');
					
		 }
		$(".input").trigger('blur');
		var numError = $('.onError').length;
		if(numError){
			return false;
		} 
		
		if (!$('[name=agree]:checkbox').attr("checked"))
		{
			alert('请选择同意协议复选框');
			return false;
		}
	}

	$(function(){
	   $("#area_r").change(function(){
		   var area=$("#area_r").val();
			$.post("area.ajax.php", { 
						'area_id' :  area,
							'act':'circle'
					}, function (data, textStatus){
							if (data==""){
								$("#circle_r").html("<option value=''>没有商圈</option>")
							}else
								$("#circle_r").html("<option value=''>请选择</option>"+data);
					});
	   })
	})

	$(function(){
	   $("#circle_r").change(function(){
		   var circle=$("#circle_r").val();
			$.post("area.ajax.php", { 
						'circle_id' :  circle,
						'act':'spot'
					}, function (data, textStatus){
							if (data==""){
								$("#spot_r").html("<option value=''>没有地标</option>")
							}else
								$("#spot_r").html(data);
						
					});
	   })
	})

	