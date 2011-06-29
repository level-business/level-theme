<?php 
// Title : Recommendation
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; print ' '; print $block->extra_classes?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>

  <div class="question"><?php print $block->question ?></div> 
  
  <div class="score">
    <img src="https://chart.googleapis.com/chart?cht=bvs&chs=140x140&chf=bg,s,f7f7f700&chco=66cc55|ee3322" />
  </div>

  <div class="widget clearfix"><?php print $block->widget ?></div>
  
  <div class="content"><?php print $block->content ?></div>
  
</div>