/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

const commonText = { 
	imgAlt: __( 'Image description', 'go' ),
};

export const aboutLayouts = [
	{
		slug: 'about-one',
		label: __( 'About', 'go' ), // everett
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Hi, I’m Everett', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': __( 'A tenacious, loving and energetic photographer who enjoys grabbing her camera and running out to take some photos.', 'go' ),
					'dropCap': false
				},
				[]
			],
			[
				'core/button',
				{

					'text': __( 'Work With Me', 'go' ),
					'align': 'center'
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/about-image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'about-image-1',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/about-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'about-image-2',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/about-image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/about-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'about-image-3',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignwide columns-2'
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'content': __( 'Early on', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'I am so fascinated by photography and it’s capability to bring your imagination to amazing places. Early on, I fell in love with the idea of filming my own productions, so I set out to learn everything I could about storytelling through photos.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'content': __( 'Current', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'I have been teaching myself filmmaking for the past four and a half years and I’m still learning every day. I am building my business as a freelance filmmaker, as well as working on my own photo shoots.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			]
		]
	},

	{
		slug: 'about-two',
		label: __( 'About', 'go' ), // miller
		blocks: [
			[
				'core/cover',
				{
					'hasParallax': false,
					'dimRatio': 50,
					'overlayColor': 'tertiary',
					'backgroundType': 'image',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Protecting your ideas', 'go' ),
							'level': 1,
							'textColor': 'secondary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality legal services and exceptional customer service.&nbsp;&nbsp;', 'go' ),
							'dropCap': false,
							'textColor': 'secondary'
						},
						[]
					]
				]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Quality Results', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Our goal is to create assets from our clients’ innovations through patent, trademark and copyright law.&nbsp; We take great pride in providing quality trademark legal services and exceptional customer service every single day. We\'re absolutely here for you.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Experienced', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'The attorneys at Miller &amp; Cole work as a team to exceed each of our clients’ expectations. We have 30+ years of high-level experience helping businesses protecting the time, money and resources spent developing ideas and inventions.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-5.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignwide size-full'
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Contact', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Office: (555) 555-5555<br>email@example.com', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Location', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '123 Example Rd<br>Scottsdale, AZ 85260', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Connect', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '<a href="https://twitter.com">Twitter</a><br><a href="https://www.facebook.com">Facebook</a><br>', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			]
		]
	},
];

export const contactLayouts = [
	{
		slug: 'contact-one',
		label: __( 'Contact', 'go' ), // everett
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Let\'s get in touch', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': __( 'Well hello there, wonderful, fabulous&nbsp;you!&nbsp;If you’d like to get in touch with me, please feel free to give me a call at (555) 555-5555, or send a message with the form down below. Either way, I\'ll be in touch shortly!', 'go' ),
					'dropCap': false
				},
				[]
			],
			[
				'coblocks/form',
				{
					'subject': null,
					'to': null
				},
				[
					[
						'coblocks/field-name',
						{
							'label': 'Name',
							'required': false,
							'hasLastName': false,
							'labelFirstName': 'First',
							'labelLastName': 'Last'
						},
						[]
					],
					[
						'coblocks/field-email',
						{
							'label': 'Email',
							'required': true
						},
						[]
					],
					[
						'coblocks/field-textarea',
						{
							'label': 'Message',
							'required': true
						},
						[]
					]
				]
			],
			[
				'coblocks/services',
				{
					'columns': 3,
					'gutter': 'medium',
					'alignment': 'center',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-circle'
				},
				[
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-1.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '<em>"I appreciate Everett\'s ability to compose visually stunning photos, brining my memories to live every time I look at them. I couldn\'t be more happier!"</em>', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '- Larina H.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-2.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '<em>"Everett should be nominated for photographer of the year. I am so pleased with her photography at my wedding. She’s wonderful!"</em>', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '- Kam V.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-3.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '<em>"Everett knew exactly how to pull the best of me out, and into a beautiful portrait. I\'m so glad I met Everett - she\'s my go-to photographer now!"</em>', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( '- Jerri S.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			]
		]
	},

	{
		slug: 'contact-two',
		label: __( 'Contact', 'go' ), // studio
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Contact Us', 'go' ),
					'level': 1
				},
				[]
			],
			[
				'core/columns',
				{},
				[
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Contact', 'go' ),
									'level': 5
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Studio Gym<br>123 Example Rd, Scottsdale, AZ 85260<br>(555) 555-5555', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Gym Hours', 'go' ),
									'level': 5
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Mon-Fri: 8:00 - 21:00<br>Sat: 8:00 - 20:00<br>Sun: 10:00 - 14:00<br>– Holidays off –', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'coblocks/form',
				{
					'subject': null,
					'to': null
				},
				[
					[
						'coblocks/field-name',
						{
							'label': 'Name',
							'required': false,
							'hasLastName': false,
							'labelFirstName': 'First',
							'labelLastName': 'Last'
						},
						[]
					],
					[
						'coblocks/field-email',
						{
							'label': 'Email',
							'required': true
						},
						[]
					],
					[
						'coblocks/field-textarea',
						{
							'label': 'Message',
							'required': true
						},
						[]
					]
				]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-3',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-1.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-1',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull'
				},
				[]
			]
		]
	},
];

export const homeLayouts = [
	{
		slug: 'home-one',
		label: __( 'Homepage', 'go' ),
		blocks: [
			[
				'core/spacer',
				{
					'height': 60,
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Where the hustle slows, the rhythm is heard, and the beans are fantastic', 'go' ),
					'level': 2,
					'fontWeight': '',
					'textTransform': '',
					'noBottomSpacing': false,
					'noTopSpacing': false
				},
				[]
			],
			[
				'core/spacer',
				{
					'height': 20,
				},
				[]
			],
			[
				'core/image',
				{
					'align': 'wide',
					'url': 'https://user-images.githubusercontent.com/1813435/76585612-2e7ca400-64b5-11ea-8ce7-936d4fe9180b.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'id': 1,
					'sizeSlug': 'full',
					'linkDestination': 'none',
					'className': 'is-style-default',
					'noBottomMargin': false,
					'noTopMargin': false,
					'cropX': 0,
					'cropY': 0,
					'cropWidth': 100,
					'cropHeight': 100,
					'cropRotation': 0
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 20
						},
						[]
					],
					[
						'core/column',
						{
							'width': 60
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Enjoy Live Music + the Best Coffee You\'ve Ever Had', 'go' ),
									'level': 3,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Connecting audience + artist in our lush, speakeasy-style listening room. Only 50 seats available for this sought-after scene.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{
							'width': 20
						},
						[]
					]
				]
			],
			[
				'go/services',
				{
					'columns': 2,
					'gutter': 'huge',
					'align': 'wide',
					'headingLevel': 4,
					'buttons': false,
					'className': 'alignwide is-style-threebyfour'
				},
				[
					[
						'go/service',
						{
							'headingLevel': 4,
							'showCta': false,
							'imageUrl': 'https://user-images.githubusercontent.com/1813435/76585533-fffec900-64b4-11ea-9ba4-fb771f6d7622.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': __( 'A social house', 'go' ),
									'level': 4,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'With our guides\' experience, we will not only get you to where the fish are - but we\'ll get you hooked on them too. Our crew is knowledgeable and friendly - ready to take you on the trip of your dreams.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							]
						]
					],
					[
						'go/service',
						{
							'headingLevel': 4,
							'showCta': false,
							'imageUrl': 'https://user-images.githubusercontent.com/1813435/76585544-04c37d00-64b5-11ea-93a2-e287301b67f0.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': __( 'A listening room', 'go' ),
									'level': 4,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Folks have fought some monster bluefin tuna on standup gear with our offshore fishing packager, which is an incredible challenge for sure! Stick to the shoreline and test your strength pulling in some biggies!', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							]
						]
					]
				]
			]
		]
	},

	{
		slug: 'home-two',
		label: __( 'Homepage', 'go' ),
		blocks: [
			[
				'core/image',
				{
					'align': 'full',
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'id': 0,
					'sizeSlug': 'full',
					'linkDestination': 'none',
					'noBottomMargin': false,
					'noTopMargin': false,
					'cropX': 0,
					'cropY': 0,
					'cropWidth': 100,
					'cropHeight': 100,
					'cropRotation': 0
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Our approach reflects the people we serve. We are diverse, yet the same.', 'go' ),
					'level': 2,
					'fontWeight': '',
					'textTransform': '',
					'noBottomSpacing': false,
					'noTopSpacing': false
				},
				[]
			],
			[
				'core/button',
				{
					'url': 'https://godaddy.com',
					'text': __( 'Learn More', 'go' ),
					'align': 'center',
					'className': 'is-style-default',
					'fontWeight': '',
					'textTransform': '',
					'noBottomSpacing': false,
					'noTopSpacing': false,
					'isFullwidth': false
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': '1',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': '2',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'caption': []
						}
					],
					'ids': [
						1,
						2
					],
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'align': 'wide',
					'noBottomMargin': false,
					'noTopMargin': false
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 40
						},
						[
							[
								'core/quote',
								{
									'value': '<p>We are 100% committed to quality. From the coffee we source, to the love with which it is roasted by.</p>',
									'citation': 'Jenna Stone, Founder',
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{
							'width': 60
						},
						[
							[
								'core/paragraph',
								{
									'content': __( 'When we set up shop with an espresso machine up front and a roaster in the back, we hoped to some day be a part of New York\'s rich tradition of service and culinary achievement. Everyday this aspiration drives us.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'The city\'s energy binds us together. It drives us to be the best.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'This fairly new coffee shop, conveniently located in downtown Scottsdale, is one of the best coffee shops I\'ve ever been to, and trust me when I say, I\'ve been to many. The owners and the staff will make you feel like an old friend or even family.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/button',
								{
									'url': 'https://godaddy.com',
									'text': __( 'Grab a cup', 'go' ),
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false,
									'isFullwidth': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/image',
				{
					'align': 'full',
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-4.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'id': 3,
					'sizeSlug': 'full',
					'linkDestination': 'none',
					'noBottomMargin': false,
					'noTopMargin': false,
					'cropX': 0,
					'cropY': 0,
					'cropWidth': 100,
					'cropHeight': 100,
					'cropRotation': 0
				},
				[]
			]
		]
	},
    
	{
		slug: 'home-three',
		label: __( 'Homepage', 'go' ), // keynote
		blocks: [
			[
				'go/hero',
				{
					'layout': 'center-left',
					'fullscreen': false,
					'paddingTop': 60,
					'paddingRight': 60,
					'paddingBottom': 60,
					'paddingLeft': 60,
					'paddingUnit': 'px',
					'paddingSize': 'huge',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginBottom': 0,
					'marginBottomTablet': 0,
					'marginBottomMobile': 0,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'backgroundColor': 'tertiary',
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'height': 500,
					'heightMobile': 400,
					'syncHeight': true,
					'align': 'full',
					'maxWidth': 805,
					'savegoMeta': true,
					'className': 'go-hero-71414479560'
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Hi, I\'m Mark Cannon. A life coach &amp; mentor in Scottsdale.', 'go' ),
							'level': 1
						},
						[]
					],
					[
						'go/buttons',
						{
							'items': '2',
							'contentAlign': 'left',
							'isStackedOnMobile': false
						},
						[
							[
								'core/button',
								{
									'text': __( 'About Me', 'go' ),
								},
								[]
							],
							[
								'core/button',
								{
									'text': __( 'Contact Me', 'go' ),
									'className': 'is-style-outline'
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 66.66
						},
						[
							[
								'core/heading',
								{
									'content': __( 'My Message', 'go' ),
									'level': 2
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'With a school-age daughter of my own, it is of the utmost importance that we keep pushing for changes in our schools, better study spaces for our kids, affordable after-school programs, and healthy lunches. Our children are the next generation, let\'s make sure they\'re prepared, together.', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'I have been actively serving our community since before my children began school. As a leader of the PTA, youth sports, and fundraising committees, I am passionate about making our town a better place for our children - and for the future.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{
							'width': 33.33
						},
						[]
					]
				]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/keynote/attachments/home-image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignwide size-large'
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 20
						},
						[]
					],
					[
						'core/column',
						{
							'width': 80
						},
						[
							[
								'core/quote',
								{
									'value': '<p>Successful people do what unsuccessful people are simply unwilling to do.</p>',
									'citation': '- Jesse Doe',
									'className': 'is-style-large'
								},
								[]
							]
						]
					]
				]
			],
			[
				'go/features',
				{
					'paddingUnit': 'px',
					'paddingSize': 'no',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'headingLevel': 4,
					'gutter': 'large',
					'columns': 2,
					'contentAlign': 'left',
					'className': 'alignwide go-features-7142041440'
				},
				[
					[
						'go/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'go-feature-71420414465'
						},
						[
							[
								'go/icon',
								{
									'icon': 'globe',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'primary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Background', 'go' ),
									'level': 3,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap': false,
									'placeholder': __( 'Add feature content', 'go' ),
								},
								[]
							]
						]
					],
					[
						'go/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'go-feature-71420414472'
						},
						[
							[
								'go/icon',
								{
									'icon': 'layers',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'primary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Experience', 'go' ),
									'level': 3,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap': false,
									'placeholder': __( 'Add feature content', 'go' ),
								},
								[]
							]
						]
					]
				]
			],
			[
				'go/features',
				{
					'paddingUnit': 'px',
					'paddingSize': 'no',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'headingLevel': 4,
					'gutter': 'large',
					'columns': 2,
					'contentAlign': 'left',
					'className': 'alignwide go-features-7142041440'
				},
				[
					[
						'go/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'go-feature-71420414465'
						},
						[
							[
								'go/icon',
								{
									'icon': 'star',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'primary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Leadership', 'go' ),
									'level': 3,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.', 'go' ),
									'dropCap': false,
									'placeholder': __( 'Add feature content', 'go' ),
								},
								[]
							]
						]
					],
					[
						'go/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'go-feature-71420414472'
						},
						[
							[
								'go/icon',
								{
									'icon': 'scatter_plot',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'primary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Topics', 'go' ),
									'level': 3,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Mark’s story of transforming his own life into a full and successful life is the inspiration behind her topics around teaching others that it is possible to do the same through education. He enjoys teaching the importance of education as a whole.', 'go' ),
									'dropCap': false,
									'placeholder': __( 'Add feature content', 'go' ),
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/group',
				{
					'backgroundColor': 'tertiary',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Your first consultation is on me', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Schedule it today', 'go' ),
							'align': 'center'
						},
						[]
					]
				]
			]
		]
	},

	{
		slug: 'home-four',
		label: __( 'Homepage', 'go' ), // bento
		blocks: [
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignfull size-full is-style-default'
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Bringing the finest culinary food from the heart of Asia directly to you', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/button',
				{

					'text': __( 'View our Menu', 'go' ),
					'align': 'center'
				},
				[]
			],
			[
				'go/shape-divider',
				{
					'align': 'full',
					'height': 100,
					'shapeHeight': 68,
					'backgroundHeight': 20,
					'syncHeight': true,
					'syncHeightAlt': true,
					'verticalFlip': false,
					'horizontalFlip': true,
					'color': 'tertiary',
					'customColor': '#111',
					'noBottomMargin': true,
					'noTopMargin': true,
					'justAdded': false,
					'className': 'alignfull go-shape-divider-8714192337 is-style-angled mb-0'
				},
				[]
			],
			[
				'core/group',
				{
					'backgroundColor': 'tertiary',
					'align': 'full',
					'className': 'mb-0 mt-0'
				},
				[
					[
						'core/paragraph',
						{
							'content': __( '<strong>Sushi Nakazawa</strong>&nbsp;serves the&nbsp;<em>omakase</em>&nbsp;of&nbsp;<strong>Chef Daisuke Nakazawa</strong>. Within the twenty-course meal lies Chef Nakazawa’s passion for sushi. With ingredients sourced both domestically and internationally, the chef crafts a very special tasting menu within the style of Edomae sushi. Chef Nakazawa is a strong believer in the food he serves representing the waters he is surrounded by, so only the best and freshest find its way to your plate.', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': __( 'The relaxed dining experience at Sushi Nakazawa is chic nonetheless. High back leather chairs at the sushi bar coddle you while each course is explained in detail, and every nuance is revealed. Whether an Edomae novice or self-proclaimed sushi foodie, you will leave with a feeling of euphoria.', 'go' ),
							'dropCap': false
						},
						[]
					]
				]
			],
			[
				'go/shape-divider',
				{
					'align': 'full',
					'height': 100,
					'shapeHeight': 69,
					'backgroundHeight': 20,
					'syncHeight': true,
					'syncHeightAlt': true,
					'verticalFlip': true,
					'horizontalFlip': false,
					'color': 'tertiary',
					'customColor': '#111',
					'noBottomMargin': true,
					'noTopMargin': true,
					'justAdded': false,
					'className': 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0'
				},
				[]
			],
			[
				'go/services',
				{
					'columns': 3,
					'gutter': 'medium',
					'alignment': 'center',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-square'
				},
				[
					[
						'go/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-2.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Authentic', 'go' ),
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'The relaxed dining experience at Bento is chic and airy. High back chairs at the sushi bar coddle you for each course.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'go/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-3.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Historical', 'go' ),
									'level': 3,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Housed in the original Yami House, the history behind Bento is amazing. Learn more as you dine in our historical dining room.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'go/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/bento/attachments/home-image-4.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Best-Rated', 'go' ),
									'level': 3,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Bento is one of the best-rated restaurants in the region. With glamourous food and delicious drinks - you won\'t want to miss out!', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'go/shape-divider',
				{
					'align': 'full',
					'height': 100,
					'shapeHeight': 69,
					'backgroundHeight': 20,
					'syncHeight': true,
					'syncHeightAlt': true,
					'verticalFlip': false,
					'horizontalFlip': false,
					'color': 'tertiary',
					'customColor': '#111',
					'noBottomMargin': true,
					'noTopMargin': true,
					'justAdded': false,
					'className': 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0'
				},
				[]
			],
			[
				'core/group',
				{
					'backgroundColor': 'tertiary',
					'align': 'full',
					'className': 'mb-0 mt-0'
				},
				[
					[
						'core/columns',
						{},
						[
							[
								'core/column',
								{
									'width': 18.44
								},
								[]
							],
							[
								'core/column',
								{
									'width': 66.56
								},
								[
									[
										'core/heading',
										{
											'align': 'center',
											'content': __( 'Bento, Steak &amp; Sushi', 'go' ),
											'level': 3
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': __( '123 Example Rd', 'go' ),
											'dropCap': false
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': __( 'Scottsdale, AZ 85260', 'go' ),
											'dropCap': false
										},
										[]
									],
									[
										'core/button',
										{
											'text': __( 'Reservations', 'go' ),
											'align': 'center',
											'className': 'is-style-default'
										},
										[]
									]
								]
							],
							[
								'core/column',
								{
									'width': 15
								},
								[]
							]
						]
					]
				]
			],
			[
				'go/shape-divider',
				{
					'align': 'full',
					'height': 100,
					'shapeHeight': 69,
					'backgroundHeight': 20,
					'syncHeight': true,
					'syncHeightAlt': true,
					'verticalFlip': true,
					'horizontalFlip': true,
					'color': 'tertiary',
					'customColor': '#111',
					'noBottomMargin': true,
					'noTopMargin': true,
					'justAdded': false,
					'className': 'alignfull go-shape-divider-8714192337 is-style-angled mb-0 mt-0'
				},
				[]
			]
		]
	},

	{
		slug: 'home-five',
		label: __( 'Homepage', 'go' ), // everett
		blocks: [
			[
				'coblocks/gallery-masonry',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-1',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-2',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-3',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-4',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-5.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-5',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-6.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-6',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-7.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-7',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-8.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-8',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-9.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-9',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-10.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-10',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-11.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-11',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-12.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-12',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-13.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-13',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-14.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-14',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-15.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-15',
							'caption': []
						}
					],
					'linkTo': 'none',
					'rel': '',
					'align': 'full',
					'gutter': 40,
					'gutterMobile': 15,
					'radius': 0,
					'shadow': 'none',
					'filter': 'none',
					'captions': false,
					'captionStyle': 'dark',
					'primaryCaption': [],
					'backgroundRadius': 0,
					'backgroundPadding': 0,
					'backgroundPaddingMobile': 0,
					'lightbox': true,
					'gridSize': 'lrg',
					'className': 'px'
				},
				[]
			]
		]
	},

	{
		slug: 'home-six',
		label: __( 'Homepage', 'go' ), // fashn
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Be Fashionable Together', 'go' ),
					'level': 1
				},
				[]
			],
			[
				'core/button',
				{

					'text': __( 'Shop Catalogue', 'go' ),
					'borderRadius': 0,
					'align': 'center'
				},
				[]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/fashn/attachments/image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignwide size-full'
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Spring is here, finally', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/media-text',
				{
					'align': 'wide',
					'mediaAlt': '',
					'mediaPosition': 'left',
					'mediaWidth': 50,
					'isStackedOnMobile': true
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Essentials', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': __( 'In fashion, beauty is in the eye of the beholder, but quality should never be a compromise. We are committed to providing you styles that have quality built in and will last through the wear and tear of your day.', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Shop Now', 'go' ),
							'borderRadius': 0,
							'align': 'none'
						},
						[]
					]
				]
			],
			[
				'core/media-text',
				{
					'align': 'wide',
					'mediaAlt': '',
					'mediaPosition': 'left',
					'mediaWidth': 50,
					'isStackedOnMobile': true,
					'className': 'has-media-on-the-right'
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Objects', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': __( 'Our collection of objects of all sorts are sure to please. Objects for the home, objects for the life, objects for your pockets, and objects to wear. While shopping with us, we want you to be completely happy with the experience.', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Shop Now', 'go' ),
							'borderRadius': 0,
							'align': 'center'
						},
						[]
					]
				]
			],
			[
				'core/media-text',
				{
					'align': 'wide',
					'mediaAlt': '',
					'mediaPosition': 'left',
					'mediaWidth': 50,
					'isStackedOnMobile': true
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Home', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': __( 'Our collection of home goods is bound to catch your attention. Style your pad as well as yourself with our second-to-none, curated collection of beautiful home goods.', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Shop Now', 'go' ),
							'borderRadius': 0,
							'align': 'none'
						},
						[]
					]
				]
			]
		]
	},

	{
		slug: 'home-seven',
		label: __( 'Homepage', 'go' ), // figure
		blocks: [
			[
				'core/group',
				{},
				[
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Hello! We\'re a', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Branding &amp; Digital Design<br>Studio in Tokyo', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Let\'s Talk', 'go' ),
							'align': 'center'
						},
						[]
					]
				]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-1',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-2',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-3',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-4',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-5',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull'
				},
				[]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-6.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignfull size-large'
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-7',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-8',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull'
				},
				[]
			],
			[
				'core/group',
				{},
				[
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Need our help?', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'We Create Brands and Inspire Experiences', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Let\'s Talk', 'go' ),
							'align': 'center'
						},
						[]
					]
				]
			]
		]
	},

	{
		slug: 'home-eight',
		label: __( 'Homepage', 'go' ), // furnish
		blocks: [
			[
				'core/group',
				{
					'backgroundColor': 'primary',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Brilliant design.<br>Simplicity in the home.', 'go' ),
							'level': 1
						},
						[]
					],
					[
						'core/image',
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-1.jpg',
							'alt': commonText.imgAlt,
							'caption': '',
							'linkDestination': 'none',
							'className': 'alignwide size-large'
						},
						[]
					]
				]
			],
			[
				'coblocks/media-card',
				{
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'paddingUnit': 'px',
					'paddingSize': 'no',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'mediaPosition': 'left',
					'mediaAlt': '',
					'mediaWidth': 55,
					'align': 'wide',
					'hasImgShadow': false,
					'hasCardShadow': false,
					'className': 'is-style-right is-stacked-on-mobile coblocks-media-card-82315629723'
				},
				[
					[
						'coblocks/row',
						{
							'paddingUnit': 'px',
							'paddingSize': 'large',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': false,
							'hasAlignmentControls': false,
							'hasStackedControl': false,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'customBackgroundColor': '#FFFFFF',
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'columns': 1,
							'layout': '100',
							'gutter': 'medium',
							'className': 'coblocks-row-82315629908'
						},
						[
							[
								'coblocks/column',
								{
									'paddingUnit': 'px',
									'paddingSize': 'no',
									'paddingSyncUnits': false,
									'paddingSyncUnitsTablet': true,
									'paddingSyncUnitsMobile': true,
									'marginUnit': 'px',
									'marginSize': 'no',
									'marginSyncUnits': false,
									'marginSyncUnitsTablet': false,
									'marginSyncUnitsMobile': false,
									'hasMarginControl': true,
									'hasAlignmentControls': true,
									'hasStackedControl': true,
									'backgroundType': 'image',
									'backgroundPosition': 'center center',
									'backgroundRepeat': 'no-repeat',
									'backgroundOverlay': 0,
									'hasParallax': false,
									'videoMuted': true,
									'videoLoop': true,
									'openPopover': false,
									'width': '100',
									'className': 'coblocks-column-82315629936'
								},
								[
									[
										'core/heading',
										{
											'content': __( 'Curating &amp; designing furnishing for your stunning home.', 'go' ),
											'level': 2,
											'placeholder': __( 'Add heading...', 'go' ),
										},
										[]
									],
									[
										'core/button',
										{
											'text': __( 'Shop Now', 'go' ),
										},
										[]
									]
								]
							]
						]
					]
				]
			],
			[
				'coblocks/media-card',
				{
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'paddingUnit': 'px',
					'paddingSize': 'no',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'mediaPosition': 'left',
					'mediaAlt': '',
					'mediaWidth': 55,
					'align': 'wide',
					'hasImgShadow': false,
					'hasCardShadow': false,
					'className': 'is-stacked-on-mobile coblocks-media-card-82315629723'
				},
				[
					[
						'coblocks/row',
						{
							'paddingUnit': 'px',
							'paddingSize': 'large',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': false,
							'hasAlignmentControls': false,
							'hasStackedControl': false,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'customBackgroundColor': '#FFFFFF',
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'columns': 1,
							'layout': '100',
							'gutter': 'medium',
							'className': 'coblocks-row-82315629908'
						},
						[
							[
								'coblocks/column',
								{
									'paddingUnit': 'px',
									'paddingSize': 'no',
									'paddingSyncUnits': false,
									'paddingSyncUnitsTablet': true,
									'paddingSyncUnitsMobile': true,
									'marginUnit': 'px',
									'marginSize': 'no',
									'marginSyncUnits': false,
									'marginSyncUnitsTablet': false,
									'marginSyncUnitsMobile': false,
									'hasMarginControl': true,
									'hasAlignmentControls': true,
									'hasStackedControl': true,
									'backgroundType': 'image',
									'backgroundPosition': 'center center',
									'backgroundRepeat': 'no-repeat',
									'backgroundOverlay': 0,
									'hasParallax': false,
									'videoMuted': true,
									'videoLoop': true,
									'openPopover': false,
									'width': '100',
									'className': 'coblocks-column-82315629936'
								},
								[
									[
										'core/heading',
										{
											'content': __( 'Shop our curated best sellers and top deals.', 'go' ),
											'level': 2,
											'placeholder': __( 'Add heading...', 'go' ),
										},
										[]
									],
									[
										'core/button',
										{
											'text': __( 'Shop Now', 'go' ),
										},
										[]
									]
								]
							]
						]
					]
				]
			],
			[
				'core/quote',
				{
					'value': '<p>“Stop and shop at Furnish to grab all the latest home furnishings” </p>',
					'citation': 'Jenna S.',
					'align': 'center',
					'className': 'is-style-large'
				},
				[]
			],
			[
				'core/cover',
				{
					'hasParallax': false,
					'dimRatio': 50,
					'overlayColor': 'primary',
					'backgroundType': 'image',
					'minHeight': 528,
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Grab our best sellers today', 'go' ),
							'level': 3
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Shop Best Sellers', 'go' ),
							'textColor': 'quaternary',
							'align': 'center',
							'className': 'is-style-outline'
						},
						[]
					]
				]
			]
		]
	},

	{
		slug: 'home-nine',
		label: __( 'Homepage', 'go' ), // miller
		blocks: [
			[
				'core/cover',
				{
					'hasParallax': false,
					'dimRatio': 50,
					'overlayColor': 'tertiary',
					'backgroundType': 'image',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Fearless. Passionate. Experienced.', 'go' ),
							'level': 1,
							'textColor': 'secondary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Helping businesses protect their brand, content and image throughout the world for more than 30 years. We help businesses protect themselves.', 'go' ),
							'dropCap': false,
							'textColor': 'secondary'
						},
						[]
					]
				]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignwide size-large'
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 66.66
						},
						[
							[
								'core/heading',
								{
									'content': __( 'Helping the leaders of successful online businesses protect everything.', 'go' ),
									'level': 2
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality patent, trademark and legal services. The patent and trademark attorneys at Miller &amp; Cole have successfully represented and advised hundreds of clients over the last 20 years.', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'We are confident that our team\'s unique experiences and trademark law focus will absolutely be an asset to your business.', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'text': __( 'Learn More', 'go' ),
									'borderRadius': 0,
									'align': 'none'
								},
								[]
							]
						]
					],
					[
						'core/column',
						{
							'width': 33.33
						},
						[
							[
								'core/paragraph',
								{
									'content': __( '<strong>Contact Us</strong>', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( '123 Example Rd<br>Scottsdale, AZ 85260', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'email@example.com<br>(555) 555-5555', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/group',
				{
					'backgroundColor': 'tertiary',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Our Services', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/spacer',
						{
							'height': 20
						},
						[]
					],
					[
						'core/columns',
						{},
						[
							[
								'core/column',
								{},
								[
									[
										'core/heading',
										{
											'align': 'center',
											'content': __( '<em>Patent Applications</em>', 'go' ),
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': __( 'A provisional patent application can be an effective tool for businesses and individuals seeking to acquire patent rights.', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							],
							[
								'core/column',
								{},
								[
									[
										'core/heading',
										{
											'align': 'center',
											'content': __( '<em>Licensing Agreements</em>', 'go' ),
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': __( 'A license agreement is a legal document used to harness the value of intellectual property - creations of the mind and more.', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							],
							[
								'core/column',
								{},
								[
									[
										'core/heading',
										{
											'align': 'center',
											'content': __( '<em>Copyrights</em>', 'go' ),
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': __( 'A copyright, an important asset to the copyright owner, is a set of exclusive rights granted to the author of an original work. ', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							]
						]
					],
					[
						'core/button',
						{
							'text': __( 'Learn More', 'go' ),
							'borderRadius': 0,
							'align': 'center'
						},
						[]
					]
				]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-2.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-2',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-3',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-4.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/miller/attachments/image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-4',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignwide'
				},
				[]
			]
		]
	},

	{
		slug: 'home-ten',
		label: __( 'Homepage', 'go' ), // nook
		blocks: [
			[
				'core/media-text',
				{
					'align': 'wide',
					'mediaAlt': '',
					'mediaPosition': 'left',
					'mediaWidth': 50,
					'isStackedOnMobile': true,
					'className': 'has-media-on-the-right'
				},
				[
					[
						'core/heading',
						{
							'content': __( 'Find your nook.', 'go' ),
							'level': 1,
							'textColor': 'primary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': __( 'Charming apartment rentals in historic neighborhoods.', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Schedule a Tour', 'go' ),
							'className': 'is-style-outline'
						},
						[]
					]
				]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Only the Best Homes', 'go' ),
					'level': 3
				},
				[]
			],
			[
				'coblocks/gallery-masonry',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-2',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-3',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-4',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-5.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-5',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-6.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-6',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-7.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-7',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-8.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-8',
							'caption': []
						}
					],
					'linkTo': 'none',
					'rel': '',
					'align': 'wide',
					'gutter': 15,
					'gutterMobile': 15,
					'radius': 0,
					'shadow': 'none',
					'filter': 'none',
					'captions': false,
					'captionStyle': 'dark',
					'primaryCaption': [],
					'backgroundRadius': 0,
					'backgroundPadding': 0,
					'backgroundPaddingMobile': 0,
					'lightbox': false,
					'gridSize': 'lrg'
				},
				[]
			],
			[
				'core/group',
				{
					'backgroundColor': 'tertiary',
					'align': 'full'
				},
				[
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Recently Rented Listings', 'go' ),
							'level': 3
						},
						[]
					],
					[
						'core/spacer',
						{
							'height': 20
						},
						[]
					],
					[
						'coblocks/services',
						{
							'columns': 3,
							'gutter': 'medium',
							'alignment': 'none',
							'headingLevel': 3,
							'buttons': false
						},
						[
							[
								'coblocks/service',
								{
									'headingLevel': 3,
									'showCta': false,
									'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-9.jpg',
									'imageAlt': commonText.imgAlt,
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': __( 'Historic Heights', 'go' ),
											'level': 4,
											'placeholder': __( 'Write title...', 'go' ),
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': __( 'Granite counter tops, new cabinets and appliances, and modern lights and fixtures. Two bedroom, one bath.', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							],
							[
								'coblocks/service',
								{
									'headingLevel': 3,
									'showCta': false,
									'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-10.jpg',
									'imageAlt': commonText.imgAlt,
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': __( 'The Legacy', 'go' ),
											'level': 4,
											'placeholder': __( 'Write title...', 'go' ),
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': __( 'One secure, gated garage space is included. Coin-op laundry onsite. Recent kitchenette renovation. One bedroom, one bath.', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							],
							[
								'coblocks/service',
								{
									'headingLevel': 3,
									'showCta': false,
									'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/nook/attachments/image-11.jpg',
									'imageAlt': commonText.imgAlt,
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': __( 'The Cottage', 'go' ),
											'level': 4,
											'placeholder': __( 'Write title...', 'go' ),
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': __( 'Hardwood floors throughout, modern kitchen, gas heat, tons of closet space and recently remodeled bathroom and kitchen.', 'go' ),
											'dropCap': false
										},
										[]
									]
								]
							]
						]
					]
				]
			]
		]
	},

	{
		slug: 'home-eleven',
		label: __( 'Homepage', 'go' ), // salt
		blocks: [
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignfull size-full is-style-top-wave'
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'home-image-2',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/home-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'home-image-3',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull mt-0'
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Welcome to Salt', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': __( 'For over forty years Salt has been known for its luxury lobster, steamed clams, barbecued chicken and homemade clam chowder. Stop on by and grab some of the most incredible seafood you\'ll ever taste.', 'go' ),
					'dropCap': false
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Food &amp; Hours', 'go' ),
					'level': 3
				},
				[]
			],
			[
				'coblocks/features',
				{
					'paddingUnit': 'px',
					'paddingSize': 'no',
					'paddingSyncUnits': false,
					'paddingSyncUnitsTablet': true,
					'paddingSyncUnitsMobile': true,
					'marginUnit': 'px',
					'marginSize': 'no',
					'marginSyncUnits': false,
					'marginSyncUnitsTablet': false,
					'marginSyncUnitsMobile': false,
					'hasMarginControl': true,
					'hasAlignmentControls': true,
					'hasStackedControl': true,
					'backgroundType': 'image',
					'backgroundPosition': 'center center',
					'backgroundRepeat': 'no-repeat',
					'backgroundOverlay': 0,
					'hasParallax': false,
					'videoMuted': true,
					'videoLoop': true,
					'openPopover': false,
					'headingLevel': 4,
					'gutter': 'large',
					'columns': 3,
					'contentAlign': 'center',
					'className': 'alignwide coblocks-features-818134018140'
				},
				[
					[
						'coblocks/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'coblocks-feature-818134018191'
						},
						[
							[
								'coblocks/icon',
								{
									'icon': 'dining',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'secondary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Ocean to Plate', 'go' ),
									'level': 4,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Cajun &amp; creole seafood cuisine, never frozen - delish', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'text': __( 'See Menu', 'go' ),
									'backgroundColor': 'secondary',
									'align': 'center'
								},
								[]
							]
						]
					],
					[
						'coblocks/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'coblocks-feature-818134018197'
						},
						[
							[
								'coblocks/icon',
								{
									'icon': 'waves',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'secondary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Dine with Us', 'go' ),
									'level': 4,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'Mon - Thurs: 5pm - 11pm<br> Fri-Sat: 5pm - Midnight', 'go' ),
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'text': __( 'Dine in', 'go' ),
									'backgroundColor': 'secondary',
									'align': 'center'
								},
								[]
							]
						]
					],
					[
						'coblocks/feature',
						{
							'paddingUnit': 'px',
							'paddingSize': 'no',
							'paddingSyncUnits': false,
							'paddingSyncUnitsTablet': true,
							'paddingSyncUnitsMobile': true,
							'marginUnit': 'px',
							'marginSize': 'no',
							'marginSyncUnits': false,
							'marginSyncUnitsTablet': false,
							'marginSyncUnitsMobile': false,
							'hasMarginControl': true,
							'hasAlignmentControls': true,
							'hasStackedControl': true,
							'backgroundType': 'image',
							'backgroundPosition': 'center center',
							'backgroundRepeat': 'no-repeat',
							'backgroundOverlay': 0,
							'hasParallax': false,
							'videoMuted': true,
							'videoLoop': true,
							'openPopover': false,
							'headingLevel': 4,
							'className': 'coblocks-feature-818134024141'
						},
						[
							[
								'coblocks/icon',
								{
									'icon': 'scatter_plot',
									'iconSize': 'medium',
									'hasContentAlign': false,
									'iconColor': 'secondary',
									'height': 60,
									'width': 60,
									'borderRadius': 0,
									'padding': 0
								},
								[]
							],
							[
								'core/heading',
								{
									'content': __( 'Catering', 'go' ),
									'level': 4,
									'placeholder': __( 'Add feature title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'We cater all events from family reunions, to weddings', 'go' ),
									'dropCap': false,
									'placeholder': __( 'Add feature content', 'go' ),
								},
								[]
							],
							[
								'core/button',
								{
									'text': __( 'Contact', 'go' ),
									'backgroundColor': 'secondary',
									'align': 'center'
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/salt/attachments/footer-image-1.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignfull size-large is-style-top-wave'
				},
				[]
			]
		]
	},
];

export const portfolioLayouts = [
	{
		slug: 'portfolio-one',
		label: __( 'Portfolio', 'go' ),
		blocks: [
			[
				'core/spacer',
				{
					'height': 10,
				},
				[]
			],
			[
				'core/columns',
				{
					'align': 'wide'
				},
				[
					[
						'core/column',
						{
							'width': 20
						},
						[]
					],
					[
						'core/column',
						{
							'width': 60
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Gallery', 'go' ),
									'level': 3,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Connecting audience + artist in our lush, speakeasy-style listening room. Only 50 seats available for this sought-after scene.', 'go' ),
									'dropCap': false,
									'fontWeight': '',
									'textTransform': '',
									'noBottomSpacing': false,
									'noTopSpacing': false
								},
								[]
							]
						]
					],
					[
						'core/column',
						{
							'width': 20
						},
						[]
					]
				]
			],
			[
				'core/image',
				{
					'align': 'wide',
					'url': 'https://user-images.githubusercontent.com/1813435/76585533-fffec900-64b4-11ea-9ba4-fb771f6d7622.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'id': 3,
					'sizeSlug': 'full',
					'linkDestination': 'none',
					'noBottomMargin': false,
					'noTopMargin': false,
					'cropX': 0,
					'cropY': 0,
					'cropWidth': 100,
					'cropHeight': 100,
					'cropRotation': 0
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': '1',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': '2',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'caption': []
						}
					],
					'ids': [
						1,
						2
					],
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'full',
					'align': 'wide',
					'noBottomMargin': true,
					'noTopMargin': true
				},
				[]
			],
			[
				'core/image',
				{
					'align': 'wide',
					'url': 'https://user-images.githubusercontent.com/1813435/76585544-04c37d00-64b5-11ea-93a2-e287301b67f0.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'id': 3,
					'sizeSlug': 'full',
					'linkDestination': 'none',
					'noBottomMargin': true,
					'noTopMargin': true,
					'cropX': 0,
					'cropY': 0,
					'cropWidth': 100,
					'cropHeight': 100,
					'cropRotation': 0
				},
				[]
			]
		]
	},

	{
		slug: 'portfolio-two',
		label: __( 'Portfolio', 'go' ), // everett
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( '“Great photography is about depth of feeling, not depth of field.”', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'coblocks/services',
				{
					'columns': 3,
					'gutter': 'medium',
					'alignment': 'center',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-circle'
				},
				[
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-1.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Portrait', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'I do senior, family, wedding, engagemnet and graduation portraits to capture those memores for a lifetime.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-2.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Maternity', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Lets capture your beautiful bump, grabbing a little snapsnap for your memories before your baby arrives.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-3.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Product', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'A photo shoot to capture the essence of your products, that helps you share your products with the world.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'coblocks/services',
				{
					'columns': 3,
					'gutter': 'medium',
					'alignment': 'center',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-circle'
				},
				[
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-4.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Architectural', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Photography based on wide architectual frames, including shoots for real estate agents looking to sell homes fast.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-5.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Baby', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'Don\'t let those years go by too fast. Let me take photos of your littlest ones, capturing those moments in time.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/gallery-image-6.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Families', 'go' ),
									'level': 5,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'I conduct full on family shoots, either portrait style - or at events like your reunion. You\'re gonna love them!', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'I\'ll capture your best side at your next photoshoot.', 'go' ),
					'level': 2
				},
				[]
			],
			[
				'core/button',
				{

					'text': __( 'Work With Me', 'go' ),
					'align': 'center'
				},
				[]
			]
		]
	},

	{
		slug: 'portfolio-three',
		label: __( 'Portfolio', 'go' ), // figure
		blocks: [
			[
				'core/group',
				{},
				[
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Hello! We\'re a', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'Branding &amp; Digital Design<br>Studio in Tokyo', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Let\'s Talk', 'go' ),
							'align': 'center'
						},
						[]
					]
				]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-1',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-2',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-3',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-4',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-5.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-5',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull'
				},
				[]
			],
			[
				'core/image',
				{
					'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-6.jpg',
					'alt': commonText.imgAlt,
					'caption': '',
					'linkDestination': 'none',
					'className': 'alignfull size-large'
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-7.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-7',
							'caption': ''
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'fullUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/figure/attachments/image-8.jpg',
							'alt': commonText.imgAlt,
							'id': 'image-8',
							'caption': ''
						}
					],
					'ids': [],
					'caption': '',
					'imageCrop': true,
					'linkTo': 'none',
					'sizeSlug': 'large',
					'className': 'alignfull'
				},
				[]
			],
			[
				'core/group',
				{},
				[
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': __( 'Need our help?', 'go' ),
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': __( 'We Create Brands and Inspire Experiences', 'go' ),
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'text': __( 'Let\'s Talk', 'go' ),
							'align': 'center'
						},
						[]
					]
				]
			]
		]
	},

	{
		slug: 'portfolio-four',
		label: __( 'Portfolio', 'go' ), // index
		blocks: [
			[
				'coblocks/gallery-carousel',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-1.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-1',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-2.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-2',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-3.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-3',
							'caption': []
						}
					],
					'linkTo': 'none',
					'rel': '',
					'align': 'full',
					'gutter': 0,
					'gutterMobile': 0,
					'radius': 0,
					'shadow': 'none',
					'filter': 'none',
					'captions': false,
					'captionStyle': 'dark',
					'primaryCaption': [],
					'backgroundRadius': 0,
					'backgroundPadding': 0,
					'backgroundPaddingMobile': 0,
					'lightbox': false,
					'gridSize': 'lrg',
					'height': 560,
					'pageDots': false,
					'prevNextButtons': true,
					'autoPlay': false,
					'autoPlaySpeed': 3000,
					'draggable': true,
					'alignCells': true,
					'pauseHover': false,
					'freeScroll': false,
					'thumbnails': false,
					'responsiveHeight': false,
					'className': 'mb-0'
				},
				[]
			],
			[
				'coblocks/gallery-stacked',
				{
					'images': [
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-4.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-4',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-5.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-5',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-6.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-6',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-7.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-7',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/gallery-image-8.jpg',
							'alt': commonText.imgAlt,
							'id': 'gallery-image-8',
							'caption': []
						}
					],
					'linkTo': 'none',
					'rel': '',
					'align': 'full',
					'gutter': 0,
					'gutterMobile': 0,
					'radius': 0,
					'shadow': 'none',
					'filter': 'none',
					'captions': false,
					'primaryCaption': [],
					'backgroundRadius': 0,
					'backgroundPadding': 0,
					'backgroundPaddingMobile': 0,
					'lightbox': false,
					'fullwidth': true
				},
				[]
			]
		]
	},

	{
		slug: 'portfolio-five',
		label: __( 'Portfolio', 'go' ), // studio
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': __( 'Our Instructors', 'go' ),
					'level': 1
				},
				[]
			],
			[
				'coblocks/services',
				{
					'columns': 2,
					'gutter': 'medium',
					'alignment': 'none',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-threebyfour'
				},
				[
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/image-4.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': __( 'Sally D.', 'go' ),
									'level': 3,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'The cardio leader focuses on classes to help you build your core foundation to maximize cardio intake.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					],
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/index/attachments/image-5.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': __( 'Tom S.', 'go' ),
									'level': 3,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': __( 'The strength leader helps you meld your physical self for an intense workout.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			],
			[
				'coblocks/services',
				{
					'columns': 1,
					'gutter': 'medium',
					'alignment': 'center',
					'headingLevel': 3,
					'buttons': false,
					'className': 'alignwide is-style-threebyfour'
				},
				[
					[
						'coblocks/service',
						{
							'headingLevel': 3,
							'showCta': false,
							'imageUrl': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-6.jpg',
							'imageAlt': commonText.imgAlt,
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': __( 'Sally D.', 'go' ),
									'level': 3,
									'placeholder': __( 'Write title...', 'go' ),
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': __( 'The cardio leader focuses on classes to help you build your core foundation to maximize cardio intake.', 'go' ),
									'dropCap': false
								},
								[]
							]
						]
					]
				]
			]
		]
	},
];

export const templateCategories = [
	{ label: __( 'About', 'go' ), layouts: aboutLayouts },
	{ label: __( 'Contact', 'go' ), layouts: contactLayouts },
	{ label: __( 'Home', 'go' ), layouts: homeLayouts },
	{ label: __( 'Portfolio', 'go' ), layouts: portfolioLayouts },
];
