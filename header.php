<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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

		<header id="masthead" class="site-header relative <?php echo esc_attr( $has_background ); ?>" itemscope itemtype="http://schema.org/WPHeader">

			<div class="site-header__inner flex items-center justify-between h-inherit w-full relative">

				<?php Go\navigation_toggle(); ?>

				<div class="site-header__title">

					<?php Go\display_site_branding(); ?>

					<nav id="js-primary-menu" class="site-navigation c-site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

						<?php
						wp_nav_menu(
							[
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu list-reset',
								'container'      => false,
							]
						);
						?>
					</nav>

				</div>

				<div class="site-header__extras">
					<?php Go\search_toggle(); ?>
				</div>

			</div>

		</header>

		<div id="content" class="site-content">
