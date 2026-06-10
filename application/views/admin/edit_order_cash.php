<div class="page-wrapper">
    <div class="page-content">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

            :root {
                --primary: #4361ee;
                --primary-dark: #3a56d4;
                --primary-light: rgba(67, 97, 238, 0.08);
                --primary-glow: rgba(67, 97, 238, 0.15);
                --accent: #7209b7;
                --success: #06d6a0;
                --success-dark: #05b88a;
                --warning: #ff9f1c;
                --text: #1a1d2e;
                --text-secondary: #4a4f6a;
                --text-muted: #8b90a8;
                --border: #e8eaf2;
                --border-light: #f1f3f8;
                --bg-card: #ffffff;
                --shadow-xs: 0 1px 3px rgba(0, 0, 0, 0.04);
                --shadow-sm: 0 2px 12px rgba(0, 0, 0, 0.06);
                --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
                --radius: 14px;
                --radius-lg: 18px;
                --radius-xl: 22px;
            }

            .edit-page * {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                box-sizing: border-box;
            }

            .edit-page {
                max-width: 820px;
                margin: 0 auto;
            }

            /* ═══ Hero Header ═══ */
            .edit-hero {
                background: linear-gradient(135deg, #4361ee 0%, #7209b7 50%, #560bad 100%);
                border-radius: var(--radius-xl);
                padding: 32px 36px;
                margin-bottom: 28px;
                color: #fff;
                position: relative;
                overflow: hidden;
            }

            .edit-hero::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -20%;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
                border-radius: 50%;
            }

            .edit-hero::after {
                content: '';
                position: absolute;
                bottom: -40%;
                left: 5%;
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
                border-radius: 50%;
            }

            .edit-hero-inner {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 20px;
            }

            .edit-hero-breadcrumb {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 12px;
                flex-wrap: wrap;
            }

            .edit-hero-breadcrumb a,
            .edit-hero-breadcrumb span {
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: color 0.2s;
            }

            .edit-hero-breadcrumb a {
                color: rgba(255, 255, 255, 0.65);
            }

            .edit-hero-breadcrumb a:hover {
                color: #fff;
            }

            .edit-hero-breadcrumb .bc-sep {
                color: rgba(255, 255, 255, 0.35);
                font-size: 11px;
            }

            .edit-hero-breadcrumb .bc-active {
                color: rgba(255, 255, 255, 0.9);
            }

            .edit-hero h1 {
                font-size: 26px;
                font-weight: 800;
                margin: 0 0 6px;
                letter-spacing: -0.5px;
            }

            .edit-hero-sub {
                margin: 0;
                opacity: 0.7;
                font-size: 14px;
                font-weight: 500;
            }

            .edit-hero-back {
                padding: 11px 24px;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.2);
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .edit-hero-back:hover {
                background: rgba(255, 255, 255, 0.22);
                transform: translateY(-1px);
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
                color: #fff;
            }

            .edit-hero-back i {
                font-size: 18px;
                transition: transform 0.2s;
            }

            .edit-hero-back:hover i {
                transform: translateX(-3px);
            }

            /* ═══ Form Card ═══ */
            .edit-form-card {
                background: var(--bg-card);
                border-radius: var(--radius-lg);
                border: 1px solid var(--border);
                box-shadow: var(--shadow-xs);
                overflow: hidden;
                transition: box-shadow 0.3s;
            }

            .edit-form-card:hover {
                box-shadow: var(--shadow-md);
            }

            .edit-form-header {
                padding: 24px 32px;
                border-bottom: 1px solid var(--border-light);
                display: flex;
                align-items: center;
                gap: 14px;
                background: linear-gradient(135deg, rgba(67, 97, 238, 0.02), transparent);
            }

            .edit-form-header-icon {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                background: linear-gradient(135deg, var(--primary), var(--accent));
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                color: #fff;
                box-shadow: 0 4px 14px rgba(67, 97, 238, 0.3);
                flex-shrink: 0;
            }

            .edit-form-header-text h3 {
                margin: 0 0 2px;
                font-size: 18px;
                font-weight: 700;
                color: var(--text);
                letter-spacing: -0.3px;
            }

            .edit-form-header-text p {
                margin: 0;
                font-size: 13px;
                color: var(--text-muted);
                font-weight: 500;
            }

            .edit-form-body {
                padding: 32px;
            }

            /* ═══ Form Grid ═══ */
            .edit-form-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 24px;
            }

            .edit-form-grid .form-full {
                grid-column: 1 / -1;
            }

            /* ═══ Form Group ═══ */
            .edit-fg {
                position: relative;
            }

            .edit-fg-label {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 8px;
                font-size: 13px;
                font-weight: 600;
                color: var(--text-secondary);
            }

            .edit-fg-label i {
                font-size: 16px;
                color: var(--primary);
                opacity: 0.6;
            }

            .edit-fg-label .required {
                color: #ef4444;
                font-size: 14px;
                line-height: 1;
            }

            .edit-fg-input-wrap {
                position: relative;
            }

            .edit-fg-input-wrap .input-icon {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 18px;
                color: var(--text-muted);
                transition: color 0.3s;
                pointer-events: none;
                z-index: 2;
            }

            .edit-fg-input-wrap .currency-symbol {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 15px;
                font-weight: 700;
                color: var(--text-muted);
                transition: color 0.3s;
                pointer-events: none;
                z-index: 2;
            }

            .edit-fg-input {
                width: 100%;
                padding: 14px 18px 14px 48px;
                border: 1.5px solid var(--border);
                border-radius: 12px;
                font-size: 14px;
                font-weight: 500;
                color: var(--text);
                background: var(--bg-card);
                transition: all 0.3s ease;
                outline: none;
                font-family: 'Inter', sans-serif;
            }

            .edit-fg-input::placeholder {
                color: var(--text-muted);
                font-weight: 400;
            }

            .edit-fg-input:hover {
                border-color: #d0d4e4;
            }

            .edit-fg-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 4px var(--primary-light);
                background: #fff;
            }

            .edit-fg-input:focus~.input-icon,
            .edit-fg-input:focus~.currency-symbol {
                color: var(--primary);
            }

            .edit-fg-hint {
                margin-top: 6px;
                font-size: 12px;
                color: var(--text-muted);
                font-weight: 400;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .edit-fg-hint i {
                font-size: 14px;
            }

            /* ═══ Divider ═══ */
            .edit-form-divider {
                grid-column: 1 / -1;
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 4px 0;
            }

            .edit-form-divider::before,
            .edit-form-divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: var(--border-light);
            }

            .edit-form-divider span {
                font-size: 11px;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 1px;
                white-space: nowrap;
            }

            /* ═══ Form Footer ═══ */
            .edit-form-footer {
                padding: 24px 32px;
                border-top: 1px solid var(--border-light);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                background: linear-gradient(135deg, #fafbff, #f8f9fe);
            }

            .edit-form-footer-hint {
                font-size: 13px;
                color: var(--text-muted);
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .edit-form-footer-hint i {
                font-size: 16px;
                color: var(--warning);
            }

            .edit-form-actions {
                display: flex;
                gap: 12px;
            }

            .edit-btn {
                padding: 12px 28px;
                border-radius: 12px;
                font-size: 14px;
                font-weight: 700;
                font-family: 'Inter', sans-serif;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                text-decoration: none;
                border: none;
            }

            .edit-btn-cancel {
                background: var(--bg-card);
                color: var(--text-secondary);
                border: 1.5px solid var(--border);
            }

            .edit-btn-cancel:hover {
                background: #f5f6fa;
                border-color: #d0d4e4;
                color: var(--text);
            }

            .edit-btn-save {
                background: linear-gradient(135deg, var(--primary), var(--accent));
                color: #fff;
                box-shadow: 0 4px 16px rgba(67, 97, 238, 0.3);
            }

            .edit-btn-save:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
            }

            .edit-btn-save:active {
                transform: translateY(0);
                box-shadow: 0 4px 16px rgba(67, 97, 238, 0.3);
            }

            .edit-btn-save i,
            .edit-btn-cancel i {
                font-size: 18px;
            }

            /* ═══ Current Values Preview ═══ */
            .edit-preview-strip {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 16px;
                margin-bottom: 28px;
            }

            .edit-preview-item {
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                padding: 18px 20px;
                text-align: center;
                box-shadow: var(--shadow-xs);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .edit-preview-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                border-radius: 3px 3px 0 0;
            }

            .edit-preview-item:nth-child(1)::before {
                background: linear-gradient(90deg, #4361ee, #818cf8);
            }

            .edit-preview-item:nth-child(2)::before {
                background: linear-gradient(90deg, #7209b7, #a855f7);
            }

            .edit-preview-item:nth-child(3)::before {
                background: linear-gradient(90deg, #06d6a0, #34d399);
            }

            .edit-preview-item:nth-child(4)::before {
                background: linear-gradient(90deg, #ff9f1c, #fbbf24);
            }

            .edit-preview-item:hover {
                box-shadow: var(--shadow-sm);
                transform: translateY(-2px);
            }

            .edit-preview-icon {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                margin: 0 auto 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
            }

            .edit-preview-item:nth-child(1) .edit-preview-icon {
                background: var(--primary-light);
                color: var(--primary);
            }

            .edit-preview-item:nth-child(2) .edit-preview-icon {
                background: rgba(114, 9, 183, 0.08);
                color: var(--accent);
            }

            .edit-preview-item:nth-child(3) .edit-preview-icon {
                background: rgba(6, 214, 160, 0.08);
                color: var(--success-dark);
            }

            .edit-preview-item:nth-child(4) .edit-preview-icon {
                background: rgba(255, 159, 28, 0.08);
                color: var(--warning);
            }

            .edit-preview-label {
                font-size: 11px;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.6px;
                margin-bottom: 4px;
            }

            .edit-preview-value {
                font-size: 14px;
                font-weight: 700;
                color: var(--text);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* ═══ Responsive ═══ */
            @media (max-width: 768px) {
                .edit-hero {
                    padding: 24px 22px;
                    border-radius: var(--radius-lg);
                }

                .edit-hero h1 {
                    font-size: 22px;
                }

                .edit-hero-inner {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .edit-form-grid {
                    grid-template-columns: 1fr;
                }

                .edit-preview-strip {
                    grid-template-columns: 1fr 1fr;
                }

                .edit-form-body {
                    padding: 24px 20px;
                }

                .edit-form-header {
                    padding: 20px;
                }

                .edit-form-footer {
                    padding: 20px;
                    flex-direction: column;
                    align-items: stretch;
                }

                .edit-form-actions {
                    justify-content: stretch;
                }

                .edit-form-actions .edit-btn {
                    flex: 1;
                    justify-content: center;
                }
            }

            @media (max-width: 480px) {
                .edit-preview-strip {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="edit-page">

            <!-- ═══ Hero Header ═══ -->
            <div class="edit-hero">
                <div class="edit-hero-inner">
                    <div>
                        <div class="edit-hero-breadcrumb">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i> Dashboard</a>
                            <span class="bc-sep">›</span>
                            <a href="<?= base_url('index.php/admin/orders'); ?>">Orders</a>
                            <span class="bc-sep">›</span>
                            <span class="bc-active">Edit Order</span>
                        </div>
                        <h1>Edit Cash Order</h1>
                        <p class="edit-hero-sub">Update order details for <?= htmlspecialchars($order->product_name) ?>
                        </p>
                    </div>
                    <a href="<?= base_url('index.php/admin/orders'); ?>" class="edit-hero-back">
                        <i class="bx bx-arrow-back"></i> Back to Orders
                    </a>
                </div>
            </div>

            <!-- ═══ Current Values Preview ═══ -->
            <div class="edit-preview-strip">
                <div class="edit-preview-item">
                    <div class="edit-preview-icon"><i class="bx bx-package"></i></div>
                    <div class="edit-preview-label">Product</div>
                    <div class="edit-preview-value"><?= htmlspecialchars($order->product_name) ?></div>
                </div>
                <div class="edit-preview-item">
                    <div class="edit-preview-icon"><i class="bx bx-chip"></i></div>
                    <div class="edit-preview-label">Model</div>
                    <div class="edit-preview-value"><?= htmlspecialchars($order->product_modal) ?></div>
                </div>
                <div class="edit-preview-item">
                    <div class="edit-preview-icon"><i class="bx bx-rupee"></i></div>
                    <div class="edit-preview-label">Price</div>
                    <div class="edit-preview-value">₹<?= number_format((float) $order->price, 2) ?></div>
                </div>
                <div class="edit-preview-item">
                    <div class="edit-preview-icon"><i class="bx bx-wallet"></i></div>
                    <div class="edit-preview-label">Down Payment</div>
                    <div class="edit-preview-value">
                        <?= !empty($order->down_payment) ? '₹' . number_format((float) $order->down_payment, 2) : '—' ?>
                    </div>
                </div>
            </div>

            <!-- ═══ Edit Form Card ═══ -->
            <form method="post" action="<?= base_url('index.php/admin/orders/update_order') ?>" id="editOrderForm">
                <input type="hidden" name="id" value="<?= $order->id ?>">

                <div class="edit-form-card">
                    <div class="edit-form-header">
                        <div class="edit-form-header-icon">
                            <i class="bx bx-edit-alt"></i>
                        </div>
                        <div class="edit-form-header-text">
                            <h3>Order Details</h3>
                            <p>Modify the fields below and save your changes</p>
                        </div>
                    </div>

                    <div class="edit-form-body">
                        <div class="edit-form-grid">

                            <!-- Product Name -->
                            <div class="edit-fg">
                                <label class="edit-fg-label">
                                    <i class="bx bx-package"></i>
                                    Product Name
                                    <span class="required">*</span>
                                </label>
                                <div class="edit-fg-input-wrap">
                                    <input type="text" name="product_name"
                                        value="<?= htmlspecialchars($order->product_name) ?>" class="edit-fg-input"
                                        placeholder="Enter product name" required>
                                    <i class="bx bx-cube input-icon"></i>
                                </div>
                            </div>

                            <!-- Model -->
                            <div class="edit-fg">
                                <label class="edit-fg-label">
                                    <i class="bx bx-chip"></i>
                                    Model Number
                                    <span class="required">*</span>
                                </label>
                                <div class="edit-fg-input-wrap">
                                    <input type="text" name="modal_numb"
                                        value="<?= htmlspecialchars($order->product_modal) ?>" class="edit-fg-input"
                                        placeholder="Enter model number" required>
                                    <i class="bx bx-hash input-icon"></i>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="edit-form-divider">
                                <span>Payment Details</span>
                            </div>

                            <!-- Price -->
                            <div class="edit-fg">
                                <label class="edit-fg-label">
                                    <i class="bx bx-rupee"></i>
                                    Price
                                    <span class="required">*</span>
                                </label>
                                <div class="edit-fg-input-wrap">
                                    <input type="number" name="price" value="<?= $order->price ?>" class="edit-fg-input"
                                        placeholder="0.00" min="0" step="0.01" required>
                                    <span class="currency-symbol">₹</span>
                                </div>
                                <div class="edit-fg-hint">
                                    <i class="bx bx-info-circle"></i>
                                    Total product price in INR
                                </div>
                            </div>

                            <!-- Down Payment -->
                            <div class="edit-fg">
                                <label class="edit-fg-label">
                                    <i class="bx bx-wallet"></i>
                                    Down Payment
                                </label>
                                <div class="edit-fg-input-wrap">
                                    <input type="number" name="down_payment" value="<?= $order->down_payment ?>"
                                        class="edit-fg-input" placeholder="0.00" min="0" step="0.01">
                                    <span class="currency-symbol">₹</span>
                                </div>
                                <div class="edit-fg-hint">
                                    <i class="bx bx-info-circle"></i>
                                    Initial payment amount (optional)
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="edit-form-footer">
                        <div class="edit-form-footer-hint">
                            <i class="bx bx-error-circle"></i>
                            Fields marked with <span class="required" style="color:#ef4444; font-weight:700;">*</span>
                            are required
                        </div>
                        <div class="edit-form-actions">
                            <a href="<?= base_url('index.php/admin/orders'); ?>" class="edit-btn edit-btn-cancel">
                                <i class="bx bx-x"></i> Cancel
                            </a>
                            <button type="submit" class="edit-btn edit-btn-save"
                                onclick="return confirm('Are you sure you want to update this order?')">
                                <i class="bx bx-check"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>