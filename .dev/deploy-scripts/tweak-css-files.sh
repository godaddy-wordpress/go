#!/bin/bash

# Strip non /*! comments from unminified CSS files and beautify
for f in $(find ./dist/css -type f -name '*.css' ! -name '*.min.css')
do
	echo "Cleaning $f file of comments..."
	echo "$(npx strip-css-comments $f)" > $f
	./node_modules/.bin/perfectionist $f $f
done

# Group similar media queries using mqpicker package
for f in $(find ./dist/css -type f -name '*.css' ! -name '*.min.css')
do
	echo "Grouping like media queries in $f..."
	./node_modules/.bin/mqpacker $f $f
done
