<?php

function hide_cat_ranking_field($field) {
  // 現在の画面がカテゴリ編集画面かどうかを確認
  if (isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'category') {
      // 編集対象のカテゴリIDを取得
      $term_id = isset($_GET['tag_ID']) ? intval($_GET['tag_ID']) : 0;

      if ($term_id) {
          // 現在のカテゴリ情報を取得
          $term = get_term($term_id, 'category');

          // 親スラッグを含めたスラッグをチェック
          if ($term->slug === 'feature' || term_is_child_of($term, 'feature')) {
              // フィールドを非表示にする
              return false;
          }
      }
  }

  // デフォルトのフィールドをそのまま返す
  return $field;
}
add_filter('acf/load_field/name=cat_ranking', 'hide_cat_ranking_field');

// 子カテゴリかどうかを判定するヘルパー関数
function term_is_child_of($term, $parent_slug) {
  while ($term->parent) {
      $term = get_term($term->parent, 'category');
      if ($term->slug === $parent_slug) {
          return true;
      }
  }
  return false;
}