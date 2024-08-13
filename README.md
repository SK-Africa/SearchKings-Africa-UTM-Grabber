# SearchKings Africa UTM Grabber

**Plugin Name:** SearchKings Africa UTM Grabber  
**Description:** A plugin that dynamically updates links with UTM parameters and populates form fields with UTM data.  
**Version:** 1.2.0  
**Author:** SearchKings Africa  
**License:** MIT  

## Description

The SearchKings Africa UTM Grabber plugin dynamically updates links with UTM parameters from the current URL, ensuring that the parameters persist as users navigate through the site. It also populates form fields with UTM data. This is particularly useful for tracking campaigns and maintaining consistent UTM tracking for analytics.

## Features

- Dynamically appends UTM parameters to a predefined URL.
- Stores UTM parameters in session storage to persist them across page navigations.
- Provides an option to show/hide a WhatsApp call-to-action button.
- Dynamically updates links with a specified class.
- Populates form fields with UTM data.

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
   - Go to `Settings > SearchKings Africa UTM Grabber`.

2. **Configure the Base URL, Show Icon Option, and Link Class:**
   - Enter the base URL for the WhatsApp call-to-action link.
   - Check or uncheck the option to show the WhatsApp icon.
   - The link class is set to "sudonim-link" by default and is read-only.

### Adding the WhatsApp Call-to-Action Button

1. **If "Show WhatsApp Icon" is enabled:**
   - Insert the shortcode `[ska_utm_grabber_anchor]` in any post, page, or widget where you want the WhatsApp button to appear.

### Example Shortcode Usage

```
[ska_utm_grabber_anchor]
```

This shortcode will display the WhatsApp icon link with the configured URL and UTM parameters if the icon is enabled.

### Adding Dynamic Link Class

1. **Add the specified class to your links:**
   - Use the class "sudonim-link" for any links you want to be dynamically updated with the UTM parameters.

### Example Class Usage

```html
<a href="#" class="sudonim-link">Your Link Text</a>
```

All links with the specified class will be dynamically updated with the configured URL and UTM parameters.

### Form Integration

The plugin populates form fields with UTM data. For this to work, you must add specific hidden fields to your forms that match the UTM parameters.

#### Required Hidden UTM Fields

You must add the following hidden fields to your forms:

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

Example of how to add these fields to your form:

```html
<form>
    <!-- Your existing form fields -->
    <input type="hidden" name="utm_id" value="">
    <input type="hidden" name="utm_source" value="">
    <input type="hidden" name="utm_medium" value="">
    <!-- Add all other UTM fields similarly -->
    <!-- Your form submit button -->
</form>
```

The plugin will automatically populate these hidden fields with UTM data from the URL or session storage.

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
   - Add hidden input fields to your forms for each of the UTM parameters listed above.
   - Ensure the field names match exactly with the supported UTM parameters.
   - The plugin will automatically populate these hidden fields with UTM data from the URL or session storage.
   - No additional configuration is needed for this feature to work once the fields are added.

5. **Maintaining the Plugin:**
   - Regularly check the plugin settings to ensure the base URL is correct.
   - Update the plugin when new versions are available.

6. **Troubleshooting:**
   - If UTM parameters are not being added to forms, check if the form fields with correct names exist.
   - Ensure JavaScript is enabled in the browser.
   - Check the browser console for any error messages related to the plugin.
   - Verify that the UTM parameters are present in the URL or session storage.

## Changelog

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

**Q4: Do I need to modify my forms to include UTM parameters?**  
A4: Yes, you need to add hidden input fields to your forms for each of the UTM parameters. The plugin will then automatically populate these fields with UTM data.

**Q5: What UTM parameters should I add to my forms?**  
A5: You should add hidden fields for the following parameters: utm_id, utm_source, utm_medium, utm_campaign, utm_term, utm_content, device, keyword, network, placement, adposition, gad_source, and gclid.

**Q6: How do I add the UTM fields to my forms?**  
A6: Add hidden input fields to your form HTML. For example:
```html
<input type="hidden" name="utm_source" value="">
```
Repeat this for each UTM parameter, changing the name attribute accordingly.

## License

This plugin is licensed under the MIT License. See the LICENSE file for more details.

## Support

For support and further information, please contact SearchKings Africa.
