<?php
/*
Plugin Name: TinyMCE Code Button
Plugin URI: https://www.potsky.com/code/wordpresscodebutton/
Description: A plugin for browsing files from the secure-files location of the s2member WordPress Membership plugin. You can display the file browser via the shortcode [s2member_secure_files_browser /].
Version: 0.0.1
Date: 2012-09-07
Author: potsky
Author URI: http://www.potsky.com/about/

Copyright © 2012 Raphael Barbate (potsky) <potsky@me.com> [http://www.potsky.com]
This file is part of TinyMCE Code Button.

TinyMCE Code Button is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License.

TinyMCE Code Button is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with TinyMCE Code Button.  If not, see <http://www.gnu.org/licenses/>.
*/
function codeElement_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_codeElement_tinymce_plugin");
		add_filter('mce_buttons', 'register_codeElement_button');
	}
}
function register_codeElement_button($buttons) {
	array_push($buttons, "|", "codeElement");
	return $buttons;
}

function add_codeElement_tinymce_plugin($plugin_array) {
	$plugin_array['codeElement'] = WP_PLUGIN_URL.'/tinymce-code-button/codeElement/editor_plugin.js';
	return $plugin_array;
}

// init process for button control
add_action('init', 'codeElement_addbuttons');
