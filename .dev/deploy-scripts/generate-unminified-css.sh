#!/bin/bash

for f in $(find ./dist/css -type f -name "*.min.css")
do
	echo "Generating an unminified version of $f"
	npx perfectionist $f ${f/.min/}
done
