/* PAS Migration Problem Finder: page script (moved unchanged from the tool's index.html).
   Runs on /pas-migration-problem-finder; the API URL comes from <meta name="mh-api"> (see pages/pas-finder.php). */
(function(){
  'use strict';
  document.documentElement.lang = document.documentElement.lang || 'en';
  var E = window.MHEngine, M = window.MHEmail;
  var API = (document.querySelector('meta[name="mh-api"]') || {}).content || '';
  var KEY = 'mh-pas-finder-v1';
  var app = document.getElementById('app');
  var I = {
    check:'<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 8.5l3 3 6-7"/></svg>',
    arrow:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h12M11 5l5 5-5 5"/></svg>',
    back:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 10H4M9 5l-5 5 5 5"/></svg>',
    chev:'<svg class="chev" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 8l5 5 5-5"/></svg>',
    out:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M6.5 10h7M10.5 7l3 3-3 3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    mail:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="2.5" y="4.5" width="15" height="11" rx="1.5"/><path d="M3 5.5l7 5.5 7-5.5"/></svg>',
    info:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><circle cx="10" cy="10" r="7.5"/><path d="M10 9v5M10 6.5v.01"/></svg>',
    x:'<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15"/></svg>'
  };

  /* ---------- state ---------- */
  function fresh(){ return { step:1, sel:{}, lead:null, sentAt:null, preview:false }; }
  var S = fresh();
  try { var raw = localStorage.getItem(KEY); if (raw) { var d = JSON.parse(raw); if (d && d.sel) S = Object.assign(fresh(), d); } } catch(e){}
  if (S.step === 3 && !S.lead) S.step = 1;
  function save(){ try { localStorage.setItem(KEY, JSON.stringify(S)); } catch(e){} }
  function esc(s){ return String(s==null?'':s).replace(/[&<>"']/g,function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];}); }
  function R(){ return E.match(S.sel); }
  function track(evt, x){ try { window.dataLayer = window.dataLayer || []; window.dataLayer.push(Object.assign({ event: evt, tool:'pas_problem_finder' }, x || {})); } catch(e){} }
  function paint(html, focusSel){
    app.innerHTML = '<div class="fade">' + html + '</div>';
    window.scrollTo({ top: 0 });
    var f = focusSel && app.querySelector(focusSel); if (f) { f.setAttribute('tabindex','-1'); f.focus({ preventScroll:true }); }
  }
  function stepsNav(){
    var t = ['Select your problems','Your details','Your results'];
    return '<ol class="steps" aria-label="Progress">' + t.map(function(x, i){ var n = i+1, cur = n === S.step, done = n < S.step;
      return '<li' + (cur ? ' aria-current="step"' : '') + (done ? ' class="done"' : '') + '><span class="n">' + (done ? I.check : n) + '</span>' + x + '</li>'; }).join('') + '</ol>';
  }
  function hero(title, text){ return '<section class="hero"><div class="wrap"><span class="eyebrow">PAS Migration Problem Finder</span><h1 id="h1">' + title + '</h1><p>' + text + '</p>' + stepsNav() + '</div></section>'; }

  /* ---------- step 1: select problems ---------- */
  function step1(){
    var cards = E.AREAS.map(function(a, i){
      var n = a.problems.filter(function(p){ return S.sel[p.id]; }).length;
      return '<section class="card area" aria-labelledby="a' + i + '"><div class="area-h"><span class="leaf" aria-hidden="true">' + (i+1) + '</span><div><h2 id="a' + i + '">' + esc(a.name) + '</h2><small>' + esc(a.sub) + '</small></div><span class="cnt" id="cnt-' + a.id + '"' + (n ? '' : ' hidden') + '>' + n + ' selected</span></div>' +
        a.problems.map(function(p){
          var on = !!S.sel[p.id], lv = S.sel[p.id] || 'medium';
          return '<div class="prob' + (on ? ' on' : '') + '" id="row-' + p.id + '"><label class="chk" for="' + p.id + '"><input type="checkbox" id="' + p.id + '" data-p="' + p.id + '" data-a="' + a.id + '"' + (on ? ' checked' : '') + '><span>' + esc(p.text) + '</span></label>' +
            '<div class="imp" id="imp-' + p.id + '"' + (on ? '' : ' hidden') + '><span class="lbl" id="il-' + p.id + '">How much does this affect you?</span><span class="seg" role="radiogroup" aria-labelledby="il-' + p.id + '">' +
            ['low','medium','high'].map(function(v){ return '<label><input type="radio" name="imp-' + p.id + '" value="' + v + '"' + (lv === v ? ' checked' : '') + ' data-p="' + p.id + '"><span>' + E.IMPACT[v].label + '</span></label>'; }).join('') +
            '</span></div></div>';
        }).join('') + '</section>';
    }).join('');
    paint(
      hero('Where is your PAS migration most at risk?', 'Tick the problems your team faces today and tell us how much each one affects you. We will rank the seven core migration areas for your situation and show how Mahathi solves each one. It takes about two minutes.') +
      '<section class="sec"><div class="wrap"><div class="sec-h"><div><h2 class="sec-t">Select the problems you face</h2><p class="sec-s">Pick as many as apply, then set how much each one affects you.</p></div></div><div class="grid">' + cards + '</div></div></section>' +
      '<div class="actbar"><div class="wrap"><span class="sum" id="sum" aria-live="polite"></span><span class="r"><button class="link" type="button" id="clr">Clear all</button><button class="btn" type="button" id="next1">Continue' + I.arrow + '</button></span></div></div>', '#h1');
    app.querySelectorAll('input[type=checkbox][data-p]').forEach(function(cb){
      cb.addEventListener('change', function(){
        var id = cb.getAttribute('data-p');
        if (cb.checked) { var r0 = app.querySelector('input[name="imp-' + id + '"]:checked'); S.sel[id] = r0 ? r0.value : 'medium'; } else delete S.sel[id];
        document.getElementById('row-' + id).classList.toggle('on', cb.checked);
        document.getElementById('imp-' + id).hidden = !cb.checked;
        save(); refresh1();
      });
    });
    app.querySelectorAll('input[type=radio][data-p]').forEach(function(rd){
      rd.addEventListener('change', function(){ var id = rd.getAttribute('data-p'); if (S.sel[id]) { S.sel[id] = rd.value; save(); refresh1(); } });
    });
    document.getElementById('clr').onclick = function(){ S.sel = {}; save(); step1(); };
    document.getElementById('next1').onclick = function(){ if (R().selected) { S.step = 2; save(); track('tool_step', { step: 2 }); step2(); } };
    refresh1();
  }
  function refresh1(){
    var r = R(), areas = r.matched.length;
    document.getElementById('sum').innerHTML = r.selected ? '<b>' + r.selected + '</b> problem' + (r.selected===1?'':'s') + ' selected across <b>' + areas + '</b> area' + (areas===1?'':'s') : 'Select at least one problem to continue';
    document.getElementById('next1').disabled = !r.selected;
    document.getElementById('clr').hidden = !r.selected;
    E.AREAS.forEach(function(a){ var n = a.problems.filter(function(p){ return S.sel[p.id]; }).length, c = document.getElementById('cnt-' + a.id); if (c) { c.hidden = !n; c.textContent = n + ' selected'; } });
  }

  /* ---------- step 2: details (before results) ---------- */
  function step2(){
    var r = R();
    if (!r.selected) { S.step = 1; step1(); return; }
    var f = function(id, label, ac, type){ return '<div class="fld"><label for="' + id + '">' + label + ' <span class="req" aria-hidden="true">*</span></label><input class="inp" id="' + id + '" type="' + (type||'text') + '" autocomplete="' + ac + '" maxlength="120" aria-required="true"><span class="err" id="' + id + 'E" hidden></span></div>'; };
    paint(
      hero('Where should we send your results?', 'Your ranked results appear on the next screen, and we email you a copy to share with your team.') +
      '<section class="sec"><div class="wrap form-wrap">' +
        '<form class="card form" id="lf" novalidate aria-labelledby="h1">' +
          '<div class="g2">' + f('fn','First name','given-name') + f('ln','Last name','family-name') + '</div>' +
          '<div class="g2">' + f('em','Work email','email','email') + f('co','Company','organization') + '</div>' +
          '<div class="g2">' + f('jt','Job title','organization-title') +
            '<div class="fld"><label for="ot">Organization type <span class="req" aria-hidden="true">*</span></label><select class="inp" id="ot" aria-required="true"><option value="">Select</option>' + ['Insurance carrier','MGA','TPA','Program administrator','Other'].map(function(o){ return '<option>' + o + '</option>'; }).join('') + '</select><span class="err" id="otE" hidden></span></div></div>' +
          '<label class="consent" for="cs"><input type="checkbox" id="cs"><span>I agree that Mahathi Infotech may email me my results and contact me about them. I can unsubscribe at any time. <a href="https://mahathiinfotech.com/privacy-policy/" target="_blank" rel="noopener">Privacy policy</a></span></label>' +
          '<span class="err" id="csE" hidden></span><span class="err" id="sdE" role="alert" hidden></span>' +
          '<div class="acts"><button class="btn ghost" type="button" id="back2">' + I.back + 'Back</button><button class="btn" type="submit" id="send">See my results' + I.arrow + '</button></div>' +
        '</form>' +
        '<aside class="side" aria-label="Your selection"><h3>Your selection</h3><ul>' +
          r.matched.map(function(a){ return '<li><span>' + esc(a.name) + '</span><span class="tag t-' + a.fit.key + '">' + a.hits.length + ' of 2</span></li>'; }).join('') +
        '</ul><p>' + r.selected + ' problem' + (r.selected===1?'':'s') + ' selected. Your results rank these areas and show how Mahathi solves each one, the accelerators we use and the results seen on Mahathi engagements.</p></aside>' +
      '</div></section>', '#h1');
    document.getElementById('back2').onclick = function(){ S.step = 1; save(); step1(); };
    document.getElementById('lf').addEventListener('submit', function(ev){ ev.preventDefault(); submit(); });
  }
  function val(id){ var el = document.getElementById(id); return el ? el.value.trim() : ''; }
  function err(id, msg){
    var e = document.getElementById(id + 'E'), el = document.getElementById(id);
    e.textContent = msg; e.hidden = !msg;
    if (el && el.type !== 'checkbox') { el.setAttribute('aria-invalid', msg ? 'true' : 'false'); if (msg) el.setAttribute('aria-describedby', id + 'E'); else el.removeAttribute('aria-describedby'); }
    return !msg;
  }
  function submit(){
    var L = { firstName: val('fn'), lastName: val('ln'), email: val('em'), company: val('co'), title: val('jt'), orgType: val('ot') };
    var ok = [
      err('fn', L.firstName ? '' : 'Enter your first name.'),
      err('ln', L.lastName ? '' : 'Enter your last name.'),
      err('em', !L.email ? 'Enter your work email.' : /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(L.email) ? '' : 'Enter a valid email, for example name@company.com.'),
      err('co', L.company ? '' : 'Enter your company name.'),
      err('jt', L.title ? '' : 'Enter your job title.'),
      err('ot', L.orgType ? '' : 'Select your organization type.'),
      err('cs', document.getElementById('cs').checked ? '' : 'Please tick this box so we can send your results.')
    ];
    if (ok.indexOf(false) >= 0) { (app.querySelector('[aria-invalid="true"]') || document.getElementById('cs')).focus(); return; }
    var btn = document.getElementById('send'); btn.disabled = true; btn.textContent = 'Preparing your results\u2026';
    var r = R();
    var done = function(pv){ S.lead = L; S.preview = pv; S.sentAt = new Date().toISOString(); S.step = 3; save(); track('generate_lead', { exposure: r.exposure, band: r.band.key, problems: r.selected }); step3(); };
    if (!API) { setTimeout(function(){ done(true); }, 500); return; }
    fetch(API, { method:'POST', headers:{ 'Content-Type':'application/json' }, body: JSON.stringify({ lead: L, consent: true, selections: S.sel, page: location.href.split('#')[0], utm: utm() }) })
      .then(function(res){ return res.json().catch(function(){ return {}; }).then(function(j){ if (!res.ok) throw new Error(j.error || 'We could not prepare your results.'); return j; }); })
      .then(function(){ done(false); })
      .catch(function(e){ err('sd', e.message + ' Please try again.'); btn.disabled = false; btn.innerHTML = 'See my results' + I.arrow; });
  }
  function utm(){ var o = {}; try { var q = new URLSearchParams(location.search); ['utm_source','utm_medium','utm_campaign','utm_term','utm_content'].forEach(function(k){ if (q.get(k)) o[k] = q.get(k); }); } catch(e){} return o; }

  /* ---------- step 3: results ---------- */
  function areaHead(a, collapsible){
    return '<span class="leaf" aria-hidden="true">' + a.rank + '</span><div><h3>' + esc(a.name) + '</h3><small>' + esc(a.sub) + '</small></div>' +
      '<div class="m"><span class="pct tnum">' + a.score + '%</span><span class="tag t-' + a.fit.key + '">' + a.fit.label + '</span>' + (a.regulatory ? '<span class="tag t-reg">Regulatory</span>' : '') + '</div>' +
      (collapsible ? '<span class="cv">' + I.chev + '</span>' : '') +
      '<div class="meter" aria-hidden="true"><i style="width:' + a.score + '%"></i></div>';
  }
  function areaBody(a){
    return '<div class="ra-b">' +
      '<div><h4>Problems you flagged</h4><ul>' + a.hits.map(function(h){ return '<li><span>' + esc(h.text) + '</span><span class="tag t-' + h.impact + '">' + h.impactLabel + '</span></li>'; }).join('') + '</ul></div>' +
      '<div><h4>How Mahathi solves it</h4><ul class="bul">' + a.approach.map(function(x){ return '<li><span>' + esc(x) + '</span></li>'; }).join('') + '</ul></div>' +
      '<div><h4>Ready-to-deploy accelerators</h4><div class="chips">' + a.accelerators.map(function(x){ return '<span class="chip">' + esc(x) + '</span>'; }).join('') + '</div></div>' +
      '<div><h4>Results on Mahathi engagements</h4><div class="out">' + a.outcomes.map(function(x){ return '<div>' + I.out + '<span>' + esc(x) + '</span></div>'; }).join('') + '</div></div>' +
      '<div style="grid-column:1 / -1"><div class="cost"><p>Average engagement cost for this area: <b>' + esc(a.cost) + '</b></p><p class="why"><b>Why it is priced per ' + esc(a.costUnit) + ':</b> ' + esc(a.costDriver) + '</p><p class="src">Source: Mahathi\u2019s average cost across past engagements. Indicative only; final scope and price are set after discovery.</p></div></div>' +
      '</div>';
  }
  function step3(){
    var r = R(), L = S.lead;
    if (!L || !r.selected) { S.step = 1; step1(); return; }
    var top = r.matched[0], unflagged = r.ranked.filter(function(a){ return a.score === 0; });
    var html =
      '<section class="band"><div class="wrap">' +
        '<div class="scorebox" role="img" aria-label="Migration risk score ' + r.exposure + ' out of 100, ' + r.band.label + '"><span class="l">Migration risk score</span><span class="v tnum">' + r.exposure + '<small>/100</small></span><span class="tag b-' + r.band.key + '">' + r.band.label + '</span></div>' +
        '<div><span class="eyebrow">Your results, ' + esc(L.firstName) + '</span><h1 id="h1">Your top risk area is ' + esc(top.name) + '</h1>' +
        '<p>' + esc(r.band.note) + (r.floorNote ? ' ' + esc(r.floorNote) : '') + ' A copy of these results has been sent to <b>' + esc(L.email) + '</b>.</p>' +
        '<div class="facts"><span><b class="tnum">' + r.selected + '</b> problem' + (r.selected===1?'':'s') + ' selected</span><span><b class="tnum">' + r.highImpact + '</b> rated high impact</span><span><b class="tnum">' + r.matched.length + '</b> of 7 areas affected</span></div></div>' +
      '</div></section>' +
      '<section class="sec"><div class="wrap">' +
        '<div class="sec-h"><div><h2 class="sec-t">Your areas, ranked</h2><p class="sec-s">Ranked by how strongly each area matches the problems you selected and how much they affect you.</p></div>' +
        (S.preview ? '<button class="btn ghost sm" type="button" id="pv">' + I.mail + 'View the email we sent</button>' : '') + '</div>' +
        '<div class="rlist">' + r.matched.map(function(a, i){
          return i < 3
            ? '<article class="card ra top" aria-labelledby="ra' + a.rank + '"><div class="ra-h" id="ra' + a.rank + '">' + areaHead(a, false) + '</div>' + areaBody(a) + '</article>'
            : '<details class="card ra more"><summary class="ra-h">' + areaHead(a, true) + '</summary>' + areaBody(a) + '</details>';
        }).join('') + '</div>' +
        (unflagged.length ? '<div class="unflag"><span>Areas you did not flag:</span>' + unflagged.map(function(a){ return '<span class="c">' + esc(a.name) + '</span>'; }).join('') + '</div>' : '') +
        '<div class="notice">' + I.info + '<span>How the score works: each problem counts 1 point for low impact, 2 for medium and 3 for high. An area\u2019s priority is its points out of 6. The migration risk score is your total points out of 42, the most possible across all 14 problems. A single high-impact problem is never averaged away: a high-impact regulatory problem sets the result to at least High, and any other high-impact problem sets it to at least Moderate. Costs are Mahathi\u2019s average engagement costs per unit, not a quote.</span></div>' +
      '</div></section>' +
      '<section class="cta"><div class="wrap"><div><h2>Talk to our PAS migration team</h2><p>Walk through your results with a Mahathi specialist and get a practical plan for your top areas.</p></div>' +
        '<div class="r"><a class="btn" href="https://mahathiinfotech.com/contact-us" target="_blank" rel="noopener">Book a 30-minute call' + I.arrow + '</a><button class="link" type="button" id="again">Start a new assessment</button></div></div></section>';
    paint(html, '#h1');
    document.getElementById('again').onclick = function(){ S = fresh(); save(); step1(); };
    var pv = document.getElementById('pv'); if (pv) pv.onclick = preview;
    track('tool_result_view', { exposure: r.exposure });
  }

  /* ---------- email preview (prototype only) ---------- */
  var lastFocus = null;
  function closeM(){ document.getElementById('modalRoot').innerHTML = ''; document.body.style.overflow = ''; if (lastFocus) lastFocus.focus(); }
  function preview(){
    lastFocus = document.activeElement;
    var mail = M.build({ lead: S.lead, result: R(), logoUrl: 'logo.png' });
    document.getElementById('modalRoot').innerHTML = '<div class="ov" data-x></div><div class="modal" role="dialog" aria-modal="true" aria-labelledby="mT"><div class="mh"><h2 id="mT">Email sent to ' + esc(S.lead.email) + '</h2><button class="x" type="button" data-x aria-label="Close">' + I.x + '</button></div>' +
      '<div class="mmeta"><b>Subject:</b> ' + esc(mail.subject) + '<br>Prototype: no email is sent from this preview. This is exactly what the person receives.</div><div class="mb">' + mail.html.replace(/^[\s\S]*?<body[^>]*>/i,'').replace(/<\/body>[\s\S]*$/i,'') + '</div></div>';
    document.body.style.overflow = 'hidden';
    document.querySelectorAll('[data-x]').forEach(function(b){ b.onclick = closeM; });
    document.querySelector('.modal .x').focus();
  }
  document.addEventListener('keydown', function(ev){
    var m = document.querySelector('.modal'); if (!m) return;
    if (ev.key === 'Escape') { closeM(); return; }
    if (ev.key === 'Tab') { var f = m.querySelectorAll('button,a[href]'); var a = f[0], z = f[f.length-1]; if (ev.shiftKey && document.activeElement === a) { ev.preventDefault(); z.focus(); } else if (!ev.shiftKey && document.activeElement === z) { ev.preventDefault(); a.focus(); } }
  });

  track('tool_view');
  if (S.step === 3) step3(); else if (S.step === 2) step2(); else step1();
})();
