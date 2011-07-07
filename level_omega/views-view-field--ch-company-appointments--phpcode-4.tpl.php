<?php
// Is this you? on company page
?>

<?php 
  global $user; 

  $profile_id = $user->profile_director_profile_id;
  $person_number = substr($row->{$view->field['person_number']->field_alias},0,-4);
  
  $class = ($profile_id == $person_number) ? 'claimed' : 'unclaimed';
  $text = ($profile_id == $person_number) ? 'This is me' : 'Is this you?';

?>

<div class="profile_name"><?php print $output; ?></div>


<?php if (!$user->uid): // not-logged-in ?>
  <a class="claim_profile unclaimed anonymous_unclaimed" href="/login-opts"><?php print $text; ?></a>
<?php endif; ?>

<?php if ($user->uid): // logged-in ?>

  <?php if ($profile_id !== $person_number): // logged-in but un_claimed ?>
    <a class="claim_profile member_unclaimed" href="/doc/person/uk/<?php print $person_number; ?>" class="claim_profile unclaimed"><?php print $text; ?></a>
  <?php endif; ?>

  <?php if ($profile_id == $person_number): // logged-in & already claimed ?>
    <a class="claim_profile claimed"><?php print $text; ?></a>
  <?php endif; ?>

<?php endif; ?>





