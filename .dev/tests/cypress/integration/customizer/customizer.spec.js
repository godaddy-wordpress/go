import { loginToSite, upload } from '../../helpers';

describe( 'Test the customizer works as intended.', () => {

	let atts = {
		title: 'Custom Title',
		tagline: 'Custom Tagline',
	};

	const designStyles = [
		'Traditional',
		'Modern',
		'Trendy',
		'Welcoming',
		'Playful',
	];

	before( () => {
		loginToSite();
	} );

	beforeEach( () => {
		cy.visit( Cypress.env( 'localTestURL' ) + '/wp-admin/customize.php' );
		cy.get( 'body' ).should( 'have.class', 'wp-customizer' );
		cy.frameLoaded( '[name="customize-preview-0"]' );
	} );

	it( 'Should upload a custom logo', () => {
		cy.get( '#accordion-section-title_tagline' ).click();

		// Custom Logo
		cy.get( '#customize-control-custom_logo .attachment-media-view .upload-button' ).click();
		upload.newLogo();
		cy.get( '.media-frame-toolbar .media-toolbar-primary button.button-primary' ).should( 'not.have.class', 'disabled' ).click();
		cy.get( '.media-toolbar button.button-secondary' ).contains( 'Skip cropping' ).click();

		// Site Title
		cy.get( '#_customize-input-blogname' ).clear().type( atts.title );

		// Site Tagline
		cy.get( '#_customize-input-blogdescription' ).clear().type( atts.tagline );

		cy.get( '#customize-header-actions input[type="submit"]' ).click().should( 'have.attr', 'disabled' );

		cy.reload();

		cy.frameLoaded( '[name="customize-preview-0"]' );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( '.custom-logo-link img' ).should( 'have.attr', 'src' ).and( 'match', /150x150/ );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'h1.site-title' ).contains( atts.title );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'p.site-description' ).contains( atts.tagline );
	} );

	// it( 'Should switch design styles as intended', () => {
	// 	cy.get( '#accordion-section-colors' ).click();
	//
	// 	designStyles.forEach( designStyle => {
	// 		cy.get( 'label[for="_customize-input-design_style_control-radio-' + designStyle.toLowerCase() + '"]' ).click();
	// 		cy.get( '#customize-header-actions input[type="submit"]' ).click().should( 'have.attr', 'disabled' );
	// 		cy.reload();
	// 		cy.frameLoaded( '[name="customize-preview-0"]' );
	// 		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'h1.site-title' ).should( 'have.class', 'is-style-' + designStyle.toLowerCase() );
	// 	} );
	//
	// 	// Loop over design style labels
	// 	// cy.get( '#customize-control-design_style_control .customize-inside-control-row' ).then( $designStyle => {
	// 	// 	[ ...$designStyle.find( 'label[for^="_customize-input-design_style_control-radio-"]' ) ].forEach( $designStyleLabel => {
	// 	// 		let designStyleName = $designStyleLabel.innerHTML;
	// 	// 		// let colors = [];
	// 	//
	// 	// 		console.log( designStyleName );
	// 	//
	// 	// 		$designStyleLabel.click();
	// 	//
	// 	// 		cy.get( '#customize-header-actions input[type="submit"]' ).click().should( 'have.attr', 'disabled' );
	// 	// 		cy.reload();
	// 	// 		cy.frameLoaded( '[name="customize-preview-0"]' );
	// 	// 		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'body' ).should( 'have.class', 'is-style-' + designStyleName.toLowerCase() );
	// 	//
	// 	// 		// Loop over design style color schemes
	// 	// 		// cy.get( 'label[for^="color_scheme_control-' + designStyleName.toLowerCase() + '-"]' ).each( $colorScheme => {
	// 	// 		// 	console.log( $colorScheme );
	// 	// 		// } );
	// 	//
	// 	// 		// designStyles.push( designStyleName[ colors ] );
	// 	// 	} );
	// 	// } );
	// } );

} );
