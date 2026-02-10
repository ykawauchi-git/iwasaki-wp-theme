<section class="top-kv">
  <?php if (have_rows('top_kv_slider')): ?>
  <div class="top-kv__slider swiper">
    <ul class="top-kv__sliderList swiper-wrapper">
      <?php
  while (have_rows('top_kv_slider')):
    the_row();
    $kvSliderImg = get_sub_field('top_kv_slider_img');
    $kvSliderImgPC = $kvSliderImg['top_kv_slider_img_pc'];
    $kvSliderImgSP = $kvSliderImg['top_kv_slider_img_sp'];

    // Convert attachment ID to URL if needed
    if (is_numeric($kvSliderImgPC)) {
      $kvSliderImgPC = wp_get_attachment_url($kvSliderImgPC);
    }
    if (is_numeric($kvSliderImgSP)) {
      $kvSliderImgSP = wp_get_attachment_url($kvSliderImgSP);
    }
?>
      <li class="swiper-slide">
        <img src="<?php echo $kvSliderImgPC; ?>" alt="" class="object_fit pc-only">
        <img src="<?php echo $kvSliderImgSP; ?>" alt="" class="object_fit tabsp-only">
      </li>
      <?php
  endwhile; ?>
    </ul>
    <div class="swiper-pagination"></div>
  </div>
  <?php
endif; ?>
  <?php /*
  <span class="top-kv__catch"><img src="<?php echo get_stylesheet_directory_uri();?>/img/top/txt_kv.svg" alt="" class="object_fit"></span>
  */?>
  <span class="top-kv__scroll">Scroll</span>
</section>

<section class=""></section>