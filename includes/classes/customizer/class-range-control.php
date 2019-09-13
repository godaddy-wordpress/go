<?php
/**
 * Range Customizer Control.
 *
 * @package Go\Customizer
 */

namespace Go\Customizer;

/**
 * This class is for the range control in the Customizer.
 */
class Range_Control extends \WP_Customize_Control {

	/**
	 * The type of customize control.
	 *
	 * @var string
	 */
	public $type = 'go_range_control';

	/**
	 * Enqueues required JS and CSS
	 *
	 * @return void
	 */
	public function enqueue() {
		enqueue_controls_assets();
	}

	/**
	 * Convert the control settings to JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// The setting value.
		$this->json['id']                  = $this->id;
		$this->json['value']               = $this->value();
		$this->json['link']                = $this->get_link();
		$this->json['defaultValue']        = $this->setting->default;
		$this->json['input_attrs']['min']  = ( isset( $this->input_attrs['min'] ) ) ? $this->input_attrs['min'] : '0';
		$this->json['input_attrs']['max']  = ( isset( $this->input_attrs['max'] ) ) ? $this->input_attrs['max'] : '100';
		$this->json['input_attrs']['step'] = ( isset( $this->input_attrs['step'] ) ) ? $this->input_attrs['step'] : '1';
	}

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
		<div class="range_control">

			<# if ( data.label ) { #>
				<label class="range_control__label">
					<span class="customize-control-title">{{ data.label }}</span>
				</label>
			<# } #>

			<div class="range_control__value">
				<span>{{ data.value }}</span>
				<input id="range-{{ data.id }}" type="number" class="range_control__number-input" value="{{ data.value }}" data-default-value="{{ data.defaultValue }}" {{{ data.link }}} <# if ( data.value ) { #> checked="checked" <# } #> />
				<# if ( data.description ) { #>
					<em>{{ data.description }}</em>
				<# } #>
			</div>

			<input type="range" data-input-type="range" class="range_control__track" value="{{ data.value }}" data-default-value="{{ data.defaultValue }}"  min="{{ data.input_attrs['min'] }}" max="{{ data.input_attrs['max'] }}" step="{{ data.input_attrs['step'] }}" {{{ data.link }}} />

			<a type="button" value="reset" class="range_control__reset"></a>

		</div>
		<?php
	}
}
