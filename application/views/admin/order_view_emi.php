    <div class="page-wrapper">
        <div class="page-content">

            <style>
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

                :root {
                    --primary: #4361ee;
                    --primary-dark: #3a56d4;
                    --primary-light: rgba(67, 97, 238, 0.08);
                    --primary-glow: rgba(67, 97, 238, 0.15);
                    --accent: #7209b7;
                    --success: #06d6a0;
                    --success-dark: #05b88a;
                    --success-light: rgba(6, 214, 160, 0.08);
                    --warning: #ff9f1c;
                    --warning-dark: #e88c0a;
                    --warning-light: rgba(255, 159, 28, 0.08);
                    --danger: #ef476f;
                    --danger-light: rgba(239, 71, 111, 0.08);
                    --text: #1a1d2e;
                    --text-secondary: #4a4f6a;
                    --text-muted: #8b90a8;
                    --border: #e8eaf2;
                    --border-light: #f1f3f8;
                    --bg-body: #f5f7fb;
                    --bg-card: #ffffff;
                    --shadow-xs: 0 1px 3px rgba(0, 0, 0, 0.04);
                    --shadow-sm: 0 2px 12px rgba(0, 0, 0, 0.06);
                    --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
                    --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.10);
                    --radius-sm: 8px;
                    --radius: 14px;
                    --radius-lg: 18px;
                    --radius-xl: 22px;
                }

                .emi-page-container * {
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                    box-sizing: border-box;
                }

                .emi-page-container {
                    max-width: 1200px;
                    margin: 0 auto;
                }

                /* ═══════════════════════════════════════
                PAGE HEADER
                ═══════════════════════════════════════ */
                .emi-hero {
                    background: linear-gradient(135deg, #4361ee 0%, #7209b7 50%, #560bad 100%);
                    border-radius: var(--radius-xl);
                    padding: 32px 36px;
                    margin-bottom: 28px;
                    color: #fff;
                    position: relative;
                    overflow: hidden;
                }

                .emi-hero::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    right: -20%;
                    width: 400px;
                    height: 400px;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
                    border-radius: 50%;
                }

                .emi-hero::after {
                    content: '';
                    position: absolute;
                    bottom: -30%;
                    left: 10%;
                    width: 250px;
                    height: 250px;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
                    border-radius: 50%;
                }

                .emi-hero-inner {
                    position: relative;
                    z-index: 2;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 20px;
                }

                .emi-hero-breadcrumb {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    margin-bottom: 12px;
                    flex-wrap: wrap;
                }

                .emi-hero-breadcrumb a,
                .emi-hero-breadcrumb span {
                    font-size: 13px;
                    font-weight: 500;
                    text-decoration: none;
                    transition: color 0.2s;
                }

                .emi-hero-breadcrumb a {
                    color: rgba(255, 255, 255, 0.65);
                }

                .emi-hero-breadcrumb a:hover {
                    color: #fff;
                }

                .emi-hero-breadcrumb .bc-sep {
                    color: rgba(255, 255, 255, 0.35);
                    font-size: 11px;
                }

                .emi-hero-breadcrumb .bc-active {
                    color: rgba(255, 255, 255, 0.9);
                }

                .emi-hero h1 {
                    font-size: 26px;
                    font-weight: 800;
                    margin: 0 0 6px;
                    letter-spacing: -0.5px;
                }

                .emi-hero-sub {
                    margin: 0;
                    opacity: 0.7;
                    font-size: 14px;
                    font-weight: 500;
                }

                .emi-hero-back {
                    padding: 11px 24px;
                    border-radius: 12px;
                    background: rgba(255, 255, 255, 0.12);
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                    color: #fff;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    font-size: 13px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .emi-hero-back:hover {
                    background: rgba(255, 255, 255, 0.22);
                    transform: translateY(-1px);
                    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
                    color: #fff;
                }

                .emi-hero-back i {
                    font-size: 18px;
                    transition: transform 0.2s;
                }

                .emi-hero-back:hover i {
                    transform: translateX(-3px);
                }

                /* ═══════════════════════════════════════
                ORDER DETAILS GRID
                ═══════════════════════════════════════ */
                .emi-details-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 24px;
                    margin-bottom: 28px;
                }

                .emi-detail-card {
                    background: var(--bg-card);
                    border-radius: var(--radius-lg);
                    border: 1px solid var(--border);
                    box-shadow: var(--shadow-xs);
                    overflow: hidden;
                    transition: all 0.3s ease;
                }

                .emi-detail-card:hover {
                    box-shadow: var(--shadow-md);
                    border-color: #dde0ec;
                }

                .emi-detail-card-header {
                    padding: 20px 24px;
                    border-bottom: 1px solid var(--border-light);
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    background: linear-gradient(135deg, rgba(67, 97, 238, 0.02), transparent);
                }

                .emi-detail-card-icon {
                    width: 40px;
                    height: 40px;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 18px;
                    flex-shrink: 0;
                }

                .emi-detail-card-icon.purple {
                    background: var(--primary-light);
                    color: var(--primary);
                }

                .emi-detail-card-icon.green {
                    background: var(--success-light);
                    color: var(--success-dark);
                }

                .emi-detail-card-header h5 {
                    margin: 0;
                    font-size: 15px;
                    font-weight: 700;
                    color: var(--text);
                    letter-spacing: -0.2px;
                }

                .emi-detail-card-body {
                    padding: 6px 0;
                }

                .emi-info-row {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 14px 24px;
                    transition: background 0.15s;
                }

                .emi-info-row+.emi-info-row {
                    border-top: 1px solid var(--border-light);
                }

                .emi-info-row:hover {
                    background: rgba(67, 97, 238, 0.015);
                }

                .emi-info-label {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    font-size: 13px;
                    font-weight: 500;
                    color: var(--text-muted);
                }

                .emi-info-label i {
                    font-size: 17px;
                    color: var(--primary);
                    opacity: 0.5;
                }

                .emi-info-value {
                    font-size: 14px;
                    font-weight: 600;
                    color: var(--text);
                    text-align: right;
                }

                .emi-price-highlight {
                    font-size: 17px;
                    font-weight: 800;
                    background: linear-gradient(135deg, var(--primary), var(--accent));
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .emi-type-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 5px 14px;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: 700;
                    background: var(--primary-light);
                    color: var(--primary);
                    letter-spacing: 0.2px;
                }

                .emi-type-badge .badge-dot {
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: var(--primary);
                    animation: badgePulse 2s ease-in-out infinite;
                }

                @keyframes badgePulse {

                    0%,
                    100% {
                        opacity: 1;
                        transform: scale(1);
                    }

                    50% {
                        opacity: 0.5;
                        transform: scale(0.8);
                    }
                }

                /* ═══════════════════════════════════════
                STATS STRIP
                ═══════════════════════════════════════ */
                .emi-stats-strip {
                    display: grid;
                    grid-template-columns: 2fr repeat(3, 1fr);
                    gap: 20px;
                    margin-bottom: 24px;
                }

                .emi-stat-product {
                    background: var(--bg-card);
                    border-radius: var(--radius-lg);
                    border: 1px solid var(--border);
                    box-shadow: var(--shadow-xs);
                    padding: 24px;
                    display: flex;
                    align-items: center;
                    gap: 18px;
                    transition: all 0.3s ease;
                }

                .emi-stat-product:hover {
                    box-shadow: var(--shadow-md);
                }

                .emi-stat-product-icon {
                    width: 60px;
                    height: 60px;
                    border-radius: 16px;
                    background: linear-gradient(135deg, var(--primary-light), rgba(114, 9, 183, 0.06));
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 28px;
                    flex-shrink: 0;
                }

                .emi-stat-product-info h4 {
                    margin: 0 0 4px;
                    font-size: 17px;
                    font-weight: 700;
                    color: var(--text);
                    letter-spacing: -0.3px;
                }

                .emi-stat-product-price {
                    font-size: 24px;
                    font-weight: 900;
                    color: var(--primary);
                    margin: 0;
                    letter-spacing: -0.5px;
                }

                .emi-stat-product-price small {
                    font-size: 12px;
                    color: var(--text-muted);
                    font-weight: 500;
                    margin-left: 4px;
                }

                .emi-stat-mini {
                    background: var(--bg-card);
                    border-radius: var(--radius-lg);
                    border: 1px solid var(--border);
                    box-shadow: var(--shadow-xs);
                    padding: 22px 20px;
                    text-align: center;
                    transition: all 0.3s ease;
                    position: relative;
                    overflow: hidden;
                }

                .emi-stat-mini::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    border-radius: 3px 3px 0 0;
                }

                .emi-stat-mini.blue::before {
                    background: linear-gradient(90deg, var(--primary), #818cf8);
                }

                .emi-stat-mini.green::before {
                    background: linear-gradient(90deg, var(--success), #34d399);
                }

                .emi-stat-mini.orange::before {
                    background: linear-gradient(90deg, var(--warning), #fbbf24);
                }

                .emi-stat-mini:hover {
                    box-shadow: var(--shadow-md);
                    transform: translateY(-3px);
                }

                .emi-stat-mini-num {
                    font-size: 28px;
                    font-weight: 900;
                    display: block;
                    line-height: 1;
                    margin-bottom: 6px;
                    letter-spacing: -1px;
                }

                .emi-stat-mini.blue .emi-stat-mini-num {
                    color: var(--primary);
                }

                .emi-stat-mini.green .emi-stat-mini-num {
                    color: var(--success-dark);
                }

                .emi-stat-mini.orange .emi-stat-mini-num {
                    color: var(--warning-dark);
                }

                .emi-stat-mini-label {
                    font-size: 11px;
                    font-weight: 700;
                    color: var(--text-muted);
                    text-transform: uppercase;
                    letter-spacing: 0.8px;
                }

                /* ═══════════════════════════════════════
                PROGRESS SECTION
                ═══════════════════════════════════════ */
                .emi-progress-card {
                    background: var(--bg-card);
                    border-radius: var(--radius-lg);
                    box-shadow: var(--shadow-xs);
                    border: 1px solid var(--border);
                    padding: 22px 28px;
                    margin-bottom: 24px;
                    transition: box-shadow 0.3s;
                }

                .emi-progress-card:hover {
                    box-shadow: var(--shadow-sm);
                }

                .emi-progress-top {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 14px;
                }

                .emi-progress-title {
                    font-size: 14px;
                    font-weight: 700;
                    color: var(--text);
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }

                .emi-progress-title i {
                    color: var(--success);
                    font-size: 18px;
                }

                .emi-progress-meta {
                    font-size: 13px;
                    font-weight: 600;
                    color: var(--text-muted);
                }

                .emi-progress-meta b {
                    color: var(--success-dark);
                }

                .emi-progress-track {
                    width: 100%;
                    height: 10px;
                    background: #eef0f7;
                    border-radius: 20px;
                    overflow: hidden;
                    position: relative;
                }

                .emi-progress-fill {
                    height: 100%;
                    border-radius: 20px;
                    background: linear-gradient(90deg, var(--success), #14b8a6, #06d6a0);
                    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                }

                .emi-progress-fill::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                    animation: progressShine 2s ease-in-out infinite;
                }

                @keyframes progressShine {
                    0% {
                        transform: translateX(-100%);
                    }

                    100% {
                        transform: translateX(100%);
                    }
                }

                /* ═══════════════════════════════════════
                TABLE CARD
                ═══════════════════════════════════════ */
                .emi-table-card {
                    background: var(--bg-card);
                    border-radius: var(--radius-lg);
                    box-shadow: var(--shadow-xs);
                    border: 1px solid var(--border);
                    overflow: hidden;
                    margin-bottom: 24px;
                    transition: box-shadow 0.3s;
                }

                .emi-table-card:hover {
                    box-shadow: var(--shadow-sm);
                }

                .emi-table-card-header {
                    padding: 20px 28px;
                    border-bottom: 1px solid var(--border);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    background: linear-gradient(135deg, #fafbff, #f8f9fe);
                }

                .emi-table-card-header h5 {
                    font-size: 16px;
                    font-weight: 700;
                    color: var(--text);
                    margin: 0;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    letter-spacing: -0.2px;
                }

                .emi-table-card-header h5 i {
                    font-size: 22px;
                    color: var(--primary);
                }

                .emi-table-card-header .header-badge {
                    padding: 4px 12px;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: 700;
                    background: var(--primary-light);
                    color: var(--primary);
                }

                .emi-tbl-wrap {
                    overflow-x: auto;
                }

                .emi-tbl {
                    width: 100%;
                    border-collapse: collapse;
                }

                .emi-tbl thead th {
                    background: #f8f9fe;
                    padding: 14px 24px;
                    font-size: 11px;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    color: var(--text-muted);
                    border-bottom: 1.5px solid var(--border);
                    text-align: left;
                    white-space: nowrap;
                }

                .emi-tbl thead th:last-child {
                    text-align: right;
                }

                .emi-tbl tbody tr {
                    transition: all 0.2s;
                }

                .emi-tbl tbody tr:hover {
                    background: linear-gradient(90deg, rgba(67, 97, 238, 0.015), rgba(114, 9, 183, 0.01));
                }

                .emi-tbl tbody td {
                    padding: 18px 24px;
                    font-size: 14px;
                    color: var(--text);
                    border-bottom: 1px solid var(--border-light);
                    vertical-align: middle;
                }

                .emi-tbl tbody td:last-child {
                    text-align: right;
                }

                .emi-tbl tbody tr:last-child td {
                    border-bottom: none;
                }

                /* Cell Elements */
                .emi-cell-num {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 36px;
                    height: 36px;
                    border-radius: 10px;
                    background: var(--primary-light);
                    color: var(--primary);
                    font-weight: 800;
                    font-size: 13px;
                    transition: all 0.2s;
                }

                tr:hover .emi-cell-num {
                    background: var(--primary-glow);
                }

                .emi-cell-date {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    font-size: 13px;
                    color: var(--text-secondary);
                    font-weight: 500;
                }

                .emi-cell-date i {
                    font-size: 16px;
                    color: var(--text-muted);
                }

                .emi-cell-amount {
                    font-weight: 700;
                    font-size: 14px;
                    color: var(--text);
                    font-variant-numeric: tabular-nums;
                }

                /* Status Chips */
                .emi-chip {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 6px 14px;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: 700;
                    letter-spacing: 0.1px;
                }

                .emi-chip-dot {
                    width: 7px;
                    height: 7px;
                    border-radius: 50%;
                    flex-shrink: 0;
                }

                .emi-chip.is-paid {
                    background: var(--success-light);
                    color: var(--success-dark);
                }

                .emi-chip.is-paid .emi-chip-dot {
                    background: var(--success);
                }

                .emi-chip.is-pending {
                    background: var(--warning-light);
                    color: var(--warning-dark);
                }

                .emi-chip.is-pending .emi-chip-dot {
                    background: var(--warning);
                    animation: pendingPulse 1.5s ease-in-out infinite;
                }

                .emi-chip.is-completed {
                    background: var(--success-light);
                    color: var(--success-dark);
                }

                .emi-chip.is-completed .emi-chip-dot {
                    background: var(--success);
                }

                @keyframes pendingPulse {

                    0%,
                    100% {
                        opacity: 1;
                    }

                    50% {
                        opacity: 0.3;
                    }
                }

                /* Action Buttons */
                .emi-btn-action {
                    padding: 8px 20px;
                    border-radius: 10px;
                    font-size: 12px;
                    font-weight: 700;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    border: none;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-family: 'Inter', sans-serif;
                }

                .emi-btn-action.btn-pay {
                    background: linear-gradient(135deg, var(--success), #14b8a6);
                    color: #fff;
                    box-shadow: 0 3px 12px rgba(6, 214, 160, 0.3);
                }

                .emi-btn-action.btn-pay:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(6, 214, 160, 0.4);
                    color: #fff;
                }

                .emi-btn-action.btn-pay:active {
                    transform: translateY(0);
                }

                .emi-btn-action.btn-service {
                    background: linear-gradient(135deg, var(--primary), var(--accent));
                    color: #fff;
                    box-shadow: 0 3px 12px rgba(67, 97, 238, 0.3);
                }

                .emi-btn-action.btn-service:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
                    color: #fff;
                }

                .emi-completed-tag {
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                    padding: 8px 16px;
                    border-radius: 10px;
                    background: var(--success-light);
                    color: var(--success-dark);
                    font-size: 12px;
                    font-weight: 700;
                }

                .emi-completed-tag i {
                    font-size: 16px;
                }

                /* ═══════════════════════════════════════
                SERVICE PROGRESS
                ═══════════════════════════════════════ */
                .emi-service-progress {
                    padding: 18px 28px;
                    border-bottom: 1px solid var(--border-light);
                }

                .emi-service-progress-bar {
                    display: flex;
                    gap: 4px;
                    margin-top: 10px;
                }

                .emi-service-seg {
                    flex: 1;
                    height: 6px;
                    border-radius: 10px;
                    background: #eef0f7;
                    transition: all 0.3s;
                }

                .emi-service-seg.filled {
                    background: linear-gradient(90deg, var(--primary), var(--accent));
                }

                /* ═══════════════════════════════════════
                EMPTY STATE
                ═══════════════════════════════════════ */
                .emi-empty-state {
                    text-align: center;
                    padding: 60px 24px;
                    color: var(--text-muted);
                }

                .emi-empty-state i {
                    font-size: 48px;
                    opacity: 0.2;
                    margin-bottom: 12px;
                }

                .emi-empty-state p {
                    font-size: 14px;
                    font-weight: 500;
                    margin: 0;
                }

                /* ═══════════════════════════════════════
                RESPONSIVE
                ═══════════════════════════════════════ */
                @media (max-width: 992px) {
                    .emi-stats-strip {
                        grid-template-columns: 1fr 1fr;
                    }

                    .emi-stat-product {
                        grid-column: 1 / -1;
                    }
                }

                @media (max-width: 768px) {
                    .emi-hero {
                        padding: 24px 22px;
                        border-radius: var(--radius-lg);
                    }

                    .emi-hero h1 {
                        font-size: 22px;
                    }

                    .emi-hero-inner {
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .emi-details-grid {
                        grid-template-columns: 1fr;
                    }

                    .emi-stats-strip {
                        grid-template-columns: 1fr;
                    }

                    .emi-stat-product {
                        flex-direction: column;
                        text-align: center;
                    }

                    .emi-stat-mini {
                        padding: 18px;
                    }

                    .emi-tbl thead th,
                    .emi-tbl tbody td {
                        padding: 14px 16px;
                    }

                    .emi-table-card-header {
                        padding: 16px 20px;
                    }

                    .emi-progress-card {
                        padding: 18px 20px;
                    }

                    .emi-info-row {
                        padding: 12px 18px;
                    }
                }

                @media (max-width: 480px) {
                    .emi-stats-strip {
                        grid-template-columns: repeat(3, 1fr);
                    }

                    .emi-stat-product {
                        grid-column: 1 / -1;
                    }

                    .emi-stat-mini-num {
                        font-size: 22px;
                    }

                    .emi-stat-mini-label {
                        font-size: 10px;
                    }

                    .emi-stat-mini {
                        padding: 16px 12px;
                    }
                }
            </style>

            <div class="emi-page-container">

                <!-- ═══ Hero Header ═══ -->
                <div class="emi-hero">
                    <div class="emi-hero-inner">
                        <div>
                            <div class="emi-hero-breadcrumb">
                                <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i> Dashboard</a>
                                <span class="bc-sep">›</span>
                                <a href="<?= base_url('index.php/admin/orders'); ?>">Orders</a>
                                <span class="bc-sep">›</span>
                                <span class="bc-active">EMI Details</span>
                            </div>
                            <h1>EMI Order Details</h1>
                            <p class="emi-hero-sub">Track and manage installment payments for this order</p>
                        </div>
                        <a href="<?= base_url('index.php/admin/orders'); ?>" class="emi-hero-back">
                            <i class="bx bx-arrow-back"></i> Back to Orders
                        </a>
                    </div>
                </div>

                <!-- ═══ Order Details Grid ═══ -->
                <div class="emi-details-grid">

                    <!-- Product Info -->
                    <div class="emi-detail-card">
                        <div class="emi-detail-card-header">
                            <div class="emi-detail-card-icon purple">
                                <i class="bx bx-package"></i>
                            </div>
                            <h5>Product Information</h5>
                        </div>
                        <div class="emi-detail-card-body">
                            <div class="emi-info-row">
                                <div class="emi-info-label">
                                    <i class="bx bx-cube"></i> Product Name
                                </div>
                                <div class="emi-info-value"><?= htmlspecialchars($order->product_name) ?></div>
                            </div>
                            <div class="emi-info-row">
                                <div class="emi-info-label">
                                    <i class="bx bx-chip"></i> Model
                                </div>
                                <div class="emi-info-value"><?= htmlspecialchars($order->product_modal) ?></div>
                            </div>
                            <div class="emi-info-row">
                                <div class="emi-info-label">
                                    <i class="bx bx-purchase-tag"></i> Price
                                </div>
                                <div class="emi-info-value">
                                    <span class="emi-price-highlight">₹<?= number_format((float) $order->price, 2) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="emi-detail-card">
                        <div class="emi-detail-card-header">
                            <div class="emi-detail-card-icon green">
                                <i class="bx bx-credit-card-front"></i>
                            </div>
                            <h5>Payment Information</h5>
                        </div>
                        <div class="emi-detail-card-body">
                            <div class="emi-info-row">
                                <div class="emi-info-label">
                                    <i class="bx bx-calendar"></i> Purchase Date
                                </div>
                                <div class="emi-info-value"><?= date('d M Y', strtotime($order->date_of_purchase)) ?></div>
                            </div>
                            <div class="emi-info-row">
                                <div class="emi-info-label">
                                    <i class="bx bx-wallet"></i> Payment Type
                                </div>
                                <div class="emi-info-value">
                                    <span class="emi-type-badge">
                                        <span class="badge-dot"></span> Installment (EMI)
                                    </span>
                                </div>
                            </div>
                            <?php if (!empty($order->down_payment)) { ?>
                                <div class="emi-info-row">
                                    <div class="emi-info-label">
                                        <i class="bx bx-down-arrow-circle"></i> Down Payment
                                    </div>
                                    <div class="emi-info-value">
                                        <span
                                            class="emi-price-highlight">₹<?= number_format((float) $order->down_payment, 2) ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- ═══ Stats Strip ═══ -->
                <?php
                $total_emis = count($emis);
                $paid_emis = 0;
                foreach ($emis as $e) {
                    if ($e->status == 1)
                        $paid_emis++;
                }
                $pending_emis = $total_emis - $paid_emis;
                $progress = $total_emis > 0 ? round(($paid_emis / $total_emis) * 100) : 0;
                $emi_amount = $total_emis > 0 ? (float) $order->price / $total_emis : 0;

                $total_services = count($services);
                $completed_services = 0;
                foreach ($services as $s) {
                    if ($s->status == 1)
                        $completed_services++;
                }
                $service_progress = $total_services > 0 ? round(($completed_services / $total_services) * 100) : 0;
                ?>

                <div class="emi-stats-strip">
                    <div class="emi-stat-product">
                        <div class="emi-stat-product-icon">📦</div>
                        <div class="emi-stat-product-info">
                            <h4><?= htmlspecialchars($order->product_name) ?></h4>
                            <p class="emi-stat-product-price">
                                ₹<?= number_format((float) $order->price, 2) ?>
                                <small>Total Amount</small>
                            </p>
                        </div>
                    </div>
                    <div class="emi-stat-mini blue">
                        <span class="emi-stat-mini-num"><?= $total_emis ?></span>
                        <span class="emi-stat-mini-label">Total EMIs</span>
                    </div>
                    <div class="emi-stat-mini green">
                        <span class="emi-stat-mini-num"><?= $paid_emis ?></span>
                        <span class="emi-stat-mini-label">Paid</span>
                    </div>
                    <div class="emi-stat-mini orange">
                        <span class="emi-stat-mini-num"><?= $pending_emis ?></span>
                        <span class="emi-stat-mini-label">Pending</span>
                    </div>
                </div>

                <!-- ═══ Progress Bar ═══ -->
                <div class="emi-progress-card">
                    <div class="emi-progress-top">
                        <span class="emi-progress-title">
                            <i class="bx bx-trending-up"></i> Payment Progress
                        </span>
                        <span class="emi-progress-meta">
                            <b><?= $paid_emis ?></b> of <?= $total_emis ?> EMIs paid (<?= $progress ?>%)
                        </span>
                    </div>
                    <div class="emi-progress-track">
                        <div class="emi-progress-fill" style="width: <?= $progress ?>%"></div>
                    </div>
                </div>

                <!-- ═══ EMI Schedule Table ═══ -->
                <div class="emi-table-card">
                    <div class="emi-table-card-header">
                        <h5><i class="bx bx-calendar-check"></i> EMI Schedule</h5>
                        <span class="header-badge"><?= $total_emis ?> Installments</span>
                    </div>
                    <div class="emi-tbl-wrap">
                        <table class="emi-tbl">
                            <thead>
                                <tr>
                                    <th>EMI #</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($emis)) { ?>
                                    <?php foreach ($emis as $e) { ?>
                                        <tr>
                                            <td><span class="emi-cell-num"><?= $e->emi_number ?></span></td>
                                            <td>
                                                <span class="emi-cell-date">
                                                    <i class="bx bx-calendar"></i>
                                                    <?= date('d M Y', strtotime($e->emi_date)) ?>
                                                </span>
                                            </td>
                                            <td><span class="emi-cell-amount">₹<?= number_format($emi_amount, 2) ?></span></td>
                                            <td>
                                                <?php if ($e->status == 1) { ?>
                                                    <span class="emi-chip is-paid">
                                                        <span class="emi-chip-dot"></span> Paid
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="emi-chip is-pending">
                                                        <span class="emi-chip-dot"></span> Pending
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($e->status == 0) { ?>
                                                    <a href="<?= base_url('index.php/admin/orders/update_emi/' . $e->id) ?>"
                                                        class="emi-btn-action btn-pay"
                                                        onclick="return confirm('Mark EMI #<?= $e->emi_number ?> as paid?')">
                                                        <i class="bx bx-check"></i> Mark Paid
                                                    </a>
                                                <?php } else { ?>
                                                    <span class="emi-completed-tag">
                                                        <i class="bx bx-check-circle"></i> Done
                                                    </span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="emi-empty-state">
                                                <i class="bx bx-calendar-x"></i>
                                                <p>No EMI schedule found for this order.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ═══ Service Schedule Table ═══ -->
                <div class="emi-table-card">
                    <div class="emi-table-card-header">
                        <h5><i class="bx bx-wrench"></i> Service Schedule</h5>
                        <span class="header-badge"><?= $total_services ?> Services</span>
                    </div>

                    <!-- Service Segment Progress -->
                    <?php if ($total_services > 0) { ?>
                        <div class="emi-service-progress">
                            <div class="emi-progress-top" style="margin-bottom: 6px;">
                                <span class="emi-progress-title" style="font-size: 13px;">
                                    <i class="bx bx-check-double" style="color: var(--primary);"></i> Service Completion
                                </span>
                                <span class="emi-progress-meta">
                                    <b><?= $completed_services ?></b> of <?= $total_services ?> done (<?= $service_progress ?>%)
                                </span>
                            </div>
                            <div class="emi-service-progress-bar">
                                <?php for ($i = 0; $i < $total_services; $i++) { ?>
                                    <div class="emi-service-seg <?= $i < $completed_services ? 'filled' : '' ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="emi-tbl-wrap">
                        <table class="emi-tbl">
                            <thead>
                                <tr>
                                    <th>Service #</th>
                                    <th>Scheduled Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($services)) { ?>
                                    <?php foreach ($services as $s) { ?>
                                        <tr>
                                            <td><span class="emi-cell-num"><?= $s->service_number ?></span></td>
                                            <td>
                                                <span class="emi-cell-date">
                                                    <i class="bx bx-calendar"></i>
                                                    <?= date('d M Y', strtotime($s->service_date)) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($s->status == 1) { ?>
                                                    <span class="emi-chip is-completed">
                                                        <span class="emi-chip-dot"></span> Completed
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="emi-chip is-pending">
                                                        <span class="emi-chip-dot"></span> Pending
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($s->status == 0) { ?>
                                                    <a href="<?= base_url('index.php/admin/orders/update_service/' . $s->id) ?>"
                                                        class="emi-btn-action btn-service"
                                                        onclick="return confirm('Mark Service #<?= $s->service_number ?> as completed?')">
                                                        <i class="bx bx-check"></i> Mark Done
                                                    </a>
                                                <?php } else { ?>
                                                    <span class="emi-completed-tag">
                                                        <i class="bx bx-check-circle"></i> Done
                                                    </span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="emi-empty-state">
                                                <i class="bx bx-wrench"></i>
                                                <p>No services scheduled for this order.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>