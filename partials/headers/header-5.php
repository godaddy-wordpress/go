<?php
/**
 * Header #5
 *
 * @package Maverick
 */

?>

<header id="masthead" class="site-header site-header--5" itemscope itemtype="http://schema.org/WPHeader">

	<div class="site-header__inner flex items-center justify-center max-w-wide m-auto relative">

		<?php if ( has_nav_menu( 'primary' ) ) { ?>

			<nav id="js-primary-menu" class="site-navigation c-site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

				<?php Maverick\navigation_toggle(); ?>

				<?php
					wp_nav_menu(
						[
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu c-primary-menu list-reset',
							'container'      => false,
						]
					);
				?>
			</nav><!-- .site-navigation -->

		<?php } else { ?>
			<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a Primary menu to the header', 'maverick' ); ?></a></p>
		<?php } ?>

		<?php Maverick\display_site_branding(); ?>

		<button id="js-site-search__toggle" class="site-search__toggle" type="button" aria-controls="js-site-search">
			<?php echo Maverick\load_inline_svg( 'search.svg' ); // phpcs:ignore ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search Toggle', 'maverick' ); ?></span>
		</button>

		<?php get_search_form(); ?>

	</div>

</header><!-- #masthead .site-header -->
