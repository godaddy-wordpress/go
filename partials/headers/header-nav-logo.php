<?php
/**
 * Header variant #3
 *
 * @package Maverick
 */

?>

<header id="masthead" class="site-header site-header--nav-logo" itemscope itemtype="http://schema.org/WPHeader">

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'maverick' ); ?></a>

	<?php if ( has_nav_menu( 'primary' ) ) { ?>
		<button id="js-site-navigation__toggle" class="site-navigation__toggle c-site-navigation__toggle" type="button" aria-controls="js-primary-menu">
			<div class="site-navigation__toggle-icon">
				<div class="site-navigation__toggle-icon-inner"></div>
			</div>

			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'maverick' ); ?></span>
		</button>

		<nav id="js-primary-menu" class="site-navigation c-site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

			<?php
				wp_nav_menu(
					[
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu c-primary-menu u-unlist',
						'container'      => false,
					]
				);
			?>

		</nav>
	<?php } else { ?>
		<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a Primary menu to the header', 'maverick' ); ?></a></p>
	<?php } ?>

	<?php Maverick\display_site_branding(); ?>

</header>


