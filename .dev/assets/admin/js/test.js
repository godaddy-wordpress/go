/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
const { FormToggle } = wp.components;
const { registerPlugin } = wp.plugins;
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose, withInstanceId } from '@wordpress/compose';

/**
 * Adds an 'Enable AMP' toggle to the block editor 'Status & Visibility' section.
 *
 * If there are error(s) that block AMP from being enabled or disabled,
 * this only displays a Notice with the error(s), not a toggle.
 * Error(s) are imported as errorMessages via wp_localize_script().
 *
 * @return {Object} AMPToggle component.
 */
function CAMPToggle( { isEnabled, onChange } ) {
	return (
		<PluginPostStatusInfo>
			<label htmlFor="amp-enabled">
				Enable AMP 2
			</label>
		</PluginPostStatusInfo>
	);
}

export const render = compose(
	withSelect( () => {
		return {
			isEnabled: true,
		};
	} ),
	withDispatch( ( dispatch ) => {
		return {
			onChange: ( isEnabled ) => {
				const newStati = isEnabled ? 'enabled' : 'disabled';
				dispatch( 'core/editor' ).editPost( { meta: { amp_status: newStati } } );
			},
		};
	} ),
	withInstanceId,
)( CAMPToggle );

registerPlugin( 'plugin-name', {
	icon: 'hidden',
	render: render,
} );
