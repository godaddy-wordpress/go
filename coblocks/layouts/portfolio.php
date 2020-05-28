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
				'core/spacer',
				array(
					'height' => 10,
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
					'url'             => 'https://user-images.githubusercontent.com/1813435/76585533-fffec900-64b4-11ea-9ba4-fb771f6d7622.jpg',
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
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => '1',
							'link'    => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => '2',
							'link'    => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
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
					'url'             => 'https://user-images.githubusercontent.com/1813435/76585544-04c37d00-64b5-11ea-93a2-e287301b67f0.jpg',
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
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-1.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-1',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-2',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-3',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-4.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-4',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-5.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-5',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-6.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-6',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-7.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-7',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-8.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-8',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-9.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-9',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-10.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-10',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-11.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-11',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-12.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-12',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-13.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-13',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-14.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-14',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-15.jpg',
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
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( '“Great photography is about depth of feeling, not depth of field.”', 'go' ),
					'level'   => 2,
				),
				array(),
			),
			array(
				'coblocks/services',
				array(
					'columns'      => 3,
					'gutter'       => 'medium',
					'alignment'    => 'center',
					'headingLevel' => 3,
					'buttons'      => false,
					'className'    => 'is-style-circle',
					'align'        => 'wide',
				),
				array(
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-1.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Portrait', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'I do senior, family, wedding, engagemnet and graduation portraits to capture those memores for a lifetime.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-2.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Maternity', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Lets capture your beautiful bump, grabbing a little snapsnap for your memories before your baby arrives.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-3.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Product', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'A photo shoot to capture the essence of your products, that helps you share your products with the world.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'coblocks/services',
				array(
					'columns'      => 3,
					'gutter'       => 'medium',
					'alignment'    => 'center',
					'headingLevel' => 3,
					'buttons'      => false,
					'className'    => 'is-style-circle',
					'align'        => 'wide',
				),
				array(
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-4.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Architectural', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Photography based on wide architectual frames, including shoots for real estate agents looking to sell homes fast.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-5.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Baby', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Don\'t let those years go by too fast. Let me take photos of your littlest ones, capturing those moments in time.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-6.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Families', 'go' ),
									'level'       => 5,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'I conduct full on family shoots, either portrait style - or at events like your reunion. You\'re gonna love them!', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'I\'ll capture your best side at your next photoshoot.', 'go' ),
					'level'   => 2,
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
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-1.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-1',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-2',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-3.jpg',
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
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-4.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-4',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-5.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-5',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-6.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-6',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-7.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'gallery-image-7',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-8.jpg',
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
