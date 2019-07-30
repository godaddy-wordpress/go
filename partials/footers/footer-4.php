<?php
/**
 * Footer Partial 4
 *
 * @see assets/admin/js/customizer/preview/footer-text.js
 *
 * @package Maverick
 */

$footer_copy_text = Maverick\footer_copy_text();
$has_social_icons = Maverick\has_social_icons();
?>

<footer id="colophon" class="site-footer">

	<div class="site-footer__inner m-auto max-w-wide px-1">

		<div class="site-footer__row site-footer__row--1 flex flex-wrap lg:justify-between lg:flex-nowrap">

			<?php Maverick\display_site_branding( array( 'description' => false ) ); ?>

			<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
				<nav class="footer-navigation footer-navigation--1" aria-label="<?php esc_attr_e( 'Primary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title text-heading bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-1' ) ); ?></span>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-1',
								'menu_class'     => 'footer-menu footer-menu--1 list-reset',
								'depth'          => 1,
							]
						);
					?>
				</nav>
			<?php } else { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #1', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-2' ) ) { ?>
				<nav class="footer-navigation footer-navigation--2" aria-label="<?php esc_attr_e( 'Secondary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title text-heading bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-2' ) ); ?></span>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-2',
								'menu_class'     => 'footer-menu footer-menu--2 list-reset',
								'depth'          => 1,
							]
						);
					?>
				</nav>
			<?php } elseif ( is_customize_preview() ) { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #2', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-3' ) ) { ?>
				<nav class="footer-navigation footer-navigation--3" aria-label="<?php esc_attr_e( 'Tertiary Footer Menu', 'maverick' ); ?>">
					<span class="footer-navigation__title text-heading bold"><?php echo esc_html( wp_get_nav_menu_name( 'footer-3' ) ); ?></span>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-3',
								'menu_class'     => 'footer-menu footer-menu--3 list-reset',
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
			<div class="site-footer__row site-footer__row--2">
				<?php Maverick\social_icons( [ 'class' => 'social-icons m-0' ] ); ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $footer_copy_text ) ) : ?>
			<div class="site-footer__row site-footer__row--3">
				<p class="site-info text-right text-xs mb-0">
					<?php echo esc_html( $footer_copy_text ); ?>
				</p>
			</div>
		<?php endif; ?>

	</div>

</footer>
