/* Sticky header */
const header = document.querySelector('header');
const logo   = document.querySelector('.logo-wrapper');

if (header && logo) {
  window.addEventListener('scroll', () => {
    const hide = window.scrollY > 100;
    header.classList.toggle('hide-logo', hide);
    logo.classList.toggle('hide-logo', hide);
  });
}

/* Mobile Menu */
const hamMenu      = document.querySelector('.ham-menu');
const navContainer = document.querySelector('.nav-main-container');
const menuBackdrop = document.querySelector('.backdrop');

if (hamMenu && navContainer && menuBackdrop) {
  hamMenu.addEventListener('click', () => {
    hamMenu.classList.toggle('active');
    navContainer.classList.toggle('active');
    menuBackdrop.classList.toggle('active');
    document.body.classList.toggle('no-scroll');
  });

  menuBackdrop.addEventListener('click', () => {
    hamMenu.classList.remove('active');
    navContainer.classList.remove('active');
    menuBackdrop.classList.remove('active');
    document.body.classList.remove('no-scroll');
  });

  document.querySelectorAll('.nav_list a').forEach(link => {
    link.addEventListener('click', () => {
      hamMenu.classList.remove('active');
      navContainer.classList.remove('active');
      menuBackdrop.classList.remove('active');
      document.body.classList.remove('no-scroll');
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navContainer.classList.contains('active')) {
      hamMenu.classList.remove('active');
      navContainer.classList.remove('active');
      menuBackdrop.classList.remove('active');
      document.body.classList.remove('no-scroll');
    }
  });
}

/* Search Overlay */
const btnToggle = document.querySelector('.search-toggle');
const overlay   = document.getElementById('searchOverlay');

if (btnToggle && overlay) {
  const input          = document.getElementById('overlayInput');
  const btnClose       = overlay.querySelector('.search-overlay__close');
  const searchBackdrop = overlay.querySelector('.search-overlay__backdrop');
  const form           = overlay.querySelector('.search-overlay__form');

  function closeSearch() {
    overlay.classList.remove('is-open');
    document.body.classList.remove('body--no-scroll');
  }

  btnToggle.addEventListener('click', () => {
    overlay.classList.add('is-open');
    document.body.classList.add('body--no-scroll');
    setTimeout(() => input.focus(), 10);
  });

  btnClose.addEventListener('click', closeSearch);

  overlay.addEventListener('click', (e) => {
    if (!form.contains(e.target)) closeSearch();
  });

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSearch();
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const q = input.value.trim();
    if (!q) return;
    window.location.href = '/?s=' + encodeURIComponent(q);
  });
}

/* Slider (front page only) */
const sliderRoot = document.querySelector('.cover-stars');

if (sliderRoot) {
  const track   = sliderRoot.querySelector('.cover-stars__track');
  const slides  = Array.from(track.children);
  const btnPrev = sliderRoot.querySelector('[data-prev]');
  const btnNext = sliderRoot.querySelector('[data-next]');
  const pager   = sliderRoot.querySelector('[data-pager]');

  let page = 0, pages = 1, perView = 1;

  function getPerView() {
    if (matchMedia('(min-width:1024px)').matches) return 3;
    if (matchMedia('(min-width:640px)').matches)  return 2;
    return 1;
  }

  function update() {
    const gap = parseFloat(getComputedStyle(track).gap) || 0;
    const viewport = sliderRoot.querySelector('.cover-stars__viewport');
    const viewportWidth = viewport.clientWidth;
    const shift = page * (viewportWidth / perView + gap);
    track.style.transform = `translateX(-${shift}px)`;
    pager.textContent = `${page + 1} / ${pages}`;
    btnPrev.disabled = page === 0;
    btnNext.disabled = page >= pages - 1;
  }

  function recalc() {
    perView = getPerView();
    pages = Math.max(1, Math.ceil(slides.length / perView));
    page = Math.min(page, pages - 1);
    update();
  }

  function toPrev() { if (page > 0) { page--; update(); } }
  function toNext() { if (page < pages - 1) { page++; update(); } }

  btnPrev.addEventListener('click', toPrev);
  btnNext.addEventListener('click', toNext);

  sliderRoot.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') toPrev();
    if (e.key === 'ArrowRight') toNext();
  });
  sliderRoot.tabIndex = 0;

  window.addEventListener('resize', recalc);

  // Touch swipe
  let startX = 0, endX = 0;
  const threshold = 50;

  track.addEventListener('touchstart', (e) => startX = e.touches[0].clientX);
  track.addEventListener('touchmove', (e) => endX = e.touches[0].clientX);
  track.addEventListener('touchend', () => {
    const diff = endX - startX;
    if (Math.abs(diff) > threshold) {
      if (diff > 0) toPrev(); else toNext();
    }
    startX = 0;
    endX = 0;
  });

  recalc();
}
