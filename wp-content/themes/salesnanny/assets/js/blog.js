/*!
 * /blog page: topic filter, search, "load more" and the newsletter form (see pages/blog.php, inc/blog.php).
 * With no filter or search the page shows the featured row + latest grid; otherwise a single results grid.
 */
(function () {
  'use strict';

  var root = document.querySelector('app-blog');
  if (!root) return;
  var $ = function (s, r) { return (r || root).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || root).querySelectorAll(s)); };

  var def = $('[data-blog-default]'), res = $('[data-blog-results]');
  var search = $('#blogSearch'), chips = $$('.blog-chip');
  var state = { topic: 'all', q: '' };

  /* ---------- filter + search ---------- */
  function apply() {
    if (!def || !res) return;
    var active = state.topic !== 'all' || state.q !== '';
    def.hidden = active;
    res.hidden = !active;
    if (!active) return;

    var shown = 0;
    $$('#blogResultsGrid .blog-card').forEach(function (card) {
      var cats = (card.getAttribute('data-cats') || '').split(',');
      var okTopic = state.topic === 'all' || cats.indexOf(state.topic) > -1;
      var okText = !state.q || (card.getAttribute('data-search') || '').indexOf(state.q) > -1;
      card.hidden = !(okTopic && okText);
      if (!card.hidden) shown++;
    });
    var chip = chips.filter(function (c) { return c.getAttribute('data-topic') === state.topic; })[0];
    $('[data-blog-results-title]').textContent = state.q && state.topic === 'all' ? 'Search results' : (state.topic !== 'all' && chip ? chip.firstChild.textContent.trim() : 'Results');
    $('[data-blog-results-count]').textContent = shown + (shown === 1 ? ' article' : ' articles');
    $('#blogResultsGrid').hidden = shown === 0;
    $('[data-blog-none]').hidden = shown !== 0;
    if (shown === 0) {
      var topicOnly = state.topic !== 'all' && !state.q && chip;
      $('[data-blog-none-title]').textContent = topicOnly ? 'New insights on ' + chip.getAttribute('data-topic-name') + ' are on the way' : 'No articles found';
      $('[data-blog-none-text]').textContent = topicOnly ? 'In the meantime, browse everything we have published.' : 'Try a different search or topic. In the meantime, browse everything we have published.';
    }
  }
  function setTopic(t) {
    state.topic = t;
    chips.forEach(function (c) {
      var on = c.getAttribute('data-topic') === t;
      c.classList.toggle('is-active', on);
      c.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
    apply();
  }
  function clearAll() { state.q = ''; if (search) search.value = ''; setTopic('all'); }

  chips.forEach(function (c) { c.addEventListener('click', function () { setTopic(c.getAttribute('data-topic')); }); });
  if (search) {
    var timer;
    search.addEventListener('input', function () {
      clearTimeout(timer);
      timer = setTimeout(function () { state.q = search.value.trim().toLowerCase(); apply(); }, 150);
    });
    search.addEventListener('keydown', function (e) { if (e.key === 'Escape' && search.value) { search.value = ''; state.q = ''; apply(); } });
  }
  var clear = $('#blogClear'); if (clear) clear.addEventListener('click', clearAll);
  var clearBtn = $('[data-blog-clear-all]'); if (clearBtn) clearBtn.addEventListener('click', clearAll);

  /* ---------- load more (latest grid) ---------- */
  var grid = $('#blogLatest'), more = $('#blogMore');
  if (grid && more) {
    var per = parseInt(grid.getAttribute('data-per-page'), 10) || 9;
    var cards = $$('.blog-card', grid), visible = per;
    var paint = function () {
      cards.forEach(function (c, i) { c.hidden = i >= visible; });
      more.parentNode.hidden = visible >= cards.length;
    };
    more.addEventListener('click', function () {
      var first = visible;
      visible += per;
      paint();
      var next = cards[first]; if (next) { var a = $('a', next); if (a) a.focus({ preventScroll: true }); }
    });
    paint();
  }

  /* ---------- newsletter ---------- */
  var form = $('#blogNlForm');
  if (form) {
    var msg = $('.blog-nl__msg', form), btn = $('button[type="submit"]', form), input = $('input[type="email"]', form);
    var say = function (text, bad) { msg.textContent = text; msg.classList.toggle('is-error', !!bad); msg.hidden = !text; };
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var email = input.value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email)) { say('Enter a valid email address.', true); input.focus(); return; }
      btn.disabled = true; say('');
      var fd = new FormData(form);
      fd.append('action', 'mh_blog_subscribe');
      fd.append('nonce', form.getAttribute('data-nonce'));
      fd.append('page_url', location.href);
      fetch(form.getAttribute('data-ajax'), { method: 'POST', body: fd, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function (j) {
          if (j && j.success) { say('Thank you! You’re subscribed.'); input.value = ''; }
          else say((j && j.data && j.data.message) || 'Something went wrong. Please try again.', true);
        })
        .catch(function () { say('Network error. Please try again.', true); })
        .then(function () { btn.disabled = false; });
    });
  }
})();
