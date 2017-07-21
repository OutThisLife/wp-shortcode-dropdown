<?php
/**
 * Plugin Name: Shortcode Dropown
 * Description: Add all theme-generated shortcodes to TinyMCE
 * Version: 1.0.0
 * Author: Talasan Nicholson
 * Author URI: http://www.talasan.co
 */

class ShortcodeDropdown {
	public function __construct() {
		add_action('admin_init', [$this, 'addDropdown']);
		add_action('admin_footer', [$this, 'setArray']);
	}

	public function addDropdown() {
		if (!(current_user_can('edit_posts') && current_user_can('edit_pages')))
			return;

		add_filter('mce_external_plugins', function($plugins) {
			$path = plugin_dir_url(__FILE__) . 'shortcode-dropdown.js';
			$plugins['sdropdown'] = $path;
			return $plugins;
		});

		add_filter('mce_buttons', function($buttons) {
			$buttons[] = 'seperator';
			$buttons[] = 'sdropdown';
			return $buttons;
		});
	}

	public function setArray() {
		global $shortcode_tags;

		echo '<script>window.shortcode_tags = [];';

		foreach ($shortcode_tags AS $tag => $code)
			echo 'window.shortcode_tags.push(\'', $tag, '\');';

		echo '</script>';
	}
}

new ShortcodeDropdown;
