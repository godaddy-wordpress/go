#!/bin/bash

# Print commands to the screen
set -x

# Catch Errors
set -euo pipefail

# These commands assume the 10up scaffolds are used. Change to match your build process
# Information on the build-release command can be found here: https://github.com/10up/theme-scaffold#npm-commands
# The specific commands run can be found in package.json under scripts -> build-release
# composer install --no-dev -o
# npm install
# grunt
npm run build-release

# Stop printing commands to screen
set +x
