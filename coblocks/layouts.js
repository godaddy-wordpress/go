/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

export const aboutLayouts = [
	{
		slug: 'about-one',
		label: __( 'About', 'go' ), // everett
		blocks: [
			[
				'core/heading',
				{
					'align': 'center',
					'content': 'Hi, I’m Everett',
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': 'A tenacious, loving and energetic photographer who enjoys grabbing her camera and running out to take some photos.',
					'dropCap': false
				},
				[]
			],
			[
				'core/button',
				{
					'url': '{{contact-page:permalink}}',
					'text': 'Work With Me',
					'align': 'center'
				},
				[]
			],
			[
				'core/gallery',
				{
					'images': [
						{
							'url': '{{about-image-1:file}}',
							'alt': '{{about-image-1:post_content}}',
							'id': '{{about-image-1}}',
							'caption': ''
						},
						{
							'url': '{{about-image-2:file}}',
							'link': '{{about-image-2:permalink}}',
							'alt': '{{about-image-2:post_content}}',
							'id': '{{about-image-2}}',
							'caption': ''
						},
						{
							'url': '{{about-image-3:file}}',
							'fullUrl': '{{about-image-3:file}}',
							'link': '{{about-image-3:permalink}}',
							'alt': '{{about-image-3:post_content}}',
							'id': '{{about-image-3}}',
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
									'content': 'Early on',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'I am so fascinated by photography and it’s capability to bring your imagination to amazing places. Early on, I fell in love with the idea of filming my own productions, so I set out to learn everything I could about storytelling through photos.',
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
									'content': 'Current',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'I have been teaching myself filmmaking for the past four and a half years and I’m still learning every day. I am building my business as a freelance filmmaker, as well as working on my own photo shoots.',
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
							'content': 'Protecting your ideas',
							'level': 1,
							'textColor': 'secondary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality legal services and exceptional customer service.&nbsp;&nbsp;',
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
									'content': 'Quality Results',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'Our goal is to create assets from our clients’ innovations through patent, trademark and copyright law.&nbsp; We take great pride in providing quality trademark legal services and exceptional customer service every single day. We\'re absolutely here for you.',
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
									'content': 'Experienced',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'The attorneys at Miller &amp; Cole work as a team to exceed each of our clients’ expectations. We have 30+ years of high-level experience helping businesses protecting the time, money and resources spent developing ideas and inventions.',
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
					'url': '{{image-5:file}}',
					'alt': '{{image-5:post_content}}',
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
									'content': 'Contact',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Office: (555) 555-5555<br>email@example.com',
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
									'content': 'Location',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '123 Example Rd<br>Scottsdale, AZ 85260',
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
									'content': 'Connect',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '<a href="https://twitter.com">Twitter</a><br><a href="https://www.facebook.com">Facebook</a><br>',
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
					'content': 'Let\'s get in touch',
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': 'Well hello there, wonderful, fabulous&nbsp;you!&nbsp;If you’d like to get in touch with me, please feel free to give me a call at (555) 555-5555, or send a message with the form down below. Either way, I\'ll be in touch shortly!',
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
							'imageUrl': '{{contact-image-1:file}}',
							'imageAlt': '{{contact-image-1:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '<em>"I appreciate Everett\'s ability to compose visually stunning photos, brining my memories to live every time I look at them. I couldn\'t be more happier!"</em>',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '- Larina H.',
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
							'imageUrl': '{{contact-image-2:file}}',
							'imageAlt': '{{contact-image-2:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '<em>"Everett should be nominated for photographer of the year. I am so pleased with her photography at my wedding. She’s wonderful!"</em>',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '- Kam V.',
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
							'imageUrl': '{{contact-image-3:file}}',
							'imageAlt': '{{contact-image-3:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '<em>"Everett knew exactly how to pull the best of me out, and into a beautiful portrait. I\'m so glad I met Everett - she\'s my go-to photographer now!"</em>',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': '- Jerri S.',
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
					'content': 'Contact Us',
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
									'content': 'Contact',
									'level': 5
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Studio Gym<br>123 Example Rd, Scottsdale, AZ 85260<br>(555) 555-5555',
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
									'content': 'Gym Hours',
									'level': 5
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Mon-Fri: 8:00 - 21:00<br>Sat: 8:00 - 20:00<br>Sun: 10:00 - 14:00<br>– Holidays off –',
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
							'url': '{{image-3:file}}',
							'fullUrl': '{{image-3:file}}',
							'link': '{{image-3:permalink}}',
							'alt': '{{image-3:post_content}}',
							'id': '{{image-3}}',
							'caption': ''
						},
						{
							'url': '{{image-1:file}}',
							'fullUrl': '{{image-1:file}}',
							'link': '{{image-1:permalink}}',
							'alt': '{{image-1:post_content}}',
							'id': '{{image-1}}',
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
					'alt': 'Image description',
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
									'content': 'Enjoy Live Music + the Best Coffee You\'ve Ever Had',
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
									'content': 'Connecting audience + artist in our lush, speakeasy-style listening room. Only 50 seats available for this sought-after scene.',
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
							'imageAlt': 'Image description',
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': 'A social house',
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
									'content': 'With our guides\' experience, we will not only get you to where the fish are - but we\'ll get you hooked on them too. Our crew is knowledgeable and friendly - ready to take you on the trip of your dreams.',
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
							'imageAlt': 'Image description',
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': 'A listening room',
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
									'content': 'Folks have fought some monster bluefin tuna on standup gear with our offshore fishing packager, which is an incredible challenge for sure! Stick to the shoreline and test your strength pulling in some biggies!',
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
					'alt': 'Image description',
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
					'content': 'Our approach reflects the people we serve. We are diverse, yet the same.',
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
					'text': 'Learn More',
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
							'alt': 'Image description',
							'id': '1',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'alt': 'Image description',
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
									'content': 'When we set up shop with an espresso machine up front and a roaster in the back, we hoped to some day be a part of New York\'s rich tradition of service and culinary achievement. Everyday this aspiration drives us.',
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
									'content': 'The city\'s energy binds us together. It drives us to be the best.',
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
									'content': 'This fairly new coffee shop, conveniently located in downtown Scottsdale, is one of the best coffee shops I\'ve ever been to, and trust me when I say, I\'ve been to many. The owners and the staff will make you feel like an old friend or even family.',
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
									'text': 'Grab a cup',
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
					'alt': 'Image description',
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
							'content': 'Hi, I\'m Mark Cannon. A life coach &amp; mentor in Scottsdale.',
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
									'url': '{{about-page:permalink}}',
									'text': 'About Me'
								},
								[]
							],
							[
								'core/button',
								{
									'url': '{{contact-page:permalink}}',
									'text': 'Contact Me',
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
									'content': 'My Message',
									'level': 2
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'With a school-age daughter of my own, it is of the utmost importance that we keep pushing for changes in our schools, better study spaces for our kids, affordable after-school programs, and healthy lunches. Our children are the next generation, let\'s make sure they\'re prepared, together.',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'I have been actively serving our community since before my children began school. As a leader of the PTA, youth sports, and fundraising committees, I am passionate about making our town a better place for our children - and for the future.',
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
					'url': '{{home-image-1:file}}',
					'alt': '{{home-image-1:post_content}}',
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
									'content': 'Background',
									'level': 3,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.',
									'dropCap': false,
									'placeholder': 'Add feature content'
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
									'content': 'Experience',
									'level': 3,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.',
									'dropCap': false,
									'placeholder': 'Add feature content'
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
									'content': 'Leadership',
									'level': 3,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'As Founder and Chief Executive Officer of Keynote, Mark has helped develop workshops and programs that have transformed the lives of men and women, and altered the course of education throughout the country and across the world.',
									'dropCap': false,
									'placeholder': 'Add feature content'
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
									'content': 'Topics',
									'level': 3,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'Mark’s story of transforming his own life into a full and successful life is the inspiration behind her topics around teaching others that it is possible to do the same through education. He enjoys teaching the importance of education as a whole.',
									'dropCap': false,
									'placeholder': 'Add feature content'
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
							'content': 'Your first consultation is on me',
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Schedule it today',
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
					'url': '{{home-image-1:file}}',
					'alt': '{{home-image-1:post_content}}',
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
					'content': 'Bringing the finest culinary food from the heart of Asia directly to you',
					'level': 2
				},
				[]
			],
			[
				'core/button',
				{
					'url': '{{menu-page:permalink}}',
					'text': 'View our Menu',
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
							'content': '<strong>Sushi Nakazawa</strong>&nbsp;serves the&nbsp;<em>omakase</em>&nbsp;of&nbsp;<strong>Chef Daisuke Nakazawa</strong>. Within the twenty-course meal lies Chef Nakazawa’s passion for sushi. With ingredients sourced both domestically and internationally, the chef crafts a very special tasting menu within the style of Edomae sushi. Chef Nakazawa is a strong believer in the food he serves representing the waters he is surrounded by, so only the best and freshest find its way to your plate.',
							'dropCap': false
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': 'The relaxed dining experience at Sushi Nakazawa is chic nonetheless. High back leather chairs at the sushi bar coddle you while each course is explained in detail, and every nuance is revealed. Whether an Edomae novice or self-proclaimed sushi foodie, you will leave with a feeling of euphoria.',
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
							'imageUrl': '{{home-image-2:file}}',
							'imageAlt': '{{home-image-2:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Authentic',
									'level': 3
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'The relaxed dining experience at Bento is chic and airy. High back chairs at the sushi bar coddle you for each course.',
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
							'imageUrl': '{{home-image-3:file}}',
							'imageAlt': '{{home-image-3:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Historical',
									'level': 3,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Housed in the original Yami House, the history behind Bento is amazing. Learn more as you dine in our historical dining room.',
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
							'imageUrl': '{{home-image-4:file}}',
							'imageAlt': '{{home-image-4:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Best-Rated',
									'level': 3,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Bento is one of the best-rated restaurants in the region. With glamourous food and delicious drinks - you won\'t want to miss out!',
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
											'content': 'Bento, Steak &amp; Sushi',
											'level': 3
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': '123 Example Rd',
											'dropCap': false
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': 'Scottsdale, AZ 85260',
											'dropCap': false
										},
										[]
									],
									[
										'core/button',
										{
											'url': '{{contact-page:permalink}}',
											'text': 'Reservations',
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
							'url': '{{gallery-image-1:file}}',
							'link': '{{gallery-image-1:permalink}}',
							'alt': '{{gallery-image-1:post_content}}',
							'id': '{{gallery-image-1}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-2:file}}',
							'link': '{{gallery-image-2:permalink}}',
							'alt': '{{gallery-image-2:post_content}}',
							'id': '{{gallery-image-2}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-3:file}}',
							'link': '{{gallery-image-3:permalink}}',
							'alt': '{{gallery-image-3:post_content}}',
							'id': '{{gallery-image-3}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-4:file}}',
							'link': '{{gallery-image-4:permalink}}',
							'alt': '{{gallery-image-4:post_content}}',
							'id': '{{gallery-image-4}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-5:file}}',
							'link': '{{gallery-image-5:permalink}}',
							'alt': '{{gallery-image-5:post_content}}',
							'id': '{{gallery-image-5}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-6:file}}',
							'link': '{{gallery-image-6:permalink}}',
							'alt': '{{gallery-image-6:post_content}}',
							'id': '{{gallery-image-6}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-7:file}}',
							'link': '{{gallery-image-7:permalink}}',
							'alt': '{{gallery-image-7:post_content}}',
							'id': '{{gallery-image-7}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-8:file}}',
							'link': '{{gallery-image-8:permalink}}',
							'alt': '{{gallery-image-8:post_content}}',
							'id': '{{gallery-image-8}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-9:file}}',
							'link': '{{gallery-image-9:permalink}}',
							'alt': '{{gallery-image-9:post_content}}',
							'id': '{{gallery-image-9}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-10:file}}',
							'link': '{{gallery-image-10:permalink}}',
							'alt': '{{gallery-image-10:post_content}}',
							'id': '{{gallery-image-10}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-11:file}}',
							'link': '{{gallery-image-11:permalink}}',
							'alt': '{{gallery-image-11:post_content}}',
							'id': '{{gallery-image-11}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-12:file}}',
							'link': '{{gallery-image-12:permalink}}',
							'alt': '{{gallery-image-12:post_content}}',
							'id': '{{gallery-image-12}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-13:file}}',
							'link': '{{gallery-image-13:permalink}}',
							'alt': '{{gallery-image-13:post_content}}',
							'id': '{{gallery-image-13}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-14:file}}',
							'link': '{{gallery-image-14:permalink}}',
							'alt': '{{gallery-image-14:post_content}}',
							'id': '{{gallery-image-14}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-15:file}}',
							'link': '{{gallery-image-15:permalink}}',
							'alt': '{{gallery-image-15:post_content}}',
							'id': '{{gallery-image-15}}',
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
					'content': 'Be Fashionable Together',
					'level': 1
				},
				[]
			],
			[
				'core/button',
				{
					'url': '{{shop-page:permalink}}',
					'text': 'Shop Catalogue',
					'borderRadius': 0,
					'align': 'center'
				},
				[]
			],
			[
				'core/image',
				{
					'url': '{{image-1:file}}',
					'alt': '{{image-1:post_content}}',
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
					'content': 'Spring is here, finally',
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
							'content': 'Essentials',
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': 'In fashion, beauty is in the eye of the beholder, but quality should never be a compromise. We are committed to providing you styles that have quality built in and will last through the wear and tear of your day.',
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{shop-page:permalink}}',
							'text': 'Shop Now',
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
							'content': 'Objects',
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': 'Our collection of objects of all sorts are sure to please. Objects for the home, objects for the life, objects for your pockets, and objects to wear. While shopping with us, we want you to be completely happy with the experience.',
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{shop-page:permalink}}',
							'text': 'Shop Now',
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
							'content': 'Home',
							'level': 2
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': 'Our collection of home goods is bound to catch your attention. Style your pad as well as yourself with our second-to-none, curated collection of beautiful home goods.',
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{shop-page:permalink}}',
							'text': 'Shop Now',
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
							'content': 'Hello! We\'re a',
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': 'Branding &amp; Digital Design<br>Studio in Tokyo',
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Let\'s Talk',
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
							'url': '{{image-1:file}}',
							'alt': '{{image-1:post_content}}',
							'id': '{{image-1}}',
							'caption': ''
						},
						{
							'url': '{{image-2:file}}',
							'link': '{{image-2:permalink}}',
							'alt': '{{image-2:post_content}}',
							'id': '{{image-2}}',
							'caption': ''
						},
						{
							'url': '{{image-3:file}}',
							'fullUrl': '{{image-3:file}}',
							'link': '{{image-3:permalink}}',
							'alt': '{{image-3:post_content}}',
							'id': '{{image-3}}',
							'caption': ''
						},
						{
							'url': '{{image-4:file}}',
							'fullUrl': '{{image-4:file}}',
							'link': '{{image-4:permalink}}',
							'alt': '{{image-4:post_content}}',
							'id': '{{image-4}}',
							'caption': ''
						},
						{
							'url': '{{image-5:file}}',
							'fullUrl': '{{image-5:file}}',
							'link': '{{image-5:permalink}}',
							'alt': '{{image-5:post_content}}',
							'id': '{{image-5}}',
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
					'url': '{{image-6:file}}',
					'alt': '{{image-6:post_content}}',
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
							'url': '{{image-7:file}}',
							'fullUrl': '{{image-7:file}}',
							'link': '{{image-7:permalink}}',
							'alt': '{{image-7:post_content}}',
							'id': '{{image-7}}',
							'caption': ''
						},
						{
							'url': '{{image-8:file}}',
							'fullUrl': '{{image-8:file}}',
							'link': '{{image-8:permalink}}',
							'alt': '{{image-8:post_content}}',
							'id': '{{image-8}}',
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
							'content': 'Need our help?',
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': 'We Create Brands and Inspire Experiences',
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Let\'s Talk',
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
							'content': 'Brilliant design.<br>Simplicity in the home.',
							'level': 1
						},
						[]
					],
					[
						'core/image',
						{
							'url': '{{image-1:file}}',
							'alt': '{{image-1:post_content}}',
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
											'content': 'Curating &amp; designing furnishing for your stunning home.',
											'level': 2,
											'placeholder': 'Add heading...'
										},
										[]
									],
									[
										'core/button',
										{
											'url': '{{shop-page:permalink}}',
											'text': 'Shop Now'
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
											'content': 'Shop our curated best sellers and top deals.',
											'level': 2,
											'placeholder': 'Add heading...'
										},
										[]
									],
									[
										'core/button',
										{
											'url': '{{shop-page:permalink}}',
											'text': 'Shop Now'
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
							'content': 'Grab our best sellers today',
							'level': 3
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{shop-page:permalink}}',
							'text': 'Shop Best Sellers',
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
							'content': 'Fearless. Passionate. Experienced.',
							'level': 1,
							'textColor': 'secondary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'align': 'center',
							'content': 'Helping businesses protect their brand, content and image throughout the world for more than 30 years. We help businesses protect themselves.',
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
					'url': '{{image-1:file}}',
					'alt': '{{image-1:post_content}}',
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
									'content': 'Helping the leaders of successful online businesses protect everything.',
									'level': 2
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'Miller &amp; Cole is tremendously proud of the impact that we have made in helping our clients by providing quality patent, trademark and legal services. The patent and trademark attorneys at Miller &amp; Cole have successfully represented and advised hundreds of clients over the last 20 years.',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'We are confident that our team\'s unique experiences and trademark law focus will absolutely be an asset to your business.',
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'url': '{{about-page:permalink}}',
									'text': 'Learn More',
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
									'content': '<strong>Contact Us</strong>',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': '123 Example Rd<br>Scottsdale, AZ 85260',
									'dropCap': false
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'email@example.com<br>(555) 555-5555',
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
							'content': 'Our Services',
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
											'content': '<em>Patent Applications</em>',
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': 'A provisional patent application can be an effective tool for businesses and individuals seeking to acquire patent rights.',
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
											'content': '<em>Licensing Agreements</em>',
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': 'A license agreement is a legal document used to harness the value of intellectual property - creations of the mind and more.',
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
											'content': '<em>Copyrights</em>',
											'level': 4
										},
										[]
									],
									[
										'core/paragraph',
										{
											'align': 'center',
											'content': 'A copyright, an important asset to the copyright owner, is a set of exclusive rights granted to the author of an original work. ',
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
							'url': '{{about-page:permalink}}',
							'text': 'Learn More',
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
							'url': '{{image-2:file}}',
							'fullUrl': '{{image-2:file}}',
							'link': '{{image-2:permalink}}',
							'alt': '{{image-2:post_content}}',
							'id': '{{image-2}}',
							'caption': ''
						},
						{
							'url': '{{image-3:file}}',
							'fullUrl': '{{image-3:file}}',
							'link': '{{image-3:permalink}}',
							'alt': '{{image-3:post_content}}',
							'id': '{{image-3}}',
							'caption': ''
						},
						{
							'url': '{{image-4:file}}',
							'fullUrl': '{{image-4:file}}',
							'link': '{{image-4:permalink}}',
							'alt': '{{image-4:post_content}}',
							'id': '{{image-4}}',
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
							'content': 'Find your nook.',
							'level': 1,
							'textColor': 'primary'
						},
						[]
					],
					[
						'core/paragraph',
						{
							'content': 'Charming apartment rentals in historic neighborhoods.',
							'dropCap': false
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Schedule a Tour',
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
					'content': 'Only the Best Homes',
					'level': 3
				},
				[]
			],
			[
				'coblocks/gallery-masonry',
				{
					'images': [
						{
							'url': '{{image-2:file}}',
							'link': '{{image-2:permalink}}',
							'alt': '{{image-2:post_content}}',
							'id': '{{image-2}}',
							'caption': []
						},
						{
							'url': '{{image-3:file}}',
							'link': '{{image-3:permalink}}',
							'alt': '{{image-3:post_content}}',
							'id': '{{image-3}}',
							'caption': []
						},
						{
							'url': '{{image-4:file}}',
							'link': '{{image-4:permalink}}',
							'alt': '{{image-4:post_content}}',
							'id': '{{image-4}}',
							'caption': []
						},
						{
							'url': '{{image-5:file}}',
							'link': '{{image-5:permalink}}',
							'alt': '{{image-5:post_content}}',
							'id': '{{image-5}}',
							'caption': []
						},
						{
							'url': '{{image-6:file}}',
							'link': '{{image-6:permalink}}',
							'alt': '{{image-6:post_content}}',
							'id': '{{image-6}}',
							'caption': []
						},
						{
							'url': '{{image-7:file}}',
							'link': '{{image-7:permalink}}',
							'alt': '{{image-7:post_content}}',
							'id': '{{image-7}}',
							'caption': []
						},
						{
							'url': '{{image-8:file}}',
							'link': '{{image-8:permalink}}',
							'alt': '{{image-8:post_content}}',
							'id': '{{image-8}}',
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
							'content': 'Recently Rented Listings',
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
									'imageUrl': '{{image-9:file}}',
									'imageAlt': '{{image-9:post_content}}',
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': 'Historic Heights',
											'level': 4,
											'placeholder': 'Write title...'
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': 'Granite counter tops, new cabinets and appliances, and modern lights and fixtures. Two bedroom, one bath.',
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
									'imageUrl': '{{image-10:file}}',
									'imageAlt': '{{image-10:post_content}}',
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': 'The Legacy',
											'level': 4,
											'placeholder': 'Write title...'
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': 'One secure, gated garage space is included. Coin-op laundry onsite. Recent kitchenette renovation. One bedroom, one bath.',
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
									'imageUrl': '{{image-11:file}}',
									'imageAlt': '{{image-11:post_content}}',
									'alignment': 'none'
								},
								[
									[
										'core/heading',
										{
											'content': 'The Cottage',
											'level': 4,
											'placeholder': 'Write title...'
										},
										[]
									],
									[
										'core/paragraph',
										{
											'content': 'Hardwood floors throughout, modern kitchen, gas heat, tons of closet space and recently remodeled bathroom and kitchen.',
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
					'url': '{{home-image-1:file}}',
					'alt': '{{home-image-1:post_content}}',
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
							'url': '{{home-image-2:file}}',
							'link': '{{home-image-2:permalink}}',
							'alt': '{{home-image-2:post_content}}',
							'id': '{{home-image-2}}',
							'caption': ''
						},
						{
							'url': '{{home-image-3:file}}',
							'fullUrl': '{{home-image-3:file}}',
							'link': '{{home-image-3:permalink}}',
							'alt': '{{home-image-3:post_content}}',
							'id': '{{home-image-3}}',
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
					'content': 'Welcome to Salt',
					'level': 2
				},
				[]
			],
			[
				'core/paragraph',
				{
					'align': 'center',
					'content': 'For over forty years Salt has been known for its luxury lobster, steamed clams, barbecued chicken and homemade clam chowder. Stop on by and grab some of the most incredible seafood you\'ll ever taste.',
					'dropCap': false
				},
				[]
			],
			[
				'core/heading',
				{
					'align': 'center',
					'content': 'Food &amp; Hours',
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
									'content': 'Ocean to Plate',
									'level': 4,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'Cajun &amp; creole seafood cuisine, never frozen - delish',
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'url': '{{menu-page:permalink}}',
									'text': 'See Menu',
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
									'content': 'Dine with Us',
									'level': 4,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'Mon - Thurs: 5pm - 11pm<br> Fri-Sat: 5pm - Midnight',
									'dropCap': false
								},
								[]
							],
							[
								'core/button',
								{
									'url': '{{contact-page:permalink}}',
									'text': 'Dine in',
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
									'content': 'Catering',
									'level': 4,
									'placeholder': 'Add feature title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'We cater all events from family reunions, to weddings',
									'dropCap': false,
									'placeholder': 'Add feature content'
								},
								[]
							],
							[
								'core/button',
								{
									'url': '{{contact-page:permalink}}',
									'text': 'Contact',
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
					'url': '{{footer-image-1:file}}',
					'alt': '{{footer-image-1:post_content}}',
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
									'content': 'Gallery',
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
									'content': 'Connecting audience + artist in our lush, speakeasy-style listening room. Only 50 seats available for this sought-after scene.',
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
					'alt': 'Image description',
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
							'alt': 'Image description',
							'id': '1',
							'link': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-2.jpg',
							'caption': []
						},
						{
							'url': 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/barista/attachments/home-image-3.jpg',
							'alt': 'Image description',
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
					'alt': 'Image description',
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
					'content': '“Great photography is about depth of feeling, not depth of field.”',
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
							'imageUrl': '{{gallery-image-1:file}}',
							'imageAlt': '{{gallery-image-1:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Portrait',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'I do senior, family, wedding, engagemnet and graduation portraits to capture those memores for a lifetime.',
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
							'imageUrl': '{{gallery-image-2:file}}',
							'imageAlt': '{{gallery-image-2:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Maternity',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Lets capture your beautiful bump, grabbing a little snapsnap for your memories before your baby arrives.',
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
							'imageUrl': '{{gallery-image-3:file}}',
							'imageAlt': '{{gallery-image-3:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Product',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'A photo shoot to capture the essence of your products, that helps you share your products with the world.',
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
							'imageUrl': '{{gallery-image-4:file}}',
							'imageAlt': '{{gallery-image-4:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Architectural',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Photography based on wide architectual frames, including shoots for real estate agents looking to sell homes fast.',
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
							'imageUrl': '{{gallery-image-5:file}}',
							'imageAlt': '{{gallery-image-5:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Baby',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'Don\'t let those years go by too fast. Let me take photos of your littlest ones, capturing those moments in time.',
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
							'imageUrl': '{{gallery-image-6:file}}',
							'imageAlt': '{{gallery-image-6:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Families',
									'level': 5,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'I conduct full on family shoots, either portrait style - or at events like your reunion. You\'re gonna love them!',
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
					'content': 'I\'ll capture your best side at your next photoshoot.',
					'level': 2
				},
				[]
			],
			[
				'core/button',
				{
					'url': '{{contact-page:permalink}}',
					'text': 'Work With Me',
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
							'content': 'Hello! We\'re a',
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': 'Branding &amp; Digital Design<br>Studio in Tokyo',
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Let\'s Talk',
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
							'url': '{{image-1:file}}',
							'alt': '{{image-1:post_content}}',
							'id': '{{image-1}}',
							'caption': ''
						},
						{
							'url': '{{image-2:file}}',
							'link': '{{image-2:permalink}}',
							'alt': '{{image-2:post_content}}',
							'id': '{{image-2}}',
							'caption': ''
						},
						{
							'url': '{{image-3:file}}',
							'fullUrl': '{{image-3:file}}',
							'link': '{{image-3:permalink}}',
							'alt': '{{image-3:post_content}}',
							'id': '{{image-3}}',
							'caption': ''
						},
						{
							'url': '{{image-4:file}}',
							'fullUrl': '{{image-4:file}}',
							'link': '{{image-4:permalink}}',
							'alt': '{{image-4:post_content}}',
							'id': '{{image-4}}',
							'caption': ''
						},
						{
							'url': '{{image-5:file}}',
							'fullUrl': '{{image-5:file}}',
							'link': '{{image-5:permalink}}',
							'alt': '{{image-5:post_content}}',
							'id': '{{image-5}}',
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
					'url': '{{image-6:file}}',
					'alt': '{{image-6:post_content}}',
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
							'url': '{{image-7:file}}',
							'fullUrl': '{{image-7:file}}',
							'link': '{{image-7:permalink}}',
							'alt': '{{image-7:post_content}}',
							'id': '{{image-7}}',
							'caption': ''
						},
						{
							'url': '{{image-8:file}}',
							'fullUrl': '{{image-8:file}}',
							'link': '{{image-8:permalink}}',
							'alt': '{{image-8:post_content}}',
							'id': '{{image-8}}',
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
							'content': 'Need our help?',
							'dropCap': false
						},
						[]
					],
					[
						'core/heading',
						{
							'align': 'center',
							'content': 'We Create Brands and Inspire Experiences',
							'level': 2
						},
						[]
					],
					[
						'core/button',
						{
							'url': '{{contact-page:permalink}}',
							'text': 'Let\'s Talk',
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
							'url': '{{gallery-image-1:file}}',
							'link': '{{gallery-image-1:permalink}}',
							'alt': '{{gallery-image-1:post_content}}',
							'id': '{{gallery-image-1}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-2:file}}',
							'link': '{{gallery-image-2:permalink}}',
							'alt': '{{gallery-image-2:post_content}}',
							'id': '{{gallery-image-2}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-3:file}}',
							'link': '{{gallery-image-3:permalink}}',
							'alt': '{{gallery-image-3:post_content}}',
							'id': '{{gallery-image-3}}',
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
							'url': '{{gallery-image-4:file}}',
							'link': '{{gallery-image-4:permalink}}',
							'alt': '{{gallery-image-4:post_content}}',
							'id': '{{gallery-image-4}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-5:file}}',
							'link': '{{gallery-image-5:permalink}}',
							'alt': '{{gallery-image-5:post_content}}',
							'id': '{{gallery-image-5}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-6:file}}',
							'link': '{{gallery-image-6:permalink}}',
							'alt': '{{gallery-image-6:post_content}}',
							'id': '{{gallery-image-6}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-7:file}}',
							'link': '{{gallery-image-7:permalink}}',
							'alt': '{{gallery-image-7:post_content}}',
							'id': '{{gallery-image-7}}',
							'caption': []
						},
						{
							'url': '{{gallery-image-8:file}}',
							'link': '{{gallery-image-8:permalink}}',
							'alt': '{{gallery-image-8:post_content}}',
							'id': '{{gallery-image-8}}',
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
					'content': 'Our Instructors',
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
							'imageUrl': '{{image-4:file}}',
							'imageAlt': '{{image-4:post_content}}',
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': 'Sally D.',
									'level': 3,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'The cardio leader focuses on classes to help you build your core foundation to maximize cardio intake.',
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
							'imageUrl': '{{image-5:file}}',
							'imageAlt': '{{image-5:post_content}}',
							'alignment': 'none'
						},
						[
							[
								'core/heading',
								{
									'content': 'Tom S.',
									'level': 3,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'content': 'The strength leader helps you meld your physical self for an intense workout.',
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
							'imageUrl': '{{image-6:file}}',
							'imageAlt': '{{image-6:post_content}}',
							'alignment': 'center'
						},
						[
							[
								'core/heading',
								{
									'align': 'center',
									'content': 'Sally D.',
									'level': 3,
									'placeholder': 'Write title...'
								},
								[]
							],
							[
								'core/paragraph',
								{
									'align': 'center',
									'content': 'The cardio leader focuses on classes to help you build your core foundation to maximize cardio intake.',
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
