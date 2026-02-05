<?php
$secName = "top-banner";
?>
<section class="<?php echo $secName; ?>">
  <?php
  $has_page_banner = function_exists('have_rows') && have_rows('top_banner');
  $has_option_banner = function_exists('have_rows') && have_rows('top_banner', 'option');
  echo "<!-- DEBUG BANNER: page=" . ($has_page_banner ? 'YES' : 'NO') . ", option=" . ($has_option_banner ? 'YES' : 'NO') . " -->";

  if ($has_page_banner || $has_option_banner):
    $banner_source = $has_page_banner ? null : 'option';
    ?>
    <div class="<?php echo $secName; ?>__slider swiper">
      <ul class="<?php echo $secName; ?>__list swiper-wrapper">
        <?php
        while (have_rows('top_banner', $banner_source)):
          the_row();
          $bannerLink = get_sub_field('top_banner_link');
          $bannerThumb = get_sub_field('top_banner_thumb');
          ?>
          <li class="<?php echo $secName; ?>__item swiper-slide"><a href="<?php echo $bannerLink['url']; ?>"
              target="<?php echo $bannerLink['target']; ?>"><img class="object_fit" src="<?php echo $bannerThumb; ?>"
                alt="<?php echo $bannerLink['title']; ?>"></a></li>
        <?php endwhile; ?>
      </ul>
      <div class="swiper-pagination"></div>
    </div>
  <?php else: ?>
    <div class="<?php echo $secName; ?>__slider swiper">
      <ul class="<?php echo $secName; ?>__list swiper-wrapper">
        <li class="<?php echo $secName; ?>__item swiper-slide">
          <a href="#"><img class="object_fit" src="<?php echo get_template_directory_uri(); ?>/img/top/img_banner.png"
              alt="Banner Fallback"></a>
        </li>
      </ul>
    </div>
  <?php endif; ?>
</section>