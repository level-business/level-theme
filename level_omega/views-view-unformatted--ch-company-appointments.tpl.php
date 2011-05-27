<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

?>
<div rev="v:affiliation">
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row):
 // var_dump($view->result[$id]->['ch_appt_person_person_number']);
  $path = '/id/person/uk/' . substr($view->result[$id]->ch_appt_person_person_number,0,8); 

  ?>
  <div class="<?php print $classes[$id]; ?>" typeof="v:Person" about="<?php print $path ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>