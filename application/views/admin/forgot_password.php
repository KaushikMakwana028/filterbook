<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f2f5;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .page-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            min-height: 100vh;
        }

        .forgot-container {
            width: 100%;
            max-width: 460px;
        }

        /* Brand */
        .brand-area {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            background: #111827;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg {
            width: 24px;
            height: 24px;
            color: #fff;
        }

        /* Card */
        .forgot-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 40px 36px;
        }

        /* Step indicator */
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 32px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .step-dot.active {
            background: #111827;
            color: #fff;
        }

        .step-dot.inactive {
            background: #f3f4f6;
            color: #9ca3af;
            border: 1px solid #e5e7eb;
        }

        .step-dot.completed {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .step-dot.completed svg {
            width: 14px;
            height: 14px;
        }

        .step-label {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #9ca3af;
        }

        .step-label.active {
            color: #111827;
        }

        .step-connector {
            width: 48px;
            height: 2px;
            background: #e5e7eb;
            margin: 0 12px;
            border-radius: 2px;
        }

        .step-connector.active {
            background: #111827;
        }

        .forgot-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .forgot-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 32px;
            line-height: 1.5;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
        }

        .input-wrapper .input-icon svg {
            width: 18px;
            height: 18px;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            background: #fff;
            padding: 0 14px 0 42px;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            color: #111827;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:hover {
            border-color: #9ca3af;
        }

        .form-control:focus {
            border-color: #111827;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.08);
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: #374151;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }

        /* Button */
        .btn-submit {
            width: 100%;
            height: 48px;
            border-radius: 10px;
            border: none;
            background: #111827;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, box-shadow 0.2s ease;
            margin-top: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #1f2937;
            box-shadow: 0 4px 12px rgba(17, 24, 39, 0.15);
        }

        .btn-submit:active {
            background: #030712;
            box-shadow: none;
        }

        .btn-submit svg {
            width: 16px;
            height: 16px;
            transition: transform 0.2s ease;
        }

        .btn-submit:hover svg {
            transform: translateX(2px);
        }

        /* Back link */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            text-decoration: none;
            color: #6b7280;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #111827;
        }

        .back-link svg {
            width: 16px;
            height: 16px;
            transition: transform 0.2s ease;
        }

        .back-link:hover svg {
            transform: translateX(-3px);
        }

        /* Alerts */
        .alert {
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            margin-bottom: 24px;
            padding: 12px 16px;
            font-size: 0.8125rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-icon svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Password strength */
        .password-strength {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .strength-bar {
            flex: 1;
            height: 3px;
            border-radius: 3px;
            background: #e5e7eb;
            transition: background 0.3s ease;
        }

        .strength-bar.weak {
            background: #ef4444;
        }

        .strength-bar.medium {
            background: #f59e0b;
        }

        .strength-bar.strong {
            background: #10b981;
        }

        .strength-text {
            font-size: 0.75rem;
            margin-top: 4px;
            font-weight: 500;
        }

        .strength-text.weak {
            color: #ef4444;
        }

        .strength-text.medium {
            color: #f59e0b;
        }

        .strength-text.strong {
            color: #10b981;
        }

        /* Footer */
        .footer-text {
            text-align: center;
            margin-top: 24px;
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 540px) {
            .forgot-card {
                padding: 28px 20px;
                border-radius: 14px;
            }

            .forgot-title {
                font-size: 1.25rem;
            }

            .step-label {
                display: none;
            }

            .step-connector {
                width: 32px;
            }
        }
    </style>
</head>

<body>
   <div class="page-wrapper">
    <div class="forgot-container">

        <!-- Brand -->
        <div class="brand-area">
            <div class="brand-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
        </div>

        <div class="forgot-card">

            <?php if (($step ?? 'expired') === 'expired'): ?>

                <!-- ── EXPIRED TOKEN STATE ── -->
                <div style="text-align:center; padding: 16px 0 8px;">
                    <div style="
                        width:72px; height:72px;
                        background: rgba(239,68,68,0.1);
                        border: 2px solid rgba(239,68,68,0.25);
                        border-radius: 50%;
                        display:flex; align-items:center; justify-content:center;
                        margin: 0 auto 20px;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.8" stroke="#ef4444" width="32" height="32">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="forgot-title">Link Expired</div>
                    <div class="forgot-subtitle">
                        This password reset link has expired (valid for 2 hours only).<br>
                        Please request a new one.
                    </div>
                    <a href="<?= site_url('admin/forgot_password_page') ?>" class="btn-submit"
                        style="display:inline-flex; margin-top:8px; text-decoration:none;">
                        Request New Link
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="<?= site_url('admin/login') ?>" class="back-link" style="margin-top:16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Login
                    </a>
                </div>

            <?php elseif (($step ?? '') === 'success'): ?>

                <!-- ── SUCCESS STATE ── -->
                <div style="text-align:center; padding: 16px 0 8px;">
                    <div style="
                        width:72px; height:72px;
                        background: rgba(34,197,94,0.1);
                        border: 2px solid rgba(34,197,94,0.3);
                        border-radius: 50%;
                        display:flex; align-items:center; justify-content:center;
                        margin: 0 auto 20px;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="#22c55e" width="32" height="32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="forgot-title">Password Updated!</div>
                    <div class="forgot-subtitle">
                        Your password has been successfully updated.<br>
                        You can now login with your new password.
                    </div>
                    <a href="<?= site_url('admin/login') ?>" class="btn-submit"
                        style="display:inline-flex; margin-top:8px; text-decoration:none;">
                        Go to Login
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

            <?php else: ?>

                <!-- ── STEP INDICATOR ── -->
                <div class="step-indicator">
                    <div class="step">
                        <div class="step-dot completed">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <span class="step-label">Verify</span>
                    </div>
                    <div class="step-connector active"></div>
                    <div class="step">
                        <div class="step-dot active">2</div>
                        <span class="step-label active">Reset</span>
                    </div>
                </div>

                <div class="forgot-title">Create New Password</div>
                <div class="forgot-subtitle">
                    Your identity has been verified. Set your new password below.
                </div>

                <!-- Flash messages -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <span class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <span class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </span>
                        <?= $this->session->flashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- API error (shown by JS) -->
                <div class="alert alert-danger" id="apiError" style="display:none;">
                    <span class="alert-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </span>
                    <span id="apiErrorMsg"></span>
                </div>

                <!-- ── RESET PASSWORD FORM ── -->
                <div id="resetForm">
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter new password" autocomplete="new-password">
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength" id="strengthBars">
                            <div class="strength-bar" id="bar1"></div>
                            <div class="strength-bar" id="bar2"></div>
                            <div class="strength-bar" id="bar3"></div>
                            <div class="strength-bar" id="bar4"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                        <div class="field-error" id="passError">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </span>
                            <input type="password" name="confirm_password" id="confirmPassword" class="form-control"
                                placeholder="Confirm new password" autocomplete="new-password">
                            <button type="button" class="password-toggle"
                                onclick="togglePassword('confirmPassword', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="field-error" id="confirmError">Passwords do not match</div>
                    </div>

                    <button type="button" class="btn-submit" id="submitBtn" onclick="submitReset()">
                        <span class="btn-text">
                            Update Password
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                        <span class="btn-loading" style="display:none;">
                            <svg style="animation:spin .7s linear infinite" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" width="20" height="20">
                                <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
                                <path d="M12 2a10 10 0 0110 10" stroke="white" stroke-width="3"
                                    stroke-linecap="round"/>
                            </svg>
                            Updating...
                        </span>
                    </button>
                </div>

                <a href="<?= site_url('admin/login') ?>" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Login
                </a>

            <?php endif; ?>

        </div>

        <div class="footer-text">
            Secured with encryption &bull; Your data is safe
        </div>
    </div>
</div>

<style>
    .field-error {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }
    .field-error.show { display: block; }
    .form-control.input-error { border-color: #ef4444 !important; }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
    /* ── Token from PHP ── */
    const RESET_TOKEN = '<?= htmlspecialchars($token ?? '') ?>';

    /* ── Toggle password visibility ── */
    function togglePassword(inputId, btn) {
        const input    = document.getElementById(inputId);
        const isHidden = input.type === 'password';
        input.type     = isHidden ? 'text' : 'password';
        btn.innerHTML  = isHidden
            ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
               </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                 <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
               </svg>`;
    }

    /* ── Password strength ── */
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function () {
            const val  = this.value;
            const bars = ['bar1','bar2','bar3','bar4'].map(id => document.getElementById(id));
            const text = document.getElementById('strengthText');
            let strength = 0;
            if (val.length >= 6)  strength++;
            if (val.length >= 10) strength++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) strength++;
            if (/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) strength++;
            const levels = ['', 'weak', 'medium', 'medium', 'strong'];
            const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
            bars.forEach((bar, i) => {
                bar.className = 'strength-bar';
                if (i < strength) bar.classList.add(levels[strength]);
            });
            text.textContent = val.length === 0 ? '' : (labels[strength] || 'Too short');
            text.className   = 'strength-text ' + (val.length === 0 ? '' : (levels[strength] || 'weak'));
        });
    }

    /* ── Show API error ── */
    function showError(msg) {
        const box = document.getElementById('apiError');
        document.getElementById('apiErrorMsg').textContent = msg;
        box.style.display = 'flex';
        box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    function hideError() {
        document.getElementById('apiError').style.display = 'none';
    }

    /* ── Submit via fetch → API ── */
    async function submitReset() {
        hideError();

        const password = document.getElementById('password').value.trim();
        const confirm  = document.getElementById('confirmPassword').value.trim();
        const passErr  = document.getElementById('passError');
        const confErr  = document.getElementById('confirmError');
        const passIn   = document.getElementById('password');
        const confIn   = document.getElementById('confirmPassword');

        // Clear previous errors
        passErr.classList.remove('show'); passIn.classList.remove('input-error');
        confErr.classList.remove('show'); confIn.classList.remove('input-error');

        let valid = true;

        if (!password || password.length < 6) {
            passErr.classList.add('show');
            passIn.classList.add('input-error');
            valid = false;
        }

        if (!confirm || confirm !== password) {
            confErr.classList.add('show');
            confIn.classList.add('input-error');
            valid = false;
        }

        if (!valid) return;

        // Loading state
        const btn     = document.getElementById('submitBtn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoad = btn.querySelector('.btn-loading');
        btn.disabled  = true;
        btnText.style.display = 'none';
        btnLoad.style.display = 'inline-flex';

        try {
            const res  = await fetch('<?= site_url('reset_password') ?>', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify({
                    token:            RESET_TOKEN,
                    password:         password,
                    confirm_password: confirm
                })
            });

            const data = await res.json();

            if (data.status) {
                // Hide form, show success
                document.getElementById('resetForm').style.display = 'none';
                document.querySelector('.step-indicator').style.display = 'none';
                document.querySelector('.forgot-title').style.display = 'none';
                document.querySelector('.forgot-subtitle').style.display = 'none';
                document.querySelector('.back-link').style.display = 'none';

                document.querySelector('.forgot-card').insertAdjacentHTML('beforeend', `
                    <div style="text-align:center; padding:16px 0 8px; animation: fadeSlide .4s ease both;">
                        <div style="
                            width:72px;height:72px;
                            background:rgba(34,197,94,0.1);
                            border:2px solid rgba(34,197,94,0.3);
                            border-radius:50%;
                            display:flex;align-items:center;justify-content:center;
                            margin:0 auto 20px;
                        ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="#22c55e" width="32" height="32">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <div class="forgot-title">Password Updated!</div>
                        <div class="forgot-subtitle">
                            Your password has been updated successfully.<br>
                            You can now login with your new password.
                        </div>
                        <a href="<?= site_url('admin/login') ?>" class="btn-submit"
                            style="display:inline-flex;margin-top:12px;text-decoration:none;">
                            Go to Login
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>
                `);
            } else {
                // Expired from API side
                if (data.message && data.message.toLowerCase().includes('expir')) {
                    window.location.href = '<?= site_url('reset_password_page') ?>?token=' + encodeURIComponent(RESET_TOKEN) + '&expired=1';
                } else {
                    showError(data.message || 'Something went wrong. Please try again.');
                }
            }
        } catch (err) {
            showError('Network error. Please check your connection and try again.');
        } finally {
            btn.disabled = false;
            btnText.style.display = 'inline-flex';
            btnLoad.style.display = 'none';
        }
    }

    /* ── Enter key support ── */
    document.addEventListener('keydown', e => {
        if (e.key === 'Enter' && document.getElementById('resetForm')) submitReset();
    });
</script>
</body>

</html>