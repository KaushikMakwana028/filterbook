<div class="page-wrapper">
    <div class="page-content">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

            :root {
                --primary: #4f46e5;
                --primary-light: #818cf8;
                --primary-bg: rgba(79, 70, 229, 0.08);
                --success: #10b981;
                --success-bg: rgba(16, 185, 129, 0.1);
                --warning: #f59e0b;
                --warning-bg: rgba(245, 158, 11, 0.1);
                --danger: #ef4444;
                --dark: #1e293b;
                --text: #334155;
                --text-muted: #94a3b8;
                --border: #e2e8f0;
                --bg-page: #f8fafc;
                --bg-card: #ffffff;
                --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.06);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
                --shadow-lg: 0 10px 25px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
                --radius: 16px;
                --radius-sm: 10px;
                --radius-xs: 6px;
            }

            .ov-container {
                font-family: 'Inter', sans-serif;
                max-width: 1100px;
                margin: 0 auto;
                padding: 0;
            }

            /* ── Page Header ── */
            .ov-page-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 28px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .ov-page-header-left {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .ov-page-icon {
                width: 52px;
                height: 52px;
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                color: #fff;
                box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
            }

            .ov-page-title {
                font-size: 24px;
                font-weight: 800;
                color: var(--dark);
                margin: 0;
                letter-spacing: -0.5px;
            }

            .ov-page-subtitle {
                font-size: 13px;
                color: var(--text-muted);
                margin: 2px 0 0;
                font-weight: 500;
            }

            .ov-back-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 11px 22px;
                background: var(--bg-card);
                color: var(--text);
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .ov-back-btn:hover {
                background: var(--primary);
                color: #fff;
                border-color: var(--primary);
                box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
                transform: translateY(-1px);
            }

            .ov-back-btn i {
                font-size: 18px;
                transition: transform 0.2s;
            }

            .ov-back-btn:hover i {
                transform: translateX(-3px);
            }

            /* ── Main Grid ── */
            .ov-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 24px;
                margin-bottom: 28px;
            }

            /* ── Cards ── */
            .ov-card {
                background: var(--bg-card);
                border-radius: var(--radius);
                border: 1px solid var(--border);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
                transition: box-shadow 0.3s ease;
            }

            .ov-card:hover {
                box-shadow: var(--shadow-lg);
            }

            .ov-card-full {
                grid-column: 1 / -1;
            }

            .ov-card-header {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 20px 24px;
                border-bottom: 1px solid var(--border);
                background: linear-gradient(to right, rgba(79, 70, 229, 0.03), transparent);
            }

            .ov-card-header-icon {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
            }

            .ov-card-header-icon.blue {
                background: var(--primary-bg);
                color: var(--primary);
            }

            .ov-card-header-icon.green {
                background: var(--success-bg);
                color: var(--success);
            }

            .ov-card-header-icon.orange {
                background: var(--warning-bg);
                color: var(--warning);
            }

            .ov-card-header h5 {
                margin: 0;
                font-size: 16px;
                font-weight: 700;
                color: var(--dark);
                letter-spacing: -0.3px;
            }

            .ov-card-body {
                padding: 8px 0;
            }

            /* ── Detail Rows ── */
            .ov-detail-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 24px;
                transition: background 0.15s;
            }

            .ov-detail-row:hover {
                background: rgba(79, 70, 229, 0.02);
            }

            .ov-detail-row+.ov-detail-row {
                border-top: 1px solid #f1f5f9;
            }

            .ov-detail-label {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 13.5px;
                font-weight: 500;
                color: var(--text-muted);
            }

            .ov-detail-label i {
                font-size: 17px;
                color: var(--primary-light);
                opacity: 0.7;
            }

            .ov-detail-value {
                font-size: 14px;
                font-weight: 600;
                color: var(--dark);
                text-align: right;
            }

            /* ── Badges ── */
            .ov-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 5px 14px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.2px;
            }

            .ov-badge-success {
                background: var(--success-bg);
                color: var(--success);
            }

            .ov-badge-warning {
                background: var(--warning-bg);
                color: var(--warning);
            }

            .ov-badge-primary {
                background: var(--primary-bg);
                color: var(--primary);
            }

            .ov-badge-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                display: inline-block;
            }

            .ov-badge-success .ov-badge-dot {
                background: var(--success);
            }

            .ov-badge-warning .ov-badge-dot {
                background: var(--warning);
            }

            .ov-badge-primary .ov-badge-dot {
                background: var(--primary);
            }

            /* ── Price Highlight ── */
            .ov-price {
                font-size: 18px;
                font-weight: 800;
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* ── Service Table ── */
            .ov-table-wrap {
                overflow-x: auto;
            }

            .ov-table {
                width: 100%;
                border-collapse: collapse;
            }

            .ov-table thead th {
                padding: 14px 24px;
                font-size: 11.5px;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.8px;
                text-align: left;
                background: #fafbfd;
                border-bottom: 1px solid var(--border);
            }

            .ov-table tbody tr {
                transition: background 0.15s;
            }

            .ov-table tbody tr:hover {
                background: rgba(79, 70, 229, 0.02);
            }

            .ov-table tbody td {
                padding: 16px 24px;
                font-size: 14px;
                color: var(--text);
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
            }

            .ov-table tbody tr:last-child td {
                border-bottom: none;
            }

            .ov-service-num {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 10px;
                background: var(--primary-bg);
                color: var(--primary);
                font-weight: 700;
                font-size: 14px;
            }

            .ov-service-date {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-weight: 500;
                color: var(--text);
            }

            .ov-service-date i {
                color: var(--text-muted);
                font-size: 16px;
            }

            /* ── Action Buttons ── */
            .ov-btn-done {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 18px;
                background: linear-gradient(135deg, var(--primary), var(--primary-light));
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                font-family: 'Inter', sans-serif;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.25s ease;
                box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
            }

            .ov-btn-done:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
            }

            .ov-btn-done:active {
                transform: translateY(0);
            }

            .ov-completed-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                background: var(--success-bg);
                color: var(--success);
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
            }

            /* ── Summary Stats ── */
            .ov-stats-row {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
                margin-bottom: 28px;
            }

            .ov-stat-card {
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                padding: 22px 24px;
                box-shadow: var(--shadow-sm);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .ov-stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
            }

            .ov-stat-card.purple::before {
                background: linear-gradient(90deg, var(--primary), var(--primary-light));
            }

            .ov-stat-card.green::before {
                background: linear-gradient(90deg, #10b981, #34d399);
            }

            .ov-stat-card.amber::before {
                background: linear-gradient(90deg, #f59e0b, #fbbf24);
            }

            .ov-stat-card:hover {
                box-shadow: var(--shadow-lg);
                transform: translateY(-2px);
            }

            .ov-stat-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 10px;
            }

            .ov-stat-label {
                font-size: 12.5px;
                font-weight: 600;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .ov-stat-icon {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }

            .ov-stat-icon.purple {
                background: var(--primary-bg);
                color: var(--primary);
            }

            .ov-stat-icon.green {
                background: var(--success-bg);
                color: var(--success);
            }

            .ov-stat-icon.amber {
                background: var(--warning-bg);
                color: var(--warning);
            }

            .ov-stat-value {
                font-size: 26px;
                font-weight: 800;
                color: var(--dark);
                letter-spacing: -0.5px;
                line-height: 1;
            }

            /* ── Progress Bar ── */
            .ov-progress-wrap {
                padding: 0 24px 20px;
            }

            .ov-progress-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }

            .ov-progress-text {
                font-size: 12px;
                font-weight: 600;
                color: var(--text-muted);
            }

            .ov-progress-bar {
                width: 100%;
                height: 8px;
                background: #f1f5f9;
                border-radius: 20px;
                overflow: hidden;
            }

            .ov-progress-fill {
                height: 100%;
                border-radius: 20px;
                background: linear-gradient(90deg, var(--success), #34d399);
                transition: width 0.6s ease;
            }

            /* ── Timeline Dot ── */
            .ov-timeline-indicator {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .ov-timeline-line {
                width: 2px;
                height: 20px;
                background: var(--border);
                margin-left: 17px;
            }

            /* ── Responsive ── */
            @media (max-width: 768px) {
                .ov-grid {
                    grid-template-columns: 1fr;
                }

                .ov-stats-row {
                    grid-template-columns: 1fr;
                }

                .ov-page-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .ov-detail-row {
                    padding: 12px 18px;
                }

                .ov-table thead th,
                .ov-table tbody td {
                    padding: 12px 16px;
                }

                .ov-card-header {
                    padding: 16px 18px;
                }

                .ov-stat-value {
                    font-size: 22px;
                }
            }

            /* ── Empty State ── */
            .ov-empty {
                text-align: center;
                padding: 48px 24px;
                color: var(--text-muted);
            }

            .ov-empty i {
                font-size: 48px;
                margin-bottom: 12px;
                opacity: 0.3;
            }

            .ov-empty p {
                font-size: 14px;
                font-weight: 500;
            }

            /* ── Pulse animation for pending ── */
            @keyframes pulse-dot {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.4;
                }
            }

            .ov-badge-warning .ov-badge-dot {
                animation: pulse-dot 1.5s ease-in-out infinite;
            }
        </style>

        <div class="ov-container">

            <!-- Page Header -->
            <div class="ov-page-header">
                <div class="ov-page-header-left">
                    <div class="ov-page-icon">
                        <i class="bx bx-receipt"></i>
                    </div>
                    <div>
                        <h1 class="ov-page-title">Cash Order Details</h1>
                        <p class="ov-page-subtitle">Order for <?= htmlspecialchars($order->product_name) ?></p>
                    </div>
                </div>
                <a href="<?= site_url('admin/orders') ?>" class="ov-back-btn">
                    <i class="bx bx-arrow-back"></i> Back to Orders
                </a>
            </div>

            <!-- Stats Row -->
            <?php
            $total_services = count($services);
            $completed_services = 0;
            foreach ($services as $s) {
                if ($s->status == 1)
                    $completed_services++;
            }
            $pending_services = $total_services - $completed_services;
            $progress = $total_services > 0 ? round(($completed_services / $total_services) * 100) : 0;
            ?>
            <div class="ov-stats-row">
                <div class="ov-stat-card purple">
                    <div class="ov-stat-top">
                        <span class="ov-stat-label">Total Price</span>
                        <div class="ov-stat-icon purple">
                            <i class="bx bx-wallet"></i>
                        </div>
                    </div>
                    <div class="ov-stat-value">₹<?= number_format((float) $order->price, 2) ?></div>
                </div>
                <div class="ov-stat-card green">
                    <div class="ov-stat-top">
                        <span class="ov-stat-label">Services Done</span>
                        <div class="ov-stat-icon green">
                            <i class="bx bx-check-circle"></i>
                        </div>
                    </div>
                    <div class="ov-stat-value"><?= $completed_services ?> / <?= $total_services ?></div>
                </div>
                <div class="ov-stat-card amber">
                    <div class="ov-stat-top">
                        <span class="ov-stat-label">Pending Services</span>
                        <div class="ov-stat-icon amber">
                            <i class="bx bx-time-five"></i>
                        </div>
                    </div>
                    <div class="ov-stat-value"><?= $pending_services ?></div>
                </div>
            </div>

            <!-- Two Column Grid -->
            <div class="ov-grid">

                <!-- Product Info Card -->
                <div class="ov-card">
                    <div class="ov-card-header">
                        <div class="ov-card-header-icon blue">
                            <i class="bx bx-box"></i>
                        </div>
                        <h5>Product Information</h5>
                    </div>
                    <div class="ov-card-body">
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-package"></i> Product Name
                            </div>
                            <div class="ov-detail-value"><?= htmlspecialchars($order->product_name) ?></div>
                        </div>
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-chip"></i> Model
                            </div>
                            <div class="ov-detail-value"><?= htmlspecialchars($order->product_modal) ?></div>
                        </div>
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-rupee"></i> Price
                            </div>
                            <div class="ov-detail-value">
                                <span class="ov-price">₹<?= number_format((float) $order->price, 2) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info Card -->
                <div class="ov-card">
                    <div class="ov-card-header">
                        <div class="ov-card-header-icon green">
                            <i class="bx bx-credit-card"></i>
                        </div>
                        <h5>Payment Information</h5>
                    </div>
                    <div class="ov-card-body">
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-calendar"></i> Purchase Date
                            </div>
                            <div class="ov-detail-value">
                                <?= date('d M Y', strtotime($order->date_of_purchase)) ?>
                            </div>
                        </div>
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-money"></i> Payment Type
                            </div>
                            <div class="ov-detail-value">
                                <span class="ov-badge ov-badge-success">
                                    <span class="ov-badge-dot"></span> Full Payment
                                </span>
                            </div>
                        </div>
                        <?php if (!empty($order->down_payment)) { ?>
                            <div class="ov-detail-row">
                                <div class="ov-detail-label">
                                    <i class="bx bx-down-arrow-circle"></i> Down Payment
                                </div>
                                <div class="ov-detail-value">
                                    <span class="ov-price">₹<?= number_format((float) $order->down_payment, 2) ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="ov-detail-row">
                            <div class="ov-detail-label">
                                <i class="bx bx-check-shield"></i> Payment Status
                            </div>
                            <div class="ov-detail-value">
                                <span class="ov-badge ov-badge-success">
                                    <span class="ov-badge-dot"></span> Paid
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Schedule Card -->
            <div class="ov-card ov-card-full">
                <div class="ov-card-header">
                    <div class="ov-card-header-icon orange">
                        <i class="bx bx-wrench"></i>
                    </div>
                    <h5>Service Schedule</h5>
                </div>

                <!-- Progress Bar -->
                <div class="ov-progress-wrap" style="padding-top: 20px;">
                    <div class="ov-progress-info">
                        <span class="ov-progress-text">Overall Completion</span>
                        <span class="ov-progress-text"><?= $progress ?>%</span>
                    </div>
                    <div class="ov-progress-bar">
                        <div class="ov-progress-fill" style="width: <?= $progress ?>%;"></div>
                    </div>
                </div>

                <div class="ov-table-wrap">
                    <table class="ov-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service No.</th>
                                <th>Scheduled Date</th>
                                <th>Status</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($services)) { ?>
                                <?php $i = 1;
                                foreach ($services as $s) { ?>
                                    <tr>
                                        <td>
                                            <span style="font-weight: 600; color: var(--text-muted); font-size: 13px;">
                                                <?= $i++ ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="ov-service-num"><?= $s->service_number ?></span>
                                        </td>
                                        <td>
                                            <span class="ov-service-date">
                                                <i class="bx bx-calendar"></i>
                                                <?= date('d M Y', strtotime($s->service_date)) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($s->status == 1) { ?>
                                                <span class="ov-badge ov-badge-success">
                                                    <span class="ov-badge-dot"></span> Completed
                                                </span>
                                            <?php } else { ?>
                                                <span class="ov-badge ov-badge-warning">
                                                    <span class="ov-badge-dot"></span> Pending
                                                </span>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if ($s->status == 0) { ?>
                                                <a href="<?= base_url('index.php/admin/orders/update_service/' . $s->id) ?>"
                                                    class="ov-btn-done" onclick="return confirm('Mark this service as completed?')">
                                                    <i class="bx bx-check"></i> Mark Done
                                                </a>
                                            <?php } else { ?>
                                                <span class="ov-completed-badge">
                                                    <i class="bx bx-check-circle"></i> Done
                                                </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="ov-empty">
                                            <i class="bx bx-calendar-x"></i>
                                            <p>No services scheduled yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
