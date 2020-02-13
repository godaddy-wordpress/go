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

# Generate a -rtl file
for f in $(find ./dist/css -type f -name '*.css')
do
	# Do not -rtl an -rtl file...
	if [[ $f == *"-rtl"* ]]; then
		continue
	fi
	echo "Generating RTL file for: $f"
	if [[ $f == *".min.css"* ]]; then
		OutputFilename=${f/.min.css/-rtl.min.css}
	else
		OutputFilename=${f/.css/-rtl.css}
	fi
	./node_modules/.bin/rtlcss $f $OutputFilename
done
