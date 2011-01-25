<?php include 'page.header.inc'; ?>

<div id='left'><div class='navbar clear-block'>
  <?php if (!empty($context_links)): ?>
    <div class='context-links clear-block'><?php print $context_links ?></div>
  <?php endif; ?>
  <?php if (!empty($left)) print $left ?>
</div></div>

<div id='canvas' class='clear-block'>

  <?php include 'page.title.inc'; ?>

  <?php if ($show_messages && $messages): ?>
    <div class='growl'><?php print $messages; ?></div>
  <?php endif; ?>

  <div id='main'>
    <div id='content' class='page-content clear-block'>
      <div id='content-wrapper'><?php print $content ?></div>
      <div id='content-region-wrapper'><?php print $content_region ?></div>
    </div>
    
    <?php if (!empty($identity)): ?>
    	<div id='identity'>
    		<?php print $identity ?>
    	</div>
    <?php endif; ?>
    
    <?php if (!empty($indicators)): ?>
    	<div id='indicators'>
    		<?php print $indicators ?>
    	</div>
    <?php endif; ?>
    
    <?php if (!empty($benchmarks)): ?>
    	<div id='benchmarks'>
    		<?php print $benchmarks ?>
    	</div>
    <?php endif; ?>
  </div>

</div>

<?php include 'page.footer.inc'; ?>