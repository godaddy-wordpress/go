<?php
/**
 * Footer #1
 *
 * @package Maverick
 */

$has_background = Maverick\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--1 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner max-w-wide m-auto text-center">

		<?php Maverick\social_icons( [ 'class' => 'social-icons list-reset' ] ); ?>

		<?php if ( has_nav_menu( 'footer-1' ) ) { ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'maverick' ); ?>">
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

		<?php Maverick\copyright( [ 'class' => 'site-info text-sm mb-0' ] ); ?>

	</div>

</footer>
