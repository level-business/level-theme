<?php
/**
 * Director appointment template, theming of the director information
 **/
?>

<div <?php print drupal_attributes($fields['#attributes']); ?>>
  <?php //print $fields['#children']; ?>
   
  <div class="director-name">
    <?php print theme('appointment_field', $fields['name']); ?>
    <?php print theme('appointment_field', $fields['person_dob']); ?>

    <?php
     // If we're listing directors of a company, add logic for "Is this you" links.
     if ($fields['#listing_type'] == LEVEL_PLATFORM_COMPANY) {
       global $user;
       if (isset($user->profile_director_profile_id)) $profile_id = $user->profile_director_profile_id;
       $person_number =($fields['person_number']['#value']);
       $class = ($profile_id == $person_number) ? 'claimed' : 'unclaimed';
       $text = ($profile_id == $person_number) ? 'This is me' : 'Is this you?';
     }
    ?>

    <?php if ($fields['#listing_type'] == LEVEL_PLATFORM_COMPANY): // on a company page ?>

      <?php if ($profile_id == $person_number): // logged-in & already claimed ?>
        <a class="claim_profile claimed"><?php print $text; ?></a>
      <?php endif; ?>

      <?php if(!property_exists($user, 'profile_director_profile_id') || empty($user->profile_director_profile_id)): ?>
        <?php if (!$user->uid): // not-logged-in ?>
          <a class="claim_profile unclaimed anonymous_unclaimed" href="/login-opts"><?php print $text; ?></a>
        <?php else: // logged-in but un_claimed ?>
          <a class="claim_profile member_unclaimed" href="/doc/person/uk/<?php print $person_number; ?>" class="claim_profile unclaimed"><?php print $text; ?></a>
      <?php endif; ?>
      <?php endif; ?>

    <?php endif ?>

  </div><!--/ .director-name -->

   <?php print theme('appointment_field', $fields['address']); ?>
   <?php print theme('appointment_field', $fields['appointment_date']); ?>
   <?php print theme('appointment_field', $fields['appointment_type']); ?>
   <?php print theme('appointment_field', $fields['occupation']); ?>
</div>
