/*!
 * Mahathi theme script.
 *
 * Behaviour for the server-rendered pages (the markup carries data attributes;
 * this file wires them up):
 *   [data-href]        click navigates (router-link style) — data-target="_blank" opens a new tab
 *   [data-mh-action]   click runs MH.actions[name](element, args, event)
 *   header / search    mega menu helpers, mobile menu, on-page search
 *   contact popup      "Get in Touch" modal + admin-ajax submission
 *   page modules       one init function per interactive page section (see MH.modules)
 */
(function (window, document) {
  'use strict';

  var cfg = window.MahathiConfig || {};
  var $ = window.jQuery;

  var MH = (window.MH = {
    actions: {},
    modules: [],
    q: function (sel, root) { return (root || document).querySelector(sel); },
    qa: function (sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); },
    on: function (el, ev, fn, opts) { if (el) el.addEventListener(ev, fn, opts); }
  });

  /* ----------------------------------------------------------------------
   * Navigation helpers
   * ------------------------------------------------------------------- */

  /** Scroll to an element id, leaving room for the sticky header (same as the original). */
  MH.scrollToId = function (id, attempts) {
    attempts = attempts || 0;
    var el = document.getElementById(id);
    if (el) {
      el.style.scrollMarginTop = '110px';
      requestAnimationFrame(function () {
        requestAnimationFrame(function () { el.scrollIntoView({ behavior: 'smooth', block: 'start' }); });
      });
      return true;
    }
    if (attempts < 20) setTimeout(function () { MH.scrollToId(id, attempts + 1); }, 100);
    return false;
  };

  /** Smooth scroll to an element, header offset 90px, with a short highlight. */
  MH.scrollToElement = function (el, offset) {
    if (!el) return;
    var top = el.getBoundingClientRect().top + window.pageYOffset - (offset == null ? 90 : offset);
    window.scrollTo({ top: top, behavior: 'smooth' });
    el.classList.add('search-highlight');
    setTimeout(function () { el.classList.remove('search-highlight'); }, 1500);
  };

  document.addEventListener('click', function (e) {
    var t = e.target;
    if (!t || !t.closest) return;

    // 1. generic actions
    var act = t.closest('[data-mh-action]');
    if (act) {
      var name = act.getAttribute('data-mh-action');
      var fn = MH.actions[name];
      if (fn) {
        var args = [];
        try { args = JSON.parse(act.getAttribute('data-mh-args') || '[]'); } catch (err) { /* ignore */ }
        if (act.hasAttribute('data-mh-stop')) e.stopPropagation();
        if (fn(act, args, e) === false) return;
      }
    }

    // 2. router-link style navigation on non-anchor elements
    var link = t.closest('[data-href]');
    if (link && !(t.closest('a[href]') && link.contains(t.closest('a[href]')))) {
      var href = link.getAttribute('data-href');
      if (!href) return;
      if (link.getAttribute('data-target') === '_blank' || e.ctrlKey || e.metaKey) {
        window.open(href, '_blank', 'noopener');
      } else {
        window.location.href = href;
      }
    }
  });

  /* ----------------------------------------------------------------------
   * Scroll effects: --scroll-ease drives the green glow layer
   * ------------------------------------------------------------------- */
  (function () {
    var last = window.scrollY, ease = 0, raf = 0;
    function frame() {
      document.documentElement.style.setProperty('--scroll-ease', String(ease));
      ease *= 0.88;
      if (ease < 0.01) {
        document.documentElement.style.setProperty('--scroll-ease', '0');
        raf = 0;
        return;
      }
      raf = requestAnimationFrame(frame);
    }
    window.addEventListener('scroll', function () {
      var y = window.scrollY;
      ease = Math.min(Math.abs(y - last) / 80, 1);
      last = y;
      if (!raf) raf = requestAnimationFrame(frame);
    }, { passive: true });
  })();

  /* ----------------------------------------------------------------------
   * Header
   * ------------------------------------------------------------------- */
  var header = {
    closeMenu: function () {
      var menu = document.getElementById('navbarNavDropdown');
      if (menu) menu.classList.remove('show');
      var burger = document.getElementById('headerToggler');
      if (burger) burger.classList.remove('active');
      MH.qa('[data-mh-submenu]').forEach(function (s) { s.hidden = true; });
      MH.qa('.mobile-main .fas').forEach(function (i) { i.classList.remove('fa-chevron-up'); i.classList.add('fa-chevron-down'); });
    },
    closeMegaMenus: function () {
      MH.qa('.ct-mega-menu.show').forEach(function (m) { m.classList.remove('show'); });
      MH.qa('.ct-mega-dropdown.show').forEach(function (m) { m.classList.remove('show'); });
    },
    closeSearch: function () {
      var panel = document.getElementById('page-header-search');
      if (!panel) return;
      panel.classList.remove('show');
      var input = panel.querySelector('input');
      if (input) input.value = '';
      header.renderResults([]);
    },
    renderResults: function (items) {
      var list = MH.q('#page-header-search .search-results');
      if (!list) return;
      list.innerHTML = '';
      items.forEach(function (item) {
        var li = document.createElement('li');
        li.appendChild(document.createTextNode(item.text + ' '));
        var small = document.createElement('small');
        small.className = 'text-muted';
        small.textContent = '— ' + item.route;
        li.appendChild(small);
        li.addEventListener('click', function () { header.closeSearch(); MH.scrollToElement(item.el, 90); });
        list.appendChild(li);
      });
      list.hidden = !items.length;
    },
    /** Elements of the current page whose text matches (h1, h2, h3, p, li). */
    findContent: function (value) {
      value = value.toLowerCase();
      var seen = {}, out = [];
      MH.qa('h1, h2, h3, p, li').forEach(function (el) {
        if (el.closest('#page-header-search')) return;
        var text = (el.textContent || '').replace(/\s+/g, ' ').trim();
        if (!text || text.toLowerCase().indexOf(value) === -1 || seen[text]) return;
        seen[text] = true;
        out.push({ text: text.length > 140 ? text.slice(0, 140) + '…' : text, route: window.location.pathname.replace(/\/$/, '') || '/', el: el });
      });
      return out;
    },
    /** First leaf element containing the text; scroll to it and highlight. */
    findLeaf: function (value) {
      value = value.toLowerCase();
      var all = document.body.getElementsByTagName('*');
      for (var i = 0; i < all.length; i++) {
        var el = all[i];
        if (el.children.length === 0 && !el.closest('#page-header-search') && el.tagName !== 'SCRIPT' && el.tagName !== 'STYLE' &&
            (el.textContent || '').toLowerCase().indexOf(value) !== -1 && el.offsetParent !== null) {
          MH.scrollToElement(el, 80);
          return true;
        }
      }
      return false;
    }
  };
  MH.header = header;

  MH.actions['toggleMobileMenu'] = function (el) {
    var menu = document.getElementById('navbarNavDropdown');
    if (!menu) return;
    var open = !menu.classList.contains('show');
    menu.classList.toggle('show', open);
    el.classList.toggle('active', open);
  };

  MH.actions['toggleMobileSub'] = function (el, args) {
    var key = args[0];
    var panel = MH.q('[data-mh-submenu="' + key + '"]');
    if (!panel) return;
    var willOpen = panel.hidden;
    MH.qa('[data-mh-submenu]').forEach(function (s) { s.hidden = true; });
    MH.qa('.mobile-main .fas').forEach(function (i) { i.classList.remove('fa-chevron-up'); i.classList.add('fa-chevron-down'); });
    if (willOpen) {
      panel.hidden = false;
      var icon = el.querySelector('.fas');
      if (icon) { icon.classList.remove('fa-chevron-down'); icon.classList.add('fa-chevron-up'); }
    }
  };

  MH.actions['toggleLocationsMenu'] = function (el, args, e) {
    e.preventDefault();
    e.stopPropagation();
    var li = el.closest('li');
    var dropdown = li && li.querySelector('.dropdown-menu');
    if (!dropdown) return;
    MH.qa('.ct-mega-menu.show').forEach(function (m) { if (m !== dropdown) m.classList.remove('show'); });
    dropdown.classList.toggle('show');
  };

  window.addEventListener('scroll', function () { header.closeMegaMenus(); header.closeSearch(); }, { passive: true });
  window.addEventListener('resize', function () { header.closeMenu(); });
  document.addEventListener('click', function (e) {
    var h = MH.q('app-header');
    if (h && !h.contains(e.target)) { header.closeMenu(); header.closeSearch(); }
  });

  document.addEventListener('DOMContentLoaded', function () {
    var form = MH.q('#page-header-search form');
    if (form) {
      var input = form.querySelector('input');
      var timer;
      MH.on(input, 'input', function () {
        clearTimeout(timer);
        var v = input.value.trim();
        if (!v) { header.renderResults([]); return; }
        timer = setTimeout(function () { header.renderResults(header.findContent(v).slice(0, 8)); }, 200);
      });
      MH.on(form, 'submit', function (e) {
        e.preventDefault();
        var v = (input.value || '').trim().toLowerCase();
        if (!v) return;
        var found = header.findLeaf(v);
        if (!found && (cfg.route || '/') !== '/') {
          window.location.href = (cfg.homeUrl || '/') + '?mh_search=' + encodeURIComponent(v);
          return;
        }
        if ($ && $.fn && $.fn.collapse) $('#page-header-search').collapse('hide');
        document.getElementById('page-header-search').classList.remove('show');
        header.closeSearch();
      });
    }

    // search carried over from another page
    var m = window.location.search.match(/[?&]mh_search=([^&]+)/);
    if (m) setTimeout(function () { header.findLeaf(decodeURIComponent(m[1]).toLowerCase()); }, 500);

    // deep link to a section (/insurance#CarrierEnablementAtScale)
    if (window.location.hash && window.location.hash.length > 1) {
      var id = decodeURIComponent(window.location.hash.slice(1));
      setTimeout(function () { MH.scrollToId(id); }, 300);
    }
  });

  /* ----------------------------------------------------------------------
   * Contact popup
   * ------------------------------------------------------------------- */
  var popup = {
    el: null,
    open: function () {
      popup.el = popup.el || document.getElementById('mh-contact-popup');
      if (!popup.el) return;
      popup.reset();
      popup.el.hidden = false;
      document.body.style.overflow = 'hidden';
      var first = popup.el.querySelector('input[name="firstName"]');
      if (first) first.focus();
    },
    close: function () {
      if (!popup.el) return;
      popup.el.hidden = true;
      document.body.style.overflow = '';
    },
    reset: function () {
      var form = popup.el.querySelector('form');
      if (form) form.reset();
      MH.qa('.field-error', popup.el).forEach(function (n) { n.hidden = true; });
      var err = popup.el.querySelector('[data-mh-popup-error]');
      if (err) { err.hidden = true; err.textContent = ''; }
      popup.el.querySelector('[data-mh-popup-body]').hidden = false;
      popup.el.querySelector('[data-mh-popup-success]').hidden = true;
      var btn = popup.el.querySelector('.submit-btn');
      btn.disabled = false;
      btn.textContent = 'Submit';
    },
    valid: function (form) {
      var ok = true;
      var email = form.elements.email.value.trim();
      ['firstName', 'lastName', 'email', 'company', 'mobile', 'service', 'message'].forEach(function (name) {
        var v = (form.elements[name].value || '').trim();
        var bad = !v || (name === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email));
        var msg = popup.el.querySelector('[data-error-for="' + name + '"]');
        if (msg) msg.hidden = !bad;
        if (bad) ok = false;
      });
      return ok;
    },
    submit: function (form) {
      if (!popup.valid(form)) return;
      var btn = form.querySelector('.submit-btn');
      var err = popup.el.querySelector('[data-mh-popup-error]');
      btn.disabled = true;
      btn.textContent = 'Submitting...';
      err.hidden = true;

      var body = new FormData(form);
      body.append('action', 'mahathi_contact');
      body.append('nonce', cfg.nonce || '');
      body.append('page_url', window.location.href);

      fetch(cfg.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (res && res.success) {
            popup.el.querySelector('[data-mh-popup-body]').hidden = true;
            popup.el.querySelector('[data-mh-popup-success]').hidden = false;
            form.reset();
          } else {
            throw new Error((res && res.data && res.data.message) || 'Unable to submit form. Please try again.');
          }
        })
        .catch(function (e) {
          err.textContent = e.message || 'Unable to submit form. Please try again.';
          err.hidden = false;
        })
        .then(function () { btn.disabled = false; btn.textContent = 'Submit'; });
    }
  };
  MH.popup = popup;

  MH.actions['open-contact'] = function () { popup.open(); };

  document.addEventListener('click', function (e) {
    var t = e.target;
    if (!popup.el || popup.el.hidden || !t.closest) return;
    if (t.closest('[data-mh-popup-close]') || t === popup.el.querySelector('[data-mh-popup-overlay]')) popup.close();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && popup.el && !popup.el.hidden) popup.close();
    if (e.key === 'Enter' && e.target && e.target.getAttribute && e.target.getAttribute('data-mh-action') === 'open-contact') popup.open();
  });
  document.addEventListener('submit', function (e) {
    if (e.target && e.target.id === 'mh-contact-form') {
      e.preventDefault();
      popup.submit(e.target);
    }
  });

  /* ======================================================================
   * Page modules (each one only acts when its markup is on the page)
   * =================================================================== */

  /* --- Home: hero video + text carousel ------------------------------- */
  MH.modules.push(function homeHero() {
    var banner = document.getElementById('page-block-banner-carousel');
    if (!banner) return;

    var video = banner.querySelector('video.bg-video');
    if (video) {
      video.muted = true;
      video.playbackRate = 0.5;
      var p = video.play();
      if (p && p.catch) p.catch(function () { /* autoplay blocked: poster stays visible */ });
    }

    setTimeout(function () {
      if ($ && $.fn && $.fn.slick) {
        var slider = $('.banner-carousel-item-inner');
        if (!slider.hasClass('slick-initialized')) {
          slider.slick({
            prevArrow: $('[solution-arrow-left]'),
            nextArrow: $('[solution-arrow-right]'),
            cssEase: 'linear',
            speed: 500,
            autoplay: true,
            autoplaySpeed: 3700,
            infinite: true,
            slidesToShow: 1,
            variableWidth: false,
            adaptiveHeight: false,
            fade: true,
            pauseOnHover: false,
            pauseOnFocus: false
          });
          // each headline stays on screen for a different time
          slider.on('beforeChange', function (event, slick, current, next) {
            var d = { 0: 3800, 1: 7900, 2: 3250 }[next] || 0;
            slider.slick('slickSetOption', 'autoplaySpeed', d);
          });
        }
      }
      banner.style.display = 'block';
      banner.style.visibility = 'visible';
      banner.style.opacity = '1';
    }, 250);
  });

  /* --- Home: impact cards auto-scroll on small screens ----------------- */
  MH.modules.push(function impactCarousel() {
    if (window.innerWidth > 768) return;
    var carousel = MH.q('.impact-mobile-carousel');
    if (!carousel) return;
    var cards = MH.qa('.impact-card-col', carousel);
    if (!cards.length) return;
    cards.forEach(function (card) { carousel.appendChild(card.cloneNode(true)); });
    var index = 0, timer = null;
    var width = function () { return cards[0].getBoundingClientRect().width; };
    function start() {
      if (timer) return;
      timer = setInterval(function () {
        if (index >= cards.length) {
          carousel.classList.add('no-snap');
          carousel.scrollLeft = 0;
          index = 0;
          requestAnimationFrame(function () { carousel.classList.remove('no-snap'); });
        }
        index++;
        carousel.scrollTo({ left: index * width(), behavior: 'smooth' });
      }, 3000);
    }
    function stop() { clearInterval(timer); timer = null; }
    start();
    carousel.addEventListener('touchstart', stop, { passive: true });
    carousel.addEventListener('touchend', start, { passive: true });
  });

  /* --- Home: ?tab=N deep link scrolls to the solutions --------------- */
  MH.modules.push(function homeTabLink() {
    if (!document.getElementById('page-block-banner-carousel')) return;
    if (!/[?&]tab=/.test(window.location.search)) return;
    setTimeout(function () {
      var t = document.getElementById('dashboard-tabs');
      if (t) t.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 600);
  });

  /* --- Healthcare: page opens scrolled to the solutions -------------- */
  MH.modules.push(function healthcareTabs() {
    if (cfg.route !== '/healthcare') return;
    setTimeout(function () {
      var target = document.getElementById('healthcare-tabs');
      if (!target) return;
      window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY + 100, behavior: 'smooth' });
    }, 200);
  });

  /* --- Solution cards -> side panel (home "Our solutions", healthcare) */
  var CLOSE_ICON = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M1 1l10 10M11 1L1 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path></svg>';
  MH.sidebar = {
    open: function (payload) {
      var aside = MH.q('[data-mh-sidebar]');
      if (!aside || !payload) return;
      var kind = aside.getAttribute('data-mh-sidebar'); // "vg" | "hc"
      MH.sidebar.close();
      var html = '<div class="' + kind + '-sidebar__header"><button class="' + kind + '-sidebar__close" aria-label="Close" data-mh-sidebar-close>' + CLOSE_ICON + '</button></div>';
      html += '<ul class="' + kind + '-sidebar__list"></ul>';
      aside.innerHTML = html;
      var list = aside.querySelector('ul');
      (payload.items || []).forEach(function (item) {
        var li = document.createElement('li');
        li.className = kind + '-sidebar__list-item';
        var target = li;
        if (kind === 'hc') {
          var btn = document.createElement('button');
          btn.className = 'hc-sidebar__list-btn';
          btn.type = 'button';
          li.appendChild(btn);
          target = btn;
        }
        target.textContent = ' ' + item.label + ' ';
        li.addEventListener('click', function () {
          if (!item.href) return;
          MH.sidebar.close();
          window.location.href = item.href;
        });
        list.appendChild(li);
      });
      aside.setAttribute('aria-label', payload.title || '');
      aside.classList.add(kind + '-sidebar--open');
      var backdrop = document.createElement('div');
      backdrop.className = kind + '-backdrop';
      backdrop.setAttribute('data-mh-sidebar-close', '');
      aside.parentNode.insertBefore(backdrop, aside.nextSibling);
    },
    close: function () {
      var aside = MH.q('[data-mh-sidebar]');
      if (!aside) return;
      var kind = aside.getAttribute('data-mh-sidebar');
      aside.classList.remove(kind + '-sidebar--open');
      aside.removeAttribute('aria-label');
      aside.innerHTML = '';
      MH.qa('.' + kind + '-backdrop').forEach(function (b) { b.parentNode.removeChild(b); });
    }
  };
  MH.actions['openSidebar'] = function (el, args) {
    var payload = args[0] || {};
    MH.sidebar.open(payload);
    if (payload.tab !== undefined && MH.solutionGrid) MH.solutionGrid.selectTab(payload.tab, true);
  };
  document.addEventListener('click', function (e) {
    if (e.target.closest && e.target.closest('[data-mh-sidebar-close]')) MH.sidebar.close();
  });

  /* --- "Select Industry" accordion (mobile) --------------------------- */
  MH.modules.push(function solutionGrid() {
    var root = MH.q('[data-mh-solution-grid]');
    if (!root) return;
    var host = root.parentNode;
    var templates = {};
    MH.qa('template[data-mh-cards]', host).forEach(function (t) { templates[t.getAttribute('data-mh-cards')] = t; });
    var headers = MH.qa('[data-mh-accordion]', root);
    var count = headers.length;
    var state = {
      tab: parseInt(root.getAttribute('data-active-tab'), 10) || 0,
      acc: root.getAttribute('data-active-acc') === '' ? null : parseInt(root.getAttribute('data-active-acc'), 10)
    };

    function render() {
      headers.forEach(function (h, i) {
        var acc = h.parentNode;
        var arrow = h.querySelector('.dropdown-arrow');
        if (arrow) arrow.classList.toggle('open', state.acc === i);
        var body = acc.querySelector('.mobile-accordion-body');
        if (state.acc !== i) {
          if (body) acc.removeChild(body);
          return;
        }
        var fresh = !body;
        if (fresh) {
          body = document.createElement('div');
          body.className = 'mobile-accordion-body';
          acc.appendChild(body);
        }
        if (fresh || body.getAttribute('data-tab') !== String(state.tab)) {
          body.innerHTML = '';
          var tpl = templates[state.tab];
          if (tpl) body.appendChild(tpl.content.cloneNode(true));
          body.setAttribute('data-tab', String(state.tab));
        }
      });
    }

    MH.solutionGrid = {
      // tab change from the page (arrows, solution card); `followTab` also opens that accordion
      selectTab: function (tab, followTab) {
        state.tab = (tab + count) % count;
        if (followTab) state.acc = state.tab;
        render();
      }
    };

    var initialBody = root.querySelector('.mobile-accordion-body');
    if (initialBody) initialBody.setAttribute('data-tab', String(state.tab));

    headers.forEach(function (h, i) {
      h.addEventListener('click', function () {
        if (state.acc === i) { state.acc = null; render(); return; }
        state.acc = i;
        state.tab = i;
        render();
        setTimeout(function () {
          window.scrollTo({ top: h.getBoundingClientRect().top + window.scrollY - 60, behavior: 'smooth' });
        }, 50);
      });
    });

    MH.qa('[data-mh-tab-step]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        MH.solutionGrid.selectTab(state.tab + parseInt(btn.getAttribute('data-mh-tab-step'), 10), false);
      });
    });
  });

  /* --- About us: timeline + leadership cards reveal on scroll -------- */
  MH.modules.push(function aboutReveal() {
    var items = MH.qa('app-aboutus .timeline-item');
    var line = MH.q('app-aboutus .timeline-line');
    if (items.length && 'IntersectionObserver' in window) {
      var tl = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
            if (line) line.classList.add('active');
          }
        });
      }, { threshold: 0.35 });
      items.forEach(function (i) { tl.observe(i); });
    }

    var cards = MH.qa('.founder-card');
    if (!cards.length) return;
    var grid = MH.q('.founders-grid');
    var columns = grid ? getComputedStyle(grid).gridTemplateColumns.split(' ').length : 1;
    if (!('IntersectionObserver' in window)) {
      cards.forEach(function (c) { c.classList.add('is-visible'); });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.18, rootMargin: '0px 0px -30px 0px' });
    cards.forEach(function (card, index) {
      card.style.transitionDelay = (Math.floor(index / columns) * 90) + 'ms';
      obs.observe(card);
    });
  });

  /* --- News: category filters, "full story" toggles, photo sliders --- */
  MH.modules.push(function newsroom() {
    if (!MH.q('app-news .newsroom')) return;
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Section tabs: show the stories (or the empty state) whose data-section matches.
    MH.actions['news-filter'] = function (el, args) {
      var key = args[0];
      MH.qa('app-news .news-tab').forEach(function (btn) {
        var on = btn === el;
        btn.classList.toggle('is-active', on);
        btn.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
      MH.qa('app-news .news-item, app-news .news-empty').forEach(function (block) {
        var match = block.getAttribute('data-section') === key;
        block.hidden = !match;
        block.classList.remove('is-entering');
        if (match) {
          void block.offsetWidth; // restart the entrance animation
          block.classList.add('is-entering');
        }
      });
    };

    MH.actions['news-toggle'] = function (el) {
      var panel = document.getElementById(el.getAttribute('aria-controls'));
      if (!panel) return;
      var open = !panel.classList.contains('is-open');
      panel.classList.toggle('is-open', open);
      el.setAttribute('aria-expanded', open ? 'true' : 'false');
      var label = el.querySelector('[data-news-toggle-label]');
      if (label) label.textContent = open ? 'Show less' : 'Read full story';
    };

    // Photo sliders: state lives on each .news-slider element; auto-advance pauses on hover/focus.
    function go(slider, index) {
      var s = slider._mhNews;
      s.index = (index + s.count) % s.count;
      s.track.style.transform = 'translateX(-' + (s.index * 100) + '%)';
      s.dots.forEach(function (d, i) { d.classList.toggle('is-active', i === s.index); });
    }
    MH.qa('app-news .news-slider').forEach(function (slider) {
      var track = slider.querySelector('.news-slider__track');
      if (!track) return;
      slider._mhNews = { track: track, index: 0, count: track.children.length || 1, dots: MH.qa('.news-slider__dot', slider), paused: false };
      ['mouseenter', 'focusin'].forEach(function (ev) { MH.on(slider, ev, function () { slider._mhNews.paused = true; }); });
      ['mouseleave', 'focusout'].forEach(function (ev) { MH.on(slider, ev, function () { slider._mhNews.paused = false; }); });
      if (!reduceMotion) {
        setInterval(function () {
          if (!slider._mhNews.paused && !document.hidden && slider.offsetParent) go(slider, slider._mhNews.index + 1);
        }, 5000);
      }
    });
    MH.actions['news-slide'] = function (el, args) {
      var slider = el.closest('.news-slider');
      if (slider && slider._mhNews) go(slider, slider._mhNews.index + (args[0] || 1));
    };
    MH.actions['news-slide-to'] = function (el, args) {
      var slider = el.closest('.news-slider');
      if (slider && slider._mhNews) go(slider, args[0] || 0);
    };
  });

  /* --- FAQ page: accordion items + jump navigation -------------------- */
  MH.actions['toggle'] = function (el) {
    var item = el.closest('.faq-item');
    if (!item) return;
    var open = !item.classList.contains('faq-item--open');
    item.classList.toggle('faq-item--open', open);
    el.setAttribute('aria-expanded', open ? 'true' : 'false');
    var icon = el.querySelector('.faq-question__icon');
    if (icon) icon.textContent = open ? ' − ' : ' + ';
  };
  MH.actions['scrollToSection'] = function (el, args, e) {
    if (e) e.preventDefault();
    var id = args.length > 1 ? args[1] : 'faq-section-' + args[0];
    var target = document.getElementById(id);
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    return false;
  };

  /* --- Guidewire: capability pills + FAQ (one open at a time) -------- */
  MH.actions['setActivePill'] = function (el) {
    MH.qa('.cap-pill', el.parentNode).forEach(function (p) { p.classList.toggle('active', p === el); });
  };
  // Databricks / Workers' Comp pills: activate the pill, scroll to its card and flash it
  MH.actions['scrollToCap'] = function (el, args) {
    MH.qa('.cap-pill', el.parentNode).forEach(function (p) { p.classList.toggle('active', p === el); });
    var card = args[0] && document.getElementById(args[0]);
    if (!card) return;
    card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    card.classList.add('flash');
    setTimeout(function () { card.classList.remove('flash'); }, 1400);
  };
  MH.actions['toggleFaq'] = function (el) {
    var item = el.closest('.faq-item');
    if (!item) return;
    var wasOpen = item.classList.contains('open');
    MH.qa('.faq-item', item.parentNode).forEach(function (other) {
      other.classList.remove('open');
      var b = other.querySelector('.faq-summary');
      if (b) b.setAttribute('aria-expanded', 'false');
      var ic = other.querySelector('.faq-icon');
      if (ic) ic.textContent = '+';
      var ans = other.querySelector('.faq-answer');
      if (ans) ans.classList.remove('is-open');
    });
    if (!wasOpen) {
      item.classList.add('open');
      el.setAttribute('aria-expanded', 'true');
      var icon = item.querySelector('.faq-icon');
      if (icon) icon.textContent = '×';
      var answer = item.querySelector('.faq-answer');
      if (answer) answer.classList.add('is-open');
    }
  };

  /* --- Section feature pills: scroll to the matching card ------------- */
  // main-template pills use the sticky-header margin; section 4.1 pills offset by the header height
  MH.actions['goTo'] = function (el, args) {
    var id = args[0];
    var target = id && document.getElementById(id);
    if (!target) return;
    if (el.closest('app-section41-temp')) {
      var header = MH.q('.menubar, .navbar, header');
      var extra = window.innerWidth < 576 ? 10 : (window.innerWidth < 992 ? 20 : 80);
      var y = target.getBoundingClientRect().top + window.pageYOffset - ((header && header.offsetHeight) || 0) - extra;
      window.scrollTo({ top: y, behavior: 'smooth' });
    } else {
      MH.scrollToId(id);
    }
  };
  MH.actions['onCtaClick'] = function () { /* product sheet / demo / ROI buttons have no target yet */ };

  /* --- Contact page: office tabs (?location=usa|india|uae|philippines) */
  var CITY_TABS = { usa: 'London', india: 'Paris', uae: 'Dubai', philippines: 'Tokyo' };
  function showCityTab(location) {
    var tabId = CITY_TABS[location] || 'London';
    MH.qa('.tabcontent').forEach(function (t) { t.style.display = 'none'; });
    MH.qa('.tablinks').forEach(function (b) { b.classList.remove('active'); });
    var active = document.getElementById(tabId);
    if (active) active.style.display = 'block';
    MH.qa('.tablinks').forEach(function (b) {
      if ((b.textContent || '').toLowerCase().indexOf(location) !== -1) b.classList.add('active');
    });
  }
  MH.actions['openCity'] = function (el, args) { showCityTab(String(args[0] || '').toLowerCase()); };
  MH.modules.push(function contactLocation() {
    if (cfg.route !== '/contact-us') return;
    var m = window.location.search.match(/[?&]location=([^&]+)/);
    if (!m) return;
    var loc = decodeURIComponent(m[1]).toLowerCase();
    setTimeout(function () {
      showCityTab(loc);
      var tabs = document.getElementById('location-tabs');
      if (tabs) tabs.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 200);
  });

  /* Tabs helper of the original page shell (used by inline onclick handlers). */
  window.openCity = function (evt, cityName) {
    MH.qa('.tabcontent').forEach(function (t) { t.style.display = 'none'; });
    MH.qa('.tablinks').forEach(function (t) { t.className = t.className.replace(' active', ''); });
    var tab = document.getElementById(cityName);
    if (tab) tab.style.display = 'block';
    if (evt && evt.currentTarget) evt.currentTarget.className += ' active';
  };

  /* ----------------------------------------------------------------------
   * Page modules
   * ------------------------------------------------------------------- */
  document.addEventListener('DOMContentLoaded', function () {
    MH.modules.forEach(function (init) {
      try { init(); } catch (err) { if (window.console) console.error('[mahathi] module failed', err); }
    });
  });
})(window, document);
