<?php
$stats = $stats ?? [];
?>

<style>
    .sa-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin: 24px 0;
    }

    .sa-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sa-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.1), 0 8px 16px -4px rgba(0, 0, 0, 0.06);
        border-color: var(--card-color);
    }

    .sa-card:hover::before {
        opacity: 1;
    }

    .sa-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .sa-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--card-color);
        color: #ffffff;
        font-size: 20px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .sa-card-label {
        color: #475569;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.3px;
        line-height: 1.4;
    }

    .sa-card-value {
        font-size: 36px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .sa-card-note {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sa-card-note::before {
        content: '•';
        color: var(--card-color);
        font-weight: bold;
    }

    /* Individual card colors */
    .sa-card:nth-child(1) {
        --card-color: #3b82f6;
        --card-color-light: #60a5fa;
    }

    .sa-card:nth-child(2) {
        --card-color: #10b981;
        --card-color-light: #34d399;
    }

    .sa-card:nth-child(3) {
        --card-color: #8b5cf6;
        --card-color-light: #a78bfa;
    }

    .sa-card:nth-child(4) {
        --card-color: #f59e0b;
        --card-color-light: #fbbf24;
    }

    .sa-card:nth-child(5) {
        --card-color: #ec4899;
        --card-color-light: #f472b6;
    }

    .sa-card:nth-child(6) {
        --card-color: #06b6d4;
        --card-color-light: #22d3ee;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .sa-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .sa-card-value {
            font-size: 32px;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .sa-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="sa-grid">
    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="sa-card-label">Total Admins</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['total_admins'] ?? 0)); ?></div>
        <div class="sa-card-note">Stores registered in system</div>
    </div>

    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <polyline points="9 11 12 14 22 4"></polyline>
                </svg>
            </div>
            <div class="sa-card-label">Active Admins</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['active_admins'] ?? 0)); ?></div>
        <div class="sa-card-note">Admins with active access</div>
    </div>

    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>
            <div class="sa-card-label">Total Orders</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['total_orders'] ?? 0)); ?></div>
        <div class="sa-card-note">Orders across all stores</div>
    </div>

    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                    </path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="sa-card-label">Total Complaints</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['total_complaints'] ?? 0)); ?></div>
        <div class="sa-card-note">Complaints in all stores</div>
    </div>

    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
            </div>
            <div class="sa-card-label">Active Plans</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['active_plans'] ?? 0)); ?></div>
        <div class="sa-card-note">Paid active subscriptions</div>
    </div>

    <div class="sa-card">
        <div class="sa-card-header">
            <div class="sa-card-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="sa-card-label">Trial Plans</div>
        </div>
        <div class="sa-card-value"><?= number_format((int) ($stats['trial_plans'] ?? 0)); ?></div>
        <div class="sa-card-note">Stores on free trial</div>
    </div>
</div>