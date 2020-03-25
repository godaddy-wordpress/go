# Extending design styles


The easiest way to add a custom design style is to create a plugin with a  function to add a new design style to Go and a corresponding stylesheet.

## Registering a design style
Add a function to make the design styles available within the Customizer:

```
/**
 * Add my Brutalist design style
 *
 * @since 0.1.0
 *
 * @param array $default_design_styles Array containings the supported design styles,
 * where the index is the slug of design style and value an array of options that sets up the design styles.
 */
function prefix_get_available_design_styles( $default_design_styles ) {

	$default_design_styles['brutalist'] = array(
		'slug'           => 'brutalist',
		'label'          => _x( 'Brutalist', 'design style name', 'go' ),
		'url'            => plugin_dir_url( __FILE__ ) . 'style-brutalist.css',
		'editor_style'   => plugin_dir_url( __FILE__ ) . 'style-brutalist.css',
		'color_schemes'  => array(
			'one' => array(
				'label'      => _x( 'Millennial', 'color palette name', 'go' ),
				'primary'    => '#0d00ff',
				'secondary'  => '#ccff04',
				'tertiary'   => '#f7ceff',
				'background' => '#ccff04',
			),
			'two' => array(
				'label'      => _x( 'Blush', 'color palette name', 'go' ),
				'primary'    => '#5501e6',
				'secondary'  => '#00fc75',
				'tertiary'   => '#f6ffd8',
				'background' => '#00fc75',
			),
		),
		'fonts'          => array(
			'Bungee'        => array(
				'400',
			),
			'IBM Plex Mono' => array(
				'400',
				'800',
			),
		),
		'viewport_basis' => '950',
	);

	return $default_design_styles;

}
add_filter( 'go_design_styles', 'prefix_get_available_design_styles' );
```


## Registering a styleseheet and modify CSS custom properties
2. Add a stylesheet to override any default CSS custom properties in Go.
