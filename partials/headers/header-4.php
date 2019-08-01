<?php
/**
 * Header #4
 *
 * @package Maverick
 */

?>

<header id="masthead" class="site-header site-header--4 site-header--search-logo-nav" itemscope itemtype="http://schema.org/WPHeader">

	<div class="site-header__inner flex items-center justify-center w-full max-w-wide m-auto relative">

		<button id="js-site-search__toggle" class="site-search__toggle" type="button" aria-controls="js-site-search">
			<?php echo Maverick\load_inline_svg( 'search.svg' ); // phpcs:ignore ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search Toggle', 'maverick' ); ?></span>
		</button>

		<?php get_search_form(); ?>

		<?php Maverick\display_site_branding(); ?>

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

				<?php get_search_form(); ?>

			</nav>
		<?php } else { ?>
			<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a Primary menu to the header', 'maverick' ); ?></a></p>
		<?php } ?>

	</div>

</header>
