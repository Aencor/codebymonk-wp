<?php

namespace CodeByMonk;

/**
 * Class CustomScripts
 *
 * Handles dynamic custom code injection for:
 * - Header scripts (<head>) - Analytics, Tag Manager, Verification, AdSense
 * - Body open scripts (immediately after <body>) - GTM Noscript
 * - Footer scripts (before </body>) - Pixels, chat widgets, deferred scripts
 * - Google AdSense automated script injection with performance safeguards
 */
class CustomScripts {

	/**
	 * Initialize hooks.
	 */
	public static function init(): void {
		add_action('wp_head', [__CLASS__, 'render_header_scripts'], 99);
		add_action('wp_body_open', [__CLASS__, 'render_body_scripts'], 1);
		add_action('wp_footer', [__CLASS__, 'render_footer_scripts'], 99);
	}

	/**
	 * Output custom code inside <head>.
	 */
	public static function render_header_scripts(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		// 1. Google AdSense automated script if enabled
		$enable_adsense = get_field('enable_adsense', 'option');
		$publisher_id   = get_field('adsense_publisher_id', 'option');

		if ($enable_adsense && !empty($publisher_id)) {
			$clean_pub = esc_attr(trim($publisher_id));
			echo "\n<!-- Google AdSense Automated Script (Codebymonk) -->\n";
			echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . $clean_pub . '" crossorigin="anonymous"></script>' . "\n";
		}

		// 2. Custom Header Scripts (Google Analytics, GTM head, Meta verification, etc.)
		$header_scripts = get_field('header_scripts', 'option');
		if (!empty($header_scripts)) {
			echo "\n<!-- Codebymonk Custom Header Scripts -->\n";
			echo $header_scripts . "\n";
			echo "<!-- /Codebymonk Custom Header Scripts -->\n";
		}
	}

	/**
	 * Output custom code immediately after opening <body> tag.
	 */
	public static function render_body_scripts(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		$body_scripts = get_field('body_scripts', 'option');
		if (!empty($body_scripts)) {
			echo "\n<!-- Codebymonk Custom Body Scripts -->\n";
			echo $body_scripts . "\n";
			echo "<!-- /Codebymonk Custom Body Scripts -->\n";
		}
	}

	/**
	 * Output custom code before closing </body> tag.
	 */
	public static function render_footer_scripts(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		$footer_scripts = get_field('footer_scripts', 'option');
		if (!empty($footer_scripts)) {
			echo "\n<!-- Codebymonk Custom Footer Scripts -->\n";
			echo $footer_scripts . "\n";
			echo "<!-- /Codebymonk Custom Footer Scripts -->\n";
		}
	}
}

