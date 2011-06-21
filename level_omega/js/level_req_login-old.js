Drupal.behaviors.level_platform = function (context) {

$('#sf_save_profile').superfish({ animation: {opacity:'show',height:'show'},
autoArrows: false } );


$('a.req_login').click(function(eventObj) {
var $dialog = $('<div></div>')
.html('To save a company you need to register or login')
// Create a dialog box
.dialog({
modal: true,
autoOpen: false,
title: 'One moment...',
buttons: {
Register: function() {
$(this).dialog('close');
var path = '/register?destination=' + $(this).dialog().data('link');
$(location).attr('href', path);
},
Login: function() {
$(this).dialog('close');
var path = '/user/login?destination=' + $(this).dialog().data('link');
$(location).attr('href', path);
},
"Login using LinkedIn": function() {
$(this).dialog('close');
var path = '/linkedin/login/0?destination=' + $(this).dialog().data('link');
$(location).attr('href', path);
}
}
}).data('link',eventObj.target.href.replace('http://' + window.location.hostname + '/',''));
// open the dialog box
$dialog.dialog('open');
// prevent the default action,
return false;
});
}