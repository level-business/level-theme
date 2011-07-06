<?php
// Is this you? on director search result page
?>

<?php 
  global $user; 
  
  $profile_id = $user->profile_director_profile_id;
  $name = $row->{$view->field['name']->field_alias};
  $person_number = $row->{$view->field['person_number']->field_alias};
  
  $class = ($profile_id == $person_number) ? 'claimed' : 'unclaimed';
  $text = ($profile_id == $person_number) ? 'This is me' : 'Is this you?';
?>


  <span class="profile_name"><a href="doc/person/uk/<?php print $person_number; ?>"><?php print $name ?></a></span>   
  <a class="claim_profile <?php print $class; ?>"><?php print $text; ?></a>

