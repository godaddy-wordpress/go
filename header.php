<?php
/**
 * The template for displaying the header.
 *
 * @package Maverick
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>

		<?php Maverick\header_variation(); ?>
