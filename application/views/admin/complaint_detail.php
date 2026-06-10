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
                --cd-radius: 20px;
                --cd-radius-sm: 12px;
                --cd-radius-xs: 8px;
                --cd-transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Dark mode support - works with existing data-theme attribute */
            [data-theme="dark"] .cd-card,
            [data-theme="dark"] .cd-message-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cd-card-header,
            [data-theme="dark"] .cd-message-header {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cd-card-title {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cd-detail-row {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cd-detail-row:hover {
                background: var(--bg-tertiary) !important;
            }

            [data-theme="dark"] .cd-detail-label {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cd-detail-value {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cd-message-body {
                background: var(--bg-secondary) !important;
            }

            [data-theme="dark"] .cd-message-box {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cd-meta-strip {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cd-status-strip.pending {
                background: rgba(245, 158, 11, 0.08) !important;
                border-color: rgba(245, 158, 11, 0.2) !important;
            }

            [data-theme="dark"] .cd-status-strip.approved,
            [data-theme="dark"] .cd-status-strip.resolved {
                background: rgba(16, 185, 129, 0.08) !important;
                border-color: rgba(16, 185, 129, 0.2) !important;
            }

            [data-theme="dark"] .cd-status-strip.reject {
                background: rgba(239, 68, 68, 0.08) !important;
                border-color: rgba(239, 68, 68, 0.2) !important;
            }

            [data-theme="dark"] .cd-act-btn.call {
                background: rgba(99, 102, 241, 0.1) !important;
                border-color: rgba(99, 102, 241, 0.2) !important;
                color: #a5b4fc !important;
            }

            [data-theme="dark"] .cd-act-btn.delete {
                background: rgba(239, 68, 68, 0.1) !important;
                border-color: rgba(239, 68, 68, 0.2) !important;
                color: #fca5a5 !important;
            }

            [data-theme="dark"] .cd-actions select {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cd-card-header-icon.purple {
                background: rgba(99, 102, 241, 0.15) !important;
            }

            [data-theme="dark"] .cd-card-header-icon.teal {
                background: rgba(13, 148, 136, 0.15) !important;
            }

            [data-theme="dark"] .cd-card-header-icon.amber {
                background: rgba(245, 158, 11, 0.15) !important;
            }

            .cd-wrap {
                max-width: 1100px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* Flash Messages */
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

            /* Status Header Strip - Modern & Clean */
            .cd-status-strip {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 28px;
                border-radius: var(--cd-radius);
                margin-bottom: 28px;
                gap: 20px;
                flex-wrap: wrap;
                backdrop-filter: blur(4px);
            }

            .cd-status-strip.pending {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.12), rgba(245, 158, 11, 0.04));
                border: 1px solid rgba(245, 158, 11, 0.25);
            }

            .cd-status-strip.approved {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(16, 185, 129, 0.04));
                border: 1px solid rgba(16, 185, 129, 0.25);
            }

            .cd-status-strip.reject {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.12), rgba(239, 68, 68, 0.04));
                border: 1px solid rgba(239, 68, 68, 0.25);
            }

            .cd-status-left {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .cd-status-icon {
                width: 52px;
                height: 52px;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 26px;
            }

            .cd-status-strip.pending .cd-status-icon {
                background: rgba(245, 158, 11, 0.2);
                color: #d97706;
            }

            .cd-status-strip.approved .cd-status-icon {
                background: rgba(16, 185, 129, 0.2);
                color: #059669;
            }

            .cd-status-strip.reject .cd-status-icon {
                background: rgba(239, 68, 68, 0.2);
                color: #dc2626;
            }

            .cd-status-text {
                font-size: 16px;
                font-weight: 700;
                margin-bottom: 4px;
            }

            .cd-status-strip.pending .cd-status-text {
                color: #92400e;
            }

            .cd-status-strip.approved .cd-status-text {
                color: #065f46;
            }

            .cd-status-strip.reject .cd-status-text {
                color: #991b1b;
            }

            .cd-status-sub {
                font-size: 13px;
                font-weight: 500;
                opacity: 0.8;
            }

            .cd-status-strip.pending .cd-status-sub {
                color: #b45309;
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
                gap: 8px;
                padding: 8px 20px;
                border-radius: 60px;
                font-size: 13px;
                font-weight: 800;
                letter-spacing: 0.3px;
            }

            .cd-status-badge .dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                display: inline-block;
            }

            .cd-status-strip.pending .cd-status-badge {
                background: rgba(245, 158, 11, 0.18);
                color: #92400e;
            }

            .cd-status-strip.pending .cd-status-badge .dot {
                background: #f59e0b;
                box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.3);
                animation: pulse 1.5s infinite;
            }

            .cd-status-strip.approved .cd-status-badge {
                background: rgba(16, 185, 129, 0.18);
                color: #065f46;
            }

            .cd-status-strip.approved .cd-status-badge .dot {
                background: #10b981;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
            }

            .cd-status-strip.reject .cd-status-badge {
                background: rgba(239, 68, 68, 0.18);
                color: #991b1b;
            }

            .cd-status-strip.reject .cd-status-badge .dot {
                background: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.3);
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.6;
                    transform: scale(0.95);
                }
            }

            /* Grid Layout */
            .cd-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
                margin-bottom: 24px;
            }

            /* Cards */
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
                transform: translateY(-2px);
            }

            .cd-card-header {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cd-border-light);
                background: rgba(99, 102, 241, 0.02);
            }

            .cd-card-header-icon {
                width: 42px;
                height: 42px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
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
                font-size: 16px;
                font-weight: 800;
                color: var(--cd-text);
                letter-spacing: -0.3px;
            }

            .cd-card-body {
                padding: 0;
            }

            .cd-detail-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 16px 24px;
                border-bottom: 1px solid var(--cd-border-light);
                transition: var(--cd-transition);
            }

            .cd-detail-row:last-child {
                border-bottom: none;
            }

            .cd-detail-row:hover {
                background: rgba(99, 102, 241, 0.02);
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
                max-width: 60%;
            }

            /* Message Card */
            .cd-message-card {
                background: var(--cd-white);
                border: 1px solid var(--cd-border);
                border-radius: var(--cd-radius);
                box-shadow: var(--cd-shadow);
                overflow: hidden;
                transition: var(--cd-transition);
                margin-bottom: 28px;
            }

            .cd-message-card:hover {
                box-shadow: var(--cd-shadow-md);
                border-color: #cbd5e1;
            }

            .cd-message-header {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cd-border-light);
                background: rgba(99, 102, 241, 0.02);
            }

            .cd-message-body {
                padding: 24px;
            }

            .cd-message-box {
                background: var(--cd-bg);
                border: 1px solid var(--cd-border-light);
                border-radius: var(--cd-radius-sm);
                padding: 24px;
                font-size: 14px;
                line-height: 1.7;
                color: var(--cd-text-secondary);
                white-space: pre-wrap;
                word-break: break-word;
                min-height: 100px;
            }

            .cd-message-empty {
                color: var(--cd-light-muted);
                font-style: italic;
                font-size: 14px;
                text-align: center;
                padding: 40px 24px;
            }

            /* Meta Strip */
            .cd-meta-strip {
                display: flex;
                align-items: center;
                gap: 28px;
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
                color: var(--cd-primary-light);
            }

            /* Action Buttons */
            .cd-actions {
                display: flex;
                gap: 14px;
                flex-wrap: wrap;
                margin-bottom: 28px;
            }

            .cd-actions select {
                padding: 12px 20px;
                border-radius: 60px;
                border: 1.5px solid var(--cd-border);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                background: var(--cd-white);
                color: var(--cd-text);
                cursor: pointer;
                outline: none;
                transition: var(--cd-transition);
                min-width: 160px;
            }

            .cd-actions select:focus {
                border-color: var(--cd-primary);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }

            .cd-act-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 24px;
                border-radius: 60px;
                text-decoration: none;
                font-size: 13px;
                font-weight: 700;
                font-family: inherit;
                transition: var(--cd-transition);
                border: 1px solid transparent;
                cursor: pointer;
                white-space: nowrap;
            }

            .cd-act-btn:hover {
                transform: translateY(-2px);
                text-decoration: none;
            }

            .cd-act-btn.update {
                background: linear-gradient(135deg, var(--cd-primary), var(--cd-primary-dark));
                color: #fff;
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            }

            .cd-act-btn.update:hover {
                box-shadow: 0 6px 18px rgba(99, 102, 241, 0.35);
                color: #fff;
            }

            .cd-act-btn.whatsapp {
                background: linear-gradient(135deg, #25d366, #128c7e);
                color: #fff;
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
            }

            .cd-act-btn.whatsapp:hover {
                box-shadow: 0 6px 18px rgba(37, 211, 102, 0.35);
                color: #fff;
            }

            .cd-act-btn.call {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(99, 102, 241, 0.05));
                color: var(--cd-primary-dark);
                border-color: rgba(99, 102, 241, 0.2);
            }

            .cd-act-btn.call:hover {
                background: rgba(99, 102, 241, 0.18);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
                color: var(--cd-primary-dark);
            }

            .cd-act-btn.delete {
                background: var(--cd-danger-light);
                color: #b91c1c;
                border-color: rgba(239, 68, 68, 0.2);
            }

            .cd-act-btn.delete:hover {
                background: rgba(239, 68, 68, 0.18);
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
                color: #991b1b;
            }

            /* Back Button Link */
            .cd-back-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 20px;
                padding: 10px 0;
                color: var(--cd-muted);
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                transition: var(--cd-transition);
            }

            .cd-back-link:hover {
                color: var(--cd-primary);
                transform: translateX(-4px);
                text-decoration: none;
            }

            .cd-back-link i {
                font-size: 18px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .cd-wrap {
                    padding: 0 12px;
                }

                .cd-grid {
                    grid-template-columns: 1fr;
                    gap: 16px;
                }

                .cd-status-strip {
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 18px 20px;
                }

                .cd-status-left {
                    width: 100%;
                }

                .cd-status-badge {
                    align-self: flex-start;
                }

                .cd-detail-row {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 6px;
                    padding: 14px 20px;
                }

                .cd-detail-value {
                    text-align: left;
                    max-width: 100%;
                    width: 100%;
                }

                .cd-actions {
                    flex-direction: column;
                }

                .cd-actions select,
                .cd-act-btn {
                    width: 100%;
                    justify-content: center;
                }

                .cd-meta-strip {
                    gap: 16px;
                }

                .cd-card-header,
                .cd-message-header {
                    padding: 16px 20px;
                }

                .cd-message-body {
                    padding: 16px;
                }

                .cd-message-box {
                    padding: 16px;
                }
            }

            @media (max-width: 480px) {
                .cd-status-icon {
                    width: 44px;
                    height: 44px;
                    font-size: 22px;
                }

                .cd-status-text {
                    font-size: 14px;
                }

                .cd-status-sub {
                    font-size: 11px;
                }

                .cd-card-title {
                    font-size: 14px;
                }

                .cd-detail-label {
                    font-size: 12px;
                }

                .cd-detail-value {
                    font-size: 13px;
                }
            }

            /* Animations */
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

            .cd-status-strip {
                animation: cdFadeUp 0.4s ease both;
            }

            .cd-grid>* {
                animation: cdFadeUp 0.4s ease 0.08s both;
            }

            .cd-message-card {
                animation: cdFadeUp 0.4s ease 0.16s both;
            }

            .cd-actions {
                animation: cdFadeUp 0.4s ease 0.24s both;
            }
        </style>

        <?php
        $rawStatus = (int) ($complaint->status ?? 0);
        $statusKey = 'approved';
        $statusLabel = 'Approved';
        $statusText = 'This complaint has been approved and resolved.';
        if ($rawStatus === 1) {
            $statusKey = 'pending';
            $statusLabel = 'Pending';
            $statusText = 'This complaint is awaiting review and action.';
        } elseif ($rawStatus === 3) {
            $statusKey = 'reject';
            $statusLabel = 'Rejected';
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

            <!-- Back Link -->
            <a href="<?= site_url('admin/complaint') ?>" class="cd-back-link">
                <i class="bx bx-arrow-back"></i> Back to Complaints
            </a>

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
                <!-- Customer Information Card -->
                <div class="cd-card">
                    <div class="cd-card-header">
                        <div class="cd-card-header-icon purple">
                            <i class="bx bx-user-circle"></i>
                        </div>
                        <div class="cd-card-title">Customer Information</div>
                    </div>
                    <div class="cd-card-body">
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-user"></i> Full Name</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->name ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-phone"></i> Mobile Number</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->mobile ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-home"></i> Address</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->address ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-map"></i> Area / Location</div>
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
                            <div class="cd-detail-label"><i class="bx bx-package"></i> Product Name</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->product_name ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-chip"></i> Serial Number</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->serial_number ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-error-alt"></i> Issue Type</div>
                            <div class="cd-detail-value"><?= htmlspecialchars($complaint->issue ?? '-') ?></div>
                        </div>
                        <div class="cd-detail-row">
                            <div class="cd-detail-label"><i class="bx bx-calendar"></i> Submission Date</div>
                            <div class="cd-detail-value">
                                <?= !empty($complaint->created_at) ? date('d M Y, h:i A', strtotime($complaint->created_at)) : '-' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complaint Description Card -->
            <div class="cd-message-card">
                <div class="cd-message-header">
                    <div class="cd-card-header-icon amber">
                        <i class="bx bx-detail"></i>
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
                        <i class="bx bx-info-circle" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>
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
                            <i class="bx bx-time"></i>
                            <?= date('h:i A', strtotime($complaint->created_at)) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="cd-actions">
                <form method="post" action="<?= site_url('admin/complaint/update_status/' . (int) $complaint->id) ?>" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <select name="status">
                        <option value="1" <?= $statusKey === 'pending' ? 'selected' : '' ?>>📋 Pending</option>
                        <option value="2" <?= $statusKey === 'approved' ? 'selected' : '' ?>>✅ Approved</option>
                        <option value="3" <?= $statusKey === 'reject' ? 'selected' : '' ?>>❌ Reject</option>
                    </select>
                    <button type="submit" class="cd-act-btn update">
                        <i class="bx bx-save"></i> Update Status
                    </button>
                </form>

                <?php if (!empty($complaint->mobile)): ?>
                    <a href="https://wa.me/91<?= preg_replace('/[^0-9]/', '', $complaint->mobile) ?>" target="_blank" class="cd-act-btn whatsapp">
                        <i class="bx bxl-whatsapp"></i> WhatsApp Customer
                    </a>
                    <a href="tel:<?= htmlspecialchars($complaint->mobile) ?>" class="cd-act-btn call">
                        <i class="bx bx-phone-call"></i> Call Customer
                    </a>
                <?php endif; ?>

                <a href="<?= site_url('admin/complaint/delete/' . (int) $complaint->id) ?>" class="cd-act-btn delete" onclick="return confirm('Are you sure you want to permanently delete this complaint? This action cannot be undone.')">
                    <i class="bx bx-trash"></i> Delete Complaint
                </a>
            </div>
        </div>
    </div>
</div>