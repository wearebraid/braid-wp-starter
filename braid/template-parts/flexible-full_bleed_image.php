<?php
// ----
// Layout: Full Bleed Images
$img = get_sub_field('image');
?>

<?php if(!empty($img)) : ?>
<img class="lazy" src="<?=$img['sizes']['full-bleed'];?>" alt="<?php echo $img['alt']; ?>" />
<?php endif; ?>