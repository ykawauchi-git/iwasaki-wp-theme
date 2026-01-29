<?php
function custom_posts() {
  global $wp_query;
  if($wp_query->is_admin) return; // 管理画面内は除く
  if(is_post_type_archive()){ // アーカイブページ
    $wp_query->query_vars['post_status'] = 'publish'; // 投稿ステータス「公開済」
  }
}
add_filter('pre_get_posts', 'custom_posts');