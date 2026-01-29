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
function lp2025_register_event_cpt()
{
	register_post_type('lp_event', [
		'labels' => [
			'name' => 'LPイベント',
			'singular_name' => 'LPイベント',
			'add_new' => '新規追加',
			'add_new_item' => 'イベントを追加',
			'edit_item' => 'イベントを編集',
		],
		'public' => true,
		'has_archive' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-calendar-alt',
		'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
		'show_in_rest' => true,
	]);

	register_taxonomy('lp_event_school', 'lp_event', [
		'labels' => [
			'name' => '学校分類',
			'singular_name' => '学校',
			'add_new_item' => '学校を追加',
		],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
	]);
}
add_action('init', 'lp2025_register_event_cpt');

/**
 * Add Meta Boxes to 'lp_event' and 'page' post types.
 */
function lp2025_add_meta_boxes()
{
	// Main event information for the LP
	add_meta_box(
		'lp2025_event_meta_box',
		'イベント情報',
		'lp2025_render_event_meta_box',
		'lp_event',
		'normal',
		'high'
	);

	// Page-specific settings like CTA URLs and Target School
	add_meta_box(
		'lp2025_page_meta_box',
		'LP設定',
		'lp2025_render_page_meta_box',
		'page',
		'side',
		'default'
	);
}
add_action('add_meta_boxes', 'lp2025_add_meta_boxes');

/**
 * Render the HTML for the LP event meta box.
 * 
 * @param WP_Post $post The current post object.
 */
function lp2025_render_event_meta_box($post)
{
	wp_nonce_field('lp2025_save_event_meta', 'lp2025_event_meta_nonce');

	$meta_fields = [
		'event_date_ymd' => get_post_meta($post->ID, 'event_date_ymd', true),
		'event_date_text' => get_post_meta($post->ID, 'event_date_text', true),
		'event_time' => get_post_meta($post->ID, 'event_time', true),
		'event_place' => get_post_meta($post->ID, 'event_place', true),
		'event_url' => get_post_meta($post->ID, 'event_url', true),
		'event_cta_label' => get_post_meta($post->ID, 'event_cta_label', true),
		'event_image_url' => get_post_meta($post->ID, 'event_image_url', true),
		'event_is_pickup' => get_post_meta($post->ID, 'event_is_pickup', true),
	];
	?>
	<style>
		.lp2025-meta-row {
			margin-bottom: 12px;
		}

		.lp2025-meta-row label {
			display: inline-block;
			width: 140px;
			font-weight: bold;
		}

		.lp2025-meta-row input[type="text"],
		.lp2025-meta-row input[type="url"] {
			width: 100%;
			max-width: 400px;
		}

		.lp2025-help {
			display: block;
			margin-left: 144px;
			color: #888;
			font-size: 12px;
			margin-top: 4px;
		}
	</style>
	<div class="lp2025-meta-row">
		<label for="event_date_ymd">開催日 (Ymd)*</label>
		<input type="text" id="event_date_ymd" name="event_date_ymd"
			value="<?php echo esc_attr($meta_fields['event_date_ymd']); ?>" placeholder="20260110" pattern="\d{8}" required>
		<span class="lp2025-help">※半角数字8桁で入力してください（例: 20260110）</span>
	</div>
	<div class="lp2025-meta-row">
		<label for="event_date_text">開催日 (表示用)</label>
		<input type="text" id="event_date_text" name="event_date_text"
			value="<?php echo esc_attr($meta_fields['event_date_text']); ?>" placeholder="2026年1月10日（土）">
	</div>
	<div class="lp2025-meta-row">
		<label for="event_time">時間</label>
		<input type="text" id="event_time" name="event_time" value="<?php echo esc_attr($meta_fields['event_time']); ?>"
			placeholder="13:00〜16:00">
	</div>
	<div class="lp2025-meta-row">
		<label for="event_place">場所</label>
		<input type="text" id="event_place" name="event_place" value="<?php echo esc_attr($meta_fields['event_place']); ?>"
			placeholder="新横浜キャンパス">
	</div>
	<div class="lp2025-meta-row">
		<label for="event_url">詳細URL</label>
		<input type="url" id="event_url" name="event_url" value="<?php echo esc_url($meta_fields['event_url']); ?>"
			placeholder="https://...">
	</div>
	<div class="lp2025-meta-row">
		<label for="event_cta_label">ボタン文言</label>
		<input type="text" id="event_cta_label" name="event_cta_label"
			value="<?php echo esc_attr($meta_fields['event_cta_label']); ?>" placeholder="詳細を見る">
	</div>
	<div class="lp2025-meta-row">
		<label for="event_is_pickup">Pickup表示</label>
		<input type="checkbox" id="event_is_pickup" name="event_is_pickup" value="on" <?php checked($meta_fields['event_is_pickup'], 'on'); ?>>
		<span style="font-size:12px;">チェックを入れるとPickupスライダーに表示されます</span>
	</div>
	<div class="lp2025-meta-row">
		<label for="event_image_url">画像URL (任意)</label>
		<input type="url" id="event_image_url" name="event_image_url"
			value="<?php echo esc_url($meta_fields['event_image_url']); ?>" placeholder="https://...">
		<span class="lp2025-help">※アイキャッチ画像がない場合に使用されます</span>
	</div>
	<?php
}

/**
 * Render the HTML for the LP page meta box (Side panel).
 * 
 * @param WP_Post $post The current post object.
 */
function lp2025_render_page_meta_box($post)
{
	wp_nonce_field('lp2025_save_page_meta', 'lp2025_page_meta_nonce');
	$cta_url = get_post_meta($post->ID, 'lp_hero_cta_url', true);
	$target_school = get_post_meta($post->ID, 'lp_target_school', true);

	// Fetch all school terms
	$schools = get_terms([
		'taxonomy' => 'lp_event_school',
		'hide_empty' => false,
	]);
	?>
	<div style="margin-bottom: 20px;">
		<label for="lp_hero_cta_url" style="font-weight:bold;">資料請求ボタンURL</label><br>
		<input type="url" id="lp_hero_cta_url" name="lp_hero_cta_url" value="<?php echo esc_attr($cta_url); ?>"
			style="width:100%; margin-top:4px;" placeholder="https://...">
	</div>

	<div>
		<label for="lp_target_school" style="font-weight:bold;">表示対象校</label><br>
		<select id="lp_target_school" name="lp_target_school" style="width:100%; margin-top:4px;">
			<option value="">すべての学校を表示</option>
			<?php if (!is_wp_error($schools) && !empty($schools)): ?>
				<?php foreach ($schools as $school): ?>
					<option value="<?php echo esc_attr($school->term_id); ?>" <?php selected($target_school, $school->term_id); ?>>
						<?php echo esc_html($school->name); ?>
					</option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<p style="font-size:12px; color:#666; margin-top:4px;">
			特定の学校のイベントのみを表示したい場合に選択してください。
		</p>
	</div>
	<?php
}

/**
 * Save meta box data when a post is saved.
 * 
 * @param int $post_id The ID of the post being saved.
 */
function lp2025_save_meta_data($post_id)
{
	// 1. Nonce Check for event-specific meta
	if (isset($_POST['lp2025_event_meta_nonce']) && wp_verify_nonce($_POST['lp2025_event_meta_nonce'], 'lp2025_save_event_meta')) {
		$fields = [
			'event_date_ymd' => 'sanitize_text_field',
			'event_date_text' => 'sanitize_text_field',
			'event_time' => 'sanitize_text_field',
			'event_place' => 'sanitize_text_field',
			'event_url' => 'esc_url_raw',
			'event_cta_label' => 'sanitize_text_field',
			'event_image_url' => 'esc_url_raw',
		];

		foreach ($fields as $field => $sanitizer) {
			if (isset($_POST[$field])) {
				update_post_meta($post_id, $field, $sanitizer($_POST[$field]));
			}
		}

		// Handle checkbox for pickup
		$pickup = isset($_POST['event_is_pickup']) ? 'on' : '';
		update_post_meta($post_id, 'event_is_pickup', $pickup);
	}

	// 2. Nonce Check for page-specific settings
	if (isset($_POST['lp2025_page_meta_nonce']) && wp_verify_nonce($_POST['lp2025_page_meta_nonce'], 'lp2025_save_page_meta')) {
		if (isset($_POST['lp_hero_cta_url'])) {
			update_post_meta($post_id, 'lp_hero_cta_url', esc_url_raw($_POST['lp_hero_cta_url']));
		}
		if (isset($_POST['lp_target_school'])) {
			update_post_meta($post_id, 'lp_target_school', sanitize_text_field($_POST['lp_target_school']));
		}
	}
}
add_action('save_post', 'lp2025_save_meta_data');

/**
 * Change Admin Bar color to orange in dev environment for safety.
 * This helps distinguish between development and production environments.
 */
function iwasaki_dev_admin_bar_color()
{
	if (is_admin_bar_showing()) {
		?>
		<style type="text/css">
			#wpadminbar {
				background: #E66100 !important;
			}

			#wpadminbar .ab-sub-wrapper {
				background: #E66100 !important;
			}
		</style>
		<?php
	}
}
add_action('wp_head', 'iwasaki_dev_admin_bar_color');
add_action('admin_head', 'iwasaki_dev_admin_bar_color');
