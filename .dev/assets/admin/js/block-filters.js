import PropTypes from 'prop-types';
import { __ } from '@wordpress/i18n';
const { FormToggle } = wp.components;
const { registerPlugin } = wp.plugins;
import { withSelect, withDispatch } from '@wordpress/data';
const { PluginPostStatusInfo } = wp.editPost;
import { compose, withInstanceId } from '@wordpress/compose';

wp.domReady( function() {
	jQuery( '.block-editor' ).append( GoBlockFilters.inlineStyles );

	if ( GoBlockFilters.hidePageTitle ) {
		jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
	}

	jQuery( '#hide-page-title-checkbox' ).on( 'change', function() {
		if ( jQuery( this ).is( ':checked' ) ) {
			jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
			return;
		}
		jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 1 } );
	} );
} );

/**
 * Determines whether Go Page Title Toggle is enabled/disabled for the current page.
 *
 * @return {boolean} Whether the page title is visible or not.
 */
export const isPageTitleHidden = () => {
	const { getEditedPostAttribute } = wp.data.select( 'core/editor' );
	const meta = getEditedPostAttribute( 'meta' );
	if ( meta && meta.hide_page_title ) {
		return 'enabled' === meta.hide_page_title;
	}
	return false;
};

/**
 * Adds an 'Hide Page Title' toggle to the block editor 'Status & Visibility' section.
 *
 * @return {Object} GoPageTitleToggle component.
 */
function GoPageTitleToggle( { isEnabled, onChange } ) {
	return (
		<PluginPostStatusInfo>
			<label htmlFor="hide-page-title-toggle">
				{ __( 'Hide page title', 'go' ) }
			</label>
			<FormToggle
				checked={ isEnabled }
				onChange={ () => onChange( ! isEnabled ) }
				id="hide-page-title-toggle"
			/>
		</PluginPostStatusInfo>
	);
}

GoPageTitleToggle.propTypes = {
	isEnabled: PropTypes.bool.isRequired,
	onChange: PropTypes.func.isRequired,
};

registerPlugin( 'go-page-title-toggle', {
	icon: 'hidden',
	render: compose(
		withSelect( () => {
			return {
				isEnabled: isPageTitleHidden(),
			};
		} ),
		withDispatch( ( dispatch ) => {
			return {
				onChange: ( isEnabled ) => {
					const newStatus = isEnabled ? 'enabled' : 'disabled';
					wp.data.dispatch( 'core/editor' ).editPost( { meta: { hide_page_title: newStatus } } );
				},
			};
		} ),
		withInstanceId,
	)( GoPageTitleToggle ),
} );
