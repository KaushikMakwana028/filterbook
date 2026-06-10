<?php
$plans = $plans ?? [];
?>

<link
    href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap"
    rel="stylesheet">

<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --ink: #0b1120;
        --ink-2: #3d4966;
        --ink-3: #7c8aaa;
        --ink-4: #b0bcd4;
        --surface: #ffffff;
        --surface-2: #f4f6fb;
        --surface-3: #eaecf5;
        --border: #e2e6f0;
        --accent: #2c5fde;
        --accent-h: #1e47c0;
        --accent-glow: rgba(44, 95, 222, .14);
        --radius-sm: 8px;
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-sm: 0 1px 3px rgba(11, 17, 32, .06), 0 1px 2px rgba(11, 17, 32, .04);
        --shadow: 0 4px 16px rgba(11, 17, 32, .08), 0 1px 4px rgba(11, 17, 32, .05);
        --shadow-lg: 0 12px 40px rgba(11, 17, 32, .12), 0 4px 12px rgba(11, 17, 32, .06);
        --font-head: 'Syne', sans-serif;
        --font-body: 'DM Sans', sans-serif;

        /* Plan accent palettes */
        --monthly-a: #2c5fde;
        --monthly-b: #60a5fa;
        --monthly-bg: #eff4ff;
        --monthly-bd: #c7d9ff;
        --monthly-txt: #1e3a8a;
        --half-a: #059669;
        --half-b: #34d399;
        --half-bg: #ecfdf5;
        --half-bd: #a7f3d0;
        --half-txt: #065f46;
        --yearly-a: #d97706;
        --yearly-b: #fbbf24;
        --yearly-bg: #fffbeb;
        --yearly-bd: #fde68a;
        --yearly-txt: #92400e;
        --trial-a: #7c3aed;
        --trial-b: #a78bfa;
        --trial-bg: #f5f3ff;
        --trial-bd: #ddd6fe;
        --trial-txt: #4c1d95;
    }

    body,
    .sp-wrap {
        font-family: var(--font-body);
        color: var(--ink);
    }

    .sp-wrap {
        max-width: 1300px;
        margin: 0 auto;
        padding: 32px 0 80px;
    }

    /* ── Page header ── */
    .sp-page-header {
        margin-bottom: 28px;
    }

    .sp-page-title {
        font-family: var(--font-head);
        font-size: 26px;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: -.4px;
        line-height: 1.15;
        margin-bottom: 6px;
    }

    .sp-page-title span {
        color: var(--accent);
    }

    .sp-page-sub {
        font-size: 13.5px;
        color: var(--ink-3);
        max-width: 620px;
        line-height: 1.65;
    }

    /* ── Alerts ── */
    .sp-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: var(--radius-lg);
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 13.5px;
        font-weight: 500;
        border: 1px solid transparent;
    }

    .sp-alert svg {
        flex-shrink: 0;
    }

    .sp-alert.success {
        background: #ecfdf5;
        color: #166534;
        border-color: #bbf7d0;
    }

    .sp-alert.error {
        background: #fef2f2;
        color: #991b1b;
        border-color: #fecaca;
    }

    /* ── Grid ── */
    .sp-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    /* ── Plan Card ── */
    .sp-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s, transform .2s;
    }

    .sp-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    /* Top accent strip */
    .sp-card-stripe {
        height: 5px;
    }

    .sp-card[data-accent="monthly"] .sp-card-stripe {
        background: linear-gradient(90deg, var(--monthly-a), var(--monthly-b));
    }

    .sp-card[data-accent="half-yearly"] .sp-card-stripe {
        background: linear-gradient(90deg, var(--half-a), var(--half-b));
    }

    .sp-card[data-accent="yearly"] .sp-card-stripe {
        background: linear-gradient(90deg, var(--yearly-a), var(--yearly-b));
    }

    .sp-card[data-accent="trial"] .sp-card-stripe {
        background: linear-gradient(90deg, var(--trial-a), var(--trial-b));
    }

    /* Card header section */
    .sp-card-header {
        padding: 20px 22px 16px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .sp-code-badge {
        font-family: var(--font-head);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        border: 1px solid var(--border);
        background: var(--surface-2);
        color: var(--ink-2);
    }

    .sp-type-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
        border: 1px solid transparent;
        font-family: var(--font-body);
    }

    .sp-type-pill.trial {
        background: var(--trial-bg);
        color: var(--trial-txt);
        border-color: var(--trial-bd);
    }

    .sp-type-pill.paid {
        background: var(--monthly-bg);
        color: var(--monthly-txt);
        border-color: var(--monthly-bd);
    }

    .sp-card-body {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* ── Fields ── */
    .sp-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sp-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--ink-3);
    }

    .sp-input,
    .sp-select,
    .sp-textarea {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        padding: 11px 14px;
        font-size: 13.5px;
        font-family: var(--font-body);
        color: var(--ink);
        background: var(--surface);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        box-shadow: var(--shadow-sm);
    }

    .sp-input::placeholder,
    .sp-textarea::placeholder {
        color: var(--ink-4);
    }

    .sp-input:focus,
    .sp-select:focus,
    .sp-textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-glow), var(--shadow-sm);
    }

    .sp-input[readonly] {
        background: var(--surface-2);
        color: var(--ink-3);
        cursor: not-allowed;
    }

    .sp-select {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 6l4 4 4-4' stroke='%237c8aaa' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 36px;
        cursor: pointer;
    }

    .sp-textarea {
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }

    .sp-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    /* ── Toggle ── */
    .sp-toggle-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        background: var(--surface-2);
        cursor: pointer;
        transition: border-color .15s, background .15s;
        user-select: none;
    }

    .sp-toggle-wrap:hover {
        border-color: var(--accent);
        background: #f0f4ff;
    }

    .sp-toggle-wrap input[type="checkbox"] {
        display: none;
    }

    .sp-toggle-knob {
        width: 38px;
        height: 22px;
        border-radius: 999px;
        background: var(--border);
        flex-shrink: 0;
        position: relative;
        transition: background .15s;
    }

    .sp-toggle-knob::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
        transition: transform .18s;
    }

    .sp-toggle-wrap.checked .sp-toggle-knob {
        background: var(--accent);
    }

    .sp-toggle-wrap.checked .sp-toggle-knob::after {
        transform: translateX(16px);
    }

    .sp-toggle-text {
        font-size: 13px;
        font-weight: 500;
        color: var(--ink-2);
    }

    /* Trial note */
    .sp-trial-note {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 10px 14px;
        background: var(--trial-bg);
        border: 1px solid var(--trial-bd);
        border-radius: var(--radius);
        font-size: 12px;
        color: var(--trial-txt);
        line-height: 1.55;
    }

    .sp-trial-note svg {
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── Sticky action bar ── */
    .sp-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        padding: 16px 24px;
        position: sticky;
        bottom: 20px;
        box-shadow: var(--shadow-lg);
    }

    .sp-actions-left {
        font-size: 13px;
        color: var(--ink-3);
    }

    .sp-actions-left strong {
        color: var(--ink-2);
        font-weight: 600;
    }

    .sp-actions-right {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .sp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 44px;
        padding: 0 22px;
        border-radius: var(--radius);
        border: 1.5px solid transparent;
        font-size: 13.5px;
        font-weight: 600;
        font-family: var(--font-body);
        cursor: pointer;
        text-decoration: none;
        transition: background .14s, border-color .14s, box-shadow .14s, transform .1s;
        white-space: nowrap;
    }

    .sp-btn:active {
        transform: translateY(1px);
    }

    .sp-btn-secondary {
        background: var(--surface);
        color: var(--ink-2);
        border-color: var(--border);
        box-shadow: var(--shadow-sm);
    }

    .sp-btn-secondary:hover {
        background: var(--surface-3);
    }

    .sp-btn-primary {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
        box-shadow: 0 4px 16px rgba(44, 95, 222, .28);
    }

    .sp-btn-primary:hover {
        background: var(--accent-h);
        border-color: var(--accent-h);
        box-shadow: 0 6px 24px rgba(44, 95, 222, .38);
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .sp-row {
            grid-template-columns: 1fr;
        }

        .sp-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .sp-actions-right {
            flex-direction: column;
        }

        .sp-btn {
            width: 100%;
        }
    }

    @media (max-width: 560px) {
        .sp-page-title {
            font-size: 20px;
        }

        .sp-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="sp-wrap">

    <!-- Page header -->
    <!-- <div class="sp-page-header">
        <div class="sp-page-title">Plan <span>Management</span></div>
        <div class="sp-page-sub">Control all subscription plans from here. Updates to price, duration, label, or
            features are reflected on the admin plan page automatically.</div>
    </div> -->

    <!-- Flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="sp-alert success">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8" cy="8" r="6.5" />
                <path d="M5 8l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <?= html_escape($this->session->flashdata('success')); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="sp-alert error">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="8" cy="8" r="6.5" />
                <path d="M6 6l4 4M10 6l-4 4" stroke-linecap="round" />
            </svg>
            <?= html_escape($this->session->flashdata('error')); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('super-admin/plan/update'); ?>">
        <div class="sp-grid">
            <?php foreach ($plans as $index => $plan):
                $featuresText = implode("\n", $plan['features'] ?? []);
                $accent = $plan['accent'] ?? 'monthly';
                $isTrial = !empty($plan['is_trial']);
                $isActive = !empty($plan['is_active']);
                ?>
                <section class="sp-card" data-accent="<?= html_escape($accent); ?>">
                    <div class="sp-card-stripe"></div>

                    <div class="sp-card-header">
                        <span class="sp-code-badge"><?= html_escape($plan['code']); ?></span>
                        <span class="sp-type-pill <?= $isTrial ? 'trial' : 'paid'; ?>">
                            <?= $isTrial ? 'Trial Plan' : 'Paid Plan'; ?>
                        </span>
                    </div>

                    <div class="sp-card-body">
                        <input type="hidden" name="plans[<?= $index; ?>][code]" value="<?= html_escape($plan['code']); ?>">

                        <!-- Plan Name -->
                        <div class="sp-field">
                            <label class="sp-label">Plan Name</label>
                            <input class="sp-input" type="text" name="plans[<?= $index; ?>][name]"
                                value="<?= html_escape($plan['name']); ?>" required>
                        </div>

                        <!-- Duration + Price -->
                        <div class="sp-row">
                            <div class="sp-field">
                                <label class="sp-label">Duration (Days)</label>
                                <input class="sp-input" type="number" min="1" name="plans[<?= $index; ?>][duration_days]"
                                    value="<?= (int) $plan['duration_days']; ?>" required>
                            </div>
                            <div class="sp-field">
                                <label class="sp-label">Price (₹)</label>
                                <input class="sp-input" type="number" min="0" step="0.01"
                                    name="plans[<?= $index; ?>][price]" value="<?= (float) $plan['price']; ?>" <?= $isTrial ? 'readonly' : ''; ?>>
                            </div>
                        </div>

                        <!-- Tag + Accent -->
                        <div class="sp-row">
                            <div class="sp-field">
                                <label class="sp-label">Tag Label</label>
                                <input class="sp-input" type="text" name="plans[<?= $index; ?>][tag]"
                                    value="<?= html_escape($plan['tag'] ?? ''); ?>" placeholder="e.g. Popular">
                            </div>
                            <div class="sp-field">
                                <label class="sp-label">Accent Style</label>
                                <select class="sp-select" name="plans[<?= $index; ?>][accent]">
                                    <option value="trial" <?= $accent === 'trial' ? 'selected' : ''; ?>>Trial</option>
                                    <option value="monthly" <?= $accent === 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                                    <option value="half-yearly" <?= $accent === 'half-yearly' ? 'selected' : ''; ?>>Half Yearly
                                    </option>
                                    <option value="yearly" <?= $accent === 'yearly' ? 'selected' : ''; ?>>Yearly</option>
                                </select>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="sp-field">
                            <label class="sp-label">Features <span
                                    style="font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;color:var(--ink-4)">(one
                                    per line)</span></label>
                            <textarea class="sp-textarea" name="plans[<?= $index; ?>][features]"
                                placeholder="Unlimited invoices&#10;SMS alerts&#10;Multi-user access"><?= html_escape($featuresText); ?></textarea>
                        </div>

                        <!-- Visibility toggle / Trial note -->
                        <?php if (!$isTrial): ?>
                            <input type="hidden" name="plans[<?= $index; ?>][is_active]" value="0">
                            <label class="sp-toggle-wrap <?= $isActive ? 'checked' : ''; ?>" id="toggle-wrap-<?= $index; ?>">
                                <input type="checkbox" name="plans[<?= $index; ?>][is_active]" value="1" <?= $isActive ? 'checked' : ''; ?> onchange="syncToggle(this, 'toggle-wrap-<?= $index; ?>')">
                                <span class="sp-toggle-knob"></span>
                                <span class="sp-toggle-text">Visible &amp; purchasable for admins</span>
                            </label>
                        <?php else: ?>
                            <div class="sp-trial-note">
                                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor"
                                    stroke-width="1.6">
                                    <circle cx="8" cy="8" r="6.5" />
                                    <path d="M8 5v3.5M8 11v.5" />
                                </svg>
                                Trial plan stays active — it controls first-time access for new admins.
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>

        <!-- Sticky actions -->
        <!-- <div class="sp-actions">
            <div class="sp-actions-left">
                <strong><?= count($plans); ?></strong> plan<?= count($plans) !== 1 ? 's' : ''; ?> configured
            </div>
            <div class="sp-actions-right">
                <a class="sp-btn sp-btn-secondary" href="<?= site_url('super-admin/admin-list'); ?>">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor"
                        stroke-width="1.7">
                        <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Admin List
                </a>
                <button class="sp-btn sp-btn-primary" type="submit">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor"
                        stroke-width="1.7">
                        <path d="M13 2.5L6 10 3 7" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13 9v4a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1h4" stroke-linecap="round" />
                    </svg>
                    Save Plan Settings
                </button>
            </div>
        </div> -->
    </form>
</div>

<script>
    function syncToggle(checkbox, wrapId) {
        const wrap = document.getElementById(wrapId);
        if (wrap) wrap.classList.toggle('checked', checkbox.checked);
    }
    // Init on load
    document.querySelectorAll('.sp-toggle-wrap input[type="checkbox"]').forEach(cb => {
        cb.addEventListener('change', function () {
            this.closest('.sp-toggle-wrap').classList.toggle('checked', this.checked);
        });
    });
</script>