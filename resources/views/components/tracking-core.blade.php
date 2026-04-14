<script>
    (function () {
        const SESSION_COOKIE = 'trk_sid';
        const SESSION_TTL_MS = 30 * 60 * 1000; // 30 minutes
        const DEBOUNCE_MS = 1500;

        function nowIso() {
            return new Date().toISOString();
        }

        function uuidv4() {
            // RFC4122 v4 using Web Crypto when available.
            if (window.crypto && window.crypto.randomUUID) return window.crypto.randomUUID();
            const buf = new Uint8Array(16);
            (window.crypto || window.msCrypto).getRandomValues(buf);
            buf[6] = (buf[6] & 0x0f) | 0x40;
            buf[8] = (buf[8] & 0x3f) | 0x80;
            const hex = [...buf].map(b => b.toString(16).padStart(2, '0')).join('');
            return `${hex.slice(0, 8)}-${hex.slice(8, 12)}-${hex.slice(12, 16)}-${hex.slice(16, 20)}-${hex.slice(20)}`;
        }

        function getCookie(name) {
            const m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()\\[\\]\\\\\\/\\+^])/g, '\\$1') + '=([^;]*)'));
            return m ? decodeURIComponent(m[1]) : null;
        }

        function setCookie(name, value, maxAgeSeconds) {
            const secure = location.protocol === 'https:' ? '; Secure' : '';
            document.cookie = `${name}=${encodeURIComponent(value)}; Path=/; Max-Age=${maxAgeSeconds}; SameSite=Lax${secure}`;
        }

        function getOrCreateSessionId() {
            const existing = getCookie(SESSION_COOKIE);
            const sid = existing || ('s_' + uuidv4().replace(/-/g, ''));
            // Extend on every page load; journey is "multiple events per session" until idle timeout.
            setCookie(SESSION_COOKIE, sid, Math.floor(SESSION_TTL_MS / 1000));
            return sid;
        }

        function getCsrfToken() {
            const el = document.querySelector('meta[name="csrf-token"]');
            return el ? el.getAttribute('content') : null;
        }

        function safeReferrer() {
            try {
                return document.referrer || null;
            } catch (e) {
                return null;
            }
        }

        function safeUrl() {
            try {
                return location.href;
            } catch (e) {
                return null;
            }
        }

        function normalizeMetaEventToGa(eventName) {
            switch (eventName) {
                case 'PageView': return 'page_view';
                case 'ViewContent': return 'view_item';
                case 'AddToCart': return 'add_to_cart';
                case 'Purchase': return 'purchase';
                default: return eventName;
            }
        }

        const sessionId = getOrCreateSessionId();
        const debounceMap = new Map();

        function shouldDebounce(key, windowMs) {
            const t = Date.now();
            const last = debounceMap.get(key);
            if (last && (t - last) < windowMs) return true;
            debounceMap.set(key, t);
            return false;
        }

        function postToBackend(eventName, payload) {
            const csrf = getCsrfToken();
            return fetch('/track-event', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}),
                },
                keepalive: true,
                body: JSON.stringify({
                    event_name: eventName,
                    ...payload,
                }),
            }).catch(() => {});
        }

        function track(eventName, params) {
            const gaEvent = normalizeMetaEventToGa(eventName);

            const base = {
                event_uuid: uuidv4(),
                session_id: sessionId,
                page_url: safeUrl(),
                referrer: safeReferrer(),
                occurred_at: nowIso(),
            };

            const metadata = {
                // Standard metadata envelope (scalable, consistent)
                page: {
                    path: location.pathname,
                    title: document.title,
                },
                ...((params && params.metadata) ? params.metadata : {}),
            };

            const finalParams = { ...(params || {}) };
            const eventParams = { ...(params || {}) };
            // Keep metadata clean: store event params under metadata.event
            delete eventParams.metadata;
            metadata.event = eventParams;

            // Prevent duplicates: debounce per (event + important keys)
            const debounceKey = gaEvent + '::' + JSON.stringify({
                content_name: finalParams.content_name,
                product_name: finalParams.product_name,
                transaction_id: finalParams.transaction_id,
                page: location.pathname,
            });
            if (shouldDebounce(debounceKey, DEBOUNCE_MS)) return;

            // Fire Meta Pixel if present (use original name)
            if (typeof fbq !== 'undefined') {
                try { fbq('track', eventName, finalParams); } catch (e) {}
            }

            // Fire GA4 if present (use GA name)
            if (typeof gtag !== 'undefined') {
                try { gtag('event', gaEvent, finalParams); } catch (e) {}
            }

            // Backend uses GA event name for consistency.
            postToBackend(gaEvent, {
                ...base,
                metadata,
            });
        }

        window.Analytics = window.Analytics || {};
        window.Analytics.sessionId = sessionId;
        window.Analytics.track = track;
        window.Analytics.normalizeEventName = normalizeMetaEventToGa;
    })();
</script>

