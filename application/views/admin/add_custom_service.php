<div class="page-wrapper">
    <div class="page-content">
        <style>
            /* ══════════════════════════════════════
   Color Fix — Match site primary + full width
══════════════════════════════════════ */
            .acs-wrap {
                max-width: 100% !important;
            }

            .acs-card {
                max-width: 860px;
                margin: 0 auto;
            }

            .acs-field select:focus,
            .acs-field input:focus {
                border-color: var(--primary, #6366f1) !important;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08) !important;
            }

            .acs-btn.primary {
                background: linear-gradient(135deg, var(--primary, #6366f1), var(--primary-dark, #4f46e5)) !important;
            }

            /* Back button */
            .acs-hero a:hover {
                background: rgba(255, 255, 255, 0.2) !important;
                color: #fff !important;
                text-decoration: none !important;
            }

            /* ══════════════════════════════════════
   DARK THEME — Service Add Page
══════════════════════════════════════ */
            [data-theme="dark"] .acs-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                box-shadow: none !important;
            }

            [data-theme="dark"] .acs-card h3 {
                color: var(--text-primary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .acs-field label {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .acs-field input,
            [data-theme="dark"] .acs-field select {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .acs-field input:focus,
            [data-theme="dark"] .acs-field select:focus {
                background: var(--bg-secondary) !important;
                border-color: var(--primary) !important;
            }

            [data-theme="dark"] .acs-field input::placeholder {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .acs-help {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .acs-btn.secondary {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .acs-btn.secondary:hover {
                background: var(--bg-primary) !important;
                color: var(--text-primary) !important;
            }
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

            /* Suggestion Dropdown CSS */
            .acs-field {
                position: relative;
            }
            .customer-suggestions-list {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                max-height: 250px;
                overflow-y: auto;
                background: #ffffff;
                border: 1.5px solid #dbe2ea;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                z-index: 1000;
                margin-top: 4px;
                padding: 6px 0;
                display: none;
            }

            [data-theme="dark"] .customer-suggestions-list {
                background: var(--bg-secondary, #1e293b);
                border-color: var(--border-color, #334155);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            }

            .customer-suggestion-item {
                padding: 10px 16px;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                gap: 2px;
                transition: background-color 0.2s ease;
            }

            .customer-suggestion-item:hover {
                background-color: #f1f5f9;
            }

            [data-theme="dark"] .customer-suggestion-item:hover {
                background-color: var(--bg-tertiary, #334155);
            }

            .customer-suggestion-name {
                font-size: 14px;
                font-weight: 600;
                color: #0f172a;
            }

            [data-theme="dark"] .customer-suggestion-name {
                color: var(--text-primary, #f8fafc);
            }

            .customer-suggestion-details {
                font-size: 12px;
                color: #64748b;
                display: flex;
                gap: 12px;
            }

            [data-theme="dark"] .customer-suggestion-details {
                color: var(--text-secondary, #94a3b8);
            }
        </style>

        <div class="acs-wrap">

            <div class="acs-card">
                <h3>Custom Service Form</h3>
                <form action="<?= site_url('admin/service/save') ?>" method="post">
                    <input type="hidden" name="customer_id" id="customer_id" value="">
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

<script>
$(document).ready(function() {
    var nameInput = $('#customer_name');
    var mobileInput = $('#mobile');
    var addressInput = $('#address');
    
    var nameSuggestions = $('<div class="customer-suggestions-list"></div>');
    var mobileSuggestions = $('<div class="customer-suggestions-list"></div>');
    
    nameInput.after(nameSuggestions);
    mobileInput.after(mobileSuggestions);
    
    var searchUrl = "<?= site_url('admin/service/search_customers') ?>";
    var timer = null;

    function handleSearch(input, dropdown) {
        var query = input.val().trim();
        if (query.length < 2) {
            dropdown.hide().empty();
            return;
        }

        clearTimeout(timer);
        timer = setTimeout(function() {
            $.ajax({
                url: searchUrl,
                type: 'GET',
                data: { q: query },
                dataType: 'json',
                success: function(data) {
                    dropdown.empty();
                    if (data.length > 0) {
                        data.forEach(function(cust) {
                            var item = $('<div class="customer-suggestion-item"></div>');
                            item.append('<div class="customer-suggestion-name">' + cust.name + '</div>');
                            item.append('<div class="customer-suggestion-details"><span><i class="bx bx-phone"></i> ' + cust.mobile + '</span><span><i class="bx bx-map"></i> ' + (cust.address || 'N/A') + '</span></div>');
                            
                            item.on('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                
                                $('#customer_id').val(cust.id);
                                nameInput.val(cust.name);
                                mobileInput.val(cust.mobile);
                                addressInput.val(cust.address || '');
                                
                                $('.customer-suggestions-list').hide().empty();
                            });
                            dropdown.append(item);
                        });
                        dropdown.show();
                    } else {
                        dropdown.hide();
                    }
                }
            });
        }, 250);
    }

    nameInput.on('input', function() {
        $('#customer_id').val('');
        handleSearch(nameInput, nameSuggestions);
    });

    mobileInput.on('input', function() {
        $('#customer_id').val('');
        handleSearch(mobileInput, mobileSuggestions);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.acs-field').length) {
            $('.customer-suggestions-list').hide();
        }
    });
});
</script>