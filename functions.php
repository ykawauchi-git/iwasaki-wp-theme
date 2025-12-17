<?php

if ( ! function_exists( 'iwasaki_setup' ) ) {
    function iwasaki_setup() {
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        register_nav_menus( [
            'menu-1' => esc_html__( 'Primary', 'iwasaki' ),
        ] );

        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );
    }
}
add_action( 'after_setup_theme', 'iwasaki_setup' );

function iwasaki_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'iwasaki_content_width', 640 );
}
add_action( 'after_setup_theme', 'iwasaki_content_width', 0 );

function iwasaki_widgets_init() {
    register_sidebar( [
        'name'          => esc_html__( 'Sidebar', 'iwasaki' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'iwasaki' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ] );
}
add_action( 'widgets_init', 'iwasaki_widgets_init' );

add_filter( 'redirect_canonical', 'my_disable_redirect_canonical' );
function my_disable_redirect_canonical( $redirect_url ) {
    if ( is_archive() ) {
        return false;
    }
    return $redirect_url;
}

function iwasaki_scripts() {
    wp_enqueue_style( 'iwasaki-sanitize', get_template_directory_uri() . '/css/sanitize.css' );

    if ( is_front_page() || is_home() || is_page( 'about' ) || is_page( 'facilities' ) || is_page( 'philosophy' ) ) {
        wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' );
    }

    wp_enqueue_style(
        'iwasaki-style',
        get_stylesheet_uri(),
        [],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', [], '', true );
    wp_enqueue_script( 'ofi', get_template_directory_uri() . '/js/ofi.min.js', [], '', true );
    wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.7.0/dist/gsap.min.js', [], '', true );
    wp_enqueue_script( 'scrollTrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.7.0/dist/ScrollTrigger.min.js', [], '', true );
    wp_enqueue_script(
        'iwasaki-scripts',
        get_template_directory_uri() . '/js/scripts.js',
        [],
        filemtime( get_stylesheet_directory() . '/js/scripts.js' ),
        true
    );

    if ( is_front_page() ) {
        wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', [], '', true );
        wp_enqueue_script(
            'iwasaki-top-scripts',
            get_template_directory_uri() . '/js/top.js',
            [],
            filemtime( get_stylesheet_directory() . '/js/top.js' ),
            true
        );
    }

    if ( is_page( 'about' ) ) {
        wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', [], '', true );
        wp_enqueue_script(
            'iwasaki-about-scripts',
            get_template_directory_uri() . '/js/about.js',
            [],
            filemtime( get_stylesheet_directory() . '/js/about.js' ),
            true
        );
    }

    if ( is_page( 'facilities' ) ) {
        wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', [], '', true );
        wp_enqueue_script(
            'iwasaki-facilities-scripts',
            get_template_directory_uri() . '/js/facilities.js',
            [],
            filemtime( get_stylesheet_directory() . '/js/facilities.js' ),
            true
        );
    }

    if ( is_page( 'philosophy' ) ) {
        wp_enqueue_script( 'swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', [], '', true );
        wp_enqueue_script(
            'iwasaki-philosophy-scripts',
            get_template_directory_uri() . '/js/philosophy.js',
            [],
            filemtime( get_stylesheet_directory() . '/js/philosophy.js' ),
            true
        );
    }

    if ( is_archive() ) {
        wp_enqueue_script( 'infinite-scripts', get_template_directory_uri() . '/js/infinite-scroll.js', [], '', true );
        wp_enqueue_script( 'post-scripts', get_template_directory_uri() . '/js/post.js', [], '', true );
    }

    if ( is_single() ) {
        wp_enqueue_script( 'single-scripts', get_template_directory_uri() . '/js/single.js', [], '', true );
    }
}
add_action( 'wp_enqueue_scripts', 'iwasaki_scripts' );

// incフォルダからインクルード
require get_template_directory() . '/inc/editor.php';
require get_template_directory() . '/inc/reset.php';
require get_template_directory() . '/inc/device_if.php';
require get_template_directory() . '/inc/body_class.php';
require get_template_directory() . '/inc/hide_author.php';
require get_template_directory() . '/inc/get_form_id.php';
require get_template_directory() . '/inc/acf_add_options_page.php';
require get_template_directory() . '/inc/change_posts_archive.php';
require get_template_directory() . '/inc/default_post.php';
require get_template_directory() . '/inc/excerpt.php';
require get_template_directory() . '/inc/form_validation.php';
require get_template_directory() . '/inc/include_my_php.php';
require get_template_directory() . '/inc/only_publish.php';
require get_template_directory() . '/inc/is_parent_slug.php';
require get_template_directory() . '/inc/wp_nav.php';
require get_template_directory() . '/inc/yoast_seo.php';
require get_template_directory() . '/inc/wp_head.php';


// スタイリングアワード2025（投稿ID 3785）専用テンプレート
function iwasaki_single_template_styling_award_2025( $single_template ) {
    if ( is_single( 3785 ) ) {
        $custom = locate_template( 'single-styling-award-2025.php' );
        if ( $custom ) {
            return $custom;
        }
    }
    return $single_template;
}
add_filter( 'single_template', 'iwasaki_single_template_styling_award_2025' );


// LP 2025 イベント用のアセット読み込み
function iwasaki_enqueue_lp2025_assets() {
    if ( is_page_template( 'page-lp2025-events.php' ) ) {
        $theme_uri = get_stylesheet_directory_uri();

        wp_enqueue_style(
            'lp2025-css',
            $theme_uri . '/css/lp2025.css',
            array(),
            '1.0.0'
        );
	wp_enqueue_script(
    	'lp2025-js',
    	$theme_uri . '/js/lp2025.js',
    	array(),
    	filemtime( get_stylesheet_directory() . '/js/lp2025.js' ),
    	true
	);

    }
}
add_action( 'wp_enqueue_scripts', 'iwasaki_enqueue_lp2025_assets' );


/* ================================
 * LP 2025 イベント用カスタム投稿
 * ================================ */
function iwasaki_register_lp_event_cpt() {
    $labels = array(
        'name'          => 'LPイベント',
        'singular_name' => 'LPイベント',
        'add_new'       => '新規イベントを追加',
        'add_new_item'  => 'LPイベントを追加',
        'edit_item'     => 'LPイベントを編集',
        'new_item'      => '新規LPイベント',
        'view_item'     => 'LPイベントを見る',
        'search_items'  => 'LPイベントを検索',
        'not_found'     => 'LPイベントはありません',
        'menu_name'     => 'LPイベント',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_position' => 21,
        'menu_icon'     => 'dashicons-calendar-alt',
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'lp-event' ),
        'show_in_rest'  => false,
    );

    register_post_type( 'lp_event', $args );
}
add_action( 'init', 'iwasaki_register_lp_event_cpt' );


/* =========================================
 * LPイベント用メタボックス
 * カスタム投稿タイプ：lp_event
 * 画像は「アイキャッチ画像」を使用
 * ========================================= */
function iwasaki_add_lp_event_metabox() {
    add_meta_box(
        'lp_event_meta',
        'LPイベント情報',
        'iwasaki_render_lp_event_metabox',
        'lp_event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'iwasaki_add_lp_event_metabox' );


function iwasaki_render_lp_event_metabox( $post ) {

    wp_nonce_field( 'lp_event_meta_nonce', 'lp_event_meta_nonce_field' );

    $tag        = get_post_meta( $post->ID, 'lp_event_tag', true );
    $date       = get_post_meta( $post->ID, 'lp_event_date', true );
    $date_label = get_post_meta( $post->ID, 'lp_event_date_label', true );
    $short      = get_post_meta( $post->ID, 'lp_event_short', true );
    $detail     = get_post_meta( $post->ID, 'lp_event_detail', true );
    $link       = get_post_meta( $post->ID, 'lp_event_link', true );

    // おすすめイベントフラグ（'1' or '0'）
    $is_featured = get_post_meta( $post->ID, 'lp_event_featured', true );
    ?>
    <table class="form-table">

        <tr>
            <th><label for="lp_event_featured">おすすめイベントにする</label></th>
            <td>
                <label>
                    <input type="checkbox"
                           name="lp_event_featured"
                           id="lp_event_featured"
                           value="1" <?php checked( $is_featured, '1' ); ?>>
                    このイベントをLP上部の「おすすめのイベント」に表示する
                </label>
                <p class="description">チェックされたイベントが1件以上ある場合、その中から1件だけ表示します。</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_tag">イベント種別</label></th>
            <td>
                <select name="lp_event_tag" id="lp_event_tag">
                    <?php
                    $options = [
                        'oc'       => 'オープンキャンパス',
                        'trial'    => '体験授業',
                        'briefing' => '説明会',
                        'soon'     => '開催間近',
                    ];
                    foreach ( $options as $value => $label ) {
                        echo '<option value="' . esc_attr( $value ) . '" ' . selected( $tag, $value, false ) . '>' . esc_html( $label ) . '</option>';
                    }
                    ?>
                </select>
                <p class="description">LPの「イベントを条件でさがす」ボタンと連動します。</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_date">開催日</label></th>
            <td>
                <input type="date" name="lp_event_date" id="lp_event_date" value="<?php echo esc_attr( $date ); ?>">
                <p class="description">例：2025-12-14（カレンダーでの絞り込みに利用）</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_date_label">表示用日付ラベル</label></th>
            <td>
                <input type="text"
                       name="lp_event_date_label"
                       id="lp_event_date_label"
                       value="<?php echo esc_attr( $date_label ); ?>"
                       placeholder="12/14">
                <p class="description">カード右下表示用。未入力なら開催日から自動生成されます（テンプレ側）。</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_short">カード概要</label></th>
            <td>
                <textarea name="lp_event_short" id="lp_event_short" rows="3" class="large-text"><?php echo esc_textarea( $short ); ?></textarea>
                <p class="description">カードに表示する短い説明文。</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_detail">モーダル詳細</label></th>
            <td>
                <textarea name="lp_event_detail" id="lp_event_detail" rows="5" class="large-text"><?php echo esc_textarea( $detail ); ?></textarea>
                <p class="description">カードクリック時のモーダルで使用。</p>
            </td>
        </tr>

        <tr>
            <th><label for="lp_event_link">詳細／予約リンク</label></th>
            <td>
                <input type="url"
                       name="lp_event_link"
                       id="lp_event_link"
                       value="<?php echo esc_attr( $link ); ?>"
                       class="large-text"
                       placeholder="https://www.iwasaki.ac.jp/...">
                <p class="description">モーダル「応募・詳細を見る」ボタンのリンク。</p>
            </td>
        </tr>

        <tr>
            <th>画像について</th>
            <td>
                <p class="description">画像は「アイキャッチ画像」に設定してください（カードとモーダルに使用）。</p>
            </td>
        </tr>

    </table>
<?php
}


/**
 * 保存処理
 */
function iwasaki_save_lp_event_meta( $post_id ) {

    if ( ! isset( $_POST['lp_event_meta_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['lp_event_meta_nonce_field'], 'lp_event_meta_nonce' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( get_post_type( $post_id ) !== 'lp_event' ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // 通常フィールド
    $fields = [
        'lp_event_tag'        => 'text',
        'lp_event_date'       => 'text',
        'lp_event_date_label' => 'text',
        'lp_event_short'      => 'textarea',
        'lp_event_detail'     => 'textarea',
        'lp_event_link'       => 'url',
    ];

    foreach ( $fields as $field => $type ) {
        if ( isset( $_POST[ $field ] ) ) {
            $value = $_POST[ $field ];

            switch ( $type ) {
                case 'textarea':
                    $value = sanitize_textarea_field( $value );
                    break;
                case 'url':
                    $value = esc_url_raw( $value );
                    break;
                default:
                    $value = sanitize_text_field( $value );
            }

            update_post_meta( $post_id, $field, $value );
        }
    }

    // おすすめフラグ（チェックは未送信になるので、必ず0/1で保存）
    $featured = ( isset( $_POST['lp_event_featured'] ) && $_POST['lp_event_featured'] === '1' ) ? '1' : '0';
    update_post_meta( $post_id, 'lp_event_featured', $featured );
}
add_action( 'save_post_lp_event', 'iwasaki_save_lp_event_meta' );
