<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Maverick
 */

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'maverick' ); ?></a>

		<?php Maverick\header_variation(); ?>

		<div id="content" class="site-content">
