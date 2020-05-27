<?php

add_filter('coblocks_layout_selector_layouts', function($layouts)
{
    $layouts[] = array(
        'slug' => 'contact-one',
        'label' => __('Contact', 'go'),
        'blocks' => array(
            array(
                'core/heading',
                array(
                    'align' => 'center',
                    'content' => __('Let\'s get in touch', 'go'),
                    'level' => 2
                ),
                array()
            ),
            array(
                'core/paragraph',
                array(
                    'align' => 'center',
                    'content' => __('Well hello there, wonderful, fabulous&nbsp;you!&nbsp;If you’d like to get in touch with me, please feel free to give me a call at (555) 555-5555, or send a message with the form down below. Either way, I\'ll be in touch shortly!', 'go'),
                    'dropCap' => false
                ),
                array()
            ),
            array(
                'coblocks/form',
                array(
                    'subject' => null,
                    'to' => null
                ),
                array(
                    array(
                        'coblocks/field-name',
                        array(
                            'label' => 'Name',
                            'required' => false,
                            'hasLastName' => false,
                            'labelFirstName' => 'First',
                            'labelLastName' => 'Last'
                        ),
                        array()
                    ),
                    array(
                        'coblocks/field-email',
                        array(
                            'label' => 'Email',
                            'required' => true
                        ),
                        array()
                    ),
                    array(
                        'coblocks/field-textarea',
                        array(
                            'label' => 'Message',
                            'required' => true
                        ),
                        array()
                    )
                )
            ),
            array(
                'coblocks/services',
                array(
                    'columns' => 3,
                    'gutter' => 'medium',
                    'alignment' => 'center',
                    'headingLevel' => 3,
                    'buttons' => false,
                    'className' => 'alignwide is-style-circle'
                ),
                array(
                    array(
                        'coblocks/service',
                        array(
                            'headingLevel' => 3,
                            'showCta' => false,
                            'imageUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-1.jpg',
                            'imageAlt' => __('Image description', 'go'),
                            'alignment' => 'center'
                        ),
                        array(
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('<em>"I appreciate Everett\'s ability to compose visually stunning photos, brining my memories to live every time I look at them. I couldn\'t be more happier!"</em>', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            ),
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('- Larina H.', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            )
                        )
                    ),
                    array(
                        'coblocks/service',
                        array(
                            'headingLevel' => 3,
                            'showCta' => false,
                            'imageUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-2.jpg',
                            'imageAlt' => __('Image description', 'go'),
                            'alignment' => 'center'
                        ),
                        array(
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('<em>"Everett should be nominated for photographer of the year. I am so pleased with her photography at my wedding. She’s wonderful!"</em>', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            ),
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('- Kam V.', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            )
                        )
                    ),
                    array(
                        'coblocks/service',
                        array(
                            'headingLevel' => 3,
                            'showCta' => false,
                            'imageUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/everett/attachments/contact-image-3.jpg',
                            'imageAlt' => __('Image description', 'go'),
                            'alignment' => 'center'
                        ),
                        array(
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('<em>"Everett knew exactly how to pull the best of me out, and into a beautiful portrait. I\'m so glad I met Everett - she\'s my go-to photographer now!"</em>', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            ),
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('- Jerri S.', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            )
                        )
                    )
                )
            )
        )
    );
    $layouts[] = array(
        'slug' => 'contact-two',
        'label' => __('Contact', 'go'), // studio
        'blocks' => array(
            array(
                'core/heading',
                array(
                    'align' => 'center',
                    'content' => __('Contact Us', 'go'),
                    'level' => 1
                ),
                array()
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
                                    'align' => 'center',
                                    'content' => __('Contact', 'go'),
                                    'level' => 5
                                ),
                                array()
                            ),
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('Studio Gym<br>123 Example Rd, Scottsdale, AZ 85260<br>(555) 555-5555', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            )
                        )
                    ),
                    array(
                        'core/column',
                        array(),
                        array(
                            array(
                                'core/heading',
                                array(
                                    'align' => 'center',
                                    'content' => __('Gym Hours', 'go'),
                                    'level' => 5
                                ),
                                array()
                            ),
                            array(
                                'core/paragraph',
                                array(
                                    'align' => 'center',
                                    'content' => __('Mon-Fri => 8:00 - 21:00<br>Sat => 8:00 - 20:00<br>Sun => 10:00 - 14:00<br>– Holidays off –', 'go'),
                                    'dropCap' => false
                                ),
                                array()
                            )
                        )
                    )
                )
            ),
            array(
                'coblocks/form',
                array(
                    'subject' => null,
                    'to' => null
                ),
                array(
                    array(
                        'coblocks/field-name',
                        array(
                            'label' => 'Name',
                            'required' => false,
                            'hasLastName' => false,
                            'labelFirstName' => 'First',
                            'labelLastName' => 'Last'
                        ),
                        array()
                    ),
                    array(
                        'coblocks/field-email',
                        array(
                            'label' => 'Email',
                            'required' => true
                        ),
                        array()
                    ),
                    array(
                        'coblocks/field-textarea',
                        array(
                            'label' => 'Message',
                            'required' => true
                        ),
                        array()
                    )
                )
            ),
            array(
                'core/gallery',
                array(
                    'images' => array(
                        array(
                            'url' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-3.jpg',
                            'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-3.jpg',
                            'alt' => __('Image description', 'go'),
                            'id' => 'image-3',
                            'caption' => ''
                        ),
                        array(
                            'url' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-1.jpg',
                            'fullUrl' => 'https://wpnux.godaddy.com/v2/wp-content/mu-plugins/wpnux/starter-content/templates/studio/attachments/image-1.jpg',
                            'alt' => __('Image description', 'go'),
                            'id' => 'image-1',
                            'caption' => ''
                        )
                    ),
                    'ids' => array(),
                    'caption' => '',
                    'imageCrop' => true,
                    'linkTo' => 'none',
                    'sizeslug' => 'large',
                    'className' => 'alignfull'
                ),
                array()
            )
        )
    );
    
    return $layouts;
});