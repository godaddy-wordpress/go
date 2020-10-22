const SwitcherControl = wp.customize.Control.extend( {
	/**
	 * Runs DOM is ready
	 */
	ready() {
		const control = this;

		this.container.on( 'change', 'input:radio', function() {
			control.setting.set( this.value );
		} );
	}
} );

export default SwitcherControl;
