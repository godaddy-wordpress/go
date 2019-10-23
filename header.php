<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="site-content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Go
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'go' ); ?></a>

		<header id="site-header" class="header relative <?php echo esc_attr( Go\has_header_background() ); ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">

			<div class="header__inner flex items-center justify-between h-inherit w-full relative">

				<?php Go\navigation_toggle(); ?>

				<div class="header__title-nav">

					<?php Go\display_site_branding(); ?>

					<?php if ( has_nav_menu( 'primary' ) ) { ?>

						<nav id="js-primary-menu" class="header__navigation" aria-label="<?php esc_attr_e( 'Horizontal', 'go' ); ?>" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

							<?php
							wp_nav_menu(
								[
									'container'      => '',
									'menu_class'     => 'primary-menu list-reset',
									'theme_location' => 'primary',
								]
							);
							?>
						</nav>

					<?php } ?>

				</div>

				<div class="header__extras">
					<?php Go\search_toggle(); ?>
				</div>

			</div>

		</header>

		<main id="site-content" class="site-content" role="main">
