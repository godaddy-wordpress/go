#!/bin/bash

set -e

sudo apt-get update && sudo apt-get install subversion
sudo -E docker-php-ext-install mysqli
sudo sh -c "printf '\ndeb http://ftp.us.debian.org/debian sid main\n' >> /etc/apt/sources.list"
sudo apt-get update && sudo apt-get install mysql-client-5.7

export WP_CORE_DIR=/tmp/wordpress
mkdir -p $WP_CORE_DIR
cd $WP_CORE_DIR

wp core download
wp config create \
	--dbname=wordpress \
	--dbuser=root \
	--dbpass="" \
	--dbhost=127.0.0.1 \
	--skip-check

wp db create
wp core install \
	--url=http://maverick.test \
	--title="WordPress Site" \
	--admin_user=admin \
	--admin_password=password \
	--admin_email=admin@maverick.test \
	--skip-email

if [ "$CIRCLE_JOB" == 'theme-check' ]; then
	php -d memory_limit=1024M "$(which wp)" package install anhskohbo/wp-cli-themecheck
	wp plugin install theme-check --activate
fi

if [ "$CIRCLE_JOB" == 'a11y-tests' ]; then
	# sudo rm /etc/apache2/mods-enabled/php5.load
	sudo cp ~/project/.dev/tests/apache-ci.conf /etc/apache2/sites-available
	sudo a2ensite apache-ci.conf
	sudo service apache2 restart
	wp db import ~/project/.dev/tests/a11y-test-db.sql --path=/tmp/wordpress
fi

export INSTALL_PATH=$WP_CORE_DIR/wp-content/themes/maverick
mkdir -p $INSTALL_PATH
rsync -av --exclude-from ~/project/.distignore --delete ~/project/. $INSTALL_PATH/
