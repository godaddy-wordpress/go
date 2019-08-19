<?php
/**
 * Header #2
 *
 * @package Maverick
 */

$has_background = Maverick\has_header_background();
?>

<header id="masthead" class="site-header site-header--2 <?php echo esc_attr( $has_background ); ?>" itemscope itemtype="http://schema.org/WPHeader">

	<div class="site-header__inner flex items-center justify-between max-w-wide m-auto">

		<?php Maverick\navigation_toggle(); ?>

		<?php if ( has_nav_menu( 'primary' ) || is_customize_preview() ) : ?>
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
		<?php endif; ?>

		<?php Maverick\display_site_branding(); ?>

	</div>

</header>
