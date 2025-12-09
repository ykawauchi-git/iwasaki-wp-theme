<?php
//自動整形無効化
function custom_remove_wpautop() {
  if (is_front_page() || is_home() || is_page()) {
    remove_filter('the_content', 'wpautop');
  }
}
add_action('wp', 'custom_remove_wpautop');

// 固定ページの編集画面でのみ自動整形を無効化
add_action('init', function () {
  add_filter('the_content', 'disable_wpautop_for_pages', 9);
  add_filter('content_save_pre', 'disable_wpautop_for_pages_on_save', 9);
});

function disable_wpautop_for_pages($content) {
  if (is_admin() && get_post_type() === 'page') {
      // フロントエンドとエディタで整形を無効化
      remove_filter('the_content', 'wpautop');
  }
  return $content;
}

function disable_wpautop_for_pages_on_save($content) {
  if (is_admin() && get_post_type() === 'page') {
      // 保存時の整形を無効化
      remove_filter('content_save_pre', 'wpautop');
  }
  return $content;
}

// クラシックブロックの自動整形を無効化
add_filter('tiny_mce_before_init', function ($initArray) {
  // 自動整形を無効化
  $initArray['wpautop'] = false;
  $initArray['forced_root_block'] = false;
  $initArray['force_br_newlines'] = true;
  return $initArray;
});

// クラス名を保持する
add_filter('tiny_mce_before_init', function ($init) {
  // クラス属性を保持
  $init['extended_valid_elements'] = '*[*]';
  return $init;
});

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
  if (!use_block_editor_for_post_type($post_type)) {
    if ($post_type !== 'post' && $post_type !== 'career') {
    // ビジュアルエディタを無効にする
      add_filter('user_can_richedit', '__return_false');
    }
  }
  return $can_edit;
}
add_filter('use_block_editor_for_post', 'disable_visual_editor_for_post_types', 10, 2);

