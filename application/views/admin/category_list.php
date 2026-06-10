<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            .ct-wrap {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .ct-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            /* ── Toolbar ── */
            .ct-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
                gap: 14px;
                flex-wrap: wrap;
            }

            .ct-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .ct-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 17px;
                font-weight: 700;
                color: #1e293b;
            }

            .ct-toolbar-title i {
                font-size: 20px;
                color: #6366f1;
            }

            .ct-toolbar-count {
                background: #eef2ff;
                color: #6366f1;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .ct-toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            /* ── Per Page ── */
            .ct-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: #64748b;
                font-weight: 500;
            }

            .ct-per-page select {
                padding: 7px 28px 7px 10px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: #1e293b;
                background: #f8fafc;
                cursor: pointer;
                outline: none;
                transition: all 0.15s ease;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 8px center;
            }

            .ct-per-page select:focus {
                border-color: #a5b4fc;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            /* ── Search ── */
            .ct-search {
                position: relative;
                min-width: 240px;
            }

            .ct-search input {
                width: 100%;
                padding: 8px 14px 8px 36px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                font-family: inherit;
                outline: none;
                background: #f8fafc;
                color: #1e293b;
                transition: all 0.15s ease;
                box-sizing: border-box;
            }

            .ct-search input::placeholder {
                color: #94a3b8;
            }

            .ct-search input:focus {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .ct-search .search-icon {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 16px;
                pointer-events: none;
            }

            /* ── Add Button ── */
            .ct-add-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                background: #6366f1;
                color: #fff;
                border: none;
                cursor: pointer;
                transition: all 0.15s ease;
                white-space: nowrap;
            }

            .ct-add-btn:hover {
                background: #4f46e5;
                color: #fff;
                text-decoration: none;
            }

            .ct-add-btn i {
                font-size: 16px;
            }

            /* ── Table ── */
            .ct-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .ct-table {
                width: 100%;
                border-collapse: collapse;
            }

            .ct-table th {
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

            .ct-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                font-weight: 500;
                vertical-align: middle;
            }

            .ct-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .ct-table tbody tr:hover {
                background: #fafbfd;
            }

            /* ── Row Number ── */
            .ct-row-num {
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

            /* ── Category Cell ── */
            .ct-cat-cell {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .ct-cat-avatar {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .ct-cat-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 14px;
                display: block;
                margin-bottom: 2px;
            }

            .ct-cat-slug {
                font-size: 11px;
                color: #94a3b8;
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .ct-cat-slug i {
                font-size: 12px;
            }

            /* ── Product Count ── */
            .ct-prod-count {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                background: #eff6ff;
                color: #2563eb;
            }

            .ct-prod-count i {
                font-size: 13px;
            }

            /* ── Added By ── */
            .ct-user-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                background: #f1f5f9;
                color: #475569;
            }

            .ct-user-badge i {
                font-size: 13px;
                color: #94a3b8;
            }

            /* ── Date ── */
            .ct-date {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                color: #64748b;
                white-space: nowrap;
            }

            .ct-date i {
                font-size: 14px;
                color: #94a3b8;
            }

            /* ── Actions ── */
            .ct-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                justify-content: center;
            }

            .ct-act-btn {
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

            .ct-act-btn.edit {
                background: #fef3c7;
                color: #b45309;
            }

            .ct-act-btn.edit:hover {
                background: #fde68a;
            }

            .ct-act-btn.delete {
                background: #fee2e2;
                color: #dc2626;
            }

            .ct-act-btn.delete:hover {
                background: #fecaca;
            }

            /* ── Empty ── */
            .ct-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .ct-empty i {
                font-size: 36px;
                color: #cbd5e1;
                margin-bottom: 10px;
                display: block;
            }

            .ct-empty h4 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 600;
                color: #475569;
            }

            .ct-empty p {
                margin: 0 0 16px;
                font-size: 13px;
                color: #94a3b8;
            }

            .ct-empty-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 18px;
                border-radius: 8px;
                background: #6366f1;
                color: #fff;
                text-decoration: none;
                font-weight: 600;
                font-size: 13px;
                transition: all 0.15s ease;
            }

            .ct-empty-btn:hover {
                background: #4f46e5;
                color: #fff;
                text-decoration: none;
            }

            /* ── No Results ── */
            .ct-no-results {
                display: none;
                text-align: center;
                padding: 36px 20px;
                color: #94a3b8;
                font-size: 13px;
                font-weight: 500;
            }

            .ct-no-results i {
                font-size: 24px;
                display: block;
                margin-bottom: 6px;
                color: #cbd5e1;
            }

            /* ── Pagination ── */
            .ct-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 20px;
                border-top: 1px solid #f1f5f9;
                gap: 12px;
                flex-wrap: wrap;
            }

            .ct-pagination-info {
                font-size: 13px;
                color: #6366f1;
                font-weight: 500;
            }

            .ct-pagination-info strong {
                color: #1e293b;
                font-weight: 700;
            }

            .ct-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .ct-page-btn {
                min-width: 34px;
                height: 34px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff;
                color: #475569;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: all 0.15s ease;
                padding: 0 4px;
            }

            .ct-page-btn:hover:not(.active):not(.disabled) {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #6366f1;
            }

            .ct-page-btn.active {
                background: #6366f1;
                color: #fff;
                border-color: #6366f1;
            }

            .ct-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .ct-page-btn.nav-btn {
                font-size: 16px;
                color: #64748b;
            }

            /* ── Flash Messages ── */
            .ct-alert {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 18px;
                border-radius: 10px;
                margin-bottom: 16px;
                font-size: 13px;
                font-weight: 500;
            }

            .ct-alert i {
                font-size: 20px;
                flex-shrink: 0;
            }

            .ct-alert.success {
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46;
            }

            .ct-alert.success i {
                color: #059669;
            }

            .ct-alert.error {
                background: #fef2f2;
                border: 1px solid #fecaca;
                color: #991b1b;
            }

            .ct-alert.error i {
                color: #dc2626;
            }

            .ct-alert .close-alert {
                margin-left: auto;
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                opacity: 0.5;
                color: inherit;
                padding: 0;
            }

            .ct-alert .close-alert:hover {
                opacity: 1;
            }

            /* ── Delete Modal ── */
            .ct-modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 9999;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(4px);
                padding: 16px;
            }

            .ct-modal-overlay.show {
                display: flex;
            }

            .ct-modal {
                background: #fff;
                border-radius: 16px;
                padding: 32px 28px;
                max-width: 380px;
                width: 90%;
                text-align: center;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            }

            .ct-modal-icon {
                width: 64px;
                height: 64px;
                border-radius: 16px;
                background: #fee2e2;
                color: #dc2626;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 28px;
                margin: 0 auto 16px;
            }

            .ct-modal h4 {
                font-size: 17px;
                font-weight: 700;
                color: #1e293b;
                margin: 0 0 6px;
            }

            .ct-modal p {
                font-size: 13px;
                color: #64748b;
                margin: 0 0 6px;
            }

            .ct-modal .ct-del-name {
                display: inline-block;
                padding: 4px 14px;
                background: #fef2f2;
                border: 1px solid #fecaca;
                border-radius: 6px;
                color: #b91c1c;
                font-weight: 700;
                font-size: 14px;
                margin-bottom: 16px;
                word-break: break-word;
            }

            .ct-modal-actions {
                display: flex;
                gap: 10px;
                justify-content: center;
            }

            .ct-modal-btn {
                padding: 9px 22px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.15s ease;
                border: none;
                font-family: inherit;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .ct-modal-btn.cancel {
                background: #f1f5f9;
                color: #475569;
            }

            .ct-modal-btn.cancel:hover {
                background: #e2e8f0;
            }

            .ct-modal-btn.confirm {
                background: #dc2626;
                color: #fff;
            }

            .ct-modal-btn.confirm:hover {
                background: #b91c1c;
                color: #fff;
                text-decoration: none;
            }

            /* ── Mobile Card Layout ── */
            .ct-mobile-cards {
                display: none;
                padding: 12px;
                gap: 10px;
                flex-direction: column;
            }

            .ct-mobile-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 14px;
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .ct-mobile-card-header {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .ct-mobile-card-header .ct-cat-avatar {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .ct-mobile-card-info {
                flex: 1;
                min-width: 0;
            }

            .ct-mobile-card-info .ct-cat-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 14px;
                display: block;
                margin-bottom: 2px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .ct-mobile-card-info .ct-cat-slug {
                font-size: 11px;
                color: #94a3b8;
                display: flex;
                align-items: center;
                gap: 3px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .ct-mobile-card-meta {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }

            .ct-mobile-card-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-top: 10px;
                border-top: 1px solid #f1f5f9;
            }

            .ct-mobile-card-footer .ct-date {
                font-size: 12px;
            }

            .ct-mobile-card-footer .ct-actions {
                gap: 6px;
            }

            .ct-mobile-card-footer .ct-act-btn {
                width: 36px;
                height: 36px;
                font-size: 17px;
            }

            /* ── Responsive ── */
            @media (max-width: 768px) {
                .ct-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 16px;
                    gap: 12px;
                }

                .ct-toolbar-left {
                    justify-content: space-between;
                }

                .ct-toolbar-right {
                    flex-direction: column;
                    gap: 8px;
                }

                .ct-search {
                    min-width: unset;
                    width: 100%;
                }

                .ct-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                .ct-per-page select {
                    flex: 1;
                    max-width: 120px;
                }

                .ct-add-btn {
                    width: 100%;
                    justify-content: center;
                    padding: 10px 16px;
                }

                .ct-table-wrap {
                    display: block !important;
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                }

                .ct-table {
                    min-width: 820px;
                }

                .ct-table th,
                .ct-table td {
                    padding: 12px 10px;
                    font-size: 12px;
                }

                .ct-table th {
                    font-size: 10px;
                }

                .ct-cat-cell {
                    gap: 10px;
                    min-width: 190px;
                }

                .ct-cat-avatar {
                    width: 36px;
                    height: 36px;
                    border-radius: 10px;
                    font-size: 12px;
                }

                .ct-cat-name {
                    font-size: 13px;
                }

                .ct-cat-slug,
                .ct-date {
                    font-size: 11px;
                }

                .ct-prod-count,
                .ct-user-badge {
                    font-size: 11px;
                    padding: 4px 8px;
                    white-space: nowrap;
                }

                .ct-actions {
                    gap: 4px;
                }

                .ct-act-btn {
                    width: 30px;
                    height: 30px;
                    font-size: 15px;
                }

                .ct-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    padding: 12px 16px;
                    gap: 10px;
                }

                .ct-pagination-info {
                    font-size: 12px;
                    text-align: center;
                }

                .ct-pagination {
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .ct-page-btn {
                    min-width: 32px;
                    height: 32px;
                    font-size: 12px;
                }

                .ct-mobile-cards {
                    display: none !important;
                }

                .ct-modal {
                    padding: 24px 20px;
                    width: 92%;
                }

                .ct-modal-icon {
                    width: 56px;
                    height: 56px;
                    font-size: 24px;
                    border-radius: 14px;
                }

                .ct-modal h4 {
                    font-size: 16px;
                }

                .ct-modal-actions {
                    flex-direction: column;
                    gap: 8px;
                }

                .ct-modal-btn {
                    width: 100%;
                    justify-content: center;
                    padding: 11px 22px;
                }

                .ct-alert {
                    padding: 12px 14px;
                    gap: 10px;
                    font-size: 12px;
                    border-radius: 8px;
                }

                .ct-alert i {
                    font-size: 18px;
                }

                .ct-empty {
                    padding: 36px 16px;
                }

                .ct-empty i {
                    font-size: 32px;
                }

                .ct-empty h4 {
                    font-size: 14px;
                }

                .ct-empty p {
                    font-size: 12px;
                }
            }

            @media (max-width: 480px) {
                .ct-wrap {
                    padding: 0 8px;
                }

                .ct-toolbar {
                    padding: 12px;
                }

                .ct-toolbar-title {
                    font-size: 15px;
                }

                .ct-toolbar-title i {
                    font-size: 18px;
                }

                .ct-toolbar-count {
                    font-size: 11px;
                    padding: 2px 8px;
                }

                .ct-wrap {
                    padding: 0 8px;
                }

                .ct-pagination-wrap {
                    padding: 10px 12px;
                }

                .ct-page-btn {
                    min-width: 30px;
                    height: 30px;
                    font-size: 11px;
                    border-radius: 6px;
                }

                .ct-modal {
                    width: 95%;
                    padding: 20px 16px;
                    border-radius: 14px;
                }
            }

            @media (max-width: 360px) {
                .ct-toolbar-title {
                    font-size: 14px;
                    gap: 6px;
                }

                .ct-toolbar-title i {
                    font-size: 16px;
                }
            }
        </style>

        <?php
        $totalCategories = !empty($categories) ? count($categories) : 0;
        $avatarColors = [
            '#6366f1',
            '#0d9488',
            '#e11d48',
            '#d97706',
            '#2563eb',
            '#059669',
            '#7c3aed',
            '#db2777'
        ];
        ?>

        <div class="ct-wrap">

            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="ct-alert success">
                    <i class="bx bx-check-circle"></i>
                    <span><?= $this->session->flashdata('success') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="ct-alert error">
                    <i class="bx bx-error-circle"></i>
                    <span><?= $this->session->flashdata('error') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <div class="ct-card">
                <div class="ct-toolbar">
                    <div class="ct-toolbar-left">
                        <div class="ct-toolbar-title">
                            <i class="bx bx-category"></i> Categories
                        </div>
                        <span class="ct-toolbar-count" id="ctToolbarCount"><?= $totalCategories ?> records</span>
                    </div>
                    <div class="ct-toolbar-right">
                        <div class="ct-per-page">
                            <span>Show</span>
                            <select id="ctPerPage">
                                <option value="15" selected>15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="ct-search">
                            <input type="text" id="ctSearchInput" placeholder="Search categories...">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                        <a href="<?= base_url('index.php/admin/category/add') ?>" class="ct-add-btn">
                            <i class="bx bx-plus"></i> Add Category
                        </a>
                    </div>
                </div>

                <!-- Desktop Table View -->
                <div class="ct-table-wrap" id="ctTableView">
                    <table class="ct-table" id="ctTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Products</th>
                                <th>Added By</th>
                                <th>Created</th>
                                <th style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ctTableBody">
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $index => $row):
                                    $bgColor = $avatarColors[$index % count($avatarColors)];
                                    $initials = strtoupper(substr(trim($row->name), 0, 2));
                                    $slug = url_title($row->name, '-', TRUE);
                                    ?>
                                    <tr class="ct-data-row">
                                        <td><span class="ct-row-num"></span></td>
                                        <td>
                                            <div class="ct-cat-cell">
                                                <div class="ct-cat-avatar" style="background:<?= $bgColor ?>">
                                                    <?= htmlspecialchars($initials) ?>
                                                </div>
                                                <div>
                                                    <span class="ct-cat-name"><?= htmlspecialchars($row->name) ?></span>
                                                    <span class="ct-cat-slug"><i class="bx bx-link-alt"></i> <?= $slug ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="ct-prod-count">
                                                <i class="bx bx-package"></i> <?= $row->product_count ?> items
                                            </span>
                                        </td>
                                        <td>
                                            <span class="ct-user-badge">
                                                <i class="bx bx-user"></i> <?= htmlspecialchars($row->user_name ?? 'Unknown') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="ct-date">
                                                <i class="bx bx-calendar"></i> <?= date('d M Y') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ct-actions">
                                                <a href="<?= base_url('index.php/admin/category/edit/' . $row->id) ?>"
                                                    class="ct-act-btn edit" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <button class="ct-act-btn delete ct-delete-trigger" data-id="<?= $row->id ?>"
                                                    data-name="<?= htmlspecialchars($row->name) ?>" title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="ct-empty">
                                            <i class="bx bx-folder-open"></i>
                                            <h4>No Categories Found</h4>
                                            <p>Get started by creating your first category.</p>
                                            <a href="<?= base_url('index.php/admin/category/add') ?>" class="ct-empty-btn">
                                                <i class="bx bx-plus"></i> Create Category
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="ct-mobile-cards" id="ctMobileCards">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $index => $row):
                            $bgColor = $avatarColors[$index % count($avatarColors)];
                            $initials = strtoupper(substr(trim($row->name), 0, 2));
                            $slug = url_title($row->name, '-', TRUE);
                            ?>
                            <div class="ct-mobile-card ct-data-row-mobile">
                                <div class="ct-mobile-card-header">
                                    <div class="ct-cat-avatar" style="background:<?= $bgColor ?>">
                                        <?= htmlspecialchars($initials) ?>
                                    </div>
                                    <div class="ct-mobile-card-info">
                                        <span class="ct-cat-name"><?= htmlspecialchars($row->name) ?></span>
                                        <span class="ct-cat-slug"><i class="bx bx-link-alt"></i> <?= $slug ?></span>
                                    </div>
                                </div>
                                <div class="ct-mobile-card-meta">
                                    <span class="ct-prod-count">
                                        <i class="bx bx-package"></i> <?= $row->product_count ?> items
                                    </span>
                                    <span class="ct-user-badge">
                                        <i class="bx bx-user"></i> <?= htmlspecialchars($row->user_name ?? 'Unknown') ?>
                                    </span>
                                </div>
                                <div class="ct-mobile-card-footer">
                                    <div class="ct-date">
                                        <i class="bx bx-calendar"></i> <?= date('d M Y') ?>
                                    </div>
                                    <div class="ct-actions">
                                        <a href="<?= base_url('index.php/admin/category/edit/' . $row->id) ?>"
                                            class="ct-act-btn edit" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button class="ct-act-btn delete ct-delete-trigger" data-id="<?= $row->id ?>"
                                            data-name="<?= htmlspecialchars($row->name) ?>" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="ct-empty">
                            <i class="bx bx-folder-open"></i>
                            <h4>No Categories Found</h4>
                            <p>Get started by creating your first category.</p>
                            <a href="<?= base_url('index.php/admin/category/add') ?>" class="ct-empty-btn">
                                <i class="bx bx-plus"></i> Create Category
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="ct-no-results" id="ctNoResults">
                    <i class="bx bx-search-alt"></i>
                    No categories match your search.
                </div>

                <div class="ct-pagination-wrap" id="ctPaginationWrap" style="display:none;">
                    <div class="ct-pagination-info" id="ctPaginationInfo"></div>
                    <div class="ct-pagination" id="ctPagination"></div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="ct-modal-overlay" id="ctDeleteModal">
            <div class="ct-modal">
                <div class="ct-modal-icon"><i class="bx bx-trash"></i></div>
                <h4>Delete Category?</h4>
                <p>You are about to delete</p>
                <div class="ct-del-name" id="ctDeleteName">"Category"</div>
                <p style="font-size:12px;color:#94a3b8;">This action cannot be undone.</p>
                <div class="ct-modal-actions">
                    <button class="ct-modal-btn cancel" onclick="ctCloseDeleteModal()">
                        <i class="bx bx-x"></i> Cancel
                    </button>
                    <a href="#" class="ct-modal-btn confirm" id="ctDeleteConfirm">
                        <i class="bx bx-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
        let currentPage = 1;
        let searchQuery = '';

        const allRows = Array.from(document.querySelectorAll('.ct-data-row'));
        const perPageSelect = document.getElementById('ctPerPage');
        const searchInput = document.getElementById('ctSearchInput');
        const noResults = document.getElementById('ctNoResults');
        const toolbarCount = document.getElementById('ctToolbarCount');
        const paginationWrap = document.getElementById('ctPaginationWrap');
        const paginationInfo = document.getElementById('ctPaginationInfo');
        const paginationDiv = document.getElementById('ctPagination');
        const tableView = document.getElementById('ctTableView');

        if (allRows.length === 0) return;

        function getPerPage() {
            const val = perPageSelect.value;
            return val === 'all' ? 99999 : parseInt(val);
        }

        function getFiltered() {
            return allRows.filter(row => {
                const text = row.textContent.toLowerCase();
                return !searchQuery || text.includes(searchQuery);
            });
        }

        function render() {
            const filtered = getFiltered();
            const perPage = getPerPage();
            const total = filtered.length;
            const totalPages = Math.max(1, Math.ceil(total / perPage));

            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const start = (currentPage - 1) * perPage;
            const end = Math.min(start + perPage, total);
            const pageRows = filtered.slice(start, end);

            allRows.forEach(r => r.style.display = 'none');
            pageRows.forEach((row, i) => {
                row.style.display = '';
                row.querySelector('.ct-row-num').textContent = start + i + 1;
            });

            toolbarCount.textContent = total + ' records';
            noResults.style.display = total === 0 ? 'block' : 'none';
            tableView.style.display = total === 0 ? 'none' : '';
            paginationWrap.style.display = total > 0 ? '' : 'none';

            const showStart = total > 0 ? start + 1 : 0;
            paginationInfo.innerHTML = 'Showing <strong>' + showStart + '</strong> to <strong>' + end + '</strong> of <strong>' + total + '</strong> categories';

            paginationDiv.innerHTML = '';
            if (totalPages <= 1) return;

            addBtn('<i class="bx bx-chevron-left"></i>', currentPage > 1 ? currentPage - 1 : null, 'nav-btn');

            let pages = [];
            if (totalPages <= 7) {
                for (let i = 1; i <= totalPages; i++) pages.push(i);
            } else if (currentPage <= 3) {
                pages = [1, 2, 3, 4, '...', totalPages];
            } else if (currentPage >= totalPages - 2) {
                pages = [1, '...', totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
            } else {
                pages = [1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages];
            }

            pages.forEach(p => {
                if (p === '...') {
                    const d = document.createElement('span');
                    d.className = 'ct-page-btn disabled';
                    d.textContent = '...';
                    paginationDiv.appendChild(d);
                } else {
                    addBtn(p, p, p === currentPage ? 'active' : '');
                }
            });

            addBtn('<i class="bx bx-chevron-right"></i>', currentPage < totalPages ? currentPage + 1 : null, 'nav-btn');
        }

        function addBtn(label, page, extraClass) {
            const btn = document.createElement('button');
            btn.className = 'ct-page-btn' + (extraClass ? ' ' + extraClass : '') + (!page ? ' disabled' : '');
            btn.innerHTML = label;
            if (page && extraClass !== 'active') {
                btn.onclick = function () {
                    currentPage = page;
                    render();
                    document.querySelector('.ct-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
                };
            }
            paginationDiv.appendChild(btn);
        }

        searchInput.addEventListener('input', function () {
            searchQuery = this.value.toLowerCase().trim();
            currentPage = 1;
            render();
        });

        perPageSelect.addEventListener('change', function () {
            currentPage = 1;
            render();
        });

        // Delete modal
        document.querySelectorAll('.ct-delete-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                document.getElementById('ctDeleteName').textContent = '"' + name + '"';
                document.getElementById('ctDeleteConfirm').href = '<?= base_url("index.php/admin/category/delete/") ?>' + id;
                document.getElementById('ctDeleteModal').classList.add('show');
            });
        });

        window.ctCloseDeleteModal = function () {
            document.getElementById('ctDeleteModal').classList.remove('show');
        };

        document.getElementById('ctDeleteModal').addEventListener('click', function (e) {
            if (e.target === this) ctCloseDeleteModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') ctCloseDeleteModal();
        });

        render();
    })();
</script>
