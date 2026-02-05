<?php
$secName = "top-banner";
?>
<section class="<?php echo $secName;?>">
  <?php
  if(have_rows('top_banner')):
  ?>
  <div class="<?php echo $secName;?>__slider swiper">
    <ul class="<?php echo $secName;?>__list swiper-wrapper">
      <?php
      while(have_rows('top_banner')): the_row();
      $bannerLink = get_sub_field('top_banner_link');
      $bannerThumb = get_sub_field('top_banner_thumb');
      ?>
      <li class="<?php echo $secName;?>__item swiper-slide"><a href="<?php echo $bannerLink['url'];?>" target="<?php echo $bannerLink['target'];?>"><img class="object_fit" src="<?php echo $bannerThumb;?>" alt="<?php echo $bannerLink['title'];?>"></a></li>
      <?php endwhile;?>
    </ul>
    <div class="swiper-pagination"></div>
  </div>
  <?php endif;?>
</section>