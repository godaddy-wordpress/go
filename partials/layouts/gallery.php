<?php
/**
 * Go layouts.
 *
 * @package Go
 */

/**
 * Set up layouts for 'gallery' category.
 *
 * @param array $layouts Array of block templates.
 */
function go_coblocks_gallery_layouts( $layouts ) {
	$layouts[] = array(
		'category' => 'gallery',
		'label'    => __( 'Gallery', 'go' ),
		'blocks'   => array(
			array(
				'core/columns',
				array(
					'align' => 'wide',
				),
				array(
					array(
						'core/column',
						array(
							'width' => 20,
						),
						array(),
					),
					array(
						'core/column',
						array(
							'width' => 60,
						),
						array(
							array(
								'core/heading',
								array(
									'align'           => 'center',
									'content'         => __( 'Gallery', 'go' ),
									'level'           => 2,
									'fontWeight'      => '',
									'textTransform'   => '',
									'noBottomSpacing' => false,
									'noTopSpacing'    => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'           => 'center',
									'content'         => __( 'Connecting audience + artist in our lush, speakeasy-style listening room. Only 50 seats available for this sought-after scene.', 'go' ),
									'dropCap'         => false,
									'fontWeight'      => '',
									'textTransform'   => '',
									'noBottomSpacing' => false,
									'noTopSpacing'    => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(
							'width' => 20,
						),
						array(),
					),
				),
			),
			array(
				'core/image',
				array(
					'align'           => 'wide',
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'id'              => 3,
					'sizeslug'        => 'full',
					'linkDestination' => 'none',
					'noBottomMargin'  => false,
					'noTopMargin'     => false,
					'cropX'           => 0,
					'cropY'           => 0,
					'cropWidth'       => 100,
					'cropHeight'      => 100,
					'cropRotation'    => 0,
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
				),
			),
			array(
				'core/image',
				array(
					'align'           => 'wide',
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'id'              => 3,
					'sizeslug'        => 'full',
					'linkDestination' => 'none',
					'noBottomMargin'  => true,
					'noTopMargin'     => true,
					'cropX'           => 0,
					'cropY'           => 0,
					'cropWidth'       => 100,
					'cropHeight'      => 100,
					'cropRotation'    => 0,
				),
				array(),
			),
		),
	);

	$layouts[] = array(
		'category' => 'gallery',
		'label'    => __( 'Gallery', 'go' ),
		'blocks'   => array(
			array(
				'coblocks/gallery-masonry',
				array(
					'images'                  => array(
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-1',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-2',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-3',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-4',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-5',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-6',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-7',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-8',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-9',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-10',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-11',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-12',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-13',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-14',
						),
						array(
							'url' => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'alt' => __( 'Image description', 'go' ),
							'id'  => 'gallery-image-15',
						),
					),
					'linkTo'                  => 'none',
					'rel'                     => '',
					'align'                   => 'full',
					'gutter'                  => 40,
					'gutterMobile'            => 15,
					'radius'                  => 0,
					'shadow'                  => 'none',
					'filter'                  => 'none',
					'captions'                => false,
					'captionStyle'            => 'dark',
					'primaryCaption'          => array(),
					'backgroundRadius'        => 0,
					'backgroundPadding'       => 0,
					'backgroundPaddingMobile' => 0,
					'lightbox'                => true,
					'gridSize'                => 'lrg',
					'className'               => 'px',
				),
				array(),
			),
		),
	);

	return $layouts;
};

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_gallery_layouts' );
