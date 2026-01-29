<?php //[myphp file='ファイル名']
  
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/template-parts/mwWpForm/$file.php");
    return ob_get_clean();
}
 
add_shortcode('myphp', 'Include_my_php');