<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/headers/headers.php',  // Add headers to functions.php
  'lib/prosvit/prosvit_google_fonts.php',  // Add fonts to functions.php
  'lib/prosvit/prosvit_images.php',  // Add Images to functions.php
  'lib/prosvit/landing-acf-php-sections.php',  // Add Sections Custom Fields
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Google Font
define('GOOGLE_FONTS', 'Montserrat:100,200,300,400,500,500i,600,700,800,900');

// Social Links
function prosvit_get_share_links() {
    global $post;

    $thumb = array();
    if( has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
    }
    $social = '';

    $social .= '<a href="http://www.facebook.com/sharer.php?u='.esc_url(get_permalink()).'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>';
    $social .= '<a href="https://twitter.com/share?url='.esc_url(get_permalink()).'&text='.esc_attr(get_the_title()).'" target="_blank"><i class="fa fa-twitter"></i></a>';
    $social .= '<a href="https://plus.google.com/share?url='.esc_url(get_permalink()).'" target="_blank"><i class="fa fa-google-plus"></i></a>';
    $social .= '<a href="https://pinterest.com/pin/create/bookmarklet/?media='.esc_url(isset($thumb[0]) ? $thumb[0] : '').'&url='.esc_url(get_permalink()).'&description='.esc_attr(get_the_title()).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
    $social .= '<a href="#" onclick="window.print();return false;"><i class="fa fa-print"></i></a>';

    return $social;
}