<?php
/**
 * Header #4
 *
 * @package Maverick
 */

$has_background = Maverick\has_header_background();
?>

<header id="masthead" class="site-header site-header--4 <?php echo esc_attr( $has_background ); ?>" itemscope itemtype="http://schema.org/WPHeader">

	<div class="site-header__inner flex items-center justify-center max-w-wide m-auto relative">

		<button id="js-site-search__toggle" class="site-search__toggle" type="button" aria-controls="js-site-search">
			<?php echo Maverick\load_inline_svg( 'search.svg' ); // phpcs:ignore ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search Toggle', 'maverick' ); ?></span>
		</button>

		<?php get_search_form(); ?>

		<?php Maverick\display_site_branding(); ?>
		<?php Maverick\navigation_toggle(); ?>

		<nav id="js-primary-menu" class="site-navigation c-site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

			<?php

			wp_nav_menu(
				[
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu list-reset',
					'container'      => false,
				]
			);

			get_search_form();

			?>

		</nav>

	</div>

</header>
