<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --primary-deeper: #4338ca;
        --primary-light: #eef2ff;
        --primary-50: rgba(99, 102, 241, 0.05);
        --primary-100: rgba(99, 102, 241, 0.1);
        --primary-200: rgba(99, 102, 241, 0.2);
        --success: #10b981;
        --success-dark: #059669;
        --success-light: #ecfdf5;
        --danger: #ef4444;
        --danger-dark: #dc2626;
        --danger-light: #fef2f2;
        --warning: #f59e0b;
        --warning-dark: #d97706;
        --warning-light: #fffbeb;
        --info: #3b82f6;
        --info-dark: #2563eb;
        --info-light: #eff6ff;
        --violet: #8b5cf6;
        --violet-dark: #7c3aed;
        --teal: #14b8a6;
        --teal-dark: #0d9488;
        --teal-light: #f0fdfa;
        --orange: #f97316;
        --orange-dark: #ea580c;
        --orange-light: #fff7ed;
        --slate-25: #fcfcfd;
        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --slate-900: #0f172a;
        --slate-950: #020617;
        --radius-xs: 10px;
        --radius-sm: 14px;
        --radius: 18px;
        --radius-md: 22px;
        --radius-lg: 28px;
        --radius-xl: 36px;
        --shadow-xs: 0 1px 3px rgba(0, 0, 0, 0.03);
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.05), 0 1px 4px rgba(0, 0, 0, 0.02);
        --shadow-md: 0 8px 30px rgba(0, 0, 0, 0.06), 0 2px 8px rgba(0, 0, 0, 0.02);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.03);
        --shadow-xl: 0 28px 70px rgba(0, 0, 0, 0.1);
        --shadow-primary: 0 10px 45px rgba(99, 102, 241, 0.2);
        --shadow-success: 0 10px 35px rgba(16, 185, 129, 0.2);
        --shadow-glow: 0 0 80px rgba(99, 102, 241, 0.06);
        --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-spring: all 0.55s cubic-bezier(0.34, 1.56, 0.64, 1);
        --glass-bg: rgba(255, 255, 255, 0.78);
        --glass-border: rgba(255, 255, 255, 0.55);
    }


    .page-wrapper {
        min-height: 100vh;
        position: relative;
        background: var(--bg-secondary);
    }

    .page-wrapper::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 400px;
        background: linear-gradient(180deg, rgba(99, 102, 241, 0.02) 0%, transparent 100%);
        pointer-events: none;
        z-index: 0;
    }

    .page-content {
        min-height: 100vh;
        padding: 20px 20px 48px;
        max-width: 100%;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .analytics {
        display: none !important;
    }

    /* ═══════════════════════════════════════════════════════════
       FLASH MESSAGE - Premium Notification
    ═══════════════════════════════════════════════════════════ */
    .flash {
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
        color: #fff;
        padding: 20px 30px;
        border-radius: var(--radius);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 16px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: var(--shadow-success), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        animation: flashSlideIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        position: relative;
        overflow: hidden;
    }

    .flash::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
        border-radius: 50%;
    }

    .flash i {
        font-size: 26px;
        flex-shrink: 0;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.12));
        position: relative;
        z-index: 1;
    }

    .flash span {
        position: relative;
        z-index: 1;
    }

    .flash .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.65;
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    .flash .btn-close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    @keyframes flashSlideIn {
        from {
            opacity: 0;
            transform: translateY(-24px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* ═══════════════════════════════════════════════════════════
       BANNER - Premium Gradient Hero with Mesh Pattern
    ═══════════════════════════════════════════════════════════ */
    .banner {
        background: linear-gradient(140deg, #1e1b4b 0%, #312e81 20%, #4338ca 45%, #6366f1 70%, #818cf8 90%, #a5b4fc 100%);
        border-radius: var(--radius-xl);
        padding: 36px 36px;
        color: #fff;
        margin-bottom: 36px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-primary), 0 0 0 1px rgba(99, 102, 241, 0.1);
    }

    .banner::before {
        content: '';
        position: absolute;
        top: -80%;
        right: -20%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
        border-radius: 50%;
        animation: bannerOrb 20s ease-in-out infinite;
    }

    .banner::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: -12%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        border-radius: 50%;
        animation: bannerOrb 25s ease-in-out infinite reverse;
    }

    .banner .banner-mesh {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 30% 20%, rgba(129, 140, 248, 0.3) 0%, transparent 50%),
            radial-gradient(ellipse at 70% 80%, rgba(99, 102, 241, 0.2) 0%, transparent 50%);
        pointer-events: none;
    }

    .banner .banner-grid-pattern {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
        background-size: 48px 48px;
        pointer-events: none;
    }

    .banner .banner-noise {
        position: absolute;
        inset: 0;
        opacity: 0.025;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        pointer-events: none;
    }

    .banner .banner-dots {
        position: absolute;
        top: 20px;
        right: 20px;
        display: grid;
        grid-template-columns: repeat(5, 6px);
        gap: 10px;
        opacity: 0.12;
    }

    .banner .banner-dots span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #fff;
    }

    @keyframes bannerOrb {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        25% {
            transform: translate(20px, -25px) scale(1.03);
        }

        50% {
            transform: translate(-15px, 15px) scale(0.97);
        }

        75% {
            transform: translate(10px, -10px) scale(1.01);
        }
    }

    .banner-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        flex-wrap: wrap;
    }

    .banner-text {
        flex: 1;
        min-width: 280px;
    }

    .banner-text .banner-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 40px;
        padding: 7px 18px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 18px;
        color: rgba(255, 255, 255, 0.9);
    }

    .banner-text .banner-eyebrow .pulse-dot {
        width: 8px;
        height: 8px;
        background: #34d399;
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 0 8px rgba(52, 211, 153, 0.5);
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(0.85);
        }
    }

    .banner-text h2 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.15rem;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.8px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        line-height: 1.2;
    }

    .banner-text h2 .wave {
        display: inline-block;
        animation: wave 2.5s ease-in-out infinite;
        transform-origin: 70% 70%;
    }

    @keyframes wave {

        0%,
        100% {
            transform: rotate(0deg);
        }

        10% {
            transform: rotate(14deg);
        }

        20% {
            transform: rotate(-8deg);
        }

        30% {
            transform: rotate(14deg);
        }

        40% {
            transform: rotate(-4deg);
        }

        50% {
            transform: rotate(10deg);
        }

        60% {
            transform: rotate(0deg);
        }
    }

    .banner-text p {
        font-size: 0.95rem;
        opacity: 0.85;
        margin: 0;
        max-width: 520px;
        font-weight: 400;
        line-height: 1.75;
    }

    .banner-text p strong {
        color: #c7d2fe;
        font-weight: 700;
    }

    .banner-pills {
        display: flex;
        gap: 14px;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
    }

    .b-pill {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: var(--radius);
        padding: 22px 30px;
        text-align: center;
        min-width: 110px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .b-pill::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.05) 0%, transparent 100%);
        pointer-events: none;
    }

    .b-pill:hover {
        background: rgba(255, 255, 255, 0.16);
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .b-pill-val {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        display: block;
        line-height: 1;
        margin-bottom: 8px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .b-pill-lbl {
        font-size: 0.65rem;
        font-weight: 700;
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* ═══════════════════════════════════════════════════════════
       STAT CARDS - Elevated Premium Glass
    ═══════════════════════════════════════════════════════════ */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
        margin-bottom: 36px;
    }

    .s-card {
        background: #fff;
        border-radius: var(--radius-md);
        border: 1px solid rgba(226, 232, 240, 0.6);
        padding: 28px 30px 24px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .s-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        opacity: 0;
        transition: opacity 0.4s, transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: scaleX(0);
    }

    .s-card::after {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.5s;
        pointer-events: none;
    }

    .s-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }

    .s-card:hover::before {
        opacity: 1;
        transform: scaleX(1);
    }

    .s-card:hover::after {
        opacity: 1;
    }

    .s-card.emerald::before {
        background: linear-gradient(90deg, #059669, #10b981, #34d399, #6ee7b7);
    }

    .s-card.emerald::after {
        background: radial-gradient(circle, rgba(16, 185, 129, 0.06) 0%, transparent 60%);
    }

    .s-card.sky::before {
        background: linear-gradient(90deg, #2563eb, #3b82f6, #60a5fa, #93c5fd);
    }

    .s-card.sky::after {
        background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 60%);
    }

    .s-card.rose::before {
        background: linear-gradient(90deg, #dc2626, #ef4444, #f87171, #fca5a5);
    }

    .s-card.rose::after {
        background: radial-gradient(circle, rgba(239, 68, 68, 0.06) 0%, transparent 60%);
    }

    .s-card.amber::before {
        background: linear-gradient(90deg, #d97706, #f59e0b, #fbbf24, #fde68a);
    }

    .s-card.amber::after {
        background: radial-gradient(circle, rgba(245, 158, 11, 0.06) 0%, transparent 60%);
    }

    .s-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .s-card-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        letter-spacing: 0.9px;
    }

    .s-card-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 28px;
        flex-shrink: 0;
        transition: var(--transition-spring);
        position: relative;
    }

    .s-card:hover .s-card-icon {
        transform: scale(1.14) rotate(-10deg);
    }

    .s-card-icon.emerald {
        background: linear-gradient(145deg, #ecfdf5, #d1fae5);
        color: #059669;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.12);
    }

    .s-card-icon.sky {
        background: linear-gradient(145deg, #eff6ff, #dbeafe);
        color: #2563eb;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.12);
    }

    .s-card-icon.rose {
        background: linear-gradient(145deg, #fef2f2, #fee2e2);
        color: #dc2626;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.12);
    }

    .s-card-icon.amber {
        background: linear-gradient(145deg, #fffbeb, #fef3c7);
        color: #d97706;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.12);
    }

    .s-card-val {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.35rem;
        font-weight: 800;
        color: var(--slate-900);
        line-height: 1;
        letter-spacing: -1.2px;
        margin-bottom: 14px;
    }

    .s-card-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .s-card-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 28px;
    }

    .s-card-badge.up {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #059669;
        border: 1px solid rgba(5, 150, 105, 0.06);
    }

    .s-card-badge.flat {
        background: var(--slate-100);
        color: var(--slate-500);
    }

    .s-card-badge i {
        font-size: 14px;
    }

    .s-card-bar {
        height: 5px;
        background: var(--slate-100);
        border-radius: 5px;
        margin-top: 18px;
        overflow: hidden;
        position: relative;
    }

    .s-card-bar-fill {
        height: 100%;
        border-radius: 5px;
        width: 0;
        transition: width 2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .s-card-bar-fill::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 30px;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4));
        border-radius: 5px;
    }

    .s-card-bar-fill.emerald {
        background: linear-gradient(90deg, #059669, #10b981, #6ee7b7);
    }

    .s-card-bar-fill.sky {
        background: linear-gradient(90deg, #2563eb, #3b82f6, #93c5fd);
    }

    .s-card-bar-fill.rose {
        background: linear-gradient(90deg, #dc2626, #ef4444, #fca5a5);
    }

    .s-card-bar-fill.amber {
        background: linear-gradient(90deg, #d97706, #f59e0b, #fde68a);
    }

    /* ═══════════════════════════════════════════════════════════
       SECTION HEADER - Refined
    ═══════════════════════════════════════════════════════════ */
    .sec-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 24px;
        margin-top: 12px;
    }

    .sec-header-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 22px;
        background: linear-gradient(145deg, var(--primary-light), #e0e7ff);
        color: var(--primary);
        box-shadow: 0 3px 10px rgba(99, 102, 241, 0.1);
        transition: var(--transition);
    }

    .sec-header:hover .sec-header-icon {
        transform: rotate(-8deg) scale(1.05);
    }

    .sec-header h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.18rem;
        font-weight: 800;
        color: var(--slate-900);
        letter-spacing: -0.3px;
    }

    .sec-header .sec-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--slate-200) 0%, var(--slate-100) 40%, transparent 100%);
    }

    .sec-header .sec-tag {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary);
        background: linear-gradient(145deg, var(--primary-light), #e0e7ff);
        padding: 6px 18px;
        border-radius: 28px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: 1px solid rgba(99, 102, 241, 0.08);
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.06);
    }

    /* ═══════════════════════════════════════════════════════════
       TABLE CARDS - Premium Elevated
    ═══════════════════════════════════════════════════════════ */
    .tbl-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
        margin-bottom: 36px;
    }

    .tbl-card {
        background: #fff;
        border-radius: var(--radius-md);
        border: 1px solid rgba(226, 232, 240, 0.6);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .tbl-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        z-index: 1;
    }

    .tbl-card:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(203, 213, 225, 0.5);
        transform: translateY(-3px);
    }

    .tbl-card-header {
        padding: 24px 30px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        border-bottom: 1px solid var(--slate-100);
        background: linear-gradient(180deg, var(--slate-25) 0%, #fff 100%);
        position: relative;
    }

    .tbl-card-header-icon {
        width: 46px;
        height: 46px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        font-size: 22px;
        box-shadow: var(--shadow-xs);
        transition: var(--transition-spring);
    }

    .tbl-card:hover .tbl-card-header-icon {
        transform: scale(1.08) rotate(-5deg);
    }

    .tbl-card-header-icon.indigo {
        background: linear-gradient(145deg, #eef2ff, #e0e7ff);
        color: #6366f1;
    }

    .tbl-card-header-icon.teal {
        background: linear-gradient(145deg, #f0fdfa, #ccfbf1);
        color: #14b8a6;
    }

    .tbl-card-header-icon.amber {
        background: linear-gradient(145deg, #fffbeb, #fef3c7);
        color: #d97706;
    }

    .tbl-card-header-icon.rose {
        background: linear-gradient(145deg, #fff1f2, #ffe4e6);
        color: #e11d48;
    }

    .tbl-card-header h4 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
        font-weight: 800;
        color: var(--slate-900);
        letter-spacing: -0.2px;
    }

    .tbl-card-header .view-all-link {
        margin-left: auto;
        font-size: 0.76rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 16px;
        border-radius: var(--radius-xs);
        transition: var(--transition);
        border: 1px solid transparent;
    }

    .tbl-card-header .view-all-link.indigo {
        color: #6366f1;
        background: rgba(99, 102, 241, 0.06);
    }

    .tbl-card-header .view-all-link.indigo:hover {
        background: rgba(99, 102, 241, 0.12);
        border-color: rgba(99, 102, 241, 0.1);
        transform: translateX(3px);
    }

    .tbl-card-header .view-all-link.teal {
        color: #14b8a6;
        background: rgba(20, 184, 166, 0.06);
    }

    .tbl-card-header .view-all-link.teal:hover {
        background: rgba(20, 184, 166, 0.12);
        border-color: rgba(20, 184, 166, 0.1);
        transform: translateX(3px);
    }

    .tbl-card-header .tbl-count {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--slate-400);
        background: var(--slate-100);
        padding: 5px 14px;
        border-radius: 16px;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .tbl-card .table-responsive {
        padding: 0;
    }

    .tbl-card table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.83rem;
    }

    .tbl-card thead th {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        letter-spacing: 0.9px;
        padding: 16px 22px;
        border-bottom: 1px solid var(--slate-100);
        background: var(--slate-50);
        white-space: nowrap;
        text-align: left;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .tbl-card tbody td {
        padding: 18px 22px;
        color: var(--slate-700);
        font-weight: 500;
        border-bottom: 1px solid rgba(241, 245, 249, 0.8);
        vertical-align: middle;
    }

    .tbl-card tbody tr {
        transition: var(--transition-fast);
    }

    .tbl-card tbody tr:last-child td {
        border-bottom: 0;
    }

    .tbl-card tbody tr:hover {
        background: linear-gradient(90deg, rgba(248, 250, 252, 0.8), rgba(241, 245, 249, 0.4));
    }

    .tbl-card tbody td strong {
        color: var(--slate-900);
        font-weight: 700;
    }

    .tbl-customer-name {
        font-weight: 700;
        color: var(--slate-800);
        font-size: 0.85rem;
        letter-spacing: -0.1px;
    }

    .tbl-customer-phone {
        font-size: 0.74rem;
        color: var(--slate-400);
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .tbl-detail-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: var(--slate-600);
        line-height: 1.8;
    }

    .tbl-detail-row b {
        color: var(--slate-500);
        font-weight: 600;
        min-width: fit-content;
    }

    .tbl-badge {
        display: inline-flex;
        align-items: center;
        font-weight: 700;
        font-size: 0.67rem;
        padding: 6px 14px;
        border-radius: var(--radius-xs);
        letter-spacing: 0.3px;
        gap: 5px;
        white-space: nowrap;
    }

    .tbl-badge.danger {
        background: linear-gradient(145deg, #fef2f2, #fee2e2);
        color: #dc2626;
        border: 1px solid rgba(220, 38, 38, 0.06);
        box-shadow: 0 2px 6px rgba(220, 38, 38, 0.06);
    }

    .tbl-badge.warning {
        background: linear-gradient(145deg, #fffbeb, #fef3c7);
        color: #d97706;
        border: 1px solid rgba(217, 119, 6, 0.06);
        box-shadow: 0 2px 6px rgba(217, 119, 6, 0.06);
    }

    .tbl-badge.success {
        background: linear-gradient(145deg, #ecfdf5, #d1fae5);
        color: #059669;
        border: 1px solid rgba(5, 150, 105, 0.06);
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.06);
    }

    .tbl-badge.info {
        background: linear-gradient(145deg, #eef2ff, #e0e7ff);
        color: #6366f1;
        border: 1px solid rgba(99, 102, 241, 0.06);
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.06);
    }

    .tbl-badge.pending {
        background: linear-gradient(145deg, #fffbeb, #fef3c7);
        color: #d97706;
        border: 1px solid rgba(217, 119, 6, 0.06);
        box-shadow: 0 2px 6px rgba(217, 119, 6, 0.06);
    }

    .tbl-badge.done {
        background: linear-gradient(145deg, #ecfdf5, #d1fae5);
        color: #059669;
        border: 1px solid rgba(5, 150, 105, 0.06);
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.06);
    }

    .tbl-card-empty {
        padding: 56px 28px;
        text-align: center;
        color: var(--slate-400);
        font-size: 0.88rem;
    }

    .tbl-empty-state {
        text-align: center;
        padding: 48px 24px;
    }

    .tbl-empty-state .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: var(--radius);
        background: var(--slate-100);
        display: grid;
        place-items: center;
        font-size: 28px;
        color: var(--slate-300);
        margin: 0 auto 16px;
    }

    .tbl-empty-state p {
        color: var(--slate-400);
        font-weight: 600;
        font-size: 0.85rem;
    }

    .tbl-empty-state small {
        color: var(--slate-300);
        font-size: 0.78rem;
        display: block;
        margin-top: 4px;
    }

    /* ═══════════════════════════════════════════════════════════
       QR SECTION - Premium Floating Card
    ═══════════════════════════════════════════════════════════ */
    .qr-section {
        background: #fff;
        border-radius: var(--radius-md);
        border: 1px solid rgba(226, 232, 240, 0.6);
        padding: 28px 32px;
        margin-bottom: 36px;
        display: flex;
        align-items: center;
        gap: 40px;
        flex-wrap: wrap;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .qr-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, var(--primary), var(--violet), #818cf8, var(--primary));
        background-size: 100% 200%;
        animation: gradientMove 4s ease-in-out infinite;
        border-radius: 5px 0 0 5px;
    }

    @keyframes gradientMove {

        0%,
        100% {
            background-position: 0% 0%;
        }

        50% {
            background-position: 0% 100%;
        }
    }

    .qr-section::after {
        content: '';
        position: absolute;
        top: -60%;
        right: -10%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 55%);
        border-radius: 50%;
        pointer-events: none;
    }

    .qr-section .qr-pattern {
        position: absolute;
        bottom: -30%;
        left: 20%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.02) 0%, transparent 55%);
        border-radius: 50%;
        pointer-events: none;
    }

    .qr-section:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(203, 213, 225, 0.5);
        transform: translateY(-3px);
    }

    .qr-frame {
        position: relative;
        flex-shrink: 0;
    }

    .qr-img-box {
        width: 160px;
        height: 160px;
        border-radius: var(--radius);
        border: 2px solid var(--slate-200);
        padding: 12px;
        background: #fff;
        box-shadow: var(--shadow-sm), 0 0 0 6px rgba(99, 102, 241, 0.03);
        transition: var(--transition);
        position: relative;
    }

    .qr-img-box::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: calc(var(--radius) + 4px);
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(139, 92, 246, 0.06), rgba(99, 102, 241, 0.04));
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .qr-section:hover .qr-img-box {
        box-shadow: var(--shadow-md), 0 0 0 6px rgba(99, 102, 241, 0.06);
        border-color: rgba(99, 102, 241, 0.2);
    }

    .qr-section:hover .qr-img-box::before {
        opacity: 1;
    }

    .qr-img-box img {
        width: 100%;
        height: 100%;
        border-radius: 12px;
    }

    .qr-dot {
        position: absolute;
        bottom: -8px;
        right: -8px;
        width: 40px;
        height: 40px;
        background: linear-gradient(145deg, var(--primary), var(--primary-dark));
        border-radius: 12px;
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 19px;
        box-shadow: var(--shadow-primary);
        border: 3px solid #fff;
        transition: var(--transition-spring);
    }

    .qr-section:hover .qr-dot {
        transform: scale(1.12) rotate(-8deg);
    }

    .qr-info {
        flex: 1;
        min-width: 260px;
        position: relative;
        z-index: 1;
    }

    .qr-info .qr-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        background: rgba(99, 102, 241, 0.06);
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 14px;
        border: 1px solid rgba(99, 102, 241, 0.06);
    }

    .qr-info h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--slate-900);
        margin-bottom: 10px;
        letter-spacing: -0.3px;
    }

    .qr-info p {
        font-size: 0.88rem;
        color: var(--slate-500);
        margin-bottom: 24px;
        line-height: 1.75;
        max-width: 500px;
    }

    .qr-btns {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .q-btn {
        padding: 13px 28px;
        border-radius: var(--radius-sm);
        font-size: 0.84rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 9px;
        text-decoration: none;
        letter-spacing: -0.15px;
        position: relative;
        overflow: hidden;
    }

    .q-btn.fill {
        background: linear-gradient(145deg, var(--primary), var(--primary-dark));
        color: #fff;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
    }

    .q-btn.fill::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.12), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .q-btn.fill:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 32px rgba(99, 102, 241, 0.35);
        color: #fff;
    }

    .q-btn.fill:hover::before {
        opacity: 1;
    }

    .q-btn.ghost {
        background: #fff;
        color: var(--slate-700);
        border: 1.5px solid var(--slate-300);
    }

    .q-btn.ghost:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(99, 102, 241, 0.04);
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
    }

    /* ═══════════════════════════════════════════════════════════
       ANALYTICS - Premium Dashboard Analytics
    ═══════════════════════════════════════════════════════════ */
    .analytics {
        background: #fff;
        border-radius: var(--radius-md);
        border: 1px solid rgba(226, 232, 240, 0.6);
        overflow: hidden;
        margin-bottom: 36px;
        transition: var(--transition);
        position: relative;
    }

    .analytics::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        z-index: 1;
    }

    .analytics:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(203, 213, 225, 0.5);
    }

    .analytics-head {
        padding: 26px 34px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
        border-bottom: 1px solid var(--slate-100);
        background: linear-gradient(180deg, var(--slate-25) 0%, #fff 100%);
    }

    .analytics-head-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .analytics-head-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        background: linear-gradient(145deg, var(--primary), var(--primary-dark));
        color: #fff;
        font-size: 24px;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        transition: var(--transition-spring);
    }

    .analytics:hover .analytics-head-icon {
        transform: scale(1.05) rotate(-5deg);
    }

    .analytics-head h5 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--slate-900);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .analytics-head small {
        display: block;
        font-size: 0.78rem;
        color: var(--slate-400);
        margin-top: 4px;
        font-weight: 500;
    }

    .analytics-head-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .a-toggle {
        background: var(--slate-100);
        border-radius: var(--radius-sm);
        padding: 4px;
        display: flex;
        gap: 3px;
        border: 1px solid var(--slate-200);
    }

    .a-toggle .a-btn {
        border-radius: var(--radius-xs);
        padding: 9px 20px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        border: none;
        color: var(--slate-500);
        background: transparent;
        cursor: pointer;
        transition: var(--transition-fast);
        position: relative;
    }

    .a-toggle .a-btn:hover {
        color: var(--slate-700);
        background: rgba(255, 255, 255, 0.5);
    }

    .a-toggle .a-btn.active {
        background: #fff;
        color: var(--primary);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .a-refresh {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-sm);
        display: grid;
        place-items: center;
        background: #fff;
        border: 1.5px solid var(--slate-200);
        color: var(--slate-400);
        cursor: pointer;
        transition: var(--transition);
        font-size: 22px;
    }

    .a-refresh:hover {
        color: var(--primary);
        border-color: var(--primary);
        background: rgba(99, 102, 241, 0.04);
        transform: rotate(90deg);
    }

    .a-refresh.spinning i {
        animation: spin 0.7s linear infinite;
    }

    /* Summary Row */
    .a-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-bottom: 1px solid var(--slate-100);
    }

    .a-summary-cell {
        padding: 28px 30px;
        text-align: center;
        position: relative;
        transition: background 0.3s;
    }

    .a-summary-cell:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 16%;
        height: 68%;
        width: 1px;
        background: linear-gradient(180deg, transparent, var(--slate-100), transparent);
    }

    .a-summary-cell:hover {
        background: linear-gradient(180deg, var(--slate-25), rgba(248, 250, 252, 0.5));
    }

    .a-summary-cell .a-lbl {
        font-size: 0.64rem;
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }

    .a-summary-cell .a-val {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.65rem;
        font-weight: 800;
        color: var(--slate-900);
        line-height: 1;
        margin-bottom: 14px;
        letter-spacing: -0.7px;
    }

    .a-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 22px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .a-badge.up {
        background: linear-gradient(145deg, #ecfdf5, #d1fae5);
        color: #059669;
        border: 1px solid rgba(5, 150, 105, 0.06);
    }

    .a-badge.down {
        background: linear-gradient(145deg, #fef2f2, #fee2e2);
        color: #dc2626;
        border: 1px solid rgba(220, 38, 38, 0.06);
    }

    .a-badge.neu {
        background: linear-gradient(145deg, #eef2ff, #e0e7ff);
        color: #6366f1;
        border: 1px solid rgba(99, 102, 241, 0.06);
    }

    .a-badge i {
        font-size: 13px;
    }

    /* Chart */
    .a-chart-wrap {
        padding: 30px 34px 34px;
        position: relative;
        min-height: 400px;
    }

    .a-loader {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(12px);
        display: grid;
        place-items: center;
        z-index: 10;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
    }

    .a-loader.active {
        opacity: 1;
        visibility: visible;
    }

    .a-loader-inner {
        text-align: center;
    }

    .a-spinner {
        width: 48px;
        height: 48px;
        border: 3px solid var(--slate-200);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 16px;
    }

    .a-loader-text {
        font-size: 0.82rem;
        color: var(--slate-400);
        font-weight: 600;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Footer */
    .a-footer {
        padding: 18px 34px;
        border-top: 1px solid var(--slate-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        background: linear-gradient(180deg, #fff 0%, var(--slate-25) 100%);
    }

    .a-legend {
        display: flex;
        gap: 30px;
    }

    .a-legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--slate-600);
    }

    .a-legend-dot {
        width: 14px;
        height: 14px;
        border-radius: 5px;
        box-shadow: var(--shadow-xs);
    }

    .a-legend-dot.orders {
        background: linear-gradient(145deg, #6366f1, #818cf8);
    }

    .a-legend-dot.revenue {
        background: linear-gradient(145deg, #10b981, #34d399);
    }

    .a-time {
        font-size: 0.74rem;
        color: var(--slate-400);
        display: flex;
        align-items: center;
        gap: 7px;
        font-weight: 500;
    }

    .a-time i {
        font-size: 16px;
    }

    /* ═══════════════════════════════════════════════════════════
       FOOTER BAR - Subtle
    ═══════════════════════════════════════════════════════════ */
    .page-footer {
        text-align: center;
        padding: 24px 20px 32px;
        color: var(--slate-400);
        font-size: 0.78rem;
        font-weight: 500;
    }

    .page-footer a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .page-footer a:hover {
        text-decoration: underline;
    }

    /* ═══════════════════════════════════════════════════════════
       SCROLL ANIMATIONS
    ═══════════════════════════════════════════════════════════ */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .plan-alert {
        margin-top: 20px;
        padding: 16px 20px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(12px);
        animation: fadeSlide 0.4s ease;
    }

    .plan-left {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 14px;
    }

    .plan-sub {
        font-size: 12px;
        opacity: 0.8;
    }

    .plan-alert.warning {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .plan-alert.danger {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-upgrade {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 13px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-upgrade:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ═══════════════════════════════════════════════════════════
   MOBILE RESPONSIVE FIXES — Replace existing media queries
═══════════════════════════════════════════════════════════ */

    @media (max-width: 1200px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }

        .banner-pills {
            display: none;
        }
    }

    @media (max-width: 992px) {
        .a-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .a-summary-cell:nth-child(2)::after {
            display: none;
        }

        .a-summary-cell:nth-child(1),
        .a-summary-cell:nth-child(2) {
            border-bottom: 1px solid var(--slate-100);
        }

        .tbl-grid {
            grid-template-columns: 1fr;
        }

        .analytics-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .page-content {
            padding: 16px 14px 44px;
        }

        /* Banner */
        .banner {
            padding: 28px 20px;
            border-radius: var(--radius-lg);
        }

        .banner-text h2 {
            font-size: 1.45rem;
        }

        /* Stat cards */
        .stats-row {
            gap: 14px;
        }

        .s-card {
            padding: 20px 20px 16px;
        }

        .s-card-val {
            font-size: 1.75rem;
        }

        .s-card-icon {
            width: 46px;
            height: 46px;
            font-size: 22px;
        }

        /* Table cards — key fixes */
        .tbl-card {
            border-radius: var(--radius);
            overflow: hidden;
        }

        .tbl-card-header {
            padding: 16px 16px 14px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tbl-card-header h4 {
            font-size: 0.9rem;
        }

        .tbl-card-header-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .tbl-card .view-all-link {
            font-size: 0.7rem;
            padding: 5px 10px;
        }

        .tbl-count {
            font-size: 0.6rem !important;
            padding: 4px 10px !important;
        }

        /* Allow tables to scroll horizontally on mobile */
        .tbl-card .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Compact table cells */
        .tbl-card table {
            min-width: 480px;
            font-size: 0.78rem;
        }

        .tbl-card thead th {
            padding: 11px 12px;
            font-size: 0.6rem;
            letter-spacing: 0.6px;
            white-space: nowrap;
        }

        .tbl-card tbody td {
            padding: 13px 12px;
            vertical-align: top;
        }

        .tbl-customer-name {
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .tbl-customer-phone {
            font-size: 0.68rem;
            white-space: nowrap;
        }

        .tbl-detail-row {
            font-size: 0.72rem;
            line-height: 1.7;
            white-space: nowrap;
        }

        .tbl-badge {
            font-size: 0.62rem;
            padding: 5px 10px;
            white-space: nowrap;
        }

        .tbl-empty-state {
            padding: 36px 16px;
        }

        .tbl-empty-state .empty-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        /* QR section */
        .qr-section {
            flex-direction: column;
            align-items: flex-start;
            padding: 24px 18px;
            gap: 20px;
        }

        .qr-section::before {
            top: 0;
            left: 0;
            right: 0;
            bottom: auto;
            width: 100%;
            height: 4px;
            border-radius: 4px 4px 0 0;
        }

        .qr-frame {
            align-self: center;
        }

        .qr-info {
            width: 100%;
        }

        .qr-info h3 {
            font-size: 1.05rem;
        }

        .qr-info p {
            font-size: 0.84rem;
            max-width: 100%;
        }

        .qr-btns {
            width: 100%;
            gap: 10px;
        }

        .q-btn {
            flex: 1;
            justify-content: center;
            padding: 11px 16px;
            font-size: 0.8rem;
        }

        /* Analytics */
        .analytics-head,
        .a-footer {
            padding-left: 16px;
            padding-right: 16px;
        }

        .analytics-head {
            padding-top: 18px;
            padding-bottom: 18px;
        }

        .a-chart-wrap {
            padding: 16px 14px 20px;
            min-height: 280px;
        }

        .a-summary-cell {
            padding: 18px 14px;
        }

        .a-summary-cell .a-val {
            font-size: 1.3rem;
        }

        .a-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .a-legend {
            gap: 18px;
        }

        /* Section header */
        .sec-header {
            gap: 12px;
        }

        .sec-header-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sec-header h3 {
            font-size: 1rem;
        }

        /* Plan warning card */
        .plan-warning-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 18px 18px;
            gap: 16px;
        }

        .plan-warning-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .plan-warning-title {
            font-size: 1.1rem;
        }

        .plan-warning-btn {
            width: 100%;
            justify-content: center;
            padding: 12px 18px;
        }
    }

    @media (max-width: 480px) {
        .page-content {
            padding: 12px 10px 32px;
        }

        /* Stack stats to single column */
        .stats-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .s-card-val {
            font-size: 1.55rem;
        }

        .banner-text h2 {
            font-size: 1.2rem;
        }

        .banner {
            padding: 22px 16px;
        }

        .banner-text .banner-eyebrow {
            font-size: 0.65rem;
            padding: 5px 12px;
        }

        .b-pill-val {
            font-size: 1.5rem;
        }

        /* Tighter table on very small screens */
        .tbl-card table {
            min-width: 420px;
            font-size: 0.74rem;
        }

        .tbl-card thead th {
            padding: 10px 10px;
        }

        .tbl-card tbody td {
            padding: 11px 10px;
        }

        /* QR */
        .qr-img-box {
            width: 120px;
            height: 120px;
        }

        /* Analytics summary 2-col grid */
        .a-summary {
            grid-template-columns: 1fr 1fr;
        }

        .a-summary-cell .a-val {
            font-size: 1.15rem;
        }

        .a-summary-cell .a-lbl {
            font-size: 0.58rem;
        }

        /* toggle buttons */
        .a-toggle .a-btn {
            padding: 7px 14px;
            font-size: 0.68rem;
        }
    }

    /* ═══════════════ DARK THEME OVERRIDES ═══════════════ */
    [data-theme="dark"] .page-wrapper {
        background: var(--bg-primary);
    }

    [data-theme="dark"] .s-card,
    [data-theme="dark"] .tbl-card,
    [data-theme="dark"] .qr-section,
    [data-theme="dark"] .analytics,
    [data-theme="dark"] .plan-warning-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .tbl-card-header,
    [data-theme="dark"] .analytics-head,
    [data-theme="dark"] .a-footer {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .tbl-card thead th {
        background: var(--bg-tertiary) !important;
        color: var(--text-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .tbl-card tbody td {
        color: var(--text-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .tbl-card tbody tr:hover {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .tbl-customer-name,
    [data-theme="dark"] .s-card-val,
    [data-theme="dark"] .a-val,
    [data-theme="dark"] .tbl-card-header h4,
    [data-theme="dark"] .analytics-head h5,
    [data-theme="dark"] .sec-header h3,
    [data-theme="dark"] .qr-info h3,
    [data-theme="dark"] .banner-text h2 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .s-card-label,
    [data-theme="dark"] .tbl-customer-phone,
    [data-theme="dark"] .tbl-detail-row,
    [data-theme="dark"] .analytics-head small,
    [data-theme="dark"] .qr-info p,
    [data-theme="dark"] .a-lbl,
    [data-theme="dark"] .a-time,
    [data-theme="dark"] .a-legend-item {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .s-card-bar {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .a-summary-cell {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .a-summary-cell:hover {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .a-toggle {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .a-toggle .a-btn.active {
        background: var(--bg-secondary) !important;
        color: var(--primary) !important;
    }

    [data-theme="dark"] .a-toggle .a-btn {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .a-refresh {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .qr-img-box {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .tbl-empty-state .empty-icon {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .sec-header .sec-line {
        background: linear-gradient(90deg, var(--border-color) 0%, transparent 100%) !important;
    }

    [data-theme="dark"] .q-btn.ghost {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .plan-warning-card {
        background: rgba(245, 158, 11, 0.08) !important;
        border-color: rgba(245, 158, 11, 0.25) !important;
    }
</style>

<?php
$adminSession = $this->session->userdata('admin')['id'];

$order = isset($order) ? (int) $order : 0;
$customers = isset($customers) ? (int) $customers : 0;
$complaints = isset($complaints) ? (int) $complaints : 0;
$total_amc = isset($total_amc) ? (int) $total_amc : 0;
$active_products = isset($active_products) ? (int) $active_products : 0;
$low_stock_items = isset($low_stock_items) ? (int) $low_stock_items : 0;
$total_sales = isset($total_sales) ? (float) $total_sales : 0;
$total_profit = isset($total_profit) ? (float) $total_profit : 0;
$total_purchase = isset($total_purchase) ? (float) $total_purchase : 0;

$tm_orders = isset($thismonth_orders) ? (int) $thismonth_orders : 0;
$tm_customers = isset($thismonth_customers) ? (int) $thismonth_customers : 0;
$tm_complaints = isset($thismonth_complaints) ? (int) $thismonth_complaints : 0;
$tm_amc = isset($thismonth_amc) ? (int) $thismonth_amc : 0;
$tm_sales = isset($thismonth_sales) ? (float) $thismonth_sales : 0;
$tm_profit = isset($thismonth_profit) ? (float) $thismonth_profit : 0;
$tm_purchase = isset($thismonth_purchase) ? (float) $thismonth_purchase : 0;
$planSummary = isset($plan_summary) && is_array($plan_summary) ? $plan_summary : [];
$showPlanWarning = !empty($planSummary['show_expiry_warning']);
$warningDaysLeft = (int) ($planSummary['warning_days_left'] ?? 0);
$warningMessage = (string) ($planSummary['warning_message'] ?? '');

$pct = function ($part, $total) {
    if ($total <= 0) {
        return 0;
    }

    return max(0, min(100, round(($part / $total) * 100)));
};

$money = function ($amount) {
    return number_format((float) $amount, 2);
};

$stats = [
    ['label' => 'Total Customers', 'value' => $customers, 'month' => $tm_customers, 'icon' => 'bx bxs-group', 'color' => 'sky', 'pct' => $customers > 0 ? $pct($tm_customers, $customers) : 0],
    ['label' => 'Total Complaints', 'value' => $complaints, 'month' => $tm_complaints, 'icon' => 'bx bxs-error-alt', 'color' => 'rose', 'pct' => $complaints > 0 ? $pct($tm_complaints, $complaints) : 0],
    ['label' => 'Total Order', 'value_display' => $money($total_sales), 'month_display' => $money($tm_sales) . ' this month', 'month_raw' => $tm_sales, 'icon' => 'bx bx-cart-alt', 'color' => 'emerald', 'pct' => $total_sales > 0 ? $pct($tm_sales, $total_sales) : 0],
    ['label' => 'Total Amc Customer', 'value_display' => $money($total_profit), 'month_display' => $money($tm_profit) . ' this month', 'month_raw' => $tm_profit, 'icon' => 'bx bx-user-check', 'color' => 'sky', 'pct' => $total_sales > 0 ? $pct($tm_profit, $total_sales) : 0],
];

$months = [];
$orderCounts = [];
$revenueCounts = [];
for ($i = 11; $i >= 0; $i--) {
    $date = date('Y-m', strtotime("-$i months"));
    $months[] = date('M Y', strtotime("-$i months"));
    $orderCounts[] = isset($monthly_orders[$date]) ? (int) $monthly_orders[$date] : 0;
    $revenueCounts[] = isset($monthly_revenue[$date]) ? (float) $monthly_revenue[$date] : 0;
}

$chartData = ['labels' => $months, 'orders' => $orderCounts, 'revenue' => $revenueCounts];

$totalOrdersAll = array_sum($orderCounts);
$totalRevenueAll = array_sum($revenueCounts);
$halfLen = (int) floor(count($orderCounts) / 2);
$recentOrders = array_sum(array_slice($orderCounts, $halfLen));
$previousOrders = array_sum(array_slice($orderCounts, 0, $halfLen));
$recentRevenue = array_sum(array_slice($revenueCounts, $halfLen));
$previousRevenue = array_sum(array_slice($revenueCounts, 0, $halfLen));

$orderGrowth = $previousOrders > 0 ? round((($recentOrders - $previousOrders) / $previousOrders) * 100, 1) : 0;
$revenueGrowth = $previousRevenue > 0 ? round((($recentRevenue - $previousRevenue) / $previousRevenue) * 100, 1) : 0;

$publicCatalogUrl = site_url('publiccatalog/view/' . $adminSession);
$qrImageUrl = 'https://quickchart.io/qr?size=220&text=' . rawurlencode($publicCatalogUrl);
$currentMonth = date('F Y');
?>

<style>
    .plan-warning-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        background: linear-gradient(135deg, #fff7ed 0%, #fffbeb 100%);
        border: 1px solid #fed7aa;
        border-radius: var(--radius-lg);
        padding: 24px 28px;
        margin-bottom: 28px;
        box-shadow: var(--shadow);
    }

    .plan-warning-copy {
        flex: 1;
        min-width: 0;
    }

    .plan-warning-eyebrow {
        display: inline-flex;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #c2410c;
        margin-bottom: 10px;
    }

    .plan-warning-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #7c2d12;
        margin-bottom: 8px;
    }

    .plan-warning-text {
        margin: 0;
        color: #9a3412;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .plan-warning-icon {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #fb923c, #f59e0b);
        color: #fff;
        box-shadow: 0 14px 30px rgba(245, 158, 11, 0.22);
        flex-shrink: 0;
        font-size: 30px;
    }

    .plan-warning-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 22px;
        border-radius: 14px;
        background: linear-gradient(135deg, #ea580c, #f59e0b);
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 12px 26px rgba(234, 88, 12, 0.18);
        transition: var(--transition-fast);
    }

    .plan-warning-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 16px 32px rgba(234, 88, 12, 0.24);
    }

    @media (max-width: 900px) {
        .plan-warning-card {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <?php if ($this->session->flashdata('success')): ?>
            <div class="flash alert alert-dismissible fade show">
                <i class="bx bx-check-circle"></i>
                <span><?= $this->session->flashdata('success'); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($showPlanWarning): ?>
            <div class="plan-warning-card animate-on-scroll">
                <div class="plan-warning-icon">
                    <i class="bx bx-time-five"></i>
                </div>
                <div class="plan-warning-copy">
                    <span class="plan-warning-eyebrow">Plan Renewal Reminder</span>
                    <div class="plan-warning-title">
                        Your plan ends in <?= $warningDaysLeft; ?> day<?= $warningDaysLeft === 1 ? '' : 's'; ?>.
                    </div>
                    <p class="plan-warning-text">
                        <?= html_escape($warningMessage); ?>
                    </p>
                </div>
                <a href="<?= site_url('admin/plan'); ?>" class="plan-warning-btn">
                    <i class="bx bx-cart"></i>
                    Buy Plan
                </a>
            </div>
        <?php endif; ?>

        <!-- ═══════ BANNER ═══════ -->
        <div class="banner">
            <div class="banner-mesh"></div>
            <div class="banner-grid-pattern"></div>
            <div class="banner-noise"></div>
            <div class="banner-dots">
                <?php for ($i = 0; $i < 15; $i++): ?><span></span><?php endfor; ?>
            </div>
            <div class="banner-inner">
                <div class="banner-text">
                    <div class="banner-eyebrow">
                        <span class="pulse-dot"></span>
                        Dashboard Overview
                    </div>
                    <h2><span class="wave">👋</span> Welcome back, Admin!</h2>
                    <p>Here's your business snapshot for <strong><?= $currentMonth ?></strong>. Stay on top of orders,
                        customers, and trends.</p>
                </div>
                <div class="banner-pills">
                    <div class="b-pill">
                        <span class="b-pill-val"><?= $tm_orders ?></span>
                        <span class="b-pill-lbl">Orders</span>
                    </div>
                    <div class="b-pill">
                        <span class="b-pill-val"><?= $tm_customers ?></span>
                        <span class="b-pill-lbl">Customers</span>
                    </div>
                    <div class="b-pill">
                        <span class="b-pill-val"><?= $tm_amc ?></span>
                        <span class="b-pill-lbl">AMC</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════ STAT CARDS ═══════ -->
        <div class="stats-row">
            <?php foreach ($stats as $s): ?>
                <div class="s-card <?= $s['color'] ?>">
                    <div class="s-card-top">
                        <div>
                            <div class="s-card-label"><?= $s['label'] ?></div>
                        </div>
                        <div class="s-card-icon <?= $s['color'] ?>">
                            <i class="<?= $s['icon'] ?>"></i>
                        </div>
                    </div>
                    <?php if (isset($s['value_display'])): ?>
                        <div class="s-card-val" style="font-size: 1.4rem; letter-spacing: -0.4px;">
                            <?= html_escape($s['value_display']); ?>
                        </div>
                    <?php elseif (is_numeric($s['value'])): ?>
                        <div class="s-card-val" data-target="<?= $s['value'] ?>">0</div>
                    <?php else: ?>
                        <div class="s-card-val" style="font-size: 1.4rem; letter-spacing: -0.4px;">
                            <?= html_escape($s['value']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="s-card-meta">
                        <?php if (isset($s['month_display'])): ?>
                            <span class="s-card-badge <?= ($s['month_raw'] ?? 0) > 0 ? 'up' : 'flat' ?>">
                                <i class="bx <?= ($s['month_raw'] ?? 0) > 0 ? 'bx-trending-up' : 'bx-minus' ?>"></i>
                                <?= html_escape($s['month_display']) ?>
                            </span>
                        <?php elseif (array_key_exists('month', $s)): ?>
                            <span class="s-card-badge <?= $s['month'] > 0 ? 'up' : 'flat' ?>">
                                <i class="bx <?= $s['month'] > 0 ? 'bx-trending-up' : 'bx-minus' ?>"></i>
                                <?= $s['month'] ?> <?= html_escape($s['month_label'] ?? 'this month') ?>
                            </span>
                        <?php elseif (isset($s['meta'])): ?>
                            <span class="s-card-badge <?= !empty($s['meta_positive']) ? 'up' : 'flat' ?>">
                                <i class="bx <?= !empty($s['meta_positive']) ? 'bx-check-circle' : 'bx-info-circle' ?>"></i>
                                <?= html_escape($s['meta']) ?>
                            </span>
                        <?php else: ?>
                            <span class="s-card-badge <?= $isExpiredPlan ? 'flat' : 'up' ?>">
                                <i class="bx <?= $isExpiredPlan ? 'bx-info-circle' : 'bx-check-circle' ?>"></i>
                                <?= html_escape($s['meta'] ?? '-'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="s-card-bar">
                        <div class="s-card-bar-fill <?= $s['color'] ?>" data-width="<?= $s['pct'] ?>"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ═══════ UPCOMING EMI & SERVICES ═══════ -->
        <div class="sec-header animate-on-scroll">
            <div class="sec-header-icon"><i class="bx bx-calendar-event"></i></div>
            <h3>Upcoming Schedule</h3>
            <div class="sec-line"></div>
            <span class="sec-tag">Next 7 days</span>
        </div>

        <div class="tbl-grid">

            <!-- EMI CARD -->
            <div class="tbl-card animate-on-scroll">
                <div class="tbl-card-header">
                    <div class="tbl-card-header-icon indigo">
                        <i class="bx bx-credit-card"></i>
                    </div>
                    <h4>EMI Payments</h4>
                    <a href="<?= site_url('admin/emi') ?>" class="view-all-link indigo">
                        View All <i class="bx bx-right-arrow-alt"></i>
                    </a>
                    <span class="tbl-count"><?= count($upcoming_emi) ?> due</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Details</th>
                                <th>Days Left</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($upcoming_emi)): ?>
                                <?php foreach ($upcoming_emi as $emi): ?>
                                    <?php
                                    $days = (strtotime($emi->emi_date) - time()) / 86400;
                                    $daysLeft = max(0, (int) ceil($days));
                                    $bc = ($daysLeft <= 2) ? 'danger' : (($daysLeft <= 5) ? 'warning' : 'success');
                                    ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="tbl-customer-name"><?= htmlspecialchars($emi->customer_name) ?>
                                                </div>
                                                <div class="tbl-customer-phone">
                                                    <i class="bx bx-phone" style="font-size:13px;"></i>
                                                    <?= htmlspecialchars($emi->customer_mobile) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><strong><?= htmlspecialchars($emi->product_name) ?></strong></td>
                                        <td>
                                            <div style="line-height:1.8">
                                                <div class="tbl-detail-row"><b>EMI:</b> #<?= (int) $emi->emi_number ?></div>
                                                <div class="tbl-detail-row"><b>Amount:</b>
                                                    ₹<?= number_format((float) $emi->price, 0) ?></div>
                                                <div class="tbl-detail-row"><b>Due:</b>
                                                    <?= date('d M Y', strtotime($emi->emi_date)) ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="tbl-badge <?= $bc ?>">
                                                <i class="bx bx-time-five" style="font-size:13px;"></i>
                                                <?= $daysLeft ?> days
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="tbl-empty-state">
                                            <div class="empty-icon"><i class="bx bx-credit-card"></i></div>
                                            <p>No EMI payments due</p>
                                            <small>No upcoming EMI in the next 7 days</small>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SERVICE CARD -->
            <div class="tbl-card animate-on-scroll">
                <div class="tbl-card-header">
                    <div class="tbl-card-header-icon teal">
                        <i class="bx bx-wrench"></i>
                    </div>
                    <h4>Services</h4>
                    <a href="<?= site_url('admin/service') ?>" class="view-all-link teal">
                        View All <i class="bx bx-right-arrow-alt"></i>
                    </a>
                    <span class="tbl-count"><?= count($upcoming_services) ?> upcoming</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($upcoming_services)): ?>
                                <?php foreach ($upcoming_services as $sv): ?>
                                    <?php $isDone = ((int) $sv->status !== 0); ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="tbl-customer-name"><?= htmlspecialchars($sv->customer_name) ?></div>
                                                <div class="tbl-customer-phone">
                                                    <i class="bx bx-phone" style="font-size:13px;"></i>
                                                    <?= htmlspecialchars($sv->customer_mobile) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><strong><?= htmlspecialchars($sv->product_name) ?></strong></td>
                                        <td>
                                            <div style="line-height:1.8">
                                                <div class="tbl-detail-row"><b>Service:</b> #<?= (int) $sv->service_number ?>
                                                </div>
                                                <div class="tbl-detail-row"><b>Price:</b>
                                                    ₹<?= number_format((float) $sv->price, 0) ?></div>
                                                <div class="tbl-detail-row"><b>Date:</b>
                                                    <?= date('d M Y', strtotime($sv->service_date)) ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="tbl-badge <?= $isDone ? 'done' : 'pending' ?>">
                                                <i class="bx <?= $isDone ? 'bx-check-circle' : 'bx-time-five' ?>"
                                                    style="font-size:13px;"></i>
                                                <?= $isDone ? 'Done' : 'Pending' ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="tbl-empty-state">
                                            <div class="empty-icon"><i class="bx bx-wrench"></i></div>
                                            <p>No upcoming services</p>
                                            <small>No services scheduled for the next 7 days</small>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- AMC EXPIRY CARD -->
            <div class="tbl-card animate-on-scroll">
                <div class="tbl-card-header">
                    <div class="tbl-card-header-icon amber">
                        <i class="bx bx-calendar-x"></i>
                    </div>
                    <h4>AMC Expiry</h4>
                    <a href="<?= site_url('admin/amc') ?>" class="view-all-link indigo">
                        View All <i class="bx bx-right-arrow-alt"></i>
                    </a>
                    <span class="tbl-count"><?= count($upcoming_amc_expiry) ?> expiring</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Expiry Date</th>
                                <th>Days Left</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($upcoming_amc_expiry)): ?>
                                <?php foreach ($upcoming_amc_expiry as $amc): ?>
                                    <?php
                                    $days = (strtotime($amc->end_date) - time()) / 86400;
                                    $daysLeft = max(0, (int) ceil($days));
                                    $bc = ($daysLeft <= 7) ? 'danger' : (($daysLeft <= 15) ? 'warning' : 'success');
                                    ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="tbl-customer-name"><?= htmlspecialchars($amc->customer_name) ?>
                                                </div>
                                                <div class="tbl-customer-phone">
                                                    <i class="bx bx-phone" style="font-size:13px;"></i>
                                                    <?= htmlspecialchars($amc->customer_mobile) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><strong><?= htmlspecialchars($amc->product_name) ?></strong></td>
                                        <td>
                                            <div style="line-height:1.8">
                                                <div class="tbl-detail-row"><b>End:</b>
                                                    <?= date('d M Y', strtotime($amc->end_date)) ?></div>
                                                <div class="tbl-detail-row"><b>Amount:</b>
                                                    ₹<?= number_format((float) $amc->amc_amount, 0) ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="tbl-badge <?= $bc ?>">
                                                <i class="bx bx-time-five" style="font-size:13px;"></i>
                                                <?= $daysLeft ?> days
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="tbl-empty-state">
                                            <div class="empty-icon"><i class="bx bx-calendar-x"></i></div>
                                            <p>No AMC expiring soon</p>
                                            <small>No AMC expiry found for the next 30 days</small>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- LATEST COMPLAINTS CARD -->
            <div class="tbl-card animate-on-scroll">
                <div class="tbl-card-header">
                    <div class="tbl-card-header-icon rose">
                        <i class="bx bxs-error-alt"></i>
                    </div>
                    <h4>Latest Complaints</h4>
                    <a href="<?= site_url('admin/complaint') ?>" class="view-all-link indigo">
                        View All <i class="bx bx-right-arrow-alt"></i>
                    </a>
                    <span class="tbl-count"><?= count($latest_complaints) ?> shown</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Issue</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($latest_complaints)): ?>
                                <?php foreach ($latest_complaints as $complaint): ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="tbl-customer-name"><?= htmlspecialchars($complaint->name) ?></div>
                                                <div class="tbl-customer-phone">
                                                    <i class="bx bx-phone" style="font-size:13px;"></i>
                                                    <?= htmlspecialchars($complaint->mobile) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?= htmlspecialchars($complaint->product_name) ?></strong>
                                            <div class="tbl-detail-row">Model:
                                                <?= htmlspecialchars($complaint->serial_number) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="line-height:1.8">
                                                <div class="tbl-detail-row"><b><?= htmlspecialchars($complaint->issue) ?></b>
                                                </div>
                                                <div class="tbl-detail-row">
                                                    <?php
                                                    $cDetails = trim((string) $complaint->complain_details);
                                                    echo htmlspecialchars(function_exists('mb_strimwidth')
                                                        ? mb_strimwidth($cDetails, 0, 60, '...')
                                                        : substr($cDetails, 0, 60) . (strlen($cDetails) > 60 ? '...' : ''));
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $dashboardComplaintStatus = (int) $complaint->status;
                                            $dashboardBadgeClass = 'done';
                                            $dashboardBadgeIcon = 'bx-check-circle';
                                            $dashboardBadgeLabel = 'Approved';
                                            if ($dashboardComplaintStatus === 1) {
                                                $dashboardBadgeClass = 'pending';
                                                $dashboardBadgeIcon = 'bx-time-five';
                                                $dashboardBadgeLabel = 'Pending';
                                            } elseif ($dashboardComplaintStatus === 3) {
                                                $dashboardBadgeClass = 'danger';
                                                $dashboardBadgeIcon = 'bx-x-circle';
                                                $dashboardBadgeLabel = 'Reject';
                                            }
                                            ?>
                                            <span class="tbl-badge <?= $dashboardBadgeClass ?>">
                                                <i class="bx <?= $dashboardBadgeIcon ?>" style="font-size:13px;"></i>
                                                <?= $dashboardBadgeLabel ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="tbl-empty-state">
                                            <div class="empty-icon"><i class="bx bxs-error-alt"></i></div>
                                            <p>No complaints found</p>
                                            <small>Everything looks great!</small>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- ═══════ QR SECTION ═══════ -->
        <div class="qr-section animate-on-scroll">
            <div class="qr-pattern"></div>
            <div class="qr-frame">
                <div class="qr-img-box">
                    <img src="<?= $qrImageUrl ?>" alt="Catalog QR">
                </div>
                <div class="qr-dot"><i class="bx bx-qr-scan"></i></div>
            </div>
            <div class="qr-info">
                <div class="qr-label">
                    <i class="bx bx-scan" style="font-size:12px;"></i>
                    Quick Access
                </div>
                <h3>📱 Your Catalog QR Code</h3>
                <p>Share this QR with customers for instant access to your complete product catalog. Scan-friendly and
                    always up to date.</p>
                <div class="qr-btns">
                    <a href="<?= site_url('admin/catalog/generate_qr') ?>" class="q-btn fill">
                        <i class="bx bx-refresh"></i> Regenerate
                    </a>
                    <a href="<?= site_url('publiccatalog/view/' . $adminSession) ?>" target="_blank"
                        class="q-btn ghost">
                        <i class="bx bx-show"></i> View Catalog
                    </a>
                </div>
            </div>
        </div>

        <!-- ═══════ ANALYTICS ═══════ -->
        <div class="analytics animate-on-scroll">
            <div class="analytics-head">
                <!-- <div class="analytics-head-left">
                    <div class="analytics-head-icon"><i class="bx bx-bar-chart-alt-2"></i></div>
                    <div>
                        <h5>Orders & Revenue</h5>
                        <small>Business performance over time</small>
                    </div>
                </div> -->
                <div class="analytics-head-right">
                    <div class="a-toggle" id="chartFilter">
                        <button class="a-btn active" data-range="6">6M</button>
                        <button class="a-btn" data-range="12">12M</button>
                        <button class="a-btn" data-range="all">All</button>
                    </div>
                    <button class="a-refresh" id="btnRefresh" title="Refresh">
                        <i class="bx bx-refresh"></i>
                    </button>
                </div>
            </div>

            <div class="a-summary">
                <div class="a-summary-cell">
                    <div class="a-lbl">Total Orders</div>
                    <div class="a-val" id="summaryOrders">0</div>
                    <span class="a-badge <?= $orderGrowth >= 0 ? 'up' : 'down' ?>" id="badgeOrders">
                        <i class="bx <?= $orderGrowth >= 0 ? 'bx-trending-up' : 'bx-trending-down' ?>"></i>
                        <span id="growthOrders"><?= abs($orderGrowth) ?>%</span>
                    </span>
                </div>
                <div class="a-summary-cell">
                    <div class="a-lbl">Total Revenue</div>
                    <div class="a-val" id="summaryRevenue">₹0</div>
                    <span class="a-badge <?= $revenueGrowth >= 0 ? 'up' : 'down' ?>" id="badgeRevenue">
                        <i class="bx <?= $revenueGrowth >= 0 ? 'bx-trending-up' : 'bx-trending-down' ?>"></i>
                        <span id="growthRevenue"><?= abs($revenueGrowth) ?>%</span>
                    </span>
                </div>
                <div class="a-summary-cell">
                    <div class="a-lbl">Avg Order Value</div>
                    <div class="a-val" id="summaryAvg">₹0</div>
                    <span class="a-badge neu"><i class="bx bx-bar-chart"></i> Per Order</span>
                </div>
                <div class="a-summary-cell">
                    <div class="a-lbl">Peak Month</div>
                    <div class="a-val" id="summaryPeak">—</div>
                    <span class="a-badge neu" id="badgePeak"><i class="bx bx-trophy"></i> <span
                            id="peakValue">—</span></span>
                </div>
            </div>

            <div class="a-chart-wrap">
                <div id="chartLoading" class="a-loader">
                    <div class="a-loader-inner">
                        <div class="a-spinner"></div>
                        <div class="a-loader-text">Loading analytics…</div>
                    </div>
                </div>
                <div id="main_analytics_chart">
                    </di v>
                </div>

                <div class="a-footer">
                    <div class="a-legend">
                        <div class="a-legend-item">
                            <div class="a-legend-dot orders"></div> Orders
                        </div>
                        <div class="a-legend-item">
                            <div class="a-legend-dot revenue"></div> Revenue (₹)
                        </div>
                    </div>
                    <div class="a-time" id="chartTimestamp">
                        <i class="bx bx-time-five"></i> Updated just now
                    </div>
                </div>
            </div>

            <!-- ═══════ FOOTER ═══════ -->
            <!-- <div class="page-footer">
            Built with precision · Dashboard v2.0
        </div> -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chartData = <?= json_encode($chartData) ?>;
            let chart = null;
            let currentRange = '6';

            const fmt = n => '₹' + Number(n).toLocaleString('en-IN');

            // ─── COUNT UP ANIMATION ─────────────────────
            function countUp(el, target, currency = false) {
                const dur = 1100,
                    t0 = performance.now();
                const s = parseInt(el.textContent.replace(/[^\d]/g, '')) || 0;
                (function tick(now) {
                    const p = Math.min((now - t0) / dur, 1);
                    const e = 1 - Math.pow(1 - p, 4);
                    const v = Math.round(s + (target - s) * e);
                    el.textContent = currency ? fmt(v) : v.toLocaleString('en-IN');
                    if (p < 1) requestAnimationFrame(tick);
                })(t0);
            }

            // ─── DATA SLICER ───────────────────────────
            function slice(range) {
                const l = chartData.labels.length;
                const c = range === 'all' ? l : Math.min(+range, l);
                const s = l - c;
                return {
                    labels: chartData.labels.slice(s),
                    orders: chartData.orders.slice(s),
                    revenue: chartData.revenue.slice(s)
                };
            }

            // ─── REFRESH SUMMARY ───────────────────────
            function refreshSummary(d) {
                const tO = d.orders.reduce((a, b) => a + b, 0);
                const tR = d.revenue.reduce((a, b) => a + b, 0);
                const avg = tO > 0 ? Math.round(tR / tO) : 0;
                countUp(document.getElementById('summaryOrders'), tO);
                countUp(document.getElementById('summaryRevenue'), tR, true);
                countUp(document.getElementById('summaryAvg'), avg, true);

                const h = Math.floor(d.orders.length / 2);
                const rO = d.orders.slice(h).reduce((a, b) => a + b, 0);
                const pO = d.orders.slice(0, h).reduce((a, b) => a + b, 0);
                const rR = d.revenue.slice(h).reduce((a, b) => a + b, 0);
                const pR = d.revenue.slice(0, h).reduce((a, b) => a + b, 0);

                setBadge('badgeOrders', 'growthOrders', pO > 0 ? ((rO - pO) / pO * 100).toFixed(1) : 0);
                setBadge('badgeRevenue', 'growthRevenue', pR > 0 ? ((rR - pR) / pR * 100).toFixed(1) : 0);

                const mi = d.orders.indexOf(Math.max(...d.orders));
                document.getElementById('summaryPeak').textContent = d.labels[mi] || '—';
                document.getElementById('peakValue').textContent = d.orders[mi] + ' orders';
            }

            function setBadge(bid, tid, g) {
                const b = document.getElementById(bid),
                    t = document.getElementById(tid),
                    v = parseFloat(g);
                b.className = 'a-badge ' + (v >= 0 ? 'up' : 'down');
                b.querySelector('i').className = 'bx ' + (v >= 0 ? 'bx-trending-up' : 'bx-trending-down');
                t.textContent = Math.abs(v) + '%';
            }

            // ─── DRAW CHART ────────────────────────────
            function draw(range) {
                const ld = document.getElementById('chartLoading');
                ld.classList.add('active');
                const d = slice(range);

                setTimeout(() => {
                    refreshSummary(d);
                    const opts = {
                        series: [{
                                name: 'Orders',
                                type: 'column',
                                data: d.orders
                            },
                            {
                                name: 'Revenue',
                                type: 'area',
                                data: d.revenue
                            }
                        ],
                        chart: {
                            height: 380,
                            type: 'line',
                            fontFamily: 'Inter, sans-serif',
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            },
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 900,
                                animateGradually: {
                                    enabled: true,
                                    delay: 100
                                }
                            },
                            dropShadow: {
                                enabled: true,
                                top: 8,
                                blur: 12,
                                color: '#10b981',
                                opacity: 0.06
                            }
                        },
                        colors: ['#6366f1', '#10b981'],
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                borderRadiusApplication: 'end',
                                columnWidth: d.labels.length > 8 ? '46%' : '32%',
                                distributed: false
                            }
                        },
                        stroke: {
                            width: [0, 3.5],
                            curve: 'smooth',
                            lineCap: 'round'
                        },
                        fill: {
                            type: ['solid', 'gradient'],
                            gradient: {
                                shade: 'light',
                                type: 'vertical',
                                opacityFrom: 0.35,
                                opacityTo: 0.01,
                                stops: [0, 80, 100],
                                colorStops: [{
                                    offset: 0,
                                    color: '#10b981',
                                    opacity: 0.25
                                }, {
                                    offset: 100,
                                    color: '#10b981',
                                    opacity: 0.01
                                }]
                            }
                        },
                        markers: {
                            size: [0, 5],
                            colors: ['#6366f1', '#10b981'],
                            strokeWidth: 3,
                            strokeColors: '#fff',
                            hover: {
                                sizeOffset: 5
                            },
                            discrete: []
                        },
                        xaxis: {
                            categories: d.labels,
                            labels: {
                                style: {
                                    colors: '#94a3b8',
                                    fontSize: '11px',
                                    fontWeight: 600,
                                    fontFamily: 'Inter'
                                },
                                rotate: d.labels.length > 8 ? -45 : 0,
                                rotateAlways: d.labels.length > 8
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                show: true,
                                stroke: {
                                    color: '#e2e8f0',
                                    width: 1,
                                    dashArray: 5
                                }
                            }
                        },
                        yaxis: [{
                                title: {
                                    text: 'Orders',
                                    style: {
                                        color: '#94a3b8',
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        fontFamily: 'Inter'
                                    }
                                },
                                labels: {
                                    style: {
                                        colors: '#94a3b8',
                                        fontSize: '11px',
                                        fontFamily: 'Inter'
                                    },
                                    formatter: v => Math.round(v)
                                },
                                min: 0,
                                forceNiceScale: true
                            },
                            {
                                opposite: true,
                                title: {
                                    text: 'Revenue (₹)',
                                    style: {
                                        color: '#94a3b8',
                                        fontSize: '12px',
                                        fontWeight: 600,
                                        fontFamily: 'Inter'
                                    }
                                },
                                labels: {
                                    style: {
                                        colors: '#94a3b8',
                                        fontSize: '11px',
                                        fontFamily: 'Inter'
                                    },
                                    formatter: v => v >= 1e5 ? '₹' + (v / 1e5).toFixed(1) + 'L' : v >= 1e3 ? '₹' + (v / 1e3).toFixed(1) + 'K' : '₹' + v
                                },
                                min: 0,
                                forceNiceScale: true
                            }
                        ],
                        grid: {
                            borderColor: '#f1f5f9',
                            strokeDashArray: 5,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 10,
                                right: 10,
                                bottom: 0,
                                left: 10
                            }
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Inter'
                            },
                            y: {
                                formatter: (v, {
                                    seriesIndex
                                }) => seriesIndex === 1 ? fmt(v) : v + ' orders'
                            },
                            marker: {
                                show: true
                            },
                            theme: 'light',
                            x: {
                                show: true
                            }
                        },
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: 'darken',
                                    value: 0.88
                                }
                            },
                            active: {
                                filter: {
                                    type: 'darken',
                                    value: 0.82
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 768,
                            options: {
                                chart: {
                                    height: 280
                                },
                                plotOptions: {
                                    bar: {
                                        columnWidth: '56%',
                                        borderRadius: 6
                                    }
                                },
                                yaxis: [{
                                        labels: {
                                            show: true
                                        },
                                        title: {
                                            text: ''
                                        }
                                    },
                                    {
                                        labels: {
                                            show: false
                                        },
                                        title: {
                                            text: ''
                                        }
                                    }
                                ]
                            }
                        }]
                    };

                    if (chart) {
                        chart.updateOptions(opts, true, true);
                    } else {
                        chart = new ApexCharts(document.getElementById('main_analytics_chart'), opts);
                        chart.render();
                    }

                    ld.classList.remove('active');
                    const now = new Date();
                    document.getElementById('chartTimestamp').innerHTML =
                        '<i class="bx bx-time-five"></i> Updated ' + now.toLocaleTimeString('en-IN', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                }, 500);
            }

            // ─── FILTER BUTTONS ────────────────────────
            document.querySelectorAll('#chartFilter .a-btn').forEach(b => {
                b.addEventListener('click', function() {
                    document.querySelector('#chartFilter .a-btn.active').classList.remove('active');
                    this.classList.add('active');
                    currentRange = this.dataset.range;
                    draw(currentRange);
                });
            });

            // ─── REFRESH BUTTON ────────────────────────
            document.getElementById('btnRefresh').addEventListener('click', function() {
                this.classList.add('spinning');
                draw(currentRange);
                setTimeout(() => this.classList.remove('spinning'), 1000);
            });

            // ─── STAT CARD COUNT UP ────────────────────
            document.querySelectorAll('[data-target]').forEach(el => countUp(el, +el.dataset.target || 0));

            // ─── PROGRESS BARS ─────────────────────────
            document.querySelectorAll('[data-width]').forEach(b => {
                setTimeout(() => b.style.width = b.dataset.width + '%', 500);
            });

            // ─── STAT CARD ENTRANCE ────────────────────
            document.querySelectorAll('.s-card').forEach((c, i) => {
                c.style.opacity = '0';
                c.style.transform = 'translateY(24px)';
                setTimeout(() => {
                    c.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
                    c.style.opacity = '1';
                    c.style.transform = 'translateY(0)';
                }, 120 + i * 100);
            });

            // ─── SCROLL ANIMATIONS ─────────────────────
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

            // ─── INITIAL CHART ─────────────────────────
            draw('6');
        });
    </script>