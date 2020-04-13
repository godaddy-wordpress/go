<?php
/**
 * Title Customizer Control.
 *
 * @package Go\Customizer
 */

namespace Go\Customizer;

/**
 * Switcher Control Class.
 */
class Title_Control extends \WP_Customize_Control {

	/**
	 * Holds the switcher type
	 *
	 * @var string
	 */
	protected $switcher_type = 'default';

	/**
	 * The slug of this control in the customizer.
	 *
	 * @var string
	 */
	public $type = 'go_title';

	/**
	 * The control is rendered in JS not PHP.
	 *
	 * @return void
	 */
	public function render_content() {}

	/**
	 * Renders the JS template for the control
	 *
	 * @return void
	 */
	protected function content_template() {
		?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<em>{{ data.description }}</em>
		<# } #>

		<?php
	}
}
