/* Common
============================================================================ */
let $ = jQuery.noConflict();

//Web font loader
window.WebFontConfig = {
  // 以下にフォントを指定する
  google: { families: ['Noto+Sans+JP:300,400,500,700'] },//使用するフォントと太さだけ指定
  //custom: { families: ['futura-pt'],urls: ['https://use.typekit.net/jxv2kur.css'] },//Adobe Fonts等
  active: function () {
    sessionStorage.fonts = true;
  }
};
(function () {
  let wf = document.createElement('script');
  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  let s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

//ページ読み込み後
$(window).on('load',function(){
  $("body").delay(500).queue(function(){
    $(this).addClass('loaded');
  })
});


//object_fit
objectFitImages('img.object_fit');

//ヘッダーメニュー
$(function(){
  let common_header = $(".common-header");
  let header_toggle = $(".common-header__toggle");
  let header_nav = $(".common-header__nav.sp");
  function checkMediaQuery(){
    header_toggle.off();
    if(window.matchMedia('(max-width: 1000px)').matches){
      header_nav.hide();
      header_toggle.on("click",function(){
        $(this).add(common_header).toggleClass("is-open");
        header_nav.show().toggleClass("is-open");
      })
    }
  }
  window.onload = checkMediaQuery();
  let lastInnerWidth = window.innerWidth;
  window.addEventListener( "resize", function () {
    if ( lastInnerWidth != window.innerWidth ) {
      lastInnerWidth = window.innerWidth ;
      checkMediaQuery();
    }
  });
});

//ページトップに戻る
$(function(){
  let page_top = $(".common-footer__pageTop");
  let window_height = $(window).height();
  $(window).on("scroll",function(){
    let scroll = $(window).scrollTop() + $(window).height();
    let footer = $("footer").offset().top;
    let scroll_top = $(window).scrollTop();
    if(scroll_top > window_height){
      page_top.fadeIn();
    }else{
      page_top.fadeOut();
    }
    if (scroll >= footer) {
      page_top.css({
        "position": "absolute",
      }).addClass("is-stop");
    } else {
      page_top.css({
        "position": "fixed",
      }).removeClass("is-stop");
    }
  });
  page_top.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });
});

//スムーズスクロール
$(function () {
  let header_height = $(".common-header").height();
  $(window).on("scroll",function(){
    header_height = $(".common-header").height();
  })
  $('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "body" : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position - header_height - 50 }, 700, "swing");
    return false;
  });
});