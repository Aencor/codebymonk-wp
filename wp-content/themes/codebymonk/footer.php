<?php
/**
 * The template for displaying the footer
 *
 * 100% Dynamic from ACF Theme Options (Rule 4)
 */

$widgets      = get_field('widgets', 'option');
$copyright    = get_field('copyright', 'option');
$social_media = get_field('social_media', 'option');
?>

<footer id="site-footer" class="site-footer bg-slate-950 text-slate-300 py-12 mt-auto border-t border-slate-800">
  <div class="container mx-auto px-4 max-w-7xl">
    <?php if (!empty($widgets) && is_array($widgets)) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <?php foreach ($widgets as $widget) : ?>
          <div class="footer-widget">
            <?php if (!empty($widget['title'])) : ?>
              <h3 class="text-white text-base font-semibold mb-4 tracking-wide uppercase font-mono">
                <?php echo esc_html($widget['title']); ?>
              </h3>
            <?php endif; ?>

            <?php if (!empty($widget['links']) && is_array($widget['links'])) : ?>
              <ul class="space-y-2">
                <?php foreach ($widget['links'] as $item) : ?>
                  <?php if (!empty($item['link']) && is_array($item['link'])) : 
                    $target = !empty($item['link']['target']) ? $item['link']['target'] : '_self';
                  ?>
                    <li>
                      <a 
                        href="<?php echo esc_url($item['link']['url']); ?>" 
                        target="<?php echo esc_attr($target); ?>"
                        rel="<?php echo $target === '_blank' ? 'noopener noreferrer' : 'follow'; ?>"
                        class="text-slate-400 hover:text-white transition-colors duration-200 text-sm"
                      >
                        <?php echo esc_html($item['link']['title']); ?>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="footer-bottom border-t border-slate-800/80 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500">
      <div class="copyright">
        <?php if (!empty($copyright)) : ?>
          <span><?php echo esc_html($copyright); ?></span>
        <?php else : ?>
          <span>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</span>
        <?php endif; ?>
      </div>

      <?php if (!empty($social_media) && is_array($social_media)) : ?>
        <div class="social-links flex items-center space-x-4">
          <?php foreach ($social_media as $social) : ?>
            <?php if (!empty($social['url']) && is_array($social['url'])) : 
              $s_target = !empty($social['url']['target']) ? $social['url']['target'] : '_blank';
            ?>
              <a 
                href="<?php echo esc_url($social['url']['url']); ?>" 
                target="<?php echo esc_attr($s_target); ?>"
                rel="noopener noreferrer"
                aria-label="<?php echo esc_attr($social['url']['title'] ?: 'Social Link'); ?>"
                class="text-slate-400 hover:text-white transition-colors duration-200 text-lg"
              >
                <?php if (!empty($social['icon'])) : ?>
                  <?php echo $social['icon']; ?>
                <?php else : ?>
                  <span><?php echo esc_html($social['url']['title']); ?></span>
                <?php endif; ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
