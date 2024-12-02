<?php
function custom_opengraph_image($img) {
	global $post;

  if(get_field('thumb_detail', $post->ID)){
    $top_image = get_field('thumb_detail', $post->ID);
  } elseif(has_post_thumbnail( $post->ID )) {
    $top_image = get_the_post_thumbnail_url($post->ID , 'full' );
  } else {
    $wp_upload_dir = wp_upload_dir();
    $top_image = $wp_upload_dir['baseurl'] . '/2024/12/img_none.jpg';
  }

	if (is_singular(array('post'))){
    if($top_image){
      return $top_image;
    }
	}
	return $img;
}
add_filter('wpseo_opengraph_image', 'custom_opengraph_image');