<div class="archive-post archive-wrap">

  <div class="archive-post__inner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('content/loop/career');?>
    <?php endwhile; endif;?>
  </div>
</div>