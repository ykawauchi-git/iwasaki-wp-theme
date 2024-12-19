/* facilities
============================================================================ */

$(function(){
  let groupSec_ttl = $(".page-facilities__groupSec-ttl");
  groupSec_ttl.on("click",function(){
    let groupSec_accordion = $(this).next();
    $(this).toggleClass("is-active");
    groupSec_accordion.slideToggle();
  })
})

const swiperSlides = document.getElementsByClassName("swiper-slide");
const breakPoint = 767; // ブレークポイントを設定
let swiper;
let swiperBool;

window.addEventListener(
  "load",
  () => {
    if (breakPoint < window.innerWidth) {
      swiperBool = false;
    } else {
      createSwiper();
      swiperBool = true;
    }
  },
  false
);

window.addEventListener(
  "resize",
  () => {
    if (breakPoint < window.innerWidth && swiperBool) {
      swiper.destroy(false, true);
      swiperBool = false;
    } else if (breakPoint >= window.innerWidth && !swiperBool) {
      createSwiper();
      swiperBool = true;
    }
  },
  false
);

const createSwiper = () => {
  swiper = new Swiper('.page-facilities__facilitySlider', {
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
};