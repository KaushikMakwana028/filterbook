<style>
    .cp-page {
        max-width: 760px;
        margin: 28px auto;
        padding: 0 18px;
    }

    .cp-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 34px rgba(15, 23, 42, 0.06);
    }

    .cp-hero {
        padding: 28px 28px 24px;
        background: linear-gradient(135deg, #1e88e5 0%, #1565c0 55%, #00a6a6 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .cp-hero::before,
    .cp-hero::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
    }

    .cp-hero::before {
        width: 180px;
        height: 180px;
        top: -70px;
        right: -40px;
    }

    .cp-hero::after {
        width: 120px;
        height: 120px;
        bottom: -40px;
        left: -20px;
    }

    .cp-hero-content {
        position: relative;
        z-index: 1;
    }

    .cp-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.14);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .cp-hero h2 {
        margin: 0 0 8px;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .cp-hero p {
        margin: 0;
        max-width: 560px;
        font-size: 0.98rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .cp-body {
        padding: 26px 28px 30px;
    }

    .cp-alert {
        border-radius: 16px;
        padding: 14px 16px;
        font-weight: 600;
        margin-bottom: 18px;
        border: 1px solid transparent;
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

    .cp-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 16px;
        background: #f8fbff;
        border: 1px solid #d9e8fb;
        color: #51627b;
        margin-bottom: 20px;
    }

    .cp-info-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f2ff;
        color: #1e88e5;
        font-size: 20px;
        flex-shrink: 0;
    }

    .cp-info strong {
        color: #122033;
    }

    .cp-form .form-label {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .cp-form .form-control {
        height: 52px;
        border-radius: 14px;
        border: 1px solid #dce6f2;
        background: #fbfdff;
        box-shadow: none;
        transition: all 0.2s ease;
    }

    .cp-form .form-control:focus {
        border-color: rgba(30, 136, 229, 0.45);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(30, 136, 229, 0.08);
    }

    .cp-form .input-group {
        border-radius: 14px;
        overflow: hidden;
    }

    .cp-form .input-group-text {
        border: 1px solid #dce6f2;
        border-left: 0;
        background: #fbfdff;
        color: #64748b;
        padding-inline: 16px;
        cursor: pointer;
    }

    .cp-form .input-group .form-control {
        border-right: 0;
    }

    .cp-actions {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .cp-btn {
        height: 50px;
        border-radius: 14px;
        padding: 0 22px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .cp-btn-primary {
        background: linear-gradient(135deg, #1e88e5, #1565c0);
        color: #fff;
        border: none;
        box-shadow: 0 14px 28px rgba(30, 136, 229, 0.18);
    }

    .cp-btn-primary:hover {
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 18px 32px rgba(30, 136, 229, 0.22);
    }

    .cp-btn-secondary {
        background: #fff;
        color: #475569;
        border: 1px solid #dce6f2;
    }

    .cp-btn-secondary:hover {
        color: #1e293b;
        background: #f8fafc;
    }

    @media (max-width: 768px) {
        .cp-page {
            padding: 0 12px;
        }

        .cp-hero {
            padding: 22px 20px 18px;
        }

        .cp-hero h2 {
            font-size: 1.6rem;
        }

        .cp-body {
            padding: 20px 18px 22px;
        }

        .cp-actions {
            flex-direction: column;
        }

        .cp-btn {
            width: 100%;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="cp-page">
            <div class="cp-card">
                <!-- <div class="cp-hero">
                    <div class="cp-hero-content">
                        <div class="cp-badge">
                            <i class="bx bx-shield-quarter"></i>
                            Security
                        </div>
                        <h2>Change Password</h2>
                        <p>Dashboard ke andar hi apna password direct update kijiye.</p>
                    </div>
                </div> -->

                <div class="cp-body">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="cp-alert success"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="cp-alert error"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <form class="row g-3 cp-form needs-validation" action="<?= site_url('change_password/update') ?>"
                        method="post" novalidate>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">New Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" id="inputChoosePassword" name="password"
                                    placeholder="Enter new password" required>
                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                        class="bx bx-hide"></i></a>
                            </div>
                            <div class="invalid-feedback">Please enter a new password.</div>
                        </div>

                        <div class="col-12">
                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group" id="show_hide_password_confirm">
                                <input type="password" class="form-control" id="inputConfirmPassword"
                                    name="confirm_password" placeholder="Confirm new password" required>
                                <a href="javascript:;" class="input-group-text bg-transparent"><i
                                        class="bx bx-hide"></i></a>
                            </div>
                            <div class="invalid-feedback">Confirm password must match the new password.</div>
                        </div>

                        <div class="col-12">
                            <div class="cp-actions">
                                <button type="submit" class="cp-btn cp-btn-primary">
                                    <i class="bx bx-check-shield"></i>
                                    Update Password
                                </button>
                                <a href="<?= site_url('admin/dashboard') ?>" class="cp-btn cp-btn-secondary">
                                    <i class="bx bx-arrow-back"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const form = document.querySelector('.needs-validation');
        const passwordInput = document.getElementById('inputChoosePassword');
        const confirmPasswordInput = document.getElementById('inputConfirmPassword');

        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            const input = $('#show_hide_password input');
            const icon = $('#show_hide_password i');
            if (input.attr("type") === "text") {
                input.attr('type', 'password');
                icon.addClass("bx-hide").removeClass("bx-show");
            } else {
                input.attr('type', 'text');
                icon.removeClass("bx-hide").addClass("bx-show");
            }
        });

        $("#show_hide_password_confirm a").on('click', function (event) {
            event.preventDefault();
            const input = $('#show_hide_password_confirm input');
            const icon = $('#show_hide_password_confirm i');
            if (input.attr("type") === "text") {
                input.attr('type', 'password');
                icon.addClass("bx-hide").removeClass("bx-show");
            } else {
                input.attr('type', 'text');
                icon.removeClass("bx-hide").addClass("bx-show");
            }
        });

        form.addEventListener('submit', function (event) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('Passwords do not match');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);

        confirmPasswordInput.addEventListener('input', function () {
            if (passwordInput.value === confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity('');
            }
        });
    });
</script>