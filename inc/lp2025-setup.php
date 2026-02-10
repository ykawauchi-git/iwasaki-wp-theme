<?php
/**
 * LP 2025 (Awards Event) Setup
 */

// LP 2025 イベント用のアセット読み込み
function iwasaki_enqueue_lp2025_assets()
{
    if (is_page_template('page-lp2025-events.php')) {
        $theme_uri = get_stylesheet_directory_uri();

        // Enqueue Swiper
        wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css');
        wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '8.0.0', true);

        wp_enqueue_style(
            'lp2025-css',
            $theme_uri . '/css/lp2025.css',
            array('swiper-style'),
            '1.0.0'
        );
        wp_enqueue_script(
            'lp2025-js',
            $theme_uri . '/js/lp2025.js',
            array('swiper-scripts'),
            filemtime(get_stylesheet_directory() . '/js/lp2025.js'),
            true
        );

    }
}
add_action('wp_enqueue_scripts', 'iwasaki_enqueue_lp2025_assets');

// LP 2025: 固定ページに「表示対象コース」フィールドを追加
if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_lp2025_page_settings',
        'title' => 'LP 2025 ページ設定',
        'fields' => array(
                array(
                'key' => 'field_lp_target_course',
                'label' => '表示対象コース',
                'name' => 'lp_target_course',
                'type' => 'taxonomy',
                'instructions' => 'このページに表示するイベントのコース（学校）を選択してください。未選択の場合は全てのイベントが表示されます。',
                'required' => 0,
                'taxonomy' => 'lp_event_course',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'id', // IDで取得するのが確実
            ),
                array(
                'key' => 'field_lp_theme_color',
                'label' => 'テーマカラー（アクセント）',
                'name' => 'lp_theme_color',
                'type' => 'color_picker',
                'instructions' => 'ボタンやタイトルなどで使用するメインのアクセントカラーを選択してください。未指定の場合はデフォルト（青）になります。',
                'default_value' => '#0070c9',
            ),
                array(
                'key' => 'field_lp_sub_color',
                'label' => 'サブカラー（日付等）',
                'name' => 'lp_sub_color',
                'type' => 'color_picker',
                'instructions' => '日付ラベルなどで使用するサブカラーを選択してください。未指定の場合はデフォルト（黄色）になります。',
                'default_value' => '#ffb800',
            ),
                array(
                'key' => 'field_lp_request_link',
                'label' => '資料請求リンク',
                'name' => 'lp_request_link',
                'type' => 'url',
                'instructions' => 'ページ下部と固定ボタンに使用する資料請求ページのURLを入力してください。',
                'required' => 0,
                'placeholder' => 'https://www.iwasaki.ac.jp/request/',
            ),
                array(
                'key' => 'field_lp_request_title',
                'label' => '資料請求セクション：見出し',
                'name' => 'lp_request_title',
                'type' => 'text',
                'default_value' => '資料請求で、もっと詳しく。',
            ),
                array(
                'key' => 'field_lp_fixed_btn_text',
                'label' => '固定ボタン：テキスト',
                'name' => 'lp_fixed_btn_text',
                'type' => 'text',
                'default_value' => '資料請求はこちら！',
            ),
                array(
                'key' => 'field_lp_request_desc',
                'label' => '資料請求セクション：説明文',
                'name' => 'lp_request_desc',
                'type' => 'textarea',
                'default_value' => "学科の詳細や、校風が伝わるパンフレットをお届けします。\n将来の進路選びに、ぜひお役立てください。",
            ),
                array(
                'key' => 'field_lp_section_title_featured',
                'label' => 'おすすめセクション：見出し',
                'name' => 'lp_title_featured',
                'type' => 'text',
                'default_value' => 'おすすめのイベント',
            ),
                array(
                'default_value' => 'イベントを条件でさがす',
            ),
                array(
                'key' => 'field_lp_show_line',
                'label' => 'LINE友達追加を表示する',
                'name' => 'lp_show_line',
                'type' => 'true_false',
                'instructions' => 'チェックを入れると、左下にLINE友達追加ボタンが表示されます。',
                'ui' => 1,
                'default_value' => 0,
            ),
                array(
                'key' => 'field_lp_line_bubble_text',
                'label' => 'LINE吹き出しテキスト',
                'name' => 'lp_line_bubble_text',
                'type' => 'text',
                'instructions' => 'LINEボタンの上に表示される吹き出しのテキストを入力してください。',
                'placeholder' => 'お気軽にご相談ください！',
                'conditional_logic' => array(
                        array(
                            array(
                            'field' => 'field_lp_show_line',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
                array(
                    array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-lp2025-events.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
endif;


/* ================================
 * LP 2025 イベント用カスタム投稿
 * ================================ */
function iwasaki_register_lp_event_cpt()
{
    $labels = array(
        'name' => 'LPイベント',
        'singular_name' => 'LPイベント',
        'add_new' => '新規イベントを追加',
        'add_new_item' => 'LPイベントを追加',
        'edit_item' => 'LPイベントを編集',
        'new_item' => '新規LPイベント',
        'view_item' => 'LPイベントを見る',
        'search_items' => 'LPイベントを検索',
        'not_found' => 'LPイベントはありません',
        'menu_name' => 'LPイベント',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => false,
        'rewrite' => array('slug' => 'lp-event'),
        'show_in_rest' => false,
    );

    register_post_type('lp_event', $args);
}
add_action('init', 'iwasaki_register_lp_event_cpt');


/* =========================================
 * LPイベント用メタボックス
 * カスタム投稿タイプ：lp_event
 * 画像は「アイキャッチ画像」を使用
 * ========================================= */
function iwasaki_add_lp_event_metabox()
{
    add_meta_box(
        'lp_event_meta',
        'LPイベント情報',
        'iwasaki_render_lp_event_metabox',
        'lp_event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'iwasaki_add_lp_event_metabox');


function iwasaki_render_lp_event_metabox($post)
{

    wp_nonce_field('lp_event_meta_nonce', 'lp_event_meta_nonce_field');

    $tag = get_post_meta($post->ID, 'lp_event_tag', true);
    $date = get_post_meta($post->ID, 'lp_event_date', true);
    $date_label = get_post_meta($post->ID, 'lp_event_date_label', true);
    $short = get_post_meta($post->ID, 'lp_event_short', true);
    $detail = get_post_meta($post->ID, 'lp_event_detail', true);
    $link = get_post_meta($post->ID, 'lp_event_link', true);

    // おすすめイベントフラグ（'1' or '0'）
    $is_featured = get_post_meta($post->ID, 'lp_event_featured', true);
?>
<table class="form-table">

    <tr>
        <th><label for="lp_event_featured">おすすめイベントにする</label></th>
        <td>
            <label>
                <input type="checkbox" name="lp_event_featured" id="lp_event_featured" value="1" <?php
                    checked($is_featured, '1' ); ?>>
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
        '' => '--- 選択してください ---',
        'oc' => 'オープンキャンパス',
        'trial' => '体験授業',
        'briefing' => '説明会',
        'soon' => '開催間近',
    ];
    foreach ($options as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($tag, $value, false) . '>' . esc_html($label) . '</option>';
    }
?>
            </select>
            <p class="description">LPの「イベントを条件でさがす」ボタンと連動します。未選択（---）の場合はLPに表示されません。</p>
        </td>
    </tr>

    <tr>
        <th><label for="lp_event_date">開催日</label></th>
        <td>
            <input type="date" name="lp_event_date" id="lp_event_date" value="<?php echo esc_attr($date); ?>">
            <p class="description">例：2025-12-14（カレンダーでの絞り込みに利用）</p>
        </td>
    </tr>

    <tr>
        <th><label for="lp_event_date_label">表示用日付ラベル</label></th>
        <td>
            <input type="text" name="lp_event_date_label" id="lp_event_date_label"
                value="<?php echo esc_attr($date_label); ?>" placeholder="12/14">
            <p class="description">カード右下表示用。未入力なら開催日から自動生成されます（テンプレ側）。</p>
        </td>
    </tr>

    <tr>
        <th><label for="lp_event_short">カード概要</label></th>
        <td>
            <textarea name="lp_event_short" id="lp_event_short" rows="3"
                class="large-text"><?php echo esc_textarea($short); ?></textarea>
            <p class="description">カードに表示する短い説明文。</p>
        </td>
    </tr>

    <tr>
        <th><label for="lp_event_detail">モーダル詳細</label></th>
        <td>
            <textarea name="lp_event_detail" id="lp_event_detail" rows="5"
                class="large-text"><?php echo esc_textarea($detail); ?></textarea>
            <p class="description">カードクリック時のモーダルで使用。</p>
        </td>
    </tr>

    <tr>
        <th><label for="lp_event_link">詳細／予約リンク</label></th>
        <td>
            <input type="url" name="lp_event_link" id="lp_event_link" value="<?php echo esc_attr($link); ?>"
                class="large-text" placeholder="https://www.iwasaki.ac.jp/...">
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
function iwasaki_save_lp_event_meta($post_id)
{

    if (!isset($_POST['lp_event_meta_nonce_field']) ||
    !wp_verify_nonce($_POST['lp_event_meta_nonce_field'], 'lp_event_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (get_post_type($post_id) !== 'lp_event') {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 通常フィールド
    $fields = [
        'lp_event_tag' => 'text',
        'lp_event_date' => 'text',
        'lp_event_date_label' => 'text',
        'lp_event_short' => 'textarea',
        'lp_event_detail' => 'textarea',
        'lp_event_link' => 'url',
    ];

    foreach ($fields as $field => $type) {
        if (isset($_POST[$field])) {
            $value = $_POST[$field];

            switch ($type) {
                case 'textarea':
                    $value = sanitize_textarea_field($value);
                    break;
                case 'url':
                    $value = esc_url_raw($value);
                    break;
                default:
                    $value = sanitize_text_field($value);
            }

            update_post_meta($post_id, $field, $value);
        }
    }

    // おすすめフラグ（チェックは未送信になるので、必ず0/1で保存）
    $featured = (isset($_POST['lp_event_featured']) && $_POST['lp_event_featured'] === '1') ? '1' : '0';
    update_post_meta($post_id, 'lp_event_featured', $featured);
}
add_action('save_post_lp_event', 'iwasaki_save_lp_event_meta');

/**
 * LPイベント一覧に警告カラムを追加
 */
function iwasaki_add_lp_event_columns($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'date') {
            $new_columns['lp_status'] = 'データ状態';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_lp_event_posts_columns', 'iwasaki_add_lp_event_columns');

function iwasaki_lp_event_columns_content($column, $post_id)
{
    if ($column == 'lp_status') {
        $tag = get_post_meta($post_id, 'lp_event_tag', true);
        $date = get_post_meta($post_id, 'lp_event_date', true);
        $warnings = array();

        if (empty($tag))
            $warnings[] = '種別未設定';
        if (empty($date))
            $warnings[] = '開催日未入力';

        if (!empty($warnings)) {
            echo '<span style="color: #d63638; font-weight: bold;">⚠️ ' . implode('<br>', $warnings) . '</span>';
            echo '<br><small>※LPには表示されません</small>';
        }
        else {
            echo '<span style="color: #008a20;">✅ OK</span>';
        }
    }
}
add_action('manage_lp_event_posts_custom_column', 'iwasaki_lp_event_columns_content', 10, 2);

/**
 * LPイベント編集画面に警告メッセージを表示
 */
function iwasaki_lp_event_admin_notices()
{
    global $post, $pagenow;
    if ($pagenow == 'post.php' && isset($post->post_type) && $post->post_type == 'lp_event') {
        $tag = get_post_meta($post->ID, 'lp_event_tag', true);
        $date = get_post_meta($post->ID, 'lp_event_date', true);

        if (empty($tag) || empty($date)) {
            echo '<div class="notice notice-warning is-dismissible">
                <p><strong>LPイベント設定の警告:</strong> 「イベント種別」または「開催日」が未入力です。このイベントはLPには表示されません。</p>
            </div>';
        }
    }
}
add_action('admin_notices', 'iwasaki_lp_event_admin_notices');


/* =========================================
 * LPイベント用タクソノミー：コース
 * ========================================= */
function iwasaki_register_lp_event_taxonomy()
{
    $labels = array(
        'name' => 'コース',
        'singular_name' => 'コース',
        'search_items' => 'コースを検索',
        'all_items' => 'すべてのコース',
        'parent_item' => '親コース',
        'parent_item_colon' => '親コース:',
        'edit_item' => 'コースを編集',
        'update_item' => 'コースを更新',
        'add_new_item' => '新規コースを追加',
        'new_item_name' => '新規コース名',
        'menu_name' => 'コース',
    );

    $args = array(
        'hierarchical' => false, // タグ形式
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'lp_event_course'),
    );

    register_taxonomy('lp_event_course', array('lp_event'), $args);
}
add_action('init', 'iwasaki_register_lp_event_taxonomy');