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

$header_flex_class = in_array( get_theme_mod( 'header_variation', \Go\Core\get_default_header_variation() ), array( 'header-6' ), true ) ? '' : ' flex';

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body
	<?php
	$body_class = get_body_class();
	if ( Go\AMP\is_amp() ) {
		?>
		aria-expanded="false"
		[aria-expanded]="mainNavMenuExpanded ? 'true' : 'false'"
		[class]="'<?php echo esc_attr( implode( ' ', $body_class ) ); ?>' + ( mainNavMenuExpanded ? ' menu-is-open' : '' )"
		<?php
	}
	?>
	class="<?php echo esc_attr( implode( ' ', $body_class ) ); ?>"
>

	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'go' ); ?></a>

		<header id="site-header" class="site-header header relative <?php echo esc_attr( Go\has_header_background() ); ?> <?php echo esc_attr( get_theme_mod( 'header_variation' ) ); ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">

			<div class="header__inner<?php echo esc_attr( $header_flex_class ); ?> items-center justify-between h-inherit w-full relative">

				<div class="header__extras">
					<?php do_action( 'go_header_social_icons' ); ?>
					<?php Go\search_toggle(); ?>
					<?php Go\WooCommerce\woocommerce_cart_link(); ?>
				</div>

				<div class="header__title-nav<?php echo esc_attr( $header_flex_class ); ?> items-center flex-nowrap">

					<?php Go\display_site_branding(); ?>

					<?php if ( has_nav_menu( 'primary' ) ) : ?>

						<nav id="header__navigation" class="header__navigation" aria-label="<?php esc_attr_e( 'Horizontal', 'go' ); ?>" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

							<div class="header__navigation-inner">
								<?php
								wp_nav_menu(
									array(
										'menu_class'     => 'primary-menu list-reset',
										'theme_location' => 'primary',
									)
								);
								?>
							</div>

						</nav>

					<?php endif; ?>

				</div>

				<?php Go\navigation_toggle(); ?>

			</div>

			<?php get_template_part( 'partials/modal-search' ); ?>

		</header>

		<main id="site-content" class="site-content" role="main">
