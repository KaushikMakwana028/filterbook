<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --primary-light: #eef2ff;
        --primary-50: rgba(99, 102, 241, 0.06);
        --primary-100: rgba(99, 102, 241, 0.12);
        --success: #10b981;
        --success-dark: #059669;
        --success-light: #ecfdf5;
        --danger: #ef4444;
        --danger-light: #fef2f2;
        --warning: #f59e0b;
        --warning-light: #fffbeb;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] .page-content {
        background: var(--bg-primary) !important;
    }

    [data-theme="dark"] .edit-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
        box-shadow: none !important;
    }

    [data-theme="dark"] .edit-card-header {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .edit-card-header h3 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .edit-card-header small {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .edit-card-body {
        background: var(--bg-secondary) !important;
    }

    [data-theme="dark"] .form-label {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .form-input,
    [data-theme="dark"] .form-textarea {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .form-input::placeholder,
    [data-theme="dark"] .form-textarea::placeholder {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .form-hint,
    [data-theme="dark"] .char-counter {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .edit-actions {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .edit-actions-left {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .btn-cancel {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .btn-cancel:hover {
        background: var(--bg-primary) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .edit-back-btn {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .edit-back-btn:hover {
        background: var(--bg-secondary) !important;
        color: var(--primary) !important;
    }

    [data-theme="dark"] .edit-breadcrumb a,
    [data-theme="dark"] .edit-breadcrumb .sep {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .edit-breadcrumb .current {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .edit-page-header-left h1 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .edit-page-header-left p {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .edit-info-item {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .edit-info-label {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .edit-info-value {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .upload-zone {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .upload-zone h4 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .upload-zone p {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .no-image-placeholder {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .current-image {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .edit-info-icon.blue {
        background: rgba(59, 130, 246, 0.15) !important;
    }

    [data-theme="dark"] .edit-info-icon.green {
        background: rgba(16, 185, 129, 0.15) !important;
    }

    [data-theme="dark"] .edit-info-icon.purple {
        background: rgba(99, 102, 241, 0.15) !important;
    }

    [data-theme="dark"] .edit-info-icon.rose {
        background: rgba(244, 63, 94, 0.15) !important;
    }

    [data-theme="dark"] .edit-card-header-icon.purple {
        background: rgba(99, 102, 241, 0.15) !important;
    }

    [data-theme="dark"] .edit-card-header-icon.emerald {
        background: rgba(16, 185, 129, 0.15) !important;
    }

    [data-theme="dark"] .edit-card-header-icon.amber {
        background: rgba(245, 158, 11, 0.15) !important;
    }

    .page-content {
        min-height: 100vh;
        padding: 32px 28px;
        background: linear-gradient(180deg, #f8f9fc 0%, #eef1f8 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* ─── Breadcrumb ─── */
    .edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .edit-breadcrumb a {
        font-size: 0.82rem;
        color: var(--gray-500);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .edit-breadcrumb a:hover {
        color: var(--primary);
    }

    .edit-breadcrumb a i {
        font-size: 18px;
    }

    .edit-breadcrumb .sep {
        color: var(--gray-300);
        font-size: 0.75rem;
    }

    .edit-breadcrumb .current {
        font-size: 0.82rem;
        color: var(--gray-800);
        font-weight: 700;
    }

    /* ─── Page Header ─── */
    .edit-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .edit-page-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .edit-page-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        display: grid;
        place-items: center;
        color: #fff;
        font-size: 24px;
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        flex-shrink: 0;
    }

    .edit-page-header-left h1 {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .edit-page-header-left p {
        font-size: 0.85rem;
        color: var(--gray-500);
        font-weight: 500;
        margin-top: 2px;
    }

    .edit-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--gray-600);
        background: #fff;
        border: 1.5px solid var(--gray-200);
        text-decoration: none;
        transition: var(--transition);
    }

    .edit-back-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-50);
        transform: translateX(-3px);
    }

    .edit-back-btn i {
        font-size: 18px;
    }

    /* ─── Main Layout ─── */
    .edit-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
        align-items: start;
    }

    /* ─── Card ─── */
    .edit-card {
        background: #fff;
        border-radius: var(--radius-xl);
        border: 1px solid var(--gray-100);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .edit-card:hover {
        box-shadow: var(--shadow-md);
        border-color: var(--gray-200);
    }

    .edit-card-header {
        padding: 22px 28px 18px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(180deg, #fafbfe, #fff);
    }

    .edit-card-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .edit-card-header-icon.purple {
        background: var(--primary-light);
        color: var(--primary);
    }

    .edit-card-header-icon.emerald {
        background: var(--success-light);
        color: var(--success);
    }

    .edit-card-header-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
    }

    .edit-card-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--gray-900);
        letter-spacing: -0.2px;
    }

    .edit-card-header small {
        display: block;
        font-size: 0.75rem;
        color: var(--gray-400);
        font-weight: 500;
        margin-top: 1px;
    }

    .edit-card-body {
        padding: 24px 28px 28px;
    }

    /* ─── Form Groups ─── */
    .form-group {
        margin-bottom: 22px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray-700);
        margin-bottom: 8px;
        letter-spacing: 0.2px;
    }

    .form-label i {
        font-size: 16px;
        color: var(--gray-400);
    }

    .form-label .required {
        color: var(--danger);
        font-weight: 800;
    }

    .form-hint {
        font-size: 0.72rem;
        color: var(--gray-400);
        font-weight: 500;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-hint i {
        font-size: 14px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius);
        font-family: inherit;
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--gray-900);
        background: #fff;
        transition: var(--transition);
        outline: none;
    }

    .form-input:hover,
    .form-textarea:hover {
        border-color: var(--gray-300);
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-50);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--gray-400);
        font-weight: 400;
    }

    .form-textarea {
        min-height: 140px;
        resize: vertical;
        line-height: 1.7;
    }

    .form-input-price {
        position: relative;
    }

    .form-input-price .currency {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--gray-500);
        pointer-events: none;
    }

    .form-input-price .form-input {
        padding-left: 32px;
    }

    /* ─── Image Upload ─── */
    .image-upload-area {
        position: relative;
    }

    .current-image-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 16px;
    }

    .current-image {
        width: 100%;
        max-width: 280px;
        height: 200px;
        object-fit: cover;
        border-radius: var(--radius);
        border: 2px solid var(--gray-200);
        box-shadow: var(--shadow);
        transition: var(--transition);
        display: block;
    }

    .current-image:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
        transform: scale(1.02);
    }

    .current-image-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
        letter-spacing: 0.3px;
    }

    .current-image-badge i {
        font-size: 13px;
    }

    .no-image-placeholder {
        width: 100%;
        max-width: 280px;
        height: 200px;
        border-radius: var(--radius);
        border: 2px dashed var(--gray-300);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: var(--gray-50);
        margin-bottom: 16px;
    }

    .no-image-placeholder i {
        font-size: 40px;
        color: var(--gray-300);
    }

    .no-image-placeholder span {
        font-size: 0.78rem;
        color: var(--gray-400);
        font-weight: 600;
    }

    .upload-zone {
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius);
        padding: 28px 20px;
        text-align: center;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        background: var(--gray-50);
    }

    .upload-zone:hover,
    .upload-zone.dragover {
        border-color: var(--primary);
        background: var(--primary-50);
    }

    .upload-zone.dragover {
        border-style: solid;
        box-shadow: 0 0 0 4px var(--primary-50);
    }

    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .upload-zone-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--primary-light);
        display: grid;
        place-items: center;
        font-size: 24px;
        color: var(--primary);
        margin: 0 auto 14px;
        transition: var(--transition);
    }

    .upload-zone:hover .upload-zone-icon {
        background: var(--primary-100);
        transform: scale(1.05);
    }

    .upload-zone h4 {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .upload-zone h4 span {
        color: var(--primary);
    }

    .upload-zone p {
        font-size: 0.75rem;
        color: var(--gray-400);
        font-weight: 500;
    }

    .file-preview {
        display: none;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        background: var(--success-light);
        border: 1.5px solid rgba(16, 185, 129, 0.2);
        border-radius: var(--radius);
        margin-top: 14px;
    }

    .file-preview.active {
        display: flex;
    }

    .file-preview-thumb {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid rgba(16, 185, 129, 0.2);
        flex-shrink: 0;
    }

    .file-preview-info {
        flex: 1;
        min-width: 0;
    }

    .file-preview-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray-800);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-preview-size {
        font-size: 0.72rem;
        color: var(--success-dark);
        font-weight: 600;
        margin-top: 2px;
    }

    .file-preview-remove {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        display: grid;
        place-items: center;
        cursor: pointer;
        font-size: 18px;
        transition: var(--transition);
        flex-shrink: 0;
    }

    .file-preview-remove:hover {
        background: rgba(239, 68, 68, 0.2);
    }

    /* ─── Sidebar Info Card ─── */
    .edit-info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid var(--gray-100);
    }

    .edit-info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .edit-info-item:first-child {
        padding-top: 0;
    }

    .edit-info-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .edit-info-icon.blue {
        background: #eff6ff;
        color: #3b82f6;
    }

    .edit-info-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .edit-info-icon.purple {
        background: var(--primary-light);
        color: var(--primary);
    }

    .edit-info-icon.rose {
        background: #fff1f2;
        color: #f43f5e;
    }

    .edit-info-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .edit-info-value {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    /* ─── Quick Tips ─── */
    .edit-tips {
        list-style: none;
        padding: 0;
    }

    .edit-tips li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        font-size: 0.8rem;
        color: var(--gray-600);
        font-weight: 500;
        line-height: 1.5;
    }

    .edit-tips li i {
        font-size: 18px;
        color: var(--success);
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ─── Action Footer ─── */
    .edit-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 20px 28px;
        border-top: 1px solid var(--gray-100);
        background: linear-gradient(180deg, #fff, var(--gray-50));
        flex-wrap: wrap;
    }

    .edit-actions-left {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.75rem;
        color: var(--gray-400);
        font-weight: 500;
    }

    .edit-actions-left i {
        font-size: 16px;
    }

    .edit-actions-right {
        display: flex;
        gap: 12px;
    }

    .btn-cancel {
        padding: 11px 24px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--gray-600);
        background: #fff;
        border: 1.5px solid var(--gray-200);
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-cancel:hover {
        border-color: var(--gray-300);
        background: var(--gray-50);
        color: var(--gray-700);
    }

    .btn-cancel i {
        font-size: 18px;
    }

    .btn-submit {
        padding: 11px 28px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-submit i {
        font-size: 18px;
    }

    .btn-submit.loading {
        pointer-events: none;
        opacity: 0.85;
    }

    .btn-submit.loading i {
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ─── Status Dot ─── */
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .status-dot.green {
        background: var(--success);
        box-shadow: 0 0 6px rgba(16, 185, 129, 0.4);
    }

    /* ─── Character Counter ─── */
    .char-counter {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray-400);
        text-align: right;
        margin-top: 6px;
        transition: color 0.2s;
    }

    .char-counter.warning {
        color: var(--warning);
    }

    .char-counter.danger {
        color: var(--danger);
    }

    /* ─── Responsive ─── */
    @media (max-width: 1024px) {
        .edit-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-content {
            padding: 18px 16px;
        }

        .edit-page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .edit-card-body {
            padding: 20px;
        }

        .edit-card-header {
            padding: 18px 20px 14px;
        }

        .edit-actions {
            padding: 16px 20px;
            flex-direction: column;
            align-items: stretch;
        }

        .edit-actions-right {
            width: 100%;
        }

        .edit-actions-right .btn-cancel,
        .edit-actions-right .btn-submit {
            flex: 1;
            justify-content: center;
        }

        .current-image {
            max-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .page-content {
            padding: 14px 12px;
        }

        .edit-page-header-left h1 {
            font-size: 1.25rem;
        }

        .edit-page-icon {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }

        .form-input,
        .form-textarea {
            padding: 10px 14px;
            font-size: 0.85rem;
        }
    }
</style>

<?php
$adminSession = $this->session->userdata('admin')['id'];
$publicCatalogUrl = site_url('publiccatalog/view/' . $adminSession);
?>

<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="edit-breadcrumb">
            <a href="<?= site_url('admin/dashboard') ?>"><i class="bx bx-home-alt"></i> Dashboard</a>
            <span class="sep"><i class="bx bx-chevron-right"></i></span>
            <a href="<?= site_url('admin/catalog') ?>">Catalog</a>
            <span class="sep"><i class="bx bx-chevron-right"></i></span>
            <span class="current">Edit Product</span>
        </div>

        <!-- Page Header -->
        <div class="edit-page-header">
            <div class="edit-page-header-left">
                <div class="edit-page-icon">
                    <i class="bx bx-edit-alt"></i>
                </div>
                <div>
                    <h1>Edit Product</h1>
                    <p>Update the details of <strong><?= htmlspecialchars($product->name) ?></strong></p>
                </div>
            </div>
            <a href="<?= site_url('admin/catalog') ?>" class="edit-back-btn">
                <i class="bx bx-arrow-back"></i> Back to Catalog
            </a>
        </div>

        <!-- Form -->
        <form method="post" action="<?= site_url('admin/catalog/update/' . $product->id) ?>"
            enctype="multipart/form-data" id="editProductForm">

            <div class="edit-layout">

                <!-- ══════ LEFT COLUMN ══════ -->
                <div class="edit-main-col">

                    <!-- Product Details Card -->
                    <div class="edit-card" style="margin-bottom: 24px;">
                        <div class="edit-card-header">
                            <div class="edit-card-header-icon purple">
                                <i class="bx bx-package"></i>
                            </div>
                            <div>
                                <h3>Product Details</h3>
                                <small>Basic information about the product</small>
                            </div>
                        </div>
                        <div class="edit-card-body">

                            <!-- Name -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bx bx-purchase-tag"></i>
                                    Product Name <span class="required">*</span>
                                </label>
                                <input type="text" name="name" class="form-input"
                                    value="<?= htmlspecialchars($product->name) ?>" placeholder="Enter product name..."
                                    required maxlength="150" id="productName">
                                <div class="char-counter" id="nameCounter">0 / 150</div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bx bx-align-left"></i>
                                    Description
                                </label>
                                <textarea name="description" class="form-textarea"
                                    placeholder="Describe the product features, specifications, etc..." maxlength="1000"
                                    id="productDesc"><?= htmlspecialchars($product->description) ?></textarea>
                                <div class="char-counter" id="descCounter">0 / 1000</div>
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bx bx-rupee"></i>
                                    Price <span class="required">*</span>
                                </label>
                                <div class="form-input-price">
                                    <span class="currency">₹</span>
                                    <input type="number" name="price" class="form-input" value="<?= $product->price ?>"
                                        placeholder="0.00" required min="0" step="0.01">
                                </div>
                                <div class="form-hint">
                                    <i class="bx bx-info-circle"></i>
                                    Enter the selling price in Indian Rupees
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Image Card -->
                    <div class="edit-card">
                        <div class="edit-card-header">
                            <div class="edit-card-header-icon emerald">
                                <i class="bx bx-image-alt"></i>
                            </div>
                            <div>
                                <h3>Product Image</h3>
                                <small>Upload or update the product photo</small>
                            </div>
                        </div>
                        <div class="edit-card-body">

                            <div class="image-upload-area">

                                <!-- Current Image -->
                                <?php if ($product->image): ?>
                                    <div class="current-image-wrapper">
                                        <img src="<?= base_url('uploads/catalog/' . $product->image) ?>"
                                            alt="<?= htmlspecialchars($product->name) ?>" class="current-image"
                                            id="currentImage">
                                        <div class="current-image-badge">
                                            <i class="bx bx-check-circle"></i> Current Image
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="no-image-placeholder" id="noImage">
                                        <i class="bx bx-image"></i>
                                        <span>No image uploaded</span>
                                    </div>
                                <?php endif; ?>

                                <!-- Upload Zone -->
                                <div class="upload-zone" id="uploadZone">
                                    <input type="file" name="image" accept="image/*" id="imageInput">
                                    <div class="upload-zone-icon">
                                        <i class="bx bx-cloud-upload"></i>
                                    </div>
                                    <h4><span>Click to upload</span> or drag & drop</h4>
                                    <p>PNG, JPG or WEBP (Max 2MB)</p>
                                </div>

                                <!-- File Preview -->
                                <div class="file-preview" id="filePreview">
                                    <img src="" alt="Preview" class="file-preview-thumb" id="previewThumb">
                                    <div class="file-preview-info">
                                        <div class="file-preview-name" id="previewName">—</div>
                                        <div class="file-preview-size" id="previewSize">—</div>
                                    </div>
                                    <button type="button" class="file-preview-remove" id="removeFile" title="Remove">
                                        <i class="bx bx-x"></i>
                                    </button>
                                </div>

                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="edit-actions">
                            <div class="edit-actions-left">
                                <i class="bx bx-shield-check"></i>
                                All changes are saved securely
                            </div>
                            <div class="edit-actions-right">
                                <a href="<?= site_url('admin/catalog') ?>" class="btn-cancel">
                                    <i class="bx bx-x"></i> Cancel
                                </a>
                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <i class="bx bx-check"></i> Update Product
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ══════ RIGHT SIDEBAR ══════ -->
                <div class="edit-sidebar-col">

                    <!-- Product Info Card -->
                    <div class="edit-card" style="margin-bottom: 20px;">
                        <div class="edit-card-header">
                            <div class="edit-card-header-icon amber">
                                <i class="bx bx-info-circle"></i>
                            </div>
                            <div>
                                <h3>Product Info</h3>
                                <small>Current details</small>
                            </div>
                        </div>
                        <div class="edit-card-body">
                            <div class="edit-info-item">
                                <div class="edit-info-icon blue">
                                    <i class="bx bx-hash"></i>
                                </div>
                                <div>
                                    <div class="edit-info-label">Product ID</div>
                                    <div class="edit-info-value">#<?= $product->id ?></div>
                                </div>
                            </div>
                            <div class="edit-info-item">
                                <div class="edit-info-icon green">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div>
                                    <div class="edit-info-label">Status</div>
                                    <div class="edit-info-value">
                                        <span class="status-dot green"></span> Active
                                    </div>
                                </div>
                            </div>
                            <div class="edit-info-item">
                                <div class="edit-info-icon purple">
                                    <i class="bx bx-rupee"></i>
                                </div>
                                <div>
                                    <div class="edit-info-label">Current Price</div>
                                    <div class="edit-info-value">₹<?= number_format($product->price, 2) ?></div>
                                </div>
                            </div>
                            <div class="edit-info-item">
                                <div class="edit-info-icon rose">
                                    <i class="bx bx-image"></i>
                                </div>
                                <div>
                                    <div class="edit-info-label">Image</div>
                                    <div class="edit-info-value">
                                        <?= $product->image ? '✅ Uploaded' : '⚠️ No image' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <!-- <div class="edit-card">
                        <div class="edit-card-header">
                            <div class="edit-card-header-icon emerald">
                                <i class="bx bx-bulb"></i>
                            </div>
                            <div>
                                <h3>Quick Tips</h3>
                                <small>Best practices</small>
                            </div>
                        </div>
                        <div class="edit-card-body">
                            <ul class="edit-tips">
                                <li>
                                    <i class="bx bx-check-circle"></i>
                                    Use clear, descriptive product names for better visibility.
                                </li>
                                <li>
                                    <i class="bx bx-check-circle"></i>
                                    Add detailed descriptions to improve customer understanding.
                                </li>
                                <li>
                                    <i class="bx bx-check-circle"></i>
                                    Upload high-quality images (at least 800x800px) for best results.
                                </li>
                                <li>
                                    <i class="bx bx-check-circle"></i>
                                    Keep prices accurate and competitive for your market.
                                </li>
                            </ul>
                        </div>
                    </div> -->

                </div>

            </div>

        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ── Character Counters ──
        const nameInput = document.getElementById('productName');
        const nameCounter = document.getElementById('nameCounter');
        const descInput = document.getElementById('productDesc');
        const descCounter = document.getElementById('descCounter');

        function updateCounter(input, counter, max) {
            const len = input.value.length;
            counter.textContent = len + ' / ' + max;
            counter.className = 'char-counter';
            if (len > max * 0.9) counter.classList.add('danger');
            else if (len > max * 0.75) counter.classList.add('warning');
        }

        if (nameInput && nameCounter) {
            updateCounter(nameInput, nameCounter, 150);
            nameInput.addEventListener('input', () => updateCounter(nameInput, nameCounter, 150));
        }
        if (descInput && descCounter) {
            updateCounter(descInput, descCounter, 1000);
            descInput.addEventListener('input', () => updateCounter(descInput, descCounter, 1000));
        }

        // ── Image Upload Preview ──
        const imageInput = document.getElementById('imageInput');
        const uploadZone = document.getElementById('uploadZone');
        const filePreview = document.getElementById('filePreview');
        const previewThumb = document.getElementById('previewThumb');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');
        const removeBtn = document.getElementById('removeFile');

        function formatBytes(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        function showFilePreview(file) {
            if (!file) return;
            previewName.textContent = file.name;
            previewSize.textContent = formatBytes(file.size) + ' • Ready to upload';
            filePreview.classList.add('active');

            const reader = new FileReader();
            reader.onload = (e) => {
                previewThumb.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function clearFilePreview() {
            filePreview.classList.remove('active');
            previewThumb.src = '';
            previewName.textContent = '—';
            previewSize.textContent = '—';
            imageInput.value = '';
        }

        if (imageInput) {
            imageInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) showFilePreview(file);
            });
        }

        if (removeBtn) {
            removeBtn.addEventListener('click', clearFilePreview);
        }

        // Drag and drop
        if (uploadZone) {
            ['dragenter', 'dragover'].forEach(evt => {
                uploadZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    uploadZone.classList.add('dragover');
                });
            });
            ['dragleave', 'drop'].forEach(evt => {
                uploadZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    uploadZone.classList.remove('dragover');
                });
            });
            uploadZone.addEventListener('drop', (e) => {
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    imageInput.files = dt.files;
                    showFilePreview(file);
                }
            });
        }

        // ── Form Submit Loading ──
        const form = document.getElementById('editProductForm');
        const submitBtn = document.getElementById('submitBtn');

        if (form && submitBtn) {
            form.addEventListener('submit', () => {
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="bx bx-loader-alt"></i> Updating...';
            });
        }

    });
</script>