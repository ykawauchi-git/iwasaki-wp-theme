<?php
get_header();
if (have_posts()) {
  while (have_posts()) {
    the_post();
    if (!empty(trim(get_the_content()))) {
      get_template_part('content/page');
    } elseif ('' !== locate_template('content/page/' . get_page_uri() . '.php')) {
      get_template_part('content/page/' . get_page_uri());
    } else {
      get_template_part('content/page');
    }
  }
  ?>
  <?php if (is_page('philosophy')): ?>
    <div class="mod-banner">
      <?php
      $ctaHeading = function_exists('get_field') ? get_field('cta_heading', 'option') : '';
      $ctaTxt = function_exists('get_field') ? get_field('cta_txt', 'option') : '';
      ?>
      <?php if ($ctaHeading): ?>
        <div class="mod-banner__ttl"><span><?php echo $ctaHeading; ?></span></div>
      <?php endif; ?>
      <?php if ($ctaTxt): ?>
        <div class="mod-banner__txt">
          <?php echo $ctaTxt; ?>
        </div>
      <?php endif; ?>
      <?php if (function_exists('have_rows') && have_rows('cta_btn', 'option')): ?>
        <div class="mod-banner__btn">
          <?php
          while (have_rows('cta_btn', 'option')):
            the_row();
            $ctaBtn = get_sub_field('cta_btn_item', 'option');
            ?>
            <a href="<?php echo $ctaBtn['url']; ?>" target="<?php echo $ctaBtn['target']; ?>"
              class="mod-btn b"><?php echo $ctaBtn['title']; ?></a>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (function_exists('wp_pagenavi')) {
    wp_pagenavi();
  } ?>
<?php
} else {
  get_template_part('content/none');
}
get_footer();
