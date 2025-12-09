<?php
get_header();
$pageName = "archive-post";
global $wpdb;
// 公開年を取得
$categories = get_categories();
$tag = get_queried_object();
?>
<div class="<?php echo $pageName;?> archive-wrap">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>ニュース一覧</span></h1>
	<div class="<?php echo $pageName;?>__intro">
		<div class="<?php echo $pageName;?>__introHeading"><?php single_tag_title(); ?></div>
		<div class="<?php echo $pageName;?>__introTxt">の記事一覧</div>
	</div>
  <?php
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type'      => 'post', // カスタム投稿タイプのスラッグ
		'tag_id' => $tag->term_id,
    'posts_per_page' => 12,      // 1ページに表示する投稿数
    'orderby'        => 'date', // 日付順
    'order'          => 'DESC', // 新着順
    'paged'          =>  $paged, // 現在のページ番号
  );
  $news_query = new WP_Query($args);
  if ($news_query->have_posts()) :
  ?>
  <div class="<?php echo $pageName;?>__inner">
    <?php while($news_query->have_posts()): $news_query->the_post();?>
    <?php get_template_part('content/loop/post');?>
    <?php endwhile; wp_reset_postdata();?>
  </div>
  <?php endif;?>
  <?php
  get_template_part('template-parts/common/infinite-scroll');
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
<?php
get_footer();
