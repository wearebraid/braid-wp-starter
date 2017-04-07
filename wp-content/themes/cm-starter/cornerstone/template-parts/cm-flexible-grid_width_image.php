<?php
// ----
// Layout: Image: Full Width Img Container
$img = get_sub_field('image');
?>
<?php if(!empty($img)) : ?>
<div class="image-container row">
    <img class="w-100 lazy" src="<?php echo $img['sizes']['container-width']; ?>" alt="<?php echo $img['alt']; ?>" />
</div>
<?php endif; ?>