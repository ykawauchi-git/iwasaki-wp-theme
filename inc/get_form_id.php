<?php
/**
 * MW WP Form の投稿IDをスラッグから取得する関数
 */
function heads_get_mwwpform_id($slug='')
{
  global $wpdb;
  $table = $wpdb->prefix.'posts';
  $query  = "SELECT * FROM $table WHERE post_type='mw-wp-form' AND post_status='publish' AND post_name= %s";
  $result = $wpdb->get_row( $wpdb->prepare( $query, $slug) );

  return (int)$result->ID;
}