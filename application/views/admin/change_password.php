<style>
    /* ══════════════════════════════════════
       Change Password Page
    ══════════════════════════════════════ */
    .cp-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 70px);
        padding: 24px 16px;
    }

    .cp-card {
        width: 100%;
        max-width: 480px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(15, 23, 42, 0.08);
    }

    /* Hero */
    .cp-hero {
        padding: 28px 32px 24px;
        background: linear-gradient(135deg, #1e88e5 0%, #1565c0 55%, #00a6a6 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .cp-hero::before {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        top: -70px;
        right: -40px;
    }

    .cp-hero::after {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        bottom: -40px;
        left: -20px;
    }

    .cp-hero-inner {
        position: relative;
        z-index: 1;
    }

    .cp-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.16);
        font-size: 11.5px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .cp-hero h2 {
        margin: 0 0 6px;
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .cp-hero p {
        margin: 0;
        font-size: 0.875rem;
        opacity: 0.88;
    }

    /* Body */
    .cp-body {
        padding: 28px 32px 32px;
    }

    /* Alert */
    .cp-alert {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
        border: 1px solid transparent;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cp-alert.success {
        background: #ecfdf5;
        color: #166534;
        border-color: #bbf7d0;
    }

    .cp-alert.error {
        background: #fef2f2;
        color: #b91c1c;
        border-color: #fecaca;
    }

    /* Field */
    .cp-field {
        margin-bottom: 20px;
    }

    .cp-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 8px;
    }

    .cp-input-wrap {
        display: flex;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    .cp-input-wrap:focus-within {
        border-color: #1e88e5;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.1);
    }

    .cp-input {
        flex: 1;
        height: 48px;
        padding: 0 14px;
        border: none;
        background: transparent;
        font-size: 0.875rem;
        font-family: inherit;
        color: #1e293b;
        outline: none;
    }

    .cp-input::placeholder {
        color: #94a3b8;
    }

    .cp-eye-btn {
        width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        font-size: 18px;
        transition: color 0.2s;
        text-decoration: none;
    }

    .cp-eye-btn:hover {
        color: #1e88e5;
    }

    .cp-invalid {
        display: none;
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 6px;
        font-weight: 500;
    }

    .was-validated .cp-input:invalid~.cp-invalid,
    .cp-input.is-invalid~.cp-invalid {
        display: block;
    }

    /* Actions */
    .cp-actions {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .cp-btn {
        flex: 1;
        height: 48px;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 700;
        font-family: inherit;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
    }

    .cp-btn-primary {
        background: linear-gradient(135deg, #1e88e5, #1565c0);
        color: #fff;
        box-shadow: 0 4px 16px rgba(30, 136, 229, 0.25);
    }

    .cp-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(30, 136, 229, 0.3);
        color: #fff;
    }

    .cp-btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1.5px solid #e2e8f0;
    }

    .cp-btn-secondary:hover {
        background: #e2e8f0;
        color: #1e293b;
        text-decoration: none;
    }

    /* ══════════════════════════════════════
       DARK THEME
    ══════════════════════════════════════ */
    [data-theme="dark"] .cp-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
        box-shadow: none !important;
    }

    [data-theme="dark"] .cp-label {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .cp-input-wrap {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .cp-input-wrap:focus-within {
        background: var(--bg-secondary) !important;
        border-color: #1e88e5 !important;
    }

    [data-theme="dark"] .cp-input {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .cp-input::placeholder {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .cp-eye-btn {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .cp-eye-btn:hover {
        color: #1e88e5 !important;
    }

    [data-theme="dark"] .cp-btn-secondary {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .cp-btn-secondary:hover {
        background: var(--bg-primary) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .cp-alert.success {
        background: rgba(16, 185, 129, 0.1) !important;
        border-color: rgba(16, 185, 129, 0.2) !important;
        color: #6ee7b7 !important;
    }

    [data-theme="dark"] .cp-alert.error {
        background: rgba(239, 68, 68, 0.1) !important;
        border-color: rgba(239, 68, 68, 0.2) !important;
        color: #fca5a5 !important;
    }

    @media (max-width: 480px) {
        .cp-hero {
            padding: 22px 20px 18px;
        }

        .cp-hero h2 {
            font-size: 1.3rem;
        }

        .cp-body {
            padding: 22px 20px 24px;
        }

        .cp-actions {
            flex-direction: column;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="cp-wrap">
            <div class="cp-card">

                <!-- Hero -->
                <div class="cp-hero">
                    <div class="cp-hero-inner">
                        <div class="cp-hero-badge">
                            <i class="bx bx-shield-quarter"></i> Security
                        </div>
                        <h2>Change Password</h2>
                        <p>Update your account password to keep it secure.</p>
                    </div>
                </div>

                <div class="cp-body">

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="cp-alert success">
                            <i class="bx bx-check-circle"></i>
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="cp-alert error">
                            <i class="bx bx-error-circle"></i>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('change_password/update') ?>" method="post" id="cpForm">

                        <div class="cp-field">
                            <label class="cp-label">New Password</label>
                            <div class="cp-input-wrap">
                                <input type="password" class="cp-input" id="cpPassword"
                                    name="password" placeholder="Enter new password" required>
                                <a href="javascript:;" class="cp-eye-btn" id="cpToggle1">
                                    <i class="bx bx-hide" id="cpEye1"></i>
                                </a>
                            </div>
                            <div class="cp-invalid" id="cpPassErr">Please enter a new password.</div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Confirm Password</label>
                            <div class="cp-input-wrap">
                                <input type="password" class="cp-input" id="cpConfirm"
                                    name="confirm_password" placeholder="Confirm new password" required>
                                <a href="javascript:;" class="cp-eye-btn" id="cpToggle2">
                                    <i class="bx bx-hide" id="cpEye2"></i>
                                </a>
                            </div>
                            <div class="cp-invalid" id="cpConfirmErr">Passwords do not match.</div>
                        </div>

                        <div class="cp-actions">
                            <button type="submit" class="cp-btn cp-btn-primary">
                                <i class="bx bx-check-shield"></i> Update Password
                            </button>
                            <a href="<?= site_url('admin/dashboard') ?>" class="cp-btn cp-btn-secondary">
                                <i class="bx bx-arrow-back"></i> Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    function toggleEye(toggleId, eyeId, inputId) {
        document.getElementById(toggleId).addEventListener('click', function() {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(eyeId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = 'password';
                icon.classList.replace('bx-show', 'bx-hide');
            }
        });
    }

    toggleEye('cpToggle1', 'cpEye1', 'cpPassword');
    toggleEye('cpToggle2', 'cpEye2', 'cpConfirm');

    // Form validation
    document.getElementById('cpForm').addEventListener('submit', function(e) {
        const pass = document.getElementById('cpPassword');
        const confirm = document.getElementById('cpConfirm');
        const passErr = document.getElementById('cpPassErr');
        const confirmErr = document.getElementById('cpConfirmErr');
        let valid = true;

        if (!pass.value.trim()) {
            passErr.style.display = 'block';
            pass.closest('.cp-input-wrap').style.borderColor = '#dc2626';
            valid = false;
        } else {
            passErr.style.display = 'none';
            pass.closest('.cp-input-wrap').style.borderColor = '';
        }

        if (!confirm.value.trim() || pass.value !== confirm.value) {
            confirmErr.style.display = 'block';
            confirm.closest('.cp-input-wrap').style.borderColor = '#dc2626';
            valid = false;
        } else {
            confirmErr.style.display = 'none';
            confirm.closest('.cp-input-wrap').style.borderColor = '';
        }

        if (!valid) e.preventDefault();
    });

    // Live confirm check
    document.getElementById('cpConfirm').addEventListener('input', function() {
        const pass = document.getElementById('cpPassword').value;
        const confirmErr = document.getElementById('cpConfirmErr');
        if (this.value === pass) {
            confirmErr.style.display = 'none';
            this.closest('.cp-input-wrap').style.borderColor = '';
        }
    });
</script>