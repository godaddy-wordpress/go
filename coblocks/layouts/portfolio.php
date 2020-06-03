<?php
/**
 * Go CoBlocks Layouts.
 *
 * @package Go
 */

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_portfolio_layouts' );

/**
 * Set up layouts for 'portfolio' category.
 *
 * @param array $layouts Array of block templates.
 */
function go_coblocks_portfolio_layouts( $layouts ) {
	$layouts[] = array(
		'category' => 'portfolio',
		'label'    => __( 'Portfolio', 'go' ),
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
									'level'           => 3,
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
					'url'             => get_theme_file_uri( '/coblocks/assets/image-1.png' ),
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
					'images'         => array(
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-2.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => '1',
							'link'    => get_theme_file_uri( '/coblocks/assets/image-2.png' ),
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-3.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => '2',
							'link'    => get_theme_file_uri( '/coblocks/assets/image-3.png' ),
							'caption' => array(),
						),
					),
					'ids'            => array(
						1,
						2,
					),
					'imageCrop'      => true,
					'linkTo'         => 'none',
					'sizeslug'       => 'full',
					'align'          => 'wide',
					'noBottomMargin' => true,
					'noTopMargin'    => true,
				),
				array(),
			),
			array(
				'core/image',
				array(
					'align'           => 'wide',
					'url'             => get_theme_file_uri( '/coblocks/assets/image-3.png' ),
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
		'category' => 'portfolio',
		'label'    => __( 'Portfolio', 'go' ),
		'blocks'   => array(
			array(
				'coblocks/gallery-masonry',
				array(
					'images'                  => array(
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-1.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-1',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-2.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-2',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-3.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-3',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-4.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-4',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-5.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-5',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-6.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-6',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-7.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-7',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-8.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-8',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-9.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-9',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-10.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-10',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-11.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-11',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-12.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-12',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-13.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-13',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-14.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-14',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-15.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-15',
							'caption' => array(),
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

	$layouts[] = array(
		'category' => 'portfolio',
		'label'    => __( 'Portfolio', 'go' ),
		'blocks'   => array(
			array(
				'coblocks/gallery-carousel',
				array(
					'images'                  => array(
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-1.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-1',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-2.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-2',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-3.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-3',
							'caption' => array(),
						),
					),
					'linkTo'                  => 'none',
					'rel'                     => '',
					'align'                   => 'full',
					'gutter'                  => 0,
					'gutterMobile'            => 0,
					'radius'                  => 0,
					'shadow'                  => 'none',
					'filter'                  => 'none',
					'captions'                => false,
					'captionStyle'            => 'dark',
					'primaryCaption'          => array(),
					'backgroundRadius'        => 0,
					'backgroundPadding'       => 0,
					'backgroundPaddingMobile' => 0,
					'lightbox'                => false,
					'gridSize'                => 'lrg',
					'height'                  => 560,
					'pageDots'                => false,
					'prevNextButtons'         => true,
					'autoPlay'                => false,
					'autoPlaySpeed'           => 3000,
					'draggable'               => true,
					'alignCells'              => true,
					'pauseHover'              => false,
					'freeScroll'              => false,
					'thumbnails'              => false,
					'responsiveHeight'        => false,
					'className'               => 'mb-0',
				),
				array(),
			),
			array(
				'coblocks/gallery-stacked',
				array(
					'images'                  => array(
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-4.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-4',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-5.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-5',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-6.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-6',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-7.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-7',
							'caption' => array(),
						),
						array(
							'url'     => get_theme_file_uri( '/coblocks/assets/image-8.png' ),
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-8',
							'caption' => array(),
						),
					),
					'linkTo'                  => 'none',
					'rel'                     => '',
					'align'                   => 'full',
					'gutter'                  => 0,
					'gutterMobile'            => 0,
					'radius'                  => 0,
					'shadow'                  => 'none',
					'filter'                  => 'none',
					'captions'                => false,
					'primaryCaption'          => array(),
					'backgroundRadius'        => 0,
					'backgroundPadding'       => 0,
					'backgroundPaddingMobile' => 0,
					'lightbox'                => false,
					'fullwidth'               => true,
				),
				array(),
			),
		),
	);

	return $layouts;
};
