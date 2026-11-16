<?php

namespace CodeByMonk;

/**
 * Class PageSpeedOptimizer
 *
 * Implements Core Web Vitals and PageSpeed optimizations:
 * - Eliminates render-blocking JavaScript via defer/async loading
 * - Adds preconnect and dns-prefetch resource hints
 * - Removes WordPress head bloat (emojis, generator, rsd, wlwmanifest)
 * - Enforces native lazy-loading and asynchronous image decoding
 * - Prevents Cumulative Layout Shift (CLS) with AdSense placeholder styles
 */
class PageSpeedOptimizer {

	/**
	 * Initialize hooks.
	 */
	public static function init(): void {
		// Clean up WP head
		add_action('init', [__CLASS__, 'cleanup_head']);

		// Resource hints (Preconnect & DNS-prefetch)
		add_filter('wp_resource_hints', [__CLASS__, 'add_resource_hints'], 10, 2);

		// Defer non-critical scripts
		add_filter('script_loader_tag', [__CLASS__, 'defer_scripts'], 10, 3);

		// Image attributes optimization (Lazy & Async)
		add_filter('wp_get_attachment_image_attributes', [__CLASS__, 'optimize_images'], 10, 3);

		// AdSense CLS guard styles
		add_action('wp_head', [__CLASS__, 'render_cls_prevention_styles'], 5);
	}

	/**
	 * Remove unnecessary default scripts and tags from <head>.
	 */
	public static function cleanup_head(): void {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	}

	/**
	 * Add preconnect & DNS prefetch hints for faster third-party connections.
	 *
	 * @param array  $urls
	 * @param string $relation_type
	 * @return array
	 */
	public static function add_resource_hints(array $urls, string $relation_type): array {
		if ('preconnect' === $relation_type) {
			$urls[] = [
				'href' => 'https://fonts.googleapis.com',
				'crossorigin' => 'anonymous',
			];
			$urls[] = [
				'href' => 'https://fonts.gstatic.com',
				'crossorigin' => 'anonymous',
			];
			$urls[] = [
				'href' => 'https://pagead2.googlesyndication.com',
				'crossorigin' => 'anonymous',
			];
		} elseif ('dns-prefetch' === $relation_type) {
			$urls[] = 'https://www.google-analytics.com';
			$urls[] = 'https://www.googletagmanager.com';
			$urls[] = 'https://pagead2.googlesyndication.com';
			$urls[] = 'https://googleads.g.doubleclick.net';
		}

		return $urls;
	}

	/**
	 * Defer scripts to eliminate render-blocking JS.
	 *
	 * @param string $tag
	 * @param string $handle
	 * @param string $src
	 * @return string
	 */
	public static function defer_scripts(string $tag, string $handle, string $src): string {
		// Do not alter admin or jquery core
		if (is_admin() || 'jquery-core' === $handle) {
			return $tag;
		}

		// Add defer if not already present
		if (!str_contains($tag, 'defer') && !str_contains($tag, 'async')) {
			$tag = str_replace(' src=', ' defer src=', $tag);
		}

		return $tag;
	}

	/**
	 * Optimize images with lazy loading and async decoding.
	 *
	 * @param array        $attr
	 * @param \WP_Post     $attachment
	 * @param string|array $size
	 * @return array
	 */
	public static function optimize_images(array $attr, $attachment, $size): array {
		if (empty($attr['loading'])) {
			$attr['loading'] = 'lazy';
		}
		if (empty($attr['decoding'])) {
			$attr['decoding'] = 'async';
		}
		return $attr;
	}

	/**
	 * Output inline CSS to prevent Cumulative Layout Shift (CLS) on AdSense units.
	 */
	public static function render_cls_prevention_styles(): void {
		echo "<style id=\"codebymonk-pagespeed-cls-guard\">\n";
		echo "/* CLS Safeguards for Ads & Images (Codebymonk) */\n";
		echo ".adsbygoogle, .adsense-slot { display: block; min-height: 250px; background-color: rgba(241, 245, 249, 0.5); overflow: hidden; }\n";
		echo "img, video { max-width: 100%; height: auto; }\n";
		echo "</style>\n";
	}
}

