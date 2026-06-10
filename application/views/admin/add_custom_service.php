<div class="page-wrapper">
    <div class="page-content">
        <style>
            .acs-wrap {
                max-width: 960px;
                margin: 0 auto;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .acs-hero {
                background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 30%, #0d9488 100%);
                color: #fff;
                border-radius: 24px;
                padding: 32px 36px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }

            .acs-hero h1 {
                margin: 0 0 8px;
                font-size: 30px;
                font-weight: 900;
            }

            .acs-hero a {
                color: #fff;
                text-decoration: none;
                border: 1px solid rgba(255, 255, 255, 0.22);
                border-radius: 12px;
                padding: 10px 16px;
                font-weight: 700;
                background: rgba(255, 255, 255, 0.1);
            }

            .acs-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
                overflow: hidden;
            }

            .acs-card h3 {
                margin: 0;
                padding: 18px 22px;
                border-bottom: 1px solid #eef2f7;
                font-size: 17px;
            }

            .acs-form {
                padding: 24px 22px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 18px;
            }

            .acs-field {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .acs-field.full {
                grid-column: 1 / -1;
            }

            .acs-field label {
                font-size: 13px;
                font-weight: 700;
                color: #334155;
            }

            .acs-field select,
            .acs-field input {
                width: 100%;
                border: 1.5px solid #dbe2ea;
                border-radius: 12px;
                padding: 12px 14px;
                font-size: 14px;
                outline: none;
                background: #f8fafc;
            }

            .acs-field select:focus,
            .acs-field input:focus {
                border-color: #8b5cf6;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.08);
            }

            .acs-help {
                font-size: 12px;
                color: #64748b;
            }

            .acs-actions {
                padding: 0 22px 24px;
                display: flex;
                justify-content: flex-end;
                gap: 12px;
            }

            .acs-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 18px;
                border-radius: 12px;
                font-weight: 700;
                text-decoration: none;
                border: 0;
                cursor: pointer;
            }

            .acs-btn.secondary {
                background: #f1f5f9;
                color: #334155;
            }

            .acs-btn.primary {
                background: linear-gradient(135deg, #7c3aed, #0d9488);
                color: #fff;
            }

            @media (max-width: 768px) {
                .acs-form {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="acs-wrap">

            <div class="acs-card">
                <h3>Custom Service Form</h3>
                <form action="<?= site_url('admin/service/save') ?>" method="post">
                    <div class="acs-form">
                        <div class="acs-field">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" required
                                placeholder="Enter customer name">
                        </div>

                        <div class="acs-field">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" required placeholder="Enter mobile number">
                        </div>

                        <div class="acs-field">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" required placeholder="Enter address">
                        </div>

                        <div class="acs-field">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" required
                                placeholder="Enter product name">
                        </div>

                        <div class="acs-field">
                            <label for="total_services">Total Service</label>
                            <input type="number" name="total_services" id="total_services" min="1" required
                                placeholder="Enter total services">
                        </div>

                        <div class="acs-field">
                            <label for="service_interval">Service Interval</label>
                            <input type="number" name="service_interval" id="service_interval" min="1" required
                                placeholder="Enter interval in months">
                        </div>

                        <div class="acs-field">
                            <label for="start_service_date">Start Service Date</label>
                            <input type="date" name="start_service_date" id="start_service_date" required
                                value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="acs-field full">
                            <div class="acs-help">
                                Service dates will be created from the selected start date using the interval in months.
                            </div>
                        </div>
                    </div>

                    <div class="acs-actions">
                        <a href="<?= site_url('admin/service') ?>" class="acs-btn secondary">Cancel</a>
                        <button type="submit" class="acs-btn primary">Save Custom Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>