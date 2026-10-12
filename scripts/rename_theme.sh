#!/bin/bash

# Script to rename the theme, theme files, config.
# Should be started from the theme directory.

# Get current theme directory and name
THEME_DIR=$(pwd)

# Identify old name by looking for the .info.yml file
OLD_NAME=$(ls *.info.yml 2>/dev/null | head -n 1 | sed 's/\.info\.yml//')

if [ -z "$OLD_NAME" ]; then
    echo "Error: Could not find a .info.yml file in the current directory."
    echo "This script must be run from the theme root directory."
    exit 1
fi

echo "Current theme name is: $OLD_NAME"
read -p "Enter new theme name (machine_name): " NEW_NAME

# Validate new name
if [[ ! "$NEW_NAME" =~ ^[a-z][a-z0-9_]*$ ]]; then
    echo "Error: Theme name must start with a letter and contain only lowercase letters, numbers, and underscores."
    exit 1
fi

if [ "$OLD_NAME" == "$NEW_NAME" ]; then
    echo "New name is same as old name. Nothing to do."
    exit 0
fi

# Convert names to PascalCase for PHP classes/namespaces
old_pascal=$(echo "$OLD_NAME" | sed -r 's/(^|_)([a-z])/\U\2/g')
new_pascal=$(echo "$NEW_NAME" | sed -r 's/(^|_)([a-z])/\U\2/g')

echo "Renaming $OLD_NAME to $NEW_NAME..."

# 1. Rename files and directories
find . -maxdepth 4 -name "*${OLD_NAME}*" | while read file; do
    new_file=$(echo "$file" | sed "s/${OLD_NAME}/${NEW_NAME}/g")
    if [ "$file" != "$new_file" ]; then
        mkdir -p "$(dirname "$new_file")"
        mv "$file" "$new_file"
    fi
done

# 2. Update PascalCase filenames (e.g. CustomBs5Hooks.php)
find . -maxdepth 5 -name "*${old_pascal}*" | while read file; do
    new_file=$(echo "$file" | sed "s/${old_pascal}/${new_pascal}/g")
    if [ "$file" != "$new_file" ]; then
        mv "$file" "$new_file"
    fi
done

# 3. Replace content (machine name)
grep -rl "$OLD_NAME" . --exclude-dir=node_modules --exclude=scripts/rename_theme.sh | xargs sed -i "s/${OLD_NAME}/${NEW_NAME}/g"

# 4. Replace content (PascalCase)
grep -rl "$old_pascal" . --exclude-dir=node_modules --exclude=scripts/rename_theme.sh | xargs sed -i "s/${old_pascal}/${new_pascal}/g"

# 5. Update theme name in .info.yml (the 'name' key)
info_file="${NEW_NAME}.info.yml"
if [ -f "$info_file" ]; then
    # Try to make a human-friendly name from the machine name
    human_name=$(echo "$NEW_NAME" | sed -r 's/(^|_)([a-z])/\U\2/g' | sed 's/\([A-Z]\)/ \1/g' | sed 's/^ //')
    sed -i "s/^name:.*/name: $human_name/" "$info_file"
fi

echo "Theme successfully renamed to $NEW_NAME"
echo "Note: The directory name itself has not been changed. You may want to rename it manually to match the new theme name if you haven't already."
echo "Suggested action: cd .. && mv $OLD_NAME $NEW_NAME"
