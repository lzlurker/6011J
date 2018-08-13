$(document).ready(function(){
	    $(".input").blur(function(){
			 var $parent = $(this).parent();
			  if( $(this).is('#name') ){
					if( this.value==""){
					    var errorMsg = 'Cannot be empty.';
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
						 //}
					   
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
	});

	function checkReg(){
		 if ($("#area").val()=='' || $("#circle").val()==''){
					
					var errorMsg = 'Please select the address';
					$("#tipSelect span").html(errorMsg);
					$("#tipSelect span").addClass('onError');
					
		 }
		if ($("#spot").val()==''){
					
					var errorMsg = 'Please select landmard';
					$("#tipSpot span").html(errorMsg);
					$("#tipSpot span").addClass('onError');
					
		 }
		$(".input").trigger('blur');
		var numError = $('.onError').length;
		if(numError){
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
								$("#circle_r").html("<option value=''>No business district</option>")
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

	