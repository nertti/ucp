//#region \0vite/modulepreload-polyfill.js
(function polyfill() {
	const relList = document.createElement("link").relList;
	if (relList && relList.supports && relList.supports("modulepreload")) return;
	for (const link of document.querySelectorAll("link[rel=\"modulepreload\"]")) processPreload(link);
	new MutationObserver((mutations) => {
		for (const mutation of mutations) {
			if (mutation.type !== "childList") continue;
			for (const node of mutation.addedNodes) if (node.tagName === "LINK" && node.rel === "modulepreload") processPreload(node);
		}
	}).observe(document, {
		childList: true,
		subtree: true
	});
	function getFetchOpts(link) {
		const fetchOpts = {};
		if (link.integrity) fetchOpts.integrity = link.integrity;
		if (link.referrerPolicy) fetchOpts.referrerPolicy = link.referrerPolicy;
		if (link.crossOrigin === "use-credentials") fetchOpts.credentials = "include";
		else if (link.crossOrigin === "anonymous") fetchOpts.credentials = "omit";
		else fetchOpts.credentials = "same-origin";
		return fetchOpts;
	}
	function processPreload(link) {
		if (link.ep) return;
		link.ep = true;
		const fetchOpts = getFetchOpts(link);
		fetch(link.href, fetchOpts);
	}
})();
//#endregion
//#region src/components/layout/iconify/iconify.min.js
(function() {
	"use strict";
	const t = Object.freeze({
		left: 0,
		top: 0,
		width: 16,
		height: 16
	}), e = Object.freeze({
		rotate: 0,
		vFlip: !1,
		hFlip: !1
	}), n = Object.freeze({
		...t,
		...e
	}), i = Object.freeze({
		...n,
		body: "",
		hidden: !1
	}), r = Object.freeze({
		width: null,
		height: null
	}), o = Object.freeze({
		...r,
		...e
	});
	const s = /[\s,]+/;
	const c = {
		...o,
		preserveAspectRatio: ""
	};
	function a(t) {
		const e = { ...c }, n = (e, n) => t.getAttribute(e) || n;
		var i;
		return e.width = n("width", null), e.height = n("height", null), e.rotate = function(t, e = 0) {
			const n = t.replace(/^-?[0-9.]*/, "");
			function i(t) {
				for (; t < 0;) t += 4;
				return t % 4;
			}
			if ("" === n) {
				const e = parseInt(t);
				return isNaN(e) ? 0 : i(e);
			}
			if (n !== t) {
				let e = 0;
				switch (n) {
					case "%":
						e = 25;
						break;
					case "deg": e = 90;
				}
				if (e) {
					let r = parseFloat(t.slice(0, t.length - n.length));
					return isNaN(r) ? 0 : (r /= e, r % 1 == 0 ? i(r) : 0);
				}
			}
			return e;
		}(n("rotate", "")), i = e, n("flip", "").split(s).forEach(((t) => {
			switch (t.trim()) {
				case "horizontal":
					i.hFlip = !0;
					break;
				case "vertical": i.vFlip = !0;
			}
		})), e.preserveAspectRatio = n("preserveAspectRatio", n("preserveaspectratio", "")), e;
	}
	const u = /^[a-z0-9]+(-[a-z0-9]+)*$/, l = (t, e, n, i = "") => {
		const r = t.split(":");
		if ("@" === t.slice(0, 1)) {
			if (r.length < 2 || r.length > 3) return null;
			i = r.shift().slice(1);
		}
		if (r.length > 3 || !r.length) return null;
		if (r.length > 1) {
			const t = r.pop(), n = r.pop(), o = {
				provider: r.length > 0 ? r[0] : i,
				prefix: n,
				name: t
			};
			return e && !f(o) ? null : o;
		}
		const o = r[0], s = o.split("-");
		if (s.length > 1) {
			const t = {
				provider: i,
				prefix: s.shift(),
				name: s.join("-")
			};
			return e && !f(t) ? null : t;
		}
		if (n && "" === i) {
			const t = {
				provider: i,
				prefix: "",
				name: o
			};
			return e && !f(t, n) ? null : t;
		}
		return null;
	}, f = (t, e) => !!t && !("" !== t.provider && !t.provider.match(u) || !(e && "" === t.prefix || t.prefix.match(u)) || !t.name.match(u));
	function d(t, n) {
		const r = function(t, e) {
			const n = {};
			!t.hFlip != !e.hFlip && (n.hFlip = !0), !t.vFlip != !e.vFlip && (n.vFlip = !0);
			const i = ((t.rotate || 0) + (e.rotate || 0)) % 4;
			return i && (n.rotate = i), n;
		}(t, n);
		for (const o in i) o in e ? o in t && !(o in r) && (r[o] = e[o]) : o in n ? r[o] = n[o] : o in t && (r[o] = t[o]);
		return r;
	}
	function h(t, e, n) {
		const i = t.icons, r = t.aliases || Object.create(null);
		let o = {};
		function s(t) {
			o = d(i[t] || r[t], o);
		}
		return s(e), n.forEach(s), d(t, o);
	}
	function p(t, e) {
		const n = [];
		if ("object" != typeof t || "object" != typeof t.icons) return n;
		t.not_found instanceof Array && t.not_found.forEach(((t) => {
			e(t, null), n.push(t);
		}));
		const i = function(t, e) {
			const n = t.icons, i = t.aliases || Object.create(null), r = Object.create(null);
			return (e || Object.keys(n).concat(Object.keys(i))).forEach((function t(e) {
				if (n[e]) return r[e] = [];
				if (!(e in r)) {
					r[e] = null;
					const n = i[e] && i[e].parent, o = n && t(n);
					o && (r[e] = [n].concat(o));
				}
				return r[e];
			})), r;
		}(t);
		for (const r in i) {
			const o = i[r];
			o && (e(r, h(t, r, o)), n.push(r));
		}
		return n;
	}
	const g = {
		provider: "",
		aliases: {},
		not_found: {},
		...t
	};
	function b(t, e) {
		for (const n in e) if (n in t && typeof t[n] != typeof e[n]) return !1;
		return !0;
	}
	function v(t) {
		if ("object" != typeof t || null === t) return null;
		const e = t;
		if ("string" != typeof e.prefix || !t.icons || "object" != typeof t.icons) return null;
		if (!b(t, g)) return null;
		const n = e.icons;
		for (const t in n) {
			const e = n[t];
			if (!t.match(u) || "string" != typeof e.body || !b(e, i)) return null;
		}
		const r = e.aliases || Object.create(null);
		for (const t in r) {
			const e = r[t], o = e.parent;
			if (!t.match(u) || "string" != typeof o || !n[o] && !r[o] || !b(e, i)) return null;
		}
		return e;
	}
	const m = Object.create(null);
	function y(t, e) {
		const n = m[t] || (m[t] = Object.create(null));
		return n[e] || (n[e] = function(t, e) {
			return {
				provider: t,
				prefix: e,
				icons: Object.create(null),
				missing: /* @__PURE__ */ new Set()
			};
		}(t, e));
	}
	function x(t, e) {
		return v(e) ? p(e, ((e, n) => {
			n ? t.icons[e] = n : t.missing.add(e);
		})) : [];
	}
	function w(t, e) {
		let n = [];
		return ("string" == typeof t ? [t] : Object.keys(m)).forEach(((t) => {
			("string" == typeof t && "string" == typeof e ? [e] : Object.keys(m[t] || {})).forEach(((e) => {
				const i = y(t, e);
				n = n.concat(Object.keys(i.icons).map(((n) => ("" !== t ? "@" + t + ":" : "") + e + ":" + n)));
			}));
		})), n;
	}
	let _ = !1;
	function k(t) {
		return "boolean" == typeof t && (_ = t), _;
	}
	function j(t) {
		const e = "string" == typeof t ? l(t, !0, _) : t;
		if (e) {
			const t = y(e.provider, e.prefix), n = e.name;
			return t.icons[n] || (t.missing.has(n) ? null : void 0);
		}
	}
	function A(t, e) {
		const n = l(t, !0, _);
		if (!n) return !1;
		return function(t, e, n) {
			try {
				if ("string" == typeof n.body) return t.icons[e] = { ...n }, !0;
			} catch (t) {}
			return !1;
		}(y(n.provider, n.prefix), n.name, e);
	}
	function O(t, e) {
		if ("object" != typeof t) return !1;
		if ("string" != typeof e && (e = t.provider || ""), _ && !e && !t.prefix) {
			let e = !1;
			return v(t) && (t.prefix = "", p(t, ((t, n) => {
				n && A(t, n) && (e = !0);
			}))), e;
		}
		const n = t.prefix;
		if (!f({
			provider: e,
			prefix: n,
			name: "a"
		})) return !1;
		return !!x(y(e, n), t);
	}
	function C(t) {
		return !!j(t);
	}
	function I(t) {
		const e = j(t);
		return e ? {
			...n,
			...e
		} : null;
	}
	function S(t, e) {
		t.forEach(((t) => {
			const n = t.loaderCallbacks;
			n && (t.loaderCallbacks = n.filter(((t) => t.id !== e)));
		}));
	}
	let E = 0;
	const M = Object.create(null);
	function T(t, e) {
		M[t] = e;
	}
	function F(t) {
		return M[t] || M[""];
	}
	var R = {
		resources: [],
		index: 0,
		timeout: 2e3,
		rotate: 750,
		random: !1,
		dataAfterTimeout: !1
	};
	function L(t, e, n, i) {
		const r = t.resources.length, o = t.random ? Math.floor(Math.random() * r) : t.index;
		let s;
		if (t.random) {
			let e = t.resources.slice(0);
			for (s = []; e.length > 1;) {
				const t = Math.floor(Math.random() * e.length);
				s.push(e[t]), e = e.slice(0, t).concat(e.slice(t + 1));
			}
			s = s.concat(e);
		} else s = t.resources.slice(o).concat(t.resources.slice(0, o));
		const c = Date.now();
		let a, u = "pending", l = 0, f = null, d = [], h = [];
		function p() {
			f && (clearTimeout(f), f = null);
		}
		function g() {
			"pending" === u && (u = "aborted"), p(), d.forEach(((t) => {
				"pending" === t.status && (t.status = "aborted");
			})), d = [];
		}
		function b(t, e) {
			e && (h = []), "function" == typeof t && h.push(t);
		}
		function v() {
			u = "failed", h.forEach(((t) => {
				t(void 0, a);
			}));
		}
		function m() {
			d.forEach(((t) => {
				"pending" === t.status && (t.status = "aborted");
			})), d = [];
		}
		function y() {
			if ("pending" !== u) return;
			p();
			const i = s.shift();
			if (void 0 === i) return d.length ? void (f = setTimeout((() => {
				p(), "pending" === u && (m(), v());
			}), t.timeout)) : void v();
			const r = {
				status: "pending",
				resource: i,
				callback: (e, n) => {
					(function(e, n, i) {
						const r = "success" !== n;
						switch (d = d.filter(((t) => t !== e)), u) {
							case "pending": break;
							case "failed":
								if (r || !t.dataAfterTimeout) return;
								break;
							default: return;
						}
						if ("abort" === n) return a = i, void v();
						if (r) return a = i, void (d.length || (s.length ? y() : v()));
						if (p(), m(), !t.random) {
							const n = t.resources.indexOf(e.resource);
							-1 !== n && n !== t.index && (t.index = n);
						}
						u = "completed", h.forEach(((t) => {
							t(i);
						}));
					})(r, e, n);
				}
			};
			d.push(r), l++, f = setTimeout(y, t.rotate), n(i, e, r.callback);
		}
		return "function" == typeof i && h.push(i), setTimeout(y), function() {
			return {
				startTime: c,
				payload: e,
				status: u,
				queriesSent: l,
				queriesPending: d.length,
				subscribe: b,
				abort: g
			};
		};
	}
	function P(t) {
		const e = {
			...R,
			...t
		};
		let n = [];
		function i() {
			n = n.filter(((t) => "pending" === t().status));
		}
		return {
			query: function(t, r, o) {
				const s = L(e, t, r, ((t, e) => {
					i(), o && o(t, e);
				}));
				return n.push(s), s;
			},
			find: function(t) {
				return n.find(((e) => t(e))) || null;
			},
			setIndex: (t) => {
				e.index = t;
			},
			getIndex: () => e.index,
			cleanup: i
		};
	}
	function N(t) {
		let e;
		if ("string" == typeof t.resources) e = [t.resources];
		else if (e = t.resources, !(e instanceof Array && e.length)) return null;
		return {
			resources: e,
			path: t.path || "/",
			maxURL: t.maxURL || 500,
			rotate: t.rotate || 750,
			timeout: t.timeout || 5e3,
			random: !0 === t.random,
			index: t.index || 0,
			dataAfterTimeout: !1 !== t.dataAfterTimeout
		};
	}
	const z = Object.create(null), Q = ["https://api.simplesvg.com", "https://api.unisvg.com"], q = [];
	for (; Q.length > 0;) 1 === Q.length || Math.random() > .5 ? q.push(Q.shift()) : q.push(Q.pop());
	function D(t, e) {
		const n = N(e);
		return null !== n && (z[t] = n, !0);
	}
	function U(t) {
		return z[t];
	}
	function H() {
		return Object.keys(z);
	}
	function J() {}
	z[""] = N({ resources: ["https://api.iconify.design"].concat(q) });
	const $ = Object.create(null);
	function B(t, e, n) {
		let i, r;
		if ("string" == typeof t) {
			const e = F(t);
			if (!e) return n(void 0, 424), J;
			r = e.send;
			const o = function(t) {
				if (!$[t]) {
					const e = U(t);
					if (!e) return;
					const n = {
						config: e,
						redundancy: P(e)
					};
					$[t] = n;
				}
				return $[t];
			}(t);
			o && (i = o.redundancy);
		} else {
			const e = N(t);
			if (e) {
				i = P(e);
				const n = F(t.resources ? t.resources[0] : "");
				n && (r = n.send);
			}
		}
		return i && r ? i.query(e, r, n)().abort : (n(void 0, 424), J);
	}
	const G = "iconify2", V = "iconify", K = V + "-count", W = V + "-version", X = 36e5, Y = 168, Z = 50;
	function tt(t, e) {
		try {
			return t.getItem(e);
		} catch (t) {}
	}
	function et(t, e, n) {
		try {
			return t.setItem(e, n), !0;
		} catch (t) {}
	}
	function nt(t, e) {
		try {
			t.removeItem(e);
		} catch (t) {}
	}
	function it(t, e) {
		return et(t, K, e.toString());
	}
	function rt(t) {
		return parseInt(tt(t, K)) || 0;
	}
	const ot = {
		local: !0,
		session: !0
	}, st = {
		local: /* @__PURE__ */ new Set(),
		session: /* @__PURE__ */ new Set()
	};
	let ct = !1;
	let at = "undefined" == typeof window ? {} : window;
	function ut(t) {
		const e = t + "Storage";
		try {
			if (at && at[e] && "number" == typeof at[e].length) return at[e];
		} catch (t) {}
		ot[t] = !1;
	}
	function lt(t, e) {
		const n = ut(t);
		if (!n) return;
		const i = tt(n, W);
		if (i !== G) {
			if (i) {
				const t = rt(n);
				for (let e = 0; e < t; e++) nt(n, V + e.toString());
			}
			et(n, W, G), it(n, 0);
			return;
		}
		const r = Math.floor(Date.now() / X) - Y, o = (t) => {
			const i = V + t.toString(), o = tt(n, i);
			if ("string" == typeof o) {
				try {
					const n = JSON.parse(o);
					if ("object" == typeof n && "number" == typeof n.cached && n.cached > r && "string" == typeof n.provider && "object" == typeof n.data && "string" == typeof n.data.prefix && e(n, t)) return !0;
				} catch (t) {}
				nt(n, i);
			}
		};
		let s = rt(n);
		for (let e = s - 1; e >= 0; e--) o(e) || (e === s - 1 ? (s--, it(n, s)) : st[t].add(e));
	}
	function ft() {
		if (!ct) {
			ct = !0;
			for (const t in ot) lt(t, ((t) => {
				const e = t.data, n = y(t.provider, e.prefix);
				if (!x(n, e).length) return !1;
				const i = e.lastModified || -1;
				return n.lastModifiedCached = n.lastModifiedCached ? Math.min(n.lastModifiedCached, i) : i, !0;
			}));
		}
	}
	function dt(t, e) {
		function n(n) {
			let i;
			if (!ot[n] || !(i = ut(n))) return;
			const r = st[n];
			let o;
			if (r.size) r.delete(o = Array.from(r).shift());
			else if (o = rt(i), o >= Z || !it(i, o + 1)) return;
			const s = {
				cached: Math.floor(Date.now() / X),
				provider: t.provider,
				data: e
			};
			return et(i, V + o.toString(), JSON.stringify(s));
		}
		ct || ft(), e.lastModified && !function(t, e) {
			const n = t.lastModifiedCached;
			if (n && n >= e) return n === e;
			if (t.lastModifiedCached = e, n) for (const n in ot) lt(n, ((n) => {
				const i = n.data;
				return n.provider !== t.provider || i.prefix !== t.prefix || i.lastModified === e;
			}));
			return !0;
		}(t, e.lastModified) || Object.keys(e.icons).length && (e.not_found && delete (e = Object.assign({}, e)).not_found, n("local") || n("session"));
	}
	function ht() {}
	function pt(t) {
		t.iconsLoaderFlag || (t.iconsLoaderFlag = !0, setTimeout((() => {
			t.iconsLoaderFlag = !1, function(t) {
				t.pendingCallbacksFlag || (t.pendingCallbacksFlag = !0, setTimeout((() => {
					t.pendingCallbacksFlag = !1;
					const e = t.loaderCallbacks ? t.loaderCallbacks.slice(0) : [];
					if (!e.length) return;
					let n = !1;
					const i = t.provider, r = t.prefix;
					e.forEach(((e) => {
						const o = e.icons, s = o.pending.length;
						o.pending = o.pending.filter(((e) => {
							if (e.prefix !== r) return !0;
							const s = e.name;
							if (t.icons[s]) o.loaded.push({
								provider: i,
								prefix: r,
								name: s
							});
							else {
								if (!t.missing.has(s)) return n = !0, !0;
								o.missing.push({
									provider: i,
									prefix: r,
									name: s
								});
							}
							return !1;
						})), o.pending.length !== s && (n || S([t], e.id), e.callback(o.loaded.slice(0), o.missing.slice(0), o.pending.slice(0), e.abort));
					}));
				})));
			}(t);
		})));
	}
	const gt = (t, e) => {
		const i = function(t) {
			const e = {
				loaded: [],
				missing: [],
				pending: []
			}, n = Object.create(null);
			t.sort(((t, e) => t.provider !== e.provider ? t.provider.localeCompare(e.provider) : t.prefix !== e.prefix ? t.prefix.localeCompare(e.prefix) : t.name.localeCompare(e.name)));
			let i = {
				provider: "",
				prefix: "",
				name: ""
			};
			return t.forEach(((t) => {
				if (i.name === t.name && i.prefix === t.prefix && i.provider === t.provider) return;
				i = t;
				const r = t.provider, o = t.prefix, s = t.name, c = n[r] || (n[r] = Object.create(null)), a = c[o] || (c[o] = y(r, o));
				let u;
				u = s in a.icons ? e.loaded : "" === o || a.missing.has(s) ? e.missing : e.pending;
				const l = {
					provider: r,
					prefix: o,
					name: s
				};
				u.push(l);
			})), e;
		}(function(t, e = !0, n = !1) {
			const i = [];
			return t.forEach(((t) => {
				const r = "string" == typeof t ? l(t, e, n) : t;
				r && i.push(r);
			})), i;
		}(t, !0, k()));
		if (!i.pending.length) {
			let t = !0;
			return e && setTimeout((() => {
				t && e(i.loaded, i.missing, i.pending, ht);
			})), () => {
				t = !1;
			};
		}
		const r = Object.create(null), o = [];
		let s, c;
		return i.pending.forEach(((t) => {
			const { provider: e, prefix: n } = t;
			if (n === c && e === s) return;
			s = e, c = n, o.push(y(e, n));
			const i = r[e] || (r[e] = Object.create(null));
			i[n] || (i[n] = []);
		})), i.pending.forEach(((t) => {
			const { provider: e, prefix: n, name: i } = t, o = y(e, n), s = o.pendingIcons || (o.pendingIcons = /* @__PURE__ */ new Set());
			s.has(i) || (s.add(i), r[e][n].push(i));
		})), o.forEach(((t) => {
			const { provider: e, prefix: n } = t;
			r[e][n].length && function(t, e) {
				t.iconsToLoad ? t.iconsToLoad = t.iconsToLoad.concat(e).sort() : t.iconsToLoad = e, t.iconsQueueFlag || (t.iconsQueueFlag = !0, setTimeout((() => {
					t.iconsQueueFlag = !1;
					const { provider: e, prefix: n } = t, i = t.iconsToLoad;
					let r;
					delete t.iconsToLoad, i && (r = F(e)) && r.prepare(e, n, i).forEach(((n) => {
						B(e, n, ((e) => {
							if ("object" != typeof e) n.icons.forEach(((e) => {
								t.missing.add(e);
							}));
							else try {
								const n = x(t, e);
								if (!n.length) return;
								const i = t.pendingIcons;
								i && n.forEach(((t) => {
									i.delete(t);
								})), dt(t, e);
							} catch (t) {
								console.error(t);
							}
							pt(t);
						}));
					}));
				})));
			}(t, r[e][n]);
		})), e ? function(t, e, n) {
			const i = E++, r = S.bind(null, n, i);
			if (!e.pending.length) return r;
			const o = {
				id: i,
				icons: e,
				callback: t,
				abort: r
			};
			return n.forEach(((t) => {
				(t.loaderCallbacks || (t.loaderCallbacks = [])).push(o);
			})), r;
		}(e, i, o) : ht;
	}, bt = (t) => new Promise(((e, i) => {
		const r = "string" == typeof t ? l(t, !0) : t;
		r ? gt([r || t], ((o) => {
			if (o.length && r) {
				const t = j(r);
				if (t) return void e({
					...n,
					...t
				});
			}
			i(t);
		})) : i(t);
	}));
	function vt(t, e) {
		const n = "string" == typeof t ? l(t, !0, !0) : null;
		if (!n) return {
			value: t,
			data: function(t) {
				try {
					const e = "string" == typeof t ? JSON.parse(t) : t;
					if ("string" == typeof e.body) return { ...e };
				} catch (t) {}
			}(t)
		};
		const i = j(n);
		if (void 0 !== i || !n.prefix) return {
			value: t,
			name: n,
			data: i
		};
		return {
			value: t,
			name: n,
			loading: gt([n], (() => e(t, n, j(n))))
		};
	}
	let mt = !1;
	try {
		mt = 0 === navigator.vendor.indexOf("Apple");
	} catch (t) {}
	const yt = /(-?[0-9.]*[0-9]+[0-9.]*)/g, xt = /^-?[0-9.]*[0-9]+[0-9.]*$/g;
	function wt(t, e, n) {
		if (1 === e) return t;
		if (n = n || 100, "number" == typeof t) return Math.ceil(t * e * n) / n;
		if ("string" != typeof t) return t;
		const i = t.split(yt);
		if (null === i || !i.length) return t;
		const r = [];
		let o = i.shift(), s = xt.test(o);
		for (;;) {
			if (s) {
				const t = parseFloat(o);
				isNaN(t) ? r.push(o) : r.push(Math.ceil(t * e * n) / n);
			} else r.push(o);
			if (o = i.shift(), void 0 === o) return r.join("");
			s = !s;
		}
	}
	const _t = (t) => "unset" === t || "undefined" === t || "none" === t;
	function kt(t, e) {
		const i = {
			...n,
			...t
		}, r = {
			...o,
			...e
		}, s = {
			left: i.left,
			top: i.top,
			width: i.width,
			height: i.height
		};
		let c = i.body;
		[i, r].forEach(((t) => {
			const e = [], n = t.hFlip, i = t.vFlip;
			let r, o = t.rotate;
			switch (n ? i ? o += 2 : (e.push("translate(" + (s.width + s.left).toString() + " " + (0 - s.top).toString() + ")"), e.push("scale(-1 1)"), s.top = s.left = 0) : i && (e.push("translate(" + (0 - s.left).toString() + " " + (s.height + s.top).toString() + ")"), e.push("scale(1 -1)"), s.top = s.left = 0), o < 0 && (o -= 4 * Math.floor(o / 4)), o %= 4, o) {
				case 1:
					r = s.height / 2 + s.top, e.unshift("rotate(90 " + r.toString() + " " + r.toString() + ")");
					break;
				case 2:
					e.unshift("rotate(180 " + (s.width / 2 + s.left).toString() + " " + (s.height / 2 + s.top).toString() + ")");
					break;
				case 3: r = s.width / 2 + s.left, e.unshift("rotate(-90 " + r.toString() + " " + r.toString() + ")");
			}
			o % 2 == 1 && (s.left !== s.top && (r = s.left, s.left = s.top, s.top = r), s.width !== s.height && (r = s.width, s.width = s.height, s.height = r)), e.length && (c = function(t, e, n) {
				const i = function(t, e = "defs") {
					let n = "";
					const i = t.indexOf("<" + e);
					for (; i >= 0;) {
						const r = t.indexOf(">", i), o = t.indexOf("</" + e);
						if (-1 === r || -1 === o) break;
						const s = t.indexOf(">", o);
						if (-1 === s) break;
						n += t.slice(r + 1, o).trim(), t = t.slice(0, i).trim() + t.slice(s + 1);
					}
					return {
						defs: n,
						content: t
					};
				}(t);
				return r = i.defs, o = e + i.content + n, r ? "<defs>" + r + "</defs>" + o : o;
				var r, o;
			}(c, "<g transform=\"" + e.join(" ") + "\">", "</g>"));
		}));
		const a = r.width, u = r.height, l = s.width, f = s.height;
		let d, h;
		null === a ? (h = null === u ? "1em" : "auto" === u ? f : u, d = wt(h, l / f)) : (d = "auto" === a ? l : a, h = null === u ? wt(d, f / l) : "auto" === u ? f : u);
		const p = {}, g = (t, e) => {
			_t(e) || (p[t] = e.toString());
		};
		g("width", d), g("height", h);
		const b = [
			s.left,
			s.top,
			l,
			f
		];
		return p.viewBox = b.join(" "), {
			attributes: p,
			viewBox: b,
			body: c
		};
	}
	function jt(t, e) {
		let n = -1 === t.indexOf("xlink:") ? "" : " xmlns:xlink=\"http://www.w3.org/1999/xlink\"";
		for (const t in e) n += " " + t + "=\"" + e[t] + "\"";
		return "<svg xmlns=\"http://www.w3.org/2000/svg\"" + n + ">" + t + "</svg>";
	}
	function At(t) {
		return "url(\"" + function(t) {
			return "data:image/svg+xml," + function(t) {
				return t.replace(/"/g, "'").replace(/%/g, "%25").replace(/#/g, "%23").replace(/</g, "%3C").replace(/>/g, "%3E").replace(/\s+/g, " ");
			}(t);
		}(t) + "\")";
	}
	let Ot = (() => {
		let t;
		try {
			if (t = fetch, "function" == typeof t) return t;
		} catch (t) {}
	})();
	function Ct(t) {
		Ot = t;
	}
	function It() {
		return Ot;
	}
	const St = {
		prepare: (t, e, n) => {
			const i = [], r = function(t, e) {
				const n = U(t);
				if (!n) return 0;
				let i;
				if (n.maxURL) {
					let t = 0;
					n.resources.forEach(((e) => {
						t = Math.max(t, e.length);
					}));
					const r = e + ".json?icons=";
					i = n.maxURL - t - n.path.length - r.length;
				} else i = 0;
				return i;
			}(t, e), o = "icons";
			let s = {
				type: o,
				provider: t,
				prefix: e,
				icons: []
			}, c = 0;
			return n.forEach(((n, a) => {
				c += n.length + 1, c >= r && a > 0 && (i.push(s), s = {
					type: o,
					provider: t,
					prefix: e,
					icons: []
				}, c = n.length), s.icons.push(n);
			})), i.push(s), i;
		},
		send: (t, e, n) => {
			if (!Ot) return void n("abort", 424);
			let i = function(t) {
				if ("string" == typeof t) {
					const e = U(t);
					if (e) return e.path;
				}
				return "/";
			}(e.provider);
			switch (e.type) {
				case "icons": {
					const t = e.prefix, n = e.icons.join(",");
					i += t + ".json?" + new URLSearchParams({ icons: n }).toString();
					break;
				}
				case "custom": {
					const t = e.uri;
					i += "/" === t.slice(0, 1) ? t.slice(1) : t;
					break;
				}
				default:
					n("abort", 400);
					return;
			}
			let r = 503;
			Ot(t + i).then(((t) => {
				const e = t.status;
				if (200 === e) return r = 501, t.json();
				setTimeout((() => {
					n(function(t) {
						return 404 === t;
					}(e) ? "abort" : "next", e);
				}));
			})).then(((t) => {
				"object" == typeof t && null !== t ? setTimeout((() => {
					n("success", t);
				})) : setTimeout((() => {
					404 === t ? n("abort", t) : n("next", r);
				}));
			})).catch((() => {
				n("next", r);
			}));
		}
	};
	function Et(t, e) {
		switch (t) {
			case "local":
			case "session":
				ot[t] = e;
				break;
			case "all": for (const t in ot) ot[t] = e;
		}
	}
	const Mt = "data-style";
	let Tt = "";
	function Ft(t) {
		Tt = t;
	}
	function Rt(t, e) {
		let n = Array.from(t.childNodes).find(((t) => t.hasAttribute && t.hasAttribute(Mt)));
		n || (n = document.createElement("style"), n.setAttribute(Mt, Mt), t.appendChild(n)), n.textContent = ":host{display:inline-block;vertical-align:" + (e ? "-0.125em" : "0") + "}span,svg{display:block}" + Tt;
	}
	const Lt = { "background-color": "currentColor" }, Pt = { "background-color": "transparent" }, Nt = {
		image: "var(--svg)",
		repeat: "no-repeat",
		size: "100% 100%"
	}, zt = {
		"-webkit-mask": Lt,
		mask: Lt,
		background: Pt
	};
	for (const t in zt) {
		const e = zt[t];
		for (const n in Nt) e[t + "-" + n] = Nt[n];
	}
	function Qt(t) {
		return t ? t + (t.match(/^[-0-9.]+$/) ? "px" : "") : "inherit";
	}
	let qt;
	function Dt(t) {
		return void 0 === qt && function() {
			try {
				qt = window.trustedTypes.createPolicy("iconify", { createHTML: (t) => t });
			} catch (t) {
				qt = null;
			}
		}(), qt ? qt.createHTML(t) : t;
	}
	function Ut(t) {
		return Array.from(t.childNodes).find(((t) => {
			const e = t.tagName && t.tagName.toUpperCase();
			return "SPAN" === e || "SVG" === e;
		}));
	}
	function Ht(t, e) {
		const i = e.icon.data, r = e.customisations, o = kt(i, r);
		r.preserveAspectRatio && (o.attributes.preserveAspectRatio = r.preserveAspectRatio);
		const s = e.renderedMode;
		let c;
		if ("svg" === s) c = function(t) {
			const e = document.createElement("span"), n = t.attributes;
			let i = "";
			n.width || (i = "width: inherit;"), n.height || (i += "height: inherit;"), i && (n.style = i);
			return e.innerHTML = Dt(jt(t.body, n)), e.firstChild;
		}(o);
		else c = function(t, e, n) {
			const i = document.createElement("span");
			let r = t.body;
			-1 !== r.indexOf("<a") && (r += "<!-- " + Date.now() + " -->");
			const o = t.attributes, s = At(jt(r, {
				...o,
				width: e.width + "",
				height: e.height + ""
			})), c = i.style, a = {
				"--svg": s,
				width: Qt(o.width),
				height: Qt(o.height),
				...n ? Lt : Pt
			};
			for (const t in a) c.setProperty(t, a[t]);
			return i;
		}(o, {
			...n,
			...i
		}, "mask" === s);
		const a = Ut(t);
		a ? "SPAN" === c.tagName && a.tagName === c.tagName ? a.setAttribute("style", c.getAttribute("style")) : t.replaceChild(c, a) : t.appendChild(c);
	}
	function Jt(t, e, n) {
		return {
			rendered: !1,
			inline: e,
			icon: t,
			lastRender: n && (n.rendered ? n : n.lastRender)
		};
	}
	(function(t = "iconify-icon") {
		let e, n;
		try {
			e = window.customElements, n = window.HTMLElement;
		} catch (t) {
			return;
		}
		if (!e || !n) return;
		const i = e.get(t);
		if (i) return i;
		const r = [
			"icon",
			"mode",
			"inline",
			"noobserver",
			"width",
			"height",
			"rotate",
			"flip"
		], o = class extends n {
			_shadowRoot;
			_initialised = !1;
			_state;
			_checkQueued = !1;
			_connected = !1;
			_observer = null;
			_visible = !0;
			constructor() {
				super();
				const t = this._shadowRoot = this.attachShadow({ mode: "open" }), e = this.hasAttribute("inline");
				Rt(t, e), this._state = Jt({ value: "" }, e), this._queueCheck();
			}
			connectedCallback() {
				this._connected = !0, this.startObserver();
			}
			disconnectedCallback() {
				this._connected = !1, this.stopObserver();
			}
			static get observedAttributes() {
				return r.slice(0);
			}
			attributeChangedCallback(t) {
				switch (t) {
					case "inline": {
						const t = this.hasAttribute("inline"), e = this._state;
						t !== e.inline && (e.inline = t, Rt(this._shadowRoot, t));
						break;
					}
					case "noobserver":
						this.hasAttribute("noobserver") ? this.startObserver() : this.stopObserver();
						break;
					default: this._queueCheck();
				}
			}
			get icon() {
				const t = this.getAttribute("icon");
				if (t && "{" === t.slice(0, 1)) try {
					return JSON.parse(t);
				} catch (t) {}
				return t;
			}
			set icon(t) {
				"object" == typeof t && (t = JSON.stringify(t)), this.setAttribute("icon", t);
			}
			get inline() {
				return this.hasAttribute("inline");
			}
			set inline(t) {
				t ? this.setAttribute("inline", "true") : this.removeAttribute("inline");
			}
			get observer() {
				return this.hasAttribute("observer");
			}
			set observer(t) {
				t ? this.setAttribute("observer", "true") : this.removeAttribute("observer");
			}
			restartAnimation() {
				const t = this._state;
				if (t.rendered) {
					const e = this._shadowRoot;
					if ("svg" === t.renderedMode) try {
						e.lastChild.setCurrentTime(0);
						return;
					} catch (t) {}
					Ht(e, t);
				}
			}
			get status() {
				const t = this._state;
				return t.rendered ? "rendered" : null === t.icon.data ? "failed" : "loading";
			}
			_queueCheck() {
				this._checkQueued || (this._checkQueued = !0, setTimeout((() => {
					this._check();
				})));
			}
			_check() {
				if (!this._checkQueued) return;
				this._checkQueued = !1;
				const t = this._state, e = this.getAttribute("icon");
				if (e !== t.icon.value) return void this._iconChanged(e);
				if (!t.rendered || !this._visible) return;
				const n = this.getAttribute("mode"), i = a(this);
				t.attrMode === n && !function(t, e) {
					for (const n in c) if (t[n] !== e[n]) return !0;
					return !1;
				}(t.customisations, i) && Ut(this._shadowRoot) || this._renderIcon(t.icon, i, n);
			}
			_iconChanged(t) {
				const e = vt(t, ((t, e, n) => {
					const i = this._state;
					if (i.rendered || this.getAttribute("icon") !== t) return;
					const r = {
						value: t,
						name: e,
						data: n
					};
					r.data ? this._gotIconData(r) : i.icon = r;
				}));
				e.data ? this._gotIconData(e) : this._state = Jt(e, this._state.inline, this._state);
			}
			_forceRender() {
				if (this._visible) this._queueCheck();
				else {
					const t = Ut(this._shadowRoot);
					t && this._shadowRoot.removeChild(t);
				}
			}
			_gotIconData(t) {
				this._checkQueued = !1, this._renderIcon(t, a(this), this.getAttribute("mode"));
			}
			_renderIcon(t, e, n) {
				const i = function(t, e) {
					switch (e) {
						case "svg":
						case "bg":
						case "mask": return e;
					}
					return "style" === e || !mt && -1 !== t.indexOf("<a") ? -1 === t.indexOf("currentColor") ? "bg" : "mask" : "svg";
				}(t.data.body, n), r = this._state.inline;
				Ht(this._shadowRoot, this._state = {
					rendered: !0,
					icon: t,
					inline: r,
					customisations: e,
					attrMode: n,
					renderedMode: i
				});
			}
			startObserver() {
				if (!this._observer && !this.hasAttribute("noobserver")) try {
					this._observer = new IntersectionObserver(((t) => {
						const e = t.some(((t) => t.isIntersecting));
						e !== this._visible && (this._visible = e, this._forceRender());
					})), this._observer.observe(this);
				} catch (t) {
					if (this._observer) {
						try {
							this._observer.disconnect();
						} catch (t) {}
						this._observer = null;
					}
				}
			}
			stopObserver() {
				this._observer && (this._observer.disconnect(), this._observer = null, this._visible = !0, this._connected && this._forceRender());
			}
		};
		r.forEach(((t) => {
			t in o.prototype || Object.defineProperty(o.prototype, t, {
				get: function() {
					return this.getAttribute(t);
				},
				set: function(e) {
					null !== e ? this.setAttribute(t, e) : this.removeAttribute(t);
				}
			});
		}));
		const s = function() {
			let t;
			T("", St), k(!0);
			try {
				t = window;
			} catch (t) {}
			if (t) {
				if (ft(), void 0 !== t.IconifyPreload) {
					const e = t.IconifyPreload, n = "Invalid IconifyPreload syntax.";
					"object" == typeof e && null !== e && (e instanceof Array ? e : [e]).forEach(((t) => {
						try {
							("object" != typeof t || null === t || t instanceof Array || "object" != typeof t.icons || "string" != typeof t.prefix || !O(t)) && console.error(n);
						} catch (t) {
							console.error(n);
						}
					}));
				}
				if (void 0 !== t.IconifyProviders) {
					const e = t.IconifyProviders;
					if ("object" == typeof e && null !== e) for (const t in e) {
						const n = "IconifyProviders[" + t + "] is invalid.";
						try {
							const i = e[t];
							if ("object" != typeof i || !i || void 0 === i.resources) continue;
							D(t, i) || console.error(n);
						} catch (t) {
							console.error(n);
						}
					}
				}
			}
			return {
				enableCache: (t) => Et(t, !0),
				disableCache: (t) => Et(t, !1),
				iconLoaded: C,
				iconExists: C,
				getIcon: I,
				listIcons: w,
				addIcon: A,
				addCollection: O,
				calculateSize: wt,
				buildIcon: kt,
				iconToHTML: jt,
				svgToURL: At,
				loadIcons: gt,
				loadIcon: bt,
				addAPIProvider: D,
				appendCustomStyle: Ft,
				_api: {
					getAPIConfig: U,
					setAPIModule: T,
					sendAPIQuery: B,
					setFetch: Ct,
					getFetch: It,
					listAPIProviders: H
				}
			};
		}();
		for (const t in s) o[t] = o.prototype[t] = s[t];
		e.define(t, o);
	})();
})();
//#endregion
//#region src/js/common/functions.js
var slideUp = (target, duration = 500, showmore = 0) => {
	if (!target.classList.contains("--slide")) {
		target.classList.add("--slide");
		target.style.transitionProperty = "height, margin, padding";
		target.style.transitionDuration = duration + "ms";
		target.style.height = `${target.offsetHeight}px`;
		target.offsetHeight;
		target.style.overflow = "hidden";
		target.style.height = showmore ? `${showmore}px` : `0px`;
		target.style.paddingTop = 0;
		target.style.paddingBottom = 0;
		target.style.marginTop = 0;
		target.style.marginBottom = 0;
		window.setTimeout(() => {
			target.hidden = !showmore ? true : false;
			!showmore && target.style.removeProperty("height");
			target.style.removeProperty("padding-top");
			target.style.removeProperty("padding-bottom");
			target.style.removeProperty("margin-top");
			target.style.removeProperty("margin-bottom");
			!showmore && target.style.removeProperty("overflow");
			target.style.removeProperty("transition-duration");
			target.style.removeProperty("transition-property");
			target.classList.remove("--slide");
			document.dispatchEvent(new CustomEvent("slideUpDone", { detail: { target } }));
		}, duration);
	}
};
var slideDown = (target, duration = 500, showmore = 0) => {
	if (!target.classList.contains("--slide")) {
		target.classList.add("--slide");
		target.hidden = target.hidden ? false : null;
		showmore && target.style.removeProperty("height");
		let height = target.offsetHeight;
		target.style.overflow = "hidden";
		target.style.height = showmore ? `${showmore}px` : `0px`;
		target.style.paddingTop = 0;
		target.style.paddingBottom = 0;
		target.style.marginTop = 0;
		target.style.marginBottom = 0;
		target.offsetHeight;
		target.style.transitionProperty = "height, margin, padding";
		target.style.transitionDuration = duration + "ms";
		target.style.height = height + "px";
		target.style.removeProperty("padding-top");
		target.style.removeProperty("padding-bottom");
		target.style.removeProperty("margin-top");
		target.style.removeProperty("margin-bottom");
		window.setTimeout(() => {
			target.style.removeProperty("height");
			target.style.removeProperty("overflow");
			target.style.removeProperty("transition-duration");
			target.style.removeProperty("transition-property");
			target.classList.remove("--slide");
			document.dispatchEvent(new CustomEvent("slideDownDone", { detail: { target } }));
		}, duration);
	}
};
var slideToggle = (target, duration = 500) => {
	if (target.hidden) return slideDown(target, duration);
	else return slideUp(target, duration);
};
var bodyLockStatus = true;
var bodyUnlock = (delay = 500) => {
	if (bodyLockStatus) {
		const lockPaddingElements = document.querySelectorAll("[data-fls-lp]");
		setTimeout(() => {
			lockPaddingElements.forEach((lockPaddingElement) => {
				lockPaddingElement.style.paddingRight = "";
			});
			document.body.style.paddingRight = "";
			document.documentElement.removeAttribute("data-fls-scrolllock");
		}, delay);
		bodyLockStatus = false;
		setTimeout(function() {
			bodyLockStatus = true;
		}, delay);
	}
};
var bodyLock = (delay = 500) => {
	if (bodyLockStatus) {
		const lockPaddingElements = document.querySelectorAll("[data-fls-lp]");
		const lockPaddingValue = window.innerWidth - document.body.offsetWidth + "px";
		lockPaddingElements.forEach((lockPaddingElement) => {
			lockPaddingElement.style.paddingRight = lockPaddingValue;
		});
		document.body.style.paddingRight = lockPaddingValue;
		document.documentElement.setAttribute("data-fls-scrolllock", "");
		bodyLockStatus = false;
		setTimeout(function() {
			bodyLockStatus = true;
		}, delay);
	}
};
function getDigFormat(item, sepp = " ") {
	return item.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, `$1${sepp}`);
}
function uniqArray(array) {
	return array.filter((item, index, self) => self.indexOf(item) === index);
}
function dataMediaQueries(array, dataSetValue) {
	const media = Array.from(array).filter((item) => item.dataset[dataSetValue]).map((item) => {
		const [value, type = "max"] = item.dataset[dataSetValue].split(",");
		return {
			value,
			type,
			item
		};
	});
	if (media.length === 0) return [];
	const breakpointsArray = media.map(({ value, type }) => `(${type}-width: ${value}px),${value},${type}`);
	return [...new Set(breakpointsArray)].map((query) => {
		const [mediaQuery, mediaBreakpoint, mediaType] = query.split(",");
		const matchMedia = window.matchMedia(mediaQuery);
		return {
			itemsArray: media.filter((item) => item.value === mediaBreakpoint && item.type === mediaType),
			matchMedia
		};
	});
}
//#endregion
//#region src/components/layout/spollers/spollers.js
function spollers() {
	const spollersArray = document.querySelectorAll("[data-fls-spollers]");
	if (spollersArray.length > 0) {
		document.addEventListener("click", setSpollerAction);
		const spollersRegular = Array.from(spollersArray).filter(function(item, index, self) {
			return !item.dataset.flsSpollers.split(",")[0];
		});
		if (spollersRegular.length) initSpollers(spollersRegular);
		let mdQueriesArray = dataMediaQueries(spollersArray, "flsSpollers");
		if (mdQueriesArray && mdQueriesArray.length) mdQueriesArray.forEach((mdQueriesItem) => {
			mdQueriesItem.matchMedia.addEventListener("change", function() {
				initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
			});
			initSpollers(mdQueriesItem.itemsArray, mdQueriesItem.matchMedia);
		});
		function initSpollers(spollersArray, matchMedia = false) {
			spollersArray.forEach((spollersBlock) => {
				spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
				if (matchMedia.matches || !matchMedia) {
					spollersBlock.classList.add("--spoller-init");
					initSpollerBody(spollersBlock);
				} else {
					spollersBlock.classList.remove("--spoller-init");
					initSpollerBody(spollersBlock, false);
				}
			});
		}
		function initSpollerBody(spollersBlock, hideSpollerBody = true) {
			let spollerItems = spollersBlock.querySelectorAll("details");
			if (spollerItems.length) spollerItems.forEach((spollerItem) => {
				let spollerTitle = spollerItem.querySelector("summary");
				if (hideSpollerBody) {
					spollerTitle.removeAttribute("tabindex");
					if (!spollerItem.hasAttribute("data-fls-spollers-open")) {
						spollerItem.open = false;
						spollerTitle.nextElementSibling.hidden = true;
					} else {
						spollerTitle.classList.add("--spoller-active");
						spollerItem.open = true;
					}
				} else {
					spollerTitle.setAttribute("tabindex", "-1");
					spollerTitle.classList.remove("--spoller-active");
					spollerItem.open = true;
					spollerTitle.nextElementSibling.hidden = false;
				}
			});
		}
		function setSpollerAction(e) {
			const el = e.target;
			if (el.closest("summary") && el.closest("[data-fls-spollers]")) {
				e.preventDefault();
				if (el.closest("[data-fls-spollers]").classList.contains("--spoller-init")) {
					const spollerTitle = el.closest("summary");
					const spollerBlock = spollerTitle.closest("details");
					const spollersBlock = spollerTitle.closest("[data-fls-spollers]");
					const oneSpoller = spollersBlock.hasAttribute("data-fls-spollers-one");
					const scrollSpoller = spollerBlock.hasAttribute("data-fls-spollers-scroll");
					const spollerSpeed = spollersBlock.dataset.flsSpollersSpeed ? parseInt(spollersBlock.dataset.flsSpollersSpeed) : 500;
					if (!spollersBlock.querySelectorAll(".--slide").length) {
						if (oneSpoller && !spollerBlock.open) hideSpollersBody(spollersBlock);
						!spollerBlock.open ? spollerBlock.open = true : setTimeout(() => {
							spollerBlock.open = false;
						}, spollerSpeed);
						spollerTitle.classList.toggle("--spoller-active");
						slideToggle(spollerTitle.nextElementSibling, spollerSpeed);
						if (scrollSpoller && spollerTitle.classList.contains("--spoller-active")) {
							const scrollSpollerValue = spollerBlock.dataset.flsSpollersScroll;
							const scrollSpollerOffset = +scrollSpollerValue ? +scrollSpollerValue : 0;
							const scrollSpollerNoHeader = spollerBlock.hasAttribute("data-fls-spollers-scroll-noheader") ? document.querySelector(".header").offsetHeight : 0;
							window.scrollTo({
								top: spollerBlock.offsetTop - (scrollSpollerOffset + scrollSpollerNoHeader),
								behavior: "smooth"
							});
						}
					}
				}
			}
			if (!el.closest("[data-fls-spollers]")) {
				const spollersClose = document.querySelectorAll("[data-fls-spollers-close]");
				if (spollersClose.length) spollersClose.forEach((spollerClose) => {
					const spollersBlock = spollerClose.closest("[data-fls-spollers]");
					const spollerCloseBlock = spollerClose.parentNode;
					if (spollersBlock.classList.contains("--spoller-init")) {
						const spollerSpeed = spollersBlock.dataset.flsSpollersSpeed ? parseInt(spollersBlock.dataset.flsSpollersSpeed) : 500;
						spollerClose.classList.remove("--spoller-active");
						slideUp(spollerClose.nextElementSibling, spollerSpeed);
						setTimeout(() => {
							spollerCloseBlock.open = false;
						}, spollerSpeed);
					}
				});
			}
		}
		function hideSpollersBody(spollersBlock) {
			const spollerActiveBlock = spollersBlock.querySelector("details[open]");
			if (spollerActiveBlock && !spollersBlock.querySelectorAll(".--slide").length) {
				const spollerActiveTitle = spollerActiveBlock.querySelector("summary");
				const spollerSpeed = spollersBlock.dataset.flsSpollersSpeed ? parseInt(spollersBlock.dataset.flsSpollersSpeed) : 500;
				spollerActiveTitle.classList.remove("--spoller-active");
				slideUp(spollerActiveTitle.nextElementSibling, spollerSpeed);
				setTimeout(() => {
					spollerActiveBlock.open = false;
				}, spollerSpeed);
			}
		}
	}
}
window.addEventListener("load", spollers);
//#endregion
//#region node_modules/swiper/shared/utils.mjs
function classesToTokens(classes = "") {
	return classes.trim().split(" ").filter((c) => !!c.trim());
}
function deleteProps(obj) {
	Object.keys(obj).forEach((key) => {
		try {
			obj[key] = null;
		} catch {}
		try {
			delete obj[key];
		} catch {}
	});
}
function nextTick(callback, delay = 0) {
	return setTimeout(callback, delay);
}
function now() {
	return Date.now();
}
function getComputedStyle$1(el) {
	return window.getComputedStyle(el, null);
}
function getTranslate(el, axis = "x") {
	const style = getComputedStyle$1(el);
	const transform = style.transform || style.webkitTransform;
	if (!transform || transform === "none") return 0;
	const matrix = new DOMMatrixReadOnly(transform);
	return axis === "x" ? matrix.m41 : matrix.m42;
}
function isObject(o) {
	return typeof o === "object" && o !== null && !!o.constructor && Object.prototype.toString.call(o).slice(8, -1) === "Object";
}
function isNode(node) {
	if (typeof HTMLElement !== "undefined" && node instanceof HTMLElement) return true;
	return !!node && typeof node === "object" && (node.nodeType === 1 || node.nodeType === 11);
}
function extend(target, ...sources) {
	const to = Object(target);
	for (let i = 0; i < sources.length; i += 1) {
		const nextSource = sources[i];
		if (nextSource === void 0 || nextSource === null || isNode(nextSource)) continue;
		const sourceObj = nextSource;
		const keysArray = Object.keys(Object(sourceObj));
		for (let nextIndex = 0, len = keysArray.length; nextIndex < len; nextIndex += 1) {
			const nextKey = keysArray[nextIndex];
			if (nextKey === "__proto__" || nextKey === "constructor" || nextKey === "prototype") continue;
			const desc = Object.getOwnPropertyDescriptor(sourceObj, nextKey);
			if (!desc || !desc.enumerable) continue;
			const sourceVal = sourceObj[nextKey];
			if (isObject(to[nextKey]) && isObject(sourceVal)) {
				if (sourceVal.__swiper__) to[nextKey] = sourceVal;
				else extend(to[nextKey], sourceVal);
			} else if (!isObject(to[nextKey]) && isObject(sourceVal)) {
				to[nextKey] = {};
				if (sourceVal.__swiper__) to[nextKey] = sourceVal;
				else extend(to[nextKey], sourceVal);
			} else to[nextKey] = sourceVal;
		}
	}
	return to;
}
function setCSSProperty(el, varName, varValue) {
	el.style.setProperty(varName, varValue);
}
function elementChildren(element, selector = "") {
	const children = [...element.children];
	if (element instanceof HTMLSlotElement) children.push(...element.assignedElements());
	return selector ? children.filter((el) => el.matches(selector)) : children;
}
function elementIsChildOfSlot(el, slot) {
	const queue = [slot];
	while (queue.length > 0) {
		const cur = queue.shift();
		if (el === cur) return true;
		queue.push(...cur.children, ...cur.shadowRoot ? cur.shadowRoot.children : [], ...cur.assignedElements ? cur.assignedElements() : []);
	}
	return false;
}
function elementIsChildOf(el, parent) {
	let isChild = parent.contains(el);
	if (!isChild && parent instanceof HTMLSlotElement) {
		isChild = [...parent.assignedElements()].includes(el);
		if (!isChild) isChild = elementIsChildOfSlot(el, parent);
	}
	return isChild;
}
function showWarning(text) {
	try {
		console.warn(text);
	} catch {}
}
function createElement(tag, classes = []) {
	const el = document.createElement(tag);
	el.classList.add(...Array.isArray(classes) ? classes : classesToTokens(classes));
	return el;
}
function elementPrevAll(el, selector) {
	const prevEls = [];
	let prev = el.previousElementSibling;
	while (prev) {
		if (!selector || prev.matches(selector)) prevEls.push(prev);
		prev = prev.previousElementSibling;
	}
	return prevEls;
}
function elementNextAll(el, selector) {
	const nextEls = [];
	let next = el.nextElementSibling;
	while (next) {
		if (!selector || next.matches(selector)) nextEls.push(next);
		next = next.nextElementSibling;
	}
	return nextEls;
}
function elementStyle(el, prop) {
	return window.getComputedStyle(el, null).getPropertyValue(prop);
}
function elementIndex(el) {
	if (!el || !el.parentNode) return void 0;
	return [...el.parentNode.children].indexOf(el);
}
function elementParents(el, selector) {
	const parents = [];
	let parent = el.parentElement;
	while (parent) {
		if (!selector || parent.matches(selector)) parents.push(parent);
		parent = parent.parentElement;
	}
	return parents;
}
function elementOuterSize(el, size, includeMargins) {
	{
		const style = window.getComputedStyle(el, null);
		return el[size === "width" ? "offsetWidth" : "offsetHeight"] + parseFloat(style.getPropertyValue(size === "width" ? "margin-right" : "margin-top")) + parseFloat(style.getPropertyValue(size === "width" ? "margin-left" : "margin-bottom"));
	}
}
function makeElementsArray(el) {
	return (Array.isArray(el) ? el : [el]).filter((e) => !!e);
}
function setInnerHTML(el, html = "") {
	const tt = globalThis.trustedTypes;
	if (typeof tt !== "undefined") el.innerHTML = tt.createPolicy("html", { createHTML: (s) => s }).createHTML(html);
	else el.innerHTML = html;
}
//#endregion
//#region node_modules/swiper/shared/swiper-core.mjs
var supportCached;
function calcSupport() {
	if (typeof window === "undefined") return { touch: false };
	return { touch: "ontouchstart" in window || navigator.maxTouchPoints > 0 };
}
function getSupport() {
	if (!supportCached) supportCached = calcSupport();
	return supportCached;
}
var deviceCached;
function calcDevice({ userAgent } = {}) {
	if (typeof window === "undefined") return {
		ios: false,
		android: false
	};
	const support = getSupport();
	const platform = navigator.platform;
	const ua = userAgent || navigator.userAgent;
	const device = {
		ios: false,
		android: false
	};
	const isAndroid = /(Android);?[\s/]+([\d.]+)?/.test(ua);
	const isIPhoneOrIPod = /(iPhone\sOS|iOS|iPod)/.test(ua);
	const isIPadDirect = /iPad/.test(ua);
	const isIPadMasquerade = platform === "MacIntel" && support.touch && navigator.maxTouchPoints > 1;
	const isIPad = isIPadDirect || isIPadMasquerade;
	if (isAndroid && !(platform === "Win32")) {
		device.os = "android";
		device.android = true;
	}
	if (isIPad || isIPhoneOrIPod) {
		device.os = "ios";
		device.ios = true;
	}
	return device;
}
function getDevice(overrides = {}) {
	if (!deviceCached) deviceCached = calcDevice(overrides);
	return deviceCached;
}
var browserCached;
function calcBrowser() {
	if (typeof window === "undefined") return {
		isSafari: false,
		isWebView: false,
		need3dFix: false
	};
	const device = getDevice();
	const ua = navigator.userAgent;
	const uaLower = ua.toLowerCase();
	const isSafari = uaLower.includes("safari") && !uaLower.includes("chrome") && !uaLower.includes("android");
	const isWebView = /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(ua);
	return {
		isSafari,
		isWebView,
		need3dFix: isSafari || isWebView && device.ios
	};
}
function getBrowser() {
	if (!browserCached) browserCached = calcBrowser();
	return browserCached;
}
var processLazyPreloader = (swiper, imageEl) => {
	if (!swiper || swiper.destroyed || !swiper.params || !swiper.params.lazyPreload) return;
	const slideSelector = () => swiper.isElement ? "swiper-slide" : `.${swiper.params.slideClass}`;
	const slideEl = imageEl.closest(slideSelector());
	if (slideEl) {
		let lazyEl = slideEl.querySelector(`.${swiper.params.lazyPreloaderClass}`);
		if (!lazyEl && swiper.isElement) {
			if (slideEl.shadowRoot) lazyEl = slideEl.shadowRoot.querySelector(`.${swiper.params.lazyPreloaderClass}`);
			else requestAnimationFrame(() => {
				if (slideEl.shadowRoot) {
					const innerLazy = slideEl.shadowRoot.querySelector(`.${swiper.params.lazyPreloaderClass}`);
					if (innerLazy && !innerLazy.lazyPreloaderManaged) innerLazy.remove();
				}
			});
		}
		if (lazyEl && !lazyEl.lazyPreloaderManaged) lazyEl.remove();
	}
};
var unlazy = (swiper, index) => {
	if (!swiper.slides[index]) return;
	const imageEl = swiper.slides[index].querySelector("[loading=\"lazy\"]");
	if (imageEl) imageEl.removeAttribute("loading");
};
var preload = (swiper) => {
	if (!swiper || swiper.destroyed || !swiper.params || !swiper.params.lazyPreload) return;
	let amount = swiper.params.lazyPreloadPrevNext;
	const len = swiper.slides.length;
	if (!len || !amount || amount < 0) return;
	amount = Math.min(amount, len);
	const slidesPerView = swiper.params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : Math.ceil(swiper.params.slidesPerView);
	const activeIndex = swiper.activeIndex;
	if (swiper.params.grid && (swiper.params.grid.rows ?? 1) > 1) {
		const activeColumn = activeIndex;
		const preloadColumns = [activeColumn - amount];
		preloadColumns.push(...Array.from({ length: amount }).map((_, i) => activeColumn + slidesPerView + i));
		swiper.slides.forEach((slideEl, i) => {
			if (slideEl.column !== void 0 && preloadColumns.includes(slideEl.column)) unlazy(swiper, i);
		});
		return;
	}
	const slideIndexLastInView = activeIndex + slidesPerView - 1;
	if (swiper.params.rewind || swiper.params.loop) for (let i = activeIndex - amount; i <= slideIndexLastInView + amount; i += 1) {
		const realIndex = (i % len + len) % len;
		if (realIndex < activeIndex || realIndex > slideIndexLastInView) unlazy(swiper, realIndex);
	}
	else for (let i = Math.max(activeIndex - amount, 0); i <= Math.min(slideIndexLastInView + amount, len - 1); i += 1) if (i !== activeIndex && (i > slideIndexLastInView || i < activeIndex)) unlazy(swiper, i);
};
function getBreakpoint(breakpoints, base = "window", containerEl) {
	if (!breakpoints || base === "container" && !containerEl) return void 0;
	let breakpoint = false;
	const currentHeight = base === "window" ? window.innerHeight : containerEl.clientHeight;
	const points = Object.keys(breakpoints).map((point) => {
		if (typeof point === "string" && point.indexOf("@") === 0) {
			const minRatio = parseFloat(point.substr(1));
			return {
				value: currentHeight * minRatio,
				point
			};
		}
		return {
			value: point,
			point
		};
	});
	points.sort((a, b) => parseInt(String(a.value), 10) - parseInt(String(b.value), 10));
	for (let i = 0; i < points.length; i += 1) {
		const { point, value } = points[i];
		if (base === "window") {
			if (window.matchMedia(`(min-width: ${value}px)`).matches) breakpoint = point;
		} else if (value <= containerEl.clientWidth) breakpoint = point;
	}
	return breakpoint || "max";
}
var isGridEnabled = (swiper, params) => {
	return !!(swiper.grid && params.grid && params.grid.rows > 1);
};
function setBreakpoint() {
	const swiper = this;
	const { realIndex, initialized, params, el } = swiper;
	const breakpoints = params.breakpoints;
	if (!breakpoints || breakpoints && Object.keys(breakpoints).length === 0) return;
	const breakpointsBase = params.breakpointsBase === "window" || !params.breakpointsBase ? params.breakpointsBase : "container";
	const breakpointContainer = ["window", "container"].includes(params.breakpointsBase) || !params.breakpointsBase ? swiper.el : document.querySelector(params.breakpointsBase);
	const breakpoint = swiper.getBreakpoint(breakpoints, breakpointsBase, breakpointContainer);
	if (!breakpoint || swiper.currentBreakpoint === breakpoint) return;
	const breakpointsRecord = breakpoints;
	const breakpointParams = (breakpoint in breakpointsRecord ? breakpointsRecord[breakpoint] : void 0) || swiper.originalParams;
	const wasMultiRow = isGridEnabled(swiper, params);
	const isMultiRow = isGridEnabled(swiper, breakpointParams);
	const wasGrabCursor = swiper.params.grabCursor;
	const isGrabCursor = breakpointParams.grabCursor;
	const wasEnabled = params.enabled;
	if (wasMultiRow && !isMultiRow) {
		el.classList.remove(`${params.containerModifierClass}grid`, `${params.containerModifierClass}grid-column`);
		swiper.emitContainerClasses();
	} else if (!wasMultiRow && isMultiRow) {
		el.classList.add(`${params.containerModifierClass}grid`);
		if (breakpointParams.grid.fill && breakpointParams.grid.fill === "column" || !breakpointParams.grid.fill && params.grid.fill === "column") el.classList.add(`${params.containerModifierClass}grid-column`);
		swiper.emitContainerClasses();
	}
	if (wasGrabCursor && !isGrabCursor) swiper.unsetGrabCursor();
	else if (!wasGrabCursor && isGrabCursor) swiper.setGrabCursor();
	const moduleOpt = (opts, prop) => opts[prop];
	[
		"navigation",
		"pagination",
		"scrollbar"
	].forEach((prop) => {
		const bpOpts = moduleOpt(breakpointParams, prop);
		if (typeof bpOpts === "undefined") return;
		const paramsOpts = moduleOpt(params, prop);
		const wasModuleEnabled = typeof paramsOpts === "object" && paramsOpts !== null && paramsOpts.enabled;
		const isModuleEnabled = typeof bpOpts === "object" && bpOpts !== null && bpOpts.enabled;
		const moduleApi = swiper[prop];
		if (wasModuleEnabled && !isModuleEnabled) moduleApi?.disable?.();
		if (!wasModuleEnabled && isModuleEnabled) moduleApi?.enable?.();
	});
	const directionChanged = breakpointParams.direction && breakpointParams.direction !== params.direction;
	const needsReLoop = params.loop && (breakpointParams.slidesPerView !== params.slidesPerView || directionChanged);
	const wasLoop = params.loop;
	if (directionChanged && initialized) swiper.changeDirection();
	extend(swiper.params, breakpointParams);
	const isEnabled = swiper.params.enabled;
	const hasLoop = swiper.params.loop;
	Object.assign(swiper, {
		allowTouchMove: swiper.params.allowTouchMove,
		allowSlideNext: swiper.params.allowSlideNext,
		allowSlidePrev: swiper.params.allowSlidePrev
	});
	if (wasEnabled && !isEnabled) swiper.disable();
	else if (!wasEnabled && isEnabled) swiper.enable();
	swiper.currentBreakpoint = breakpoint;
	swiper.emit("_beforeBreakpoint", breakpointParams);
	if (initialized) {
		if (needsReLoop) {
			swiper.loopDestroy();
			swiper.loopCreate(realIndex);
			swiper.updateSlides();
		} else if (!wasLoop && hasLoop) {
			swiper.loopCreate(realIndex);
			swiper.updateSlides();
		} else if (wasLoop && !hasLoop) swiper.loopDestroy();
	}
	swiper.emit("breakpoint", breakpointParams);
}
var breakpoints = {
	setBreakpoint,
	getBreakpoint
};
function checkOverflow() {
	const swiper = this;
	const { isLocked: wasLocked, params } = swiper;
	const { slidesOffsetBefore } = params;
	if (slidesOffsetBefore) {
		const lastSlideIndex = swiper.slides.length - 1;
		const lastSlideRightEdge = swiper.slidesGrid[lastSlideIndex] + swiper.slidesSizesGrid[lastSlideIndex] + slidesOffsetBefore * 2;
		swiper.isLocked = swiper.size > lastSlideRightEdge;
	} else swiper.isLocked = swiper.snapGrid.length === 1;
	if (params.allowSlideNext === true) swiper.allowSlideNext = !swiper.isLocked;
	if (params.allowSlidePrev === true) swiper.allowSlidePrev = !swiper.isLocked;
	if (wasLocked && wasLocked !== swiper.isLocked) swiper.isEnd = false;
	if (wasLocked !== swiper.isLocked) swiper.emit(swiper.isLocked ? "lock" : "unlock");
}
var checkOverflow$1 = { checkOverflow };
function prepareClasses(entries, prefix) {
	const resultClasses = [];
	entries.forEach((item) => {
		if (typeof item === "object") Object.keys(item).forEach((classNames) => {
			if (item[classNames]) resultClasses.push(prefix + classNames);
		});
		else if (typeof item === "string") resultClasses.push(prefix + item);
	});
	return resultClasses;
}
function addClasses() {
	const swiper = this;
	const { classNames, params, rtl, el, device } = swiper;
	const suffixes = prepareClasses([
		"initialized",
		params.direction,
		{ "free-mode": swiper.params.freeMode && params.freeMode.enabled },
		{ "autoheight": params.autoHeight },
		{ "rtl": rtl },
		{ "grid": params.grid && params.grid.rows > 1 },
		{ "grid-column": params.grid && params.grid.rows > 1 && params.grid.fill === "column" },
		{ "android": device.android },
		{ "ios": device.ios },
		{ "css-mode": params.cssMode },
		{ "centered": params.cssMode && params.centeredSlides },
		{ "watch-progress": params.watchSlidesProgress }
	], params.containerModifierClass);
	classNames.push(...suffixes);
	el.classList.add(...classNames);
	swiper.emitContainerClasses();
}
function removeClasses() {
	const swiper = this;
	const { el, classNames } = swiper;
	if (!el || typeof el === "string") return;
	el.classList.remove(...classNames);
	swiper.emitContainerClasses();
}
var classes = {
	addClasses,
	removeClasses
};
var defaults = {
	init: true,
	direction: "horizontal",
	oneWayMovement: false,
	swiperElementNodeName: "SWIPER-CONTAINER",
	touchEventsTarget: "wrapper",
	initialSlide: 0,
	speed: 300,
	cssMode: false,
	updateOnWindowResize: true,
	resizeObserver: true,
	nested: false,
	createElements: false,
	eventsPrefix: "swiper",
	enabled: true,
	focusableElements: "input, select, option, textarea, button, video, label",
	width: null,
	height: null,
	preventInteractionOnTransition: false,
	userAgent: null,
	url: null,
	edgeSwipeDetection: false,
	edgeSwipeThreshold: 20,
	autoHeight: false,
	setWrapperSize: false,
	virtualTranslate: false,
	effect: "slide",
	breakpoints: void 0,
	breakpointsBase: "window",
	spaceBetween: 0,
	slidesPerView: 1,
	slidesPerGroup: 1,
	slidesPerGroupSkip: 0,
	slidesPerGroupAuto: false,
	centeredSlides: false,
	centeredSlidesBounds: false,
	slidesOffsetBefore: 0,
	slidesOffsetAfter: 0,
	normalizeSlideIndex: true,
	centerInsufficientSlides: false,
	snapToSlideEdge: false,
	watchOverflow: true,
	roundLengths: false,
	touchRatio: 1,
	touchAngle: 45,
	simulateTouch: true,
	shortSwipes: true,
	longSwipes: true,
	longSwipesRatio: .5,
	longSwipesMs: 300,
	followFinger: true,
	allowTouchMove: true,
	threshold: 5,
	touchMoveStopPropagation: false,
	touchStartPreventDefault: true,
	touchStartForcePreventDefault: false,
	touchReleaseOnEdges: false,
	uniqueNavElements: true,
	resistance: true,
	resistanceRatio: .85,
	watchSlidesProgress: false,
	grabCursor: false,
	preventClicks: true,
	preventClicksPropagation: true,
	slideToClickedSlide: false,
	loop: false,
	loopAddBlankSlides: true,
	loopAdditionalSlides: 0,
	loopPreventsSliding: true,
	rewind: false,
	allowSlidePrev: true,
	allowSlideNext: true,
	swipeHandler: null,
	noSwiping: true,
	noSwipingClass: "swiper-no-swiping",
	noSwipingSelector: null,
	passiveListeners: true,
	maxBackfaceHiddenSlides: 10,
	containerModifierClass: "swiper-",
	slideClass: "swiper-slide",
	slideBlankClass: "swiper-slide-blank",
	slideActiveClass: "swiper-slide-active",
	slideVisibleClass: "swiper-slide-visible",
	slideFullyVisibleClass: "swiper-slide-fully-visible",
	slideNextClass: "swiper-slide-next",
	slidePrevClass: "swiper-slide-prev",
	wrapperClass: "swiper-wrapper",
	lazyPreload: true,
	lazyPreloaderClass: "swiper-lazy-preloader",
	lazyPreloadPrevNext: 0,
	runCallbacksOnInit: true,
	_emitClasses: false
};
var eventsEmitter = {
	on(events, handler, priority) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (typeof handler !== "function") return self;
		const method = priority ? "unshift" : "push";
		events.split(" ").forEach((event) => {
			if (!self.eventsListeners[event]) self.eventsListeners[event] = [];
			self.eventsListeners[event][method](handler);
		});
		return self;
	},
	once(events, handler, priority) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (typeof handler !== "function") return self;
		const onceHandler = function onceHandlerFn(...args) {
			self.off(events, onceHandler);
			if (onceHandler.__emitterProxy) delete onceHandler.__emitterProxy;
			handler.apply(self, args);
		};
		onceHandler.__emitterProxy = handler;
		return self.on(events, onceHandler, priority);
	},
	onAny(handler, priority) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (typeof handler !== "function") return self;
		const method = priority ? "unshift" : "push";
		if (self.eventsAnyListeners.indexOf(handler) < 0) self.eventsAnyListeners[method](handler);
		return self;
	},
	offAny(handler) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (!self.eventsAnyListeners) return self;
		const index = self.eventsAnyListeners.indexOf(handler);
		if (index >= 0) self.eventsAnyListeners.splice(index, 1);
		return self;
	},
	off(events, handler) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (!self.eventsListeners) return self;
		events.split(" ").forEach((event) => {
			if (typeof handler === "undefined") self.eventsListeners[event] = [];
			else if (self.eventsListeners[event]) self.eventsListeners[event].forEach((eventHandler, index) => {
				if (eventHandler === handler || eventHandler.__emitterProxy && eventHandler.__emitterProxy === handler) self.eventsListeners[event].splice(index, 1);
			});
		});
		return self;
	},
	emit(...args) {
		const self = this;
		if (!self.eventsListeners || self.destroyed) return self;
		if (!self.eventsListeners) return self;
		let events;
		let data;
		let context;
		if (typeof args[0] === "string" || Array.isArray(args[0])) {
			events = args[0];
			data = args.slice(1, args.length);
			context = self;
		} else {
			const opts = args[0];
			events = opts.events;
			data = opts.data ?? [];
			context = opts.context || self;
		}
		data.unshift(context);
		(Array.isArray(events) ? events : events.split(" ")).forEach((event) => {
			if (self.eventsAnyListeners && self.eventsAnyListeners.length) self.eventsAnyListeners.forEach((eventHandler) => {
				eventHandler.apply(context, [event, ...data]);
			});
			if (self.eventsListeners && self.eventsListeners[event]) self.eventsListeners[event].forEach((eventHandler) => {
				eventHandler.apply(context, data);
			});
		});
		return self;
	}
};
function onClick(e) {
	const swiper = this;
	if (swiper.destroyed) return;
	if (!swiper.enabled) return;
	if (!swiper.allowClick) {
		if (swiper.params.preventClicks) e.preventDefault();
		if (swiper.params.preventClicksPropagation && swiper.animating) {
			e.stopPropagation();
			e.stopImmediatePropagation();
		}
	}
}
function onDocumentTouchStart() {
	const swiper = this;
	if (swiper.destroyed) return;
	if (swiper.documentTouchHandlerProceeded) return;
	swiper.documentTouchHandlerProceeded = true;
	if (swiper.params.touchReleaseOnEdges) swiper.el.style.touchAction = "auto";
}
function onLoad(e) {
	const swiper = this;
	if (swiper.destroyed) return;
	processLazyPreloader(swiper, e.target);
	if (swiper.params.cssMode || swiper.params.slidesPerView !== "auto" && !swiper.params.autoHeight) return;
	swiper.update();
}
function onResize() {
	const swiper = this;
	const { params, el } = swiper;
	if (el && el.offsetWidth === 0) return;
	if (params.breakpoints) swiper.setBreakpoint();
	const { allowSlideNext, allowSlidePrev, snapGrid } = swiper;
	const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
	swiper.allowSlideNext = true;
	swiper.allowSlidePrev = true;
	swiper.updateSize();
	swiper.updateSlides();
	swiper.updateSlidesClasses();
	const isVirtualLoop = isVirtual && params.loop;
	if ((params.slidesPerView === "auto" || params.slidesPerView > 1) && swiper.isEnd && !swiper.isBeginning && !swiper.params.centeredSlides && !isVirtualLoop) {
		const slidesLength = isVirtual ? swiper.virtual.slides.length : swiper.slides.length;
		swiper.slideTo(slidesLength - 1, 0, false, true);
	} else if (swiper.params.loop && !isVirtual) swiper.slideToLoop(swiper.realIndex, 0, false, true);
	else swiper.slideTo(swiper.activeIndex, 0, false, true);
	if (swiper.autoplay && swiper.autoplay.running && swiper.autoplay.paused) {
		const autoplay = swiper.autoplay;
		clearTimeout(autoplay.resizeTimeout);
		autoplay.resizeTimeout = setTimeout(() => {
			if (swiper.autoplay && swiper.autoplay.running && swiper.autoplay.paused) swiper.autoplay.resume();
		}, 500);
	}
	swiper.allowSlidePrev = allowSlidePrev;
	swiper.allowSlideNext = allowSlideNext;
	if (swiper.params.watchOverflow && snapGrid !== swiper.snapGrid) swiper.checkOverflow();
}
function onScroll() {
	const swiper = this;
	if (swiper.destroyed) return;
	const { wrapperEl, rtlTranslate, enabled } = swiper;
	if (!enabled) return;
	swiper.previousTranslate = swiper.translate;
	if (swiper.isHorizontal()) swiper.translate = -wrapperEl.scrollLeft;
	else swiper.translate = -wrapperEl.scrollTop;
	if (swiper.translate === 0) swiper.translate = 0;
	swiper.updateActiveIndex();
	swiper.updateSlidesClasses();
	let newProgress;
	const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
	if (translatesDiff === 0) newProgress = 0;
	else newProgress = (swiper.translate - swiper.minTranslate()) / translatesDiff;
	if (newProgress !== swiper.progress) swiper.updateProgress(rtlTranslate ? -swiper.translate : swiper.translate);
	swiper.emit("setTranslate", swiper.translate, false);
}
function onTouchEnd(event) {
	const swiper = this;
	if (swiper.destroyed) return;
	const data = swiper.touchEventsData;
	let e = event.originalEvent ?? event;
	if (!(e.type === "touchend" || e.type === "touchcancel")) {
		if (data.touchId !== null) return;
		if (e.pointerId !== data.pointerId) return;
	} else {
		const found = [...e.changedTouches].find((t) => t.identifier === data.touchId);
		if (!found || found.identifier !== data.touchId) return;
	}
	if ([
		"pointercancel",
		"pointerout",
		"pointerleave",
		"contextmenu"
	].includes(e.type)) {
		if (!(["pointercancel", "contextmenu"].includes(e.type) && (swiper.browser.isSafari || swiper.browser.isWebView))) return;
	}
	data.pointerId = null;
	data.touchId = null;
	const { params, touches, rtlTranslate: rtl, slidesGrid, enabled } = swiper;
	if (!enabled) return;
	if (!params.simulateTouch && e.pointerType === "mouse") return;
	if (data.allowTouchCallbacks) swiper.emit("touchEnd", e);
	data.allowTouchCallbacks = false;
	if (!data.isTouched) {
		if (data.isMoved && params.grabCursor) swiper.setGrabCursor(false);
		data.isMoved = false;
		data.startMoving = false;
		return;
	}
	if (params.grabCursor && data.isMoved && data.isTouched && (swiper.allowSlideNext === true || swiper.allowSlidePrev === true)) swiper.setGrabCursor(false);
	const touchEndTime = now();
	const timeDiff = touchEndTime - data.touchStartTime;
	if (swiper.allowClick) {
		const pathTree = e.path ?? (e.composedPath && e.composedPath());
		swiper.updateClickedSlide(pathTree && pathTree[0], pathTree);
		swiper.emit("tap click", e);
		if (timeDiff < 300 && touchEndTime - data.lastClickTime < 300) swiper.emit("doubleTap doubleClick", e);
	}
	data.lastClickTime = now();
	nextTick(() => {
		if (!swiper.destroyed) swiper.allowClick = true;
	});
	if (!data.isTouched || !data.isMoved || !swiper.swipeDirection || touches.diff === 0 && !data.loopSwapReset || data.currentTranslate === data.startTranslate && !data.loopSwapReset) {
		data.isTouched = false;
		data.isMoved = false;
		data.startMoving = false;
		return;
	}
	data.isTouched = false;
	data.isMoved = false;
	data.startMoving = false;
	let currentPos;
	if (params.followFinger) currentPos = rtl ? swiper.translate : -swiper.translate;
	else currentPos = -(data.currentTranslate ?? 0);
	if (params.cssMode) return;
	if (params.freeMode && params.freeMode.enabled) {
		swiper.freeMode.onTouchEnd({ currentPos });
		return;
	}
	const swipeToLast = currentPos >= -swiper.maxTranslate() && !swiper.params.loop;
	let stopIndex = 0;
	let groupSize = swiper.slidesSizesGrid[0];
	for (let i = 0; i < slidesGrid.length; i += i < params.slidesPerGroupSkip ? 1 : params.slidesPerGroup) {
		const increment = i < params.slidesPerGroupSkip - 1 ? 1 : params.slidesPerGroup;
		if (typeof slidesGrid[i + increment] !== "undefined") {
			if (swipeToLast || currentPos >= slidesGrid[i] && currentPos < slidesGrid[i + increment]) {
				stopIndex = i;
				groupSize = slidesGrid[i + increment] - slidesGrid[i];
			}
		} else if (swipeToLast || currentPos >= slidesGrid[i]) {
			stopIndex = i;
			groupSize = slidesGrid[slidesGrid.length - 1] - slidesGrid[slidesGrid.length - 2];
		}
	}
	let rewindFirstIndex = null;
	let rewindLastIndex = null;
	if (params.rewind) {
		if (swiper.isBeginning) rewindLastIndex = params.virtual?.enabled && swiper.virtual ? swiper.virtual.slides.length - 1 : swiper.slides.length - 1;
		else if (swiper.isEnd) rewindFirstIndex = 0;
	}
	const ratio = (currentPos - slidesGrid[stopIndex]) / groupSize;
	const increment = stopIndex < params.slidesPerGroupSkip - 1 ? 1 : params.slidesPerGroup;
	if (timeDiff > params.longSwipesMs) {
		if (!params.longSwipes) {
			swiper.slideTo(swiper.activeIndex);
			return;
		}
		if (swiper.swipeDirection === "next") {
			if (ratio >= params.longSwipesRatio) swiper.slideTo(params.rewind && swiper.isEnd ? rewindFirstIndex : stopIndex + increment);
			else swiper.slideTo(stopIndex);
		}
		if (swiper.swipeDirection === "prev") {
			if (ratio > 1 - params.longSwipesRatio) swiper.slideTo(stopIndex + increment);
			else if (rewindLastIndex !== null && ratio < 0 && Math.abs(ratio) > params.longSwipesRatio) swiper.slideTo(rewindLastIndex);
			else swiper.slideTo(stopIndex);
		}
	} else {
		if (!params.shortSwipes) {
			swiper.slideTo(swiper.activeIndex);
			return;
		}
		if (!(swiper.navigation && (e.target === swiper.navigation.nextEl || e.target === swiper.navigation.prevEl))) {
			if (swiper.swipeDirection === "next") swiper.slideTo(rewindFirstIndex !== null ? rewindFirstIndex : stopIndex + increment);
			if (swiper.swipeDirection === "prev") swiper.slideTo(rewindLastIndex !== null ? rewindLastIndex : stopIndex);
		} else if (e.target === swiper.navigation.nextEl) swiper.slideTo(stopIndex + increment);
		else swiper.slideTo(stopIndex);
	}
}
function onTouchMove(event) {
	const swiper = this;
	if (swiper.destroyed) return;
	const data = swiper.touchEventsData;
	const { params, touches, rtlTranslate: rtl, enabled } = swiper;
	if (!enabled) return;
	if (!params.simulateTouch && event.pointerType === "mouse") return;
	const wrapped = event;
	const e = wrapped.originalEvent ?? wrapped;
	if (e.type === "pointermove") {
		if (data.touchId !== null) return;
		if (e.pointerId !== data.pointerId) return;
	}
	let targetTouch;
	if (e.type === "touchmove") {
		const found = [...e.changedTouches].find((t) => t.identifier === data.touchId);
		if (!found || found.identifier !== data.touchId) return;
		targetTouch = found;
	} else targetTouch = e;
	if (!data.isTouched) {
		if (data.startMoving && data.isScrolling) swiper.emit("touchMoveOpposite", e);
		return;
	}
	const pageX = targetTouch.pageX;
	const pageY = targetTouch.pageY;
	if (e.preventedByNestedSwiper) {
		touches.startX = pageX;
		touches.startY = pageY;
		return;
	}
	if (!swiper.allowTouchMove) {
		if (!e.target.matches(data.focusableElements)) swiper.allowClick = false;
		if (data.isTouched) {
			Object.assign(touches, {
				startX: pageX,
				startY: pageY,
				currentX: pageX,
				currentY: pageY
			});
			data.touchStartTime = now();
		}
		return;
	}
	if (params.touchReleaseOnEdges && !params.loop) {
		if (swiper.isVertical()) {
			if (pageY < touches.startY && swiper.translate <= swiper.maxTranslate() || pageY > touches.startY && swiper.translate >= swiper.minTranslate()) {
				data.isTouched = false;
				data.isMoved = false;
				return;
			}
		} else if (rtl && (pageX > touches.startX && -swiper.translate <= swiper.maxTranslate() || pageX < touches.startX && -swiper.translate >= swiper.minTranslate())) return;
		else if (!rtl && (pageX < touches.startX && swiper.translate <= swiper.maxTranslate() || pageX > touches.startX && swiper.translate >= swiper.minTranslate())) return;
	}
	if (document.activeElement && document.activeElement.matches(data.focusableElements) && document.activeElement !== e.target && e.pointerType !== "mouse") document.activeElement.blur();
	if (document.activeElement) {
		if (e.target === document.activeElement && e.target.matches(data.focusableElements)) {
			data.isMoved = true;
			swiper.allowClick = false;
			return;
		}
	}
	if (data.allowTouchCallbacks) swiper.emit("touchMove", e);
	touches.previousX = touches.currentX;
	touches.previousY = touches.currentY;
	touches.currentX = pageX;
	touches.currentY = pageY;
	const diffX = touches.currentX - touches.startX;
	const diffY = touches.currentY - touches.startY;
	if (swiper.params.threshold && Math.sqrt(diffX ** 2 + diffY ** 2) < swiper.params.threshold) return;
	if (typeof data.isScrolling === "undefined") {
		let touchAngle;
		if (swiper.isHorizontal() && touches.currentY === touches.startY || swiper.isVertical() && touches.currentX === touches.startX) data.isScrolling = false;
		else if (diffX * diffX + diffY * diffY >= 25) {
			touchAngle = Math.atan2(Math.abs(diffY), Math.abs(diffX)) * 180 / Math.PI;
			data.isScrolling = swiper.isHorizontal() ? touchAngle > params.touchAngle : 90 - touchAngle > params.touchAngle;
		}
	}
	if (data.isScrolling) swiper.emit("touchMoveOpposite", e);
	if (typeof data.startMoving === "undefined") {
		if (touches.currentX !== touches.startX || touches.currentY !== touches.startY) data.startMoving = true;
	}
	if (data.isScrolling || e.type === "touchmove" && data.preventTouchMoveFromPointerMove) {
		data.isTouched = false;
		return;
	}
	if (!data.startMoving) return;
	swiper.allowClick = false;
	if (!params.cssMode && e.cancelable) e.preventDefault();
	if (params.touchMoveStopPropagation && !params.nested) e.stopPropagation();
	let diff = swiper.isHorizontal() ? diffX : diffY;
	let touchesDiff = swiper.isHorizontal() ? touches.currentX - touches.previousX : touches.currentY - touches.previousY;
	if (params.oneWayMovement) {
		diff = Math.abs(diff) * (rtl ? 1 : -1);
		touchesDiff = Math.abs(touchesDiff) * (rtl ? 1 : -1);
	}
	touches.diff = diff;
	diff *= params.touchRatio;
	if (rtl) {
		diff = -diff;
		touchesDiff = -touchesDiff;
	}
	const prevTouchesDirection = swiper.touchesDirection;
	swiper.swipeDirection = diff > 0 ? "prev" : "next";
	swiper.touchesDirection = touchesDiff > 0 ? "prev" : "next";
	const isLoop = swiper.params.loop && !params.cssMode;
	const allowLoopFix = swiper.touchesDirection === "next" && swiper.allowSlideNext || swiper.touchesDirection === "prev" && swiper.allowSlidePrev;
	if (!data.isMoved) {
		if (isLoop && allowLoopFix) swiper.loopFix({ direction: swiper.swipeDirection });
		data.startTranslate = swiper.getTranslate();
		swiper.setTransition(0);
		if (swiper.animating) {
			const evt = new window.CustomEvent("transitionend", {
				bubbles: true,
				cancelable: true,
				detail: { bySwiperTouchMove: true }
			});
			swiper.wrapperEl.dispatchEvent(evt);
		}
		data.allowMomentumBounce = false;
		if (params.grabCursor && (swiper.allowSlideNext === true || swiper.allowSlidePrev === true)) swiper.setGrabCursor(true);
		swiper.emit("sliderFirstMove", e);
	}
	(/* @__PURE__ */ new Date()).getTime();
	if (params._loopSwapReset !== false && data.isMoved && data.allowThresholdMove && prevTouchesDirection !== swiper.touchesDirection && isLoop && allowLoopFix && Math.abs(diff) >= 1) {
		Object.assign(touches, {
			startX: pageX,
			startY: pageY,
			currentX: pageX,
			currentY: pageY,
			startTranslate: data.currentTranslate
		});
		data.loopSwapReset = true;
		data.startTranslate = data.currentTranslate;
		return;
	}
	swiper.emit("sliderMove", e);
	data.isMoved = true;
	const startTranslate = data.startTranslate ?? 0;
	data.currentTranslate = diff + startTranslate;
	let disableParentSwiper = true;
	let resistanceRatio = params.resistanceRatio;
	if (params.touchReleaseOnEdges) resistanceRatio = 0;
	if (diff > 0) {
		if (isLoop && allowLoopFix && data.allowThresholdMove && data.currentTranslate > (params.centeredSlides ? swiper.minTranslate() - swiper.slidesSizesGrid[swiper.activeIndex + 1] - (params.slidesPerView !== "auto" && swiper.slides.length - params.slidesPerView >= 2 ? swiper.slidesSizesGrid[swiper.activeIndex + 1] + swiper.params.spaceBetween : 0) - swiper.params.spaceBetween : swiper.minTranslate())) swiper.loopFix({
			direction: "prev",
			setTranslate: true,
			activeSlideIndex: 0
		});
		if (data.currentTranslate > swiper.minTranslate()) {
			disableParentSwiper = false;
			if (params.resistance) data.currentTranslate = swiper.minTranslate() - 1 + (-swiper.minTranslate() + startTranslate + diff) ** resistanceRatio;
		}
	} else if (diff < 0) {
		if (isLoop && allowLoopFix && data.allowThresholdMove && data.currentTranslate < (params.centeredSlides ? swiper.maxTranslate() + swiper.slidesSizesGrid[swiper.slidesSizesGrid.length - 1] + swiper.params.spaceBetween + (params.slidesPerView !== "auto" && swiper.slides.length - params.slidesPerView >= 2 ? swiper.slidesSizesGrid[swiper.slidesSizesGrid.length - 1] + swiper.params.spaceBetween : 0) : swiper.maxTranslate())) swiper.loopFix({
			direction: "next",
			setTranslate: true,
			activeSlideIndex: swiper.slides.length - (params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : Math.ceil(parseFloat(String(params.slidesPerView))))
		});
		if (data.currentTranslate < swiper.maxTranslate()) {
			disableParentSwiper = false;
			if (params.resistance) data.currentTranslate = swiper.maxTranslate() + 1 - (swiper.maxTranslate() - startTranslate - diff) ** resistanceRatio;
		}
	}
	if (disableParentSwiper) e.preventedByNestedSwiper = true;
	if (!swiper.allowSlideNext && swiper.swipeDirection === "next" && (data.currentTranslate ?? 0) < startTranslate) data.currentTranslate = startTranslate;
	if (!swiper.allowSlidePrev && swiper.swipeDirection === "prev" && (data.currentTranslate ?? 0) > startTranslate) data.currentTranslate = startTranslate;
	if (!swiper.allowSlidePrev && !swiper.allowSlideNext) data.currentTranslate = startTranslate;
	if (params.threshold > 0) {
		if (Math.abs(diff) > params.threshold || data.allowThresholdMove) {
			if (!data.allowThresholdMove) {
				data.allowThresholdMove = true;
				touches.startX = touches.currentX;
				touches.startY = touches.currentY;
				data.currentTranslate = data.startTranslate;
				touches.diff = swiper.isHorizontal() ? touches.currentX - touches.startX : touches.currentY - touches.startY;
				return;
			}
		} else {
			data.currentTranslate = data.startTranslate;
			return;
		}
	}
	if (!params.followFinger || params.cssMode) return;
	if (params.freeMode && params.freeMode.enabled && swiper.freeMode || params.watchSlidesProgress) {
		swiper.updateActiveIndex();
		swiper.updateSlidesClasses();
	}
	if (params.freeMode && params.freeMode.enabled && swiper.freeMode) swiper.freeMode.onTouchMove();
	swiper.updateProgress(data.currentTranslate);
	swiper.setTranslate(data.currentTranslate ?? 0);
}
function closestElement(selector, base) {
	function __closestFrom(el) {
		if (!el || el === document || el === window) return null;
		let cur = el;
		if (cur.assignedSlot) cur = cur.assignedSlot;
		const found = cur.closest(selector);
		if (!found && !cur.getRootNode) return null;
		const root = cur.getRootNode();
		return found || __closestFrom(root.host);
	}
	return __closestFrom(base);
}
function preventEdgeSwipe(swiper, event, startX) {
	const { params } = swiper;
	const edgeSwipeDetection = params.edgeSwipeDetection;
	const edgeSwipeThreshold = params.edgeSwipeThreshold;
	if (edgeSwipeDetection && (startX <= edgeSwipeThreshold || startX >= window.innerWidth - edgeSwipeThreshold)) {
		if (edgeSwipeDetection === "prevent") {
			event.preventDefault();
			return true;
		}
		return false;
	}
	return true;
}
function onTouchStart(event) {
	const swiper = this;
	if (swiper.destroyed) return;
	const e = event.originalEvent ?? event;
	const data = swiper.touchEventsData;
	if (e.type === "pointerdown") {
		const pe = e;
		if (data.pointerId !== null && data.pointerId !== pe.pointerId) return;
		data.pointerId = pe.pointerId;
	} else if (e.type === "touchstart" && e.targetTouches.length === 1) data.touchId = e.targetTouches[0].identifier;
	if (e.type === "touchstart") {
		preventEdgeSwipe(swiper, e, e.targetTouches[0].pageX);
		return;
	}
	const { params, touches, enabled } = swiper;
	if (!enabled) return;
	if (!params.simulateTouch && e.pointerType === "mouse") return;
	if (swiper.animating && params.preventInteractionOnTransition) return;
	if (!swiper.animating && params.cssMode && params.loop) swiper.loopFix();
	let targetEl = e.target;
	if (params.touchEventsTarget === "wrapper") {
		if (!elementIsChildOf(targetEl, swiper.wrapperEl)) return;
	}
	const mouseLike = e;
	if (typeof mouseLike.which === "number" && mouseLike.which === 3) return;
	if (typeof mouseLike.button === "number" && mouseLike.button > 0) return;
	if (data.isTouched && data.isMoved) return;
	const swipingClassHasValue = !!params.noSwipingClass && params.noSwipingClass !== "";
	const eventPath = e.composedPath ? e.composedPath() : e.path;
	if (swipingClassHasValue && e.target && e.target.shadowRoot && eventPath) targetEl = eventPath[0];
	const noSwipingSelector = params.noSwipingSelector ? params.noSwipingSelector : `.${params.noSwipingClass}`;
	const isTargetShadow = !!(e.target && e.target.shadowRoot);
	if (params.noSwiping && (isTargetShadow ? closestElement(noSwipingSelector, targetEl) : targetEl.closest(noSwipingSelector))) {
		swiper.allowClick = true;
		return;
	}
	if (params.swipeHandler) {
		if (typeof params.swipeHandler === "string" && !targetEl.closest(params.swipeHandler)) return;
	}
	const pe = e;
	touches.currentX = pe.pageX;
	touches.currentY = pe.pageY;
	const startX = touches.currentX;
	const startY = touches.currentY;
	if (!preventEdgeSwipe(swiper, e, startX)) return;
	Object.assign(data, {
		isTouched: true,
		isMoved: false,
		allowTouchCallbacks: true,
		isScrolling: void 0,
		startMoving: void 0
	});
	touches.startX = startX;
	touches.startY = startY;
	data.touchStartTime = now();
	swiper.allowClick = true;
	swiper.updateSize();
	swiper.swipeDirection = void 0;
	if (params.threshold > 0) data.allowThresholdMove = false;
	let preventDefault = true;
	if (targetEl.matches(data.focusableElements)) {
		preventDefault = false;
		if (targetEl.nodeName === "SELECT") data.isTouched = false;
	}
	if (document.activeElement && document.activeElement.matches(data.focusableElements) && document.activeElement !== targetEl && (pe.pointerType === "mouse" || pe.pointerType !== "mouse" && !targetEl.matches(data.focusableElements))) document.activeElement.blur();
	const shouldPreventDefault = preventDefault && swiper.allowTouchMove && params.touchStartPreventDefault;
	if ((params.touchStartForcePreventDefault || shouldPreventDefault) && !targetEl.isContentEditable) e.preventDefault();
	if (params.freeMode && params.freeMode.enabled && swiper.freeMode && swiper.animating && !params.cssMode) swiper.freeMode.onTouchStart();
	swiper.emit("touchStart", e);
}
var events = (swiper, method) => {
	const { params, el, wrapperEl, device } = swiper;
	const capture = !!params.nested;
	const domMethod = method === "on" ? "addEventListener" : "removeEventListener";
	const swiperMethod = method;
	if (!el || typeof el === "string") return;
	document[domMethod]("touchstart", swiper.onDocumentTouchStart, {
		passive: false,
		capture
	});
	el[domMethod]("touchstart", swiper.onTouchStart, { passive: false });
	el[domMethod]("pointerdown", swiper.onTouchStart, { passive: false });
	document[domMethod]("touchmove", swiper.onTouchMove, {
		passive: false,
		capture
	});
	document[domMethod]("pointermove", swiper.onTouchMove, {
		passive: false,
		capture
	});
	document[domMethod]("touchend", swiper.onTouchEnd, { passive: true });
	document[domMethod]("pointerup", swiper.onTouchEnd, { passive: true });
	document[domMethod]("pointercancel", swiper.onTouchEnd, { passive: true });
	document[domMethod]("touchcancel", swiper.onTouchEnd, { passive: true });
	document[domMethod]("pointerout", swiper.onTouchEnd, { passive: true });
	document[domMethod]("pointerleave", swiper.onTouchEnd, { passive: true });
	document[domMethod]("contextmenu", swiper.onTouchEnd, { passive: true });
	if (params.preventClicks || params.preventClicksPropagation) el[domMethod]("click", swiper.onClick, true);
	if (params.cssMode) wrapperEl[domMethod]("scroll", swiper.onScroll);
	const subscribe = (events) => {
		swiper[swiperMethod](events, onResize, true);
	};
	if (params.updateOnWindowResize) subscribe(device.ios || device.android ? "resize orientationchange observerUpdate" : "resize observerUpdate");
	else subscribe("observerUpdate");
	if (params.lazyPreload) el[domMethod]("load", swiper.onLoad, { capture: true });
};
function attachEvents() {
	const swiper = this;
	const { params } = swiper;
	swiper.onTouchStart = onTouchStart.bind(swiper);
	swiper.onTouchMove = onTouchMove.bind(swiper);
	swiper.onTouchEnd = onTouchEnd.bind(swiper);
	swiper.onDocumentTouchStart = onDocumentTouchStart.bind(swiper);
	if (params.cssMode) swiper.onScroll = onScroll.bind(swiper);
	swiper.onClick = onClick.bind(swiper);
	swiper.onLoad = onLoad.bind(swiper);
	events(swiper, "on");
}
function detachEvents() {
	events(this, "off");
}
var events$1 = {
	attachEvents,
	detachEvents
};
function setGrabCursor(moving) {
	const swiper = this;
	if (!swiper.params.simulateTouch || swiper.params.watchOverflow && swiper.isLocked || swiper.params.cssMode) return;
	const el = swiper.params.touchEventsTarget === "container" ? swiper.el : swiper.wrapperEl;
	if (swiper.isElement) swiper.__preventObserver__ = true;
	el.style.cursor = "move";
	el.style.cursor = moving ? "grabbing" : "grab";
	if (swiper.isElement) requestAnimationFrame(() => {
		swiper.__preventObserver__ = false;
	});
}
function unsetGrabCursor() {
	const swiper = this;
	if (swiper.params.watchOverflow && swiper.isLocked || swiper.params.cssMode) return;
	if (swiper.isElement) swiper.__preventObserver__ = true;
	swiper[swiper.params.touchEventsTarget === "container" ? "el" : "wrapperEl"].style.cursor = "";
	if (swiper.isElement) requestAnimationFrame(() => {
		swiper.__preventObserver__ = false;
	});
}
var grabCursor = {
	setGrabCursor,
	unsetGrabCursor
};
function loopCreate(slideRealIndex, initial) {
	const swiper = this;
	const { params, slidesEl } = swiper;
	if (!params.loop || swiper.virtual && swiper.params.virtual?.enabled) return;
	const initSlides = () => {
		elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`).forEach((el, index) => {
			el.setAttribute("data-swiper-slide-index", String(index));
		});
	};
	const clearBlankSlides = () => {
		const slides = elementChildren(slidesEl, `.${params.slideBlankClass}`);
		slides.forEach((el) => {
			el.remove();
		});
		if (slides.length > 0) {
			swiper.recalcSlides();
			swiper.updateSlides();
		}
	};
	const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
	if (params.loopAddBlankSlides && (params.slidesPerGroup > 1 || gridEnabled)) clearBlankSlides();
	const slidesPerGroup = params.slidesPerGroup * (gridEnabled ? params.grid.rows : 1);
	const shouldFillGroup = swiper.slides.length % slidesPerGroup !== 0;
	const shouldFillGrid = gridEnabled && swiper.slides.length % params.grid.rows !== 0;
	const addBlankSlides = (amountOfSlides) => {
		for (let i = 0; i < amountOfSlides; i += 1) {
			const slideEl = swiper.isElement ? createElement("swiper-slide", [params.slideBlankClass]) : createElement("div", [params.slideClass, params.slideBlankClass]);
			swiper.slidesEl.append(slideEl);
		}
	};
	if (shouldFillGroup) {
		if (params.loopAddBlankSlides) {
			addBlankSlides(slidesPerGroup - swiper.slides.length % slidesPerGroup);
			swiper.recalcSlides();
			swiper.updateSlides();
		} else showWarning("Swiper Loop Warning: The number of slides is not even to slidesPerGroup, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
		initSlides();
	} else if (shouldFillGrid) {
		if (params.loopAddBlankSlides) {
			addBlankSlides(params.grid.rows - swiper.slides.length % params.grid.rows);
			swiper.recalcSlides();
			swiper.updateSlides();
		} else showWarning("Swiper Loop Warning: The number of slides is not even to grid.rows, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)");
		initSlides();
	} else initSlides();
	const bothDirections = params.centeredSlides || !!params.slidesOffsetBefore || !!params.slidesOffsetAfter;
	swiper.loopFix({
		slideRealIndex,
		direction: bothDirections ? void 0 : "next",
		initial
	});
}
function loopDestroy() {
	const swiper = this;
	const { params, slidesEl } = swiper;
	if (!params.loop || !slidesEl || swiper.virtual && swiper.params.virtual?.enabled) return;
	swiper.recalcSlides();
	const newSlidesOrder = [];
	swiper.slides.forEach((slideEl) => {
		const loopSlideEl = slideEl;
		const index = typeof loopSlideEl.swiperSlideIndex === "undefined" ? Number(slideEl.getAttribute("data-swiper-slide-index")) : loopSlideEl.swiperSlideIndex;
		newSlidesOrder[index] = slideEl;
	});
	swiper.slides.forEach((slideEl) => {
		slideEl.removeAttribute("data-swiper-slide-index");
	});
	newSlidesOrder.forEach((slideEl) => {
		slidesEl.append(slideEl);
	});
	swiper.recalcSlides();
	swiper.slideTo(swiper.realIndex, 0);
}
function loopFix(options = {}) {
	const { slideRealIndex, slideTo = true, direction, setTranslate, activeSlideIndex: activeSlideIndexParam, initial, byController, byMousewheel } = options;
	let activeSlideIndex = activeSlideIndexParam;
	const swiper = this;
	if (!swiper.params.loop) return;
	swiper.emit("beforeLoopFix");
	swiper.__loopFixInProgress__ = true;
	const { slides, allowSlidePrev, allowSlideNext, slidesEl, params } = swiper;
	const { centeredSlides, slidesOffsetBefore, slidesOffsetAfter, initialSlide } = params;
	const bothDirections = centeredSlides || !!slidesOffsetBefore || !!slidesOffsetAfter;
	swiper.allowSlidePrev = true;
	swiper.allowSlideNext = true;
	if (swiper.virtual && params.virtual?.enabled) {
		if (slideTo) {
			const virtualSlidesLength = swiper.virtual.slides.length;
			const virtualSlidesBefore = swiper.virtual.slidesBefore ?? 0;
			if (!bothDirections && swiper.snapIndex === 0) swiper.slideTo(virtualSlidesLength, 0, false, true);
			else if (bothDirections && swiper.snapIndex < params.slidesPerView) swiper.slideTo(virtualSlidesLength + swiper.snapIndex, 0, false, true);
			else if (swiper.snapIndex === swiper.snapGrid.length - 1) swiper.slideTo(virtualSlidesBefore, 0, false, true);
		}
		swiper.allowSlidePrev = allowSlidePrev;
		swiper.allowSlideNext = allowSlideNext;
		swiper.__loopFixInProgress__ = false;
		swiper.emit("loopFix");
		return;
	}
	let slidesPerView = params.slidesPerView;
	if (slidesPerView === "auto") slidesPerView = swiper.slidesPerViewDynamic();
	else {
		slidesPerView = Math.ceil(parseFloat(String(params.slidesPerView)));
		if (bothDirections && slidesPerView % 2 === 0) slidesPerView = slidesPerView + 1;
	}
	const slidesPerGroup = params.slidesPerGroupAuto ? slidesPerView : params.slidesPerGroup;
	const resolveOffset = (value) => (typeof value === "function" ? value.call(swiper) : value) || 0;
	const slidesGridStep = swiper.slidesGrid.length > 1 ? (swiper.slidesGrid[swiper.slidesGrid.length - 1] - swiper.slidesGrid[0]) / (swiper.slidesGrid.length - 1) : swiper.size;
	const offsetSlidesBefore = slidesGridStep > 0 ? resolveOffset(slidesOffsetBefore) / slidesGridStep : 0;
	const offsetSlidesAfter = slidesGridStep > 0 ? resolveOffset(slidesOffsetAfter) / slidesGridStep : 0;
	let loopedSlides = bothDirections ? Math.max(slidesPerGroup, (centeredSlides ? Math.ceil(slidesPerView / 2) : 0) + Math.ceil(Math.max(offsetSlidesBefore, offsetSlidesAfter))) : slidesPerGroup;
	if (loopedSlides % slidesPerGroup !== 0) loopedSlides += slidesPerGroup - loopedSlides % slidesPerGroup;
	loopedSlides += params.loopAdditionalSlides;
	swiper.loopedSlides = loopedSlides;
	const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
	if (slides.length < slidesPerView + loopedSlides || swiper.params.effect === "cards" && slides.length < slidesPerView + loopedSlides * 2) showWarning("Swiper Loop Warning: The number of slides is not enough for loop mode, it will be disabled or not function properly. You need to add more slides (or make duplicates) or lower the values of slidesPerView and slidesPerGroup parameters");
	else if (gridEnabled && params.grid.fill === "row") showWarning("Swiper Loop Warning: Loop mode is not compatible with grid.fill = `row`");
	const prependSlidesIndexes = [];
	const appendSlidesIndexes = [];
	const cols = gridEnabled ? Math.ceil(slides.length / params.grid.rows) : slides.length;
	const isInitialOverflow = initial && cols - initialSlide < slidesPerView && !bothDirections;
	let activeIndex = isInitialOverflow ? initialSlide : swiper.activeIndex;
	if (typeof activeSlideIndex === "undefined") activeSlideIndex = swiper.getSlideIndex(slides.find((el) => el.classList.contains(params.slideActiveClass)));
	else activeIndex = activeSlideIndex;
	const isNext = direction === "next" || !direction;
	const isPrev = direction === "prev" || !direction;
	let slidesPrepended = 0;
	let slidesAppended = 0;
	const activeColIndexWithShift = (gridEnabled ? slides[activeSlideIndex].column ?? 0 : activeSlideIndex) + (bothDirections && typeof setTranslate === "undefined" ? (centeredSlides ? -slidesPerView / 2 + .5 : 0) - offsetSlidesBefore : 0);
	if (activeColIndexWithShift < loopedSlides) {
		slidesPrepended = Math.max(loopedSlides - activeColIndexWithShift, slidesPerGroup);
		for (let i = 0; i < loopedSlides - activeColIndexWithShift; i += 1) {
			const index = i - Math.floor(i / cols) * cols;
			if (gridEnabled) {
				const colIndexToPrepend = cols - index - 1;
				for (let j = slides.length - 1; j >= 0; j -= 1) if (slides[j].column === colIndexToPrepend) prependSlidesIndexes.push(j);
			} else prependSlidesIndexes.push(cols - index - 1);
		}
	} else if (activeColIndexWithShift + slidesPerView > cols - loopedSlides) {
		slidesAppended = Math.max(activeColIndexWithShift - (cols - loopedSlides * 2), slidesPerGroup);
		if (isInitialOverflow) slidesAppended = Math.max(slidesAppended, slidesPerView - cols + initialSlide + 1);
		for (let i = 0; i < slidesAppended; i += 1) {
			const index = i - Math.floor(i / cols) * cols;
			if (gridEnabled) slides.forEach((slide, slideIndex) => {
				if (slide.column === index) appendSlidesIndexes.push(slideIndex);
			});
			else appendSlidesIndexes.push(index);
		}
	}
	swiper.__preventObserver__ = true;
	requestAnimationFrame(() => {
		swiper.__preventObserver__ = false;
	});
	if (swiper.params.effect === "cards" && slides.length < slidesPerView + loopedSlides * 2) {
		if (appendSlidesIndexes.includes(activeSlideIndex)) appendSlidesIndexes.splice(appendSlidesIndexes.indexOf(activeSlideIndex), 1);
		if (prependSlidesIndexes.includes(activeSlideIndex)) prependSlidesIndexes.splice(prependSlidesIndexes.indexOf(activeSlideIndex), 1);
	}
	if (isPrev) prependSlidesIndexes.forEach((index) => {
		const slideEl = slides[index];
		slideEl.swiperLoopMoveDOM = true;
		slidesEl.prepend(slideEl);
		slideEl.swiperLoopMoveDOM = false;
	});
	if (isNext) appendSlidesIndexes.forEach((index) => {
		const slideEl = slides[index];
		slideEl.swiperLoopMoveDOM = true;
		slidesEl.append(slideEl);
		slideEl.swiperLoopMoveDOM = false;
	});
	swiper.recalcSlides();
	if (params.slidesPerView === "auto") swiper.updateSlides();
	else if (gridEnabled && (prependSlidesIndexes.length > 0 && isPrev || appendSlidesIndexes.length > 0 && isNext)) swiper.slides.forEach((slide, slideIndex) => {
		swiper.grid.updateSlide(slideIndex, slide, swiper.slides);
	});
	if (params.watchSlidesProgress) swiper.updateSlidesOffset();
	if (slideTo) {
		if (prependSlidesIndexes.length > 0 && isPrev) {
			if (typeof slideRealIndex === "undefined") {
				const currentSlideTranslate = swiper.slidesGrid[activeIndex];
				const diff = swiper.slidesGrid[activeIndex + slidesPrepended] - currentSlideTranslate;
				if (byMousewheel) swiper.setTranslate(swiper.translate - diff);
				else {
					swiper.slideTo(activeIndex + Math.ceil(slidesPrepended), 0, false, true);
					if (setTranslate) {
						swiper.touchEventsData.startTranslate = swiper.touchEventsData.startTranslate - diff;
						swiper.touchEventsData.currentTranslate = swiper.touchEventsData.currentTranslate - diff;
					}
				}
			} else if (setTranslate) {
				const shift = gridEnabled ? prependSlidesIndexes.length / params.grid.rows : prependSlidesIndexes.length;
				swiper.slideTo(swiper.activeIndex + shift, 0, false, true);
				swiper.touchEventsData.currentTranslate = swiper.translate;
			}
		} else if (appendSlidesIndexes.length > 0 && isNext) {
			if (typeof slideRealIndex === "undefined") {
				const currentSlideTranslate = swiper.slidesGrid[activeIndex];
				const diff = swiper.slidesGrid[activeIndex - slidesAppended] - currentSlideTranslate;
				if (byMousewheel) swiper.setTranslate(swiper.translate - diff);
				else {
					swiper.slideTo(activeIndex - slidesAppended, 0, false, true);
					if (setTranslate) {
						swiper.touchEventsData.startTranslate = swiper.touchEventsData.startTranslate - diff;
						swiper.touchEventsData.currentTranslate = swiper.touchEventsData.currentTranslate - diff;
					}
				}
			} else {
				const shift = gridEnabled ? appendSlidesIndexes.length / params.grid.rows : appendSlidesIndexes.length;
				swiper.slideTo(swiper.activeIndex - shift, 0, false, true);
			}
		}
	}
	swiper.allowSlidePrev = allowSlidePrev;
	swiper.allowSlideNext = allowSlideNext;
	const controlled = swiper.controller?.control;
	if (controlled && !byController) {
		const loopParams = {
			slideRealIndex,
			direction,
			setTranslate,
			activeSlideIndex,
			byController: true
		};
		if (Array.isArray(controlled)) controlled.forEach((c) => {
			if (!c.destroyed && c.params.loop) c.loopFix({
				...loopParams,
				slideTo: c.params.slidesPerView === params.slidesPerView ? slideTo : false
			});
		});
		else if (controlled instanceof swiper.constructor && controlled.params.loop) controlled.loopFix({
			...loopParams,
			slideTo: controlled.params.slidesPerView === params.slidesPerView ? slideTo : false
		});
	}
	swiper.__loopFixInProgress__ = false;
	swiper.emit("loopFix");
}
var loop = {
	loopCreate,
	loopFix,
	loopDestroy
};
function moduleExtendParams(params, allModulesParams) {
	return function extendParams(obj = {}) {
		const moduleParamName = Object.keys(obj)[0];
		const moduleParams = obj[moduleParamName];
		if (typeof moduleParams !== "object" || moduleParams === null) {
			extend(allModulesParams, obj);
			return;
		}
		if (params[moduleParamName] === true) params[moduleParamName] = { enabled: true };
		if (moduleParamName === "navigation" && params[moduleParamName] && params[moduleParamName].enabled && !params[moduleParamName].prevEl && !params[moduleParamName].nextEl) params[moduleParamName].auto = true;
		if (["pagination", "scrollbar"].indexOf(moduleParamName) >= 0 && params[moduleParamName] && params[moduleParamName].enabled && !params[moduleParamName].el) params[moduleParamName].auto = true;
		if (!(moduleParamName in params && "enabled" in moduleParams)) {
			extend(allModulesParams, obj);
			return;
		}
		if (typeof params[moduleParamName] === "object" && !("enabled" in params[moduleParamName])) params[moduleParamName].enabled = true;
		if (!params[moduleParamName]) params[moduleParamName] = { enabled: false };
		extend(allModulesParams, obj);
	};
}
var Observer = ({ swiper, extendParams, on }) => {
	const observers = [];
	const attach = (target, options = {}) => {
		const ObserverFunc = window.MutationObserver || window.WebkitMutationObserver;
		if (!ObserverFunc) return;
		const observer = new ObserverFunc((mutations) => {
			if (swiper.__preventObserver__) return;
			if (mutations.length === 1) {
				swiper.emit("observerUpdate", mutations[0]);
				return;
			}
			const observerUpdate = function observerUpdate() {
				swiper.emit("observerUpdate", mutations[0]);
			};
			if (window.requestAnimationFrame) window.requestAnimationFrame(observerUpdate);
			else window.setTimeout(observerUpdate, 0);
		});
		observer.observe(target, {
			attributes: typeof options.attributes === "undefined" ? true : options.attributes,
			childList: swiper.isElement || (typeof options.childList === "undefined" ? true : options.childList),
			characterData: typeof options.characterData === "undefined" ? true : options.characterData
		});
		observers.push(observer);
	};
	const init = () => {
		if (!swiper.params.observer) return;
		if (swiper.params.observeParents) {
			const containerParents = elementParents(swiper.hostEl);
			for (let i = 0; i < containerParents.length; i += 1) attach(containerParents[i]);
		}
		attach(swiper.hostEl, { childList: swiper.params.observeSlideChildren });
		attach(swiper.wrapperEl, { attributes: false });
	};
	const destroy = () => {
		observers.forEach((observer) => {
			observer.disconnect();
		});
		observers.splice(0, observers.length);
	};
	extendParams({
		observer: false,
		observeParents: false,
		observeSlideChildren: false
	});
	on("init", init);
	on("destroy", destroy);
};
var Resize = ({ swiper, on, emit }) => {
	let observer = null;
	let animationFrame = null;
	const resizeHandler = () => {
		if (!swiper || swiper.destroyed || !swiper.initialized) return;
		emit("beforeResize");
		emit("resize");
	};
	const createObserver = () => {
		if (!swiper || swiper.destroyed || !swiper.initialized) return;
		observer = new ResizeObserver((entries) => {
			animationFrame = window.requestAnimationFrame(() => {
				const { width, height } = swiper;
				let newWidth = width;
				let newHeight = height;
				entries.forEach(({ contentBoxSize, contentRect, target }) => {
					if (target && target !== swiper.el) return;
					const box = Array.isArray(contentBoxSize) ? contentBoxSize[0] : contentBoxSize;
					newWidth = contentRect ? contentRect.width : box.inlineSize;
					newHeight = contentRect ? contentRect.height : box.blockSize;
				});
				if (newWidth !== width || newHeight !== height) resizeHandler();
			});
		});
		observer.observe(swiper.el);
	};
	const removeObserver = () => {
		if (animationFrame) window.cancelAnimationFrame(animationFrame);
		if (observer && observer.unobserve && swiper.el) {
			observer.unobserve(swiper.el);
			observer = null;
		}
	};
	const orientationChangeHandler = () => {
		if (!swiper || swiper.destroyed || !swiper.initialized) return;
		emit("orientationchange");
	};
	on("init", () => {
		if (swiper.params.resizeObserver && typeof window.ResizeObserver !== "undefined") {
			createObserver();
			return;
		}
		window.addEventListener("resize", resizeHandler);
		window.addEventListener("orientationchange", orientationChangeHandler);
	});
	on("destroy", () => {
		removeObserver();
		window.removeEventListener("resize", resizeHandler);
		window.removeEventListener("orientationchange", orientationChangeHandler);
	});
};
function slideNext(speed, runCallbacks = true, internal) {
	const swiper = this;
	const { enabled, params, animating } = swiper;
	if (!enabled || swiper.destroyed) return swiper;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	let perGroup = params.slidesPerGroup;
	if (params.slidesPerView === "auto" && params.slidesPerGroup === 1 && params.slidesPerGroupAuto) perGroup = Math.max(swiper.slidesPerViewDynamic("current", true), 1);
	const increment = swiper.activeIndex < params.slidesPerGroupSkip ? 1 : perGroup;
	const isVirtual = swiper.virtual && params.virtual?.enabled;
	if (params.loop) {
		if (animating && !isVirtual && params.loopPreventsSliding) return false;
		swiper.loopFix({ direction: "next" });
		swiper._clientLeft = swiper.wrapperEl.clientLeft;
		if (swiper.activeIndex === swiper.slides.length - 1 && params.cssMode) {
			requestAnimationFrame(() => {
				swiper.slideTo(swiper.activeIndex + increment, speed, runCallbacks, internal);
			});
			return true;
		}
	}
	if (params.rewind && swiper.isEnd) return swiper.slideTo(0, speed, runCallbacks, internal);
	return swiper.slideTo(swiper.activeIndex + increment, speed, runCallbacks, internal);
}
function slidePrev(speed, runCallbacks = true, internal) {
	const swiper = this;
	const { params, snapGrid, slidesGrid, rtlTranslate, enabled, animating } = swiper;
	if (!enabled || swiper.destroyed) return swiper;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	const isVirtual = swiper.virtual && params.virtual?.enabled;
	if (params.loop) {
		if (animating && !isVirtual && params.loopPreventsSliding) return false;
		swiper.loopFix({ direction: "prev" });
		swiper._clientLeft = swiper.wrapperEl.clientLeft;
	}
	const translate = rtlTranslate ? swiper.translate : -swiper.translate;
	function normalize(val) {
		if (val < 0) return -Math.floor(Math.abs(val));
		return Math.floor(val);
	}
	const normalizedTranslate = normalize(translate);
	const normalizedSnapGrid = snapGrid.map((val) => normalize(val));
	const isFreeMode = params.freeMode && params.freeMode.enabled;
	let prevSnap = snapGrid[normalizedSnapGrid.indexOf(normalizedTranslate) - 1];
	if (typeof prevSnap === "undefined" && (params.cssMode || isFreeMode)) {
		let prevSnapIndex;
		snapGrid.forEach((snap, snapIndex) => {
			if (normalizedTranslate >= snap) prevSnapIndex = snapIndex;
		});
		if (typeof prevSnapIndex !== "undefined") prevSnap = isFreeMode ? snapGrid[prevSnapIndex] : snapGrid[prevSnapIndex > 0 ? prevSnapIndex - 1 : prevSnapIndex];
	}
	let prevIndex = 0;
	if (typeof prevSnap !== "undefined") {
		prevIndex = slidesGrid.indexOf(prevSnap);
		if (prevIndex < 0) prevIndex = swiper.activeIndex - 1;
		if (params.slidesPerView === "auto" && params.slidesPerGroup === 1 && params.slidesPerGroupAuto) {
			prevIndex = prevIndex - swiper.slidesPerViewDynamic("previous", true) + 1;
			prevIndex = Math.max(prevIndex, 0);
		}
	}
	if (params.rewind && swiper.isBeginning) {
		const lastIndex = swiper.params.virtual?.enabled && swiper.virtual ? swiper.virtual.slides.length - 1 : swiper.slides.length - 1;
		return swiper.slideTo(lastIndex, speed, runCallbacks, internal);
	} else if (params.loop && swiper.activeIndex === 0 && params.cssMode) {
		requestAnimationFrame(() => {
			swiper.slideTo(prevIndex, speed, runCallbacks, internal);
		});
		return true;
	}
	return swiper.slideTo(prevIndex, speed, runCallbacks, internal);
}
function slideReset(speed, runCallbacks = true, internal) {
	const swiper = this;
	if (swiper.destroyed) return;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	return swiper.slideTo(swiper.activeIndex, speed, runCallbacks, internal);
}
function slideTo(index = 0, speed, runCallbacks = true, internal, initial) {
	if (typeof index === "string") index = parseInt(index, 10);
	const swiper = this;
	let slideIndex = index;
	if (slideIndex < 0) slideIndex = 0;
	const { params, snapGrid, slidesGrid, previousIndex, activeIndex, rtlTranslate: rtl, wrapperEl, enabled } = swiper;
	if (!enabled && !internal && !initial || swiper.destroyed || swiper.animating && params.preventInteractionOnTransition) return false;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	const skip = Math.min(swiper.params.slidesPerGroupSkip, slideIndex);
	let snapIndex = skip + Math.floor((slideIndex - skip) / swiper.params.slidesPerGroup);
	if (snapIndex >= snapGrid.length) snapIndex = snapGrid.length - 1;
	const translate = -snapGrid[snapIndex];
	if (params.normalizeSlideIndex) for (let i = 0; i < slidesGrid.length; i += 1) {
		const normalizedTranslate = -Math.floor(translate * 100);
		const normalizedGrid = Math.floor(slidesGrid[i] * 100);
		const normalizedGridNext = Math.floor(slidesGrid[i + 1] * 100);
		if (typeof slidesGrid[i + 1] !== "undefined") {
			if (normalizedTranslate >= normalizedGrid && normalizedTranslate < normalizedGridNext - (normalizedGridNext - normalizedGrid) / 2) slideIndex = i;
			else if (normalizedTranslate >= normalizedGrid && normalizedTranslate < normalizedGridNext) slideIndex = i + 1;
		} else if (normalizedTranslate >= normalizedGrid) slideIndex = i;
	}
	if (swiper.initialized && slideIndex !== activeIndex) {
		if (!swiper.allowSlideNext && (rtl ? translate > swiper.translate && translate > swiper.minTranslate() : translate < swiper.translate && translate < swiper.minTranslate())) return false;
		if (!swiper.allowSlidePrev && translate > swiper.translate && translate > swiper.maxTranslate()) {
			if ((activeIndex || 0) !== slideIndex) return false;
		}
	}
	if (slideIndex !== (previousIndex || 0) && runCallbacks) swiper.emit("beforeSlideChangeStart");
	swiper.updateProgress(translate);
	let direction;
	if (slideIndex > activeIndex) direction = "next";
	else if (slideIndex < activeIndex) direction = "prev";
	else direction = "reset";
	const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
	if (!(isVirtual && initial) && (rtl && -translate === swiper.translate || !rtl && translate === swiper.translate)) {
		swiper.updateActiveIndex(slideIndex);
		if (params.autoHeight) swiper.updateAutoHeight();
		swiper.updateSlidesClasses();
		if (params.effect !== "slide") swiper.setTranslate(translate);
		if (direction !== "reset") {
			swiper.transitionStart(runCallbacks, direction);
			swiper.transitionEnd(runCallbacks, direction);
		}
		return false;
	}
	if (params.cssMode) {
		const isH = swiper.isHorizontal();
		const t = rtl ? translate : -translate;
		if (speed === 0) {
			if (isVirtual) {
				swiper.wrapperEl.style.scrollSnapType = "none";
				swiper._immediateVirtual = true;
			}
			if (isVirtual && !swiper._cssModeVirtualInitialSet && (swiper.params.initialSlide ?? 0) > 0) {
				swiper._cssModeVirtualInitialSet = true;
				requestAnimationFrame(() => {
					wrapperEl[isH ? "scrollLeft" : "scrollTop"] = t;
				});
			} else wrapperEl[isH ? "scrollLeft" : "scrollTop"] = t;
			if (isVirtual) requestAnimationFrame(() => {
				swiper.wrapperEl.style.scrollSnapType = "";
				swiper._immediateVirtual = false;
			});
		} else wrapperEl.scrollTo({
			[isH ? "left" : "top"]: t,
			behavior: "smooth"
		});
		return true;
	}
	const isSafari = getBrowser().isSafari;
	if (isVirtual && !initial && isSafari && swiper.isElement) swiper.virtual.update(false, false, slideIndex);
	swiper.setTransition(speed);
	swiper.setTranslate(translate);
	swiper.updateActiveIndex(slideIndex);
	swiper.updateSlidesClasses();
	swiper.emit("beforeTransitionStart", speed, internal);
	swiper.transitionStart(runCallbacks, direction);
	if (speed === 0) swiper.transitionEnd(runCallbacks, direction);
	else if (!swiper.animating) {
		swiper.animating = true;
		if (!swiper.onSlideToWrapperTransitionEnd) swiper.onSlideToWrapperTransitionEnd = function transitionEnd(e) {
			if (!swiper || swiper.destroyed) return;
			if (e.target !== this) return;
			swiper.wrapperEl.removeEventListener("transitionend", swiper.onSlideToWrapperTransitionEnd);
			swiper.onSlideToWrapperTransitionEnd = null;
			delete swiper.onSlideToWrapperTransitionEnd;
			swiper.transitionEnd(runCallbacks, direction);
		};
		swiper.wrapperEl.addEventListener("transitionend", swiper.onSlideToWrapperTransitionEnd);
	}
	return true;
}
function slideToClickedSlide() {
	const swiper = this;
	if (swiper.destroyed) return;
	const { params, slidesEl, clickedSlide, clickedIndex } = swiper;
	if (clickedSlide === void 0 || clickedIndex === void 0) return;
	const slidesPerView = params.slidesPerView === "auto" ? swiper.slidesPerViewDynamic() : params.slidesPerView;
	let slideToIndex = swiper.getSlideIndexWhenGrid(clickedIndex);
	let realIndex;
	const slideSelector = swiper.isElement ? `swiper-slide` : `.${params.slideClass}`;
	const isGrid = swiper.grid && swiper.params.grid && swiper.params.grid.rows > 1;
	if (params.loop) {
		if (swiper.animating) return;
		realIndex = parseInt(clickedSlide.getAttribute("data-swiper-slide-index"), 10);
		if (params.centeredSlides) swiper.slideToLoop(realIndex);
		else if (slideToIndex > (isGrid ? (swiper.slides.length - slidesPerView) / 2 - (swiper.params.grid.rows - 1) : swiper.slides.length - slidesPerView)) {
			swiper.loopFix();
			slideToIndex = swiper.getSlideIndex(elementChildren(slidesEl, `${slideSelector}[data-swiper-slide-index="${realIndex}"]`)[0]);
			nextTick(() => {
				swiper.slideTo(slideToIndex);
			});
		} else swiper.slideTo(slideToIndex);
	} else swiper.slideTo(slideToIndex);
}
function slideToClosest(speed, runCallbacks = true, internal, threshold = .5) {
	const swiper = this;
	if (swiper.destroyed) return;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	let index = swiper.activeIndex;
	const skip = Math.min(swiper.params.slidesPerGroupSkip, index);
	const snapIndex = skip + Math.floor((index - skip) / swiper.params.slidesPerGroup);
	const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
	if (translate >= swiper.snapGrid[snapIndex]) {
		const currentSnap = swiper.snapGrid[snapIndex];
		const nextSnap = swiper.snapGrid[snapIndex + 1];
		if (translate - currentSnap > (nextSnap - currentSnap) * threshold) index += swiper.params.slidesPerGroup;
	} else {
		const prevSnap = swiper.snapGrid[snapIndex - 1];
		const currentSnap = swiper.snapGrid[snapIndex];
		if (translate - prevSnap <= (currentSnap - prevSnap) * threshold) index -= swiper.params.slidesPerGroup;
	}
	index = Math.max(index, 0);
	index = Math.min(index, swiper.slidesGrid.length - 1);
	return swiper.slideTo(index, speed, runCallbacks, internal);
}
function slideToLoop(index = 0, speed, runCallbacks = true, internal) {
	if (typeof index === "string") index = parseInt(index, 10);
	const swiper = this;
	if (swiper.destroyed) return;
	if (typeof speed === "undefined") speed = swiper.params.speed;
	const gridEnabled = swiper.grid && swiper.params.grid && swiper.params.grid.rows > 1;
	let newIndex = index;
	if (swiper.params.loop) {
		if (swiper.virtual && swiper.params.virtual?.enabled) newIndex = newIndex + (swiper.virtual.slidesBefore ?? 0);
		else {
			let targetSlideIndex;
			if (gridEnabled) {
				const slideIndex = newIndex * swiper.params.grid.rows;
				targetSlideIndex = swiper.slides.find((slideEl) => Number(slideEl.getAttribute("data-swiper-slide-index")) === slideIndex)?.column ?? 0;
			} else targetSlideIndex = swiper.getSlideIndexByData(newIndex);
			const cols = gridEnabled ? Math.ceil(swiper.slides.length / swiper.params.grid.rows) : swiper.slides.length;
			const { centeredSlides, slidesOffsetBefore, slidesOffsetAfter } = swiper.params;
			const bothDirections = centeredSlides || !!slidesOffsetBefore || !!slidesOffsetAfter;
			let slidesPerView;
			if (swiper.params.slidesPerView === "auto") slidesPerView = swiper.slidesPerViewDynamic();
			else {
				slidesPerView = Math.ceil(parseFloat(String(swiper.params.slidesPerView)));
				if (bothDirections && slidesPerView % 2 === 0) slidesPerView = slidesPerView + 1;
			}
			let needLoopFix = cols - targetSlideIndex < slidesPerView;
			if (bothDirections) needLoopFix = needLoopFix || targetSlideIndex < Math.ceil(slidesPerView / 2);
			if (internal && bothDirections && swiper.params.slidesPerView !== "auto" && !gridEnabled) needLoopFix = false;
			if (needLoopFix) {
				const direction = bothDirections ? targetSlideIndex < swiper.activeIndex ? "prev" : "next" : targetSlideIndex - swiper.activeIndex - 1 < swiper.params.slidesPerView ? "next" : "prev";
				swiper.loopFix({
					direction,
					slideTo: true,
					activeSlideIndex: direction === "next" ? targetSlideIndex + 1 : targetSlideIndex - cols + 1,
					slideRealIndex: direction === "next" ? swiper.realIndex : void 0
				});
			}
			if (gridEnabled) {
				const slideIndex = newIndex * swiper.params.grid.rows;
				newIndex = swiper.slides.find((slideEl) => Number(slideEl.getAttribute("data-swiper-slide-index")) === slideIndex)?.column ?? 0;
			} else newIndex = swiper.getSlideIndexByData(newIndex);
		}
	}
	requestAnimationFrame(() => {
		swiper.slideTo(newIndex, speed, runCallbacks, internal);
	});
	return swiper;
}
var slide = {
	slideTo,
	slideToLoop,
	slideNext,
	slidePrev,
	slideReset,
	slideToClosest,
	slideToClickedSlide
};
function setTransition(duration, byController) {
	const swiper = this;
	if (!swiper.params.cssMode) {
		swiper.wrapperEl.style.transitionDuration = `${duration}ms`;
		swiper.wrapperEl.style.transitionDelay = duration === 0 ? `0ms` : "";
	}
	swiper.emit("setTransition", duration, byController);
}
function transitionEmit({ swiper, runCallbacks, direction, step }) {
	const { activeIndex, previousIndex } = swiper;
	let dir = direction;
	if (!dir) {
		if (activeIndex > previousIndex) dir = "next";
		else if (activeIndex < previousIndex) dir = "prev";
		else dir = "reset";
	}
	swiper.emit(`transition${step}`);
	if (runCallbacks && dir === "reset") swiper.emit(`slideResetTransition${step}`);
	else if (runCallbacks && activeIndex !== previousIndex) {
		swiper.emit(`slideChangeTransition${step}`);
		if (dir === "next") swiper.emit(`slideNextTransition${step}`);
		else swiper.emit(`slidePrevTransition${step}`);
	}
}
function transitionEnd(runCallbacks = true, direction) {
	const swiper = this;
	const { params } = swiper;
	swiper.animating = false;
	if (params.cssMode) return;
	swiper.setTransition(0);
	transitionEmit({
		swiper,
		runCallbacks,
		direction,
		step: "End"
	});
}
function transitionStart(runCallbacks = true, direction) {
	const swiper = this;
	const { params } = swiper;
	if (params.cssMode) return;
	if (params.autoHeight) swiper.updateAutoHeight();
	transitionEmit({
		swiper,
		runCallbacks,
		direction,
		step: "Start"
	});
}
var transition = {
	setTransition,
	transitionStart,
	transitionEnd
};
function getSwiperTranslate(axis = this.isHorizontal() ? "x" : "y") {
	const swiper = this;
	const { params, rtlTranslate: rtl, translate, wrapperEl } = swiper;
	if (params.virtualTranslate) return rtl ? -translate : translate;
	if (params.cssMode) return translate;
	let currentTranslate = getTranslate(wrapperEl, axis);
	currentTranslate += swiper.cssOverflowAdjustment();
	if (rtl) currentTranslate = -currentTranslate;
	return currentTranslate || 0;
}
function maxTranslate() {
	return -this.snapGrid[this.snapGrid.length - 1];
}
function minTranslate() {
	return -this.snapGrid[0];
}
function setTranslate(translate, byController) {
	const swiper = this;
	const { rtlTranslate: rtl, params, wrapperEl, progress } = swiper;
	let x = 0;
	let y = 0;
	const z = 0;
	if (swiper.isHorizontal()) x = rtl ? -translate : translate;
	else y = translate;
	if (params.roundLengths) {
		x = Math.floor(x);
		y = Math.floor(y);
	}
	swiper.previousTranslate = swiper.translate;
	swiper.translate = swiper.isHorizontal() ? x : y;
	if (params.cssMode) wrapperEl[swiper.isHorizontal() ? "scrollLeft" : "scrollTop"] = swiper.isHorizontal() ? -x : -y;
	else if (!params.virtualTranslate) {
		if (swiper.isHorizontal()) x -= swiper.cssOverflowAdjustment();
		else y -= swiper.cssOverflowAdjustment();
		wrapperEl.style.transform = `translate3d(${x}px, ${y}px, ${z}px)`;
	}
	let newProgress;
	const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
	if (translatesDiff === 0) newProgress = 0;
	else newProgress = (translate - swiper.minTranslate()) / translatesDiff;
	if (newProgress !== progress) swiper.updateProgress(translate);
	swiper.emit("setTranslate", swiper.translate, byController);
}
function translateTo(translate = 0, speed = this.params.speed, runCallbacks = true, translateBounds = true, internal) {
	const swiper = this;
	const { params, wrapperEl } = swiper;
	if (swiper.animating && params.preventInteractionOnTransition) return false;
	const minTranslate = swiper.minTranslate();
	const maxTranslate = swiper.maxTranslate();
	let newTranslate;
	if (translateBounds && translate > minTranslate) newTranslate = minTranslate;
	else if (translateBounds && translate < maxTranslate) newTranslate = maxTranslate;
	else newTranslate = translate;
	swiper.updateProgress(newTranslate);
	if (params.cssMode) {
		const isH = swiper.isHorizontal();
		if (speed === 0) wrapperEl[isH ? "scrollLeft" : "scrollTop"] = -newTranslate;
		else wrapperEl.scrollTo({
			[isH ? "left" : "top"]: -newTranslate,
			behavior: "smooth"
		});
		return true;
	}
	if (speed === 0) {
		swiper.setTransition(0);
		swiper.setTranslate(newTranslate);
		if (runCallbacks) {
			swiper.emit("beforeTransitionStart", speed, internal);
			swiper.emit("transitionEnd");
		}
	} else {
		swiper.setTransition(speed);
		swiper.setTranslate(newTranslate);
		if (runCallbacks) {
			swiper.emit("beforeTransitionStart", speed, internal);
			swiper.emit("transitionStart");
		}
		if (!swiper.animating) {
			swiper.animating = true;
			if (!swiper.onTranslateToWrapperTransitionEnd) swiper.onTranslateToWrapperTransitionEnd = function transitionEnd(e) {
				if (!swiper || swiper.destroyed) return;
				if (e.target !== this) return;
				swiper.wrapperEl.removeEventListener("transitionend", swiper.onTranslateToWrapperTransitionEnd);
				swiper.onTranslateToWrapperTransitionEnd = null;
				delete swiper.onTranslateToWrapperTransitionEnd;
				swiper.animating = false;
				if (runCallbacks) swiper.emit("transitionEnd");
			};
			swiper.wrapperEl.addEventListener("transitionend", swiper.onTranslateToWrapperTransitionEnd);
		}
	}
	return true;
}
var translate = {
	getTranslate: getSwiperTranslate,
	setTranslate,
	minTranslate,
	maxTranslate,
	translateTo
};
function getActiveIndexByTranslate(swiper) {
	const { slidesGrid, params } = swiper;
	const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
	let activeIndex;
	for (let i = 0; i < slidesGrid.length; i += 1) if (typeof slidesGrid[i + 1] !== "undefined") {
		if (translate >= slidesGrid[i] && translate < slidesGrid[i + 1] - (slidesGrid[i + 1] - slidesGrid[i]) / 2) activeIndex = i;
		else if (translate >= slidesGrid[i] && translate < slidesGrid[i + 1]) activeIndex = i + 1;
	} else if (translate >= slidesGrid[i]) activeIndex = i;
	if (params.normalizeSlideIndex) {
		if (activeIndex < 0 || typeof activeIndex === "undefined") activeIndex = 0;
	}
	return activeIndex;
}
function updateActiveIndex(newActiveIndex) {
	const swiper = this;
	const translate = swiper.rtlTranslate ? swiper.translate : -swiper.translate;
	const { snapGrid, params, activeIndex: previousIndex, realIndex: previousRealIndex, snapIndex: previousSnapIndex } = swiper;
	let activeIndex = newActiveIndex;
	let snapIndex;
	const getVirtualRealIndex = (aIndex) => {
		const virtualSlides = swiper.virtual.slides;
		let realIndex = aIndex - (swiper.virtual.slidesBefore ?? 0);
		if (realIndex < 0) realIndex = virtualSlides.length + realIndex;
		if (realIndex >= virtualSlides.length) realIndex -= virtualSlides.length;
		return realIndex;
	};
	if (typeof activeIndex === "undefined") activeIndex = getActiveIndexByTranslate(swiper);
	if (snapGrid.indexOf(translate) >= 0) snapIndex = snapGrid.indexOf(translate);
	else {
		const skip = Math.min(params.slidesPerGroupSkip, activeIndex);
		snapIndex = skip + Math.floor((activeIndex - skip) / params.slidesPerGroup);
	}
	if (snapIndex >= snapGrid.length) snapIndex = snapGrid.length - 1;
	if (activeIndex === previousIndex && !swiper.params.loop) {
		if (snapIndex !== previousSnapIndex) {
			swiper.snapIndex = snapIndex;
			swiper.emit("snapIndexChange");
		}
		return;
	}
	if (activeIndex === previousIndex && swiper.params.loop && swiper.virtual && swiper.params.virtual?.enabled) {
		swiper.realIndex = getVirtualRealIndex(activeIndex);
		return;
	}
	const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
	let realIndex;
	if (swiper.virtual && params.virtual?.enabled) {
		if (params.loop) realIndex = getVirtualRealIndex(activeIndex);
		else realIndex = activeIndex;
	} else if (gridEnabled) {
		const firstSlideInColumn = swiper.slides.find((slideEl) => slideEl.column === activeIndex);
		let activeSlideIndex = parseInt(firstSlideInColumn.getAttribute("data-swiper-slide-index"), 10);
		if (Number.isNaN(activeSlideIndex)) activeSlideIndex = Math.max(swiper.slides.indexOf(firstSlideInColumn), 0);
		realIndex = Math.floor(activeSlideIndex / params.grid.rows);
	} else if (swiper.slides[activeIndex]) {
		const slideIndex = swiper.slides[activeIndex].getAttribute("data-swiper-slide-index");
		if (slideIndex) realIndex = parseInt(slideIndex, 10);
		else realIndex = activeIndex;
	} else realIndex = activeIndex;
	Object.assign(swiper, {
		previousSnapIndex,
		snapIndex,
		previousRealIndex,
		realIndex,
		previousIndex,
		activeIndex
	});
	if (swiper.initialized) preload(swiper);
	if (swiper.__loopFixInProgress__) return;
	swiper.emit("activeIndexChange");
	swiper.emit("snapIndexChange");
	if (swiper.initialized || swiper.params.runCallbacksOnInit) {
		if ((swiper.__lastEmittedRealIndex__ ?? previousRealIndex) !== realIndex) swiper.emit("realIndexChange");
		swiper.emit("slideChange");
	}
	swiper.__lastEmittedRealIndex__ = realIndex;
}
function updateAutoHeight(speed) {
	const swiper = this;
	const activeSlides = [];
	const isVirtual = swiper.virtual && swiper.params.virtual?.enabled;
	let newHeight = 0;
	let i;
	if (typeof speed === "number") swiper.setTransition(speed);
	else if (speed === true) swiper.setTransition(swiper.params.speed);
	const getSlideByIndex = (index) => {
		if (isVirtual) return swiper.slides[swiper.getSlideIndexByData(index)];
		return swiper.slides[index];
	};
	if (swiper.params.slidesPerView !== "auto" && swiper.params.slidesPerView > 1) {
		if (swiper.params.centeredSlides) (swiper.visibleSlides || []).forEach((slide) => {
			activeSlides.push(slide);
		});
		else for (i = 0; i < Math.ceil(swiper.params.slidesPerView); i += 1) {
			const index = swiper.activeIndex + i;
			if (index > swiper.slides.length && !isVirtual) break;
			const slide = getSlideByIndex(index);
			if (slide) activeSlides.push(slide);
		}
	} else {
		const slide = getSlideByIndex(swiper.activeIndex);
		if (slide) activeSlides.push(slide);
	}
	for (i = 0; i < activeSlides.length; i += 1) if (typeof activeSlides[i] !== "undefined") {
		const height = activeSlides[i].offsetHeight;
		newHeight = height > newHeight ? height : newHeight;
	}
	if (newHeight || newHeight === 0) swiper.wrapperEl.style.height = `${newHeight}px`;
}
function updateClickedSlide(el, path) {
	const swiper = this;
	const params = swiper.params;
	let slide = el.closest(`.${params.slideClass}, swiper-slide`);
	if (!slide && swiper.isElement && path && path.length > 1 && path.includes(el)) [...path.slice(path.indexOf(el) + 1, path.length)].forEach((pathEl) => {
		if (!slide && pathEl.matches && pathEl.matches(`.${params.slideClass}, swiper-slide`)) slide = pathEl;
	});
	let slideFound = false;
	let slideIndex;
	if (slide) {
		for (let i = 0; i < swiper.slides.length; i += 1) if (swiper.slides[i] === slide) {
			slideFound = true;
			slideIndex = i;
			break;
		}
	}
	if (slide && slideFound) {
		swiper.clickedSlide = slide;
		if (swiper.virtual && swiper.params.virtual?.enabled) swiper.clickedIndex = parseInt(slide.getAttribute("data-swiper-slide-index"), 10);
		else swiper.clickedIndex = slideIndex;
	} else {
		swiper.clickedSlide = void 0;
		swiper.clickedIndex = void 0;
		return;
	}
	if (params.slideToClickedSlide && swiper.clickedIndex !== void 0 && swiper.clickedIndex !== swiper.activeIndex) swiper.slideToClickedSlide();
}
function updateProgress(translate) {
	const swiper = this;
	if (typeof translate === "undefined") {
		const multiplier = swiper.rtlTranslate ? -1 : 1;
		translate = swiper && swiper.translate && swiper.translate * multiplier || 0;
	}
	const params = swiper.params;
	const translatesDiff = swiper.maxTranslate() - swiper.minTranslate();
	let { progress, isBeginning, isEnd } = swiper;
	let progressLoop = swiper.progressLoop;
	const wasBeginning = isBeginning;
	const wasEnd = isEnd;
	if (translatesDiff === 0) {
		progress = 0;
		isBeginning = true;
		isEnd = true;
	} else {
		progress = (translate - swiper.minTranslate()) / translatesDiff;
		const isBeginningRounded = Math.abs(translate - swiper.minTranslate()) < 1;
		const isEndRounded = Math.abs(translate - swiper.maxTranslate()) < 1;
		isBeginning = isBeginningRounded || progress <= 0;
		isEnd = isEndRounded || progress >= 1;
		if (isBeginningRounded) progress = 0;
		if (isEndRounded) progress = 1;
	}
	if (params.loop) {
		const firstSlideIndex = swiper.getSlideIndexByData(0);
		const lastSlideIndex = swiper.getSlideIndexByData(swiper.slides.length - 1);
		const firstSlideTranslate = swiper.slidesGrid[firstSlideIndex];
		const lastSlideTranslate = swiper.slidesGrid[lastSlideIndex];
		const translateMax = swiper.slidesGrid[swiper.slidesGrid.length - 1];
		const translateAbs = Math.abs(translate);
		if (translateAbs >= firstSlideTranslate) progressLoop = (translateAbs - firstSlideTranslate) / translateMax;
		else progressLoop = (translateAbs + translateMax - lastSlideTranslate) / translateMax;
		if (progressLoop > 1) progressLoop -= 1;
	}
	Object.assign(swiper, {
		progress,
		progressLoop,
		isBeginning,
		isEnd
	});
	if (params.watchSlidesProgress || params.centeredSlides && params.autoHeight) swiper.updateSlidesProgress(translate);
	if (isBeginning && !wasBeginning) swiper.emit("reachBeginning toEdge");
	if (isEnd && !wasEnd) swiper.emit("reachEnd toEdge");
	if (wasBeginning && !isBeginning || wasEnd && !isEnd) swiper.emit("fromEdge");
	swiper.emit("progress", progress);
}
function updateSize() {
	const swiper = this;
	let width;
	let height;
	const el = swiper.el;
	if (typeof swiper.params.width !== "undefined" && swiper.params.width !== null) width = swiper.params.width;
	else width = el.clientWidth;
	if (typeof swiper.params.height !== "undefined" && swiper.params.height !== null) height = swiper.params.height;
	else height = el.clientHeight;
	if (width === 0 && swiper.isHorizontal() || height === 0 && swiper.isVertical()) return;
	width = width - parseInt(elementStyle(el, "padding-left") || "0", 10) - parseInt(elementStyle(el, "padding-right") || "0", 10);
	height = height - parseInt(elementStyle(el, "padding-top") || "0", 10) - parseInt(elementStyle(el, "padding-bottom") || "0", 10);
	if (Number.isNaN(width)) width = 0;
	if (Number.isNaN(height)) height = 0;
	Object.assign(swiper, {
		width,
		height,
		size: swiper.isHorizontal() ? width : height
	});
}
function updateSlides() {
	const swiper = this;
	function getDirectionPropertyValue(node, label) {
		return parseFloat(node.getPropertyValue(swiper.getDirectionLabel(label)) || "0");
	}
	const params = swiper.params;
	const { wrapperEl, slidesEl, rtlTranslate: rtl, wrongRTL } = swiper;
	const isVirtual = !!(swiper.virtual && params.virtual?.enabled);
	const previousSlidesLength = isVirtual ? swiper.virtual.slides.length : swiper.slides.length;
	const slides = elementChildren(slidesEl, `.${swiper.params.slideClass}, swiper-slide`);
	const slidesLength = isVirtual ? swiper.virtual.slides.length : slides.length;
	let snapGrid = [];
	const slidesGrid = [];
	const slidesSizesGrid = [];
	const resolveOffset = (value) => typeof value === "function" ? value.call(swiper) : value;
	const offsetBefore = resolveOffset(params.slidesOffsetBefore);
	const offsetAfter = resolveOffset(params.slidesOffsetAfter);
	const previousSnapGridLength = swiper.snapGrid.length;
	const previousSlidesGridLength = swiper.slidesGrid.length;
	const swiperSize = swiper.size - offsetBefore - offsetAfter;
	let spaceBetween = params.spaceBetween;
	let slidePosition = -offsetBefore;
	let prevSlideSize = 0;
	let index = 0;
	if (typeof swiperSize === "undefined") return;
	if (typeof spaceBetween === "string" && spaceBetween.indexOf("%") >= 0) spaceBetween = parseFloat(spaceBetween.replace("%", "")) / 100 * swiperSize;
	else if (typeof spaceBetween === "string") spaceBetween = parseFloat(spaceBetween);
	swiper.virtualSize = -spaceBetween - offsetBefore - offsetAfter;
	slides.forEach((slideEl) => {
		if (rtl) slideEl.style.marginLeft = "";
		else slideEl.style.marginRight = "";
		slideEl.style.marginBottom = "";
		slideEl.style.marginTop = "";
	});
	if (params.centeredSlides && params.cssMode) {
		setCSSProperty(wrapperEl, "--swiper-centered-offset-before", "");
		setCSSProperty(wrapperEl, "--swiper-centered-offset-after", "");
	}
	if (params.cssMode) {
		setCSSProperty(wrapperEl, "--swiper-slides-offset-before", `${offsetBefore}px`);
		setCSSProperty(wrapperEl, "--swiper-slides-offset-after", `${offsetAfter}px`);
	}
	const gridEnabled = params.grid && params.grid.rows > 1 && swiper.grid;
	if (gridEnabled) swiper.grid.initSlides(slides);
	else if (swiper.grid) swiper.grid.unsetSlides();
	let slideSize = 0;
	const shouldResetSlideSize = params.slidesPerView === "auto" && params.breakpoints && Object.keys(params.breakpoints).filter((key) => {
		return typeof params.breakpoints[key]?.slidesPerView !== "undefined";
	}).length > 0;
	for (let i = 0; i < slidesLength; i += 1) {
		slideSize = 0;
		const slide = slides[i];
		if (slide) {
			if (gridEnabled) swiper.grid.updateSlide(i, slide, slides);
			if (elementStyle(slide, "display") === "none") continue;
		}
		if (isVirtual && params.slidesPerView === "auto") {
			if (params.virtual?.slidesPerViewAutoSlideSize) slideSize = params.virtual.slidesPerViewAutoSlideSize;
			if (slideSize && slide) {
				if (params.roundLengths) slideSize = Math.floor(slideSize);
				slide.style[swiper.getDirectionLabel("width")] = `${slideSize}px`;
			}
		} else if (params.slidesPerView === "auto") {
			if (shouldResetSlideSize) slide.style[swiper.getDirectionLabel("width")] = ``;
			const slideStyles = getComputedStyle(slide);
			const currentTransform = slide.style.transform;
			const currentWebKitTransform = slide.style.webkitTransform;
			if (currentTransform) slide.style.transform = "none";
			if (currentWebKitTransform) slide.style.webkitTransform = "none";
			if (params.roundLengths) slideSize = swiper.isHorizontal() ? elementOuterSize(slide, "width") : elementOuterSize(slide, "height");
			else {
				const width = getDirectionPropertyValue(slideStyles, "width");
				const paddingLeft = getDirectionPropertyValue(slideStyles, "padding-left");
				const paddingRight = getDirectionPropertyValue(slideStyles, "padding-right");
				const marginLeft = getDirectionPropertyValue(slideStyles, "margin-left");
				const marginRight = getDirectionPropertyValue(slideStyles, "margin-right");
				const boxSizing = slideStyles.getPropertyValue("box-sizing");
				if (boxSizing && boxSizing === "border-box") slideSize = width + marginLeft + marginRight;
				else {
					const { clientWidth, offsetWidth } = slide;
					slideSize = width + paddingLeft + paddingRight + marginLeft + marginRight + (offsetWidth - clientWidth);
				}
			}
			if (currentTransform) slide.style.transform = currentTransform;
			if (currentWebKitTransform) slide.style.webkitTransform = currentWebKitTransform;
			if (params.roundLengths) slideSize = Math.floor(slideSize);
		} else {
			slideSize = (swiperSize - (params.slidesPerView - 1) * spaceBetween) / params.slidesPerView;
			if (params.roundLengths) slideSize = Math.floor(slideSize);
			if (slide) slide.style[swiper.getDirectionLabel("width")] = `${slideSize}px`;
		}
		if (slide) slide.swiperSlideSize = slideSize;
		slidesSizesGrid.push(slideSize);
		if (params.centeredSlides) {
			slidePosition = slidePosition + slideSize / 2 + prevSlideSize / 2 + spaceBetween;
			if (prevSlideSize === 0 && i !== 0) slidePosition = slidePosition - swiperSize / 2 - spaceBetween;
			if (i === 0) slidePosition = slidePosition - swiperSize / 2 - spaceBetween;
			if (Math.abs(slidePosition) < 1 / 1e3) slidePosition = 0;
			if (params.roundLengths) slidePosition = Math.floor(slidePosition);
			if (index % params.slidesPerGroup === 0) snapGrid.push(slidePosition);
			slidesGrid.push(slidePosition);
		} else {
			if (params.roundLengths) slidePosition = Math.floor(slidePosition);
			if ((index - Math.min(swiper.params.slidesPerGroupSkip, index)) % swiper.params.slidesPerGroup === 0) snapGrid.push(slidePosition);
			slidesGrid.push(slidePosition);
			slidePosition = slidePosition + slideSize + spaceBetween;
		}
		swiper.virtualSize += slideSize + spaceBetween;
		prevSlideSize = slideSize;
		index += 1;
	}
	swiper.virtualSize = Math.max(swiper.virtualSize, swiperSize) + offsetAfter;
	if (rtl && wrongRTL && (params.effect === "slide" || params.effect === "coverflow")) wrapperEl.style.width = `${swiper.virtualSize + spaceBetween}px`;
	if (params.setWrapperSize) wrapperEl.style[swiper.getDirectionLabel("width")] = `${swiper.virtualSize + spaceBetween}px`;
	if (gridEnabled) swiper.grid.updateWrapperSize(slideSize, snapGrid);
	if (!params.centeredSlides) {
		const isFractionalSlidesPerView = params.slidesPerView !== "auto" && params.slidesPerView % 1 !== 0;
		const shouldSnapToSlideEdge = params.snapToSlideEdge && !params.loop && (params.slidesPerView === "auto" || isFractionalSlidesPerView);
		let lastAllowedSnapIndex = snapGrid.length;
		if (shouldSnapToSlideEdge) {
			let minVisibleSlides;
			if (params.slidesPerView === "auto") {
				minVisibleSlides = 1;
				let accumulatedSize = 0;
				for (let i = slidesSizesGrid.length - 1; i >= 0; i -= 1) {
					accumulatedSize += slidesSizesGrid[i] + (i < slidesSizesGrid.length - 1 ? spaceBetween : 0);
					if (accumulatedSize <= swiperSize) minVisibleSlides = slidesSizesGrid.length - i;
					else break;
				}
			} else minVisibleSlides = Math.floor(params.slidesPerView);
			lastAllowedSnapIndex = Math.max(slidesLength - minVisibleSlides, 0);
		}
		const newSlidesGrid = [];
		for (let i = 0; i < snapGrid.length; i += 1) {
			let slidesGridItem = snapGrid[i];
			if (params.roundLengths) slidesGridItem = Math.floor(slidesGridItem);
			if (shouldSnapToSlideEdge) {
				if (i <= lastAllowedSnapIndex) newSlidesGrid.push(slidesGridItem);
			} else if (snapGrid[i] <= swiper.virtualSize - swiperSize) newSlidesGrid.push(slidesGridItem);
		}
		snapGrid = newSlidesGrid;
		if (Math.floor(swiper.virtualSize - swiperSize) - Math.floor(snapGrid[snapGrid.length - 1]) > 1) {
			if (!shouldSnapToSlideEdge) snapGrid.push(swiper.virtualSize - swiperSize);
		}
	}
	if (isVirtual && params.loop) {
		const size = slidesSizesGrid[0] + spaceBetween;
		const virtualLoopCount = (swiper.virtual.slidesBefore ?? 0) + (swiper.virtual.slidesAfter ?? 0);
		if (params.slidesPerGroup > 1) {
			const groups = Math.ceil(virtualLoopCount / params.slidesPerGroup);
			const groupSize = size * params.slidesPerGroup;
			for (let i = 0; i < groups; i += 1) snapGrid.push(snapGrid[snapGrid.length - 1] + groupSize);
		}
		for (let i = 0; i < virtualLoopCount; i += 1) {
			if (params.slidesPerGroup === 1) snapGrid.push(snapGrid[snapGrid.length - 1] + size);
			slidesGrid.push(slidesGrid[slidesGrid.length - 1] + size);
			swiper.virtualSize += size;
		}
	}
	if (snapGrid.length === 0) snapGrid = [0];
	if (spaceBetween !== 0) {
		const key = swiper.isHorizontal() && rtl ? "marginLeft" : swiper.getDirectionLabel("marginRight");
		slides.filter((_, slideIndex) => {
			if (!params.cssMode || params.loop) return true;
			if (slideIndex === slides.length - 1) return false;
			return true;
		}).forEach((slideEl) => {
			slideEl.style[key] = `${spaceBetween}px`;
		});
	}
	if (params.centeredSlides && params.centeredSlidesBounds) {
		let allSlidesSize = 0;
		slidesSizesGrid.forEach((slideSizeValue) => {
			allSlidesSize += slideSizeValue + (spaceBetween || 0);
		});
		allSlidesSize -= spaceBetween;
		const maxSnap = allSlidesSize > swiperSize ? allSlidesSize - swiperSize : 0;
		snapGrid = snapGrid.map((snap) => {
			if (snap <= 0) return -offsetBefore;
			if (snap > maxSnap) return maxSnap + offsetAfter;
			return snap;
		});
	}
	if (params.centerInsufficientSlides) {
		let allSlidesSize = 0;
		slidesSizesGrid.forEach((slideSizeValue) => {
			allSlidesSize += slideSizeValue + (spaceBetween || 0);
		});
		allSlidesSize -= spaceBetween;
		if (allSlidesSize < swiperSize) {
			const allSlidesOffset = (swiperSize - allSlidesSize) / 2;
			snapGrid.forEach((snap, snapIndex) => {
				snapGrid[snapIndex] = snap - allSlidesOffset;
			});
			slidesGrid.forEach((snap, snapIndex) => {
				slidesGrid[snapIndex] = snap + allSlidesOffset;
			});
		}
	}
	Object.assign(swiper, {
		slides,
		snapGrid,
		slidesGrid,
		slidesSizesGrid
	});
	if (params.centeredSlides && params.cssMode && !params.centeredSlidesBounds) {
		setCSSProperty(wrapperEl, "--swiper-centered-offset-before", `${-snapGrid[0]}px`);
		setCSSProperty(wrapperEl, "--swiper-centered-offset-after", `${swiper.size / 2 - slidesSizesGrid[slidesSizesGrid.length - 1] / 2}px`);
		const addToSnapGrid = -swiper.snapGrid[0];
		const addToSlidesGrid = -swiper.slidesGrid[0];
		swiper.snapGrid = swiper.snapGrid.map((v) => v + addToSnapGrid);
		swiper.slidesGrid = swiper.slidesGrid.map((v) => v + addToSlidesGrid);
	}
	if (slidesLength !== previousSlidesLength) swiper.emit("slidesLengthChange");
	if (snapGrid.length !== previousSnapGridLength) {
		if (swiper.params.watchOverflow) swiper.checkOverflow();
		swiper.emit("snapGridLengthChange");
	}
	if (slidesGrid.length !== previousSlidesGridLength) swiper.emit("slidesGridLengthChange");
	if (params.watchSlidesProgress) swiper.updateSlidesOffset();
	swiper.emit("slidesUpdated");
	if (!isVirtual && !params.cssMode && (params.effect === "slide" || params.effect === "fade")) {
		const backFaceHiddenClass = `${params.containerModifierClass}backface-hidden`;
		const hasClassBackfaceClassAdded = swiper.el.classList.contains(backFaceHiddenClass);
		if (slidesLength <= params.maxBackfaceHiddenSlides) {
			if (!hasClassBackfaceClassAdded) swiper.el.classList.add(backFaceHiddenClass);
		} else if (hasClassBackfaceClassAdded) swiper.el.classList.remove(backFaceHiddenClass);
	}
}
var toggleSlideClasses$1 = (slideEl, condition, className) => {
	if (condition && !slideEl.classList.contains(className)) slideEl.classList.add(className);
	else if (!condition && slideEl.classList.contains(className)) slideEl.classList.remove(className);
};
function updateSlidesClasses() {
	const swiper = this;
	const { slides, params, slidesEl, activeIndex } = swiper;
	const isVirtual = !!(swiper.virtual && params.virtual?.enabled);
	const gridEnabled = swiper.grid && params.grid && params.grid.rows > 1;
	const getFilteredSlide = (selector) => {
		return elementChildren(slidesEl, `.${params.slideClass}${selector}, swiper-slide${selector}`)[0];
	};
	let activeSlide;
	let prevSlide;
	let nextSlide;
	if (isVirtual) {
		if (params.loop) {
			const virtualSlides = swiper.virtual.slides;
			let slideIndex = activeIndex - (swiper.virtual.slidesBefore ?? 0);
			if (slideIndex < 0) slideIndex = virtualSlides.length + slideIndex;
			if (slideIndex >= virtualSlides.length) slideIndex -= virtualSlides.length;
			activeSlide = getFilteredSlide(`[data-swiper-slide-index="${slideIndex}"]`);
		} else activeSlide = getFilteredSlide(`[data-swiper-slide-index="${activeIndex}"]`);
	} else if (gridEnabled) {
		activeSlide = slides.find((slideEl) => slideEl.column === activeIndex);
		nextSlide = slides.find((slideEl) => slideEl.column === activeIndex + 1);
		prevSlide = slides.find((slideEl) => slideEl.column === activeIndex - 1);
	} else activeSlide = slides[activeIndex];
	if (activeSlide) {
		if (!gridEnabled) {
			nextSlide = elementNextAll(activeSlide, `.${params.slideClass}, swiper-slide`)[0];
			if (params.loop && !nextSlide) nextSlide = slides[0];
			prevSlide = elementPrevAll(activeSlide, `.${params.slideClass}, swiper-slide`)[0];
			if (params.loop && false);
		}
	}
	slides.forEach((slideEl) => {
		toggleSlideClasses$1(slideEl, slideEl === activeSlide, params.slideActiveClass);
		toggleSlideClasses$1(slideEl, slideEl === nextSlide, params.slideNextClass);
		toggleSlideClasses$1(slideEl, slideEl === prevSlide, params.slidePrevClass);
	});
	swiper.emitSlidesClasses();
}
function updateSlidesOffset() {
	const swiper = this;
	const slides = swiper.slides;
	const minusOffset = swiper.isElement ? swiper.isHorizontal() ? swiper.wrapperEl.offsetLeft : swiper.wrapperEl.offsetTop : 0;
	for (let i = 0; i < slides.length; i += 1) slides[i].swiperSlideOffset = (swiper.isHorizontal() ? slides[i].offsetLeft : slides[i].offsetTop) - minusOffset - swiper.cssOverflowAdjustment();
}
var toggleSlideClasses = (slideEl, condition, className) => {
	if (condition && !slideEl.classList.contains(className)) slideEl.classList.add(className);
	else if (!condition && slideEl.classList.contains(className)) slideEl.classList.remove(className);
};
function updateSlidesProgress(translate = this && this.translate || 0) {
	const swiper = this;
	const params = swiper.params;
	const { slides, rtlTranslate: rtl, snapGrid } = swiper;
	if (slides.length === 0) return;
	if (typeof slides[0].swiperSlideOffset === "undefined") swiper.updateSlidesOffset();
	let offsetCenter = -translate;
	if (rtl) offsetCenter = translate;
	swiper.visibleSlidesIndexes = [];
	swiper.visibleSlides = [];
	let spaceBetween = params.spaceBetween;
	if (typeof spaceBetween === "string" && spaceBetween.indexOf("%") >= 0) spaceBetween = parseFloat(spaceBetween.replace("%", "")) / 100 * swiper.size;
	else if (typeof spaceBetween === "string") spaceBetween = parseFloat(spaceBetween);
	for (let i = 0; i < slides.length; i += 1) {
		const slide = slides[i];
		let slideOffset = slide.swiperSlideOffset ?? 0;
		if (params.cssMode && params.centeredSlides) slideOffset -= slides[0].swiperSlideOffset ?? 0;
		const slideSize = slide.swiperSlideSize ?? 0;
		const slideProgress = (offsetCenter + (params.centeredSlides ? swiper.minTranslate() : 0) - slideOffset) / (slideSize + spaceBetween);
		const originalSlideProgress = (offsetCenter - snapGrid[0] + (params.centeredSlides ? swiper.minTranslate() : 0) - slideOffset) / (slideSize + spaceBetween);
		const slideBefore = -(offsetCenter - slideOffset);
		const slideAfter = slideBefore + swiper.slidesSizesGrid[i];
		const isFullyVisible = slideBefore >= 0 && slideBefore <= swiper.size - swiper.slidesSizesGrid[i];
		const isVisible = slideBefore >= 0 && slideBefore < swiper.size - 1 || slideAfter > 1 && slideAfter <= swiper.size || slideBefore <= 0 && slideAfter >= swiper.size;
		if (isVisible) {
			swiper.visibleSlides.push(slide);
			swiper.visibleSlidesIndexes.push(i);
		}
		toggleSlideClasses(slide, isVisible, params.slideVisibleClass);
		toggleSlideClasses(slide, isFullyVisible, params.slideFullyVisibleClass);
		slide.progress = rtl ? -slideProgress : slideProgress;
		slide.originalProgress = rtl ? -originalSlideProgress : originalSlideProgress;
	}
}
var prototypes = {
	eventsEmitter,
	update: {
		updateSize,
		updateSlides,
		updateAutoHeight,
		updateSlidesOffset,
		updateSlidesProgress,
		updateProgress,
		updateSlidesClasses,
		updateActiveIndex,
		updateClickedSlide
	},
	translate,
	transition,
	slide,
	loop,
	grabCursor,
	events: events$1,
	breakpoints,
	checkOverflow: checkOverflow$1,
	classes
};
var extendedDefaults = {};
var Swiper = class Swiper {
	static extendedDefaults;
	static defaults;
	constructor(...args) {
		let el;
		let params;
		if (args.length === 1 && args[0] !== null && typeof args[0] === "object" && Object.prototype.toString.call(args[0]).slice(8, -1) === "Object") params = args[0];
		else [el, params] = args;
		if (!params) params = {};
		params = extend({}, params);
		if (el && !params.el) params.el = el;
		if (params.el && typeof params.el === "string" && typeof document !== "undefined" && document.querySelectorAll(params.el).length > 1) {
			const swipers = [];
			document.querySelectorAll(params.el).forEach((containerEl) => {
				const newParams = extend({}, params, { el: containerEl });
				swipers.push(new Swiper(newParams));
			});
			return swipers;
		}
		const swiper = this;
		swiper.__swiper__ = true;
		swiper.support = getSupport();
		swiper.device = getDevice({ userAgent: params.userAgent ?? void 0 });
		swiper.browser = getBrowser();
		swiper.eventsListeners = {};
		swiper.eventsAnyListeners = [];
		swiper.modules = [...swiper.__modules__ || []];
		if (params.modules && Array.isArray(params.modules)) params.modules.forEach((mod) => {
			const fn = mod;
			if (typeof fn === "function" && swiper.modules.indexOf(fn) < 0) swiper.modules.push(fn);
		});
		const allModulesParams = {};
		swiper.modules.forEach((mod) => {
			mod({
				params,
				swiper,
				extendParams: moduleExtendParams(params, allModulesParams),
				on: swiper.on.bind(swiper),
				once: swiper.once.bind(swiper),
				off: swiper.off.bind(swiper),
				emit: swiper.emit.bind(swiper)
			});
		});
		swiper.params = extend({}, extend({}, defaults, allModulesParams), extendedDefaults, params);
		swiper.originalParams = extend({}, swiper.params);
		swiper.passedParams = extend({}, params);
		if (swiper.params && swiper.params.on) {
			const onHandlers = swiper.params.on;
			Object.keys(onHandlers).forEach((eventName) => {
				const handler = onHandlers[eventName];
				if (handler) swiper.on(eventName, handler);
			});
		}
		if (swiper.params && swiper.params.onAny) swiper.onAny(swiper.params.onAny);
		Object.assign(swiper, {
			enabled: swiper.params.enabled,
			el,
			classNames: [],
			slides: [],
			slidesGrid: [],
			snapGrid: [],
			slidesSizesGrid: [],
			isHorizontal() {
				return swiper.params.direction === "horizontal";
			},
			isVertical() {
				return swiper.params.direction === "vertical";
			},
			activeIndex: 0,
			realIndex: 0,
			isBeginning: true,
			isEnd: false,
			translate: 0,
			previousTranslate: 0,
			progress: 0,
			velocity: 0,
			animating: false,
			cssOverflowAdjustment() {
				return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
			},
			allowSlideNext: swiper.params.allowSlideNext,
			allowSlidePrev: swiper.params.allowSlidePrev,
			touchEventsData: {
				isTouched: void 0,
				isMoved: void 0,
				allowTouchCallbacks: void 0,
				touchStartTime: void 0,
				isScrolling: void 0,
				currentTranslate: void 0,
				startTranslate: void 0,
				allowThresholdMove: void 0,
				focusableElements: swiper.params.focusableElements,
				lastClickTime: 0,
				clickTimeout: void 0,
				velocities: [],
				allowMomentumBounce: void 0,
				startMoving: void 0,
				pointerId: null,
				touchId: null
			},
			allowClick: true,
			allowTouchMove: swiper.params.allowTouchMove,
			touches: {
				startX: 0,
				startY: 0,
				currentX: 0,
				currentY: 0,
				diff: 0
			},
			imagesToLoad: [],
			imagesLoaded: 0
		});
		swiper.emit("_swiper");
		if (swiper.params.init) swiper.init();
		return swiper;
	}
	getDirectionLabel(property) {
		if (this.isHorizontal()) return property;
		return {
			"width": "height",
			"margin-top": "margin-left",
			"margin-bottom ": "margin-right",
			"margin-left": "margin-top",
			"margin-right": "margin-bottom",
			"padding-left": "padding-top",
			"padding-right": "padding-bottom",
			"marginRight": "marginBottom"
		}[property];
	}
	/**
	* !INTERNAL
	*/
	isHorizontal() {
		return this.params.direction === "horizontal";
	}
	isVertical() {
		return this.params.direction === "vertical";
	}
	cssOverflowAdjustment() {
		return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
	}
	getSlideIndex(slideEl) {
		const { slidesEl, params } = this;
		const firstSlideIndex = elementIndex(elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`)[0]);
		return elementIndex(slideEl) - (firstSlideIndex ?? 0);
	}
	getSlideIndexByData(index) {
		return this.getSlideIndex(this.slides.find((slideEl) => Number(slideEl.getAttribute("data-swiper-slide-index")) === index));
	}
	getSlideIndexWhenGrid(index) {
		if (this.grid && this.params.grid && this.params.grid.rows > 1) {
			if (this.params.grid.fill === "column") index = Math.floor(index / this.params.grid.rows);
			else if (this.params.grid.fill === "row") index = index % Math.ceil(this.slides.length / this.params.grid.rows);
		}
		return index;
	}
	recalcSlides() {
		const { slidesEl, params } = this;
		this.slides = elementChildren(slidesEl, `.${params.slideClass}, swiper-slide`);
	}
	/**
	* Enable Swiper (if it was disabled)
	*/
	enable() {
		if (this.enabled) return;
		this.enabled = true;
		if (this.params.grabCursor) this.setGrabCursor();
		this.emit("enable");
	}
	/**
	* Disable Swiper (if it was enabled). When Swiper is disabled, it will hide all navigation elements and won't respond to any events and interactions
	*/
	disable() {
		if (!this.enabled) return;
		this.enabled = false;
		if (this.params.grabCursor) this.unsetGrabCursor();
		this.emit("disable");
	}
	/**
	* Set Swiper translate progress (from 0 to 1). Where 0 - its initial position (offset) on first slide, and 1 - its maximum position (offset) on last slide
	*
	* @param progress Swiper translate progress (from 0 to 1).
	* @param speed Transition duration (in ms).
	*/
	setProgress(progress, speed) {
		progress = Math.min(Math.max(progress, 0), 1);
		const min = this.minTranslate();
		const current = (this.maxTranslate() - min) * progress + min;
		this.translateTo(current, typeof speed === "undefined" ? 0 : speed);
		this.updateActiveIndex();
		this.updateSlidesClasses();
	}
	emitContainerClasses() {
		if (!this.params._emitClasses || !this.el) return;
		const cls = this.el.className.split(" ").filter((className) => {
			return className.indexOf("swiper") === 0 || className.indexOf(this.params.containerModifierClass) === 0;
		});
		this.emit("_containerClasses", cls.join(" "));
	}
	getSlideClasses(slideEl) {
		if (this.destroyed) return "";
		return slideEl.className.split(" ").filter((className) => {
			return className.indexOf("swiper-slide") === 0 || className.indexOf(this.params.slideClass) === 0;
		}).join(" ");
	}
	emitSlidesClasses() {
		if (!this.params._emitClasses || !this.el) return;
		const updates = [];
		this.slides.forEach((slideEl) => {
			const classNames = this.getSlideClasses(slideEl);
			updates.push({
				slideEl,
				classNames
			});
			this.emit("_slideClass", slideEl, classNames);
		});
		this.emit("_slideClasses", updates);
	}
	/**
	* Get dynamically calculated amount of slides per view, useful only when slidesPerView set to `auto`
	*/
	slidesPerViewDynamic(view = "current", exact = false) {
		const { params, slides, slidesGrid, slidesSizesGrid, size: swiperSize, activeIndex } = this;
		let spv = 1;
		if (typeof params.slidesPerView === "number") return params.slidesPerView;
		if (!swiperSize) return spv;
		if (params.centeredSlides) {
			let slideSize = slides[activeIndex] ? Math.ceil(slides[activeIndex].swiperSlideSize ?? 0) : 0;
			let breakLoop = false;
			for (let i = activeIndex + 1; i < slides.length; i += 1) if (slides[i] && !breakLoop) {
				slideSize += Math.ceil(slides[i].swiperSlideSize ?? 0);
				spv += 1;
				if (slideSize > swiperSize) breakLoop = true;
			}
			for (let i = activeIndex - 1; i >= 0; i -= 1) if (slides[i] && !breakLoop) {
				slideSize += slides[i].swiperSlideSize ?? 0;
				spv += 1;
				if (slideSize > swiperSize) breakLoop = true;
			}
		} else if (view === "current") {
			for (let i = activeIndex + 1; i < slides.length; i += 1) if (exact ? slidesGrid[i] + slidesSizesGrid[i] - slidesGrid[activeIndex] < swiperSize : slidesGrid[i] - slidesGrid[activeIndex] < swiperSize) spv += 1;
		} else for (let i = activeIndex - 1; i >= 0; i -= 1) if (slidesGrid[activeIndex] - slidesGrid[i] < swiperSize) spv += 1;
		return spv;
	}
	/**
	* You should call it after you add/remove slides
	* manually, or after you hide/show it, or do any
	* custom DOM modifications with Swiper
	* This method also includes subcall of the following
	* methods which you can use separately:
	*/
	update() {
		const swiper = this;
		if (!swiper || swiper.destroyed) return;
		const { snapGrid, params } = swiper;
		if (params.breakpoints) swiper.setBreakpoint();
		if (params.lazyPreload) [...swiper.el.querySelectorAll("[loading=\"lazy\"]")].forEach((imageEl) => {
			if (imageEl.complete) processLazyPreloader(swiper, imageEl);
		});
		swiper.updateSize();
		swiper.updateSlides();
		swiper.updateProgress();
		swiper.updateSlidesClasses();
		function setTranslate() {
			const translateValue = swiper.rtlTranslate ? swiper.translate * -1 : swiper.translate;
			const newTranslate = Math.min(Math.max(translateValue, swiper.maxTranslate()), swiper.minTranslate());
			swiper.setTranslate(newTranslate);
			swiper.updateActiveIndex();
			swiper.updateSlidesClasses();
		}
		let translated;
		if (params.freeMode?.enabled && !params.cssMode) {
			setTranslate();
			if (params.autoHeight) swiper.updateAutoHeight();
		} else {
			if ((params.slidesPerView === "auto" || params.slidesPerView > 1) && swiper.isEnd && !params.centeredSlides) {
				const slidesLength = swiper.virtual && params.virtual?.enabled ? swiper.virtual.slides.length : swiper.slides.length;
				translated = swiper.slideTo(slidesLength - 1, 0, false, true);
			} else translated = swiper.slideTo(swiper.activeIndex, 0, false, true);
			if (!translated) setTranslate();
		}
		if (params.watchOverflow && snapGrid !== swiper.snapGrid) swiper.checkOverflow();
		swiper.emit("update");
	}
	/**
	* Changes slider direction from horizontal to vertical and back.
	*
	* @param direction New direction. If not specified, then will automatically changed to opposite direction
	* @param needUpdate Will call swiper.update(). Default true
	*/
	changeDirection(newDirection, needUpdate = true) {
		const swiper = this;
		const currentDirection = swiper.params.direction;
		if (!newDirection) newDirection = currentDirection === "horizontal" ? "vertical" : "horizontal";
		if (newDirection === currentDirection || newDirection !== "horizontal" && newDirection !== "vertical") return swiper;
		swiper.el.classList.remove(`${swiper.params.containerModifierClass}${currentDirection}`);
		swiper.el.classList.add(`${swiper.params.containerModifierClass}${newDirection}`);
		swiper.emitContainerClasses();
		swiper.params.direction = newDirection;
		swiper.rtlTranslate = newDirection === "horizontal" && swiper.rtl;
		swiper.slides.forEach((slideEl) => {
			if (newDirection === "vertical") slideEl.style.width = "";
			else slideEl.style.height = "";
		});
		swiper.emit("changeDirection");
		if (needUpdate) swiper.update();
		return swiper;
	}
	/**
	* Changes slider language
	*
	* @param direction New direction. Should be `rtl` or `ltr`
	*/
	changeLanguageDirection(direction) {
		const swiper = this;
		if (swiper.rtl && direction === "rtl" || !swiper.rtl && direction === "ltr") return;
		swiper.rtl = direction === "rtl";
		swiper.rtlTranslate = swiper.params.direction === "horizontal" && swiper.rtl;
		if (swiper.rtl) {
			swiper.el.classList.add(`${swiper.params.containerModifierClass}rtl`);
			swiper.el.dir = "rtl";
		} else {
			swiper.el.classList.remove(`${swiper.params.containerModifierClass}rtl`);
			swiper.el.dir = "ltr";
		}
		swiper.update();
	}
	mount(element) {
		const swiper = this;
		if (swiper.mounted) return true;
		if (typeof document === "undefined") return false;
		const initialEl = element ?? swiper.params.el;
		let el = null;
		if (typeof initialEl === "string") el = document.querySelector(initialEl);
		else if (initialEl instanceof HTMLElement) el = initialEl;
		if (!el) return false;
		el.swiper = swiper;
		const parent = el.parentNode;
		if (parent && parent.host && parent.host.nodeName === swiper.params.swiperElementNodeName.toUpperCase()) swiper.isElement = true;
		const getWrapperSelector = () => {
			return `.${(swiper.params.wrapperClass || "").trim().split(" ").join(".")}`;
		};
		const getWrapper = () => {
			if (el && el.shadowRoot) return el.shadowRoot.querySelector(getWrapperSelector());
			return elementChildren(el, getWrapperSelector())[0];
		};
		let wrapperEl = getWrapper();
		if (!wrapperEl && swiper.params.createElements) {
			wrapperEl = createElement("div", swiper.params.wrapperClass);
			el.append(wrapperEl);
			elementChildren(el, `.${swiper.params.slideClass}`).forEach((slideEl) => {
				wrapperEl.append(slideEl);
			});
		}
		const host = swiper.isElement ? el.parentNode.host : null;
		Object.assign(swiper, {
			el,
			wrapperEl,
			slidesEl: swiper.isElement && !host.slideSlots ? host : wrapperEl,
			hostEl: swiper.isElement ? host : el,
			mounted: true,
			rtl: el.dir.toLowerCase() === "rtl" || elementStyle(el, "direction") === "rtl",
			rtlTranslate: swiper.params.direction === "horizontal" && (el.dir.toLowerCase() === "rtl" || elementStyle(el, "direction") === "rtl"),
			wrongRTL: elementStyle(wrapperEl, "display") === "-webkit-box"
		});
		return true;
	}
	/**
	* Initialize slider
	*/
	init(el) {
		const swiper = this;
		if (swiper.initialized) return swiper;
		if (swiper.mount(el) === false) return swiper;
		swiper.emit("beforeInit");
		if (swiper.params.breakpoints) swiper.setBreakpoint();
		swiper.addClasses();
		swiper.updateSize();
		swiper.updateSlides();
		if (swiper.params.watchOverflow) swiper.checkOverflow();
		if (swiper.params.grabCursor && swiper.enabled) swiper.setGrabCursor();
		if (swiper.params.loop && swiper.virtual && swiper.params.virtual?.enabled) swiper.slideTo((swiper.params.initialSlide ?? 0) + (swiper.virtual.slidesBefore ?? 0), 0, swiper.params.runCallbacksOnInit, false, true);
		else swiper.slideTo(swiper.params.initialSlide, 0, swiper.params.runCallbacksOnInit, false, true);
		if (swiper.params.loop) swiper.loopCreate(void 0, true);
		swiper.attachEvents();
		if (swiper.params.lazyPreload) {
			const lazyElements = [...swiper.el.querySelectorAll("[loading=\"lazy\"]")];
			if (swiper.isElement) lazyElements.push(...swiper.hostEl.querySelectorAll("[loading=\"lazy\"]"));
			lazyElements.forEach((imageEl) => {
				if (imageEl.complete) processLazyPreloader(swiper, imageEl);
				else imageEl.addEventListener("load", (e) => {
					processLazyPreloader(swiper, e.target);
				});
			});
		}
		swiper.initialized = true;
		preload(swiper);
		swiper.emit("init");
		swiper.emit("afterInit");
		return swiper;
	}
	/**
	* Destroy slider instance and detach all events listeners
	*
	* @param deleteInstance Set it to false (by default it is true) to not to delete Swiper instance
	* @param cleanStyles Set it to true (by default it is true) and all custom styles will be removed from slides, wrapper and container.
	* Useful if you need to destroy Swiper and to init again with new options or in different direction
	*/
	destroy(deleteInstance = true, cleanStyles = true) {
		const swiper = this;
		const { params, el, wrapperEl, slides } = swiper;
		if (typeof swiper.params === "undefined" || swiper.destroyed) return null;
		swiper.emit("beforeDestroy");
		swiper.initialized = false;
		swiper.detachEvents();
		if (params.loop) swiper.loopDestroy();
		if (cleanStyles) {
			swiper.removeClasses();
			if (el && typeof el !== "string") el.removeAttribute("style");
			if (wrapperEl) wrapperEl.removeAttribute("style");
			if (slides && slides.length) slides.forEach((slideEl) => {
				slideEl.classList.remove(params.slideVisibleClass, params.slideFullyVisibleClass, params.slideActiveClass, params.slideNextClass, params.slidePrevClass);
				slideEl.removeAttribute("style");
				slideEl.removeAttribute("data-swiper-slide-index");
			});
		}
		swiper.emit("destroy");
		Object.keys(swiper.eventsListeners).forEach((eventName) => {
			swiper.off(eventName);
		});
		if (deleteInstance !== false) {
			if (swiper.el && typeof swiper.el !== "string") swiper.el.swiper = null;
			deleteProps(swiper);
		}
		swiper.destroyed = true;
		return null;
	}
	static extendDefaults(newDefaults) {
		extend(extendedDefaults, newDefaults);
	}
	static installModule(mod) {
		if (!Swiper.prototype.__modules__) Swiper.prototype.__modules__ = [];
		const modules = Swiper.prototype.__modules__;
		if (typeof mod === "function" && modules.indexOf(mod) < 0) modules.push(mod);
	}
	static use(module) {
		if (Array.isArray(module)) {
			module.forEach((m) => Swiper.installModule(m));
			return Swiper;
		}
		Swiper.installModule(module);
		return Swiper;
	}
};
Object.defineProperty(Swiper, "extendedDefaults", { get() {
	return extendedDefaults;
} });
Object.defineProperty(Swiper, "defaults", { get() {
	return defaults;
} });
var prototypeRecord = prototypes;
var swiperProto = Swiper.prototype;
Object.keys(prototypeRecord).forEach((prototypeGroup) => {
	const group = prototypeRecord[prototypeGroup];
	Object.keys(group).forEach((protoMethod) => {
		swiperProto[protoMethod] = group[protoMethod];
	});
});
Swiper.use([Resize, Observer]);
//#endregion
//#region node_modules/swiper/shared/create-element-if-not-defined.mjs
function createElementIfNotDefined(swiper, originalParams, params, checkProps) {
	const target = params ?? {};
	const original = originalParams ?? {};
	if (swiper.params.createElements) Object.keys(checkProps).forEach((key) => {
		if (!target[key] && target.auto === true) {
			let element = elementChildren(swiper.el, `.${checkProps[key]}`)[0];
			if (!element) {
				element = createElement("div", checkProps[key]);
				element.className = checkProps[key];
				swiper.el.append(element);
			}
			target[key] = element;
			original[key] = element;
		}
	});
	return target;
}
//#endregion
//#region node_modules/swiper/modules/navigation.mjs
var arrowSvg = `<svg class="swiper-navigation-icon" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.38296 20.0762C0.111788 19.805 0.111788 19.3654 0.38296 19.0942L9.19758 10.2796L0.38296 1.46497C0.111788 1.19379 0.111788 0.754138 0.38296 0.482966C0.654131 0.211794 1.09379 0.211794 1.36496 0.482966L10.4341 9.55214C10.8359 9.9539 10.8359 10.6053 10.4341 11.007L1.36496 20.0762C1.09379 20.3474 0.654131 20.3474 0.38296 20.0762Z" fill="currentColor"/></svg>`;
var Navigation = ({ swiper, extendParams, on, emit }) => {
	extendParams({ navigation: {
		nextEl: null,
		prevEl: null,
		addIcons: true,
		hideOnClick: false,
		disabledClass: "swiper-button-disabled",
		hiddenClass: "swiper-button-hidden",
		lockClass: "swiper-button-lock",
		navigationDisabledClass: "swiper-navigation-disabled"
	} });
	swiper.navigation = {
		nextEl: null,
		prevEl: null,
		arrowSvg
	};
	function getParams() {
		return swiper.params.navigation;
	}
	function getEl(el) {
		let res;
		if (el && typeof el === "string" && swiper.isElement) {
			res = swiper.el.querySelector(el) || swiper.hostEl.querySelector(el);
			if (res) return res;
		}
		if (el) {
			if (typeof el === "string") res = [...document.querySelectorAll(el)];
			if (swiper.params.uniqueNavElements && typeof el === "string" && res && res.length > 1 && swiper.el.querySelectorAll(el).length === 1) res = swiper.el.querySelector(el);
			else if (res && res.length === 1) res = res[0];
		}
		if (el && !res) return el;
		return res;
	}
	function toggleEl(el, disabled) {
		const params = getParams();
		makeElementsArray(el).forEach((subEl) => {
			if (subEl) {
				subEl.classList[disabled ? "add" : "remove"](...params.disabledClass.split(" "));
				if (subEl.tagName === "BUTTON") subEl.disabled = disabled;
				if (swiper.params.watchOverflow && swiper.enabled) subEl.classList[swiper.isLocked ? "add" : "remove"](params.lockClass);
			}
		});
	}
	function update() {
		const { nextEl, prevEl } = swiper.navigation;
		if (swiper.params.loop) {
			toggleEl(prevEl, false);
			toggleEl(nextEl, false);
			return;
		}
		toggleEl(prevEl, swiper.isBeginning && !swiper.params.rewind);
		toggleEl(nextEl, swiper.isEnd && !swiper.params.rewind);
	}
	function onPrevClick(e) {
		e.preventDefault();
		if (swiper.isBeginning && !swiper.params.loop && !swiper.params.rewind) return;
		swiper.slidePrev();
		emit("navigationPrev");
	}
	function onNextClick(e) {
		e.preventDefault();
		if (swiper.isEnd && !swiper.params.loop && !swiper.params.rewind) return;
		swiper.slideNext();
		emit("navigationNext");
	}
	function init() {
		swiper.params.navigation = createElementIfNotDefined(swiper, swiper.originalParams.navigation, swiper.params.navigation, {
			nextEl: "swiper-button-next",
			prevEl: "swiper-button-prev"
		});
		const params = getParams();
		if (!(params.nextEl || params.prevEl)) return;
		const nextEl = getEl(params.nextEl);
		const prevEl = getEl(params.prevEl);
		Object.assign(swiper.navigation, {
			nextEl,
			prevEl
		});
		const nextEls = makeElementsArray(nextEl);
		const prevEls = makeElementsArray(prevEl);
		const initButton = (el, dir) => {
			if (el) {
				if (params.addIcons && el.matches(".swiper-button-next,.swiper-button-prev") && !el.querySelector("svg")) {
					const tempEl = document.createElement("div");
					setInnerHTML(tempEl, arrowSvg);
					const svgEl = tempEl.querySelector("svg");
					if (svgEl) el.appendChild(svgEl);
					tempEl.remove();
				}
				el.addEventListener("click", dir === "next" ? onNextClick : onPrevClick);
			}
			if (!swiper.enabled && el) el.classList.add(...params.lockClass.split(" "));
		};
		nextEls.forEach((el) => initButton(el, "next"));
		prevEls.forEach((el) => initButton(el, "prev"));
	}
	function destroy() {
		const params = getParams();
		const { nextEl, prevEl } = swiper.navigation;
		const nextEls = makeElementsArray(nextEl);
		const prevEls = makeElementsArray(prevEl);
		const destroyButton = (el, dir) => {
			el.removeEventListener("click", dir === "next" ? onNextClick : onPrevClick);
			el.classList.remove(...params.disabledClass.split(" "));
		};
		nextEls.forEach((el) => destroyButton(el, "next"));
		prevEls.forEach((el) => destroyButton(el, "prev"));
	}
	on("init", () => {
		if (getParams().enabled === false) disable();
		else {
			init();
			update();
		}
	});
	on("toEdge fromEdge lock unlock", () => {
		update();
	});
	on("destroy", () => {
		destroy();
	});
	on("enable disable", () => {
		const params = getParams();
		const { nextEl, prevEl } = swiper.navigation;
		const nextEls = makeElementsArray(nextEl);
		const prevEls = makeElementsArray(prevEl);
		if (swiper.enabled) {
			update();
			return;
		}
		[...nextEls, ...prevEls].filter((el) => !!el).forEach((el) => el.classList.add(params.lockClass));
	});
	on("click", (_s, e) => {
		const params = getParams();
		const { nextEl, prevEl } = swiper.navigation;
		const nextEls = makeElementsArray(nextEl);
		const prevEls = makeElementsArray(prevEl);
		const targetEl = e.target;
		let targetIsButton = prevEls.includes(targetEl) || nextEls.includes(targetEl);
		if (swiper.isElement && !targetIsButton) {
			const path = e.composedPath ? e.composedPath() : [];
			if (path.length) targetIsButton = path.find((pathEl) => nextEls.includes(pathEl) || prevEls.includes(pathEl));
		}
		if (params.hideOnClick && !targetIsButton) {
			if (swiper.pagination && swiper.params.pagination && swiper.params.pagination.clickable && (swiper.pagination.el === targetEl || swiper.pagination.el.contains(targetEl))) return;
			let isHidden;
			if (nextEls.length) isHidden = nextEls[0].classList.contains(params.hiddenClass);
			else if (prevEls.length) isHidden = prevEls[0].classList.contains(params.hiddenClass);
			if (isHidden === true) emit("navigationShow");
			else emit("navigationHide");
			[...nextEls, ...prevEls].filter((el) => !!el).forEach((el) => el.classList.toggle(params.hiddenClass));
		}
	});
	const enable = () => {
		const params = getParams();
		swiper.el.classList.remove(...params.navigationDisabledClass.split(" "));
		init();
		update();
	};
	const disable = () => {
		const params = getParams();
		swiper.el.classList.add(...params.navigationDisabledClass.split(" "));
		destroy();
	};
	Object.assign(swiper.navigation, {
		enable,
		disable,
		update,
		init,
		destroy
	});
};
//#endregion
//#region node_modules/swiper/shared/classes-to-selector.mjs
function classesToSelector(classes = "") {
	return `.${classes.trim().replace(/([.:!+/()[\]#>~*^$|=,'"@{}\\])/g, "\\$1").replace(/ /g, ".")}`;
}
//#endregion
//#region node_modules/swiper/modules/pagination.mjs
var isVirtualEnabled = (swiper) => !!swiper.virtual && !!swiper.params.virtual?.enabled;
var isFreeModeEnabled = (swiper) => !!swiper.params.freeMode?.enabled;
var getSlidesLength = (swiper) => {
	if (isVirtualEnabled(swiper)) return swiper.virtual.slides.length;
	const gridRows = swiper.params.grid?.rows;
	if (swiper.grid && gridRows && gridRows > 1) return swiper.slides.length / Math.ceil(gridRows);
	return swiper.slides.length;
};
var Pagination = ({ swiper, extendParams, on, emit }) => {
	const pfx = "swiper-pagination";
	extendParams({ pagination: {
		el: null,
		bulletElement: "span",
		clickable: false,
		hideOnClick: false,
		renderBullet: null,
		renderProgressbar: null,
		renderFraction: null,
		renderCustom: null,
		progressbarOpposite: false,
		type: "bullets",
		dynamicBullets: false,
		dynamicMainBullets: 1,
		formatFractionCurrent: (number) => number,
		formatFractionTotal: (number) => number,
		bulletClass: `${pfx}-bullet`,
		bulletActiveClass: `${pfx}-bullet-active`,
		modifierClass: `${pfx}-`,
		currentClass: `${pfx}-current`,
		totalClass: `${pfx}-total`,
		hiddenClass: `${pfx}-hidden`,
		progressbarFillClass: `${pfx}-progressbar-fill`,
		progressbarOppositeClass: `${pfx}-progressbar-opposite`,
		clickableClass: `${pfx}-clickable`,
		lockClass: `${pfx}-lock`,
		horizontalClass: `${pfx}-horizontal`,
		verticalClass: `${pfx}-vertical`,
		paginationDisabledClass: `${pfx}-disabled`
	} });
	swiper.pagination = {
		el: null,
		bullets: []
	};
	let bulletSize;
	let dynamicBulletIndex = 0;
	function getParams() {
		return swiper.params.pagination;
	}
	function isPaginationDisabled() {
		return !getParams().el || !swiper.pagination.el || Array.isArray(swiper.pagination.el) && swiper.pagination.el.length === 0;
	}
	function setSideBullets(bulletEl, position) {
		const { bulletActiveClass } = getParams();
		if (!bulletEl) return;
		let current = bulletEl[`${position === "prev" ? "previous" : "next"}ElementSibling`];
		if (current) {
			current.classList.add(`${bulletActiveClass}-${position}`);
			current = current[`${position === "prev" ? "previous" : "next"}ElementSibling`];
			if (current) current.classList.add(`${bulletActiveClass}-${position}-${position}`);
		}
	}
	function getMoveDirection(prevIndex, nextIndex, length) {
		prevIndex = prevIndex % length;
		nextIndex = nextIndex % length;
		if (nextIndex === prevIndex + 1) return "next";
		else if (nextIndex === prevIndex - 1) return "previous";
	}
	function onBulletClick(e) {
		const bulletEl = e.target.closest(classesToSelector(getParams().bulletClass));
		if (!bulletEl) return;
		e.preventDefault();
		const index = (elementIndex(bulletEl) ?? 0) * (swiper.params.slidesPerGroup ?? 1);
		if (swiper.params.loop) {
			if (swiper.realIndex === index) return;
			const moveDirection = getMoveDirection(swiper.realIndex, index, swiper.slides.length);
			if (moveDirection === "next") swiper.slideNext();
			else if (moveDirection === "previous") swiper.slidePrev();
			else swiper.slideToLoop(index);
		} else swiper.slideTo(index);
	}
	function update() {
		const rtl = swiper.rtl;
		const params = getParams();
		if (isPaginationDisabled()) return;
		const els = makeElementsArray(swiper.pagination.el);
		let current;
		let previousIndex;
		const slidesLength = getSlidesLength(swiper);
		const total = swiper.params.loop ? Math.ceil(slidesLength / (swiper.params.slidesPerGroup ?? 1)) : swiper.snapGrid.length;
		if (swiper.params.loop) {
			previousIndex = swiper.previousRealIndex || 0;
			current = (swiper.params.slidesPerGroup ?? 1) > 1 ? Math.floor(swiper.realIndex / (swiper.params.slidesPerGroup ?? 1)) : swiper.realIndex;
		} else if (typeof swiper.snapIndex !== "undefined") {
			current = swiper.snapIndex;
			previousIndex = swiper.previousSnapIndex;
		} else {
			previousIndex = swiper.previousIndex || 0;
			current = swiper.activeIndex || 0;
		}
		if (params.type === "bullets" && swiper.pagination.bullets && swiper.pagination.bullets.length > 0) {
			const bullets = swiper.pagination.bullets;
			let firstIndex = 0;
			let lastIndex = 0;
			let midIndex = 0;
			if (params.dynamicBullets) {
				bulletSize = elementOuterSize(bullets[0], swiper.isHorizontal() ? "width" : "height");
				const dim = swiper.isHorizontal() ? "width" : "height";
				els.forEach((subEl) => {
					subEl.style[dim] = `${(bulletSize ?? 0) * (params.dynamicMainBullets + 4)}px`;
				});
				if (params.dynamicMainBullets > 1 && previousIndex !== void 0) {
					dynamicBulletIndex += current - (previousIndex || 0);
					if (dynamicBulletIndex > params.dynamicMainBullets - 1) dynamicBulletIndex = params.dynamicMainBullets - 1;
					else if (dynamicBulletIndex < 0) dynamicBulletIndex = 0;
				}
				firstIndex = Math.max(current - dynamicBulletIndex, 0);
				lastIndex = firstIndex + (Math.min(bullets.length, params.dynamicMainBullets) - 1);
				midIndex = (lastIndex + firstIndex) / 2;
			}
			bullets.forEach((bulletEl) => {
				const classesToRemove = [
					"",
					"-next",
					"-next-next",
					"-prev",
					"-prev-prev",
					"-main"
				].map((suffix) => `${params.bulletActiveClass}${suffix}`).flatMap((s) => typeof s === "string" && s.includes(" ") ? s.split(" ") : [s]);
				bulletEl.classList.remove(...classesToRemove);
			});
			if (els.length > 1) bullets.forEach((bullet) => {
				const bulletIndex = elementIndex(bullet);
				if (bulletIndex === current) bullet.classList.add(...params.bulletActiveClass.split(" "));
				else if (swiper.isElement) bullet.setAttribute("part", "bullet");
				if (params.dynamicBullets && bulletIndex !== void 0) {
					if (bulletIndex >= firstIndex && bulletIndex <= lastIndex) bullet.classList.add(...`${params.bulletActiveClass}-main`.split(" "));
					if (bulletIndex === firstIndex) setSideBullets(bullet, "prev");
					if (bulletIndex === lastIndex) setSideBullets(bullet, "next");
				}
			});
			else {
				const bullet = bullets[current];
				if (bullet) bullet.classList.add(...params.bulletActiveClass.split(" "));
				if (swiper.isElement) bullets.forEach((bulletEl, bulletIndex) => {
					bulletEl.setAttribute("part", bulletIndex === current ? "bullet-active" : "bullet");
				});
				if (params.dynamicBullets) {
					const firstDisplayedBullet = bullets[firstIndex];
					const lastDisplayedBullet = bullets[lastIndex];
					for (let i = firstIndex; i <= lastIndex; i += 1) if (bullets[i]) bullets[i].classList.add(...`${params.bulletActiveClass}-main`.split(" "));
					setSideBullets(firstDisplayedBullet, "prev");
					setSideBullets(lastDisplayedBullet, "next");
				}
			}
			if (params.dynamicBullets) {
				const dynamicBulletsLength = Math.min(bullets.length, params.dynamicMainBullets + 4);
				const bulletsOffset = ((bulletSize ?? 0) * dynamicBulletsLength - (bulletSize ?? 0)) / 2 - midIndex * (bulletSize ?? 0);
				const offsetProp = rtl ? "right" : "left";
				const positionDim = swiper.isHorizontal() ? offsetProp : "top";
				bullets.forEach((bullet) => {
					bullet.style[positionDim] = `${bulletsOffset}px`;
				});
			}
		}
		els.forEach((subEl, subElIndex) => {
			if (params.type === "fraction") {
				subEl.querySelectorAll(classesToSelector(params.currentClass)).forEach((fractionEl) => {
					fractionEl.textContent = String(params.formatFractionCurrent(current + 1));
				});
				subEl.querySelectorAll(classesToSelector(params.totalClass)).forEach((totalEl) => {
					totalEl.textContent = String(params.formatFractionTotal(total));
				});
			}
			if (params.type === "progressbar") {
				let progressbarDirection;
				if (params.progressbarOpposite) progressbarDirection = swiper.isHorizontal() ? "vertical" : "horizontal";
				else progressbarDirection = swiper.isHorizontal() ? "horizontal" : "vertical";
				const scale = (current + 1) / total;
				let scaleX = 1;
				let scaleY = 1;
				if (progressbarDirection === "horizontal") scaleX = scale;
				else scaleY = scale;
				subEl.querySelectorAll(classesToSelector(params.progressbarFillClass)).forEach((progressEl) => {
					progressEl.style.transform = `translate3d(0,0,0) scaleX(${scaleX}) scaleY(${scaleY})`;
					progressEl.style.transitionDuration = `${swiper.params.speed}ms`;
				});
			}
			if (params.type === "custom" && params.renderCustom) {
				setInnerHTML(subEl, params.renderCustom(swiper, current + 1, total));
				if (subElIndex === 0) emit("paginationRender", subEl);
			} else {
				if (subElIndex === 0) emit("paginationRender", subEl);
				emit("paginationUpdate", subEl);
			}
			if (swiper.params.watchOverflow && swiper.enabled) subEl.classList[swiper.isLocked ? "add" : "remove"](params.lockClass);
		});
	}
	function render() {
		const params = getParams();
		if (isPaginationDisabled()) return;
		const slidesLength = getSlidesLength(swiper);
		const els = makeElementsArray(swiper.pagination.el);
		let paginationHTML = "";
		if (params.type === "bullets") {
			let numberOfBullets = swiper.params.loop ? Math.ceil(slidesLength / (swiper.params.slidesPerGroup ?? 1)) : swiper.snapGrid.length;
			if (swiper.params.freeMode && isFreeModeEnabled(swiper) && numberOfBullets > slidesLength) numberOfBullets = slidesLength;
			for (let i = 0; i < numberOfBullets; i += 1) if (params.renderBullet) paginationHTML += params.renderBullet.call(swiper, i, params.bulletClass);
			else paginationHTML += `<${params.bulletElement} ${swiper.isElement ? "part=\"bullet\"" : ""} class="${params.bulletClass}"></${params.bulletElement}>`;
		}
		if (params.type === "fraction") {
			if (params.renderFraction) paginationHTML = params.renderFraction.call(swiper, params.currentClass, params.totalClass);
			else paginationHTML = `<span class="${params.currentClass}"></span> / <span class="${params.totalClass}"></span>`;
		}
		if (params.type === "progressbar") {
			if (params.renderProgressbar) paginationHTML = params.renderProgressbar.call(swiper, params.progressbarFillClass);
			else paginationHTML = `<span class="${params.progressbarFillClass}"></span>`;
		}
		swiper.pagination.bullets = [];
		els.forEach((subEl) => {
			if (params.type !== "custom") setInnerHTML(subEl, paginationHTML || "");
			if (params.type === "bullets") swiper.pagination.bullets.push(...Array.from(subEl.querySelectorAll(classesToSelector(params.bulletClass))));
		});
		if (params.type !== "custom") emit("paginationRender", els[0]);
	}
	function init() {
		swiper.params.pagination = createElementIfNotDefined(swiper, swiper.originalParams.pagination, swiper.params.pagination, { el: "swiper-pagination" });
		const params = getParams();
		if (!params.el) return;
		let el;
		if (typeof params.el === "string" && swiper.isElement) el = swiper.el.querySelector(params.el);
		if (!el && typeof params.el === "string") el = [...document.querySelectorAll(params.el)];
		if (!el) el = params.el;
		if (!el || Array.isArray(el) && el.length === 0) return;
		if (swiper.params.uniqueNavElements && typeof params.el === "string" && Array.isArray(el) && el.length > 1) {
			el = [...swiper.el.querySelectorAll(params.el)];
			if (el.length > 1) {
				const found = el.find((subEl) => {
					if (elementParents(subEl, ".swiper")[0] !== swiper.el) return false;
					return true;
				});
				if (found) el = found;
			}
		}
		if (Array.isArray(el) && el.length === 1) el = el[0];
		Object.assign(swiper.pagination, { el });
		makeElementsArray(el).forEach((subEl) => {
			if (params.type === "bullets" && params.clickable) subEl.classList.add(...(params.clickableClass || "").split(" "));
			subEl.classList.add(params.modifierClass + params.type);
			subEl.classList.add(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
			if (params.type === "bullets" && params.dynamicBullets) {
				subEl.classList.add(`${params.modifierClass}${params.type}-dynamic`);
				dynamicBulletIndex = 0;
				if (params.dynamicMainBullets < 1) params.dynamicMainBullets = 1;
			}
			if (params.type === "progressbar" && params.progressbarOpposite) subEl.classList.add(params.progressbarOppositeClass);
			if (params.clickable) subEl.addEventListener("click", onBulletClick);
			if (!swiper.enabled) subEl.classList.add(params.lockClass);
		});
	}
	function destroy() {
		const params = getParams();
		if (isPaginationDisabled()) return;
		const el = swiper.pagination.el;
		if (el) makeElementsArray(el).forEach((subEl) => {
			subEl.classList.remove(params.hiddenClass);
			subEl.classList.remove(params.modifierClass + params.type);
			subEl.classList.remove(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
			if (params.clickable) {
				subEl.classList.remove(...(params.clickableClass || "").split(" "));
				subEl.removeEventListener("click", onBulletClick);
			}
		});
		if (swiper.pagination.bullets) swiper.pagination.bullets.forEach((subEl) => subEl.classList.remove(...params.bulletActiveClass.split(" ")));
	}
	on("changeDirection", () => {
		if (!swiper.pagination || !swiper.pagination.el) return;
		const params = getParams();
		makeElementsArray(swiper.pagination.el).forEach((subEl) => {
			subEl.classList.remove(params.horizontalClass, params.verticalClass);
			subEl.classList.add(swiper.isHorizontal() ? params.horizontalClass : params.verticalClass);
		});
	});
	on("init", () => {
		if (getParams().enabled === false) disable();
		else {
			init();
			render();
			update();
		}
	});
	on("activeIndexChange", () => {
		if (typeof swiper.snapIndex === "undefined") update();
	});
	on("snapIndexChange", () => {
		update();
	});
	on("snapGridLengthChange", () => {
		render();
		update();
	});
	on("destroy", () => {
		destroy();
	});
	on("enable disable", () => {
		const { el } = swiper.pagination;
		if (el) {
			const params = getParams();
			makeElementsArray(el).forEach((subEl) => subEl.classList[swiper.enabled ? "remove" : "add"](params.lockClass));
		}
	});
	on("lock unlock", () => {
		update();
	});
	on("click", (_s, e) => {
		const targetEl = e.target;
		const els = makeElementsArray(swiper.pagination.el);
		const params = getParams();
		if (params.el && params.hideOnClick && els && els.length > 0 && !targetEl.classList.contains(params.bulletClass)) {
			if (swiper.navigation && (swiper.navigation.nextEl && targetEl === swiper.navigation.nextEl || swiper.navigation.prevEl && targetEl === swiper.navigation.prevEl)) return;
			if (els[0].classList.contains(params.hiddenClass) === true) emit("paginationShow");
			else emit("paginationHide");
			els.forEach((subEl) => subEl.classList.toggle(params.hiddenClass));
		}
	});
	const enable = () => {
		const params = getParams();
		swiper.el.classList.remove(params.paginationDisabledClass);
		const { el } = swiper.pagination;
		if (el) makeElementsArray(el).forEach((subEl) => subEl.classList.remove(params.paginationDisabledClass));
		init();
		render();
		update();
	};
	const disable = () => {
		const params = getParams();
		swiper.el.classList.add(params.paginationDisabledClass);
		const { el } = swiper.pagination;
		if (el) makeElementsArray(el).forEach((subEl) => subEl.classList.add(params.paginationDisabledClass));
		destroy();
	};
	Object.assign(swiper.pagination, {
		enable,
		disable,
		render,
		update,
		init,
		destroy
	});
};
//#endregion
//#region node_modules/swiper/modules/thumbs.mjs
var Thumb = ({ swiper, extendParams, on }) => {
	extendParams({ thumbs: {
		swiper: null,
		multipleActiveThumbs: true,
		autoScrollOffset: 0,
		slideThumbActiveClass: "swiper-slide-thumb-active",
		thumbsContainerClass: "swiper-thumbs"
	} });
	let initialized = false;
	let swiperCreated = false;
	swiper.thumbs = { swiper: null };
	function getParams() {
		return swiper.params.thumbs;
	}
	function isVirtualEnabled() {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return false;
		const virtual = thumbsSwiper.params.virtual;
		return !!virtual && !!virtual.enabled;
	}
	function onThumbClick() {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return;
		const clickedIndex = thumbsSwiper.clickedIndex;
		const clickedSlide = thumbsSwiper.clickedSlide;
		const thumbsParams = getParams();
		if (clickedSlide && clickedSlide.classList.contains(thumbsParams.slideThumbActiveClass)) return;
		if (typeof clickedIndex === "undefined" || clickedIndex === null) return;
		let slideToIndex;
		if (thumbsSwiper.params.loop) {
			const attr = thumbsSwiper.clickedSlide?.getAttribute("data-swiper-slide-index");
			slideToIndex = attr == null ? clickedIndex : parseInt(attr, 10);
		} else slideToIndex = clickedIndex;
		if (swiper.params.loop) swiper.slideToLoop(slideToIndex);
		else swiper.slideTo(slideToIndex);
	}
	function init() {
		const thumbsParams = getParams();
		if (initialized) return false;
		initialized = true;
		const SwiperClass = swiper.constructor;
		if (thumbsParams.swiper instanceof SwiperClass) {
			if (thumbsParams.swiper.destroyed) {
				initialized = false;
				return false;
			}
			const thumbsSwiper = thumbsParams.swiper;
			swiper.thumbs.swiper = thumbsSwiper;
			Object.assign(thumbsSwiper.originalParams, {
				watchSlidesProgress: true,
				slideToClickedSlide: false
			});
			Object.assign(thumbsSwiper.params, {
				watchSlidesProgress: true,
				slideToClickedSlide: false
			});
			thumbsSwiper.update();
		} else if (isObject(thumbsParams.swiper)) {
			const thumbsSwiperParams = Object.assign({}, thumbsParams.swiper);
			Object.assign(thumbsSwiperParams, {
				watchSlidesProgress: true,
				slideToClickedSlide: false
			});
			swiper.thumbs.swiper = new SwiperClass(thumbsSwiperParams);
			swiperCreated = true;
		}
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper) return false;
		thumbsSwiper.el.classList.add(thumbsParams.thumbsContainerClass);
		thumbsSwiper.on("tap", onThumbClick);
		if (isVirtualEnabled()) thumbsSwiper.on("virtualUpdate", () => {
			update(false, { autoScroll: false });
		});
		return true;
	}
	function update(initial, p) {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return;
		let thumbsToActivate = 1;
		const thumbsParams = getParams();
		const thumbActiveClass = thumbsParams.slideThumbActiveClass;
		const slidesPerView = swiper.params.slidesPerView;
		if (typeof slidesPerView === "number" && slidesPerView > 1 && !swiper.params.centeredSlides) thumbsToActivate = slidesPerView;
		if (!thumbsParams.multipleActiveThumbs) thumbsToActivate = 1;
		thumbsToActivate = Math.floor(thumbsToActivate);
		thumbsSwiper.slides.forEach((slideEl) => slideEl.classList.remove(thumbActiveClass));
		if (thumbsSwiper.params.loop || isVirtualEnabled()) for (let i = 0; i < thumbsToActivate; i += 1) elementChildren(thumbsSwiper.slidesEl, `[data-swiper-slide-index="${swiper.realIndex + i}"]`).forEach((slideEl) => {
			slideEl.classList.add(thumbActiveClass);
		});
		else for (let i = 0; i < thumbsToActivate; i += 1) {
			const slide = thumbsSwiper.slides[swiper.realIndex + i];
			if (slide) slide.classList.add(thumbActiveClass);
		}
		if (p?.autoScroll ?? true) autoScroll(initial ? 0 : void 0);
	}
	function autoScroll(slideSpeed) {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return;
		const thumbsSlidesPerView = thumbsSwiper.params.slidesPerView;
		const slidesPerView = thumbsSlidesPerView === "auto" ? thumbsSwiper.slidesPerViewDynamic() : thumbsSlidesPerView ?? 1;
		const autoScrollOffset = getParams().autoScrollOffset;
		const useOffset = autoScrollOffset && !thumbsSwiper.params.loop;
		if (swiper.realIndex !== thumbsSwiper.realIndex || useOffset) {
			const currentThumbsIndex = thumbsSwiper.activeIndex;
			let newThumbsIndex;
			let direction;
			if (thumbsSwiper.params.loop) {
				const newThumbsSlide = thumbsSwiper.slides.find((slideEl) => slideEl.getAttribute("data-swiper-slide-index") === `${swiper.realIndex}`);
				newThumbsIndex = newThumbsSlide ? thumbsSwiper.slides.indexOf(newThumbsSlide) : -1;
				direction = swiper.activeIndex > swiper.previousIndex ? "next" : "prev";
			} else {
				newThumbsIndex = swiper.realIndex;
				direction = newThumbsIndex > swiper.previousIndex ? "next" : "prev";
			}
			if (useOffset) newThumbsIndex += direction === "next" ? autoScrollOffset : -1 * autoScrollOffset;
			if (thumbsSwiper.visibleSlidesIndexes && thumbsSwiper.visibleSlidesIndexes.indexOf(newThumbsIndex) < 0) {
				if (thumbsSwiper.params.centeredSlides) {
					if (newThumbsIndex > currentThumbsIndex) newThumbsIndex = newThumbsIndex - Math.floor(slidesPerView / 2) + 1;
					else newThumbsIndex = newThumbsIndex + Math.floor(slidesPerView / 2) - 1;
				} else if (newThumbsIndex > currentThumbsIndex && thumbsSwiper.params.slidesPerGroup === 1);
				thumbsSwiper.slideTo(newThumbsIndex, slideSpeed);
			}
		}
	}
	on("beforeInit", () => {
		const thumbs = swiper.params.thumbs;
		if (!thumbs || !thumbs.swiper) return;
		if (typeof thumbs.swiper === "string" || thumbs.swiper instanceof HTMLElement) {
			const getThumbsElementAndInit = () => {
				const thumbsElement = typeof thumbs.swiper === "string" ? document.querySelector(thumbs.swiper) : thumbs.swiper;
				if (thumbsElement && thumbsElement.swiper) {
					thumbs.swiper = thumbsElement.swiper;
					init();
					update(true);
				} else if (thumbsElement) {
					const eventName = `${swiper.params.eventsPrefix}init`;
					const onThumbsSwiper = (e) => {
						const detail = e.detail;
						thumbs.swiper = detail[0];
						thumbsElement.removeEventListener(eventName, onThumbsSwiper);
						init();
						update(true);
						thumbs.swiper.update();
						swiper.update();
					};
					thumbsElement.addEventListener(eventName, onThumbsSwiper);
				}
				return thumbsElement;
			};
			const watchForThumbsToAppear = () => {
				if (swiper.destroyed) return;
				if (!getThumbsElementAndInit()) requestAnimationFrame(watchForThumbsToAppear);
			};
			requestAnimationFrame(watchForThumbsToAppear);
		} else {
			init();
			update(true);
		}
	});
	on("slideChange update resize observerUpdate", () => {
		update();
	});
	on("setTransition", (_s, duration) => {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return;
		thumbsSwiper.setTransition(duration);
	});
	on("beforeDestroy", () => {
		const thumbsSwiper = swiper.thumbs.swiper;
		if (!thumbsSwiper || thumbsSwiper.destroyed) return;
		if (swiperCreated) thumbsSwiper.destroy();
	});
	Object.assign(swiper.thumbs, {
		init,
		update
	});
};
//#endregion
//#region src/components/layout/slider/slider.js
var swiperInstance = null;
function checkAndHideNavigation(sliderElement, config) {
	const hasMultipleSlides = sliderElement.querySelectorAll(".swiper-slide").length > 1;
	if (!hasMultipleSlides) {
		if (config.navigation) {
			const prevEl = document.querySelector(config.navigation.prevEl);
			const nextEl = document.querySelector(config.navigation.nextEl);
			if (prevEl) prevEl.style.display = "none";
			if (nextEl) nextEl.style.display = "none";
		}
		if (config.pagination) {
			const paginationEl = document.querySelector(config.pagination.el);
			if (paginationEl) paginationEl.style.display = "none";
		}
	}
	return hasMultipleSlides;
}
var sliderConfigs = {
	"preview-slider": {
		modules: [Pagination],
		observer: true,
		observeParents: true,
		slidesPerView: 1,
		spaceBetween: 10,
		speed: 800,
		loop: true,
		autoplay: {
			delay: 3e3,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
			stopOnLastSlide: false,
			waitForTransition: true
		},
		pagination: {
			el: ".preview-slider-pagination",
			clickable: true
		},
		isVideoSlider: true
	},
	"home__feed-news-slider": {
		modules: [Navigation, Pagination],
		observer: true,
		observeParents: true,
		slidesPerView: 1,
		spaceBetween: 20,
		speed: 800,
		loop: true,
		navigation: {
			prevEl: ".home__feed-news-slider-button-prev",
			nextEl: ".home__feed-news-slider-button-next"
		},
		pagination: {
			el: ".home__feed-news-slider-pagination",
			clickable: true
		},
		breakpoints: { 0: {
			slidesPerView: 1,
			spaceBetween: 20
		} }
	},
	"universities__slider": {
		modules: [Navigation, Pagination],
		observer: true,
		observeParents: true,
		slidesPerView: 1,
		spaceBetween: 60,
		speed: 800,
		loop: true,
		navigation: {
			prevEl: ".universities__slider-button-prev",
			nextEl: ".universities__slider-button-next"
		},
		pagination: {
			el: ".universities__slider-pagination",
			clickable: true
		},
		breakpoints: { 0: {
			slidesPerView: 1,
			spaceBetween: 60
		} }
	},
	"universities__branches-slider": {
		modules: [Navigation],
		observer: true,
		observeParents: true,
		observeSlideChildren: true,
		speed: 800,
		loop: false,
		slidesPerView: 1,
		spaceBetween: 16,
		navigation: {
			prevEl: ".universities__branches-slider-button-prev",
			nextEl: ".universities__branches-slider-button-next"
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 16
			}
		},
		isResponsive: true
	},
	"news__slider": {
		modules: [Navigation, Pagination],
		observer: true,
		observeParents: true,
		slidesPerView: 1,
		spaceBetween: 60,
		speed: 800,
		loop: true,
		navigation: {
			prevEl: ".news__slider-button-prev",
			nextEl: ".news__slider-button-next"
		},
		pagination: {
			el: ".news__slider-pagination",
			clickable: true
		},
		breakpoints: { 0: {
			slidesPerView: 1,
			spaceBetween: 60
		} }
	},
	"page__image-slider-main": {
		modules: [Navigation, Thumb],
		observer: true,
		observeParents: true,
		slidesPerView: 1,
		spaceBetween: 20,
		speed: 800,
		navigation: {
			prevEl: ".page__image-slider-prev",
			nextEl: ".page__image-slider-next"
		},
		thumbs: { swiper: {
			el: ".page__image-slider-thumbs",
			slidesPerView: 6,
			spaceBetween: 10,
			breakpoints: {
				768: {
					slidesPerView: 6,
					spaceBetween: 8
				},
				1024: {
					slidesPerView: 9,
					spaceBetween: 8
				}
			}
		} }
	},
	"footer__slider": {
		modules: [Navigation],
		observer: true,
		observeParents: true,
		slidesPerView: 4,
		spaceBetween: 20,
		speed: 800,
		loop: true,
		navigation: {
			prevEl: ".footer__slider-button-prev",
			nextEl: ".footer__slider-button-next"
		},
		breakpoints: {
			0: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			767: {
				slidesPerView: 4,
				spaceBetween: 20,
				slidesPerGroup: 1
			}
		}
	}
};
function initSliders() {
	Object.keys(sliderConfigs).forEach((sliderClass) => {
		const element = document.querySelector(`.${sliderClass}`);
		if (!element) return;
		const config = sliderConfigs[sliderClass];
		if (!checkAndHideNavigation(element, config)) return;
		if (config.isVideoSlider) {
			initPreviewSlider(element, config);
			return;
		}
		if (config.isResponsive) {
			initResponsiveSlider(sliderClass, config);
			return;
		}
		new Swiper(`.${sliderClass}`, config);
	});
}
function initPreviewSlider(element, config) {
	let initCounter = 0;
	let isVideoPlaying = false;
	let isAutoplayPaused = false;
	function initSlider() {
		if (swiperInstance) return;
		swiperInstance = new Swiper(element, {
			...config,
			on: { init: function() {
				const slider = this;
				if (slider.autoplay) slider.autoplay.start();
				const videoStates = /* @__PURE__ */ new Map();
				const videos = slider.el.querySelectorAll("video");
				const startVideoWithUserInteraction = (video) => {
					if (!video) return;
					if (isVideoPlaying) return;
					video.muted = true;
					video.play().then(() => {
						isVideoPlaying = true;
					}).catch(() => {
						const clickHandler = () => {
							video.muted = true;
							video.play().then(() => {
								isVideoPlaying = true;
							}).catch(() => {});
							document.removeEventListener("click", clickHandler);
							document.removeEventListener("touchstart", clickHandler);
						};
						document.addEventListener("click", clickHandler);
						document.addEventListener("touchstart", clickHandler);
					});
				};
				videos.forEach((video) => {
					const slide = video.closest(".swiper-slide");
					const muteButton = slide ? slide.querySelector(".preview-slider-video-mute") : null;
					let icon = null;
					if (muteButton) icon = muteButton.querySelector("iconify-icon");
					video.muted = true;
					if (icon) icon.setAttribute("icon", "mdi:mute");
					videoStates.set(video, {
						currentTime: 0,
						isPaused: true
					});
					const slideEl = video.closest(".swiper-slide");
					if (slideEl && slideEl.classList.contains("swiper-slide-active")) setTimeout(() => {
						startVideoWithUserInteraction(video);
					}, 500);
					video.addEventListener("loadedmetadata", () => {
						const slideEl = video.closest(".swiper-slide");
						if (slideEl && slideEl.classList.contains("swiper-slide-active")) startVideoWithUserInteraction(video);
					}, { once: true });
					video.addEventListener("canplay", () => {
						const slideEl = video.closest(".swiper-slide");
						if (slideEl && slideEl.classList.contains("swiper-slide-active")) startVideoWithUserInteraction(video);
					}, { once: true });
					if (muteButton) muteButton.addEventListener("click", function(e) {
						e.stopPropagation();
						video.muted = !video.muted;
						if (icon) {
							if (video.muted) icon.setAttribute("icon", "mdi:mute");
							else icon.setAttribute("icon", "octicon:unmute-16");
						}
						if (video.paused) video.play().then(() => {
							isVideoPlaying = true;
						}).catch(() => {});
					});
					if (icon) video.addEventListener("volumechange", function() {
						if (video.muted) icon.setAttribute("icon", "mdi:mute");
						else icon.setAttribute("icon", "octicon:unmute-16");
					});
					video.addEventListener("pause", function() {
						const state = videoStates.get(this);
						if (state) {
							state.currentTime = this.currentTime;
							state.isPaused = true;
						}
						if (!this.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) {
							isVideoPlaying = false;
							swiperInstance.autoplay.start();
						}
					});
					video.addEventListener("play", function() {
						const state = videoStates.get(this);
						if (state) state.isPaused = false;
						isVideoPlaying = true;
						if (swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
					});
					video.addEventListener("timeupdate", function() {
						const state = videoStates.get(this);
						if (state) state.currentTime = this.currentTime;
					});
					video.addEventListener("ended", () => {
						isVideoPlaying = false;
						if (swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
						if (swiperInstance) swiperInstance.slideNext();
						setTimeout(() => {
							if (swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.start();
						}, 1e3);
					});
					video.addEventListener("waiting", () => {
						if (swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
					});
					video.addEventListener("canplay", () => {
						if (video.paused && !video.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.start();
					});
					video.addEventListener("loadedmetadata", () => {
						if (video.paused && !video.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.start();
					});
					video.addEventListener("seeking", () => {
						if (swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
					});
					video.addEventListener("seeked", () => {
						if (!video.paused && !video.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
						else if (video.paused && !video.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.start();
					});
					video.addEventListener("ratechange", () => {
						if (!video.paused && !video.ended && swiperInstance && swiperInstance.autoplay && !isAutoplayPaused) swiperInstance.autoplay.stop();
					});
				});
				slider.el.addEventListener("mouseenter", () => {
					if (slider.autoplay && !isAutoplayPaused) {
						slider.autoplay.stop();
						isAutoplayPaused = true;
					}
				});
				slider.el.addEventListener("mouseleave", () => {
					if (slider.autoplay && isAutoplayPaused) {
						const activeSlide = slider.slides[slider.activeIndex];
						const activeVideo = activeSlide ? activeSlide.querySelector("video") : null;
						if (!activeVideo || activeVideo.paused || activeVideo.ended) slider.autoplay.start();
						isAutoplayPaused = false;
					}
				});
				slider.on("slideChange", function() {
					initCounter++;
					if (initCounter <= 5) return;
					slider.el.querySelectorAll("video").forEach((video) => {
						if (!video.paused) {
							video.pause();
							isVideoPlaying = false;
							const state = videoStates.get(video);
							if (state) {
								state.currentTime = video.currentTime;
								state.isPaused = true;
							}
						}
					});
					if (slider.autoplay && !isAutoplayPaused) slider.autoplay.stop();
				});
				slider.on("slideChangeTransitionEnd", function() {
					const activeSlide = slider.slides[slider.activeIndex];
					if (activeSlide) {
						const activeVideo = activeSlide.querySelector("video");
						if (activeVideo) {
							const state = videoStates.get(activeVideo);
							if (state) {
								if (activeVideo.currentTime !== state.currentTime) activeVideo.currentTime = state.currentTime;
								setTimeout(() => {
									startVideoWithUserInteraction(activeVideo);
								}, 300);
								state.isPaused = false;
							}
						}
					}
					const currentSlide = slider.slides[slider.activeIndex];
					if (!(currentSlide ? currentSlide.querySelector("video") : false) && slider.autoplay && !isAutoplayPaused) slider.autoplay.start();
				});
			} }
		});
	}
	if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", initSlider);
	else initSlider();
}
function initResponsiveSlider(sliderClass, config) {
	let branchesSlider = null;
	function initBranchesSlider() {
		const element = document.querySelector(`.${sliderClass}`);
		if (!element) return;
		const hasMultipleSlides = element.querySelectorAll(".swiper-slide").length > 1;
		if (window.innerWidth <= 950 && hasMultipleSlides) {
			if (!branchesSlider) branchesSlider = new Swiper(`.${sliderClass}`, {
				...config,
				on: { init(swiper) {
					swiper.update();
				} }
			});
		} else {
			if (branchesSlider) {
				branchesSlider.destroy(true, true);
				branchesSlider = null;
				const wrapper = document.querySelector(`.${sliderClass} .swiper-wrapper`);
				const slides = document.querySelectorAll(`.${sliderClass} .swiper-slide`);
				const action = document.querySelector(`.${sliderClass}-action`);
				if (wrapper) wrapper.removeAttribute("style");
				slides.forEach((slide) => {
					slide.removeAttribute("style");
					slide.classList.remove("swiper-slide-active", "swiper-slide-next", "swiper-slide-prev");
				});
				if (action) action.style.display = "";
			}
			if (!hasMultipleSlides) {
				const navPrev = document.querySelector(config.navigation.prevEl);
				const navNext = document.querySelector(config.navigation.nextEl);
				if (navPrev) navPrev.style.display = "none";
				if (navNext) navNext.style.display = "none";
			}
		}
	}
	initBranchesSlider();
	let resizeTimer;
	window.addEventListener("resize", () => {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(() => {
			initBranchesSlider();
		}, 200);
	});
}
window.addEventListener("load", function(e) {
	initSliders();
});
//#endregion
//#region src/components/layout/dynamic/dynamic.js
var DynamicAdapt = class {
	constructor() {
		this.type = "max";
		this.init();
	}
	init() {
		this.objects = [];
		this.daClassname = "--dynamic";
		this.nodes = [...document.querySelectorAll("[data-fls-dynamic]")];
		this.nodes.forEach((node) => {
			const dataArray = node.dataset.flsDynamic.trim().split(`,`);
			const object = {};
			object.element = node;
			object.parent = node.parentNode;
			object.destinationParent = dataArray[3] ? node.closest(dataArray[3].trim()) || document : document;
			const parentObjectSelector = dataArray[3] ? dataArray[3].trim() : null;
			const objectSelector = dataArray[0] ? dataArray[0].trim() : null;
			if (objectSelector) {
				if (parentObjectSelector) `${parentObjectSelector}${objectSelector}`;
				const foundDestination = object.destinationParent.querySelector(objectSelector);
				if (foundDestination) object.destination = foundDestination;
			}
			object.breakpoint = dataArray[1] ? dataArray[1].trim() : `767.98`;
			object.place = dataArray[2] ? dataArray[2].trim() : `last`;
			object.index = this.indexInParent(object.parent, object.element);
			this.objects.push(object);
		});
		this.arraySort(this.objects);
		this.mediaQueries = this.objects.map(({ breakpoint }) => `(${this.type}-width: ${breakpoint / 16}em),${breakpoint}`).filter((item, index, self) => self.indexOf(item) === index);
		this.mediaQueries.forEach((media) => {
			const mediaSplit = media.split(",");
			const matchMedia = window.matchMedia(mediaSplit[0]);
			const mediaBreakpoint = mediaSplit[1];
			const objectsFilter = this.objects.filter(({ breakpoint }) => breakpoint === mediaBreakpoint);
			matchMedia.addEventListener("change", () => {
				this.mediaHandler(matchMedia, objectsFilter);
			});
			this.mediaHandler(matchMedia, objectsFilter);
		});
	}
	mediaHandler(matchMedia, objects) {
		if (matchMedia.matches) objects.forEach((object) => {
			if (object.destination) this.moveTo(object.place, object.element, object.destination);
		});
		else objects.forEach(({ parent, element, index }) => {
			if (element.classList.contains(this.daClassname)) this.moveBack(parent, element, index);
		});
	}
	moveTo(place, element, destination) {
		element.classList.add(this.daClassname);
		const index = place === "last" || place === "first" ? place : parseInt(place, 10);
		if (index === "last" || index >= destination.children.length) destination.append(element);
		else if (index === "first") destination.prepend(element);
		else destination.children[index].before(element);
	}
	moveBack(parent, element, index) {
		element.classList.remove(this.daClassname);
		if (parent.children[index] !== void 0) parent.children[index].before(element);
		else parent.append(element);
	}
	indexInParent(parent, element) {
		return [...parent.children].indexOf(element);
	}
	arraySort(arr) {
		if (this.type === "min") arr.sort((a, b) => {
			if (a.breakpoint === b.breakpoint) {
				if (a.place === b.place) return 0;
				if (a.place === "first" || b.place === "last") return -1;
				if (a.place === "last" || b.place === "first") return 1;
				return 0;
			}
			return a.breakpoint - b.breakpoint;
		});
		else {
			arr.sort((a, b) => {
				if (a.breakpoint === b.breakpoint) {
					if (a.place === b.place) return 0;
					if (a.place === "first" || b.place === "last") return 1;
					if (a.place === "last" || b.place === "first") return -1;
					return 0;
				}
				return b.breakpoint - a.breakpoint;
			});
			return;
		}
	}
};
if (document.querySelector("[data-fls-dynamic]")) window.addEventListener("load", () => window.flsDynamic = new DynamicAdapt());
//#endregion
//#region src/components/templates/main/main.js
var Popup = class {
	constructor(options) {
		let config = {
			logging: true,
			init: true,
			attributeOpenButton: "data-popup",
			attributeCloseButton: "data-close-popup",
			fixElementSelector: "[data-lp]",
			youtubeAttribute: "data-popup-youtube",
			youtubePlaceAttribute: "data-popup-youtube-place",
			setAutoplayYoutube: true,
			classes: {
				popup: "popup",
				popupContent: "popup__content",
				popupActive: "popup_show",
				bodyActive: "popup-show"
			},
			focusCatch: true,
			closeEsc: true,
			bodyLock: true,
			hashSettings: {
				location: true,
				goHash: true
			},
			on: {
				beforeOpen: function() {},
				afterOpen: function() {},
				beforeClose: function() {},
				afterClose: function() {}
			}
		};
		this.youTubeCode;
		this.isOpen = false;
		this.targetOpen = {
			selector: false,
			element: false
		};
		this.previousOpen = {
			selector: false,
			element: false
		};
		this.lastClosed = {
			selector: false,
			element: false
		};
		this._dataValue = false;
		this.hash = false;
		this._reopen = false;
		this._selectorOpen = false;
		this.lastFocusEl = false;
		this._focusEl = [
			"a[href]",
			"input:not([disabled]):not([type=\"hidden\"]):not([aria-hidden])",
			"button:not([disabled]):not([aria-hidden])",
			"select:not([disabled]):not([aria-hidden])",
			"textarea:not([disabled]):not([aria-hidden])",
			"area[href]",
			"iframe",
			"object",
			"embed",
			"[contenteditable]",
			"[tabindex]:not([tabindex^=\"-\"])"
		];
		this.options = {
			...config,
			...options,
			classes: {
				...config.classes,
				...options?.classes
			},
			hashSettings: {
				...config.hashSettings,
				...options?.hashSettings
			},
			on: {
				...config.on,
				...options?.on
			}
		};
		this.bodyLock = false;
		this.options.init && this.initPopups();
	}
	initPopups() {
		this.eventsPopup();
	}
	eventsPopup() {
		document.addEventListener("click", function(e) {
			if (e.target.closest(`[${this.options.attributeCloseButton}]`)) {
				e.preventDefault();
				e.stopPropagation();
				console.log("Close button clicked");
				this.close();
				return;
			}
		}.bind(this), true);
		document.addEventListener("click", function(e) {
			const buttonOpen = e.target.closest(`[${this.options.attributeOpenButton}]`);
			if (buttonOpen) {
				e.preventDefault();
				this._dataValue = buttonOpen.getAttribute(this.options.attributeOpenButton) ? buttonOpen.getAttribute(this.options.attributeOpenButton) : "error";
				this.youTubeCode = buttonOpen.getAttribute(this.options.youtubeAttribute) ? buttonOpen.getAttribute(this.options.youtubeAttribute) : null;
				if (this._dataValue !== "error") {
					if (!this.isOpen) this.lastFocusEl = buttonOpen;
					this.targetOpen.selector = `${this._dataValue}`;
					this._selectorOpen = true;
					this.open();
					return;
				}
				return;
			}
			if (this.isOpen && !e.target.closest(`.${this.options.classes.popupContent}`)) {
				e.preventDefault();
				console.log("Closing popup by clicking outside");
				this.close();
				return;
			}
		}.bind(this));
		document.addEventListener("keydown", function(e) {
			if (this.options.closeEsc && e.which == 27 && e.code === "Escape" && this.isOpen) {
				e.preventDefault();
				this.close();
				return;
			}
			if (this.options.focusCatch && e.which == 9 && this.isOpen) {
				this._focusCatch(e);
				return;
			}
		}.bind(this));
		if (this.options.hashSettings.goHash) {
			window.addEventListener("hashchange", function() {
				if (window.location.hash) this._openToHash();
				else this.close(this.targetOpen.selector);
			}.bind(this));
			window.addEventListener("load", function() {
				if (window.location.hash) this._openToHash();
			}.bind(this));
		}
	}
	open(selectorValue) {
		if (bodyLockStatus) {
			this.bodyLock = document.documentElement.classList.contains("lock") && !this.isOpen ? true : false;
			if (selectorValue && typeof selectorValue === "string" && selectorValue.trim() !== "") {
				this.targetOpen.selector = selectorValue;
				this._selectorOpen = true;
			}
			if (this.isOpen) {
				this._reopen = true;
				this.close();
			}
			if (!this._selectorOpen) this.targetOpen.selector = this.lastClosed.selector;
			if (!this._reopen) this.previousActiveElement = document.activeElement;
			this.targetOpen.element = document.querySelector(this.targetOpen.selector);
			if (this.targetOpen.element) {
				if (this.youTubeCode) {
					const urlVideo = `https://www.youtube.com/embed/${this.youTubeCode}?rel=0&showinfo=0&autoplay=1`;
					const iframe = document.createElement("iframe");
					iframe.setAttribute("allowfullscreen", "");
					const autoplay = this.options.setAutoplayYoutube ? "autoplay;" : "";
					iframe.setAttribute("allow", `${autoplay}; encrypted-media`);
					iframe.setAttribute("src", urlVideo);
					if (!this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`)) this.targetOpen.element.querySelector(".popup__text").setAttribute(`${this.options.youtubePlaceAttribute}`, "");
					this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`).appendChild(iframe);
				}
				if (this.options.hashSettings.location) {
					this._getHash();
					this._setHash();
				}
				this.options.on.beforeOpen(this);
				document.dispatchEvent(new CustomEvent("beforePopupOpen", { detail: { popup: this } }));
				this.targetOpen.element.classList.add(this.options.classes.popupActive);
				document.documentElement.classList.add(this.options.classes.bodyActive);
				if (!this._reopen) !this.bodyLock && bodyLock();
				else this._reopen = false;
				this.targetOpen.element.setAttribute("aria-hidden", "false");
				this.previousOpen.selector = this.targetOpen.selector;
				this.previousOpen.element = this.targetOpen.element;
				this._selectorOpen = false;
				this.isOpen = true;
				setTimeout(() => {
					this._focusTrap();
				}, 50);
				this.options.on.afterOpen(this);
				document.dispatchEvent(new CustomEvent("afterPopupOpen", { detail: { popup: this } }));
			}
		}
	}
	close(selectorValue) {
		if (selectorValue && typeof selectorValue === "string" && selectorValue.trim() !== "") this.previousOpen.selector = selectorValue;
		if (!this.isOpen || !bodyLockStatus) {
			console.log("Popup is not open or bodyLockStatus is false");
			return;
		}
		this.options.on.beforeClose(this);
		document.dispatchEvent(new CustomEvent("beforePopupClose", { detail: { popup: this } }));
		if (this.youTubeCode) {
			if (this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`)) this.targetOpen.element.querySelector(`[${this.options.youtubePlaceAttribute}]`).innerHTML = "";
		}
		this.previousOpen.element.classList.remove(this.options.classes.popupActive);
		this.previousOpen.element.setAttribute("aria-hidden", "true");
		if (!this._reopen) {
			document.documentElement.classList.remove(this.options.classes.bodyActive);
			!this.bodyLock && bodyUnlock();
			this.isOpen = false;
		}
		this._removeHash();
		if (this._selectorOpen) {
			this.lastClosed.selector = this.previousOpen.selector;
			this.lastClosed.element = this.previousOpen.element;
		}
		this.options.on.afterClose(this);
		document.dispatchEvent(new CustomEvent("afterPopupClose", { detail: { popup: this } }));
		setTimeout(() => {
			this._focusTrap();
		}, 50);
	}
	_getHash() {
		if (this.options.hashSettings.location) this.hash = this.targetOpen.selector.includes("#") ? this.targetOpen.selector : this.targetOpen.selector.replace(".", "#");
	}
	_openToHash() {
		const hash = window.location.hash;
		if (!hash || hash === "#") return;
		const hashValue = hash.replace("#", "");
		if (!hashValue) return;
		let classInHash = document.querySelector(`.${hashValue}`) ? `.${hashValue}` : document.querySelector(`#${hashValue}`) ? `#${hashValue}` : null;
		if (!classInHash) return;
		const buttons = document.querySelector(`[${this.options.attributeOpenButton}="${classInHash}"]`) || document.querySelector(`[${this.options.attributeOpenButton}="${classInHash.replace(".", "#")}"]`);
		if (!buttons) return;
		this.youTubeCode = buttons.getAttribute(this.options.youtubeAttribute) ? buttons.getAttribute(this.options.youtubeAttribute) : null;
		this.open(classInHash);
	}
	_setHash() {
		history.pushState("", "", this.hash);
	}
	_removeHash() {
		history.pushState("", "", window.location.href.split("#")[0]);
	}
	_focusCatch(e) {
		const focusable = this.targetOpen.element.querySelectorAll(this._focusEl);
		const focusArray = Array.prototype.slice.call(focusable);
		const focusedIndex = focusArray.indexOf(document.activeElement);
		if (e.shiftKey && focusedIndex === 0) {
			focusArray[focusArray.length - 1].focus();
			e.preventDefault();
		}
		if (!e.shiftKey && focusedIndex === focusArray.length - 1) {
			focusArray[0].focus();
			e.preventDefault();
		}
	}
	_focusTrap() {
		const focusable = this.previousOpen.element.querySelectorAll(this._focusEl);
		if (!this.isOpen && this.lastFocusEl) this.lastFocusEl.focus();
		else if (focusable && focusable.length > 0) focusable[0].focus();
	}
};
document.querySelector("[data-popup]") && window.addEventListener("load", () => window.flsPopup = new Popup({}));
document.addEventListener("DOMContentLoaded", () => {
	let lastScroll = 0;
	const header = document.querySelector(".header");
	const scrollOffset = 80;
	if (!header) return;
	window.addEventListener("scroll", () => {
		const currentScroll = window.pageYOffset;
		if (currentScroll <= 0) {
			header.classList.remove("_hide");
			return;
		}
		if (currentScroll > lastScroll && currentScroll > scrollOffset) header.classList.add("_hide");
		else header.classList.remove("_hide");
		lastScroll = currentScroll;
	});
});
document.addEventListener("DOMContentLoaded", function() {
	const wrapper = document.querySelector(".wrapper");
	const dropdownItems = document.querySelectorAll(".menu__item--has-dropdown");
	function handleDropdownHover(isHovering) {
		if (isHovering) wrapper.classList.add("dropdown-active");
		else {
			const hasActiveDropdown = Array.from(dropdownItems).some((item) => item.matches(":hover"));
			const isDropdownHovered = Array.from(document.querySelectorAll(".menu__dropdown")).some((dropdown) => dropdown.matches(":hover"));
			if (!hasActiveDropdown && !isDropdownHovered) wrapper.classList.remove("dropdown-active");
		}
	}
	dropdownItems.forEach((item) => {
		item.addEventListener("mouseenter", () => {
			handleDropdownHover(true);
		});
		item.addEventListener("mouseleave", (e) => {
			const relatedTarget = e.relatedTarget;
			const dropdown = item.querySelector(".menu__dropdown");
			if (dropdown && dropdown.contains(relatedTarget)) return;
			handleDropdownHover(false);
		});
	});
	document.querySelectorAll(".header__dropdown").forEach((dropdown) => {
		dropdown.addEventListener("mouseenter", () => {
			handleDropdownHover(true);
		});
		dropdown.addEventListener("mouseleave", () => {
			handleDropdownHover(false);
		});
	});
	document.addEventListener("keydown", function(e) {
		if (e.key === "Escape" && wrapper.classList.contains("dropdown-active")) wrapper.classList.remove("dropdown-active");
	});
});
document.addEventListener("DOMContentLoaded", function() {
	const wrapper = document.querySelector(".wrapper");
	const searchWrapper = document.querySelector(".header__search");
	const searchInput = document.querySelector(".header__search-input input");
	const searchContent = document.querySelector(".header__search-content");
	const searchItems = document.querySelectorAll(".header__search-item");
	const clearBtn = document.querySelector(".header__search-btn--clear");
	const searchBtn = document.querySelector(".header__search-btn--search");
	let searchTimeout;
	let blurTimeout;
	let closeTimeout;
	let isMobileFocus = false;
	const mobileBreakpoint = 1100;
	function isMobile() {
		return window.innerWidth <= mobileBreakpoint;
	}
	function showContent() {
		clearTimeout(searchTimeout);
		clearTimeout(closeTimeout);
		searchContent.classList.add("active");
		if (wrapper) wrapper.classList.add("search-active");
	}
	function hideContent() {
		searchContent.classList.remove("active");
		if (wrapper) wrapper.classList.remove("search-active");
	}
	function updateClearButton() {
		const hasValue = searchInput.value.trim().length > 0;
		requestAnimationFrame(() => {
			if (hasValue) searchWrapper.classList.add("has-value");
			else searchWrapper.classList.remove("has-value");
		});
	}
	function closeMobileSearch() {
		if (!isMobile()) return;
		hideContent();
		clearTimeout(closeTimeout);
		closeTimeout = setTimeout(() => {
			searchWrapper.classList.remove("active");
			searchInput.blur();
			if (searchInput.value.trim()) {
				searchInput.value = "";
				updateClearButton();
			}
		}, 150);
	}
	searchInput.addEventListener("input", function(e) {
		const trimmedQuery = e.target.value.trim();
		clearTimeout(searchTimeout);
		clearTimeout(closeTimeout);
		requestAnimationFrame(() => {
			updateClearButton();
		});
		if (trimmedQuery !== "") showContent();
		else hideContent();
	});
	searchInput.addEventListener("focus", function() {
		clearTimeout(closeTimeout);
		clearTimeout(blurTimeout);
		if (!isMobile() || searchWrapper.classList.contains("active")) searchWrapper.classList.add("active");
		if (this.value.trim() !== "") showContent();
	});
	searchInput.addEventListener("blur", function() {
		if (isMobileFocus) {
			isMobileFocus = false;
			return;
		}
		blurTimeout = setTimeout(() => {
			if (!searchInput.value.trim()) {
				if (isMobile()) closeMobileSearch();
				else {
					searchWrapper.classList.remove("active");
					hideContent();
				}
			} else if (!isMobile()) searchWrapper.classList.remove("active");
		}, 200);
	});
	searchBtn.addEventListener("click", function(e) {
		e.preventDefault();
		e.stopPropagation();
		clearTimeout(closeTimeout);
		if (isMobile() && !searchWrapper.classList.contains("active")) {
			searchWrapper.classList.add("active");
			isMobileFocus = true;
			requestAnimationFrame(() => {
				searchInput.focus();
				setTimeout(() => {
					isMobileFocus = false;
				}, 100);
			});
			return;
		}
		searchInput.focus();
	});
	searchWrapper.addEventListener("mousedown", function(e) {
		e.stopPropagation();
	});
	clearBtn.addEventListener("click", function(e) {
		e.preventDefault();
		e.stopPropagation();
		if (window.navigator && window.navigator.vibrate) window.navigator.vibrate(10);
		searchInput.value = "";
		requestAnimationFrame(() => {
			updateClearButton();
		});
		hideContent();
		if (isMobile()) closeMobileSearch();
		else {
			searchWrapper.classList.remove("active");
			if (document.activeElement === searchInput) searchWrapper.classList.add("active");
		}
		searchInput.dispatchEvent(new Event("input", { bubbles: true }));
	});
	searchItems.forEach((item) => {
		item.addEventListener("click", function() {
			const textElement = this.querySelector(".text._black");
			if (!textElement) return;
			const selectedText = textElement.textContent.trim();
			searchInput.value = selectedText;
			requestAnimationFrame(() => {
				updateClearButton();
			});
			if (isMobile()) closeMobileSearch();
			else {
				hideContent();
				searchWrapper.classList.remove("active");
				searchInput.blur();
			}
			searchInput.dispatchEvent(new Event("input", { bubbles: true }));
		});
	});
	document.addEventListener("click", function(e) {
		if (e.target.closest(".header__search-btn--search")) return;
		if (!searchWrapper.contains(e.target)) {
			clearTimeout(blurTimeout);
			if (isMobile()) closeMobileSearch();
			else {
				hideContent();
				if (!searchInput.value.trim()) {
					searchWrapper.classList.remove("active");
					searchWrapper.classList.remove("has-value");
				} else searchWrapper.classList.remove("active");
			}
		}
	});
	searchInput.addEventListener("keydown", function(e) {
		if (e.key === "Escape") {
			e.preventDefault();
			if (isMobile()) closeMobileSearch();
			else {
				hideContent();
				if (!searchInput.value.trim()) searchWrapper.classList.remove("has-value");
				searchWrapper.classList.remove("active");
				this.blur();
			}
		}
	});
	let resizeTimeout;
	window.addEventListener("resize", function() {
		clearTimeout(resizeTimeout);
		clearTimeout(closeTimeout);
		resizeTimeout = setTimeout(() => {
			if (!isMobile() && searchWrapper.classList.contains("active") && !searchInput.value.trim()) searchWrapper.classList.remove("active");
			if (!isMobile() && searchContent.classList.contains("active") && !searchInput.value.trim()) hideContent();
		}, 100);
	});
	updateClearButton();
	if (searchInput.value.trim()) searchWrapper.classList.add("has-value");
});
document.addEventListener("DOMContentLoaded", function() {
	const searchBtnMobile = document.querySelector(".header__search-btn-mobile");
	const mobileSearch = document.querySelector(".mobile-search");
	const mobileInput = document.querySelector(".mobile-search__input");
	const mobileContent = document.querySelector(".mobile-search__content");
	const mobileClear = document.querySelector(".mobile-search__btn--clear");
	const mobileItems = document.querySelectorAll(".mobile-search__item");
	const header = document.querySelector(".header");
	const wrapper = document.querySelector(".wrapper");
	function openMobileSearch() {
		if (mobileSearch) {
			mobileSearch.classList.add("active");
			header.classList.add("search-open");
			if (wrapper) wrapper.classList.add("search-active");
			setTimeout(() => {
				if (mobileInput) mobileInput.focus();
			}, 300);
		}
	}
	function closeMobileSearch() {
		if (mobileSearch) {
			mobileSearch.classList.remove("active");
			header.classList.remove("search-open");
			if (wrapper) wrapper.classList.remove("search-active");
			if (mobileInput) {
				mobileInput.value = "";
				mobileSearch.classList.remove("has-value");
			}
			if (mobileContent) mobileContent.classList.remove("active");
		}
	}
	if (searchBtnMobile) searchBtnMobile.addEventListener("click", function(e) {
		e.preventDefault();
		e.stopPropagation();
		if (mobileSearch) {
			if (mobileSearch.classList.contains("active")) closeMobileSearch();
			else openMobileSearch();
		}
	});
	if (mobileClear) mobileClear.addEventListener("click", function(e) {
		e.stopPropagation();
		if (mobileInput) {
			if (mobileInput.value.trim().length > 0) {
				mobileInput.value = "";
				mobileInput.focus();
				mobileSearch.classList.remove("has-value");
				if (mobileContent) mobileContent.classList.remove("active");
			} else closeMobileSearch();
		}
	});
	if (mobileInput) {
		mobileInput.addEventListener("input", function() {
			if (this.value.trim().length > 0) {
				mobileSearch.classList.add("has-value");
				if (mobileContent) mobileContent.classList.add("active");
			} else {
				mobileSearch.classList.remove("has-value");
				if (mobileContent) mobileContent.classList.remove("active");
			}
		});
		mobileInput.addEventListener("keydown", function(e) {
			if (e.key === "Escape") {
				if (this.value.trim().length > 0) {
					this.value = "";
					mobileSearch.classList.remove("has-value");
					if (mobileContent) mobileContent.classList.remove("active");
					this.focus();
				} else {
					closeMobileSearch();
					this.blur();
				}
			}
			if (e.key === "Enter") e.preventDefault();
		});
	}
	mobileItems.forEach((item) => {
		item.addEventListener("click", function() {
			const textElement = this.querySelector(".text-caption");
			if (textElement && mobileInput) {
				mobileInput.value = textElement.textContent.trim();
				mobileSearch.classList.add("has-value");
				setTimeout(() => {
					closeMobileSearch();
				}, 500);
			}
		});
	});
	document.addEventListener("click", function(e) {
		if (mobileSearch && mobileSearch.classList.contains("active")) {
			if (!mobileSearch.contains(e.target) && !searchBtnMobile.contains(e.target)) closeMobileSearch();
		}
	});
	window.addEventListener("resize", function() {
		if (window.innerWidth > 768 && mobileSearch && mobileSearch.classList.contains("active")) closeMobileSearch();
	});
});
document.addEventListener("DOMContentLoaded", function() {
	const upButton = document.getElementById("upButton");
	if (!upButton) return;
	window.addEventListener("scroll", () => {
		upButton.classList.toggle("show", window.scrollY > 500);
	});
	upButton.addEventListener("click", () => {
		window.scrollTo({
			top: 0,
			behavior: "smooth"
		});
	});
});
document.addEventListener("DOMContentLoaded", () => {
	const blocks = document.querySelectorAll(".sort__block");
	const isTouch = "ontouchstart" in window || navigator.maxTouchPoints > 0;
	blocks.forEach((block) => {
		const btn = block.querySelector(".button-sort");
		const content = block.querySelector(".sort__content");
		const btnText = btn.querySelector("span");
		const radios = content.querySelectorAll("input[type=\"radio\"]");
		let checked = content.querySelector("input[type=\"radio\"]:checked") || radios[0];
		if (checked && !checked.checked) checked.checked = true;
		if (checked) btnText.textContent = checked.nextElementSibling.textContent;
		const close = () => {
			content.classList.remove("active");
			block.classList.remove("is-open");
		};
		const open = () => {
			document.querySelectorAll(".sort__content.active").forEach((c) => {
				if (c !== content) c.classList.remove("active");
			});
			document.querySelectorAll(".sort__block.is-open").forEach((b) => {
				if (b !== block) b.classList.remove("is-open");
			});
			content.classList.add("active");
			block.classList.add("is-open");
		};
		btn.addEventListener("click", (e) => {
			e.preventDefault();
			e.stopPropagation();
			if (isTouch) {
				if (content.classList.contains("active")) close();
				else open();
			}
		});
		content.addEventListener("change", (e) => {
			const target = e.target;
			if (!target.matches("input[type=\"radio\"]")) return;
			content.querySelectorAll("input[type=\"radio\"]").forEach((r) => r.checked = false);
			target.checked = true;
			const label = target.closest("label");
			if (label) {
				btnText.textContent = label.querySelector("span").textContent;
				content.querySelectorAll("label").forEach((l) => l.classList.remove("active"));
				label.classList.add("active");
			}
			if (isTouch) close();
		});
		document.addEventListener("click", (e) => {
			if (!block.contains(e.target)) close();
		});
		document.addEventListener("keydown", (e) => {
			if (e.key === "Escape") close();
		});
		const initialChecked = content.querySelector("input[type=\"radio\"]:checked");
		if (initialChecked) {
			const parentLabel = initialChecked.closest("label");
			if (parentLabel) parentLabel.classList.add("active");
		}
	});
});
document.addEventListener("DOMContentLoaded", function() {
	const filterButton = document.querySelector(".button-filter");
	const mobileFilter = document.querySelector(".page__mobile-filter");
	function openFilter() {
		if (!mobileFilter) return;
		mobileFilter.classList.add("_active");
		document.body.classList.add("_lock");
		let overlay = document.querySelector(".filter-overlay");
		if (!overlay) {
			overlay = document.createElement("div");
			overlay.className = "filter-overlay";
			document.body.appendChild(overlay);
			overlay.addEventListener("click", closeFilter);
		}
		setTimeout(() => overlay.classList.add("_active"), 10);
	}
	function closeFilter() {
		if (!mobileFilter) return;
		mobileFilter.classList.remove("_active");
		document.body.classList.remove("_lock");
		const overlay = document.querySelector(".filter-overlay");
		if (overlay) {
			overlay.classList.remove("_active");
			setTimeout(() => overlay.remove(), 300);
		}
	}
	if (filterButton) filterButton.addEventListener("click", openFilter);
	document.addEventListener("click", function(e) {
		if (e.target.closest("[data-close]")) closeFilter();
	});
	document.addEventListener("keydown", function(e) {
		if (e.key === "Escape" && mobileFilter && mobileFilter.classList.contains("_active")) closeFilter();
	});
});
document.addEventListener("DOMContentLoaded", function() {
	document.querySelector(".wrapper");
	const searchWrapper = document.querySelector(".page__sidebar-search");
	const searchInput = document.querySelector(".page__sidebar-search-input input");
	const clearBtn = document.querySelector(".page__sidebar-search-btn--clear");
	const searchBtn = document.querySelector(".page__sidebar-search-btn--search");
	if (!searchWrapper || !searchInput) {
		console.warn("Search elements not found");
		return;
	}
	function updateClearButton() {
		const hasValue = searchInput.value.trim().length > 0;
		requestAnimationFrame(() => {
			if (hasValue) searchWrapper.classList.add("has-value");
			else searchWrapper.classList.remove("has-value");
		});
	}
	function clearSearch() {
		searchInput.value = "";
		updateClearButton();
		searchInput.focus();
		searchInput.dispatchEvent(new Event("input", { bubbles: true }));
		searchInput.dispatchEvent(new Event("change", { bubbles: true }));
	}
	searchInput.addEventListener("input", function() {
		updateClearButton();
	});
	searchInput.addEventListener("focus", function() {
		searchWrapper.classList.add("active");
		updateClearButton();
	});
	searchInput.addEventListener("blur", function() {
		setTimeout(() => {
			if (!searchInput.value.trim()) searchWrapper.classList.remove("active");
		}, 200);
	});
	if (clearBtn) clearBtn.addEventListener("click", function(e) {
		e.preventDefault();
		e.stopPropagation();
		clearSearch();
	});
	if (searchBtn) searchBtn.addEventListener("click", function(e) {
		e.preventDefault();
		searchInput.focus();
	});
	document.addEventListener("click", function(e) {
		if (!searchWrapper.contains(e.target)) {
			if (!searchInput.value.trim()) {
				searchWrapper.classList.remove("active");
				searchWrapper.classList.remove("has-value");
			} else searchWrapper.classList.remove("active");
		}
	});
	searchInput.addEventListener("keydown", function(e) {
		if (e.key === "Escape") {
			e.preventDefault();
			searchInput.blur();
			if (!searchInput.value.trim()) {
				searchWrapper.classList.remove("active");
				searchWrapper.classList.remove("has-value");
			} else searchWrapper.classList.remove("active");
		}
	});
	updateClearButton();
});
document.addEventListener("DOMContentLoaded", function() {
	const subnav = document.querySelector(".home__subnav");
	const footer = document.querySelector("footer");
	if (!subnav || !footer) return;
	new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				subnav.style.position = "absolute";
				subnav.style.top = "auto";
				subnav.style.bottom = footer.offsetHeight + 20 + "px";
			} else {
				subnav.style.position = "sticky";
				subnav.style.top = "30px";
				subnav.style.bottom = "auto";
			}
		});
	}, {
		root: null,
		threshold: 0,
		rootMargin: "0px 0px -50px 0px"
	}).observe(footer);
});
document.addEventListener("DOMContentLoaded", () => {
	const langContainer = document.querySelector(".header__lang");
	const navElement = document.querySelector(".header__nav");
	if (!langContainer) return;
	const langBtn = langContainer.querySelector(".header__lang-btn");
	const langCurrent = langContainer.querySelector(".header__lang-current");
	const langOptions = langContainer.querySelectorAll(".header__lang-option");
	function setNavZIndex(isLangOpen) {
		if (!navElement) return;
		if (isLangOpen) navElement.style.zIndex = "-1";
		else navElement.style.zIndex = "";
	}
	function setLangOpenState(isOpen) {
		if (isOpen) {
			langContainer.classList.add("open");
			setNavZIndex(true);
		} else {
			langContainer.classList.remove("open");
			setNavZIndex(false);
		}
	}
	function repositionDropdownOptions() {
		const nonActiveOptions = Array.from(langOptions).filter((opt) => !opt.classList.contains("active"));
		nonActiveOptions.forEach((opt) => {
			opt.style.removeProperty("--option-index");
		});
		nonActiveOptions.forEach((opt, idx) => {
			opt.style.setProperty("--option-index", idx + 1);
		});
		const totalOptions = langOptions.length;
		langContainer.style.setProperty("--lang-count", totalOptions);
	}
	function setCurrentLang(lang) {
		langCurrent.textContent = lang.toUpperCase();
		langOptions.forEach((option) => {
			if (option.getAttribute("data-lang") === lang) option.classList.add("active");
			else option.classList.remove("active");
		});
		repositionDropdownOptions();
		localStorage.setItem("preferred-language", lang);
	}
	function initCurrentLang() {
		const activeOption = Array.from(langOptions).find((opt) => opt.classList.contains("active"));
		if (activeOption) {
			const activeLang = activeOption.getAttribute("data-lang");
			langCurrent.textContent = activeLang.toUpperCase();
		} else if (langOptions.length > 0) setCurrentLang(langOptions[0].getAttribute("data-lang"));
		repositionDropdownOptions();
	}
	langBtn.addEventListener("click", (e) => {
		e.preventDefault();
		e.stopPropagation();
		const willBeOpen = !langContainer.classList.contains("open");
		setLangOpenState(willBeOpen);
		if (willBeOpen) repositionDropdownOptions();
	});
	let hoverTimer;
	langContainer.addEventListener("mouseenter", () => {
		clearTimeout(hoverTimer);
		setLangOpenState(true);
		repositionDropdownOptions();
	});
	langContainer.addEventListener("mouseleave", () => {
		hoverTimer = setTimeout(() => {
			setLangOpenState(false);
		}, 100);
	});
	const dropdown = langContainer.querySelector(".header__lang-dropdown");
	if (dropdown) {
		dropdown.addEventListener("mouseenter", () => {
			clearTimeout(hoverTimer);
		});
		dropdown.addEventListener("mouseleave", () => {
			hoverTimer = setTimeout(() => {
				setLangOpenState(false);
			}, 100);
		});
	}
	langOptions.forEach((option) => {
		option.addEventListener("click", (e) => {
			e.preventDefault();
			e.stopPropagation();
			const selectedLang = option.getAttribute("data-lang");
			if (selectedLang !== langCurrent.textContent.toLowerCase()) {
				setCurrentLang(selectedLang);
				const langChangeEvent = new CustomEvent("languageChanged", { detail: { language: selectedLang } });
				document.dispatchEvent(langChangeEvent);
			}
			setTimeout(() => {
				setLangOpenState(false);
			}, 200);
		});
	});
	document.addEventListener("click", (e) => {
		if (!langContainer.contains(e.target)) setLangOpenState(false);
	});
	document.addEventListener("keydown", (e) => {
		if (e.key === "Escape" && langContainer.classList.contains("open")) setLangOpenState(false);
	});
	initCurrentLang();
	let resizeTimer;
	window.addEventListener("resize", () => {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(() => {
			if (langContainer.classList.contains("open")) repositionDropdownOptions();
		}, 150);
	});
	new MutationObserver(() => {
		repositionDropdownOptions();
	}).observe(langContainer, {
		childList: true,
		subtree: true
	});
});
document.addEventListener("DOMContentLoaded", function() {
	const subnavItems = document.querySelectorAll(".home__subnav-list-item");
	let activeItem = null;
	let timeoutId = null;
	subnavItems.forEach((item) => {
		const link = item.querySelector("a");
		item.addEventListener("mouseenter", function(e) {
			if (timeoutId) {
				clearTimeout(timeoutId);
				timeoutId = null;
			}
			if (activeItem && activeItem !== this) activeItem.querySelector("a").classList.remove("is-active");
			link.classList.add("is-active");
			activeItem = this;
		});
		item.addEventListener("mouseleave", function(e) {
			timeoutId = setTimeout(() => {
				link.classList.remove("is-active");
				activeItem = null;
				timeoutId = null;
			}, 300);
		});
	});
});
document.addEventListener("DOMContentLoaded", function() {
	document.querySelectorAll(".phone-mask").forEach(function(phoneInput) {
		if (!phoneInput) return;
		const mask = "+375 (__) ___ - __ - __";
		let digits = "";
		function updateInput() {
			let res = "";
			let di = 0;
			for (let i = 0; i < 23; i++) if (mask[i] === "_") res += di < digits.length ? digits[di++] : "_";
			else res += mask[i];
			phoneInput.value = res;
			phoneInput.setAttribute("data-raw-digits", digits);
		}
		function getCursor() {
			let count = 0;
			for (let i = 0; i < 23; i++) if (mask[i] === "_") {
				if (count === digits.length) return i < 5 ? 5 : i;
				count++;
			}
			return 23;
		}
		function setCursor() {
			const pos = getCursor();
			phoneInput.setSelectionRange(pos, pos);
		}
		phoneInput.addEventListener("input", function() {
			digits = phoneInput.value.replace("+375", "").replace(/\D/g, "").slice(0, 9);
			updateInput();
			setCursor();
			this.classList.remove("error");
			removeErrorMessage(this);
		});
		phoneInput.addEventListener("keydown", function(e) {
			const start = phoneInput.selectionStart;
			const end = phoneInput.selectionEnd;
			if (e.key === "Backspace") {
				if (start !== end) digits = "";
				else if (digits.length > 0) digits = digits.slice(0, -1);
				updateInput();
				setCursor();
				e.preventDefault();
			}
			if (e.key === "Delete") {
				if (start !== end) {
					digits = "";
					updateInput();
					setCursor();
				}
				e.preventDefault();
			}
		});
		phoneInput.addEventListener("focus", function() {
			updateInput();
			setCursor();
		});
		phoneInput.addEventListener("click", function(e) {
			e.preventDefault();
			setCursor();
		});
		phoneInput.addEventListener("paste", function(e) {
			e.preventDefault();
			digits = (e.clipboardData || window.clipboardData).getData("text").replace(/\D/g, "").slice(0, 9);
			updateInput();
			setCursor();
		});
		updateInput();
	});
	document.querySelectorAll(".radio-block").forEach((block) => {
		const radio = block.querySelector(".radio");
		const label = block.querySelector(".radio-label");
		if (radio && label) {
			const handleClick = function(e) {
				if (!e.target.closest("input")) {
					radio.checked = true;
					const changeEvent = new Event("change", { bubbles: true });
					radio.dispatchEvent(changeEvent);
					const parentBlock = block.closest(".form__line-block[data-error]");
					if (parentBlock) {
						parentBlock.classList.remove("has-error");
						removeErrorMessage(parentBlock);
					}
				}
			};
			block.addEventListener("click", handleClick);
			label.addEventListener("click", function(e) {
				e.stopPropagation();
			});
		}
	});
	function removeErrorMessage(element) {
		const parent = element.closest ? element.closest(".form__line") : element.parentElement;
		if (parent) {
			const errorMsg = parent.querySelector(".error-message");
			if (errorMsg) errorMsg.remove();
		}
		const block = element.closest ? element.closest(".form__line-block") : null;
		if (block) {
			const errorMsg = block.querySelector(".error-message");
			if (errorMsg) errorMsg.remove();
		}
	}
	const popup = document.querySelector(".popup");
	const header = document.querySelector(".header");
	if (popup && header) {
		new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.attributeName === "class") {
					if (popup.classList.contains("popup_show")) header.classList.add("_hide");
					else header.classList.remove("_hide");
				}
			});
		}).observe(popup, {
			attributes: true,
			attributeFilter: ["class"]
		});
		if (popup.classList.contains("popup_show")) header.classList.add("_hide");
	}
});
document.addEventListener("DOMContentLoaded", function() {
	const navContainer = document.querySelector(".home__feed-news-nav");
	const newsList = document.querySelector(".home__feed-news-list");
	if (!navContainer || !newsList) return;
	let animationTimeout = null;
	function filterNews(category) {
		if (animationTimeout) {
			clearTimeout(animationTimeout);
			animationTimeout = null;
		}
		const items = newsList.querySelectorAll(".home__feed-news-item");
		let visibleCount = 0;
		items.forEach((item) => {
			item.style.transition = "none";
			item.style.opacity = "";
			item.style.transform = "";
			item.style.display = "";
		});
		newsList.offsetHeight;
		items.forEach((item, index) => {
			const itemCategory = item.dataset.category || "university";
			if (category === "all" || itemCategory === category) {
				visibleCount++;
				item.style.display = "";
				item.style.opacity = "0";
				item.style.transform = "translateY(20px) scale(0.95)";
				item.style.transition = "none";
				requestAnimationFrame(() => {
					animationTimeout = setTimeout(() => {
						item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
						item.style.opacity = "1";
						item.style.transform = "translateY(0) scale(1)";
					}, index * 80);
				});
			} else {
				item.style.transition = "none";
				item.style.opacity = "0";
				item.style.transform = "translateY(20px) scale(0.95)";
				item.style.display = "none";
			}
		});
		if (visibleCount === 0) newsList.style.minHeight = "200px";
		else newsList.style.minHeight = "";
	}
	function getActiveCategory() {
		const activeItem = navContainer.querySelector(".home__feed-news-nav-item._active");
		if (activeItem) return activeItem.dataset.tab || "all";
		const firstItem = navContainer.querySelector(".home__feed-news-nav-item");
		if (firstItem) {
			firstItem.classList.add("_active");
			return firstItem.dataset.tab || "all";
		}
		return "all";
	}
	navContainer.addEventListener("click", function(e) {
		const navItem = e.target.closest(".home__feed-news-nav-item");
		if (!navItem) return;
		const category = navItem.dataset.tab || "all";
		document.querySelectorAll(".home__feed-news-nav-item").forEach((el) => {
			el.classList.remove("_active");
		});
		navItem.classList.add("_active");
		filterNews(category);
	});
	filterNews(getActiveCategory());
});
//#endregion
//#region src/components/layout/digcounter/digcounter.js
function digitsCounter() {
	function digitsCountersInit(digitsCountersItems) {
		let digitsCounters = digitsCountersItems ? digitsCountersItems : document.querySelectorAll("[data-fls-digcounter]");
		if (digitsCounters.length) digitsCounters.forEach((digitsCounter) => {
			if (digitsCounter.hasAttribute("data-fls-digcounter-go")) return;
			digitsCounter.setAttribute("data-fls-digcounter-go", "");
			digitsCounter.dataset.flsDigcounter = digitsCounter.innerHTML;
			digitsCounter.innerHTML = `0`;
			digitsCountersAnimate(digitsCounter);
		});
	}
	function digitsCountersAnimate(digitsCounter) {
		let startTimestamp = null;
		const duration = parseFloat(digitsCounter.dataset.flsDigcounterSpeed) ? parseFloat(digitsCounter.dataset.flsDigcounterSpeed) : 1e3;
		const startValue = parseFloat(digitsCounter.dataset.flsDigcounter);
		const format = digitsCounter.dataset.flsDigcounterFormat ? digitsCounter.dataset.flsDigcounterFormat : " ";
		const startPosition = 0;
		const step = (timestamp) => {
			if (!startTimestamp) startTimestamp = timestamp;
			const progress = Math.min((timestamp - startTimestamp) / duration, 1);
			const value = Math.floor(progress * (startPosition + startValue));
			digitsCounter.innerHTML = typeof digitsCounter.dataset.flsDigcounterFormat !== "undefined" ? getDigFormat(value, format) : value;
			if (progress < 1) window.requestAnimationFrame(step);
			else digitsCounter.removeAttribute("data-fls-digcounter-go");
		};
		window.requestAnimationFrame(step);
	}
	function digitsCounterAction(e) {
		const entry = e.detail.entry;
		const targetElement = entry.target;
		if (targetElement.querySelectorAll("[data-fls-digcounter]").length && !targetElement.querySelectorAll("[data-fls-watcher]").length && entry.isIntersecting) digitsCountersInit(targetElement.querySelectorAll("[data-fls-digcounter]"));
	}
	document.addEventListener("watcherCallback", digitsCounterAction);
}
document.querySelector("[data-fls-digcounter]") && window.addEventListener("load", digitsCounter);
//#endregion
//#region src/components/effects/watcher/watcher.js
var ScrollWatcher = class {
	constructor(props) {
		let defaultConfig = { logging: true };
		this.config = Object.assign(defaultConfig, props);
		this.observer;
		!document.documentElement.hasAttribute("data-fls-watch") && this.scrollWatcherRun();
	}
	scrollWatcherUpdate() {
		this.scrollWatcherRun();
	}
	scrollWatcherRun() {
		document.documentElement.setAttribute("data-fls-watch", "");
		this.scrollWatcherConstructor(document.querySelectorAll("[data-fls-watcher]"));
	}
	scrollWatcherConstructor(items) {
		if (items.length) uniqArray(Array.from(items).map(function(item) {
			if (item.dataset.flsWatcher === "navigator" && !item.dataset.flsWatcherThreshold) {
				let valueOfThreshold;
				if (item.clientHeight > 2) {
					valueOfThreshold = window.innerHeight / 2 / (item.clientHeight - 1);
					if (valueOfThreshold > 1) valueOfThreshold = 1;
				} else valueOfThreshold = 1;
				item.setAttribute("data-fls-watcher-threshold", valueOfThreshold.toFixed(2));
			}
			return `${item.dataset.flsWatcherRoot ? item.dataset.flsWatcherRoot : null}|${item.dataset.flsWatcherMargin ? item.dataset.flsWatcherMargin : "0px"}|${item.dataset.flsWatcherThreshold ? item.dataset.flsWatcherThreshold : 0}`;
		})).forEach((uniqParam) => {
			let uniqParamArray = uniqParam.split("|");
			let paramsWatch = {
				root: uniqParamArray[0],
				margin: uniqParamArray[1],
				threshold: uniqParamArray[2]
			};
			let groupItems = Array.from(items).filter(function(item) {
				let watchRoot = item.dataset.flsWatcherRoot ? item.dataset.flsWatcherRoot : null;
				let watchMargin = item.dataset.flsWatcherMargin ? item.dataset.flsWatcherMargin : "0px";
				let watchThreshold = item.dataset.flsWatcherThreshold ? item.dataset.flsWatcherThreshold : 0;
				if (String(watchRoot) === paramsWatch.root && String(watchMargin) === paramsWatch.margin && String(watchThreshold) === paramsWatch.threshold) return item;
			});
			let configWatcher = this.getScrollWatcherConfig(paramsWatch);
			this.scrollWatcherInit(groupItems, configWatcher);
		});
	}
	getScrollWatcherConfig(paramsWatch) {
		let configWatcher = {};
		if (document.querySelector(paramsWatch.root)) configWatcher.root = document.querySelector(paramsWatch.root);
		else if (paramsWatch.root !== "null") {}
		configWatcher.rootMargin = paramsWatch.margin;
		if (paramsWatch.margin.indexOf("px") < 0 && paramsWatch.margin.indexOf("%") < 0) return;
		if (paramsWatch.threshold === "prx") {
			paramsWatch.threshold = [];
			for (let i = 0; i <= 1; i += .005) paramsWatch.threshold.push(i);
		} else paramsWatch.threshold = paramsWatch.threshold.split(",");
		configWatcher.threshold = paramsWatch.threshold;
		return configWatcher;
	}
	scrollWatcherCreate(configWatcher) {
		this.observer = new IntersectionObserver((entries, observer) => {
			entries.forEach((entry) => {
				this.scrollWatcherCallback(entry, observer);
			});
		}, configWatcher);
	}
	scrollWatcherInit(items, configWatcher) {
		this.scrollWatcherCreate(configWatcher);
		items.forEach((item) => this.observer.observe(item));
	}
	scrollWatcherIntersecting(entry, targetElement) {
		if (entry.isIntersecting) !targetElement.classList.contains("--watcher-view") && targetElement.classList.add("--watcher-view");
		else targetElement.classList.contains("--watcher-view") && targetElement.classList.remove("--watcher-view");
	}
	scrollWatcherOff(targetElement, observer) {
		observer.unobserve(targetElement);
	}
	scrollWatcherCallback(entry, observer) {
		const targetElement = entry.target;
		this.scrollWatcherIntersecting(entry, targetElement);
		targetElement.hasAttribute("data-fls-watcher-once") && entry.isIntersecting && this.scrollWatcherOff(targetElement, observer);
		document.dispatchEvent(new CustomEvent("watcherCallback", { detail: { entry } }));
	}
};
document.querySelector("[data-fls-watcher]") && window.addEventListener("load", () => new ScrollWatcher({}));
//#endregion
