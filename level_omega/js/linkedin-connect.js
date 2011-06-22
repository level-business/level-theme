$(document).ready(function() {

  // STANDARD_LOGIN_CONNECT_ACCOUNTS
  // Create dialog box
  $('#main_content_container').prepend('<div id="linkedinDialog"></div>');
  $('#linkedinDialog').hide();
  $('#linkedinDialog').html('<div class="linkedin-button"><h2>Connect with LinkedIn</h2><a href="/linkedin/login/0">Link your account</a></div><div id="refuse"><a href="#">No Thanks</a></div>');
  
  // Target linkedin edit link
  $('.section-user ul.tabs a[href*="/edit/linkedin"]').click(function() {
    $('#linkedinDialog').slideDown();
    return false;
  });
  
  // Close dialog box when click "No Thanks" button
  $('#refuse a').click(function() {
    $('#linkedinDialog').slideUp();
    return false;
  });

});