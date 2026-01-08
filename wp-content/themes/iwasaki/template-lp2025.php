<?php
/**
 * Template Name: LP2025（テスト）
 * Description: カスタム投稿タイプ 'lp_event' からイベントを取得して表示。
 * 
 * 仕様:
 * - カレンダー削除（シンプル化）
 * - 未来イベント優先（昇順）、なければ過去イベント（降順）
 * - 日付ロジック：今日以降は受付中（厳密な整数比較）
 * - 管理者のみデバッグ情報表示
 */

get_header();

/* =========================================================
 * 0. 固定ページ情報の取得（タイトル、本文、CTA URL）
 * ======================================================= */
$page_title = '';
$page_content = '';
$hero_cta_url = '';

if (have_posts()) {
  while (have_posts()) {
    the_post(); // Main Page Loop
    $page_title = get_the_title();
    $page_content = get_the_content();
    $hero_cta_url = get_post_meta(get_the_ID(), 'lp_hero_cta_url', true);
  }
}
// Fallback CTA
if (!$hero_cta_url) {
  $hero_cta_url = '#';
}

/* =========================================================
 * 1. データ取得 (WP_Query)
 * ======================================================= */
// 日付基準：WordPressのローカルタイムで Ymd (int) を取得
$today_int = (int) wp_date('Ymd');
$is_admin = is_user_logged_in() && current_user_can('manage_options');

// Debug output buffer
$debug_html = '';

if ($is_admin) {
  $debug_html .= '<div style="background:#ffe; color:#333; padding:10px; border-bottom:1px solid #fcc; font-size:11px; font-family:monospace; position:fixed; top:32px; right:10px; z-index:9999; max-width:300px; opacity:0.95; max-height:80vh; overflow-y:auto;">';
  $debug_html .= '<strong>[Admin Debug]</strong><br>';
  $debug_html .= 'Today(int): ' . $today_int . '<br>';
  $debug_html .= '------------------<br>';
}

$args = [
  'post_type' => 'lp_event',
  'posts_per_page' => -1, // 全件取得
  'post_status' => 'publish',
  // 'meta_key'    => 'event_date_ymd', // 必須にすると日付未設定の投稿が出なくなるため除外
];
$query = new WP_Query($args);

$counts = wp_count_posts('lp_event');
$count_publish = $counts->publish;
$count_draft = $counts->draft;
$count_private = $counts->private;
$count_trash = $counts->trash;

if ($is_admin) {
  $debug_html .= 'Status: Pub(' . $count_publish . ') / Draft(' . $count_draft . ') / Private(' . $count_private . ') / Trash(' . $count_trash . ')<br>';
  $debug_html .= 'Query Found: ' . $query->found_posts . '<br>';
}

$future_events = [];
$past_events = [];
$nodate_events = []; // 日付未設定

if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();

    // Meta取得
    $d_ymd_raw = get_post_meta(get_the_ID(), 'event_date_ymd', true);
    // 正規化（数字以外除去してint化）
    $event_date_int = (int) preg_replace('/\D/', '', $d_ymd_raw);

    $event_url = get_post_meta(get_the_ID(), 'event_url', true);

    $is_pickup = get_post_meta(get_the_ID(), 'event_is_pickup', true) === 'on';

    // 受付ステータス判定: Open if event date is today or future
    // 日付未設定($event_date_int == 0)の場合はどうするか？ -> 一応表示するが「詳細未定」扱いなど
    if ($event_date_int > 0) {
      $is_open = ($event_date_int >= $today_int);
    } else {
      $is_open = true; // 日付未定ならとりあえずOpen扱いにする（要件次第）
    }

    // Debug info per post
    if ($is_admin) {
      $status_label = $is_open ? '<span style="color:green;font-weight:bold;">OPEN</span>' : '<span style="color:red;">CLOSED</span>';
      $url_label = !empty($event_url) ? '(URL:Yes)' : '(URL:No)';
      $pickup_label = $is_pickup ? '(PICKUP)' : '';
      $debug_html .= sprintf(
        '[ID:%d] %s (%s) %s %s %s<br>',
        get_the_ID(),
        mb_strimwidth(get_the_title(), 0, 20, '...'),
        $d_ymd_raw ? $d_ymd_raw : 'NoDate',
        $status_label,
        $url_label,
        $pickup_label
      );
    }

    // 画像判定
    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
    if (!$thumb_url) {
      $thumb_url = get_post_meta(get_the_ID(), 'event_image_url', true);
    }
    if (empty($thumb_url)) {
      $thumb_url = 'https://placehold.jp/24/cccccc/ffffff/1200x675.png?text=No%20Image';
    }

    // コース情報
    $terms = get_the_terms(get_the_ID(), 'lp_event_course');
    $course_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';

    // 日付整形
    $date_text = get_post_meta(get_the_ID(), 'event_date_text', true);
    if (empty($date_text) && $event_date_int > 0) {
      $ymd_str = (string) $event_date_int;
      if (strlen($ymd_str) === 8) {
        $y = substr($ymd_str, 0, 4);
        $m = substr($ymd_str, 4, 2);
        $d = substr($ymd_str, 6, 2);
        $date_text = sprintf('%d年%d月%d日', $y, $m, $d);
      }
    }

    $event_data = [
      'id' => get_the_ID(),
      'title' => get_the_title(),
      'content' => get_the_content(), // Add for Modal
      'lead' => get_the_excerpt(),
      'date_ymd' => $d_ymd_raw, // Original String
      'date_int' => $event_date_int, // Integer
      'date_text' => $date_text,
      'time' => get_post_meta(get_the_ID(), 'event_time', true),
      'place' => get_post_meta(get_the_ID(), 'event_place', true),
      'url' => $event_url,
      'cta_label' => get_post_meta(get_the_ID(), 'event_cta_label', true),
      'image_url' => $thumb_url,
      'course' => $course_name,
      'is_open' => $is_open,
      'is_pickup' => $is_pickup,
    ];

    if ($event_date_int == 0) {
      $nodate_events[] = $event_data;
    } else if ($is_open) {
      $future_events[] = $event_data;
    } else {
      $past_events[] = $event_data;
    }
  }
  wp_reset_postdata();
}

if ($is_admin) {
  $debug_html .= 'Future: ' . count($future_events) . '<br>';
  $debug_html .= 'Past: ' . count($past_events) . '<br>';
  $debug_html .= 'NoDate: ' . count($nodate_events) . '<br>';
  $debug_html .= '</div>';
  echo $debug_html;
}

/* =========================================================
 * 2. 表示用リストの構築
 * ======================================================= */
// 並び替え: 未来(近い順) -> 日付未定 -> 過去(新しい順)
// 未来イベント（昇順）
if (!empty($future_events)) {
  usort($future_events, function ($a, $b) {
    return $a['date_int'] - $b['date_int'];
  });
}
// 過去イベント（降順）
if (!empty($past_events)) {
  usort($past_events, function ($a, $b) {
    return $b['date_int'] - $a['date_int'];
  });
}

// 結合: 未来 -> 日付なし -> 過去
$all_sorted_events = array_merge($future_events, $nodate_events, $past_events);

$pickup_events = [];
$grid_events = $all_sorted_events; // Pickup含め、すべての予定を一覧に表示する

foreach ($all_sorted_events as $ev) {
  if ($ev['is_pickup']) {
    $pickup_events[] = $ev;
  }
}

// Pickupがない場合のフォールバック: 全体から最初の1つをPickupにする
if (empty($pickup_events) && !empty($all_sorted_events)) {
  $pickup_events[] = $all_sorted_events[0];
}


/* =========================================================
 * 3. CSS (Scoped)
 * ======================================================= */
?>
<style>
  /* Base */
  .lp2025 {
    width: 100%;
    box-sizing: border-box;
    font-family: "Helvetica Neue", Arial, sans-serif;
    background: #fff;
  }

  .lp2025 * {
    box-sizing: border-box;
  }

  .lp2025__inner {
    width: min(1120px, calc(100% - 32px));
    margin: 0 auto;
    padding: 24px 0 56px;
  }

  .lp2025__title {
    margin: 0 0 16px;
    font-size: 32px;
    line-height: 1.2;
    text-align: center;
    font-weight: bold;
  }

  .lp2025__note {
    margin: 0 auto 40px;
    font-size: 14px;
    color: #555;
    text-align: center;
    max-width: 800px;
    line-height: 1.8;
  }

  /* CTA Button */
  .lp2025-main-cta {
    display: table;
    margin: 0 auto 48px;
    background: #e60012;
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    padding: 16px 48px;
    border-radius: 99px;
    text-decoration: none;
    transition: background 0.3s;
    box-shadow: 0 4px 12px rgba(230, 0, 18, 0.3);
  }

  .lp2025-main-cta:hover {
    background: #c2000f;
  }

  /* Featured Card */
  .lp2025-featured {
    border: 1px solid #e6e6e6;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    margin: 0 0 40px;
    transition: box-shadow 0.2s;
  }

  .lp2025-featured:hover {
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
  }

  .lp2025-featured__inner {
    display: grid;
    grid-template-columns: 1.25fr 1fr;
    gap: 0;
    text-decoration: none;
    color: inherit;
  }

  .lp2025-featured__media {
    background: #eee;
    overflow: hidden;
    position: relative;
    width: 100%;
    aspect-ratio: 16/9;
  }

  .lp2025-featured__media img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    vertical-align: bottom;
    transition: transform 0.3s;
  }

  .lp2025-featured:hover .lp2025-featured__media img {
    transform: scale(1.02);
  }

  .lp2025-featured__body {
    padding: 32px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .lp2025-featured__kicker {
    margin: 0 0 10px;
    font-size: 12px;
    letter-spacing: .05em;
    color: #666;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .lp2025-featured__title {
    margin: 0 0 16px;
    font-size: 26px;
    line-height: 1.3;
    font-weight: bold;
    color: #111;
  }

  .lp2025-featured__lead {
    margin: 0 0 24px;
    font-size: 14px;
    color: #444;
    line-height: 1.6;
  }

  .lp2025-featured__meta {
    margin: 0 0 24px;
    display: grid;
    gap: 8px;
  }

  .lp2025-featured__meta div {
    display: grid;
    grid-template-columns: 50px 1fr;
    gap: 12px;
    align-items: baseline;
    font-size: 14px;
  }

  .lp2025-featured__meta dt {
    color: #888;
    margin: 0;
    font-size: 13px;
  }

  .lp2025-featured__meta dd {
    color: #111;
    margin: 0;
    font-weight: bold;
  }

  .lp2025-featured__tag {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    background: #efefef;
    font-size: 12px;
    color: #555;
  }

  /* Buttons */
  .lp2025-btn {
    display: inline-block;
    padding: 10px 24px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    background: #fff;
    color: #333;
    align-self: flex-start;
    text-decoration: none;
    transition: background 0.2s;
    cursor: pointer;
  }

  .lp2025-btn:hover {
    background: #f0f0f0;
  }

  /* Closed State (Not a link) */
  .lp2025-btn-closed {
    display: inline-block;
    padding: 10px 24px;
    border: 1px solid #eee;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    background: #f9f9f9;
    color: #999;
    align-self: flex-start;
    cursor: default;
    pointer-events: none;
  }

  /* Grid Layout */
  .lp2025-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
    margin-bottom: 60px;
  }

  .lp2025-card {
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
  }

  .lp2025-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
  }

  a.lp2025-card__link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .lp2025-card__link--div {
    /* Linkでない場合のスタイル */
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .lp2025-card__media {
    background: #eee;
    position: relative;
    width: 100%;
    aspect-ratio: 16/9;
    overflow: hidden;
  }

  .lp2025-card__media img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    vertical-align: bottom;
  }

  .lp2025-card__body {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .lp2025-card__title {
    margin: 0 0 12px;
    font-size: 18px;
    line-height: 1.4;
    font-weight: bold;
    color: #111;
    min-height: 2.8em;
    /* 2行分の高さを確保してリズムを一定にする */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .lp2025-card__meta {
    margin: 0 0 12px;
    padding-top: 12px;
    border-top: 1px solid #f0f0f0;
    display: grid;
    gap: 6px;
    font-size: 13px;
  }

  .lp2025-card__meta div {
    display: flex;
    gap: 10px;
  }

  .lp2025-card__meta dt {
    color: #888;
    min-width: 40px;
  }

  .lp2025-card__meta dd {
    font-weight: bold;
    margin: 0;
  }

  .lp2025-card__tags {
    margin-bottom: 8px;
  }

  .lp2025-card__btn-area {
    margin-top: auto;
    padding-top: 20px;
  }

  .lp2025-tag {
    font-size: 11px;
    padding: 3px 8px;
    background: #f4f4f4;
    border-radius: 4px;
    color: #555;
  }

  /* Load More Button - Modern & Premium */
  .lp2025-load-more-area {
    text-align: center;
    margin: 0 0 60px;
    clear: both;
  }

  .lp2025-load-more {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 56px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 99px;
    font-size: 14px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    position: relative;
    overflow: hidden;
  }

  .lp2025-load-more:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    background: #fafafa;
    border-color: #ddd;
  }

  .lp2025-load-more:active {
    transform: translateY(0);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .lp2025-load-more::after {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    border-right: 2px solid #666;
    border-bottom: 2px solid #666;
    transform: rotate(45deg);
    margin-top: -4px;
    transition: transform 0.3s;
  }

  .lp2025-load-more:hover::after {
    transform: rotate(45deg) translate(2px, 2px);
  }

  .lp2025-load-more.is-expanded::after {
    transform: rotate(-135deg);
    margin-top: 2px;
  }

  .lp2025-load-more.is-expanded:hover::after {
    transform: rotate(-135deg) translate(-2px, -2px);
  }

  /* Reveal Animation */
  .lp2025-card--hidden {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
  }

  .lp2025-card--show {
    display: flex !important;
  }

  .lp2025-card--fadein {
    opacity: 1;
    transform: translateY(0);
  }

  /* Slider Logic Styles */
  .lp2025-slider {
    position: relative;
    max-width: 1200px;
    margin: 0 auto 60px;
    overflow: hidden;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
  }

  .lp2025-featured__media {
    background: #eee;
    position: relative;
    width: 100%;
    aspect-ratio: 16/9;
    overflow: hidden;
  }

  .lp2025-featured__media img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    vertical-align: bottom;
  }

  .lp2025-slide {
    display: none;
    animation: lpFade 0.8s ease-in-out forwards;
  }

  .lp2025-slide.is-active {
    display: block;
  }

  @keyframes lpFade {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  /* Slider Arrows */
  .lp2025-slider__arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s;
    opacity: 0.4;
    /* Slightly visible by default */
    border: 1px solid #ddd;
  }

  .lp2025-slider:hover .lp2025-slider__arrow {
    opacity: 1;
    background: #fff;
  }

  .lp2025-slider__arrow:hover {
    background: #fff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    animation: lpArrowPulse 1s infinite ease-in-out;
  }

  .lp2025-slider__arrow--prev {
    left: 20px;
  }

  .lp2025-slider__arrow--next {
    right: 20px;
  }

  .lp2025-slider__arrow::before {
    content: '';
    display: block;
    width: 10px;
    height: 10px;
    border-top: 2px solid #333;
    border-left: 2px solid #333;
  }

  .lp2025-slider__arrow--prev::before {
    transform: rotate(-45deg) translate(2px, 2px);
  }

  .lp2025-slider__arrow--next::before {
    transform: rotate(135deg) translate(2px, 2px);
  }

  @keyframes lpArrowPulse {
    0% {
      transform: translateY(-50%) scale(1);
      border-color: #ddd;
    }

    50% {
      transform: translateY(-50%) scale(1.1);
      border-color: #aaa;
    }

    100% {
      transform: translateY(-50%) scale(1);
      border-color: #ddd;
    }
  }

  /* Modal Styles */
  .lp2025-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
  }

  .lp2025-modal.is-open {
    opacity: 1;
    visibility: visible;
  }

  .lp2025-modal-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
  }

  .lp2025-modal-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -45%);
    width: 90%;
    max-width: 800px;
    max-height: 85vh;
    background: #fff;
    border-radius: 24px;
    overflow-y: auto;
    transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  }

  .lp2025-modal.is-open .lp2025-modal-container {
    transform: translate(-50%, -50%);
  }

  .lp2025-modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .lp2025-modal-close::before,
  .lp2025-modal-close::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 2px;
    background: #333;
  }

  .lp2025-modal-close::before {
    transform: rotate(45deg);
  }

  .lp2025-modal-close::after {
    transform: rotate(-45deg);
  }

  .lp2025-modal-content {
    padding: 60px 40px;
  }

  .lp2025-modal-header {
    margin-bottom: 30px;
    text-align: center;
  }

  .lp2025-modal-img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 30px;
  }

  .lp2025-modal-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
    line-height: 1.4;
  }

  .lp2025-modal-body {
    font-size: 16px;
    line-height: 1.8;
    color: #444;
    margin-bottom: 40px;
  }

  .lp2025-modal-footer {
    text-align: center;
  }

  .lp2025-modal-btn {
    display: inline-block;
    padding: 18px 60px;
    background: #cc0000;
    color: #fff;
    font-weight: bold;
    border-radius: 99px;
    text-decoration: none;
    transition: transform 0.3s, background 0.3s;
    box-shadow: 0 10px 20px rgba(204, 0, 0, 0.2);
  }

  .lp2025-modal-btn:hover {
    transform: translateY(-2px);
    background: #ee0000;
  }

  /* --- Horror Gimmick CSS --- */
  .lp2025-modal.is-horror .lp2025-modal-container {
    background: #1a0000;
    color: #cc0000;
    box-shadow: 0 0 50px rgba(255, 0, 0, 0.2);
    border: 1px solid #330000;
  }

  .lp2025-modal.is-horror .lp2025-modal-body,
  .lp2025-modal.is-horror .lp2025-modal-title {
    color: #cc0000;
    text-shadow: 2px 2px 0px #000;
  }

  .lp2025-modal.is-horror .lp2025-modal-img {
    filter: grayscale(1) contrast(1.5) brightness(0.5) sepia(1) hue-rotate(-50deg);
  }

  .is-glitching {
    animation: lpGlitch 0.2s infinite;
  }

  @keyframes lpGlitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
  }

  .lp-static-noise {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 20000;
    background: url('https://upload.wikimedia.org/wikipedia/commons/5/5a/Static_noise.gif');
    opacity: 0.3;
    pointer-events: none;
    display: none;
  }

  .lp2025-modal.is-horror .lp2025-modal-btn {
    background: #330000;
    border: 1px solid #660000;
    box-shadow: none;
    font-family: serif;
    letter-spacing: 5px;
  }

  .lp2025-modal.is-horror .lp2025-modal-btn:hover {
    background: #000;
    color: #f00;
  }

  .shake-btn {
    animation: lpShake 0.1s infinite;
  }

  @keyframes lpShake {
    0% { transform: translate(0, 0) rotate(0); }
    25% { transform: translate(5px, 5px) rotate(5deg); }
    50% { transform: translate(-5px, 5px) rotate(-5deg); }
    75% { transform: translate(5px, -5px) rotate(5deg); }
    100% { transform: translate(-5px, -5px) rotate(-5deg); }
  }

  /* Progressive Effects */
  .is-stage3-glitch {
    animation: lpGlitch 0.5s infinite step-end;
    opacity: 0.9;
  }

  .is-stage4-distorted .lp2025-modal-title,
  .is-stage4-distorted .lp2025-modal-body {
    filter: blur(0.5px);
    letter-spacing: -1px;
    font-family: serif;
    transform: skewX(-5deg);
  }

  /* Responsive */
  @media (max-width: 960px) {
    .lp2025-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .lp2025-featured__inner {
      grid-template-columns: 1fr;
    }

    .lp2025-modal-content {
      padding: 40px 20px;
    }
  }

  @media (max-width: 600px) {
    .lp2025-grid {
      grid-template-columns: 1fr;
    }

    .lp2025-main-cta {
      width: 100%;
      text-align: center;
    }

    .lp2025__inner {
      width: calc(100% - 24px);
    }

    .lp2025__title {
      font-size: 26px;
    }

    .lp2025-modal-title {
      font-size: 22px;
    }

    .lp2025-slider__arrow {
      opacity: 0.6;
      width: 40px;
      height: 40px;
    }
  }
</style>

<main class="lp2025">
  <div class="lp2025__inner">

    <h1 class="lp2025__title" id="lp-main-title"><?php echo esc_html($page_title); ?></h1>
    <script>
      (function() {
        if (sessionStorage.getItem('lp_horror_seen')) {
          const title = document.getElementById('lp-main-title');
          if (title) title.textContent = "Welcome... back";
          sessionStorage.removeItem('lp_horror_seen');
        }
      })();
    </script>
    <div class="lp2025__note">
      <?php echo apply_filters('the_content', $page_content); ?>
    </div>

    <div style="text-align:center; margin-bottom: 60px;">
      <?php if ($hero_cta_url && $hero_cta_url !== '#'): ?>
        <a href="<?php echo esc_url($hero_cta_url); ?>" class="lp2025-main-cta" target="_blank">資料請求はこちら</a>
      <?php endif; ?>
    </div>

    <?php if (empty($all_sorted_events)): ?>
      <p style="text-align:center; padding: 40px; color:#666;">現在予定されているイベントはありません。</p>
    <?php else: ?>

      <?php /* --- PICKUP SLIDER --- */ ?>
      <section class="lp2025-slider">
        <?php foreach ($pickup_events as $idx => $p): ?>
          <article class="lp2025-slide <?php echo ($idx === 0) ? 'is-active' : ''; ?>"
            data-id="<?php echo esc_attr($p['id']); ?>">
            <div class="lp2025-featured__inner" style="cursor: pointer;"
              onclick="lpOpenModal(<?php echo esc_attr($p['id']); ?>)">
              <div class="lp2025-featured__media">
                <img src="<?php echo esc_url($p['image_url']); ?>" width="1200" height="675"
                  alt="<?php echo esc_attr($p['title']); ?>" loading="lazy">
              </div>
              <div class="lp2025-featured__body">
                <div class="lp2025-featured__kicker">
                  <?php if ($p['course']): ?>
                    <span class="lp2025-featured__tag"><?php echo esc_html($p['course']); ?></span>
                  <?php endif; ?>
                  <span>Pickup Event</span>
                </div>
                <h2 class="lp2025-featured__title"><?php echo esc_html($p['title']); ?></h2>
                <?php if ($p['lead']): ?>
                  <p class="lp2025-featured__lead"><?php echo esc_html($p['lead']); ?></p>
                <?php endif; ?>

                <dl class="lp2025-featured__meta">
                  <div>
                    <dt>開催日</dt>
                    <dd><?php echo esc_html($p['date_text'] ?: $p['date_ymd']); ?></dd>
                  </div>
                  <?php if ($p['time']): ?>
                    <div>
                      <dt>時間</dt>
                      <dd><?php echo esc_html($p['time']); ?></dd>
                    </div><?php endif; ?>
                  <?php if ($p['place']): ?>
                    <div>
                      <dt>場所</dt>
                      <dd><?php echo esc_html($p['place']); ?></dd>
                    </div><?php endif; ?>
                </dl>

                <?php if ($p['is_open']): ?>
                  <span class="lp2025-btn">詳細を見る</span>
                <?php else: ?>
                  <span class="lp2025-btn-closed">受付終了</span>
                <?php endif; ?>
              </div>
            </div>
          </article>
        <?php endforeach; ?>

        <?php if (count($pickup_events) > 1): ?>
          <div class="lp2025-slider__arrow lp2025-slider__arrow--prev" id="lp-slider-prev"></div>
          <div class="lp2025-slider__arrow lp2025-slider__arrow--next" id="lp-slider-next"></div>
        <?php endif; ?>
      </section>

      <?php /* --- GRID SECTION --- */ ?>
      <?php if (!empty($grid_events)): ?>
        <section class="lp2025-grid">
          <?php
          $item_idx = 0;
          foreach ($grid_events as $ev):
            $is_hidden = ($item_idx >= 6); // グリッドは全件表示（ただし初期は6件まで）
            $hidden_class = $is_hidden ? 'lp2025-card--hidden' : '';
            ?>
            <article class="lp2025-card <?php echo $hidden_class; ?>" id="event-<?php echo esc_attr($ev['id']); ?>">
              <div class="lp2025-card__link--div" style="cursor: pointer;"
                onclick="lpOpenModal(<?php echo esc_attr($ev['id']); ?>)">
                <div class="lp2025-card__media">
                  <img src="<?php echo esc_url($ev['image_url']); ?>" width="1200" height="675"
                    alt="<?php echo esc_attr($ev['title']); ?>" loading="lazy">
                </div>
                <div class="lp2025-card__body">
                  <?php if ($ev['course']): ?>
                    <div class="lp2025-card__tags"><span class="lp2025-tag"><?php echo esc_html($ev['course']); ?></span></div>
                  <?php endif; ?>
                  <h3 class="lp2025-card__title"><?php echo esc_html($ev['title']); ?></h3>
                  <dl class="lp2025-card__meta">
                    <div>
                      <dt>日程</dt>
                      <dd><?php echo esc_html($ev['date_text'] ?: $ev['date_ymd']); ?></dd>
                    </div>
                    <?php if ($ev['time']): ?>
                      <div>
                        <dt>時間</dt>
                        <dd><?php echo esc_html($ev['time']); ?></dd>
                      </div><?php endif; ?>
                  </dl>
                  <div class="lp2025-card__btn-area">
                    <?php if ($ev['is_open']): ?>
                      <span class="lp2025-card-btn">詳細を見る</span>
                    <?php else: ?>
                      <span class="lp2025-card-btn-closed">受付終了</span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </article>
            <?php
            $item_idx++;
          endforeach; ?>
        </section>

        <?php if (count($grid_events) > 6): ?>
          <div class="lp2025-load-more-area" id="lp2025-scroll-anchor">
            <button type="button" id="lp2025-load-more" class="lp2025-load-more" data-text-open="MORE EVENTS"
              data-text-close="CLOSE LIST">MORE EVENTS</button>
          </div>
        <?php endif; ?>

      <?php endif; ?>

    <?php endif; ?>

    <div style="text-align:center; margin-top: 80px; margin-bottom: 60px;">
      <?php
      // URLが未設定でもレイアウト確認のために表示する
      $b_url = ($hero_cta_url && $hero_cta_url !== '#') ? $hero_cta_url : '#';
      $b_target = ($b_url !== '#') ? '_blank' : '_self';
      ?>
      <a href="<?php echo esc_url($b_url); ?>" id="lp2025-bottom-cta" class="lp2025-main-cta"
        target="<?php echo esc_attr($b_target); ?>">資料請求はこちら</a>
    </div>

  </div>
</main>

<!-- Modal HTML -->
<div id="lp2025-modal" class="lp2025-modal">
  <div class="lp2025-modal-overlay" onclick="lpCloseModal()"></div>
  <div class="lp2025-modal-container">
    <div class="lp2025-modal-close" id="lp-modal-close" onclick="lpCloseModal()"></div>
    <div id="lp2025-modal-inner" class="lp2025-modal-content">
      <!-- Injected by JS -->
    </div>
  </div>
</div>
<div id="lp-static-noise" class="lp-static-noise"></div>

<script>
  // Data for Modal
  const lpEventsMap = <?php
  $map = [];
  foreach ($all_sorted_events as $e) {
    $map[$e['id']] = [
      'title' => $e['title'],
      'content' => apply_filters('the_content', $e['content']),
      'img' => $e['image_url'],
      'date' => $e['date_text'] ?: $e['date_ymd'],
      'time' => $e['time'],
      'place' => $e['place'],
      'url' => $e['url'],
      'is_open' => $e['is_open'],
      'course' => $e['course'],
      'label' => $e['cta_label'] ?: '参加する！'
    ];
  }
  echo json_encode($map);
  ?>;

  let lpClickSequence = [];
  const lpSecretPattern = [1, 5, 0, 2, 3, 1]; // Visual index ritual: Top-Ctr -> Bot-R -> Top-L -> Top-R -> Bot-L -> Top-Ctr

  function lpOpenModal(id) {
    const data = lpEventsMap[id];
    if (!data) return;

    // Secret logic
    const allCards = Array.from(document.querySelectorAll('.lp2025-card'));
    const clickedCard = document.getElementById(`event-${id}`);
    const visualIdx = allCards.indexOf(clickedCard);
    
    if (visualIdx !== -1) {
      lpClickSequence.push(visualIdx);
      if (lpClickSequence.length > lpSecretPattern.length) lpClickSequence.shift();
    }

    // Check how many steps match the secret pattern
    let matchCount = 0;
    for (let i = 0; i < lpClickSequence.length; i++) {
      if (lpClickSequence[i] === lpSecretPattern[i]) {
        matchCount++;
      } else {
        matchCount = 0; // Reset if any step in the current sequence is wrong
        break;
      }
    }

    const isHorror = matchCount === 6;
    const stage = matchCount;

    const inner = document.getElementById('lp2025-modal-inner');
    const modal = document.getElementById('lp2025-modal');
    const closeBtn = document.getElementById('lp-modal-close');

    // Reset styles
    modal.classList.remove('is-horror', 'is-stage3-glitch', 'is-stage4-distorted');
    inner.classList.remove('is-glitching');
    closeBtn.classList.remove('shake-btn');
    closeBtn.style.position = '';
    closeBtn.onmouseover = null;

    let titleText = data.title;
    let contentHtml = data.content;
    let btnHtml = (data.is_open && data.url ? `<a href="${data.url}" class="lp2025-modal-btn" target="_blank">${data.label}</a>` : `<span style="color:#999;">${data.is_open ? '詳細準備中' : '受付終了'}</span>`);

    if (stage === 3) {
      modal.classList.add('is-stage3-glitch');
      inner.classList.add('is-glitching');
    } else if (stage === 4) {
      modal.classList.add('is-stage4-distorted');
      const mojibakePool = "縺ゅ≠縺縺縿鐔縲懆髮縺後⊆縺溘∪縺縺吶％";
      titleText = data.title.split('').map(c => Math.random() > 0.5 ? mojibakePool[Math.floor(Math.random() * mojibakePool.length)] : c).join('');
      contentHtml = data.content.split('').map(c => Math.random() > 0.7 ? mojibakePool[Math.floor(Math.random() * mojibakePool.length)] : c).join('');
    } else if (stage === 5) {
      // Step 5: Fake Normal - do nothing, let it be normal
    } else if (stage === 6) {
      modal.classList.add('is-horror');
      inner.classList.add('is-glitching');
      closeBtn.classList.add('shake-btn');
      titleText = "た す け て";
      contentHtml = `<p style="text-align:center; font-size:30px; letter-spacing:10px;">だれかそこにいるの？</p><p style="margin-top:200px; text-align:right; opacity:0.5;">みてはいけない</p>`;
      btnHtml = `<button onclick="lpTriggerEnd()" class="lp2025-modal-btn">真相を知る</button>`;

      closeBtn.onmouseover = () => {
        closeBtn.style.position = 'fixed';
        closeBtn.style.top = Math.random() * 80 + 10 + '%';
        closeBtn.style.right = Math.random() * 80 + 10 + '%';
      };
    }

    inner.innerHTML = `
    <div class="lp2025-modal-header">
      <img src="${data.img}" class="lp2025-modal-img" alt="">
      <h2 class="lp2025-modal-title">${titleText}</h2>
      <div style="font-size:14px; color:#888; margin-bottom: 10px;">
        ${data.course ? `<span class="lp2025-tag">${data.course}</span>` : ''}
        ${isHorror ? "????/??/??" : `開催日: ${data.date} ${data.time ? `/ ${data.time}` : ''}`}
      </div>
    </div>
    <div class="lp2025-modal-body">
      ${contentHtml}
    </div>
    <div class="lp2025-modal-footer">
      ${btnHtml}
    </div>
  `;

    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden'; 

    // Move close button away on hover in horror mode
    if (isHorror) {
      closeBtn.onmouseover = () => {
        closeBtn.style.position = 'fixed';
        closeBtn.style.top = Math.random() * 80 + 10 + '%';
        closeBtn.style.right = Math.random() * 80 + 10 + '%';
      };
    } else {
      closeBtn.onmouseover = null;
      closeBtn.style.position = '';
      closeBtn.style.top = '';
      closeBtn.style.right = '';
    }
  }

  function lpTriggerEnd() {
    const noise = document.getElementById('lp-static-noise');
    noise.style.display = 'block';
    sessionStorage.setItem('lp_horror_seen', '1');
    setTimeout(() => {
      window.location.href = '/';
    }, 1200);
  }

  function lpCloseModal() {
    document.getElementById('lp2025-modal').classList.remove('is-open');
    document.body.style.overflow = '';
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Slider Logic
    const slides = document.querySelectorAll('.lp2025-slide');
    if (slides.length > 1) {
      let currentSlide = 0;

      const showSlide = (n) => {
        slides[currentSlide].classList.remove('is-active');
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('is-active');
      };

      // Auto
      let timer = setInterval(() => showSlide(currentSlide + 1), 6000);

      // Arrows
      const nextBtn = document.getElementById('lp-slider-next');
      const prevBtn = document.getElementById('lp-slider-prev');

      const resetTimer = () => {
        clearInterval(timer);
        timer = setInterval(() => showSlide(currentSlide + 1), 6000);
      };

      if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          showSlide(currentSlide + 1);
          resetTimer();
        });
      }
      if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          showSlide(currentSlide - 1);
          resetTimer();
        });
      }
    }

    // Load More Toggle
    const loadMoreBtn = document.getElementById('lp2025-load-more');
    const anchor = document.getElementById('lp2025-scroll-anchor');
    if (loadMoreBtn) {
      let isExpanded = false;
      loadMoreBtn.addEventListener('click', function () {
        const hiddenCards = Array.from(document.querySelectorAll('.lp2025-card--hidden'));
        if (!isExpanded) {
          hiddenCards.forEach((c, i) => {
            c.classList.add('lp2025-card--show');
            setTimeout(() => c.classList.add('lp2025-card--fadein'), i * 60);
          });
          loadMoreBtn.textContent = loadMoreBtn.dataset.textClose;
          loadMoreBtn.classList.add('is-expanded');
          isExpanded = true;
        } else {
          anchor.scrollIntoView({ behavior: 'smooth', block: 'center' });
          hiddenCards.forEach(c => {
            c.classList.remove('lp2025-card--fadein');
            // Check isExpanded again in case user clicks rapidly
            setTimeout(() => { if (!isExpanded) c.classList.remove('lp2025-card--show'); }, 500);
          });
          loadMoreBtn.textContent = loadMoreBtn.dataset.textOpen;
          loadMoreBtn.classList.remove('is-expanded');
          isExpanded = false;
        }
      });
    }
  });
</script>

<?php get_footer(); ?>