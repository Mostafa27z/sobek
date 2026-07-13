<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'سوبك ترافيل - احجز تذاكر طيران، فنادق، تأشيرات وحج وعمرة بأفضل الأسعار. دعم 24/7 ورد فوري عبر واتساب.')">
    <meta name="theme-color" content="#001f3f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="@yield('title', 'سوبك ترافيل - تذاكر طيران وفنادق وتأشيرات وحج وعمرة')">
    <meta property="og:description" content="@yield('meta_description', 'احجز تذاكر طيران بأرخص الأسعار. وجهات متعددة، دعم 24/7.')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:title" content="@yield('title')">
    <meta property="twitter:description" content="@yield('meta_description')">

    <title>@yield('title', 'سوبك ترافيل - تذاكر طيران وفنادق وتأشيرات وحج وعمرة')</title>

    <!-- Load compiled Vite assets when available -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif

    <style>
        /* ===== CRITICAL INLINE CSS (OPTIMIZED) ===== */
        *{margin:0;padding:0;box-sizing:border-box}
        :root{
            --primary:#0077B6;
            --primary-dark:#005F8E;
            --primary-deeper:#004777;
            --secondary:#00B4D8;
            --accent:#27AE60;
            --sky-light:#E0F4FD;
            --sky-mid:#90E0EF;
            --dark:#0D0D0D;
            --light:#F0FAFF;
            --gray:#6B7280;
            --border:#BEE3F8;
            --success:#27AE60;
            --warning:#F59E0B;
            --shadow:0 10px 40px rgba(0,119,182,.08);
            --shadow-hover:0 20px 60px rgba(0,119,182,.16);
        }
        html{scroll-behavior:smooth;overflow-x:hidden}
        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
            background-color:var(--light);color:var(--dark);line-height:1.6;
            overflow-x:hidden;-webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }
        @keyframes fadeInDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1}}
        @keyframes fadeInUp{from{opacity:0;transform:translateY(20px)}to{opacity:1}}
        @keyframes scaleIn{from{opacity:0;transform:scale(.92)}to{opacity:1}}
        @keyframes slideInLeft{from{opacity:0;transform:translateX(30px)}to{opacity:1}}
        @keyframes spin{to{transform:rotate(360deg)}}

        .reveal{opacity:0;transform:translateY(24px);transition:opacity .6s ease-out,transform .6s ease-out}
        .reveal.visible{opacity:1;transform:translateY(0)}
        .icon{width:18px;height:18px;display:inline-block;vertical-align:middle;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

        /* ===== HEADER ===== */
        header{
            background:rgba(255, 255, 255, 0.85);
            backdrop-filter:blur(12px);
            -webkit-backdrop-filter:blur(12px);
            padding:10px 0;box-shadow:0 4px 30px rgba(0,119,182,0.06);
            position:sticky;top:0;z-index:1000;
            border-bottom:1px solid rgba(190, 227, 248, 0.5);
            transition: all 0.3s ease;
        }
        .header-wrapper{
            max-width:1400px;margin:0 auto;padding:0 24px;
            display:flex;justify-content:space-between;align-items:center;gap:16px;
        }
        .logo-section{
            display:flex;
            flex-direction: column;
            align-items:center;
            gap:4px;
            text-decoration:none;
            transition: transform 0.2s ease;
            text-align: center;
        }
        .logo-section:hover {
            transform: scale(1.02);
        }
        .logo-image{width:100px;height:100px;object-fit:contain;flex-shrink:0}
        .logo-text{
            display: flex;
            flex-direction: column;
            gap: 2px;
            align-items: center;
        }
        .logo-brand{
            font-size:18px;
            color:var(--primary-dark);
            font-weight:800;
            margin:0;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo-meta{
            display: flex;
            gap: 8px;
            align-items: center;
            flex-direction: column;
            margin-top: -10px;
        }
        .logo-text h1{font-size:11px;color:var(--gray);font-weight:600;margin:0}
        .logo-text p{font-size:11px;color:var(--secondary);font-weight:700;margin:0; background: rgba(0, 180, 216, 0.08); padding: 2px 6px; border-radius: 4px;}

        .nav-menu{
            display:flex;align-items:center;gap:24px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-link{
            color: var(--dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            position: relative;
            padding: 6px 0;
            transition: color 0.25s ease;
        }
        .nav-link:hover{
            color: var(--primary);
        }
        .nav-link::after{
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: width 0.25s ease;
        }
        .nav-link:hover::after{
            width: 100%;
            left: 0;
            right: auto;
        }

        .header-actions{display:flex;align-items:center;gap:10px}
        .header-cta{
            display:flex;align-items:center;gap:8px;
            color:#fff;text-decoration:none;font-weight:700;
            font-size:14px;padding:10px 20px;background:var(--accent);
            border-radius:30px;transition:all .25s ease;
            box-shadow:0 4px 15px rgba(39,174,96,0.25);
        }
        .header-cta:hover,.header-cta:focus{
            background:#229954;
            transform: translateY(-2px);
            box-shadow:0 6px 20px rgba(39,174,96,0.35);
            outline:none;
        }
        .header-cta:focus{box-shadow:0 0 0 3px rgba(39,174,96,.4)}

        /* ===== MAIN CONTENT ===== */
        main{min-height:calc(100vh - 200px);overflow-x:hidden}
        .container{max-width:1400px;margin:40px auto;padding:0 20px}
        .card{background:#fff;padding:28px 24px;border-radius:14px;box-shadow:var(--shadow);margin-bottom:24px;border:1px solid var(--border)}

        .alert{
            padding:14px;border-radius:8px;margin-bottom:20px;
            font-size:14px;font-weight:700;border-left:4px solid;
        }
        .alert-success{
            background-color:#d1fae5;color:#065f46;border-left-color:#10b981;
        }
        .alert-danger{
            background-color:#fee2e2;color:#991b1b;border-left-color:#ef4444;
        }

        /* ===== FOOTER ===== */
        footer{
            background:var(--primary);color:#fff;padding:40px 20px 30px;
            margin-top:60px;border-top:4px solid var(--secondary);
        }
        .footer-wrapper{max-width:1400px;margin:0 auto}
        .footer-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:28px;margin-bottom:28px;
        }
        .footer-section h3{font-size:15px;font-weight:700;margin-bottom:12px}
        .footer-section ul{list-style:none}
        .footer-section li{margin:8px 0;font-size:13px;opacity:.85;line-height:1.6}
        .footer-section a{
            color:var(--secondary);text-decoration:none;font-weight:600;
            transition:color .2s ease;
        }
        .footer-section a:hover,.footer-section a:focus{color:#fff;text-decoration:underline}
        .footer-divider{height:1px;background:rgba(255,255,255,.2);margin:24px 0}
        .footer-bottom{text-align:center;font-size:12px;opacity:.8;line-height:1.8}

        /* ===== STICKY WHATSAPP BUTTON ===== */
        .sticky-whatsapp{
            position:fixed;bottom:20px;right:20px;z-index:999;
            background:var(--accent);color:#fff;
            width:60px;height:60px;border-radius:50%;border:none;
            cursor:pointer;transition:all .3s ease;
            box-shadow:0 6px 20px rgba(39,174,96,.4);
            display:flex;align-items:center;justify-content:center;
            font-size:28px;text-decoration:none;animation:slideInLeft .4s ease-out;
        }
        .sticky-whatsapp:hover,.sticky-whatsapp:focus{
            transform:scale(1.1);box-shadow:0 8px 28px rgba(39,174,96,.5);
            outline:2px solid rgba(39,174,96,.3);outline-offset:2px;
        }
        .sticky-whatsapp:focus{outline:3px solid var(--accent)}

        .footer-branches {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 0;
            margin: 0;
            list-style: none !important;
        }
        @media (max-width: 576px) {
            .footer-branches {
                grid-template-columns: 1fr;
            }
        }
        .footer-branches li {
            font-size: 13px !important;
            line-height: 1.6;
        }
        .footer-branches strong {
            color: var(--secondary);
            display: block;
            margin-bottom: 4px;
        }
        .payment-methods {
            margin-top: 20px;
        }
        .payment-methods h4 {
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 700;
            color: #fff;
        }
        .payment-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .payment-badge {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            color: #fff;
            white-space: nowrap;
        }
        .footer-whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #25d366;
            color: #fff !important;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none !important;
            font-weight: bold;
            margin-top: 15px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
            transition: all 0.3s ease;
        }
        .footer-whatsapp-btn:hover {
            background: #20ba5a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
        }
        .footer-whatsapp-btn svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width:768px){
            .logo-brand{font-size:16px}
            .logo-text h1{font-size:10px}
            .logo-text p{font-size:10px}
            .logo-image{width:60px;height:60px}
            .header-cta{font-size:12px;padding:8px 16px}
            .footer-grid{grid-template-columns:1fr 1fr}
        }
        @media (max-width:480px){
            .header-wrapper{padding:0 12px;gap:8px}
            .logo-brand{font-size:14px}
            .logo-image{width:48px;height:48px}
            .nav-menu{gap:12px}
            .nav-link{font-size:13px}
            .header-actions{gap:6px}
            .header-cta{font-size:11px;padding:6px 12px}
        }
        @media (prefers-reduced-motion:reduce){
            *{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important}
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- HEADER -->
<header role="banner">
    <div class="header-wrapper">
        <a href="{{ route('landing') }}" class="logo-section" aria-label="سوبك ترافيل - الصفحة الرئيسية">
            <img src="/logo.png" alt="Sobek Travel Logo" class="logo-image" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%22 y=%2250%22 text-anchor=%22middle%22 dy=%22.3em%22 font-size=%2216%22%3EST%3C/text%3E%3C/svg%3E'" loading="lazy">
            <div class="logo-text">
                <!-- <span class="logo-brand">سوبك ترافيل</span> -->
                <div class="logo-meta">
                    <h1>ترخيص سياحة رقم ٦٧٨</h1>
                    <p>منذ ١٩٨٧م</p>
                </div>
            </div>
        </a>
        <nav class="nav-menu" aria-label="قائمة التنقل الرئيسية">
            <!-- <a href="{{ route('landing') }}" class="nav-link" aria-label="الرئيسية">الرئيسية</a> -->
        </nav>
        <div class="header-actions">
            <a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer" class="header-cta" aria-label="اتصل بنا عبر واتساب">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" fill="currentColor"/></svg>
                <span>تواصل معنا</span>
            </a>
        </div>
    </div>
</header>

<!-- ALERTS -->
@if(session('success'))
    <div class="container" style="margin-bottom:0">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif

@if($errors->any())
    <div class="container" style="margin-bottom:0">
        <div class="alert alert-danger" role="alert">
            <ul style="list-style:none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- MAIN CONTENT -->
<main role="main">
    @yield('content')
</main>

<!-- STICKY WHATSAPP -->
<a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer" class="sticky-whatsapp" title="تحدث معنا عبر واتساب" aria-label="فتح محادثة واتساب">
    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" style="width:30px;height:30px"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
</a>

<!-- FOOTER -->
<footer role="contentinfo">
    <div class="footer-wrapper">
        <div class="footer-grid">
           
            <section class="footer-section">
                <h3>سوبيك للسياحة</h3>
                <ul style="padding:0; margin:0; list-style:none;">
                    <li style="margin: 8px 0; font-size: 13.5px;"><strong>سوبيك للسياحة</strong></li>
                    <li style="margin: 8px 0;">ترخيص سياحة رقم 678 - وزارة السياحة المصرية</li>
                    <li style="margin: 8px 0;">عضوية منظمة الاياتا العالمية</li>
                    <li style="margin: 8px 0; font-weight: bold; color: var(--secondary);">للشكاوى أو الاقتراحات: <a href="tel:+201110073052" style="color:var(--secondary); text-decoration:underline;">01110073052</a></li>
                    <li style="margin: 8px 0;">البريد الإلكتروني: <a href="mailto:info@sobek-travel.com" style="color:#fff;">info@sobek-travel.com</a></li>
                </ul>
            </section>

            <section class="footer-section" style="grid-column: span 2;">
                <h3>فروعنا</h3>
                <ul class="footer-branches">
                    <li>
                        <strong>مدينة 6 اكتوبر</strong>
                        ميدان الحصري ـ 79 شارع المحور المركزى
                    </li>
                    <li>
                        <strong>المهندسين</strong>
                        334شارع السودان
                    </li>
                    <li>
                        <strong>حلوان</strong>
                        1شارع محمود خاطر
                    </li>
                    <li>
                        <strong>الغردقة</strong>
                        14 قرية ناشيونال بالممشي السياحي
                    </li>
                    <li>
                        <strong>الفيوم</strong>
                        ميدان الشيخ سالم ـ 1 عمارة محمود السواح
                    </li>
                </ul>
            </section>

            <section class="footer-section">
                <h3>تواصل ودفع سريع</h3>
                <div>
                    <a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer" class="footer-whatsapp-btn">
                        <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        واتساب  
                    </a>
                </div>
                
                <div class="payment-methods">
                    <h4>وسائل الدفع المقبولة:</h4>
                    <div class="payment-badges">
                        <span class="payment-badge">انستاباي (InstaPay)</span>
                        <span class="payment-badge">فودافون كاش</span>
                        <span class="payment-badge">نقاط البيع (POS)</span>
                        <span class="payment-badge">رابط دفع إلكتروني</span>
                        <span class="payment-badge">كاش / نقدي</span>
                    </div>
                </div>
            </section>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} سوبيك للسياحة - جميع الحقوق محفوظة</p>
            <p>رد فوري • دعم 24/7 • أفضل الأسعار مضمونة</p>
        </div>
    </div>
</footer>

<!-- STRUCTURED DATA -->
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Organization",
    "name": "سوبك ترافيل",
    "url": "{{ config('app.url') }}",
    "logo": "{{ asset('/logo.png') }}",
    "description": "وكالة سفر متخصصة في حجز تذاكر الطيران والفنادق والتأشيرات والحج والعمرة",
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Customer Support",
        "telephone": "+201110073052",
        "availableLanguage": "ar"
    },
    "sameAs": [
        "https://www.facebook.com",
        "https://www.instagram.com",
        "https://twitter.com"
    ]
}
</script>

<!-- SCROLL REVEAL -->
<script>
    (function() {
        function observeReveal() {
            var els = document.querySelectorAll('.reveal:not(.visible)');
            if (!('IntersectionObserver' in window)) {
                for (var i = 0; i < els.length; i++) {
                    els[i].classList.add('visible');
                }
                return;
            }
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: .12 });
            for (var i = 0; i < els.length; i++) {
                io.observe(els[i]);
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', observeReveal);
        } else {
            observeReveal();
        }
    }());
</script>

@yield('scripts')
</body>
</html>