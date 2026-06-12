<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details — <?= htmlspecialchars($order->vendor_name) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #eef2ff;
            --success: #10b981;
            --success-light: #ecfdf5;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --danger: #ef4444;
            
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            line-height: 1.5;
            padding: 24px 16px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Header / Brand */
        .brand-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .brand-header h1 {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }

        .brand-header p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* Card styles */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 8px;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Info grids */
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px dotted var(--border);
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        .info-value {
            color: var(--text-main);
            font-weight: 600;
            text-align: right;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: var(--success-light);
            color: var(--success);
        }

        .badge-warning {
            background-color: var(--warning-light);
            color: var(--warning);
        }

        /* Tables for logs */
        .log-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 4px;
        }

        .log-table th {
            text-align: left;
            padding: 8px;
            background-color: var(--bg-main);
            color: var(--text-secondary);
            font-weight: 600;
            border-bottom: 1px solid var(--border);
        }

        .log-table td {
            padding: 10px 8px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
        }

        .log-table tr:last-child td {
            border-bottom: none;
        }

        /* Complaint Button */
        .btn-complaint {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background-color: var(--danger);
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: var(--radius-md);
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            transition: background-color 0.2s;
            margin-top: 8px;
        }

        .btn-complaint:hover {
            background-color: #dc2626;
        }

        .btn-complaint i {
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Brand / Store Info -->
    <div class="brand-header">
        <h1><?= htmlspecialchars($order->vendor_name) ?></h1>
        <p><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($order->vendor_mobile) ?> &nbsp;|&nbsp; <i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($order->vendor_email) ?></p>
    </div>

    <!-- Order Summary Card -->
    <div class="card">
        <div class="card-title">
            <i class="fa-solid fa-file-invoice"></i> Order Summary
        </div>
        <div class="info-row">
            <span class="info-label">Order ID</span>
            <span class="info-value">#<?= str_pad($order->id, 6, '0', STR_PAD_LEFT) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Product Name</span>
            <span class="info-value"><?= htmlspecialchars($order->product_name) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Model</span>
            <span class="info-value"><?= !empty($order->product_modal) ? htmlspecialchars($order->product_modal) : '—' ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Purchase Date</span>
            <span class="info-value"><?= date('d M Y', strtotime($order->date_of_purchase)) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Price</span>
            <span class="info-value" style="color: var(--primary-dark);">₹<?= number_format($order->price, 2) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Payment Method</span>
            <span class="info-value">
                <span class="badge badge-success">
                    <?= (int)$order->payment_type === 1 ? 'EMI' : 'Cash' ?>
                </span>
            </span>
        </div>
        <?php if ((int)$order->payment_type === 1): ?>
            <div class="info-row">
                <span class="info-label">Down Payment</span>
                <span class="info-value">₹<?= number_format($order->down_payment, 2) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">EMI Amount</span>
                <span class="info-value">₹<?= number_format($order->emi_amount, 2) ?>/mo</span>
            </div>
            <div class="info-row">
                <span class="info-label">EMI Duration</span>
                <span class="info-value"><?= $order->emi_duration ?> Months</span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Customer Card -->
    <div class="card">
        <div class="card-title">
            <i class="fa-solid fa-user"></i> Customer Details
        </div>
        <div class="info-row">
            <span class="info-label">Name</span>
            <span class="info-value"><?= htmlspecialchars($order->customer_name) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Mobile</span>
            <span class="info-value"><?= htmlspecialchars($order->customer_mobile) ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Address</span>
            <span class="info-value"><?= htmlspecialchars($order->customer_address) ?></span>
        </div>
    </div>

    <!-- Services Log Card -->
    <?php if (!empty($services)): ?>
        <div class="card">
            <div class="card-title">
                <i class="fa-solid fa-screwdriver-wrench"></i> Service Log
            </div>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Service #</th>
                        <th>Scheduled Date</th>
                        <th style="text-align: right;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $svc): ?>
                        <tr>
                            <td>Service <?= $svc->service_number ?></td>
                            <td><?= date('d M Y', strtotime($svc->service_date)) ?></td>
                            <td style="text-align: right;">
                                <?php if ((int)$svc->status === 1): ?>
                                    <span class="badge badge-success"><i class="fa-solid fa-circle-check"></i> Done</span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><i class="fa-solid fa-clock"></i> Pending</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- EMI Log Card -->
    <?php if ((int)$order->payment_type === 1 && !empty($emis)): ?>
        <div class="card">
            <div class="card-title">
                <i class="fa-solid fa-credit-card"></i> EMI Payments
            </div>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>EMI #</th>
                        <th>Due Date</th>
                        <th style="text-align: right;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emis as $emi): ?>
                        <tr>
                            <td>EMI <?= $emi->emi_number ?></td>
                            <td><?= date('d M Y', strtotime($emi->emi_date)) ?></td>
                            <td style="text-align: right;">
                                <?php if ((int)$emi->status === 1): ?>
                                    <span class="badge badge-success"><i class="fa-solid fa-circle-check"></i> Paid</span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><i class="fa-solid fa-clock"></i> Due</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Raise Complaint Button -->
    <a href="<?= site_url('complaint/' . $order->customer_id . '?order_id=' . $order->id) ?>" class="btn-complaint">
        <i class="fa-solid fa-circle-exclamation"></i> Raise Complaint
    </a>
</div>

</body>
</html>
