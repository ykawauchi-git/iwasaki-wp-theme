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