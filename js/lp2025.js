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
  const modal = document.getElementById('lp2025-modal');
  const modalImg = document.getElementById('lp2025-modal-img');
  const modalTitle = document.getElementById('lp2025-modal-title');
  const modalDesc = document.getElementById('lp2025-modal-desc');
  const modalDetail = document.getElementById('lp2025-modal-detail');
  const modalLink = document.getElementById('lp2025-modal-link');
  const DEFAULT_LINK = 'https://www.iwasaki.ac.jp/';

  if (modal) {
    const modalClose = modal.querySelector('.lp2025-modal-close');

    // クリック対象は「都度」取り直す（絞り込み後も安全）
    document.addEventListener('click', function (e) {
      const card = e.target.closest('.lp2025-card-grid .lp2025-card');
      if (!card) return;

      if (modalImg) modalImg.src = card.dataset.modalImg || '';
      if (modalTitle) modalTitle.textContent = card.dataset.modalTitle || '';
      if (modalDesc) modalDesc.textContent = card.dataset.modalDesc || '';
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

  // ==========================
  // カレンダー
  // ==========================
  const calPrevBtn = document.getElementById('lp2025-cal-prev');
  const calNextBtn = document.getElementById('lp2025-cal-next');
  const calTitle = document.getElementById('lp2025-cal-title');
  const calBody = document.getElementById('lp2025-calendar');

  if (calBody && calTitle) {
    let currentY = new Date().getFullYear();
    let currentM = new Date().getMonth(); // 0-indexed

    // イベントがある日付を取得
    function getEventDates() {
      const cards = getCards();
      return cards.map(c => c.dataset.date).filter(Boolean);
    }

    const allEventDates = getEventDates().sort();
    if (allEventDates.length > 0) {
      const firstEventDate = new Date(allEventDates[0]);
      currentY = firstEventDate.getFullYear();
      currentM = firstEventDate.getMonth();
    }

    function renderCalendar(year, month) {
      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);

      const startDayOfWeek = firstDay.getDay(); // 0 (Sun) to 6 (Sat)
      const daysInMonth = lastDay.getDate();

      calTitle.textContent = `${year}年${month + 1}月`;

      let html = '<table class="lp2025-calendar-table">';
      html += '<thead><tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr></thead>';
      html += '<tbody><tr>';

      // 埋める
      let dayCount = 1;
      const eventDates = getEventDates();

      // 空白（先月分）
      for (let i = 0; i < startDayOfWeek; i++) {
        html += '<td class="is-empty"></td>';
      }

      for (let i = startDayOfWeek; i < 42; i++) {
        if (dayCount > daysInMonth) {
          if (i % 7 === 0) break;
          html += '<td class="is-empty"></td>';
        } else {
          const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(dayCount).padStart(2, '0')}`;
          const hasEvent = eventDates.includes(dateStr);
          const isToday = new Date().toDateString() === new Date(year, month, dayCount).toDateString();

          let cls = 'lp2025-calendar-day';
          if (hasEvent) cls += ' has-event';
          if (isToday) cls += ' is-today';

          html += `<td class="${cls}" data-date="${dateStr}"><span>${dayCount}</span></td>`;
          dayCount++;
        }

        if (i % 7 === 6 && dayCount <= daysInMonth) {
          html += '</tr><tr>';
        }
      }

      html += '</tr></tbody></table>';
      calBody.innerHTML = html;
    }

    calBody.addEventListener('click', (e) => {
      const td = e.target.closest('.has-event');
      if (!td) return;
      const date = td.dataset.date;
      const targetCard = document.querySelector(`.lp2025-card[data-date="${date}"]`);
      if (targetCard) {
        targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // 視覚的な強調（ふよん、とする拡大と影）
        targetCard.style.transition = 'transform 0.3s, box-shadow 0.3s';
        targetCard.style.transform = 'scale(1.05)';
        targetCard.style.boxShadow = '0 0 30px rgba(230, 81, 0, 0.4)';
        targetCard.style.zIndex = '10';

        setTimeout(() => {
          targetCard.style.transform = 'scale(1)';
          targetCard.style.boxShadow = '';
          targetCard.style.zIndex = '';
        }, 1500);
      }
    });

    calPrevBtn?.addEventListener('click', () => {
      currentM--;
      if (currentM < 0) {
        currentM = 11;
        currentY--;
      }
      renderCalendar(currentY, currentM);
    });

    calNextBtn?.addEventListener('click', () => {
      currentM++;
      if (currentM > 11) {
        currentM = 0;
        currentY++;
      }
      renderCalendar(currentY, currentM);
    });

    renderCalendar(currentY, currentM);
  }

  // ==========================
  // おすすめイベントスライダー
  // ==========================
  const featureSwiper = document.querySelector('.lp2025-feature-swiper');
  if (featureSwiper) {
    const swiper = new Swiper('.lp2025-feature-swiper', {
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      speed: 1000,
      pagination: {
        el: '.lp2025-feature-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.lp2025-feature-next',
        prevEl: '.lp2025-feature-prev',
      },
      slidesPerView: 'auto',
      centeredSlides: true,
      spaceBetween: 40,
      breakpoints: {
        // スマホ
        320: {
          spaceBetween: 16,
        },
        // PC
        768: {
          spaceBetween: 40,
        },
      },
    });
  }

  // 資料請求スムーズスクロール
  const fixedReqBtn = document.querySelector('.lp2025-fixed-request');
  if (fixedReqBtn) {
    fixedReqBtn.addEventListener('click', (e) => {
      const href = fixedReqBtn.getAttribute('href');
      if (href.startsWith('#')) {
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
          const headerHeight = document.querySelectorAll('header')[0]?.offsetHeight || 0;
          const targetPos = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
          window.scrollTo({
            top: targetPos,
            behavior: 'smooth'
          });
        }
      }
    });
  }
});
