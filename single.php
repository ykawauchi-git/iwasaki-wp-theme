<?php
get_header();
if (have_posts()) {
	while (have_posts()) {
		the_post();
		if ('' !== locate_template('content/single/'.get_post_type().'.php')) {
			get_template_part('content/single/'.get_post_type());
		} else {
			get_template_part('content/single');
		}
	} ?>
		<?php
		if (function_exists('wp_pagenavi')) {
			wp_pagenavi();
		} ?>
<?php
} else {
	get_template_part('content/none');
}
get_footer();
