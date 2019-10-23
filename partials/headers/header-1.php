<?php
/**
 * Header #1
 *
 * @package Go
 */

$has_background = Go\has_header_background();
?>

<header id="masthead" class="site-header site-header--1 relative <?php echo esc_attr( $has_background ); ?>" itemscope itemtype="http://schema.org/WPHeader">

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

		<div class="site-header__extras justify-end">
			<?php Go\search_toggle(); ?>
		</div>

	</div>

</header>
