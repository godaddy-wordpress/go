<?php
/**
 * Go layouts.
 *
 * @package Go
 */

/**
 * Set up layouts for 'about' category.
 *
 * @param array $layouts Array of block templates.
 */
function go_coblocks_about_layouts( $layouts ) {
	$layouts[] = array(
		'category' => 'about',
		'label'    => __( 'About', 'go' ),
		'blocks'   => array(
			array(
				'core/heading',
				array(
					'textAlign' => 'center',
					'content'   => __( 'Hi, I’m Everett', 'go' ),
					'level'     => 2,
				),
				array(),
			),
			array(
				'core/paragraph',
				array(
					'align'   => 'center',
					'content' => __( 'A tenacious, loving and energetic photographer who enjoys grabbing her camera and running out to take some photos.', 'go' ),
					'dropCap' => false,
				),
				array(),
			),
			array(
				'core/button',
				array(
					'text'  => __( 'Work With Me', 'go' ),
					'align' => 'center',
				),
				array(),
			),
			array(
				'core/gallery',
				array(
					'align' => 'wide',
				),
				array(
					array(
						'core/image',
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
						),
					),
					array(
						'core/image',
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
						),
					),
					array(
						'core/image',
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
						),
					),
				),
			),
			array(
				'core/columns',
				array(
					'align' => 'wide',
				),
				array(
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'content' => __( 'Early on', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'I am so fascinated by photography and it’s capability to bring your imagination to amazing places. Early on, I fell in love with the idea of filming my own productions, so I set out to learn everything I could.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'content' => __( 'Current', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'I have been teaching myself filmmaking for the past four and a half years and I’m still learning every day. I am building my business as a freelance filmmaker, as well as working on my own photo shoots.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'about',
		'label'    => __( 'About', 'go' ),
		'blocks'   => array(
			array(
				'core/cover',
				array(
					'overlayColor' => 'tertiary',
					'align'        => 'wide',
				),
				array(
					array(
						'core/heading',
						array(
							'align'     => 'center',
							'content'   => __( 'Protecting yourself', 'go' ),
							'level'     => 1,
							'textColor' => 'primary',
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'align'     => 'center',
							'content'   => __( 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality legal services and exceptional service.', 'go' ),
							'dropCap'   => false,
							'textColor' => 'primary',
						),
						array(),
					),
				),
			),
			array(
				'core/columns',
				array(
					'align' => 'wide',
				),
				array(
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'left',
									'content' => __( 'Quality Results', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'Our goal is to create assets from our clients’ innovations through patent, trademark and copyright law.&nbsp; We take great pride in providing quality trademark legal services and exceptional customer service every single day.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'left',
									'content' => __( 'Experienced', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'The attorneys at Miller &amp; Cole work as a team to exceed each of our clients’ expectations. We have 30+ years of high-level experience helping businesses protecting the time, money and resources spent developing ideas and inventions.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'core/image',
				array(
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'size-full',
					'align'           => 'wide',
				),
				array(),
			),
			array(
				'core/columns',
				array(
					'align' => 'wide',
				),
				array(
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'center',
									'content' => __( 'Contact', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Office => (555) 555-5555<br>email@example.com', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'center',
									'content' => __( 'Location', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( '123 Example Rd<br>Scottsdale, AZ 85260', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'center',
									'content' => __( 'Connect', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( '<a href="https://twitter.com">Twitter</a><br><a href="https://www.facebook.com">Facebook</a><br>', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
		),
	);

	return $layouts;
};

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_about_layouts' );
