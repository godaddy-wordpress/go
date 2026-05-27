<?php
/**
 * Native block patterns for the Go theme.
 *
 * These patterns ship as a core-block-only alternative to the existing
 * CoBlocks layout-selector entries in partials/layouts/. Sites that do not
 * have CoBlocks installed still have a curated set of starter patterns to
 * choose from in the editor.
 *
 * @package Go\Patterns
 */

namespace Go\Patterns;

/**
 * Hook the pattern registration on `init` so the block registry is ready.
 *
 * @return void
 */
function setup() {
	add_action( 'init', __NAMESPACE__ . '\\register_categories' );
	add_action( 'init', __NAMESPACE__ . '\\register_patterns' );
}

/**
 * Register the Go pattern category.
 *
 * @return void
 */
function register_categories() {

	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'go',
		array(
			'label'       => _x( 'Go', 'Block pattern category', 'go' ),
			'description' => __( 'Patterns curated for the Go theme using core blocks only.', 'go' ),
		)
	);
}

/**
 * Register a curated set of core-block patterns covering the same four
 * layout categories the CoBlocks layout-selector ships (about, contact,
 * gallery, home).
 *
 * @return void
 */
function register_patterns() {

	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern(
		'go/about-hero',
		array(
			'title'       => __( 'About: Centred hero', 'go' ),
			'description' => __( 'Heading, intro paragraph, call-to-action, and a wide gallery.', 'go' ),
			'categories'  => array( 'go', 'about' ),
			'keywords'    => array( 'about', 'intro', 'hero' ),
			'content'     => '<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center","level":2} -->
	<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Hi, I’m Everett', 'go' ) . '</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">' . esc_html__( 'A tenacious, loving and energetic photographer who enjoys grabbing her camera and running out to take some photos.', 'go' ) . '</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Work With Me', 'go' ) . '</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","align":"wide"} -->
<figure class="wp-block-gallery has-nested-images columns-3 is-cropped alignwide"></figure>
<!-- /wp:gallery -->',
		)
	);

	register_block_pattern(
		'go/contact-split',
		array(
			'title'       => __( 'Contact: Two-column split', 'go' ),
			'description' => __( 'Heading and details on one side, contact form placeholder on the other.', 'go' ),
			'categories'  => array( 'go', 'contact' ),
			'keywords'    => array( 'contact', 'form', 'get in touch' ),
			'content'     => '<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"50%"} -->
	<div class="wp-block-column" style="flex-basis:50%">
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">' . esc_html__( 'Get in touch', 'go' ) . '</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Tell us about your project. We usually reply within one business day.', 'go' ) . '</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p><strong>' . esc_html__( 'Email:', 'go' ) . '</strong> hello@example.com<br><strong>' . esc_html__( 'Phone:', 'go' ) . '</strong> (555) 555-1234</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"50%"} -->
	<div class="wp-block-column" style="flex-basis:50%">
		<!-- wp:paragraph {"placeholder":"' . esc_attr__( 'Drop a contact form block here.', 'go' ) . '"} -->
		<p></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->',
		)
	);

	register_block_pattern(
		'go/gallery-masonry',
		array(
			'title'       => __( 'Gallery: Masonry layout', 'go' ),
			'description' => __( 'A wide masonry gallery using the core Gallery block.', 'go' ),
			'categories'  => array( 'go', 'gallery' ),
			'keywords'    => array( 'gallery', 'masonry', 'images' ),
			'content'     => '<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Recent work', 'go' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:gallery {"columns":3,"linkTo":"none","align":"wide","layout":{"type":"masonry"}} -->
<figure class="wp-block-gallery has-nested-images columns-3 alignwide"></figure>
<!-- /wp:gallery -->',
		)
	);

	register_block_pattern(
		'go/home-services',
		array(
			'title'       => __( 'Home: Three-column services', 'go' ),
			'description' => __( 'Header, intro, and a three-column services grid using core columns and headings.', 'go' ),
			'categories'  => array( 'go', 'home' ),
			'keywords'    => array( 'home', 'services', 'features' ),
			'content'     => '<!-- wp:cover {"overlayColor":"primary","minHeight":420,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:420px">
	<span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:heading {"textAlign":"center","level":1,"textColor":"background"} -->
		<h1 class="wp-block-heading has-text-align-center has-background-color has-text-color">' . esc_html__( 'We build things that last', 'go' ) . '</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","textColor":"background"} -->
		<p class="has-text-align-center has-background-color has-text-color">' . esc_html__( 'Strategy, design, and engineering for ambitious teams.', 'go' ) . '</p>
		<!-- /wp:paragraph -->
	</div>
</div>
<!-- /wp:cover -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">' . esc_html__( 'Strategy', 'go' ) . '</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Research, positioning, and roadmaps that survive contact with reality.', 'go' ) . '</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">' . esc_html__( 'Design', 'go' ) . '</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Brand systems, product UI, and content design built for the long run.', 'go' ) . '</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">' . esc_html__( 'Engineering', 'go' ) . '</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>' . esc_html__( 'Modern WordPress, headless integrations, and performance work.', 'go' ) . '</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->',
		)
	);
}

setup();
