<?php
$adminAccount = $admin_account ?? null;
$customers = $customers ?? [];
$filters = $customer_filters ?? ['search' => ''];
$searchValue = trim((string) ($filters['search'] ?? ''));
$pagination = $customer_pagination ?? ['current_page' => 1, 'per_page' => 10, 'total_items' => count($customers), 'total_pages' => 1];
$currentPage = (int) ($pagination['current_page'] ?? 1);
$totalPages = (int) ($pagination['total_pages'] ?? 1);
$buildPageUrl = static function ($page, $adminId, $searchValue) {
    $params = ['page' => max(1, (int) $page)];
    if ($searchValue !== '') {
        $params['search'] = $searchValue;
    }
    return site_url('super-admin/admin-details/' . (int) $adminId . '?' . http_build_query($params));
};
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --ink: #0c1322;
        --ink-2: #344054;
        --ink-3: #667085;
        --ink-4: #98a2b3;
        --surface: #ffffff;
        --surface-2: #f8f9fc;
        --surface-3: #f1f4f9;
        --border: rgba(0, 0, 0, .07);
        --border-2: rgba(0, 0, 0, .11);
        --accent: #2563eb;
        --accent-2: #1d4ed8;
        --accent-lt: #eff4ff;
        --accent-glow: rgba(37, 99, 235, .14);
        --success: #10b981;
        --success-lt: #ecfdf5;
        --rad-sm: 8px;
        --rad-md: 14px;
        --rad-lg: 20px;
        --rad-xl: 26px;
        --shadow-xs: 0 1px 2px rgba(0, 0, 0, .04);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
        --shadow-md: 0 6px 24px rgba(0, 0, 0, .08), 0 2px 6px rgba(0, 0, 0, .04);
    }

    .acd-wrap {
        font-family: 'DM Sans', sans-serif;
        padding: 36px 0 72px;
        color: var(--ink);
        -webkit-font-smoothing: antialiased;
    }

    /* ── TOP BAR ── */
    .acd-topbar {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .acd-heading-eyebrow {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--accent);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .acd-heading-eyebrow::before {
        content: '';
        width: 6px;
        height: 6px;
        background: var(--accent);
        border-radius: 50%;
    }

    .acd-title {
        font-family: 'Sora', sans-serif;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -.5px;
        color: var(--ink);
        line-height: 1.15;
        margin-bottom: 4px;
    }

    .acd-subtitle {
        font-size: 14px;
        color: var(--ink-3);
        font-weight: 400;
    }

    .acd-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: var(--rad-md);
        text-decoration: none;
        color: var(--ink-2);
        background: var(--surface);
        border: 1px solid var(--border-2);
        font-size: 14px;
        font-weight: 500;
        transition: all .18s ease;
        box-shadow: var(--shadow-xs);
        white-space: nowrap;
    }

    .acd-back:hover {
        background: var(--surface-2);
        border-color: var(--accent);
        color: var(--accent);
        box-shadow: var(--shadow-sm);
        transform: translateX(-2px);
    }

    /* ── STAT CARDS ── */
    .acd-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .acd-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--rad-lg);
        padding: 0;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
        position: relative;
    }

    .acd-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .acd-card-inner {
        padding: 20px 22px 22px;
    }

    .acd-card-accent {
        height: 3px;
        width: 100%;
    }

    .acd-card:nth-child(1) .acd-card-accent {
        background: linear-gradient(90deg, #2563eb, #60a5fa);
    }

    .acd-card:nth-child(2) .acd-card-accent {
        background: linear-gradient(90deg, #7c3aed, #a78bfa);
    }

    .acd-card:nth-child(3) .acd-card-accent {
        background: linear-gradient(90deg, #0891b2, #67e8f9);
    }

    .acd-card:nth-child(4) .acd-card-accent {
        background: linear-gradient(90deg, #059669, #34d399);
    }

    .acd-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--ink-4);
        margin-bottom: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .acd-label-icon {
        width: 24px;
        height: 24px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .acd-card:nth-child(1) .acd-label-icon {
        background: #eff4ff;
        color: #2563eb;
    }

    .acd-card:nth-child(2) .acd-label-icon {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .acd-card:nth-child(3) .acd-label-icon {
        background: #ecfeff;
        color: #0891b2;
    }

    .acd-card:nth-child(4) .acd-label-icon {
        background: var(--success-lt);
        color: var(--success);
    }

    .acd-value {
        font-family: 'Sora', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
        word-break: break-word;
        line-height: 1.2;
    }

    .acd-card:nth-child(4) .acd-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--success);
    }

    /* ── TOOLBAR ── */
    .acd-toolbar {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .acd-search {
        flex: 1;
        min-width: 260px;
        position: relative;
    }

    .acd-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-4);
        font-size: 15px;
        pointer-events: none;
    }

    .acd-search input {
        width: 100%;
        height: 46px;
        padding: 0 16px 0 42px;
        border-radius: var(--rad-md);
        border: 1.5px solid var(--border-2);
        background: var(--surface);
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: var(--ink);
        transition: border-color .18s, box-shadow .18s;
        box-shadow: var(--shadow-xs);
    }

    .acd-search input::placeholder {
        color: var(--ink-4);
    }

    .acd-search input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-glow);
    }

    .acd-btn {
        height: 46px;
        border-radius: var(--rad-md);
        padding: 0 22px;
        border: none;
        background: var(--accent);
        color: #fff;
        font-family: 'Sora', sans-serif;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all .18s ease;
        box-shadow: 0 2px 12px rgba(37, 99, 235, .28);
        white-space: nowrap;
    }

    .acd-btn:hover {
        background: var(--accent-2);
        box-shadow: 0 4px 18px rgba(37, 99, 235, .38);
        transform: translateY(-1px);
    }

    /* ── TABLE CARD ── */
    .acd-table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--rad-xl);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .acd-table-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .acd-table-title {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .acd-table-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--accent-lt);
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 100px;
        font-family: 'Sora', sans-serif;
    }

    .acd-table-wrap {
        overflow-x: auto;
    }

    .acd-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 680px;
    }

    .acd-table thead tr {
        background: var(--surface-2);
        border-bottom: 1px solid var(--border-2);
    }

    .acd-table th {
        padding: 13px 20px;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--ink-4);
        font-weight: 700;
        white-space: nowrap;
    }

    .acd-table th:first-child {
        padding-left: 24px;
    }

    .acd-table td:first-child {
        padding-left: 24px;
    }

    .acd-table th:last-child,
    .acd-table td:last-child {
        padding-right: 24px;
    }

    .acd-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .14s ease;
    }

    .acd-table tbody tr:last-child {
        border-bottom: none;
    }

    .acd-table tbody tr:hover {
        background: var(--surface-2);
    }

    .acd-table td {
        padding: 15px 20px;
        font-size: 14px;
        color: var(--ink-2);
        vertical-align: middle;
    }

    /* Row number */
    .acd-row-num {
        font-size: 12px;
        font-weight: 600;
        color: var(--ink-4);
        background: var(--surface-3);
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'Sora', sans-serif;
    }

    /* Customer cell */
    .acd-customer-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .acd-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--accent-lt);
        color: var(--accent);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        letter-spacing: -.3px;
    }

    .acd-name {
        font-weight: 600;
        color: var(--ink);
        font-size: 14px;
        line-height: 1.3;
    }

    .acd-muted {
        color: var(--ink-4);
        font-size: 12px;
        margin-top: 2px;
    }

    /* Mobile badge for phone */
    .acd-mobile-val {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        font-weight: 500;
        color: var(--ink-2);
    }

    /* Address */
    .acd-address-val {
        font-size: 13px;
        color: var(--ink-3);
        max-width: 220px;
        line-height: 1.45;
    }

    /* Orders badge */
    .acd-orders-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 28px;
        padding: 0 10px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Sora', sans-serif;
    }

    .acd-orders-badge.has-orders {
        background: var(--success-lt);
        color: var(--success);
    }

    .acd-orders-badge.no-orders {
        background: var(--surface-3);
        color: var(--ink-4);
    }

    /* Empty state */
    .acd-empty {
        padding: 64px 20px;
        text-align: center;
    }

    .acd-empty-icon {
        width: 64px;
        height: 64px;
        background: var(--surface-3);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 28px;
    }

    .acd-empty-title {
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 6px;
    }

    .acd-empty-sub {
        font-size: 14px;
        color: var(--ink-3);
    }

    /* ── PAGINATION ── */
    .acd-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        padding: 16px 24px;
        background: var(--surface-2);
        border-top: 1px solid var(--border);
    }

    .acd-pagination-info {
        font-size: 13px;
        color: var(--ink-3);
        font-weight: 400;
    }

    .acd-pagination-info strong {
        color: var(--ink-2);
        font-weight: 600;
    }

    .acd-pages {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .acd-page {
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--rad-sm);
        border: 1px solid var(--border-2);
        text-decoration: none;
        color: var(--ink-2);
        background: var(--surface);
        font-size: 13px;
        font-weight: 500;
        transition: all .15s ease;
        font-family: 'DM Sans', sans-serif;
    }

    .acd-page:hover:not(.active) {
        background: var(--accent-lt);
        border-color: var(--accent);
        color: var(--accent);
    }

    .acd-page.active {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(37, 99, 235, .3);
    }

    .acd-page-arrow {
        font-size: 15px;
        color: var(--ink-3);
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .acd-card {
        animation: fadeUp .35s ease both;
    }

    .acd-card:nth-child(1) {
        animation-delay: .04s;
    }

    .acd-card:nth-child(2) {
        animation-delay: .09s;
    }

    .acd-card:nth-child(3) {
        animation-delay: .14s;
    }

    .acd-card:nth-child(4) {
        animation-delay: .19s;
    }

    .acd-table-card {
        animation: fadeUp .4s .22s ease both;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .acd-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .acd-wrap {
            padding: 24px 0 48px;
        }

        .acd-summary {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .acd-title {
            font-size: 21px;
        }

        .acd-search {
            min-width: 100%;
        }

        .acd-btn {
            width: 100%;
            justify-content: center;
        }

        .acd-back {
            width: 100%;
            justify-content: center;
        }

        .acd-topbar {
            flex-direction: column;
        }

        .acd-pagination {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 400px) {
        .acd-summary {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="acd-wrap">

    <!-- Top Bar -->
    <div class="acd-topbar">
        <div>
            <div class="acd-heading-eyebrow">Super Admin</div>
            <div class="acd-title">Admin Customer Details</div>
            <div class="acd-subtitle">View all customers registered under this admin account.</div>
        </div>
        <a href="<?= site_url('super-admin/admin-list'); ?>" class="acd-back">
            <i class='bx bx-arrow-back'></i>
            Back to Admin List
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="acd-summary">
        <div class="acd-card">
            <div class="acd-card-accent"></div>
            <div class="acd-card-inner">
                <div class="acd-label">
                    <span class="acd-label-icon"><i class='bx bx-user'></i></span>
                    Admin Name
                </div>
                <div class="acd-value"><?= html_escape($adminAccount->name ?? 'Unknown'); ?></div>
            </div>
        </div>
        <div class="acd-card">
            <div class="acd-card-accent"></div>
            <div class="acd-card-inner">
                <div class="acd-label">
                    <span class="acd-label-icon"><i class='bx bx-store'></i></span>
                    Store Name
                </div>
                <div class="acd-value"><?= html_escape($adminAccount->store_name ?? '-'); ?></div>
            </div>
        </div>
        <div class="acd-card">
            <div class="acd-card-accent"></div>
            <div class="acd-card-inner">
                <div class="acd-label">
                    <span class="acd-label-icon"><i class='bx bx-phone'></i></span>
                    Mobile
                </div>
                <div class="acd-value"><?= html_escape($adminAccount->mobile ?? '-'); ?></div>
            </div>
        </div>
        <div class="acd-card">
            <div class="acd-card-accent"></div>
            <div class="acd-card-inner">
                <div class="acd-label">
                    <span class="acd-label-icon"><i class='bx bx-group'></i></span>
                    Total Customers
                </div>
                <div class="acd-value"><?= (int) ($pagination['total_items'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <!-- Search Toolbar -->
    <form method="get" action="<?= site_url('super-admin/admin-details/' . (int) ($adminAccount->id ?? 0)); ?>"
        class="acd-toolbar">
        <div class="acd-search">
            <i class='bx bx-search acd-search-icon'></i>
            <input type="text" name="search" value="<?= html_escape($searchValue); ?>"
                placeholder="Search by name, mobile, address or area…">
        </div>
        <button type="submit" class="acd-btn">
            <i class='bx bx-search-alt'></i>
            Search
        </button>
    </form>

    <!-- Table Card -->
    <div class="acd-table-card">

        <div class="acd-table-header">
            <div class="acd-table-title">
                <i class='bx bx-list-ul' style="color:var(--ink-3);font-size:18px;"></i>
                Customer List
                <span class="acd-table-count"><?= (int) ($pagination['total_items'] ?? 0); ?> total</span>
            </div>
            <?php if ($searchValue !== ''): ?>
                <span style="font-size:13px;color:var(--ink-3);">
                    Results for <strong style="color:var(--ink-2);">"<?= html_escape($searchValue); ?>"</strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="acd-table-wrap">
            <?php if (empty($customers)): ?>
                <div class="acd-empty">
                    <div class="acd-empty-icon">👤</div>
                    <div class="acd-empty-title">No customers found</div>
                    <div class="acd-empty-sub">
                        <?= $searchValue !== '' ? 'Try adjusting your search query.' : 'No customers have been added under this admin yet.'; ?>
                    </div>
                </div>
            <?php else: ?>
                <table class="acd-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $index => $customer): ?>
                            <?php
                            // Generate initials for avatar
                            $nameParts = explode(' ', trim($customer->name ?? 'U'));
                            $initials = strtoupper(
                                substr($nameParts[0] ?? '', 0, 1) .
                                substr($nameParts[1] ?? '', 0, 1)
                            );
                            $initials = $initials ?: 'U';
                            $totalOrders = (int) ($customer->total_orders ?? 0);
                            ?>
                            <tr>
                                <td>
                                    <span class="acd-row-num">
                                        <?= (($currentPage - 1) * (int) ($pagination['per_page'] ?? 10)) + $index + 1; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="acd-customer-cell">
                                        <div class="acd-avatar"><?= html_escape($initials); ?></div>
                                        <div>
                                            <div class="acd-name"><?= html_escape($customer->name ?? 'Unknown'); ?></div>
                                            <?php if (!empty($customer->email)): ?>
                                                <div class="acd-muted"><?= html_escape($customer->email); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="acd-mobile-val">
                                        <i class='bx bx-phone' style="color:var(--ink-4);font-size:13px;"></i>
                                        <?= html_escape($customer->mobile ?? '-'); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="acd-address-val"><?= html_escape($customer->address ?? '-'); ?></div>
                                </td>
                                <td>
                                    <span class="acd-orders-badge <?= $totalOrders > 0 ? 'has-orders' : 'no-orders'; ?>">
                                        <?= $totalOrders; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="acd-pagination">
            <div class="acd-pagination-info">
                Page <strong><?= $currentPage; ?></strong> of <strong><?= $totalPages; ?></strong>
                &nbsp;·&nbsp; <?= (int) ($pagination['total_items'] ?? 0); ?> customers total
            </div>
            <div class="acd-pages">
                <?php $prevPage = max(1, $currentPage - 1); ?>
                <?php $nextPage = min($totalPages, $currentPage + 1); ?>

                <a href="<?= $buildPageUrl($prevPage, (int) ($adminAccount->id ?? 0), $searchValue); ?>"
                    class="acd-page acd-page-arrow"
                    style="<?= $currentPage <= 1 ? 'opacity:.35;pointer-events:none;' : ''; ?>" title="Previous page">
                    <i class='bx bx-chevron-left'></i>
                </a>

                <?php
                // Smart pagination: show limited page numbers with ellipsis
                $range = 2;
                $pages_shown = [];
                for ($p = 1; $p <= $totalPages; $p++) {
                    if ($p === 1 || $p === $totalPages || abs($p - $currentPage) <= $range) {
                        $pages_shown[] = $p;
                    }
                }
                $prev_p = null;
                foreach ($pages_shown as $p):
                    if ($prev_p !== null && $p - $prev_p > 1):
                        ?>
                        <span style="padding:0 4px;color:var(--ink-4);font-size:14px;line-height:36px;">…</span>
                        <?php
                    endif;
                    ?>
                    <a href="<?= $buildPageUrl($p, (int) ($adminAccount->id ?? 0), $searchValue); ?>"
                        class="acd-page <?= $p === $currentPage ? 'active' : ''; ?>">
                        <?= $p; ?>
                    </a>
                    <?php
                    $prev_p = $p;
                endforeach;
                ?>

                <a href="<?= $buildPageUrl($nextPage, (int) ($adminAccount->id ?? 0), $searchValue); ?>"
                    class="acd-page acd-page-arrow"
                    style="<?= $currentPage >= $totalPages ? 'opacity:.35;pointer-events:none;' : ''; ?>"
                    title="Next page">
                    <i class='bx bx-chevron-right'></i>
                </a>
            </div>
        </div>

    </div>
</div>