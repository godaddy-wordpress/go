<?php
/**
 * Footer #2
 *
 * @package Go
 */

$has_social_icons = Go\has_social_icons();
$has_background   = Go\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--3 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner max-w-base lg:max-w-wide m-auto px">

		<div class="flex flex-wrap lg:justify-between lg:flex-nowrap">

			<?php Go\display_site_branding( array( 'description' => false ) ); ?>

			<?php if ( has_nav_menu( 'footer-1' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--1 text-sm" aria-label="<?php esc_attr_e( 'Primary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-1' ) ); ?></span>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-1',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							)
						);
					?>
				</nav>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer-2' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--2 text-sm" aria-label="<?php esc_attr_e( 'Secondary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-2' ) ); ?></span>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-2',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							)
						);
					?>
				</nav>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer-3' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--3 text-sm" aria-label="<?php esc_attr_e( 'Tertiary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-3' ) ); ?></span>
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-3',
								'menu_class'     => 'footer-menu list-reset',
								'depth'          => 1,
							)
						);
					?>
				</nav>
			<?php endif; ?>
		</div>

		<?php if ( $has_social_icons ) : ?>
			<div class="site-footer__row flex flex-column lg:flex-row justify-between items-center">
				<?php Go\copyright( array( 'class' => 'site-info text-sm mb-0' ) ); ?>
				<?php Go\social_icons( array( 'class' => 'social-icons list-reset m-0' ) ); ?>
			</div>
		<?php endif; ?>

	</div>

</footer>
