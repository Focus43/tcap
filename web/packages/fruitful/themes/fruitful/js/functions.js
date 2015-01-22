
$(document).ready(function(){
		
	$("#mainNav").clone().prependTo($("body")).attr("id","mobileNav").addClass("visible-xs-block visible-sm-block").removeClass("hidden-xs hidden-sm");
	
	$("#icoMobileNav").click(function(){
		$(".ccm-page, #mobileNav").toggleClass("slideOver");	
	});	
    $(".btnSearchIcon").click(function(){
        $(".ccm-page").toggleClass("slideDown");    
    });
			 
	
	//login page forgot password
	$("#btnForgotPassword").click(function(){
		$("#forgot_password").fadeIn();
	});
	
	
	
});//doc.ready