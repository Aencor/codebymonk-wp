<?php

namespace CodeByMonk;

/**
 * Class SeoManager
 *
 * Handles comprehensive SEO & GEO SEO optimization:
 * - Dynamic Title & Meta Description
 * - Canonical & Robots Meta
 * - Open Graph & Twitter Cards
 * - GEO SEO meta tags (geo.region, geo.placename, geo.position, ICBM)
 * - Schema.org JSON-LD (WebSite, Organization / LocalBusiness with GeoCoordinates)
 */
class SeoManager {

	/**
	 * Initialize hooks.
	 */
	public static function init(): void {
		add_action('wp_head', [__CLASS__, 'render_seo_meta'], 1);
		add_action('wp_head', [__CLASS__, 'render_geo_meta'], 2);
		add_action('wp_head', [__CLASS__, 'render_schema_jsonld'], 3);
	}

	/**
	 * Render SEO Meta tags (Title, Description, Canonical, OG, Twitter).
	 */
	public static function render_seo_meta(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		$site_name        = get_bloginfo('name');
		$page_title       = wp_get_document_title();
		$current_url      = (is_ssl() ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '');
		$meta_description = self::get_meta_description();
		$og_image         = self::get_og_image();

		echo "\n<!-- SEO & Social Graph (Codebymonk) -->\n";
		if (!empty($meta_description)) {
			echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
		}

		// Canonical
		$canonical = wp_get_canonical_url() ?: $current_url;
		if (!empty($canonical)) {
			echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
		}

		// Open Graph
		echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">' . "\n";
		echo '<meta property="og:type" content="' . (is_singular() ? 'article' : 'website') . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr($page_title) . '">' . "\n";
		if (!empty($meta_description)) {
			echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
		}
		echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
		if (!empty($og_image)) {
			echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
		}

		// Twitter Cards
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr($page_title) . '">' . "\n";
		if (!empty($meta_description)) {
			echo '<meta name="twitter:description" content="' . esc_attr($meta_description) . '">' . "\n";
		}
		if (!empty($og_image)) {
			echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
		}
	}

	/**
	 * Render GEO SEO Meta tags for local ranking.
	 */
	public static function render_geo_meta(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		$geo_region    = get_field('geo_region', 'option');
		$geo_placename = get_field('geo_placename', 'option');
		$geo_lat       = get_field('geo_latitude', 'option');
		$geo_long      = get_field('geo_longitude', 'option');

		if (!empty($geo_region) || !empty($geo_placename) || (!empty($geo_lat) && !empty($geo_long))) {
			echo "\n<!-- GEO SEO Meta Tags (Codebymonk) -->\n";
			if (!empty($geo_region)) {
				echo '<meta name="geo.region" content="' . esc_attr($geo_region) . '">' . "\n";
			}
			if (!empty($geo_placename)) {
				echo '<meta name="geo.placename" content="' . esc_attr($geo_placename) . '">' . "\n";
			}
			if (!empty($geo_lat) && !empty($geo_long)) {
				$coords = esc_attr(trim($geo_lat)) . ';' . esc_attr(trim($geo_long));
				echo '<meta name="geo.position" content="' . $coords . '">' . "\n";
				echo '<meta name="ICBM" content="' . esc_attr(trim($geo_lat)) . ', ' . esc_attr(trim($geo_long)) . '">' . "\n";
			}
		}
	}

	/**
	 * Render Schema.org JSON-LD structured data.
	 */
	public static function render_schema_jsonld(): void {
		if (is_admin() || wp_doing_ajax()) {
			return;
		}

		$site_url      = home_url('/');
		$site_name     = get_bloginfo('name');
		$business_name = get_field('business_name', 'option') ?: $site_name;
		$telephone     = get_field('business_telephone', 'option');
		$address       = get_field('business_address', 'option');
		$geo_lat       = get_field('geo_latitude', 'option');
		$geo_long      = get_field('geo_longitude', 'option');
		$logo          = self::get_og_image();

		$graph = [];

		// 1. WebSite Schema
		$graph[] = [
			'@type' => 'WebSite',
			'@id'   => $site_url . '#website',
			'url'   => $site_url,
			'name'  => $site_name,
			'potentialAction' => [
				'@type'       => 'SearchAction',
				'target'      => $site_url . '?s={search_term_string}',
				'query-input' => 'required name=search_term_string'
			]
		];

		// 2. Organization / LocalBusiness Schema
		$org = [
			'@type' => (!empty($geo_lat) && !empty($geo_long)) ? 'LocalBusiness' : 'Organization',
			'@id'   => $site_url . '#organization',
			'name'  => $business_name,
			'url'   => $site_url,
		];

		if (!empty($logo)) {
			$org['logo'] = [
				'@type' => 'ImageObject',
				'url'   => $logo
			];
		}

		if (!empty($telephone)) {
			$org['telephone'] = $telephone;
		}

		if (!empty($address)) {
			$org['address'] = [
				'@type'          => 'PostalAddress',
				'streetAddress'  => $address,
			];
		}

		if (!empty($geo_lat) && !empty($geo_long)) {
			$org['geo'] = [
				'@type'     => 'GeoCoordinates',
				'latitude'  => (float) $geo_lat,
				'longitude' => (float) $geo_long,
			];
		}

		$graph[] = $org;

		$schema = [
			'@context' => 'https://schema.org',
			'@graph'   => $graph,
		];

		echo "\n<!-- Schema.org JSON-LD (Codebymonk) -->\n";
		echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
	}

	/**
	 * Get meta description from ACF or current post/page.
	 */
	private static function get_meta_description(): string {
		$desc = '';

		if (is_singular()) {
			global $post;
			if ($post && !empty($post->post_excerpt)) {
				$desc = $post->post_excerpt;
			} elseif ($post && !empty($post->post_content)) {
				$desc = wp_strip_all_tags($post->post_content);
			}
		}

		if (empty($desc)) {
			$desc = get_field('meta_description', 'option') ?: get_bloginfo('description');
		}

		return wp_trim_words($desc, 25, '...');
	}

	/**
	 * Get default or featured image for OG.
	 */
	private static function get_og_image(): string {
		if (is_singular() && has_post_thumbnail()) {
			$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
			if ($thumb && !empty($thumb[0])) {
				return $thumb[0];
			}
		}

		$custom_image = get_field('og_default_image', 'option');
		if (!empty($custom_image)) {
			if (is_array($custom_image) && !empty($custom_image['url'])) {
				return $custom_image['url'];
			}
			if (is_string($custom_image)) {
				return $custom_image;
			}
		}

		$favicon = get_template_directory_uri() . '/assets/img/logos/favicon.png';
		return file_exists(get_template_directory() . '/assets/img/logos/favicon.png') ? $favicon : '';
	}
}

