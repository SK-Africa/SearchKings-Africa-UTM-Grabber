# SearchKings Africa UTM Grabber

**Plugin Name:** SearchKings Africa UTM Grabber  
**Description:** A WordPress plugin that dynamically updates links with UTM parameters, populates form fields with UTM data, and detects traffic channel and source.  
**Version: 1.2.0**
**Author:** SearchKings Africa  
**License:** MIT  

## Description

The SearchKings Africa UTM Grabber plugin enhances your WordPress site's tracking capabilities by dynamically updating links with UTM parameters from the current URL. It ensures that UTM parameters persist as users navigate through your site, populates form fields with UTM data, and detects whether the traffic is from paid search or organic sources. This plugin is particularly useful for tracking marketing campaigns and maintaining consistent UTM tracking for analytics.

## Features

- Dynamically appends UTM parameters to a predefined URL.
- Stores UTM parameters in session storage to persist them across page navigations.
- Provides an option to show/hide a WhatsApp call-to-action button.
- Dynamically updates links with a specified class.
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

### Configuring the Plugin

1. **Navigate to Settings:**
   - Go to `Settings > SearchKings Africa UTM Grabber` in your WordPress admin panel.

2. **Configure the Base URL, Show Icon Option, and Link Class:**
   - Enter the base URL for the WhatsApp call-to-action link.
   - Check or uncheck the option to show the WhatsApp icon.
   - The link class is set to "sudonim-link" by default and is read-only.

### Adding the WhatsApp Call-to-Action Button

If "Show WhatsApp Icon" is enabled:
- Insert the shortcode `[ska_utm_grabber_anchor]` in any post, page, or widget where you want the WhatsApp button to appear.

Example Shortcode Usage:
```
[ska_utm_grabber_anchor]
```

This shortcode will display the WhatsApp icon link with the configured URL and UTM parameters.

### Adding Dynamic Link Class

To dynamically update links with UTM parameters:
- Add the class "sudonim-link" to any links you want to be updated.

Example Class Usage:
```html
<a href="#" class="sudonim-link">Your Link Text</a>
```

All links with the specified class will be dynamically updated with the configured URL and UTM parameters.

### Form Integration

The plugin populates form fields with UTM data and traffic channel/source information. For this to work, you must add specific hidden fields to your forms.

#### Required Hidden Fields

Add the following hidden fields to your forms:

1. utm_id
2. utm_source
3. utm_medium
4. utm_campaign
5. utm_term
6. utm_content
7. device
8. keyword
9. network
10. placement
11. adposition
12. gad_source
13. gclid
14. channel
15. source

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

1. **Setting Up the Plugin:**
   - After installation, go to the plugin settings page.
   - Set the base URL for your WhatsApp link.
   - Choose whether to show or hide the WhatsApp icon.
   - The link class is pre-set to "sudonim-link" and cannot be changed.

2. **Using the WhatsApp Button:**
   - If enabled, place the `[ska_utm_grabber_anchor]` shortcode where you want the button to appear.
   - The button will automatically include UTM parameters from the current URL.

3. **Updating Links Dynamically:**
   - Add the class "sudonim-link" to any links you want to update with UTM parameters.
   - These links will be automatically updated when the page loads.

4. **Form Integration:**
   - Add hidden input fields to your forms for each of the UTM parameters listed above, plus "channel" and "source".
   - Ensure the field names match exactly with the supported parameters.
   - The plugin will automatically populate these hidden fields with UTM data from the URL or session storage, and detect the traffic channel and source.
   - No additional configuration is needed for this feature to work once the fields are added.

5. **Maintaining the Plugin:**
   - Regularly check the plugin settings to ensure the base URL is correct.
   - Update the plugin when new versions are available.

6. **Troubleshooting:**
   - If UTM parameters or channel/source information are not being added to forms, check if the form fields with correct names exist.
   - Ensure JavaScript is enabled in the browser.
   - Check the browser console for any error messages related to the plugin.
   - Verify that the UTM parameters are present in the URL or session storage.

## Changelog

### [1.3.1] - 2024-08-16
- Added compatibility with Elementor forms
- Updated documentation for Elementor form integration

### [1.3.0] - 2024-08-15
- Added detection of traffic channel (Paid Search/Organic) and source (Google/Bing/Yahoo).
- Updated form integration to include Channel and Source fields.

### [1.2.0] - 2024-08-13
- Added automatic form integration for UTM parameters.
- Improved error handling and performance.

### [1.1.1] - 2024-06-13
- Added option to show/hide WhatsApp icon.
- Added option to dynamically update links with a specified class.

### [1.0.0] - 2024-06-12
- Initial release

## Frequently Asked Questions

**Q1: How do I change the base URL for the WhatsApp link?**  
A1: Navigate to `Settings > SearchKings Africa UTM Grabber` and update the base URL in the provided field.

**Q2: How do I make the WhatsApp button appear on every page?**  
A2: Add the shortcode `[ska_utm_grabber_anchor]` to a template file that is included on all pages, such as `footer.php` or `header.php`.

**Q3: How do I dynamically update links with UTM parameters?**  
A3: Add the class "sudonim-link" to any links you want to be dynamically updated.

**Q4: Do I need to modify my forms to include UTM parameters and channel/source information?**  
A4: Yes, you need to add hidden input fields to your forms for each of the UTM parameters, plus "channel" and "source". The plugin will then automatically populate these fields with UTM data and detected channel/source information.

**Q5: What fields should I add to my forms?**  
A5: You should add hidden fields for the following parameters: utm_id, utm_source, utm_medium, utm_campaign, utm_term, utm_content, device, keyword, network, placement, adposition, gad_source, gclid, channel, and source.

**Q6: How do I add these fields to my forms?**  
A6: Add hidden input fields to your form HTML. For example:
```html
<input type="hidden" name="utm_source" value="">
<input type="hidden" name="channel" value="">
<input type="hidden" name="source" value="">
```
Repeat this for each parameter, changing the name attribute accordingly.

**Q7: How does the plugin determine if traffic is from paid search or organic?**  
A7: The plugin checks the utm_source parameter for known search engine names (Google, Bing, Yahoo) and the presence of a gclid parameter. It also checks if the utm_medium contains 'cpc'. If any of these conditions are met, it's considered paid search; otherwise, it's organic.

**Q8: Is this plugin compatible with Elementor forms?**  
A8: Yes, the plugin is compatible with both standard WordPress forms and Elementor forms. For Elementor forms, make sure to add hidden fields with the correct field IDs as described in the Form Integration section of this README.

## License

This plugin is licensed under the MIT License. See the LICENSE file for more details.

## Support

For support and further information, please contact SearchKings Africa.

