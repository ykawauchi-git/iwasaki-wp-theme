<div class="archive-post archive-wrap">
  <ul class="archive-post__cat">
  <?php
    $args = array(
    'orderby' => 'name'
    );
    $categories = get_categories( $args );
    echo '<li><a href="' . home_url('/news/') . '">全　て</a></li>';
    foreach ( $categories as $category ) {
    $cat_link = get_category_link($category->cat_ID);
    echo '<li><a href="' . $cat_link . '">' . $category->name . '</a></li>';
    }
  ?>
  </ul>
  <div class="archive-post__inner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('content/loop/post');?>
    <?php endwhile; endif;?>
  </div>
</div>