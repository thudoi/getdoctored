<div class="skills_boxes">
    <span id="<?php print $element_id;?>" class="chart" data-percent="<?php print $percent; ?>"><span class="percent"></span></span>
    <div class="title"><h3><?php print $title; ?></h3></div>
    <p><?php print $content; ?></p>
</div><!-- end skills_boxes -->
<?php
global $base_url;
$theme_path = drupal_get_path('theme', 'shoot');
?>
<script src="<?php print $base_url . '/' . $theme_path . '/templates/shortcode/js/jquery.easypiechart.min.js'; ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $this = $("#<?php print $element_id;?>");
//                $tracker = $this.find('.dexp-color-track'),
//                $trackcolor = $tracker.css('trackcolor'),
//                $barcolor = $tracker.css('barcolor');                
        $this.easyPieChart({
            easing: 'easeOutBounce',
            size: <?php print $width; ?>,
            animate: 2000,
            lineWidth: 5,
            lineCap: 'square',
            barColor: '<?php print $barcolor;?>',
            trackColor: '<?php print $trackcolor;?>',
            scaleColor: false,
            onStep: function (a, b, c) {
                $(this.el).find('span.percent').text(Math.round(a) + '%');
            }
        });
    });
</script>