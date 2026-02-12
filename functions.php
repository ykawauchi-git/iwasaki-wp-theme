<?php
/**
 * iwasaki Theme Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package iwasaki
 */

/**
 * ACF Fallback: Define dummy functions if ACF is not active to prevent fatal errors.
 * This ensures the site doesn't crash if the Advanced Custom Fields plugin is deactivated.
 */
if (!function_exists('have_rows')) {
    function have_rows(...$args)
    {
        return false;
    }
}
if (!function_exists('the_row')) {
    function the_row(...$args)
    {
    }
}
if (!function_exists('get_sub_field')) {
    function get_sub_field(...$args)
    {
        return null;
    }
}
if (!function_exists('the_field')) {
    function the_field(...$args)
    {
    }
}
if (!function_exists('get_field')) {
    function get_field(...$args)
    {
        return null;
    }
}
if (!function_exists('acf_add_options_page')) {
    function acf_add_options_page(...$args)
    {
    }
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * 
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if (!function_exists('iwasaki_setup')) {
    function iwasaki_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in three locations.
        register_nav_menus([
            'menu-1' => esc_html__('Primary', 'iwasaki'),
            'global' => 'グローバルメニュー',
            'footer' => 'フッターメニュー'
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
    }
}
add_action('after_setup_theme', 'iwasaki_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function iwasaki_content_width()
{
    $GLOBALS['content_width'] = apply_filters('iwasaki_content_width', 640);
}
add_action('after_setup_theme', 'iwasaki_content_width', 0);

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function iwasaki_widgets_init()
{
    register_sidebar([
        'name' => esc_html__('Sidebar', 'iwasaki'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'iwasaki'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}
add_action('widgets_init', 'iwasaki_widgets_init');

/**
 * Disable canonical redirect for archives to prevent unintended SEO redirects.
 */
add_filter('redirect_canonical', 'my_disable_redirect_canonical');
function my_disable_redirect_canonical($redirect_url)
{
    if (is_archive()) {
        return false;
    }
    return $redirect_url;
}

/**
 * Enqueue scripts and styles.
 */
function iwasaki_scripts()
{
    // Sanitize CSS
    wp_enqueue_style('iwasaki-sanitize', get_template_directory_uri() . '/css/sanitize.css');

    // Swiper CSS for specific pages
    if (is_front_page() || is_home() || is_page('about') || is_page('facilities') || is_page('philosophy')) {
        wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');
    }

    // Main Style
    wp_enqueue_style('iwasaki-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));

    // Replace Core jQuery with CDN version for performance
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', '', '', true);

    // Object Fit Images (Polyfill for IE)
    wp_enqueue_script('ofi', get_template_directory_uri() . '/js/ofi.min.js', '', '', true);

    // Animation Libraries (GSAP)
    wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.7.0/dist/gsap.min.js', '', '', true);
    wp_enqueue_script('scrollTrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.7.0/dist/ScrollTrigger.min.js', '', '', true);

    // Theme Main Script
    wp_enqueue_script('iwasaki-scripts', get_template_directory_uri() . '/js/scripts.js', '', filemtime(get_stylesheet_directory() . '/js/scripts.js'), true);

    // Page-specific scripts
    if (is_front_page()) {
        wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', '', '', true);
        wp_enqueue_script('iwasaki-top-scripts', get_template_directory_uri() . '/js/top.js', '', filemtime(get_stylesheet_directory() . '/js/top.js'), true);
    }
    if (is_page('about')) {
        wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', '', '', true);
        wp_enqueue_script('iwasaki-about-scripts', get_template_directory_uri() . '/js/about.js', '', filemtime(get_stylesheet_directory() . '/js/about.js'), true);
    }
    if (is_page('facilities')) {
        wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', '', '', true);
        wp_enqueue_script('iwasaki-facilities-scripts', get_template_directory_uri() . '/js/facilities.js', '', filemtime(get_stylesheet_directory() . '/js/facilities.js'), true);
    }
    if (is_page('philosophy')) {
        wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', '', '', true);
        wp_enqueue_script('iwasaki-philosophy-scripts', get_template_directory_uri() . '/js/philosophy.js', '', filemtime(get_stylesheet_directory() . '/js/philosophy.js'), true);
    }
    if (is_archive()) {
        wp_enqueue_script('infinite-scripts', get_template_directory_uri() . '/js/infinite-scroll.js', '', '', true);
        wp_enqueue_script('post-scripts', get_template_directory_uri() . '/js/post.js', '', '', true);
    }
    if (is_single()) {
        wp_enqueue_script('single-scripts', get_template_directory_uri() . '/js/single.js', '', '', true);
    }
}
add_action('wp_enqueue_scripts', 'iwasaki_scripts');

/**
 * Include helper files from /inc directory.
 * This keeps functions.php clean by separating logic into modules.
 */
require get_template_directory() . '/inc/editor.php';
require get_template_directory() . '/inc/reset.php';
require get_template_directory() . '/inc/device_if.php';
require get_template_directory() . '/inc/body_class.php';
require get_template_directory() . '/inc/hide_author.php';
require get_template_directory() . '/inc/get_form_id.php';
if (function_exists('acf_add_options_page')) {
    require get_template_directory() . '/inc/acf_add_options_page.php';
}
require get_template_directory() . '/inc/change_posts_archive.php';
require get_template_directory() . '/inc/default_post.php';
require get_template_directory() . '/inc/excerpt.php';
if (class_exists('MW_WP_Form')) {
    require get_template_directory() . '/inc/form_validation.php';
}
require get_template_directory() . '/inc/include_my_php.php';
require get_template_directory() . '/inc/only_publish.php';
require get_template_directory() . '/inc/is_parent_slug.php';
require get_template_directory() . '/inc/wp_nav.php';
if (defined('WPSEO_VERSION')) {
    require get_template_directory() . '/inc/yoast_seo.php';
}
if (function_exists('get_field')) {
    require get_template_directory() . '/inc/wp_head.php';
}

/* ==========================================================================
 LP2025: Custom Event Post Type and Meta Management
 ========================================================================== */

/**
 * Register Custom Post Type: lp_event and Custom Taxonomy: lp_event_course.
 * This is used specifically for the 2025 LP template.
 */

require get_template_directory() . '/inc/lp2025-setup.php';