<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php if (!has_site_icon()) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logos/favicon.png'); ?>">
  <?php endif; ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-950 text-slate-100 antialiased selection:bg-blue-600 selection:text-white'); ?>>
<?php wp_body_open(); ?>

<!-- Sticky Navigation Header -->
<header id="site-header" class="sticky top-0 z-50 w-full backdrop-blur-md bg-slate-950/80 border-b border-slate-800/80 transition-all duration-200">
  <div class="container mx-auto px-4 max-w-7xl h-20 flex items-center justify-between gap-6">
    <!-- Brand Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="group flex items-center gap-2.5 font-mono text-xl font-bold tracking-tight text-white hover:text-blue-400 transition-colors">
      <span class="w-3 h-3 rounded-full bg-blue-500 group-hover:scale-125 transition-transform"></span>
      <span>CodeByMonk<span class="text-blue-500">.</span></span>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-slate-300">
      <a href="<?php echo esc_url(home_url('/')); ?>#proyectos" class="hover:text-white transition-colors">Proyectos</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#casos-de-estudio" class="hover:text-white transition-colors">Casos de Estudio</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#filosofia" class="hover:text-white transition-colors">Filosofía</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#servicios" class="hover:text-white transition-colors">Servicios</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#sobre-mi" class="hover:text-white transition-colors">Sobre Mí</a>
      <a href="<?php echo esc_url(home_url('/')); ?>#articulos" class="hover:text-white transition-colors">Artículos</a>
      <a href="<?php echo esc_url(home_url('/cv/')); ?>" class="hover:text-white transition-colors text-slate-400">Mi CV</a>
    </nav>

    <!-- Header CTA Action -->
    <div class="flex items-center gap-4">
      <a 
        href="<?php echo esc_url(home_url('/')); ?>#contacto" 
        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-lg shadow-md hover:shadow-blue-500/20 transition-all duration-200"
      >
        Hablemos &rarr;
      </a>
    </div>
  </div>
</header>
