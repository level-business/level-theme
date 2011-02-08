<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif;?>

<select onchange="window.location.href = this.value">
<option value="">--Select</option>
<?php foreach ($rows as $id => $row): ?>
  <?php print $row; ?>
<?php endforeach; ?>
</select>
