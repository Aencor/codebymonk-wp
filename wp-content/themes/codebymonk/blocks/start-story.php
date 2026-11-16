<?php
/**
 * Block Template: Start Story / Manifesto
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('story_title') ?: 'Diseñar menos, decidir mejor';
$lead  = get_field('story_lead') ?: 'La tentación más común al crear un nuevo sitio web es agregar: más secciones, más efectos y adornos superfluos. Sin embargo, los productos más exitosos comparten una virtud silenciosa: la capacidad de eliminar el ruido para potenciar lo esencial.';
?>

<section 
	id="filosofia" 
	data-block="start-story" 
	class="start-story-block py-24 bg-slate-950 relative overflow-hidden <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-5xl">
		<div class="rounded-3xl border border-slate-800 bg-radial from-slate-900 to-slate-950 p-8 sm:p-14 lg:p-16 space-y-12">
			<!-- Top Tag -->
			<div class="space-y-3">
				<div class="text-xs uppercase font-mono tracking-widest text-blue-400 font-medium">Filosofía de Trabajo</div>
				<h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white"><?= esc_html($title); ?></h2>
			</div>

			<!-- Main Manifesto Text -->
			<p class="text-lg sm:text-xl text-slate-300 leading-relaxed font-light">
				<?= esc_html($lead); ?>
			</p>

			<!-- 3 Principles -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-6 border-t border-slate-800">
				<div class="space-y-3">
					<div class="w-8 h-8 rounded-lg bg-blue-600/20 text-blue-400 flex items-center justify-center font-mono font-bold text-sm">01</div>
					<h3 class="text-base font-bold text-white">Eliminar la Fricción Visual</h3>
					<p class="text-sm text-slate-400 leading-relaxed">
						Cada píxel compite por la atención del visitante. Si un usuario se abruma con elementos innecesarios, se fatiga antes de entender el valor de tu producto.
					</p>
				</div>

				<div class="space-y-3">
					<div class="w-8 h-8 rounded-lg bg-emerald-600/20 text-emerald-400 flex items-center justify-center font-mono font-bold text-sm">02</div>
					<h3 class="text-base font-bold text-white">Jerarquía con Intención</h3>
					<p class="text-sm text-slate-400 leading-relaxed">
						El diseño facilita la comprensión inmediata. Tipografía sólida y espacios limpios crean un ritmo visual que guía la lectura de forma orgánica.
					</p>
				</div>

				<div class="space-y-3">
					<div class="w-8 h-8 rounded-lg bg-amber-600/20 text-amber-400 flex items-center justify-center font-mono font-bold text-sm">03</div>
					<h3 class="text-base font-bold text-white">La Regla del 80/20</h3>
					<p class="text-sm text-slate-400 leading-relaxed">
						El 80% de las conversiones provienen de entender la propuesta de valor, ver ejemplos reales y contar con vías de contacto directas sin obstáculos.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
