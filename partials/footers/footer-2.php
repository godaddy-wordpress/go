<?php
/**
 * Footer Partial 2
 *
 * The .footer-blurb-text and .footer-copy-text are used by customizer,
 * when changing these classes make sure to always update the classes that the Customizer Preview is targeting in /assets/admin/js/customizer/preview/footer-text.js
 *
 * @see assets/admin/js/customizer/preview/footer-text.js
 *
 * @package Maverick
 */

$footer_copy_text = Maverick\footer_copy_text();
$has_social_icons = Maverick\has_social_icons();
?>

<footer id="colophon" class="site-footer site-footer--2 u-ma-auto u-max-width-full">

	<div class="site-footer__inner max-w-wide m-auto">

		<div class="row row--1">
			<div class="footer-blurb-text">
				<?php echo wp_kses_post( Maverick\footer_blurb_text() ); ?>
			</div><!-- .footer-blurb-text -->

			<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
				<nav class="footer-navigation footer-navigation--1" aria-label="<?php esc_attr_e( 'Primary Footer Menu', 'maverick' ); ?>">
					<h6 class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-1' ) ); ?></h6>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-1',
								'menu_class'     => 'footer-menu footer-menu--1 unlist',
								'depth'          => 1,
							]
						);
					?>
				</nav><!-- .footer-navigation -->
			<?php } else { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #1', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-2' ) ) { ?>
				<nav class="footer-navigation footer-navigation--2" aria-label="<?php esc_attr_e( 'Secondary Footer Menu', 'maverick' ); ?>">
					<h6 class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-2' ) ); ?></h6>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-2',
								'menu_class'     => 'footer-menu footer-menu--2 unlist',
								'depth'          => 1,
							]
						);
					?>
				</nav><!-- .footer-navigation -->
			<?php } else if ( is_customize_preview() ) { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #2', 'maverick' ); ?></a></p>
			<?php } ?>

			<?php if ( has_nav_menu( 'footer-3' ) ) { ?>
				<nav class="footer-navigation footer-navigation--3" aria-label="<?php esc_attr_e( 'Tertiary Footer Menu', 'maverick' ); ?>">
					<h6 class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-3' ) ); ?></h6>

					<?php
						wp_nav_menu(
							[
								'theme_location' => 'footer-3',
								'menu_class'     => 'footer-menu footer-menu--3 unlist',
								'depth'          => 1,
							]
						);
					?>
				</nav><!-- .footer-navigation -->
			<?php } else if ( is_customize_preview() ) { ?>
				<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #3', 'maverick' ); ?></a></p>
			<?php } ?>
		</div><!-- .row .row--1 -->

		<?php if ( $has_social_icons || ! empty( $footer_copy_text ) ) : ?>
			<div class="row row--2">
				<?php if ( ! empty( $footer_copy_text ) ) : ?>
					<p class="footer-copy-text">
						<?php echo esc_html( $footer_copy_text ); ?>
					</p><!-- .footer-copy-text -->
				<?php endif; ?>

				<?php Maverick\social_icons( [ 'class' => 'social-icons m-0' ] ); ?>
			</div><!-- .row .row--2 -->
		<?php endif; ?>

	</div>
</footer><!-- #colophon .site-footer -->
