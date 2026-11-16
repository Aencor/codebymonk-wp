<?php

/**
 * Enqueue Theme Scripts and Stylesheets
 *
 * Optimized for PageSpeed Insights & Core Web Vitals.
 */
function theme_scripts() {
	if (is_single() && comments_open() && get_option("thread_comments")) {
		wp_enqueue_script("comment-reply");
	}

	// Font Awesome (Async/Non-blocking)
	wp_enqueue_style(
		"font-awesome",
		"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css",
		[],
		"6.6.0",
		"all"
	);

	// Main Compiled Theme Stylesheet
	$style_path = get_template_directory() . "/assets/build/style.css";
	$style_ver  = file_exists($style_path) ? filemtime($style_path) : "1.0.0";

	wp_enqueue_style(
		"master",
		get_template_directory_uri() . "/assets/build/style.css",
		[],
		$style_ver,
		"all"
	);

	// Main Theme JS - Enqueued in Footer
	$js_path = get_template_directory() . "/assets/build/main.js";
	$js_ver  = file_exists($js_path) ? filemtime($js_path) : "1.0.0";

	wp_enqueue_script(
		"theme-main",
		get_template_directory_uri() . "/assets/build/main.js",
		['jquery'],
		$js_ver,
		true // Load in footer for Core Web Vitals
	);
}

add_action("wp_enqueue_scripts", "theme_scripts", 9999);
