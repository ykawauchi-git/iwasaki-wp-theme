<?php
function change_posts_archive($query) {
 /* 管理画面,メインクエリに干渉しないために必須 */
if ( is_admin() || ! $query->is_main_query() ){
     return;
 }
}
add_action( 'pre_get_posts', 'change_posts_archive' );
