<?php
get_header();
$pageName = "common-archive";
?>

<section class="<?php echo $pageName;?>">
  <h2 class="<?php echo $pageName;?>__heading page-heading"><span>NEWS</span></h2>
  <?php $cats = get_the_category(); ?>
  <ul class="<?php echo $pageName;?>__cat">
    <?php $cats = get_categories(); ?>
    <li>
      <a href="<?php echo home_url('/news/');?>">全　て</a>
    </li>
    <?php foreach( $cats as $cat ) : ?>
      <li>
        <a href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php
    $paged = get_query_var('paged')? get_query_var('paged') : 1;
    $args= new WP_Query( array(
      'post_type' => 'post',
      'paged' => $paged,
      'post_status' => 'publish',
      'posts_per_page' => 12,
    ));
    if ( $args ->have_posts() ) :
  ?>
  <div class="<?php echo $pageName;?>__inner">
      <!-- ループ -->
      <?php while ( $args -> have_posts() ) : $args -> the_post(); ?>
        <?php get_template_part('content/loop/post');?>
      <?php endwhile; ?>
  </div>
  <?php
  // サブクエリをリセット
    wp_reset_postdata();
    endif;
  ?>
  <div class="common-moreBtn">
    <?php get_template_part('template-parts/common/infinite-scroll'); ?>
    <?php
    if (function_exists('wp_pagenavi')) {
      wp_pagenavi();
    } ?>
  </div>
</section>

<?php get_footer();