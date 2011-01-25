<?php
// Render fields with known formatting first.
$date        = level_views_render_field($fields['timestamp_1']);
$feed        = level_views_render_field($fields['title_1']);
$author      = level_views_render_field($fields['author']);
$description = level_views_render_field($fields['description']);
$labels      = level_views_render_field($fields['data_taxonomy_form']);
$links       = level_views_render_field($fields['simpleshare_link']) . level_views_render_field($fields['mark_trash']);

// All other fields.
$other       = level_views_render_field($fields);
?>
<div class='feeditem feeditem-twitter clear-block'>

  <div class='feeditem-meta clear-block'><?php print $date ?><?php print $feed ?></div>
  <div class='feeditem-content prose clear-block'><?php print $author ?> <?php print $description ?></div>

  <?php if ($labels): ?>
    <div class='feeditem-labels clear-block'><?php print $labels ?></div>
  <?php endif; ?>

  <div class='feeditem-links clear-block'><?php print $links ?></div>

</div>
