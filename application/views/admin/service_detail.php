<div class="page-wrapper">
    <div class="page-content">
        <style>
            .detail-page {
                max-width: 1080px;
                margin: 0 auto;
            }

            .detail-hero {
                background: linear-gradient(135deg, #0f766e, #1d4ed8);
                color: #fff;
                border-radius: 18px;
                padding: 28px 30px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }

            .detail-hero h1 {
                margin: 0 0 6px;
                font-size: 28px;
                font-weight: 800;
            }

            .detail-hero a {
                color: #fff;
                text-decoration: none;
                border: 1px solid rgba(255,255,255,0.25);
                padding: 10px 16px;
                border-radius: 10px;
                font-weight: 700;
            }

            .detail-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .detail-card {
                background: #fff;
                border: 1px solid #e5e7eb;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
            }

            .detail-card h3 {
                margin: 0;
                padding: 18px 20px;
                border-bottom: 1px solid #eef2f7;
                font-size: 16px;
            }

            .detail-row {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                padding: 14px 20px;
                border-bottom: 1px solid #f1f5f9;
            }

            .detail-row:last-child {
                border-bottom: 0;
            }

            .detail-label {
                color: #64748b;
                font-weight: 600;
            }

            .detail-value {
                text-align: right;
                font-weight: 700;
                color: #0f172a;
            }

            .detail-status {
                display: inline-flex;
                align-items: center;
                padding: 6px 12px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
            }

            .detail-status.pending {
                background: #fff7ed;
                color: #c2410c;
            }

            .detail-status.paid {
                background: #ecfdf5;
                color: #047857;
            }

            .detail-actions {
                margin-top: 24px;
            }

            .detail-primary-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 18px;
                border-radius: 12px;
                background: #16a34a;
                color: #fff;
                text-decoration: none;
                font-weight: 700;
            }

            @media (max-width: 768px) {
                .detail-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <?php
        $status = ((string) ($service->status ?? 0) === '1' || strtolower((string) ($service->status ?? '')) === 'done') ? 'paid' : 'pending';
        ?>

        <div class="detail-page">
            <div class="detail-hero" style="background: linear-gradient(135deg, #7c3aed, #0891b2);">
                <div>
                    <h1>Service Detail</h1>
                    <p>Scheduled service information and customer details.</p>
                </div>
                <a href="<?= site_url('admin/service') ?>">Back to Service List</a>
            </div>

            <div class="detail-grid">
                <div class="detail-card">
                    <h3>Customer Details</h3>
                    <div class="detail-row">
                        <div class="detail-label">Customer Name</div>
                        <div class="detail-value"><?= htmlspecialchars($service->customer_name ?? '-') ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile</div>
                        <div class="detail-value"><?= htmlspecialchars($service->customer_mobile ?? '-') ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Address</div>
                        <div class="detail-value"><?= htmlspecialchars($service->customer_address ?? '-') ?></div>
                    </div>
                </div>

                <div class="detail-card">
                    <h3>Service Details</h3>
                    <div class="detail-row">
                        <div class="detail-label">Product</div>
                        <div class="detail-value"><?= htmlspecialchars($service->product_name ?? '-') ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Service Number</div>
                        <div class="detail-value"><?= isset($service->service_number) ? (int) $service->service_number : '-' ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Service Date</div>
                        <div class="detail-value"><?= !empty($service->service_date) ? date('d M Y, h:i A', strtotime($service->service_date)) : '-' ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="detail-status <?= $status ?>">
                                <?= $status === 'paid' ? 'Done' : 'Pending' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($status !== 'paid'): ?>
                <div class="detail-actions">
                    <a href="<?= site_url('admin/service/mark_done/' . $service->id) ?>" class="detail-primary-btn"
                        onclick="return confirm('Mark this service as done?')">
                        Mark Done
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
