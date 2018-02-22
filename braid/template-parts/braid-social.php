<?php 
    // Output Social links
    // TODO: modify to get_fields for performance and put a PHP check around div.social-links.

    $social_classes = 'dim social-link pa2 dib'
?>

<div class="social-links">

<?php if ( get_field('linkedin', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('linkedin', 'option'); ?>" target="_blank"><i class="white fa fa-linkedin" aria-hidden="true"></i></a>
<?php endif; ?>

<?php if ( get_field('facebook', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('facebook', 'option'); ?>" target="_blank"><i class="white ml3 fa fa-facebook" aria-hidden="true"></i></a>
<?php endif; ?>

<?php if ( get_field('youtube', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('youtube', 'option'); ?>" target="_blank"><i class="white ml3 fa fa-youtube" aria-hidden="true"></i></a>
<?php endif; ?>

<?php if ( get_field('twitter', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('twitter', 'option'); ?>" target="_blank"><i class="white ml3 fa fa-twitter" aria-hidden="true"></i></a>
<?php endif; ?>

<?php if ( get_field('pinterest', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('pinterest', 'option'); ?>" target="_blank"><i class="white ml3 fa fa-pinterest" aria-hidden="true"></i></a>
<?php endif; ?>

<?php if ( get_field('instagram', 'option')) : ?>
    <a class="<?=$social_classes;?>" href="<?php the_field('instagram', 'option'); ?>" target="_blank"><i class="white ml3 fa fa-instagram" aria-hidden="true"></i></a>
<?php endif; ?>

</div>