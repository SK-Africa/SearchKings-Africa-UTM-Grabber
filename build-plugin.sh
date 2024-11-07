#!/bin/bash

# Variables
PLUGIN_DIR="."
TEMP_DIR="sk-utm-grabber-temp"
MAIN_FILE="$PLUGIN_DIR/ska-utm-grabber.php"
README_FILE="$PLUGIN_DIR/README.md"
ZIP_PREFIX="sk-utm-grabber-"

# Function to validate version number
validate_version() {
    if [[ ! $1 =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
        echo "Invalid version number. Please use semantic versioning (e.g., 1.2.3)."
        exit 1
    fi
}

# Function to ensure changelog section exists
ensure_changelog_section() {
    if ! grep -q "^## Changelog" "$README_FILE"; then
        # Add Changelog section before License section
        sed -i.bak '/## License/i\## Changelog\n\n' "$README_FILE"
        rm -f "$README_FILE.bak"
        echo "Created Changelog section"
    fi
}

# Function to clean up old ZIP files
cleanup_old_zips() {
    local current_zip="$1"
    # Remove all sk-utm-grabber-*.zip files except the current one
    find . -maxdepth 1 -name "${ZIP_PREFIX}*.zip" ! -name "$current_zip" -type f -delete
    echo "Cleaned up old ZIP files."
}

# Read the current version from the PHP file
current_version=$(grep "Version:" "$MAIN_FILE" | sed "s/.*Version: *\([0-9.]*\).*/\1/")

# Check if version was found
if [ -z "$current_version" ]; then
    echo "Error: Could not find current version in ska-utm-grabber.php"
    exit 1
fi

# Display current version and prompt for new version
echo "Current version is $current_version"
read -p "Enter new version number (or press enter to keep current version): " new_version

# If a new version is provided, update files
if [ ! -z "$new_version" ]; then
    # Validate the new version
    validate_version $new_version

    # Update the version constant in the PHP file
    sed -i.bak "s/define( *'SKA_UTM_GRABBER_VERSION', *'[0-9.]*' *)/define( 'SKA_UTM_GRABBER_VERSION', '$new_version' )/" "$MAIN_FILE"

    # Update the version in the plugin header
    sed -i.bak "s/\* Version: *[0-9.]*/* Version: $new_version/" "$MAIN_FILE"

    # Update the version in the README.md file
    sed -i.bak "s/Version: *[0-9.]*/Version: $new_version/" "$README_FILE"

    echo "Version updated to $new_version"

    # Remove backup files created by sed
    rm "$MAIN_FILE.bak" "$README_FILE.bak"

    # Ensure changelog section exists
    ensure_changelog_section

    # Require changelog entry for version updates
    echo "A changelog entry is required for version updates."
    echo "Enter changelog entry for version $new_version:"
    read changelog_entry

    # Keep prompting until a changelog entry is provided
    while [ -z "$changelog_entry" ]; do
        echo "Changelog entry cannot be empty. Please enter a description of the changes:"
        read changelog_entry
    done

    # Add the changelog entry
    today=$(date +%Y-%m-%d)
    sed -i.bak "/## Changelog/a\\\\n### [$new_version] - $today\\n- $changelog_entry\\n" "$README_FILE"
    
    echo "Changelog entry added."
    
    # Remove backup file created by sed
    rm -f "$README_FILE.bak"

    # Prompt for commit message
    echo "Enter a commit message (press enter to use default message):"
    read custom_commit_message

    if [ ! -z "$custom_commit_message" ]; then
        commit_message="$custom_commit_message"
    else
        commit_message="Bump version to $new_version - $changelog_entry"
    fi
else
    new_version=$current_version
fi

# Define ZIP filename
ZIP_FILE="${ZIP_PREFIX}${new_version}.zip"

# Step 1: Clean up any previous builds
echo "Cleaning up previous builds..."
rm -rf "$TEMP_DIR"

# Step 2: Create a temporary directory and copy the plugin files
echo "Creating temporary directory and copying plugin files..."
mkdir "$TEMP_DIR"
if [ $? -ne 0 ]; then
    echo "Error: Failed to create temporary directory."
    exit 1
fi

cp -R "$PLUGIN_DIR"/* "$TEMP_DIR"
if [ $? -ne 0 ]; then
    echo "Error: Failed to copy plugin files."
    rm -rf "$TEMP_DIR"
    exit 1
fi

# Step 3: Ensure all necessary directories exist
echo "Ensuring all necessary directories exist..."
mkdir -p "$TEMP_DIR/assets/css"
mkdir -p "$TEMP_DIR/assets/js"
mkdir -p "$TEMP_DIR/assets/images"
mkdir -p "$TEMP_DIR/includes"
mkdir -p "$TEMP_DIR/languages"

# Step 4: Remove unnecessary files from the temporary copy
echo "Removing unnecessary files..."
rm -f "$TEMP_DIR/build-plugin.sh"

# Step 5: Create the ZIP file
echo "Creating ZIP file..."
mkdir "ska-utm-grabber"
cp -R "$TEMP_DIR"/* "ska-utm-grabber/"

# Clean up old ZIP files before creating new one
cleanup_old_zips "$ZIP_FILE"

# Create new ZIP file
zip -r "$ZIP_FILE" "ska-utm-grabber"
rm -rf "ska-utm-grabber"

# Step 6: Clean up the temporary directory
echo "Cleaning up temporary files..."
rm -rf "$TEMP_DIR"

echo "Build completed successfully. ZIP file created: $ZIP_FILE"
echo "Remember to always commit your work and push any changes to the remote repo -- TS ✨"

# Optional: Git commands to stage and commit changes
if [ ! -z "$new_version" ] && [ "$new_version" != "$current_version" ]; then
    read -p "Do you want to stage and commit these changes? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]
    then
        git add .
        git commit -m "$commit_message"
        echo "Changes committed with message: '$commit_message'"
        echo "Don't forget to push to your repository."
    fi
fi