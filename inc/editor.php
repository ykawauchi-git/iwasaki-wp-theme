<?php
/**
 * Editor Customizations
 * 
 * Handles WordPress editor behaviors such as:
 * - Disabling automatic paragraph tags (wpautop) in certain contexts.
 * - Configuring TinyMCE (Classic Editor) settings.
 * - Enabling/disabling the Visual Editor for specific post types.
 */

/**
 * Disable wpautop (automatic <p> tags) on specific front-end pages.
 */
function custom_remove_wpautop()
{
  if (is_front_page() || is_home() || is_page()) {
    remove_filter('the_content', 'wpautop');
  }
}
add_action('wp', 'custom_remove_wpautop');

/**
 * Disable wpautop in the admin editor and during save for 'page' post type.
 * This prevents unexpected formatting issues when using custom HTML in pages.
 */
add_action('init', function () {
  add_filter('the_content', 'disable_wpautop_for_pages', 9);
  add_filter('content_save_pre', 'disable_wpautop_for_pages_on_save', 9);
});

function disable_wpautop_for_pages($content)
{
  if (is_admin() && get_post_type() === 'page') {
    remove_filter('the_content', 'wpautop');
  }
  return $content;
}

function disable_wpautop_for_pages_on_save($content)
{
  if (is_admin() && get_post_type() === 'page') {
    remove_filter('content_save_pre', 'wpautop');
  }
  return $content;
}

/**
 * Configure TinyMCE (Classic Block) settings to prevent automatic cleanup.
 */
add_filter('tiny_mce_before_init', function ($initArray) {
  $initArray['wpautop'] = false;
  $initArray['forced_root_block'] = false;
  $initArray['force_br_newlines'] = true;
  return $initArray;
});

/**
 * Ensure TinyMCE preserves all attributes (like class/id) on elements.
 */
add_filter('tiny_mce_before_init', function ($init) {
  $init['extended_valid_elements'] = '*[*]';
  return $init;
});

/**
 * Enable default WordPress gallery styles.
 */
function enable_default_gallery_style()
{
  add_filter('use_default_gallery_style', '__return_true');
}
add_action('after_setup_theme', 'enable_default_gallery_style');

/**
 * Disables the Visual Editor for specific post types where raw code is preferred.
 * Currently enables it for 'post' and 'career', but disables it for others.
 */
function disable_visual_editor_for_post_types($can_edit)
{
  if (!is_admin()) {
    return $can_edit;
  }

  $post = get_post();
  if (!$post) {
    return $can_edit;
  }

  $post_type = get_post_type($post);

  // If the post type is NOT using the block editor (Gutenberg)
  if (!use_block_editor_for_post_type($post_type)) {
    // Disable visual editor for everything except 'post' and 'career'
    if ($post_type !== 'post' && $post_type !== 'career') {
      return false;
    }
  }
  return $can_edit;
}
add_filter('user_can_richedit', 'disable_visual_editor_for_post_types', 10, 1);