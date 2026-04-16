=== WPMinds Skill Assessment Task ===
Contributors: ahmad4372
Tags: reviews, slider, shortcode, skill, test
Requires at least: 4.5
Tested up to: 6.9
Requires PHP: 5.6
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Custom WordPress plugin to manage reviews with CPT, meta fields, and a frontend slider with shortcode support.

== Description ==

This plugin allows you to manage reviews with a custom post type, meta fields, and a frontend slider with shortcode support.

== Features ==

- Custom post type for reviews
- Meta fields for review content, author name, and author tagline
- Frontend slider for displaying reviews
- Shortcode support for displaying reviews
- Settings page for plugin configuration

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= Will it work with any theme? =

Yes, this plugin is designed to work with any theme.

= How to use the shortcode? =

Use the shortcode [wpmsat_reviews] to display the reviews slider. Visit setting page for more details.

== Changelog ==

= 0.1.0 =
Initial release.

== Developer Note ==

I have used the following to make plugin scalable and maintainable:

1. Composer style Autoloader
2. Singleton Pattern
3. Object-Oriented Programming
4. Namespace
5. DRY principle
6. WordPress Coding Style / Standard

Code is well abstracted into seprate file and proper folders. I have also added proper comments and documentation to the code.
I have not used any AI tools to generate the plugin. But I have used WP-CLI to generate the plugin skeleton. 