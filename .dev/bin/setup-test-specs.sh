#!/usr/bin/env bash

# Allow files to be passed into the script
CHANGEDFILES=${@-$(git diff --name-only origin/master)}
SPECS=()
SPECSTRING=''

for FILE in $CHANGEDFILES
do
	# Changed file matches /.dev/assets/design-styles/*
	if [[ $FILE == *".dev/assets/design-styles/"* ]]; then
		testSpec=$(echo $FILE | cut -d'/' -f4)
		foundwords=$(echo ${SPECS[@]} | grep -o "${testSpec}" | wc -w)
		# The test spec does not yet exist in the SPECS array
		if [[ "${testSpec}" -eq 0 ]]; then
			# Spec file string is empty, do not start string with a ,
			if [[ ${#SPECSTRING} -eq 0 ]]; then
				SPECSTRING=".dev/tests/cypress/integration/visual-regression/*-$testSpec.spec.js"
			else
				SPECSTRING="${SPECSTRING},.dev/tests/cypress/integration/visual-regression/*-$testSpec.spec.js"
			fi
			SPECS=( "${SPECS[@]}" "${testSpec}" )
		fi
	fi
done

# No spec files to run
if [ ${#SPECS[@]} -eq 0 ]; then
	echo "Changes do not require visual regression testing."
	circleci-agent step halt
	exit
fi

printf "\n\033[0;33mRunning the following Cypress spec files: ${SPECS[*]}\033[0m\n"

# Store $SPECSTRING value in /tmp/specstring file for later use
echo $SPECSTRING > /tmp/specstring
