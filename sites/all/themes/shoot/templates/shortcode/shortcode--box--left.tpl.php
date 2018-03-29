<div class="<?php print $classes;?>">
  <?php if ($icon): ?>
    <div class="box-icon"><span><i class="<?php print $icon; ?>"></i><br/><i class="<?php print $icon; ?>"></i></span></div>
  <?php endif; ?>
  <?php if ($title): ?>
    <?php if($link !=''):?>
      <a href="<?php print $link;?>"><h4 class="box-title"><?php print $title; ?></h4></a>
    <?php else:?>
      <h4 class="box-title"><?php print $title; ?></h4>
    <?php endif;?>
  <?php endif; ?>
  <?php if ($content): ?>
    <div class="box-content"><?php print $content; ?></div>
  <?php endif; ?>
</div>