<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

            :root {
                --cd-primary: #6366f1;
                --cd-primary-dark: #4f46e5;
                --cd-primary-light: #818cf8;
                --cd-secondary: #0d9488;
                --cd-text: #0f172a;
                --cd-text-secondary: #334155;
                --cd-muted: #64748b;
                --cd-light-muted: #94a3b8;
                --cd-border: #e2e8f0;
                --cd-border-light: #f1f5f9;
                --cd-white: #ffffff;
                --cd-bg: #f8fafc;
                --cd-warning: #f59e0b;
                --cd-warning-light: rgba(245, 158, 11, 0.1);
                --cd-success: #10b981;
                --cd-success-light: rgba(16, 185, 129, 0.1);
                --cd-danger: #ef4444;
                --cd-danger-light: rgba(239, 68, 68, 0.08);
                --cd-shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
                --cd-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
                --cd-shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.06), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
                --cd-radius: 16px;
                --cd-radius-sm: 10px;
                --cd-radius-xs: 6px;
                --cd-transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .cd-wrap {
                max-width: 1100px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* ── Flash Messages ── */
            .cd-flash {
                padding: 14px 20px;
                border-radius: var(--cd-radius-sm);
                font-size: 14px;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                animation: cdSlideDown 0.35s ease both;
            }

            .cd-flash i {
                font-size: 20px;
                flex-shrink: 0;
            }

            .cd-flash.success {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(16, 185, 129, 0.03));
                color: #065f46;
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .cd-flash.error {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(239, 68, 68, 0.03));
                color: #991b1b;
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            @keyframes cdSlideDown {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* ── Hero ── */
            .cd-hero {
                position: relative;
                background: linear-gradient(135deg, #4f46e5 0%, #6366f1 30%, #0d9488 100%);
                color: #fff;
                border-radius: 24px;
                padding: 40px 44px;
                margin-bottom: 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                flex-wrap: wrap;
                overflow: hidden;
            }

            .cd-hero::before {
                content: '';
                position: absolute;
                top: -60%;
                right: -10%;
                width: 420px;
                height: 420px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .cd-hero::after {
                content: '';
                position: absolute;
                bottom: -50%;
                left: 15%;
                width: 350px;
                height: 350px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .cd-hero-content {
                position: relative;
                z-index: 1;
            }

            .cd-hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.04em;
                margin-bottom: 14px;
                border: 1px solid rgba(255, 255, 255, 0.12);
            }

            .cd-hero-badge i {
                font-size: 14px;
            }

            .cd-hero h1 {
                margin: 0 0 8px;
                font-size: 32px;
                font-weight: 900;
                letter-spacing: -0.02em;
                line-height: 1.2;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .cd-hero p {
                margin: 0;
                font-size: 15px;
                opacity: 0.85;
                font-weight: 400;
                line-height: 1.5;
            }

            .cd-hero-actions {
                position: relative;
                z-index: 1;
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .cd-back-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 13px 24px;
                border-radius: 14px;
                font-weight: 700;
                font-size: 14px;
                text-decoration: none;
                transition: var(--cd-transition);
                background: rgba(255, 255, 255, 0.95);
                color: var(--cd-primary-dark);
                border: none;
                cursor: pointer;
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
            }

            .cd-back-btn:hover {
                background: #fff;
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                color: var(--cd-primary-dark);
                text-decoration: none;
            }

            .cd-back-btn i {
                font-size: 18px;
            }

            /* ── Status Header Strip ── */
            .cd-status-strip {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 24px;
                border-radius: var(--cd-radius);
                margin-bottom: 24px;
                gap: 16px;
                flex-wrap: wrap;
            }

            .cd-status-strip.pending {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.08), rgba(245, 158, 11, 0.03));
                border: 1px solid rgba(245, 158, 11, 0.2);
            }

            .cd-status-strip.resolved {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(16, 185, 129, 0.03));
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .cd-status-strip.approved {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(16, 185, 129, 0.03));
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .cd-status-strip.reject {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(239, 68, 68, 0.03));
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            .cd-status-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .cd-status-icon {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
            }

            .cd-status-strip.pending .cd-status-icon {
                background: var(--cd-warning-light);
                color: #d97706;
            }

            .cd-status-strip.resolved .cd-status-icon {
                background: var(--cd-success-light);
                color: var(--cd-success);
            }

            .cd-status-strip.approved .cd-status-icon {
                background: var(--cd-success-light);
                color: var(--cd-success);
            }

            .cd-status-strip.reject .cd-status-icon {
                background: var(--cd-danger-light);
                color: #dc2626;
            }

            .cd-status-text {
                font-size: 15px;
                font-weight: 700;
            }

            .cd-status-strip.pending .cd-status-text {
                color: #92400e;
            }

            .cd-status-strip.resolved .cd-status-text {
                color: #065f46;
            }

            .cd-status-strip.approved .cd-status-text {
                color: #065f46;
            }

            .cd-status-strip.reject .cd-status-text {
                color: #991b1b;
            }

            .cd-status-sub {
                font-size: 12px;
                font-weight: 500;
                margin-top: 2px;
            }

            .cd-status-strip.pending .cd-status-sub {
                color: #b45309;
            }

            .cd-status-strip.resolved .cd-status-sub {
                color: #047857;
            }

            .cd-status-strip.approved .cd-status-sub {
                color: #047857;
            }

            .cd-status-strip.reject .cd-status-sub {
                color: #b91c1c;
            }

            .cd-status-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 18px;
                border-radius: 999px;
                font-size: 13px;
                font-weight: 700;
            }

            .cd-status-badge .dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                display: inline-block;
            }

            .cd-status-strip.pending .cd-status-badge {
                background: rgba(245, 158, 11, 0.15);
                color: #92400e;
            }

            .cd-status-strip.pending .cd-status-badge .dot {
                background: var(--cd-warning);
                box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
            }

            .cd-status-strip.resolved .cd-status-badge {
                background: rgba(16, 185, 129, 0.15);
                color: #065f46;
            }

            .cd-status-strip.approved .cd-status-badge {
                background: rgba(16, 185, 129, 0.15);
                color: #065f46;
            }

            .cd-status-strip.reject .cd-status-badge {
                background: rgba(239, 68, 68, 0.15);
                color: #991b1b;
            }

            .cd-status-strip.resolved .cd-status-badge .dot {
                background: var(--cd-success);
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            }

            .cd-status-strip.approved .cd-status-badge .dot {
                background: var(--cd-success);
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            }

            .cd-status-strip.reject .cd-status-badge .dot {
                background: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.18);
            }

            /* ── Grid ── */
            .cd-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                margin-bottom: 20px;
            }

            /* ── Card ── */
            .cd-card {
                background: var(--cd-white);
                border: 1px solid var(--cd-border);
                border-radius: var(--cd-radius);
                box-shadow: var(--cd-shadow);
                overflow: hidden;
                transition: var(--cd-transition);
            }

            .cd-card:hover {
                box-shadow: var(--cd-shadow-md);
                border-color: #cbd5e1;
            }

            .cd-card-header {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cd-border-light);
            }

            .cd-card-header-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
            }

            .cd-card-header-icon.purple {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(99, 102, 241, 0.05));
                color: var(--cd-primary);
            }

            .cd-card-header-icon.teal {
                background: linear-gradient(135deg, rgba(13, 148, 136, 0.12), rgba(13, 148, 136, 0.05));
                color: var(--cd-secondary);
            }

            .cd-card-header-icon.amber {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.12), rgba(245, 158, 11, 0.05));
                color: #d97706;
            }

            .cd-card-title {
                font-size: 15px;
                font-weight: 800;
                color: var(--cd-text);
                letter-spacing: -0.01em;
            }

            .cd-card-body {
                padding: 0;
            }

            .cd-detail-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 14px 24px;
                border-bottom: 1px solid var(--cd-border-light);
                transition: var(--cd-transition);
            }

            .cd-detail-row:last-child {
                border-bottom: none;
            }

            .cd-detail-row:hover {
                background: rgba(99, 102, 241, 0.015);
            }

            .cd-detail-label {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                font-weight: 600;
                color: var(--cd-muted);
                white-space: nowrap;
            }

            .cd-detail-label i {
                font-size: 16px;
                color: var(--cd-light-muted);
                width: 20px;
                text-align: center;
            }

            .cd-detail-value {
                font-size: 14px;
                font-weight: 700;
                color: var(--cd-text);
                text-align: right;
                word-break: break-word;
            }

            /* ── Message Card (Full Width) ── */
            .cd-message-card {
                background: var(--cd-white);
                border: 1px solid var(--cd-border);
                border-radius: var(--cd-radius);
                box-shadow: var(--cd-shadow);
                overflow: hidden;
                transition: var(--cd-transition);
                margin-bottom: 24px;
            }

            .cd-message-card:hover {
                box-shadow: var(--cd-shadow-md);
                border-color: #cbd5e1;
            }

            .cd-message-header {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cd-border-light);
            }

            .cd-message-body {
                padding: 24px;
            }

            .cd-message-box {
                background: var(--cd-bg);
                border: 1px solid var(--cd-border-light);
                border-radius: var(--cd-radius-sm);
                padding: 20px 24px;
                font-size: 14px;
                line-height: 1.8;
                color: var(--cd-text-secondary);
                white-space: pre-wrap;
                word-break: break-word;
                min-height: 80px;
            }

            .cd-message-empty {
                color: var(--cd-light-muted);
                font-style: italic;
                font-size: 14px;
                text-align: center;
                padding: 24px;
            }

            /* ── Timeline / Meta ── */
            .cd-meta-strip {
                display: flex;
                align-items: center;
                gap: 24px;
                padding: 14px 24px;
                background: var(--cd-bg);
                border-top: 1px solid var(--cd-border-light);
                font-size: 12px;
                color: var(--cd-light-muted);
                font-weight: 500;
                flex-wrap: wrap;
            }

            .cd-meta-item {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .cd-meta-item i {
                font-size: 15px;
                color: #cbd5e1;
            }

            /* ── Action Buttons ── */
            .cd-actions {
                display: flex;
                gap: 12px;
                flex-wrap: wrap;
                margin-bottom: 28px;
            }

            .cd-act-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 14px 24px;
                border-radius: var(--cd-radius-sm);
                text-decoration: none;
                font-size: 14px;
                font-weight: 700;
                font-family: inherit;
                transition: var(--cd-transition);
                border: 1px solid transparent;
                cursor: pointer;
                white-space: nowrap;
            }

            .cd-act-btn:hover {
                transform: translateY(-2px);
            }

            .cd-act-btn i {
                font-size: 18px;
            }

            .cd-act-btn.resolve {
                background: linear-gradient(135deg, var(--cd-success), #059669);
                color: #fff;
                box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
            }

            .cd-act-btn.resolve:hover {
                box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
                color: #fff;
                text-decoration: none;
            }

            .cd-act-btn.mark-pending {
                background: linear-gradient(135deg, var(--cd-warning), #d97706);
                color: #fff;
                box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3);
            }

            .cd-act-btn.mark-pending:hover {
                box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
                color: #fff;
                text-decoration: none;
            }

            .cd-act-btn.delete {
                background: var(--cd-danger-light);
                color: #b91c1c;
                border-color: rgba(239, 68, 68, 0.15);
            }

            .cd-act-btn.delete:hover {
                background: rgba(239, 68, 68, 0.15);
                box-shadow: 0 4px 14px rgba(239, 68, 68, 0.12);
                color: #991b1b;
                text-decoration: none;
            }

            .cd-act-btn.whatsapp {
                background: linear-gradient(135deg, #25d366, #128c7e);
                color: #fff;
                box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
            }

            .cd-act-btn.whatsapp:hover {
                box-shadow: 0 8px 20px rgba(37, 211, 102, 0.35);
                color: #fff;
                text-decoration: none;
            }

            .cd-act-btn.call {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(99, 102, 241, 0.03));
                color: var(--cd-primary-dark);
                border-color: rgba(99, 102, 241, 0.15);
            }

            .cd-act-btn.call:hover {
                background: rgba(99, 102, 241, 0.14);
                box-shadow: 0 4px 14px rgba(99, 102, 241, 0.12);
                color: var(--cd-primary-dark);
                text-decoration: none;
            }

            /* ── Responsive ── */
            @media (max-width: 768px) {
                .cd-hero {
                    padding: 28px 24px;
                    border-radius: 20px;
                    flex-direction: column;
                    align-items: flex-start;
                }

                .cd-hero h1 {
                    font-size: 26px;
                }

                .cd-hero-actions {
                    width: 100%;
                }

                .cd-back-btn {
                    width: 100%;
                    justify-content: center;
                }

                .cd-grid {
                    grid-template-columns: 1fr;
                }

                .cd-status-strip {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .cd-actions {
                    flex-direction: column;
                }

                .cd-act-btn {
                    width: 100%;
                    justify-content: center;
                }

                .cd-detail-row {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 4px;
                }

                .cd-detail-value {
                    text-align: left;
                }
            }

            /* ── Animations ── */
            @keyframes cdFadeUp {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .cd-hero {
                animation: cdFadeUp 0.45s ease both;
            }

            .cd-status-strip {
                animation: cdFadeUp 0.45s ease 0.06s both;
            }

            .cd-grid {
                animation: cdFadeUp 0.45s ease 0.12s both;
            }

            .cd-message-card {
                animation: cdFadeUp 0.45s ease 0.18s both;
            }

            .cd-actions {
                animation: cdFadeUp 0.45s ease 0.24s both;
            }
        </style>

        <?php
        $rawStatus = (int) ($complaint->status ?? 0);
        $statusKey = 'approved';
        $statusLabel = 'Approved';
        $statusText = 'This complaint has been approved.';
        if ($rawStatus === 1) {
            $statusKey = 'pending';
            $statusLabel = 'Pending';
            $statusText = 'This complaint is awaiting action.';
        } elseif ($rawStatus === 3) {
            $statusKey = 'reject';
            $statusLabel = 'Reject';
            $statusText = 'This complaint has been rejected.';
        }
        ?>

        <div class="cd-wrap">

            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="cd-flash success">
                    <i class="bx bx-check-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="cd-flash error">
                    <i class="bx bx-error-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Hero -->
            <!-- <div class="cd-hero">
                <div class="cd-hero-content">
                    <div class="cd-hero-badge">
                        <i class="bx bx-message-square-error"></i> Complaint #<?= (int) ($complaint->id ?? 0) ?>
                    </div>
                    <h1>Complaint Details</h1>
                    <p>View full complaint information, manage status and take action directly from here.</p>
                </div>
                <div class="cd-hero-actions">
                    <a href="<?= site_url('admin/complaint') ?>" class="cd-back-btn">
                        <i class="bx bx-arrow-back"></i> Back to List
                    </a>
                </div>
            </div> -->

            <!-- Status Strip -->
            <div class="cd-status-strip <?= $statusKey ?>">
                <div class="cd-status-left">
                    <div class="cd-status-icon">
                        <i class="bx <?= $statusKey === 'pending' ? 'bx-time-five' : ($statusKey === 'reject' ? 'bx-x-circle' : 'bx-check-double') ?>"></i>
                    </div>
                    <div>
                        <div class="cd-status-text"><?= $statusText ?></div>
                        <div class="cd-status-sub">
                            <?php if (!empty($complaint->created_at)): ?>
                                Submitted on <?= date('d M Y \a\t h:i A', strtotime($complaint->created_at)) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="cd-status-badge">
                    <span class="dot"></span>
                    <?= $statusLabel ?>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="cd-grid">
                <!-- Customer Card -->
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-header-icon purple">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="cd-card-title">Customer Information</div>
                    </div>
                    <div class="cd-card-body">
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-user"></i> Name</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->name ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-phone"></i> Mobile</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->mobile ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-home"></i> Address</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->address ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-map"></i> Area</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->area ?? '-') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Product & Issue Card -->
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-header-icon teal">
                            <i class="bx bx-package"></i>
                        </div>
                        <div class="cd-card-title">Product & Issue Details</div>
                    </div>
                    <div class="cd-card-body">
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-package"></i> Product</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->product_name ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-chip"></i> Model / Serial</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->serial_number ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-error-circle"></i> Issue Type</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->issue ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-calendar"></i> Submitted</div>
                            <div class="cd-detail-value">
                                <?= !empty($complaint->created_at) ? date('d M Y, h:i A', strtotime($complaint->created_at)) : '-' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Card -->
            <div class="cd-message-card">
                <div class="cd-message-header">
                    <div class="cd-card-header-icon amber">
                        <i class="bx bx-message-detail"></i>
                    </div>
                    <div class="cd-card-title">Complaint Description</div>
                </div>
                <?php $details = trim((string) ($complaint->complain_details ?? '')); ?>
                <?php if (!empty($details)): ?>
                    <div class="cd-message-body">
                        <div class="cd-message-box"><?= nl2br(htmlspecialchars($details)) ?></div>
                    </div>
                <?php else: ?>
                    <div class="cd-message-empty">
                        <i class="bx bx-info-circle"
                            style="font-size: 18px; vertical-align: middle; margin-right: 6px;"></i>
                        No additional details were provided for this complaint.
                    </div>
                <?php endif; ?>
                <div class="cd-meta-strip">
                    <div class="cd-meta-item">
                        <i class="bx bx-hash"></i>
                        Complaint ID: #<?= (int) ($complaint->id ?? 0) ?>
                    </div>
                    <?php if (!empty($complaint->created_at)): ?>
                        <div class="cd-meta-item">
                            <i class="bx bx-calendar"></i>
                            <?= date('d M Y', strtotime($complaint->created_at)) ?>
                        </div>
                        <div class="cd-meta-item">
                            <i class="bx bx-time-five"></i>
                            <?= date('h:i A', strtotime($complaint->created_at)) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="cd-actions">
                <form method="post" action="<?= site_url('admin/complaint/update_status/' . (int) $complaint->id) ?>"
                    style="display:inline-flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <select name="status" class="form-select" style="min-width:180px; border-radius:12px; font-weight:700;">
                        <option value="1" <?= $statusKey === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="2" <?= $statusKey === 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="3" <?= $statusKey === 'reject' ? 'selected' : '' ?>>Reject</option>
                    </select>
                    <button type="submit" class="cd-act-btn resolve">
                        <i class="bx bx-save"></i> Update Status
                    </button>
                </form>

                <?php if (!empty($complaint->mobile)): ?>
                    <a href="https://wa.me/91<?= preg_replace('/[^0-9]/', '', $complaint->mobile) ?>" target="_blank"
                        class="cd-act-btn whatsapp">
                        <i class="bx bxl-whatsapp"></i> WhatsApp
                    </a>
                    <a href="tel:<?= htmlspecialchars($complaint->mobile) ?>" class="cd-act-btn call">
                        <i class="bx bx-phone-call"></i> Call Customer
                    </a>
                <?php endif; ?>

                <a href="<?= site_url('admin/complaint/delete/' . (int) $complaint->id) ?>" class="cd-act-btn delete"
                    onclick="return confirm('Are you sure you want to permanently delete this complaint?')">
                    <i class="bx bx-trash"></i> Delete Complaint
                </a>
            </div>
        </div>
    </div>
</div>
