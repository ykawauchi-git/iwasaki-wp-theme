<?php
get_header();
if (have_posts()) {
	while (have_posts()) {
		the_post();
		if ('' !== locate_template('content/page/'.get_page_uri().'.php')) {
			get_template_part('content/page/'.get_page_uri());
		} else {
			get_template_part('content/page');
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
