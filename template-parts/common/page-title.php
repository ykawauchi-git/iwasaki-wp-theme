<?php
  $page = get_post( get_the_ID() );
  $page_parent = get_post( $post ->post_parent );
  $slug = $page->post_name;
  $page_id = get_option( 'page_on_front' );
  $slug_parent = $page_parent->post_name;
  $ttl = get_the_title();

  //page
  if(is_page()){

	//archives
	}elseif(is_archive()){
	//他
  }elseif(is_page('contact')){
  }elseif(is_page('privacy-policy')){
  }
?>