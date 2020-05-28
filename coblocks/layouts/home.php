<?php
/**
 * Go CoBlocks Layouts.
 *
 * @package Go
 */

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_home_layouts' );

/**
 * Set up layouts for 'home' category.
 *
 * @param array $layouts Array of block templates.
 */
function go_coblocks_home_layouts( $layouts ) {
	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/spacer',
				array(
					'height' => 60,
				),
				array(),
			),
			array(
				'core/heading',
				array(
					'align'           => 'center',
					'content'         => __( 'Where the hustle slows, the rhythm is heard, and the beans are fantastic', 'go' ),
					'level'           => 2,
					'fontWeight'      => '',
					'textTransform'   => '',
					'noBottomSpacing' => false,
					'noTopSpacing'    => false,
				),
				array(),
			),
			array(
				'core/spacer',
				array(
					'height' => 20,
				),
				array(),
			),
			array(
				'core/image',
				array(
					'align'           => 'wide',
					'url'             => 'https://user-images.githubusercontent.com/1813435/76585612-2e7ca400-64b5-11ea-8ce7-936d4fe9180b.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'id'              => 1,
					'sizeslug'        => 'full',
					'linkDestination' => 'none',
					'className'       => 'is-style-default',
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
									'content'         => __( 'Enjoy Live Music + the Best Coffee You\'ve Ever Had', 'go' ),
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
				'go/services',
				array(
					'columns'      => 2,
					'gutter'       => 'huge',
					'align'        => 'wide',
					'headingLevel' => 4,
					'buttons'      => false,
					'className'    => 'alignwide is-style-threebyfour',
				),
				array(
					array(
						'go/service',
						array(
							'headingLevel' => 4,
							'showCta'      => false,
							'imageUrl'     => 'https://user-images.githubusercontent.com/1813435/76585533-fffec900-64b4-11ea-9ba4-fb771f6d7622.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'none',
						),
						array(
							array(
								'core/heading',
								array(
									'content'         => __( 'A social house', 'go' ),
									'level'           => 4,
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
									'content'         => __( 'With our guides\' experience, we will not only get you to where the fish are - but we\'ll get you hooked on them too. Our crew is knowledgeable and friendly - ready to take you on the trip of your dreams.', 'go' ),
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
						'go/service',
						array(
							'headingLevel' => 4,
							'showCta'      => false,
							'imageUrl'     => 'https://user-images.githubusercontent.com/1813435/76585544-04c37d00-64b5-11ea-93a2-e287301b67f0.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'none',
						),
						array(
							array(
								'core/heading',
								array(
									'content'         => __( 'A listening room', 'go' ),
									'level'           => 4,
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
									'content'         => __( 'Folks have fought some monster bluefin tuna on standup gear with our offshore fishing packager, which is an incredible challenge for sure! Stick to the shoreline and test your strength pulling in some biggies!', 'go' ),
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
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/image',
				array(
					'align'           => 'full',
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'id'              => 0,
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
				'core/heading',
				array(
					'align'           => 'center',
					'content'         => __( 'Our approach reflects the people we serve. We are diverse, yet the same.', 'go' ),
					'level'           => 2,
					'fontWeight'      => '',
					'textTransform'   => '',
					'noBottomSpacing' => false,
					'noTopSpacing'    => false,
				),
				array(),
			),
			array(
				'core/button',
				array(
					'url'             => 'https://godaddy.com',
					'text'            => __( 'Learn More', 'go' ),
					'align'           => 'center',
					'className'       => 'is-style-default',
					'fontWeight'      => '',
					'textTransform'   => '',
					'noBottomSpacing' => false,
					'noTopSpacing'    => false,
					'isFullwidth'     => false,
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
					'sizeslug'       => 'large',
					'align'          => 'wide',
					'noBottomMargin' => false,
					'noTopMargin'    => false,
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
							'width' => 40,
						),
						array(
							array(
								'core/quote',
								array(
									'value'           => '<p>We are 100% committed to quality. From the coffee we source, to the love with which it is roasted by.</p>',
									'citation'        => 'Jenna Stone, Founder',
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
							'width' => 60,
						),
						array(
							array(
								'core/paragraph',
								array(
									'content'         => __( 'When we set up shop with an espresso machine up front and a roaster in the back, we hoped to some day be a part of New York\'s rich tradition of service and culinary achievement. Everyday this aspiration drives us.', 'go' ),
									'dropCap'         => false,
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
									'content'         => __( 'The city\'s energy binds us together. It drives us to be the best.', 'go' ),
									'dropCap'         => false,
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
									'content'         => __( 'This fairly new coffee shop, conveniently located in downtown Scottsdale, is one of the best coffee shops I\'ve ever been to, and trust me when I say, I\'ve been to many. The owners and the staff will make you feel like an old friend or even family.', 'go' ),
									'dropCap'         => false,
									'fontWeight'      => '',
									'textTransform'   => '',
									'noBottomSpacing' => false,
									'noTopSpacing'    => false,
								),
								array(),
							),
							array(
								'core/button',
								array(
									'url'             => 'https://godaddy.com',
									'text'            => __( 'Grab a cup', 'go' ),
									'fontWeight'      => '',
									'textTransform'   => '',
									'noBottomSpacing' => false,
									'noTopSpacing'    => false,
									'isFullwidth'     => false,
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
					'align'           => 'full',
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-4.jpg',
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
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'go/hero',
				array(
					'layout'                 => 'center-left',
					'fullscreen'             => false,
					'paddingTop'             => 60,
					'paddingRight'           => 60,
					'paddingBottom'          => 60,
					'paddingLeft'            => 60,
					'paddingUnit'            => 'px',
					'paddingSize'            => 'huge',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginBottom'           => 0,
					'marginBottomTablet'     => 0,
					'marginBottomMobile'     => 0,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'backgroundColor'        => 'tertiary',
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'height'                 => 500,
					'heightMobile'           => 400,
					'syncHeight'             => true,
					'align'                  => 'full',
					'maxWidth'               => 805,
					'savegoMeta'             => true,
					'className'              => 'go-hero-71414479560',
				),
				array(
					array(
						'core/heading',
						array(
							'content' => __( 'Hi, I\'m Mark Cannon. A life coach &amp; mentor in Scottsdale.', 'go' ),
							'level'   => 1,
						),
						array(),
					),
					array(
						'go/buttons',
						array(
							'items'             => '2',
							'contentAlign'      => 'left',
							'isStackedOnMobile' => false,
						),
						array(
							array(
								'core/button',
								array(
									'text' => __( 'About Me', 'go' ),
								),
								array(),
							),
							array(
								'core/button',
								array(
									'text'      => __( 'Contact Me', 'go' ),
									'className' => 'is-style-outline',
								),
								array(),
							),
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
						array(
							'width' => 66.66,
						),
						array(
							array(
								'core/heading',
								array(
									'content' => __( 'My Message', 'go' ),
									'level'   => 2,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'With a school-age daughter of my own, it is of the utmost importance that we keep pushing for changes in our schools, better study spaces for our kids, affordable after-school programs, and healthy lunches. Our children are the next generation, let\'s make sure they\'re prepared, together.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'I have been actively serving our community since before my children began school. As a leader of the PTA, youth sports, and fundraising committees, I am passionate about making our town a better place for our children - and for the future.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(
							'width' => 33.33,
						),
						array(),
					),
				),
			),
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/keynote/attachments/home-image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignwide size-large',
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
							'width' => 80,
						),
						array(
							array(
								'core/quote',
								array(
									'value'     => '<p>Successful people do what unsuccessful people are simply unwilling to do.</p>',
									'citation'  => '- Jesse Doe',
									'className' => 'is-style-large',
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'go/features',
				array(
					'paddingUnit'            => 'px',
					'paddingSize'            => 'no',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'headingLevel'           => 4,
					'gutter'                 => 'large',
					'columns'                => 2,
					'contentAlign'           => 'left',
					'className'              => 'alignwide go-features-7142041440',
				),
				array(
					array(
						'go/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'go-feature-71420414465',
						),
						array(
							array(
								'go/icon',
								array(
									'icon'            => 'globe',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'primary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Background', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content'     => __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap'     => false,
									'placeholder' => __( 'Add feature content', 'go' ),
								),
								array(),
							),
						),
					),
					array(
						'go/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'go-feature-71420414472',
						),
						array(
							array(
								'go/icon',
								array(
									'icon'            => 'layers',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'primary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Experience', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content'     => __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap'     => false,
									'placeholder' => __( 'Add feature content', 'go' ),
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'go/features',
				array(
					'paddingUnit'            => 'px',
					'paddingSize'            => 'no',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'headingLevel'           => 4,
					'gutter'                 => 'large',
					'columns'                => 2,
					'contentAlign'           => 'left',
					'className'              => 'alignwide go-features-7142041440',
				),
				array(
					array(
						'go/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'go-feature-71420414465',
						),
						array(
							array(
								'go/icon',
								array(
									'icon'            => 'star',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'primary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Leadership', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content'     => __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap'     => false,
									'placeholder' => __( 'Add feature content', 'go' ),
								),
								array(),
							),
						),
					),
					array(
						'go/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'go-feature-71420414472',
						),
						array(
							array(
								'go/icon',
								array(
									'icon'            => 'scatter_plot',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'primary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Topics', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content'     => __( 'Mark’s story of transforming his own life into a full and successful life is the inspiration behind her topics around teaching others that it is possible to do the same through education. He enjoys teaching the importance of education as a whole.', 'go' ),
									'dropCap'     => false,
									'placeholder' => __( 'Add feature content', 'go' ),
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'Your first consultation is on me', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'  => __( 'Schedule it today', 'go' ),
							'align' => 'center',
						),
						array(),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignfull size-full is-style-default',
				),
				array(),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Bringing the finest culinary food from the heart of Asia directly to you', 'go' ),
					'level'   => 2,
				),
				array(),
			),
			array(
				'core/button',
				array(

					'text'  => __( 'View our Menu', 'go' ),
					'align' => 'center',
				),
				array(),
			),
			array(
				'go/shape-divider',
				array(
					'align'            => 'full',
					'height'           => 100,
					'shapeHeight'      => 68,
					'backgroundHeight' => 20,
					'syncHeight'       => true,
					'syncHeightAlt'    => true,
					'verticalFlip'     => false,
					'horizontalFlip'   => true,
					'color'            => 'tertiary',
					'customColor'      => '#111',
					'noBottomMargin'   => true,
					'noTopMargin'      => true,
					'justAdded'        => false,
					'className'        => 'alignfull go-shape-divider-8714192337 is-style-angled mb-0',
				),
				array(),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
					'className'       => 'mb-0 mt-0',
				),
				array(
					array(
						'core/paragraph',
						array(
							'content' => __( '<strong>Sushi Nakazawa</strong>&nbsp;serves the&nbsp;<em>omakase</em>&nbsp;of&nbsp;<strong>Chef Daisuke Nakazawa</strong>. Within the twenty-course meal lies Chef Nakazawa’s passion for sushi. With ingredients sourced both domestically and internationally, the chef crafts a very special tasting menu within the style of Edomae sushi. Chef Nakazawa is a strong believer in the food he serves representing the waters he is surrounded by, so only the best and freshest find its way to your plate.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content' => __( 'The relaxed dining experience at Sushi Nakazawa is chic nonetheless. High back leather chairs at the sushi bar coddle you while each course is explained in detail, and every nuance is revealed. Whether an Edomae novice or self-proclaimed sushi foodie, you will leave with a feeling of euphoria.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
				),
			),
			array(
				'go/shape-divider',
				array(
					'align'            => 'full',
					'height'           => 100,
					'shapeHeight'      => 69,
					'backgroundHeight' => 20,
					'syncHeight'       => true,
					'syncHeightAlt'    => true,
					'verticalFlip'     => true,
					'horizontalFlip'   => false,
					'color'            => 'tertiary',
					'customColor'      => '#111',
					'noBottomMargin'   => true,
					'noTopMargin'      => true,
					'justAdded'        => false,
					'className'        => 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0',
				),
				array(),
			),
			array(
				'go/services',
				array(
					'columns'      => 3,
					'gutter'       => 'medium',
					'alignment'    => 'center',
					'headingLevel' => 3,
					'buttons'      => false,
					'className'    => 'alignwide is-style-square',
				),
				array(
					array(
						'go/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-2.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'   => 'center',
									'content' => __( 'Authentic', 'go' ),
									'level'   => 3,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'The relaxed dining experience at Bento is chic and airy. High back chairs at the sushi bar coddle you for each course.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'go/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-3.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Historical', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Housed in the original Yami House, the history behind Bento is amazing. Learn more as you dine in our historical dining room.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
					array(
						'go/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-4.jpg',
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Best-Rated', 'go' ),
									'level'       => 3,
									'placeholder' => __( 'Write title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Bento is one of the best-rated restaurants in the region. With glamourous food and delicious drinks - you won\'t want to miss out!', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'go/shape-divider',
				array(
					'align'            => 'full',
					'height'           => 100,
					'shapeHeight'      => 69,
					'backgroundHeight' => 20,
					'syncHeight'       => true,
					'syncHeightAlt'    => true,
					'verticalFlip'     => false,
					'horizontalFlip'   => false,
					'color'            => 'tertiary',
					'customColor'      => '#111',
					'noBottomMargin'   => true,
					'noTopMargin'      => true,
					'justAdded'        => false,
					'className'        => 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0',
				),
				array(),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
					'className'       => 'mb-0 mt-0',
				),
				array(
					array(
						'core/columns',
						array(),
						array(
							array(
								'core/column',
								array(
									'width' => 18.44,
								),
								array(),
							),
							array(
								'core/column',
								array(
									'width' => 66.56,
								),
								array(
									array(
										'core/heading',
										array(
											'align'   => 'center',
											'content' => __( 'Bento, Steak &amp; Sushi', 'go' ),
											'level'   => 3,
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'align'   => 'center',
											'content' => __( '123 Example Rd', 'go' ),
											'dropCap' => false,
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'align'   => 'center',
											'content' => __( 'Scottsdale, AZ 85260', 'go' ),
											'dropCap' => false,
										),
										array(),
									),
									array(
										'core/button',
										array(
											'text'      => __( 'Reservations', 'go' ),
											'align'     => 'center',
											'className' => 'is-style-default',
										),
										array(),
									),
								),
							),
							array(
								'core/column',
								array(
									'width' => 15,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'go/shape-divider',
				array(
					'align'            => 'full',
					'height'           => 100,
					'shapeHeight'      => 69,
					'backgroundHeight' => 20,
					'syncHeight'       => true,
					'syncHeightAlt'    => true,
					'verticalFlip'     => true,
					'horizontalFlip'   => true,
					'color'            => 'tertiary',
					'customColor'      => '#111',
					'noBottomMargin'   => true,
					'noTopMargin'      => true,
					'justAdded'        => false,
					'className'        => 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0',
				),
				array(),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
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
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Be Fashionable Together', 'go' ),
					'level'   => 1,
				),
				array(),
			),
			array(
				'core/button',
				array(

					'text'         => __( 'Shop Catalogue', 'go' ),
					'borderRadius' => 0,
					'align'        => 'center',
				),
				array(),
			),
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/fashn/attachments/image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignwide size-full',
				),
				array(),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Spring is here, finally', 'go' ),
					'level'   => 2,
				),
				array(),
			),
			array(
				'core/media-text',
				array(
					'align'             => 'wide',
					'mediaAlt'          => '',
					'mediaPosition'     => 'left',
					'mediaWidth'        => 50,
					'isStackedOnMobile' => true,
				),
				array(
					array(
						'core/heading',
						array(
							'content' => __( 'Essentials', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content' => __( 'In fashion, beauty is in the eye of the beholder, but quality should never be a compromise. We are committed to providing you styles that have quality built in and will last through the wear and tear of your day.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'         => __( 'Shop Now', 'go' ),
							'borderRadius' => 0,
							'align'        => 'none',
						),
						array(),
					),
				),
			),
			array(
				'core/media-text',
				array(
					'align'             => 'wide',
					'mediaAlt'          => '',
					'mediaPosition'     => 'left',
					'mediaWidth'        => 50,
					'isStackedOnMobile' => true,
					'className'         => 'has-media-on-the-right',
				),
				array(
					array(
						'core/heading',
						array(
							'content' => __( 'Objects', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content' => __( 'Our collection of objects of all sorts are sure to please. Objects for the home, objects for the life, objects for your pockets, and objects to wear. While shopping with us, we want you to be completely happy with the experience.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'         => __( 'Shop Now', 'go' ),
							'borderRadius' => 0,
							'align'        => 'center',
						),
						array(),
					),
				),
			),
			array(
				'core/media-text',
				array(
					'align'             => 'wide',
					'mediaAlt'          => '',
					'mediaPosition'     => 'left',
					'mediaWidth'        => 50,
					'isStackedOnMobile' => true,
				),
				array(
					array(
						'core/heading',
						array(
							'content' => __( 'Home', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content' => __( 'Our collection of home goods is bound to catch your attention. Style your pad as well as yourself with our second-to-none, curated collection of beautiful home goods.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'         => __( 'Shop Now', 'go' ),
							'borderRadius' => 0,
							'align'        => 'none',
						),
						array(),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/group',
				array(),
				array(
					array(
						'core/paragraph',
						array(
							'align'   => 'center',
							'content' => __( 'Hello! We\'re a', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'Branding &amp; Digital Design<br>Studio in Tokyo', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'  => __( 'Let\'s Talk', 'go' ),
							'align' => 'center',
						),
						array(),
					),
				),
			),
			array(
				'core/gallery',
				array(
					'images'    => array(
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-1.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-1',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-2',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-3',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-4',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-5',
							'caption' => '',
						),
					),
					'ids'       => array(),
					'caption'   => '',
					'imageCrop' => true,
					'linkTo'    => 'none',
					'sizeslug'  => 'large',
					'className' => 'alignfull',
				),
				array(),
			),
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-6.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignfull size-large',
				),
				array(),
			),
			array(
				'core/gallery',
				array(
					'images'    => array(
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-7',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-8',
							'caption' => '',
						),
					),
					'ids'       => array(),
					'caption'   => '',
					'imageCrop' => true,
					'linkTo'    => 'none',
					'sizeslug'  => 'large',
					'className' => 'alignfull',
				),
				array(),
			),
			array(
				'core/group',
				array(),
				array(
					array(
						'core/paragraph',
						array(
							'align'   => 'center',
							'content' => __( 'Need our help?', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'We Create Brands and Inspire Experiences', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'  => __( 'Let\'s Talk', 'go' ),
							'align' => 'center',
						),
						array(),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/group',
				array(
					'backgroundColor' => 'primary',
					'align'           => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'Brilliant design.<br>Simplicity in the home.', 'go' ),
							'level'   => 1,
						),
						array(),
					),
					array(
						'core/image',
						array(
							'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-1.jpg',
							'alt'             => __( 'Image description', 'go' ),
							'caption'         => '',
							'linkDestination' => 'none',
							'className'       => 'alignwide size-large',
						),
						array(),
					),
				),
			),
			array(
				'coblocks/media-card',
				array(
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'paddingUnit'            => 'px',
					'paddingSize'            => 'no',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'mediaPosition'          => 'left',
					'mediaAlt'               => '',
					'mediaWidth'             => 55,
					'align'                  => 'wide',
					'hasImgShadow'           => false,
					'hasCardShadow'          => false,
					'className'              => 'is-style-right is-stacked-on-mobile coblocks-media-card-82315629723',
				),
				array(
					array(
						'coblocks/row',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'large',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => false,
							'hasAlignmentControls'   => false,
							'hasStackedControl'      => false,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'customBackgroundColor'  => '#FFFFFF',
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'columns'                => 1,
							'layout'                 => '100',
							'gutter'                 => 'medium',
							'className'              => 'coblocks-row-82315629908',
						),
						array(
							array(
								'coblocks/column',
								array(
									'paddingUnit'          => 'px',
									'paddingSize'          => 'no',
									'paddingSyncUnits'     => false,
									'paddingSyncUnitsTablet' => true,
									'paddingSyncUnitsMobile' => true,
									'marginUnit'           => 'px',
									'marginSize'           => 'no',
									'marginSyncUnits'      => false,
									'marginSyncUnitsTablet' => false,
									'marginSyncUnitsMobile' => false,
									'hasMarginControl'     => true,
									'hasAlignmentControls' => true,
									'hasStackedControl'    => true,
									'backgroundType'       => 'image',
									'backgroundPosition'   => 'center center',
									'backgroundRepeat'     => 'no-repeat',
									'backgroundOverlay'    => 0,
									'hasParallax'          => false,
									'videoMuted'           => true,
									'videoLoop'            => true,
									'openPopover'          => false,
									'width'                => '100',
									'className'            => 'coblocks-column-82315629936',
								),
								array(
									array(
										'core/heading',
										array(
											'content'     => __( 'Curating &amp; designing furnishing for your stunning home.', 'go' ),
											'level'       => 2,
											'placeholder' => __( 'Add heading...', 'go' ),
										),
										array(),
									),
									array(
										'core/button',
										array(
											'text' => __( 'Shop Now', 'go' ),
										),
										array(),
									),
								),
							),
						),
					),
				),
			),
			array(
				'coblocks/media-card',
				array(
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'paddingUnit'            => 'px',
					'paddingSize'            => 'no',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'mediaPosition'          => 'left',
					'mediaAlt'               => '',
					'mediaWidth'             => 55,
					'align'                  => 'wide',
					'hasImgShadow'           => false,
					'hasCardShadow'          => false,
					'className'              => 'is-stacked-on-mobile coblocks-media-card-82315629723',
				),
				array(
					array(
						'coblocks/row',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'large',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => false,
							'hasAlignmentControls'   => false,
							'hasStackedControl'      => false,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'customBackgroundColor'  => '#FFFFFF',
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'columns'                => 1,
							'layout'                 => '100',
							'gutter'                 => 'medium',
							'className'              => 'coblocks-row-82315629908',
						),
						array(
							array(
								'coblocks/column',
								array(
									'paddingUnit'          => 'px',
									'paddingSize'          => 'no',
									'paddingSyncUnits'     => false,
									'paddingSyncUnitsTablet' => true,
									'paddingSyncUnitsMobile' => true,
									'marginUnit'           => 'px',
									'marginSize'           => 'no',
									'marginSyncUnits'      => false,
									'marginSyncUnitsTablet' => false,
									'marginSyncUnitsMobile' => false,
									'hasMarginControl'     => true,
									'hasAlignmentControls' => true,
									'hasStackedControl'    => true,
									'backgroundType'       => 'image',
									'backgroundPosition'   => 'center center',
									'backgroundRepeat'     => 'no-repeat',
									'backgroundOverlay'    => 0,
									'hasParallax'          => false,
									'videoMuted'           => true,
									'videoLoop'            => true,
									'openPopover'          => false,
									'width'                => '100',
									'className'            => 'coblocks-column-82315629936',
								),
								array(
									array(
										'core/heading',
										array(
											'content'     => __( 'Shop our curated best sellers and top deals.', 'go' ),
											'level'       => 2,
											'placeholder' => __( 'Add heading...', 'go' ),
										),
										array(),
									),
									array(
										'core/button',
										array(
											'text' => __( 'Shop Now', 'go' ),
										),
										array(),
									),
								),
							),
						),
					),
				),
			),
			array(
				'core/quote',
				array(
					'value'     => '<p>“Stop and shop at Furnish to grab all the latest home furnishings” </p>',
					'citation'  => 'Jenna S.',
					'align'     => 'center',
					'className' => 'is-style-large',
				),
				array(),
			),
			array(
				'core/cover',
				array(
					'hasParallax'    => false,
					'dimRatio'       => 50,
					'overlayColor'   => 'primary',
					'backgroundType' => 'image',
					'minHeight'      => 528,
					'align'          => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'content' => __( 'Grab our best sellers today', 'go' ),
							'level'   => 3,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'      => __( 'Shop Best Sellers', 'go' ),
							'textColor' => 'quaternary',
							'align'     => 'center',
							'className' => 'is-style-outline',
						),
						array(),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/cover',
				array(
					'hasParallax'    => false,
					'dimRatio'       => 50,
					'overlayColor'   => 'tertiary',
					'backgroundType' => 'image',
					'align'          => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'align'     => 'center',
							'content'   => __( 'Fearless. Passionate. Experienced.', 'go' ),
							'level'     => 1,
							'textColor' => 'secondary',
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'align'     => 'center',
							'content'   => __( 'Helping businesses protect their brand, content and image throughout the world for more than 30 years. We help businesses protect themselves.', 'go' ),
							'dropCap'   => false,
							'textColor' => 'secondary',
						),
						array(),
					),
				),
			),
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignwide size-large',
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
							'width' => 66.66,
						),
						array(
							array(
								'core/heading',
								array(
									'content' => __( 'Helping the leaders of successful online businesses protect everything.', 'go' ),
									'level'   => 2,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality patent, trademark and legal services. The patent and trademark attorneys at Miller &amp; Cole have successfully represented and advised hundreds of clients over the last 20 years.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'We are confident that our team\'s unique experiences and trademark law focus will absolutely be an asset to your business.', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/button',
								array(
									'text'         => __( 'Learn More', 'go' ),
									'borderRadius' => 0,
									'align'        => 'none',
								),
								array(),
							),
						),
					),
					array(
						'core/column',
						array(
							'width' => 33.33,
						),
						array(
							array(
								'core/paragraph',
								array(
									'content' => '<strong>' . __( 'Contact Us', 'go' ) . '</strong>',
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( '123 Example Rd<br>Scottsdale, AZ 85260', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'email@example.com<br>(555) 555-5555', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'Our Services', 'go' ),
							'level'   => 2,
						),
						array(),
					),
					array(
						'core/spacer',
						array(
							'height' => 20,
						),
						array(),
					),
					array(
						'core/columns',
						array(),
						array(
							array(
								'core/column',
								array(),
								array(
									array(
										'core/heading',
										array(
											'align'   => 'center',
											'content' => '<em>' . __( 'Patent Applications', 'go' ) . '</em>',
											'level'   => 4,
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'align'   => 'center',
											'content' => __( 'A provisional patent application can be an effective tool for businesses and individuals seeking to acquire patent rights.', 'go' ),
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
											'content' => '<em>' . __( 'Licensing Agreements', 'go' ) . '</em>',
											'level'   => 4,
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'align'   => 'center',
											'content' => __( 'A license agreement is a legal document used to harness the value of intellectual property - creations of the mind and more.', 'go' ),
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
											'content' => '<em>' . __( 'Copyrights', 'go' ) . '</em>',
											'level'   => 4,
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'align'   => 'center',
											'content' => __( 'A copyright, an important asset to the copyright owner, is a set of exclusive rights granted to the author of an original work. ', 'go' ),
											'dropCap' => false,
										),
										array(),
									),
								),
							),
						),
					),
					array(
						'core/button',
						array(
							'text'         => __( 'Learn More', 'go' ),
							'borderRadius' => 0,
							'align'        => 'center',
						),
						array(),
					),
				),
			),
			array(
				'core/gallery',
				array(
					'images'    => array(
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-2.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-2',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-3.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-3',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-4.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-4.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-4',
							'caption' => '',
						),
					),
					'ids'       => array(),
					'caption'   => '',
					'imageCrop' => true,
					'linkTo'    => 'none',
					'sizeslug'  => 'large',
					'className' => 'alignwide',
				),
				array(),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/media-text',
				array(
					'align'             => 'wide',
					'mediaAlt'          => '',
					'mediaPosition'     => 'left',
					'mediaWidth'        => 50,
					'isStackedOnMobile' => true,
					'className'         => 'has-media-on-the-right',
				),
				array(
					array(
						'core/heading',
						array(
							'content'   => __( 'Find your nook.', 'go' ),
							'level'     => 1,
							'textColor' => 'primary',
						),
						array(),
					),
					array(
						'core/paragraph',
						array(
							'content' => __( 'Charming apartment rentals in historic neighborhoods.', 'go' ),
							'dropCap' => false,
						),
						array(),
					),
					array(
						'core/button',
						array(
							'text'      => __( 'Schedule a Tour', 'go' ),
							'className' => 'is-style-outline',
						),
						array(),
					),
				),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Only the Best Homes', 'go' ),
					'level'   => 3,
				),
				array(),
			),
			array(
				'coblocks/gallery-masonry',
				array(
					'images'                  => array(
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-2',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-3',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-4.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-4',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-5.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-5',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-6.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-6',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-7.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-7',
							'caption' => array(),
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-8.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'image-8',
							'caption' => array(),
						),
					),
					'linkTo'                  => 'none',
					'rel'                     => '',
					'align'                   => 'wide',
					'gutter'                  => 15,
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
					'lightbox'                => false,
					'gridSize'                => 'lrg',
				),
				array(),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
				),
				array(
					array(
						'core/heading',
						array(
							'align'   => 'center',
							'content' => __( 'Recently Rented Listings', 'go' ),
							'level'   => 3,
						),
						array(),
					),
					array(
						'core/spacer',
						array(
							'height' => 20,
						),
						array(),
					),
					array(
						'coblocks/services',
						array(
							'columns'      => 3,
							'gutter'       => 'medium',
							'alignment'    => 'none',
							'headingLevel' => 3,
							'buttons'      => false,
						),
						array(
							array(
								'coblocks/service',
								array(
									'headingLevel' => 3,
									'showCta'      => false,
									'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-9.jpg',
									'imageAlt'     => __( 'Image description', 'go' ),
									'alignment'    => 'none',
								),
								array(
									array(
										'core/heading',
										array(
											'content'     => __( 'Historic Heights', 'go' ),
											'level'       => 4,
											'placeholder' => __( 'Write title...', 'go' ),
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'content' => __( 'Granite counter tops, new cabinets and appliances, and modern lights and fixtures. Two bedroom, one bath.', 'go' ),
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
									'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-10.jpg',
									'imageAlt'     => __( 'Image description', 'go' ),
									'alignment'    => 'none',
								),
								array(
									array(
										'core/heading',
										array(
											'content'     => __( 'The Legacy', 'go' ),
											'level'       => 4,
											'placeholder' => __( 'Write title...', 'go' ),
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'content' => __( 'One secure, gated garage space is included. Coin-op laundry onsite. Recent kitchenette renovation. One bedroom, one bath.', 'go' ),
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
									'imageUrl'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-11.jpg',
									'imageAlt'     => __( 'Image description', 'go' ),
									'alignment'    => 'none',
								),
								array(
									array(
										'core/heading',
										array(
											'content'     => __( 'The Cottage', 'go' ),
											'level'       => 4,
											'placeholder' => __( 'Write title...', 'go' ),
										),
										array(),
									),
									array(
										'core/paragraph',
										array(
											'content' => __( 'Hardwood floors throughout, modern kitchen, gas heat, tons of closet space and recently remodeled bathroom and kitchen.', 'go' ),
											'dropCap' => false,
										),
										array(),
									),
								),
							),
						),
					),
				),
			),
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/image',
				array(
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignfull size-full is-style-top-wave',
				),
				array(),
			),
			array(
				'core/gallery',
				array(
					'images'    => array(
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-2.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'home-image-2',
							'caption' => '',
						),
						array(
							'url'     => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-3.jpg',
							'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-3.jpg',
							'alt'     => __( 'Image description', 'go' ),
							'id'      => 'home-image-3',
							'caption' => '',
						),
					),
					'ids'       => array(),
					'caption'   => '',
					'imageCrop' => true,
					'linkTo'    => 'none',
					'sizeslug'  => 'large',
					'className' => 'alignfull mt-0',
				),
				array(),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Welcome to Salt', 'go' ),
					'level'   => 2,
				),
				array(),
			),
			array(
				'core/paragraph',
				array(
					'align'   => 'center',
					'content' => __( 'For over forty years Salt has been known for its luxury lobster, steamed clams, barbecued chicken and homemade clam chowder. Stop on by and grab some of the most incredible seafood you\'ll ever taste.', 'go' ),
					'dropCap' => false,
				),
				array(),
			),
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Food &amp; Hours', 'go' ),
					'level'   => 3,
				),
				array(),
			),
			array(
				'coblocks/features',
				array(
					'paddingUnit'            => 'px',
					'paddingSize'            => 'no',
					'paddingSyncUnits'       => false,
					'paddingSyncUnitsTablet' => true,
					'paddingSyncUnitsMobile' => true,
					'marginUnit'             => 'px',
					'marginSize'             => 'no',
					'marginSyncUnits'        => false,
					'marginSyncUnitsTablet'  => false,
					'marginSyncUnitsMobile'  => false,
					'hasMarginControl'       => true,
					'hasAlignmentControls'   => true,
					'hasStackedControl'      => true,
					'backgroundType'         => 'image',
					'backgroundPosition'     => 'center center',
					'backgroundRepeat'       => 'no-repeat',
					'backgroundOverlay'      => 0,
					'hasParallax'            => false,
					'videoMuted'             => true,
					'videoLoop'              => true,
					'openPopover'            => false,
					'headingLevel'           => 4,
					'gutter'                 => 'large',
					'columns'                => 3,
					'contentAlign'           => 'center',
					'className'              => 'alignwide coblocks-features-818134018140',
				),
				array(
					array(
						'coblocks/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'coblocks-feature-818134018191',
						),
						array(
							array(
								'coblocks/icon',
								array(
									'icon'            => 'dining',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'secondary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Ocean to Plate', 'go' ),
									'level'       => 4,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'Cajun &amp; creole seafood cuisine, never frozen - delish', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/button',
								array(
									'text'            => __( 'See Menu', 'go' ),
									'backgroundColor' => 'secondary',
									'align'           => 'center',
								),
								array(),
							),
						),
					),
					array(
						'coblocks/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'coblocks-feature-818134018197',
						),
						array(
							array(
								'coblocks/icon',
								array(
									'icon'            => 'waves',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'secondary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Dine with Us', 'go' ),
									'level'       => 4,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content' => __( 'Mon - Thurs => 5pm - 11pm<br> Fri-Sat => 5pm - Midnight', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/button',
								array(
									'text'            => __( 'Dine in', 'go' ),
									'backgroundColor' => 'secondary',
									'align'           => 'center',
								),
								array(),
							),
						),
					),
					array(
						'coblocks/feature',
						array(
							'paddingUnit'            => 'px',
							'paddingSize'            => 'no',
							'paddingSyncUnits'       => false,
							'paddingSyncUnitsTablet' => true,
							'paddingSyncUnitsMobile' => true,
							'marginUnit'             => 'px',
							'marginSize'             => 'no',
							'marginSyncUnits'        => false,
							'marginSyncUnitsTablet'  => false,
							'marginSyncUnitsMobile'  => false,
							'hasMarginControl'       => true,
							'hasAlignmentControls'   => true,
							'hasStackedControl'      => true,
							'backgroundType'         => 'image',
							'backgroundPosition'     => 'center center',
							'backgroundRepeat'       => 'no-repeat',
							'backgroundOverlay'      => 0,
							'hasParallax'            => false,
							'videoMuted'             => true,
							'videoLoop'              => true,
							'openPopover'            => false,
							'headingLevel'           => 4,
							'className'              => 'coblocks-feature-818134024141',
						),
						array(
							array(
								'coblocks/icon',
								array(
									'icon'            => 'scatter_plot',
									'iconSize'        => 'medium',
									'hasContentAlign' => false,
									'iconColor'       => 'secondary',
									'height'          => 60,
									'width'           => 60,
									'borderRadius'    => 0,
									'padding'         => 0,
								),
								array(),
							),
							array(
								'core/heading',
								array(
									'content'     => __( 'Catering', 'go' ),
									'level'       => 4,
									'placeholder' => __( 'Add feature title...', 'go' ),
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'content'     => __( 'We cater all events from family reunions, to weddings', 'go' ),
									'dropCap'     => false,
									'placeholder' => __( 'Add feature content', 'go' ),
								),
								array(),
							),
							array(
								'core/button',
								array(
									'text'            => __( 'Contact', 'go' ),
									'backgroundColor' => 'secondary',
									'align'           => 'center',
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
					'url'             => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/footer-image-1.jpg',
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignfull size-large is-style-top-wave',
				),
				array(),
			),
		),
	);

	return $layouts;
};
