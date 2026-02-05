<section class="top-kv">
  <?php
  $has_page_kv = function_exists('have_rows') && have_rows('top_kv_slider');
  $has_option_kv = function_exists('have_rows') && have_rows('top_kv_slider', 'option');
  echo "<!-- DEBUG KV: page=" . ($has_page_kv ? 'YES' : 'NO') . ", option=" . ($has_option_kv ? 'YES' : 'NO') . " -->";

  if ($has_page_kv || $has_option_kv):
    $kv_source = $has_page_kv ? null : 'option';
    ?>
    <div class="top-kv__slider swiper">
      <ul class="top-kv__sliderList swiper-wrapper">
        <?php
        while (have_rows('top_kv_slider', $kv_source)):
          the_row();
          $kvSliderImg = get_sub_field('top_kv_slider_img');
          $kvSliderImgPC = $kvSliderImg['top_kv_slider_img_pc'];
          $kvSliderImgSP = $kvSliderImg['top_kv_slider_img_sp'];
          ?>
          <li class="swiper-slide">
            <img src="<?php echo $kvSliderImgPC; ?>" alt="" class="object_fit pc-only">
            <img src="<?php echo $kvSliderImgSP; ?>" alt="" class="object_fit tabsp-only">
          </li>
        <?php endwhile; ?>
      </ul>
      <div class="swiper-pagination"></div>
    </div>
  <?php else: ?>
    <div class="top-kv__slider swiper">
      <ul class="top-kv__sliderList swiper-wrapper">
        <li class="swiper-slide">
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/img_kv.jpg" alt="" class="object_fit pc-only">
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/img_kv-sp.jpg" alt=""
            class="object_fit tabsp-only">
        </li>
      </ul>
    </div>
  <?php endif; ?>
  <span class="top-kv__scroll">Scroll</span>
</section>
<section class=""></section>