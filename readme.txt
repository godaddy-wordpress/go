=== Go ===
Contributors: godaddy, richtabor, eherman24, jrtashjian
Tags: one-column, custom-colors, custom-logo, custom-menu, editor-style, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks
Requires at least: 5.0
Tested up to: 5.2
Requires PHP: 5.6.0
Stable tag: 1.2.4
License: GPL-2.0-only
License URI: https://www.gnu.org/licenses/license-list.html#GPLv2

Go is an innovative, Gutenberg-first WordPress theme, hyper-focused on empowering makers to build beautifully rich websites with WordPress.

== Description ==

**Features**

* Responsive Layout
* Multiple Design Styles
* Customize Colors
* Customize Fonts
* Multiple Design Styles
* Social Links Menu
* WooCommerce-Ready
* Available in 29 Languages
* RTL Language Support

**Contributing**

You can fork and contribute back to Go by visiting [our public repo on GitHub](https://github.com/godaddy-wordpress/go).

== Installation ==

1. In your admin panel, navigate to **Appearance > Themes** and click the **Add New** button.
2. Type **Go** in the search form and press the **Enter** key on your keyboard.
3. Click the **Activate** button to begin using Go on your website.
4. In your admin panel, navigate to **Appearance > Customize**.
5. Put the finishing touches on your website by adding a logo, header image, and custom colors.

== Copyright ==

Go WordPress theme, Copyright 2019 GoDaddy Operating Company, LLC.
Go is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

Go bundles the following third-party resources:

Screenshot image #1, Copyright Helena Lopes
License: CC0 1.0 Universal (CC0 1.0) (https://creativecommons.org/publicdomain/zero/1.0/)
Source: https://stocksnap.io/photo/8LHTBAZW32

TGM-Plugin-Activation, Copyright 2011, Thomas Griffin
License: GPLv2 or later
Source: http://tgmpluginactivation.com

CSS-vars-ponyfill, Copyright John Hildenbiddle ([@jhildenbiddle](https://github.com/jhildenbiddle))
License: MIT
Source: https://github.com/jhildenbiddle/css-vars-ponyfill

Lodash, Copyright [Lodash Core Team](https://github.com/orgs/lodash/people)
License: MIT
Source: https://lodash.com

Normalize.css, Copyright Nicolas Gallagher ([@necolas](https://github.com/necolas))
License: MIT
Source: https://github.com/necolas/normalize.css

Bespoke Icons Created For Go
License: Creative Commons Zero (CC0), https://creativecommons.org/publicdomain/zero/1.0/
List of bespoke icons:
- Arrow icons
- Arrow Paginator icon
- Calendar icon
- Carousel arrow icons
- Cart icon
- Checkbox checked icon
- Checkbox icon
- Cross-stich border icon
- Empty Cart icon
- Error icon
- Header and footer icons
- Menu icon
- Search icons
- Shopping Bag icon
- Tags icon

Social Icons
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Source: WordPress Social Link Block (See wp-includes\blocks\social-link.php)

Feather Icons
Copyright (c) 2013-2017 Cole Bemis
License: MIT License, https://opensource.org/licenses/MIT
Source: https://feathericons.com
List of bespoke icons:
- Author icon
- Bookmark icon
- Categories icon
- Comments icon

== Changelog ==

= 1.2.4 / 2020-02-13 =

### Enhancements
* Improve vertical vertical rhythm and spacing. [#451](https://github.com/godaddy-wordpress/go/pull/451)
* Switch from PO/MO to JSON-based translation system. [#459](https://github.com/godaddy-wordpress/go/pull/459)

### Bug Fixes
* Conditionally set menu locations description based on selected footer variation. [#445](https://github.com/godaddy-wordpress/go/pull/445)
* Prevent site header from overlapping the mobile menu. [#449](https://github.com/godaddy-wordpress/go/pull/449)
* Tweak CoBlocks carousel block arrows for Welcoming, Trendy and Playful design styles. [#452](https://github.com/godaddy-wordpress/go/pull/452)
* Fix gallery caption alignment. [#461](https://github.com/godaddy-wordpress/go/pull/461)
* Hide previously open menu items when a new one is opened. [#464](https://github.com/godaddy-wordpress/go/pull/464)

= 1.2.3 =
* Add jQuery as a dependency of `frontend.js`.

= 1.2.2 =
* Set `is_automatic` to false in `includes/tgm.php`.
* Removed excess, unused, files.
* Removed `font-family` from global `p` element. @props [Danny Cooper](https://github.com/DannyCooper)
* Renamed 'Colors' panel title in the customizer to 'Site Design'.
* Remove `esc_attr()` from `searchform.php`.
* Swap `esc_attr_x()` for `esc_html_x()` in `searchform.php`.
* Update theme `screenshot.png` and add attribution for image used in screenshot.
* Add attribution for node dependencies in `readme.txt`.
* Refactor `primary-menu.js` and `search-toggle.js` to lock tab focus to the main menu and the search form, respectively.

= 1.2.1 =
* Refactor `woo-menu-cart.js` to resolve JavaScript error on non-shop sites.
* Remove the `href` attribute from the cart slide out button element.
* Disable the WooCommerce slide out cart when on the cart page.

= 1.2.0 =
* Introduce breadcrumbs and post navigation in single product templates.
* Fix output of archive page title.
* Tweak product navigation.
* Fix shop page title visibility.
* Introduce WooCommerce cart menu icon and slide out cart.
* Fix empty cart message icon.
* Tweak variation styles.
* Update 'Clear' reset variations link text.
* Update comments in design style CSS files.
* Fix Playful design style default header text color.
* Update headers and theme responsiveness.
* Add variants to `--header-padding` values.
* Improved site search bar.
* Fix submenu item word wrap.
* Typecast all Go filters to return data in the expected format.
* Add an `aria-label` to the navigation cart link.
* Revert all PHP array shorthand syntax.
* Update unit test suite.
* Fix unscoped jQuery for WordPress 5.3 compatibility.
* Fix code sniffs.
* Fix dashboard fatal error on `shop_order` post type.

= 1.1.1 =
* Introduce additional design styles.

= 1.1.0 =
* Initial release.
