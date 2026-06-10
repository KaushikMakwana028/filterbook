<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product->name) ?> — <?= htmlspecialchars($vendor->store_name) ?></title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #eef2ff;
            --success: #10b981;
            --success-dark: #059669;
            --whatsapp: #25d366;
            --whatsapp-dark: #1ebe5d;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --radius: 16px;
            --radius-lg: 24px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
            --shadow-lg: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 32px 64px -16px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f0f2ff 0%, #e8f4f8 50%, #f0fdf4 100%);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            color: var(--slate-800);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: -30%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ═══════════ PRODUCT CARD ═══════════ */
        .product-card {
            max-width: 960px;
            width: 100%;
            background: #fff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            display: grid;
            grid-template-columns: 420px 1fr;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.8);
            animation: cardEntrance 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ═══════════ IMAGE SECTION ═══════════ */
        .image-section {
            position: relative;
            background: var(--slate-100);
            overflow: hidden;
        }

        .image-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 60%, rgba(0, 0, 0, 0.04) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .product-image {
            width: 100%;
            height: 100%;
            min-height: 480px;
            object-fit: cover;
            display: block;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover .product-image {
            transform: scale(1.03);
        }

        .image-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 3;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .badge.featured {
            background: rgba(99, 102, 241, 0.9);
            color: #fff;
        }

        .badge.in-stock {
            background: rgba(16, 185, 129, 0.9);
            color: #fff;
        }

        .badge i {
            font-size: 14px;
        }

        /* ═══════════ INFO SECTION ═══════════ */
        .info-section {
            padding: 36px 36px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0;
        }

        /* Store Header */
        .store-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--slate-100);
        }

        .store-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: grid;
            place-items: center;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }

        .store-details h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--slate-800);
            letter-spacing: -0.2px;
        }

        .store-details span {
            font-size: 0.75rem;
            color: var(--slate-400);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .store-details span i {
            font-size: 13px;
            color: var(--success);
        }

        /* Product Title */
        .product-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.5px;
            line-height: 1.25;
            margin-bottom: 14px;
        }

        /* Description */
        .product-desc {
            font-size: 0.9rem;
            color: var(--slate-500);
            line-height: 1.7;
            margin-bottom: 24px;
            max-width: 480px;
        }

        /* Price Block */
        .price-block {
            background: linear-gradient(135deg, var(--primary-light), rgba(99, 102, 241, 0.04));
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .price-main {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .price-currency {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .price-amount {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--primary-dark);
            letter-spacing: -1px;
            line-height: 1;
        }

        .price-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--slate-400);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .price-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 10px;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-dark);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .price-tag i {
            font-size: 16px;
        }

        /* Features (optional) */
        .features {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--slate-600);
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-size: 16px;
            background: var(--slate-100);
            color: var(--slate-500);
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .btn-wa {
            flex: 1;
            min-width: 200px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px 28px;
            border-radius: 14px;
            font-size: 0.92rem;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            letter-spacing: -0.2px;
            background: linear-gradient(135deg, #25d366, #1ebe5d);
            color: #fff;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
        }

        .btn-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(37, 211, 102, 0.35);
            color: #fff;
        }

        .btn-wa:active {
            transform: translateY(-1px);
        }

        .btn-wa i {
            font-size: 22px;
        }

        .btn-share {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 22px;
            background: #fff;
            border: 1.5px solid var(--slate-200);
            color: var(--slate-500);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            flex-shrink: 0;
        }

        .btn-share:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* Footer Note */
        .card-footer-note {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            color: var(--slate-400);
            font-weight: 500;
            padding-top: 16px;
            border-top: 1px solid var(--slate-100);
        }

        .card-footer-note i {
            font-size: 16px;
            color: var(--success);
        }

        /* ═══════════ BACK LINK ═══════════ */
        .back-link {
            position: fixed;
            top: 24px;
            left: 24px;
            z-index: 100;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid var(--slate-200);
            color: var(--slate-700);
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .back-link:hover {
            background: #fff;
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            color: var(--primary);
        }

        .back-link i {
            font-size: 18px;
        }

        /* ═══════════ SHARE TOAST ═══════════ */
        .share-toast {
            position: fixed;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: var(--slate-900);
            color: #fff;
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 200;
            box-shadow: var(--shadow-xl);
            pointer-events: none;
        }

        .share-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .share-toast i {
            font-size: 20px;
            color: var(--success);
        }

        /* ═══════════ RESPONSIVE ═══════════ */
        @media (max-width: 860px) {
            body {
                padding: 16px 12px;
                align-items: flex-start;
            }

            .product-card {
                grid-template-columns: 1fr;
                max-width: 520px;
            }

            .image-section {
                max-height: 380px;
            }

            .product-image {
                min-height: 320px;
                max-height: 380px;
            }

            .info-section {
                padding: 28px 24px 28px;
            }

            .product-title {
                font-size: 1.4rem;
            }

            .price-amount {
                font-size: 1.9rem;
            }

            .back-link {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 12px;
                display: inline-flex;
                width: auto;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 12px 8px;
            }

            .product-card {
                border-radius: 18px;
            }

            .info-section {
                padding: 22px 18px 24px;
            }

            .product-title {
                font-size: 1.25rem;
            }

            .price-block {
                padding: 16px 18px;
                flex-direction: column;
                align-items: flex-start;
            }

            .price-amount {
                font-size: 1.7rem;
            }

            .store-header {
                margin-bottom: 16px;
                padding-bottom: 14px;
            }

            .features {
                gap: 10px;
            }

            .actions {
                flex-direction: column;
            }

            .btn-share {
                width: 100%;
                height: 48px;
            }

            .btn-wa {
                min-width: unset;
            }

            .image-section {
                max-height: 300px;
            }

            .product-image {
                min-height: 260px;
                max-height: 300px;
            }

            .image-badge {
                top: 14px;
                left: 14px;
            }
        }
    </style>
</head>

<body>

    <?php
    $storeInitial = strtoupper(substr($vendor->store_name, 0, 1));
    $whatsappUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $vendor->mobile) . '?text=' . rawurlencode("Hi! I'm interested in *" . $product->name . "* (₹" . number_format($product->price, 0) . "). Can you share more details?");
    $shareUrl = current_url();
    ?>

    <!-- Back Link -->
    <a href="javascript:history.back()" class="back-link">
        <i class="bx bx-arrow-back"></i> Back to Catalog
    </a>

    <!-- Product Card -->
    <div class="product-card">

        <!-- Image Section -->
        <div class="image-section">
            <div class="image-badge">
                <span class="badge featured"><i class="bx bxs-star"></i> Featured</span>
                <span class="badge in-stock"><i class="bx bxs-check-circle"></i> In Stock</span>
            </div>
            <img class="product-image" src="<?= base_url('uploads/catalog/' . $product->image) ?>"
                alt="<?= htmlspecialchars($product->name) ?>">
        </div>

        <!-- Info Section -->
        <div class="info-section">

            <!-- Store Header -->
            <div class="store-header">
                <div class="store-avatar"><?= $storeInitial ?></div>
                <div class="store-details">
                    <h4><?= htmlspecialchars($vendor->store_name) ?></h4>
                    <span><i class="bx bxs-check-circle"></i> Verified Seller</span>
                </div>
            </div>

            <!-- Product Title -->
            <h1 class="product-title"><?= htmlspecialchars($product->name) ?></h1>

            <!-- Description -->
            <p class="product-desc"><?= htmlspecialchars($product->description) ?></p>

            <!-- Price Block -->
            <div class="price-block">
                <div>
                    <div class="price-label">Price</div>
                    <div class="price-main">
                        <span class="price-currency">₹</span>
                        <span class="price-amount"><?= number_format($product->price, 0) ?></span>
                    </div>
                </div>
                <div class="price-tag">
                    <i class="bx bxs-offer"></i> Best Price
                </div>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon"><i class="bx bxs-truck"></i></div>
                    Fast Delivery
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bx bxs-shield-alt-2"></i></div>
                    Genuine Product
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bx bxs-credit-card"></i></div>
                    EMI Available
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="<?= $whatsappUrl ?>" target="_blank" class="btn-wa">
                    <i class="bx bxl-whatsapp"></i> Contact on WhatsApp
                </a>
                <button class="btn-share" id="shareBtn" title="Share this product">
                    <i class="bx bx-share-alt"></i>
                </button>
            </div>

            <!-- Footer Note -->
            <div class="card-footer-note">
                <i class="bx bxs-lock-alt"></i>
                Secure &amp; trusted — contact directly via WhatsApp for fastest response.
            </div>
        </div>
    </div>

    <!-- Share Toast -->
    <div class="share-toast" id="shareToast">
        <i class="bx bx-check-circle"></i>
        Link copied to clipboard!
    </div>

    <script>
        document.getElementById('shareBtn').addEventListener('click', async function () {
            const shareData = {
                title: '<?= addslashes(htmlspecialchars($product->name)) ?>',
                text: 'Check out <?= addslashes(htmlspecialchars($product->name)) ?> at ₹<?= number_format($product->price, 0) ?> from <?= addslashes(htmlspecialchars($vendor->store_name)) ?>',
                url: window.location.href
            };

            if (navigator.share) {
                try {
                    await navigator.share(shareData);
                } catch (e) {
                    fallbackCopy();
                }
            } else {
                fallbackCopy();
            }
        });

        function fallbackCopy() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                showToast();
            }).catch(() => {
                // Fallback for older browsers
                const ta = document.createElement('textarea');
                ta.value = window.location.href;
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                showToast();
            });
        }

        function showToast() {
            const toast = document.getElementById('shareToast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }

        // Smooth image load
        const img = document.querySelector('.product-image');
        if (img.complete) {
            img.style.opacity = 1;
        } else {
            img.style.opacity = 0;
            img.style.transition = 'opacity 0.5s ease';
            img.addEventListener('load', () => { img.style.opacity = 1; });
        }
    </script>
</body>

</html>