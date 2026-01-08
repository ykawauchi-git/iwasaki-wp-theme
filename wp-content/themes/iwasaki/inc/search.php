<?php

/**
 * 現在のタクソノミーを取得.
 *
 * @param mixed $taxonomy
 */
function heads_get_query_term($taxonomy){
	$term_id = heads_get_url_paramater($taxonomy);
	$current = get_term($term_id, $taxonomy);
	if (is_wp_error($current)) {
		return false;
	}
	return $current;
}

/**
 * URLパラメータを取得.
 *
 * @param mixed $parameter_name
 * @param mixed $type
 * @param mixed $default
 */
function heads_get_url_paramater($parameter_name, $type = 'number', $default = ''){
	if (is_post_type_archive('shop') || is_search() || is_page('search')) {
		$var = get_query_var($parameter_name);
		if ('number' === $type) {
			if (preg_match('/^[0-9]+$/', $var)) {
				return (int) $var;
			}

			return $default;
		}

		return $var;
	}
	if (is_tax($parameter_name)) {
		$term_name = get_query_var($parameter_name);
		if ($term_name) {
			$tax_term = get_term_by('slug', $term_name, $parameter_name);
			if ($tax_term) {
				return $tax_term->term_id;
			}
		}

		return $var;
	}

	return $default;
}

/**
 * タクソノミーセレクトボックスを表示する.
 *
 * @param mixed $taxonomy
 * @param mixed $parent
 */
function heads_terms_select_option($taxonomy)
{
	$args = [
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => false,
		'fields' => 'all',
		// 'parent' => $parent,
		'hierarchical' => true,
	];
	$current_id = heads_get_url_paramater($taxonomy);
	$terms = get_terms($taxonomy, $args);
	foreach ($terms as $term) {
    if($_GET['shop_area'] == $term->slug){
      $selected = ' selected ';
    }else{
      $selected = '';
    }
		echo "<option value='".$term->slug."' ".$selected.'>'.$term->name.'</option>';
    echo $_GET['shop_type'];
	}
}

/**
 * タクソノミーラジオボタンを表示する.
 *
 * @param mixed $taxonomy
 * @param mixed $parent
 */
function heads_terms_radio_button($taxonomy)
{
	$current_term = heads_get_query_term($taxonomy);
	$parent = 0;
	$current_id = 0;
	if ($current_term) {
		$current_id = $current_term->term_id;
		if (0 === $current_term->parent) {
			$parent = $current_term->term_id;
		} else {
			$parent = $current_term->parent;
		}
	}
	$args = [
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => false,
		'fields' => 'all',
		'parent' => $parent,
		'hierarchical' => true,
		'pad_counts' => true,
	];
	$terms = get_terms($taxonomy, $args);

	$number = 1;
  echo '<div class="radio"><input id="all" name="'.$taxonomy.'" type="radio" value="" checked="checked" style="display:none;"><label for="all">全　て</label></div>';
	foreach ($terms as $term) {
		$id = $taxonomy.'-'.$number++;
    if($_GET['shop_type'] == $term->slug){
      $checked = ' checked="checked" ';
    }else{
      $checked = '';
    }

		echo '<div class="radio"><input id="'.$id.'" name="'.$taxonomy.'" type="radio" value="'.$term->slug.'" '.$checked.' style="display:none;"><label for="'.$id.'">'.$term->name.'</label></div>';
	}
}
