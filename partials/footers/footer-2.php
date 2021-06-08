<?php
/**
 * Footer #3
 *
 * @package Go
 */

$has_background = Go\has_footer_background();
$classes        = array( 'site-footer', 'site-footer--2', $has_background );

if ( ! has_nav_menu( 'footer-1' ) ) {
	$classes[] = 'has-no-footer-menu';
}
?>

<footer id="colophon" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<div class="site-footer__inner flex flex-column lg:flex-row lg:flex-wrap items-center align-center max-w-wide m-auto px">

		<?php if ( has_nav_menu( 'footer-1' ) || is_customize_preview() ) : ?>
			<nav class="footer-navigation text-sm" aria-label="<?php esc_attr_e( 'Footer Menu', 'go' ); ?>">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-1',
							'menu_class'     => 'footer-menu footer-menu--1 list-reset',
							'depth'          => 1,
						)
					);
				?>
			</nav>
		<?php endif; ?>

		<?php Go\social_icons( array( 'class' => 'social-icons list-reset' ) ); ?>

		<?php Go\copyright( array( 'class' => 'site-info text-xs mb-0 lg:w-full' ) ); ?>

	</div>

</footer>
