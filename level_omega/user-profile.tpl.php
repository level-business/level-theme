<?php

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */
?>
<?php if (!$account->hide_profile): ?>
  <?php profile_load_profile($account); ?>

  <h1 id="profile-title"><?php print ucwords(strtolower($account->name)); ?><?php print check_plain($account->profile_age['#value']); ?></h1>

  <div class="profile clear-block">

    <div class="linkedin_additional clear-block">
      <?php print $account->content['linkedin_additional']['options']['#value']; ?>
    </div>
  
    <?php if (isset($account->content['identification'])): ?>
      <div class="identification clear-block">
        <div class="identification-top clear-block">
          <div <?php print drupal_attributes($account->content['identification']['profile_nationality']['#attributes']); ?>>
            <h4><?php print check_plain($account->content['identification']['profile_nationality']['#title']); ?></h4>
            <div class="content"><span><?php print check_plain($account->content['identification']['profile_nationality']['#value']); ?></span></div>
          </div>
             
          <div <?php print drupal_attributes($account->content['identification']['profile_date_of_birth']['#attributes']); ?>>
            <h4>Date of Birth</h4>
            <div class="content"><span><?php print check_plain($account->content['identification']['profile_date_of_birth']['#value']); ?></span></div>
          </div>

          <div <?php print drupal_attributes($account->content['identification']['profile_age']['#attributes']); ?>>
            <h4><?php print check_plain($account->content['identification']['profile_age']['#title']); ?></h4>
            <div class="content"><span><?php print check_plain($account->content['identification']['profile_age']['#value']); ?> years</span></div>
          </div>
        </div>

        <div <?php print drupal_attributes($account->content['identification']['profile_occupation']['#attributes']); ?>>
          <h4><?php print check_plain($account->content['identification']['profile_occupation']['#title']); ?></h4>
          <div class="content"><span><?php print check_plain($account->content['identification']['profile_occupation']['#value']); ?></span></div>
        </div>
    
        <div <?php print drupal_attributes($account->content['identification']['profile_address']['#attributes']); ?>>
          <h4><?php print check_plain($account->content['identification']['profile_address']['#title']); ?></h4>
          <div class="content"><span><?php print check_plain($account->content['identification']['profile_address']['#value']); ?></span></div>
        </div>
      </div><!--/ .identification -->
  
      <div class="appointments clear-block">
        <?php print $profile['appointments']; ?>
      </div>
  
    <?php endif ?>
  </div>
<?php endif ?>
