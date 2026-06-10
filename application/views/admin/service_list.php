<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            .sv-wrap {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .sv-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            .sv-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
                gap: 14px;
                flex-wrap: wrap;
            }

            .sv-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sv-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 17px;
                font-weight: 700;
                color: #1e293b;
            }

            .sv-toolbar-title i {
                font-size: 20px;
                color: #7c3aed;
            }

            .sv-toolbar-count {
                background: #f3f0ff;
                color: #7c3aed;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .sv-toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .sv-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: #64748b;
                font-weight: 500;
            }

            .sv-per-page select {
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

            .sv-per-page select:focus {
                border-color: #c4b5fd;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
            }

            .sv-filter-tabs {
                display: flex;
                gap: 2px;
                background: #f1f5f9;
                border-radius: 8px;
                padding: 3px;
                border: 1px solid #e2e8f0;
            }

            .sv-filter-tab {
                padding: 6px 14px;
                border: none;
                background: transparent;
                border-radius: 6px;
                cursor: pointer;
                font-size: 12px;
                font-weight: 700;
                color: #94a3b8;
                font-family: inherit;
                transition: all 0.15s ease;
                white-space: nowrap;
            }

            .sv-filter-tab.active {
                background: #fff;
                color: #7c3aed;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            }

            .sv-filter-tab:hover:not(.active) {
                color: #64748b;
            }

            .sv-search {
                position: relative;
                min-width: 240px;
            }

            .sv-search input {
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
            }

            .sv-search input::placeholder {
                color: #94a3b8;
            }

            .sv-search input:focus {
                border-color: #c4b5fd;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
            }

            .sv-search .search-icon {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 16px;
                pointer-events: none;
            }

            .sv-add-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                background: #7c3aed;
                color: #fff;
                border: none;
                cursor: pointer;
                transition: all 0.15s ease;
            }

            .sv-add-btn:hover {
                background: #6d28d9;
                color: #fff;
                text-decoration: none;
            }

            .sv-add-btn i {
                font-size: 16px;
            }

            .sv-table-wrap {
                overflow-x: auto;
            }

            .sv-table {
                width: 100%;
                border-collapse: collapse;
            }

            .sv-table th {
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

            .sv-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                font-weight: 500;
                vertical-align: middle;
            }

            .sv-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .sv-table tbody tr:hover {
                background: #fafbfd;
            }

            .sv-row-num {
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

            .sv-customer-cell {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sv-avatar {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
            }

            .sv-avatar.violet {
                background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            }

            .sv-avatar.teal {
                background: linear-gradient(135deg, #14b8a6, #0d9488);
            }

            .sv-avatar.rose {
                background: linear-gradient(135deg, #f43f5e, #e11d48);
            }

            .sv-avatar.amber {
                background: linear-gradient(135deg, #f59e0b, #d97706);
            }

            .sv-avatar.blue {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
            }

            .sv-avatar.emerald {
                background: linear-gradient(135deg, #10b981, #059669);
            }

            .sv-avatar.sky {
                background: linear-gradient(135deg, #0ea5e9, #0284c7);
            }

            .sv-avatar.pink {
                background: linear-gradient(135deg, #ec4899, #db2777);
            }

            .sv-customer-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 13px;
                display: block;
                margin-bottom: 1px;
            }

            .sv-customer-mobile {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .sv-customer-mobile i {
                font-size: 12px;
            }

            .sv-product-cell {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .sv-product-ico {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f3f0ff;
                color: #7c3aed;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                flex-shrink: 0;
            }

            .sv-product-name {
                font-weight: 600;
                color: #334155;
                font-size: 13px;
            }

            .sv-svc-num {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                background: #f1f5f9;
                color: #64748b;
            }

            .sv-svc-num i {
                font-size: 13px;
            }

            .sv-date {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                color: #64748b;
                white-space: nowrap;
            }

            .sv-date i {
                font-size: 14px;
                color: #94a3b8;
            }

            .sv-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 12px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .sv-badge i {
                font-size: 13px;
            }

            .sv-badge.done {
                background: #ecfdf5;
                color: #059669;
            }

            .sv-badge.pending {
                background: #fffbeb;
                color: #d97706;
            }

            .sv-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                justify-content: center;
            }

            .sv-act-btn {
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

            .sv-act-btn.view {
                background: #f3f0ff;
                color: #7c3aed;
            }

            .sv-act-btn.view:hover {
                background: #ede9fe;
            }

            .sv-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .sv-empty i {
                font-size: 36px;
                color: #cbd5e1;
                margin-bottom: 10px;
                display: block;
            }

            .sv-empty h4 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 600;
                color: #475569;
            }

            .sv-empty p {
                margin: 0;
                font-size: 13px;
                color: #94a3b8;
            }

            .sv-no-results {
                display: none;
                text-align: center;
                padding: 36px 20px;
                color: #94a3b8;
                font-size: 13px;
                font-weight: 500;
            }

            .sv-no-results i {
                font-size: 24px;
                display: block;
                margin-bottom: 6px;
                color: #cbd5e1;
            }

            .sv-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 20px;
                border-top: 1px solid #f1f5f9;
                gap: 12px;
                flex-wrap: wrap;
            }

            .sv-pagination-info {
                font-size: 13px;
                color: #7c3aed;
                font-weight: 500;
            }

            .sv-pagination-info strong {
                color: #1e293b;
                font-weight: 700;
            }

            .sv-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .sv-page-btn {
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
                text-decoration: none;
                padding: 0 4px;
            }

            .sv-page-btn:hover:not(.active):not(.disabled) {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #7c3aed;
            }

            .sv-page-btn.active {
                background: #7c3aed;
                color: #fff;
                border-color: #7c3aed;
            }

            .sv-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .sv-page-btn.nav-btn {
                font-size: 16px;
                color: #64748b;
            }

            @media (max-width: 768px) {
                .sv-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 16px;
                    gap: 10px;
                }

                .sv-toolbar-left {
                    justify-content: space-between;
                }

                .sv-toolbar-right {
                    flex-direction: column;
                    gap: 8px;
                }

                .sv-search {
                    min-width: unset;
                    width: 100%;
                }

                .sv-filter-tabs {
                    width: 100%;
                }

                .sv-filter-tab {
                    flex: 1;
                    text-align: center;
                }

                .sv-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                .sv-per-page select {
                    flex: 1;
                    max-width: 120px;
                }

                .sv-add-btn {
                    width: 100%;
                    justify-content: center;
                }

                .sv-table-wrap {
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                }

                .sv-table {
                    min-width: 860px;
                }

                .sv-table th,
                .sv-table td {
                    padding: 12px 10px;
                    font-size: 12px;
                }

                .sv-table th {
                    font-size: 10px;
                }

                .sv-customer-cell {
                    gap: 8px;
                    min-width: 180px;
                }

                .sv-avatar {
                    width: 34px;
                    height: 34px;
                    border-radius: 9px;
                    font-size: 11px;
                }

                .sv-customer-name,
                .sv-product-name {
                    font-size: 12px;
                }

                .sv-customer-mobile,
                .sv-svc-num,
                .sv-date,
                .sv-badge {
                    font-size: 11px;
                }

                .sv-product-cell {
                    min-width: 150px;
                }

                .sv-product-ico {
                    width: 30px;
                    height: 30px;
                    border-radius: 8px;
                    font-size: 14px;
                }

                .sv-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .sv-wrap {
                    padding: 0 8px;
                }

                .sv-toolbar {
                    padding: 12px;
                }

                .sv-toolbar-title {
                    font-size: 15px;
                }

                .sv-toolbar-title i {
                    font-size: 18px;
                }

                .sv-toolbar-count {
                    font-size: 11px;
                    padding: 2px 8px;
                }
            }
        </style>

        <?php
        $totalRows = !empty($services) ? count($services) : 0;
        $doneCount = 0;
        $pendingCount = 0;
        $currentMonth = (int) date('n');
        $monthOptions = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        if (!empty($services)) {
            foreach ($services as $s) {
                $isDone = ((string) ($s->status ?? 0) === '1' || strtolower((string) ($s->status ?? '')) === 'done');
                if ($isDone)
                    $doneCount++;
                else
                    $pendingCount++;
            }
        }
        $avatarColors = ['violet', 'teal', 'rose', 'amber', 'blue', 'emerald', 'sky', 'pink'];
        ?>

        <div class="sv-wrap">
            <div class="sv-card">
                <div class="sv-toolbar">
                    <div class="sv-toolbar-left">
                        <div class="sv-toolbar-title">
                            <i class="bx bx-wrench"></i> Services
                        </div>
                        <span class="sv-toolbar-count" id="svToolbarCount"><?= $totalRows ?> records</span>
                    </div>
                    <div class="sv-toolbar-right">
                        <div class="sv-per-page">
                            <span>Show</span>
                            <select id="svPerPage">
                                <option value="15" selected>15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="sv-per-page">
                            <span>Month</span>
                            <select id="svMonthFilter">
                                <?php foreach ($monthOptions as $monthNumber => $monthLabel): ?>
                                    <option value="<?= $monthNumber ?>" <?= $monthNumber === $currentMonth ? 'selected' : '' ?>>
                                        <?= $monthLabel ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="sv-filter-tabs" id="svFilterTabs">
                            <button class="sv-filter-tab active" data-filter="all">All (<?= $totalRows ?>)</button>
                            <button class="sv-filter-tab" data-filter="pending">Pending (<?= $pendingCount ?>)</button>
                            <button class="sv-filter-tab" data-filter="done">Done (<?= $doneCount ?>)</button>
                        </div>
                        <div class="sv-search">
                            <input type="text" id="svSearchInput" placeholder="Search name, mobile, product...">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                        <a href="<?= site_url('admin/service/add') ?>" class="sv-add-btn">
                            <i class="bx bx-plus"></i> Add Service
                        </a>
                    </div>
                </div>

                <div class="sv-table-wrap" id="svTableView">
                    <table class="sv-table" id="svTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Service No.</th>
                                <th>Service Date</th>
                                <th>Status</th>
                                <th style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="svTableBody">
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $index => $s):
                                    $isDone = ((string) ($s->status ?? 0) === '1' || strtolower((string) ($s->status ?? '')) === 'done');
                                    $statusClass = $isDone ? 'done' : 'pending';
                                    $statusLabel = $isDone ? 'Done' : 'Pending';
                                    $monthValue = !empty($s->service_date) ? (int) date('n', strtotime($s->service_date)) : 0;
                                    $initials = strtoupper(substr(trim($s->customer_name ?? 'CU'), 0, 2));
                                    $colorClass = $avatarColors[$index % count($avatarColors)];
                                    ?>
                                    <tr class="sv-data-row" data-status="<?= $statusClass ?>" data-month="<?= $monthValue ?>">
                                        <td><span class="sv-row-num"></span></td>
                                        <td>
                                            <div class="sv-customer-cell">
                                                <div class="sv-avatar <?= $colorClass ?>"><?= htmlspecialchars($initials) ?>
                                                </div>
                                                <div>
                                                    <span
                                                        class="sv-customer-name"><?= htmlspecialchars($s->customer_name ?? ('Customer #' . ($s->customer_id ?? ''))) ?></span>
                                                    <span class="sv-customer-mobile">
                                                        <i class="bx bx-phone"></i>
                                                        <?= htmlspecialchars($s->customer_mobile ?? '-') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sv-product-cell">
                                                <div class="sv-product-ico"><i class="bx bx-devices"></i></div>
                                                <span
                                                    class="sv-product-name"><?= htmlspecialchars($s->product_name ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="sv-svc-num">
                                                <i class="bx bx-hash"></i>
                                                <?= isset($s->service_number) ? (int) $s->service_number : '-' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="sv-date">
                                                <i class="bx bx-calendar"></i>
                                                <?= !empty($s->service_date) ? date('d M Y', strtotime($s->service_date)) : '—' ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="sv-badge <?= $statusClass ?>">
                                                <i class="bx <?= $isDone ? 'bx-check-circle' : 'bx-time-five' ?>"></i>
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="sv-actions">
                                                <a href="<?= site_url('admin/service/view/' . $s->id) ?>"
                                                    class="sv-act-btn view" title="View">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="sv-empty-row">
                                    <td colspan="7">
                                        <div class="sv-empty">
                                            <i class="bx bx-wrench"></i>
                                            <h4>No Services Found</h4>
                                            <p>Service records will appear here once services are scheduled.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="sv-no-results" id="svNoResults">
                    <i class="bx bx-search-alt"></i>
                    No services match your search or filter.
                </div>

                <div class="sv-pagination-wrap" id="svPaginationWrap" style="display:none;">
                    <div class="sv-pagination-info" id="svPaginationInfo"></div>
                    <div class="sv-pagination" id="svPagination"></div>
                </div>
            </div>
        </div>

        <script>
            (function () {
                let currentPage = 1;
                let currentFilter = 'all';
                let searchQuery = '';

                const allRows = Array.from(document.querySelectorAll('.sv-data-row'));
                const perPageSelect = document.getElementById('svPerPage');
                const monthFilterSelect = document.getElementById('svMonthFilter');
                const searchInput = document.getElementById('svSearchInput');
                const filterTabs = document.getElementById('svFilterTabs');
                const noResults = document.getElementById('svNoResults');
                const toolbarCount = document.getElementById('svToolbarCount');
                const paginationWrap = document.getElementById('svPaginationWrap');
                const paginationInfo = document.getElementById('svPaginationInfo');
                const paginationDiv = document.getElementById('svPagination');

                if (allRows.length === 0) return;

                function getPerPage() {
                    const val = perPageSelect.value;
                    return val === 'all' ? 99999 : parseInt(val);
                }

                function getFilteredRows() {
                    return allRows.filter(row => {
                        const status = row.getAttribute('data-status');
                        const rowMonth = row.getAttribute('data-month');
                        const text = row.textContent.toLowerCase();
                        const matchFilter = currentFilter === 'all' || status === currentFilter;
                        const matchMonth = !monthFilterSelect.value || rowMonth === monthFilterSelect.value;
                        const matchSearch = !searchQuery || text.includes(searchQuery);
                        return matchFilter && matchMonth && matchSearch;
                    });
                }

                function render() {
                    const filtered = getFilteredRows();
                    const perPage = getPerPage();
                    const total = filtered.length;
                    const totalPages = Math.max(1, Math.ceil(total / perPage));

                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    const start = (currentPage - 1) * perPage;
                    const end = Math.min(start + perPage, total);
                    const pageRows = filtered.slice(start, end);

                    // Hide all rows first
                    allRows.forEach(r => r.style.display = 'none');

                    // Show only current page rows and set row numbers
                    pageRows.forEach((row, i) => {
                        row.style.display = '';
                        row.querySelector('.sv-row-num').textContent = start + i + 1;
                    });

                    // Update count
                    toolbarCount.textContent = total + ' records';

                    // No results
                    noResults.style.display = total === 0 ? 'block' : 'none';
                    document.getElementById('svTableView').style.display = total === 0 ? 'none' : '';

                    // Pagination visibility
                    if (total > 0 && totalPages > 1) {
                        paginationWrap.style.display = '';
                    } else if (total > 0) {
                        paginationWrap.style.display = '';
                    } else {
                        paginationWrap.style.display = 'none';
                    }

                    // Pagination info
                    const showStart = total > 0 ? start + 1 : 0;
                    const showEnd = end;
                    paginationInfo.innerHTML = 'Showing <strong>' + showStart + '</strong> to <strong>' + showEnd + '</strong> of <strong>' + total + '</strong> services';

                    // Build pagination buttons
                    paginationDiv.innerHTML = '';

                    if (totalPages <= 1) return;

                    // Prev
                    addPageBtn('<i class="bx bx-chevron-left"></i>', currentPage > 1 ? currentPage - 1 : null, 'nav-btn');

                    // Page numbers
                    const maxVisible = 7;
                    let pages = [];

                    if (totalPages <= maxVisible) {
                        for (let i = 1; i <= totalPages; i++) pages.push(i);
                    } else {
                        pages.push(1);
                        if (currentPage > 3) pages.push('...');

                        let rangeStart = Math.max(2, currentPage - 1);
                        let rangeEnd = Math.min(totalPages - 1, currentPage + 1);

                        if (currentPage <= 3) {
                            rangeEnd = Math.min(4, totalPages - 1);
                        }
                        if (currentPage >= totalPages - 2) {
                            rangeStart = Math.max(totalPages - 3, 2);
                        }

                        for (let i = rangeStart; i <= rangeEnd; i++) pages.push(i);

                        if (currentPage < totalPages - 2) pages.push('...');
                        pages.push(totalPages);
                    }

                    pages.forEach(p => {
                        if (p === '...') {
                            const dots = document.createElement('span');
                            dots.className = 'sv-page-btn disabled';
                            dots.textContent = '...';
                            paginationDiv.appendChild(dots);
                        } else {
                            addPageBtn(p, p, p === currentPage ? 'active' : '');
                        }
                    });

                    // Next
                    addPageBtn('<i class="bx bx-chevron-right"></i>', currentPage < totalPages ? currentPage + 1 : null, 'nav-btn');
                }

                function addPageBtn(label, page, extraClass) {
                    const btn = document.createElement('button');
                    btn.className = 'sv-page-btn' + (extraClass ? ' ' + extraClass : '') + (!page ? ' disabled' : '');
                    btn.innerHTML = label;
                    if (page && extraClass !== 'active') {
                        btn.onclick = function () {
                            currentPage = page;
                            render();
                            // Scroll to top of table
                            document.querySelector('.sv-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
                        };
                    }
                    paginationDiv.appendChild(btn);
                }

                // Events
                searchInput.addEventListener('input', function () {
                    searchQuery = this.value.toLowerCase().trim();
                    currentPage = 1;
                    render();
                });

                perPageSelect.addEventListener('change', function () {
                    currentPage = 1;
                    render();
                });

                monthFilterSelect.addEventListener('change', function () {
                    currentPage = 1;
                    render();
                });

                filterTabs.addEventListener('click', function (e) {
                    const tab = e.target.closest('.sv-filter-tab');
                    if (!tab) return;
                    filterTabs.querySelectorAll('.sv-filter-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    currentFilter = tab.getAttribute('data-filter');
                    currentPage = 1;
                    render();
                });

                // Keyboard nav
                document.addEventListener('keydown', function (e) {
                    if (document.activeElement === searchInput) return;
                    const filtered = getFilteredRows();
                    const perPage = getPerPage();
                    const totalPages = Math.max(1, Math.ceil(filtered.length / perPage));

                    if (e.key === 'ArrowLeft' && currentPage > 1) {
                        currentPage--;
                        render();
                    } else if (e.key === 'ArrowRight' && currentPage < totalPages) {
                        currentPage++;
                        render();
                    }
                });

                // Init
                render();
            })();
        </script>
    </div>
</div>
