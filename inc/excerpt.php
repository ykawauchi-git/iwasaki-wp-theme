<?php
function new_excerpt_mblength($length) {
    if(is_mobile()){
        return 96;
    }else{
        return 114;
    }
     //return 36; //抜粋する文字数を50文字に設定
}
add_filter('excerpt_mblength', 'new_excerpt_mblength');

function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
