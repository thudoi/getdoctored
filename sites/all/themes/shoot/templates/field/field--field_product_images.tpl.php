<?php if(count($items) <= 1):?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
    <?php endif; ?>
    <div class="field-items"<?php print $content_attributes; ?>>
        <?php foreach ($items as $delta => $item): ?>
        <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
            <?php print render($item); ?>
        </div>
        <?php endforeach; ?>
    </div>
</div> 
<?php else: ?>

<ul class="bxslider">
    <?php foreach ($items as $delta => $item):
      $uri = $item['#item']['uri'];
      $path = file_create_url($uri); ?>
      <li><img class="thumbnail" src='<?php print $path;?>'/></li>
    <?php endforeach;?>
</ul>

<div id="bx-pager">
    <?php $i = 0; foreach ($items as $delta => $item):
      $uri = $item['#item']['uri'];
      $path = file_create_url($uri); ?>
      <a data-slide-index="<?php print $i;?>" href=""><img class="thumbnail" src="<?php print $path;?>" /></a>
    <?php $i = $i + 1; endforeach;?>
</div>
<?php $library = libraries_get_libraries();
  if (isset($library['bxslider'])) {
    $path = $library['bxslider'];
    drupal_add_css($path . '/jquery.bxslider.css');
    drupal_add_js($path . '/jquery.bxslider.min.js');
  }
?>
<script>
(function($) {
  Drupal.behaviors.shoot_slider = {
    attach: function (context, settings) {
      $('.bxslider').bxSlider({
        infiniteLoop:false, // Add this to avoid pager thumbnail work not correct when ajax loading...
        maxSlides: 1, 
        controls:false,
        pagerCustom: '#bx-pager'
      });
  }
 };
})(jQuery);
</script>
<?php endif;?>