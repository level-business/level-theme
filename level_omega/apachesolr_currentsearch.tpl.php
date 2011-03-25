<?php
 // Show the filter for the current search page.
?>

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
elseif ($transaction_search):
  ?>
  <div class="results_string"><em><?php print number_format($total_found) ?></em> <?php print $transaction_search ?></div>
  <?php
else:
  ?>
  <div class="results_string"><em><?php print number_format($total_found) ?></em> Companies found</div>
  <?php
endif;
?>