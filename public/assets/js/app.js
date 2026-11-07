/* ScholarDesk — prototype logic (login, registration, registrar approvals).
   Everything is stored in this browser's localStorage. This is for the demo only:
   in Laravel, replace it with real authentication and a database. */
(function () {
    // ---- Registrar account (change these if you need to) ----
    var REGISTRAR = { email: '2400725284@mubs.ac.ug', password: '12345678', name: 'Registrar', role: 'admin' };

    var APPS_KEY = 'sd_applications_v1', SESSION_KEY = 'sd_session_v1';
    var HOME = { student: 'student/dashboard.html', lecturer: 'lecturer/dashboard.html', admin: 'admin/dashboard.html' };
    var ROLE_LABEL = { student: 'Student', lecturer: 'Lecturer', admin: 'Registrar' };
    var html = document.documentElement;
    var ROOT = html.getAttribute('data-root') || '';

    // ---- storage helpers (fail safely) ----
    var canStore = (function () { try { localStorage.setItem('sd_t', '1'); localStorage.removeItem('sd_t'); return true; } catch (e) { return false; } })();
    function get(k, d) { try { var v = localStorage.getItem(k); return v ? JSON.parse(v) : d; } catch (e) { return d; } }
    function set(k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }

    var SEED = [
        { ref: 'APP-2026-04907', role: 'student', name: 'Patience Achan', email: 'patience.achan@gmail.com', password: '12345678', detail: 'Bachelor of Procurement & Logistics (BPLM)', extra: 'Weekend · Private', status: 'Pending', date: '2026-10-31' },
        { ref: 'APP-2026-04911', role: 'student', name: 'Hassan Kato', email: 'hassan.kato@gmail.com', password: '12345678', detail: 'Bachelor of Business Computing (BBC)', extra: 'Day · Government', status: 'Pending', date: '2026-10-31' },
        { ref: 'APP-2026-04913', role: 'lecturer', name: 'Dr. Florence Nabukenya', email: 'florence.nabukenya@gmail.com', password: '12345678', detail: 'Information Technology', extra: 'PhD · Full-time', status: 'Pending', date: '2026-10-30' },
        { ref: 'APP-2026-04915', role: 'student', name: 'Doreen Nantongo', email: 'doreen.nantongo@gmail.com', password: '12345678', detail: 'Bachelor of Information Technology (BIT)', extra: 'Evening · Private', status: 'Pending', date: '2026-10-30' },
        { ref: 'APP-2026-04918', role: 'lecturer', name: 'Mr. Denis Ocen', email: 'denis.ocen@gmail.com', password: '12345678', detail: 'Accounting', extra: 'Masters · Part-time', status: 'Pending', date: '2026-10-29' },
        { ref: 'APP-2026-04821', role: 'student', name: 'Sarah Nakato', email: 'sarah.nakato@gmail.com', password: '12345678', detail: 'Bachelor of Business Computing (BBC)', extra: 'Evening · Private', status: 'Approved', number: '2400714521', date: '2026-10-20' },
        { ref: 'APP-2026-04788', role: 'student', name: 'Samuel Kiggundu', email: 'samuel.kiggundu@gmail.com', password: '12345678', detail: 'Diploma in Computer Science (DCS)', extra: 'Day · Private', status: 'Rejected', date: '2026-10-18' }
    ];
    function apps() { var a = get(APPS_KEY, null); if (!a) { a = SEED.slice(); set(APPS_KEY, a); } return a; }
    function saveApps(a) { set(APPS_KEY, a); }
    function session() { return get(SESSION_KEY, null); }

    // ---- page guard: runs immediately, before the page shows ----
    var need = html.getAttribute('data-role');
    if (need && canStore) {
        var s = session();
        if (!s) { location.replace(ROOT + 'login.html'); return; }
        if (s.role !== need) { location.replace(ROOT + HOME[s.role]); return; }
    }

    function esc(t) { return String(t == null ? '' : t).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }
    function initials(n) { return n.replace(/^(Dr|Mr|Ms|Mrs|Prof|Assoc\. Prof)\.?\s+/i, '').split(/\s+/).map(function (p) { return p[0]; }).join('').slice(0, 2).toUpperCase(); }
    function showError(box, msg) { if (!box) return; box.querySelector('span').textContent = msg; box.hidden = false; }
    var BADGE = { Pending: 'bg-accent-50 text-accent-700', Approved: 'bg-brand-50 text-brand-700', Rejected: 'bg-red-50 text-red-600', Active: 'bg-brand-50 text-brand-700' };
    function badge(t) { return '<span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-full ' + (BADGE[t] || 'bg-slate-100 text-slate-600') + '">' + esc(t) + '</span>'; }
    function roleBadge(r) { return r === 'lecturer' ? '<span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-accent-50 text-accent-700">Lecturer</span>' : '<span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Student</span>'; }
    function avatar(n, tone) { return '<div class="w-9 h-9 rounded-full ' + (tone === 'accent' ? 'bg-accent-100 text-accent-700' : 'bg-brand-100 text-brand-800') + ' flex items-center justify-center text-xs font-bold shrink-0">' + esc(initials(n)) + '</div>'; }
    function icons() { if (window.lucide) lucide.createIcons(); }

    document.addEventListener('DOMContentLoaded', function () {
        var s = session();

        // ---- show signed-in user in header / sidebar ----
        if (s && need) {
            document.querySelectorAll('[data-u="name"]').forEach(function (el) { el.textContent = s.name; });
            document.querySelectorAll('[data-u="email"]').forEach(function (el) { el.textContent = s.email; });
            document.querySelectorAll('[data-u="initials"]').forEach(function (el) { el.textContent = initials(s.name); });
            var t = s.name.match(/^(Dr|Prof|Mr|Ms|Mrs)\.?\s+(.*)$/i);
            var first = t ? t[1] + '. ' + t[2].split(' ').slice(-1)[0] : s.name.split(' ')[0];
            document.querySelectorAll('[data-u="first"]').forEach(function (el) { el.textContent = first; });
            if (s.number) document.querySelectorAll('[data-u="number"]').forEach(function (el) { el.textContent = s.number; });
        }

        // ---- sign out ----
        document.querySelectorAll('[data-logout]').forEach(function (a) {
            a.addEventListener('click', function () { try { localStorage.removeItem(SESSION_KEY); } catch (e) {} });
        });

        // ---- login ----
        var lf = document.getElementById('login-form');
        if (lf) {
            var cur = session();
            lf.addEventListener('submit', function (e) {
                e.preventDefault();
                var err = document.getElementById('login-error'); err.hidden = true;
                var role = (lf.querySelector('input[name=role]:checked') || {}).value;
                var email = lf.email.value.trim().toLowerCase(), pw = lf.password.value;
                if (!email || !pw) return showError(err, 'Enter your email and password.');
                var user = null;
                if (email === REGISTRAR.email && pw === REGISTRAR.password) {
                    if (role !== 'admin') return showError(err, 'This is the Registrar account. Choose "Registrar" above.');
                    user = { name: REGISTRAR.name, email: REGISTRAR.email, role: 'admin' };
                } else {
                    var a = apps().filter(function (x) { return x.email.toLowerCase() === email; })[0];
                    if (!a || a.password !== pw) return showError(err, 'Wrong email or password.');
                    if (a.role !== role) return showError(err, 'This account is registered as a ' + ROLE_LABEL[a.role] + '. Choose "' + ROLE_LABEL[a.role] + '" above.');
                    if (a.status === 'Pending') return showError(err, 'Your registration is still waiting for the Registrar to approve it.');
                    if (a.status === 'Rejected') return showError(err, 'Your registration was not approved. Please contact the Registrar\'s office.');
                    user = { name: a.name, email: a.email, role: a.role, number: a.number };
                }
                set(SESSION_KEY, user);
                location.href = HOME[user.role];
            });
        }

        // ---- registration ----
        var rf = document.getElementById('register-form');
        if (rf) {
            var sync = function () {
                var r = rf.querySelector('input[name=account_type]:checked').value;
                rf.querySelectorAll('fieldset[data-for]').forEach(function (fs) {
                    var on = fs.getAttribute('data-for') === r; fs.disabled = !on; fs.style.display = on ? '' : 'none';
                });
            };
            rf.addEventListener('change', function (e) { if (e.target.name === 'account_type') sync(); });
            sync();
            rf.addEventListener('submit', function (e) {
                e.preventDefault();
                var err = document.getElementById('register-error'); err.hidden = true;
                var f = new FormData(rf), role = f.get('account_type');
                var email = String(f.get('email') || '').trim().toLowerCase();
                if (String(f.get('password')).length < 8) return showError(err, 'Password must be at least 8 characters.');
                if (f.get('password') !== f.get('password_confirmation')) return showError(err, 'The two passwords do not match.');
                if (email === REGISTRAR.email || apps().some(function (x) { return x.email.toLowerCase() === email; })) return showError(err, 'This email is already registered. Sign in instead.');
                var name = (f.get('first_name') + ' ' + f.get('last_name')).trim();
                if (role === 'lecturer') name = f.get('title') + ' ' + name;
                var a = {
                    ref: 'APP-2026-' + String(Math.floor(10000 + Math.random() * 89999)),
                    role: role, name: name, email: email, password: String(f.get('password')), phone: f.get('phone'),
                    detail: role === 'student' ? f.get('programme') : f.get('department'),
                    extra: role === 'student' ? f.get('study_mode') + ' · ' + f.get('sponsorship') : f.get('qualification') + ' · ' + f.get('employment'),
                    status: 'Pending', date: new Date().toISOString().slice(0, 10)
                };
                var list = apps(); list.unshift(a); saveApps(list);
                location.href = 'registration-success.html?ref=' + encodeURIComponent(a.ref) + '&role=' + role + '&name=' + encodeURIComponent(f.get('first_name'));
            });
        }

        // ---- registration success ----
        if (document.querySelector('[data-q="ref"]')) {
            var q = new URLSearchParams(location.search);
            if (q.get('ref')) document.querySelector('[data-q="ref"]').textContent = q.get('ref');
            if (q.get('name')) document.querySelector('[data-q="name"]').textContent = q.get('name');
            var r = q.get('role') === 'lecturer';
            document.querySelector('[data-q="role"]').textContent = r ? 'lecturer registration' : 'student registration';
            document.querySelector('[data-q="numlabel"]').textContent = r ? 'staff number' : 'student number';
        }

        // ---- registrar: applications ----
        var body = document.getElementById('apps-body');
        if (body) {
            var state = { status: 'Pending', role: 'all' };
            var render = function () {
                var list = apps();
                ['Pending', 'Approved', 'Rejected'].forEach(function (st) {
                    var el = document.querySelector('[data-count="' + st + '"]');
                    if (el) el.textContent = list.filter(function (x) { return x.status === st && (state.role === 'all' || x.role === state.role); }).length;
                });
                var rows = list.filter(function (x) { return x.status === state.status && (state.role === 'all' || x.role === state.role); });
                if (!rows.length) { body.innerHTML = '<tr><td colspan="6" class="py-12 text-center text-sm text-slate-400">No ' + state.status.toLowerCase() + ' registrations here.</td></tr>'; return; }
                body.innerHTML = rows.map(function (a) {
                    var act = a.status === 'Pending'
                        ? '<div class="flex justify-end gap-2"><button data-act="approve" data-ref="' + esc(a.ref) + '" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-brand-700 text-white hover:bg-brand-800">Approve</button><button data-act="reject" data-ref="' + esc(a.ref) + '" class="px-3 py-1.5 rounded-lg text-xs font-bold border border-slate-200 text-slate-600 hover:border-red-300 hover:text-red-600">Reject</button></div>'
                        : '<div class="text-right text-xs text-slate-500">' + (a.number ? '<span class="font-bold text-slate-800">' + esc(a.number) + '</span>' : '—') + '</div>';
                    return '<tr class="border-t border-slate-100 hover:bg-brand-50/40">' +
                        '<td class="py-3.5 px-4 text-sm"><div class="flex items-center gap-3">' + avatar(a.name, a.role === 'lecturer' ? 'accent' : 'brand') + '<div><p class="font-semibold">' + esc(a.name) + '</p><p class="text-xs text-slate-500">' + esc(a.email) + '</p></div></div></td>' +
                        '<td class="py-3.5 px-4 text-sm">' + roleBadge(a.role) + '</td>' +
                        '<td class="py-3.5 px-4 text-sm"><p>' + esc(a.detail) + '</p><p class="text-xs text-slate-500">' + esc(a.extra) + '</p></td>' +
                        '<td class="py-3.5 px-4 text-sm text-slate-500">' + esc(a.ref) + '<br><span class="text-xs">' + esc(a.date) + '</span></td>' +
                        '<td class="py-3.5 px-4 text-sm">' + badge(a.status) + '</td>' +
                        '<td class="py-3.5 px-4 text-sm">' + act + '</td></tr>';
                }).join('');
            };
            document.querySelectorAll('[data-status-tab]').forEach(function (t) {
                t.addEventListener('click', function () {
                    state.status = t.getAttribute('data-status-tab');
                    document.querySelectorAll('[data-status-tab]').forEach(function (o) {
                        var on = o === t;
                        o.className = 'px-4 py-2 rounded-xl text-sm font-semibold ' + (on ? 'bg-brand-700 text-white' : 'bg-white border border-slate-200 text-slate-600');
                    });
                    render();
                });
            });
            var rs = document.getElementById('role-filter');
            if (rs) rs.addEventListener('change', function () { state.role = rs.value; render(); });
            body.addEventListener('click', function (e) {
                var b = e.target.closest('[data-act]'); if (!b) return;
                var list = apps(), a = list.filter(function (x) { return x.ref === b.getAttribute('data-ref'); })[0]; if (!a) return;
                if (b.getAttribute('data-act') === 'approve') {
                    a.status = 'Approved';
                    a.number = a.role === 'student' ? '2600' + String(Math.floor(100000 + Math.random() * 899999)) : 'STF/' + String(Math.floor(1000 + Math.random() * 8999));
                } else { a.status = 'Rejected'; }
                saveApps(list); render();
                var toast = document.getElementById('toast');
                if (toast) { toast.querySelector('span').textContent = a.name + (a.status === 'Approved' ? ' approved · ' + a.number : ' rejected'); toast.hidden = false; clearTimeout(toast._t); toast._t = setTimeout(function () { toast.hidden = true; }, 3500); }
            });
            render();
        }

        // ---- registrar: pending counts + dashboard list ----
        var pending = apps().filter(function (x) { return x.status === 'Pending'; });
        document.querySelectorAll('[data-pending-count]').forEach(function (el) { el.textContent = pending.length; });
        var dash = document.getElementById('dash-apps');
        if (dash) {
            dash.innerHTML = pending.length ? pending.slice(0, 5).map(function (a) {
                return '<div class="flex items-center gap-3 py-3 border-t border-slate-100 first:border-t-0">' + avatar(a.name, a.role === 'lecturer' ? 'accent' : 'brand') +
                    '<div class="flex-1 min-w-0"><p class="text-sm font-semibold truncate">' + esc(a.name) + '</p><p class="text-xs text-slate-500 truncate">' + ROLE_LABEL[a.role] + ' · ' + esc(a.detail) + '</p></div>' +
                    '<a href="applications/index.html" class="text-xs font-bold text-brand-700 px-3 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100">Review</a></div>';
            }).join('') : '<p class="py-6 text-sm text-slate-400 text-center">No registrations waiting.</p>';
        }

        // ---- registrar: approved people appear in Students / Lecturers lists ----
        [['approved-students', 'student'], ['approved-lecturers', 'lecturer']].forEach(function (p) {
            var tb = document.getElementById(p[0]); if (!tb) return;
            var rows = apps().filter(function (x) { return x.role === p[1] && x.status === 'Approved' && x.ref !== 'APP-2026-04821'; });
            tb.insertAdjacentHTML('afterbegin', rows.map(function (a) {
                var who = '<div class="flex items-center gap-3">' + avatar(a.name, p[1] === 'lecturer' ? 'accent' : 'brand') + '<div><p class="font-semibold">' + esc(a.name) + ' <span class="ml-1 text-[10px] font-bold uppercase text-accent-600">new</span></p><p class="text-xs text-slate-500">' + esc(p[1] === 'student' ? a.number : a.email) + '</p></div></div>';
                var td = function (c, al) { return '<td class="py-3.5 px-4 text-sm' + (al ? ' text-' + al : '') + '">' + c + '</td>'; };
                return '<tr class="border-t border-slate-100 bg-accent-50/30">' + (p[1] === 'student'
                    ? td(who) + td(esc((a.detail.match(/\(([^)]+)\)/) || [0, a.detail])[1])) + td('Year 1') + td(esc(a.extra.split(' · ')[0])) + td(badge('Active')) + td('')
                    : td(who) + td(esc(a.detail)) + td('<span class="font-bold">0</span>', 'center') + td(badge('Active')) + td('')) + '</tr>';
            }).join(''));
        });

        icons();
    });
})();
