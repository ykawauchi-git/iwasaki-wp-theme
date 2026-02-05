<?php

function remove_yoast_twitter_author_meta( $data ) {
  if ( isset( $data['twitter_author'] ) ) {
      unset( $data['twitter_author'] );
  }
  return $data;
}
add_filter( 'wpseo_twitter_card', 'remove_yoast_twitter_author_meta', 10, 1 );
