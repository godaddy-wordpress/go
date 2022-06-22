<?php
/**
 * Go layouts.
 *
 * @package Go
 */

/**
 * Set up layouts for 'contact' category.
 *
 * @param array $layouts Array of block templates.
 */
function go_coblocks_contact_layouts( $layouts ) {
	$layouts[] = array(
		'category' => 'contact',
		'label'    => __( 'Contact', 'go' ),
		'blocks'   => array(
			array(
				'core/heading',
				array(
					'align'   => 'center',
					'content' => __( 'Let\'s get in touch', 'go' ),
					'level'   => 2,
				),
				array(),
			),
			array(
				'core/paragraph',
				array(
					'align'   => 'center',
					'content' => __( 'Well hello there, wonderful, fabulous&nbsp;you!&nbsp;If you’d like to get in touch with me, please feel free to give me a call at (555) 555-5555, or send a message with the form down below. Either way, I\'ll be in touch shortly!', 'go' ),
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
				'coblocks/form',
				array(
					'subject' => null,
					'to'      => null,
				),
				array(
					array(
						'coblocks/field-name',
						array(
							'label'          => 'Name',
							'required'       => false,
							'hasLastName'    => false,
							'labelFirstName' => 'First',
							'labelLastName'  => 'Last',
						),
						array(),
					),
					array(
						'coblocks/field-email',
						array(
							'label'    => 'Email',
							'required' => true,
						),
						array(),
					),
					array(
						'coblocks/field-textarea',
						array(
							'label'    => 'Message',
							'required' => true,
						),
						array(),
					),
					array(
						'coblocks/field-submit-button',
						array(
							'submitButtonText' => __( 'Contact Us', 'go' ),
						),
						array(),
					),
				),
			),
			array(
				'coblocks/services',
				array(
					'columns'      => 3,
					'gutter'       => 'huge',
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
							'imageUrl'     => get_theme_file_uri( '/partials/layouts/images/1x1.jpg' ),
							'imageAlt'     => __( 'Image description', 'go' ),
							'alignment'    => 'center',
						),
						array(
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => '<em>' . __( '"I appreciate Everett\'s ability to compose visually stunning photos, brining my memories to live every time I look at them."', 'go' ) . '</em>',
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( '- Larina H.', 'go' ),
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
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => '<em>' . __( '"Everett should be nominated for photographer of the year. I am so pleased with her photography at my wedding."', 'go' ) . '</em>',
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( '- Kam V.', 'go' ),
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
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => '<em>' . __( '"Everett knew exactly how to pull the best of me out, and into a beautiful portrait. I\'m so glad I met Everett!"', 'go' ) . '</em>',
									'dropCap' => false,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( '- Jerri S.', 'go' ),
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
		'category' => 'contact',
		'label'    => __( 'Contact', 'go' ),
		'blocks'   => array(
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
									'content' => __( 'Contact', 'go' ),
									'level'   => 5,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Studio Gym<br>123 Example Rd, Scottsdale, AZ 85260<br>(555) 555-5555', 'go' ),
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
									'content' => __( 'Hours', 'go' ),
									'level'   => 5,
								),
								array(),
							),
							array(
								'core/paragraph',
								array(
									'align'   => 'center',
									'content' => __( 'Mon-Fri => 8:00 - 21:00<br>Sat => 8:00 - 20:00<br>Sun => 10:00 - 14:00', 'go' ),
									'dropCap' => false,
								),
								array(),
							),
						),
					),
				),
			),
			array(
				'coblocks/form',
				array(
					'subject' => null,
					'to'      => null,
				),
				array(
					array(
						'coblocks/field-name',
						array(
							'label'          => 'Name',
							'required'       => false,
							'hasLastName'    => false,
							'labelFirstName' => 'First',
							'labelLastName'  => 'Last',
						),
						array(),
					),
					array(
						'coblocks/field-email',
						array(
							'label'    => 'Email',
							'required' => true,
						),
						array(),
					),
					array(
						'coblocks/field-textarea',
						array(
							'label'    => 'Message',
							'required' => true,
						),
						array(),
					),
					array(
						'coblocks/field-submit-button',
						array(
							'submitButtonText' => __( 'Contact Us', 'go' ),
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
				),
			),
		),
	);

	return $layouts;
};

add_filter( 'coblocks_layout_selector_layouts', 'go_coblocks_contact_layouts' );
