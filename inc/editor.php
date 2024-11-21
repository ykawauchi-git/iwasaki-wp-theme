<?php
function custom_remove_wpautop() {
    if (is_front_page() || is_home() || is_page()) {
        remove_filter('the_content', 'wpautop');
    }
}
add_action('wp', 'custom_remove_wpautop');