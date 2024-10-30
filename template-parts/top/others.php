<?php $secName = "top-others";?>
<section class="<?php echo $secName;?>">
  <?php if(have_rows('top_others')):?>
  <ul class="<?php echo $secName;?>__list">
    <?php
    while(have_rows('top_others')): the_row();
    $othersLink = get_sub_field('top_others_link');
    $othersThumb = get_sub_field('top_others_thumb');
    ?>
    <li>
      <a href="<?php echo $othersLink['url'];?>" target="<?php echo $othersLink['target'];?>">
        <img class="object_fit" src="<?php echo $othersThumb;?>" alt="">
        <span><?php echo $othersLink['title'];?></span>
      </a>
    </li>
    <?php endwhile;?>
  </ul>
  <?php endif;?>
</section>