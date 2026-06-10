<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

            :root {
                --ec-primary: #6366f1;
                --ec-primary-dark: #4f46e5;
                --ec-secondary: #0d9488;
                --ec-text: #0f172a;
                --ec-muted: #64748b;
                --ec-border: #e2e8f0;
                --ec-border-light: #f1f5f9;
                --ec-white: #ffffff;
                --ec-bg: #f8fafc;
                --ec-danger: #dc2626;
                --ec-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
                --ec-shadow-md: 0 18px 40px rgba(15, 23, 42, 0.12);
                --ec-radius: 20px;
                --ec-radius-sm: 12px;
                --ec-transition: all 0.2s ease;
            }

            [data-theme="dark"] .ec-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                box-shadow: none !important;
            }

            [data-theme="dark"] .ec-card-header {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .ec-card-header h3 {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .ec-card-header span {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            /* Form fields */
            [data-theme="dark"] .ec-field label {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .ec-field input,
            [data-theme="dark"] .ec-field textarea {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .ec-field input:focus,
            [data-theme="dark"] .ec-field textarea:focus {
                background: var(--bg-secondary) !important;
                border-color: var(--primary) !important;
            }

            [data-theme="dark"] .ec-field input::placeholder,
            [data-theme="dark"] .ec-field textarea::placeholder {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .ec-help {
                color: var(--text-tertiary) !important;
            }

            /* Cancel button */
            [data-theme="dark"] .ec-cancel-btn {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .ec-cancel-btn:hover {
                background: var(--bg-primary) !important;
                color: var(--text-primary) !important;
            }

            /* Alert */
            [data-theme="dark"] .ec-alert.error {
                background: rgba(220, 38, 38, 0.1) !important;
                border-color: rgba(220, 38, 38, 0.2) !important;
            }

            .ec-wrap {
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 auto;
            }

            .ec-hero {
                background: linear-gradient(135deg, #4f46e5 0%, #6366f1 35%, #0d9488 100%);
                border-radius: 24px;
                padding: 36px 40px;
                color: #fff;
                margin-bottom: 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                flex-wrap: wrap;
                position: relative;
                overflow: hidden;
            }

            .ec-hero::before {
                content: '';
                position: absolute;
                top: -40%;
                right: -8%;
                width: 260px;
                height: 260px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.07);
            }

            .ec-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                border-radius: 999px;
                padding: 6px 14px;
                background: rgba(255, 255, 255, 0.14);
                border: 1px solid rgba(255, 255, 255, 0.15);
                font-size: 12px;
                font-weight: 700;
                margin-bottom: 12px;
            }

            .ec-hero h1 {
                margin: 0 0 8px;
                font-size: 30px;
                font-weight: 900;
                letter-spacing: -0.02em;
            }

            .ec-hero p {
                margin: 0;
                font-size: 14px;
                opacity: 0.88;
            }

            .ec-hero-actions {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
                position: relative;
                z-index: 1;
            }

            .ec-link-btn,
            .ec-submit-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                min-height: 46px;
                padding: 0 20px;
                border-radius: 14px;
                text-decoration: none;
                font-size: 14px;
                font-weight: 700;
                transition: var(--ec-transition);
                border: 1px solid transparent;
                cursor: pointer;
            }

            .ec-link-btn {
                color: #fff;
                background: rgba(255, 255, 255, 0.12);
                border-color: rgba(255, 255, 255, 0.2);
            }

            .ec-link-btn:hover {
                color: #fff;
                text-decoration: none;
                background: rgba(255, 255, 255, 0.2);
            }

            .ec-card {
                background: var(--ec-white);
                border: 1px solid var(--ec-border);
                border-radius: var(--ec-radius);
                box-shadow: var(--ec-shadow);
                overflow: hidden;
            }

            .ec-card-header {
                padding: 22px 26px;
                border-bottom: 1px solid var(--ec-border-light);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                flex-wrap: wrap;
            }

            .ec-card-header h3 {
                margin: 0;
                font-size: 18px;
                font-weight: 800;
                color: var(--ec-text);
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .ec-card-header span {
                font-size: 12px;
                font-weight: 700;
                color: var(--ec-muted);
                background: var(--ec-border-light);
                border-radius: 999px;
                padding: 5px 12px;
            }

            .ec-form {
                padding: 26px;
            }

            .ec-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .ec-field.full {
                grid-column: 1 / -1;
            }

            .ec-field label {
                display: block;
                margin-bottom: 8px;
                font-size: 13px;
                font-weight: 700;
                color: var(--ec-text);
            }

            .ec-field input,
            .ec-field textarea {
                width: 100%;
                border: 1.5px solid var(--ec-border);
                border-radius: var(--ec-radius-sm);
                background: var(--ec-bg);
                color: var(--ec-text);
                padding: 13px 14px;
                font-size: 14px;
                font-family: inherit;
                outline: none;
                transition: var(--ec-transition);
            }

            .ec-field textarea {
                min-height: 120px;
                resize: vertical;
            }

            .ec-field input:focus,
            .ec-field textarea:focus {
                border-color: var(--ec-primary);
                background: #fff;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
            }

            .ec-help {
                margin-top: 8px;
                font-size: 12px;
                color: var(--ec-muted);
            }

            .ec-alert {
                margin: 0 26px 18px;
                padding: 14px 16px;
                border-radius: 14px;
                font-size: 13px;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .ec-alert.error {
                background: rgba(220, 38, 38, 0.08);
                color: var(--ec-danger);
                border: 1px solid rgba(220, 38, 38, 0.15);
            }

            .ec-actions {
                margin-top: 24px;
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 12px;
                flex-wrap: wrap;
            }

            .ec-cancel-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                min-height: 46px;
                padding: 0 18px;
                border-radius: 14px;
                text-decoration: none;
                font-size: 14px;
                font-weight: 700;
                color: var(--ec-muted);
                background: var(--ec-border-light);
                border: 1px solid var(--ec-border);
                transition: var(--ec-transition);
            }

            .ec-cancel-btn:hover {
                text-decoration: none;
                color: var(--ec-text);
                background: #eef2f7;
            }

            .ec-submit-btn {
                color: #fff;
                background: linear-gradient(135deg, var(--ec-primary), var(--ec-secondary));
                box-shadow: 0 10px 24px rgba(79, 70, 229, 0.2);
            }

            .ec-submit-btn:hover {
                transform: translateY(-1px);
                box-shadow: var(--ec-shadow-md);
            }

            @media (max-width: 768px) {
                .ec-wrap {
                    padding: 0 8px;
                }

                .ec-hero {
                    padding: 28px 24px;
                }

                .ec-grid {
                    grid-template-columns: 1fr;
                }

                .ec-form {
                    padding: 20px;
                }

                .ec-actions {
                    justify-content: stretch;
                }

                .ec-cancel-btn,
                .ec-submit-btn,
                .ec-link-btn {
                    width: 100%;
                }
            }
        </style>

        <div class="ec-wrap">
            <div class="ec-hero">
                <div>
                    <div class="ec-badge">
                        <i class="bx bx-edit"></i>
                        Customer Editor
                    </div>
                    <h1>Edit <?= htmlspecialchars($customer->name) ?></h1>
                    <p>Update customer profile details used across the order history.</p>
                </div>
                <div class="ec-hero-actions">
                    <a href="<?= site_url('admin/orders/customer/' . $customer->id) ?>" class="ec-link-btn">
                        <i class="bx bx-arrow-back"></i> Back to Details
                    </a>
                </div>
            </div>

            <div class="ec-card">
                <div class="ec-card-header">
                    <h3><i class="bx bx-user"></i> Customer Information</h3>
                    <span>ID #<?= (int) $customer->id ?></span>
                </div>

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="ec-alert error">
                        <i class="bx bx-error-circle"></i>
                        <?= htmlspecialchars($this->session->flashdata('error')) ?>
                    </div>
                <?php } ?>

                <form action="<?= site_url('admin/orders/update_customer/' . $customer->id) ?>" method="post" class="ec-form">
                    <div class="ec-grid">
                        <div class="ec-field">
                            <label for="customerName">Customer Name</label>
                            <input type="text" id="customerName" name="name" value="<?= htmlspecialchars($customer->name) ?>" required>
                        </div>

                        <div class="ec-field">
                            <label for="customerMobile">Mobile Number</label>
                            <input type="text" id="customerMobile" name="mobile" value="<?= htmlspecialchars($customer->mobile) ?>" required>
                            <div class="ec-help">Use a unique mobile number for this store.</div>
                        </div>

                        <div class="ec-field full">
                            <label for="customerAddress">Address</label>
                            <textarea id="customerAddress" name="address" placeholder="Enter customer address"><?= htmlspecialchars($customer->address) ?></textarea>
                        </div>
                    </div>

                    <div class="ec-actions">
                        <a href="<?= site_url('admin/orders/customer/' . $customer->id) ?>" class="ec-cancel-btn">
                            <i class="bx bx-x"></i> Cancel
                        </a>
                        <button type="submit" class="ec-submit-btn">
                            <i class="bx bx-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>