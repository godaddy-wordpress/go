<?php
/**
 * Footer Partial 3
 *
 * The .footer-blurb-text and .footer-copy-text are used by customizer,
 * when changing these classes make sure to always update the classes that the Customizer Preview is targeting in /assets/admin/js/customizer/preview/footer-text.js\
 *
 * @see assets/admin/js/customizer/preview/footer-text.js
 *
 * @package Maverick
 */

$footer_copy_text = Maverick\footer_copy_text();
?>

<footer id="colophon" class="site-footer site-footer--3 u-ma-auto u-max-width-full">

	<div class="site-footer__inner max-w-wide m-auto">

		<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
			<nav class="footer-navigation c-footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'maverick' ); ?>">
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
		<?php } elseif ( is_customize_preview() ) { ?>
			<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #1', 'maverick' ); ?></a></p>
		<?php } ?>

		<?php Maverick\social_icons( [ 'class' => 'social-icons unlist' ] ); ?>

		<?php if ( ! empty( $footer_copy_text ) ) : ?>
			<p class="footer-copy-text mb-0">
				<?php echo esc_html( $footer_copy_text ); ?>
			</p>
		<?php endif; ?>

	</div>

</footer>
