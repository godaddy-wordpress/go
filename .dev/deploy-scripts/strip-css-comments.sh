#!/bin/bash

for f in $(find ./dist/css -type f -name "*.css")
do
	echo "Cleaning $f file of comments..."
	#!/bin/bash
	CONTENT=$(strip-css-comments $f)
	echo "$CONTENT" > $f
done
# awk '/^--/ {next} /^\/\*/ && /\*\/$/{next} /^\/\*/{c=1;next} /\*\/$/{c=0;next} !c{FS="--|\/\*";a=$1;FS="\\*\\/";a=a$2;$0=a;print}'
