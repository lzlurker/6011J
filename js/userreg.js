$(document).ready(function(){
	    $(".input").blur(function(){
			 var $parent = $(this).parent();
			 if( $(this).is('#phone') ){
					if( this.value==""){
					    var errorMsg = 'Phone number cannot be empty';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else{
						var name=$("#phone").val();
							var reg=/^\d+$/i;
						 if( name.match(reg)){
							var okMsg = "<img src='images/ok.gif' />";
							 $parent.find('.errormt').html(okMsg);
							 $parent.find('.errormt').removeClass('onError')
						 }else{
							  var errorMsg = 'Phone number format is not correct.';
								$parent.find('.errormt').text(errorMsg);
								$parent.find('.errormt').addClass('onError')
								
							
						}
					}
			 }
			  if( $(this).is('#name') ){
					if( this.value==""){
					    var errorMsg = 'The name cannot be empty.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else{
							var name=$("#name").val();
							var reg=/^[\u0391-\uFFE5]+$/;
						// if(name.match(reg)){

							  if (this.value.length>40){
								 var errorMsg = 'Cannot exceed 40 characters.';
									$parent.find('.errormt').text(errorMsg);
									$parent.find('.errormt').addClass('onError'); 
							  }else{
								 var okMsg = "<img src='images/ok.gif' />";
								 $parent.find('.errormt').html(okMsg);
								 $parent.find('.errormt').removeClass('onError');
							}
						
						// }else{
							// var errorMsg = '姓名只能是中文.';
							//	$parent.find('.errormt').text(errorMsg);
							//	$parent.find('.errormt').addClass('onError'); 
						// }
					   
					}
			 }
			  if( $(this).is('#address') ){
					if( this.value==""){
					    var errorMsg = 'The address cannot be empty.';
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
						  var errorMsg = 'Please write correct email address.';
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
					    var errorMsg = 'The password should be 6 digits minimum';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else if (this.value.length < 6){
						var errorMsg = 'The password cannot be less than 6 digits';
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
					    var errorMsg = 'Confirmed password cannot be empty.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError')
					}else if ($('#pw').val()!=this.value){
					
					     var errorMsg = 'The passwords typed 2 times are not the same';
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
					
					var errorMsg = 'Please select your address';
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
					
					var errorMsg = 'Please choose your address';
					$("#tipSelect span").html(errorMsg);
					$("#tipSelect span").addClass('onError');
					
		 }
		if ($("#spot").val()==''){
					
					var errorMsg = 'Please choose landmark';
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
			alert('Please agree with the rectangle');
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
								$("#circle_r").html("<option value=''>No trade district</option>")
							}else
								$("#circle_r").html("<option value=''>Please select</option>"+data);
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
								$("#spot_r").html("<option value=''>No landmark</option>")
							}else
								$("#spot_r").html(data);
						
					});
	   })
	})

	