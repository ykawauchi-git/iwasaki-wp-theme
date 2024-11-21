<?php
// 現在の固定ページIDを取得
$page_id = get_the_ID();

// 固定ページの投稿オブジェクトを取得
$page = get_post($page_id);

get_header();
if (have_posts()) {
	while (have_posts()) {
		the_post();
		if ($page && !empty(trim($page->post_content))) {
			get_template_part('content/page');
		} elseif('' !== locate_template('content/page/'.get_page_uri().'.php')) {
			get_template_part('content/page/'.get_page_uri());
		}
	}
	?>
	<?php if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	} ?>
<?php
} else {
		get_template_part('content/none');
	}
get_footer();
