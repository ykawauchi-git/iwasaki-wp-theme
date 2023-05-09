<?php
  $page = get_post( get_the_ID() );
  $page_parent = get_post( $post ->post_parent );
  $slug = $page->post_name;
  $page_id = get_option( 'page_on_front' );
  $slug_parent = $page_parent->post_name;
  $ttl = get_the_title();
  $thumb = get_the_post_thumbnail_url('','full');
  $thumb_sp = get_field('thumb_sp');


  //page
  if(is_page()){
    if(!is_page(array('sitemap','contact','access','document','media-policy','privacy-policy','history','career'))){
      echo '<section class="page-kv common-kv">';
      echo '<figure class="common-kv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
      echo '<h1 class="common-kv__ttl">'.$ttl.'</h1>';
      echo '</section>';
    }
	//archives
	}elseif(is_archive()){
	//他
  }elseif(is_page('contact')){
  }elseif(is_page('privacy-policy')){
  }
?>