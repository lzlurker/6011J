$(document).ready(function(){
	    $(".input").blur(function(){
			 var $parent = $(this).parent();
			 if( $(this).is('#phone') ){
					if( this.value=="" || this.value.length < 11 ||  this.value.length > 11){
					    var errorMsg = 'Please write correct phone number.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError');
					}else{
					    var name=$("#phone").val();
							var reg=/^1[358]\d{9}$/;
						 if(name.match(reg)){
							var okMsg = "<img src='images/ok.gif' />";
							 $parent.find('.errormt').html(okMsg);
							 $parent.find('.errormt').removeClass('onError');
						 }else{
							  var errorMsg = 'Format is not correct.';
								$parent.find('.errormt').text(errorMsg);
								$parent.find('.errormt').addClass('onError')
						}
						
					}
			 }
			 
			  if( $(this).is('#phone1') ){
					$('#sendCode').html("<label>&nbsp;</label> <a href=\"javascript:void();\" onClick=\"sendcode()\"><img src=\"images/button/getcode.gif\" alt=\"\" style='cursor:pointer;'/></a>");
					if( this.value==""){
					    var errorMsg = 'Phone number cannot be empty.';
                        $parent.find('.errormt').text(errorMsg);
						$parent.find('.errormt').addClass('onError');
						$('#sendCode').html("<label>&nbsp;</label> <img src=\"images/button/getcode.gif\" alt=\"\" style='cursor:pointer;'/>");
						return false;
					}else{
					   var name=$("#phone1").val();
						var reg=/^1[358]\d{9}$/;
						 if(name.match(reg)){
							 $.get("userpw_do.php", { 
							'act'   :  "check",
							'phone' :  $('#phone1').val()
							}, function (data, textStatus){
									if (data=="S")
									{
										var okMsg = "<img src='images/ok.gif' />";
										 $parent.find('.errormt').html(okMsg);
										 $parent.find('.errormt').removeClass('onError');
										return true;
									}else{
										 var errorMsg = 'This phone number does not exist';
										$('#phoneTip').text(errorMsg);
										$('#phoneTip').addClass('onError');
										return false;
									}
							});
						 }else{
							  var errorMsg = 'The format of phone number is not correct.';
								$parent.find('.errormt').text(errorMsg);
								$parent.find('.errormt').addClass('onError');
								$('#sendCode').html("<label>&nbsp;</label> <img src=\"images/button/getcode.gif\" alt=\"\" style='cursor:pointer;'/>");
								return false;
						}
						
					}
			 }
			 
		});//end blur
		
	});
	 function check(){
			$(".input").trigger('blur');	
			var numError = $('.onError').length;
			if(numError){
				return false;
			} 
	 }

	  function checkPWD(){
			if ($('#pw').val()==''){
				alert('New password cannot be blank');
				$('#pw').focus();
				return false;
			}
			if ($('#repw').val()==''){
				alert('Confirmation password cannot be blank');
				$('#repw').focus();
				return false;
			}
			if ($('#pw').val()!=$('#repw').val())
			{
				alert('The passwords typed 2 times are not same');
				return false;
			}
	  }

	 function sendcode(){
		 $(".input").trigger('blur');
		var numError = $('.onError').length;
		if(numError){
			return false;
		}else{
			$("#codeTip").css('display','block');
			 $.get("userpw_do.php", { 
							'act'   :  "send",
							'phone' :  $('#phone1').val()
							}, function (data, textStatus){
									if (data=="S"){
									//成功
									}	
									
			 });
		 }
	 }


	