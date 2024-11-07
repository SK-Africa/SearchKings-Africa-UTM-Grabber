# SearchKings Africa UTM Grabber

**Plugin Name:** SearchKings Africa UTM Grabber  
**Description:** A WordPress plugin that dynamically updates links with UTM parameters, populates form fields with UTM data, and detects traffic channel and source.  
**Version: 1.0.4**
**Author:** SearchKings Africa  
**License:** MIT  

## Description

The SearchKings Africa UTM Grabber plugin enhances your WordPress site's tracking capabilities. It ensures that UTM parameters persist as users navigate through your site, populates form fields with UTM data, and detects whether the traffic is from paid search or organic sources. This plugin is particularly useful for tracking marketing campaigns and maintaining consistent UTM tracking for analytics.

## Features

- Stores UTM parameters in session storage to persist them across page navigations.
- Populates form fields with UTM data.
- Detects and populates form fields with traffic channel (Paid Search/Organic) and source (Google/Bing/Yahoo).
- Compatible with standard WordPress forms and Elementor forms.

## Installation

1. **Upload the Plugin:**
   - Download the plugin ZIP file.
   - Navigate to `Plugins > Add New` in your WordPress admin dashboard.
   - Click `Upload Plugin` and select the downloaded ZIP file.
   - Click `Install Now` and then `Activate`.

2. **Manual Installation:**
   - Unzip the downloaded plugin file.
   - Upload the `sk-utm-grabber-plugin` directory to the `/wp-content/plugins/` directory.
   - Activate the plugin through the `Plugins` menu in WordPress.

## Usage

### Form Integration

The plugin populates form fields with UTM data and traffic channel/source information. For this to work, you must add specific hidden fields to your forms.

#### Required Hidden Fields

Add the following hidden fields to your forms:

1. utm_source
2. utm_medium
3. utm_campaign
4. utm_term
5. utm_content
6. device
7. network
8. placement
9. adposition
10. gclid
11. channel
12. source
13. keyword

Example for standard WordPress forms:
```html
<form>
    <!-- Your existing form fields -->
    <input type="hidden" name="utm_id" value="">
    <input type="hidden" name="utm_source" value="">
    <input type="hidden" name="utm_medium" value="">
    <!-- Add all other UTM fields similarly -->
    <input type="hidden" name="channel" value="">
    <input type="hidden" name="source" value="">
    <!-- Your form submit button -->
</form>
```

For Elementor forms:
1. Add a new field to your form
2. Set the field type to "Hidden"
3. Set the field ID to match the required field names (e.g., "utm_source", "channel", "source")

The plugin will automatically populate these hidden fields with UTM data from the URL or session storage, and detect the traffic channel and source.

## Operating Procedures

1. **Form Integration:**
   - Add hidden input fields to your forms for each of the UTM parameters listed above, plus "channel" and "source".
   - Ensure the field names match exactly with the supported parameters.
   - The plugin will automatically populate these hidden fields with UTM data from the URL or session storage, and detect the traffic channel and source.
   - No additional configuration is needed for this feature to work once the fields are added.

2. **Troubleshooting:**
   - If UTM parameters or channel/source information are not being added to forms, check if the form fields with correct names exist.
   - Ensure JavaScript is enabled in the browser.
   - Check the browser console for any error messages related to the plugin.
   - Verify that the UTM parameters are present in the URL or session storage.


## Frequently Asked Questions

**Q1: Do I need to modify my forms to include UTM parameters and channel/source information?**  
A1: Yes, you need to add hidden input fields to your forms for each of the UTM parameters, plus "channel" and "source". The plugin will then automatically populate these fields with UTM data and detected channel/source information.

**Q2: What fields should I add to my forms?**  
A2: You should add hidden fields for the following parameters: utm_source, utm_medium, utm_campaign, utm_term, utm_content, device, network, placement, adposition, gclid, keyword, channel, and source.

**Q3: How do I add these fields to my forms?**  
A3: Add hidden input fields to your form HTML. For example:
```html
<input type="hidden" name="utm_source" value="">
<input type="hidden" name="channel" value="">
<input type="hidden" name="source" value="">
```
Repeat this for each parameter, changing the name attribute accordingly.

**Q4: How does the plugin determine if traffic is from paid search or organic?**  
A4: The plugin checks the utm_source parameter for known search engine names (Google, Bing, Yahoo) and the presence of a gclid parameter. It also checks if the utm_medium contains 'cpc'. If any of these conditions are met, it's considered paid search; otherwise, it's organic.

**Q5: Is this plugin compatible with Elementor forms?**  
A5: Yes, the plugin is compatible with both standard WordPress forms and Elementor forms. For Elementor forms, make sure to add hidden fields with the correct field IDs as described in the Form Integration section of this README.

## Developer Guide

### Build Process

The plugin includes a build script (`build-plugin.sh`) that automates the versioning and packaging process. Here's how to use it:

1. **Prerequisites:**
   - Bash shell environment (Linux/Mac/WSL)
   - Git installed
   - Execute permissions on the script (`chmod +x build-plugin.sh`)

2. **Running the Build:**
   ```bash
   ./build-plugin.sh
   ```
   
   The script will:
   - Display the current version and prompt for a new version
   - Update version numbers across all relevant files
   - Optionally add a changelog entry
   - Create a ZIP file ready for distribution
   - Optionally commit changes to Git

3. **Build Options:**
   - Press Enter to keep the current version
   - Enter a new version number (e.g., "1.0.5") to update the version
   - Choose whether to add a changelog entry
   - Provide a custom commit message or use the default

### Project Structure

```
sk-utm-grabber/
├── admin/
│   └── partials/
│       └── ska-utm-grabber-admin-display.php
├── assets/
│   ├── css/
│   │   └── ska-utm-grabber.css
│   └── js/
│       └── ska-utm-grabber.js
├── includes/
│   ├── class-ska-utm-grabber.php
│   ├── class-ska-utm-grabber-admin.php
│   └── class-ska-utm-grabber-public.php
├── languages/
├── build-plugin.sh
├── README.md
├── ska-utm-grabber.php
└── uninstall.php
```

### Development Guidelines

1. **Version Control:**
   - Always use the build script to update versions
   - Follow semantic versioning (MAJOR.MINOR.PATCH)
   - Add meaningful changelog entries

2. **Code Standards:**
   - Follow WordPress Coding Standards
   - Use PHP_CodeSniffer with WordPress rules
   - Maintain proper documentation and comments

3. **Testing:**
   - Test with multiple form plugins (especially Elementor)
   - Verify UTM parameter persistence across page navigation
   - Check traffic source detection accuracy
   - Test across different WordPress versions

4. **JavaScript Development:**
   - The main tracking logic is in `assets/js/ska-utm-grabber.js`
   - Use ES6+ features with caution (consider browser compatibility)
   - Maintain the MutationObserver for dynamic form detection

5. **Form Compatibility:**
   - Test new features with both standard WordPress forms and Elementor
   - Maintain compatibility with existing field naming conventions
   - Document any new field requirements

### Key Files

- `ska-utm-grabber.php`: Main plugin file
- `class-ska-utm-grabber.php`: Core plugin class
- `ska-utm-grabber.js`: UTM tracking and form population logic
- `ska-utm-grabber-admin-display.php`: Admin interface template

### Adding New Features

1. Start by creating a new branch
2. Update relevant PHP classes in `includes/`
3. Add any new JavaScript to `assets/js/`
4. Update the admin interface if needed
5. Document changes in README.md
6. Use build script to create a new version
7. Test thoroughly before merging

### Common Development Tasks

1. **Adding New UTM Parameters:**
   - Update `utmGrabberData.utmParams` array in `class-ska-utm-grabber-public.php`
   - Add parameter handling in `ska-utm-grabber.js`
   - Update documentation

2. **Modifying Traffic Source Detection:**
   - Edit the `determineChannelAndSource` function in `ska-utm-grabber.js`
   - Update tests and documentation

3. **Adding Admin Settings:**
   - Add fields in `class-ska-utm-grabber-admin.php`
   - Update the admin display template
   - Add any necessary JavaScript/CSS

## Support

For development support and contributions:
1. Create issues in the repository for bugs or feature requests
2. Follow the contribution guidelines
3. Contact SearchKings Africa development team for access and questions

## License

This plugin is licensed under the MIT License. See the LICENSE file for more details.

