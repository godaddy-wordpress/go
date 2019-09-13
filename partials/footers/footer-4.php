<?php
/**
 * Footer #4
 *
 * @package Maverick
 */

$has_social_icons = Maverick\has_social_icons();
$has_background   = Maverick\has_footer_background();
?>

<footer id="colophon" class="site-footer site-footer--4 <?php echo esc_attr( $has_background ); ?>">

	<div class="site-footer__inner m-auto max-w-wide px">

		<div class="flex flex-wrap lg:justify-start lg:flex-nowrap">

			<?php Maverick\display_site_branding( array( 'description' => false ) ); ?>

			<?php if ( has_nav_menu( 'footer-1' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--1 text-sm" aria-label="<?php esc_attr_e( 'Primary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-1' ) ); ?></span>

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
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer-2' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--2 text-sm" aria-label="<?php esc_attr_e( 'Secondary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-2' ) ); ?></span>

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
			<?php endif; ?>

			<?php if ( has_nav_menu( 'footer-3' ) || is_customize_preview() ) : ?>
				<nav class="footer-navigation footer-navigation--3 text-sm" aria-label="<?php esc_attr_e( 'Tertiary Footer Menu', 'go' ); ?>">
					<span class="footer-navigation__title"><?php echo esc_html( wp_get_nav_menu_name( 'footer-3' ) ); ?></span>

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
			<?php endif; ?>
		</div>

		<?php if ( $has_social_icons ) : ?>
			<div class="site-footer__row flex flex-column lg:flex-row justify-between lg:items-center">
				<?php Maverick\copyright( [ 'class' => 'site-info text-sm mb-0' ] ); ?>
				<?php Maverick\social_icons( [ 'class' => 'social-icons list-reset' ] ); ?>
			</div>
		<?php endif; ?>

	</div>

</footer>
