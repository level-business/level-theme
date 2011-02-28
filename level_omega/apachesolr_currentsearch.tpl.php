<?php
 // Show the filter for the current search page.
?>
<?php
  //Temp. disable the facets in the header
  $links = array();

 if (sizeof($links) > 0):
  ?>
<div class="results_filter">
 <h3>Filtered by</h3>
  <ul>
    <?php foreach ($links as $filter_link):?>
      <li>
        <?php print $filter_link; ?>
      </li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif; ?>

<?php 
/*
 * Options for the results string
 * If there is a search term we use Results for XXX
 * If there is a title we use that as part of the text
 * If there is no title and no results, say XXX companies
 * 
 */
?>

<?php 
if ($current_search):
?>
  <div class="results_string"><em><?php print number_format($total_found) ?></em> Results for <span class="search_term"><?php print $current_search ?></span></div>
<?php 
else:
  ?>
  <div class="results_string"><em><?php print number_format($total_found) ?></em> Companies found</div>
  <?php
endif;
?>