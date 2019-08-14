#!/bin/bash

for f in $(find ./dist/css -type f -name "*.css")
do
	echo "Cleaning $f file of comments..."
	echo "$(npx strip-css-comments $f)" > $f
	npx perfectionist $f $f
done
