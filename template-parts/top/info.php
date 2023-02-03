<?php
$sticky = get_option('sticky_posts');
$the_query = new WP_Query($args = array('post_type' => 'post', 'posts_per_page' => 1,'post__in' => $sticky,));
if ($the_query->have_posts()):?>
<section class="top-info">
  <div class="top-info__inner">
    <h2 class="top-info__heading">重要なお知らせ</h2>
    <div class="top-info__box">
      <?php
      while ($the_query->have_posts()):$the_query->the_post(); ?>
      <article class="top-info__post">
        <time class="top-info__date"><?php the_time('Y.m.j');?></time>
        <h3 class="top-info__ttl"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
      </article>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; wp_reset_postdata();?>