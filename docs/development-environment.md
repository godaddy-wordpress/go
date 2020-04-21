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

## Installing development tools

Scripts and styles are compiled using Webpack and a number of node packages. These can be quickly and easily installed using `npm`.

Run `npm install` to install all of the development dependencies.

Next you'll want to install the composer dependencies.

`composer install`

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

---

# Unit-testing

- Todo

## PHP unit tests

- Todo

---

# Linting, standards, etc.

## Coding standards

- Todo

## Linting

- Todo

* ### Linting Go's JavaScript

	- Todo

* ### Linting Go's PHP

	- Todo
