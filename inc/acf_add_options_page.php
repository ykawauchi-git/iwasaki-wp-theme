<?php

//----------------------------------------------------------
//【管理画面】ACF Options Page の設定
//----------------------------------------------------------
//通常オプションページカスタマイズ
function my_acf_options_page_settings( $settings )
{
	$settings['title'] = '全体設定';
	$settings['menu'] = '全体設定';
	$settings['slug'] = 'acf-options';
  $settings['capability'] = 'edit_posts';
	return $settings;
}
add_filter('acf/options_page/settings', 'my_acf_options_page_settings');

//追加オプションページカスタマイズ
/* if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' => 'ページタイトル',
    'menu_title' => 'メニュータイトル',
    'menu_slug' => 'acf-custom-options',
    'capability' => 'read',
    'redirect' => true
  ));
  acf_add_options_page(array(
    'page_title' => 'ページタイトル2',
    'menu_title' => 'メニュータイトル2',
    'menu_slug' => 'acf-custom-options2',
    'capability' => 'read',
    'redirect' => true
  ));
} */

//----------------------------------------------------------
//【管理画面】ページの属性で非公開などを親に選択できるようにする
//----------------------------------------------------------
add_filter( 'page_attributes_dropdown_pages_args', 'add_dropdown_pages' );
add_filter( 'quick_edit_dropdown_pages_args', 'add_dropdown_pages' );
function add_dropdown_pages( $add_dropdown_pages, $post = NULL ) {
  $add_dropdown_pages['post_status'] = array( 'publish', 'future', 'draft', 'pending', 'private', ); // 公開済、予約済、下書き、承認待ち、非公開、を選択
  return $add_dropdown_pages;
}