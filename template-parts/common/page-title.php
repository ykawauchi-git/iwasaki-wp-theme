<?php
  $page = get_post( get_the_ID() );
  if($post) {
  $page_parent = get_post( $post ->post_parent );
  $slug = $page->post_name;
  $slug_parent = $page_parent->post_name;
  }
  $page_id = get_option( 'page_on_front' );
  $ttl = get_the_title();
  $thumb = get_the_post_thumbnail_url('','full');
  $thumb_sp = get_field('thumb_sp');


  //page
  if(is_page()){
    if(!is_page(array('sitemap','contact','access','document','media-policy','privacy-policy','history','career','facility','pioneer','speciality','method','academic-industrial-collaboration'))){
      echo '<section class="page-kv common-kv">';
      echo '<figure class="common-kv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
      echo '<h1 class="common-kv__ttl">'.$ttl.'</h1>';
      echo '</section>';
    }
    // 就職・資格サポート
    if(is_page('career')) {
      echo '<div class="common-subKv"">';
        echo '<figure class="common-subKv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
        echo '<div class="common-subKv__inner">';
          echo '<div class="common-subKv__ttl page-subHeading">就職・資格サポート</div>';
          echo '<div class="common-subKv__txt">';
            echo '文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。<br>
            文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。';
          echo'</div>';
        echo'</div>';
      echo'</div>';
    }
    // 専門力
    if(is_page('speciality')) {
      echo '<div class="common-subKv"">';
        echo '<figure class="common-subKv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
        echo '<div class="common-subKv__inner">';
          echo '<div class="common-subKv__ttl page-subHeading">岩崎学園の専門力</div>';
          echo '<div class="common-subKv__txt">';
            echo '文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。<br>
            文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。';
          echo'</div>';
        echo'</div>';
      echo'</div>';
    }
    // 専門力
    if(is_page('pioneer')) {
      echo '<div class="common-subKv"">';
        echo '<figure class="common-subKv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
        echo '<div class="common-subKv__inner">';
          echo '<div class="common-subKv__ttl page-subHeading">未来を生きる力を磨く「開拓力」</div>';
          echo '<div class="common-subKv__txt">';
            echo '文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。<br>
            文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。文章が入ります、文章が入ります。';
          echo'</div>';
        echo'</div>';
      echo'</div>';
    }
    // IWASAKI METHOD
    if(is_page('method')){
      echo '<section class="page-kv common-kv">';
      echo '<figure class="common-kv__bg"><img src="'.$thumb.'" alt="'.$ttl.'" class="pctab-only object_fit"><img src="'.$thumb_sp.'" alt="'.$ttl.'" class="sp-only object_fit"></figure>';
      echo '<h1 class="common-kv__ttl">発想力豊かな人材を育成する<br>IWASAKI METHOD</h1>';
      echo '</section>';
    }
	//archives
	}elseif(is_archive()){
	//他
  }elseif(is_page('contact')){
  }elseif(is_page('privacy-policy')){
  }
?>