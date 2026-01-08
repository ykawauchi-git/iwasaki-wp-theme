/* js > android-class
============================================================================ */

//android端末で表示した時にAndroidというクラスをつける
$(function() {
if ( navigator.userAgent.indexOf('Android') > 0 ) {
    $("body").addClass("Android");
}
});