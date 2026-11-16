<?php
/**
 * Block Template: About
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('about_title') ?: 'Sobre Mí & CodeByMonk';
$lead  = get_field('about_lead') ?: 'Detrás de CodeByMonk está Enrique Contreras, Ingeniero Frontend y Especialista en WordPress con más de 10 años de trayectoria creando software web de alto rendimiento.';
?>

<section 
	id="sobre-mi" 
	data-block="about" 
	class="about-block py-24 bg-slate-900/40 border-t border-slate-900 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
			<!-- Text Content -->
			<div class="lg:col-span-7 space-y-6">
				<div class="text-xs uppercase tracking-widest text-blue-400 font-mono font-medium">Trayectoria Profesional</div>
				<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
				<p class="text-base sm:text-lg text-slate-300 leading-relaxed font-light"><?= esc_html($lead); ?></p>

				<div class="space-y-4 text-sm sm:text-base text-slate-400 leading-relaxed">
					<p>
						A lo largo de mi carrera he colaborado con agencias globales, startups tecnológicas y empresas consolidadas, entregando soluciones web para marcas como Warner Bros, Disney, Riot Games, Mortal Kombat, Liverpool, Sunglass Hut, Colgate y LLYC.
					</p>
					<p>
						Mi filosofía es simple: no construyo sitios web genéricos sobre plantillas prefabricadas. Desarrollo temas nativos desde cero con código modular, semántica HTML5 estricta, diseño intencional y animaciones que respetan el hilo principal del navegador.
					</p>
				</div>

				<div class="pt-4 flex flex-wrap items-center gap-4">
					<a 
						href="<?php echo esc_url(home_url('/cv/')); ?>" 
						class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-xl shadow-md transition-colors gap-2"
					>
						<span>Ver Mi Currículum Vitae</span>
						<span>&rarr;</span>
					</a>
					<a 
						href="#contacto" 
						class="inline-flex items-center px-6 py-3 text-sm font-semibold text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-xl transition-colors"
					>
						Iniciar Conversación
					</a>
				</div>
			</div>

			<!-- Visual Highlight Card -->
			<div class="lg:col-span-5">
				<div class="rounded-3xl border border-slate-800 bg-slate-950 p-8 sm:p-10 space-y-6 shadow-2xl relative overflow-hidden">
					<div class="absolute -top-12 -right-12 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

					<div class="space-y-2">
						<div class="text-xs font-mono uppercase tracking-wider text-slate-500">Stack Principal</div>
						<div class="text-xl font-bold text-white">Tecnologías de Vanguardia</div>
					</div>

					<div class="space-y-3 font-mono text-xs">
						<div class="flex items-center justify-between p-3 rounded-lg bg-slate-900/80 border border-slate-800">
							<span class="text-slate-300">WordPress Gutenberg + ACF Pro</span>
							<span class="text-blue-400 font-bold">100% Nativo</span>
						</div>
						<div class="flex items-center justify-between p-3 rounded-lg bg-slate-900/80 border border-slate-800">
							<span class="text-slate-300">Tailwind CSS v4 & SCSS</span>
							<span class="text-emerald-400 font-bold">Modular</span>
						</div>
						<div class="flex items-center justify-between p-3 rounded-lg bg-slate-900/80 border border-slate-800">
							<span class="text-slate-300">GSAP & ScrollTrigger</span>
							<span class="text-amber-400 font-bold">Fluid 60FPS</span>
						</div>
						<div class="flex items-center justify-between p-3 rounded-lg bg-slate-900/80 border border-slate-800">
							<span class="text-slate-300">Google Core Web Vitals</span>
							<span class="text-emerald-400 font-bold">95-100 LCP/CLS</span>
						</div>
						<div class="flex items-center justify-between p-3 rounded-lg bg-slate-900/80 border border-slate-800">
							<span class="text-slate-300">Docker & MariaDB</span>
							<span class="text-blue-400 font-bold">DevOps Ready</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

