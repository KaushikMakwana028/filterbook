<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vendor->store_name ?? 'Catalog') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8f9fb;
            color: #1a1a2e;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .catalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 60px;
        }

        /* ===== STORE HEADER ===== */
        .store-header {
            text-align: center;
            padding: 48px 20px 40px;
            position: relative;
        }

        .store-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }

        .store-name {
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .store-owner {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .store-social {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .social-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
            color: #475569;
            transition: all 0.2s;
        }

        .social-chip i {
            font-size: 13px;
        }

        .social-chip .ig-icon {
            color: #e11d48;
        }

        .social-chip .fb-icon {
            color: #1877f2;
        }

        .social-chip .web-icon {
            color: #059669;
        }

        .social-chip .addr-icon {
            color: #f59e0b;
        }

        .store-divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #a855f7);
            border-radius: 10px;
            margin: 24px auto 0;
        }

        /* ===== TOOLBAR ===== */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toolbar-left h3 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .item-count {
            padding: 3px 10px;
            background: #eef2ff;
            color: #6366f1;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 200px;
            padding: 9px 14px 9px 36px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: #1a1a2e;
            background: #fff;
            outline: none;
            transition: all 0.25s;
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .search-box input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            width: 260px;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
            pointer-events: none;
        }

        .view-toggle {
            display: flex;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .view-toggle button {
            width: 38px;
            height: 36px;
            border: none;
            background: #fff;
            color: #94a3b8;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }

        .view-toggle button.active {
            background: #6366f1;
            color: #fff;
        }

        .view-toggle button:hover:not(.active) {
            color: #6366f1;
            background: #eef2ff;
        }

        .view-toggle button:not(:last-child) {
            border-right: 1px solid #e5e7eb;
        }

        /* ===== PRODUCT GRID ===== */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 18px;
        }

        /* ===== PRODUCT CARD ===== */
        .product-card {
            background: #fff;
            border: 1px solid #eef0f4;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            border-color: transparent;
        }

        .product-img-wrap {
            position: relative;
            overflow: hidden;
            height: 230px;
            background: #f5f6f8;
        }

        .product-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img-wrap img {
            transform: scale(1.05);
        }

        /* Quick view overlay */
        .img-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover .img-overlay {
            opacity: 1;
        }

        .quick-view-btn {
            padding: 8px 18px;
            background: #fff;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #1a1a2e;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transform: translateY(10px);
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover .quick-view-btn {
            transform: translateY(0);
        }

        .quick-view-btn:hover {
            background: #6366f1;
            color: #fff;
        }

        /* Card Info */
        .product-info {
            padding: 16px 18px 20px;
        }

        .product-name {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 4px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-desc {
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .product-price .currency {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
        }

        .inquiry-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #f0f0ff;
            border: none;
            border-radius: 8px;
            color: #6366f1;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s;
        }

        .inquiry-btn:hover {
            background: #6366f1;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        /* ===== LIST VIEW ===== */
        .product-grid.list-view {
            grid-template-columns: 1fr;
        }

        .product-grid.list-view .product-card {
            display: grid;
            grid-template-columns: 260px 1fr;
        }

        .product-grid.list-view .product-img-wrap {
            height: 100%;
            min-height: 180px;
        }

        .product-grid.list-view .product-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px 24px;
        }

        .product-grid.list-view .product-desc {
            -webkit-line-clamp: 3;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #eef2ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon i {
            font-size: 30px;
            color: #6366f1;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #0f172a;
        }

        .empty-state p {
            font-size: 13px;
            color: #94a3b8;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
            gap: 6px;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            color: #475569;
            background: #fff;
            border: 1px solid #e5e7eb;
        }

        .pagination-wrapper a:hover {
            border-color: #6366f1;
            color: #6366f1;
            background: #eef2ff;
        }

        .pagination-wrapper .active {
            background: #6366f1;
            color: #fff;
            border-color: #6366f1;
        }

        .pagination-wrapper .disabled {
            color: #d1d5db;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ===== FOOTER ===== */
        .catalog-footer {
            text-align: center;
            padding: 28px 20px;
            color: #94a3b8;
            font-size: 12px;
            border-top: 1px solid #eef0f4;
            margin-top: 40px;
        }

        /* ===== SCROLL TOP ===== */
        .scroll-top {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 42px;
            height: 42px;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.35);
            opacity: 0;
            transform: translateY(16px);
            transition: all 0.3s;
            z-index: 99;
        }

        .scroll-top.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top:hover {
            background: #4f46e5;
            transform: translateY(-2px);
        }

        /* ===== PRODUCT MODAL ===== */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.25s ease;
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 16px;
            max-width: 520px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalIn 0.3s ease;
        }

        .modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border: none;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50%;
            color: #64748b;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 2;
        }

        .modal-close:hover {
            background: #ef4444;
            color: #fff;
        }

        .modal-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-body h3 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .modal-body .modal-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .modal-price {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .modal-price .currency {
            font-size: 16px;
            font-weight: 600;
            color: #64748b;
        }

        .modal-contact-btn {
            width: 100%;
            padding: 13px;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s;
        }

        .modal-contact-btn:hover {
            background: #4f46e5;
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* ===== ANIMATIONS ===== */
        .product-card {
            animation: cardUp 0.45s ease both;
            opacity: 0;
        }

        @keyframes cardUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

        @media (max-width: 768px) {

            /* ── Container ── */
            .catalog-container {
                padding: 0 12px 40px;
            }

            /* ── Store Header ── */
            .store-header {
                padding: 28px 12px 24px;
            }

            .store-logo {
                width: 72px;
                height: 72px;
                margin-bottom: 12px;
            }

            .store-name {
                font-size: 22px;
                letter-spacing: -0.3px;
            }

            .store-owner {
                font-size: 13px;
                margin-bottom: 12px;
            }

            .store-social {
                gap: 8px;
            }

            .social-chip {
                font-size: 11px;
                padding: 5px 10px;
                gap: 5px;
            }

            .social-chip i {
                font-size: 12px;
            }

            .store-divider {
                margin: 18px auto 0;
            }

            /* ── Toolbar ── */
            .toolbar {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
                margin-bottom: 16px;
            }

            .toolbar-left {
                justify-content: space-between;
            }

            .toolbar-left h3 {
                font-size: 16px;
            }

            .toolbar-right {
                justify-content: space-between;
                gap: 8px;
            }

            .search-box {
                flex: 1;
                width: auto;
            }

            .search-box input {
                width: 100%;
                font-size: 13px;
            }

            .search-box input:focus {
                width: 100%;
            }

            /* ── Product Grid — 2 columns on tablet ── */
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .product-img-wrap {
                height: 160px;
            }

            .product-info {
                padding: 10px 12px 13px;
            }

            .product-name {
                font-size: 12.5px;
                margin-bottom: 2px;
            }

            .product-desc {
                display: none;
                /* hide desc in 2-col to save space */
            }

            .product-bottom {
                padding-top: 10px;
            }

            .product-price {
                font-size: 15px;
                letter-spacing: -0.2px;
            }

            .product-price .currency {
                font-size: 12px;
            }

            /* Keep inquiry button icon-only on small grid */
            .inquiry-btn span {
                display: none;
            }

            .inquiry-btn {
                padding: 7px 10px;
                border-radius: 7px;
            }

            /* ── List view on mobile — stack image above info ── */
            .product-grid.list-view {
                grid-template-columns: 1fr;
            }

            .product-grid.list-view .product-card {
                display: grid;
                grid-template-columns: 130px 1fr;
            }

            .product-grid.list-view .product-img-wrap {
                height: 100%;
                min-height: 140px;
            }

            .product-grid.list-view .product-info {
                padding: 14px 16px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .product-grid.list-view .product-name {
                font-size: 13.5px;
                -webkit-line-clamp: 2;
                white-space: normal;
            }

            .product-grid.list-view .product-desc {
                display: block;
                font-size: 11.5px;
                -webkit-line-clamp: 2;
                margin-bottom: 10px;
            }

            .product-grid.list-view .inquiry-btn span {
                display: inline;
            }

            /* ── Pagination ── */
            .pagination-wrapper {
                margin-top: 28px;
                gap: 4px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .pagination-wrapper a,
            .pagination-wrapper span {
                min-width: 34px;
                height: 34px;
                font-size: 12px;
                padding: 0 8px;
                border-radius: 7px;
            }

            /* ── Modal ── */
            .modal-backdrop {
                padding: 12px;
                align-items: flex-end;
                /* slide up from bottom on mobile */
            }

            .modal-box {
                border-radius: 16px 16px 12px 12px;
                max-height: 92vh;
            }

            .modal-img {
                height: 200px;
                border-radius: 16px 16px 0 0;
            }

            .modal-body {
                padding: 18px 18px 24px;
            }

            .modal-body h3 {
                font-size: 17px;
            }

            .modal-price {
                font-size: 22px;
                margin-bottom: 16px;
            }

            /* ── Scroll top ── */
            .scroll-top {
                bottom: 16px;
                right: 14px;
                width: 38px;
                height: 38px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .catalog-container {
                padding: 0 8px 32px;
            }

            .store-header {
                padding: 22px 8px 20px;
            }

            .store-name {
                font-size: 20px;
            }

            /* Single column on very small phones */
            .product-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .product-img-wrap {
                height: 210px;
            }

            /* Show description again in single column */
            .product-desc {
                display: -webkit-box;
                font-size: 12px;
                -webkit-line-clamp: 2;
                margin-bottom: 10px;
            }

            .product-name {
                font-size: 14px;
                margin-bottom: 4px;
            }

            .product-price {
                font-size: 18px;
            }

            /* Show label text again in single column */
            .inquiry-btn span {
                display: inline;
            }

            .inquiry-btn {
                padding: 8px 14px;
            }

            .product-info {
                padding: 12px 14px 16px;
            }

            /* List view on tiny screens — full stack */
            .product-grid.list-view .product-card {
                grid-template-columns: 1fr;
            }

            .product-grid.list-view .product-img-wrap {
                height: 200px;
            }

            /* Social chips wrap nicely */
            .store-social {
                gap: 6px;
            }

            .social-chip {
                font-size: 10.5px;
                padding: 4px 9px;
            }

            /* Modal full bottom sheet */
            .modal-img {
                height: 180px;
            }

            .modal-body {
                padding: 16px 16px 20px;
            }

            .modal-body h3 {
                font-size: 16px;
            }

            .modal-price {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="catalog-container">

        <!-- ===== STORE HEADER ===== -->
        <?php if (!empty($vendor)): ?>
            <div class="store-header">
                <?php
                $vendorImg = !empty($vendor->profile_image) ? base_url($vendor->profile_image) : base_url('assets/images/icons/user.png');
                ?>
                <img src="<?= $vendorImg ?>" alt="Store" class="store-logo">
                <h1 class="store-name"><?= htmlspecialchars($vendor->store_name) ?></h1>
                <p class="store-owner"><?= htmlspecialchars($vendor->name) ?></p>

                <div class="store-social">
                    <?php if (!empty($vendor->address)): ?>
                        <span class="social-chip">
                            <i class="fas fa-map-marker-alt addr-icon"></i>
                            <?= htmlspecialchars($vendor->address) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($vendor->instagram)): ?>
                        <span class="social-chip">
                            <i class="fab fa-instagram ig-icon"></i>
                            <?= htmlspecialchars(str_replace(['https://instagram.com/', 'https://www.instagram.com/', 'http://instagram.com/'], '@', $vendor->instagram)) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($vendor->facebook)): ?>
                        <span class="social-chip">
                            <i class="fab fa-facebook-f fb-icon"></i>
                            <?= htmlspecialchars(basename($vendor->facebook)) ?>
                        </span>
                    <?php endif; ?>

                    <?php if (!empty($vendor->website)): ?>
                        <span class="social-chip">
                            <i class="fas fa-globe web-icon"></i>
                            <?= htmlspecialchars(str_replace(['https://', 'http://', 'www.'], '', $vendor->website)) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="store-divider"></div>
            </div>
        <?php endif; ?>

        <!-- ===== TOOLBAR ===== -->
        <div class="toolbar">
            <div class="toolbar-left">
                <h3>Products</h3>
                <span class="item-count"><?= count($products) ?></span>
            </div>
            <div class="toolbar-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search products..." id="searchInput">
                </div>
                <div class="view-toggle">
                    <button class="active" id="gridViewBtn" title="Grid">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button id="listViewBtn" title="List">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- ===== PRODUCT GRID ===== -->
        <div class="product-grid" id="productGrid">

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $i => $p): ?>
                    <div class="product-card" style="animation-delay: <?= $i * 0.04 ?>s"
                        data-name="<?= htmlspecialchars($p->name) ?>" data-desc="<?= htmlspecialchars($p->description) ?>"
                        data-price="<?= number_format($p->price, 2) ?>"
                        data-img="<?= base_url('uploads/catalog/' . $p->image) ?>">

                        <div class="product-img-wrap">
                            <img src="<?= base_url('uploads/catalog/' . $p->image) ?>" alt="<?= htmlspecialchars($p->name) ?>"
                                loading="lazy">
                            <div class="img-overlay">
                                <button class="quick-view-btn" onclick="openModal(this.closest('.product-card'))">
                                    <i class="fas fa-eye"></i> Quick View
                                </button>
                            </div>
                        </div>

                        <div class="product-info">
                            <h4 class="product-name"><?= htmlspecialchars($p->name) ?></h4>
                            <p class="product-desc"><?= htmlspecialchars($p->description) ?></p>
                            <div class="product-bottom">
                                <div class="product-price">
                                    <span class="currency">₹</span><?= number_format($p->price, 2) ?>
                                </div>
                                <a href="<?= base_url('index.php/publiccatalog/product_detail/' . $p->id) ?>"
                                    class="inquiry-btn">
                                    <i class="fas fa-eye"></i> <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>No Products Yet</h3>
                    <p>This store hasn't added any products yet. Check back later!</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- ===== PAGINATION ===== -->
        <div class="pagination-wrapper">
            <?= $pagination ?>
        </div>

        <!-- ===== FOOTER ===== -->
        <!-- <div class="catalog-footer">
            &copy; <?= date('Y') ?> <?= htmlspecialchars($vendor->store_name ?? 'Store') ?>. All rights reserved.
        </div> -->
    </div>

    <!-- ===== PRODUCT MODAL ===== -->
    <div class="modal-backdrop" id="productModal">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
            <img src="" alt="" class="modal-img" id="modalImg">
            <div class="modal-body">
                <h3 id="modalName"></h3>
                <p class="modal-desc" id="modalDesc"></p>
                <div class="modal-price">
                    <span class="currency">₹</span><span id="modalPrice"></span>
                </div>
                <?php if (!empty($vendor->mobile)): ?>
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $vendor->mobile) ?>?text=Hi%2C%20I%27m%20interested%20in%20a%20product"
                        target="_blank" style="text-decoration: none;">
                        <button class="modal-contact-btn">
                            <i class="fab fa-whatsapp"></i> Contact on WhatsApp
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Scroll Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // ===== VIEW TOGGLE =====
        const grid = document.getElementById('productGrid');
        const gridBtn = document.getElementById('gridViewBtn');
        const listBtn = document.getElementById('listViewBtn');

        gridBtn.addEventListener('click', () => {
            grid.classList.remove('list-view');
            gridBtn.classList.add('active');
            listBtn.classList.remove('active');
        });

        listBtn.addEventListener('click', () => {
            grid.classList.add('list-view');
            listBtn.classList.add('active');
            gridBtn.classList.remove('active');
        });

        // ===== SEARCH =====
        document.getElementById('searchInput').addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('.product-card').forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const desc = (card.getAttribute('data-desc') || '').toLowerCase();
                card.style.display = (name.includes(q) || desc.includes(q)) ? '' : 'none';
            });
        });

        // ===== MODAL =====
        function openModal(card) {
            const modal = document.getElementById('productModal');
            document.getElementById('modalImg').src = card.getAttribute('data-img');
            document.getElementById('modalName').textContent = card.getAttribute('data-name');
            document.getElementById('modalDesc').textContent = card.getAttribute('data-desc');
            document.getElementById('modalPrice').textContent = card.getAttribute('data-price');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close on backdrop click
        document.getElementById('productModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });

        // ===== SCROLL TO TOP =====
        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            scrollBtn.classList.toggle('visible', window.scrollY > 400);
        });
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>

</html>