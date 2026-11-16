<?php
/**
 * Block Template: CTA (Contact Call to Action)
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('cta_title') ?: '¿Tienes un proyecto en mente? Hablemos.';
$lead  = get_field('cta_lead') ?: 'Ya sea que necesites modernizar una plataforma existente, rescatar un sitio lento o desarrollar un producto digital desde cero, estoy disponible para colaborar.';
$email = get_field('contact_email', 'option') ?: 'enrique@codebymonk.com';
?>

<section 
	id="contacto" 
	data-block="cta" 
	class="cta-block py-28 bg-radial from-slate-900 to-slate-950 relative overflow-hidden border-t border-slate-900 <?= esc_attr($block_meta['classes']); ?>"
>
	<!-- Ambient Glow -->
	<div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-blue-600/10 rounded-full blur-[140px] pointer-events-none"></div>

	<div class="container mx-auto px-4 max-w-5xl relative z-10 text-center space-y-8">
		<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-emerald-400 text-xs sm:text-sm font-mono font-medium">
			<span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
			<span>Agenda Abierta para Nuevos Proyectos</span>
		</div>

		<h2 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight max-w-3xl mx-auto">
			<?= esc_html($title); ?>
		</h2>

		<p class="text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed font-light">
			<?= esc_html($lead); ?>
		</p>

		<!-- Contact Buttons -->
		<div class="flex flex-wrap items-center justify-center gap-4 pt-4">
			<a 
				href="mailto:<?= esc_attr($email); ?>" 
				class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all duration-200 transform hover:-translate-y-0.5"
			>
				Escríbeme a <?= esc_html($email); ?>
			</a>

			<a 
				href="<?php echo esc_url(home_url('/cv/')); ?>" 
				class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-slate-300 hover:text-white bg-slate-900/80 hover:bg-slate-800 border border-slate-700 rounded-xl transition-all duration-200"
			>
				Consultar Mi CV & Experiencia
			</a>
		</div>

		<div class="pt-8 text-xs font-mono text-slate-500">
			<span>Respuesta habitual en menos de 24 horas hábiles &bull; Trabajo directo sin intermediarios</span>
		</div>
	</div>
</section>

