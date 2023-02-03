<?php

/* DNSプリフェッチ設定の削除 */
add_filter( 'emoji_svg_url', '__return_false' );

//インラインスタイル削除(html直書きstylesheet削除)
function remove_recent_comments_style(){
  global $wp_widget_factory;
  remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ));
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

//全てのバージョンの表示の削除
function remove_cssjs_ver2( $src ) {
  if ( strpos( $src, 'ver=' ) )
  $src = remove_query_arg( 'ver', $src );
  return $src;
}
//add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
//add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );

/* 絵文字削除 */
function dis_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'dis_emojis' );

/* WP5.x.xのブロックエディタ用スタイルの排除 */
wp_deregister_style( 'wp-block-library' );
wp_deregister_style( 'wp-block-library-theme' );

//コメントのフィードなどの表示削除
remove_action('wp_head', 'feed_links_extra', 3);

/* wp-json削除 */
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');

/* 外部投稿ツール設定削除 */
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/* WPのバージョン削除 */
remove_action('wp_head', 'wp_generator');

//wp_head内のプラグインの不要なCSSを読み込まない
function my_delete_plugin_files() {
  wp_dequeue_style('wp-pagenavi');
  wp_dequeue_style('tablepress-default');
}
add_action( 'wp_enqueue_scripts', 'my_delete_plugin_files' );
