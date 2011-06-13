$(document).ready(function() {

  // add termDefinition class to definition wrapper
  $('.node .terminology').children().addClass('termDefinition clearfix').wrapInner('<div class="inner-wrapper" />');
  
  // hide all term definition
  $('.node .terminology .termDefinition').hide();

  // replace <dl> with <div>
  $('dl.terminology').each(function(i){
    $(this).replaceWith('<div class="terminology clearfix">' + $(this).html() + '</div>')
    
  });
  
  // replace <dt> with <h3>
  $('.termDefinition dt').each(function(){
    $(this).replaceWith('<h3 class="term">' + $(this).text() + '</h3>');
  });

  // replace <dd> with <div>
  $('.termDefinition dd').each(function(){
    $(this).replaceWith('<div class="definition">' + $(this).html() + '</div>');
  });
  
  $('.inner-wrapper').before('<div class="close-button clearfix"><a href="#">Hide</a></div>');


  // Glossary toggle
  $('.term-list a:not(.active)').click(function() {
    
    // match each trigger (term link) with its own definition
    trigger = $(this).attr('href').replace(/#/g, '');
    defClass = '.terminology .' + trigger;
    currentDefinition = defClass + ':not(.current-term)';
    
    // this term definition is already open
    if ($(this).hasClass('active') ) {
      $('.term-list a.active').removeClass('active');
      $('.termDefinition').slideUp();
    }
    
    // this term definition is not already open
    else {
        // another term definition is open, close it first
        if ($('.term-list a.active').length > 0) {
          $('.term-list a.active').removeClass('active');
          $('.terminology .current-term').removeClass('current-term').slideUp();
        }

        // add .active class to current trigger
        $(this).addClass('active');

        // slide down new term definition
        $(defClass).addClass('current-term').slideDown();
    }
    return false;
  });
  
  // "Hide button"
  $('.close-button a').bind('click', function() {
    $('.term-list a.active').removeClass('active');
    $('.termDefinition').slideUp();
    return false;
  });
  
});