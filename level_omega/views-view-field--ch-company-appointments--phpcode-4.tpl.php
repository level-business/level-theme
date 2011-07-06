<?php
// Is this you? on company page
?>

<?php 
  global $user; 
  
  $profile_id = $user->profile_director_profile_id;
  $person_number = $row->{$view->field['person_number']->field_alias};
  
  $class = ($profile_id == $person_number) ? 'claimed' : 'unclaimed';
  $text = ($profile_id == $person_number) ? 'This is me' : 'Is this you?';
?>

<div class="profile_name"><?php print $output; ?></div>

<a class="claim_profile <?php print $class; ?>"><?php print $text; ?></a>
