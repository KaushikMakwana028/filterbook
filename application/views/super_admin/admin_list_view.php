<?php
$admins       = $admins       ?? [];
$planSummaries = $plan_summaries ?? [];
$pagination   = $pagination   ?? ['current_page' => 1, 'per_page' => 10, 'total_items' => count($admins), 'total_pages' => 1];
$adminTotals  = $admin_totals  ?? ['total' => count($admins), 'active' => 0, 'inactive' => 0];
$planTotals   = $plan_totals   ?? ['paid' => 0, 'unpaid' => 0, 'trial' => 0, 'expired' => 0];
$filters      = $filters ?? ['search' => '', 'status' => 'all'];
$searchValue  = trim((string) ($filters['search'] ?? ''));
$statusValue  = (string) ($filters['status'] ?? 'all');
$currentPage  = (int) ($pagination['current_page'] ?? 1);
$totalPages   = (int) ($pagination['total_pages']   ?? 1);
$buildPageUrl = static function ($page, $searchValue, $statusValue) {
    $params = ['page' => max(1, (int) $page)];
    if ($searchValue !== '') $params['search'] = $searchValue;
    if (in_array($statusValue, ['active', 'inactive'], true)) $params['status'] = $statusValue;
    return site_url('super-admin/admin-list?' . http_build_query($params));
};
?>

<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --ink:        #0b1120;
    --ink-2:      #3d4966;
    --ink-3:      #7c8aaa;
    --ink-4:      #b0bcd4;
    --surface:    #ffffff;
    --surface-2:  #f4f6fb;
    --surface-3:  #eaecf5;
    --border:     #e2e6f0;
    --accent:     #2c5fde;
    --accent-h:   #1e47c0;
    --accent-glow:rgba(44,95,222,.14);
    --green:      #15803d;
    --green-bg:   #dcfce7;
    --green-bd:   #bbf7d0;
    --red:        #b91c1c;
    --red-bg:     #fee2e2;
    --red-bd:     #fecaca;
    --amber:      #92400e;
    --amber-bg:   #fef3c7;
    --amber-bd:   #fde68a;
    --slate:      #475569;
    --slate-bg:   #f1f5f9;
    --slate-bd:   #cbd5e1;
    --radius-sm:  8px;
    --radius:     12px;
    --radius-lg:  16px;
    --radius-xl:  20px;
    --shadow-sm:  0 1px 3px rgba(11,17,32,.06), 0 1px 2px rgba(11,17,32,.04);
    --shadow:     0 4px 16px rgba(11,17,32,.08), 0 1px 4px rgba(11,17,32,.05);
    --shadow-lg:  0 12px 40px rgba(11,17,32,.12), 0 4px 12px rgba(11,17,32,.06);
    --font-head:  'Syne', sans-serif;
    --font-body:  'DM Sans', sans-serif;
}

.al-wrap {
    padding: 32px 0 64px;
    font-family: var(--font-body);
    color: var(--ink);
}

/* ── Page header ── */
.al-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 28px;
}
.al-page-title {
    font-family: var(--font-head);
    font-size: 26px;
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -.4px;
    line-height: 1.1;
}
.al-page-title span {
    color: var(--accent);
}
.al-page-subtitle {
    font-size: 13px;
    color: var(--ink-3);
    margin-top: 4px;
    font-weight: 400;
}

/* ── Stat pills ── */
.al-stats-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}
.al-stat-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: 8px 18px 8px 10px;
    box-shadow: var(--shadow-sm);
    transition: box-shadow .15s;
}
.al-stat-pill:hover { box-shadow: var(--shadow); }
.al-stat-icon {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.al-stat-icon svg { display: block; }
.al-stat-icon--total   { background: #e8eeff; color: var(--accent); }
.al-stat-icon--active  { background: var(--green-bg); color: var(--green); }
.al-stat-icon--inactive{ background: var(--red-bg); color: var(--red); }
.al-stat-body {}
.al-stat-val {
    font-family: var(--font-head);
    font-size: 18px;
    font-weight: 800;
    color: var(--ink);
    line-height: 1;
}
.al-stat-lbl {
    font-size: 11px;
    color: var(--ink-3);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .4px;
    margin-top: 1px;
}

/* ── Main card ── */
.al-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    overflow: hidden;
}

/* ── Toolbar ── */
.al-toolbar {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-2);
}
.al-search-form {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.al-search-wrap {
    position: relative;
    flex: 1;
    min-width: 260px;
}
.al-search-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    color: var(--ink-4);
    pointer-events: none;
    display: flex;
}
.al-search-input {
    width: 100%;
    height: 44px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    padding: 0 14px 0 42px;
    font-size: 14px;
    font-family: var(--font-body);
    color: var(--ink);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
    box-shadow: var(--shadow-sm);
}
.al-search-input::placeholder { color: var(--ink-4); }
.al-search-input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-glow), var(--shadow-sm);
}
.al-filter-select {
    height: 44px;
    min-width: 160px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    padding: 0 36px 0 14px;
    font-size: 14px;
    font-family: var(--font-body);
    color: var(--ink);
    outline: none;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6l4 4 4-4' stroke='%237c8aaa' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    transition: border-color .15s, box-shadow .15s;
    box-shadow: var(--shadow-sm);
}
.al-filter-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px var(--accent-glow), var(--shadow-sm);
}
.al-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 44px;
    padding: 0 20px;
    border-radius: var(--radius);
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-body);
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: background .14s, border-color .14s, box-shadow .14s, transform .1s;
    white-space: nowrap;
    text-decoration: none;
}
.al-btn:active { transform: translateY(1px); }
.al-btn-primary {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent);
    box-shadow: 0 2px 8px rgba(44,95,222,.28);
}
.al-btn-primary:hover {
    background: var(--accent-h);
    border-color: var(--accent-h);
    box-shadow: 0 4px 16px rgba(44,95,222,.36);
}
.al-btn-ghost {
    background: var(--surface);
    color: var(--ink-2);
    border-color: var(--border);
    box-shadow: var(--shadow-sm);
}
.al-btn-ghost:hover { background: var(--surface-3); }

/* Active filters indicator */
.al-active-filters {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background: #eef1ff;
    border-bottom: 1px solid #d4dbff;
    font-size: 12px;
    color: var(--accent);
    font-weight: 500;
}
.al-active-filters svg { flex-shrink: 0; }

/* ── Table ── */
.al-tbl-wrap { overflow-x: auto; }
.al-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 880px;
}
.al-table thead tr {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border);
}
.al-table th {
    padding: 12px 20px;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: var(--ink-3);
    text-align: left;
    white-space: nowrap;
    font-family: var(--font-head);
}
.al-table td {
    padding: 16px 20px;
    font-size: 13.5px;
    color: var(--ink-2);
    vertical-align: middle;
    border-bottom: 1px solid var(--border);
}
.al-table tbody tr { transition: background .1s; }
.al-table tbody tr:last-child td { border-bottom: none; }
.al-table tbody tr:hover td { background: #f7f9ff; }

/* Avatar */
.al-user-cell { display: flex; align-items: center; gap: 12px; }
.al-avatar {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    font-weight: 800;
    font-family: var(--font-head);
    flex-shrink: 0;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(44,95,222,.15);
}
/* Color variety for avatars based on first letter */
.al-avatar[data-color="b"] { background: linear-gradient(135deg, #fce7f3, #fbcfe8); color: #be185d; box-shadow: 0 2px 6px rgba(190,24,93,.15); }
.al-avatar[data-color="c"] { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #065f46; box-shadow: 0 2px 6px rgba(6,95,70,.15); }
.al-avatar[data-color="d"] { background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: #5b21b6; box-shadow: 0 2px 6px rgba(91,33,182,.15); }
.al-avatar[data-color="e"] { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; box-shadow: 0 2px 6px rgba(146,64,14,.15); }
.al-avatar[data-color="f"] { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #991b1b; box-shadow: 0 2px 6px rgba(153,27,27,.15); }

.al-user-name { font-size: 14px; font-weight: 600; color: var(--ink); font-family: var(--font-head); letter-spacing: -.1px; }
.al-user-email { font-size: 12px; color: var(--ink-3); margin-top: 2px; }

/* Store name */
.al-store { font-weight: 500; color: var(--ink); font-size: 13px; }

/* Plan */
.al-plan-name { font-weight: 600; color: var(--ink); font-size: 13px; margin-bottom: 3px; }
.al-plan-name .plan-type { color: var(--ink-3); font-weight: 400; }
.al-plan-dates { font-size: 11px; color: var(--ink-4); display: flex; align-items: center; gap: 4px; }

/* Badges */
.al-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 600;
    white-space: nowrap;
    border: 1px solid transparent;
    font-family: var(--font-body);
}
.al-badge-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
}
.al-b-active   { background: var(--green-bg);  color: var(--green); border-color: var(--green-bd); }
.al-b-active .al-badge-dot   { background: var(--green); box-shadow: 0 0 0 2px #86efac; }
.al-b-inactive { background: var(--red-bg);    color: var(--red);   border-color: var(--red-bd); }
.al-b-inactive .al-badge-dot { background: var(--red); }
.al-b-paid    { background: var(--green-bg);  color: var(--green); border-color: var(--green-bd); }
.al-b-paid .al-badge-dot    { background: var(--green); box-shadow: 0 0 0 2px #86efac; }
.al-b-trial   { background: var(--amber-bg);  color: var(--amber); border-color: var(--amber-bd); }
.al-b-trial .al-badge-dot   { background: #f59e0b; }
.al-b-unpaid  { background: var(--slate-bg);  color: var(--slate); border-color: var(--slate-bd); }
.al-b-unpaid .al-badge-dot  { background: #94a3b8; }
.al-b-expired { background: var(--red-bg);    color: var(--red);   border-color: var(--red-bd); }
.al-b-expired .al-badge-dot { background: var(--red); }

/* Action buttons */
.al-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    height: 34px;
    padding: 0 14px;
    border-radius: var(--radius-sm);
    font-size: 12px;
    font-weight: 600;
    font-family: var(--font-body);
    cursor: pointer;
    border: 1.5px solid;
    background: transparent;
    transition: background .12s, transform .1s, box-shadow .12s;
    white-space: nowrap;
}
.al-action-btn:active { transform: scale(.97); }
.al-action-group {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.al-action-link {
    text-decoration: none;
}
.al-action-btn--details {
    color: var(--accent);
    border-color: #c7d2fe;
    background: #eef2ff;
}
.al-action-btn--details:hover {
    background: #dbeafe;
    border-color: #93c5fd;
    box-shadow: 0 2px 8px rgba(44,95,222,.15);
}
.al-action-btn--deactivate {
    color: var(--red);
    border-color: var(--red-bd);
    background: var(--red-bg);
}
.al-action-btn--deactivate:hover {
    background: #fecaca;
    border-color: #f87171;
    box-shadow: 0 2px 8px rgba(185,28,28,.15);
}
.al-action-btn--activate {
    color: var(--green);
    border-color: var(--green-bd);
    background: var(--green-bg);
}
.al-action-btn--activate:hover {
    background: #bbf7d0;
    border-color: #4ade80;
    box-shadow: 0 2px 8px rgba(21,128,61,.15);
}

/* ── Pagination ── */
.al-pgn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface-2);
}
.al-pgn-info { font-size: 12.5px; color: var(--ink-3); }
.al-pgn-info strong { color: var(--ink-2); font-weight: 600; }
.al-pgn-links { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
.al-pgn-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px; height: 36px;
    padding: 0 10px;
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--border);
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font-head);
    color: var(--ink-2);
    text-decoration: none;
    background: var(--surface);
    transition: border-color .12s, background .12s, color .12s, box-shadow .12s;
    box-shadow: var(--shadow-sm);
}
.al-pgn-link:hover { background: var(--surface-3); border-color: var(--ink-4); }
.al-pgn-link.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #fff;
    box-shadow: 0 2px 8px rgba(44,95,222,.3);
}
.al-pgn-link--arrow { font-size: 16px; padding: 0 12px; color: var(--ink-3); }

/* Empty state */
.al-empty {
    padding: 64px 24px;
    text-align: center;
}
.al-empty-icon {
    width: 60px; height: 60px;
    border-radius: 18px;
    background: var(--surface-2);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    color: var(--ink-4);
    border: 1px solid var(--border);
}
.al-empty-title { font-size: 16px; font-weight: 700; font-family: var(--font-head); color: var(--ink); margin-bottom: 6px; }
.al-empty-text { font-size: 13.5px; color: var(--ink-3); }

/* Contact */
.al-contact { font-variant-numeric: tabular-nums; letter-spacing: .3px; }

@media (max-width: 700px) {
    .al-search-wrap { min-width: 100%; }
    .al-filter-select { min-width: 100%; }
    .al-btn { width: 100%; justify-content: center; }
    .al-search-form { flex-direction: column; }
}
@media (max-width: 560px) {
    .al-page-title { font-size: 20px; }
    .al-stats-row { gap: 8px; }
}
</style>

<div class="al-wrap">

    <!-- Page header -->
    <!-- <div class="al-page-header">
        <div>
            <div class="al-page-title">Admin <span>Accounts</span></div>
            <div class="al-page-subtitle">Manage and monitor all admin users across your platform</div>
        </div>
    </div> -->

    <!-- Stat pills -->
    <!-- <div class="al-stats-row">
        <div class="al-stat-pill">
            <div class="al-stat-icon al-stat-icon--total">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="6" cy="5" r="2.5"/><path d="M1 13c0-2.5 2-4 5-4s5 1.5 5 4"/><circle cx="12" cy="5" r="2"/><path d="M14.5 12c0-1.5-1-2.5-2.5-3"/></svg>
            </div>
            <div class="al-stat-body">
                <div class="al-stat-val"><?= (int) ($adminTotals['total'] ?? 0); ?></div>
                <div class="al-stat-lbl">Total</div>
            </div>
        </div>
        <div class="al-stat-pill">
            <div class="al-stat-icon al-stat-icon--active">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="6.5"/><path d="M5 8l2 2 4-4"/></svg>
            </div>
            <div class="al-stat-body">
                <div class="al-stat-val"><?= (int) ($adminTotals['active'] ?? 0); ?></div>
                <div class="al-stat-lbl">Active</div>
            </div>
        </div>
        <div class="al-stat-pill">
            <div class="al-stat-icon al-stat-icon--inactive">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="6.5"/><path d="M6 6l4 4M10 6l-4 4"/></svg>
            </div>
            <div class="al-stat-body">
                <div class="al-stat-val"><?= (int) ($adminTotals['inactive'] ?? 0); ?></div>
                <div class="al-stat-lbl">Inactive</div>
            </div>
        </div>
    </div> -->

    <!-- Main card -->
    <div class="al-card">

        <!-- Toolbar -->
        <div class="al-toolbar">
            <form method="get" action="<?= site_url('super-admin/admin-list'); ?>" class="al-search-form">
                <div class="al-search-wrap">
                    <span class="al-search-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="7" cy="7" r="4.5"/><path d="M10.5 10.5L14 14" stroke-linecap="round"/></svg>
                    </span>
                    <input type="text" name="search" class="al-search-input"
                           value="<?= html_escape($searchValue); ?>"
                           placeholder="Search by name, email, mobile or store…">
                </div>

                <select name="status" class="al-filter-select">
                    <option value="all"      <?= $statusValue === 'all'      ? 'selected' : ''; ?>>All Status</option>
                    <option value="active"   <?= $statusValue === 'active'   ? 'selected' : ''; ?>>Active Only</option>
                    <option value="inactive" <?= $statusValue === 'inactive' ? 'selected' : ''; ?>>Inactive Only</option>
                </select>

                <button type="submit" class="al-btn al-btn-primary">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="7" cy="7" r="4.5"/><path d="M10.5 10.5L14 14" stroke-linecap="round"/></svg>
                    Apply
                </button>

                <?php if ($searchValue !== '' || $statusValue !== 'all'): ?>
                    <a href="<?= site_url('super-admin/admin-list'); ?>" class="al-btn al-btn-ghost">
                        <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 4L4 12M4 4l8 8" stroke-linecap="round"/></svg>
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <?php if ($searchValue !== '' || $statusValue !== 'all'): ?>
        <div class="al-active-filters">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 4h12M5 8h6M7 12h2"/></svg>
            Filters active:
            <?php if ($searchValue !== ''): ?>
                <strong>"<?= html_escape($searchValue); ?>"</strong>
            <?php endif; ?>
            <?php if ($statusValue !== 'all'): ?>
                <span class="al-badge <?= $statusValue === 'active' ? 'al-b-active' : 'al-b-inactive'; ?>" style="padding:2px 8px;font-size:10px;">
                    <?= ucfirst($statusValue); ?>
                </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Table -->
        <div class="al-tbl-wrap">
            <?php if (empty($admins)): ?>
                <div class="al-empty">
                    <div class="al-empty-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/><path d="M8 11h6M11 8v6"/></svg>
                    </div>
                    <div class="al-empty-title">No admins found</div>
                    <div class="al-empty-text">No admin accounts match the selected search or filter criteria.</div>
                </div>
            <?php else: ?>
                <table class="al-table">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Store</th>
                            <th>Contact</th>
                            <th>Plan</th>
                            <th>Purchase</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin):
                            $planSummary = $planSummaries[(int) $admin->id] ?? null;
                            $parts    = preg_split('/\s+/', trim((string) ($admin->name ?? '')));
                            $initials = strtoupper(substr($parts[0] ?? '', 0, 1));
                            if (count($parts) > 1) $initials .= strtoupper(substr($parts[1], 0, 1));

                            $purchaseStatus = $planSummary['purchase_status'] ?? 'Unpaid';
                            $isActive       = !empty($admin->isActive);

                            $purchaseBadgeClass = match (strtolower($purchaseStatus)) {
                                'paid'    => 'al-b-paid',
                                'trial'   => 'al-b-trial',
                                'expired' => 'al-b-expired',
                                default   => 'al-b-unpaid',
                            };

                            // Avatar color variety based on first letter
                            $firstChar  = strtolower(substr($parts[0] ?? 'z', 0, 1));
                            $colorMap   = ['a'=>'a','b'=>'b','c'=>'c','d'=>'d','e'=>'e','f'=>'f','g'=>'b','h'=>'c','i'=>'d','j'=>'e','k'=>'f','l'=>'b','m'=>'c','n'=>'d','o'=>'e','p'=>'f','q'=>'b','r'=>'c','s'=>'d','t'=>'e','u'=>'f','v'=>'b','w'=>'c','x'=>'d','y'=>'e','z'=>'f'];
                            $avatarColor = $colorMap[$firstChar] ?? 'a';
                        ?>
                            <tr>
                                <!-- Admin -->
                                <td>
                                    <div class="al-user-cell">
                                        <div class="al-avatar" data-color="<?= $avatarColor; ?>"><?= $initials ?: '?'; ?></div>
                                        <div>
                                            <div class="al-user-name"><?= html_escape($admin->name ?? 'Unknown'); ?></div>
                                            <div class="al-user-email"><?= html_escape($admin->email ?? '—'); ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Store -->
                                <td><span class="al-store"><?= html_escape($admin->store_name ?? '—'); ?></span></td>

                                <!-- Contact -->
                                <td><span class="al-contact"><?= html_escape($admin->mobile ?? '—'); ?></span></td>

                                <!-- Plan -->
                                <td>
                                    <div class="al-plan-name">
                                        <span class="plan-type"><?= html_escape($planSummary['detail_plan_label'] ?? 'Plan'); ?>:</span>
                                        <?= html_escape($planSummary['detail_plan_name'] ?? 'No paid plan'); ?>
                                    </div>
                                    <div class="al-plan-dates">
                                        <?php if (!empty($planSummary['detail_start_date']) && $planSummary['detail_start_date'] !== '-'): ?>
                                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="2" width="10" height="9" rx="1.5"/><path d="M4 1v2M8 1v2M1 5h10"/></svg>
                                            <?= html_escape($planSummary['detail_start_date']); ?> – <?= html_escape($planSummary['detail_end_date'] ?? '—'); ?>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Purchase -->
                                <td>
                                    <span class="al-badge <?= $purchaseBadgeClass; ?>">
                                        <span class="al-badge-dot"></span>
                                        <?= html_escape($purchaseStatus); ?>
                                    </span>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="al-badge <?= $isActive ? 'al-b-active' : 'al-b-inactive'; ?>">
                                        <span class="al-badge-dot"></span>
                                        <?= $isActive ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>

                                <!-- Action -->
                                <td>
                                    <div class="al-action-group">
                                        <a href="<?= site_url('super-admin/admin-details/' . (int) $admin->id); ?>" class="al-action-link">
                                            <span class="al-action-btn al-action-btn--details">
                                                <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M1.5 8s2.5-4 6.5-4 6.5 4 6.5 4-2.5 4-6.5 4-6.5-4-6.5-4Z"/><circle cx="8" cy="8" r="1.8"/></svg>
                                                Details
                                            </span>
                                        </a>
                                        <form method="post" action="<?= site_url('super-admin/admin-status/' . (int) $admin->id); ?>">
                                            <input type="hidden" name="page"   value="<?= $currentPage; ?>">
                                            <input type="hidden" name="search" value="<?= html_escape($searchValue); ?>">
                                            <input type="hidden" name="status" value="<?= html_escape($statusValue); ?>">
                                            <button type="submit"
                                                    class="al-action-btn <?= $isActive ? 'al-action-btn--deactivate' : 'al-action-btn--activate'; ?>">
                                                <?php if ($isActive): ?>
                                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="6"/><path d="M6 6l4 4M10 6l-4 4" stroke-linecap="round"/></svg>
                                                    Deactivate
                                                <?php else: ?>
                                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="6"/><path d="M5 8l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    Activate
                                                <?php endif; ?>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="al-pgn">
            <span class="al-pgn-info">
                Page <strong><?= $currentPage; ?></strong> of <strong><?= $totalPages; ?></strong>
                &nbsp;·&nbsp;
                <strong><?= (int) ($pagination['total_items'] ?? count($admins)); ?></strong> total admins
            </span>
            <div class="al-pgn-links">
                <?php $prevPage = max(1, $currentPage - 1); ?>
                <?php $nextPage = min($totalPages, $currentPage + 1); ?>
                <a href="<?= $buildPageUrl($prevPage, $searchValue, $statusValue); ?>"
                   class="al-pgn-link al-pgn-link--arrow <?= $currentPage <= 1 ? 'al-pgn-link--disabled' : ''; ?>"
                   style="<?= $currentPage <= 1 ? 'opacity:.4;pointer-events:none;' : ''; ?>">
                    ←
                </a>
                <?php
                // Smart pagination: show first, last, current ±1, with ellipsis
                $pages = [];
                for ($p = 1; $p <= $totalPages; $p++) {
                    if ($p === 1 || $p === $totalPages || abs($p - $currentPage) <= 1) {
                        $pages[] = $p;
                    }
                }
                $pages = array_unique($pages);
                sort($pages);
                $prev = null;
                foreach ($pages as $p):
                    if ($prev !== null && $p - $prev > 1): ?>
                        <span class="al-pgn-link" style="border:none;background:none;cursor:default;color:var(--ink-4);">…</span>
                    <?php endif; ?>
                    <a href="<?= $buildPageUrl($p, $searchValue, $statusValue); ?>"
                       class="al-pgn-link <?= $p === $currentPage ? 'active' : ''; ?>">
                        <?= $p; ?>
                    </a>
                    <?php $prev = $p;
                endforeach; ?>
                <a href="<?= $buildPageUrl($nextPage, $searchValue, $statusValue); ?>"
                   class="al-pgn-link al-pgn-link--arrow <?= $currentPage >= $totalPages ? 'al-pgn-link--disabled' : ''; ?>"
                   style="<?= $currentPage >= $totalPages ? 'opacity:.4;pointer-events:none;' : ''; ?>">
                    →
                </a>
            </div>
        </div>

    </div><!-- /.al-card -->
</div><!-- /.al-wrap -->
