/*!
 * Mahathi lead dashboard (contact-dashboard.php).
 *
 * Talks to the admin-ajax endpoints in inc/leads.php (mh_leads_list / stats / get / update /
 * note / delete / export). Config comes from window.MH_LEADS. Everything a visitor submitted is
 * escaped with esc() before it is put into the page.
 */
(function () {
  'use strict';

  var C = window.MH_LEADS;
  if (!C) return;

  /* ------------------------------------------------------------------ helpers */
  var $ = function (sel, root) { return (root || document).querySelector(sel); };
  var $$ = function (sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); };
  var ESC = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' };
  function esc(v) { return String(v == null ? '' : v).replace(/[&<>"']/g, function (c) { return ESC[c]; }); }
  function plural(n, one, many) { return n + ' ' + (n === 1 ? one : (many || one + 's')); }
  function initials(name) {
    var parts = String(name || '').trim().split(/\s+/).filter(Boolean);
    if (!parts.length) return '?';
    return ((parts[0][0] || '') + (parts.length > 1 ? parts[parts.length - 1][0] : '')).toUpperCase();
  }
  function displayName(r) { return r.name || r.email || 'Website visitor'; }
  function statusLabel(key) { return C.statuses[key] || key; }
  function debounce(fn, ms) { var t; return function () { var a = arguments; clearTimeout(t); t = setTimeout(function () { fn.apply(null, a); }, ms); }; }

  var rtf = window.Intl && Intl.RelativeTimeFormat ? new Intl.RelativeTimeFormat('en', { numeric: 'auto' }) : null;
  function fmtRelative(iso) {
    if (!iso) return '';
    var diff = (new Date(iso).getTime() - Date.now()) / 1000;
    var abs = Math.abs(diff);
    if (abs < 45) return 'just now';
    if (!rtf) return fmtDate(iso);
    if (abs < 3600) return rtf.format(Math.round(diff / 60), 'minute');
    if (abs < 86400) return rtf.format(Math.round(diff / 3600), 'hour');
    if (abs < 86400 * 7) return rtf.format(Math.round(diff / 86400), 'day');
    return fmtDate(iso);
  }
  function fmtDate(iso, withTime) {
    if (!iso) return '';
    var d = new Date(iso);
    var opts = { month: 'short', day: 'numeric' };
    if (d.getFullYear() !== new Date().getFullYear()) opts.year = 'numeric';
    if (withTime) { opts.year = 'numeric'; opts.hour = 'numeric'; opts.minute = '2-digit'; }
    return d.toLocaleString('en-US', opts);
  }
  function fmtTime(iso) { return iso ? new Date(iso).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' }) : ''; }

  /** Today's date (YYYY-MM-DD) in the site's timezone when the browser knows it. */
  function siteToday() {
    try { return new Intl.DateTimeFormat('en-CA', { timeZone: C.timezone }).format(new Date()); }
    catch (e) { var d = new Date(); return ymd(d); }
  }
  function ymd(d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0'); }
  function shiftDay(dateStr, days) { var p = dateStr.split('-').map(Number); return ymd(new Date(p[0], p[1] - 1, p[2] + days)); }

  /* ------------------------------------------------------------------ state */
  var DEFAULTS = { view: 'all', search: '', service: '', range: '', from: '', to: '', unread: false, starred: false, followups: false, sort: 'received', order: 'desc', page: 1, perPage: 25 };
  var S = Object.assign({}, DEFAULTS);
  var rows = [];
  var totalRows = 0;
  var pageCount = 1;
  var selected = new Set();
  var currentId = null;
  var current = null;
  var knownLatest = null;
  var lastFocus = null;

  var el = {
    kpis: $('[data-mhd-kpis]'),
    trend: $('[data-mhd-trend]'),
    trendSub: $('[data-mhd-trend-sub]'),
    services: $('[data-mhd-services]'),
    tabs: $('[data-mhd-tabs]'),
    search: $('[data-mhd-search]'),
    service: $('[data-mhd-service]'),
    range: $('[data-mhd-range]'),
    custom: $('[data-mhd-custom]'),
    from: $('[data-mhd-from]'),
    to: $('[data-mhd-to]'),
    clear: $('[data-mhd-clear]'),
    bulk: $('[data-mhd-bulk]'),
    bulkCount: $('[data-mhd-bulk-count]'),
    bulkNormal: $('[data-mhd-bulk-normal]'),
    bulkTrash: $('[data-mhd-bulk-trash]'),
    bulkStatus: $('[data-mhd-bulk-status]'),
    wrap: $('.mhd-tablewrap'),
    tbody: $('[data-mhd-rows]'),
    empty: $('[data-mhd-empty]'),
    checkAll: $('[data-mhd-check-all]'),
    rangeText: $('[data-mhd-range-text]'),
    pageText: $('[data-mhd-page-text]'),
    per: $('[data-mhd-per]'),
    drawer: $('[data-mhd-drawer]'),
    scrim: $('[data-mhd-scrim]'),
    toasts: $('[data-mhd-toasts]'),
    live: $('.mhd-live')
  };

  /* ------------------------------------------------------------------ API */
  function api(action, data) {
    var fd = new FormData();
    fd.append('action', 'mh_leads_' + action);
    fd.append('nonce', C.nonce);
    Object.keys(data || {}).forEach(function (k) {
      var v = data[k];
      if (v === undefined || v === null) return;
      fd.append(k, typeof v === 'boolean' ? (v ? '1' : '0') : v);
    });
    return fetch(C.ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' })
      .then(function (res) { return res.json().catch(function () { throw new Error('Unexpected response from the server.'); }); })
      .then(function (json) {
        if (!json || !json.success) throw new Error((json && json.data && json.data.message) || 'Something went wrong. Please try again.');
        return json.data;
      });
  }

  /** Filter arguments shared by the list, the tab counts and the export. */
  function filterParams() {
    var from = '', to = '', today = siteToday();
    if (S.range === 'today') { from = today; to = today; }
    else if (S.range === '7') { from = shiftDay(today, -6); }
    else if (S.range === '30') { from = shiftDay(today, -29); }
    else if (S.range === 'month') { from = today.slice(0, 8) + '01'; }
    else if (S.range === 'custom') { from = S.from; to = S.to; }
    return {
      view: S.view, search: S.search, service: S.service, from: from, to: to,
      unread: S.unread ? '1' : '', starred: S.starred ? '1' : '', followups: S.followups ? '1' : ''
    };
  }
  function exportUrl(ids) {
    var p = new URLSearchParams(Object.assign({ action: 'mh_leads_export', nonce: C.nonce }, filterParams()));
    if (ids && ids.length) p.set('ids', ids.join(','));
    return C.ajaxUrl + '?' + p.toString();
  }

  /* ------------------------------------------------------------------ toasts */
  function toast(message, type, action) {
    var t = document.createElement('div');
    t.className = 'mhd-toast' + (type === 'error' ? ' mhd-toast--error' : '');
    t.innerHTML = '<i class="fa-solid ' + (type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check') + '" aria-hidden="true"></i><span>' + esc(message) + '</span>';
    if (action) {
      var b = document.createElement('button');
      b.type = 'button';
      b.textContent = action.label;
      b.addEventListener('click', function () { t.remove(); action.run(); });
      t.appendChild(b);
    }
    el.toasts.appendChild(t);
    setTimeout(function () { t.remove(); }, action ? 7000 : 3500);
  }

  /* ------------------------------------------------------------------ URL state */
  function syncUrl() {
    var p = new URLSearchParams();
    if (S.view !== 'all') p.set('view', S.view);
    if (S.search) p.set('q', S.search);
    if (S.service) p.set('service', S.service);
    if (S.range) p.set('range', S.range);
    if (S.range === 'custom') { if (S.from) p.set('from', S.from); if (S.to) p.set('to', S.to); }
    ['unread', 'starred', 'followups'].forEach(function (k) { if (S[k]) p.set(k, '1'); });
    if (S.sort !== 'received' || S.order !== 'desc') { p.set('sort', S.sort); p.set('order', S.order); }
    if (S.page > 1) p.set('page', S.page);
    if (S.perPage !== 25) p.set('per', S.perPage);
    if (currentId) p.set('lead', currentId);
    var qs = p.toString();
    history.replaceState(null, '', location.pathname + (qs ? '?' + qs : ''));
  }
  function readUrl() {
    var p = new URLSearchParams(location.search);
    var views = ['all', 'trash'].concat(Object.keys(C.statuses));
    if (views.indexOf(p.get('view')) > -1) S.view = p.get('view');
    S.search = (p.get('q') || '').slice(0, 100);
    S.service = p.get('service') || '';
    S.range = ['today', '7', '30', 'month', 'custom'].indexOf(p.get('range')) > -1 ? p.get('range') : '';
    S.from = /^\d{4}-\d{2}-\d{2}$/.test(p.get('from') || '') ? p.get('from') : '';
    S.to = /^\d{4}-\d{2}-\d{2}$/.test(p.get('to') || '') ? p.get('to') : '';
    S.unread = p.get('unread') === '1';
    S.starred = p.get('starred') === '1';
    S.followups = p.get('followups') === '1';
    if (['received', 'name', 'company', 'service', 'status'].indexOf(p.get('sort')) > -1) S.sort = p.get('sort');
    if (p.get('order') === 'asc' || p.get('order') === 'desc') S.order = p.get('order');
    S.page = Math.max(1, parseInt(p.get('page'), 10) || 1);
    if ([10, 25, 50, 100].indexOf(parseInt(p.get('per'), 10)) > -1) S.perPage = parseInt(p.get('per'), 10);
    return parseInt(p.get('lead'), 10) || null;
  }
  function filtersActive() {
    return !!(S.search || S.service || S.range || S.unread || S.starred || S.followups);
  }
  function syncControls() {
    el.search.value = S.search;
    el.service.value = S.service;
    el.range.value = S.range;
    el.custom.hidden = S.range !== 'custom';
    el.from.value = S.from;
    el.to.value = S.to;
    el.per.value = String(S.perPage);
    $$('[data-mhd-chip]').forEach(function (b) { b.setAttribute('aria-pressed', S[b.getAttribute('data-mhd-chip')] ? 'true' : 'false'); });
    $$('[data-mhd-sort]').forEach(function (b) {
      var on = b.getAttribute('data-mhd-sort') === S.sort;
      b.classList.toggle('is-asc', on && S.order === 'asc');
      b.classList.toggle('is-desc', on && S.order === 'desc');
      b.closest('th').setAttribute('aria-sort', on ? (S.order === 'asc' ? 'ascending' : 'descending') : 'none');
    });
    el.clear.hidden = !filtersActive();
  }

  /* ------------------------------------------------------------------ stats */
  function loadStats() {
    return api('stats').then(function (d) {
      renderKpis(d);
      renderTrend(d.series);
      renderServices(d.services);
      document.title = (d.unread ? '(' + d.unread + ') ' : '') + 'Lead Dashboard · Mahathi';
      // Compare the newest id (not the total, which also grows when a lead is restored from trash).
      if (knownLatest !== null && d.latest && d.latest.id > knownLatest) {
        toast('New lead from ' + (d.latest.name || 'a website visitor'), null, { label: 'Show', run: function () { resetFilters(); } });
      }
      knownLatest = d.latest ? d.latest.id : 0;
      setLive(true);
      return d;
    }).catch(function (e) { setLive(false); throw e; });
  }
  function setLive(on) { if (el.live) el.live.classList.toggle('is-off', !on); }

  function kpi(o) {
    var tag = o.action ? 'button type="button" data-mhd-kpi="' + o.action + '"' : 'div';
    return '<' + tag + ' class="mhd-kpi' + (o.cls ? ' ' + o.cls : '') + '">' +
      '<div class="mhd-kpi__top"><span class="mhd-kpi__label">' + esc(o.label) + '</span><span class="mhd-kpi__icon"><i class="fa-solid ' + o.icon + '" aria-hidden="true"></i></span></div>' +
      '<div class="mhd-kpi__value">' + esc(o.value) + '</div>' +
      '<div class="mhd-kpi__meta">' + o.meta + '</div>' +
      '</' + (o.action ? 'button' : 'div') + '>';
  }
  function renderKpis(d) {
    var change;
    if (!d.prev7) change = d.last7 ? 'New activity this week' : 'No leads this week yet';
    else {
      var pct = Math.round(((d.last7 - d.prev7) / d.prev7) * 100);
      change = pct === 0 ? 'Same as the previous 7 days'
        : '<span class="' + (pct > 0 ? 'up' : 'down') + '">' + (pct > 0 ? '▲ ' : '▼ ') + Math.abs(pct) + '%</span> vs previous 7 days';
    }
    var closed = d.won + d.lost;
    el.kpis.innerHTML = [
      kpi({ label: 'Total leads', value: d.total.toLocaleString(), icon: 'fa-inbox', cls: 'mhd-kpi--accent', meta: esc(plural(d.today, 'new lead') + ' today'), action: 'all' }),
      kpi({ label: 'Unread', value: d.unread.toLocaleString(), icon: 'fa-envelope', meta: d.unread ? 'Waiting for a first look' : 'Inbox zero — nice work', action: 'unread' }),
      kpi({ label: 'Last 7 days', value: d.last7.toLocaleString(), icon: 'fa-chart-line', meta: change, action: 'week' }),
      kpi({ label: 'Win rate', value: closed ? Math.round((d.won / closed) * 100) + '%' : '—', icon: 'fa-trophy', meta: esc(d.won + ' won · ' + d.lost + ' lost'), action: 'won' }),
      kpi({ label: 'Follow-ups due', value: d.followups.toLocaleString(), icon: 'fa-bell', cls: d.followups ? 'mhd-kpi--alert' : '', meta: d.followups ? 'Due today or overdue' : 'You’re all caught up', action: 'followups' })
    ].join('');
  }

  var lastSeries = [];
  function renderTrend(series) {
    lastSeries = series || [];
    var box = el.trend;
    var W = Math.max(280, box.clientWidth), H = 180, padL = 26, padB = 22, padT = 16;
    var n = lastSeries.length || 30;
    var max = Math.max.apply(null, lastSeries.map(function (s) { return s.count; }).concat([0]));
    var top = Math.max(4, Math.ceil(max / 4) * 4);
    var plotW = W - padL, plotH = H - padB - padT;
    var step = plotW / n, barW = Math.max(3, step * 0.62);
    var sum = 0, best = null;
    var svg = '<svg viewBox="0 0 ' + W + ' ' + H + '" role="img" aria-label="Leads per day for the last 30 days">';
    [0, 0.5, 1].forEach(function (f) {
      var y = padT + plotH - plotH * f;
      svg += '<line class="grid" x1="' + padL + '" x2="' + W + '" y1="' + y + '" y2="' + y + '"/>';
      svg += '<text x="0" y="' + (y + 4) + '">' + Math.round(top * f) + '</text>';
    });
    lastSeries.forEach(function (s, i) {
      sum += s.count;
      if (!best || s.count > best.count) best = s;
      var h = s.count ? Math.max(3, (s.count / top) * plotH) : 0;
      var x = padL + i * step + (step - barW) / 2;
      var y = padT + plotH - h;
      var date = new Date(s.date + 'T12:00:00');
      var label = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
      svg += '<g><title>' + esc(label + ': ' + plural(s.count, 'lead')) + '</title>' +
        '<rect class="hit" x="' + (padL + i * step) + '" y="' + padT + '" width="' + step + '" height="' + plotH + '"/>' +
        (h ? '<rect class="bar' + (i === n - 1 ? ' is-today' : '') + '" x="' + x + '" y="' + y + '" width="' + barW + '" height="' + h + '" rx="3"/>' : '') +
        '<text class="mhd-trend__tip" x="' + (x + barW / 2) + '" y="' + (y - 5) + '" text-anchor="middle">' + s.count + '</text>';
      // Weekly date labels, skipping any that would collide with "Today" at the right edge.
      if ((i % 7 === 0 && i < n - 4) || i === n - 1) {
        svg += '<text x="' + (padL + i * step + step / 2) + '" y="' + (H - 4) + '" text-anchor="middle">' + esc(i === n - 1 ? 'Today' : label) + '</text>';
      }
      svg += '</g>';
    });
    box.innerHTML = svg + '</svg>';
    el.trendSub.textContent = sum
      ? plural(sum, 'lead') + ' in 30 days · busiest day ' + new Date(best.date + 'T12:00:00').toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) + ' (' + best.count + ')'
      : 'No leads in the last 30 days yet';
  }

  function renderServices(list) {
    if (!list || !list.length) {
      el.services.innerHTML = '<li class="mhd-services__empty">Service requests will appear here as leads come in.</li>';
      return;
    }
    var max = list[0].count || 1;
    el.services.innerHTML = list.map(function (s) {
      return '<li><button type="button" data-mhd-service-pick="' + esc(s.name) + '" title="Show leads for ' + esc(s.name) + '">' + esc(s.name) + '</button>' +
        '<span class="mhd-services__count">' + s.count + '</span>' +
        '<span class="mhd-services__bar"><span style="width:' + Math.round((s.count / max) * 100) + '%"></span></span></li>';
    }).join('');
  }

  /* ------------------------------------------------------------------ list */
  var listSeq = 0;
  function loadList(opts) {
    opts = opts || {};
    var seq = ++listSeq;
    if (!opts.silent) el.wrap.classList.add('is-loading');
    syncControls();
    syncUrl();
    var args = Object.assign(filterParams(), { sort: S.sort, order: S.order, page: S.page, per_page: S.perPage });
    return api('list', args).then(function (d) {
      if (seq !== listSeq) return;
      rows = d.rows;
      totalRows = d.total;
      pageCount = d.pages;
      S.page = d.page;
      var ids = rows.map(function (r) { return r.id; });
      selected.forEach(function (id) { if (ids.indexOf(id) === -1) selected.delete(id); });
      renderTabs(d.counts);
      renderRows();
      renderPager();
      renderBulk();
    }).catch(function (e) {
      if (seq === listSeq) toast(e.message, 'error');
    }).then(function () {
      if (seq === listSeq) el.wrap.classList.remove('is-loading');
    });
  }

  function renderTabs(counts) {
    var tabs = [['all', 'All leads']].concat(Object.keys(C.statuses).map(function (k) { return [k, C.statuses[k]]; }), [['trash', 'Trash']]);
    el.tabs.innerHTML = tabs.map(function (t) {
      var on = S.view === t[0];
      var dot = C.statuses[t[0]] ? '<span class="mhd-tab__dot" data-st="' + t[0] + '" aria-hidden="true"></span>' : (t[0] === 'trash' ? '<i class="fa-regular fa-trash-can" aria-hidden="true"></i>' : '');
      return '<button type="button" class="mhd-tab' + (on ? ' is-active' : '') + '" data-mhd-view="' + t[0] + '"' + (on ? ' aria-current="true"' : '') + '>' +
        dot + esc(t[1]) + '<span class="mhd-tab__count">' + (counts[t[0]] || 0) + '</span></button>';
    }).join('');
  }

  function followUpBadge(r) {
    if (!r.followUpAt || ['won', 'lost', 'spam'].indexOf(r.status) > -1) return '';
    var due = new Date(r.followUpAt);
    var endToday = new Date(); endToday.setHours(23, 59, 59, 999);
    var overdue = due < new Date();
    if (due <= endToday) {
      return '<span class="mhd-followup"><i class="fa-solid fa-bell" aria-hidden="true"></i>' + (overdue ? 'Follow-up overdue' : 'Follow up today ' + esc(fmtTime(r.followUpAt))) + '</span>';
    }
    return '<span class="mhd-followup is-later"><i class="fa-regular fa-bell" aria-hidden="true"></i>Follow up ' + esc(fmtDate(r.followUpAt)) + '</span>';
  }

  function rowHtml(r) {
    var name = displayName(r);
    var cls = [r.unread ? 'is-unread' : '', selected.has(r.id) ? 'is-selected' : '', r.id === currentId ? 'is-current' : ''].join(' ');
    var owner = r.assignee
      ? '<span class="mhd-owner"><span class="mhd-avatar" data-tone="' + (r.assignedTo % 5) + '">' + esc(initials(r.assignee)) + '</span>' + esc(r.assignee) + '</span>'
      : '<span class="mhd-muted">Unassigned</span>';
    return '<tr data-id="' + r.id + '" class="' + cls + '" tabindex="0" aria-label="Open lead ' + esc(name) + '">' +
      '<td class="mhd-col-check"><input type="checkbox" class="mhd-check" data-mhd-select aria-label="Select ' + esc(name) + '"' + (selected.has(r.id) ? ' checked' : '') + '></td>' +
      '<td class="mhd-col-star"><button type="button" class="mhd-star' + (r.starred ? ' is-on' : '') + '" data-mhd-star aria-pressed="' + r.starred + '" aria-label="' + (r.starred ? 'Unstar' : 'Star') + ' lead"><i class="fa-' + (r.starred ? 'solid' : 'regular') + ' fa-star" aria-hidden="true"></i></button></td>' +
      '<td><div class="mhd-lead"><span class="mhd-avatar" data-tone="' + (r.id % 5) + '">' + esc(initials(name)) + '</span><div class="mhd-lead__text">' +
        '<div class="mhd-lead__name">' + (r.unread ? '<span class="mhd-unread-dot" title="Unread"></span>' : '') + esc(name) + '</div>' +
        '<div class="mhd-lead__email">' + esc(r.name && r.email ? r.email : (r.phone || r.formLabel)) + '</div></div></div></td>' +
      '<td class="mhd-col-company"><span class="mhd-truncate">' + (r.company ? esc(r.company) : '<span class="mhd-muted">—</span>') + '</span></td>' +
      '<td class="mhd-col-service"><span class="mhd-truncate">' + esc(r.service || r.formLabel) + '</span></td>' +
      '<td><span class="mhd-pill" data-st="' + esc(r.status) + '">' + esc(statusLabel(r.status)) + '</span></td>' +
      '<td class="mhd-col-owner">' + owner + '</td>' +
      '<td class="mhd-col-date"><div class="mhd-date" title="' + esc(fmtDate(r.receivedAt, true)) + '">' + esc(fmtRelative(r.receivedAt)) + '<small>' + esc(fmtDate(r.receivedAt) + ' · ' + fmtTime(r.receivedAt)) + '</small></div>' + followUpBadge(r) + '</td>' +
      '</tr>';
  }

  function renderRows() {
    if (!rows.length) {
      el.tbody.innerHTML = '';
      el.empty.hidden = false;
      var filtered = filtersActive();
      var trash = S.view === 'trash';
      el.empty.innerHTML = '<span class="mhd-empty__icon"><i class="fa-solid ' + (filtered ? 'fa-magnifying-glass' : (trash ? 'fa-trash-can' : 'fa-inbox')) + '" aria-hidden="true"></i></span>' +
        '<h3>' + (filtered ? 'No leads match these filters' : (trash ? 'Trash is empty' : (S.view === 'all' ? 'No leads yet' : 'Nothing in “' + esc(statusLabel(S.view)) + '” yet'))) + '</h3>' +
        '<p>' + (filtered ? 'Try a different search or clear the filters.' : (S.view === 'all' ? 'New “Get in Touch” form submissions will appear here automatically.' : 'Leads you move to this stage will show up here.')) + '</p>' +
        (filtered ? '<button type="button" class="mhd-btn" data-mhd-clear-empty>Clear filters</button>' : '');
    } else {
      el.empty.hidden = true;
      el.tbody.innerHTML = rows.map(rowHtml).join('');
    }
    el.checkAll.checked = rows.length > 0 && rows.every(function (r) { return selected.has(r.id); });
    el.checkAll.indeterminate = !el.checkAll.checked && rows.some(function (r) { return selected.has(r.id); });
  }

  function renderSkeleton() {
    var cells = '';
    for (var i = 0; i < 6; i++) {
      cells += '<tr class="mhd-row-skeleton"><td class="mhd-col-check"></td><td></td><td><span class="mhd-skeleton" style="width:70%"></span></td><td class="mhd-col-company"><span class="mhd-skeleton" style="width:60%"></span></td><td class="mhd-col-service"><span class="mhd-skeleton" style="width:55%"></span></td><td><span class="mhd-skeleton" style="width:70px"></span></td><td class="mhd-col-owner"><span class="mhd-skeleton" style="width:60%"></span></td><td class="mhd-col-date"><span class="mhd-skeleton" style="width:70px;margin-left:auto"></span></td></tr>';
    }
    el.tbody.innerHTML = cells;
  }

  function renderPager() {
    var start = totalRows ? (S.page - 1) * S.perPage + 1 : 0;
    var end = Math.min(totalRows, S.page * S.perPage);
    el.rangeText.textContent = totalRows ? 'Showing ' + start + '–' + end + ' of ' + plural(totalRows, 'lead') : 'No leads to show';
    el.pageText.textContent = 'Page ' + S.page + ' of ' + pageCount;
    $('[data-mhd-page="-1"]').disabled = S.page <= 1;
    $('[data-mhd-page="1"]').disabled = S.page >= pageCount;
  }

  function renderBulk() {
    var n = selected.size;
    el.bulk.hidden = n === 0;
    el.bulkCount.textContent = n + ' selected';
    el.bulkNormal.hidden = S.view === 'trash';
    el.bulkTrash.hidden = S.view !== 'trash';
  }

  function findRow(id) { for (var i = 0; i < rows.length; i++) if (rows[i].id === id) return rows[i]; return null; }

  /* ------------------------------------------------------------------ updates */
  function update(ids, changes) {
    return api('update', Object.assign({ ids: ids.join(',') }, changes));
  }
  function refreshAll(silent) {
    return Promise.all([loadList({ silent: silent !== false }), loadStats().catch(function () {})]);
  }

  function bulk(action) {
    var ids = Array.from(selected);
    if (action === 'clear') { selected.clear(); renderRows(); renderBulk(); return; }
    if (!ids.length) return;
    if (action === 'export') { window.location.href = exportUrl(ids); return; }
    var p;
    if (action === 'read' || action === 'unread') p = update(ids, { unread: action === 'unread' ? '1' : '0' }).then(function () { toast(plural(ids.length, 'lead') + ' marked ' + action); });
    else if (action === 'trash') p = update(ids, { trash: '1' }).then(function () {
      toast(plural(ids.length, 'lead') + ' moved to trash', null, { label: 'Undo', run: function () { update(ids, { restore: '1' }).then(function () { refreshAll(); }); } });
    });
    else if (action === 'restore') p = update(ids, { restore: '1' }).then(function () { toast(plural(ids.length, 'lead') + ' restored'); });
    else if (action === 'delete') {
      if (!window.confirm('Permanently delete ' + plural(ids.length, 'lead') + '? This removes them and their notes for good and cannot be undone.')) return;
      p = api('delete', { ids: ids.join(',') }).then(function (d) { toast(plural(d.deleted, 'lead') + ' deleted permanently'); });
    }
    if (!p) return;
    p.then(function () { selected.clear(); return refreshAll(); }).catch(function (e) { toast(e.message, 'error'); });
  }

  function toggleStar(id) {
    var r = findRow(id);
    var on = !(r ? r.starred : current && current.starred);
    if (r) { r.starred = on; renderRows(); }
    if (current && current.id === id) { current.starred = on; renderDrawerHead(); }
    update([id], { starred: on ? '1' : '0' }).catch(function (e) {
      if (r) { r.starred = !on; renderRows(); }
      toast(e.message, 'error');
    });
  }

  /* ------------------------------------------------------------------ drawer */
  function openLead(id) {
    lastFocus = document.activeElement;
    currentId = id;
    current = null;
    renderRows();
    el.scrim.hidden = false;
    el.drawer.classList.add('is-open');
    el.drawer.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    el.drawer.innerHTML = '<div class="mhd-drawer__loading"><span><i class="fa-solid fa-circle-notch fa-spin" aria-hidden="true"></i> Loading lead…</span></div>';
    el.drawer.focus();
    syncUrl();
    api('get', { id: id }).then(function (d) {
      if (currentId !== id) return;
      current = d.lead;
      renderDrawer();
      var r = findRow(id);
      if (r && r.unread) { r.unread = false; renderRows(); loadStats().catch(function () {}); }
    }).catch(function (e) {
      if (currentId !== id) return;
      el.drawer.innerHTML = '<div class="mhd-drawer__loading"><div class="mhd-empty"><span class="mhd-empty__icon"><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i></span><h3>Couldn’t open this lead</h3><p>' + esc(e.message) + '</p><button type="button" class="mhd-btn" data-d="close">Close</button></div></div>';
    });
  }

  function closeDrawer() {
    if (!el.drawer.classList.contains('is-open')) return;
    el.drawer.classList.remove('is-open');
    el.drawer.setAttribute('aria-hidden', 'true');
    el.scrim.hidden = true;
    document.body.style.overflow = '';
    var id = currentId;
    currentId = null;
    current = null;
    renderRows();
    syncUrl();
    var row = id && el.tbody.querySelector('tr[data-id="' + id + '"]');
    (row || lastFocus || el.search).focus();
  }

  function step(dir) {
    if (!rows.length) return;
    var idx = -1;
    for (var i = 0; i < rows.length; i++) if (rows[i].id === currentId) idx = i;
    var next = rows[idx + dir];
    if (!next && idx === -1) next = rows[dir > 0 ? 0 : rows.length - 1];
    if (next) openLead(next.id);
  }

  function renderDrawerHead() {
    var head = $('.mhd-drawer__head', el.drawer);
    if (!head || !current) return;
    var star = $('[data-d="star"]', head);
    star.setAttribute('aria-pressed', current.starred);
    star.setAttribute('aria-label', current.starred ? 'Unstar lead' : 'Star lead');
    star.innerHTML = '<i class="fa-' + (current.starred ? 'solid' : 'regular') + ' fa-star" aria-hidden="true" style="color:' + (current.starred ? '#e0ad25' : '') + '"></i>';
  }

  var TL_ICONS = { note: 'fa-solid fa-comment', status: 'fa-solid fa-flag', assign: 'fa-solid fa-user', followup: 'fa-solid fa-bell', trash: 'fa-solid fa-trash-can', restore: 'fa-solid fa-rotate-left', created: 'fa-solid fa-paper-plane', whatsapp: 'fa-brands fa-whatsapp', email: 'fa-solid fa-envelope' };
  function timelineHtml() {
    var items = (current.activity || []).slice();
    var source = current.formType === 'contactus' ? 'the contact form' : current.formType === 'pas_finder' ? 'the ' + current.formLabel : 'a ' + current.formLabel.toLowerCase();
    items.push({ type: 'created', author: displayName(current), content: 'Submitted ' + source + (current.pageUrl ? ' on ' + pagePath(current.pageUrl) : ''), at: current.receivedAt });
    return items.map(function (a) {
      return '<li data-type="' + esc(a.type) + '"><span class="mhd-timeline__icon"><i class="' + (TL_ICONS[a.type] || 'fa-solid fa-circle') + '" aria-hidden="true"></i></span>' +
        '<div><div class="mhd-timeline__meta"><strong>' + esc(a.author || 'System') + '</strong> · <span title="' + esc(fmtDate(a.at, true)) + '">' + esc(fmtRelative(a.at)) + '</span></div>' +
        '<p class="mhd-timeline__text">' + esc(a.content) + '</p></div></li>';
    }).join('');
  }

  function pagePath(url) {
    try { var u = new URL(url); return (u.pathname.replace(/\/$/, '') || '/') ; } catch (e) { return url; }
  }

  /** WhatsApp group delivery state for the details list, with a (re)send button when not delivered. */
  function whatsappHtml(L) {
    if (L.whatsapp === 'sent') return '<span class="mhd-wa mhd-wa--sent"><i class="fa-solid fa-circle-check" aria-hidden="true"></i>Sent to group</span>';
    var label = L.whatsapp === 'failed' ? 'Delivery failed' : 'Not sent';
    return '<span class="mhd-wa' + (L.whatsapp === 'failed' ? ' mhd-wa--failed' : '') + '">' + label + '</span>' +
      '<button type="button" class="mhd-linkbtn" data-d="whatsapp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> ' + (L.whatsapp === 'failed' ? 'Retry now' : 'Send to group') + '</button>';
  }

  function detailRow(label, valueHtml) {
    return valueHtml ? '<dt>' + esc(label) + '</dt><dd>' + valueHtml + '</dd>' : '';
  }
  function copyBtn(value, label) {
    return '<button type="button" class="mhd-copy" data-copy="' + esc(value) + '" aria-label="Copy ' + esc(label) + '" title="Copy"><i class="fa-regular fa-copy" aria-hidden="true"></i></button>';
  }

  function renderDrawer() {
    var L = current;
    var name = displayName(L);
    var idx = -1;
    for (var i = 0; i < rows.length; i++) if (rows[i].id === L.id) idx = i;
    var sub = [L.company, L.service || L.formLabel].filter(Boolean).join(' · ');
    var first = L.firstName || (L.name || '').split(' ')[0] || '';
    var mailto = L.email ? 'mailto:' + encodeURIComponent(L.email).replace(/%40/g, '@') +
      '?subject=' + encodeURIComponent('Re: Your enquiry to Mahathi Infotech' + (L.service ? ' — ' + L.service : '')) +
      '&body=' + encodeURIComponent((first ? 'Hi ' + first + ',' : 'Hello,') + '\n\nThank you for contacting Mahathi Infotech.\n\n') : '';
    var tel = L.phone ? 'tel:' + L.phone.replace(/[^\d+]/g, '') : '';

    var statusOpts = Object.keys(C.statuses).map(function (k) { return '<option value="' + k + '"' + (k === L.status ? ' selected' : '') + '>' + esc(C.statuses[k]) + '</option>'; }).join('');
    var team = C.team.slice();
    if (L.assignedTo && !team.some(function (u) { return u.id === L.assignedTo; })) team.push({ id: L.assignedTo, name: L.assignee || 'Former user' });
    var ownerOpts = '<option value="0">Unassigned</option>' + team.map(function (u) {
      return '<option value="' + u.id + '"' + (u.id === L.assignedTo ? ' selected' : '') + '>' + esc(u.name) + (u.id === C.me ? ' (you)' : '') + '</option>';
    }).join('');

    var details =
      detailRow('Email', L.email ? '<a href="mailto:' + esc(L.email) + '">' + esc(L.email) + '</a>' + copyBtn(L.email, 'email') : '') +
      detailRow('Phone', L.phone ? '<a href="' + esc(tel) + '">' + esc(L.phone) + '</a>' + copyBtn(L.phone, 'phone number') : '') +
      detailRow('Company', esc(L.company)) +
      detailRow('Service', esc(L.service)) +
      detailRow('Received', esc(fmtDate(L.receivedAt, true))) +
      detailRow('Source page', L.pageUrl ? '<a href="' + esc(L.pageUrl) + '" target="_blank" rel="noopener noreferrer">' + esc(pagePath(L.pageUrl)) + '</a>' : '') +
      detailRow('Location', esc(L.location)) +
      detailRow('Device', esc(L.browser)) +
      detailRow('IP address', esc(L.ip)) +
      detailRow('Form', esc(L.formLabel)) +
      (C.whatsapp && ['contactus', 'pas_finder'].indexOf(L.formType) > -1 ? detailRow('WhatsApp', whatsappHtml(L)) : '') +
      (L.extra || []).map(function (x) { return detailRow(x.label, esc(x.value)); }).join('');

    el.drawer.innerHTML =
      '<div class="mhd-drawer__head">' +
        '<span class="mhd-avatar mhd-avatar--lg" data-tone="' + (L.id % 5) + '">' + esc(initials(name)) + '</span>' +
        '<div class="mhd-drawer__title"><h2>' + esc(name) + '</h2><p>' + esc(sub) + '</p></div>' +
        '<div class="mhd-drawer__tools">' +
          '<button type="button" class="mhd-iconbtn" data-d="star"></button>' +
          '<button type="button" class="mhd-iconbtn" data-d="prev" aria-label="Previous lead (K)"' + (idx <= 0 ? ' disabled' : '') + '><i class="fa-solid fa-chevron-up" aria-hidden="true"></i></button>' +
          '<button type="button" class="mhd-iconbtn" data-d="next" aria-label="Next lead (J)"' + (idx === -1 || idx >= rows.length - 1 ? ' disabled' : '') + '><i class="fa-solid fa-chevron-down" aria-hidden="true"></i></button>' +
          '<button type="button" class="mhd-iconbtn" data-d="close" aria-label="Close (Esc)"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>' +
        '</div>' +
      '</div>' +
      '<div class="mhd-drawer__body">' +
        '<div class="mhd-quick">' +
          (mailto ? '<a class="mhd-btn mhd-btn--primary mhd-btn--sm" href="' + esc(mailto) + '"><i class="fa-solid fa-reply" aria-hidden="true"></i>Reply by email</a>' : '') +
          (tel ? '<a class="mhd-btn mhd-btn--sm" href="' + esc(tel) + '"><i class="fa-solid fa-phone" aria-hidden="true"></i>Call</a>' : '') +
          '<button type="button" class="mhd-btn mhd-btn--sm" data-d="unread"><i class="fa-regular fa-envelope" aria-hidden="true"></i>Mark unread</button>' +
        '</div>' +
        '<div class="mhd-manage">' +
          '<label class="mhd-field"><span>Status</span><select class="mhd-select" data-d-field="lead_status">' + statusOpts + '</select></label>' +
          '<label class="mhd-field"><span>Owner</span><select class="mhd-select" data-d-field="assigned_to">' + ownerOpts + '</select></label>' +
          '<label class="mhd-field mhd-field--follow"><span>Follow-up</span><input type="datetime-local" class="mhd-input" data-d-field="follow_up" value="' + esc(L.followUpLocal || '') + '">' +
            (L.followUpLocal ? '<button type="button" class="mhd-linkbtn" data-d="clear-follow">Clear</button>' : '') + '</label>' +
        '</div>' +
        (L.message ? '<section class="mhd-section"><h3><i class="fa-regular fa-message" aria-hidden="true"></i>Message</h3><div class="mhd-message">' + esc(L.message) + '</div></section>' : '') +
        '<section class="mhd-section"><h3><i class="fa-regular fa-address-card" aria-hidden="true"></i>Details</h3><dl class="mhd-details">' + details + '</dl></section>' +
        '<section class="mhd-section"><h3><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i>Notes &amp; activity</h3>' +
          '<form class="mhd-note-form" data-d-note><label class="mhd-sr" for="mhd-note">Add a note</label><textarea id="mhd-note" class="mhd-textarea" maxlength="2000" placeholder="Add an internal note — call summary, next steps…"></textarea>' +
          '<div class="mhd-note-form__row"><span>Visible to your team only · Ctrl + Enter to save</span><button type="submit" class="mhd-btn mhd-btn--primary mhd-btn--sm">Add note</button></div></form>' +
          '<ul class="mhd-timeline" data-d-timeline>' + timelineHtml() + '</ul>' +
        '</section>' +
      '</div>' +
      '<div class="mhd-drawer__foot"><small>Lead #' + L.id + '</small>' +
        (L.trashed
          ? '<div style="display:flex;gap:8px"><button type="button" class="mhd-btn mhd-btn--sm" data-d="restore"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i>Restore</button><button type="button" class="mhd-btn mhd-btn--sm mhd-btn--danger" data-d="delete"><i class="fa-solid fa-trash" aria-hidden="true"></i>Delete forever</button></div>'
          : '<button type="button" class="mhd-btn mhd-btn--sm mhd-btn--danger" data-d="trash"><i class="fa-regular fa-trash-can" aria-hidden="true"></i>Move to trash</button>') +
      '</div>';
    renderDrawerHead();
  }

  /** Save one field from the drawer and refresh what depends on it. */
  function saveField(changes, okMessage) {
    var id = current.id;
    return update([id], changes).then(function (d) {
      if (!current || current.id !== id) return;
      if (d.lead) Object.assign(current, d.lead);
      if (d.activity) current.activity = d.activity;
      renderDrawer();
      if (okMessage) toast(okMessage);
      refreshAll();
    }).catch(function (e) { toast(e.message, 'error'); if (current && current.id === id) renderDrawer(); });
  }

  el.drawer.addEventListener('click', function (e) {
    var copy = e.target.closest('[data-copy]');
    if (copy) {
      var v = copy.getAttribute('data-copy');
      (navigator.clipboard ? navigator.clipboard.writeText(v) : Promise.reject()).then(function () { toast('Copied to clipboard'); }, function () { toast('Copy failed — select and copy manually', 'error'); });
      return;
    }
    var b = e.target.closest('[data-d]');
    if (!b) return;
    var act = b.getAttribute('data-d');
    if (act === 'close') return closeDrawer();
    if (!current) return;
    var id = current.id;
    if (act === 'prev') step(-1);
    else if (act === 'next') step(1);
    else if (act === 'star') toggleStar(id);
    else if (act === 'clear-follow') saveField({ follow_up: '' }, 'Follow-up cleared');
    else if (act === 'unread') update([id], { unread: '1' }).then(function () { toast('Marked as unread'); closeDrawer(); refreshAll(); }).catch(function (er) { toast(er.message, 'error'); });
    else if (act === 'trash') update([id], { trash: '1' }).then(function () {
      closeDrawer(); refreshAll();
      toast('Lead moved to trash', null, { label: 'Undo', run: function () { update([id], { restore: '1' }).then(function () { refreshAll(); }); } });
    }).catch(function (er) { toast(er.message, 'error'); });
    else if (act === 'restore') saveField({ restore: '1' }, 'Lead restored');
    else if (act === 'whatsapp') {
      b.disabled = true;
      api('whatsapp', { id: id }).then(function (d) {
        toast('Sent to the WhatsApp group');
        if (current && current.id === id) { Object.assign(current, d.lead); current.activity = d.activity; renderDrawer(); }
      }).catch(function (er) {
        toast(er.message, 'error');
        // Reload so the failure reason shows in the activity log.
        api('get', { id: id }).then(function (d) { if (current && current.id === id) { current = d.lead; renderDrawer(); } });
      });
    }
    else if (act === 'delete') {
      if (!window.confirm('Permanently delete this lead and its notes? This cannot be undone.')) return;
      api('delete', { ids: String(id) }).then(function () { closeDrawer(); refreshAll(); toast('Lead deleted permanently'); }).catch(function (er) { toast(er.message, 'error'); });
    }
  });

  el.drawer.addEventListener('change', function (e) {
    var f = e.target.closest('[data-d-field]');
    if (!f || !current) return;
    var key = f.getAttribute('data-d-field');
    var changes = {};
    changes[key] = f.value;
    var msg = key === 'lead_status' ? 'Status set to ' + statusLabel(f.value)
      : key === 'assigned_to' ? (f.value === '0' ? 'Lead unassigned' : 'Assigned to ' + f.options[f.selectedIndex].text.replace(' (you)', ''))
      : (f.value ? 'Follow-up scheduled' : 'Follow-up cleared');
    saveField(changes, msg);
  });

  el.drawer.addEventListener('submit', function (e) {
    var form = e.target.closest('[data-d-note]');
    if (!form || !current) return;
    e.preventDefault();
    var ta = $('textarea', form);
    var note = ta.value.trim();
    if (!note) { ta.focus(); return; }
    var btn = $('button[type="submit"]', form);
    btn.disabled = true;
    var id = current.id;
    api('note', { id: id, note: note }).then(function (d) {
      if (!current || current.id !== id) return;
      current.activity = [d.item].concat(current.activity || []);
      ta.value = '';
      $('[data-d-timeline]', el.drawer).innerHTML = timelineHtml();
      toast('Note added');
    }).catch(function (er) { toast(er.message, 'error'); }).then(function () { btn.disabled = false; });
  });
  el.drawer.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' && (e.ctrlKey || e.metaKey) && e.target.matches('.mhd-note-form textarea')) {
      e.preventDefault();
      e.target.form.requestSubmit ? e.target.form.requestSubmit() : e.target.form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
    }
    // Keep keyboard focus inside the open drawer.
    if (e.key === 'Tab') {
      var f = $$('a[href], button:not([disabled]), input, select, textarea', el.drawer);
      if (!f.length) return;
      if (e.shiftKey && document.activeElement === f[0]) { e.preventDefault(); f[f.length - 1].focus(); }
      else if (!e.shiftKey && document.activeElement === f[f.length - 1]) { e.preventDefault(); f[0].focus(); }
    }
  });
  el.scrim.addEventListener('click', closeDrawer);

  /* ------------------------------------------------------------------ list events */
  el.tbody.addEventListener('click', function (e) {
    var tr = e.target.closest('tr[data-id]');
    if (!tr) return;
    var id = parseInt(tr.getAttribute('data-id'), 10);
    if (e.target.closest('[data-mhd-select]')) {
      if (e.target.checked) selected.add(id); else selected.delete(id);
      tr.classList.toggle('is-selected', e.target.checked);
      renderBulk();
      el.checkAll.checked = rows.every(function (r) { return selected.has(r.id); });
      el.checkAll.indeterminate = !el.checkAll.checked && selected.size > 0;
      return;
    }
    if (e.target.closest('.mhd-col-check')) return;
    if (e.target.closest('[data-mhd-star]')) { toggleStar(id); return; }
    openLead(id);
  });
  el.tbody.addEventListener('keydown', function (e) {
    var tr = e.target.closest('tr[data-id]');
    if (tr && e.target === tr && (e.key === 'Enter' || e.key === ' ')) { e.preventDefault(); openLead(parseInt(tr.getAttribute('data-id'), 10)); }
  });
  el.checkAll.addEventListener('change', function () {
    rows.forEach(function (r) { if (el.checkAll.checked) selected.add(r.id); else selected.delete(r.id); });
    renderRows();
    renderBulk();
  });

  el.tabs.addEventListener('click', function (e) {
    var b = e.target.closest('[data-mhd-view]');
    if (!b) return;
    S.view = b.getAttribute('data-mhd-view');
    S.page = 1;
    selected.clear();
    loadList();
  });

  el.search.addEventListener('input', debounce(function () { S.search = el.search.value.trim(); S.page = 1; loadList(); }, 300));
  el.service.addEventListener('change', function () { S.service = el.service.value; S.page = 1; loadList(); });
  el.range.addEventListener('change', function () {
    S.range = el.range.value;
    el.custom.hidden = S.range !== 'custom';
    S.page = 1;
    if (S.range === 'custom') { el.from.focus(); if (!S.from && !S.to) return; }
    loadList();
  });
  [el.from, el.to].forEach(function (input) {
    input.addEventListener('change', function () { S.from = el.from.value; S.to = el.to.value; S.page = 1; loadList(); });
  });
  $$('[data-mhd-chip]').forEach(function (b) {
    b.addEventListener('click', function () { var k = b.getAttribute('data-mhd-chip'); S[k] = !S[k]; S.page = 1; loadList(); });
  });
  function resetFilters() {
    Object.assign(S, { view: 'all', search: '', service: '', range: '', from: '', to: '', unread: false, starred: false, followups: false, page: 1 });
    selected.clear();
    return refreshAll(false);
  }
  el.clear.addEventListener('click', function () {
    Object.assign(S, { search: '', service: '', range: '', from: '', to: '', unread: false, starred: false, followups: false, page: 1 });
    loadList();
  });
  document.addEventListener('click', function (e) {
    if (e.target.closest('[data-mhd-clear-empty]')) { el.clear.click(); }
  });

  $$('[data-mhd-sort]').forEach(function (b) {
    b.addEventListener('click', function () {
      var key = b.getAttribute('data-mhd-sort');
      if (S.sort === key) S.order = S.order === 'asc' ? 'desc' : 'asc';
      else { S.sort = key; S.order = key === 'received' ? 'desc' : 'asc'; }
      S.page = 1;
      loadList();
    });
  });
  el.per.addEventListener('change', function () { S.perPage = parseInt(el.per.value, 10); S.page = 1; loadList(); });
  $$('[data-mhd-page]').forEach(function (b) {
    b.addEventListener('click', function () { S.page = Math.min(pageCount, Math.max(1, S.page + parseInt(b.getAttribute('data-mhd-page'), 10))); loadList(); el.wrap.scrollIntoView({ block: 'nearest' }); });
  });

  $$('[data-mhd-bulk-action]').forEach(function (b) { b.addEventListener('click', function () { bulk(b.getAttribute('data-mhd-bulk-action')); }); });
  el.bulkStatus.addEventListener('change', function () {
    var v = el.bulkStatus.value;
    el.bulkStatus.value = '';
    if (!v) return;
    var ids = Array.from(selected);
    update(ids, { lead_status: v }).then(function () {
      toast(plural(ids.length, 'lead') + ' moved to ' + statusLabel(v));
      selected.clear();
      return refreshAll();
    }).catch(function (e) { toast(e.message, 'error'); });
  });

  $('[data-mhd-export]').addEventListener('click', function () { window.location.href = exportUrl(); });
  $('[data-mhd-refresh]').addEventListener('click', function (e) {
    var icon = $('i', e.currentTarget);
    icon.classList.add('fa-spin');
    refreshAll(false).then(function () { setTimeout(function () { icon.classList.remove('fa-spin'); }, 300); });
  });

  el.kpis.addEventListener('click', function (e) {
    var k = e.target.closest('[data-mhd-kpi]');
    if (!k) return;
    var a = k.getAttribute('data-mhd-kpi');
    Object.assign(S, { view: 'all', search: '', service: '', range: '', from: '', to: '', unread: false, starred: false, followups: false, page: 1 });
    if (a === 'unread') S.unread = true;
    else if (a === 'week') S.range = '7';
    else if (a === 'won') S.view = 'won';
    else if (a === 'followups') S.followups = true;
    selected.clear();
    loadList();
    $('.mhd-leads').scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
  el.services.addEventListener('click', function (e) {
    var b = e.target.closest('[data-mhd-service-pick]');
    if (!b) return;
    S.service = b.getAttribute('data-mhd-service-pick');
    S.page = 1;
    loadList();
    $('.mhd-leads').scrollIntoView({ behavior: 'smooth', block: 'start' });
  });

  // User menu
  var userBtn = $('[data-mhd-user]'), userMenu = $('[data-mhd-user-menu]');
  function setMenu(open) { userMenu.hidden = !open; userBtn.setAttribute('aria-expanded', open ? 'true' : 'false'); }
  userBtn.addEventListener('click', function (e) { e.stopPropagation(); setMenu(userMenu.hidden); });
  document.addEventListener('click', function (e) { if (!userMenu.hidden && !e.target.closest('.mhd-user')) setMenu(false); });

  // Keyboard shortcuts
  document.addEventListener('keydown', function (e) {
    var typing = e.target.closest && e.target.closest('input, textarea, select, [contenteditable]');
    if (e.key === 'Escape') {
      if (!userMenu.hidden) return setMenu(false);
      if (typing && e.target === el.search && el.search.value) { el.search.value = ''; S.search = ''; loadList(); return; }
      return closeDrawer();
    }
    if (typing || e.ctrlKey || e.metaKey || e.altKey) return;
    if (e.key === '/') { e.preventDefault(); closeDrawer(); el.search.focus(); el.search.select(); }
    else if (e.key === 'j' || e.key === 'J') { e.preventDefault(); step(1); }
    else if (e.key === 'k' || e.key === 'K') { e.preventDefault(); step(-1); }
  });

  window.addEventListener('resize', debounce(function () { if (lastSeries.length) renderTrend(lastSeries); }, 150));

  /* ------------------------------------------------------------------ live refresh */
  setInterval(function () {
    if (document.hidden) return;
    loadStats().then(function () {
      if (S.page === 1 && !selected.size) loadList({ silent: true });
    }).catch(function () {});
  }, 60000);
  document.addEventListener('visibilitychange', function () {
    if (!document.hidden) loadStats().catch(function () {});
  });

  /* ------------------------------------------------------------------ init */
  C.services.forEach(function (s) {
    var o = document.createElement('option');
    o.value = s; o.textContent = s;
    el.service.appendChild(o);
  });
  Object.keys(C.statuses).forEach(function (k) {
    var o = document.createElement('option');
    o.value = k; o.textContent = 'Move to ' + C.statuses[k];
    el.bulkStatus.appendChild(o);
  });

  var openId = readUrl();
  if (S.service && C.services.indexOf(S.service) === -1) {
    var o = document.createElement('option'); o.value = S.service; o.textContent = S.service; el.service.appendChild(o);
  }
  syncControls();
  renderSkeleton();
  loadStats().catch(function (e) { toast(e.message, 'error'); });
  loadList().then(function () { if (openId) openLead(openId); });
})();
