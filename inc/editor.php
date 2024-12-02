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

function disable_visual_editor_for_post_types($can_edit, $post) {
    // お知らせページ以外でビジュアルエディタを無効にする
    if (!is_admin() || !$post) {
        return $can_edit;
    }

    // 投稿タイプを取得
    $post_type = get_post_type($post);

    // お知らせページの投稿タイプを指定（例: 'news' がカスタム投稿タイプのスラッグの場合）
    if ($post_type !== 'post' && $post_type !== 'career') {
        // ビジュアルエディタを無効にする
        add_filter('user_can_richedit', '__return_false');
    }

    return $can_edit;
}
add_filter('use_block_editor_for_post', 'disable_visual_editor_for_post_types', 10, 2);