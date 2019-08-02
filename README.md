# A WordPress theme for GoDaddy

__Description:__ GoDaddy wanted the ability for a single WordPress theme to encompass several design styles (aka moods). This theme uses the Customizer to apply different design styles based on the user's selection.

Also included within the theme:

* [TGM Plugin Activation](http://tgmpluginactivation.com/) library - used to help onboard users to install necessary plugin dependencies. Including:
    * [WooCommerce](https://wordpress.org/plugins/woocommerce/) plugin
	* [CoBlocks](https://wordpress.org/plugins/coblocks/) plugin - Page Builder Gutenberg Blocks

## Asset organization

Since we're dealing with mini-themes (aka design styles) within a theme. Here is an overview of the asset organization:

``` bash
|—— assets/
    |—— admin/         Customizer and WP admin assets
        |—— css/
        |—— images/
        |—— js/
    |-- design-styles/  Each Design Style assets
        |—— modern/
            |—— css/
            |—— fonts/
            |—— images/
        |—— play/
        |—— traditional/
        |—— trendy-shop/
        |—— welcoming/
    |—— shared           Global and shared assets
        |—— css/
            |—— coblocks/
            |—— components/
            |—— config/
            |—— blocks/
            |—— editor/
            |—— elements/  Generic HTML element coverage
            |—— layout/    Layout specific
            |—— templates/ WordPress template specific
            |—— utilities/
            |—— woocommerce/
            |—— editor-style.css Gutenberg editor styles
            |—— shared-style.css Imports all of the above
        |—— images/
        |—— js/
            |—— frontend/
                |—— components/
                |—— utility/
                |—— vendor/
                |—— frontend.js Imports most of the above
        |—— svg/
```
