<?php
/**
 * Template Name: LP 2025 イベント一覧
 * Description: LPイベント投稿から自動生成するイベントLP（おすすめ＋一覧＋絞り込み）。
 */

get_header();
?>

<main id="primary" class="lp2025-page">

  <?php
/* =========================================
 * おすすめイベント（featured）
 * - featured=1 かつ 今日以降で開催日が最も近いものを1件
 * ========================================= */
$today = current_time('Y-m-d');
$target_course_raw = get_field('lp_target_course'); // IDまたはスラッグを取得
$request_link = get_field('lp_request_link'); // 資料請求リンクを取得

// テーマカスタマイズ
$theme_color = get_field('lp_theme_color') ?: '#0070c9';
$sub_color = get_field('lp_sub_color') ?: '#ffb800';
$title_featured = get_field('lp_title_featured') ?: 'おすすめのイベント';
$title_list = get_field('lp_title_list') ?: 'イベントを条件でさがす';
$request_title = get_field('lp_request_title') ?: '資料請求で、もっと詳しく。';
$request_desc = get_field('lp_request_desc') ?: "学科の詳細や、校風が伝わるパンフレットをお届けします。\n将来の進路選びに、ぜひお役立てください。";
$fixed_btn_text = get_field('lp_fixed_btn_text') ?: '資料請求はこちら！';

// LINE
$show_line = get_field('lp_show_line');
$line_url = get_field('lp_line_url');
$line_bubble = get_field('lp_line_bubble_text');
?>

<style>
  :root {
    --lp2025-accent: <?php echo esc_html($theme_color); ?>;
    --lp2025-sub: <?php echo esc_html($sub_color); ?>;
    --lp2025-accent-rgb: <?php 
      // RGB変換（box-shadow用）
      $hex = str_replace('#', '', $theme_color);
      if(strlen($hex) == 3) $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
      $r = hexdec(substr($hex, 0, 2));
      $g = hexdec(substr($hex, 2, 2));
      $b = hexdec(substr($hex, 4, 2));
      echo "$r, $g, $b";
    ?>;
  }
  .lp2025-feature-btn, .lp2025-modal-btn, .lp2025-card-date, .lp2025-bottom-btn, .lp2025-fixed-request { background-color: var(--lp2025-accent) !important; }
  .lp2025-feature-date, .lp2025-filter-buttons button.active { background-color: var(--lp2025-sub) !important; }
  .lp2025-title, .lp2025-bottom-title { color: var(--lp2025-accent) !important; }
  .lp2025-card.is-soon::before { background-color: var(--lp2025-sub) !important; }
  .lp2025-calendar-day.has-event::after { background-color: var(--lp2025-accent) !important; }
</style>

<?php
// タックスクエリ用のパラメータを整理
$course_filter_field = 'slug';
$course_filter_value = $target_course_raw;

if ($target_course_raw && is_numeric($target_course_raw)) {
  $course_filter_field = 'term_id';
  $course_filter_value = (int)$target_course_raw;
}

$featured_args = [
  'post_type' => 'lp_event',
  'post_status' => 'publish',
  'posts_per_page' => 5,
  'meta_query' => [
    'relation' => 'AND',
    'featured_clause' => [
      'key' => 'lp_event_featured',
      'value' => '1',
      'compare' => '=',
    ],
    'tag_clause' => [
      'key' => 'lp_event_tag',
      'value' => '',
      'compare' => '!=',
    ],
    'date_clause' => [
      'key' => 'lp_event_date',
      'value' => $today,
      'compare' => '>=',
      'type' => 'DATE',
    ],
  ],
  'orderby' => [
    'date_clause' => 'ASC',
  ],
];

// コースが指定されている場合は絞り込みを追加
if ($target_course_raw) {
  $featured_args['tax_query'] = [
    'relation' => 'OR',
    [
      'taxonomy' => 'lp_event_course',
      'field'    => $course_filter_field,
      'terms'    => $course_filter_value,
    ],
    [
      'taxonomy' => 'lp_event_course',
      'field'    => 'slug',
      'terms'    => 'all', // 全体表示用コース
    ],
  ];
} else {
  // 指定がない（All表示）場合でも、タグ未設定のものは非表示にするための追加条件
  // (meta_query ですでに対応済み)
}

$featured_query = new WP_Query($featured_args);

if ($featured_query->have_posts()):
?>
  <section class="lp2025-section lp2025-section-feature">
    <h2 class="lp2025-title"><?php echo esc_html($title_featured); ?></h2>

    <div class="swiper lp2025-feature-swiper">
      <div class="swiper-wrapper">
        <?php
        while ($featured_query->have_posts()):
          $featured_query->the_post();

          $event_id = get_the_ID();
          $date = get_post_meta($event_id, 'lp_event_date', true);
          $date_label = get_post_meta($event_id, 'lp_event_date_label', true);
          $short = get_post_meta($event_id, 'lp_event_short', true);
          $detail = get_post_meta($event_id, 'lp_event_detail', true);
          $link = get_post_meta($event_id, 'lp_event_link', true);

          if (!$date_label && $date) {
            $date_label = date_i18n('n/j', strtotime($date));
          }

          $thumb_id = get_post_thumbnail_id($event_id);
          $img_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
          $img_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
        ?>
          <div class="swiper-slide">
            <div class="lp2025-feature-card">
              <?php if ($img_url): ?>
                <div class="lp2025-feature-img">
                  <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                </div>
              <?php endif; ?>

              <div class="lp2025-feature-body">
                <h3 class="lp2025-feature-title">
                  <?php the_title(); ?>
                </h3>

                <?php if ($short): ?>
                  <p class="lp2025-feature-text">
                    <?php echo esc_html($short); ?>
                  </p>
                <?php endif; ?>

                <div class="lp2025-feature-meta">
                  <?php if ($date_label): ?>
                    <span class="lp2025-feature-date">
                      <?php echo esc_html($date_label); ?>
                    </span>
                  <?php endif; ?>

                  <?php if ($link): ?>
                    <a href="<?php echo esc_url($link); ?>" class="lp2025-feature-btn" target="_blank" rel="noopener">
                      詳細・申込を見る
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <!-- Pagination (Dots) -->
      <div class="lp2025-feature-pagination swiper-pagination"></div>
      
      <!-- Navigation (Arrows) -->
      <div class="lp2025-feature-prev swiper-button-prev"></div>
      <div class="lp2025-feature-next swiper-button-next"></div>
    </div>
  </section>
<?php
  wp_reset_postdata();
endif;
?>

  <!-- =========================================
       イベント一覧（条件検索）
       ========================================= -->
  <section class="lp2025-section">
    <h2 class="lp2025-title"><?php echo esc_html($title_list); ?></h2>

    <div class="lp2025-filter-buttons">
      <button type="button" data-tag="all" class="active">すべて</button>
      <button type="button" data-tag="oc">オープンキャンパス</button>
      <button type="button" data-tag="trial">体験授業</button>
      <button type="button" data-tag="briefing">説明会</button>
      <button type="button" data-tag="soon">開催間近</button>
    </div>

    <!-- =========================================
         カレンダー（表示枠）
         ※ JSで #lp2025-calendar に中身を描画する想定
         ========================================= -->
    <div class="lp2025-calendar-wrap">
      <div class="lp2025-calendar-head" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
        <button type="button" id="lp2025-cal-prev" class="lp2025-cal-nav" style="border:none;background:#f0f0f0;border-radius:16px;padding:4px 10px;cursor:pointer;font-size:18px;">‹</button>
        <div id="lp2025-cal-title" class="lp2025-cal-title" style="font-weight:700;"></div>
        <button type="button" id="lp2025-cal-next" class="lp2025-cal-nav" style="border:none;background:#f0f0f0;border-radius:16px;padding:4px 10px;cursor:pointer;font-size:18px;">›</button>
      </div>

      <div id="lp2025-calendar" class="lp2025-calendar"></div>

      <div id="lp2025-cal-state" class="lp2025-cal-state" style="display:none;">
        <span id="lp2025-cal-state-text"></span>
        <button type="button" id="lp2025-cal-reset" class="lp2025-cal-reset">解除</button>
      </div>
    </div>

    <div class="lp2025-card-grid">
      <?php
$list_args = [
  'post_type' => 'lp_event',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'meta_query' => [
    'relation' => 'AND',
    'tag_clause' => [
      'key' => 'lp_event_tag',
      'value' => '',
      'compare' => '!=',
    ],
    'date_clause' => [
      'key' => 'lp_event_date',
      'value' => $today,
      'compare' => '>=',
      'type' => 'DATE',
    ],
  ],
  'orderby' => [
    'date_clause' => 'ASC',
  ],
];

if ($target_course_raw) {
  $list_args['tax_query'] = [
    'relation' => 'OR',
    [
      'taxonomy' => 'lp_event_course',
      'field'    => $course_filter_field,
      'terms'    => $course_filter_value,
    ],
    [
      'taxonomy' => 'lp_event_course',
      'field'    => 'slug',
      'terms'    => 'all', // 全体表示用コース
    ],
  ];
}

$events_query = new WP_Query($list_args);

if ($events_query->have_posts()):
  while ($events_query->have_posts()):
    $events_query->the_post();

    $event_id = get_the_ID();
    $tag = get_post_meta($event_id, 'lp_event_tag', true) ?: 'oc';
    $date = get_post_meta($event_id, 'lp_event_date', true);
    $date_label = get_post_meta($event_id, 'lp_event_date_label', true);
    $short = get_post_meta($event_id, 'lp_event_short', true);
    $detail = get_post_meta($event_id, 'lp_event_detail', true);
    $link = get_post_meta($event_id, 'lp_event_link', true);

    if (!$date_label && $date) {
      $date_label = date_i18n('n/j', strtotime($date));
    }

    $thumb_id = get_post_thumbnail_id($event_id);
    $img_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : '';
    $img_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
?>

      <article class="lp2025-card" data-tag="<?php echo esc_attr($tag); ?>"
        data-date="<?php echo esc_attr($date); ?>" data-modal-title="<?php echo esc_attr(get_the_title()); ?>"
        data-modal-desc="<?php echo esc_attr($short); ?>" data-modal-detail="<?php echo esc_attr($detail); ?>" <?php
        if ($img_url): ?>
        data-modal-img="
        <?php echo esc_url($img_url); ?>"
        <?php
    endif; ?>
        <?php if ($link): ?>
        data-modal-link="
        <?php echo esc_url($link); ?>"
        <?php
    endif; ?>
        >

        <div class="lp2025-card-img">
          <?php if ($img_url): ?>
            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
          <?php endif; ?>
        </div>

        <div class="lp2025-card-body">
          <h3 class="lp2025-card-title">
            <?php the_title(); ?>
          </h3>
          <?php if ($short): ?>
          <p>
            <?php echo esc_html($short); ?>
          </p>
          <?php
    endif; ?>
        </div>

        <?php if ($date_label): ?>
        <div class="lp2025-card-date">
          <?php echo esc_html($date_label); ?>
        </div>
        <?php
    endif; ?>

      </article>

      <?php
  endwhile;
  wp_reset_postdata();
else:
?>
      <p>現在、開催予定のイベントはありません。</p>
      <?php
endif; ?>
    </div><!-- /.lp2025-card-grid -->
  </section><!-- /.lp2025-section -->

  <!-- =========================================
       モーダル
       ========================================= -->
  <div id="lp2025-modal" class="lp2025-modal">
    <div class="lp2025-modal-inner">
      <span class="lp2025-modal-close">&times;</span>
      <img id="lp2025-modal-img" alt="">
      <h3 id="lp2025-modal-title"></h3>
      <p id="lp2025-modal-desc"></p>
      <p id="lp2025-modal-detail"></p>
      <a id="lp2025-modal-link" href="#" target="_blank" rel="noopener" class="lp2025-modal-btn" style="display:none;">
        詳細・申込を見る
      </a>
    </div>
  </div>

  <!-- 資料請求固定ボタン -->
  <?php if ($request_link): ?>
    <a href="#lp-request-bottom" class="lp2025-fixed-request"><?php echo esc_html($fixed_btn_text); ?></a>
  <?php endif; ?>

  <!-- 資料請求詳細セクション -->
  <?php if ($request_link): ?>
    <section id="lp-request-bottom" class="lp2025-bottom-section">
      <div class="lp2025-container">
        <h2 class="lp2025-bottom-title"><?php echo esc_html($request_title); ?></h2>
        <div class="lp2025-bottom-desc">
          <?php echo nl2br(esc_html($request_desc)); ?>
        </div>
        <a href="<?php echo esc_url($request_link); ?>" target="_blank" rel="noopener" class="lp2025-bottom-btn">
          資料請求（無料）はこちら
        </a>
      </div>
    </section>
  <?php endif; ?>

  <!-- LINE友達追加ボタン -->
  <?php if ($show_line && $line_url): ?>
    <div class="lp2025-line-wrap" id="lp2025-line-wrap">
      <?php if ($line_bubble): ?>
        <div class="lp2025-line-bubble"><?php echo esc_html($line_bubble); ?></div>
      <?php endif; ?>
      <a href="<?php echo esc_url($line_url); ?>" target="_blank" rel="noopener" class="lp2025-line-btn">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/LINE_logo.svg" alt="LINE友達追加">
      </a>
    </div>
  <?php endif; ?>

</main>

<?php get_footer(); ?>