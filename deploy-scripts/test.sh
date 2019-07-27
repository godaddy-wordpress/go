#!/bin/bash

# Print commands to the screen
set -x

# Catch Errors
set -euo pipefail

# These commands assume the 10up scaffolds are used. Change to match your build process
# The specific commands run can be found in package.json under scripts -> lint-release
npm run lint-release

# Stop printing commands to screen
set +x
