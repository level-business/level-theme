<?php 
// Title : Payment
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; print ' '; print $block->extra_classes?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>

  <div class="question"><?php print $block->question ?></div>

  <div class="score clearfix">
    <img src="https://chart.googleapis.com/chart?cht=pc&chs=115x115&chf=bg,s,f7f7f700&chd=t:-1|<?php print $block->yes_count; ?>,<?php print $block->no_count; ?>&chco=58C327,58C327|ee3322" />
    <div class="widget"><?php print $block->widget ?></div>
    <div class="percentage"><?php print round($block->yes_count * 100 / $block->vote_sum); ?>%</div>
  </div>

  
  <div class="content"><?php print $block->content ?></div>
  
  <div style="font-size:10px;color:red;margin-top:10px;">Debugging: Yes = <?php print $block->yes_count ?> No = <?php print $block->no_count ?> Sum = <?php print $block->vote_sum ?></div>


  
</div>