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

    (() => {
    const imgs = document.querySelectorAll('.single-career__editor .wp-block-image img, .editor-content .wp-block-image img');
    const mark = (img) => {
        const fig = img.closest('.wp-block-image');
        if (!fig) return;
        const w = img.naturalWidth, h = img.naturalHeight;
        if (!w || !h) return;                  // まだ寸法が出ないならスキップ
        fig.classList.toggle('is-vertical', h > w);
    };
    imgs.forEach(img => {
        if (img.complete) mark(img);           // もう読めてるなら即判定
        img.addEventListener('load', () => mark(img), { once: true }); // 遅延読込対応
    });
    })();
});