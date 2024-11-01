<div class="page-sitemap">
  <h1 class="page-heading page-sitemap__heading"><span>サイトマップ</span></h1>
  <div class="page-sitemap__inner">
    <ul class="page-sitemap__list">
      <li><a href="<?php echo home_url('/');?>" class="top">トップページ</a></li>
    </ul>
    <div class="page-sitemap__row">
      <?php if(have_rows('sitemap_list_left')):?>
      <ul class="page-sitemap__list left">
        <?php
        while(have_rows('sitemap_list_left')): the_row();
        $sitemapLeftLink = get_sub_field('sitemap_list_left_link');
        ?>
        <?php if($sitemapLeftLink):?>
        <li>
          <a href="<?php echo $sitemapLeftLink['url'];?>" target="<?php echo $sitemapLeftLink['target'];?>"><?php echo $sitemapLeftLink['title'];?></a>
        </li>
        <?php endif;?>
        <?php endwhile;?>
      </ul>
      <?php endif; reset_rows();?>
      <?php if(have_rows('sitemap_list_right')):?>
      <ul class="page-sitemap__list right">
        <?php
        while(have_rows('sitemap_list_right')): the_row();
        $sitemapRightLink = get_sub_field('sitemap_list_right_link');
        ?>
        <?php if($sitemapRightLink):?>
        <li>
          <a href="<?php echo $sitemapRightLink['url'];?>" target="<?php echo $sitemapRightLink['target'];?>"><?php echo $sitemapRightLink['title'];?></a>
        </li>
        <?php endif;?>
        <?php endwhile;?>
      </ul>
      <?php endif;?>
    </div>
  </div>
</div>