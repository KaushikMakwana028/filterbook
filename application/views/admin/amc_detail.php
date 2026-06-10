<?php
$today = strtotime(date('Y-m-d'));
$startTs = !empty($amc->start_date) ? strtotime($amc->start_date) : null;
$endTs = !empty($amc->end_date) ? strtotime($amc->end_date) : null;
$isActive = (int) ($amc->status ?? 0) === 1 && $endTs && $endTs >= $today;
$daysLeft = $endTs ? (int) floor(($endTs - $today) / 86400) : null;
$statusLabel = $isActive ? 'Active' : 'Expired';
$statusClass = $isActive ? 'active' : 'expired';
$initials = strtoupper(substr((string) ($amc->customer_name ?? 'NA'), 0, 2));
?>

<style>
    .amcd-shell {
        max-width: 1120px;
        margin: 28px auto;
        padding: 0 18px;
    }

    .amcd-hero,
    .amcd-card {
        background: #fff;
        border: 1px solid #e8eef7;
        border-radius: 24px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
    }

    .amcd-hero {
        padding: 24px 28px;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
        margin-bottom: 22px;
    }

    .amcd-title {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .amcd-icon,
    .amcd-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
    }

    .amcd-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #eef2ff, #dbeafe);
        color: #4f46e5;
        font-size: 24px;
    }

    .amcd-title h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #172033;
    }

    .amcd-title p {
        margin: 6px 0 0;
        color: #7b8aa0;
        font-size: 14px;
    }

    .amcd-hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .amcd-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        border: 1px solid #dbe5f1;
    }

    .amcd-btn.back { color: #475569; background: #fff; }
    .amcd-btn.edit { color: #4f46e5; background: #eef2ff; border-color: #c7d2fe; }
    .amcd-btn.delete { color: #dc2626; background: #fff1f2; border-color: #fecdd3; }

    .amcd-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 22px;
    }

    .amcd-card {
        padding: 24px;
    }

    .amcd-profile {
        text-align: center;
        padding-top: 12px;
    }

    .amcd-avatar {
        width: 86px;
        height: 86px;
        margin: 0 auto 14px;
        background: linear-gradient(135deg, #6366f1, #06b6d4);
        color: #fff;
        font-size: 32px;
        font-weight: 800;
    }

    .amcd-profile h3 {
        margin: 0;
        font-size: 24px;
        color: #172033;
    }

    .amcd-profile p {
        margin: 6px 0 0;
        color: #7b8aa0;
    }

    .amcd-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
    }

    .amcd-badge.active { background: #ecfdf3; color: #059669; }
    .amcd-badge.expired { background: #fff1f2; color: #dc2626; }

    .amcd-list {
        margin: 22px 0 0;
        display: grid;
        gap: 14px;
    }

    .amcd-item {
        padding: 14px 16px;
        border-radius: 16px;
        background: #f8fbff;
        border: 1px solid #edf2f7;
        text-align: left;
    }

    .amcd-label {
        color: #8a97ab;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 6px;
    }

    .amcd-value {
        color: #1f2937;
        font-size: 16px;
        font-weight: 700;
        word-break: break-word;
    }

    .amcd-main {
        display: grid;
        gap: 22px;
    }

    .amcd-section-title {
        font-size: 20px;
        font-weight: 800;
        color: #172033;
        margin: 0 0 18px;
    }

    .amcd-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .amcd-highlight {
        padding: 18px;
        border-radius: 18px;
        background: linear-gradient(135deg, #f8fafc, #eef6ff);
        border: 1px solid #e4edf7;
    }

    .amcd-highlight strong {
        display: block;
        margin-top: 8px;
        font-size: 28px;
        color: #111827;
    }

    .amcd-note {
        margin-top: 18px;
        padding: 18px;
        border-radius: 18px;
        background: #fffaf0;
        border: 1px solid #fde7b2;
        color: #7c5b14;
        line-height: 1.65;
    }

    @media (max-width: 920px) {
        .amcd-grid,
        .amcd-info-grid {
            grid-template-columns: 1fr;
        }

        .amcd-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="amcd-shell">
            <div class="amcd-hero">
                <div class="amcd-title">
                    <div class="amcd-icon"><i class="bx bx-file"></i></div>
                    <div>
                        <h1>AMC Contract Details</h1>
                        <p>Review customer, product, validity period, and contract value.</p>
                    </div>
                </div>
                <div class="amcd-hero-actions">
                    <a href="<?= site_url('admin/amc') ?>" class="amcd-btn back"><i class="bx bx-arrow-back"></i> Back</a>
                    <a href="<?= site_url('admin/amc/edit/' . (int) $amc->id) ?>" class="amcd-btn edit"><i class="bx bx-edit-alt"></i> Edit</a>
                    <a href="<?= site_url('admin/amc/delete/' . (int) $amc->id) ?>" class="amcd-btn delete" onclick="return confirm('Delete this contract?')"><i class="bx bx-trash"></i> Delete</a>
                </div>
            </div>

            <div class="amcd-grid">
                <div class="amcd-card">
                    <div class="amcd-profile">
                        <div class="amcd-avatar"><?= htmlspecialchars($initials) ?></div>
                        <h3><?= htmlspecialchars($amc->customer_name ?? 'Customer') ?></h3>
                        <p><?= htmlspecialchars($amc->customer_mobile ?? '-') ?></p>
                        <div class="amcd-badge <?= $statusClass ?>">
                            <i class="bx <?= $isActive ? 'bx-check-circle' : 'bx-time-five' ?>"></i>
                            <?= $statusLabel ?>
                        </div>
                    </div>

                    <div class="amcd-list">
                        <div class="amcd-item">
                            <div class="amcd-label">Address</div>
                            <div class="amcd-value"><?= htmlspecialchars($amc->customer_address ?: '-') ?></div>
                        </div>
                        <div class="amcd-item">
                            <div class="amcd-label">Product</div>
                            <div class="amcd-value"><?= htmlspecialchars($amc->product_name ?: '-') ?></div>
                        </div>
                        <div class="amcd-item">
                            <div class="amcd-label">Model / Serial</div>
                            <div class="amcd-value"><?= htmlspecialchars($amc->product_modal ?: 'N/A') ?></div>
                        </div>
                        <div class="amcd-item">
                            <div class="amcd-label">Created At</div>
                            <div class="amcd-value"><?= !empty($amc->created_at) ? date('d M, Y', strtotime($amc->created_at)) : '-' ?></div>
                        </div>
                    </div>
                </div>

                <div class="amcd-main">
                    <div class="amcd-card">
                        <h3 class="amcd-section-title">Contract Summary</h3>
                        <div class="amcd-info-grid">
                            <div class="amcd-item">
                                <div class="amcd-label">Start Date</div>
                                <div class="amcd-value"><?= $startTs ? date('d M, Y', $startTs) : '-' ?></div>
                            </div>
                            <div class="amcd-item">
                                <div class="amcd-label">End Date</div>
                                <div class="amcd-value"><?= $endTs ? date('d M, Y', $endTs) : '-' ?></div>
                            </div>
                            <div class="amcd-item">
                                <div class="amcd-label">AMC Amount</div>
                                <div class="amcd-value">₹<?= number_format((float) ($amc->amc_amount ?? 0), 0) ?></div>
                            </div>
                            <div class="amcd-item">
                                <div class="amcd-label">Purchase Date</div>
                                <div class="amcd-value"><?= !empty($amc->date_of_purchase) ? date('d M, Y', strtotime($amc->date_of_purchase)) : '-' ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="amcd-card">
                        <h3 class="amcd-section-title">Status Insight</h3>
                        <div class="amcd-info-grid">
                            <div class="amcd-highlight">
                                <div class="amcd-label">Contract Status</div>
                                <strong><?= $statusLabel ?></strong>
                            </div>
                            <div class="amcd-highlight">
                                <div class="amcd-label">Days Remaining</div>
                                <strong><?= $daysLeft !== null ? max($daysLeft, 0) : 0 ?></strong>
                            </div>
                        </div>

                        <div class="amcd-note">
                            <?php if ($isActive): ?>
                                This AMC contract is currently active and usable. Keep monitoring the validity so you can renew it before expiry.
                            <?php else: ?>
                                This AMC contract has expired. You can edit or renew the contract to keep support active for this customer.
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
