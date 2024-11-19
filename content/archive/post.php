<?php
$pageName = "archive-post";
?>
<div class="<?php echo $pageName;?> archive-wrap">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>ニュース一覧</span></h1>
  <div class="<?php echo $pageName;?>__select">年　度</div>
  <ul class="<?php echo $pageName;?>__cat">
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
  <div class="<?php echo $pageName;?>__inner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('content/loop/post');?>
    <?php endwhile; endif;?>
  </div>
  <?php get_template_part('template-parts/common/infinite-scroll'); ?>
	<?php
	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	} 
	?>
  <?php
  $allTags = get_tags();
  if($allTags):
  ?>
  <div class="<?php echo $pageName;?>__tag">
    <h2 class="page-subHeading"><span>その他のキーワード</span></h2>
    <ul class="<?php echo $pageName;?>__tagList">
      <?php
      foreach($allTags as $tag) :
      $tag_link = get_tag_link($tag->term_id);
      $tag_name = $tag->name;
      ?>
      <li><a href="<?php echo $tag_link; ?>"><?php echo $tag_name; ?></a></li>
      <?php endforeach;?>
    </ul>
  </div>
  <?php endif;?>
</div>