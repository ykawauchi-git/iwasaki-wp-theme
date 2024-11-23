/* SINGLE
============================================================================ */

// document.addEventListener('DOMContentLoaded', function () {
//   const copyButton = document.getElementById('copy-link-btn');
//   const pageUrl = window.location.href;

//   copyButton.addEventListener('click', function () {
//       navigator.clipboard.writeText(pageUrl).then(function () {
//           alert('リンクをコピーしました！');
//       }).catch(function (err) {
//           alert('リンクのコピーに失敗しました');
//           console.error(err);
//       });
//   });
// });

$(function () {
    $('#copy').click(function () {
        // data-urlの値を取得
        const url = window.location.href;

        // クリップボードにコピー
        navigator.clipboard.writeText(url);

        // フラッシュメッセージ表示
        $('.success-msg').fadeIn("slow", function () {
            $(this).delay(2000).fadeOut("slow");
        });
    });
});