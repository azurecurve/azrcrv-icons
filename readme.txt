=== Icons ===

Description:	Allows a 16x16 icon to be displayed in a post or page using a shortcode.
Version:		1.7.1
Tags:			icon, icons, posts, pages
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/icons/
Download link:	https://github.com/azurecurve/azrcrv-icons/releases/download/v1.7.1/azrcrv-icons.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	icons
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Allows a 16x16 icon to be displayed in a post or page using a shortcode.

== Description ==

# Description

Easily add an icon to a post or page using the `[icon]` shortcode.

For example, to display the note icon, shortcode usage is `[icon=note]`; 1,000 icons from the famfamfam Silk collection are included.

Defintion of icons can be found at [famfamfam.com](http://www.famfamfam.com/lab/icons/silk/); a settings page also shows all available icons.

Custom cons can be added; if a custom icon with the same name as a standard icon exists, the custom icon will be used.

[Shortcodes In Comments](https://development.azurecurve.co.uk/classicpress-plugins/shortcode-in-comments/) can be used to allow flags in comments and [Shortcodes In Widgets](https://development.azurecurve.co.uk/classicpress-plugins/shortcode-in-widgets/) can allow them in widgets.

This plugin is multisite compatible.

== Installation ==

# Installation Instructions

 * Download the latest release of the plugin from [GitHub](https://github.com/azurecurve/azrcrv-icons/releases/latest/).
 * Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
 * Activate the plugin.
 * Configure relevant settings via the configuration page in the admin control panel (azurecurve menu).

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot file is in the plugins languages folder; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.7.1](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.7.1)
 * Update azurecurve menu.
 * Update readme files.

### [Version 1.7.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.7.0)
 * Tidy up code on settings page.
 * Remove jQuery UI tabs and add tabs using aria.
 * Add uninstall.
 * Update azurecurve menu and logo.
 
### [Version 1.6.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.6.0)
 * Refactor settings page to be accessible using jQuery UI Tabs.

### [Version 1.5.1](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.5.1)
 * Fix version number bug.

### [Version 1.5.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.5.0)
 * Add functionality for custom icons, including upload of custom icons.
 
### [Version 1.4.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.4.0)
 * Add function to build list of icons.
 * Fix bug to prevent non-existent icon being used.
 * Update azurecurve plugin menu.
 
### [Version 1.3.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.3.0)
 * Fix plugin action link to use admin_url() function.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.

### [Version 1.2.4](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.2.4)
 * Fix bug with plugin menu.
 * Update plugin menu css.

### [Version 1.2.3](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.2.3)
 * Upgrade azurecurve plugin to store available plugins in options.
 
### [Version 1.2.2](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.2.2)
 * Update Update Manager class to v2.0.0.
 * Update action link.
 * Update azurecurve menu icon with compressed image.
 * Update icons with compressed images.

### [Version 1.2.1](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.2.1)
 * Fix bug with incorrect language load text domain.

### [Version 1.2.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.2.0)
 * Add integration with Update Manager for automatic updates.
 * Fix issue with display of azurecurve menu.
 * Change settings page heading.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.1.0)
 * Fix issue with flags not displaying correctly on admin page.
 * Exclude index.php from image listing on admin page.
 * Fix link in localized string and rebuild .pot.
 * Amend sort order of icons to alphabetical order on admin page.

### [Version 1.0.1](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.0.1)
 * Update azurecurve menu for easier maintenance.
 * Move require of azurecurve menu below security check.
 * Localization fixes.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-icons/releases/tag/v1.0.0)
 * Initial release for ClassicPress forked from azurecurve Icons WordPress Plugin.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://directory.classicpress.net/plugins/update-manager) for fully integrated, no hassle, updates.

Some of the other plugins available from **azurecurve** are:
 * Check Plugin Status - [details](https://development.azurecurve.co.uk/classicpress-plugins/check-plugin-status/) / [download](https://github.com/azurecurve/azrcrv-check-plugin-status/releases/latest/)
 * Conditional Links - [details](https://development.azurecurve.co.uk/classicpress-plugins/conditional-links/) / [download](https://github.com/azurecurve/azrcrv-conditional-links/releases/latest/)
 * Display After Post Content - [details](https://development.azurecurve.co.uk/classicpress-plugins/display-after-post-content/) / [download](https://github.com/azurecurve/azrcrv-display-after-post-content/releases/latest/)
 * From Twitter - [details](https://development.azurecurve.co.uk/classicpress-plugins/from-twitter/) / [download](https://github.com/azurecurve/azrcrv-from-twitter/releases/latest/)
 * Images - [details](https://development.azurecurve.co.uk/classicpress-plugins/images/) / [download](https://github.com/azurecurve/azrcrv-images/releases/latest/)
 * Loop Injection - [details](https://development.azurecurve.co.uk/classicpress-plugins/loop-injection/) / [download](https://github.com/azurecurve/azrcrv-loop-injection/releases/latest/)
 * Redirect - [details](https://development.azurecurve.co.uk/classicpress-plugins/redirect/) / [download](https://github.com/azurecurve/azrcrv-redirect/releases/latest/)
 * Tag Cloud - [details](https://development.azurecurve.co.uk/classicpress-plugins/tag-cloud/) / [download](https://github.com/azurecurve/azrcrv-tag-cloud/releases/latest/)
 * Taxonomy Order - [details](https://development.azurecurve.co.uk/classicpress-plugins/taxonomy-order/) / [download](https://github.com/azurecurve/azrcrv-taxonomy-order/releases/latest/)
 * Widget Announcements - [details](https://development.azurecurve.co.uk/classicpress-plugins/widget-announcements/) / [download](https://github.com/azurecurve/azrcrv-widget-announcements/releases/latest/)