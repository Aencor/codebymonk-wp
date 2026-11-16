<?php
/**
 * ACF Options Pages Configuration
 *
 * Registers the global theme settings and subpages for scripts, SEO/GEO, 404, etc.
 */

if (function_exists("acf_add_options_page")) {
	acf_add_options_page([
		"page_title" => "Global Settings",
		"menu_title" => "Global Settings",
		"menu_slug"  => "theme-general-options",
		"capability" => "edit_posts",
		"redirect"   => true,
		"icon_url"   => "dashicons-admin-site",
		"position"   => 58,
	]);

	acf_add_options_sub_page([
		"page_title"  => "Global Settings",
		"menu_title"  => "Global Settings",
		"menu_slug"   => "acf-options-global-settings",
		"parent_slug" => "theme-general-options",
	]);

	acf_add_options_sub_page([
		"page_title"  => "External Scripts & Custom Code",
		"menu_title"  => "External Scripts",
		"menu_slug"   => "acf-options-external-scripts",
		"parent_slug" => "theme-general-options",
	]);

	acf_add_options_sub_page([
		"page_title"  => "SEO & GEO Settings",
		"menu_title"  => "SEO & GEO",
		"menu_slug"   => "acf-options-seo-geo",
		"parent_slug" => "theme-general-options",
	]);

	acf_add_options_sub_page([
		"page_title"  => "Menu Options",
		"menu_title"  => "Menu Options",
		"menu_slug"   => "acf-options-menu-options",
		"parent_slug" => "theme-general-options",
	]);

	acf_add_options_sub_page([
		"page_title"  => "404 Page",
		"menu_title"  => "404 Page",
		"menu_slug"   => "acf-options-404-page",
		"parent_slug" => "theme-general-options",
	]);
}
