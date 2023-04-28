/* group
============================================================================ */

$(function(){
  let group_slider = $(".page-group__contInner");
  let toggle_list = $(".page-group__contToggle");
  group_slider.slick({
    fade: true,
    arrows: false,
    dots: false,
    //variableWidth: true,
  });
  group_slider.each(function(){
    let group_slider = $(this);
    let toggle_item = $(this).find(toggle_list).find("li");
    let toggle_item_index = toggle_item.index();
    toggle_item.eq(toggle_item_index).addClass("is-active");
    $(this).on("click",function(){
      $(this).find(toggle_item).index();
    })
    toggle_item.on('click', function() {
      let toggle_item_index = $(this).index();
      group_slider.slick('slickGoTo', toggle_item_index, false);
    });
    group_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      toggle_item.removeClass("is-active");
      $(this).find(toggle_list).each(function(){
        let toggle_item = $(this).find("li");
        toggle_item.eq(nextSlide).addClass("is-active");
      })
    });
  });
})