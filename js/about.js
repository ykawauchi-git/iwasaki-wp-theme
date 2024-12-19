/* about
============================================================================ */

const mySwiper = new Swiper('.page-about__messageSlider', {
  loop: true,
  spaceBetween: 9,
  speed: 8000,
  slidesPerView: 'auto',
  //loopAdditionalSlides: 1,
  allowTouchMove: false, // スワイプ無効
  autoplay: {
    delay: 0, // 途切れなくループ
    disableOnInteraction: false,
  },
});