<?php
/**
 * Block Template: Services
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('services_title') ?: 'Servicios de Ingeniería Frontend & WordPress';
$lead  = get_field('services_lead') ?: 'Soluciones digitales diseñadas para empresas que no pueden permitirse sitios web lentos, genéricos o difíciles de mantener.';

$services = [
	[
		'title' => 'WordPress en Bloques (Gutenberg + ACF Pro)',
		'desc'  => 'Desarrollo de temas a la medida basados 100% en bloques Gutenberg con ACF Pro. Cero page builders lentos (Elementor o Divi), código semántico limpio y total autonomía para tu equipo.',
		'tag'   => 'Core WordPress',
	],
	[
		'title' => 'Frontend Moderno & Tailwind CSS v4',
		'desc'  => 'Arquitectura frontend escalable, maquetación responsiva con Tailwind CSS y componentes modulares listos para producción con máxima velocidad de renderizado.',
		'tag'   => 'Modern CSS',
	],
	[
		'title' => 'Animaciones Fluidas con GSAP',
		'desc'  => 'Interacciones inmersivas, efectos de scroll y timelines sincronizados con GSAP y ScrollTrigger. Añadimos valor de marca sin penalizar el rendimiento ni el hilo principal.',
		'tag'   => 'GreenSock GSAP',
	],
	[
		'title' => 'E-Commerce con WooCommerce',
		'desc'  => 'Tiendas en línea robustas, catálogos optimizados para alta conversión, pasarelas de pago blindadas y programas de fidelización o puntos a la medida.',
		'tag'   => 'WooCommerce',
	],
	[
		'title' => 'Optimización Core Web Vitals & PageSpeed',
		'desc'  => 'Auditoría y optimización extrema para obtener puntuaciones 95-100 en Google PageSpeed Insights. Reducción de LCP, INP instantáneo y cero Cumulative Layout Shift (CLS).',
		'tag'   => 'PageSpeed 100/100',
	],
	[
		'title' => 'Diseño de Producto UI/UX Intencional',
		'desc'  => 'Diseño de interfaces centrado en la usabilidad, claridad visual y conversión. Prototipos en Figma trasladados al código con fidelidad absoluta al píxel.',
		'tag'   => 'UI/UX Design',
	],
];
?>

<section 
	id="servicios" 
	data-block="services" 
	class="services-block py-24 bg-slate-950 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<!-- Section Header -->
		<div class="max-w-3xl mb-16 space-y-4">
			<div class="text-xs uppercase tracking-widest text-blue-400 font-mono font-medium">Capacidades Técnicas</div>
			<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
			<p class="text-base sm:text-lg text-slate-400 leading-relaxed"><?= esc_html($lead); ?></p>
		</div>

		<!-- Services Grid -->
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			<?php foreach ($services as $svc) : ?>
				<div class="p-8 rounded-2xl border border-slate-800/80 bg-slate-900/40 hover:border-blue-500/40 hover:bg-slate-900/80 transition-all duration-300 space-y-4 flex flex-col justify-between">
					<div class="space-y-3">
						<span class="inline-block px-3 py-1 rounded-md text-xs font-mono font-medium bg-blue-900/30 text-blue-400 border border-blue-700/30">
							<?= esc_html($svc['tag']); ?>
						</span>
						<h3 class="text-xl font-bold text-white"><?= esc_html($svc['title']); ?></h3>
						<p class="text-sm text-slate-400 leading-relaxed"><?= esc_html($svc['desc']); ?></p>
					</div>

					<div class="pt-2 text-xs font-mono text-slate-500 flex items-center gap-2">
						<span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
						<span>Disponible para proyectos</span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

