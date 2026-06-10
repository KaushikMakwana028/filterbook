<div class="page-wrapper">
    <div class="page-content">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

            :root {
                --cp-primary: #6366f1;
                --cp-primary-dark: #4f46e5;
                --cp-primary-light: #818cf8;
                --cp-secondary: #0d9488;
                --cp-text: #0f172a;
                --cp-text-secondary: #334155;
                --cp-muted: #64748b;
                --cp-light-muted: #94a3b8;
                --cp-border: #e2e8f0;
                --cp-border-light: #f1f5f9;
                --cp-white: #ffffff;
                --cp-bg: #f8fafc;
                --cp-warning: #f59e0b;
                --cp-warning-light: rgba(245, 158, 11, 0.1);
                --cp-success: #10b981;
                --cp-success-light: rgba(16, 185, 129, 0.1);
                --cp-danger: #ef4444;
                --cp-danger-light: rgba(239, 68, 68, 0.1);
                --cp-shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
                --cp-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                --cp-shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
                --cp-radius: 20px;
                --cp-radius-sm: 12px;
                --cp-radius-xs: 8px;
                --cp-transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Dark mode support */
            [data-theme="dark"] .cp-wrap {
                --cp-text: #f1f5f9;
                --cp-text-secondary: #cbd5e1;
                --cp-muted: #94a3b8;
                --cp-light-muted: #94a3b8;
                --cp-border: #334155;
                --cp-border-light: #1e293b;
                --cp-white: #1e293b;
                --cp-bg: #0f172a;
            }

            [data-theme="dark"] .cp-card,
            [data-theme="dark"] .cp-toolbar,
            [data-theme="dark"] .cp-pagination-wrap {
                background: var(--cp-white) !important;
                border-color: var(--cp-border) !important;
            }

            [data-theme="dark"] .cp-table th {
                background: var(--cp-bg) !important;
                color: var(--cp-muted) !important;
                border-color: var(--cp-border) !important;
            }

            [data-theme="dark"] .cp-table td {
                color: var(--cp-text-secondary) !important;
                border-color: rgba(255, 255, 255, 0.05) !important;
            }

            [data-theme="dark"] .cp-table tbody tr:hover {
                background: rgba(255, 255, 255, 0.03) !important;
            }

            [data-theme="dark"] .cp-details-box {
                background: var(--cp-bg) !important;
                border-color: var(--cp-border) !important;
            }

            [data-theme="dark"] .cp-search input,
            [data-theme="dark"] .cp-filter-select,
            [data-theme="dark"] .cp-per-page select {
                background: var(--cp-bg) !important;
                border-color: var(--cp-border) !important;
                color: var(--cp-text) !important;
            }

            [data-theme="dark"] .cp-status-select.cp-status-pending {
                background: rgba(245, 158, 11, 0.15) !important;
                color: #fbbf24 !important;
            }

            [data-theme="dark"] .cp-status-select.cp-status-approved {
                background: rgba(16, 185, 129, 0.15) !important;
                color: #34d399 !important;
            }

            [data-theme="dark"] .cp-status-select.cp-status-reject {
                background: rgba(239, 68, 68, 0.15) !important;
                color: #f87171 !important;
            }

            [data-theme="dark"] .cp-page-btn {
                background: var(--cp-white) !important;
                border-color: var(--cp-border) !important;
                color: var(--cp-text-secondary) !important;
            }

            [data-theme="dark"] .cp-page-btn.active {
                background: var(--cp-primary) !important;
                border-color: var(--cp-primary) !important;
                color: #fff !important;
            }

            [data-theme="dark"] .cp-empty-icon {
                background: var(--cp-bg) !important;
            }

            .cp-wrap {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* Flash Messages */
            .cp-flash {
                padding: 14px 20px;
                border-radius: var(--cp-radius-sm);
                font-size: 14px;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                animation: cpSlideDown 0.35s ease both;
            }

            .cp-flash i {
                font-size: 20px;
            }

            .cp-flash.success {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
                color: #065f46;
                border-left: 3px solid #10b981;
            }

            .cp-flash.error {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
                color: #991b1b;
                border-left: 3px solid #ef4444;
            }

            @keyframes cpSlideDown {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Main Card */
            .cp-card {
                background: var(--cp-white);
                border: 1px solid var(--cp-border);
                border-radius: var(--cp-radius);
                box-shadow: var(--cp-shadow);
                overflow: hidden;
                transition: var(--cp-transition);
                margin-bottom: 28px;
            }

            .cp-card:hover {
                box-shadow: var(--cp-shadow-md);
            }

            /* Toolbar */
            .cp-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cp-border-light);
                gap: 16px;
                flex-wrap: wrap;
                background: var(--cp-white);
            }

            .cp-toolbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .cp-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 18px;
                font-weight: 800;
                color: var(--cp-text);
            }

            .cp-toolbar-title i {
                font-size: 22px;
                color: var(--cp-primary);
            }

            .cp-toolbar-count {
                background: var(--cp-border-light);
                color: var(--cp-muted);
                padding: 4px 12px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
            }

            .cp-toolbar-right {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
            }

            /* Filters */
            .cp-filter-select,
            .cp-per-page select {
                padding: 9px 36px 9px 14px;
                border: 1.5px solid var(--cp-border);
                border-radius: var(--cp-radius-xs);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: var(--cp-text);
                background: var(--cp-bg);
                cursor: pointer;
                outline: none;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
            }

            .cp-per-page {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: var(--cp-muted);
                font-weight: 500;
            }

            .cp-search {
                position: relative;
                min-width: 260px;
            }

            .cp-search input {
                width: 100%;
                padding: 10px 16px 10px 42px;
                border: 1.5px solid var(--cp-border);
                border-radius: 60px;
                font-size: 13px;
                font-weight: 500;
                font-family: inherit;
                outline: none;
                background: var(--cp-bg);
                color: var(--cp-text);
                transition: var(--cp-transition);
            }

            .cp-search input:focus {
                border-color: var(--cp-primary-light);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .cp-search .search-icon {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--cp-light-muted);
                font-size: 18px;
            }

            /* Table */
            .cp-table-wrap {
                overflow-x: auto;
            }

            .cp-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }

            .cp-table th {
                background: var(--cp-bg);
                color: var(--cp-muted);
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                padding: 14px 18px;
                text-align: left;
                border-bottom: 1.5px solid var(--cp-border);
                font-weight: 700;
            }

            .cp-table td {
                padding: 18px;
                border-bottom: 1px solid var(--cp-border-light);
                color: var(--cp-text-secondary);
                vertical-align: middle;
            }

            .cp-table tbody tr:hover {
                background: rgba(99, 102, 241, 0.02);
            }

            .cp-row-num {
                width: 32px;
                height: 32px;
                border-radius: var(--cp-radius-sm);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 800;
                background: var(--cp-border-light);
                color: var(--cp-muted);
            }

            /* Customer */
            .cp-customer-cell {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .cp-avatar {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
            }

            .cp-avatar.purple {
                background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            }

            .cp-avatar.teal {
                background: linear-gradient(135deg, #14b8a6, #0d9488);
            }

            .cp-avatar.rose {
                background: linear-gradient(135deg, #f43f5e, #e11d48);
            }

            .cp-avatar.amber {
                background: linear-gradient(135deg, #f59e0b, #d97706);
            }

            .cp-avatar.blue {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
            }

            .cp-avatar.emerald {
                background: linear-gradient(135deg, #10b981, #059669);
            }

            .cp-avatar.violet {
                background: linear-gradient(135deg, #a78bfa, #8b5cf6);
            }

            .cp-avatar.cyan {
                background: linear-gradient(135deg, #06b6d4, #0891b2);
            }

            .cp-customer-name {
                font-weight: 700;
                color: var(--cp-text);
                font-size: 14px;
                margin-bottom: 2px;
                display: block;
            }

            .cp-customer-meta {
                font-size: 12px;
                color: var(--cp-light-muted);
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 4px;
                margin-top: 2px;
            }

            .cp-product-name {
                font-weight: 700;
                color: var(--cp-text);
                font-size: 14px;
            }

            .cp-product-model {
                font-size: 12px;
                color: var(--cp-light-muted);
                display: flex;
                align-items: center;
                gap: 4px;
                margin-top: 3px;
            }

            .cp-issue-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 5px 12px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
                background: rgba(239, 68, 68, 0.08);
                color: #b91c1c;
                border: 1px solid rgba(239, 68, 68, 0.15);
            }

            .cp-details-box {
                max-width: 260px;
                max-height: 80px;
                overflow-y: auto;
                font-size: 13px;
                color: var(--cp-muted);
                line-height: 1.5;
                padding: 8px 12px;
                background: var(--cp-bg);
                border: 1px solid var(--cp-border-light);
                border-radius: var(--cp-radius-xs);
                word-break: break-word;
            }

            /* Status Select */
            .cp-status-select {
                min-width: 120px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
                padding: 6px 28px 6px 12px;
                border: 1px solid transparent;
                cursor: pointer;
                font-family: inherit;
                appearance: none;
                background-repeat: no-repeat;
                background-position: right 10px center;
                background-size: 12px;
            }

            .cp-status-pending {
                background-color: var(--cp-warning-light);
                color: #92400e;
                border-color: rgba(245, 158, 11, 0.3);
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2392400e' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            }

            .cp-status-approved {
                background-color: var(--cp-success-light);
                color: #065f46;
                border-color: rgba(16, 185, 129, 0.3);
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23065f46' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            }

            .cp-status-reject {
                background-color: var(--cp-danger-light);
                color: #991b1b;
                border-color: rgba(239, 68, 68, 0.3);
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23991b1b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            }

            /* Actions */
            .cp-actions {
                display: flex;
                align-items: center;
                gap: 8px;
                justify-content: flex-end;
            }

            .cp-act-btn {
                height: 36px;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
                transition: var(--cp-transition);
                border: 1px solid transparent;
                padding: 0 14px;
                cursor: pointer;
            }

            .cp-act-btn:hover {
                transform: translateY(-1px);
            }

            .cp-act-btn.view {
                background: rgba(99, 102, 241, 0.08);
                color: var(--cp-primary-dark);
                border-color: rgba(99, 102, 241, 0.2);
            }

            .cp-act-btn.view:hover {
                background: rgba(99, 102, 241, 0.15);
            }

            .cp-act-btn.delete {
                background: rgba(239, 68, 68, 0.08);
                color: #991b1b;
                border-color: rgba(239, 68, 68, 0.2);
            }

            .cp-act-btn.delete:hover {
                background: rgba(239, 68, 68, 0.15);
            }

            /* Empty State */
            .cp-empty {
                padding: 56px 20px;
                text-align: center;
            }

            .cp-empty-icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: var(--cp-border-light);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 18px;
                font-size: 32px;
                color: var(--cp-light-muted);
            }

            .cp-empty h4 {
                margin: 0 0 8px;
                font-size: 18px;
                font-weight: 700;
                color: var(--cp-text-secondary);
            }

            .cp-empty p {
                margin: 0;
                font-size: 14px;
                color: var(--cp-light-muted);
            }

            /* Pagination */
            .cp-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 24px;
                border-top: 1px solid var(--cp-border-light);
                gap: 16px;
                flex-wrap: wrap;
                background: var(--cp-white);
            }

            .cp-pagination-info {
                font-size: 13px;
                color: var(--cp-muted);
                font-weight: 500;
            }

            .cp-pagination {
                display: flex;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }

            .cp-page-btn {
                min-width: 38px;
                height: 38px;
                border: 1.5px solid var(--cp-border);
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--cp-white);
                color: var(--cp-text-secondary);
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--cp-transition);
                padding: 0 6px;
            }

            .cp-page-btn:hover:not(.active):not(.disabled) {
                background: var(--cp-bg);
                border-color: var(--cp-primary);
                color: var(--cp-primary);
            }

            .cp-page-btn.active {
                background: var(--cp-primary);
                color: #fff;
                border-color: var(--cp-primary);
            }

            .cp-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .cp-page-ellipsis {
                min-width: 38px;
                height: 38px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--cp-light-muted);
                font-size: 14px;
                font-weight: 700;
            }

            .cp-no-results {
                text-align: center;
                padding: 40px 20px;
                color: var(--cp-light-muted);
                font-size: 14px;
                font-weight: 500;
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .cp-wrap {
                    padding: 0 12px;
                }

                .cp-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 16px;
                }

                .cp-toolbar-right {
                    width: 100%;
                    flex-direction: column;
                }

                .cp-search {
                    min-width: unset;
                    width: 100%;
                }

                .cp-filter-select,
                .cp-per-page select {
                    width: 100%;
                }

                .cp-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                /* Table to cards on mobile */
                .cp-table thead {
                    display: none;
                }

                .cp-table,
                .cp-table tbody,
                .cp-table tr,
                .cp-table td {
                    display: block;
                    width: 100%;
                }

                .cp-table tbody tr.cp-data-row {
                    display: block;
                    background: var(--cp-white);
                    border: 1px solid var(--cp-border);
                    border-radius: 16px;
                    padding: 16px;
                    margin-bottom: 12px;
                    position: relative;
                }

                .cp-table tbody tr.cp-data-row td {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    padding: 8px 0;
                    border: none;
                    border-bottom: 1px dashed var(--cp-border-light);
                }

                .cp-table tbody tr.cp-data-row td:last-child {
                    border-bottom: none;
                }

                .cp-table tbody tr.cp-data-row td::before {
                    content: attr(data-label);
                    font-weight: 700;
                    font-size: 11px;
                    text-transform: uppercase;
                    color: var(--cp-muted);
                    letter-spacing: 0.5px;
                    min-width: 100px;
                }

                .cp-table tbody tr.cp-data-row td>* {
                    flex: 1;
                    text-align: right;
                }

                .cp-customer-cell {
                    justify-content: flex-end;
                }

                .cp-actions {
                    justify-content: flex-end;
                }

                .cp-row-num {
                    position: absolute;
                    top: 12px;
                    right: 12px;
                }

                .cp-details-box {
                    max-width: 100%;
                }

                .cp-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .cp-table tbody tr.cp-data-row td {
                    flex-direction: column;
                    gap: 6px;
                }

                .cp-table tbody tr.cp-data-row td::before {
                    min-width: auto;
                }

                .cp-table tbody tr.cp-data-row td>* {
                    text-align: left;
                    width: 100%;
                }

                .cp-customer-cell {
                    justify-content: flex-start;
                }
            }
        </style>

        <?php
        $avatarColors = ['purple', 'teal', 'rose', 'amber', 'blue', 'emerald', 'violet', 'cyan'];
        $totalComplaints = !empty($complaints) ? count($complaints) : 0;
        $pendingCount = 0;
        $resolvedCount = 0;
        if (!empty($complaints)) {
            foreach ($complaints as $c) {
                if ((int) $c->status === 1)
                    $pendingCount++;
                else
                    $resolvedCount++;
            }
        }
        ?>

        <div class="cp-wrap">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="cp-flash success">
                    <i class="bx bx-check-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="cp-flash error">
                    <i class="bx bx-error-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Main Card -->
            <div class="cp-card">
                <div class="cp-toolbar">
                    <div class="cp-toolbar-left">
                        <div class="cp-toolbar-title">
                            <i class="bx bx-list-ul"></i>
                            <span>Complaints</span>
                        </div>
                        <span class="cp-toolbar-count" id="cpToolbarCount"><?= $totalComplaints ?> records</span>
                    </div>
                    <div class="cp-toolbar-right">
                        <div class="cp-per-page">
                            <span>Show</span>
                            <select id="cpPerPage" onchange="cpResetPage()">
                                <option value="10">10</option>
                                <option value="15" selected>15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <select id="cpStatusFilter" class="cp-filter-select" onchange="cpApplyFilters()">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="reject">Reject</option>
                        </select>
                        <div class="cp-search">
                            <input type="text" id="cpSearchInput" placeholder="Search name, mobile, product, issue..." oninput="cpApplyFilters()">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="cp-table-wrap">
                    <table class="cp-table" id="cpTable">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Issue</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th style="text-align: right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cpTableBody">
                            <?php if (!empty($complaints)): ?>
                                <?php foreach ($complaints as $index => $complaint):
                                    $rawStatus = (int) $complaint->status;
                                    $statusKey = 'approved';
                                    if ($rawStatus === 1) {
                                        $statusKey = 'pending';
                                    } elseif ($rawStatus === 3) {
                                        $statusKey = 'reject';
                                    }
                                    $initials = strtoupper(substr(trim($complaint->name), 0, 2));
                                    $colorClass = $avatarColors[$index % count($avatarColors)];
                                    $searchData = strtolower($complaint->name . ' ' . $complaint->mobile . ' ' . $complaint->area . ' ' . $complaint->product_name . ' ' . $complaint->serial_number . ' ' . $complaint->issue . ' ' . $complaint->complain_details);
                                ?>
                                    <tr class="cp-data-row" data-search="<?= htmlspecialchars($searchData) ?>" data-status="<?= $statusKey ?>">
                                        <td data-label="#"><span class="cp-row-num"><?= $index + 1 ?></span></td>
                                        <td data-label="Customer">
                                            <div class="cp-customer-cell">
                                                <div class="cp-avatar <?= $colorClass ?>"><?= htmlspecialchars($initials) ?></div>
                                                <div>
                                                    <span class="cp-customer-name"><?= htmlspecialchars($complaint->name) ?></span>
                                                    <div class="cp-customer-meta"><i class="bx bx-phone"></i> <?= htmlspecialchars($complaint->mobile) ?></div>
                                                    <div class="cp-customer-meta"><i class="bx bx-map"></i> <?= htmlspecialchars($complaint->area) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Product">
                                            <div class="cp-product-name"><?= htmlspecialchars($complaint->product_name) ?></div>
                                            <div class="cp-product-model"><i class="bx bx-chip"></i> <?= htmlspecialchars($complaint->serial_number) ?></div>
                                        </td>
                                        <td data-label="Issue">
                                            <span class="cp-issue-badge">
                                                <i class="bx bx-error-circle"></i>
                                                <?= htmlspecialchars($complaint->issue) ?>
                                            </span>
                                        </td>
                                        <td data-label="Details">
                                            <?php $details = trim((string) $complaint->complain_details); ?>
                                            <?php if (!empty($details)): ?>
                                                <div class="cp-details-box"><?= nl2br(htmlspecialchars($details)) ?></div>
                                            <?php else: ?>
                                                <span class="cp-details-empty">No details provided</span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Status">
                                            <form method="post" action="<?= site_url('admin/complaint/update_status/' . (int) $complaint->id) ?>">
                                                <input type="hidden" name="redirect" value="list">
                                                <select name="status" class="cp-status-select cp-status-<?= $statusKey ?>" onchange="this.form.submit()">
                                                    <option value="1" <?= $statusKey === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="2" <?= $statusKey === 'approved' ? 'selected' : '' ?>>Approved</option>
                                                    <option value="3" <?= $statusKey === 'reject' ? 'selected' : '' ?>>Reject</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td data-label="Actions">
                                            <div class="cp-actions">
                                                <a href="<?= site_url('admin/complaint/view/' . (int) $complaint->id) ?>" class="cp-act-btn view" title="View Details">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="<?= site_url('admin/complaint/delete/' . (int) $complaint->id) ?>" class="cp-act-btn delete" onclick="return confirm('Are you sure you want to delete this complaint?')" title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="cp-empty-row">
                                    <td colspan="7">
                                        <div class="cp-empty">
                                            <div class="cp-empty-icon"><i class="bx bx-message-square-x"></i></div>
                                            <h4>No Complaints Found</h4>
                                            <p>When customers submit complaints, they will appear here for you to manage and resolve.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- No Results -->
                <div class="cp-no-results" id="cpNoResults" style="display: none;">
                    <i class="bx bx-search-alt"></i>
                    No complaints match your search or filter criteria.
                </div>

                <!-- Pagination -->
                <?php if (!empty($complaints)): ?>
                    <div class="cp-pagination-wrap" id="cpPaginationWrap">
                        <div class="cp-pagination-info" id="cpPaginationInfo"></div>
                        <div class="cp-pagination" id="cpPagination"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
            (function() {
                var currentPage = 1;
                var allRows = [];
                var filteredRows = [];

                function init() {
                    allRows = Array.from(document.querySelectorAll('#cpTable .cp-data-row'));
                    filteredRows = allRows.slice();
                    renderPage();
                }

                function getPerPage() {
                    var sel = document.getElementById('cpPerPage');
                    return sel ? parseInt(sel.value, 10) : 15;
                }

                function getTotalPages() {
                    return Math.max(1, Math.ceil(filteredRows.length / getPerPage()));
                }

                function renderPage() {
                    var perPage = getPerPage();
                    var totalPages = getTotalPages();
                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    var start = (currentPage - 1) * perPage;
                    var end = start + perPage;

                    allRows.forEach(function(r) {
                        r.style.display = 'none';
                    });
                    filteredRows.forEach(function(r, i) {
                        if (i >= start && i < end) {
                            r.style.display = '';
                            var num = r.querySelector('.cp-row-num');
                            if (num) num.textContent = i + 1;
                        }
                    });

                    var infoEl = document.getElementById('cpPaginationInfo');
                    if (infoEl) {
                        var s = filteredRows.length > 0 ? start + 1 : 0;
                        var e = Math.min(end, filteredRows.length);
                        infoEl.innerHTML = 'Showing <strong>' + s + '</strong> to <strong>' + e + '</strong> of <strong>' + filteredRows.length + '</strong> complaints';
                    }

                    var countEl = document.getElementById('cpToolbarCount');
                    if (countEl) countEl.textContent = filteredRows.length + ' records';

                    buildPagination(totalPages);
                }

                function buildPagination(totalPages) {
                    var c = document.getElementById('cpPagination');
                    if (!c) return;
                    c.innerHTML = '';

                    var prev = document.createElement('button');
                    prev.className = 'cp-page-btn nav-btn' + (currentPage <= 1 ? ' disabled' : '');
                    prev.innerHTML = '<i class="bx bx-chevron-left"></i>';
                    prev.onclick = function() {
                        if (currentPage > 1) {
                            currentPage--;
                            renderPage();
                            scrollToTable();
                        }
                    };
                    c.appendChild(prev);

                    var pages = smartPages(currentPage, totalPages);
                    pages.forEach(function(p) {
                        if (p === '...') {
                            var ell = document.createElement('span');
                            ell.className = 'cp-page-ellipsis';
                            ell.textContent = '•••';
                            c.appendChild(ell);
                        } else {
                            var btn = document.createElement('button');
                            btn.className = 'cp-page-btn' + (p === currentPage ? ' active' : '');
                            btn.textContent = p;
                            btn.onclick = (function(pg) {
                                return function() {
                                    currentPage = pg;
                                    renderPage();
                                    scrollToTable();
                                };
                            })(p);
                            c.appendChild(btn);
                        }
                    });

                    var next = document.createElement('button');
                    next.className = 'cp-page-btn nav-btn' + (currentPage >= totalPages ? ' disabled' : '');
                    next.innerHTML = '<i class="bx bx-chevron-right"></i>';
                    next.onclick = function() {
                        if (currentPage < totalPages) {
                            currentPage++;
                            renderPage();
                            scrollToTable();
                        }
                    };
                    c.appendChild(next);
                }

                function smartPages(cur, total) {
                    if (total <= 7) {
                        var a = [];
                        for (var i = 1; i <= total; i++) a.push(i);
                        return a;
                    }
                    var p = [1];
                    if (cur > 3) p.push('...');
                    for (var j = Math.max(2, cur - 1); j <= Math.min(total - 1, cur + 1); j++) p.push(j);
                    if (cur < total - 2) p.push('...');
                    p.push(total);
                    return p;
                }

                function scrollToTable() {
                    var el = document.querySelector('.cp-card');
                    if (el) el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                window.cpApplyFilters = function() {
                    var q = (document.getElementById('cpSearchInput').value || '').toLowerCase().trim();
                    var status = document.getElementById('cpStatusFilter').value;
                    currentPage = 1;

                    filteredRows = allRows.filter(function(row) {
                        var sd = (row.getAttribute('data-search') || '');
                        var rs = (row.getAttribute('data-status') || '');
                        return (q === '' || sd.indexOf(q) > -1) && (status === '' || rs === status);
                    });

                    var nr = document.getElementById('cpNoResults');
                    var pw = document.getElementById('cpPaginationWrap');

                    if (filteredRows.length === 0 && (q || status)) {
                        allRows.forEach(function(r) {
                            r.style.display = 'none';
                        });
                        if (nr) nr.style.display = 'block';
                        if (pw) pw.style.display = 'none';
                        var ce = document.getElementById('cpToolbarCount');
                        if (ce) ce.textContent = '0 records';
                    } else {
                        if (nr) nr.style.display = 'none';
                        if (pw) pw.style.display = '';
                        renderPage();
                    }
                };

                window.cpResetPage = function() {
                    currentPage = 1;
                    renderPage();
                };

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', init);
                } else {
                    init();
                }
            })();
        </script>
    </div>
</div>