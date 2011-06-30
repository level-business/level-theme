<?php 
// Title : Payment
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; print ' '; print $block->extra_classes?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>

  <div class="question"><?php print $block->question ?></div>

  <div class="score clearfix">
    <img src="https://chart.googleapis.com/chart?cht=pc&chs=115x115&chf=bg,s,f7f7f700&chco=58C327,58C327|ee3322&chd=t:-1|<?php print $block->votes['yes']; ?>,<?php print $block->votes['no']; ?>" />
    
    <div class="widget"><?php print $block->widget ?></div>
    
    <div class="percentage">
      <?php if($block->total_votes == '0'): ?><span>--%</span><?php endif; ?>
      
      <?php if($block->total_votes >> '0'): ?>
        <span><?php print round($block->votes['yes'] * 100 / $block->total_votes,1); ?>%</span>
      <?php endif; ?>
    </div>
    
  </div>

  <div class="content"><?php print $block->content ?></div>

</div>