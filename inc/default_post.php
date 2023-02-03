<?php

/* 通常投稿アーカイブページ url */
add_filter('register_post_type_args', function($args, $post_type) {
    if ('post' == $post_type) {
        global $wp_rewrite;
        $archive_slug = 'news';
        $args['has_archive'] = $archive_slug;
        $archive_slug = $wp_rewrite->root.$archive_slug;
        $feeds = '(' . trim( implode('|', $wp_rewrite->feeds) ) . ')';
        add_rewrite_rule("{$archive_slug}/?$", "index.php?post_type={$post_type}", 'top');
        add_rewrite_rule("{$archive_slug}/feed/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
        add_rewrite_rule("{$archive_slug}/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
        add_rewrite_rule("{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type={$post_type}".'&paged=$matches[1]', 'top');
    }
    return $args;
}, 10, 2);

//通常投稿記事ページ url
function add_article_post_permalink( $permalink ) {
    $permalink = '/news' . $permalink;
    return $permalink;
}
add_filter( 'pre_post_link', 'add_article_post_permalink' );
 
function add_article_post_rewrite_rules( $post_rewrite ) {
    $return_rule = array();
    foreach ( $post_rewrite as $regex => $rewrite ) {
        $return_rule['news/' . $regex] = $rewrite;
    }
    return $return_rule;
}
add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );

function change_post_menu_label() {
  global $menu;
  global $submenu;
  $menu[5][0] = 'お知らせ';
  $submenu['edit.php'][5][0] = 'お知らせ一覧';
  $submenu['edit.php'][10][0] = '新規追加';
  $submenu['edit.php'][16][0] = 'タグ';
}

function change_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'お知らせ';
  $labels->singular_name = 'お知らせ';
  $labels->add_new = _x('追加', 'お知らせ');
  $labels->add_new_item = 'お知らせの新規追加';
  $labels->edit_item = 'お知らせの編集';
  $labels->new_item = 'お知らせ記事';
  $labels->view_item = 'お知らせを表示';
  $labels->search_items = 'お知らせを検索';
  $labels->not_found = 'お知らせが見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱にお知らせは見つかりませんでした';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );