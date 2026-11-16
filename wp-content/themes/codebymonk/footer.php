<?php
/**
 * The template for displaying the footer
 *
 * @package codebymonk
 */

$copyright = get_field('copyright', 'option') ?: '&copy; ' . date('Y') . ' CodeByMonk. Todos los derechos reservados.';
$social_media = get_field('social_media', 'option');
?>

<footer id="site-footer" class="site-footer bg-slate-950 text-slate-300 pt-16 pb-12 border-t border-slate-800/80">
  <div class="container mx-auto px-4 max-w-7xl space-y-12">
    <!-- Top Footer Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
      <!-- Col 1: Brand Info -->
      <div class="lg:col-span-2 space-y-4">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center gap-2 font-mono text-xl font-bold tracking-tight text-white">
          <span class="w-3 h-3 rounded-full bg-blue-500"></span>
          <span>CodeByMonk<span class="text-blue-500">.</span></span>
        </a>
        <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
          Estudio de desarrollo web frontend y WordPress de alto rendimiento. Arquitectura limpia, animaciones fluidas con GSAP y optimización extrema de Core Web Vitals.
        </p>
        <div class="pt-2 text-xs font-mono text-slate-500">
          Ubicación: Ciudad de México / Remoto Global
        </div>
      </div>

      <!-- Col 2: Explorar -->
      <div class="space-y-3">
        <h3 class="text-xs font-mono uppercase tracking-wider text-white font-bold">Navegación</h3>
        <ul class="space-y-2 text-sm text-slate-400">
          <li><a href="<?php echo esc_url(home_url('/')); ?>#proyectos" class="hover:text-white transition-colors">Proyectos</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#casos-de-estudio" class="hover:text-white transition-colors">Casos de Estudio</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#filosofia" class="hover:text-white transition-colors">Filosofía</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#servicios" class="hover:text-white transition-colors">Servicios</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#sobre-mi" class="hover:text-white transition-colors">Sobre Mí</a></li>
        </ul>
      </div>

      <!-- Col 3: Contenido -->
      <div class="space-y-3">
        <h3 class="text-xs font-mono uppercase tracking-wider text-white font-bold">Recursos</h3>
        <ul class="space-y-2 text-sm text-slate-400">
          <li><a href="<?php echo esc_url(home_url('/')); ?>#articulos" class="hover:text-white transition-colors">Artículos</a></li>
          <li><a href="<?php echo esc_url(home_url('/cv/')); ?>" class="hover:text-white transition-colors">Mi CV Completo</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#contacto" class="hover:text-white transition-colors">Contacto Directo</a></li>
          <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="hover:text-white transition-colors">Privacidad</a></li>
        </ul>
      </div>

      <!-- Col 4: Contacto & Redes -->
      <div class="space-y-3">
        <h3 class="text-xs font-mono uppercase tracking-wider text-white font-bold">Conectar</h3>
        <ul class="space-y-2 text-sm text-slate-400">
          <li>
            <a href="mailto:enrique@codebymonk.com" class="hover:text-blue-400 transition-colors font-mono text-xs">
              enrique@codebymonk.com
            </a>
          </li>
          <li>
            <a href="https://github.com/Aencor" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors flex items-center gap-2">
              <i class="fa-brands fa-github"></i>
              <span>GitHub</span>
            </a>
          </li>
          <li>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors flex items-center gap-2">
              <i class="fa-brands fa-linkedin"></i>
              <span>LinkedIn</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottom Footer Row -->
    <div class="pt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
      <div class="copyright">
        <?= wp_kses_post($copyright); ?>
      </div>

      <div class="flex items-center gap-2 font-mono">
        <span>Construido con WordPress, Tailwind CSS v4 & GSAP</span>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
