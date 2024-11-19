<?php
get_header();
if (is_archive()) {
		if ('' !== locate_template('content/archive/'.get_query_var('post_type').'.php')) {
			get_template_part('content/archive/'.get_query_var('post_type'));
		} else {
			get_template_part('content/archive');
		}
	?>
<?php
} else {
	get_template_part('content/none');
}
get_footer();
