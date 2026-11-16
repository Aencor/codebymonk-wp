<?php
/**
 * Block Template: Clients / Social Proof
 *
 * @var array $block The block settings and attributes.
 * @var bool $is_preview True during AJAX preview or Gutenberg inserter.
 */

$block_meta = \CodeByMonk\BlockHelper::setup($block, $is_preview ?? false);

if (\CodeByMonk\BlockHelper::render_preview_if_needed($block_meta)) {
	return;
}

$title = get_field('clients_title') ?: 'Marcas y Proyectos de Alto Impacto';
$lead  = get_field('clients_lead') ?: 'Experiencia colaborando en desarrollos web, activaciones interactivas y proyectos para marcas líderes a nivel global.';

$brands = [
	['name' => 'Warner Bros', 'badge' => 'WARNER BROS'],
	['name' => 'Disney', 'badge' => 'DISNEY'],
	['name' => 'Riot Games', 'badge' => 'RIOT GAMES'],
	['name' => 'Mortal Kombat', 'badge' => 'MORTAL KOMBAT'],
	['name' => 'Liverpool', 'badge' => 'LIVERPOOL'],
	['name' => 'Sunglass Hut', 'badge' => 'SUNGLASS HUT'],
	['name' => 'Colgate', 'badge' => 'COLGATE'],
	['name' => 'LLYC', 'badge' => 'LLYC'],
];
?>

<section 
	id="<?= esc_attr($block_meta['id']); ?>" 
	data-block="clients" 
	class="clients-block py-16 bg-slate-950 border-y border-slate-900 <?= esc_attr($block_meta['classes']); ?>"
>
	<div class="container mx-auto px-4 max-w-7xl">
		<div class="text-center max-w-2xl mx-auto mb-10 space-y-2">
			<h2 class="text-xs uppercase tracking-widest text-slate-400 font-mono"><?= esc_html($title); ?></h2>
			<p class="text-sm text-slate-500"><?= esc_html($lead); ?></p>
		</div>

		<div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 items-center">
			<?php foreach ($brands as $brand) : ?>
				<div class="h-16 flex items-center justify-center p-3 rounded-xl border border-slate-800/80 bg-slate-900/50 hover:border-slate-700 hover:bg-slate-900 transition-all duration-200">
					<span class="text-xs font-mono font-bold tracking-wider text-slate-400 hover:text-white transition-colors text-center">
						<?= esc_html($brand['badge']); ?>
					</span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
