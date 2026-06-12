<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            /* ══════════════════════════════════════
   DARK THEME — Customer View Page
══════════════════════════════════════ */

            /* Top bar */
            [data-theme="dark"] .cv-topbar-title {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cv-id {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cv-top-btn {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cv-top-btn:hover {
                background: var(--bg-tertiary) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cv-top-btn.primary {
                background: var(--primary) !important;
                border-color: var(--primary) !important;
                color: #fff !important;
            }

            /* Cards */
            [data-theme="dark"] .cv-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cv-card-head {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cv-card-head h3 {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cv-count {
                background: var(--bg-tertiary) !important;
                color: var(--primary) !important;
            }

            /* Info rows */
            [data-theme="dark"] .cv-info-row {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cv-info-label {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cv-info-label i {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cv-info-val {
                color: var(--text-primary) !important;
            }

            /* Table */
            [data-theme="dark"] .cv-table th {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cv-table td {
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .cv-table tbody tr {
                background: var(--bg-secondary) !important;
            }

            [data-theme="dark"] .cv-table tbody tr:hover {
                background: var(--bg-tertiary) !important;
            }

            /* Product cell */
            [data-theme="dark"] .cv-prod-ico {
                background: rgba(99, 102, 241, 0.15) !important;
                color: var(--primary) !important;
            }

            [data-theme="dark"] .cv-prod-name {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .cv-prod-model {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cv-date {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cv-date i {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cv-price {
                color: var(--text-primary) !important;
            }

            /* Num chip */
            [data-theme="dark"] .cv-num {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            /* Service chip */
            [data-theme="dark"] .cv-svc {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            /* Empty state */
            [data-theme="dark"] .cv-empty h4 {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .cv-empty p {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cv-empty i {
                color: var(--text-tertiary) !important;
            }

            /* Footer */
            [data-theme="dark"] .cv-footer {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .cv-footer strong {
                color: var(--text-secondary) !important;
            }

            /* Mobile card rows */
            @media (max-width: 768px) {
                [data-theme="dark"] .cv-table tbody tr {
                    background: var(--bg-secondary) !important;
                    border-color: var(--border-color) !important;
                }
            }

            .cv-wrap {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* ── Top Bar ── */
            .cv-topbar {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                flex-wrap: wrap;
            }

            .cv-topbar-title {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 20px;
                font-weight: 700;
                color: #1e293b;
                margin-right: auto;
            }

            .cv-topbar-title i {
                font-size: 24px;
                color: #6366f1;
            }

            .cv-topbar-title .cv-id {
                font-size: 13px;
                font-weight: 600;
                color: #94a3b8;
                background: #f1f5f9;
                padding: 3px 10px;
                border-radius: 6px;
                margin-left: 4px;
            }

            .cv-top-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                border: 1px solid #e2e8f0;
                background: #fff;
                color: #475569;
                cursor: pointer;
                transition: all 0.15s ease;
            }

            .cv-top-btn:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #334155;
                text-decoration: none;
            }

            .cv-top-btn i {
                font-size: 16px;
            }

            .cv-top-btn.primary {
                background: #6366f1;
                color: #fff;
                border-color: #6366f1;
            }

            .cv-top-btn.primary:hover {
                background: #4f46e5;
                border-color: #4f46e5;
                color: #fff;
            }

            /* ── Grid ── */
            .cv-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-bottom: 20px;
            }

            /* ── Card ── */
            .cv-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
            }

            .cv-card-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
            }

            .cv-card-head h3 {
                margin: 0;
                font-size: 15px;
                font-weight: 700;
                color: #1e293b;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .cv-card-head h3 i {
                font-size: 18px;
                color: #6366f1;
            }

            .cv-card-head .cv-count {
                background: #f1f5f9;
                color: #6366f1;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            /* ── Info Rows ── */
            .cv-info-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 14px 20px;
                border-bottom: 1px solid #f8fafc;
            }

            .cv-info-row:last-child {
                border-bottom: 0;
            }

            .cv-info-label {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                font-weight: 500;
                color: #64748b;
            }

            .cv-info-label i {
                font-size: 16px;
                color: #94a3b8;
            }

            .cv-info-val {
                font-size: 14px;
                font-weight: 600;
                color: #1e293b;
            }

            /* ── Badge ── */
            .cv-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .cv-badge i {
                font-size: 13px;
            }

            .cv-badge.cash {
                background: #ecfdf5;
                color: #059669;
            }

            .cv-badge.emi {
                background: #eef2ff;
                color: #4f46e5;
            }

            /* ── Table ── */
            .cv-table-wrap {
                overflow-x: auto;
            }

            .cv-table {
                width: 100%;
                border-collapse: collapse;
            }

            .cv-table th {
                background: #f8fafc;
                font-size: 11px;
                font-weight: 700;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                padding: 12px 16px;
                text-align: left;
                border-bottom: 1px solid #e2e8f0;
                white-space: nowrap;
            }

            .cv-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                font-weight: 500;
                vertical-align: middle;
            }

            .cv-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .cv-table tbody tr:hover {
                background: #fafbfd;
            }

            /* ── Product Cell ── */
            .cv-prod {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .cv-prod-ico {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: #eef2ff;
                color: #6366f1;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            .cv-prod-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 13px;
            }

            .cv-prod-model {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
            }

            .cv-date {
                display: flex;
                align-items: center;
                gap: 5px;
                color: #64748b;
                font-size: 13px;
                white-space: nowrap;
            }

            .cv-date i {
                font-size: 14px;
                color: #94a3b8;
            }

            .cv-price {
                font-weight: 700;
                color: #1e293b;
                white-space: nowrap;
            }

            .cv-svc {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                background: #f1f5f9;
                color: #64748b;
            }

            .cv-svc i {
                font-size: 13px;
            }

            .cv-num {
                width: 28px;
                height: 28px;
                border-radius: 6px;
                background: #f1f5f9;
                color: #64748b;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 700;
            }

            /* ── Action Buttons ── */
            .cv-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                justify-content: center;
            }

            .cv-act {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 16px;
                transition: all 0.15s ease;
                border: none;
                cursor: pointer;
            }

            .cv-act.edit {
                background: #fef3c7;
                color: #b45309;
            }

            .cv-act.edit:hover {
                background: #fde68a;
            }

            .cv-act.delete {
                background: #fee2e2;
                color: #dc2626;
            }

            .cv-act.delete:hover {
                background: #fecaca;
            }

            /* ── Empty ── */
            .cv-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .cv-empty i {
                font-size: 36px;
                color: #cbd5e1;
                margin-bottom: 10px;
                display: block;
            }

            .cv-empty h4 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 600;
                color: #475569;
            }

            .cv-empty p {
                margin: 0;
                font-size: 13px;
                color: #94a3b8;
            }

            /* ── Footer ── */
            .cv-footer {
                text-align: center;
                padding: 14px;
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
            }

            .cv-footer strong {
                color: #64748b;
            }

            /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

            @media (max-width: 768px) {

                /* ── Wrapper ── */
                .cv-wrap {
                    padding: 0 10px;
                }

                /* ── Top Bar ── */
                .cv-topbar {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                    margin-bottom: 16px;
                }

                .cv-topbar-title {
                    margin-right: 0;
                    font-size: 17px;
                    flex-wrap: wrap;
                    gap: 6px;
                }

                .cv-topbar-title i {
                    font-size: 20px;
                }

                .cv-top-btns {
                    display: flex;
                    gap: 8px;
                    flex-wrap: wrap;
                    width: 100%;
                }

                .cv-top-btn {
                    flex: 1;
                    justify-content: center;
                    padding: 9px 12px;
                    font-size: 13px;
                }

                /* ── Info Grid ── */
                .cv-grid {
                    grid-template-columns: 1fr;
                    gap: 12px;
                    margin-bottom: 14px;
                }

                /* ── Cards ── */
                .cv-card {
                    border-radius: 10px;
                }

                .cv-card-head {
                    padding: 13px 16px;
                }

                .cv-card-head h3 {
                    font-size: 14px;
                }

                .cv-card-head h3 i {
                    font-size: 16px;
                }

                /* ── Info rows ── */
                .cv-info-row {
                    padding: 11px 16px;
                    flex-wrap: wrap;
                    gap: 4px;
                }

                .cv-info-label {
                    font-size: 12px;
                    min-width: 100px;
                }

                .cv-info-val {
                    font-size: 13px;
                }

                /* ══════════════════════════════════════════
       ORDERS TABLE → CARD LAYOUT ON MOBILE
    ══════════════════════════════════════════ */

                .cv-table-wrap {
                    overflow: visible;
                }

                /* Hide thead */
                .cv-table thead {
                    display: none;
                }

                /* Block layout */
                .cv-table,
                .cv-table tbody {
                    display: block;
                    width: 100%;
                }

                /* Each row = a card */
                .cv-table tbody tr {
                    display: block;
                    background: #fff;
                    border: 1px solid #e2e8f0;
                    border-radius: 10px;
                    padding: 13px 14px;
                    margin: 0 0 10px;
                    position: relative;
                }

                .cv-table tbody tr:last-child {
                    border-bottom: 1px solid #e2e8f0;
                    margin-bottom: 0;
                }

                .cv-table tbody tr:hover {
                    background: #fafbfd;
                }

                /* Hide all cells by default */
                .cv-table tbody tr td {
                    display: none;
                    padding: 0;
                    border: none;
                    font-size: 13px;
                }

                /* ── Row number — top-right chip ── */
                .cv-table tbody tr td:nth-child(1) {
                    display: block;
                    position: absolute;
                    top: 13px;
                    right: 14px;
                }

                .cv-num {
                    width: 26px;
                    height: 26px;
                    font-size: 11px;
                }

                /* ── Product — top section ── */
                .cv-table tbody tr td:nth-child(2) {
                    display: block;
                    padding-bottom: 11px;
                    margin-bottom: 10px;
                    border-bottom: 1px solid #f1f5f9;
                    padding-right: 36px;
                    /* space for row num */
                }

                .cv-prod {
                    gap: 10px;
                }

                .cv-prod-ico {
                    width: 34px;
                    height: 34px;
                    font-size: 15px;
                    flex-shrink: 0;
                }

                .cv-prod-name {
                    font-size: 13.5px;
                }

                .cv-prod-model {
                    font-size: 11.5px;
                }

                /* ── Purchase Date ── */
                .cv-table tbody tr td:nth-child(3) {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding-bottom: 8px;
                    margin-bottom: 7px;
                    border-bottom: 1px solid #f8fafc;
                }

                .cv-table tbody tr td:nth-child(3)::before {
                    content: "Date:";
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    white-space: nowrap;
                    min-width: 44px;
                }

                .cv-date {
                    font-size: 13px;
                }

                /* ── Price ── */
                .cv-table tbody tr td:nth-child(4) {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding-bottom: 8px;
                    margin-bottom: 7px;
                    border-bottom: 1px solid #f8fafc;
                }

                .cv-table tbody tr td:nth-child(4)::before {
                    content: "Price:";
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    white-space: nowrap;
                    min-width: 44px;
                }

                .cv-price {
                    font-size: 14px;
                }

                /* ── Payment + Services — inline row ── */
                .cv-table tbody tr td:nth-child(5),
                .cv-table tbody tr td:nth-child(6) {
                    display: inline-flex;
                    vertical-align: middle;
                    padding-top: 4px;
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid #f8fafc;
                }

                .cv-table tbody tr td:nth-child(5) {
                    flex: 1;
                    align-items: center;
                    gap: 6px;
                }

                .cv-table tbody tr td:nth-child(5)::before {
                    content: "Pay:";
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    white-space: nowrap;
                    align-self: center;
                }

                .cv-table tbody tr td:nth-child(6) {
                    align-items: center;
                    gap: 6px;
                    justify-content: flex-end;
                }

                .cv-table tbody tr td:nth-child(6)::before {
                    content: "Svc:";
                    font-size: 0.68rem;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    white-space: nowrap;
                    align-self: center;
                }

                .cv-badge {
                    font-size: 11.5px;
                    padding: 3px 9px;
                }

                .cv-svc {
                    font-size: 11.5px;
                    padding: 3px 9px;
                }

                /* ── Actions — bottom right ── */
                .cv-table tbody tr td:nth-child(7) {
                    display: flex;
                    justify-content: flex-end;
                    padding-top: 10px;
                    margin-top: 2px;
                    border-top: 1px solid #f1f5f9;
                }

                .cv-actions {
                    gap: 6px;
                }

                .cv-act {
                    width: 34px;
                    height: 34px;
                    font-size: 17px;
                }

                /* ── Empty state ── */
                .cv-table tbody tr td[colspan] {
                    display: block;
                    border: none;
                    padding: 0;
                }

                .cv-table tbody tr:has(.cv-empty) {
                    border: 1px solid #e2e8f0;
                    border-radius: 10px;
                    padding: 0;
                }

                .cv-empty {
                    padding: 36px 16px;
                }

                .cv-empty i {
                    font-size: 30px;
                }

                /* ── Footer ── */
                .cv-footer {
                    padding: 10px;
                    font-size: 12px;
                }
            }

            @media (max-width: 480px) {
                .cv-wrap {
                    padding: 0 6px;
                }

                .cv-topbar-title {
                    font-size: 15px;
                }

                .cv-top-btn {
                    font-size: 12px;
                    padding: 8px 10px;
                }

                .cv-info-row {
                    padding: 10px 13px;
                }

                /* Stack payment and services vertically on tiny screens */
                .cv-table tbody tr td:nth-child(5),
                .cv-table tbody tr td:nth-child(6) {
                    display: flex;
                    width: 100%;
                    padding-bottom: 6px;
                    margin-bottom: 6px;
                }

                .cv-table tbody tr td:nth-child(6) {
                    justify-content: flex-start;
                    border-bottom: 1px solid #f8fafc;
                }
            }

            @media print {
                body, .page-wrapper, .page-content, .adm-wrapper {
                    background: #fff !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    box-shadow: none !important;
                }
                .adm-sidebar, .adm-topbar, .adm-overlay, .cv-wrap, .cv-topbar, .cv-top-btns, footer, .cv-actions {
                    display: none !important;
                    visibility: hidden !important;
                }
                .printable-invoice {
                    display: block !important;
                    visibility: visible !important;
                    width: 100% !important;
                    background: #fff !important;
                    color: #000 !important;
                    position: absolute !important;
                    left: 0 !important;
                    top: 0 !important;
                    padding: 10px !important;
                }
                .invoice-header {
                    display: flex !important;
                    justify-content: space-between !important;
                    align-items: center !important;
                    margin-bottom: 20px !important;
                }
                .invoice-vendor-details {
                    text-align: right !important;
                }
            }
        </style>

        <?php
        $CI =& get_instance();
        $store = null;
        $adminSession = $CI->session->userdata('admin');
        if ($adminSession) {
            $store = $CI->db->get_where('users', ['id' => (int) $adminSession['id']])->row();
        }
        ?>

        <!-- Printable Invoice (Only visible when printing) -->
        <div class="printable-invoice" style="display: none;">
            <div class="invoice-header">
                <div class="invoice-logo">
                    <img src="<?= base_url('assets/images/filtter-logo.png') ?>" alt="Logo" style="height: 45px; object-fit: contain;" />
                </div>
                <div class="invoice-vendor-details">
                    <h2 style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 4px;"><?= htmlspecialchars($store->store_name ?? $store->name ?? 'Filter Book') ?></h2>
                    <p style="font-size: 12px; color: #475569; margin: 2px 0;"><?= htmlspecialchars($store->address ?? '') ?></p>
                    <p style="font-size: 12px; color: #475569; margin: 2px 0;">Phone: <?= htmlspecialchars($store->mobile ?? '') ?> &nbsp;|&nbsp; Email: <?= htmlspecialchars($store->email ?? '') ?></p>
                </div>
            </div>
            
            <div style="border-bottom: 2px solid #e2e8f0; margin: 15px 0;"></div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div>
                    <h4 style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Bill To:</h4>
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;"><?= htmlspecialchars($customer->name) ?></h3>
                    <p style="font-size: 13px; color: #475569; margin: 2px 0;">Phone: <?= htmlspecialchars($customer->mobile) ?></p>
                    <p style="font-size: 13px; color: #475569; margin: 2px 0;">Address: <?= htmlspecialchars($customer->address) ?></p>
                </div>
                <div style="text-align: right;">
                    <h4 style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Invoice Info:</h4>
                    <p style="font-size: 13px; color: #475569; margin: 2px 0;"><strong>Invoice ID:</strong> #IN-<?= str_pad($customer->id, 5, '0', STR_PAD_LEFT) ?></p>
                    <p style="font-size: 13px; color: #475569; margin: 2px 0;"><strong>Date:</strong> <?= date('d M Y') ?></p>
                </div>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1px solid #cbd5e1;">
                        <th style="padding: 10px; text-align: left; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase;">Product</th>
                        <th style="padding: 10px; text-align: center; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase;">Model</th>
                        <th style="padding: 10px; text-align: center; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase;">Purchase Date</th>
                        <th style="padding: 10px; text-align: center; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase;">Payment</th>
                        <th style="padding: 10px; text-align: right; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase;">Price</th>
                        <th style="padding: 10px; text-align: center; font-size: 12px; font-weight: 700; color: #475569; text-transform: uppercase; width: 100px;">Scan QR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): 
                        $orderQrText = site_url('order/view/' . $order->id);
                        $orderQrCodeUrl = 'https://quickchart.io/qr?size=100&text=' . rawurlencode($orderQrText);
                    ?>
                        <tr style="border-bottom: 1px dotted #e2e8f0;">
                            <td style="padding: 12px 10px; font-size: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($order->product_name) ?></td>
                            <td style="padding: 12px 10px; text-align: center; font-size: 13px; color: #475569;"><?= !empty($order->product_modal) ? htmlspecialchars($order->product_modal) : '—' ?></td>
                            <td style="padding: 12px 10px; text-align: center; font-size: 13px; color: #475569;"><?= !empty($order->date_of_purchase) ? date('d M Y', strtotime($order->date_of_purchase)) : '—' ?></td>
                            <td style="padding: 12px 10px; text-align: center; font-size: 13px; color: #475569;"><?= (int)$order->payment_type === 1 ? 'EMI' : 'Cash' ?></td>
                            <td style="padding: 12px 10px; text-align: right; font-size: 14px; font-weight: 700; color: #0f172a;">₹<?= number_format((float)$order->price, 2) ?></td>
                            <td style="padding: 5px; text-align: center;">
                                <img src="<?= $orderQrCodeUrl ?>" alt="QR" style="width: 70px; height: 70px;" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="max-width: 350px;">
                    <p style="font-size: 12px; color: #64748b; font-style: italic;">Scan the QR code next to your product to view full details, including Service schedule, EMI log, and raise complaints directly.</p>
                </div>
                <div style="width: 200px; text-align: right;">
                    <p style="font-size: 14px; color: #475569; margin: 4px 0;"><strong>Subtotal:</strong> ₹<?= number_format((float)$total_value, 2) ?></p>
                    <p style="font-size: 16px; color: #0f172a; margin: 4px 0; border-top: 1px solid #e2e8f0; padding-top: 6px;"><strong>Grand Total:</strong> ₹<?= number_format((float)$total_value, 2) ?></p>
                </div>
            </div>
            
            <div style="margin-top: 50px; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                <p style="font-size: 14px; font-weight: 600; color: #475569;">Thank you for your business!</p>
            </div>
        </div>

        <div class="cv-wrap">

            <!-- ── Top Bar ── -->
            <div class="cv-topbar">
                <div class="cv-topbar-title">
                    <i class="bx bx-user-circle"></i>
                    <?= htmlspecialchars($customer->name) ?>
                    <span class="cv-id">#<?= (int) $customer->id ?></span>
                </div>
                <div class="cv-top-btns">
                    <a href="<?= site_url('admin/orders') ?>" class="cv-top-btn">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                    <button onclick="window.print()" class="cv-top-btn">
                        <i class="bx bx-printer"></i> Print
                    </button>
                </div>
            </div>

            <!-- ── Info Grid ── -->
            <div class="cv-grid">
                <div class="cv-card">
                    <div class="cv-card-head">
                        <h3><i class="bx bx-user"></i> Customer Details</h3>
                    </div>
                    <div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-user-circle"></i> Full Name</div>
                            <div class="cv-info-val"><?= htmlspecialchars($customer->name) ?></div>
                        </div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-phone"></i> Mobile</div>
                            <div class="cv-info-val"><?= htmlspecialchars($customer->mobile) ?></div>
                        </div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-map"></i> Address</div>
                            <div class="cv-info-val"><?= htmlspecialchars($customer->address) ?></div>
                        </div>
                    </div>
                </div>

                <div class="cv-card">
                    <div class="cv-card-head">
                        <h3><i class="bx bx-bar-chart-alt-2"></i> Order Summary</h3>
                    </div>
                    <div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-package"></i> Total Orders</div>
                            <div class="cv-info-val"><?= (int) $total_orders ?></div>
                        </div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-wallet"></i> Cash Orders</div>
                            <div class="cv-info-val">
                                <span class="cv-badge cash"><i class="bx bx-check-circle"></i>
                                    <?= count(array_filter($orders, function ($o) {
                                        return (int) $o->payment_type === 0;
                                    })) ?></span>
                            </div>
                        </div>
                        <div class="cv-info-row">
                            <div class="cv-info-label"><i class="bx bx-credit-card"></i> EMI Orders</div>
                            <div class="cv-info-val">
                                <span class="cv-badge emi"><i class="bx bx-time-five"></i>
                                    <?= count(array_filter($orders, function ($o) {
                                        return (int) $o->payment_type === 1;
                                    })) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Orders Table ── -->
            <div class="cv-card" style="margin-bottom: 20px;">
                <div class="cv-card-head">
                    <h3><i class="bx bx-list-ul"></i> All Orders</h3>
                    <span class="cv-count"><?= (int) $total_orders ?> records</span>
                </div>
                <div class="cv-table-wrap">
                    <table class="cv-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Purchase Date</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Services</th>
                                <th style="text-align:center">QR Code</th>
                                <th style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) { ?>
                                <?php foreach ($orders as $index => $order) { ?>
                                    <tr>
                                        <td><span class="cv-num"><?= $index + 1 ?></span></td>
                                        <td>
                                            <div class="cv-prod">
                                                <div class="cv-prod-ico"><i class="bx bx-devices"></i></div>
                                                <div>
                                                    <div class="cv-prod-name"><?= htmlspecialchars($order->product_name) ?>
                                                    </div>
                                                    <div class="cv-prod-model"><?= htmlspecialchars($order->product_modal) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cv-date">
                                                <i class="bx bx-calendar"></i>
                                                <?= !empty($order->date_of_purchase) ? date('d M Y', strtotime($order->date_of_purchase)) : '—' ?>
                                            </div>
                                        </td>
                                        <td><span class="cv-price">₹<?= number_format((float) $order->price, 2) ?></span></td>
                                        <td>
                                            <span class="cv-badge <?= (int) $order->payment_type === 1 ? 'emi' : 'cash' ?>">
                                                <i
                                                    class="bx <?= (int) $order->payment_type === 1 ? 'bx-time-five' : 'bx-check-circle' ?>"></i>
                                                <?= (int) $order->payment_type === 1 ? 'EMI' : 'Cash' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="cv-svc"><i class="bx bx-wrench"></i>
                                                <?= (int) $order->total_services ?></span>
                                        </td>
                                        <?php 
                                            $scrQrText = site_url('order/view/' . $order->id);
                                            $scrQrCodeUrl = 'https://quickchart.io/qr?size=100&text=' . rawurlencode($scrQrText);
                                        ?>
                                        <td style="text-align:center">
                                            <a href="<?= $scrQrText ?>" target="_blank" title="Scan QR to View Details & Complain">
                                                <img src="<?= $scrQrCodeUrl ?>" alt="Order QR" style="width: 48px; height: 48px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 2px; background: #fff;" />
                                            </a>
                                        </td>
                                        <td>
                                            <div class="cv-actions">
                                                <a href="<?= site_url('admin/orders/edit/' . $order->id) ?>" class="cv-act edit"
                                                    title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a href="<?= site_url('admin/orders/delete/' . $order->id) ?>"
                                                    class="cv-act delete" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="cv-empty">
                                            <i class="bx bx-package"></i>
                                            <h4>No Orders Yet</h4>
                                            <p>This customer hasn't placed any orders.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cv-footer">
                Showing <?= (int) $total_orders ?> order<?= (int) $total_orders !== 1 ? 's' : '' ?> for
                <strong><?= htmlspecialchars($customer->name) ?></strong>
            </div>

        </div>
    </div>
</div>