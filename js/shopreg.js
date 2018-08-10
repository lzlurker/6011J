$(document).ready(function(){
	   $(".input").blur(function(){
			 var $parent = $(this).parent();
			
			  if( $(this).is('#account') ){
					if( this.value==""){
					    var errorMsg = 'Username cannot be empty.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }

			  if( $(this).is('#account1') ){
					if( this.value==""){
					    var errorMsg = 'Account cannot be empty.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }
			
			 if( $(this).is('#phone') ){
					if( this.value=="" || this.value.length < 11 ||  this.value.length > 11){
					    var errorMsg = 'please enter a valid phone number.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }
			  if( $(this).is('#email') ){
				 if (this.value!=''){
					if( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) ){
						  var errorMsg = "Please enter the correct E-mail address.";
						  $parent.find('.red').text(errorMsg);
						  $parent.find('.red').addClass('onError')
					}else{
						  var okMsg = "Entered correctly";
						 $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
				 }
			 }
			  if( $(this).is('#pw') ){
					if( this.value==""){
					    var errorMsg = 'password cannot be blank.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else if (this.value.length < 6){
						var errorMsg = 'Password cannot be less than 6 digits.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }
			
			  if( $(this).is('#pw1') ){
					if( this.value==""){
					    var errorMsg = 'password cannot be blank.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else if (this.value.length < 6){
						var errorMsg = 'Password 6 or more.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }

			 if( $(this).is('#repw') ){
					if( this.value==""){
					    var errorMsg = 'confirm password cannot be blank.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else if ($('#pw').val()!=this.value){
					
					     var errorMsg = 'The password entered twice is different.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
						
					}else{
						var okMsg = 'Entered correctly.';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }

			 if( $(this).is('#imgcode') ){
					if( this.value==""){
					    var errorMsg = 'please enter verification code.';
                        $parent.find('.red').text(errorMsg);
						$parent.find('.red').addClass('onError')
					}else{
					    var okMsg = '';
					     $parent.find('.red').text(okMsg);
						 $parent.find('.red').removeClass('onError')
					}
			 }
		}).keyup(function(){
		   $(this).triggerHandler("blur");
		}).focus(function(){
	  	   $(this).triggerHandler("blur");
		});//end blur

		
	});

	function checkReg(){
		$(".input").trigger('blur');
		var numError = $('.onError').length;
		if(numError){
			return false;
		} 
	}

	