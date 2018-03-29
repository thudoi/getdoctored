<div<?php print $attributes;?>>
<div class="layerslider-banner" style="opacity:0; max-height:<?php print $settings->startheight;?>px; height:<?php print $settings->startheight;?>px;">
<ul>
<?php print $content;?>
</ul>
<?php if($settings->timer):?>
<div class="tp-bannertimer tp-<?php print $settings->timer;?>"></div>
<?php endif;?>
</div>
</div>
<?php
$slidesetting = new stdClass();
$slidesetting->delay = $settings->delay;
$slidesetting->startheight = $settings->startheight;
$slidesetting->startwidth = $settings->startwidth;
$slidesetting->hideThumbs = $settings->hideThumbs;
$slidesetting->thumbWidth = $settings->thumbWidth;
$slidesetting->thumbHeight = $settings->thumbHeight;
$slidesetting->thumbAmount = $settings->thumbAmount;
$slidesetting->navigationType = $settings->navigationType;
$slidesetting->navigationArrows = $settings->navigationArrows;
$slidesetting->navigationStyle = $settings->navigationStyle;
$slidesetting->navigationHAlign = $settings->navigationHAlign;
$slidesetting->navigationVAlign = $settings->navigationVAlign;
$slidesetting->navigationHOffset = 0;
$slidesetting->navigationVOffset = 0;
$slidesetting->soloArrowLeftHalign = "left";
$slidesetting->soloArrowLeftValign = "center";
$slidesetting->soloArrowLeftHOffset = 0;
$slidesetting->soloArrowLeftVOffset = 0;
$slidesetting->soloArrowRightHalign = "right";
$slidesetting->soloArrowRightValign = "center";
$slidesetting->soloArrowRightHOffset = 0;
$slidesetting->soloArrowRightVOffset = 0;
$slidesetting->touchenabled = "on";
$slidesetting->onHoverStop = $settings->onHoverStop;
$slidesetting->stopAtSlide = -1;
$slidesetting->stopAfterLoops = -1;
$slidesetting->hideCaptionAtLimit = 0;
$slidesetting->hideAllCaptionAtLilmit = 0;
$slidesetting->hideSliderAtLimit = 0;
$slidesetting->shadow = $settings->shadow;
$slidesetting->fullWidth = $settings->fullWidth;
$slidesetting->fullScreen = $settings->fullScreen;
$slidesetting->fullScreenOffsetContainer = $settings->fullScreenOffsetContainer;
$slidesetting->lazyLoad = 'on';
$slidesetting->soloArrowLeftHOffset =0;
$slidesetting->soloArrowRightHOffset =0;
$slidesetting->timer =$settings->timer;
$slidesetting->shuffle = 'off';
$slidesetting->dottedOverlay = $settings->dottedOverlay;
$slidesetting->parallaxLevels = array(10,20,30,40,50,60,70,80,90,100);
if(!$settings->timer){
    $slidesetting->hideTimerBar = 'on';
}
if(isset($settings->parallax)){
    $slidesetting->parallax = $settings->parallax;
}
if(isset($settings->parallaxBgFreeze)){
    $slidesetting->parallaxBgFreeze = $settings->parallaxBgFreeze;
}
$slidesetting = json_encode($slidesetting);
$js = "jQuery(document).ready(function($){if($.fn.cssOriginal!=undefined)$.fn.css = $.fn.cssOriginal;$('#{$id} .layerslider-banner').css({opacity:1}).revolution({$slidesetting});})";
drupal_add_js($js,'inline');
