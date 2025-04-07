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

		$deactivation_form_choices = array(
			array(
				'slug'       => 'broken-or-breaks-plugins',
				'label'      => "It's broken or broke other plugins I'm using",
				'is_checked' => false,
				'text_field' => null,
			),
			array(
				'slug'       => 'lack-of-support',
				'label'      => 'Lack of help or support from GoDaddy',
				'is_checked' => false,
				'text_field' => null,
			),
			array(
				'slug'       => 'not-enough-features',
				'label'      => "It doesn't have the features I am looking for",
				'is_checked' => false,
				'text_field' => 'choice_not-enough-features_text',
			),
			array(
				'slug'       => 'not-responsive',
				'label'      => "It isn't responsive to screen size",
				'is_checked' => false,
				'text_field' => null,
			),
			array(
				'slug'       => 'slow-website-performance',
				'label'      => "It slows down my website's speed/load time",
				'is_checked' => false,
				'text_field' => null,
			),
		);

		// Randomize the choices.
		shuffle( $deactivation_form_choices );

		// Ensure "Other Reason" is last.
		$deactivation_form_choices[] = array(
			'slug'       => 'other',
			'label'      => 'Other reason:',
			'is_checked' => false,
			'text_field' => 'choice_other_text',
		);

		$deactivation_labels = array(
			'privacy_disclaimer' => __( "Please do not include any personal information in your submission. We do not collect or need this information. Please see our <a href='https://www.godaddy.com/legal/agreements/privacy-policy' target='_blank'>privacy policy</a> for details.", 'go' ),
			'skip_deactivate'    => __( 'Skip & Switch Theme', 'go' ),
			'submit_deactivate'  => __( 'Submit & Switch Theme', 'go' ),
			'title'              => __( 'Thanks for trying Go. Let us know how we can improve.', 'go' ),
		);

		// Pass data.
		wp_localize_script(
			'go-theme-deactivation',
			'goThemeDeactivateData',
			array(
				'containerId'    => self::CONTAINER_ID,
				'hostname'       => gethostname(),
				// Localize options here.
				'choices'        => $deactivation_form_choices,
				'labels'         => $deactivation_labels,
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
