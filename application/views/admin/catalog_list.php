<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --primary-light: #EEF2FF;
            --text: #1F2937;
            --text-secondary: #6B7280;
            --text-muted: #9CA3AF;
            --border: #E5E7EB;
            --border-light: #F3F4F6;
            --bg: #F9FAFB;
            --white: #FFFFFF;
            --success: #059669;
            --success-bg: #ECFDF5;
            --warning: #D97706;
            --warning-bg: #FFFBEB;
            --danger: #DC2626;
            --danger-bg: #FEF2F2;
            --info: #2563EB;
            --info-bg: #EFF6FF;
            --radius: 8px;
            --radius-lg: 12px;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.2s ease;
        }

        html[data-bs-theme="dark"] {
            --text: #E5E7EB;
            --text-secondary: #9CA3AF;
            --text-muted: #6B7280;
            --border: rgba(148, 163, 184, 0.2);
            --border-light: rgba(148, 163, 184, 0.12);
            --bg: #111827;
            --white: #1F2937;
            --success-bg: rgba(5, 150, 105, 0.16);
            --warning-bg: rgba(217, 119, 6, 0.16);
            --danger-bg: rgba(220, 38, 38, 0.16);
            --info-bg: rgba(37, 99, 235, 0.16);
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 10px 24px rgba(0, 0, 0, 0.28);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }

        html[data-bs-theme="dark"] body {
            background: #111827;
        }

        /* ── Page Layout ── */
        .page-wrapper {
            min-height: 100vh;
        }

        html[data-bs-theme="dark"] .page-wrapper {
            background:
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.18), transparent 32%),
                radial-gradient(circle at bottom right, rgba(37, 99, 235, 0.14), transparent 28%),
                linear-gradient(180deg, #0f172a 0%, #111827 100%);
        }

        .page-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* ── Page Header ── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header-left h1 {
            font-size: 1.625rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.025em;
        }

        .page-header-left p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .page-header-right {
            display: flex;
            gap: 0.75rem;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 1px 2px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
            border-color: #D1D5DB;
        }

        .btn-icon {
            width: 2.25rem;
            height: 2.25rem;
            padding: 0;
            justify-content: center;
            border-radius: var(--radius);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        .btn-danger-ghost {
            background: none;
            color: var(--danger);
            border: none;
            padding: 0.375rem;
        }

        .btn-danger-ghost:hover {
            background: var(--danger-bg);
        }

        /* ── Stats Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 2.75rem;
            height: 2.75rem;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .stat-icon.blue {
            background: var(--info-bg);
            color: var(--info);
        }

        .stat-icon.green {
            background: var(--success-bg);
            color: var(--success);
        }

        .stat-icon.yellow {
            background: var(--warning-bg);
            color: var(--warning);
        }

        .stat-icon.red {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .stat-value {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.025em;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.125rem;
        }

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-box {
            position: relative;
            max-width: 320px;
            flex: 1;
        }

        .search-box input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.875rem;
            font-family: inherit;
            background: var(--white);
            transition: var(--transition);
            color: var(--text);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .search-box i {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .filter-btn {
            position: relative;
        }

        .filter-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .view-toggle {
            display: flex;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .view-toggle button {
            width: 2.25rem;
            height: 2.25rem;
            border: none;
            background: var(--white);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 0.875rem;
        }

        .view-toggle button:not(:last-child) {
            border-right: 1px solid var(--border);
        }

        .view-toggle button.active {
            background: var(--primary);
            color: var(--white);
        }

        .view-toggle button:hover:not(.active) {
            background: var(--bg);
            color: var(--text);
        }

        /* ── Table Card ── */
        .table-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }

        thead th {
            padding: 0.75rem 1.25rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
            transition: var(--transition);
        }

        thead th:hover {
            color: var(--text);
        }

        thead th .sort-icon {
            margin-left: 0.25rem;
            font-size: 0.625rem;
            opacity: 0.4;
        }

        thead th:hover .sort-icon {
            opacity: 1;
        }

        thead th.sorted {
            color: var(--primary);
        }

        thead th.sorted .sort-icon {
            opacity: 1;
            color: var(--primary);
        }

        tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: var(--transition);
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #FAFAFF;
        }

        tbody td {
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        /* ── Checkbox ── */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border-radius: 4px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        /* ── Product Cell ── */
        .product-cell {
            display: flex;
            align-items: center;
            gap: 0.875rem;
        }

        .product-image {
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius);
            object-fit: cover;
            border: 1px solid var(--border);
            background: var(--bg);
            flex-shrink: 0;
        }

        .product-placeholder {
            width: 3rem;
            height: 3rem;
            border-radius: var(--radius);
            background: var(--border-light);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .product-info {
            min-width: 0;
        }

        .product-name {
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }

        .product-sku {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.125rem;
        }

        /* ── Price Cell ── */
        .price {
            font-weight: 600;
            color: var(--text);
            font-variant-numeric: tabular-nums;
        }

        .price-original {
            text-decoration: line-through;
            color: var(--text-muted);
            font-weight: 400;
            font-size: 0.75rem;
            margin-left: 0.375rem;
        }

        /* ── Description Cell ── */
        .description-text {
            color: var(--text-secondary);
            max-width: 280px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.5;
            font-size: 0.8125rem;
        }

        /* ── Status Badge ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .badge-success {
            background: var(--success-bg);
            color: var(--success);
        }

        .badge-success .badge-dot {
            background: var(--success);
        }

        .badge-warning {
            background: var(--warning-bg);
            color: var(--warning);
        }

        .badge-warning .badge-dot {
            background: var(--warning);
        }

        .badge-danger {
            background: var(--danger-bg);
            color: var(--danger);
        }

        .badge-danger .badge-dot {
            background: var(--danger);
        }

        /* ── Actions ── */
        .actions-cell {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .action-btn {
            width: 2rem;
            height: 2rem;
            border: none;
            background: none;
            border-radius: var(--radius);
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 0.875rem;
        }

        .action-btn:hover {
            background: var(--bg);
            color: var(--text);
        }

        .action-btn.edit:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .action-btn.delete:hover {
            background: var(--danger-bg);
            color: var(--danger);
        }

        /* ── Table Footer / Pagination ── */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.875rem 1.25rem;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .table-info {
            font-size: 0.8125rem;
            color: var(--text-secondary);
        }

        .table-info strong {
            color: var(--text);
            font-weight: 600;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .page-btn {
            width: 2rem;
            height: 2rem;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: var(--radius);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: var(--transition);
            font-family: inherit;
        }

        .page-btn:hover:not(.active):not(:disabled) {
            background: var(--bg);
            border-color: #D1D5DB;
            color: var(--text);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--text-muted);
        }

        .empty-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .empty-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        /* ── Bulk Actions Bar ── */
        .bulk-bar {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: var(--primary);
            color: var(--white);
            padding: 0.75rem 1.25rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1rem;
            animation: slideDown 0.2s ease;
        }

        .bulk-bar.show {
            display: flex;
        }

        .bulk-bar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .bulk-bar-right {
            display: flex;
            gap: 0.5rem;
        }

        .bulk-btn {
            padding: 0.375rem 0.875rem;
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .bulk-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Tooltip ── */
        .tooltip-wrapper {
            position: relative;
        }

        .tooltip-wrapper::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%;
            transform: translateX(-50%) scale(0.9);
            background: var(--text);
            color: var(--white);
            padding: 0.375rem 0.625rem;
            border-radius: 6px;
            font-size: 0.6875rem;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.15s ease;
        }

        .tooltip-wrapper:hover::after {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }

        /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

        @media (max-width: 768px) {

            /* ── Page ── */
            .page-content {
                padding: 0.875rem 0.75rem;
            }

            /* ── Page Header ── */
            .page-header {
                flex-direction: column;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }

            .page-header-left h1 {
                font-size: 1.3rem;
            }

            .page-header-right {
                width: 100%;
                display: flex;
                gap: 0.5rem;
            }

            .page-header-right .btn {
                flex: 1;
                justify-content: center;
            }

            /* ── QR Section ── */
            .page-content>div[style*="margin-bottom: 1.5rem"][style*="display:flex"] {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 14px;
                background: #fff;
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                margin-bottom: 1rem !important;
            }

            /* ── Search ── */
            .page-content>div[style*="margin-bottom: 1.5rem"]>div {
                max-width: 100% !important;
            }

            .page-content>div[style*="margin-bottom: 1.5rem"] input {
                width: 100% !important;
            }

            /* ── Stats ── */
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            /* ── Toolbar ── */
            .toolbar {
                flex-direction: column;
                align-items: stretch;
                gap: 0.625rem;
                margin-bottom: 0.875rem;
            }

            .toolbar-left {
                flex-direction: column;
            }

            .search-box {
                max-width: 100%;
            }

            .toolbar-right {
                justify-content: flex-end;
            }

            /* ── Bulk bar ── */
            .bulk-bar {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }

            .bulk-bar-right {
                justify-content: center;
                width: 100%;
                flex-wrap: wrap;
            }

            .bulk-btn {
                flex: 1;
                justify-content: center;
            }

            /* ══════════════════════════════════════════
       TABLE → CARD LAYOUT ON MOBILE
    ══════════════════════════════════════════ */

            .table-card {
                border-radius: var(--radius);
                background: transparent;
                border: none;
                box-shadow: none;
            }

            .table-wrapper {
                overflow: visible;
            }

            /* Hide thead */
            table thead {
                display: none;
            }

            /* Block layout */
            table,
            table tbody {
                display: block;
                width: 100%;
            }

            /* Each row = a card */
            table tbody tr {
                display: block;
                background: #fff;
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 14px;
                margin-bottom: 10px;
                position: relative;
                transition: var(--transition);
            }

            table tbody tr:last-child {
                border-bottom: 1px solid var(--border);
                margin-bottom: 0;
            }

            table tbody tr:hover {
                background: #fff;
                box-shadow: var(--shadow-md);
            }

            /* Hide all cells by default */
            table tbody tr td {
                display: none;
                padding: 0;
                border: none;
                font-size: 0.875rem;
            }

            /* ── Checkbox — absolute top-right ── */
            table tbody tr td:nth-child(1) {
                display: block;
                position: absolute;
                top: 14px;
                right: 14px;
            }

            /* ── Product — top section ── */
            table tbody tr td:nth-child(2) {
                display: block;
                padding-bottom: 12px;
                margin-bottom: 10px;
                border-bottom: 1px solid var(--border-light);
                padding-right: 28px;
                /* space for checkbox */
            }

            .product-cell {
                gap: 12px;
            }

            .product-image,
            .product-placeholder {
                width: 52px;
                height: 52px;
                border-radius: var(--radius);
                flex-shrink: 0;
            }

            .product-name {
                max-width: 100%;
                font-size: 0.9rem;
                white-space: normal;
                word-break: break-word;
            }

            .product-sku {
                font-size: 0.72rem;
            }

            /* ── Price ── */
            table tbody tr td:nth-child(3) {
                display: flex;
                align-items: center;
                gap: 8px;
                padding-bottom: 8px;
                margin-bottom: 8px;
                border-bottom: 1px solid var(--border-light);
            }

            table tbody tr td:nth-child(3)::before {
                content: "Price:";
                font-size: 0.7rem;
                font-weight: 600;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                white-space: nowrap;
                min-width: 52px;
            }

            .price {
                font-size: 0.95rem;
            }

            /* ── Description ── */
            table tbody tr td:nth-child(4) {
                display: block;
                padding-bottom: 8px;
                margin-bottom: 8px;
                border-bottom: 1px solid var(--border-light);
            }

            table tbody tr td:nth-child(4)::before {
                content: "Description:";
                display: block;
                font-size: 0.7rem;
                font-weight: 600;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-bottom: 4px;
            }

            .description-text {
                max-width: 100%;
                font-size: 0.82rem;
                -webkit-line-clamp: 3;
            }

            /* ── Status + Actions — bottom row ── */
            table tbody tr td:nth-child(5),
            table tbody tr td:nth-child(6) {
                display: inline-flex;
                vertical-align: middle;
            }

            table tbody tr td:nth-child(5) {
                padding-top: 10px;
                flex: 1;
                align-items: center;
            }

            table tbody tr td:nth-child(6) {
                padding-top: 10px;
                align-items: center;
                justify-content: flex-end;
            }

            .actions-cell {
                gap: 6px;
            }

            .action-btn {
                width: 34px;
                height: 34px;
                font-size: 0.9rem;
                border: 1px solid var(--border);
            }

            /* ── Empty state row ── */
            table tbody tr:has(.empty-state) {
                background: #fff;
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                display: block;
            }

            table tbody tr td[colspan] {
                display: block;
                border: none;
                padding: 0;
            }

            /* ── Table footer ── */
            .table-footer {
                flex-direction: column;
                align-items: center;
                gap: 0.625rem;
                padding: 0.875rem 0;
                border: none;
                background: transparent;
                margin-top: 4px;
            }

            .table-info {
                font-size: 0.75rem;
                text-align: center;
            }

            .pagination {
                gap: 3px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-btn {
                width: 1.875rem;
                height: 1.875rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .page-content {
                padding: 0.75rem 0.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.625rem;
            }

            .page-header-left h1 {
                font-size: 1.15rem;
            }

            .page-btn {
                width: 1.75rem;
                height: 1.75rem;
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="page-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>Product Catalog</h1>
                    <p>Manage and organize your product listings</p>
                </div>
                <div class="page-header-right">

                    <!-- NEW QR BUTTON -->
                    <a href="<?= site_url('admin/catalog/generate_qr') ?>" class="btn btn-secondary">
                        <i class="fas fa-qrcode"></i> QR Code
                    </a>

                    <a href="<?= site_url('admin/catalog/add') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Catalog
                    </a>

                </div>
            </div>

            <?php
            $publicCatalogUrl = site_url('publiccatalog/view/' . $this->session->userdata('admin')['id']);
            $qrImageUrl = 'https://quickchart.io/qr?size=220&text=' . rawurlencode($publicCatalogUrl);
            ?>
            <div style="margin-bottom: 1.5rem; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
                <img src="<?= $qrImageUrl ?>" alt="Catalog QR"
                    style="width:110px; border-radius:10px; border:1px solid #E5E7EB; background:#fff; padding:8px;">
                <div>
                    <div style="font-weight:600; margin-bottom:6px;">Public Catalog QR</div>
                    <a href="<?= $publicCatalogUrl ?>" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-eye"></i> Open Catalog
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <div style="margin-bottom: 1.5rem;">
                <div style="max-width: 400px;">
                    <input type="text" id="searchInput" placeholder="Search products..."
                        style="width: 100%; padding: 10px 15px; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 14px;">
                </div>
            </div>

            <!-- Bulk Actions Bar -->
            <div class="bulk-bar" id="bulkBar">
                <div class="bulk-bar-left">
                    <i class="fas fa-check-circle"></i>
                    <span><strong id="selectedCount">0</strong> products selected</span>
                </div>
                <div class="bulk-bar-right">
                    <button class="bulk-btn"><i class="fas fa-edit"></i> Edit</button>
                    <button class="bulk-btn"><i class="fas fa-trash"></i> Delete</button>
                    <button class="bulk-btn" onclick="clearSelection()"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)">
                                    </div>
                                </th>
                                <th class="sorted">
                                    Product <i class="fas fa-arrow-up sort-icon"></i>
                                </th>
                                <th>
                                    Price <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th>
                                    Description <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th>
                                    Status <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #6B7280;"></i>
                                    <div style="margin-top: 10px; color: #6B7280;">Loading...</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="table-footer" id="tableFooter" style="display: none;">
                    <div class="table-info" id="tableInfo">
                        Showing <strong>0</strong> to <strong>0</strong> of <strong>0</strong> results
                    </div>
                    <div class="pagination" id="paginationContainer">
                        <!-- Pagination will be inserted here -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let currentPage = 1;
        let searchQuery = '';
        let searchTimeout = null;

        // Load products on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts(1);
        });

        // Search functionality with debounce
        document.getElementById('searchInput').addEventListener('input', function(e) {
            searchQuery = e.target.value;

            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Set new timeout
            searchTimeout = setTimeout(function() {
                currentPage = 1;
                loadProducts(1);
            }, 500); // Wait 500ms after user stops typing
        });

        // Load products via AJAX
        function loadProducts(page) {
            currentPage = page;

            // Show loading state
            document.getElementById('productTableBody').innerHTML = `
        <tr>
            <td colspan="6" style="text-align: center; padding: 40px;">
                <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #6B7280;"></i>
                <div style="margin-top: 10px; color: #6B7280;">Loading...</div>
            </td>
        </tr>
    `;

            // AJAX request
            fetch('<?= site_url("admin/catalog/index") ?>?search=' + encodeURIComponent(searchQuery) + '&page=' + page, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    renderProducts(data.products);
                    renderPagination(data);
                    updateTableInfo(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('productTableBody').innerHTML = `
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #EF4444;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px;"></i>
                    <div style="margin-top: 10px;">Error loading products</div>
                </td>
            </tr>
        `;
                });
        }

        // Render products in table
        function renderProducts(products) {
            const tbody = document.getElementById('productTableBody');

            if (products.length === 0) {
                tbody.innerHTML = `
            <tr>
                <td colspan="6">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="empty-title">No products found</div>
                        <div class="empty-text">${searchQuery ? 'Try different search terms' : 'Get started by adding your first product'}</div>
                        <a href="<?= site_url('admin/catalog/add') ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Product
                        </a>
                    </div>
                </td>
            </tr>
        `;
                return;
            }

            let html = '';
            products.forEach(function(p) {
                html += `
            <tr>
                <td>
                    <div class="checkbox-wrapper">
                        <input type="checkbox" class="row-checkbox" onchange="updateBulkBar()">
                    </div>
                </td>
                <td>
                    <div class="product-cell">
                        ${p.image ? 
                            `<img src="<?= base_url('uploads/catalog/') ?>${p.image}" alt="${p.name}" class="product-image">` :
                            `<div class="product-placeholder"><i class="fas fa-image"></i></div>`
                        }
                        <div class="product-info">
                            <div class="product-name">${p.name}</div>
                            <div class="product-sku">SKU-${String(p.id).padStart(5, '0')}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="price">$${parseFloat(p.price).toFixed(2)}</span>
                </td>
                <td>
                    <div class="description-text">
                        ${p.description || '<span style="color:var(--text-muted);">No description</span>'}
                    </div>
                </td>
                <td>
                    <span class="badge badge-success">
                        <span class="badge-dot"></span>
                        Active
                    </span>
                </td>
                <td>
                    <div class="actions-cell">
                        <a href="<?= site_url('admin/catalog/edit/') ?>${p.id}" class="action-btn edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?= site_url('admin/catalog/delete/') ?>${p.id}" 
                           class="action-btn delete"
                           onclick="return confirm('Are you sure you want to delete this item?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        `;
            });

            tbody.innerHTML = html;
        }

        // Render pagination
        function renderPagination(data) {
            const footer = document.getElementById('tableFooter');
            const container = document.getElementById('paginationContainer');

            if (data.total === 0) {
                footer.style.display = 'none';
                return;
            }

            footer.style.display = 'flex';

            let html = '';
            const currentPage = data.current_page;
            const totalPages = data.total_pages;

            // Previous button
            html += `<button class="page-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="loadProducts(${currentPage - 1})">
        <i class="fas fa-chevron-left" style="font-size:10px;"></i>
    </button>`;

            // Calculate which pages to show (show 3 buttons max)
            let startPage, endPage;

            if (totalPages <= 3) {
                startPage = 1;
                endPage = totalPages;
            } else {
                if (currentPage === 1) {
                    startPage = 1;
                    endPage = 3;
                } else if (currentPage === totalPages) {
                    startPage = totalPages - 2;
                    endPage = totalPages;
                } else {
                    startPage = currentPage - 1;
                    endPage = currentPage + 1;
                }
            }

            // Page buttons
            for (let i = startPage; i <= endPage; i++) {
                html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="loadProducts(${i})">${i}</button>`;
            }

            // Show last page if not already visible
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    html += `<button class="page-btn" disabled>...</button>`;
                }
                html += `<button class="page-btn" onclick="loadProducts(${totalPages})">${totalPages}</button>`;
            }

            // Next button
            html += `<button class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="loadProducts(${currentPage + 1})">
        <i class="fas fa-chevron-right" style="font-size:10px;"></i>
    </button>`;

            container.innerHTML = html;
        }

        // Update table info
        function updateTableInfo(data) {
            const info = document.getElementById('tableInfo');
            const start = data.total === 0 ? 0 : ((data.current_page - 1) * data.per_page) + 1;
            const end = Math.min(data.current_page * data.per_page, data.total);

            info.innerHTML = `Showing <strong>${start}</strong> to <strong>${end}</strong> of <strong>${data.total}</strong> results`;
        }

        // Keep your existing bulk action functions
        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
            updateBulkBar();
        }

        function updateBulkBar() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            const count = checkboxes.length;
            document.getElementById('selectedCount').textContent = count;
            document.getElementById('bulkBar').style.display = count > 0 ? 'flex' : 'none';
            document.getElementById('selectAll').checked = count === document.querySelectorAll('.row-checkbox').length;
        }

        function clearSelection() {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
            document.getElementById('selectAll').checked = false;
            updateBulkBar();
        }
    </script>
</body>

</html>