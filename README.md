# SearchKings Africa UTM Grabber

**Plugin Name:** SearchKings Africa UTM Grabber  
**Description:** A plugin that dynamically updates links with UTM parameters and adds them to form fields.  
**Version:** 1.2.0  
**Author:** SearchKings Africa  
**License:** MIT  

## Description

The SearchKings Africa UTM Grabber plugin dynamically updates links with UTM parameters from the current URL, ensuring that the parameters persist as users navigate through the site. It also adds UTM parameters to form fields. This is particularly useful for tracking campaigns and maintaining consistent UTM tracking for analytics.

## Features

- Dynamically appends UTM parameters to a predefined URL.
- Stores UTM parameters in session storage to persist them across page navigations.
- Provides an option to show/hide a WhatsApp call-to-action button.
- Dynamically updates links with a specified class.
- Adds UTM parameters to form fields.

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

The plugin automatically adds UTM parameters to all forms on the page. No additional configuration is needed for this feature.

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
   - The plugin automatically adds UTM parameter fields to all forms.
   - No manual configuration is needed for forms.

5. **Maintaining the Plugin:**
   - Regularly check the plugin settings to ensure the base URL is correct.
   - Update the plugin when new versions are available.

6. **Troubleshooting:**
   - If UTM parameters are not being added, check if they are present in the URL.
   - Ensure JavaScript is enabled in the browser.
   - Check the browser console for any error messages related to the plugin.

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
A4: No, the plugin automatically adds UTM parameter fields to all forms on the page.

## License

This plugin is licensed under the MIT License. See the LICENSE file for more details.

## Support

For support and further information, please contact SearchKings Africa.

