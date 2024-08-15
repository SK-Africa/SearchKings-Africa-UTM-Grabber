#!/bin/bash

# Variables
PLUGIN_DIR="."
TEMP_DIR="${PLUGIN_DIR}-temp"
ZIP_FILE="sk-utm-grabber.zip"

# Function to validate version number
validate_version() {
    if [[ ! $1 =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
        echo "Invalid version number. Please use semantic versioning (e.g., 1.2.3)."
        exit 1
    fi
}

# Read the current version from the PHP file
current_version=$(grep "define( 'SKA_UTM_GRABBER_VERSION'" $PLUGIN_DIR/ska-utm-grabber.php | sed "s/.*'\(.*\)'.*/\1/")

# Check if version was found
if [ -z "$current_version" ]; then
    echo "Error: Could not find current version in ska-utm-grabber.php"
    exit 1
fi

# Display current version and prompt for new version
echo "Current version is $current_version"
read -p "Enter new version number (or press enter to keep current version): " new_version

# Initialize variables
changelog_entry=""
commit_message=""

# If a new version is provided, update files
if [ ! -z "$new_version" ]; then
    # Validate the new version
    validate_version $new_version

    # Update the version constant in the PHP file
    sed -i "s/define( 'SKA_UTM_GRABBER_VERSION', '.*' )/define( 'SKA_UTM_GRABBER_VERSION', '$new_version' )/" $PLUGIN_DIR/ska-utm-grabber.php

    # Update the version in the plugin header
    sed -i "s/Version: .*/Version: $new_version/" $PLUGIN_DIR/ska-utm-grabber.php

    # Update the version in the README.md file
    sed -i "s/Version: .*/Version: $new_version/" $PLUGIN_DIR/README.md

    # Update the changelog in README.md
    today=$(date +%Y-%m-%d)
    sed -i "/## Changelog/a \n### [$new_version] - $today\n- " $PLUGIN_DIR/README.md

    # Prompt for changelog entry
    echo "Enter changelog entry for version $new_version:"
    read changelog_entry

    # Add the changelog entry
    sed -i "/### \[$new_version\] - $today/a - $changelog_entry" $PLUGIN_DIR/README.md

    echo "Version updated to $new_version"

    # Prompt for commit message
    echo "Enter a commit message (press enter to use default message):"
    read custom_commit_message

    if [ ! -z "$custom_commit_message" ]; then
        commit_message="$custom_commit_message"
    else
        commit_message="Bump version to $new_version"
    fi
fi

# Step 1: Clean up any previous builds
echo "Cleaning up previous builds..."
rm -rf "$TEMP_DIR" "$ZIP_FILE"

# Step 2: Copy the plugin directory to a temporary location
echo "Copying plugin directory to temporary location..."
if [ -d "$PLUGIN_DIR" ]; then
    cp -r "$PLUGIN_DIR" "$TEMP_DIR"
else
    echo "Error: Directory $PLUGIN_DIR does not exist."
    exit 1
fi

# Step 3: Ensure all necessary directories exist
echo "Ensuring all necessary directories exist..."
mkdir -p "${TEMP_DIR}/assets/css"
mkdir -p "${TEMP_DIR}/assets/js"
mkdir -p "${TEMP_DIR}/assets/images"
mkdir -p "${TEMP_DIR}/includes"
mkdir -p "${TEMP_DIR}/languages"

# Step 4: Remove unnecessary files from the temporary copy
echo "Removing unnecessary files..."
rm -rf "${TEMP_DIR}/.git"
rm -f "${TEMP_DIR}/build-plugin.sh"

# Step 5: Create the ZIP file
echo "Creating ZIP file..."
if [ -d "$TEMP_DIR" ]; then
    (cd "$TEMP_DIR" && zip -r "../$ZIP_FILE" .)
else
    echo "Error: Temporary directory $TEMP_DIR does not exist."
    exit 1
fi

# Step 6: Clean up the temporary copy
echo "Cleaning up temporary files..."
rm -rf "$TEMP_DIR"

echo "Build completed successfully. ZIP file created: $ZIP_FILE"

# Optional: Git commands to stage and commit changes
if [ ! -z "$new_version" ]; then
    read -p "Do you want to stage and commit these changes? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        git add $PLUGIN_DIR/ska-utm-grabber.php $PLUGIN_DIR/README.md
        git commit -m "$commit_message"
        echo "Changes committed with message: '$commit_message'"
        echo "Don't forget to push to your repository."
    fi
fi