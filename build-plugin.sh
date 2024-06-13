#!/bin/bash

# Variables
PLUGIN_DIR="sk-utm-grabber-plugin"
TEMP_DIR="${PLUGIN_DIR}-temp"
ZIP_FILE="${PLUGIN_DIR}.zip"

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

# Step 3: Remove the .git folder from the temporary copy
echo "Removing .git folder..."
rm -rf "${TEMP_DIR}/.git"

# Step 4: Create a ZIP file from the temporary copy
echo "Creating ZIP file..."
if [ -d "$TEMP_DIR" ]; then
    zip -r "$ZIP_FILE" "$TEMP_DIR"
else
    echo "Error: Temporary directory $TEMP_DIR does not exist."
    exit 1
fi

# Step 5: Clean up the temporary copy
echo "Cleaning up temporary files..."
rm -rf "$TEMP_DIR"

echo "Build completed successfully. ZIP file created: $ZIP_FILE"