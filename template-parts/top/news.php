<?php $secName = "top-news";?>
<section class="<?php echo $secName;?>">
  <div class="<?php echo $secName;?>__inner">
    <h2>NEWS</h2>
    <div class="<?php echo $secName;?>__list">
      <?php
      $the_query = new WP_Query($args = array('post_type' => 'post', 'posts_per_page' => 3));
      if ($the_query->have_posts()): while ($the_query->have_posts()):$the_query->the_post();
      ?>
      <article class="<?php echo $secName;?>__post">
          <figure class="<?php echo $secName;?>__postThumb">
            <a href="<?php the_permalink();?>">
              <img src="<?php if(has_post_thumbnail()){echo get_the_post_thumbnail_url('','full');}else{echo 'http://placehold.jp/150x150.png';}?>" alt="" class="object_fit">
            </a>
          </figure>
          <figcaption class="<?php echo $secName;?>__postInfo">
            <a href="<?php the_permalink();?>">
              <p class="<?php echo $secName;?>__postDate"><?php the_time('Y.m.j');?></p>
              <h3 class="<?php echo $secName;?>__postTtl"><?php the_title();?></h3>
            </a>
            <?php $tags = get_the_tags();if($tags):?>
            <ul class="<?php echo $secName;?>__postTag">
              <?php
              foreach($tags as $tag){
              $tag_name = $tag->name;
              $tag_link = get_tag_link($tag->term_id);
              ?>
              <li><a href="<?php echo $tag_link;?>"><?php echo $tag_name; ?></a></li>
              <?php }?>
            </ul>
            <?php endif;?>
          </figcaption>
      </article>
      <?php endwhile; endif; wp_reset_postdata();?>
    </div>
  </div>
  <a href="<?php echo home_url('/news/');?>" class="btn__more w">もっと見る</a>
</section>