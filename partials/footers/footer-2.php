<?php
/**
 * Footer #3
 *
 * @package Maverick
 */

$has_background = Maverick\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--2 <?php echo esc_attr( $has_background ); ?>">

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

		<?php Maverick\copyright( [ 'class' => 'site-info text-xs mb-0 lg:w-full' ] ); ?>

	</div>

</footer>
