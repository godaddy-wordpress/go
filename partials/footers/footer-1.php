<?php
/**
 * Footer #1
 *
 * @package Go
 */

$has_background = Go\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--1 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner max-w-wide m-auto text-center">

		<?php Go\social_icons( array( 'class' => 'social-icons list-reset' ) ); ?>

		<?php if ( has_nav_menu( 'footer-1' ) || is_customize_preview() ) : ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'go' ); ?>">
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

		<?php Go\copyright( array( 'class' => 'site-info text-sm mb-0' ) ); ?>

	</div>

</footer>
