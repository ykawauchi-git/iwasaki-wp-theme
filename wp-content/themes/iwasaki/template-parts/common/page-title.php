<?php
$page = get_post(get_the_ID());
if ($post) {
  $page_parent = get_post($post->post_parent);
  $slug = $page->post_name;
  $slug_parent = $page_parent->post_name;
}
$page_id = get_option('page_on_front');
$ttl = get_the_title();
$thumb = get_the_post_thumbnail_url('', 'full');
$thumb_sp = function_exists('get_field') ? get_field('thumb_sp') : '';
$careerKV = function_exists('get_field') ? get_field('career_kv', 'option') : '';
$careerKV_pc = (is_array($careerKV) && isset($careerKV['career_kv_pc'])) ? $careerKV['career_kv_pc'] : '';
$careerKV_sp = (is_array($careerKV) && isset($careerKV['career_kv_sp'])) ? $careerKV['career_kv_sp'] : '';

//page
if (is_front_page() || is_home()) {
} elseif (is_page()) {
  if (!is_page(array('sitemap', 'access', 'document', 'media-policy', 'privacy-policy', 'history', 'career', 'facilities', 'pioneer', 'speciality', 'method', 'academic-industrial-collaboration'))) {
    if ($thumb && $thumb_sp) {
      echo '<section class="page-kv common-kv">';
      echo '<figure class="common-kv__bg"><img src="' . $thumb . '" alt="' . $ttl . '" class="pctab-only object_fit"><img src="' . $thumb_sp . '" alt="' . $ttl . '" class="sp-only object_fit"></figure>';
      // echo '<h1 class="common-kv__ttl">'.$ttl.'</h1>';
      echo '</section>';
    }
  }
  //archives
} elseif (is_archive()) {
  if (is_post_type_archive('career')) {
    if ($careerKV_pc && $careerKV_sp) {
      echo '<section class="page-kv common-kv">';
      echo '<figure class="common-kv__bg"><img src="' . $careerKV_pc . '" alt="' . $ttl . '" class="pctab-only object_fit"><img src="' . $careerKV_sp . '" alt="' . $ttl . '" class="sp-only object_fit"></figure>';
      // echo '<h1 class="common-kv__ttl">'.$ttl.'</h1>';
      echo '</section>';
    }
  }
  //他
} elseif (is_page('contact')) {
} elseif (is_page('privacy-policy')) {
}
?>