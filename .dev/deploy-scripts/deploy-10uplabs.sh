#!/bin/bash

# Catch Errors
set -euo pipefail

rsync -vrxc --delete ./ gitlab@10uplabs.com:/var/www/html/wordpress/godaddy/wp-content/themes/godaddy-theme/ --exclude-from=$CI_PROJECT_DIR/.dev/deploy-scripts/rsync-excludes.txt --exclude-from=$CI_PROJECT_DIR/.dev/deploy-scripts/rsync-excludes-10uplabs.txt
