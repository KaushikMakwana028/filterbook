<?php
$planSummary = $plan_summary ?? null;
$subscription = $planSummary['subscription'] ?? null;
$currentPlanCode = $subscription->plan_code ?? '';
$isCurrentPlanExpired = !empty($planSummary['is_expired']);
$canPurchasePlan = !empty($planSummary['can_purchase_plan']);
$purchaseLockedMessage = (string) ($planSummary['purchase_locked_message'] ?? '');
$paymentLabel = !empty($planSummary['is_trial']) ? 'Trial Access' : 'Plan Payment';
$paymentValue = !empty($planSummary['is_trial'])
    ? 'Free'
    : 'Rs ' . number_format((float) ($planSummary['amount'] ?? 0), 0);
$razorpayEnabled = trim((string) ($razorpay_key_id ?? '')) !== '';
?>

<style>
    :root {
        --primary-600: #2563eb;
        --primary-500: #3b82f6;
        --primary-400: #60a5fa;
        --primary-300: #93c5fd;
        --success-600: #059669;
        --success-500: #10b981;
        --success-400: #34d399;
        --warning-600: #d97706;
        --warning-500: #f59e0b;
        --error-600: #dc2626;
        --error-500: #ef4444;
        --gray-900: #111827;
        --gray-800: #1f2937;
        --gray-700: #374151;
        --gray-600: #4b5563;
        --gray-500: #6b7280;
        --gray-400: #9ca3af;
        --gray-300: #d1d5db;
        --gray-200: #e5e7eb;
        --gray-100: #f3f4f6;
        --gray-50: #f9fafb;
    }

    .plan-page {
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 40px 24px 60px;
    }

    .plan-shell {
        max-width: 1280px;
        margin: 0 auto;
    }

    /* Flash Messages */
    .plan-flash {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDown 0.3s ease;
    }

    .plan-flash::before {
        content: '';
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .plan-flash.success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .plan-flash.success::before {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23059669'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/%3E%3C/svg%3E") center/contain no-repeat;
    }

    .plan-flash.error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .plan-flash.error::before {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23dc2626'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'/%3E%3C/svg%3E") center/contain no-repeat;
    }

    /* Hero Section */
    .plan-hero {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 24px;
        padding: 48px;
        color: #ffffff;
        overflow: hidden;
        box-shadow: 0 20px 60px -12px rgba(102, 126, 234, 0.25);
    }

    .plan-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .plan-hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
    }

    .plan-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 100px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
    }

    .plan-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.1;
        margin: 0 0 16px;
        letter-spacing: -0.02em;
    }

    .plan-hero p {
        font-size: 1.125rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        max-width: 700px;
    }

    /* Status Cards */
    .plan-status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin: -40px 0 40px;
        position: relative;
        z-index: 2;
    }

    .plan-status-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--gray-200);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .plan-status-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    .plan-status-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 8px;
        display: block;
    }

    .plan-status-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        display: block;
    }

    /* Alert Banner */
    .plan-alert {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px 28px;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-left: 4px solid var(--primary-500);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .plan-alert.is-trial {
        border-left-color: var(--primary-500);
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    }

    .plan-alert.is-expired {
        border-left-color: var(--error-500);
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    }

    .plan-alert.is-active {
        border-left-color: var(--success-500);
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    }

    .plan-alert-content {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
    }

    .plan-alert-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.6);
    }

    .plan-alert.is-trial .plan-alert-icon {
        color: var(--primary-600);
    }

    .plan-alert.is-expired .plan-alert-icon {
        color: var(--error-600);
    }

    .plan-alert.is-active .plan-alert-icon {
        color: var(--success-600);
    }

    .plan-alert-text h4 {
        margin: 0 0 4px;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
    }

    .plan-alert-text p {
        margin: 0;
        color: var(--gray-700);
        line-height: 1.5;
        font-size: 14px;
    }

    .plan-alert-meta {
        text-align: right;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 12px;
        min-width: 140px;
    }

    .plan-alert-meta-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-500);
        margin-bottom: 4px;
    }

    .plan-alert-meta-value {
        display: block;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--gray-900);
    }

    /* Section Header */
    .plan-section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .plan-section-header h2 {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--gray-900);
        margin: 0 0 12px;
        letter-spacing: -0.02em;
    }

    .plan-section-header p {
        font-size: 1.125rem;
        color: var(--gray-600);
        margin: 0;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Plan Cards Grid */
    .plan-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 32px;
        margin-bottom: 48px;
    }

    /* Plan Card */
    .plan-card {
        position: relative;
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 32px;
        border: 2px solid var(--gray-200);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .plan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: var(--primary-300);
    }

    .plan-card.featured {
        border-color: var(--primary-500);
        box-shadow: 0 12px 32px rgba(37, 99, 235, 0.15);
        transform: scale(1.05);
    }

    .plan-card.featured:hover {
        transform: scale(1.05) translateY(-8px);
    }

    .plan-card.current {
        border-color: var(--success-500);
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    }

    .plan-card-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .plan-card.monthly .plan-card-badge {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
    }

    .plan-card.half-yearly .plan-card-badge {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .plan-card.yearly .plan-card-badge {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .plan-card-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .plan-card-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #ffffff;
    }

    .plan-card.half-yearly .plan-card-icon {
        background: linear-gradient(135deg, var(--success-500) 0%, var(--success-600) 100%);
    }

    .plan-card.yearly .plan-card-icon {
        background: linear-gradient(135deg, var(--warning-500) 0%, var(--warning-600) 100%);
    }

    .plan-card-name {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--gray-900);
        margin: 0 0 8px;
    }

    .plan-card-duration {
        font-size: 14px;
        color: var(--gray-600);
        font-weight: 600;
    }

    .plan-card-pricing {
        text-align: center;
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 2px solid var(--gray-100);
    }

    .plan-card-price {
        font-size: 3rem;
        font-weight: 800;
        color: var(--gray-900);
        line-height: 1;
        margin-bottom: 8px;
    }

    .plan-card-price-note {
        font-size: 14px;
        color: var(--gray-500);
        font-weight: 500;
    }

    .plan-card-features {
        list-style: none;
        padding: 0;
        margin: 0 0 32px;
        flex: 1;
    }

    .plan-card-features li {
        padding: 12px 0;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 15px;
        color: var(--gray-700);
        line-height: 1.6;
    }

    .plan-card-features li::before {
        content: '✓';
        width: 24px;
        height: 24px;
        background: var(--primary-100);
        color: var(--primary-600);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
        font-size: 14px;
    }

    .plan-card-action {
        display: block;
        width: 100%;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .plan-card-action.primary {
        background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-500) 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
    }

    .plan-card-action.primary:hover {
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        transform: translateY(-2px);
    }

    .plan-card-action.success {
        background: linear-gradient(135deg, var(--success-600) 0%, var(--success-500) 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);
    }

    .plan-card-action.success:hover {
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.4);
        transform: translateY(-2px);
    }

    .plan-card-action.warning {
        background: linear-gradient(135deg, var(--warning-600) 0%, var(--warning-500) 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(217, 119, 6, 0.3);
    }

    .plan-card-action.warning:hover {
        box-shadow: 0 6px 20px rgba(217, 119, 6, 0.4);
        transform: translateY(-2px);
    }

    .plan-card-action.secondary {
        background: #ffffff;
        color: var(--gray-800);
        border: 1.5px solid var(--gray-300);
        box-shadow: none;
        margin-top: 12px;
    }

    .plan-card-action.secondary:hover {
        border-color: var(--primary-400);
        color: var(--primary-600);
    }

    .plan-card-action.disabled {
        background: var(--gray-100);
        color: var(--gray-500);
        cursor: not-allowed;
        border: 2px solid var(--success-500);
    }

    .plan-card-action.disabled:hover {
        transform: none;
        box-shadow: none;
    }

    .plan-card-note {
        margin-top: 16px;
        font-size: 13px;
        color: var(--gray-500);
        text-align: center;
        line-height: 1.5;
    }

    .qr-modal {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .qr-modal.is-open {
        display: flex;
    }

    .qr-modal-dialog {
        width: min(420px, 100%);
        background: #ffffff;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.22);
        text-align: center;
        position: relative;
    }

    .qr-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 50%;
        background: var(--gray-100);
        color: var(--gray-700);
        font-size: 22px;
        cursor: pointer;
    }

    .qr-modal-title {
        margin: 0 0 8px;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--gray-900);
    }

    .qr-modal-copy {
        margin: 0 0 20px;
        color: var(--gray-600);
        line-height: 1.6;
    }

    .qr-modal-image-wrap {
        width: 250px;
        height: 250px;
        margin: 0 auto 18px;
        border-radius: 20px;
        border: 1px solid var(--gray-200);
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .qr-modal-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .qr-modal-amount {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 6px;
    }

    .qr-modal-status {
        font-size: 14px;
        color: var(--gray-600);
    }

    /* Footer CTA */
    .plan-footer-cta {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        border: 2px solid var(--gray-200);
    }

    .plan-footer-cta h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 12px;
    }

    .plan-footer-cta p {
        font-size: 1rem;
        color: var(--gray-600);
        margin: 0 0 24px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .plan-footer-cta a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: var(--gray-900);
        color: #ffffff;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .plan-footer-cta a:hover {
        background: var(--gray-800);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .plan-page {
            padding: 16px 12px 32px;
        }

        .plan-hero {
            padding: 24px 16px;
            border-radius: 14px;
        }

        .plan-hero h1 {
            font-size: 1.5rem;
        }

        .plan-hero p {
            font-size: 0.9rem;
        }

        .plan-status-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: -20px 0 24px;
        }

        .plan-status-card {
            padding: 14px;
        }

        .plan-alert {
            flex-direction: row;
            align-items: center;
            padding: 14px 16px;
            gap: 10px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .plan-alert-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
            border-radius: 10px;
        }

        .plan-alert-text h4 {
            font-size: 13px;
        }

        .plan-alert-text p {
            font-size: 11px;
        }

        .plan-alert-meta {
            text-align: right;
            padding: 8px 12px;
            min-width: 80px;
            border-radius: 10px;
        }

        .plan-alert-meta-value {
            font-size: 18px;
        }

        .plan-section-header {
            margin-bottom: 20px;
        }

        .plan-section-header h2 {
            font-size: 1.25rem;
        }

        .plan-section-header p {
            font-size: 0.8rem;
        }

        .plan-cards-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .plan-card {
            padding: 20px 18px;
            border-radius: 16px;
        }

        .plan-card.featured {
            transform: none;
        }

        .plan-card.featured:hover {
            transform: translateY(-4px);
        }

        /* Fix badge overlap */
        .plan-card-badge {
            position: static;
            display: inline-block;
            margin-bottom: 12px;
            font-size: 11px;
            padding: 4px 10px;
        }

        .plan-card-header {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: left;
            gap: 12px;
            margin-bottom: 14px;
        }

        .plan-card-icon {
            width: 42px;
            height: 42px;
            font-size: 22px;
            border-radius: 10px;
            margin: 0;
            flex-shrink: 0;
        }

        .plan-card-name {
            font-size: 1.25rem;
            margin: 0 0 2px;
        }

        .plan-card-duration {
            font-size: 12px;
        }

        .plan-card-pricing {
            margin-bottom: 14px;
            padding-bottom: 14px;
        }

        .plan-card-price {
            font-size: 2rem;
        }

        .plan-card-price-note {
            font-size: 12px;
        }

        .plan-card-features {
            margin-bottom: 16px;
        }

        .plan-card-features li {
            padding: 6px 0;
            font-size: 13px;
            gap: 8px;
        }

        .plan-card-features li::before {
            width: 18px;
            height: 18px;
            font-size: 11px;
        }

        .plan-card-action {
            padding: 13px 20px;
            font-size: 15px;
            border-radius: 10px;
        }

        .plan-card-note {
            font-size: 11px;
            margin-top: 10px;
        }

        .plan-footer-cta {
            padding: 20px 16px;
            border-radius: 16px;
        }

        .plan-footer-cta h3 {
            font-size: 15px;
        }

        .plan-footer-cta p {
            font-size: 12px;
            margin-bottom: 14px;
        }

        .plan-footer-cta a {
            font-size: 13px;
            padding: 10px 20px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="plan-page">
            <div class="plan-shell">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="plan-flash success"><?= html_escape($this->session->flashdata('success')); ?></div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="plan-flash error"><?= html_escape($this->session->flashdata('error')); ?></div>
                <?php endif; ?>

                <!-- Hero Section -->
                <!-- <section class="plan-hero">
                    <div class="plan-hero-content">
                        <div class="plan-badge">
                            <i class='bx bx-crown'></i>
                            Subscription Plans
                        </div>
                        <h1>Choose the perfect plan for your business growth</h1>
                        <p>
                            Start with a 1-month free trial and experience all premium features. Upgrade anytime to
                            continue without interruption. All plans include full access to your admin dashboard.
                        </p>
                    </div>
                </section> -->

                <!-- Status Cards -->
                <!-- <div class="plan-status-grid">
                    <div class="plan-status-card">
                        <span class="plan-status-label">Status</span>
                        <strong
                            class="plan-status-value"><?= html_escape($planSummary['status_label'] ?? 'Not Available'); ?></strong>
                    </div>
                    <div class="plan-status-card">
                        <span class="plan-status-label">Current Plan</span>
                        <strong
                            class="plan-status-value"><?= html_escape($planSummary['plan_name'] ?? 'No Plan'); ?></strong>
                    </div>
                    <div class="plan-status-card">
                        <span class="plan-status-label"><?= html_escape($paymentLabel); ?></span>
                        <strong class="plan-status-value"><?= html_escape($paymentValue); ?></strong>
                    </div>
                    <div class="plan-status-card">
                        <span class="plan-status-label">Start Date</span>
                        <strong
                            class="plan-status-value"><?= html_escape($planSummary['start_date'] ?? '-'); ?></strong>
                    </div>
                    <div class="plan-status-card">
                        <span class="plan-status-label">End Date</span>
                        <strong class="plan-status-value"><?= html_escape($planSummary['end_date'] ?? '-'); ?></strong>
                    </div>
                </div> -->

                <!-- Alert Banner -->
                <?php
                $alertClass = !empty($planSummary['is_expired'])
                    ? 'is-expired'
                    : (!empty($planSummary['is_trial']) ? 'is-trial' : 'is-active');
                $alertTitle = !empty($planSummary['is_expired'])
                    ? 'Plan Expired'
                    : (!empty($planSummary['is_last_day'])
                        ? 'Last Day of Free Trial'
                        : (!empty($planSummary['is_trial']) ? 'Free Trial Active' : 'Plan Active'));
                $alertIcon = !empty($planSummary['is_expired'])
                    ? 'bx-error-circle'
                    : (!empty($planSummary['is_trial']) ? 'bx-time-five' : 'bx-badge-check');
                ?>
                <div class="plan-alert <?= $alertClass; ?>">
                    <div class="plan-alert-content">
                        <div class="plan-alert-icon">
                            <i class='bx <?= $alertIcon; ?>'></i>
                        </div>
                        <div class="plan-alert-text">
                            <h4><?= html_escape($alertTitle); ?></h4>
                            <p><?= html_escape($planSummary['message'] ?? ''); ?></p>
                        </div>
                    </div>
                    <div class="plan-alert-meta">
                        <span class="plan-alert-meta-label">
                            <?= !empty($planSummary['is_trial']) ? 'Days Remaining' : 'Plan Value'; ?>
                        </span>
                        <strong class="plan-alert-meta-value">
                            <?php if (!empty($planSummary['is_trial'])): ?>
                                <?= (int) ($planSummary['days_left'] ?? 0); ?>
                                day<?= (int) ($planSummary['days_left'] ?? 0) === 1 ? '' : 's'; ?>
                            <?php else: ?>
                                ₹<?= number_format((float) ($planSummary['amount'] ?? 0), 0); ?>
                            <?php endif; ?>
                        </strong>
                    </div>
                </div>

                <?php if ($purchaseLockedMessage !== ''): ?>
                    <div class="plan-flash error"><?= html_escape($purchaseLockedMessage); ?></div>
                <?php endif; ?>

                <!-- Section Header -->
                <div class="plan-section-header">
                    <h2>Choose Your Plan</h2>
                    <p>Select the subscription duration that best fits your business needs. All plans include premium
                        features.</p>
                </div>

                <!-- Plan Cards -->
                <div class="plan-cards-grid">
                    <?php
                    $cardIndex = 0;
                    foreach ($plans as $plan):
                        if (!empty($plan['is_trial']))
                            continue;
                        if (empty($plan['is_active']) && $currentPlanCode !== $plan['code'])
                            continue;
                        $cardIndex++;

                        $cardClass = $plan['accent'] === 'half-yearly' ? 'half-yearly' : ($plan['accent'] === 'yearly' ? 'yearly' : 'monthly');
                        $isCurrent = !$isCurrentPlanExpired && $currentPlanCode === $plan['code'];
                        $isFeatured = $cardClass === 'half-yearly';
                        $buttonClass = $cardClass === 'monthly' ? 'primary' : ($cardClass === 'half-yearly' ? 'success' : 'warning');
                        $badgeLabel = '';

                        if ($plan['code'] === 'half_yearly') {
                            $badgeLabel = 'Most Popular';
                        } elseif ($plan['code'] === 'yearly') {
                            $monthlyPrice = isset($plans['monthly']['price']) ? (float) $plans['monthly']['price'] : 0;
                            $yearlyPrice = (float) ($plan['price'] ?? 0);
                            $rawSaving = max(0, ($monthlyPrice * 12) - $yearlyPrice);
                            $displaySaving = $rawSaving > 0 ? round($rawSaving / 100) * 100 : 0;
                            $badgeLabel = $displaySaving > 0
                                ? 'Best Value (Save Rs ' . number_format($displaySaving, 0) . ')'
                                : 'Best Value';
                        }
                        $buttonLabel = $isCurrent ? '✓ Current Plan' : (($currentPlanCode === $plan['code'] && $isCurrentPlanExpired) ? 'Renew Plan' : 'Get Started');
                    ?>
                        <article
                            class="plan-card <?= $cardClass; ?> <?= $isCurrent ? 'current' : ''; ?> <?= $isFeatured ? 'featured' : ''; ?>">
                            <?php if ($badgeLabel !== ''): ?>
                                <span class="plan-card-badge"><?= html_escape($badgeLabel); ?></span>
                            <?php endif; ?>

                            <div class="plan-card-header">
                                <div class="plan-card-icon">
                                    <i class='bx bx-crown'></i>
                                </div>
                                <h3 class="plan-card-name"><?= html_escape(str_replace(' Plan', '', $plan['name'])); ?></h3>
                                <p class="plan-card-duration"><?= html_escape($plan['duration_label']); ?> Subscription</p>
                            </div>

                            <div class="plan-card-pricing">
                                <div class="plan-card-price"><?= html_escape($plan['price_label']); ?></div>
                                <p class="plan-card-price-note">per <?= html_escape($plan['duration_label']); ?></p>
                            </div>

                            <ul class="plan-card-features">
                                <?php foreach ($plan['features'] as $feature): ?>
                                    <li><?= html_escape($feature); ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <?php if ($isCurrent): ?>
                                <button class="plan-card-action disabled" disabled>✓ Current Active Plan</button>
                            <?php else: ?>
                                <button type="button" class="plan-card-action <?= $buttonClass; ?> js-razorpay-plan-btn"
                                    data-plan-code="<?= html_escape($plan['code']); ?>"
                                    data-plan-name="<?= html_escape($plan['name']); ?>" <?= !$razorpayEnabled ? 'disabled' : ''; ?>>
                                    <?= html_escape($razorpayEnabled ? $buttonLabel : 'Configure Razorpay First'); ?>
                                </button>

                            <?php endif; ?>

                            <p class="plan-card-note">
                                Activates immediately • Valid for <?= (int) $plan['duration_days']; ?> days
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Footer CTA -->
                <div class="plan-footer-cta">
                    <h3>🎉 Start with 1 Month Free Trial</h3>
                    <p>
                        <?php if (!empty($planSummary['trial_used'])): ?>
                            Your free trial has been used. Choose any plan above to continue enjoying premium features.
                        <?php else: ?>
                            Try all premium features risk-free for 30 days. No credit card required. Upgrade anytime before
                            trial ends.
                        <?php endif; ?>
                    </p>
                    <a href="<?= site_url('admin/dashboard'); ?>">
                        <i class='bx bx-arrow-back'></i>
                        Back to Dashboard
                    </a>
                </div>

                <?php if ($purchaseLockedMessage !== '' && !$canPurchasePlan): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var cards = document.querySelectorAll('.plan-cards-grid .plan-card');

                            cards.forEach(function(card) {
                                var currentButton = card.querySelector('button.plan-card-action.disabled');
                                if (currentButton) {
                                    return;
                                }

                                var actionLink = card.querySelector('a.plan-card-action');
                                if (!actionLink) {
                                    return;
                                }

                                var disabledButton = document.createElement('button');
                                disabledButton.type = 'button';
                                disabledButton.className = actionLink.className + ' disabled';
                                disabledButton.disabled = true;
                                disabledButton.textContent = 'Available After Expiry';
                                actionLink.replaceWith(disabledButton);

                                var note = card.querySelector('.plan-card-note');
                                if (note) {
                                    note.textContent = <?= json_encode($purchaseLockedMessage); ?>;
                                }
                            });
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<form id="razorpayVerifyForm" method="post" action="<?= site_url('admin/plan/verify_payment'); ?>"
    style="display:none;">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>



<?php if ($razorpayEnabled): ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.js-razorpay-plan-btn');
            var verifyForm = document.getElementById('razorpayVerifyForm');
            var paymentIdInput = document.getElementById('razorpay_payment_id');
            var orderIdInput = document.getElementById('razorpay_order_id');
            var signatureInput = document.getElementById('razorpay_signature');
            var createOrderUrl = <?= json_encode(base_url('index.php/admin/plan/create_order')); ?>;
            var createQrUrl = <?= json_encode(base_url('index.php/admin/plan/create_qr')); ?>;
            var checkQrStatusUrl = <?= json_encode(base_url('index.php/admin/plan/check_qr_status')); ?>;
            var paymentFailedUrl = <?= json_encode(base_url('index.php/admin/plan/payment_failed')); ?>;
            var razorpayKey = <?= json_encode((string) ($razorpay_key_id ?? '')); ?>;
            var companyName = <?= json_encode((string) ($razorpay_company_name ?? 'Filter Book')); ?>;
            var logoUrl = <?= json_encode((string) ($razorpay_logo_url ?? '')); ?>;
            var themeColor = <?= json_encode((string) ($razorpay_theme_color ?? '#2563eb')); ?>;
            var qrModal = document.getElementById('qrPaymentModal');
            var qrModalImage = document.getElementById('qrModalImage');
            var qrModalStatus = document.getElementById('qrModalStatus');
            var qrModalTitle = document.getElementById('qrModalTitle');
            var qrModalAmount = document.getElementById('qrModalAmount');
            var qrModalCloseBtn = document.getElementById('qrModalCloseBtn');
            var qrPollTimer = null;

            function clearQrPolling() {
                if (qrPollTimer) {
                    window.clearInterval(qrPollTimer);
                    qrPollTimer = null;
                }
            }

            function closeQrModal() {
                clearQrPolling();
                qrModal.classList.remove('is-open');
                qrModal.setAttribute('aria-hidden', 'true');
                qrModalImage.setAttribute('src', '');
            }

            function openQrModal(qrData, planName) {
                qrModalTitle.textContent = planName ? planName + ' QR Payment' : 'Scan QR Code';
                qrModalAmount.textContent = qrData.amount_label || 'Rs 1';
                qrModalStatus.textContent = 'Waiting for payment confirmation...';
                qrModalImage.setAttribute('src', qrData.image_url || '');
                qrModal.classList.add('is-open');
                qrModal.setAttribute('aria-hidden', 'false');
            }

            function pollQrStatus(qrId) {
                clearQrPolling();

                qrPollTimer = window.setInterval(function() {
                    var formData = new FormData();
                    formData.append('qr_id', qrId);

                    fetch(checkQrStatusUrl, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    }).then(function(response) {
                        return parseJsonResponse(response);
                    }).then(function(result) {
                        if (!result || !result.status) {
                            return;
                        }

                        if (result.paid) {
                            qrModalStatus.textContent = 'Payment received. Activating your plan...';
                            clearQrPolling();
                            window.setTimeout(function() {
                                window.location.href = result.redirect_url || <?= json_encode(site_url('admin/plan')); ?>;
                            }, 1200);
                            return;
                        }

                        if (result.qr_status === 'closed') {
                            qrModalStatus.textContent = 'QR closed. Please generate a new QR code.';
                            clearQrPolling();
                            return;
                        }
                    }).catch(function() {
                        qrModalStatus.textContent = 'Checking payment status...';
                    });
                }, 5000);
            }

            function setButtonState(button, loading) {
                if (!button) {
                    return;
                }

                if (!button.dataset.defaultLabel) {
                    button.dataset.defaultLabel = button.textContent;
                }

                button.disabled = loading;
                button.textContent = loading ? 'Please wait...' : button.dataset.defaultLabel;
            }

            function postFailure(orderId, reason) {
                var formData = new FormData();
                formData.append('razorpay_order_id', orderId || '');
                formData.append('reason', reason || 'Payment cancelled');

                fetch(paymentFailedUrl, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                });
            }

            function parseJsonResponse(response) {
                return response.text().then(function(text) {
                    try {
                        return text ? JSON.parse(text) : {};
                    } catch (e) {
                        throw new Error(text || ('Request failed with status ' + response.status));
                    }
                });
            }

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var planCode = button.getAttribute('data-plan-code') || '';

                    if (!planCode) {
                        alert('Plan code is missing.');
                        return;
                    }

                    setButtonState(button, true);

                    var formData = new FormData();
                    formData.append('plan_code', planCode);

                    fetch(createOrderUrl, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    }).then(function(response) {
                        return parseJsonResponse(response);
                    }).then(function(result) {
                        if (!result || !result.status || !result.order) {
                            throw new Error(result && result.message ? result.message : 'Unable to create payment order.');
                        }

                        var order = result.order;
                        var prefill = result.prefill || {};
                        var options = {
                            key: razorpayKey,
                            amount: order.amount,
                            currency: order.currency || 'INR',

                            // ✅ BRANDING
                            name: companyName,
                            description: (result.plan && result.plan.name ? result.plan.name : 'Subscription Plan'),
                            image: logoUrl,

                            order_id: order.id,

                            prefill: {
                                name: prefill.name || '',
                                email: prefill.email || '',
                                contact: prefill.contact || ''
                            },

                            // 🔥 ADD THIS (IMPORTANT)
                            notes: {
                                plan_name: result.plan.name || '',
                                user: prefill.name || ''
                            },

                            theme: {
                                color: themeColor
                            },
                            handler: function(response) {
                                paymentIdInput.value = response.razorpay_payment_id || '';
                                orderIdInput.value = response.razorpay_order_id || '';
                                signatureInput.value = response.razorpay_signature || '';
                                verifyForm.submit();
                            },
                            modal: {
                                ondismiss: function() {
                                    postFailure(order.id, 'Payment popup closed');
                                    setButtonState(button, false);
                                }
                            }
                        };

                        var razorpay = new Razorpay(options);
                        razorpay.on('payment.failed', function(response) {
                            var error = response && response.error ? response.error.description : 'Payment failed';
                            postFailure(order.id, error);
                            alert(error);
                            setButtonState(button, false);
                        });
                        razorpay.open();
                    }).catch(function(error) {
                        alert(error && error.message ? error.message : 'Unable to start payment.');
                        setButtonState(button, false);
                    });
                });
            });

            qrButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var planCode = button.getAttribute('data-plan-code') || '';
                    var planName = button.getAttribute('data-plan-name') || '';

                    if (!planCode) {
                        alert('Plan code is missing.');
                        return;
                    }

                    setButtonState(button, true);

                    var formData = new FormData();
                    formData.append('plan_code', planCode);

                    fetch(createQrUrl, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    }).then(function(response) {
                        return parseJsonResponse(response);
                    }).then(function(result) {
                        if (!result || !result.status || !result.qr || !result.qr.image_url) {
                            throw new Error(result && result.message ? result.message : 'Unable to create QR code.');
                        }

                        openQrModal(result.qr, planName || (result.plan && result.plan.name ? result.plan.name : 'Plan'));
                        pollQrStatus(result.qr.id || '');
                        setButtonState(button, false);
                    }).catch(function(error) {
                        alert(error && error.message ? error.message : 'Unable to create QR code.');
                        setButtonState(button, false);
                    });
                });
            });

            qrModalCloseBtn.addEventListener('click', closeQrModal);
            qrModal.addEventListener('click', function(event) {
                if (event.target === qrModal) {
                    closeQrModal();
                }
            });
        });
    </script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('plan_expired')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: '⚠️ Plan Expired!',
                html: `
            <p style="color:#555; margin-bottom:12px;">
                <?= addslashes($this->session->flashdata('plan_expired_message')) ?>
            </p>
            <p style="color:#888; font-size:13px;">
                Purchase a new plan below to restore full access.
            </p>
        `,
                confirmButtonText: '🛒 Choose a Plan',
                confirmButtonColor: '#6366f1',
                allowOutsideClick: false,
            });
        });
    </script>
<?php endif; ?>