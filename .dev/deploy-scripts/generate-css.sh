#!/bin/bash

# Production: Generated unminified versions of each CSS file
if [ "$NODE_ENV" == 'production' ];
then
	for f in $(find ./dist/css -type f -name "*.min.css")
	do
		echo "Generating an unminified version of $f"
		npx perfectionist $f ${f/.min/}
	done
fi

# Dev: Generated minified versions of each CSS file
if [ "$NODE_ENV" == 'development' ];
then
	for f in $(find ./dist/css -type f -name "*.css")
	do
		echo "Generating a minified version of $f"
		npx uglifycss $f > ${f/.css/.min.css}
	done
fi
