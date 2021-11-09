<?php
/**
 * Partial: single.php
 * Display permalinks or full articles
 *
 * @package Go
 */

get_header();

echo do_blocks( file_get_contents( get_stylesheet_directory() . '/go-block-templates/single.html' ) );

get_footer();
