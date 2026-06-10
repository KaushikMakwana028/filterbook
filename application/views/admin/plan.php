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
    /* ═══════════════════════════════════════════════
       PLAN PAGE — Full Redesign
       Dark-first, glassmorphism, indigo/emerald/amber
    ═══════════════════════════════════════════════ */

    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    :root {
        /* Core palette */
        --p-bg: #060b18;
        --p-bg2: #0d1426;
        --p-bg3: #111c35;
        --p-border: rgba(255, 255, 255, 0.07);
        --p-border-2: rgba(255, 255, 255, 0.12);

        /* Accents */
        --indigo: #6366f1;
        --indigo-lite: #818cf8;
        --indigo-glow: rgba(99, 102, 241, 0.22);
        --emerald: #10b981;
        --emerald-lite: #34d399;
        --emerald-glow: rgba(16, 185, 129, 0.22);
        --amber: #f59e0b;
        --amber-lite: #fbbf24;
        --amber-glow: rgba(245, 158, 11, 0.22);
        --rose: #f43f5e;
        --rose-glow: rgba(244, 63, 94, 0.22);

        /* Text */
        --t1: #f1f5f9;
        --t2: #94a3b8;
        --t3: #64748b;

        /* Radius */
        --r-sm: 10px;
        --r-md: 16px;
        --r-lg: 24px;
        --r-xl: 32px;
    }

    /* Light theme overrides */
    [data-theme="light"] .plan-page-wrap {
        --p-bg: #f0f4ff;
        --p-bg2: #ffffff;
        --p-bg3: #f8fafc;
        --p-border: rgba(0, 0, 0, 0.07);
        --p-border-2: rgba(0, 0, 0, 0.12);
        --t1: #0f172a;
        --t2: #475569;
        --t3: #94a3b8;
    }

    .plan-page-wrap {
        font-family: 'Inter', sans-serif;
        background: var(--p-bg);
        min-height: 100vh;
        padding: 32px 20px 72px;
        position: relative;
        overflow-x: hidden;
    }

    .plan-shell {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* ── Ambient Orbs ── */
    .plan-orbs {
        pointer-events: none;
        position: fixed;
        inset: 0;
        z-index: 0;
        overflow: hidden;
    }

    .plan-orbs span {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        opacity: 0.18;
        animation: orbFloat 12s ease-in-out infinite alternate;
    }

    .plan-orbs span:nth-child(1) {
        width: 600px;
        height: 600px;
        background: var(--indigo);
        top: -200px;
        right: -100px;
        animation-duration: 14s;
    }

    .plan-orbs span:nth-child(2) {
        width: 500px;
        height: 500px;
        background: var(--emerald);
        bottom: -150px;
        left: -80px;
        animation-duration: 18s;
        animation-delay: -5s;
    }

    .plan-orbs span:nth-child(3) {
        width: 400px;
        height: 400px;
        background: var(--amber);
        top: 40%;
        left: 45%;
        animation-duration: 22s;
        animation-delay: -9s;
        opacity: 0.10;
    }

    @keyframes orbFloat {
        from {
            transform: translate(0, 0) scale(1);
        }

        to {
            transform: translate(40px, 30px) scale(1.1);
        }
    }

    /* ── Content Z ── */
    .plan-content-layer {
        position: relative;
        z-index: 1;
    }

    /* ── Flash ── */
    .plan-flash {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        border-radius: var(--r-md);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
        animation: fadeSlide .35s ease;
    }

    .plan-flash.success {
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: var(--emerald-lite);
    }

    .plan-flash.error {
        background: rgba(244, 63, 94, 0.10);
        border: 1px solid rgba(244, 63, 94, 0.22);
        color: #fb7185;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── Hero ── */
    .plan-hero {
        position: relative;
        border-radius: var(--r-xl);
        padding: 56px 52px 72px;
        overflow: hidden;
        background: linear-gradient(135deg, #0f1a3a 0%, #1a0f3a 50%, #0f2a1a 100%);
        border: 1px solid var(--p-border-2);
        margin-bottom: 0;
    }

    .plan-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 50% at 80% 20%, rgba(99, 102, 241, 0.18) 0%, transparent 60%),
            radial-gradient(ellipse 40% 40% at 20% 80%, rgba(16, 185, 129, 0.14) 0%, transparent 60%);
    }

    .plan-hero-inner {
        position: relative;
        z-index: 1;
        max-width: 680px;
    }

    .plan-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(99, 102, 241, 0.18);
        border: 1px solid rgba(99, 102, 241, 0.35);
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--indigo-lite);
        margin-bottom: 22px;
    }

    .plan-hero h1 {
        font-size: clamp(2rem, 4vw, 3.25rem);
        font-weight: 900;
        line-height: 1.08;
        letter-spacing: -0.03em;
        color: var(--t1);
        margin: 0 0 18px;
    }

    .plan-hero h1 em {
        font-style: normal;
        background: linear-gradient(135deg, var(--indigo-lite), var(--emerald-lite));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .plan-hero p {
        font-size: 1.05rem;
        color: var(--t2);
        line-height: 1.75;
        margin: 0;
    }

    /* ── Status Strip (floats over hero bottom) ── */
    .plan-status-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin: -36px 0 44px;
        position: relative;
        z-index: 2;
    }

    .plan-stat {
        background: var(--p-bg2);
        border: 1px solid var(--p-border-2);
        border-radius: var(--r-md);
        padding: 20px 22px;
        backdrop-filter: blur(12px);
        transition: border-color .2s, transform .2s;
    }

    .plan-stat:hover {
        border-color: rgba(99, 102, 241, 0.35);
        transform: translateY(-3px);
    }

    .plan-stat-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--t3);
        margin-bottom: 6px;
        display: block;
    }

    .plan-stat-value {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--t1);
        display: block;
    }

    .plan-stat.accent-indigo {
        border-top: 3px solid var(--indigo);
    }

    .plan-stat.accent-emerald {
        border-top: 3px solid var(--emerald);
    }

    .plan-stat.accent-amber {
        border-top: 3px solid var(--amber);
    }

    .plan-stat.accent-rose {
        border-top: 3px solid var(--rose);
    }

    /* ── Alert Banner ── */
    .plan-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 22px 28px;
        border-radius: var(--r-lg);
        margin-bottom: 52px;
        border: 1px solid var(--p-border-2);
        position: relative;
        overflow: hidden;
    }

    .plan-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: .08;
    }

    .plan-banner.is-trial {
        background: var(--p-bg2);
        border-left: 4px solid var(--indigo);
    }

    .plan-banner.is-trial::before {
        background: var(--indigo);
    }

    .plan-banner.is-active {
        background: var(--p-bg2);
        border-left: 4px solid var(--emerald);
    }

    .plan-banner.is-active::before {
        background: var(--emerald);
    }

    .plan-banner.is-expired {
        background: var(--p-bg2);
        border-left: 4px solid var(--rose);
    }

    .plan-banner.is-expired::before {
        background: var(--rose);
    }

    .plan-banner-left {
        display: flex;
        align-items: center;
        gap: 18px;
        flex: 1;
        position: relative;
    }

    .plan-banner-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--r-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .is-trial .plan-banner-icon {
        background: var(--indigo-glow);
        color: var(--indigo-lite);
    }

    .is-active .plan-banner-icon {
        background: var(--emerald-glow);
        color: var(--emerald-lite);
    }

    .is-expired .plan-banner-icon {
        background: var(--rose-glow);
        color: #fb7185;
    }

    .plan-banner-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--t1);
        margin: 0 0 4px;
    }

    .plan-banner-msg {
        font-size: 13px;
        color: var(--t2);
        margin: 0;
        line-height: 1.5;
    }

    .plan-banner-right {
        text-align: right;
        padding: 14px 20px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid var(--p-border);
        border-radius: var(--r-sm);
        min-width: 130px;
        flex-shrink: 0;
        position: relative;
    }

    .plan-banner-right-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        color: var(--t3);
        margin-bottom: 4px;
    }

    .plan-banner-right-value {
        display: block;
        font-size: 1.5rem;
        font-weight: 900;
        color: var(--t1);
    }

    /* ── Section Heading ── */
    .plan-section-head {
        text-align: center;
        margin-bottom: 48px;
    }

    .plan-section-head h2 {
        font-size: clamp(1.6rem, 3vw, 2.25rem);
        font-weight: 900;
        letter-spacing: -0.03em;
        color: var(--t1);
        margin: 0 0 12px;
    }

    .plan-section-head p {
        font-size: 1rem;
        color: var(--t2);
        margin: 0;
        max-width: 520px;
        margin-inline: auto;
        line-height: 1.7;
    }

    /* ── Cards Grid ── */
    .plan-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 52px;
        align-items: start;
    }

    /* ── Plan Card ── */
    .plan-card {
        position: relative;
        background: var(--p-bg2);
        border: 1px solid var(--p-border-2);
        border-radius: var(--r-xl);
        padding: 36px 30px;
        display: flex;
        flex-direction: column;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        overflow: hidden;
    }

    .plan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        border-radius: var(--r-xl) var(--r-xl) 0 0;
        opacity: 0;
        transition: opacity .3s;
    }

    .plan-card:hover {
        transform: translateY(-8px);
        border-color: var(--p-border-2);
    }

    .plan-card:hover::before {
        opacity: 1;
    }

    /* Monthly */
    .plan-card.monthly::before {
        background: linear-gradient(90deg, var(--indigo), var(--indigo-lite));
    }

    .plan-card.monthly:hover {
        box-shadow: 0 24px 60px var(--indigo-glow);
        border-color: rgba(99, 102, 241, 0.35);
    }

    /* Half-yearly (featured) */
    .plan-card.half-yearly {
        border-color: rgba(16, 185, 129, 0.35);
        box-shadow: 0 12px 40px var(--emerald-glow);
        background: linear-gradient(160deg, #0d1f1a 0%, var(--p-bg2) 60%);
    }

    .plan-card.half-yearly::before {
        background: linear-gradient(90deg, var(--emerald), var(--emerald-lite));
        opacity: 1;
    }

    .plan-card.half-yearly:hover {
        transform: translateY(-10px);
        box-shadow: 0 28px 70px var(--emerald-glow);
    }

    /* Yearly */
    .plan-card.yearly::before {
        background: linear-gradient(90deg, var(--amber), var(--amber-lite));
    }

    .plan-card.yearly:hover {
        box-shadow: 0 24px 60px var(--amber-glow);
        border-color: rgba(245, 158, 11, 0.35);
    }

    /* Current */
    .plan-card.current-plan {
        border-color: rgba(16, 185, 129, 0.45) !important;
        background: linear-gradient(160deg, #0d1f1a 0%, var(--p-bg2) 70%);
    }

    /* ── Card Badge ── */
    .plan-card-badge {
        position: absolute;
        top: 22px;
        right: 22px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .monthly .plan-card-badge {
        background: var(--indigo-glow);
        color: var(--indigo-lite);
        border: 1px solid rgba(99, 102, 241, 0.3);
    }

    .half-yearly .plan-card-badge {
        background: var(--emerald-glow);
        color: var(--emerald-lite);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .yearly .plan-card-badge {
        background: var(--amber-glow);
        color: var(--amber-lite);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    /* ── Card Icon ── */
    .plan-card-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 20px;
        flex-shrink: 0;
    }

    .monthly .plan-card-icon {
        background: var(--indigo-glow);
        color: var(--indigo-lite);
        border: 1px solid rgba(99, 102, 241, 0.2);
    }

    .half-yearly .plan-card-icon {
        background: var(--emerald-glow);
        color: var(--emerald-lite);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .yearly .plan-card-icon {
        background: var(--amber-glow);
        color: var(--amber-lite);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    /* ── Card Name / Duration ── */
    .plan-card-name {
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--t1);
        letter-spacing: -0.02em;
        margin: 0 0 4px;
    }

    .plan-card-sub {
        font-size: 13px;
        color: var(--t3);
        font-weight: 500;
        margin-bottom: 24px;
    }

    /* ── Divider ── */
    .plan-divider {
        height: 1px;
        background: var(--p-border);
        margin: 0 0 24px;
    }

    /* ── Pricing ── */
    .plan-card-price-wrap {
        margin-bottom: 28px;
    }

    .plan-card-price {
        font-size: 2.6rem;
        font-weight: 900;
        letter-spacing: -0.04em;
        color: var(--t1);
        line-height: 1;
        margin-bottom: 6px;
    }

    .monthly .plan-card-price {
        color: var(--indigo-lite);
    }

    .half-yearly .plan-card-price {
        color: var(--emerald-lite);
    }

    .yearly .plan-card-price {
        color: var(--amber-lite);
    }

    .plan-card-price-note {
        font-size: 13px;
        color: var(--t3);
        font-weight: 500;
    }

    /* ── Features ── */
    .plan-features {
        list-style: none;
        padding: 0;
        margin: 0 0 28px;
        flex: 1;
    }

    .plan-features li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 14px;
        color: var(--t2);
        padding: 8px 0;
        line-height: 1.5;
        border-bottom: 1px solid var(--p-border);
    }

    .plan-features li:last-child {
        border-bottom: none;
    }

    .plan-features li .feat-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .monthly .feat-dot {
        background: var(--indigo-glow);
        color: var(--indigo-lite);
    }

    .half-yearly .feat-dot {
        background: var(--emerald-glow);
        color: var(--emerald-lite);
    }

    .yearly .feat-dot {
        background: var(--amber-glow);
        color: var(--amber-lite);
    }

    /* ── CTA Buttons ── */
    .plan-btn {
        display: block;
        width: 100%;
        padding: 15px 24px;
        border-radius: var(--r-md);
        font-size: 15px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        letter-spacing: 0.2px;
    }

    .plan-btn.btn-indigo {
        background: linear-gradient(135deg, #4f52d3, var(--indigo));
        color: #fff;
        box-shadow: 0 6px 20px var(--indigo-glow);
    }

    .plan-btn.btn-indigo:hover {
        box-shadow: 0 8px 28px rgba(99, 102, 241, 0.45);
        transform: translateY(-2px);
    }

    .plan-btn.btn-emerald {
        background: linear-gradient(135deg, #059669, var(--emerald));
        color: #fff;
        box-shadow: 0 6px 20px var(--emerald-glow);
    }

    .plan-btn.btn-emerald:hover {
        box-shadow: 0 8px 28px rgba(16, 185, 129, 0.45);
        transform: translateY(-2px);
    }

    .plan-btn.btn-amber {
        background: linear-gradient(135deg, #d97706, var(--amber));
        color: #fff;
        box-shadow: 0 6px 20px var(--amber-glow);
    }

    .plan-btn.btn-amber:hover {
        box-shadow: 0 8px 28px rgba(245, 158, 11, 0.45);
        transform: translateY(-2px);
    }

    .plan-btn.btn-current {
        background: rgba(16, 185, 129, 0.08);
        color: var(--emerald-lite);
        border: 1.5px solid rgba(16, 185, 129, 0.3);
        cursor: not-allowed;
    }

    .plan-btn.btn-current:hover {
        transform: none;
    }

    .plan-btn.btn-locked {
        background: rgba(255, 255, 255, 0.04);
        color: var(--t3);
        border: 1px solid var(--p-border);
        cursor: not-allowed;
    }

    .plan-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none !important;
    }

    .plan-card-footnote {
        margin-top: 12px;
        font-size: 12px;
        color: var(--t3);
        text-align: center;
        line-height: 1.5;
    }

    /* ── Secondary QR button ── */
    .plan-btn-secondary {
        display: block;
        width: 100%;
        padding: 11px 20px;
        border-radius: var(--r-sm);
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        border: 1px solid var(--p-border-2);
        background: transparent;
        color: var(--t2);
        cursor: pointer;
        margin-top: 10px;
        transition: all .2s;
    }

    .plan-btn-secondary:hover {
        border-color: var(--indigo);
        color: var(--indigo-lite);
    }

    /* ── Footer CTA ── */
    .plan-footer-block {
        background: var(--p-bg2);
        border: 1px solid var(--p-border-2);
        border-radius: var(--r-xl);
        padding: 44px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .plan-footer-block::before {
        content: '';
        position: absolute;
        top: -60%;
        left: 50%;
        transform: translateX(-50%);
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .plan-footer-block h3 {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--t1);
        margin: 0 0 10px;
        position: relative;
    }

    .plan-footer-block p {
        font-size: 0.95rem;
        color: var(--t2);
        margin: 0 0 28px;
        max-width: 520px;
        margin-inline: auto;
        margin-bottom: 28px;
        line-height: 1.7;
        position: relative;
    }

    .plan-footer-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid var(--p-border-2);
        border-radius: var(--r-md);
        color: var(--t1);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all .2s;
        position: relative;
    }

    .plan-footer-link:hover {
        background: var(--indigo);
        border-color: var(--indigo);
        box-shadow: 0 6px 20px var(--indigo-glow);
        transform: translateY(-2px);
    }

    /* ── QR Modal ── */
    .qr-modal {
        position: fixed;
        inset: 0;
        background: rgba(6, 11, 24, 0.75);
        backdrop-filter: blur(8px);
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
        background: var(--p-bg2);
        border: 1px solid var(--p-border-2);
        border-radius: var(--r-xl);
        padding: 32px 28px;
        text-align: center;
        position: relative;
        box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5);
        animation: modalPop .3s ease;
    }

    @keyframes modalPop {
        from {
            opacity: 0;
            transform: scale(.92);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .qr-modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        color: var(--t2);
        font-size: 20px;
        cursor: pointer;
        transition: background .2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qr-modal-close:hover {
        background: rgba(244, 63, 94, 0.2);
        color: #fb7185;
    }

    .qr-modal-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--t1);
        margin: 0 0 8px;
    }

    .qr-modal-copy {
        font-size: 14px;
        color: var(--t2);
        margin: 0 0 20px;
        line-height: 1.6;
    }

    .qr-modal-img-wrap {
        width: 240px;
        height: 240px;
        margin: 0 auto 20px;
        border-radius: var(--r-lg);
        border: 1px solid var(--p-border-2);
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .qr-modal-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .qr-modal-amount {
        font-size: 1.75rem;
        font-weight: 900;
        color: var(--t1);
        margin-bottom: 6px;
    }

    .qr-modal-status {
        font-size: 13px;
        color: var(--t3);
    }

    /* ═══ LIGHT THEME OVERRIDES ═══ */
    [data-theme="light"] .plan-page-wrap {
        background: #f0f4ff;
    }

    [data-theme="light"] .plan-hero {
        background: linear-gradient(135deg, #1e2a5e 0%, #312060 50%, #1a3a2a 100%);
    }

    [data-theme="light"] .plan-stat,
    [data-theme="light"] .plan-card,
    [data-theme="light"] .plan-banner,
    [data-theme="light"] .plan-footer-block,
    [data-theme="light"] .qr-modal-dialog {
        background: #ffffff;
        border-color: rgba(0, 0, 0, 0.08);
    }

    [data-theme="light"] .plan-card.half-yearly,
    [data-theme="light"] .plan-card.current-plan {
        background: linear-gradient(160deg, #edfcf4 0%, #fff 60%);
    }

    [data-theme="light"] .plan-stat-label,
    [data-theme="light"] .plan-card-sub,
    [data-theme="light"] .plan-card-price-note,
    [data-theme="light"] .plan-card-footnote,
    [data-theme="light"] .plan-banner-msg,
    [data-theme="light"] .plan-footer-block p,
    [data-theme="light"] .qr-modal-copy,
    [data-theme="light"] .qr-modal-status {
        color: #64748b;
    }

    [data-theme="light"] .plan-stat-value,
    [data-theme="light"] .plan-card-name,
    [data-theme="light"] .plan-card-price,
    [data-theme="light"] .plan-section-head h2,
    [data-theme="light"] .plan-banner-title,
    [data-theme="light"] .plan-footer-block h3,
    [data-theme="light"] .plan-hero h1,
    [data-theme="light"] .qr-modal-title,
    [data-theme="light"] .qr-modal-amount {
        color: #0f172a;
    }

    [data-theme="light"] .plan-features li {
        color: #475569;
        border-color: rgba(0, 0, 0, 0.06);
    }

    [data-theme="light"] .plan-section-head p {
        color: #475569;
    }

    [data-theme="light"] .plan-footer-link {
        color: #0f172a;
        background: rgba(0, 0, 0, 0.04);
        border-color: rgba(0, 0, 0, 0.1);
    }

    [data-theme="light"] .plan-btn-secondary {
        color: #475569;
        border-color: rgba(0, 0, 0, 0.1);
    }

    [data-theme="light"] .plan-orbs span {
        opacity: 0.06;
    }

    [data-theme="light"] .plan-btn.btn-current {
        background: rgba(16, 185, 129, 0.07);
    }

    [data-theme="light"] .plan-banner-right {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 0, 0, 0.08);
    }

    [data-theme="light"] .qr-modal-close {
        background: rgba(0, 0, 0, 0.06);
        color: #475569;
    }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 900px) {
        .plan-status-strip {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .plan-page-wrap {
            padding: 16px 14px 48px;
        }

        .plan-hero {
            padding: 28px 22px 52px;
            border-radius: var(--r-lg);
        }

        .plan-hero h1 {
            font-size: 1.65rem;
        }

        .plan-hero p {
            font-size: 0.9rem;
        }

        .plan-status-strip {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: -24px 0 32px;
        }

        .plan-stat {
            padding: 14px 16px;
        }

        .plan-stat-value {
            font-size: 1rem;
        }

        .plan-banner {
            flex-direction: row;
            gap: 10px;
            padding: 16px 18px;
            margin-bottom: 36px;
        }

        .plan-banner-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .plan-banner-title {
            font-size: 0.9rem;
        }

        .plan-banner-msg {
            font-size: 12px;
        }

        .plan-banner-right {
            min-width: 90px;
            padding: 10px 14px;
        }

        .plan-banner-right-value {
            font-size: 1.2rem;
        }

        .plan-section-head h2 {
            font-size: 1.5rem;
        }

        .plan-section-head p {
            font-size: 0.875rem;
        }

        .plan-cards {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .plan-card {
            padding: 24px 22px;
            border-radius: var(--r-lg);
        }

        .plan-card-icon {
            width: 48px;
            height: 48px;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .plan-card-name {
            font-size: 1.35rem;
        }

        .plan-card-price {
            font-size: 2.2rem;
        }

        .plan-card-badge {
            top: 16px;
            right: 16px;
            font-size: 10px;
            padding: 4px 10px;
        }

        .plan-footer-block {
            padding: 28px 20px;
            border-radius: var(--r-lg);
        }

        .plan-footer-block h3 {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 480px) {
        .plan-status-strip {
            grid-template-columns: 1fr 1fr;
        }

        .plan-banner-right {
            display: none;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .plan-orbs span {
            animation: none;
        }

        .plan-card,
        .plan-stat,
        .plan-btn {
            transition: none;
        }
    }
</style>

<!-- Ambient background orbs -->
<div class="plan-orbs" aria-hidden="true">
    <span></span><span></span><span></span>
</div>

<div class="plan-page-wrap">
    <div class="plan-shell plan-content-layer">

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="plan-flash success">
                <i class='bx bx-check-circle' style="font-size:18px;flex-shrink:0"></i>
                <?= html_escape($this->session->flashdata('success')); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="plan-flash error">
                <i class='bx bx-error-circle' style="font-size:18px;flex-shrink:0"></i>
                <?= html_escape($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>
        <?php if ($purchaseLockedMessage !== ''): ?>
            <div class="plan-flash error">
                <i class='bx bx-lock' style="font-size:18px;flex-shrink:0"></i>
                <?= html_escape($purchaseLockedMessage); ?>
            </div>
        <?php endif; ?>

        <!-- Hero -->
        <section class="plan-hero">
            <div class="plan-hero-inner">
                <div class="plan-eyebrow">
                    <i class='bx bx-crown'></i>
                    Subscription Plans
                </div>
                <h1>Choose the plan that <em>powers your growth</em></h1>
                <p>Start with a 30-day free trial — no credit card required. Upgrade anytime to unlock uninterrupted access to your full admin dashboard.</p>
            </div>
        </section>

        <!-- Status Strip -->
        <div class="plan-status-strip">
            <div class="plan-stat accent-indigo">
                <span class="plan-stat-label">Status</span>
                <strong class="plan-stat-value"><?= html_escape($planSummary['status_label'] ?? '—'); ?></strong>
            </div>
            <div class="plan-stat accent-emerald">
                <span class="plan-stat-label">Current Plan</span>
                <strong class="plan-stat-value"><?= html_escape($planSummary['plan_name'] ?? 'No Plan'); ?></strong>
            </div>
            <div class="plan-stat accent-amber">
                <span class="plan-stat-label"><?= html_escape($paymentLabel); ?></span>
                <strong class="plan-stat-value"><?= html_escape($paymentValue); ?></strong>
            </div>
            <div class="plan-stat accent-rose">
                <span class="plan-stat-label">
                    <?= !empty($planSummary['is_trial']) ? 'Trial Ends' : 'Plan Ends'; ?>
                </span>
                <strong class="plan-stat-value"><?= html_escape($planSummary['end_date'] ?? '—'); ?></strong>
            </div>
        </div>

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
        <div class="plan-banner <?= $alertClass; ?>">
            <div class="plan-banner-left">
                <div class="plan-banner-icon">
                    <i class='bx <?= $alertIcon; ?>'></i>
                </div>
                <div>
                    <h4 class="plan-banner-title"><?= html_escape($alertTitle); ?></h4>
                    <p class="plan-banner-msg"><?= html_escape($planSummary['message'] ?? ''); ?></p>
                </div>
            </div>
            <div class="plan-banner-right">
                <span class="plan-banner-right-label">
                    <?= !empty($planSummary['is_trial']) ? 'Days Left' : 'Plan Value'; ?>
                </span>
                <strong class="plan-banner-right-value">
                    <?php if (!empty($planSummary['is_trial'])): ?>
                        <?= (int)($planSummary['days_left'] ?? 0); ?>d
                    <?php else: ?>
                        ₹<?= number_format((float)($planSummary['amount'] ?? 0), 0); ?>
                    <?php endif; ?>
                </strong>
            </div>
        </div>

        <!-- Section Heading -->
        <div class="plan-section-head">
            <h2>Pick Your Plan</h2>
            <p>All plans unlock full access to every premium feature. Choose the duration that suits your business.</p>
        </div>

        <!-- Plan Cards -->
        <div class="plan-cards">
            <?php
            foreach ($plans as $plan):
                if (!empty($plan['is_trial'])) continue;
                if (empty($plan['is_active']) && $currentPlanCode !== $plan['code']) continue;

                $cardClass  = $plan['accent'] === 'half-yearly' ? 'half-yearly' : ($plan['accent'] === 'yearly' ? 'yearly' : 'monthly');
                $isCurrent  = !$isCurrentPlanExpired && $currentPlanCode === $plan['code'];
                $btnClass   = $cardClass === 'monthly' ? 'btn-indigo' : ($cardClass === 'half-yearly' ? 'btn-emerald' : 'btn-amber');
                $badgeLabel = '';

                if ($plan['code'] === 'half_yearly') {
                    $badgeLabel = '⭐ Most Popular';
                } elseif ($plan['code'] === 'yearly') {
                    $monthlyPrice = isset($plans['monthly']['price']) ? (float)$plans['monthly']['price'] : 0;
                    $yearlyPrice  = (float)($plan['price'] ?? 0);
                    $rawSaving    = max(0, ($monthlyPrice * 12) - $yearlyPrice);
                    $displaySaving = $rawSaving > 0 ? round($rawSaving / 100) * 100 : 0;
                    $badgeLabel   = $displaySaving > 0 ? '🔥 Save ₹' . number_format($displaySaving, 0) : '🔥 Best Value';
                }
                $buttonLabel = $isCurrent
                    ? '✓ Current Plan'
                    : (($currentPlanCode === $plan['code'] && $isCurrentPlanExpired) ? 'Renew Plan' : 'Get Started');
            ?>
                <article class="plan-card <?= $cardClass; ?> <?= $isCurrent ? 'current-plan' : ''; ?>">

                    <?php if ($badgeLabel !== ''): ?>
                        <span class="plan-card-badge"><?= html_escape($badgeLabel); ?></span>
                    <?php endif; ?>

                    <div class="plan-card-icon">
                        <i class='bx bx-crown'></i>
                    </div>

                    <h3 class="plan-card-name"><?= html_escape(str_replace(' Plan', '', $plan['name'])); ?></h3>
                    <p class="plan-card-sub"><?= html_escape($plan['duration_label']); ?> Subscription • <?= (int)$plan['duration_days']; ?> days</p>

                    <div class="plan-divider"></div>

                    <div class="plan-card-price-wrap">
                        <div class="plan-card-price"><?= html_escape($plan['price_label']); ?></div>
                        <p class="plan-card-price-note">billed once · valid <?= (int)$plan['duration_days']; ?> days</p>
                    </div>

                    <ul class="plan-features">
                        <?php foreach ($plan['features'] as $feature): ?>
                            <li>
                                <span class="feat-dot">✓</span>
                                <?= html_escape($feature); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if ($isCurrent): ?>
                        <button class="plan-btn btn-current" disabled>✓ Active Plan</button>
                    <?php elseif (!$canPurchasePlan && $purchaseLockedMessage !== ''): ?>
                        <button class="plan-btn btn-locked" disabled>Available After Expiry</button>
                    <?php else: ?>
                        <button type="button"
                            class="plan-btn <?= $btnClass; ?> js-razorpay-plan-btn"
                            data-plan-code="<?= html_escape($plan['code']); ?>"
                            data-plan-name="<?= html_escape($plan['name']); ?>"
                            <?= !$razorpayEnabled ? 'disabled' : ''; ?>>
                            <?= html_escape($razorpayEnabled ? $buttonLabel : 'Configure Razorpay First'); ?>
                        </button>
                    <?php endif; ?>

                    <p class="plan-card-footnote">
                        Activates immediately &nbsp;·&nbsp; Valid <?= (int)$plan['duration_days']; ?> days
                    </p>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Footer CTA -->
        <div class="plan-footer-block">
            <h3>🎉 Try Free for 30 Days</h3>
            <p>
                <?php if (!empty($planSummary['trial_used'])): ?>
                    Your free trial has been used. Choose any plan above to continue enjoying premium features.
                <?php else: ?>
                    Experience every premium feature risk-free for a full month. No credit card, no commitment — upgrade anytime.
                <?php endif; ?>
            </p>
            <a href="<?= site_url('admin/dashboard'); ?>" class="plan-footer-link">
                <i class='bx bx-arrow-back'></i>
                Back to Dashboard
            </a>
        </div>

    </div><!-- /.plan-shell -->
</div><!-- /.plan-page-wrap -->

<!-- QR Modal -->
<div class="qr-modal" id="qrPaymentModal" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="qr-modal-dialog">
        <button class="qr-modal-close" id="qrModalCloseBtn" aria-label="Close">×</button>
        <h3 class="qr-modal-title" id="qrModalTitle">Scan to Pay</h3>
        <p class="qr-modal-copy">Point your UPI app camera at the QR code below to complete payment.</p>
        <div class="qr-modal-img-wrap">
            <img class="qr-modal-img" id="qrModalImage" src="" alt="QR Code">
        </div>
        <div class="qr-modal-amount" id="qrModalAmount"></div>
        <div class="qr-modal-status" id="qrModalStatus">Waiting for payment…</div>
    </div>
</div>

<!-- Razorpay verify form -->
<form id="razorpayVerifyForm" method="post" action="<?= site_url('admin/plan/verify_payment'); ?>" style="display:none;">
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
            var razorpayKey = <?= json_encode((string)($razorpay_key_id ?? '')); ?>;
            var companyName = <?= json_encode((string)($razorpay_company_name ?? 'Filter Book')); ?>;
            var logoUrl = <?= json_encode((string)($razorpay_logo_url ?? '')); ?>;
            var themeColor = <?= json_encode((string)($razorpay_theme_color ?? '#6366f1')); ?>;
            var qrModal = document.getElementById('qrPaymentModal');
            var qrModalImage = document.getElementById('qrModalImage');
            var qrModalStatus = document.getElementById('qrModalStatus');
            var qrModalTitle = document.getElementById('qrModalTitle');
            var qrModalAmount = document.getElementById('qrModalAmount');
            var qrModalCloseBtn = document.getElementById('qrModalCloseBtn');
            var qrPollTimer = null;

            function clearQrPolling() {
                if (qrPollTimer) {
                    clearInterval(qrPollTimer);
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
                qrModalTitle.textContent = planName ? planName + ' — QR Payment' : 'Scan QR Code';
                qrModalAmount.textContent = qrData.amount_label || '';
                qrModalStatus.textContent = 'Waiting for payment confirmation…';
                qrModalImage.setAttribute('src', qrData.image_url || '');
                qrModal.classList.add('is-open');
                qrModal.setAttribute('aria-hidden', 'false');
            }

            function pollQrStatus(qrId) {
                clearQrPolling();
                qrPollTimer = setInterval(function() {
                    var fd = new FormData();
                    fd.append('qr_id', qrId);
                    fetch(checkQrStatusUrl, {
                            method: 'POST',
                            body: fd,
                            credentials: 'same-origin'
                        })
                        .then(parseJsonResponse)
                        .then(function(result) {
                            if (!result || !result.status) return;
                            if (result.paid) {
                                qrModalStatus.textContent = 'Payment received — activating your plan…';
                                clearQrPolling();
                                setTimeout(function() {
                                    window.location.href = result.redirect_url || <?= json_encode(site_url('admin/plan')); ?>;
                                }, 1200);
                                return;
                            }
                            if (result.qr_status === 'closed') {
                                qrModalStatus.textContent = 'QR expired. Please generate a new code.';
                                clearQrPolling();
                            }
                        }).catch(function() {
                            qrModalStatus.textContent = 'Checking payment status…';
                        });
                }, 5000);
            }

            function setButtonState(btn, loading) {
                if (!btn) return;
                if (!btn.dataset.defaultLabel) btn.dataset.defaultLabel = btn.textContent;
                btn.disabled = loading;
                btn.textContent = loading ? 'Please wait…' : btn.dataset.defaultLabel;
            }

            function postFailure(orderId, reason) {
                var fd = new FormData();
                fd.append('razorpay_order_id', orderId || '');
                fd.append('reason', reason || 'Payment cancelled');
                fetch(paymentFailedUrl, {
                    method: 'POST',
                    body: fd,
                    credentials: 'same-origin'
                });
            }

            function parseJsonResponse(response) {
                return response.text().then(function(text) {
                    try {
                        return text ? JSON.parse(text) : {};
                    } catch (e) {
                        throw new Error(text || ('Request failed: ' + response.status));
                    }
                });
            }

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var planCode = button.getAttribute('data-plan-code') || '';
                    if (!planCode) {
                        alert('Plan code missing.');
                        return;
                    }

                    setButtonState(button, true);
                    var fd = new FormData();
                    fd.append('plan_code', planCode);

                    fetch(createOrderUrl, {
                            method: 'POST',
                            body: fd,
                            credentials: 'same-origin'
                        })
                        .then(parseJsonResponse)
                        .then(function(result) {
                            if (!result || !result.status || !result.order) {
                                throw new Error(result && result.message ? result.message : 'Unable to create payment order.');
                            }
                            var order = result.order;
                            var prefill = result.prefill || {};
                            var rzp = new Razorpay({
                                key: razorpayKey,
                                amount: order.amount,
                                currency: order.currency || 'INR',
                                name: companyName,
                                description: result.plan && result.plan.name ? result.plan.name : 'Subscription Plan',
                                image: logoUrl,
                                order_id: order.id,
                                prefill: {
                                    name: prefill.name || '',
                                    email: prefill.email || '',
                                    contact: prefill.contact || ''
                                },
                                notes: {
                                    plan_name: (result.plan && result.plan.name) ? result.plan.name : '',
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
                                        postFailure(order.id, 'Popup closed');
                                        setButtonState(button, false);
                                    }
                                }
                            });
                            rzp.on('payment.failed', function(r) {
                                var err = r && r.error ? r.error.description : 'Payment failed';
                                postFailure(order.id, err);
                                alert(err);
                                setButtonState(button, false);
                            });
                            rzp.open();
                        })
                        .catch(function(error) {
                            alert(error && error.message ? error.message : 'Unable to start payment.');
                            setButtonState(button, false);
                        });
                });
            });

            qrModalCloseBtn.addEventListener('click', closeQrModal);
            qrModal.addEventListener('click', function(e) {
                if (e.target === qrModal) closeQrModal();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && qrModal.classList.contains('is-open')) closeQrModal();
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
                title: '⚠️ Plan Expired',
                background: '#0d1426',
                color: '#f1f5f9',
                html: `<p style="color:#94a3b8;margin-bottom:12px;"><?= addslashes($this->session->flashdata('plan_expired_message')); ?></p>
               <p style="color:#64748b;font-size:13px;">Purchase a plan below to restore full access.</p>`,
                confirmButtonText: '🛒 Choose a Plan',
                confirmButtonColor: '#6366f1',
                allowOutsideClick: false,
            });
        });
    </script>
<?php endif; ?>