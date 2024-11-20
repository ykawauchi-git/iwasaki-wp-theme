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