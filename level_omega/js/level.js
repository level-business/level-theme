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
  
  // Equal height for any_vote widget blocks
  $('#main_content_container .block-any_vote').equalHeight();
  
  // hide privacy legend
  $('#user-profile-form legend:contains(privacy)').hide();
  
  // LinkedIn Carousel
  $(function(){
    $('ul.linkedin_contact_list').jcarousel();
  });
  // To-do add equalHeight() to  ul.linkedin_contact_list li
	
  
  var moreLikeThisContent = '<span class="tooltip">This panel shows companies that share the same SIC codes as the profile you are viewing. The greater the number of SIC codes a company has in common, the higher it will appear in this list.</span>';
  
  $(function(){
	   // only show tooltip for anonymous users
	   $('#block-level_search-more_like_this').tipTip({
	     defaultPosition: 'top',
	     content: moreLikeThisContent,
	     keepAlive: false,
	   });
	  });
	

  /* New #block-level_search-level_search_tabs on #page_tools
   */
   var topSearchBox = '#page_tools #block-level_search-level_search_tabs';
   // Only if there's topSearchBox
   if ($(topSearchBox).length > 0) {

     // Change <label> texts to "Search UK Companies" : "Search UK Directors"
     $('#level_search_block_form_companies .views-widget-filter-text_1 label').text('Search UK Companies');
     $('#level_search_block_form_directors .views-widget-filter-text label').text('Search UK Directors');
     
     // Hide inactive tab & form
     $('.level_search_tabbed_form').not('.level_search_tabbed_form_active').hide();

     $(topSearchBox + ' .item-list ul li').not('.active_tab').hide();
     $(topSearchBox + ' .item-list ul li').not('.active_tab').appendTo(topSearchBox + ' .item-list ul');
     
     // Expand both Companies & Directors tabs when rollover
     $(topSearchBox + ' .item-list ul').hover(
       // mouseover
       function(){
         // show inactive tab
         $(this).children().not('.active_tab').show();
         // when rollover each tabs
         $(this).children().mouseover(function(){
            // add .active_tab class to it then remove that class from its sibling
            $(this).addClass('active_tab');
            $(this).siblings().removeClass('active_tab');
            
            // if Directors tab is active, show its form & hide Companies form
            if ($(this).children().hasClass('search_block_tab_Directors')) {
              $(topSearchBox + ' #level_search_block_form_companies').hide();
              $(topSearchBox + ' #level_search_block_form_directors').show();
            }
            // if Companies tab is active, show its form & hide Directors form
            if ($(this).children().hasClass('search_block_tab_Companies')) {
              $(topSearchBox + ' #level_search_block_form_directors').hide();
              $(topSearchBox + ' #level_search_block_form_companies').show();
            }
         });
       },
       // mouseout
       function(){
         $(this).children().not('.active_tab').appendTo(this).hide();
       }
     );
     
     // hide annoying Directors .compact-form-label in FireFox
     if ($('.level_search_tabbed_form').not('.level_search_tabbed_form_active')) {
       $(topSearchBox + ' #level_search_block_form_directors label.compact-form-label').hide();
     }
     
   }

});
