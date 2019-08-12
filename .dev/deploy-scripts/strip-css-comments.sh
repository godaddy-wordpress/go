#!/bin/bash

for f in $(find ./dist/css -type f -name "*.css")
do
	echo "Cleaning $f file of comments..."
	#!/bin/bash
	CONTENT=$(strip-css-comments $f)
	echo "$CONTENT" > $f
done
