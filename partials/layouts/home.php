<?php
/**
 * Go layouts.
 *
 * @package Go
 */

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
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
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
				'coblocks/services',
				array(
					'columns'      => 2,
					'gutter'       => 'huge',
					'align'        => 'wide',
					'headingLevel' => 4,
					'buttons'      => false,
					'className'    => 'is-style-threebyfour',
					'align'        => 'wide',
				),
				array(
					array(
						'coblocks/service',
						array(
							'headingLevel' => 4,
							'showCta'      => false,
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
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
						'coblocks/service',
						array(
							'headingLevel' => 4,
							'showCta'      => false,
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
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
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
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
		),
	);

	$layouts[] = array(
		'category' => 'home',
		'label'    => __( 'Homepage', 'go' ),
		'blocks'   => array(
			array(
				'core/image',
				array(
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'alignfull size-full is-style-default',
					'align'           => 'full',
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
				'coblocks/shape-divider',
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
					'noTopMargin'      => false,
					'justAdded'        => false,
					'className'        => 'coblocks-shape-divider-8714192337 is-style-angled mb-0',
				),
				array(),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
					'className'       => 'mb-0 mt-0',
					'noBottomMargin'  => true,
					'noTopMargin'     => true,
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
				'coblocks/shape-divider',
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
					'className'        => 'coblocks-shape-divider-8714192337 is-style-angled mb-0 mt-0',
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
					'className'    => 'is-style-square',
					'align'        => 'wide',
				),
				array(
					array(
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
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
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
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
						'coblocks/service',
						array(
							'headingLevel' => 3,
							'showCta'      => false,
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/heading',
								array(
									'align'       => 'center',
									'content'     => __( 'Best-rated', 'go' ),
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
				'coblocks/shape-divider',
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
					'className'        => 'coblocks-shape-divider-8714192337 is-style-angled mb-0 mt-0',
				),
				array(),
			),
			array(
				'core/group',
				array(
					'backgroundColor' => 'tertiary',
					'align'           => 'full',
					'className'       => 'mb-0 mt-0',
					'noBottomMargin'  => true,
					'noTopMargin'     => true,
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
				'coblocks/shape-divider',
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
					'className'        => 'coblocks-shape-divider-8714192337 is-style-angled mt-0 mb-0',
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
				'core/group',
				array(
					'align' => 'wide',
				),
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
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'size-large',
					'align'           => 'wide',
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
				'core/group',
				array(
					'align' => 'wide',
				),
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
				'core/image',
				array(
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'size-full is-style-top-wave mb-0',
					'align'           => 'full',
					'noBottomMargin'  => true,
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
				'core/spacer',
				array(
					'height' => 30,
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
					'className'              => 'coblocks-features-818134018140',
					'align'                  => 'wide',
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
					'url'             => get_theme_file_uri( '/partials/layouts/images/2x3.jpg' ),
					'alt'             => __( 'Image description', 'go' ),
					'caption'         => '',
					'linkDestination' => 'none',
					'className'       => 'size-large is-style-top-wave',
					'align'           => 'full',
				),
				array(),
			),
		),
	);

	return $layouts;
};

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_home_layouts' );
