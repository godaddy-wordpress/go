#!/bin/bash

for f in $(find ./dist/css -type f -name "*.css")
do
	echo "Cleaning $f file of comments..."
	CONTENT=$(npx strip-css-comments --no-preserve $f)
	echo "$CONTENT" > $f
	npx perfectionist $f $f
done
