<?php
// ----
// Layout: Hero Banner -- tops of internal pages
$img = get_sub_field('image');
$bgPos = get_sub_field('bg_position') ? get_sub_field('bg_position') : 'center center';
$style = "background-image: url(" . $img['url'] . "); background-position:" . $bgPos . ";";
$bgCol = empty($img) ? 'bg-pri' : '';
$size = the_sub_field('size') ? 'hero--' . the_sub_field('size') : '';
?>

<div class="hero <?=size?> <?=$bgCol;?> ttu white tc cover relative" style="<?=$style; ?>">
    <div class="hero--content absolute center-it ttu white w-90">
        <h2 class="fw7 lh-solid ma0 mb2"><?php the_sub_field('heading'); ?></h2>
        <h3 class="fw3 mt0"><?php the_sub_field('sub_heading'); ?></h3>
    </div>
</div>