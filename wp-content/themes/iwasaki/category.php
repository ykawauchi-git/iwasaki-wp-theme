<?php
get_header();

?>
<?php
$pageName = "archive-post";
global $wpdb;
// 公開年を取得
$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date DESC");
$categories = get_categories();
$current_year = isset($_GET['year']) ? $_GET['year'] : '';
$current_cat = isset($_GET['cat']) ? $_GET['cat'] : '';
$current_obj = get_queried_object();
if($current_obj) {
  // カテゴリースラッグの取得
  $current_category_slug = $current_obj->slug;
}
?>
<div class="<?php echo $pageName;?> archive-wrap">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>ニュース一覧</span></h1>
  <form class="<?php echo $pageName;?>__search" method="GET" action="<?php echo home_url( '/news/' ); ?>">
    <div class="<?php echo $pageName;?>__year">
      <select name="year">
        <option value="">年　次</option>
        <?php foreach($years as $year): ?>
            <option value="<?php echo $year; ?>" <?php selected($current_year, $year); ?>><?php echo $year; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- カテゴリのタブボタン -->
    <div class="<?php echo $pageName;?>__cat">
        <button type="button" data-category="" class="<?php echo empty($current_cat) ? 'active' : ''; ?>">全　て</button>
        <?php foreach($categories as $category): ?>
          <button type="button" data-category="<?php echo $category->term_id; ?>" class="<?php echo ($current_cat == $category->term_id) ? 'active' : ''; ?>">
              <?php echo $category->name; ?>
          </button>
        <?php endforeach; ?>
    </div>
    <input type="hidden" name="cat" value="<?php echo esc_attr($current_cat); ?>">

    <!-- 絞り込みボタン -->
    <button class="btn__more b" type="submit">絞り込む</button>
  </form>

  <?php
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      'post_type'      => 'post', // カスタム投稿タイプのスラッグ
      'posts_per_page' => 12,      // 1ページに表示する投稿数
      'orderby'        => 'date', // 日付順
      'order'          => 'DESC', // 新着順
      'tax_query'      => [
        [
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $current_category_slug,
        ]
      ],
      'paged'          =>  $paged, // 現在のページ番号
    );
  if(!empty($current_year)) {
    $args['year'] = $current_year;
  }

  if(!empty($current_cat)) {
    $args['cat'] = $current_cat;
  }
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
