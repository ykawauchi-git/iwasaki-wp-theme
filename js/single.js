/* SINGLE
============================================================================ */

document.addEventListener('DOMContentLoaded', function () {
  const copyButton = document.getElementById('copy-link-btn');
  const pageUrl = window.location.href;

  copyButton.addEventListener('click', function () {
      navigator.clipboard.writeText(pageUrl).then(function () {
          alert('リンクをコピーしました！');
      }).catch(function (err) {
          alert('リンクのコピーに失敗しました');
          console.error(err);
      });
  });
});