<span class="<?php print $flag_wrapper_classes; ?>">
<?php if ($link_href): ?>
<?php 
    $PREFIX_CONS = "flag-wrapper flag-like flag-like-";
    $length = drupal_strlen($PREFIX_CONS);
    $node_id = drupal_substr($flag_wrapper_classes, $length);
    $count = $flag->get_count($node_id);
    //print $count;
?>
<a href="<?php print $link_href; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php print $count;?> <?php print t('Likes');?>" title="<?php print $link_title; ?>" class="<?php print $flag_classes ?> dtooltip" rel="nofollow">
    <?php print $link_text; ?>
</a>
    <span class="flag-throbber">&nbsp;</span>
<?php else: ?>
<span class="<?php print $flag_classes ?>"><?php print $link_text; ?></span>
<?php endif; ?>
<?php if ($after_flagging): ?>
<span class="flag-message flag-<?php print $status; ?>-message">
<?php print $message_text; ?>
</span>
<?php endif; ?>
</span> 