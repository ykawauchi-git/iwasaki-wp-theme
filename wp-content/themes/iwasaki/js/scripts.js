/* Common
============================================================================ */
let $ = jQuery.noConflict();

//Web font loader
window.WebFontConfig = {
  // 以下にフォントを指定する
  google: { families: ['Noto+Sans+JP:300,400,500,700', 'Noto+Serif+JP'] },//使用するフォントと太さだけ指定
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
$(window).on('load', function () {
  $("body").delay(500).queue(function () {
    $(this).addClass('loaded');
  })
});


//object_fit
objectFitImages('img.object_fit');

//ヘッダーメニュー
$(function () {
  let common_header = $(".common-header");
  let header_toggle = $(".common-header__toggle");
  let header_nav = $(".common-header__menu");

  function checkMediaQuery() {
    header_toggle.off(); // クリックイベントを解除
    if (window.matchMedia('(max-width: 1024px)').matches) {
      // 1024px以下のときの動作
      // header_nav.hide(); // 初期状態で非表示にする
      header_toggle.on("click", function () {
        $(this).add(common_header).toggleClass("is-open");
        if (header_nav.hasClass("is-open")) {
          header_nav.removeClass("is-open"); // メニューを非表示
        } else {
          header_nav.addClass("is-open"); // メニューを表示
        }
      });
    } else {
      // 1025px以上のときの動作
      header_nav.show().removeClass("is-open"); // メニューを表示し、状態をリセット
      common_header.removeClass("is-open");
      header_toggle.removeClass("is-open");
    }
  }

  // 初期実行
  checkMediaQuery();

  // リサイズ時に動作をチェック
  let lastInnerWidth = window.innerWidth;
  window.addEventListener("resize", function () {
    if (lastInnerWidth !== window.innerWidth) {
      lastInnerWidth = window.innerWidth;
      checkMediaQuery();
    }
  });
});

//ページトップに戻る
$(function () {
  let page_top = $(".common-footer__pageTop");
  let window_height = $(window).height();
  $(window).on("scroll", function () {
    let scroll_top = $(window).scrollTop();
    let scroll_bottom = scroll_top + $(window).height();
    let $footer = $("footer");

    if (scroll_top > window_height) {
      page_top.fadeIn();
    } else {
      page_top.fadeOut();
    }

    if ($footer.length) {
      let footer_top = $footer.offset().top;
      if (scroll_bottom >= footer_top) {
        page_top.css({
          "position": "absolute",
        }).addClass("is-stop");
      } else {
        page_top.css({
          "position": "fixed",
        }).removeClass("is-stop");
      }
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
  $(window).on("scroll", function () {
    header_height = $(".common-header").height();
  })
  $('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "body" : href);
    if (target.length) {
      var position = target.offset().top;
      $("html, body").animate({ scrollTop: position - header_height - 50 }, 700, "swing");
    }
    return false;
  });

  // パンくず追従
  if (window.location.pathname !== "/") {
    var $breadcrumbs = $('.mod-breadcrumbs');
    if ($breadcrumbs.length) {
      var headerHeight = $('.common-header').outerHeight();
      var offset = $breadcrumbs.offset().top - headerHeight;

      const updateBreadcrumbs = () => {
        if ($(window).scrollTop() > offset) {
          $breadcrumbs.addClass('fixed');
        } else {
          $breadcrumbs.removeClass('fixed');
        }
      };

      updateBreadcrumbs();
      $(window).on('scroll', updateBreadcrumbs);
      $(window).on('resize', function () {
        offset = $breadcrumbs.offset().top;
      });
    }
  }
});


// 歴史ページ
$(function () {
  $(document).ready(function () {
    $('.page-history__fv').addClass('active');
  });
  // 可視範囲で線が伸びる
  $(window).on('scroll', function () {
    $('.page-history__item').each(function () { // .js-scrollというクラスが付いている要素に対して

      var elemPosition = $(this).offset().top,
        windowHeight = $(window).height(),
        scroll = $(window).scrollTop();
      if (scroll > elemPosition - windowHeight + windowHeight / 2) {
        // if (scroll > elemPosition - windowHeight) イベント発火のタイミグはお好みで
        $(this).addClass('extend'); // ターゲットにis-showというクラスを追加
      }
    });
  });
});
// 学び
$(function () {
  $('.page-speciality__step-item').each(function () {
    specialityHeight = $(this).find('.page-speciality__step-inner').outerHeight();
    $('.page-speciality__step-bg').css('height', specialityHeight);
    $(this).find('.page-speciality__step-bg').css('height', specialityHeight);
    $('.page-speciality__step-item:nth-of-type(3)').find('.page-speciality__step-bg').css('min-height', specialityHeight);

  });
});

// 就職・資格サポート
$(function () {
  $('.page-career__achievement-question').click(function () {
    $(this).parent('.page-career__achievement-item').toggleClass('selected');
    $(this).next('.page-career__achievement-answer').slideToggle();
  });
});

// 学生支援
$(document).ready(function () {
  // サムネイル画像をクリックした際の処理
  $('.page-support__dormitoryGuideLeftSubItem').on('click', function () {
    // クラスの付け替え
    $('.page-support__dormitoryGuideLeftSubItem').removeClass('current');
    $(this).addClass('current');

    // メイン画像をフェードで切り替え
    const newSrc = $(this).find('img').attr('data-src');
    const newSrcset = $(this).find('img').attr('data-srcset');
    const $mainImage = $('.page-support__dormitoryGuideLeftMain img');

    $mainImage.fadeOut(200, function () {
      // フェードアウト完了後に画像を切り替え
      $mainImage.attr('src', newSrc);
      $mainImage.attr('srcset', newSrcset);

      // フェードイン
      $mainImage.fadeIn(300);
    });
  });
});
// 企業の皆さまへ
$(function () {
  $('.page-recruiters__post-question').click(function () {
    $(this).parent('.page-recruiters__post-item').toggleClass('selected');
    $(this).next('.page-recruiters__post-answer').slideToggle();
  });
});