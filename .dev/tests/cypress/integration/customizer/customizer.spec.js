import { loginToSite, upload, saveCustomizerSettings } from '../../helpers';

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

	let headerCount = 7;

	let footerCount = 4;

	const socialAccounts = {
		facebook: 'https://www.facebook.com',
		twitter: 'https://www.twitter.com',
		instagram: 'https://www.instagram.com',
		linkedin: 'https://www.linkedin.com',
		xing: 'https://www.xing.com',
		pinterest: 'https://www.pinterest.com',
		youtube: 'https://www.youtube.com',
		spotify: 'https://www.spotify.com',
		github: 'https://www.github.com',
		tiktok: 'https://www.tiktok.com',
		mastodon: 'https://mastodon.social',
	};

	before( () => {
		loginToSite();
	} );

	beforeEach( () => {
		cy.visit( Cypress.env( 'localTestURL' ) + '/wp-admin/customize.php' );
		cy.get( 'body' ).should( 'have.class', 'wp-customizer' );
		cy.frameLoaded( '[name="customize-preview-0"]' );
	} );

	it( 'Test Site title, description and a custom logo', () => {
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

		saveCustomizerSettings();

		cy.reload();

		cy.frameLoaded( '[name="customize-preview-0"]' );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( '.custom-logo-link img' ).should( 'have.attr', 'src' ).and( 'match', /150x150/ );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'h1.site-title' ).contains( atts.title );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'span.site-description' ).contains( atts.tagline );

		// Test Hidden title and tagline
		cy.get( '#accordion-section-title_tagline' ).click();
		cy.get( '#_customize-input-hide_site_title_checkbox' ).click();
		cy.get( '#_customize-input-hide_site_tagline_checkbox' ).click();
		saveCustomizerSettings();

		cy.reload();

		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'h1#site-title' ).should( 'not.exist' );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'span.site-description' ).should( 'not.exist' );
	} );

	it( 'Should switch design styles as intended', () => {
		// Start at the bottom of the list
		designStyles.reverse().forEach( designStyle => {
			cy.get( '#accordion-section-colors' ).click();
			cy.wait( 1500 );
			cy.get( 'label[for="_customize-input-design_style_control-radio-' + designStyle.toLowerCase() + '"]' ).click( { force: true } );

			// Wait for the submit button to be ready.
			cy.get('.publish-settings', { timeout: 10000 }).should('be.visible');
			saveCustomizerSettings();
			cy.reload();
			cy.frameLoaded( '[name="customize-preview-0"]' );
			cy.iframe( 'iframe[name="customize-preview-0"]' ).should( 'have.class', 'is-style-' + designStyle.toLowerCase() );
		} );
	} );

	it( 'Should switch headers as intended', () => {
		while ( headerCount >= 1 ) {
			cy.get( '#accordion-section-go_header_settings' ).click();
			cy.get( 'label[for="header_variation_control-header-' + headerCount + '"]' ).click();
			saveCustomizerSettings();
			cy.reload();
			cy.frameLoaded( '[name="customize-preview-0"]' );
			cy.iframe( 'iframe[name="customize-preview-0"]' ).should( 'have.class', 'has-header-' + headerCount );
			headerCount--;
		}
	} );

	it( 'Should switch footers as intended', () => {
		while ( footerCount >= 1 ) {
			cy.get( '#accordion-section-go_footer_settings' ).click();
			cy.get( 'label[for="footer_variation_control-footer-' + footerCount + '"]' ).click();
			saveCustomizerSettings();
			cy.reload();
			cy.frameLoaded( '[name="customize-preview-0"]' );
			cy.iframe( 'iframe[name="customize-preview-0"]' ).should( 'have.class', 'has-footer-' + footerCount );
			footerCount--;
		}
	} );

	it( 'Should show social icons and set the URL', () => {
		cy.get( '#accordion-section-go_social_media' ).click();

		// Check icons do not show on page when no input is present
		cy.get( '#_customize-input-social_icon_github_control' ).should( 'have.value', '' );

		cy.frameLoaded( '[name="customize-preview-0"]' );
		cy.iframe( 'iframe[name="customize-preview-0"]' ).find( 'ul.social-icons > .social-icon-github' ).should( 'not.be.visible' );

		for ( const socialNetworkName in socialAccounts ) {
			cy.get( `#_customize-input-social_icon_${socialNetworkName}_control` ).clear().type( socialAccounts[ socialNetworkName ] );
		}

		saveCustomizerSettings();
		cy.reload();

		// Check that the social icons are visible in the footer (header 1 has no social icons visible)
		cy.frameLoaded( '[name="customize-preview-0"]' );
		for ( const socialNetworkName in socialAccounts ) {
			cy.iframe( 'iframe[name="customize-preview-0"]' ).find( `footer ul.social-icons > .social-icon-${socialNetworkName}` ).should( 'be.visible' );
		}
	} );

} );
