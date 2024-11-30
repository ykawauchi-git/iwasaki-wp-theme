<?php
function custom_remove_wpautop() {
    if (is_front_page() || is_home() || is_page()) {
        remove_filter('the_content', 'wpautop');
    }
}
add_action('wp', 'custom_remove_wpautop');

function enable_default_gallery_style() {
	add_filter('use_default_gallery_style', '__return_true');
}
add_action('after_setup_theme', 'enable_default_gallery_style');