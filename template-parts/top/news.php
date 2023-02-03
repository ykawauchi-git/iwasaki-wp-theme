<section class="top-news">
  <h2 class="top-news__heading common-heading">
    <span class="en">NEWS</span>
    <span class="ja">ニュース</span>
  </h2>
  <div class="top-news__inner">
  <?php
    $the_query = new WP_Query($args = array('post_type' => 'post', 'posts_per_page' => 3));
    if ($the_query->have_posts()): while ($the_query->have_posts()):$the_query->the_post();?>
    <article class="top-news__post">
      <figure class="top-news__postThumb">
        <p class="top-news__postDate sp-only"><?php the_time('Y.m.j');?></p>
        <a href="<?php the_permalink();?>">
        <img src="<?php if(has_post_thumbnail()){echo get_the_post_thumbnail_url('','full');}else{echo 'http://placehold.jp/150x150.png';}?>" alt="" class="object_fit">
        </a>
      </figure>
      <figcaption class="top-news__postInfo">
        <p class="top-news__postDate pctab-only"><?php the_time('Y.m.j');?></p>
        <h3 class="top-news__postTtl"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
      </figcaption>
      <?php $tags = get_the_tags();if($tags):?>
        <ul class="top-news__postTag">
          <?php foreach($tags as $tag){?>
          <li><?php echo $tag->name;?></li>
          <?php }?>
        </ul>
        <?php endif;?>
    </article>
    <?php endwhile; endif; wp_reset_postdata();?>
  </div>
  <a href="<?php echo home_url('/');?>" class="btn__more yellow">もっと見る</a>
</section>