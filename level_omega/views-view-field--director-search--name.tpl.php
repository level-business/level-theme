<?php
// Is this you? on director search result page
?>

<?php 
  global $user; 

  $user = user_load($user->uid);
  $profile_id = $user->profile_director_profile_id;

  $name = $row->{$view->field['name']->field_alias};
  $person_number = $row->{$view->field['person_number']->field_alias};
  
  $class = ($profile_id == $person_number) ? 'claimed' : 'unclaimed';
  $text = ($profile_id == $person_number) ? 'This is me' : 'Is this you?';
?>


  <span class="profile_name"><a href="doc/person/uk/<?php print $person_number; ?>"><?php print $name ?></a></span>
  
  <?php if ($user->uid && $profile_id == $person_number): ?>
    <a href="/claim-director/confirm/<?php print $person_number; ?>" class="claim_profile claimed"><?php print $text; ?></a>
  <?php endif; ?>
  
  
  <?php if(!property_exists($user, 'profile_director_profile_id') || empty($user->profile_director_profile_id)): ?>
  
    <?php if ($user->uid && $profile_id !== $person_number): ?>
      <a href="doc/person/uk/<?php print $person_number; ?>" class="claim_profile unclaimed"><?php print $text; ?></a>
  
    <?php elseif (!$user->uid): ?>
      <a class="claim_profile unclaimed anonymous_unclaimed"><?php print $text; ?></a>
    
    <?php endif; ?>
  <?php endif; ?>