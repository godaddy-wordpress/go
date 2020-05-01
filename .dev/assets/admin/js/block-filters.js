
var el = wp.element.createElement;
var __ = wp.i18n.__;
var registerPlugin = wp.plugins.registerPlugin;
var PluginPostStatusInfo = wp.editPost.PluginPostStatusInfo;

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

		var registerPlugin = wp.plugins.registerPlugin;
		var el = wp.element.createElement;
		var CheckboxControl = wp.components.CheckboxControl



		var MetaBlockField = function( ) {
			return el( CheckboxControl, {
				label: 'Hide page title',
				checked: jQuery( '#hide-page-title-checkbox').prop( 'checked' ),
				onChange: function( content ) {
					console.log(jQuery( this ).is( ':checked' ))
					if ( jQuery( this ).is( ':checked' ) ) {
						jQuery( '#hide-page-title-checkbox' ).prop( 'checked', true );
						return;
					}
					jQuery( '#hide-page-title-checkbox' ).prop( 'checked', false );
				},
			} );
		}
	 
		registerPlugin( 'post-status-info-test', {
			render: function() {
				return el( PluginPostStatusInfo,
					{
						name: 'post-status-info-test',
						title: 'My plugin sidebar',
					},
					el( 'div',
						{ className: 'plugin-sidebar-content' },
						el( MetaBlockField )
					)
				);
			}
		} );
	
} );
