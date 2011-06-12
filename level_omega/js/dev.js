$(document).ready(function() {

  // add termDefinition class to definition wrapper
  $('.node .terminology').children().addClass('termDefinition clearfix').prepend('<div class="close-button"><a href="#">Hide</a></div>');
  
  // hide all term definition
  $('.node .terminology .termDefinition').hide();

  // replace <dl> with <div>
  $('dl.terminology').each(function(i){
    $(this).replaceWith('<div class="terminology clearfix">' + $(this).html() + '</div>')
    
  });
  $('.terminology').wrapInner('<div class="inner-wrapper" />');
  
  // replace <dt> with <h3>
  $('.termDefinition dt').each(function(){
    $(this).replaceWith('<h3 class="term">' + $(this).text() + '</h3>');
  });
  
  // replace <dd> with <div>
  $('.termDefinition dd').each(function(){
    $(this).replaceWith('<div class="definition">' + $(this).html() + '</div>');
  });
  

  

  // Glossary toggle
  $('.term-list a:not(.active)').click(function() {
    
    // match each trigger (term link) with its own difinition
    trigger = $(this).attr('href').replace(/#/g, '');
    defClass = '.terminology .' + trigger;
    currentDefinition = defClass + ':not(.current-term)';
    
    
    
    // if trigger allready has .active class then remove it
    if ($('.term-list a.active').length > 0) {
      $('.term-list a.active').removeClass('active');
    }
    
    // add .active class to current trigger 
    $(this).addClass('active');

    $('.terminology .current-term').removeClass('current-term').slideUp();

    // slide down new term definition
    $(defClass).addClass('current-term').slideDown();

    return false;
  });
    

  
  // "Hide button"
  $('.close-button a').bind('click', function() {
    $('.termDefinition').slideUp();
    return false;
  });


  
});