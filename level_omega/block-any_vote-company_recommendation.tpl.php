<?php 
// Replace NULL with 0 to print out the result
?>
<?php $yes = ($block->votes['yes'] === NULL) ? 0 : $block->votes['yes']; ?>
<?php $no = ($block->votes['no'] === NULL) ? 0 : $block->votes['no']; ?>

<?php 
// Title : Recommendation
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module; print ' '; print $block->extra_classes?>">

<?php if ($block->subject): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif; ?>

  <div class="question"><?php print $block->question ?></div> 

  <div class="score">
    <?php if ($block->extra_classes == 'block_has_no_votes'): ?>
      <div class="content"><?php print $block->content ?></div>
    <?php endif; ?>
    
    <?php if ($block->extra_classes !== 'block_has_no_votes'): ?>
    <img src="http://chart.apis.google.com/chart?cht=bvg&amp;chs=150x75&amp;chbh=56,35,0&amp;chds=a&amp;chf=bg,s,F7F7F700&amp;chxs=0,F7F7F7,0,0,_,F7F7F700&amp;chxt=y&amp;chco=58c327,ee3322&amp;chd=t:<?php print $yes; ?>|<?php print $no; ?>" />
    <?php endif; ?>
  </div>
  


  <div class="widget clearfix">
  
    <ul class="result-number">
      <li class="first"><?php print $yes; ?></li>
      <li class="last"><?php print $no; ?></li>
    </ul>

    <?php print $block->widget ?>
  </div>
  
  
</div>