#!/bin/bash

found_todos=''
RED='\033[0;31m'
NC='\033[0m'

# If we have a STDIN, use it, otherwise get one
if tty >/dev/null 2>&1; then
    TTY=$(tty)
else
    TTY=/dev/tty
fi

IFS=$'\n'

ask() {
    while true; do

        if [ "${2:-}" = "Y" ]; then
            prompt="Y/n"
            default=Y
        elif [ "${2:-}" = "N" ]; then
            prompt="y/N"
            default=N
        else
            prompt="y/n"
            default=
        fi

        # Ask the question (not using "read -p" as it uses stderr not stdout)
        echo -n "$1 [$prompt] "

        # Read the answer
        read REPLY < "$TTY"

        # Default?
        if [ -z "$REPLY" ]; then
            REPLY=$default
        fi

        # Check if the reply is valid
        case "$REPLY" in
            Y*|y*) return 0 ;;
            N*|n*) return 1 ;;
        esac

    done
}

check_file() {
    local file=$1
    local match_pattern=$2

    # Scan the file contents for any matching patterns
    local file_contents=$(cat $file | grep $match_pattern)

    if [ -n "$file_contents" ]; then
        found_todos='true'
        echo ""
        echo -e "$file match '$match_pattern':" | tr -d '\n'

        for matched_line in $file_contents
        do
            echo -e "${RED}"
            echo -e "$matched_line" | sed -e 's/^[[:space:]]*//'
            echo -e "${NC}"
        done
    fi
}

# Actual hook logic:
MATCH=( '@todo' '@TODO' )
CSS_FILES=$(find . -type f -name '*.css' ! -name '*.min.css' -not -path "./node_modules/*" -not -path "./.dist/*")
PHP_FILES=$(find . -type f -name '*.php' -not -path "./includes/classes/class-tgm-plugin-activation.php" -not -path "./node_modules/*")
JS_FILES=$(find . -type f -name '*.js' ! -name '*.min.js' -not -path "./node_modules/*" -not -path "./.dist/*")

# Combine all files into a single array
FILES=("${CSS_FILES[@]}" "${PHP_FILES[@]}" "${JS_FILES[@]}")

for file in ${FILES[@]}; do
    for match_pattern in ${MATCH[@]}
    do
        check_file $file $match_pattern
    done
done

if [ -n "$found_todos" ]; then
    if ask "Found @todo comments. Should we continue with this commit?"; then
        echo 'Continuing'
    else
        echo "Not committing. Finish the @todo's and re-commit."
        exit 1
    fi
fi
