<section class="top-pages">
  <?php if(have_rows('top_pages')):?>
  <ul class="top-pages__list">
    <?php
    while(have_rows('top_pages')): the_row();
    $pagesTtl = get_sub_field('top_pages_ttl');
    $pagesTtlJP = $pagesTtl['top_pages_ttl_jp'];
    $pagesTtlEN = $pagesTtl['top_pages_ttl_en'];
    $pagesTxt = get_sub_field('top_pages_txt');
    $pagesLink = get_sub_field('top_pages_link');
    $pagesThumb = get_sub_field('top_pages_thumb');
    ?>
    <li class="top-pages__item right">
      <figcaption class="top-pages__itemBox right">
        <?php if($pagesTtlJP):?>
        <h3><?php echo $pagesTtlJP;?></h3>
        <?php endif;?>
        <?php if($pagesTxt):?>
        <p><?php echo $pagesTxt;?></p>
        <?php endif;?>
        <a href="<?php echo home_url('/philosphy/');?>">もっと見る</a>
      </figcaption>
      <?php if($pagesThumb):?>
      <figure class="top-pages__itemThumb">
        <img class="object_fit" src="<?php echo $pagesThumb;?>" alt="" class="object_fit">
        <?php if($pagesTtlEN):?>
        <span><?php echo $pagesTtlEN;?></span>
        <?php endif;?>
      </figure>
      <?php endif;?>
    </li>
    <?php endwhile;?>
  </ul>
  <?php endif;?>
</section>