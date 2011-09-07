// Star Rating
$(document).ready(function() {

  // scope internal var for each any_vote_points_widget
  $('ul.any_vote_points_widget').each(function(){

   // remove other classes to get numeric class names only
   $(this).children().removeClass('first last');

    // count stars with average-active class
    var average_count = $('a.average-active').length;

    // highlight stars on rollover only when current user does has not voted yet
    $('.block-any_vote:not(.user_voted) ul.any_vote_points_widget li').hover(

      // mouseover
      function(){
        $('ul.any_vote_points_widget a.average-active').removeClass('average-active');
        var index = parseInt($(this).attr('class'));
        // highlight stars below this one
        for(i=0; i<=index; i++) {
          $('ul.any_vote_points_widget li').eq(i).addClass('highlight');
        }
      },
      
      // mouseout
      function(){
        // unhighlight all stars
        $('ul.any_vote_points_widget li').removeClass('highlight');

        // restore average-active class
        for(i=0; i<average_count; i++) {
          $('ul.any_vote_points_widget li').eq(i).find('a').addClass('average-active');
        }
      }
    );
  });
  
  var registerToVoteContent = '<span class="tooltip">Voting on a company is only available to registered users. Please <a href="/user/login">login</a> or <a href="/register">register</a>  to vote on this company.</span>';
  // Vote to Register
  $('.vote_registration').tipTip({
    defaultPosition: 'top',
	content:registerToVoteContent,
	keepAlive: true,
  });
	  
});