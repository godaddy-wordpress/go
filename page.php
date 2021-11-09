<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Go
 */

get_header();

echo do_blocks( file_get_contents( get_stylesheet_directory() . '/go-block-templates/page.html' ) );

get_footer();
