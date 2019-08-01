<?php
/**
 * Footer Partial 3
 *
 * @see assets/admin/js/customizer/preview/footer-text.js
 *
 * @package Maverick
 */

$footer_copy_text = Maverick\footer_copy_text();
$has_background   = Maverick\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--3 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner flex flex-column lg:flex-row lg:flex-wrap items-center align-center max-w-wide m-auto px-1">

		<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
			<nav class="footer-navigation text-sm" aria-label="<?php esc_attr_e( 'Footer Menu', 'maverick' ); ?>">
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
		<?php } elseif ( is_customize_preview() ) { ?>
			<p class="u-informational"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Please assign a menu to the Footer Menu #1', 'maverick' ); ?></a></p>
		<?php } ?>

		<?php Maverick\social_icons( [ 'class' => 'social-icons list-reset' ] ); ?>

		<?php if ( ! empty( $footer_copy_text ) ) : ?>
			<p class="site-info mb-0 lg:w-full text-xs">
				<?php echo esc_html( $footer_copy_text ); ?>

				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '' );
				}
				?>
			</p>
		<?php endif; ?>

	</div>

</footer>
