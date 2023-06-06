/* POST
============================================================================ */

//無限スクロール
var infScroll = new InfiniteScroll('.common-archive__inner', {
  append: '.mod-post',
  path: '.nextpostslink',
  hideNav: '.wp-pagenavi',
  button: '.btn__more',
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