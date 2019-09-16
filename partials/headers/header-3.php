<?php
/**
 * Header #3
 *
 * @package Go
 */

$has_background = Go\has_header_background();
?>

<header id="masthead" class="site-header site-header--3 relative <?php echo esc_attr( $has_background ); ?>" itemscope itemtype="http://schema.org/WPHeader">

	<div class="site-header__inner flex lg:flex-column items-center justify-between max-w-wide m-auto relative">

		<?php Go\display_site_branding(); ?>

		<?php Go\navigation_toggle(); ?>

		<?php if ( has_nav_menu( 'primary' ) || is_customize_preview() ) : ?>
			<nav id="js-primary-menu" class="site-navigation c-site-navigation lg:justify-center text-center" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

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

	</div>

</header>
