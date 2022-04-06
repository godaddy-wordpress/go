<?php
/**
 * Register theme deactivation class.
 *
 * @package CoBlocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Go_Theme_Deactivation Class
 *
 * @since 1.6.0
 */
class Go_Theme_Deactivation {

	const CONTAINER_ID = 'go-theme-deactivate-modal';

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_footer-themes.php', array( $this, 'admin_go_deactivation_modal' ) );

		add_filter( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Register meta.
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts( $hook_suffix ) {

		if ( 'themes.php' !== $hook_suffix ) {

			return;

		}

		$name     = 'go-theme-deactivation';
		$filepath = '/dist/js/admin/' . $name;

		// Enqueue modal script.
		wp_enqueue_script(
			'go-theme-deactivation',
			GO_PLUGIN_URL . $filepath . '.js',
			array( 'wp-components', 'wp-dom', 'wp-dom-ready', 'wp-element' ),
			GO_VERSION,
			true
		);

		$wpnux_export_data = json_decode( get_option( 'wpnux_export_data', '[]' ), true );

		// Pass data.
		wp_localize_script(
			'go-theme-deactivation',
			'goThemeDeactivateData',
			array(
				'containerId'    => self::CONTAINER_ID,
				'hostname'       => gethostname(),
				'domain'         => site_url(),
				'goThemeVersion' => GO_VERSION,
				'wpVersion'      => $GLOBALS['wp_version'],
			)
		);

		// Styles.
		$name     = 'style-go-theme-deactivation';
		$filepath = '/dist/css/admin/' . $name;
		$rtl      = ! is_rtl() ? '' : '-rtl';

		wp_enqueue_style(
			'go-theme-deactivation',
			GO_PLUGIN_URL . $filepath . $rtl . '.css',
			array( 'wp-components' ),
			GO_VERSION
		);

	}

	/**
	 * Add Go Theme Deactivation Modal backdrop to the DOM.
	 */
	public function admin_go_deactivation_modal() {

		?>

		<div id="<?php echo esc_attr( self::CONTAINER_ID ); ?>"></div>

		<?php

	}

}

return new Go_Theme_Deactivation();
