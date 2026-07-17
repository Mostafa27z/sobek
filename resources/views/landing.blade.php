@extends('layouts.app')

@section('title', 'احجز تذاكر طيران - سوبك ترافيل')

@section('meta_description', 'ابحث عن تذاكر طيران بأرخص الأسعار واحجز فوراً عبر واتساب. وجهات متعددة، دعم 24/7، وأفضل أسعار مضمونة مع سوبك ترافيل.')

@section('styles')
    <!-- Owl Carousel CSS (used by the testimonials section below) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* =========================================================
               HERO CAROUSEL (marketing header) - RESPONSIVE FIXED
            ========================================================= */
        .hero-carousel {
            position: relative;
            width: 100%;
            height: 80vh;
            min-height: 500px;
            max-height: 800px;
            overflow: hidden;
            background: var(--primary-deeper);
            margin-top: -1px;
        }

        .hero-track {
            position: relative;
            width: 100%;
            height: 100%
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity 1.1s ease;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 2
        }

        .hero-slide .slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.12);
            transition: transform 7s linear;
            filter: saturate(1.05);
        }

        .hero-slide.active .slide-bg {
            transform: scale(1)
        }

        .hero-slide .slide-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(120deg, rgba(0, 31, 63, .92) 0%, rgba(0, 71, 119, .72) 42%, rgba(0, 119, 182, .35) 100%);
        }

        .hero-slide .slide-overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 55%, rgba(0, 15, 30, .55) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 3;
            height: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 680px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .35);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            padding: 9px 18px;
            border-radius: 30px;
            width: fit-content;
            margin-bottom: 20px;
            letter-spacing: .3px;
            opacity: 0;
            transform: translateY(16px);
        }

        .hero-slide.active .hero-eyebrow {
            animation: heroRise .7s .25s ease forwards
        }

        .hero-eyebrow svg {
            width: 14px;
            height: 14px;
            stroke: var(--secondary);
            fill: var(--secondary)
        }

        .hero-title {
            font-size: 48px;
            line-height: 1.15;
            font-weight: 800;
            color: #fff;
            margin-bottom: 18px;
            text-shadow: 0 4px 24px rgba(0, 0, 0, .35);
            opacity: 0;
            transform: translateY(20px);
            letter-spacing: -0.5px;
        }

        .hero-slide.active .hero-title {
            animation: heroRise .75s .4s ease forwards
        }

        .hero-title .accent-word {
            background: linear-gradient(90deg, var(--secondary), #7CF5D3);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, .92);
            line-height: 1.8;
            margin-bottom: 28px;
            max-width: 560px;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-slide.active .hero-subtitle {
            animation: heroRise .75s .55s ease forwards
        }

        .hero-cta-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-slide.active .hero-cta-group {
            animation: heroRise .75s .7s ease forwards
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all .25s ease;
            outline-offset: 3px;
            white-space: nowrap;
        }

        .hero-btn svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0
        }

        .hero-btn-primary {
            background: #fff;
            color: var(--primary-deeper);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        }

        .hero-btn-primary:hover {
            background: var(--secondary);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(0, 180, 216, .4);
        }

        .hero-btn-primary:focus {
            outline: 3px solid rgba(255, 255, 255, .6)
        }

        .hero-btn-whatsapp {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 10px 30px rgba(39, 174, 96, .35);
        }

        .hero-btn-whatsapp:hover {
            background: #229954;
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(39, 174, 96, .45);
        }

        .hero-btn-whatsapp:focus {
            outline: 3px solid rgba(39, 174, 96, .6)
        }

        .hero-stats {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-slide.active .hero-stats {
            animation: heroRise .75s .85s ease forwards
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .hero-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hero-stat-icon svg {
            width: 18px;
            height: 18px;
            stroke: var(--secondary);
            fill: none;
            stroke-width: 2
        }

        .hero-stat-num {
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1
        }

        .hero-stat-label {
            font-size: 11px;
            color: rgba(255, 255, 255, .75);
            font-weight: 600
        }

        @keyframes heroRise {
            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .hero-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .35);
            backdrop-filter: blur(6px);
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            transition: all .25s ease;
            outline-offset: 3px;
        }

        .hero-arrow:hover {
            background: #fff;
            color: var(--primary-deeper);
            transform: translateY(-50%) scale(1.08)
        }

        .hero-arrow:focus {
            outline: 3px solid rgba(255, 255, 255, .6)
        }

        .hero-arrow svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.3
        }

        .hero-arrow-prev {
            right: 28px
        }

        .hero-arrow-next {
            left: 28px
        }

        .hero-dots {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 5;
            display: flex;
            gap: 12px;
        }

        .hero-dot {
            position: relative;
            width: 36px;
            height: 6px;
            border-radius: 4px;
            background: rgba(255, 255, 255, .3);
            border: none;
            cursor: pointer;
            overflow: hidden;
            padding: 0;
            outline-offset: 4px;
        }

        .hero-dot:focus {
            outline: 2px solid #fff
        }

        .hero-dot::after {
            content: '';
            position: absolute;
            inset: 0;
            background: #fff;
            transform: scaleX(0);
            transform-origin: right;
            border-radius: 4px;
        }

        .hero-dot.active::after {
            animation: dotFill 6s linear forwards
        }

        @keyframes dotFill {
            from {
                transform: scaleX(0)
            }

            to {
                transform: scaleX(1)
            }
        }

        @media (prefers-reduced-motion:reduce) {
            .hero-slide .slide-bg {
                transition: none
            }

            .hero-dot.active::after {
                animation: none;
                transform: scaleX(1)
            }
        }

        /* Laptop/Desktop (992px - 1199px) */
        @media (max-width:1024px) {
            .hero-carousel {
                height: 70vh;
                min-height: 480px;
                max-height: 700px;
            }

            .hero-title {
                font-size: 40px
            }

            .hero-content {
                padding: 0 35px
            }

            .hero-arrow {
                width: 44px;
                height: 44px
            }

            .hero-arrow svg {
                width: 20px;
                height: 20px
            }
        }

        /* Tablet Portrait/Landscape (768px - 991px) */
        @media (max-width:768px) {
            .hero-carousel {
                height: 65vh;
                min-height: 420px;
                max-height: 600px;
            }

            .hero-content {
                padding: 0 30px;
                max-width: 100%;
            }

            .hero-title {
                font-size: 32px;
                margin-bottom: 14px;
                line-height: 1.2;
            }

            .hero-eyebrow {
                font-size: 12px;
                padding: 8px 14px;
                margin-bottom: 16px;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-bottom: 22px;
                line-height: 1.6;
            }

            .hero-cta-group {
                margin-bottom: 22px;
                gap: 12px;
            }

            .hero-btn {
                padding: 12px 22px;
                font-size: 13px;
            }

            .hero-btn svg {
                width: 16px;
                height: 16px;
            }

            .hero-stats {
                gap: 20px;
            }

            .hero-stat-icon {
                width: 36px;
                height: 36px;
            }

            .hero-stat-icon svg {
                width: 16px;
                height: 16px;
            }

            .hero-stat-num {
                font-size: 14px;
            }

            .hero-stat-label {
                font-size: 10px;
            }

            .hero-arrow {
                display: none
            }

            .hero-dots {
                bottom: 20px;
                gap: 10px;
            }

            .hero-dot {
                width: 32px;
                height: 5px;
            }
        }

        /* Small Tablet/Large Mobile (640px - 767px) */
        @media (max-width:640px) {
            .hero-carousel {
                height: 60vh;
                min-height: 380px;
                max-height: 550px;
            }

            .hero-content {
                padding: 0 24px
            }

            .hero-title {
                font-size: 27px;
                margin-bottom: 12px;
                font-weight: 700;
            }

            .hero-eyebrow {
                font-size: 11px;
                padding: 7px 12px;
                margin-bottom: 14px;
            }

            .hero-subtitle {
                font-size: 13px;
                margin-bottom: 18px;
                line-height: 1.5;
            }

            .hero-cta-group {
                margin-bottom: 18px;
                gap: 10px;
            }

            .hero-btn {
                padding: 11px 18px;
                font-size: 12px;
                flex: 1;
                min-width: 140px;
                justify-content: center;
            }

            .hero-btn svg {
                width: 14px;
                height: 14px;
            }

            .hero-stats {
                gap: 16px;
                font-size: 12px;
            }

            .hero-stat {
                gap: 8px;
            }

            .hero-stat-icon {
                width: 32px;
                height: 32px;
            }

            .hero-stat-icon svg {
                width: 14px;
                height: 14px;
            }

            .hero-stat-num {
                font-size: 13px;
            }

            .hero-stat-label {
                font-size: 9px;
            }

            .hero-dots {
                bottom: 16px;
                gap: 8px;
            }

            .hero-dot {
                width: 28px;
                height: 4px;
            }
        }

        /* Mobile Portrait (480px - 639px) */
        @media (max-width:480px) {
            .hero-carousel {
                height: 55vh;
                min-height: 350px;
                max-height: 480px;
            }

            .hero-content {
                padding: 0 20px
            }

            .hero-title {
                font-size: 24px;
                margin-bottom: 10px;
                font-weight: 700;
                line-height: 1.2;
            }

            .hero-eyebrow {
                font-size: 10px;
                padding: 6px 10px;
                margin-bottom: 12px;
            }

            .hero-eyebrow svg {
                width: 12px;
                height: 12px;
            }

            .hero-subtitle {
                font-size: 12px;
                margin-bottom: 16px;
                line-height: 1.5;
            }

            .hero-cta-group {
                margin-bottom: 16px;
                gap: 8px;
                flex-direction: column;
            }

            .hero-btn {
                padding: 10px 16px;
                font-size: 11px;
                width: 100%;
                justify-content: center;
            }

            .hero-btn svg {
                width: 12px;
                height: 12px;
            }

            .hero-stats {
                gap: 12px;
                font-size: 12px;
            }

            .hero-stat {
                gap: 6px;
            }

            .hero-stat-icon {
                width: 28px;
                height: 28px;
                min-width: 28px;
            }

            .hero-stat-icon svg {
                width: 12px;
                height: 12px;
            }

            .hero-stat-num {
                font-size: 12px;
            }

            .hero-stat-label {
                font-size: 8px;
            }

            .hero-dots {
                bottom: 12px;
                gap: 6px;
            }

            .hero-dot {
                width: 24px;
                height: 3px;
            }
        }

        /* Small Mobile (320px - 479px) */
        @media (max-width:380px) {
            .hero-carousel {
                height: 52vh;
                min-height: 320px;
            }

            .hero-content {
                padding: 0 16px;
            }

            .hero-title {
                font-size: 20px;
                margin-bottom: 8px;
            }

            .hero-eyebrow {
                font-size: 9px;
                padding: 5px 8px;
                margin-bottom: 10px;
            }

            .hero-subtitle {
                font-size: 11px;
                margin-bottom: 14px;
            }

            .hero-cta-group {
                margin-bottom: 14px;
                gap: 6px;
            }

            .hero-btn {
                padding: 9px 14px;
                font-size: 10px;
            }

            .hero-stats {
                display: none;
            }
        }

        /* ===== PAGE LAYOUT ===== */
        .page-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px 60px;
            overflow-x: hidden;
        }

        /* ===== SHARED SECTION HEADERS (used by why-us / video / testimonials) ===== */
        .section-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--sky-light);
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            padding: 7px 16px;
            border-radius: 30px;
            margin-bottom: 14px;
            letter-spacing: .3px;
            border: 1px solid var(--border);
        }

        .section-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.3;
            margin-bottom: 14px;
        }

        .section-subtitle {
            font-size: 15px;
            color: var(--gray);
            line-height: 1.8;
            max-width: 560px;
        }

        .center {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        /* =========================================================
               WHY US SECTION
            ========================================================= */
        .why-us-section {
            padding: 70px 20px;
            max-width: 1400px;
            margin: 0 auto;
            overflow: hidden;
        }

        .why-us-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 60px;
            align-items: center;
        }

        .why-us-visual {
            position: relative;
        }

        .why-us-glow {
            position: absolute;
            inset: -30px;
            background: radial-gradient(circle at 30% 30%, rgba(0, 180, 216, .18), transparent 60%);
            z-index: 0;
        }

        .why-us-visual img {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 30px 60px rgba(0, 71, 119, .25);
        }

        .why-us-badge {
            position: absolute;
            z-index: 2;
            background: #fff;
            border-radius: 14px;
            padding: 12px 18px;
            box-shadow: 0 12px 30px rgba(0, 71, 119, .18);
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid var(--border);
        }

        .why-us-badge-1 {
            top: 24px;
            right: -18px;
        }

        .why-us-badge-2 {
            bottom: 24px;
            left: -18px;
        }

        .badge-num {
            font-size: 18px;
            font-weight: 900;
            color: var(--primary);
        }

        .badge-label {
            font-size: 11px;
            color: var(--gray);
            font-weight: 700;
            margin-top: 2px;
        }

        .why-us-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin: 26px 0 30px;
        }

        .why-us-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .why-us-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            flex-shrink: 0;
            background: var(--sky-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .why-us-icon svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .why-us-item h3 {
            font-size: 15px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .why-us-item p {
            font-size: 13px;
            color: var(--gray);
            line-height: 1.7;
        }

        .why-us-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: #fff;
            font-weight: 800;
            font-size: 14px;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(0, 119, 182, .3);
            transition: all .25s ease;
        }

        .why-us-cta:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width:900px) {
            .why-us-wrapper {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .why-us-visual img {
                height: 300px;
            }

            .why-us-badge {
                padding: 9px 14px;
            }

            .why-us-badge-1 {
                right: 8px;
            }

            .why-us-badge-2 {
                left: 8px;
            }
        }

        @media (max-width:520px) {
            .why-us-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 24px;
            }

            .why-us-badge-1 {
                right: 8px;
                top: 12px;
            }

            .why-us-badge-2 {
                left: 8px;
                bottom: 12px;
            }
        }

        /* =========================================================
               VIDEO SECTION
            ========================================================= */
        .video-section {
            padding: 70px 20px;
            background: linear-gradient(180deg, #F0FAFF, #fff);
        }

        .video-wrapper {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .video-frame {
            position: relative;
            margin-top: 36px;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 16/9;
            background: #000;
            box-shadow: 0 25px 60px rgba(0, 71, 119, .25);
            cursor: pointer;
        }

        .video-frame img.video-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: .85;
            transition: opacity .3s ease;
        }

        .video-frame:hover img.video-thumb {
            opacity: .65;
        }

        .video-frame iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
            transition: all .25s ease;
        }

        .video-frame:hover .video-play-btn {
            background: var(--accent);
            transform: translate(-50%, -50%) scale(1.08);
        }

        .video-play-btn svg {
            width: 28px;
            height: 28px;
            fill: var(--primary);
            margin-right: -3px;
        }

        .video-frame:hover .video-play-btn svg {
            fill: #fff;
        }

        @media (max-width:520px) {
            .video-play-btn {
                width: 60px;
                height: 60px;
            }

            .video-play-btn svg {
                width: 22px;
                height: 22px;
            }
        }

        /* =========================================================
               TESTIMONIALS SECTION
            ========================================================= */
        .testimonials-section {
            padding: 70px 20px 90px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .testimonials-head {
            margin-bottom: 36px;
        }

        .testi-carousel-wrapper {
            position: relative;
        }

        .testi-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 26px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin: 10px 4px;
        }

        .testi-quote-icon {
            color: var(--sky-mid);
            width: 30px;
            height: 30px;
        }

        .testi-quote-icon svg {
            width: 100%;
            height: 100%;
            fill: currentColor;
        }

        .testi-stars {
            display: flex;
            gap: 3px;
        }

        .testi-stars svg {
            width: 15px;
            height: 15px;
            fill: var(--warning);
        }

        .testi-text {
            font-size: 13.5px;
            color: var(--dark);
            line-height: 1.9;
            flex: 1;
        }

        .testi-person {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
        }

        .testi-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-weight: 800;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .testi-name {
            font-size: 13.5px;
            font-weight: 800;
            color: var(--dark);
        }

        .testi-city {
            font-size: 11.5px;
            color: var(--gray);
            font-weight: 600;
        }

        .testi-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid var(--border);
            color: var(--primary);
            box-shadow: 0 8px 20px rgba(0, 71, 119, .12);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
            transition: all .2s ease;
        }

        .testi-arrow:hover {
            background: var(--primary);
            color: #fff;
        }

        .testi-arrow svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.3;
        }

        .testi-arrow-prev {
            right: -22px;
        }

        .testi-arrow-next {
            left: -22px;
        }

        /* Owl Carousel Custom Dots Styling */
        .owl-theme .owl-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 26px;
        }

        .owl-theme .owl-dots .owl-dot {
            background: none;
            border: none;
            padding: 0;
            outline: none;
        }

        .owl-theme .owl-dots .owl-dot span {
            display: block;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--border);
            transition: all .2s ease;
            margin: 0;
        }

        .owl-theme .owl-dots .owl-dot.active span {
            background: var(--primary);
            width: 24px;
            border-radius: 5px;
        }

        @media (max-width:992px) {
            .testi-arrow-prev {
                right: 0;
            }

            .testi-arrow-next {
                left: 0;
            }
        }

        @media (max-width:640px) {
            .testi-arrow {
                display: none;
            }
        }

        /* ===== SEARCH BOX ===== */
        .search-box {
            background: linear-gradient(rgba(0, 119, 182, 0.85), rgba(0, 119, 182, 0.85)), url('https://images.unsplash.com/photo-1530521954074-e64f6810b32d?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 119, 182, 0.2);
            margin-bottom: 40px;
            border: none;
            color: #fff;
            position: relative;
            overflow: visible;
        }

        .search-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-title svg {
            width: 28px;
            height: 28px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .search-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative
        }

        .form-group label {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 8px;
            letter-spacing: .3px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .form-group input,
        .form-group select,
        .passengers-selector {
            padding: 14px 16px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            transition: all .25s ease;
            background: rgba(255, 255, 255, 0.98);
            color: var(--dark);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .passengers-selector {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group input:hover,
        .form-group select:hover,
        .passengers-selector:hover {
            border-color: #fff;
            background: #fff;
            transform: translateY(-2px);
        }

        .form-group input:focus,
        .form-group select:focus,
        .passengers-selector.active {
            outline: none;
            border-color: #fff;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.25);
            background: #fff;
        }

        /* Passengers Dropdown */
        .passengers-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            padding: 20px;
            z-index: 100;
            animation: fadeInUp 0.3s ease-out;
            border: 1px solid var(--border);
        }

        .passengers-dropdown.show {
            display: block;
        }

        /* Autocomplete Styles */
        .autocomplete-group {
            position: relative;
        }
        .autocomplete-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            margin-top: 5px;
        }
        .autocomplete-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .autocomplete-item:hover, .autocomplete-item.active {
            background: #f3f8fc;
        }
        .autocomplete-main {
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
        }
        .autocomplete-sub {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .autocomplete-iata {
            background: #e5e7eb;
            color: #374151;
            padding: 1px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .autocomplete-loader {
            padding: 12px;
            text-align: center;
            font-size: 12px;
            color: #999;
            background: #fff;
        }
        .autocomplete-no-results {
            padding: 12px;
            text-align: center;
            font-size: 13px;
            color: #666;
            background: #fff;
        }

        .passenger-type-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .passenger-type-row:last-child {
            margin-bottom: 0;
        }

        .passenger-info h4 {
            font-size: 14px;
            color: var(--primary);
            margin-bottom: 2px;
        }

        .passenger-info span {
            font-size: 11px;
            color: var(--gray);
        }

        .counter-control {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .counter-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: #fff;
            color: var(--primary);
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .counter-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }

        .counter-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .counter-value {
            font-weight: 800;
            font-size: 16px;
            color: var(--dark);
            min-width: 20px;
            text-align: center;
        }

        /* ===== SEARCH BUTTON ===== */
        .search-btn {
            padding: 14px 32px;
            background: var(--secondary);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all .3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            align-self: flex-end;
            box-shadow: 0 8px 25px rgba(0, 180, 216, 0.4);
            min-height: 52px;
            position: relative;
            outline-offset: 2px;
            margin-top: 5px;
        }

        .search-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 119, 182, 0.5);
        }

        .search-btn:active {
            transform: translateY(0);
        }

        .search-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .search-btn.loading {
            pointer-events: none;
            background: var(--primary-dark);
        }

        .btn-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        .search-btn.loading .btn-spinner {
            display: inline-block
        }

        .search-btn.loading .search-icon,
        .search-btn.loading span:not(.btn-spinner) {
            display: none
        }

        .search-icon {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* ===== FLIGHTS GRID ===== */
        .flights-grid {
            display: flex;
            flex-direction: column;
            gap: 24px
        }

        .flight-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all .4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid var(--border);
            position: relative;
        }

        .flight-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: url('https://www.transparenttextures.com/patterns/pinstripe-light.png');
            opacity: 0.05;
            pointer-events: none;
        }

        .flight-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 119, 182, 0.15);
            border-color: var(--primary);
        }

        .card-header {
            background: linear-gradient(to left, #F0FAFF, #fff);
            padding: 24px 30px;
            border-bottom: 1px dashed var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .route-info {
            display: flex;
            align-items: center;
            gap: 24px
        }

        .airport-code {
            font-size: 24px;
            font-weight: 900;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .route-arrow {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--secondary);
            position: relative;
        }

        .route-arrow svg {
            width: 32px;
            height: 32px;
            stroke: var(--secondary)
        }

        .route-arrow::after {
            content: '✈';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
        }

        .price-box {
            background: var(--primary);
            padding: 12px 20px;
            border-radius: 15px;
            color: #fff;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 119, 182, 0.2);
        }

        .price-value {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
        }

        .price-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .card-body {
            padding: 24px 30px
        }

        .flight-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .meta-icon-wrapper {
            width: 40px;
            height: 40px;
            background: var(--sky-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .meta-details {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 11px;
            color: var(--gray);
            font-weight: 700;
            margin-bottom: 2px;
        }

        .meta-value {
            font-size: 14px;
            color: var(--dark);
            font-weight: 800;
        }

        .booking-section {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ===== RESPONSIVE FIXES & MOBILE OPTIMIZATION ===== */
        @media (max-width: 768px) {
            .page-wrapper {
                padding: 15px 10px 40px;
            }

            .search-box {
                padding: 25px 20px;
                border-radius: 15px;
                margin-bottom: 25px;
            }

            .search-title {
                font-size: 20px;
                margin-bottom: 20px;
            }

            .search-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .search-btn {
                width: 100%;
                margin-top: 10px;
                min-height: 55px;
                font-size: 18px;
            }

            .section-title {
                font-size: 26px;
            }

            .flight-card {
                border-radius: 15px;
            }

            .card-header {
                padding: 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .route-info {
                width: 100%;
                justify-content: space-between;
            }

            .airport-code {
                font-size: 20px;
            }

            .price-box {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 20px;
            }

            .price-value {
                font-size: 20px;
            }

            .price-label {
                margin-top: 0;
            }

            .card-body {
                padding: 20px;
            }

            .flight-meta {
                grid-template-columns: 1fr;
                gap: 15px;
                margin-bottom: 20px;
                padding-bottom: 20px;
            }

            .booking-section {
                flex-direction: column;
                width: 100%;
            }

            .ticket-code {
                width: 100%;
                text-align: center;
            }

            .whatsapp-btn {
                width: 100%;
                justify-content: center;
                padding: 15px;
                font-size: 16px;
            }

            /* Float WhatsApp Button for Leads */
            .sticky-whatsapp {
                width: 55px;
                height: 55px;
                bottom: 15px;
                right: 15px;
            }
        }

        @media (max-width: 480px) {
            .airport-code {
                font-size: 18px;
            }

            .why-us-visual img {
                height: 250px;
            }

            .section-title {
                font-size: 22px;
            }
        }

        .ticket-code {
            flex: 1;
            min-width: 180px;
            padding: 12px 18px;
            background: var(--light);
            border-radius: 12px;
            border: 2px dashed var(--border);
        }

        .code-label {
            font-size: 11px;
            color: var(--gray);
            font-weight: 700;
            margin-bottom: 4px;
        }

        .code-value {
            font-size: 15px;
            color: var(--primary);
            font-weight: 900;
            font-family: 'Monaco', 'Consolas', monospace;
        }

        /* Custom Alert for Babies Validation */
        .validation-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: none;
            align-items: center;
            gap: 12px;
            z-index: 10000;
            border-right: 5px solid var(--danger);
            animation: slideInDown 0.3s ease-out;
        }

        .validation-alert.show {
            display: flex;
        }

        .validation-alert-icon {
            color: var(--danger);
            font-size: 24px;
        }

        .validation-alert-text {
            font-weight: 700;
            color: var(--dark);
            font-size: 14px;
        }


        /* ===== WHATSAPP BUTTON ===== */
        .whatsapp-btn {
            flex: 2;
            min-width: 160px;
            padding: 12px 20px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(39, 174, 96, .25);
            min-height: 44px;
            outline-offset: 2px;
        }

        .whatsapp-btn:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(39, 174, 96, .35);
        }

        .whatsapp-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(39, 174, 96, .25);
        }

        .whatsapp-btn:focus {
            outline: 3px solid rgba(39, 174, 96, .5);
            background: #229954;
        }

        .whatsapp-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0
        }

        /* ===== SUGGESTIONS ===== */
        .suggestions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            align-items: center;
        }

        .suggestion-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 700;
            white-space: nowrap;
        }

        .suggestion-btn {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            font-size: 12px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
        }

        .suggestion-btn:hover {
            background: #fff;
            color: var(--primary);
        }

        /* ===== FILTERS ===== */
        .filter-bar {
            display: none;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .filter-bar.active {
            display: flex
        }

        .filter-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
            white-space: nowrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid var(--border);
            background: #fff;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            transition: all .2s ease;
            color: var(--dark);
            outline-offset: 2px;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary)
        }

        .filter-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* ===== NO RESULTS ===== */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .no-results h2 {
            font-size: 18px;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .no-results p {
            margin-bottom: 16px;
            line-height: 1.6
        }

        .no-results a {
            color: var(--accent);
            font-weight: 700;
            text-decoration: none;
            transition: color .2s ease;
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
        }

        .no-results a:hover {
            color: #fff;
            background: var(--accent)
        }

        .no-results a:focus {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeInUp .3s ease-out;
        }

        .modal-overlay.open {
            display: flex
        }

        .modal-box {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .25);
            direction: rtl;
            text-align: right;
            animation: scaleIn .3s ease-out;
        }

        .modal-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .modal-box h2 {
            margin: 0;
            color: var(--primary);
            font-size: 19px;
            font-weight: 800;
        }

        .modal-box p {
            font-size: 13px;
            color: var(--gray);
            margin-bottom: 22px;
            line-height: 1.7;
        }

        .modal-box .form-group {
            margin-bottom: 20px
        }

        .modal-box .form-group label {
            color: var(--dark);
            text-shadow: none;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
        }

        .modal-box .form-group input {
            border: 2px solid var(--border);
            background: #f8f9fa;
            color: var(--dark);
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .modal-box .form-group input:hover {
            border-color: var(--primary);
            background: #fff;
            transform: none;
        }

        .modal-box .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.15);
            background: #fff;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .btn-cancel {
            background: #f1f3f5;
            color: #495057;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            border: 1px solid #e9ecef;
            cursor: pointer;
            font-size: 13px;
            transition: all .2s ease;
            outline-offset: 2px;
        }

        .btn-cancel:hover {
            background: #e2e6ea;
            border-color: #dee2e6
        }

        .btn-cancel:focus {
            outline: 2px solid #495057;
        }

        .btn-confirm {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-size: 13px;
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all .2s ease;
            outline-offset: 2px;
        }

        .btn-confirm:hover {
            background: #229954;
            transform: translateY(-1px)
        }

        .btn-confirm:focus {
            outline: 3px solid rgba(39, 174, 96, .5);
            background: #229954;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width:768px) {
            .search-grid {
                grid-template-columns: 1fr 1fr
            }

            .search-btn {
                grid-column: span 2;
                width: 100%
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start
            }

            .booking-section {
                flex-direction: column;
                width: 100%
            }

            .whatsapp-btn,
            .ticket-code {
                width: 100%;
                min-width: unset
            }
        }

        @media (max-width:480px) {
            .page-wrapper {
                padding: 20px 16px 50px
            }

            .search-box {
                padding: 20px 16px
            }

            .search-title {
                font-size: 18px;
                gap: 8px
            }

            .search-grid {
                grid-template-columns: 1fr;
                gap: 12px
            }

            .search-btn {
                grid-column: span 1
            }

            .card-body {
                padding: 12px 16px
            }

            .flight-meta {
                gap: 16px
            }

            .modal-box {
                padding: 20px
            }
        }

        @media (prefers-reduced-motion:reduce) {
            * {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important
            }
        }

        /* ===== ACCESSIBILITY ===== */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        :focus {
            outline: 3px solid var(--primary);
            outline-offset: 2px
        }

        button:focus,
        a:focus,
        .filter-btn:focus,
        .suggestion-btn:focus,
        .search-btn:focus,
        .whatsapp-btn:focus {
            outline: 3px solid var(--primary) !important;
            outline-offset: 2px;
        }

        /* Flatpickr Custom Sky Blue Styling */
        .flatpickr-calendar {
            border-radius: 15px;
            box-shadow: 0 15px 45px rgba(0, 119, 182, 0.15);
            border: 1px solid var(--border);
            font-family: inherit;
            background: #fff;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .flatpickr-day:hover {
            background: var(--sky-light) !important;
        }

        .flatpickr-months .flatpickr-month {
            background: var(--primary);
            color: #fff;
            fill: #fff;
            border-radius: 15px 15px 0 0;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: var(--primary);
        }

        .flatpickr-weekdays {
            background: var(--primary);
        }

        span.flatpickr-weekday {
            background: var(--primary);
            color: rgba(255, 255, 255, 0.9);
        }

        /* =========================================================
               EXCLUSIVE HEADING SECTION
            ========================================================= */
        .exclusive-header-section {
            background: linear-gradient(180deg, #F0FAFF 0%, #FFFFFF 100%);
            padding: 40px 20px 20px 20px;
            text-align: center;
            position: relative;
        }

        .exclusive-header-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .exclusive-title {
            font-size: 36px;
            font-weight: 850;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .exclusive-subtitle {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(39, 174, 96, 0.08);
            padding: 6px 16px;
            border-radius: 50px;
            border: 1px dashed rgba(39, 174, 96, 0.3);
        }

        @media (max-width: 768px) {
            .exclusive-title {
                font-size: 28px;
            }

            .exclusive-subtitle {
                font-size: 16px;
                padding: 4px 12px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

    <!-- Validation Alert -->
    <div class="validation-alert" id="validationAlert">
        <div class="validation-alert-icon">⚠️</div>
        <div class="validation-alert-text" id="validationAlertText"></div>
    </div>

    <!-- EXCLUSIVE HEADING SECTION -->
    <div class="exclusive-header-section">
        <div class="exclusive-header-container">
            <h2 class="exclusive-title">أسعار تذاكر طيران حصرية</h2>
            <p class="exclusive-subtitle">متاحة فقط لـ مُسافرينا</p>
        </div>
    </div>

    <div class="page-wrapper" style="padding-top: 10px; padding-bottom: 20px;">
        <!-- SEARCH SECTION -->
        <section aria-labelledby="search-heading">
            <div class="search-box">
                <h2 id="search-heading" class="search-title">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    ابحث عن تذكرتك
                </h2>

                <div class="search-grid" role="search" aria-label="نموذج البحث عن الرحلات">
                    <div class="form-group autocomplete-group" id="fromCityAutocomplete">
                        <label for="from_city_search">من * <span class="sr-only">(نقطة المغادرة)</span></label>
                        <input type="text" id="from_city_search" class="autocomplete-input" placeholder="اختر مدينة المغادرة *" autocomplete="off" required>
                        <input type="hidden" id="from_city_id" name="from_city_id">
                        <div class="autocomplete-dropdown" style="display: none;">
                            <div class="autocomplete-results"></div>
                            <div class="autocomplete-loader" style="display: none;">جاري التحميل...</div>
                        </div>
                    </div>

                    <div class="form-group autocomplete-group" id="toCityAutocomplete">
                        <label for="to_city_search">إلى * <span class="sr-only">(نقطة الوصول)</span></label>
                        <input type="text" id="to_city_search" class="autocomplete-input" placeholder="اختر مدينة الوصول *" autocomplete="off" required>
                        <input type="hidden" id="to_city_id" name="to_city_id">
                        <div class="autocomplete-dropdown" style="display: none;">
                            <div class="autocomplete-results"></div>
                            <div class="autocomplete-loader" style="display: none;">جاري التحميل...</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="trip_type">نوع الرحلة</label>
                        <select id="trip_type" name="trip_type" aria-label="نوع الرحلة">
                            <option value="one_way">ذهاب فقط</option>
                            <option value="round_trip">ذهاب وعودة</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="flightDate">تاريخ السفر *</label>
                        <input type="text" id="flightDate" name="flightDate" placeholder="اختر تاريخ السفر *"
                            aria-label="تاريخ المغادرة" readonly required>
                    </div>

                    <div class="form-group" id="returnDateGroup" style="display:none;">
                        <label for="returnDate">تاريخ العودة *</label>
                        <input type="text" id="returnDate" name="return_date" placeholder="اختر تاريخ العودة *"
                            aria-label="تاريخ العودة" readonly>
                    </div>

                    <!-- New Passengers Dropdown -->
                    <div class="form-group">
                        <label>عدد الركاب</label>
                        <div class="passengers-selector" id="passengersSelector" onclick="togglePassengersDropdown(event)" role="button" aria-expanded="false" aria-controls="passengersDropdown" tabindex="0">
                            <span id="passengersSummary">1 كبير </span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width:16px;height:16px"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                        </div>
                        
                        <div class="passengers-dropdown" id="passengersDropdown">
                            <div class="passenger-type-row">
                                <div class="passenger-info">
                                    <h4>كبار</h4>
                                    <span>بعمر 12 سنة وما فوق</span>
                                </div>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn" onclick="updateCounter('adults', -1, event)">-</button>
                                    <span id="adultsCount">1</span>
                                    <button type="button" class="counter-btn" onclick="updateCounter('adults', 1, event)">+</button>
                                </div>
                                <input type="hidden" name="number_of_adults" id="number_of_adults" value="1">
                            </div>
                            
                            <div class="passenger-type-row">
                                <div class="passenger-info">
                                    <h4>أطفال</h4>
                                    <span>بعمر 2-12 سنة</span>
                                </div>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn" onclick="updateCounter('children', -1, event)">-</button>
                                    <span id="childrenCount">0</span>
                                    <button type="button" class="counter-btn" onclick="updateCounter('children', 1, event)">+</button>
                                </div>
                                <input type="hidden" name="number_of_children" id="number_of_children" value="0">
                            </div>
                            
                            <div class="passenger-type-row">
                                <div class="passenger-info">
                                    <h4>رضع</h4>
                                    <span>تحت عمر سنتين</span>
                                </div>
                                <div class="counter-control">
                                    <button type="button" class="counter-btn" onclick="updateCounter('babies', -1, event)">-</button>
                                    <span id="babiesCount">0</span>
                                    <button type="button" class="counter-btn" onclick="updateCounter('babies', 1, event)">+</button>
                                </div>
                                <input type="hidden" name="number_of_babies" id="number_of_babies" value="0">
                            </div>
                            
                            <button type="button" class="btn-primary" style="width:100%;margin-top:15px;padding:8px" onclick="togglePassengersDropdown(event)">تم</button>
                        </div>
                    </div>

                    <button class="search-btn" id="searchBtn" onclick="performSearch()" aria-label="بحث عن الرحلات">
                        <span class="btn-spinner" aria-hidden="true"></span>
                        <svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <span>بحث</span>
                    </button>
                </div>

                <div class="suggestions" aria-label="وجهات شائعة">
                    <span class="suggestion-label">وجهات شائعة:</span>
                    @forelse($cities->where('can_be_to', true)->take(5) as $city)
                        <button class="suggestion-btn" onclick="selectDestination('{{ $city->id }}', '{{ $city->name }}')"
                            aria-label="اختر وجهة {{ $city->name }}">
                            {{ $city->name }}
                        </button>
                    @empty
                        <span style="font-size:12px;color:var(--gray)">لا توجد وجهات متاحة</span>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- FILTERS SECTION -->
        <div class="filter-bar" id="filterWrapper" role="group" aria-label="خيارات ترتيب النتائج">
            <span class="filter-label">ترتيب:</span>
            <button class="filter-btn active" onclick="sortResults('all',this)" aria-label="عرض جميع النتائج">الكل</button>
            <button class="filter-btn" onclick="sortResults('price',this)" aria-label="ترتيب حسب السعر">الأقل سعرًا</button>
            <button class="filter-btn" onclick="sortResults('date',this)" aria-label="ترتيب حسب التاريخ">الأقرب
                تاريخاً</button>
        </div>

        <!-- RESULTS SECTION -->
        <section aria-labelledby="results-heading" aria-live="polite" aria-busy="false">
            <h2 id="results-heading" class="sr-only">نتائج الرحلات</h2>
            <div class="flights-grid" id="flightsGrid" role="list"></div>
        </section>
    </div>

    <!-- =========================================================
             FULL-SCREEN MARKETING CAROUSEL (header)
        ========================================================= -->
    <section class="hero-carousel" id="heroCarousel" aria-roledescription="carousel" aria-label="أبرز عروض سوبك ترافيل">
        <div class="hero-track" id="heroTrack">

            <!-- SLIDE 1: Booking with EGP -->
            <div class="hero-slide active" data-index="0" role="group" aria-roledescription="slide" aria-label="1 من 6">
                <div class="slide-bg" style="background-image:url('/egp_payment.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                        خيارات دفع مرنة ومتنوعة
                    </span>
                    <h1 class="hero-title">الحجز <span class="accent-word">بالجنية المصري</span></h1>
                    <p class="hero-subtitle">نسهل عليك طرق الدفع لجميع رحلاتك، يمكنك الدفع مباشرة عبر الطرق التالية:</p>
                    <div class="hero-cta-group" style="margin-top: 10px;">
                        <a href="#search-heading" class="hero-btn hero-btn-primary">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            ابحث عن تذكرتك الآن
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="M2 10h20" />
                                </svg></span>
                            <span><span class="hero-stat-num">كاش &amp; فيزا</span><br><span class="hero-stat-label">الدفع
                                    بالبطاقات البنكية</span></span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                </svg></span>
                            <span><span class="hero-stat-num">إنستاباي &amp; محفظة</span><br><span
                                    class="hero-stat-label">فودافون كاش وتحويل فوري</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: Egyptian Travel Company -->
            <div class="hero-slide" data-index="1" role="group" aria-roledescription="slide" aria-label="2 من 6">
                <div class="slide-bg" style="background-image:url('/pyramids_plane.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        خبرة عريقة ومصداقية تامة
                    </span>
                    <h2 class="hero-title">شركة سياحة <span class="accent-word">مصرية مرخصة</span></h2>
                    <p class="hero-subtitle">سوبك ترافيل حاصلة على ترخيص سياحة عامة فئة (أ) لتقديم خدمات السفر المتكاملة
                        بأعلى معايير الجودة والضمان منذ عام ١٩٨٧م.</p>
                    <div class="hero-cta-group" style="margin-top: 10px;">
                        <a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer"
                            class="hero-btn hero-btn-whatsapp">
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="fill:currentColor;stroke:none">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            تواصل معنا عبر واتساب
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg></span>
                            <span><span class="hero-stat-num">منذ عام ١٩٨٧م</span><br><span class="hero-stat-label">أكثر من
                                    35 عاماً من الخبرة</span></span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg></span>
                            <span><span class="hero-stat-num">ترخيص عامة فئة أ</span><br><span class="hero-stat-label">ترخيص
                                    رسمي رقم ٦٧٨</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: Branches -->
            <div class="hero-slide" data-index="2" role="group" aria-roledescription="slide" aria-label="3 من 6">
                <div class="slide-bg" style="background-image:url('/travel_office.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2a10 10 0 0 0-10 10c0 5.25 10 12 10 12s10-6.75 10-12a10 10 0 0 0-10-10z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        متواجدون دائماً بالقرب منك
                    </span>
                    <h2 class="hero-title">فروعنا في <span class="accent-word">أنحاء الجمهورية</span></h2>
                    <p class="hero-subtitle">يسعدنا استقبالكم في أي من فروعنا لتقديم أفضل الخدمات والحلول السياحية وحجوزات
                        الطيران:</p>
                    <div class="hero-stats"
                        style="grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); margin-top: 15px;">
                        <div class="hero-stat">
                            <span><span class="hero-stat-num">القاهرة الكبرى</span><br><span
                                    class="hero-stat-label">المهندسين · ٦ أكتوبر · حلوان</span></span>
                        </div>
                        <div class="hero-stat">
                            <span><span class="hero-stat-num">المحافظات</span><br><span class="hero-stat-label">الغردقة ·
                                    الفيوم</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDE 4: Free Preliminary Booking -->
            <div class="hero-slide" data-index="3" role="group" aria-roledescription="slide" aria-label="4 من 6">
                <div class="slide-bg" style="background-image:url('/booking_confirm.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        خطط لرحلتك بدون ضغوط
                    </span>
                    <h2 class="hero-title">حجز <span class="accent-word">مبدئي مجاني</span></h2>
                    <p class="hero-subtitle">احجز مقعدك على الرحلة الآن مجاناً وبدون أي التزام مالي فوري، ورتب أمورك بكل
                        أريحية قبل تأكيد الحجز والدفع النهائي.</p>
                    <div class="hero-cta-group" style="margin-top: 10px;">
                        <a href="#search-heading" class="hero-btn hero-btn-primary">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            ابدأ البحث عن رحلتك
                        </a>
                    </div>
                </div>
            </div>

            <!-- SLIDE 5: Ticket Modifications -->
            <div class="hero-slide" data-index="4" role="group" aria-roledescription="slide" aria-label="5 من 6">
                <div class="slide-bg" style="background-image:url('/travel_luggage.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67" />
                        </svg>
                        مرونة كاملة في خطط سفرك
                    </span>
                    <h2 class="hero-title">تعديلات مرنة <span class="accent-word">على التكت</span></h2>
                    <p class="hero-subtitle">تغيرت خططك؟ لا تقلق إطلاقاً. يمكنك طلب تعديل موعد الرحلة أو تفاصيل التذكرة
                        بسهولة حتى قبل موعد السفر بـ ٧٢ ساعة.</p>
                    <div class="hero-cta-group" style="margin-top: 10px;">
                        <a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer"
                            class="hero-btn hero-btn-whatsapp">
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="fill:currentColor;stroke:none">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            استفسر عن الشروط والتعديل
                        </a>
                    </div>
                </div>
            </div>

            <!-- SLIDE 6: Customer Service via WhatsApp -->
            <div class="hero-slide" data-index="5" role="group" aria-roledescription="slide" aria-label="6 من 6">
                <div class="slide-bg" style="background-image:url('/airport_chat.png')"></div>
                <div class="slide-overlay"></div>
                <div class="hero-content">
                    <span class="hero-eyebrow">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        دعم فوري متواصل طوال الأسبوع
                    </span>
                    <h2 class="hero-title">خدمة عملاء <span class="accent-word">عبر الواتساب</span></h2>
                    <p class="hero-subtitle">يسعدنا خدمتكم والإجابة على كافة استفساراتكم ومساعدتكم في إنهاء إجراءات حجزكم
                        على مدار ٧ أيام في الأسبوع.</p>
                    <div class="hero-cta-group" style="margin-top: 10px;">
                        <a href="https://wa.me/201110073052" target="_blank" rel="noopener noreferrer"
                            class="hero-btn hero-btn-whatsapp">
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="fill:currentColor;stroke:none">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            تواصل معنا فورا
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                </svg></span>
                            <span><span class="hero-stat-num">٧ أيام أسبوعياً</span><br><span class="hero-stat-label">خدمة
                                    سريعة وموثوقة</span></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ARROWS -->
        <button class="hero-arrow hero-arrow-prev" id="heroPrev" aria-label="الشريحة السابقة">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 18l6-6-6-6" />
            </svg>
        </button>
        <button class="hero-arrow hero-arrow-next" id="heroNext" aria-label="الشريحة التالية">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </button>

        <!-- DOTS -->
        <div class="hero-dots" id="heroDots" role="tablist" aria-label="اختيار الشريحة"></div>
    </section>

    <div class="page-wrapper">

        @include('partials.home-extra-sections')
    </div>

    <!-- BOOKING MODAL -->
    <div class="modal-overlay" id="bookingModal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-box">
            <div class="modal-header">
                <h2 id="modal-title">تأكيد حجز التذكرة</h2>
            </div>
            <p>أدخل اسم المسافر الكامل وسنحولك فوراً إلى واتساب لإتمام الحجز.</p>
            <div class="form-group">
                <label for="modalFullName">اسم المسافر الكامل *</label>
                <input type="text" id="modalFullName" placeholder="مثال: أحمد محمد علي"
                    onkeydown="if(event.key==='Enter') submitBookingToWhatsapp()" aria-label="أدخل اسم المسافر الكامل">
            </div>
            <div class="form-group">
                <label for="modalEmail">البريد الإلكتروني *</label>
                <input type="email" id="modalEmail" placeholder="مثال: name@example.com"
                    onkeydown="if(event.key==='Enter') submitBookingToWhatsapp()" aria-label="أدخل البريد الإلكتروني">
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeBookingModal()" aria-label="إغلق النموذج بدون حفظ">إلغاء</button>
                <button class="btn-confirm" onclick="submitBookingToWhatsapp()" aria-label="متابعة الحجز عبر واتساب">
                    <svg viewBox="0 0 24 24" aria-hidden="true" style="width:16px;height:16px;fill:currentColor">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    <span>متابعة عبر واتساب</span>
                </button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

    <!-- jQuery + Owl Carousel (loaded once, only here, for the testimonials section) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#flightDate", {
                minDate: "today",
                locale: "ar",
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr) {
                    if (window.returnFp) {
                        window.returnFp.set('minDate', dateStr);
                    }
                }
            });

            window.returnFp = flatpickr("#returnDate", {
                minDate: "today",
                locale: "ar",
                dateFormat: "Y-m-d"
            });
        });

        (function () {
            // ===== YouTube facade (lazy-load on click for performance) =====
            var videoFrame = document.getElementById('videoFrame');
            if (videoFrame) {
                function loadVideo() {
                    var videoId = videoFrame.getAttribute('data-video-id');
                    var iframe = document.createElement('iframe');
                    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';
                    iframe.title = 'كيف تحجز معنا؟';
                    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                    iframe.allowFullscreen = true;
                    videoFrame.innerHTML = '';
                    videoFrame.appendChild(iframe);
                }
                videoFrame.addEventListener('click', loadVideo);
                videoFrame.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); loadVideo(); }
                });
            }

            // ===== Testimonials Owl Carousel =====
            var $carousel = $('#testiCarousel');
            if ($carousel.length) {
                $carousel.owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 22,
                    nav: false, // We use our custom buttons
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        640: {
                            items: 2
                        },
                        992: {
                            items: 3
                        }
                    }
                });

                // Custom Navigation events
                $('#testiNext').click(function () {
                    $carousel.trigger('next.owl.carousel');
                });
                $('#testiPrev').click(function () {
                    $carousel.trigger('prev.owl.carousel');
                });
            }
        }());
    </script>

    <script>
        var SEARCH_ROUTE = @json(route('tickets.search'));
        var WHATSAPP_ROUTE_TEMPLATE = @json(route('ticket.whatsapp', ['ticket' => 'TICKET_ID']));
    </script>
    <script>
        (function () {
            var rawTickets = [];
            var currentSort = 'all';
            var currentBookingTicket = null;
            var previousFocus = null;

            // --- Passengers Dropdown Logic ---
            window.togglePassengersDropdown = function (e) {
                e.stopPropagation();
                var dropdown = document.getElementById('passengersDropdown');
                var selector = document.getElementById('passengersSelector');
                dropdown.classList.toggle('show');
                selector.classList.toggle('active');
            };

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                var dropdown = document.getElementById('passengersDropdown');
                var selector = document.getElementById('passengersSelector');
                if (dropdown && !dropdown.contains(e.target) && !selector.contains(e.target)) {
                    dropdown.classList.remove('show');
                    selector.classList.remove('active');
                }
            });

            window.updateCounter = function (type, change, e) {
                e.stopPropagation();
                var countEl = document.getElementById(type + 'Count');
                var hiddenInput = document.getElementById('number_of_' + type);
                var currentVal = parseInt(countEl.innerText);
                var newVal = currentVal + change;

                // Minimum constraints
                if (type === 'adults' && newVal < 1) return;
                if (newVal < 0) return;

                // Validation: Babies <= Adults
                if (type === 'babies' && newVal > parseInt(document.getElementById('adultsCount').innerText)) {
                    showValidationError('يجب أن يكون عدد الرضيع مساوياً أو أقل من عدد الكبار');
                    return;
                }

                // Update UI and hidden input
                countEl.innerText = newVal;
                hiddenInput.value = newVal;

                // Update minus button state
                document.getElementById(type + 'Minus').disabled = (newVal === (type === 'adults' ? 1 : 0));

                updatePassengersSummary();
            };

            function updatePassengersSummary() {
                var adults = parseInt(document.getElementById('adultsCount').innerText);
                var children = parseInt(document.getElementById('childrenCount').innerText);
                var babies = parseInt(document.getElementById('babiesCount').innerText);

                var summary = adults + 'كبير ';
                if (children > 0) summary += ' · ' + children + ' أطفال';
                if (babies > 0) summary += ' · ' + babies + ' رضيع';

                document.getElementById('passengersSummary').innerText = summary;
            }

            function showValidationError(message) {
                var alertEl = document.getElementById('validationAlert');
                var textEl = document.getElementById('validationAlertText');
                textEl.innerText = message;
                alertEl.classList.add('show');
                setTimeout(function () {
                    alertEl.classList.remove('show');
                }, 4000);
            }

            function updateReturnDateVisibility() {
                var tripTypeSelect = document.getElementById('trip_type');
                var returnDateGroup = document.getElementById('returnDateGroup');
                var returnDateInput = document.getElementById('returnDate');

                if (!tripTypeSelect || !returnDateGroup || !returnDateInput) {
                    return;
                }

                if (tripTypeSelect.value === 'round_trip') {
                    returnDateGroup.style.display = '';
                    returnDateInput.required = true;
                } else {
                    returnDateGroup.style.display = 'none';
                    returnDateInput.required = false;
                    returnDateInput.value = '';
                }
            }

            // Initialize
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function () {
                    var tripTypeSelect = document.getElementById('trip_type');
                    if (tripTypeSelect) {
                        tripTypeSelect.addEventListener('change', updateReturnDateVisibility);
                    }
                    updateReturnDateVisibility();
                });
            } else {
                var tripTypeSelect = document.getElementById('trip_type');
                if (tripTypeSelect) {
                    tripTypeSelect.addEventListener('change', updateReturnDateVisibility);
                }
                updateReturnDateVisibility();
            }

            // ===== PUBLIC FUNCTIONS (called from inline HTML onclick) =====
            window.selectDestination = function (cityId, cityName) {
                document.getElementById('to_city_id').value = cityId;
                var toCitySearch = document.getElementById('to_city_search');
                if (toCitySearch) {
                    toCitySearch.value = cityName;
                }
                performSearch();
            };

            // --- City Autocomplete Logic ---
            function initCityAutocomplete(groupId, type) {
                var group = document.getElementById(groupId);
                if (!group) return;
                var input = group.querySelector('.autocomplete-input');
                var hiddenInput = group.querySelector('input[type="hidden"]');
                var dropdown = group.querySelector('.autocomplete-dropdown');
                var resultsContainer = group.querySelector('.autocomplete-results');
                var loader = group.querySelector('.autocomplete-loader');

                var currentPage = 1;
                var hasMore = false;
                var isLoading = false;
                var currentQuery = '';
                
                input.addEventListener('focus', function() {
                    dropdown.style.display = 'block';
                    if (resultsContainer.children.length === 0) {
                        loadCities(true);
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!group.contains(e.target)) {
                        dropdown.style.display = 'none';
                        if (!hiddenInput.value) {
                            input.value = '';
                        }
                    }
                });

                var debounceTimer;
                input.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    hiddenInput.value = '';
                    debounceTimer = setTimeout(function() {
                        currentQuery = input.value;
                        loadCities(true);
                    }, 300);
                });

                dropdown.addEventListener('scroll', function() {
                    if (isLoading || !hasMore) return;
                    if (dropdown.scrollTop + dropdown.clientHeight >= dropdown.scrollHeight - 20) {
                        currentPage++;
                        loadCities(false);
                    }
                });

                function loadCities(reset) {
                    if (isLoading) return;
                    isLoading = true;
                    loader.style.display = 'block';
                    
                    if (reset) {
                        currentPage = 1;
                        resultsContainer.innerHTML = '';
                        hasMore = false;
                    }

                    var url = '/cities/search-api?q=' + encodeURIComponent(currentQuery) + 
                              '&type=' + type + 
                              '&page=' + currentPage;

                    fetch(url)
                        .then(function(res) { return res.json(); })
                        .then(function(data) {
                            isLoading = false;
                            loader.style.display = 'none';
                            hasMore = data.more;
                            
                            if (data.items.length === 0 && reset) {
                                resultsContainer.innerHTML = '<div class="autocomplete-no-results">لا توجد نتائج</div>';
                                return;
                            }

                            data.items.forEach(function(city) {
                                var item = document.createElement('div');
                                item.className = 'autocomplete-item';
                                item.dataset.id = city.id;
                                
                                item.innerHTML = 
                                    '<div class="autocomplete-main">' + (city.name || '') + '</div>' +
                                    '<div class="autocomplete-sub">' +
                                        '<span>' + (city.city || '') + '، ' + (city.country || '') + '</span>' +
                                        '<span class="autocomplete-iata">' + (city.iata || '') + '</span>' +
                                    '</div>';
                                
                                item.addEventListener('click', function() {
                                    input.value = (city.city || '') + ' (' + (city.iata || '') + ')';
                                    hiddenInput.value = city.id;
                                    dropdown.style.display = 'none';
                                    
                                    var event = new Event('change', { bubbles: true });
                                    hiddenInput.dispatchEvent(event);
                                });
                                resultsContainer.appendChild(item);
                            });
                        })
                        .catch(function(err) {
                            isLoading = false;
                            loader.style.display = 'none';
                            console.error(err);
                        });
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    initCityAutocomplete('fromCityAutocomplete', 'from');
                    initCityAutocomplete('toCityAutocomplete', 'to');
                });
            } else {
                initCityAutocomplete('fromCityAutocomplete', 'from');
                initCityAutocomplete('toCityAutocomplete', 'to');
            }

            var hasSearched = false;

            window.performSearch = function () {
                var fromCity = document.getElementById('from_city_id').value;
                var toCity = document.getElementById('to_city_id').value;
                var flightDate = document.getElementById('flightDate').value;
                var tripType = document.getElementById('trip_type').value;
                var returnDate = document.getElementById('returnDate').value;

                if (!fromCity || !toCity || !flightDate || (tripType === 'round_trip' && !returnDate)) {
                    showValidationError('يرجى اختيار مدينة المغادرة، والوصول، وتاريخ السفر.');
                    return;
                }

                var dropdown = document.getElementById('passengersDropdown');
                var selector = document.getElementById('passengersSelector');
                if (dropdown) {
                    dropdown.classList.remove('show');
                    selector.classList.remove('active');
                }

                var btn = document.getElementById('searchBtn');
                var section = document.querySelector('section[aria-live="polite"]');

                btn.classList.add('loading');
                btn.disabled = true;
                section.setAttribute('aria-busy', 'true');

                var params = new URLSearchParams({
                    from_city_id: fromCity,
                    to_city_id: toCity,
                    trip_type: tripType,
                    date: flightDate,
                    return_date: returnDate,
                    number_of_adults: document.getElementById('number_of_adults').value || '1',
                    number_of_children: document.getElementById('number_of_children').value || '0',
                    number_of_babies: document.getElementById('number_of_babies').value || '0',
                });

                hasSearched = true;

                fetch(SEARCH_ROUTE + '?' + params)
                    .then(function (response) {
                        if (!response.ok) { throw new Error('Network response was not ok'); }
                        return response.json();
                    })
                    .then(function (data) {
                        rawTickets = Array.isArray(data) ? data : [];
                        btn.classList.remove('loading');
                        btn.disabled = false;
                        section.setAttribute('aria-busy', 'false');
                        document.getElementById('filterWrapper').classList.toggle('active', rawTickets.length > 0);
                        renderTickets();
                    })
                    .catch(function (error) {
                        console.error('Search error:', error);
                        btn.classList.remove('loading');
                        btn.disabled = false;
                        section.setAttribute('aria-busy', 'false');
                        document.getElementById('flightsGrid').innerHTML =
                            '<div class="no-results" role="status"><h2>حدث خطأ</h2><p>يرجى المحاولة مرة أخرى لاحقاً</p></div>';
                    });
            };

            window.sortResults = function (type, el) {
                currentSort = type;
                document.querySelectorAll('.filter-btn').forEach(function (button) {
                    button.classList.remove('active');
                });
                el.classList.add('active');
                renderTickets();
            };

            function renderTickets() {
                var grid = document.getElementById('flightsGrid');
                if (!hasSearched) {
                    grid.innerHTML = '';
                    return;
                }
                var tickets = rawTickets.slice();

                if (currentSort === 'price') {
                    tickets.sort(function (a, b) { return parseFloat(a.price || 0) - parseFloat(b.price || 0); });
                }
                if (currentSort === 'date') {
                    tickets.sort(function (a, b) { return new Date(a.departure_date || 0) - new Date(b.departure_date || 0); });
                }

                if (!tickets.length) {
                    grid.innerHTML = '<div class="no-results" role="status" style="display:flex; flex-direction:column; align-items:center; text-align:center; gap:16px; padding:40px 20px;">' +
                        '<h2 style="color:var(--primary-dark); font-size:24px; font-weight:800; margin:0;">تواصلكم غالي علينا</h2>' +
                        '<p style="font-size:15px; max-width:550px; margin:0 auto; line-height:1.7; color:var(--dark); font-weight:600;">هنا يمكنكم الحصول على أرخص سعر لهذة التذكرة مع وزن حقائب مثالي وشروط تعديل وإلغاء مميزة</p>' +
                        '<button onclick="openInquiryModal()" style="text-decoration:none; display:inline-flex; align-items:center; gap:10px; font-size:15px; padding:12px 28px; border-radius:30px; margin-top:10px; background:var(--accent); color:#fff; font-weight:700; border:none; cursor:pointer; box-shadow:0 4px 15px rgba(39,174,96,0.25);">' +
                        '<svg viewBox="0 0 24 24" style="width:20px;height:20px;fill:currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>' +
                        '<span>تواصل معنا عبر واتساب</span>' +
                        '</button>' +
                        '</div>';
                    return;
                }

                var adults = parseInt(document.getElementById('number_of_adults').value) || 1;
                var children = parseInt(document.getElementById('number_of_children').value) || 0;
                var babies = parseInt(document.getElementById('number_of_babies').value) || 0;
                var passengers = adults + children + babies;

                grid.innerHTML = tickets.map(function (ticket) {
                    var total = Math.round(parseFloat(ticket.price || 0) * passengers);
                    var dateObj = new Date(ticket.departure_date || new Date());
                    var dateStr = dateObj.toLocaleString('ar-EG', {
                        day: 'numeric', month: 'long', year: 'numeric'
                    });
                    var timeStr = dateObj.toLocaleString('ar-EG', {
                        hour: '2-digit', minute: '2-digit'
                    });

                    var from = (ticket.from_city || ticket.fromCity || {}).name || 'غير محدد';
                    var to = (ticket.to_city || ticket.toCity || {}).name || 'غير محدد';
                    var passengerSummary = adults + 'كبير ' +
                        (children ? ' · ' + children + ' أطفال' : '') +
                        (babies ? ' · ' + babies + ' رضيع' : '');

                    var escapedFrom = from.replace(/'/g, "\\'");
                    var escapedTo = to.replace(/'/g, "\\'");

                    var returnDateHtml = '';
                    if (ticket.trip_type === 'round_trip' && ticket.return_date) {
                        var rDateObj = new Date(ticket.return_date);
                        var raDateObj = ticket.return_arrival_date ? new Date(ticket.return_arrival_date) : null;

                        var returnDurationHtml = '';
                        if (ticket.return_duration_hours > 0 || ticket.return_duration_minutes > 0 || ticket.return_duration_days > 0) {
                            var durParts = [];
                            if (ticket.return_duration_days > 0) durParts.push(ticket.return_duration_days + ' يوم');
                            if (ticket.return_duration_hours > 0) durParts.push(ticket.return_duration_hours + ' ساعة');
                            if (ticket.return_duration_minutes > 0) durParts.push(ticket.return_duration_minutes + ' دقيقة');
                            returnDurationHtml = '<span class="meta-label">مدة العودة: ' + durParts.join(' و ') + '</span>';
                        }

                        returnDateHtml = '<div class="meta-item">' +
                            '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg></div>' +
                            '<div class="meta-details">' +
                            '<span class="meta-label">العودة</span>' +
                            '<span class="meta-value">' + rDateObj.toLocaleString('ar-EG', { day: 'numeric', month: 'long' }) + ' · ' + rDateObj.toLocaleString('ar-EG', { hour: '2-digit', minute: '2-digit' }) + '</span>' +
                            (raDateObj ? '<span class="meta-label">وصول العودة: ' + raDateObj.toLocaleString('ar-EG', { hour: '2-digit', minute: '2-digit' }) + '</span>' : '') +
                            returnDurationHtml +
                            '</div>' +
                            '</div>';
                    }

                    var durationHtml = '';
                    if (ticket.duration_hours > 0 || ticket.duration_minutes > 0 || ticket.duration_days > 0) {
                        var durParts = [];
                        if (ticket.duration_days > 0) durParts.push(ticket.duration_days + ' يوم');
                        if (ticket.duration_hours > 0) durParts.push(ticket.duration_hours + ' ساعة');
                        if (ticket.duration_minutes > 0) durParts.push(ticket.duration_minutes + ' دقيقة');
                        durationHtml = '<div class="meta-item">' +
                            '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>' +
                            '<div class="meta-details">' +
                            '<span class="meta-label">مدة الرحلة</span>' +
                            '<span class="meta-value">' + durParts.join(' و ') + '</span>' +
                            '</div>' +
                            '</div>';
                    }

                    var arrivalDateObj = ticket.arrival_date ? new Date(ticket.arrival_date) : null;
                    var arrivalTimeHtml = arrivalDateObj ?
                        '<span class="meta-label">موعد الوصول: ' + arrivalDateObj.toLocaleString('ar-EG', { hour: '2-digit', minute: '2-digit' }) + '</span>' : '';

                    var airlineHtml = ticket.airline ?
                        '<div class="meta-item">' +
                        '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><path d="M22 12L3 20l3.5-8L3 4l19 8z"/></svg></div>' +
                        '<div class="meta-details">' +
                        '<span class="meta-label">شركة الطيران</span>' +
                        '<span class="meta-value">' + ticket.airline + '</span>' +
                        '</div>' +
                        '</div>' : '';

                    var weightHtml = ticket.weight ?
                        '<div class="meta-item">' +
                        '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM10 4h4v3h-4V4z"/></svg></div>' +
                        '<div class="meta-details">' +
                        '<span class="meta-label">الوزن المسموح</span>' +
                        '<span class="meta-value">' + ticket.weight + '</span>' +
                        '</div>' +
                        '</div>' : '';

                    return '<article class="flight-card" role="listitem">' +
                        '<div class="card-header">' +
                        '<div class="route-info">' +
                        '<span class="airport-code">' + from + '</span>' +
                        '<div class="route-arrow">' +
                        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>' +
                        '</div>' +
                        '<span class="airport-code">' + to + '</span>' +
                        '</div>' +
                        '<div class="price-box">' +
                        '<div class="price-value">' + total.toLocaleString('ar-EG') + ' ج.م</div>' +
                        '<div class="price-label">إجمالي السعر</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<div class="flight-meta">' +
                        airlineHtml +
                        weightHtml +
                        '<div class="meta-item">' +
                        '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>' +
                        '<div class="meta-details">' +
                        '<span class="meta-label">المغادرة</span>' +
                        '<span class="meta-value">' + dateStr + ' · ' + timeStr + '</span>' +
                        arrivalTimeHtml +
                        '</div>' +
                        '</div>' +
                        durationHtml +
                        returnDateHtml +
                        '<div class="meta-item">' +
                        '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>' +
                        '<div class="meta-details">' +
                        '<span class="meta-label">المسافرون</span>' +
                        '<span class="meta-value">' + passengerSummary + '</span>' +
                        '</div>' +
                        '</div>' +
                        (ticket.description ?
                            '<div class="meta-item">' +
                            '<div class="meta-icon-wrapper"><svg class="icon" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>' +
                            '<div class="meta-details">' +
                            '<span class="meta-label">تفاصيل إضافية</span>' +
                            '<span class="meta-value">' + ticket.description + '</span>' +
                            '</div>' +
                            '</div>' : '') +
                        '</div>' +
                        '<div class="booking-section">' +
                        '<div class="ticket-code">' +
                        '<div class="code-label">رمز الرحلة</div>' +
                        '<div class="code-value">SBK-' + ticket.id + '-' + Math.floor(Math.random() * 900 + 100) + '</div>' +
                        '</div>' +
                        '<button class="whatsapp-btn" ' +
                        'onclick="openBookingModal(\'' + ticket.id + '\',\'' + escapedFrom + '\',\'' + escapedTo + '\',\'' + ticket.departure_date + '\',\'' + (ticket.return_date || '') + '\',' + total + ',' + adults + ',' + children + ',' + babies + ')" ' +
                        'aria-label="احجز الآن">' +
                        '<svg viewBox="0 0 24 24" style="width:20px;height:20px;fill:currentColor">' +
                        '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>' +
                        '</svg>' +
                        '<span>احجز رحلتك الآن</span>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</article>';
                }).join('');
            }

            // ===== MODAL =====
            window.openInquiryModal = function () {
                var fromSelect = document.getElementById('from_city_id');
                var fromCityName = fromSelect && fromSelect.selectedIndex >= 0 ? fromSelect.options[fromSelect.selectedIndex].text : 'غير محدد';
                var toSelect = document.getElementById('to_city_id');
                var toCityName = toSelect && toSelect.selectedIndex >= 0 ? toSelect.options[toSelect.selectedIndex].text : 'غير محدد';
                var flightDate = document.getElementById('flightDate').value || 'غير محدد';
                var returnDate = document.getElementById('returnDate').value || '';

                var adults = document.getElementById('number_of_adults').value || '1';
                var children = document.getElementById('number_of_children').value || '0';
                var babies = document.getElementById('number_of_babies').value || '0';

                window.openBookingModal('custom_inquiry', fromCityName, toCityName, flightDate, returnDate, 0, adults, children, babies);
            };

            window.openBookingModal = function (ticketId, from, to, date, returnDate, totalPrice, adults, children, babies) {
                currentBookingTicket = { id: ticketId, from: from, to: to, date: date, returnDate: returnDate, totalPrice: totalPrice, adults: adults, children: children, babies: babies };
                previousFocus = document.activeElement;
                document.getElementById('modalFullName').value = '';
                document.getElementById('modalEmail').value = '';

                var modalTitle = document.getElementById('modal-title');
                var modalDesc = document.querySelector('#bookingModal p');
                if (ticketId === 'custom_inquiry') {
                    if (modalTitle) modalTitle.innerText = 'طلب تسعير تذكرة خاصة';
                    if (modalDesc) modalDesc.innerText = 'أدخل اسمك وبريدك الإلكتروني وسنحولك فوراً إلى واتساب لإرسال تفاصيل الرحلة المطلوبة والحصول على أفضل عرض.';
                } else {
                    if (modalTitle) modalTitle.innerText = 'تأكيد حجز التذكرة';
                    if (modalDesc) modalDesc.innerText = 'أدخل اسم المسافر الكامل وسنحولك فوراً إلى واتساب لإتمام الحجز.';
                }

                document.getElementById('bookingModal').classList.add('open');
                document.body.style.overflow = 'hidden';
                setTimeout(function () { document.getElementById('modalFullName').focus(); }, 100);
            };

            window.closeBookingModal = function () {
                document.getElementById('bookingModal').classList.remove('open');
                document.body.style.overflow = '';
                if (previousFocus) { previousFocus.focus(); }
            };

            window.submitBookingToWhatsapp = function () {
                var name = document.getElementById('modalFullName').value.trim();
                if (!name) {
                    alert('يرجى إدخال اسم المسافر');
                    document.getElementById('modalFullName').focus();
                    return;
                }
                var email = document.getElementById('modalEmail').value.trim();
                if (!email) {
                    alert('يرجى إدخال البريد الإلكتروني');
                    document.getElementById('modalEmail').focus();
                    return;
                }

                var t = currentBookingTicket;
                var totalPassengers = parseInt(t.adults) + parseInt(t.children) + parseInt(t.babies);

                if (t.id === 'custom_inquiry') {
                    var msg = 'طلب تسعير رحلة خاصة - سوبك ترافيل\n' +
                        'تواصلكم غالي علينا ونرغب في الحصول على أرخص سعر\n\n' +
                        'اسم العميل: ' + name + '\n' +
                        'البريد الإلكتروني: ' + email + '\n' +
                        'المسار المطلوب: من ' + t.from + ' إلى ' + t.to + '\n' +
                        'تاريخ المغادرة: ' + t.date + '\n';
                    if (t.returnDate) {
                        msg += 'تاريخ العودة: ' + t.returnDate + '\n';
                    }
                    msg += 'عدد المسافرين: ' + totalPassengers + ' (كبير: ' + t.adults + ' · أطفال: ' + t.children + ' · رضيع: ' + t.babies + ')';

                    var url = 'https://wa.me/201110073052?text=' + encodeURIComponent(msg);
                    window.open(url, '_blank', 'noopener,noreferrer');
                    closeBookingModal();
                    return;
                }

                var dateStr = new Date(t.date).toLocaleString('ar-EG', {
                    weekday: 'long', year: 'numeric', month: 'long',
                    day: 'numeric', hour: '2-digit', minute: '2-digit'
                });

                var msg = 'طلب حجز تذكرة طيران - سوبك ترافيل\n' +
                    'اسم المسافر: ' + name + '\n' +
                    'البريد الإلكتروني: ' + email + '\n' +
                    'المسار: من ' + t.from + ' إلى ' + t.to + '\n' +
                    'التاريخ: ' + dateStr + '\n';

                if (t.returnDate) {
                    var returnDateStr = new Date(t.returnDate).toLocaleString('ar-EG', {
                        weekday: 'long', year: 'numeric', month: 'long',
                        day: 'numeric', hour: '2-digit', minute: '2-digit'
                    });
                    msg += 'تاريخ العودة: ' + returnDateStr + '\n';
                }

                msg += 'الركاب: ' + totalPassengers + ' شخص\n' +
                    'السعر الإجمالي: ' + parseInt(t.totalPrice).toLocaleString('ar-EG') + ' ج.م';

                var url = WHATSAPP_ROUTE_TEMPLATE.replace(':id', t.id) + '?text=' + encodeURIComponent(msg);
                window.open(url, '_blank', 'noopener,noreferrer');
                closeBookingModal();
            };

            // Modal backdrop click
            document.getElementById('bookingModal').addEventListener('click', function (e) {
                if (e.target === this) { window.closeBookingModal(); }
            });

            // Modal Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && document.getElementById('bookingModal').classList.contains('open')) {
                    window.closeBookingModal();
                }
            });

        }());
    </script>

    <!-- ===== HERO CAROUSEL SCRIPT (independent, does not touch search logic) ===== -->
    <script>
        (function () {
            var track = document.getElementById('heroTrack');
            var slides = track ? Array.prototype.slice.call(track.querySelectorAll('.hero-slide')) : [];
            var dotsWrap = document.getElementById('heroDots');
            var prevBtn = document.getElementById('heroPrev');
            var nextBtn = document.getElementById('heroNext');
            var carousel = document.getElementById('heroCarousel');

            if (!slides.length || !carousel) { return; }

            var current = 0;
            var total = slides.length;
            var AUTOPLAY_MS = 6000;
            var timer = null;
            var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            slides.forEach(function (slide, i) {
                var dot = document.createElement('button');
                dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('role', 'tab');
                dot.setAttribute('aria-label', 'الانتقال للشريحة ' + (i + 1));
                dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
                dot.addEventListener('click', function () { goTo(i, true); });
                dotsWrap.appendChild(dot);
            });
            var dots = Array.prototype.slice.call(dotsWrap.querySelectorAll('.hero-dot'));

            function goTo(index, userInitiated) {
                slides[current].classList.remove('active');
                dots[current].classList.remove('active');
                dots[current].setAttribute('aria-selected', 'false');

                current = (index + total) % total;

                slides[current].classList.add('active');
                dots[current].classList.add('active');
                dots[current].setAttribute('aria-selected', 'true');

                if (userInitiated) { restartAutoplay(); }
            }

            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            function startAutoplay() {
                if (reducedMotion) { return; }
                stopAutoplay();
                timer = setInterval(next, AUTOPLAY_MS);
            }
            function stopAutoplay() {
                if (timer) { clearInterval(timer); timer = null; }
            }
            function restartAutoplay() { startAutoplay(); }

            if (nextBtn) { nextBtn.addEventListener('click', function () { next(); restartAutoplay(); }); }
            if (prevBtn) { prevBtn.addEventListener('click', function () { prev(); restartAutoplay(); }); }

            carousel.addEventListener('mouseenter', stopAutoplay);
            carousel.addEventListener('mouseleave', startAutoplay);
            carousel.addEventListener('focusin', stopAutoplay);
            carousel.addEventListener('focusout', startAutoplay);

            carousel.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowLeft') { prev(); restartAutoplay(); }
                if (e.key === 'ArrowRight') { next(); restartAutoplay(); }
            });

            var touchStartX = 0;
            carousel.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].clientX;
            }, { passive: true });

            carousel.addEventListener('touchend', function (e) {
                var diff = e.changedTouches[0].clientX - touchStartX;
                if (Math.abs(diff) < 40) { return; }
                if (diff < 0) { prev(); } else { next(); }
                restartAutoplay();
            }, { passive: true });

            startAutoplay();
        }());
    </script>

@endsection