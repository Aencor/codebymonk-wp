<?php
/**
 * Block Template: Hero
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

// ACF Fields with production fallbacks
$title   = get_field('block_title') ?: get_field('hero_title') ?: 'Desarrollo Web de Alto Rendimiento & Diseño Intencional';
$lead    = get_field('block_content') ?: get_field('hero_description') ?: 'Construyo plataformas digitales a medida con WordPress en bloques (Gutenberg nativo), Tailwind CSS y animaciones fluidas con GSAP. Rendimiento extremo, Core Web Vitals al 100% y cero builders pesados.';
$badge   = get_field('hero_badge') ?: 'CodeByMonk Studio • Frontend & WordPress Engineer';
$cta_url = get_field('block_cta') ? (is_array(get_field('block_cta')) ? get_field('block_cta')['url'] : get_field('block_cta')) : '#proyectos';
$cta_lbl = get_field('block_cta') ? (is_array(get_field('block_cta')) ? get_field('block_cta')['title'] : 'Explorar Proyectos') : 'Explorar Proyectos';
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="hero" 
	class="hero-block relative overflow-hidden pt-20 pb-28 md:pt-28 md:pb-36 bg-radial from-slate-900 to-slate-950 <?= esc_attr($block_meta['classes']); ?>"
>
	<!-- Ambient Background Glow -->
	<div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-blue-600/15 rounded-full blur-[130px] pointer-events-none"></div>

	<div class="container mx-auto px-4 max-w-7xl relative z-10">
		<div class="max-w-4xl mx-auto text-center space-y-8">
			<!-- Tag Badge -->
			<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-blue-500/30 bg-blue-500/10 text-blue-400 text-xs sm:text-sm font-mono font-medium tracking-wide">
				<span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
				<?= esc_html($badge); ?>
			</div>

			<!-- Main Headline -->
			<h1 class="hero-title text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.1]">
				<?= esc_html($title); ?>
			</h1>

			<!-- Subtitle / Value Proposition -->
			<p class="hero-description text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
				<?= wp_kses_post($lead); ?>
			</p>

			<!-- Action Buttons -->
			<div class="flex flex-wrap items-center justify-center gap-4 pt-4">
				<a 
					href="<?= esc_url($cta_url); ?>" 
					class="hero-cta inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5"
				>
					<?= esc_html($cta_lbl); ?> &rarr;
				</a>
				<a 
					href="#casos-de-estudio" 
					class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-slate-300 hover:text-white bg-slate-900/80 hover:bg-slate-800 border border-slate-700 rounded-xl transition-all duration-200"
				>
					Ver Casos de Estudio
				</a>
			</div>

			<!-- Metrics / Highlights Row -->
			<div class="pt-12 grid grid-cols-2 sm:grid-cols-4 gap-6 border-t border-slate-800/60 max-w-3xl mx-auto text-left">
				<div class="space-y-1">
					<div class="text-2xl sm:text-3xl font-extrabold text-white font-mono">10+</div>
					<div class="text-xs text-slate-400 uppercase tracking-wider">Años de Exp.</div>
				</div>
				<div class="space-y-1">
					<div class="text-2xl sm:text-3xl font-extrabold text-blue-400 font-mono">100%</div>
					<div class="text-xs text-slate-400 uppercase tracking-wider">Core Web Vitals</div>
				</div>
				<div class="space-y-1">
					<div class="text-2xl sm:text-3xl font-extrabold text-emerald-400 font-mono">Zero</div>
					<div class="text-xs text-slate-400 uppercase tracking-wider">Builders Pesados</div>
				</div>
				<div class="space-y-1">
					<div class="text-2xl sm:text-3xl font-extrabold text-amber-400 font-mono">GSAP</div>
					<div class="text-xs text-slate-400 uppercase tracking-wider">Animaciones Pro</div>
				</div>
			</div>
		</div>
	</div>
</section>
