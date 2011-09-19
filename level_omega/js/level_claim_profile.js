$(document).ready(function() {
  
  // Claim profile dialog for not-loged-in users
  $('.not-logged-in .block-level_claim_profile a').click(function() {
    
    // Set full link destinaion paths
    var linkedInPath =  '/linkedin/login/0?destination=http://' + window.location.host + $(this).attr('href');
    
    var loginPath =  '/user/login?destination=http://' + window.location.host + $(this).attr('href');
    
    var registerPath =  '/register?destination=http://' + window.location.host + $(this).attr('href');
    
    var claimIntro = '<p class="intro-text">In order to claim this profile you must register with us. We verify your identity by linking your LevelBusiness account with your LinkedIn account.</p>';
    
    var claimSteps = '<ol class="claim-steps clearfix"><li class="first"><span class="number">1</span><h3>Login</h3><p>Login or Register</p></li><li class="second"><span class="number">2</span><h3>Link</h3><p>Authenticate by linking to a linkedin account</p></li><li class="third"><span class="number">3</span><h3>Claim</h3><p>Claim your profile</p></li><li class="forth"><span class="number">4</span><h3>Share</h3><p>Tell the word you\'ve claimed your profile</p></li></ol>';
    
    var linkedinButton = '<ul class="dialog-links"><li class="linkedin-login"><a href="'+ linkedInPath +'">Login with LinkedIn</a></li></ul>';
    
    var registerButton = '<p class="register-intro">Don\'t have an account with LevelBusiness yet?</p><ul class="dialog-links"><li class="register"><a href="'+ registerPath +'">Register</a></li></ul>';


    var $dialog = $('<div class="claimDialog"></div>')
    
    // Create Level text & links
    .html(claimIntro + claimSteps + '<div class="dialog-links-wrapper">'+ linkedinButton + registerButton + '</div>')

    // Create a dialog box 
    .dialog({
      modal: true,
      autoOpen: false,
      width: 714,
      height: 'auto',
      title: 'Is this you?',
    });
    // open the dialog box
    $dialog.dialog('open');
    // prevent default action,
    return false;
  });
  
  
  // Confirm dialog for loged-in user
  
  // Firstly, check if the trigger link exists
  if ($('.logged-in .block-level_claim_profile a[href^=/claim-director/confirm/]').length > 0) {

    // create wrapper
    $('<div id="dialogHolder"><div id="claimContent"></div></div>').appendTo('body');

    // load the right form by id from claim link href before insert into dialog
    var claimContent = $('#claimContent').load($('.logged-in #block-level_claim_profile-account-progress-block a').attr('href') + ' form.confirmation');

    // confirmation dialog display
    $('.logged-in .block-level_claim_profile a[href^=/claim-director/confirm/]').click(function() {

      var $dialog = $('<div class="confirmDialog"></div>')

      .html(claimContent)

      .dialog({
        modal: true,
        autoOpen: false,
        width: 714,
        height: 'auto',
        title: 'Please confirm...',
      });
      // open the dialog box
      $dialog.dialog('open');
      // prevent default action,
      return false;
    });
  }

  // Tooltip
  // For anonymous users
  var tooltipContent = 'Manage how others see your information. <a href="/user/login">Login</a> or <a href="/register">register</a> in order to claim your Director Profile.';

  $('a.anonymous_unclaimed').removeAttr('href');
  $(function(){
   // only show tooltip for anonymous users
   $('a.anonymous_unclaimed').tipTip({
     defaultPosition: 'top',
     content: tooltipContent,
     keepAlive: true,
   });
  });

  // Withheld fields
  $(function(){
	/**
	 * Fields that a director has chosen to withhold:
	 */
    $('.profile .profile-catagory .field_hidden p span, \
       .profile .identification .field_hidden .content span, \
       .director_appointment .field_hidden p span')
    .tipTip({
      defaultPosition: 'top',
      content: 'This director has chosen to withhold this information from unregistered users. Please <a href="/user/login">login</a> or <a href="/register">register</a> in order to see this information, or to claim your own profile.',
    });

    /*
     * Fields that are hidden by default, unless the director chooses to show them:
     */
    $('.profile .profile-catagory .field_hidden.field_opt_in p span, \
       .profile .identification .field_hidden.field_opt_in .content span, \
       .director_appointment .field_hidden.field_opt_in p span')
    .tipTip({
      defaultPosition: 'top',
      content: 'This field is only available to registered users. Please <a href="/user/login">login</a> or <a href="/register">register</a> in order to see this information, or to claim your own profile.',
    });
  });

 if($('.block_help_text').length) {  
 $('a.hide_promo')
 
		 .click(
		  function() {
			  /*alert('foo');*/
			  var cookie_name = '__' + $('.block_help_text').attr('class').match(/block_content_[0-9a-f]*/);
			  document.cookie = cookie_name + '=1; expires=2 Aug 2030 01:01:11 UTC; path=/';
			  $('.block_help_text').slideUp('slow');
			  /* set the cookie and hide the element */
		  }		 
  );
 	 var block_hash = $('.block_help_text').attr('class').match(/block_content_[0-9a-f]*/);
     var search=new RegExp(block_hash);
 	 if(!search.test(document.cookie)) {
	   $('.block_help_text').slideDown('slow');	 
	 }
  }

});
