<?php
//メニューの<li>からID除去
function removeMenuId( $id ){
    return $id = array();
}
add_filter('nav_menu_item_id', 'removeMenuId', 10);

//メニューの<li>からクラス変更
function removeMenuClass( $classes ) {
    return $classes = array('common__header--menu');
} 
add_filter( 'nav_menu_css_class', 'removeMenuClass', 10, 2 );