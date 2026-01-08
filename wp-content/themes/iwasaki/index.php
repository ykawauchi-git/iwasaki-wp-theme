<?php

if (is_category()|| is_tag() || is_date() || is_day() || is_year() ) {
	get_template_part('home');
} else {
	get_header();
	echo "<div class='container'>";
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			get_template_part('content/loop/'.get_post_type());
		}
		if (function_exists('wp_pagenavi')) {
			wp_pagenavi();
		}
	} else {
		get_template_part('content/none');
	}
	echo '</div></div>';
	get_footer();
}
