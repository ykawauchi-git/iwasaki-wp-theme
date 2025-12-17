document.addEventListener('DOMContentLoaded', function () {
  // ==========================
  // タブ絞り込み
  // ==========================
  const buttons = Array.from(document.querySelectorAll('.lp2025-filter-buttons button'));

  function setActive(btn) {
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
  }

  function getCards() {
    return Array.from(document.querySelectorAll('.lp2025-card-grid .lp2025-card'));
  }

  // ==========================
  // 「開催間近」= 直近3件に付与
  // - data-date (YYYY-MM-DD) の昇順で3件
  // - 既存の soon は一旦消して付け直す
  // ==========================
  function markSoonTop3() {
    const cards = getCards();
    if (!cards.length) return;

    // いったん soon を除去（仕様変更しやすいように）
    cards.forEach(c => {
      if (c.dataset.tag === 'soon') delete c.dataset.tag;
      c.classList.remove('is-soon');
    });

    // data-date があるカードを日付順に並べる
    const dated = cards
      .filter(c => c.dataset.date)
      .slice()
      .sort((a, b) => new Date(a.dataset.date) - new Date(b.dataset.date));

    // 直近3件だけ soon にする
    dated.slice(0, 3).forEach(c => {
      c.dataset.tag = 'soon';
      c.classList.add('is-soon');
    });
  }

  function filterCardsByTag(tag) {
    const cards = getCards();

    // カード0件でも「active切替」だけは動かす
    if (!cards.length) return;

    cards.forEach(card => {
      const type = card.dataset.tag || '';
      if (tag === 'all') {
        card.style.display = 'block';
      } else {
        card.style.display = (type === tag) ? 'block' : 'none';
      }
    });
  }

  // ボタンのイベントは cards の有無に関係なく必ず登録
  buttons.forEach(btn => {
    btn.addEventListener('click', function () {
      setActive(this);
      const tag = this.dataset.tag || 'all';
      filterCardsByTag(tag);
    });
  });

  // 初期化：直近3件に soon を付与 → 初期表示（all）
  markSoonTop3();

  const allBtn = document.querySelector('.lp2025-filter-buttons button[data-tag="all"]');
  if (allBtn) {
    setActive(allBtn);
    filterCardsByTag('all');
  }

  // ==========================
  // モーダル
  // ==========================
  const modal        = document.getElementById('lp2025-modal');
  const modalImg     = document.getElementById('lp2025-modal-img');
  const modalTitle   = document.getElementById('lp2025-modal-title');
  const modalDesc    = document.getElementById('lp2025-modal-desc');
  const modalDetail  = document.getElementById('lp2025-modal-detail');
  const modalLink    = document.getElementById('lp2025-modal-link');
  const DEFAULT_LINK = 'https://www.iwasaki.ac.jp/';

  if (modal) {
    const modalClose = modal.querySelector('.lp2025-modal-close');

    // クリック対象は「都度」取り直す（絞り込み後も安全）
    document.addEventListener('click', function (e) {
      const card = e.target.closest('.lp2025-card-grid .lp2025-card');
      if (!card) return;

      if (modalImg)    modalImg.src = card.dataset.modalImg || '';
      if (modalTitle)  modalTitle.textContent  = card.dataset.modalTitle  || '';
      if (modalDesc)   modalDesc.textContent   = card.dataset.modalDesc   || '';
      if (modalDetail) modalDetail.textContent = card.dataset.modalDetail || '';

      const link = card.dataset.modalLink || DEFAULT_LINK;
      if (modalLink) {
        modalLink.href = link;
        modalLink.style.display = link ? 'inline-block' : 'none';
      }

      modal.style.display = 'flex';
    });

    if (modalClose) {
      modalClose.addEventListener('click', function () {
        modal.style.display = 'none';
      });
    }

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.style.display = 'none';
    });
  }
});
