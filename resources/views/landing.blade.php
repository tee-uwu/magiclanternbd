<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MagicLanternBD</title>
    <link rel="icon" href="/favicon.ico?v=2" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    @if(!empty($contents['facebook_pixel']))
    <script>
      !function(f,b,e,v,n,t,s){
        if(f.fbq)return;n=f.fbq=function(){
          n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)
        };
        if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];
        t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)
      }(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');

      fbq('init', '{{ $contents['facebook_pixel'] }}');
      fbq('track', 'PageView');
    </script>
    @endif

    @if(!empty($contents['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $contents['google_analytics'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $contents['google_analytics'] }}');
    </script>
    @endif

    <style>
:root {
  --cream: #f0f8ff;
  --panel: #e6f3ff;
  --panel-2: #d4ebff;
  --white: #ffffff;
  --amber: #0fb9f7;
  --amber-2: #3dd5ff;
  --amber-deep: #0891b2;
  --text: #0f3a5f;
  --muted: #4b7a99;
  --border: rgba(15,185,247,0.22);
  --shadow: 0 12px 32px rgba(0,0,0,0.12);        /* ✅ Reduced */
  --shadow-strong: 0 20px 40px rgba(0,0,0,0.16);  /* ✅ Unified */
  --dark-bg: #0d2d47;
  --dark-bg-2: #081f2e;
  --success: #3DAA6B;
  --danger: #c54545;
}

[data-theme="dark"] {
  --cream: #0a0f1a;
  --panel: #1a2338;
  --white: #f8fafc;
  --text: #e2e8f0;
  --muted: #94a3b8;
  --border: rgba(59,130,246,0.3);
}

* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Hind Siliguri', sans-serif;
  background: var(--cream);
  color: var(--text);
  overflow-x: hidden;
  line-height: 1.6;
}

img { display: block; max-width: 100%; height: auto; }
a { color: inherit; text-decoration: none; }
button { font-family: inherit; cursor: pointer; border: none; }

/* ✅ Spacing scale: 4px → 8/12/16/20/24/32 */
.container { max-width: 1160px; margin: 0 auto; padding: 0 20px; }
.section { padding: 80px 0; }
.section-title {
  font-size: clamp(28px, 4vw, 42px); font-weight: 800; 
  text-align: center; margin-bottom: 16px; /* ✅ Unified */
  color: var(--text);
}
.section-sub {
  text-align: center; color: var(--muted); max-width: 720px; 
  margin: 0 auto 32px; line-height: 1.7; font-size: 16px; /* ✅ Improved */
}
[data-theme="dark"] .section-title { color: #3dd5ff; }
.section-dark .section-title { color: #3dd5ff; }
.section-dark .section-sub { color: rgba(255,255,255,0.8); }

      /* ================= CRITICAL MOBILE FIXES ================= */
@media (max-width: 640px) {
  
  /* ✅ STEP 2: Hide ALL clutter */
  .announcement-bar, .stats-grid, .best-seller-gallery, 
  .slider, .live-orders, .trust-strip, 
  .lamp-glow, .lamp-beam, .hero-mini-trust,
  #how, #specs { display: none !important; }

  /* ✅ STEP 3: Mobile Circular Toggle (Desktop unchanged) */
  .theme-toggle {
    position: absolute !important; top: 14px !important; right: 14px !important; 
    z-index: 999 !important; width: 44px !important; height: 44px !important; 
    border-radius: 50% !important; border: none !important;
    background: rgba(255,255,255,0.92) !important; backdrop-filter: blur(16px) !important;
    font-size: 20px !important; display: flex !important; align-items: center !important; 
    justify-content: center !important; box-shadow: var(--shadow-strong) !important;
    transition: all 0.3s cubic-bezier(0.25,0.46,0.45,0.94) !important;
  }
  .theme-toggle:hover { transform: scale(1.15) !important; box-shadow: 0 8px 32px rgba(0,0,0,0.3) !important; }
  [data-theme="dark"] .theme-toggle { background: rgba(15,23,42,0.95) !important; color: #fbbf24 !important; }
  .theme-toggle .toggle-knob, .theme-toggle .sun-icon, .theme-toggle .moon-icon { display: none !important; }

  /* ✅ STEP 4: Hero - Center, compact, readable */
  .hero-grid { flex-direction: column-reverse !important; gap: 24px !important; text-align: center !important; padding: 24px 0 !important; }
  .hero-image-card img { max-height: 260px !important; object-fit: contain !important; border-radius: 20px !important; }
  .hero-actions { flex-direction: column !important; gap: 12px !important; }
  .hero-actions .btn-primary, .btn-secondary { width: 100% !important; padding: 16px !important; font-size: 16px !important; }
  .hero-title { font-size: clamp(26px, 7vw, 38px) !important; line-height: 1.25 !important; margin: 16px 0 !important; }
  .hero-sub { font-size: 15px !important; line-height: 1.75 !important; opacity: 0.95 !important; }

  /* ✅ STEP 5: Product Cards → Horizontal */
  .product-card { 
    flex-direction: row !important; align-items: center !important; gap: 16px !important; 
    padding: 20px !important; border-radius: 20px !important; text-align: left !important;
  }
  .product-thumb { width: 90px !important; height: 110px !important; margin: 0 !important; flex-shrink: 0 !important; }
  .product-name { font-size: 16px !important; margin-bottom: 6px !important; font-weight: 700 !important; }
  .product-pricing { margin-bottom: 0 !important; text-align: left !important; }
  .product-pricing strong { font-size: 18px !important; color: var(--text) !important; }
  .product-card button { 
    margin-left: auto !important; width: auto !important; padding: 12px 20px !important; 
    font-size: 14px !important; border-radius: 12px !important; white-space: nowrap !important;
  }
  .product-badge { top: 12px !important; right: 12px !important; font-size: 11px !important; padding: 6px 10px !important; }

  /* ✅ STEP 6: Order Full Width */
  .order-layout { flex-direction: column !important; gap: 0 !important; }
  .order-left-space { display: none !important; }
  .order-card { position: static !important; width: 100% !important; padding: 24px !important; border-radius: 24px !important; }

  /* ✅ STEP 7: Navbar Order Button */
  .topbar-order-btn { 
    padding: 10px 18px !important; font-size: 14px !important; max-width: 140px !important; 
    margin-right: 60px !important; /* toggle space */ white-space: nowrap !important; border-radius: 24px !important;
  }

  /* ✅ STEP 8: Polish + Performance */
  * { scroll-behavior: smooth !important; } /* ✅ Consistent */
  .section { padding: 60px 0 !important; } /* Reduced */
  [data-theme="dark"] .price-main, [data-theme="dark"] .product-pricing strong { 
    color: #60a5fa !important; text-shadow: 0 0 8px rgba(96,165,250,0.4) !important; /* ✅ Visible */
  }
  .slider-track { animation: none !important; } /* ✅ No infinite */
}

      .section-dark .section-sub {
        color: rgba(255,255,255,0.70);
      }

      .pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(15,185,247,0.14);
        color: var(--amber-deep);
        border: 1px solid rgba(15,185,247,0.20);
        border-radius: 999px;
        padding: 7px 14px;
        font-size: 12px;
        font-weight: 700;
        backdrop-filter: blur(6px);
      }

      .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        border: none;
        border-radius: 14px;
        padding: 14px 24px;
        font-size: 15px;
        font-weight: 800;
        cursor: pointer;
        transition: .25s ease;
        box-shadow: 0 10px 30px rgba(15,185,247,0.34);
      }

      .btn-primary:hover {
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 16px 44px rgba(15,185,247,0.45);
      }

      .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(92,61,30,0.16);
        background: rgba(255,255,255,0.72);
        color: #2b2b2b;
        border-radius: 14px;
        padding: 13px 22px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: .25s ease;
        backdrop-filter: blur(8px);
      }

      .btn-secondary:hover {
        transform: translateY(-2px);
        background: white;
      }

      .card {
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,185,247,0.18);
        border-radius: 22px;
        box-shadow: var(--shadow);
        transition: 0.3s ease;
      }

      .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 58px rgba(15,60,95,0.18);
      }

      .glass-dark {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(15,185,247,0.25);
        backdrop-filter: blur(14px);
        box-shadow: 0 18px 60px rgba(0,0,0,0.20);
      }

      @keyframes scroll-left {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
      }

      .announcement-bar {
        background: linear-gradient(90deg, var(--amber) 0%, var(--amber-2) 100%);
        color: white;
        padding: 12px 0;
        font-weight: 600;
        font-size: clamp(13px, 2vw, 15px);
        white-space: nowrap;
        overflow: hidden;
        border-bottom: 2px solid rgba(255,255,255,0.2);
      }

      .announcement-bar-content {
        display: inline-flex;
        align-items: center;
        gap: 2.5rem;
        animation: scroll-left 20s linear infinite;
        white-space: nowrap;
      }

      .announcement-bar-content:hover {
        animation-play-state: paused;
      }

      .slider {
    overflow: hidden;
    position: relative;
}

.slider-track {
    display: flex;
    gap: 20px;
    animation: scrollSlider 20s linear infinite;
}
 .slider-track:hover {
    animation-play-state: paused;
}
.slide {
    min-width: 240px;
    border-radius: 16px;
    overflow: hidden;
    flex-shrink: 0;
}

.slide img {
    width: 100%;
    height: 170px;
    object-fit: cover;
}

/* animation */
@keyframes scrollSlider {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

      .ticker-item {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding-right: 2rem;
        border-right: 1px solid rgba(255,255,255,0.25);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
      }

      .ticker-item:last-child {
        border-right: none;
      }

      .topbar {
        background: rgba(255,255,255,0.88);
        border-bottom: 1px solid rgba(245,166,35,0.10);
        position: sticky;
        top: 0;
        z-index: 200;
        backdrop-filter: blur(12px);
      }

      .topbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 72px;
        gap: 20px;
      }

      .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 800;
        font-size: 18px;
        color: #0f3a5f;
      }

      [data-theme="dark"] .brand {
        color: #3dd5ff;
      }

      .brand-dot {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 35%, #7ee5ff 0%, var(--amber) 40%, var(--amber-deep) 100%);
        box-shadow: 0 0 0 8px rgba(15,185,247,.10), 0 0 24px rgba(15,185,247,.35);
      }

      .nav-links {
        display: flex;
        align-items: center;
        gap: 18px;
        color: var(--muted);
        font-size: 14px;
      }

      .nav-links a:hover { 
        color: #1f130b; 
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        transition: color 0.25s ease;
      }

      [data-theme="dark"] .nav-links a {
        color: var(--text);
        opacity: 0.8;
      }

      [data-theme="dark"] .nav-links a:hover { 
        color: white !important; 
        opacity: 1;
        text-shadow: 0 0 8px rgba(255,255,255,0.3);
        transform: translateY(-1px);
      }

      .hero-wrap {
  position: relative;
  padding: 46px 0 26px;
  background: linear-gradient(180deg, var(--panel) 0%, var(--cream) 100%);
  border-bottom: 1px solid rgba(15,185,247,0.15);
  overflow: hidden;
}

      .hero-wrap::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -100px;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(15,185,247,0.18) 0%, transparent 70%);
        filter: blur(20px);
        animation: lampPulse 4s ease-in-out infinite alternate;
        pointer-events: none;
      }

      .hero-wrap::after {
        content: '';
        position: absolute;
        left: -160px;
        bottom: -200px;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(8,145,178,0.12) 0%, transparent 70%);
        filter: blur(24px);
        pointer-events: none;
      }
.lamp-glow {
  position: absolute;
  width: 500px;
  height: 500px;

  pointer-events: none;
  border-radius: 50%;

  background: radial-gradient(
    circle at center,
    rgba(125, 211, 252, 0.6) 0%,   /* soft blue center */
    rgba(56, 189, 248, 0.35) 20%,  /* main brand blue */
    rgba(14, 165, 233, 0.18) 40%,  /* deeper blue */
    rgba(2, 132, 199, 0.08) 60%,   /* fade */
    transparent 75%
  );

  filter: blur(40px);
  transform: translate(-50%, -50%);
}
.lamp-glow {
  box-shadow: 0 0 80px rgba(56, 189, 248, 0.25);
}
@keyframes glowPulse {
  from { opacity: 0.8; }
  to { opacity: 1; }
}

.lamp-glow {
  animation: glowPulse 2s ease-in-out infinite alternate;
}

      .lamp-glow::after {
        content: '';
        position: absolute;
        inset: -80px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(127,231,245,0.18) 0%, transparent 72%);
        filter: blur(52px);
      }

      .lamp-beam {
        position: absolute;
        top: -20px;
        right: 15%;
        width: 300px;
        height: 560px;
        background: linear-gradient(180deg, rgba(173,239,255,0.14) 0%, rgba(245,166,35,0.08) 30%, rgba(245,166,35,0.02) 65%, transparent 100%);
        clip-path: polygon(47% 0%, 53% 0%, 100% 100%, 0% 100%);
        filter: blur(10px);
        opacity: .8;
        pointer-events: none;
        z-index: 0;
      }

      .hero-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1.15fr .95fr;
        gap: 40px;
        align-items: center;
      }

      .hero-copy {
        position: relative;
        z-index: 1;
      }

      .hero-title {
        font-size: clamp(34px, 5vw, 58px);
        line-height: 1.05;
        font-weight: 800;
        color: #0f3a5f;
        margin: 16px 0 14px;
      }

      .hero-sub {
        color: var(--muted);
        line-height: 1.85;
        max-width: 560px;
        font-size: 15px;
        margin-bottom: 22px;
      }

      .price-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        flex-wrap: wrap;
      }

      .price-main {
        font-size: 38px;
        font-weight: 800;
        color: #0f3a5f;
      }

      .price-old {
        font-size: 17px;
        color: #4b7a99;
        text-decoration: line-through;
      }

      .hero-note {
        color: #0891b2;
        font-size: 13px;
        margin-bottom: 18px;
        font-weight: 700;
      }

      .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
      }

      .hero-media {
        display: flex;
        justify-content: center;
        position: relative;
      }

      .hero-image-shell {
        position: relative;
      }

      .hero-image-card {
        position: relative;
        width: 100%;
        max-width: 430px;
        background: rgba(255,255,255,0.78);
        border-radius: 26px;
        padding: 18px;
        border: 1px solid rgba(15,185,247,0.20);
        box-shadow: var(--shadow-strong);
        backdrop-filter: blur(12px);
      }

      .hero-image-card::before {
        content: '';
        position: absolute;
        inset: -14px;
        border-radius: 34px;
        background: radial-gradient(circle, rgba(127,231,245,0.36) 0%, rgba(15,185,247,0.20) 24%, transparent 68%);
        filter: blur(24px);
        z-index: -2;
      }

      .hero-image-card::after {
        content: '';
        position: absolute;
        inset: auto 22px -24px 22px;
        height: 40px;
        border-radius: 50%;
        background: rgba(60, 34, 12, 0.18);
        filter: blur(20px);
        z-index: -3;
      }

      .hero-image-card img {
        width: 100%;
        border-radius: 20px;
        object-fit: cover;
        min-height: 420px;
        max-height: 520px;
      }

      .float-badge {
        position: absolute;
        background: rgba(255,255,255,0.84);
        border: 1px solid rgba(15,185,247,0.18);
        box-shadow: var(--shadow);
        backdrop-filter: blur(12px);
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        color: #0f3a5f;
        z-index: 3;
      }

      .float-badge.top {
        top: 18px;
        left: -20px;
      }

      .float-badge.bottom {
        right: -16px;
        bottom: 18px;
      }

      .hero-mini-trust {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 24px;
      }

      .hero-mini-trust .mini-item {
        background: rgba(255,255,255,0.66);
        border: 1px solid rgba(15,185,247,0.16);
        border-radius: 16px;
        padding: 14px 12px;
        text-align: center;
        font-size: 13px;
        color: #0f3a5f;
        box-shadow: var(--shadow);
        backdrop-filter: blur(8px);
      }

      .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-top: 34px;
      }

      .stat-box {
        background: rgba(255,255,255,0.88);
        border: 1px solid rgba(15,185,247,0.14);
        border-radius: 18px;
        text-align: center;
        padding: 22px 14px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px);
      }

      .stat-box strong {
        display: block;
        font-size: 30px;
        line-height: 1;
        margin-bottom: 8px;
        color: #0891b2;
      }

.best-seller-gallery {
        margin-top: 24px;
        padding: 28px;
        border-radius: 22px;
        background: rgba(245, 251, 255, 0.8);
        border: 1px solid rgba(15,185,247,0.18);
      }

      .best-seller-gallery .gallery-title {
        font-weight: 700;
        margin-bottom: 12px;
        color: #0f3a5f;
      }

      .best-seller-gallery .gallery-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
      }

      .best-seller-gallery .gallery-item {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 14px 30px rgba(15,60,95,0.14);
      }

      .best-seller-gallery .gallery-item img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        transition: transform .3s ease;
      }

      .best-seller-gallery .gallery-item img:hover {
        transform: scale(1.08);
      }

      .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
      }

      .gallery-card {
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(15,185,247,0.18);
        box-shadow: 0 14px 30px rgba(15,60,95,0.15);
      }

      .gallery-card img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform .3s ease;
      }

      .gallery-card img:hover {
        transform: scale(1.05);
      }

      .stat-box span {
        font-size: 13px;
        color: var(--muted);
      }

      .choose-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
      }

      .product-card {
        padding: 18px 16px;
        text-align: center;
        cursor: pointer;
        transition: .25s ease;
        position: relative;
        overflow: hidden;
      }

      .product-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top center, rgba(127,231,245,0.22), transparent 52%);
        opacity: 0;
        transition: .25s ease;
      }

      .product-card:hover::before,
      .product-card.active::before {
        opacity: 1;
      }

      .product-card:hover,
      .product-card.active {
        transform: translateY(-5px);
        border-color: rgba(8,145,178,0.24);
        box-shadow: 0 18px 42px rgba(8,145,178,0.18);
      }

      .product-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        border-radius: 999px;
        padding: 5px 11px;
        font-size: 11px;
        font-weight: 800;
        z-index: 1;
      }
      
      .topbar-order-btn {
  padding: 10px 18px;
  border-radius: 999px;
}

@media (max-width: 640px) {
  .topbar-order-btn {
    padding: 6px 12px;
    font-size: 12px;
  }
}

      .product-thumb {
        width: 88px;
        height: 120px;
        margin: 0 auto 12px;
        border-radius: 14px;
        background: linear-gradient(180deg, #e6f3ff, #d4ebff);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid rgba(15,185,247,0.14);
      }

      .product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .product-name {
        font-weight: 700;
        margin-bottom: 6px;
      }

      .product-pricing {
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 10px;
      }

      .product-pricing strong {
        color: #222;
        font-size: 15px;
      }

      .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
      }

      .feature-card {
        padding: 24px;
      }

      .feature-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(15,185,247,.12);
        color: var(--amber-deep);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
        box-shadow: inset 0 0 0 1px rgba(15,185,247,.12);
      }

      .feature-card h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #0f3a5f;
      }

      .feature-card p {
        color: var(--muted);
        line-height: 1.8;
        font-size: 14px;
      }

      .how-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        max-width: 940px;
        margin: 0 auto;
      }

      .how-item {
        text-align: center;
        padding: 8px 16px;
      }

      .how-dot {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        margin: 0 auto 14px;
        box-shadow: 0 12px 24px rgba(245,166,35,.22);
      }

      .how-item h4 {
        font-size: 17px;
        margin-bottom: 7px;
      }

      .how-item p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
      }

      .reviews-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
      }

      .review-card {
        padding: 24px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(15,185,247,0.20);
        color: white;
      }

      .review-stars {
        color: #f5c04f;
        margin-bottom: 12px;
        letter-spacing: 2px;
        font-size: 16px;
      }

      .review-card p {
        color: rgba(255,255,255,0.80);
        line-height: 1.85;
        font-size: 14px;
        margin-bottom: 16px;
      }

      .review-user {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .review-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
      }

      .review-user strong {
        display: block;
        font-size: 14px;
      }

      .review-user span {
        color: rgba(255,255,255,0.60);
        font-size: 12px;
      }

      .trust-strip {
        background: linear-gradient(135deg, var(--dark-bg), var(--dark-bg-2));
        color: white;
        padding: 24px 0;
        position: relative;
        overflow: hidden;
      }

      .trust-strip::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(15,185,247,0.12), transparent 62%);
        pointer-events: none;
      }

      .trust-strip-inner {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    position: relative;
    z-index: 1;
}

      .trust-pill {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-weight: 700;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(15,185,247,0.14);
        border-radius: 18px;
        padding: 16px;
      }
      .trust-pill {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

/* Glow effect */
.trust-pill::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, rgba(61,213,255,0.15), transparent 70%);
    opacity: 0;
    transition: 0.3s ease;
}

/* Hover animation */
.trust-pill:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 50px rgba(15,185,247,0.25);
}

.trust-pill:hover::before {
    opacity: 1;
}

      .trust-pill small {
        display: block;
        font-size: 12px;
        font-weight: 400;
        opacity: .85;
      }

      .order-wrap {
        background:
          radial-gradient(500px 280px at 82% 10%, rgba(61,213,255,0.13), transparent 58%),
          linear-gradient(180deg, #0a1f2d 0%, var(--dark-bg) 100%);
        color: white;
      }

      .order-wrap .section-title {
        color: #3dd5ff;
      }

      .order-wrap .section-sub {
        color: rgba(255,255,255,0.68);
      }

      .order-layout {
        display: grid;
        grid-template-columns: 1fr 440px;
        gap: 30px;
        align-items: start;
      }

      .order-left-space {
        min-height: 560px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 18px;
      }

      .order-promo {
        border-radius: 24px;
        padding: 28px;
        color: white;
      }

      .order-promo h3 {
        font-size: clamp(26px, 4vw, 38px);
        line-height: 1.12;
        margin-bottom: 12px;
      }

      .order-promo p {
        color: rgba(255,255,255,0.76);
        line-height: 1.85;
        margin-bottom: 22px;
      }

      .promo-points {
        display: grid;
        gap: 12px;
      }

      .promo-points div {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(15,185,247,0.16);
        border-radius: 16px;
        padding: 14px 16px;
      }

      .order-card {
        padding: 22px;
        position: sticky;
        top: 96px;
        border-radius: 24px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(15,185,247,0.25);
        color: white;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
      }
.order-card {
  padding: 28px;
  border-radius: 28px;
  max-width: 100%;
}




  .order-left-space {
    display: none;
  }

  .order-card {
    width: 100%;
    padding: 16px;
  }
}
      .order-form .field {
        margin-bottom: 14px;
      }

      .order-form label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
        color: rgba(255,255,255,0.86);
      }

      .order-form input,
      .order-form textarea,
      .order-form select {
        width: 100%;
        border: 1px solid rgba(255,255,255,0.18);
        background: rgba(255,255,255,0.10);
        color: white;
        border-radius: 14px;
        padding: 13px 14px;
        font-size: 14px;
        outline: none;
        transition: .2s ease;
      }

      .order-form textarea {
        min-height: 95px;
        resize: vertical;
      }

      .order-form input::placeholder,
      .order-form textarea::placeholder {
        color: rgba(255,255,255,0.40);
      }

      .order-form select option {
        color: #fff;
        background: #2d1a08;
      }

      .order-form input:focus,
      .order-form textarea:focus,
      .order-form select:focus {
        border-color: rgba(255,214,120,0.62);
        box-shadow: 0 0 0 4px rgba(15,185,247,.10);
      }

      .color-swatches {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      .color-option {
        position: relative;
      }

      .color-option input {
        display: none;
      }

      .color-dot {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        border: 2px solid rgba(255,255,255,0.9);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.22);
        cursor: pointer;
        transition: .2s ease;
      }

      .color-option input:checked + .color-dot {
        transform: scale(1.15);
        box-shadow: 0 0 0 4px rgba(15,185,247,.25);
      }

      .qty-row {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .summary-box {
        margin-top: 14px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(15,185,247,0.16);
        border-radius: 16px;
        padding: 16px;
      }

      .summary-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
        margin-bottom: 8px;
        color: rgba(255,255,255,0.86);
      }

      .summary-line.total {
        margin-top: 10px;
        padding-top: 12px;
        border-top: 1px solid rgba(255,255,255,0.12);
        font-size: 18px;
        font-weight: 800;
        color: #f0f9ff;
      }

      .helper-note {
        font-size: 13px;
        color: rgba(255,255,255,0.66);
        margin-top: 12px;
        text-align: center;
      }

      .error-box,
      .success-box {
        margin-bottom: 16px;
        padding: 14px 16px;
        border-radius: 12px;
        font-size: 14px;
      }

      .error-box {
        background: rgba(255,80,110,0.12);
        color: #ffd7df;
        border: 1px solid rgba(255,132,156,0.24);
      }

      .success-box {
        background: rgba(61,170,107,0.14);
        color: #d8ffe8;
        border: 1px solid rgba(61,170,107,0.26);
      }

      .countdown-wrap {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(15,185,247,0.16);
        margin-bottom: 18px;
        font-size: 13px;
      }

      .countdown-time {
        font-weight: 800;
        color: #3dd5ff;
        letter-spacing: 1px;
      }

      .live-orders {
        position: fixed;
        left: 18px;
        bottom: 88px;
        z-index: 150;
        width: min(340px, calc(100vw - 36px));
      }

      .live-order-card {
        display: none;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border-radius: 18px;
        background: rgba(26,15,0,0.92);
        color: white;
        border: 1px solid rgba(15,185,247,0.18);
        box-shadow: 0 20px 50px rgba(0,0,0,0.24);
        backdrop-filter: blur(10px);
        animation: slideToast 0.45s ease;
      }

      .live-order-card.show {
        display: flex;
      }

      .live-order-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        flex-shrink: 0;
      }

      .live-order-card strong {
        display: block;
        font-size: 14px;
      }

      .live-order-card span {
        display: block;
        color: rgba(255,255,255,0.70);
        font-size: 12px;
        margin-top: 2px;
      }

      footer {
  background: linear-gradient(135deg, #020617, #020617);
  color: rgba(255,255,255,0.85);
  padding: 40px 0 90px;
  position: relative;
  overflow: hidden;
  border-top: 1px solid rgba(59,130,246,0.2);
}

/* subtle glow */
footer::before {
  content: '';
  position: absolute;
  top: -100px;
  left: -100px;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(59,130,246,0.2), transparent 70%);
  filter: blur(60px);
}

/* second glow */
footer::after {
  content: '';
  position: absolute;
  bottom: -120px;
  right: -100px;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(14,165,233,0.2), transparent 70%);
  filter: blur(60px);
}

      .footer-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  flex-wrap: wrap;
  position: relative;
  z-index: 2;
}

      .footer-brand span {
  font-size: 18px;
  font-weight: 700;
  color: #ffffff;
}

.footer-brand img {
  filter: drop-shadow(0 4px 10px rgba(59,130,246,0.5));
}

.footer-text {
  color: rgba(255,255,255,0.6);
  font-size: 14px;
}

.footer-support {
  color: #38bdf8;
  font-weight: 700;
}

      .sticky-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, var(--dark-bg), var(--dark-bg-2));
        border-top: 2px solid var(--amber);
        padding: 12px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        z-index: 180;
        transform: translateY(100%);
        transition: transform 0.4s ease;
        box-shadow: 0 -8px 28px rgba(0,0,0,0.42);
      }

      .sticky-bar.visible {
        transform: translateY(0);
      }

      .sticky-price {
        color: #3dd5ff;
        font-weight: 800;
        font-size: 18px;
      }

      .sticky-price small {
        color: rgba(255,255,255,0.45);
        text-decoration: line-through;
        font-size: 12px;
        margin-right: 7px;
      }

      .sticky-btn {
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        font-weight: 800;
        border: none;
        padding: 11px 22px;
        border-radius: 999px;
        cursor: pointer;
        transition: transform .2s ease;
        white-space: nowrap;
      }

      .sticky-btn:hover {
        transform: scale(1.05);
      }

      .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.62);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

    .modal-overlay.open { display: flex; }

      /* Image Preview Modal */
      .image-preview-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.9);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .image-preview-overlay.open { display: flex; }

      .image-preview-container {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
      }

      .image-preview-container img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 12px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5);
      }

      .close-preview {
        position: absolute;
        top: -50px;
        right: -10px;
        background: rgba(255,255,255,0.95);
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        transition: 0.2s ease;
      }

      .close-preview:hover {
        background: white;
        transform: scale(1.1);
      }

      .modal-box {
        width: 100%;
        max-width: 430px;
        background: #fff8ee;
        border-radius: 24px;
        padding: 36px 28px;
        text-align: center;
        box-shadow: 0 25px 50px rgba(0,0,0,.15);
      }

      .modal-icon {
        font-size: 54px;
        margin-bottom: 10px;
      }

      .modal-box h3 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #0f3a5f;
      }

      .modal-box p {
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 18px;
      }

      .modal-close {
        background: linear-gradient(135deg, var(--amber), var(--amber-deep));
        color: #ffffff;
        border: none;
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 800;
        cursor: pointer;
      }

      @keyframes lampPulse {
        from { transform: scale(1); opacity: 0.72; }
        to { transform: scale(1.18); opacity: 1; }
      }

      @keyframes slideToast {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @media (max-width: 1100px) {
        .hero-grid,
        .order-layout {
          grid-template-columns: 1fr;
        }

        .order-left-space {
          min-height: auto;
        }

        .order-card {
          position: static;
        }

        .lamp-beam {
          right: 6%;
        }
      }

      @media (max-width: 992px) {
        .stats-grid,
        .choose-grid,
        .features-grid,
        .reviews-grid,
        .trust-strip-inner,
        .how-grid,
        .hero-mini-trust {
          grid-template-columns: repeat(2, 1fr);
        }

        .hero-image-card img {
          min-height: 360px;
        }
      }

      @media (max-width: 768px) {
        .topbar-inner {
          min-height: 60px;
          padding: 12px 0;
        }

        .brand {
          font-size: 16px;
        }

        .hero-wrap {
          padding-top: 24px;
          padding-bottom: 20px;
        }

        .hero-actions {
          flex-direction: column;
          align-items: stretch;
        }

        .btn-primary,
        .btn-secondary {
          width: 100%;
          padding: 12px 18px;
          font-size: 14px;
        }

        .float-badge.top {
          left: 8px;
          top: 8px;
          font-size: 12px;
          padding: 7px 12px;
        }

        .float-badge.bottom {
          right: 8px;
          bottom: 8px;
          font-size: 12px;
          padding: 7px 12px;
        }

        .lamp-glow {
          width: 240px;
          height: 240px;
          right: 0;
          top: 16%;
          filter: blur(28px);
        }

        .lamp-beam {
          width: 240px;
          right: 0;
          height: 440px;
          opacity: .7;
        }

        .section {
          padding: 52px 0;
        }

        .section-title {
          font-size: clamp(24px, 6vw, 36px);
        }

        .price-main {
          font-size: 32px;
        }

        .hero-title {
          font-size: clamp(28px, 7vw, 42px);
        }

        .hero-sub {
          font-size: 14px;
        }
      }

      @media (max-width: 640px) {
        .nav-links { display: none; }

        .topbar-inner {
          padding: 10px 0;
          min-height: 56px;
        }

        .brand {
          font-size: 14px;
          gap: 8px;
        }

        .brand-dot {
          width: 24px;
          height: 24px;
        }

        .container {
          padding: 0 14px;
        }

        .btn-primary {
          padding: 10px 14px;
          font-size: 12px;
          border-radius: 8px;
        }

        .stats-grid,
        .choose-grid,
        .features-grid,
        .reviews-grid,
        .trust-strip-inner,
        .how-grid,
        .hero-mini-trust {
          grid-template-columns: 1fr;
          gap: 12px;
        }

        .section {
          padding: 42px 0;
        }

        .section-title {
          font-size: clamp(20px, 5vw, 28px);
        }

        .section-sub {
          font-size: 13px;
          margin-bottom: 24px;
        }

        .hero-title {
          font-size: clamp(24px, 6vw, 36px);
          margin: 12px 0 10px;
        }

        .hero-sub {
          font-size: 13px;
          max-width: 100%;
          margin-bottom: 16px;
          line-height: 1.7;
        }

        .price-row {
          gap: 10px;
          margin-bottom: 8px;
        }

        .price-main {
          font-size: 28px;
        }

        .price-old {
          font-size: 15px;
        }

        .hero-note {
          font-size: 12px;
          margin-bottom: 14px;
        }

        .hero-image-card {
          max-width: 100%;
          padding: 12px;
          border-radius: 18px;
        }

        .hero-image-card img {
          min-height: 280px;
          max-height: 360px;
          border-radius: 14px;
        }

        .hero-image-card::before {
          inset: -10px;
          border-radius: 28px;
        }

        .hero-image-card::after {
          inset: auto 16px -20px 16px;
          height: 32px;
        }

        .pill {
          padding: 6px 12px;
          font-size: 11px;
          border-radius: 8px;
        }

        .stat-box {
          padding: 16px 12px;
          border-radius: 14px;
        }

        .stat-box strong {
          font-size: 24px;
          margin-bottom: 6px;
        }

        .stat-box span {
          font-size: 12px;
        }

        .product-card {
          padding: 14px 12px;
          border-radius: 16px;
        }

        .product-thumb {
          width: 72px;
          height: 100px;
          margin: 0 auto 10px;
          border-radius: 10px;
        }

        .product-name {
          font-size: 14px;
        }

        .product-pricing {
          font-size: 12px;
        }

        .product-pricing strong {
          font-size: 14px;
        }

        .feature-card {
          padding: 16px 12px;
          border-radius: 16px;
        }

        .feature-icon {
          width: 40px;
          height: 40px;
          margin-bottom: 12px;
          font-size: 18px;
          border-radius: 10px;
        }

        .feature-card h3 {
          font-size: 16px;
          margin-bottom: 6px;
        }

        .feature-card p {
          font-size: 13px;
          line-height: 1.6;
        }

        .how-dot {
          width: 50px;
          height: 50px;
          margin: 0 auto 10px;
          font-size: 16px;
        }

        .how-item h4 {
          font-size: 15px;
          margin-bottom: 6px;
        }

        .how-item p {
          font-size: 13px;
        }

        .review-card {
          padding: 16px 12px;
          border-radius: 14px;
        }

        .review-stars {
          font-size: 14px;
          margin-bottom: 10px;
        }

        .review-card p {
          font-size: 13px;
          margin-bottom: 12px;
          line-height: 1.6;
        }

        .review-avatar {
          width: 34px;
          height: 34px;
          font-size: 14px;
        }

        .review-user strong {
          font-size: 13px;
        }

        .review-user span {
          font-size: 11px;
        }

        .trust-pill {
          padding: 12px;
          gap: 10px;
          font-size: 13px;
          border-radius: 12px;
        }

        .trust-pill small {
          font-size: 11px;
        }

        .sticky-bar {
          padding: 10px 12px;
          gap: 10px;
        }

        .sticky-price {
          font-size: 14px;
        }

        .sticky-btn {
          padding: 9px 14px;
          font-size: 13px;
          border-radius: 8px;
        }

        .live-orders {
          left: 10px;
          width: calc(100vw - 20px);
          bottom: 70px;
          max-width: 360px;
          font-size: 12px;
        }

        .order-promo {
          padding: 20px 16px;
          border-radius: 18px;
        }

        .order-promo h3 {
          font-size: clamp(20px, 5vw, 30px);
        }
      }

      @media (max-width: 480px) {
        .container {
          padding: 0 12px;
        }

        .topbar-inner {
          gap: 12px;
        }

        .brand {
          font-size: 12px;
        }

        .btn-primary {
          padding: 8px 12px;
          font-size: 11px;
        }

        .hero-title {
          font-size: clamp(20px, 5vw, 32px);
        }

        .price-main {
          font-size: 24px;
        }

        .hero-actions {
          gap: 8px;
        }

        .section {
          padding: 36px 0;
        }

        .section-title {
          font-size: clamp(18px, 4vw, 24px);
        }

        .section-sub {
          font-size: 12px;
          margin-bottom: 18px;
        }

        .stat-box {
          padding: 12px 10px;
        }

        .stat-box strong {
          font-size: 20px;
        }

        .feature-card {
          padding: 12px 10px;
        }

        .feature-card h3 {
          font-size: 14px;
        }
      }
      /* Footer improvements */
.footer-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    flex-wrap: wrap;
}
@media (max-width: 768px) {
  .footer-inner {
    flex-direction: column;
    text-align: center;
    gap: 16px;
  }
}
/* Social container */
.footer-social {
    display: flex;
    gap: 12px;
    align-items: center;
}

/* Premium social icons */
.social-icon {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;

  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(59,130,246,0.3);

  color: #38bdf8;

  transition: all 0.35s ease;
}

/* hover = premium glow */
.social-icon:hover {
  transform: translateY(-5px) scale(1.1);
  background: linear-gradient(135deg, #3b82f6, #0ea5e9);
  color: white;
  box-shadow: 0 10px 30px rgba(59,130,246,0.5);
}

/* Glow effect */
.social-icon::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, rgba(61,213,255,0.25), transparent 70%);
    opacity: 0;
    transition: 0.3s;
}

.social-icon:hover::after {
    opacity: 1;
}

      .brand-logo {
        width: 36px;
        height: 36px;
        object-fit: contain;
      }


/* More pill-shaped Apple-style Theme Toggle - Right corner */
      @keyframes knobBounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
      }

      @keyframes iconPulse {
        0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.7; }
        50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
      }

      @keyframes toggleGlow {
        0%, 100% { box-shadow: 0 4px 20px rgba(15,185,247,0.4); }
        50% { box-shadow: 0 8px 32px rgba(15,185,247,0.6); }
      }

      .theme-toggle {
        --toggle-width: 64px;
        --toggle-height: 36px;
        --knob-size: 28px;
        --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        
        position: relative;
        width: var(--toggle-width);
        height: var(--toggle-height);
        border: none;
        border-radius: 999px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(20px);
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: 4px 6px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        transition: var(--transition);
        margin-left: auto;
        margin-right: -8px;
      }

      .theme-toggle:hover {
        transform: scale(1.08) rotate(2deg);
        box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        animation: toggleGlow 0.6s ease-in-out;
      }

      .theme-toggle:active {
        transform: scale(0.98);
      }

      .theme-toggle.active {
        background: linear-gradient(135deg, var(--amber), var(--amber-2));
        box-shadow: 0 6px 28px rgba(15,185,247,0.5);
        animation: knobBounce 0.5s ease-out;
      }

      .theme-toggle .sun-icon,
      .theme-toggle .moon-icon {
        position: absolute;
        font-size: 18px;
        z-index: 2;
        transition: var(--transition);
        opacity: 0.7;
      }

      .theme-toggle .sun-icon {
        left: 6px;
        color: #fbbf24;
      }

      .theme-toggle.active .sun-icon {
        opacity: 0;
        animation: iconPulse 0.4s ease-out;
      }

      .theme-toggle .moon-icon {
        right: 6px;
        color: #f1f5f9;
        opacity: 0;
      }

      .theme-toggle.active .moon-icon {
        opacity: 1;
        animation: iconPulse 0.4s ease-out reverse;
      }

      .toggle-knob {
        position: absolute;
        width: var(--knob-size);
        height: var(--knob-size);
        border-radius: 50%;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: var(--transition);
        border: 2px solid rgba(255,255,255,0.9);
        z-index: 3;
      }

      .theme-toggle.active .toggle-knob {
        transform: translateX(calc(var(--toggle-width) - var(--knob-size) - 8px)) scale(1.05);
        background: linear-gradient(145deg, #fff, #f8f9ff);
        box-shadow: 0 6px 20px rgba(15,185,247,0.4), inset 0 1px 0 rgba(255,255,255,1);
      }

      /* Focus visible for accessibility */
      .theme-toggle:focus-visible {
        outline: 2px solid var(--amber);
        outline-offset: 2px;
      }

      /* Dark mode body updates */
      [data-theme="dark"] body {
        background: var(--cream);
        color: var(--text);
      }

      [data-theme="dark"] .topbar {
        background: rgba(10,15,26,0.95);
      }

      [data-theme="dark"] .card {
        background: rgba(255,255,255,0.1);
        border-color: rgba(15,185,247,0.3);
        color: var(--white);
      }

      /* Responsive toggle */
      @media (max-width: 768px) {
        .theme-toggle {
          --toggle-size: 42px;
          --knob-size: 24px;
        }
      }

      @media (max-width: 480px) {
        .theme-toggle {
          --toggle-size: 38px;
          --knob-size: 22px;
        }
      }
      <style>
  /* all your existing CSS */

 

  /* ================= DARK MODE FIX (FINAL CLEAN) ================= */

/* HERO */
[data-theme="dark"] .hero-wrap {
  background: linear-gradient(180deg, #020617 0%, #020617 100%);
  border-bottom: 1px solid rgba(59,130,246,0.2);
}



[data-theme="dark"] .hero-sub {
  color: #cbd5f5;
}

/* HERO CARD */
[data-theme="dark"] .hero-image-card {
  background: #020617;
  border: 1px solid rgba(59,130,246,0.2);
  box-shadow: 0 20px 60px rgba(0,0,0,0.6);
}
[data-theme="dark"] .hero-title {
  color: #ffffff;
}

[data-theme="dark"] .price-main {
  color: #38bdf8;
}
/* MINI TRUST */
[data-theme="dark"] .mini-item {
  background: rgba(15,23,42,0.55);
  color: #e2e8f0;
}

/* STATS */
[data-theme="dark"] .stat-box {
  background: rgba(15,23,42,0.6);
  border: 1px solid rgba(59,130,246,0.25);
}

/* GALLERY */
[data-theme="dark"] .best-seller-gallery {
  background: rgba(15,23,42,0.6);
}

/* SECTION BACKGROUND FIX (VERY IMPORTANT) */
[data-theme="dark"] .section-soft {
  background: linear-gradient(180deg, #020617 0%, #0f172a 50%, #1e293b 100%);
}

/* FEATURE CARDS */
[data-theme="dark"] .feature-card {
  background: rgba(15,23,42,0.7);
  border: 1px solid rgba(59,130,246,0.25);
}

[data-theme="dark"] .feature-card h3 {
  color: #f8fafc;
}

[data-theme="dark"] .feature-card p {
  color: #cbd5f5;
}

/* ICON */
[data-theme="dark"] .feature-icon {
  background: rgba(59,130,246,0.15);
  color: #60a5fa;
}

/* HOW SECTION */
[data-theme="dark"] .how-item h4 {
  color: #f8fafc;
}

[data-theme="dark"] .how-item p {
  color: #cbd5f5;
}

[data-theme="dark"] .how-dot {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  box-shadow: 0 10px 25px rgba(59,130,246,0.4);
}

/* BUTTON FIX */
[data-theme="dark"] .btn-secondary {
  background: rgba(30,41,59,0.6);
  color: #e2e8f0;
  border: 1px solid rgba(59,130,246,0.3);
}

/* ===== FINAL HERO CLEANUP (IMPORTANT) ===== */

/* Remove background glow blobs */
[data-theme="dark"] .hero-wrap::before,
[data-theme="dark"] .hero-wrap::after {
  display: none;
}

/* Remove lamp glow completely */
[data-theme="dark"] .lamp-glow {
  display: none;
}

/* Remove beam */
[data-theme="dark"] .lamp-beam {
  display: none;
}

/* Remove card glow */
[data-theme="dark"] .hero-image-card::before {
  display: none;
}


[data-theme="dark"] .best-seller-gallery .gallery-title {
  color: #ffffff;
}

/* FINAL HERO POLISH */
[data-theme="dark"] .hero-sub {
  color: #cbd5f5;
}

[data-theme="dark"] .hero-note {
  color: #38bdf8;
}

[data-theme="dark"] .price-old {
  color: #64748b;
}

/* Fix Facebook stuck state */
.social-icon:focus {
  outline: none;
  background: rgba(255,255,255,0.05);
  color: #38bdf8;
  box-shadow: none;
  transform: none;
}

.social-icon {
  position: relative; /* 🔥 IMPORTANT FIX */
  overflow: hidden;   /* prevents glow leaking */
}
@media (max-width: 640px) {

  .topbar .btn-primary {
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 20px;
  }

}


  /* hide slider parts */
  .toggle-knob,
  .sun-icon,
  .moon-icon {
    display: none !important;
  }

  /* dark mode style */
  [data-theme="dark"] .theme-toggle {
    background: rgba(15,23,42,0.8);
    color: #facc15;
  }

}
/* ensure button stays clickable */
.btn-primary {
  position: relative;
  z-index: 100;
}

/* FINAL TOGGLE FIX */
@media (max-width: 640px) {

  .theme-toggle {
    position: absolute;
    right: 10px;
    top: 10px;

    width: 34px;
    height: 34px;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(10px);

    border: none;
    font-size: 16px;
    z-index: 999;
  }

  /* hide slider UI */
  .toggle-knob,
  .sun-icon,
  .moon-icon {
    display: none !important;
  }

  [data-theme="dark"] .theme-toggle {
    background: rgba(15,23,42,0.8);
    color: #facc15;
  }

}

@media (max-width: 640px) {

  .topbar .btn-primary {
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 16px;
  }

}

@media (max-width: 640px) {

  .topbar-inner {
    position: relative; /* needed for absolute toggle */
  }

}

  .topbar-inner {
    gap: 10px;
  }



@media (max-width: 640px) {

  .theme-toggle {
    width: 50px;
    height: 28px;
  }

  .toggle-knob {
    width: 20px;
    height: 20px;
  }

}
@media (max-width: 640px) {

  /* ❌ REMOVE NOISE */
  .announcement-bar,
  .stats-grid,
  .best-seller-gallery,
  .slider,
  .live-orders,
  .trust-strip,
  .lamp-glow,
  .lamp-beam {
    display: none !important;
  }

}

@media (max-width: 640px) {

  .hero-grid {
    display: flex;
    flex-direction: column;
    gap: 18px;
    text-align: center;
  }

  .hero-title {
    font-size: 26px;
    line-height: 1.2;
  }

  .hero-sub {
    font-size: 14px;
    opacity: 0.85;
  }

  .hero-image-card img {
    max-height: 260px;
    object-fit: contain;
  }

  .hero-actions {
    gap: 10px;
  }

}
@media (max-width: 640px) {

  .product-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px;
    border-radius: 16px;
    text-align: left;
  }

  .product-thumb {
    width: 80px;
    height: 100px;
    flex-shrink: 0;
  }

  .product-thumb img {
    border-radius: 10px;
  }

  .product-name {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 4px;
  }

  .product-pricing {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .product-pricing strong {
    font-size: 16px;
  }

  .product-pricing div {
    font-size: 12px;
  }

  .product-card .btn-primary {
    margin-left: auto;
    padding: 10px 14px;
    font-size: 13px;
    border-radius: 10px;
    white-space: nowrap;
  }

  /* Fix badge position */
  .product-badge {
    top: 8px;
    right: 8px;
    font-size: 10px;
    padding: 4px 8px;
  }
.product-card {
  background: rgba(255,255,255,0.9);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
}


@media (max-width: 640px) {

  .features-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }

  .feature-card {
    padding: 14px;
  }

}

@media (max-width: 640px) {

  #how,
  #specs {
    display: none;
  }

}

@media (max-width: 640px) {

  .order-layout {
    display: flex;
    flex-direction: column;
  }

  .order-left-space {
    display: none; /* remove promo block */
  }

  .order-card {
    position: static;
    padding: 16px;
  }

}

@media (max-width: 640px) {

  .sticky-bar {
    padding: 10px;
  }

  .sticky-btn {
    width: 100%;
    font-size: 14px;
  }

}
@media (max-width: 640px) {

  .hero-mini-trust {
    display: none !important;
  }

}

[data-theme="dark"] .product-pricing strong {
  color: #38bdf8;
}

[data-theme="dark"] .product-pricing div {
  color: #64748b;
}

[data-theme="dark"] .product-card {
  background: #0f172a;
}

[data-theme="dark"] .product-pricing strong {
  color: #60a5fa;
  text-shadow: 0 0 8px rgba(59,130,246,0.4);
}


  /* ❌ hide knob */
  .toggle-knob {
    display: none !important;
  }

  /* ❌ hide sun icon */
  .theme-toggle .sun-icon {
    display: none !important;
  }

  /* ❌ hide moon icon */
  .theme-toggle .moon-icon {
    display: none !important;
  }

}


@media (max-width: 640px) {

  .topbar {
    backdrop-filter: blur(14px);
    background: rgba(255,255,255,0.7);
    border-bottom: 1px solid rgba(0,0,0,0.05);
  }

  [data-theme="dark"] .topbar {
    background: rgba(2,6,23,0.7);
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .topbar-inner {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .brand span {
    font-size: 15px;
    font-weight: 700;
  }

}

.topbar .btn-primary {
  background: linear-gradient(135deg, #22c1c3, #0ea5e9);
}

@media (max-width: 640px) {

  .topbar-order-btn {
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 14px;

    max-width: 150px;
    white-space: nowrap;
  }

}
</style>
      
</head>
<body>

@php
    $productName = $contents['hero_title'] ?? ($product->name ?? 'ম্যাজিক ল্যান্টার্ন');
    $heroSubtitle = $contents['hero_subtitle'] ?? 'আপনার ঘর, রুম বা উপহারের মুহূর্তকে আরও উষ্ণ, নান্দনিক এবং জাদুকরী আলোয় ভরিয়ে দিতে তৈরি প্রিমিয়াম ল্যাম্প।';
    $promoText = $contents['promo_text'] ?? 'সীমিত সময়ের অফার';

    $oldPrice = $product?->old_price;
    $price = (int) ($product?->price ?? 0);
    $discount = $product?->discount;

    $discountText = $discount
        ? $discount . '% ছাড়'
        : (($oldPrice && $price) ? ($oldPrice - $price) . ' টাকা সাশ্রয়' : 'আজকের বিশেষ অফার');

    $phone = $contents['phone'] ?? '01XXXXXXXXX';

    $featureTitle = $contents['feature_title'] ?? 'কেন MagicLanternBD আলাদা?';
    $featureSubtitle = $contents['feature_subtitle'] ?? 'নরম আলো, প্রিমিয়াম লুক, গিফট-রেডি স্টাইল এবং ঘরের পরিবেশ বদলে দেওয়ার মতো ডিজাইন।';

    $productsTitle = $contents['product_section_title'] ?? 'আপনার পছন্দের ভ্যারিয়েন্ট বেছে নিন';
    $productsSubtitle = $contents['product_section_subtitle'] ?? 'নিচের কার্ডে ক্লিক করলেই অর্ডার ফর্মে রং/ভ্যারিয়েন্ট সিলেক্ট হয়ে যাবে।';

    $howTitle = $contents['how_title'] ?? 'কিভাবে অর্ডার করবেন?';
    $howSubtitle = $contents['how_subtitle'] ?? 'মাত্র ৩ ধাপে আপনার ম্যাজিক ল্যান্টার্ন পৌঁছে যাবে দরজায়।';

    $reviewTitle = $contents['review_title'] ?? 'গ্রাহকরা কী বলছেন';
    $reviewSubtitle = $contents['review_subtitle'] ?? 'রিয়েল কাস্টমার ফিডব্যাক, রিয়েল এক্সপেরিয়েন্স';

    $orderTitle = $contents['order_title'] ?? 'এখনই অর্ডার করুন';
    $orderSubtitle = $contents['order_subtitle'] ?? 'নিচের ফর্ম পূরণ করুন, মোট মূল্য দেখুন এবং কনফার্ম অর্ডার দিন।';

    $footerText = $contents['footer_text'] ?? '© 2026 MagicLanternBD. All Rights Reserved';

    $heroImage = $product?->image 
        ? \Illuminate\Support\Facades\Storage::url($product->image)
        : ($contents['hero_image'] ?? 'https://images.unsplash.com/photo-1517999144091-3d9dca6d1e43?auto=format&fit=crop&w=1000&q=80');

    $colors = !empty($product?->colors)
        ? (is_string($product->colors)
            ? array_values(array_filter(array_map('trim', explode(',', $product->colors))))
            : $product->colors)
        : ['#f6d365', '#fda085', '#c3cfe2', '#fbc2eb'];

    $tickerRaw = $contents['news_ticker'] ?? 'আজকের স্পেশাল: এখনই অর্ডার করলে ডেলিভারি ফ্রি। | ৩টি কিনলে ১টি ফ্রি। | সীমিত স্টক।';

    $tickerItems = is_array($tickerRaw)
        ? $tickerRaw
        : array_filter(array_map('trim', preg_split('/\|/', $tickerRaw, -1, PREG_SPLIT_NO_EMPTY)));

    if (empty($tickerItems)) {
        $tickerItems = ['আজকের খবর: স্টক শীঘ্রই আপডেট হবে।'];
    }

    $sliders = \App\Models\Slider::where('is_active', true)->orderBy('sort_order')->get();
    $sliderImages = $sliders->pluck('image')->toArray();

    if (empty($sliderImages)) {
        $sliderImages = [$heroImage];
    }

    $stats = [
        ['value' => $contents['stat_1_value'] ?? '১০০০+', 'label' => $contents['stat_1_label'] ?? 'সন্তুষ্ট গ্রাহক'],
        ['value' => $contents['stat_2_value'] ?? (($product?->discount ?? '২০') . '%'), 'label' => $contents['stat_2_label'] ?? 'আজকের অফার'],
        ['value' => $contents['stat_3_value'] ?? '৭', 'label' => $contents['stat_3_label'] ?? 'দিন রিপ্লেসমেন্ট'],
        ['value' => $contents['stat_4_value'] ?? '২৪/৭', 'label' => $contents['stat_4_label'] ?? 'সাপোর্ট'],
    ];

    $selectedOldProduct = old('product', $product?->name ?? 'Magic Lantern');
    $selectedOldColor = old('color', $colors[0] ?? '');
    $selectedOldQty = (int) old('quantity', 1);
    $selectedOldDelivery = old('delivery_area', 'inside');
@endphp

<div class="topbar">
    <div class="container topbar-inner">
<div class="brand">
    <img src="/images/logo.png" alt="Magic Lantern Logo" class="brand-logo">
    <span>{{ $contents['brand_name'] ?? 'MagicLanternBD' }}</span>
</div>

<!-- Theme Toggle -->
<button id="themeToggle" class="theme-toggle" title="Toggle Dark/Light Mode" aria-label="Toggle theme">
  <span class="sun-icon">☀️</span>
  <span class="moon-icon">🌙</span>
  <div class="toggle-knob"></div>
</button>

        <div class="nav-links">
    <a href="#hero">হোম</a>
    <a href="#products">পণ্য</a>
    <a href="#features">বৈশিষ্ট্য</a>
    <a href="#how">ব্যবহার</a>
    <a href="#specs">স্পেসিফিকেশন</a>
    <a href="#reviews">রিভিউ</a>
    <a href="#order">অর্ডার</a>
</div>

<a href="#order" class="btn-primary topbar-order-btn">
            অর্ডার করুন
        </a>
    </div>
</div>

<div class="announcement-bar">
    <div class="container">
        <div class="announcement-bar-content" id="newsTicker">
            @foreach(array_merge($tickerItems, $tickerItems) as $item)
                <span class="ticker-item">📰 {{ $item }}</span>
            @endforeach
        </div>
    </div>
</div>

<section class="hero-wrap" id="hero">
    <div class="lamp-glow" id="lampGlow"></div>
    <div class="lamp-beam"></div>

    <div class="container">
        <div class="hero-grid">
            <div class="hero-copy">
                <div class="pill">🔥 {{ $promoText }}</div>

                <h1 class="hero-title">{{ $productName }}</h1>

                <p class="hero-sub">{{ $heroSubtitle }}</p>

                <div class="price-row">
                    <div class="price-main">৳ {{ number_format($price) }}</div>
                    @if($oldPrice)
                        <div class="price-old">৳ {{ number_format($oldPrice) }}</div>
                    @endif
                    @if(!empty($product->discount))
                        <span class="pill">{{ $product->discount }}% OFF</span>
                    @endif
                </div>

                <div class="hero-note">{{ $discountText }}</div>

                <div class="hero-actions">
                    <a href="#order" class="btn-primary">🔥 এখনই অর্ডার করুন</a>
                    <a href="#products" class="btn-secondary">বিস্তারিত দেখুন</a>
                </div>

                <div class="hero-mini-trust">
                    <div class="mini-item">✨ নরম ও উষ্ণ আলো</div>
                    <div class="mini-item">🎁 গিফট-রেডি ডিজাইন</div>
                    <div class="mini-item">🚚 সারা বাংলাদেশে ডেলিভারি</div>
                </div>
            </div>

            <div class="hero-media">
                <div class="hero-image-shell">
                    <div class="float-badge top">💡 Mood Lighting</div>
                    <div class="float-badge bottom">🔥 Best Seller</div>
                    <div class="hero-image-card">
                        <img src="{{ $heroImage }}" alt="{{ $productName }}"
                             onerror="this.src='https://images.unsplash.com/photo-1517999144091-3d9dca6d1e43?auto=format&fit=crop&w=1000&q=80'">
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            @foreach($stats as $stat)
                <div class="stat-box">
                    <strong>{{ $stat['value'] }}</strong>
                    <span>{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>

        <div class="best-seller-gallery" style="margin-top: 24px;">
            <div class="gallery-title">Product Images</div>
            <div class="slider">
                <div class="slider-track">
                    @foreach(array_merge($sliderImages, $sliderImages) as $url)
                        <div class="slide">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($url) }}" alt="Slider Image"
                                 onerror="this.src='{{ $heroImage }}'"
                                 onclick="openImagePreview(this.src)"
                                 style="cursor: pointer;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="products">
    <div class="container">
        <h2 class="section-title">{{ $productsTitle }}</h2>
        <p class="section-sub">{{ $productsSubtitle }}</p>

        <div class="choose-grid">
@foreach($products->take(4) as $index => $product)
                <?php $color = $product->colors[0] ?? ['#f6d365'][$index % 4]; ?>
                <div
                    class="card product-card {{ $index === 0 ? 'active' : '' }}"
                    data-product-name="{{ $product->name }}"
                    data-product-price="{{ $product->price }}"
                    data-color="{{ $color }}"
                    onclick="selectProductCard(this)"
                >
                    @if($index === 0)
                        <div class="product-badge">নতুন</div>
                    @endif

                    <div class="product-thumb">
    <img src="{{ $product->image ? \Illuminate\Support\Facades\Storage::url($product->image) : $heroImage }}" 
         alt="{{ $product->name }}"
         style="background-color: {{ $color }}30;"
         onerror="this.src='https://images.unsplash.com/photo-1517999144091-3d9dca6d1e43?auto=format&fit=crop&w=1000&q=80'">
</div>

                    <div class="product-name">{{ $product->name }}</div>

                    <div class="product-pricing">
@if($product->old_price)
                            <div style="text-decoration:line-through; color:#7aa3b8;">৳ {{ number_format($product->old_price) }}</div>
                        @endif
                        <strong>৳ {{ number_format($product->price) }}</strong>
                    </div>

                    <button type="button" class="btn-primary" style="width:100%; padding:11px 14px;">
                        অর্ডার করুন
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</section>



<section class="section section-soft" id="features">
    <div class="container">
        <h2 class="section-title">{{ $featureTitle }}</h2>
        <p class="section-sub">{{ $featureSubtitle }}</p>

        <div class="features-grid">

    <div class="card feature-card">
        <div class="feature-icon">🌙</div>
        <h3>চোখের আরামে পড়ুন</h3>
        <p>
            Transparent flat panel design-এর ফলে সমান আলো ছড়ায় —
            কোনো glare নেই, shadow নেই। রাতে দীর্ঘ সময় পড়লেও চোখে চাপ পড়ে না।
        </p>
    </div>

    <div class="card feature-card">
        <div class="feature-icon">🔋</div>
        <h3>Battery চালিত — যেখানেই খুশি</h3>
        <p>
            Socket বা charge-এর ঝামেলা নেই। Travel, হোস্টেল, বিছানা —
            যেখানেই যান সহজে ব্যবহার করতে পারবেন।
        </p>
    </div>

    <div class="card feature-card">
        <div class="feature-icon">⚡</div>
        <h3>Simple One-Button Control</h3>
        <p>
            কোনো জটিলতা নেই — একটি button চাপলেই চালু,
            আবার চাপলেই বন্ধ। যে কেউ সহজে ব্যবহার করতে পারবে।
        </p>
    </div>

</div>
    </div>
</section>

<section class="section section-soft" id="how">
    <div class="container">
        <h2 class="section-title">✨ কীভাবে ব্যবহার করবেন?</h2>
        <p class="section-sub">মাত্র ৩টি সহজ ধাপ — একদম সহজ!</p>

        <div class="how-grid">
            <div class="how-item">
                <div class="how-dot">১</div>
                <h4>Battery লাগান</h4>
                <p>Battery-চালিত ডিভাইস — কোনো wire নেই।</p>
            </div>

            <div class="how-item">
                <div class="how-dot">২</div>
                <h4>বইয়ের উপর রাখুন</h4>
                <p>Transparent panel টি বইয়ের পাতার উপর সমান করে রাখুন।</p>
            </div>

            <div class="how-item">
                <div class="how-dot">৩</div>
                <h4>Button চেপে পড়া শুরু</h4>
                <p>একটি button — চাপ দিলেই আলো জ্বলে উঠবে।</p>
            </div>
        </div>
    </div>
</section>
<section class="section section-dark" id="specs">
    <div class="container">
        <h2 class="section-title">প্রযুক্তিগত বিবরণ</h2>
        <p class="section-sub">সম্পূর্ণ specification এক নজরে</p>

        <div class="card glass-dark" style="padding:20px; border-radius:20px;">
            <table style="width:100%; border-collapse:collapse; color:white;">
                <tr>
                    <td style="padding:12px; border-bottom:1px solid rgba(255,255,255,0.1);">ওজন</td>
                    <td style="padding:12px; border-bottom:1px solid rgba(255,255,255,0.1);">০.৫৯৯ কেজি (৫৯৯ গ্রাম)</td>
                </tr>
                <tr>
                    <td style="padding:12px;">রঙ</td>
                    <td style="padding:12px;">Black & White</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Switch Mode</td>
                    <td style="padding:12px;">Button Type</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Voltage</td>
                    <td style="padding:12px;">≤ ৩৬V</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Power Supply</td>
                    <td style="padding:12px;">Battery</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Shade Material</td>
                    <td style="padding:12px;">Plastic</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Style</td>
                    <td style="padding:12px;">Modern Simplicity</td>
                </tr>
                <tr>
                    <td style="padding:12px;">Item No.</td>
                    <td style="padding:12px;">WR107</td>
                </tr>
            </table>
        </div>
    </div>
</section>

<section class="section section-dark" id="reviews">
    <div class="container">
        <h2 class="section-title">{{ $reviewTitle }}</h2>
        <p class="section-sub">{{ $reviewSubtitle }}</p>

        <div class="reviews-grid">
@forelse($reviews->take(3) as $review)
                <div class="card review-card">
                    <div class="review-stars">{{ str_repeat('⭐', $review->rating) }}</div>
                    <p>{{ $review->text }}</p>
                    <div class="review-user">
                        <div class="review-avatar">{{ mb_substr($review->name, 0, 1) }}</div>
                        <div>
                            <strong>{{ $review->name }}</strong>
                            <span>{{ $review->place }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card review-card text-center py-12">
                    <p>কোনো রিভিউ এখনো যোগ করা হয়নি।</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="trust-strip">
    <div class="container">
        <div class="trust-strip-inner">

            <div class="trust-pill">
                <span>📦</span>
                <div>
                    ২৪ ঘন্টা
                    <small>দ্রুত কনফার্মেশন</small>
                </div>
            </div>

            <div class="trust-pill">
    <span>🚚</span>
    <div>
        ঢাকায় 70৳
        <small>Inside Dhaka Delivery</small>
    </div>
</div>

<div class="trust-pill">
    <span>🚛</span>
    <div>
        ঢাকার বাইরে 130৳
        <small>Outside Dhaka Delivery</small>
    </div>
</div>

            <div class="trust-pill">
                <span>🛡️</span>
                <div>
                    ক্যাশ অন ডেলিভারি
                    <small>নিরাপদ অর্ডার</small>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section order-wrap" id="order">
    <div class="container">
        <h2 class="section-title">{{ $orderTitle }}</h2>
        <p class="section-sub">{{ $orderSubtitle }}</p>

        <div class="order-layout">
            <div class="order-left-space">
                <div class="glass-dark order-promo">
                    <div class="countdown-wrap">
                        <span>⏳ অফার শেষ হতে বাকি</span>
                        <span class="countdown-time" id="countdownTimer">14:59</span>
                    </div>
                    <h3>আজই ঘরকে দিন ম্যাজিক লাইটের স্পর্শ</h3>
                    <p>স্টক সীমিত। দেরি করলে অফার মিস হতে পারে। আজকের ডিসকাউন্টে এখনই অর্ডার করলে ক্যাশ অন ডেলিভারিতে পেয়ে যাবেন আপনার ম্যাজিক ল্যান্টার্ন।</p>
                    <div class="promo-points">
                        <div>✨ ঘরের মুড বদলে দেয় এমন প্রিমিয়াম গ্লো</div>
                        <div>🎁 উপহার দেওয়ার জন্য স্টাইলিশ ও আকর্ষণীয়</div>
                        <div>🚚 দ্রুত কলব্যাক ও সারা বাংলাদেশে ডেলিভারি</div>
                    </div>
                </div>
            </div>

            <div class="card order-card">
                @if($errors->any())
                    <div class="error-box">
                        <strong>দয়া করে নিচের ভুলগুলো ঠিক করুন:</strong>
                        <ul style="margin-top:8px; padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success') == 'order_success')
                    <div class="success-box">
                        আপনার অর্ডার সফলভাবে গ্রহণ করা হয়েছে।
                    </div>
                @endif

                <form method="POST" action="/order" class="order-form">
                    @csrf

                    <input type="hidden" name="product" id="selectedProduct" value="{{ $selectedOldProduct }}">
                    <input type="hidden" name="delivery_charge" id="deliveryChargeInput" value="{{ $selectedOldDelivery === 'inside' ? 70 : 130 }}">
                    <input type="hidden" name="total_price" id="totalPriceInput" value="{{ ($price * $selectedOldQty) + ($selectedOldDelivery === 'inside' ? 70 : 130) }}">

                    <div class="field">
                        <label>নির্বাচিত পণ্য</label>
                        <div style="font-weight:700; margin-bottom:10px; color:#fff8e6;">
                            <span id="productNameDisplay">{{ $selectedOldProduct }}</span>
                        </div>
                    </div>

                    <div class="field">
                        <label>আপনার নাম *</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="আপনার পুরো নাম লিখুন" required>
                    </div>

                    <div class="field">
                        <label>মোবাইল নম্বর *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
                    </div>

                    <div class="field">
                        <label>সম্পূর্ণ ঠিকানা *</label>
                        <textarea name="address" placeholder="বাড়ি / রাস্তা / এলাকা / জেলা" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="field">
                        <label>রং / ভ্যারিয়েন্ট সিলেক্ট করুন *</label>
                        <div class="color-swatches" id="colorSwatches">
                            @foreach($colors as $color)
                                <label class="color-option">
                                    <input
                                        type="radio"
                                        name="color"
                                        value="{{ $color }}"
                                        {{ $selectedOldColor === $color ? 'checked' : '' }}
                                        onchange="syncSelectedColor('{{ $color }}')"
                                        required
                                    >
                                    <span class="color-dot"
                                          style="background: {{ $color }};"
                                          title="{{ $color }}"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="field">
                        <label>পরিমাণ *</label>
                        <div class="qty-row">
                            <select name="quantity" id="quantitySelect" onchange="updatePrice()" required>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $selectedOldQty === $i ? 'selected' : '' }}>
                                        {{ $i }} টি
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label>ডেলিভারি এরিয়া *</label>
                        <select name="delivery_area" id="deliverySelect" onchange="updatePrice()" required>
                            <option value="inside" {{ $selectedOldDelivery === 'inside' ? 'selected' : '' }}>
                                ঢাকার ভিতরে (70৳)
                            </option>
                            <option value="outside" {{ $selectedOldDelivery === 'outside' ? 'selected' : '' }}>
                                ঢাকার বাইরে (130৳)
                            </option>
                        </select>
                    </div>

                    <div class="summary-box">
                        <div class="summary-line">
                            <span>পণ্যের মূল্য</span>
                            <strong>৳ <span id="productTotal">{{ $price * $selectedOldQty }}</span></strong>
                        </div>

                        <div class="summary-line">
                            <span>ডেলিভারি চার্জ</span>
                            <strong>৳ <span id="deliveryCharge">{{ $selectedOldDelivery === 'inside' ? 70 : 130 }}</span></strong>
                        </div>

                        <div class="summary-line total">
                            <span>মোট</span>
                            <span>৳ <span id="grandTotal">{{ ($price * $selectedOldQty) + ($selectedOldDelivery === 'inside' ? 70 : 130) }}</span></span>
                        </div>
                    </div>

                    <button class="btn-primary" type="submit" style="width:100%; margin-top:16px; padding:16px 20px;">
                        🛒 অর্ডার কনফার্ম করুন
                    </button>

                    <div class="helper-note">
                        যেকোনো প্রয়োজনে কল করুন: {{ $phone }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container footer-inner">

        <div class="footer-brand">
            <img src="/images/logo.png" class="brand-logo" alt="logo">
            <span>{{ $contents['brand_name'] ?? 'MagicLanternBD' }}</span>
        </div>

        <div class="footer-text">
            {{ $footerText }}
        </div>

        <!-- Social Icons -->
        <div class="footer-social">
            
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=61576438410805" target="_blank" class="social-icon">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <path d="M22 12.07C22 6.48 17.52 2 11.93 2S1.86 6.48 1.86 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.4V9.41c0-2.37 1.41-3.68 3.57-3.68 1.03 0 2.11.18 2.11.18v2.32h-1.19c-1.17 0-1.54.73-1.54 1.48v1.77h2.62l-.42 2.9h-2.2V22c4.78-.8 8.44-4.94 8.44-9.93z"/>
                </svg>
            </a>

            <!-- Instagram -->
            <a href="https://www.instagram.com/magic_lanternbd/" target="_blank" class="social-icon">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 110 10 5 5 0 010-10zm6.5-.75a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zM12 9a3 3 0 100 6 3 3 0 000-6z"/>
                </svg>
            </a>

        </div>

        <div class="footer-support">
            সাপোর্ট: {{ $phone }}
        </div>

    </div>
</footer>

<div class="live-orders">
    <div class="live-order-card" id="liveOrderCard">
        <div class="live-order-avatar" id="liveOrderAvatar">র</div>
        <div>
            <strong id="liveOrderName">রাফি</strong>
            <span id="liveOrderText">ঢাকা থেকে এখনই ১টি অর্ডার করেছেন</span>
        </div>
    </div>
</div>

<div class="sticky-bar" id="stickyBar">
    <div class="sticky-price">
        @if($oldPrice)
        <small>৳ {{ number_format($oldPrice) }}</small>
        @endif
        ৳ {{ number_format($price) }}
    </div>

    <button class="sticky-btn" onclick="document.getElementById('order').scrollIntoView({behavior:'smooth'})">
        🔥 অর্ডার করুন
    </button>
</div>

@if(session('success') == 'order_success')
<div id="successModal" class="modal-overlay open">
    <div class="modal-box">
        <div class="modal-icon">🎉</div>
        <h3>অর্ডার হয়েছে!</h3>
        <p>আপনার অর্ডার সফলভাবে গ্রহণ করা হয়েছে। আমরা শীঘ্রই ফোন করব।</p>
        <button class="modal-close" onclick="closeModal()">ঠিক আছে</button>
    </div>
</div>
@endif

<!-- Image Preview Modal -->
<div id="imagePreviewOverlay" class="image-preview-overlay">
    <div class="image-preview-container">
        <img id="previewImage" src="" alt="Full Image Preview">
        <button class="close-preview" onclick="closeImagePreview()" title="Close">&times;</button>
    </div>
</div>

@if(session('success') == 'order_success')
<script>
  if (typeof fbq !== 'undefined') {
    fbq('track', 'Purchase');
  }
  if (typeof gtag !== 'undefined') {
    gtag('event', 'purchase');
  }
</script>
@endif

<script>
    let basePrice = {{ $price }};
    let selectedProductName = @json($selectedOldProduct);
    const hero = document.querySelector('.hero-wrap');
    const glow = document.getElementById('lampGlow');
    const stickyBar = document.getElementById('stickyBar');
    const liveOrderCard = document.getElementById('liveOrderCard');

    function selectProductCard(card) {
        document.querySelectorAll('.product-card').forEach(c => c.classList.remove('active'));
        card.classList.add('active');

        const name = card.dataset.productName;
        const price = parseInt(card.dataset.productPrice, 10);
        const color = card.dataset.color;

        selectedProductName = name;
        basePrice = price;

        document.getElementById('selectedProduct').value = name;
        document.getElementById('productNameDisplay').innerText = name;

        const colorInputs = document.querySelectorAll('#colorSwatches input[type="radio"]');
        colorInputs.forEach(input => {
            input.checked = input.value === color;
        });

        updatePrice();
        document.getElementById('order').scrollIntoView({ behavior: 'smooth' });
    }

    function syncSelectedColor(color) {
        document.querySelectorAll('.product-card').forEach(card => {
            card.classList.toggle('active', card.dataset.color === color);
        });
    }

    function updatePrice() {
        const qty = parseInt(document.getElementById('quantitySelect').value || 1, 10);
        const deliveryType = document.getElementById('deliverySelect').value;
        const deliveryCharge = deliveryType === 'inside' ? 70 : 130;

        const productTotal = basePrice * qty;
        const grandTotal = productTotal + deliveryCharge;

        document.getElementById('productTotal').innerText = productTotal;
        document.getElementById('deliveryCharge').innerText = deliveryCharge;
        document.getElementById('grandTotal').innerText = grandTotal;

        document.getElementById('deliveryChargeInput').value = deliveryCharge;
        document.getElementById('totalPriceInput').value = grandTotal;
    }

    function closeModal() {
        const el = document.getElementById('successModal');
        if (el) el.style.display = 'none';
    }

    function openImagePreview(src) {
        const overlay = document.getElementById('imagePreviewOverlay');
        const previewImg = document.getElementById('previewImage');
        previewImg.src = src;
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeImagePreview() {
        const overlay = document.getElementById('imagePreviewOverlay');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    // Close on overlay click
    document.addEventListener('click', function(e) {
        if (e.target.id === 'imagePreviewOverlay') {
            closeImagePreview();
        }
    });

  

    window.addEventListener('scroll', () => {
        if (window.scrollY > 420) {
            stickyBar.classList.add('visible');
        } else {
            stickyBar.classList.remove('visible');
        }
    });

    const fakeOrders = [
        { name: 'রাফি', district: 'ঢাকা', qty: 1 },
        { name: 'নুসরাত', district: 'চট্টগ্রাম', qty: 2 },
        { name: 'ইমরান', district: 'সিলেট', qty: 1 },
        { name: 'মিম', district: 'কুমিল্লা', qty: 1 },
        { name: 'তানভীর', district: 'রাজশাহী', qty: 3 },
        { name: 'সাবা', district: 'খুলনা', qty: 1 }
    ];

    function showLiveOrder() {
        if (!liveOrderCard) return;
        const item = fakeOrders[Math.floor(Math.random() * fakeOrders.length)];
        document.getElementById('liveOrderAvatar').innerText = item.name.charAt(0);
        document.getElementById('liveOrderName').innerText = item.name;
        document.getElementById('liveOrderText').innerText = `${item.district} থেকে এখনই ${item.qty}টি অর্ডার করেছেন`;
        liveOrderCard.classList.add('show');

        setTimeout(() => {
            liveOrderCard.classList.remove('show');
        }, 4200);
    }

    let remaining = 14 * 60 + 59;
    function updateCountdown() {
        const el = document.getElementById('countdownTimer');
        if (!el) return;
        const min = String(Math.floor(remaining / 60)).padStart(2, '0');
        const sec = String(remaining % 60).padStart(2, '0');
        el.textContent = `${min}:${sec}`;
        if (remaining > 0) remaining--;
    }

    window.addEventListener('DOMContentLoaded', function () {
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
function updateMobileIcon(theme) {
  if (window.innerWidth <= 640) {
    themeToggle.innerHTML = theme === 'dark' ? '☀️' : '🌙';  /* ✅ FIXED: innerHTML */
  }
}
        // Load saved theme or detect system preference
        const savedTheme = localStorage.getItem('theme') || 
                          (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        body.setAttribute('data-theme', savedTheme);
        if (savedTheme === 'dark') themeToggle.classList.add('active');
        
       themeToggle.addEventListener('click', () => {
  const currentTheme = body.getAttribute('data-theme');
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

  body.setAttribute('data-theme', newTheme);
  themeToggle.classList.toggle('active');
  localStorage.setItem('theme', newTheme);

  updateMobileIcon(newTheme); // 👈 ADD THIS
});
        
        updatePrice();
        updateCountdown();
        setInterval(updateCountdown, 1000);
        setTimeout(showLiveOrder, 2500);
        setInterval(showLiveOrder, 12000);
        let mouseX = 0, mouseY = 0;
let glowX = 0, glowY = 0;

function animateGlow() {
    glowX += (mouseX - glowX) * 0.1;
    glowY += (mouseY - glowY) * 0.1;

    glow.style.left = glowX + "px";
    glow.style.top = glowY + "px";

    requestAnimationFrame(animateGlow);
}

hero.addEventListener("mousemove", (e) => {
    const rect = hero.getBoundingClientRect();
    mouseX = e.clientX - rect.left;
    mouseY = e.clientY - rect.top;
});

animateGlow();
    });
    
   
</script>

</body>
</html>