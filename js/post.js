/* POST
============================================================================ */

// 現在カテゴリ時にクラス名つける
$(document).ready(function() {
  // 現在のURLを取得
  const currentUrl = window.location.href;

  // 各リンクをチェックして一致するものにクラスを追加
  $('.archive-post__cat li a').each(function() {
    const linkUrl = $(this).attr('href');

    // 現在のURLがリンクURLと一致する場合、親の<li>にクラス"active"を追加
    if (currentUrl.includes(linkUrl)) {
      $(this).parent('li').addClass('now');
    }
  });
});

//無限スクロール
var infScroll = new InfiniteScroll('.archive-post__inner', {
  append: '.mod-post',
  path: '.nextpostslink',
  hideNav: '.wp-pagenavi',
  button: '.infiniteBtn',
  scrollThreshold: false,
  status: '.scroller-status',
  history: 'false',
});

jQuery(function($) {
$('.common-archive__inner').on('append.infiniteScroll', function(event, response, path, items) {
  $(items).find('img[srcset]').each(function(i, img) {
    img.outerHTML = img.outerHTML;
  });
});
});


document.querySelectorAll('.archive-post__cat button').forEach(function(button) {
    button.addEventListener('click', function() {
        document.querySelector('.archive-post__cat .active').classList.remove('active');
        this.classList.add('active');
        document.querySelector('input[name="cat"]').value = this.getAttribute('data-category');
    });
});