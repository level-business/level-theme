<div class='utility clear-block'>

<?php
$edit = level_views_render_field($fields['edit_node']);
$delete = level_views_render_field($fields['delete_node']);
if ($edit || $delete):
?>
<div class='utility-links clear-block'><?php print $edit ?><?php print $delete ?></div>
<?php endif; ?>

<?php print level_views_render_field($fields['title']) ?>

</div>