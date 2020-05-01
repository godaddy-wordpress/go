# Development Environment

## Table of contents

* [Setting up your environment](#setting-up-your-environment)
	* [Installing development tools](#installing-development-tools)
* [Start development](#development-workflow)
	 * [Run a build](#building-go)
* [Unit Testing](#unit-testing)
	 * [PHP unit testing](#php-unit-tests)
* [Linting, standards, etc.](#linting-standards-etc)
	* [Coding standards](#coding-standards)
	* [Linting](#linting)

# Setting up your development environment

## Define `SCRIPT_DEBUG`

When developing locally with Go, you should set the `SCRIPT_DEBUG` constant inside of your `wp-config.php` file to `true`. This ensures that all of the unminified files are loaded, since none of the minified js/css files exist in the theme until you run a final production build.

```php
define( 'SCRIPT_DEBUG', true );
```

## Installing development tools

Scripts and styles are compiled using Webpack and a number of node packages. These can be quickly and easily installed using `npm`.

To install all of the Go dependencies, you can run the two commands:

```sh
$ npm run setup
```

If you are introducing or altering any styles, you'll most likely want to setup

`.dev/config/webpack.settings.js`

# Development workflow

To start work on the Go theme you need to follow these steps:

1. [Clone the repository](#clone-the-repository)
2. [Install the development tools](#installing-development-tools)
3. Make sure Go is enabled on your WordPress site
4. [Build Go](#building-go)

## Clone the repository

Make sure you have `git`, `node`, `composer`, and a working WordPress installation.
Clone this repository inside your local install theme directory.

```sh
git@github.com:godaddy-wordpress/go.git
cd go
```

 You'll need to have a public SSH key setup with GitHub, which is more secure than saving your password in your keychain.
 There are more details about [setting up a public key on GitHub.com](https://help.github.com/en/articles/adding-a-new-ssh-key-to-your-github-account).

## Building Go

To work on Go you need to build the JavaScript and CSS components of the theme. This will compile all of the scripts and styles into the `/dist` directory.

There are two types of builds:

* ### Development & Production build/Continuous build
	The standard development build will compile necessary JavaScript and CSS files. To build Go like this run:

	```sh
	npm run build
	```

	By default the development build above will run once and if you change any of the files, you need to run `npm run build` again to see the changes on the site. If you want to avoid that, you can run a continuous build that will rebuild anytime it sees any changes on your local filesystem. To run it, use:

	```sh
	npm run start
	```

	To build an installable zip of the theme, use:
	```sh
	npm run package
	```

#### BrowserSync

Go leverages BrowserSync to inject styles into the DOM as you are working, so you don't have to continuously refresh the page after making small CSS tweaks.

After running `npm run start`, anytime you change alter any of the `.scss` files in the `.dev/assets/` they will be recompiled and BrowserSync will inject the new styles into the DOM. Our webpack configuration file proxys the requests to `https://go.test`. You most likely do not have your site setup at this address locally.

If you are using a different URL, you'll need to update the proxy value inside of the [webpack config file](https://github.com/godaddy-wordpress/go/blob/master/.dev/config/webpack.settings.js#L78).

> **Important:** Do not commit these changes with your PR.

---

# Unit Testing

Go includes several unit tests that you can run in your local environment before submitting a new Pull Request. We like to maintain 100% code coverage at all times, when possible. So, writing unit tests for any new code introduced into Go is a must.

If you're not familiar with writing unit tests, or are uncomfortable doing so, don't worry - you can still issue a Pull Request and one of our developers will help out with the unit tests.

To get started, there are several ways to run the unit tests, depending on how you set up your development environment.

## PHP Unit Tests

We bundle PHPUnit locally with Go as a composer package. This makes installing PHPUnit and running unit tests much simpler. You can install PHPUnit by running the following in the command line:

```sh
$ composer install
```

Once PHPUnit is installed, you'll need to install the WordPress test library, and create a new, empty, test database. We have included a bash script with Go to make this process a bit more streamlined. You can execute install the WordPress test library with the following commnad:

```sh
$ composer install-phpunit
```

This composer command runs the [local-install-wp-tests.sh](https://github.com/godaddy-wordpress/go/blob/master/.dev/deploy-scripts/install-wp-tests.sh) script.

When you have the WordPress test instance setup, you can run the unit tests with the following composer command.

```sh
$ composer test
```

##### Advanced Usage:

You can generate code coverage reports to get a better understanding of where coverage exists, and where you need to write tests.

This can be done by executing the PHPUnit composer package directly with a `--coverage-html` flag, and a path to the directory you want the coverage reports saved to.

```sh
$ ./vendor/bin/phpunit --coverage-html=/tmp/go
```

This will take a little bit more time than just running the tests, but once the coverage reports are generated you can open them with the following command:

```sh
$ open /tmp/go/index.html
```

---

# Linting, standards, etc.

## Coding standards

We strongly recommend that you install tools to review your code in your IDE of choice. It will make it easier for you to notice any missing documentation or invalid/incorrect coding standards which you should respect. Most IDEs display warnings and notices inside the editor, making it even easier.

- You can find [Code Sniffer rules for WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#installation) here. Once you've installed these rulesets, you can [follow the instructions here](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#how-to-use) to configure your IDE.

- For JavaScript, we recommend installing [ESLint](https://eslint.org/). Most IDEs come with an ESLint plugin that you can use. Go includes a .eslintrc.js file that defines our coding standards.

## Linting

* ### Linting Go's PHP

We bundle PHPCS locally as a composer package, so installing PHPCS and linting your code is quick and easy. You can install PHPCS with the following command:

This will install all the CodeSniffer rulesets we need for linting Go's PHP code.

```sh
$ composer install
```

Then, to lint Go's PHP code, run the following command:

```sh
composer lint
```
