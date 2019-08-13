#!/bin/bash

if [ "$NODE_ENV" = 'production' ];
then
	return;
fi

echo "NODE ENVIRONMENT:"
echo $NODE_ENV

for f in $(find ./dist/css -type f -name "*.css")
do
	echo "Cleaning $f file of comments..."
	#!/bin/bash
	CONTENT=$(npx strip-css-comments --no-preserve $f)
	echo "$CONTENT" > $f
	npx perfectionist $f $f
done
