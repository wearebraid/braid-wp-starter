<?php
// ----
// Layout: WYSIWYG

$elem_classes = get_sub_field('constrained_content') ? 'constrained-content' : '';
$elem_classes = get_sub_field('reduce_padding') ? $elem_classes . ' reduce' : $elem_classes;
?>
<?php if (get_sub_field('bg_color')) { echo '<div class="bg-'. get_sub_field('bg_color') . '">'; } ?>
    <div class="row content-section <?=$elem_classes;?>">
        <?php echo apply_filters('the_content', get_sub_field('content', false, false)); ?>
    </div>
<?php if (get_sub_field('bg_color')) { echo '</div>'; } ?>
