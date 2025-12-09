/* Top
============================================================================ */

$(function(){
  let pages_heading = $(".top-pages__heading");
  ScrollTrigger.create({
    trigger: pages_heading,
    start: "top 70%",
    onEnter: function(){pages_heading.removeClass('is-default');},
  });
})

$(document).ready(function() {

  var bannerSwiper = new Swiper('.top-banner__slider', {
    slidesPerView: "auto", //variablewidthにするため､autoを指定
    centeredSlides: true, //スライドを中央に寄せる
    loop: true,
    speed: 500,
    autoplay: { // 自動再生
      delay: 2000, // 1.5秒後に次のスライド
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  // スライダーの初期化前にスライドの数をチェック
  const slides = document.querySelectorAll('.top-kv__slider .swiper-slide');
  if (slides.length <= 1) {
    // スライドが1枚以下の場合はスライダー機能をオフにする
    new Swiper('.top-kv__slider', {
      autoHeight: true,
      slidesPerView: 1,
      effect: 'fade',
      speed: 1000,
      fadeEffect: { crossFade: true },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  } else {
    // スライドが複数枚ある場合は通常のスライダー機能を有効化
    new Swiper('.top-kv__slider', {
      autoHeight: true,
      slidesPerView: 1,
      effect: 'fade',
      loop: true,
      speed: 1000,
      fadeEffect: { crossFade: true },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        waitForTransition: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  }
});