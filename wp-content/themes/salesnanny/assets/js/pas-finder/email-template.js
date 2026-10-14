/* Results email for the PAS Migration Problem Finder (HTML + plain text).
   Styled like mahathiinfotech.com: white, sage headings, rounded cards. Table layout and inline styles for email clients.
   Used by the server to send and by the page to preview. */
(function (root, factory) {
  if (typeof module === 'object' && module.exports) module.exports = factory();
  else root.MHEmail = factory();
})(typeof self !== 'undefined' ? self : this, function () {
  'use strict';

  var F = "font-family:Poppins,'Segoe UI',Helvetica,Arial,sans-serif;";
  var C = { ink: '#222222', ink2: '#444444', ink3: '#595959', title: '#302D42', sage: '#547852', sageTxt: '#4F6149', sageBg: '#EEF2EC', tint: '#EEF2EC', line: '#DEE2E6', bg: '#F4F4F2' };
  var TAG = { high: ['#8F3E4F', '#F6EBED'], medium: ['#3E4655', '#E5E5F0'], low: ['#4F6149', '#EEF2EC'], critical: ['#FFFFFF', '#8F3E4F'], moderate: ['#3E4655', '#E5E5F0'], strong: ['#8F3E4F', '#F6EBED'], good: ['#3E4655', '#E5E5F0'], partial: ['#4F6149', '#EEF2EC'] };
  var BANDTAG = { critical: TAG.critical, high: ['#8F3E4F', '#F6EBED'], moderate: TAG.moderate, low: TAG.low };

  function esc(s) { return String(s == null ? '' : s).replace(/[&<>"']/g, function (ch) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[ch]; }); }
  function tag(t, key, map) { var c = (map || TAG)[key]; return '<span style="' + F + 'display:inline-block;padding:2px 10px;border-radius:12px;font-size:12px;font-weight:600;color:' + c[0] + ';background:' + c[1] + ';white-space:nowrap;">' + t + '</span>'; }
  function p(t, x) { return '<p style="' + F + 'font-size:14px;line-height:1.6;color:' + C.ink2 + ';margin:0 0 12px;' + (x || '') + '">' + t + '</p>'; }
  function h(t) { return '<p style="' + F + 'font-size:20px;font-weight:400;text-transform:uppercase;color:' + C.title + ';margin:28px 0 12px;">' + t + '</p>'; }

  /* opts: { lead:{firstName}, result (MHEngine.match), ctaUrl, logoUrl, showCost } */
  function build(opts) {
    var r = opts.result, lead = opts.lead || {};
    var cta = opts.ctaUrl || 'https://mahathiinfotech.com/contact-us';
    var showCost = opts.showCost !== false;
    var top = r.matched[0];

    var areaBlock = function (a) {
      var hits = a.hits.map(function (x) { return '<tr><td style="' + F + 'font-size:13px;color:' + C.ink + ';padding:3px 0;">' + esc(x.text) + '</td><td align="right" style="padding:3px 0 3px 8px;">' + tag(x.impactLabel, x.impact) + '</td></tr>'; }).join('');
      return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 14px;background:#FFFFFF;border:1px solid ' + C.line + ';border-radius:12px;"><tr><td style="padding:16px 18px;">' +
        '<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr>' +
        '<td width="44" valign="top"><div style="' + F + 'width:36px;height:36px;line-height:36px;text-align:center;border-radius:0 30%;background:' + (a.rank <= 3 ? C.sage : C.sageBg) + ';color:' + (a.rank <= 3 ? '#FFFFFF' : C.sageTxt) + ';font-weight:600;font-size:15px;">' + a.rank + '</div></td>' +
        '<td valign="top"><div style="' + F + 'font-size:16px;font-weight:600;color:' + C.sageTxt + ';">' + esc(a.name) + '</div><div style="' + F + 'font-size:12px;color:' + C.ink3 + ';">' + esc(a.sub) + '</div></td>' +
        '<td align="right" valign="top" style="white-space:nowrap;"><div style="' + F + 'font-size:20px;font-weight:600;color:' + C.title + ';">' + a.score + '%</div>' + tag(a.fit.label, a.fit.key) + '</td></tr></table>' +
        '<div style="' + F + 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:' + C.ink3 + ';margin:14px 0 4px;">Problems you flagged</div>' +
        '<table role="presentation" width="100%" cellpadding="0" cellspacing="0">' + hits + '</table>' +
        '<div style="' + F + 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:' + C.ink3 + ';margin:14px 0 4px;">How Mahathi solves it</div>' +
        a.approach.map(function (x) { return '<div style="' + F + 'font-size:13px;line-height:1.5;color:' + C.ink + ';margin:0 0 4px;">&bull;&nbsp; ' + esc(x) + '</div>'; }).join('') +
        '<div style="' + F + 'font-size:13px;color:' + C.ink + ';margin-top:10px;"><b>Accelerators:</b> ' + esc(a.accelerators.join(', ')) + '</div>' +
        '<div style="' + F + 'font-size:13px;color:' + C.sageTxt + ';margin-top:6px;"><b>Results on Mahathi engagements:</b> ' + esc(a.outcomes.join('; ')) + '</div>' +
        (showCost ? '<div style="' + F + 'font-size:12px;line-height:1.5;color:' + C.ink3 + ';margin-top:10px;background:' + C.bg + ';padding:8px 10px;border-radius:6px;">Average engagement cost: <b style="color:' + C.ink + ';">' + esc(a.cost) + '</b><br>Why it is priced per ' + esc(a.costUnit) + ': ' + esc(a.costDriver) + '</div>' : '') +
        '</td></tr></table>';
    };

    var html = '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Your PAS Migration Problem Finder results</title></head>' +
      '<body style="margin:0;padding:0;background:' + C.bg + ';">' +
      '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:' + C.bg + ';"><tr><td align="center" style="padding:24px 12px;">' +
      '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background:#FFFFFF;">' +
      '<tr><td style="height:6px;line-height:6px;font-size:0;background:#76A379;">&nbsp;</td></tr>' +
      '<tr><td style="padding:18px 24px;border-bottom:1px solid ' + C.line + ';">' + (opts.logoUrl ? '<img src="' + esc(opts.logoUrl) + '" width="130" alt="Mahathi Infotech" style="display:block;border:0;">' : '<span style="' + F + 'font-size:18px;color:' + C.sageTxt + ';">mahathi</span>') + '</td></tr>' +
      '<tr><td style="padding:24px 24px 8px;background:' + C.tint + ';">' +
        '<div style="' + F + 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:' + C.sageTxt + ';">PAS Migration Problem Finder</div>' +
        '<div style="' + F + 'font-size:22px;font-weight:400;text-transform:uppercase;color:' + C.title + ';margin:6px 0 14px;line-height:1.3;">Your top risk area is ' + esc(top.name) + '</div>' +
        '<table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 0 16px;"><tr>' +
          '<td style="background:#FFFFFF;border-radius:0 30%;padding:16px 26px;text-align:center;"><div style="' + F + 'font-size:11px;text-transform:uppercase;letter-spacing:1px;color:' + C.ink3 + ';">Migration risk score</div><div style="' + F + 'font-size:36px;font-weight:600;color:' + C.title + ';line-height:1.1;">' + r.exposure + '<span style="font-size:14px;font-weight:400;color:' + C.ink3 + ';">/100</span></div>' + tag(r.band.label, r.band.key, BANDTAG) + '</td>' +
          '<td style="padding-left:18px;' + F + 'font-size:13px;color:' + C.ink2 + ';line-height:1.8;">' + r.selected + ' problems selected<br>' + r.highImpact + ' rated high impact<br>' + r.matched.length + ' of 7 areas affected</td>' +
        '</tr></table></td></tr>' +
      '<tr><td style="padding:20px 24px 8px;">' +
        p('Hi ' + esc(lead.firstName || 'there') + ',') +
        p('Thank you for using the PAS Migration Problem Finder. Based on the problems you selected, here is how the seven core migration areas rank for your team, and how Mahathi approaches each one.') +
        p(esc(r.band.note) + (r.floorNote ? ' ' + esc(r.floorNote) : '')) +
        h('Your areas, ranked') + r.matched.map(areaBlock).join('') +
        (r.ranked.length > r.matched.length ? p('Areas you did not flag: ' + esc(r.ranked.filter(function (a) { return !a.score; }).map(function (a) { return a.name; }).join(', ')) + '.', 'font-size:13px;color:' + C.ink3 + ';') : '') +
        h('Next step') +
        p('Our PAS migration team can walk through these results with you in a 30-minute call and outline a practical plan for your top areas.') +
        '<table role="presentation" cellpadding="0" cellspacing="0" style="margin:4px 0 20px;"><tr><td style="background:' + C.sage + ';border-radius:24px;"><a href="' + esc(cta) + '" style="' + F + 'display:inline-block;padding:12px 26px;font-size:14px;font-weight:600;color:#FFFFFF;text-decoration:none;">Book a 30-minute call</a></td></tr></table>' +
        p('Regards,<br>PAS Migration Team, Mahathi Infotech') +
      '</td></tr>' +
      '<tr><td style="padding:16px 24px;border-top:1px solid ' + C.line + ';' + F + 'font-size:11px;line-height:1.6;color:' + C.ink3 + ';">' +
        'Mahathi Infotech LLC, 630 Freedom Business Center Dr, Floor 3, King of Prussia, PA 19406, USA. You received this email because you requested your results at mahathiinfotech.com. Scores are based only on the problems you selected. Outcomes are from past Mahathi engagements; results vary by program. Costs are Mahathi\u2019s average engagement costs per unit, indicative only; final scope and price are set after discovery.' +
      '</td></tr></table></td></tr></table></body></html>';

    var text = 'Hi ' + (lead.firstName || 'there') + ',\n\n' +
      'Thank you for using the PAS Migration Problem Finder.\n\n' +
      'Migration risk score: ' + r.exposure + '/100 (' + r.band.label + ')\n' + r.band.note + (r.floorNote ? ' ' + r.floorNote : '') + '\n' +
      'Problems selected: ' + r.selected + ' | High impact: ' + r.highImpact + ' | Areas affected: ' + r.matched.length + ' of 7\n\n' +
      'Your areas, ranked:\n\n' + r.matched.map(function (a) {
        return a.rank + '. ' + a.name + ' - ' + a.score + '% (' + a.fit.label + ')\n' +
          a.hits.map(function (x) { return '   - ' + x.text + ' [' + x.impactLabel + ']'; }).join('\n') + '\n' +
          '   How Mahathi solves it: ' + a.approach.join('; ') + '\n' +
          '   Accelerators: ' + a.accelerators.join(', ') + '\n' +
          '   Results on Mahathi engagements: ' + a.outcomes.join('; ') +
          (showCost ? '\n   Average engagement cost: ' + a.cost + ' (priced per ' + a.costUnit + ': ' + a.costDriver + ')' : '');
      }).join('\n\n') + '\n\n' +
      'Book a 30-minute call: ' + cta + '\n\nRegards,\nPAS Migration Team, Mahathi Infotech\n';

    return { subject: 'Your PAS migration results: top risk area is ' + top.name, html: html, text: text };
  }

  return { build: build };
});
