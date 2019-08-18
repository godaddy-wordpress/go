<?php
/**
 * Footer #2
 *
 * @package Maverick
 */

$has_social_icons = Maverick\has_social_icons();
$has_background   = Maverick\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--3 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner max-w-base lg:max-w-wide m-auto px-1">

		<div class="flex flex-wrap lg:justify-between lg:flex-nowrap">

			<?php Maverick\display_site_branding( array( 'description' => false ) ); ?>

			<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
				<nav class="footer-navigation footer-navigation--1 text-sm" aria-label="<?php esc_attr_e( 'Primary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-1' ) ); ?></span>
					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-1',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							]
						);
					?>
				</nav>
			<?php } else { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #1', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-2' ) ) { ?>
				<nav class="footer-navigation footer-navigation--2 text-sm" aria-label="<?php esc_attr_e( 'Secondary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-2' ) ); ?></span>
					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-2',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							]
						);
					?>
				</nav>
			<?php } elseif ( is_customize_preview() ) { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #2', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-3' ) ) { ?>
				<nav class="footer-navigation footer-navigation--3 text-sm" aria-label="<?php esc_attr_e( 'Tertiary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-3' ) ); ?></span>
					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-3',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							]
						);
					?>
				</nav>
			<?php } elseif ( is_customize_preview() ) { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #3', 'maverick' ); ?></a></p>
			<?php } ?>
		</div>

		<?php if ( $has_social_icons ) : ?>
			<div class="site-footer__row flex flex-column lg:flex-row justify-between items-center">
				<?php Maverick\copyright( [ 'class' => 'site-info text-sm mb-0' ] ); ?>
				<?php Maverick\social_icons( [ 'class' => 'social-icons m-0' ] ); ?>
			</div>
		<?php endif; ?>

	</div>

</footer>
