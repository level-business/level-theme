<?php
 // Show the filter for the current search page.
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

<div class="results_string"><em><?php print number_format($total_found) ?></em> Results for <span class="search_term"><?php print $current_search ?></span></div>
