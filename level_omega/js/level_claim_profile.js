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
  
  // create wrapper
  $('<div id="dialogHolder"><div id="claimContent"></div></div>').appendTo('body');
  
  // load the right form by id from claim link href before insert into dialog
  var claimContent = $('#claimContent').load($('.logged-in .block-level_claim_profile a').attr('href') + ' form.confirmation');

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

  // Tooltip
  // company page
  var tooltipContent = '<span class="tooltip">Manage how others see your information. <a href="/user/login">Login</a> or <a href="/register">Register</a> in order to claim your Director Profile.</span>';

  $('a.anonymous_unclaimed').removeAttr('href');
  $(function(){
   // only show tooltip for anonymous users
   $('a.anonymous_unclaimed').tipTip({
     defaultPosition: 'top',
     content: tooltipContent,
     keepAlive: true,
   });
  });
});


