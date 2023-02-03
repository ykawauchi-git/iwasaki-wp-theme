<?php

function heads_aioseo_filter_robots_meta( $attributes ) {
  if (has_term('liquor_store','shop_type') ) {
      $attributes['noindex']  = 'noindex';
      $attributes['nofollow'] = 'nofollow';
  }
  return $attributes;
}
add_filter( 'aioseo_robots_meta', 'heads_aioseo_filter_robots_meta' );

//リダイレクト
function heads_specific_url_redirect(){
  if (has_term('liquor_store','shop_type') && is_single() ) {
		wp_redirect( home_url('/'), 301 );
		exit;
	}
}
add_action( 'get_header', 'heads_specific_url_redirect' );
