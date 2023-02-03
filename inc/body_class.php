<?php
function pagename_class($classes = '') {
         if (is_page()) {
             $page = get_page(get_the_ID());
             $classes[] = $page->post_name;
         }
	return $classes;
}

add_filter('body_class','pagename_class');



//bodyクラスにページスラッグと最上の親ページスラッグのクラスを追加
add_filter( 'body_class', 'add_page_slug_class_name' );
function add_page_slug_class_name( $classes ) {
  if ( is_page() ) {
    $page = get_post( get_the_ID() );
    $classes[] = $page->post_name;

    $parent_id = $page->post_parent;
    if ( 0 == $parent_id ) {
      $classes[] = get_post($parent_id)->post_name;
    } else {
      $progenitor_id = array_pop( get_ancestors( $page->ID, 'page', 'post_type' ) );
      $classes[] = get_post($progenitor_id)->post_name . '-child';
    }
  }
  return $classes;
}
