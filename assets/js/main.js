/* Sticky header */
const header = document.querySelector('header');
const logo   = document.querySelector('.logo-wrapper');

window.addEventListener('scroll', () => {
  const hide = window.scrollY > 100; // проверяем, опустились ли ниже 100px
  header.classList.toggle('hide-logo', hide);
  logo.classList.toggle('hide-logo', hide);
});

/* Menu Functions */

const hamMenu = document.querySelector('.ham-menu');
const navContainer = document.querySelector('.nav-main-container');
const overlayBackdrop  = document.querySelector('.backdrop')

hamMenu.addEventListener( 'click', () => {
hamMenu.classList.toggle('active');
navContainer.classList.toggle('active');
overlayBackdrop.classList.toggle('active');
});

// overlayBackdrop.addEventListener('click', (e) => {
//   if (!form.contains(e.target)) {
//     navContainer.classList.remove('active');
//     overlayBackdrop.classList.remove('active');
//   }
// });

/*   SEARCH BAR   */

const btnToggle = document.querySelector('.search-toggle');
const overlay   = document.getElementById('searchOverlay');
const input     = document.getElementById('overlayInput');
const btnClose  = overlay.querySelector('.search-overlay__close');
const backdrop  = overlay.querySelector('.search-overlay__backdrop');
const form      = overlay.querySelector('.search-overlay__form');

 
btnToggle.addEventListener('click', () => {
  overlay.classList.add('is-open');
  document.body.classList.add('body--no-scroll');
  setTimeout(() => input.focus(), 10);
});

btnClose.addEventListener('click', () => {
    overlay.classList.remove('is-open');
    document.body.classList.remove('body--no--scroll');
  });

 overlay.addEventListener('click', (banana) => {
  if (!form.contains(banana.target)){
  overlay.classList.remove('is-open');
  document.body.classList.remove('body--no-scroll');
 }
});

  // закрыть по Esc
window.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    overlay.classList.remove('is-open');
    document.body.classList.remove('body--no-scroll');
  }
});
 // по сабмиту можно закрыть/обрабатывать запрос
  overlay.querySelector('.search-overlay__form').addEventListener('submit', (e)=>{
    e.preventDefault();
    const q = input.value.trim();
    if(!q) return;
    // TODO: сделай переход на свою страницу поиска
    // window.location.href = '/search?q=' + encodeURIComponent(q);
    closeSearch();
  });

/*  SLIDER JS */

    const root   = document.querySelector('.cover-stars');
const track  = root.querySelector('.cover-stars__track');
const slides = Array.from(track.children);
const btnPrev = root.querySelector('[data-prev]');
const btnNext = root.querySelector('[data-next]');
const pager   = root.querySelector('[data-pager]');

let page = 0;
let pages = 1;
let perView = 1;

function getPerView(){
  if (matchMedia('(min-width:1024px)').matches) return 3;
  if (matchMedia('(min-width:640px)').matches)  return 2;
  return 1;
}

function recalc(){
  perView = getPerView();
  pages = Math.max(1, Math.ceil(slides.length / perView));
  page = Math.min(page, pages -1);
  update();
}

function update(){
  const gap = parseFloat(getComputedStyle(track).gap) || 0;
  const viewport = root.querySelector('.cover-stars__viewport');
  const viewportWidth = viewport.clientWidth;

  const shift = page * (viewportWidth / perView + gap); 
  track.style.transform = `translateX(-${shift}px)`;

  pager.textContent = `${page + 1} / ${pages}`;
  btnPrev.disabled = page === 0;
  btnNext.disabled = page >= pages - 1;
}

function toPrev(){ if (page > 0){ page--; update(); } }
function toNext(){ if (page < pages - 1){ page++; update(); } }

// события кнопок
btnPrev.addEventListener('click', toPrev);
btnNext.addEventListener('click', toNext);

// клавиатура
root.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowLeft') toPrev();
  if (e.key === 'ArrowRight') toNext();
});
root.tabIndex = 0;

// пересчёт при ресайзе
window.addEventListener('resize', recalc);

// свайп на мобильных
let startX = 0;
let endX = 0;
const threshold = 50;

track.addEventListener('touchstart', (e) => startX = e.touches[0].clientX);
track.addEventListener('touchmove', (e) => endX = e.touches[0].clientX);
track.addEventListener('touchend', () => {
  const diff = endX - startX;
  if (Math.abs(diff) > threshold) {
    if (diff > 0) toPrev();
    else toNext();
  }
  startX = 0;
  endX = 0;
});

// первый запуск
recalc();


  


