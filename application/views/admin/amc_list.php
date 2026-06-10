<div class="page-wrapper">
    <div class="page-content">
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
                --success-50: rgba(16, 185, 129, 0.05);
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
                --radius-xs: 8px;
                --radius-sm: 12px;
                --radius: 16px;
                --radius-md: 20px;
                --radius-lg: 24px;
                --radius-xl: 32px;
                --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
                --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.03);
                --shadow: 0 4px 16px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.03);
                --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.07), 0 2px 8px rgba(0, 0, 0, 0.03);
                --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.03);
                --shadow-xl: 0 24px 64px rgba(0, 0, 0, 0.12);
                --shadow-primary: 0 8px 40px rgba(99, 102, 241, 0.2);
                --shadow-success: 0 8px 32px rgba(16, 185, 129, 0.2);
                --shadow-glow: 0 0 60px rgba(99, 102, 241, 0.08);
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-fast: all 0.18s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-spring: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
                --glass-bg: rgba(255, 255, 255, 0.72);
                --glass-border: rgba(255, 255, 255, 0.5);
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            /* ═══════════════════════════════════════════
               BANNER - Premium Hero
            ═══════════════════════════════════════════ */
            .banner {
                background: linear-gradient(135deg, #312e81 0%, #4338ca 25%, #6366f1 60%, #818cf8 100%);
                border-radius: var(--radius-xl);
                padding: 48px 52px;
                color: #fff;
                margin-bottom: 32px;
                position: relative;
                overflow: hidden;
                box-shadow: var(--shadow-primary), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }

            .banner::before {
                content: '';
                position: absolute;
                top: -60%;
                right: -15%;
                width: 700px;
                height: 700px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.07) 0%, transparent 55%);
                border-radius: 50%;
                animation: bannerOrb 15s ease-in-out infinite;
            }

            .banner::after {
                content: '';
                position: absolute;
                bottom: -50%;
                left: -8%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.04) 0%, transparent 55%);
                border-radius: 50%;
                animation: bannerOrb 18s ease-in-out infinite reverse;
            }

            .banner .banner-grid-pattern {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
                background-size: 40px 40px;
                pointer-events: none;
            }

            @keyframes bannerOrb {

                0%,
                100% {
                    transform: translate(0, 0) scale(1);
                }

                33% {
                    transform: translate(15px, -20px) scale(1.02);
                }

                66% {
                    transform: translate(-10px, 10px) scale(0.98);
                }
            }

            .banner-inner {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 32px;
                flex-wrap: wrap;
            }

            .banner-text h2 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                margin: 0 0 10px;
                letter-spacing: -0.7px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .banner-text p {
                font-size: 0.95rem;
                opacity: 0.88;
                margin: 0;
                max-width: 500px;
                font-weight: 400;
                line-height: 1.7;
            }

            .banner-text p strong {
                color: #c7d2fe;
                font-weight: 700;
            }

            .banner-pills {
                display: flex;
                gap: 12px;
                flex-shrink: 0;
                position: relative;
                z-index: 2;
            }

            .b-pill {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.14);
                border-radius: var(--radius);
                padding: 18px 26px;
                text-align: center;
                min-width: 100px;
                transition: var(--transition);
            }

            .b-pill:hover {
                background: rgba(255, 255, 255, 0.18);
                transform: translateY(-4px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            }

            .b-pill-val {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.65rem;
                font-weight: 800;
                display: block;
                line-height: 1;
                margin-bottom: 5px;
                text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .b-pill-lbl {
                font-size: 0.68rem;
                font-weight: 600;
                opacity: 0.7;
                text-transform: uppercase;
                letter-spacing: 0.6px;
            }

            .banner-action {
                position: relative;
                z-index: 2;
                flex-shrink: 0;
            }

            .btn-hero {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: #fff;
                color: var(--primary-dark);
                padding: 14px 30px;
                border-radius: var(--radius-sm);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.88rem;
                font-weight: 800;
                text-decoration: none;
                border: none;
                cursor: pointer;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
                transition: var(--transition);
                letter-spacing: -0.2px;
            }

            .btn-hero:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
                color: var(--primary-dark);
                text-decoration: none;
            }

            .btn-hero:active {
                transform: translateY(-1px);
            }

            .btn-hero i {
                font-size: 20px;
            }

            /* ═══════════════════════════════════════════
               STAT CARDS - Premium Glass
            ═══════════════════════════════════════════ */
            .stats-row {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
                margin-bottom: 32px;
            }

            .s-card {
                background: #fff;
                border-radius: var(--radius-md);
                border: 1px solid rgba(226, 232, 240, 0.8);
                padding: 26px 28px 22px;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
                backdrop-filter: blur(10px);
            }

            .s-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                opacity: 0;
                transition: opacity 0.35s, transform 0.35s;
                transform: scaleX(0);
            }

            .s-card:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-lg);
                border-color: transparent;
            }

            .s-card:hover::before {
                opacity: 1;
                transform: scaleX(1);
            }

            .s-card.emerald::before {
                background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
            }

            .s-card.sky::before {
                background: linear-gradient(90deg, #3b82f6, #60a5fa, #93c5fd);
            }

            .s-card.rose::before {
                background: linear-gradient(90deg, #ef4444, #f87171, #fca5a5);
            }

            .s-card.amber::before {
                background: linear-gradient(90deg, #f59e0b, #fbbf24, #fde68a);
            }

            .s-card-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 14px;
                margin-bottom: 18px;
            }

            .s-card-label {
                font-size: 0.72rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.8px;
            }

            .s-card-icon {
                width: 52px;
                height: 52px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-size: 26px;
                flex-shrink: 0;
                transition: var(--transition-spring);
            }

            .s-card:hover .s-card-icon {
                transform: scale(1.12) rotate(-8deg);
            }

            .s-card-icon.emerald {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
            }

            .s-card-icon.sky {
                background: linear-gradient(135deg, #eff6ff, #dbeafe);
                color: #2563eb;
            }

            .s-card-icon.rose {
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
                color: #dc2626;
            }

            .s-card-icon.amber {
                background: linear-gradient(135deg, #fffbeb, #fef3c7);
                color: #d97706;
            }

            .s-card-val {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 2.2rem;
                font-weight: 800;
                color: var(--slate-900);
                line-height: 1;
                letter-spacing: -1px;
                margin-bottom: 12px;
            }

            .s-card-badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                font-size: 0.72rem;
                font-weight: 700;
                padding: 5px 12px;
                border-radius: 24px;
            }

            .s-card-badge.up {
                background: #ecfdf5;
                color: #059669;
            }

            .s-card-badge.down {
                background: #fef2f2;
                color: #dc2626;
            }

            .s-card-badge.flat {
                background: var(--slate-100);
                color: var(--slate-500);
            }

            .s-card-badge i {
                font-size: 14px;
            }

            .s-card-bar {
                height: 4px;
                background: var(--slate-100);
                border-radius: 4px;
                margin-top: 16px;
                overflow: hidden;
            }

            .s-card-bar-fill {
                height: 100%;
                border-radius: 4px;
                width: 0;
                transition: width 1.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .s-card-bar-fill.emerald {
                background: linear-gradient(90deg, #10b981, #6ee7b7);
            }

            .s-card-bar-fill.sky {
                background: linear-gradient(90deg, #3b82f6, #93c5fd);
            }

            .s-card-bar-fill.rose {
                background: linear-gradient(90deg, #ef4444, #fca5a5);
            }

            .s-card-bar-fill.amber {
                background: linear-gradient(90deg, #f59e0b, #fde68a);
            }

            /* ═══════════════════════════════════════════
               SECTION HEADER
            ═══════════════════════════════════════════ */
            .sec-header {
                display: flex;
                align-items: center;
                gap: 16px;
                margin-bottom: 20px;
                margin-top: 8px;
            }

            .sec-header-icon {
                width: 40px;
                height: 40px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-size: 20px;
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                color: var(--primary);
                box-shadow: 0 2px 8px rgba(99, 102, 241, 0.1);
            }

            .sec-header h3 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.12rem;
                font-weight: 800;
                color: var(--slate-900);
                letter-spacing: -0.3px;
            }

            .sec-header .sec-line {
                flex: 1;
                height: 1px;
                background: linear-gradient(90deg, var(--slate-200), transparent);
            }

            .sec-header .sec-tag {
                font-size: 0.67rem;
                font-weight: 700;
                color: var(--primary);
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                padding: 5px 16px;
                border-radius: 24px;
                letter-spacing: 0.4px;
                text-transform: uppercase;
                border: 1px solid rgba(99, 102, 241, 0.1);
            }

            /* ═══════════════════════════════════════════
               TABLE CARD - Premium
            ═══════════════════════════════════════════ */
            .tbl-card {
                background: #fff;
                border-radius: var(--radius-md);
                border: 1px solid rgba(226, 232, 240, 0.8);
                overflow: hidden;
                transition: var(--transition);
                margin-bottom: 32px;
            }

            .tbl-card:hover {
                box-shadow: var(--shadow-md);
                border-color: var(--slate-300);
            }

            .tbl-card-header {
                padding: 22px 28px 16px;
                display: flex;
                align-items: center;
                gap: 14px;
                border-bottom: 1px solid var(--slate-100);
                background: linear-gradient(180deg, var(--slate-25), #fff);
                flex-wrap: wrap;
            }

            .tbl-card-header-icon {
                width: 42px;
                height: 42px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-size: 20px;
                box-shadow: var(--shadow-xs);
            }

            .tbl-card-header-icon.indigo {
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                color: #6366f1;
            }

            .tbl-card-header h4 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.98rem;
                font-weight: 800;
                color: var(--slate-900);
                letter-spacing: -0.2px;
            }

            .tbl-card-header .tbl-count {
                font-size: 0.67rem;
                font-weight: 700;
                color: var(--slate-400);
                background: var(--slate-100);
                padding: 4px 12px;
                border-radius: 14px;
                letter-spacing: 0.3px;
            }

            .tbl-card-header .tbl-spacer {
                flex: 1;
            }

            /* ── Search & Filters ── */
            .tbl-toolbar {
                padding: 16px 28px;
                display: flex;
                align-items: center;
                gap: 12px;
                border-bottom: 1px solid var(--slate-100);
                background: var(--slate-25);
                flex-wrap: wrap;
            }

            .tbl-search {
                position: relative;
                flex: 1;
                min-width: 240px;
                max-width: 380px;
            }

            .tbl-search input {
                width: 100%;
                padding: 10px 16px 10px 42px;
                border-radius: var(--radius-sm);
                border: 1.5px solid var(--slate-200);
                font-size: 0.82rem;
                font-family: 'Inter', sans-serif;
                font-weight: 500;
                transition: var(--transition);
                background: #fff;
                color: var(--slate-800);
            }

            .tbl-search input::placeholder {
                color: var(--slate-400);
            }

            .tbl-search input:focus {
                border-color: var(--primary);
                outline: none;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .tbl-search i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--slate-400);
                font-size: 16px;
            }

            .tbl-filter-group {
                display: flex;
                background: var(--slate-100);
                border-radius: var(--radius-sm);
                padding: 4px;
                gap: 3px;
                border: 1px solid var(--slate-200);
            }

            .tbl-filter-btn {
                border-radius: var(--radius-xs);
                padding: 7px 16px;
                font-size: 0.73rem;
                font-weight: 700;
                letter-spacing: 0.3px;
                border: none;
                color: var(--slate-500);
                background: transparent;
                cursor: pointer;
                transition: var(--transition-fast);
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-family: 'Inter', sans-serif;
            }

            .tbl-filter-btn:hover {
                color: var(--slate-700);
                background: rgba(255, 255, 255, 0.6);
            }

            .tbl-filter-btn.active {
                background: #fff;
                color: var(--primary);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            }

            .tbl-filter-btn .f-count {
                font-size: 0.64rem;
                font-weight: 800;
                background: var(--slate-200);
                padding: 2px 7px;
                border-radius: 10px;
                color: var(--slate-500);
                transition: var(--transition-fast);
            }

            .tbl-filter-btn.active .f-count {
                background: rgba(99, 102, 241, 0.1);
                color: var(--primary);
            }

            .tbl-view-toggle {
                display: flex;
                background: var(--slate-100);
                border-radius: var(--radius-sm);
                padding: 4px;
                gap: 3px;
                border: 1px solid var(--slate-200);
                margin-left: auto;
            }

            .tbl-view-btn {
                width: 34px;
                height: 34px;
                border-radius: var(--radius-xs);
                border: none;
                background: transparent;
                color: var(--slate-400);
                cursor: pointer;
                transition: var(--transition-fast);
                display: grid;
                place-items: center;
                font-size: 17px;
            }

            .tbl-view-btn:hover {
                color: var(--slate-600);
            }

            .tbl-view-btn.active {
                background: #fff;
                color: var(--primary);
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            }

            /* ── Table ── */
            .tbl-card table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.83rem;
            }

            .tbl-card thead th {
                font-size: 0.67rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.8px;
                padding: 14px 24px;
                border-bottom: 1px solid var(--slate-100);
                background: var(--slate-50);
                white-space: nowrap;
                text-align: left;
                position: sticky;
                top: 0;
                z-index: 5;
            }

            .tbl-card tbody td {
                padding: 18px 24px;
                color: var(--slate-700);
                font-weight: 500;
                border-bottom: 1px solid var(--slate-50);
                vertical-align: middle;
            }

            .tbl-card tbody tr {
                transition: var(--transition-fast);
                position: relative;
            }

            .tbl-card tbody tr::after {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 0;
                background: var(--primary);
                border-radius: 0 3px 3px 0;
                transition: width 0.25s;
            }

            .tbl-card tbody tr:hover::after {
                width: 3px;
            }

            .tbl-card tbody tr:last-child td {
                border-bottom: 0;
            }

            .tbl-card tbody tr:hover {
                background: var(--slate-25);
            }

            /* ── Client Cell ── */
            .client-cell {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .client-avatar {
                width: 44px;
                height: 44px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-weight: 800;
                font-size: 14px;
                color: #fff;
                flex-shrink: 0;
                text-transform: uppercase;
                position: relative;
                transition: var(--transition-spring);
            }

            .tbl-card tbody tr:hover .client-avatar {
                transform: scale(1.08) rotate(-3deg);
            }

            .client-avatar.av-indigo {
                background: linear-gradient(135deg, #6366f1, #818cf8);
            }

            .client-avatar.av-rose {
                background: linear-gradient(135deg, #f43f5e, #fb7185);
            }

            .client-avatar.av-cyan {
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
            }

            .client-avatar.av-amber {
                background: linear-gradient(135deg, #f59e0b, #fbbf24);
            }

            .client-avatar.av-emerald {
                background: linear-gradient(135deg, #10b981, #34d399);
            }

            .client-avatar.av-violet {
                background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            }

            .client-avatar .av-status {
                position: absolute;
                bottom: -3px;
                right: -3px;
                width: 14px;
                height: 14px;
                border-radius: 50%;
                border: 2.5px solid #fff;
            }

            .av-status.online {
                background: var(--success);
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
            }

            .av-status.offline {
                background: var(--danger);
                box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
            }

            .client-details {
                display: flex;
                flex-direction: column;
                gap: 2px;
            }

            .client-name {
                font-weight: 700;
                color: var(--slate-800);
                font-size: 0.86rem;
                letter-spacing: -0.2px;
                transition: color 0.2s;
            }

            .tbl-card tbody tr:hover .client-name {
                color: var(--primary);
            }

            .client-meta {
                font-size: 0.74rem;
                color: var(--slate-400);
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .client-meta i {
                font-size: 13px;
                color: var(--slate-300);
            }

            /* ── Product Cell ── */
            .product-cell {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .product-icon-box {
                width: 38px;
                height: 38px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-size: 18px;
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                color: var(--primary);
                flex-shrink: 0;
                transition: var(--transition);
            }

            .tbl-card tbody tr:hover .product-icon-box {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(99, 102, 241, 0.18));
            }

            .product-info .product-name {
                font-weight: 700;
                color: var(--slate-800);
                font-size: 0.84rem;
            }

            .product-info .product-model {
                font-size: 0.72rem;
                color: var(--slate-400);
                margin-top: 2px;
            }

            /* ── Date Cell ── */
            .date-cell {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .date-row {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 0.8rem;
            }

            .date-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                flex-shrink: 0;
            }

            .date-dot.start {
                background: var(--success);
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
            }

            .date-dot.end {
                background: var(--danger);
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
            }

            .date-label {
                font-size: 0.65rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                width: 36px;
            }

            .date-val {
                font-weight: 600;
                color: var(--slate-700);
                font-size: 0.8rem;
            }

            .date-progress {
                height: 4px;
                background: var(--slate-100);
                border-radius: 4px;
                margin-top: 6px;
                overflow: hidden;
            }

            .date-progress-fill {
                height: 100%;
                border-radius: 4px;
                transition: width 1s ease;
            }

            .date-progress-fill.active {
                background: linear-gradient(90deg, #10b981, #6ee7b7);
            }

            .date-progress-fill.expired {
                background: linear-gradient(90deg, #ef4444, #fca5a5);
            }

            .days-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                font-size: 0.66rem;
                font-weight: 700;
                padding: 3px 10px;
                border-radius: 20px;
                margin-top: 6px;
            }

            .days-tag.safe {
                background: #ecfdf5;
                color: #059669;
                border: 1px solid rgba(5, 150, 105, 0.08);
            }

            .days-tag.warn {
                background: #fffbeb;
                color: #d97706;
                border: 1px solid rgba(217, 119, 6, 0.08);
            }

            .days-tag.critical {
                background: #fef2f2;
                color: #dc2626;
                border: 1px solid rgba(220, 38, 38, 0.08);
            }

            .days-tag i {
                font-size: 12px;
            }

            /* ── Amount ── */
            .amount-val {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-weight: 800;
                color: var(--slate-900);
                font-size: 0.95rem;
                letter-spacing: -0.3px;
            }

            .amount-sub {
                font-size: 0.68rem;
                color: var(--slate-400);
                font-weight: 500;
                margin-top: 2px;
            }

            /* ── Status Badge ── */
            .tbl-badge {
                display: inline-flex;
                align-items: center;
                font-weight: 700;
                font-size: 0.68rem;
                padding: 5px 12px;
                border-radius: var(--radius-xs);
                letter-spacing: 0.3px;
                gap: 5px;
            }

            .tbl-badge .badge-pulse {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                display: inline-block;
            }

            .tbl-badge.success {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
                border: 1px solid rgba(5, 150, 105, 0.08);
            }

            .tbl-badge.success .badge-pulse {
                background: #10b981;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
                animation: pulseDot 2s ease-in-out infinite;
            }

            .tbl-badge.danger {
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
                color: #dc2626;
                border: 1px solid rgba(220, 38, 38, 0.08);
            }

            .tbl-badge.danger .badge-pulse {
                background: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
            }

            @keyframes pulseDot {

                0%,
                100% {
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
                }

                50% {
                    box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
                }
            }

            /* ── Notes ── */
            .notes-text {
                font-size: 0.78rem;
                color: var(--slate-500);
                max-width: 170px;
                line-height: 1.6;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .notes-empty {
                color: var(--slate-300);
                font-size: 0.78rem;
                font-style: italic;
            }

            /* ── Action Buttons ── */
            .act-btns {
                display: flex;
                gap: 5px;
            }

            .act-btn {
                width: 34px;
                height: 34px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                border: 1px solid var(--slate-200);
                background: #fff;
                color: var(--slate-400);
                cursor: pointer;
                transition: var(--transition);
                font-size: 16px;
                text-decoration: none;
            }

            .act-btn:hover {
                background: var(--primary-light);
                border-color: rgba(99, 102, 241, 0.3);
                color: var(--primary);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.12);
            }

            .act-btn.act-edit:hover {
                background: var(--warning-light);
                border-color: rgba(245, 158, 11, 0.3);
                color: var(--warning-dark);
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.12);
            }

            .act-btn.act-delete:hover {
                background: var(--danger-light);
                border-color: rgba(239, 68, 68, 0.3);
                color: var(--danger);
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.12);
            }

            .act-btn.act-renew:hover {
                background: var(--success-light);
                border-color: rgba(16, 185, 129, 0.3);
                color: var(--success-dark);
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.12);
            }

            /* ── Table Footer ── */
            .tbl-footer {
                padding: 16px 28px;
                border-top: 1px solid var(--slate-100);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: linear-gradient(180deg, #fff, var(--slate-25));
                flex-wrap: wrap;
                gap: 12px;
            }

            .tbl-footer-info {
                font-size: 0.78rem;
                color: var(--slate-400);
                font-weight: 500;
            }

            .tbl-footer-info strong {
                color: var(--slate-700);
                font-weight: 700;
            }

            .tbl-footer-actions {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .btn-export {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 20px;
                border-radius: var(--radius-xs);
                font-size: 0.78rem;
                font-weight: 700;
                font-family: 'Inter', sans-serif;
                background: #fff;
                color: var(--slate-600);
                border: 1.5px solid var(--slate-200);
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
                letter-spacing: -0.1px;
            }

            .btn-export:hover {
                border-color: var(--primary);
                color: var(--primary);
                background: var(--primary-50);
                transform: translateY(-1px);
            }

            .btn-export i {
                font-size: 16px;
            }

            /* ── Grid View ── */
            .grid-view {
                display: none;
                grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
                gap: 18px;
                padding: 24px 28px;
            }

            .grid-view.active {
                display: grid;
            }

            .grid-item {
                background: #fff;
                border-radius: var(--radius);
                border: 1px solid rgba(226, 232, 240, 0.8);
                padding: 24px;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .grid-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .grid-item:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-lg);
                border-color: transparent;
            }

            .grid-item:hover::before {
                opacity: 1;
            }

            .grid-item.g-active::before {
                background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
            }

            .grid-item.g-expired::before {
                background: linear-gradient(90deg, #ef4444, #f87171, #fca5a5);
            }

            .grid-item-head {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 20px;
            }

            .grid-item-body .g-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 9px 0;
                border-bottom: 1px dashed var(--slate-100);
            }

            .grid-item-body .g-row:last-child {
                border-bottom: none;
            }

            .g-row-label {
                font-size: 0.68rem;
                color: var(--slate-400);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .g-row-value {
                font-size: 0.84rem;
                font-weight: 700;
                color: var(--slate-800);
            }

            .grid-item-foot {
                margin-top: 18px;
                padding-top: 14px;
                border-top: 1px solid var(--slate-100);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* ── Empty State ── */
            .no-results-state {
                display: none;
                text-align: center;
                padding: 72px 28px;
            }

            .no-results-state.show {
                display: block;
            }

            .no-results-icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                display: grid;
                place-items: center;
                margin: 0 auto 20px;
                font-size: 32px;
                color: var(--primary);
            }

            .no-results-state h4 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.1rem;
                font-weight: 800;
                color: var(--slate-800);
                margin-bottom: 6px;
            }

            .no-results-state p {
                color: var(--slate-400);
                font-size: 0.88rem;
                max-width: 340px;
                margin: 0 auto;
                line-height: 1.6;
            }

            /* ── Scrollbar ── */
            .table-scroll::-webkit-scrollbar {
                height: 5px;
            }

            .table-scroll::-webkit-scrollbar-track {
                background: var(--slate-100);
            }

            .table-scroll::-webkit-scrollbar-thumb {
                background: var(--slate-300);
                border-radius: 50px;
            }

            .table-scroll::-webkit-scrollbar-thumb:hover {
                background: var(--slate-400);
            }

            /* ── Animations ── */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(16px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .banner {
                animation: fadeInUp 0.5s ease-out;
            }

            .s-card {
                animation: fadeInUp 0.5s ease-out backwards;
            }

            .s-card:nth-child(1) {
                animation-delay: 0.05s;
            }

            .s-card:nth-child(2) {
                animation-delay: 0.10s;
            }

            .s-card:nth-child(3) {
                animation-delay: 0.15s;
            }

            .s-card:nth-child(4) {
                animation-delay: 0.20s;
            }

            .tbl-card {
                animation: fadeInUp 0.5s ease-out 0.25s backwards;
            }

            .amc-row {
                animation: fadeInUp 0.4s ease-out backwards;
            }

            /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

            @media (max-width: 1200px) {
                .stats-row {
                    grid-template-columns: repeat(2, 1fr);
                }

                .banner-pills {
                    display: none;
                }
            }

            @media (max-width: 768px) {

                /* ── Page ── */
                .page-content {
                    padding: 14px 10px 32px;
                }

                /* ── Banner ── */
                .banner {
                    padding: 24px 20px;
                    border-radius: var(--radius-lg);
                    margin-bottom: 20px;
                }

                .banner-inner {
                    flex-direction: column;
                    gap: 16px;
                }

                .banner-text h2 {
                    font-size: 1.4rem;
                }

                .banner-text p {
                    font-size: 0.88rem;
                    max-width: 100%;
                }

                .btn-hero {
                    width: 100%;
                    justify-content: center;
                    padding: 13px 20px;
                }

                /* ── Stats ── */
                .stats-row {
                    gap: 12px;
                    margin-bottom: 20px;
                }

                .s-card {
                    padding: 18px 18px 14px;
                }

                .s-card-val {
                    font-size: 1.75rem;
                }

                .s-card-icon {
                    width: 44px;
                    height: 44px;
                    font-size: 22px;
                }

                /* ── Section header ── */
                .sec-header {
                    margin-bottom: 14px;
                }

                /* ── Table card header ── */
                .tbl-card-header {
                    padding: 16px 14px 12px;
                    gap: 10px;
                }

                .tbl-card-header h4 {
                    font-size: 0.9rem;
                }

                .tbl-card-header-icon {
                    width: 36px;
                    height: 36px;
                    font-size: 18px;
                }

                /* ── Toolbar ── */
                .tbl-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 12px 14px;
                    gap: 10px;
                }

                .tbl-search {
                    max-width: 100%;
                    min-width: unset;
                }

                .tbl-search input {
                    width: 100%;
                }

                .tbl-filter-group {
                    width: 100%;
                    justify-content: space-between;
                }

                .tbl-filter-btn {
                    flex: 1;
                    justify-content: center;
                    padding: 7px 8px;
                    font-size: 0.7rem;
                }

                .tbl-view-toggle {
                    margin-left: 0;
                    align-self: flex-end;
                }

                /* ══════════════════════════════════════════
       TABLE → CARD LAYOUT ON MOBILE
    ══════════════════════════════════════════ */

                /* Remove overflow so inner cards render */
                #tableView {
                    overflow: visible !important;
                }

                /* Hide thead */
                #tableView table thead {
                    display: none;
                }

                /* Block layout on table and tbody */
                #tableView table,
                #tableView table tbody {
                    display: block;
                    width: 100%;
                }

                /* Each row = a card */
                #tableView table tbody tr.amc-row {
                    display: block;
                    background: #fff;
                    border: 1px solid var(--slate-200);
                    border-radius: 14px;
                    padding: 14px;
                    margin-bottom: 10px;
                    position: relative;
                    overflow: hidden;
                    animation: none !important;
                }

                /* Left accent bar per status */
                #tableView table tbody tr.amc-row[data-status="active"]::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 4px;
                    background: linear-gradient(180deg, #10b981, #34d399);
                    border-radius: 4px 0 0 4px;
                }

                #tableView table tbody tr.amc-row[data-status="expired"]::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 4px;
                    background: linear-gradient(180deg, #ef4444, #fca5a5);
                    border-radius: 4px 0 0 4px;
                }

                /* Hide all cells by default */
                #tableView table tbody tr.amc-row td {
                    display: none;
                    padding: 0;
                    border: none;
                    font-size: 0.83rem;
                }

                /* ── Client — top row with badge ── */
                #tableView table tbody tr.amc-row td:nth-child(1) {
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;
                    padding-left: 8px;
                    padding-bottom: 12px;
                    margin-bottom: 10px;
                    border-bottom: 1px solid var(--slate-100);
                }

                /* ── Status badge — float right in client row (handled via flex above) ── */
                #tableView table tbody tr.amc-row td:nth-child(5) {
                    display: none;
                    /* merged into client row via layout below */
                }

                /* ── Product ── */
                #tableView table tbody tr.amc-row td:nth-child(2) {
                    display: block;
                    padding-left: 8px;
                    padding-bottom: 10px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid var(--slate-100);
                }

                #tableView table tbody tr.amc-row td:nth-child(2)::before {
                    content: "Product";
                    display: block;
                    font-size: 0.65rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 6px;
                }

                /* ── Contract Period ── */
                #tableView table tbody tr.amc-row td:nth-child(3) {
                    display: block;
                    padding-left: 8px;
                    padding-bottom: 10px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid var(--slate-100);
                }

                #tableView table tbody tr.amc-row td:nth-child(3)::before {
                    content: "Contract Period";
                    display: block;
                    font-size: 0.65rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 6px;
                }

                /* ── Value + Status — inline row ── */
                #tableView table tbody tr.amc-row td:nth-child(4) {
                    display: inline-flex;
                    flex-direction: column;
                    padding-left: 8px;
                    padding-top: 4px;
                    width: 50%;
                    vertical-align: top;
                }

                #tableView table tbody tr.amc-row td:nth-child(4)::before {
                    content: "Value";
                    display: block;
                    font-size: 0.65rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 4px;
                }

                /* ── Actions ── */
                #tableView table tbody tr.amc-row td:nth-child(6) {
                    display: flex;
                    padding-top: 12px;
                    margin-top: 10px;
                    border-top: 1px solid var(--slate-100);
                    justify-content: flex-end;
                    padding-left: 8px;
                }

                /* Adjust inner elements */
                .client-cell {
                    gap: 10px;
                }

                .client-avatar {
                    width: 38px;
                    height: 38px;
                    font-size: 12px;
                    border-radius: 10px;
                }

                .client-name {
                    font-size: 0.88rem;
                }

                .client-meta {
                    font-size: 0.72rem;
                }

                .product-cell {
                    gap: 10px;
                }

                .product-icon-box {
                    width: 32px;
                    height: 32px;
                    font-size: 16px;
                }

                .product-name {
                    font-size: 0.84rem;
                }

                .product-model {
                    font-size: 0.7rem;
                }

                .date-cell {
                    gap: 3px;
                }

                .date-row {
                    font-size: 0.78rem;
                }

                .date-label {
                    width: 32px;
                }

                .amount-val {
                    font-size: 1rem;
                }

                .act-btns {
                    justify-content: flex-end;
                    gap: 6px;
                }

                .act-btn {
                    width: 36px;
                    height: 36px;
                    font-size: 17px;
                }

                /* ── Grid view on mobile ── */
                .grid-view {
                    grid-template-columns: 1fr;
                    padding: 12px 14px;
                    gap: 12px;
                }

                /* ── Footer ── */
                .tbl-footer {
                    padding: 14px 14px;
                    flex-direction: column;
                    align-items: center;
                    gap: 10px;
                    text-align: center;
                }

                .btn-export {
                    width: 100%;
                    justify-content: center;
                }

                /* ── No results ── */
                .no-results-state {
                    padding: 48px 16px;
                }
            }

            @media (max-width: 480px) {
                .page-content {
                    padding: 10px 8px 28px;
                }

                .stats-row {
                    grid-template-columns: 1fr;
                    gap: 10px;
                }

                .banner-text h2 {
                    font-size: 1.2rem;
                }

                .banner {
                    padding: 20px 16px;
                }

                .tbl-card-header {
                    padding: 14px 12px 10px;
                }

                .tbl-toolbar {
                    padding: 10px 12px;
                }

                /* Stack value + actions vertically on very small */
                #tableView table tbody tr.amc-row td:nth-child(4) {
                    display: block;
                    width: 100%;
                    border-bottom: 1px solid var(--slate-100);
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                }
            }
        </style>

        <?php
        $active_amc = 0;
        $expired_amc = 0;
        $total_value = 0;
        $today = strtotime(date('Y-m-d'));
        $expiring_soon = 0;

        foreach ($amcs as $amc) {
            $end_ts = strtotime($amc->end_date);
            $is_active = (int) $amc->status === 1 && $end_ts >= $today;

            if ($is_active) {
                $active_amc++;
                $days_left = floor(($end_ts - $today) / 86400);
                if ($days_left <= 30)
                    $expiring_soon++;
            } else {
                $expired_amc++;
            }

            $total_value += (float) $amc->amc_amount;
        }

        $total_count = count($amcs);
        $active_pct = $total_count > 0 ? round(($active_amc / $total_count) * 100) : 0;
        $avatar_classes = ['av-indigo', 'av-rose', 'av-cyan', 'av-amber', 'av-emerald', 'av-violet'];
        ?>

        <!-- ═══════ BANNER ═══════ -->
        <!-- <div class="banner">
            <div class="banner-grid-pattern"></div>
            <div class="banner-inner">
                <div class="banner-text">
                    <h2><i class="bx bx-shield-quarter" style="vertical-align: middle; margin-right: 6px;"></i> AMC
                        Management</h2>
                    <p>Track, manage and renew your <strong>Annual Maintenance Contracts</strong> with precision and
                        ease.</p>
                </div>
                <div class="banner-pills">
                    <div class="b-pill">
                        <span class="b-pill-val">
                            <?= $total_count ?>
                        </span>
                        <span class="b-pill-lbl">Total</span>
                    </div>
                    <div class="b-pill">
                        <span class="b-pill-val">
                            <?= $active_amc ?>
                        </span>
                        <span class="b-pill-lbl">Active</span>
                    </div>
                    <div class="b-pill">
                        <span class="b-pill-val">₹
                            <?= number_format($total_value / 1000, 1) ?>K
                        </span>
                        <span class="b-pill-lbl">Revenue</span>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="banner-action">
            <a href="<?= site_url('admin/amc/add') ?>" class="btn-hero">
                <i class="bx bx-plus-circle"></i> Create Contract
            </a>
        </div>



        <!-- ═══════ SECTION HEADER ═══════ -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <?= htmlspecialchars($this->session->flashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <?= htmlspecialchars($this->session->flashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="sec-header">
            <!-- <div class="sec-header-icon">
                <i class="bx bx-list-check"></i>
            </div> -->
            <!-- <h3>Contract Records</h3> -->
            <div class="sec-line"></div>
            <span class="sec-tag">
                <?= date('M Y') ?>
            </span>
        </div>

        <!-- ═══════ TABLE CARD ═══════ -->
        <div class="tbl-card">
            <div class="tbl-card-header">
                <div class="tbl-card-header-icon indigo">
                    <i class="bx bx-file"></i>
                </div>
                <h4>All AMC Contracts</h4>
                <span class="tbl-count">
                    <?= $total_count ?> RECORDS
                </span>
                <div class="tbl-spacer"></div>
            </div>

            <!-- Toolbar -->
            <div class="tbl-toolbar">
                <!-- <div class="tbl-search">
                    <i class="bx bx-search"></i>
                    <input type="text" id="amcSearchInput" placeholder="Search name, mobile, product...">
                </div> -->

                <!-- <div class="tbl-filter-group" id="filterGroup">
                    <button class="tbl-filter-btn active" data-filter="">
                        All <span class="f-count">
                            <?= $total_count ?>
                        </span>
                    </button>
                    <button class="tbl-filter-btn" data-filter="active">
                        <i class="bx bxs-circle" style="font-size:6px; color:var(--success);"></i>
                        Active <span class="f-count">
                            <?= $active_amc ?>
                        </span>
                    </button>
                    <button class="tbl-filter-btn" data-filter="expired">
                        <i class="bx bxs-circle" style="font-size:6px; color:var(--danger);"></i>
                        Expired <span class="f-count">
                            <?= $expired_amc ?>
                        </span>
                    </button>
                </div> -->

                <div class="tbl-view-toggle">
                    <button class="tbl-view-btn active" data-view="table" title="Table View">
                        <i class="bx bx-list-ul"></i>
                    </button>
                    <button class="tbl-view-btn" data-view="grid" title="Grid View">
                        <i class="bx bx-grid-alt"></i>
                    </button>
                </div>
            </div>

            <!-- TABLE VIEW -->
            <div class="table-scroll" id="tableView" style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Product</th>
                            <th>Contract Period</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="amcTableBody">
                        <?php
                        $idx = 0;
                        foreach ($amcs as $amc):
                            $end_ts = strtotime($amc->end_date);
                            $start_ts = strtotime($amc->start_date);
                            $is_active = (int) $amc->status === 1 && $end_ts >= $today;
                            $days_left = floor(($end_ts - $today) / 86400);
                            $initials = strtoupper(substr($amc->customer_name, 0, 2));
                            $av_class = $avatar_classes[$idx % count($avatar_classes)];

                            // Progress calculation
                            $total_days = max(floor(($end_ts - $start_ts) / 86400), 1);
                            $elapsed = floor(($today - $start_ts) / 86400);
                            $progress = min(max(round(($elapsed / $total_days) * 100), 0), 100);
                            if (!$is_active)
                                $progress = 100;

                            $days_class = 'safe';
                            if (!$is_active)
                                $days_class = 'critical';
                            elseif ($days_left <= 30)
                                $days_class = 'critical';
                            elseif ($days_left <= 90)
                                $days_class = 'warn';

                            $idx++;
                        ?>
                            <tr class="amc-row"
                                data-search="<?= strtolower($amc->customer_name . ' ' . $amc->customer_mobile . ' ' . $amc->product_name) ?>"
                                data-status="<?= $is_active ? 'active' : 'expired' ?>"
                                style="animation-delay: <?= ($idx * 0.04) ?>s">

                                <!-- Client -->
                                <td>
                                    <div class="client-cell">
                                        <div class="client-avatar <?= $av_class ?>">
                                            <?= $initials ?>
                                            <span class="av-status <?= $is_active ? 'online' : 'offline' ?>"></span>
                                        </div>
                                        <div class="client-details">
                                            <span class="client-name">
                                                <?= htmlspecialchars($amc->customer_name) ?>
                                            </span>
                                            <span class="client-meta"><i class="bx bx-phone"></i>
                                                <?= htmlspecialchars($amc->customer_mobile) ?>
                                            </span>
                                            <span class="client-meta"><i class="bx bx-map"></i>
                                                <?= htmlspecialchars($amc->customer_address) ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Product -->
                                <td>
                                    <div class="product-cell">
                                        <div class="product-icon-box">
                                            <i class="bx bx-box"></i>
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name">
                                                <?= htmlspecialchars($amc->product_name) ?>
                                            </div>
                                            <div class="product-model">
                                                <?= $amc->product_modal ?: 'N/A' ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contract Period -->
                                <td>
                                    <div class="date-cell">
                                        <div class="date-row">
                                            <span class="date-dot start"></span>
                                            <span class="date-label">Start</span>
                                            <span class="date-val">
                                                <?= date('d M, Y', $start_ts) ?>
                                            </span>
                                        </div>
                                        <div class="date-row">
                                            <span class="date-dot end"></span>
                                            <span class="date-label">End</span>
                                            <span class="date-val">
                                                <?= date('d M, Y', $end_ts) ?>
                                            </span>
                                        </div>
                                        <div class="date-progress">
                                            <div class="date-progress-fill <?= $is_active ? 'active' : 'expired' ?>"
                                                data-width="<?= $progress ?>"></div>
                                        </div>
                                        <?php if ($is_active): ?>
                                            <span class="days-tag <?= $days_class ?>">
                                                <i class="bx bx-time-five"></i>
                                                <?= $days_left ?> days left
                                            </span>
                                        <?php else: ?>
                                            <span class="days-tag critical">
                                                <i class="bx bx-x-circle"></i> Expired
                                                <?= abs($days_left) ?>d ago
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Value -->
                                <td>
                                    <div class="amount-val">₹
                                        <?= number_format($amc->amc_amount, 0) ?>
                                    </div>
                                    <div class="amount-sub">per year</div>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="tbl-badge <?= $is_active ? 'success' : 'danger' ?>">
                                        <span class="badge-pulse"></span>
                                        <?= $is_active ? 'Active' : 'Expired' ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="act-btns" style="justify-content:center;">
                                        <a href="<?= site_url('admin/amc/view/' . $amc->id) ?>" class="act-btn"
                                            title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="<?= site_url('admin/amc/edit/' . $amc->id) ?>" class="act-btn act-edit"
                                            title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <?php if (!$is_active): ?>
                                            <a href="<?= site_url('admin/amc/renew/' . $amc->id) ?>" class="act-btn act-renew"
                                                title="Renew">
                                                <i class="bx bx-refresh"></i>
                                            </a>
                                        <?php endif; ?>
                                        <button class="act-btn act-delete" title="Delete"
                                            onclick="if(confirm('Delete this contract?')) window.location='<?= site_url('admin/amc/delete/' . $amc->id) ?>'">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="no-results-state" id="noResults">
                    <div class="no-results-icon">
                        <i class="bx bx-search-alt"></i>
                    </div>
                    <h4>No contracts found</h4>
                    <p>Try adjusting your search or filter to find what you're looking for.</p>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div class="grid-view" id="gridView">
                <?php
                $idx = 0;
                foreach ($amcs as $amc):
                    $end_ts = strtotime($amc->end_date);
                    $is_active = (int) $amc->status === 1 && $end_ts >= $today;
                    $days_left = floor(($end_ts - $today) / 86400);
                    $initials = strtoupper(substr($amc->customer_name, 0, 2));
                    $av_class = $avatar_classes[$idx % count($avatar_classes)];
                    $idx++;

                    $days_class = 'safe';
                    if (!$is_active)
                        $days_class = 'critical';
                    elseif ($days_left <= 30)
                        $days_class = 'critical';
                    elseif ($days_left <= 90)
                        $days_class = 'warn';
                ?>
                    <div class="grid-item <?= $is_active ? 'g-active' : 'g-expired' ?> amc-grid-item"
                        data-search="<?= strtolower($amc->customer_name . ' ' . $amc->customer_mobile . ' ' . $amc->product_name) ?>"
                        data-status="<?= $is_active ? 'active' : 'expired' ?>">

                        <div class="grid-item-head">
                            <div class="client-cell">
                                <div class="client-avatar <?= $av_class ?>" style="width:40px;height:40px;font-size:13px;">
                                    <?= $initials ?>
                                </div>
                                <div class="client-details">
                                    <span class="client-name">
                                        <?= htmlspecialchars($amc->customer_name) ?>
                                    </span>
                                    <span class="client-meta"><i class="bx bx-phone"></i>
                                        <?= htmlspecialchars($amc->customer_mobile) ?>
                                    </span>
                                </div>
                            </div>
                            <span class="tbl-badge <?= $is_active ? 'success' : 'danger' ?>"
                                style="font-size:0.64rem; padding:4px 10px;">
                                <span class="badge-pulse"></span>
                                <?= $is_active ? 'Active' : 'Expired' ?>
                            </span>
                        </div>

                        <div class="grid-item-body">
                            <div class="g-row">
                                <span class="g-row-label">Product</span>
                                <span class="g-row-value">
                                    <?= htmlspecialchars($amc->product_name) ?>
                                </span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Model</span>
                                <span class="g-row-value" style="color:var(--slate-500); font-weight:600;">
                                    <?= $amc->product_modal ?: 'N/A' ?>
                                </span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Period</span>
                                <span class="g-row-value" style="font-size:0.76rem;">
                                    <?= date('d M, Y', strtotime($amc->start_date)) ?> —
                                    <?= date('d M, Y', $end_ts) ?>
                                </span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Value</span>
                                <span class="g-row-value amount-val" style="font-size:0.92rem;">₹
                                    <?= number_format($amc->amc_amount, 0) ?>
                                </span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Remaining</span>
                                <span class="days-tag <?= $days_class ?>" style="font-size:0.62rem;">
                                    <?php if ($is_active): ?>
                                        <i class="bx bx-time-five"></i>
                                        <?= $days_left ?> days left
                                    <?php else: ?>
                                        <i class="bx bx-x-circle"></i> Expired
                                        <?= abs($days_left) ?>d ago
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                        <div class="grid-item-foot">
                            <div class="act-btns">
                                <a href="<?= site_url('admin/amc/view/' . $amc->id) ?>" class="act-btn" title="View">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="<?= site_url('admin/amc/edit/' . $amc->id) ?>" class="act-btn act-edit"
                                    title="Edit">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <?php if (!$is_active): ?>
                                    <a href="<?= site_url('admin/amc/renew/' . $amc->id) ?>" class="act-btn act-renew"
                                        title="Renew">
                                        <i class="bx bx-refresh"></i>
                                    </a>
                                <?php endif; ?>
                                <button class="act-btn act-delete" title="Delete"
                                    onclick="if(confirm('Delete this contract?')) window.location='<?= site_url('admin/amc/delete/' . $amc->id) ?>'">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Footer -->
            <div class="tbl-footer">
                <div class="tbl-footer-info">
                    Showing <strong id="visibleCount">
                        <?= $total_count ?>
                    </strong> of <strong>
                        <?= $total_count ?>
                    </strong> contracts
                </div>
                <div class="tbl-footer-actions">
                    <button class="btn-export" onclick="exportCSV()">
                        <i class="bx bx-download"></i> Export CSV
                    </button>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                // ── Animated Counters ──
                function animateCounters() {
                    $('.s-card-val').each(function() {
                        const $el = $(this);
                        const target = parseFloat($el.data('count'));
                        if (isNaN(target)) return;
                        const prefix = $el.data('prefix') || '';
                        const isCurrency = $el.data('format') === 'currency';
                        const duration = 1400;
                        const start = performance.now();

                        function step(now) {
                            const progress = Math.min((now - start) / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 4);
                            const current = Math.floor(target * eased);

                            if (isCurrency) {
                                $el.text(prefix + current.toLocaleString('en-IN'));
                            } else {
                                $el.text(prefix + current.toLocaleString());
                            }

                            if (progress < 1) requestAnimationFrame(step);
                        }
                        requestAnimationFrame(step);
                    });
                }

                // ── Bar Animations ──
                function animateBars() {
                    $('.s-card-bar-fill, .date-progress-fill').each(function() {
                        const w = $(this).data('width');
                        if (w !== undefined) $(this).css('width', w + '%');
                    });
                }

                setTimeout(animateCounters, 200);
                setTimeout(animateBars, 500);

                // ── Search & Filter ──
                function filterTable() {
                    const keyword = $('#amcSearchInput').val().toLowerCase().trim();
                    const status = $('#filterGroup .tbl-filter-btn.active').data('filter') || '';
                    let visible = 0;

                    $('.amc-row').each(function() {
                        const textOk = !keyword || $(this).data('search').indexOf(keyword) !== -1;
                        const statusOk = !status || $(this).data('status') === status;
                        const show = textOk && statusOk;
                        $(this).toggle(show);
                        if (show) visible++;
                    });

                    $('.amc-grid-item').each(function() {
                        const textOk = !keyword || $(this).data('search').indexOf(keyword) !== -1;
                        const statusOk = !status || $(this).data('status') === status;
                        $(this).toggle(textOk && statusOk);
                    });

                    $('#visibleCount').text(visible);
                    if (visible === 0) {
                        $('#noResults').addClass('show');
                    } else {
                        $('#noResults').removeClass('show');
                    }
                }

                $('#amcSearchInput').on('input', filterTable);

                $('#filterGroup .tbl-filter-btn').on('click', function() {
                    $('#filterGroup .tbl-filter-btn').removeClass('active');
                    $(this).addClass('active');
                    filterTable();
                });

                // ── View Toggle ──
                $('.tbl-view-btn').on('click', function() {
                    const view = $(this).data('view');
                    $('.tbl-view-btn').removeClass('active');
                    $(this).addClass('active');

                    if (view === 'grid') {
                        $('#tableView').hide();
                        $('#gridView').addClass('active');
                    } else {
                        $('#gridView').removeClass('active');
                        $('#tableView').show();
                    }
                });

                // ── Row stagger ──
                $('.amc-row').each(function(i) {
                    $(this).css('animation-delay', (i * 0.04) + 's');
                });
            });

            // ── Export CSV ──
            function exportCSV() {
                let csv = 'Client Name,Mobile,Product,Model,Start Date,End Date,Amount,Status\n';

                $('.amc-row:visible').each(function() {
                    const tds = $(this).find('td');
                    const name = $(tds[0]).find('.client-name').text().trim();
                    const mobile = $(tds[0]).find('.client-meta').first().text().trim();
                    const product = $(tds[1]).find('.product-name').text().trim();
                    const model = $(tds[1]).find('.product-model').text().trim();
                    const dates = $(tds[2]).find('.date-val');
                    const start = $(dates[0]).text().trim();
                    const end = $(dates[1]).text().trim();
                    const amount = $(tds[3]).find('.amount-val').text().trim();
                    const status = $(tds[4]).find('.tbl-badge').text().trim();

                    csv += `"${name}","${mobile}","${product}","${model}","${start}","${end}","${amount}","${status}"\n`;
                });

                const blob = new Blob([csv], {
                    type: 'text/csv'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'amc_contracts_' + new Date().toISOString().split('T')[0] + '.csv';
                a.click();
                URL.revokeObjectURL(url);
            }
        </script>
    </div>
</div>