<?php
/**
 * Login customization
 *
 * @package Go\Core
 */

namespace Go\Login;

/**
 * Set up login features.
 *
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'login_enqueue_scripts', $n( 'customize_login_screen' ), PHP_INT_MAX );

}

/**
 * Customize the login screen
 * Note: Disables when any other function is hooked into login_enqueue_scripts
 */
function customize_login_screen() {

	/**
	 * Filter to disable all login customizations
	 *
	 * @var bool
	 */
	$disable_customizations = (bool) apply_filters( 'go_disable_login_customizations', false );

	if ( $disable_customizations ) {

		return;

	}

	/**
	 * Filter to preserve login customizations
	 *
	 * @var bool
	 */
	$preserve_customizations = (bool) apply_filters( 'go_preserve_login_customizations', false );

	global $wp_filter;

	if (
		( 1 < count( $wp_filter['login_enqueue_scripts']->callbacks ) ) &&
		! $preserve_customizations
	) {

		return;

	}

	/**
	 * Set the login header text
	 */
	add_filter(
		'login_headertext',
		function() {
			return get_bloginfo( 'name' );
		}
	);

	/**
	 * Set the login page logo URL
	 */
	add_filter(
		'login_headerurl',
		function() {
			return site_url();
		}
	);

	\Go\Core\styles();
	\Go\Customizer\inline_css();

	?>

	<style type="text/css">
	body.login {
		align-items: center;
		background: '<?php echo esc_attr( get_background_color() ); ?>';
		display: flex;
		justify-content: center;
	}

	body.login #loginform {
		border-color: hsl(var(--theme-input--border-color));
		border-radius: 2px;
		padding: 26px 24px 35px;
	}

	body.login div#login {
		padding: 0;
	}

	<?php

	if ( has_custom_logo() ) {

		?>

		body.login div#login h1 a {
			background-image: url( '<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>' );
			background-size: contain;
			background-position: center;
			height: 150px;
			width: auto;
		}

		<?php

	} else {

		?>

		body.login div#login h1 {
			display: none;
		}

		body.login div#login h1 a {
			background-image: none;
		}

		<?php

	}

	?>

	body.login div#login #nav a,
	body.login div#login #backtoblog a  {
		color: hsl(var(--theme-link--color, var(--theme-color-primary)));
		text-decoration: underline;
	}

	body.login div#login #nav a:hover,
	body.login div#login #backtoblog a:hover {
		color: hsl(var(--theme-link--color-interactive, var(--theme-color-text)));
	}

	body.login div#login input[type="submit"] {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		background: hsl(var(--theme-button--bg));
		border: none;
		padding: 0 10px;
	}

	body.login div#login input[type="submit"]:hover,
	body.login div#login input[type="submit"]:focus,
	body.login div#login input[type="submit"]:active {
		background-color: hsl(var(--theme-button--bg-interactive));
	}

	body.login div#login .button.wp-hide-pw {
		color: hsl(var(--theme-label--color));
	}

	body.login div#login .button.wp-hide-pw:focus {
		border: none;
	}

	body.login div#login h1 a:focus,
	body.login div#login input[type="submit"]:focus,
	body.login div#login input#rememberme:focus,
	body.login div#login .button.wp-hide-pw:focus {
		box-shadow: none;
		outline-color: hsla(var(--theme-outline-color), 1);
		outline-style: var(--theme-outline-style, dotted);
		outline-width: var(--theme-outline-width, 1px);
	}

	body.login div#login p.submit {
		display: inline-block;
		margin-top: 1.25em;
		width: 100%;
	}

	body.login div#login p.submit input[type="submit"] {
		width: 100%;
	}

	body.login div#login input#rememberme {
		border-color: hsl(var(--theme-input--border-color));
	}
	</style>

	<?php

}
