#!/bin/bash

set -e

sudo apt-get update && sudo apt-get install subversion
sudo -E docker-php-ext-install mysqli
sudo sh -c "printf '\ndeb http://ftp.us.debian.org/debian sid main\n' >> /etc/apt/sources.list"
sudo apt-get update && sudo apt-get install mysql-client-5.7

export WP_CORE_DIR=/tmp/wordpress
mkdir -p $WP_CORE_DIR
cd $WP_CORE_DIR

php /tmp/wp.phar core download --version=$WP_VERSION
php /tmp/wp.phar config create \
	--dbname=wordpress \
	--dbuser=root \
	--dbpass="" \
	--skip-check

php /tmp/wp.phar db create
php /tmp/wp.phar core install \
	--url=http://test.dev \
	--title="WordPress Site" \
	--admin_user=admin \
	--admin_password=password \
	--admin_email=admin@test.dev \
	--skip-email

php /tmp/wp.phar package install anhskohbo/wp-cli-themecheck
php /tmp/wp.phar plugin install theme-check --activate

export INSTALL_PATH=$WP_CORE_DIR/wp-content/themes/maverick
mkdir -p $INSTALL_PATH
rsync -av --exclude-from ./.distignore --delete ./ $INSTALL_PATH/
