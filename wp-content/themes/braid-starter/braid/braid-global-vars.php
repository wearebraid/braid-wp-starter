<?php 

// ---
// Global Variables For Use Theme-wide
// ---

// use within templates by calling "global $uploads"
$uploads = wp_upload_dir()['baseurl'];
$root = get_template_directory_uri();
$img_root = $root . "/lib/img";
$genPhone = get_field('phone', 'option');
$genPhoneHref = 'tel:' . str_replace(["-", ".", "(", ")"], "", $genPhone);
$genFax = get_field('fax', 'option');
$genFaxHref = 'fax:' . str_replace(["-", "."], "", $genFax);
$genEmail = get_field('email', 'option');
$genAddress = get_field('address', 'option');
$addressGoogleFormat = "https://maps.google.com/?daddr=" . str_replace([", ", " "], "+", $genAddress);

?>