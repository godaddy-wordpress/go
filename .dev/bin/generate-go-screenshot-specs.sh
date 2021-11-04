#! /bin/bash

set -o errexit
set -o nounset

URLS=$(curl -sS https://wpnux.godaddy.com/v2/api/templates | jq -r '.[].styles[].preview_url')

for URL in $URLS; do
    params=(${URL//[=&]/ })

    template=${params[1]}
    style=${params[3]}

    preview_url=$(printf '%q' "$URL")
    spec_filename="${template}-${style}.spec.js"

    sed "s/{{TEMPLATE}}/$template/g; s/{{STYLE}}/$style/g; s,{{PREVIEW_URL}},$preview_url,g;" .dev/tests/cypress/vr-template.stub > ".dev/tests/cypress/integration/visual-regression/${spec_filename}"
done
