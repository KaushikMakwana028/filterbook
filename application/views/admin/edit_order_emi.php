<style>
    .emi-edit-wrapper {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .emi-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .emi-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 24px 30px;
        color: #fff;
    }

    .emi-card-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .emi-card-header p {
        margin: 5px 0 0;
        font-size: 14px;
        opacity: 0.85;
    }

    .emi-card-body {
        padding: 30px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-grid .full-width {
        grid-column: 1 / -1;
    }

    .form-group {
        position: relative;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group .input-icon-wrap {
        position: relative;
    }

    .form-group .input-icon-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-size: 16px;
    }

    .form-group .form-control {
        width: 100%;
        padding: 12px 14px 12px 42px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        color: #2d3748;
        background: #f7fafc;
        transition: all 0.3s ease;
        outline: none;
        box-sizing: border-box;
    }

    .form-group .form-control:focus {
        border-color: #667eea;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    }

    .form-group .form-control:hover {
        border-color: #cbd5e0;
    }

    .divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        margin: 30px 0;
    }

    /* EMI Table Section */
    .emi-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .emi-table-header h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .emi-summary-badges {
        display: flex;
        gap: 10px;
    }

    .emi-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .emi-badge.paid {
        background: #c6f6d5;
        color: #22543d;
    }

    .emi-badge.pending {
        background: #fed7d7;
        color: #9b2c2c;
    }

    .emi-table-wrap {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .emi-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .emi-table thead {
        background: linear-gradient(135deg, #edf2f7, #e2e8f0);
    }

    .emi-table thead th {
        padding: 14px 18px;
        text-align: left;
        font-weight: 700;
        color: #4a5568;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.8px;
        border-bottom: 2px solid #cbd5e0;
    }

    .emi-table tbody tr {
        transition: background 0.2s ease;
    }

    .emi-table tbody tr:hover {
        background: #f7fafc;
    }

    .emi-table tbody tr:not(:last-child) td {
        border-bottom: 1px solid #edf2f7;
    }

    .emi-table tbody td {
        padding: 14px 18px;
        color: #2d3748;
    }

    .emi-number-cell {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
    }

    .emi-date-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4a5568;
        font-weight: 500;
    }

    .emi-date-cell i {
        color: #a0aec0;
    }

    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-chip.paid {
        background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
        color: #22543d;
    }

    .status-chip.pending {
        background: linear-gradient(135deg, #fefcbf, #fbd38d);
        color: #975a16;
    }

    .status-chip i {
        font-size: 12px;
    }

    /* Progress Bar */
    .emi-progress-section {
        margin-bottom: 20px;
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #4a5568;
    }

    .progress-bar-track {
        width: 100%;
        height: 10px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(135deg, #48bb78, #38a169);
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-update {
        padding: 14px 36px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
    }

    .btn-update:active {
        transform: translateY(0);
    }

    .btn-cancel {
        padding: 14px 28px;
        background: #fff;
        color: #4a5568;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: #f7fafc;
        border-color: #cbd5e0;
    }

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: #f7fafc;
        border-radius: 12px;
        padding: 16px 18px;
        border: 1px solid #e2e8f0;
        text-align: center;
        transition: all 0.3s ease;
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .summary-card .s-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .summary-card .s-icon.blue {
        background: #ebf4ff;
        color: #667eea;
    }

    .summary-card .s-icon.green {
        background: #c6f6d5;
        color: #38a169;
    }

    .summary-card .s-icon.orange {
        background: #fefcbf;
        color: #d69e2e;
    }

    .summary-card .s-icon.purple {
        background: #e9d8fd;
        color: #805ad5;
    }

    .summary-card .s-value {
        font-size: 20px;
        font-weight: 800;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .summary-card .s-label {
        font-size: 12px;
        color: #a0aec0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Empty State */
    .empty-emi {
        text-align: center;
        padding: 40px;
        color: #a0aec0;
    }

    .empty-emi i {
        font-size: 48px;
        margin-bottom: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .summary-cards {
            grid-template-columns: 1fr 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-update,
        .btn-cancel {
            justify-content: center;
        }

        .emi-summary-badges {
            display: none;
        }

        .emi-table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .summary-cards {
            grid-template-columns: 1fr;
        }

        .emi-card-body {
            padding: 20px;
        }

        .emi-card-header {
            padding: 20px;
        }
    }
</style>

<!-- Font Awesome CDN (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="page-wrapper">
    <div class="page-content">
        <div class="emi-edit-wrapper">

            <form method="post" action="<?= base_url('index.php/admin/orders/update_order_emi') ?>">
                <input type="hidden" name="id" value="<?= $order->id ?>">

                <!-- Order Details Card -->
                <div class="emi-card">
                    <div class="emi-card-header">
                        <h3><i class="fas fa-credit-card"></i> Edit EMI Order</h3>
                        <p>Update order details and manage EMI schedule</p>
                    </div>
                    <div class="emi-card-body">

                        <!-- Summary Cards -->
                        <div class="summary-cards">
                            <div class="summary-card">
                                <div class="s-icon blue"><i class="fas fa-rupee-sign"></i></div>
                                <div class="s-value">₹<?= number_format((float) $order->price) ?></div>
                                <div class="s-label">Total Price</div>
                            </div>
                            <div class="summary-card">
                                <div class="s-icon green"><i class="fas fa-hand-holding-usd"></i></div>
                                <div class="s-value">₹<?= number_format((float) $order->down_payment, 2) ?>
                                </div>
                                <div class="s-label">Down Payment</div>
                            </div>
                            <div class="summary-card">
                                <div class="s-icon orange"><i class="fas fa-calendar-check"></i></div>
                                <div class="s-value">₹<?= number_format((float) $order->emi_amount, 2) ?></div>
                                <div class="s-label">Per EMI</div>
                            </div>
                            <div class="summary-card">
                                <div class="s-icon purple"><i class="fas fa-clock"></i></div>
                                <div class="s-value"><?= $order->emi_duration ?></div>
                                <div class="s-label">Months</div>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label>Product Name</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-box"></i>
                                    <input type="text" name="product_name" value="<?= $order->product_name ?>"
                                        class="form-control" placeholder="Enter product name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Total Price (₹)</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-rupee-sign"></i>
                                    <input type="number" name="price" value="<?= $order->price ?>" class="form-control"
                                        placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Down Payment (₹)</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <input type="number" name="down_payment" value="<?= $order->down_payment ?>"
                                        class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>EMI Amount (₹)</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <input type="number" name="emi_amount" value="<?= $order->emi_amount ?>"
                                        class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Total Months</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-calendar-alt"></i>
                                    <input type="number" name="emi_duration" value="<?= $order->emi_duration ?>"
                                        class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EMI Schedule Card -->
                <div class="emi-card">
                    <div class="emi-card-body">

                        <?php
                        $paid_count = 0;
                        $pending_count = 0;
                        foreach ($emis as $e) {
                            if ($e->status == 1)
                                $paid_count++;
                            else
                                $pending_count++;
                        }
                        $total_emis = count($emis);
                        $progress = $total_emis > 0 ? round(($paid_count / $total_emis) * 100) : 0;
                        ?>

                        <div class="emi-table-header">
                            <h4><i class="fas fa-calendar-alt"></i> EMI Schedule</h4>
                            <div class="emi-summary-badges">
                                <span class="emi-badge paid"><i class="fas fa-check-circle"></i> <?= $paid_count ?>
                                    Paid</span>
                                <span class="emi-badge pending"><i class="fas fa-hourglass-half"></i>
                                    <?= $pending_count ?> Pending</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="emi-progress-section">
                            <div class="progress-info">
                                <span>Payment Progress</span>
                                <span><?= $progress ?>% Complete</span>
                            </div>
                            <div class="progress-bar-track">
                                <div class="progress-bar-fill" style="width: <?= $progress ?>%"></div>
                            </div>
                        </div>

                        <?php if ($total_emis > 0): ?>
                            <div class="emi-table-wrap">
                                <table class="emi-table">
                                    <thead>
                                        <tr>
                                            <th>EMI #</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($emis as $e): ?>
                                            <tr>
                                                <td>
                                                    <span class="emi-number-cell"><?= $e->emi_number ?></span>
                                                </td>
                                                <td>
                                                    <span class="emi-date-cell">
                                                        <i class="far fa-calendar"></i>
                                                        <?= date('d M Y', strtotime($e->emi_date)) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong>₹<?= number_format((float) $order->emi_amount, 2) ?></strong>
                                                </td>
                                                <td>
                                                    <?php if ($e->status == 1): ?>
                                                        <span class="status-chip paid">
                                                            <i class="fas fa-check-circle"></i> Paid
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="status-chip pending">
                                                            <i class="fas fa-hourglass-half"></i> Pending
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-emi">
                                <i class="far fa-calendar-times"></i>
                                <p>No EMI records found for this order.</p>
                            </div>
                        <?php endif; ?>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <a href="<?= base_url('index.php/admin/orders') ?>" class="btn-cancel">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save"></i> Update EMI Order
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
</div>