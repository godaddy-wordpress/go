import PropTypes from 'prop-types';
const { __ } = wp.i18n;
const { FormToggle } = wp.components;
const { registerPlugin } = wp.plugins;
const { withSelect, withDispatch } = wp.data;
const { PluginPostStatusInfo } = wp.editPost;
const { compose, withInstanceId } = wp.compose;

// Inject Custom CSS into the block editor
wp.domReady( function() {
	jQuery( 'head' ).append( GoBlockFilters.inlineStyles );
} );

/**
 * Adds an 'Hide Page Title' toggle to the block editor 'Status & Visibility' section.
 *
 * @return {Object} GoPageTitleToggle component.
 */
function GoPageTitleToggle( { isEnabled, onChange } ) {
	wp.domReady( function() {
		if ( isEnabled ) {
			jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
		}

		jQuery( '#hide-page-title-toggle' ).on( 'change', function() {
			if ( jQuery( this ).is( ':checked' ) ) {
				jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
				return;
			}
			jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 1 } );
		} );
	} );

	if ( 'page' !== wp.data.select('core/editor').getCurrentPostType() || ! GoBlockFilters.showPageTitles ) {

		return null;

	}

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
		withSelect( (select) => {
			const isPageTitleHidden = () => {
				const { getEditedPostAttribute } = select( 'core/editor' );
				const meta = getEditedPostAttribute( 'meta' );
				if ( meta && meta.hide_page_title ) {
					return 'enabled' === meta.hide_page_title;
				}
				return false;
			};

			return {
				isEnabled: isPageTitleHidden(),
			};
		} ),
		withDispatch( ( dispatch ) => {
			return {
				onChange: ( isEnabled ) => {
					const newStatus = isEnabled ? 'enabled' : 'disabled';
					dispatch( 'core/editor' ).editPost( { meta: { hide_page_title: newStatus } } );
				},
			};
		} ),
		withInstanceId,
	)( GoPageTitleToggle ),
} );
