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
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  var bannerSwiper = new Swiper('.top-kv__slider', {
    autoHeight: true,
    slidesPerView: 1,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
});