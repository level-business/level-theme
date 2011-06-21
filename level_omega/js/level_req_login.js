Drupal.behaviors.level_platform = function (context) {
	
	$('#sf_save_profile').superfish({ animation:   {opacity:'show',height:'show'}, 
		                              autoArrows:  false }       );

	
	$('a.req_login').click(function() {
	  
	  // Set full link destinaion paths
	  var linkedInPath =  '/linkedin/login/0?destination=http://' + window.location.hostname + $(this).attr('href');
	  
	  var loginPath =  '/user/login?destination=http://' + window.location.hostname + $(this).attr('href');
	  
	  var registerPath =  '/register?destination=http://' + window.location.hostname + $(this).attr('href');


		var $dialog = $('<div></div>')
		
		// Create Level text & links
		.html('<p class="intro-text">To save a company profile you need to register or login</p><div class="dialog-links-wrapper"><ul class="dialog-links"><li class="linkedin-login"><a href="'+ linkedInPath +'">Login with LinkedIn</a></li><li class="standard-login"><a href="'+ loginPath +'">Login</a></li></ul><p class="register-intro">Do not have an account with LevelBusiness yet?</p><ul class="dialog-links"><li class="register"><a href="'+ registerPath +'">Register</a></li></ul></div>')


		// Create a dialog box 
		.dialog({
			modal: true,
			autoOpen: false,
			width: 550,
			height: 'auto',
			title: 'One moment...',
		});
  
		// open the dialog box
		$dialog.dialog('open');
		// prevent the default action,
		return false;
	});
}