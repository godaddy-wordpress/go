<?php
/**
 * Header #2
 *
 * @package Maverick
 */

?>

<header id="masthead" class="site-header site-header--2" itemscope itemtype="http://schema.org/WPHeader">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'maverick' ); ?></a>

	<div class="site-header__inner flex items-center justify-between w-full max-w-wide m-auto">

		<?php if ( has_nav_menu( 'primary' ) ) { ?>

			<?php Maverick\navigation_toggle(); ?>

			<nav id="js-primary-menu" class="site-navigation c-site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

				<?php
					wp_nav_menu(
						[
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu c-primary-menu list-reset',
							'container'      => false,
						]
					);
				?>

			</nav>
		<?php } else { ?>
			<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a Primary menu to the header', 'maverick' ); ?></a></p>
		<?php } ?>

		<?php Maverick\display_site_branding(); ?>

	</div>

</header>
