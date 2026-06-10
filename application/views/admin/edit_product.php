<style>
    /* ========== Design System Variables ========== */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
        --danger-gradient: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        --card-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
        --card-hover-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        --border-radius-lg: 20px;
        --border-radius-md: 14px;
        --border-radius-sm: 10px;
        --transition-smooth: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    /* ========== Animations ========== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(0.8);
            opacity: 0.5;
        }

        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* ========== Breadcrumb ========== */
    .page-breadcrumb {
        animation: fadeInDown 0.5s ease;
        margin-bottom: 1.5rem;
    }

    .breadcrumb-title {
        font-size: 1.4rem;
        font-weight: 700;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        padding-right: 15px;
    }

    .breadcrumb-title::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 35px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
        transition: var(--transition-smooth);
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: #667eea;
    }

    .breadcrumb-item.active {
        color: #495057;
        font-weight: 600;
    }

    /* ========== Flash Messages ========== */
    .alert-enhanced {
        border: none;
        border-radius: var(--border-radius-md);
        padding: 16px 20px;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.4s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        backdrop-filter: blur(10px);
    }

    .alert-enhanced.alert-success {
        background: linear-gradient(135deg, rgba(17, 153, 142, 0.08) 0%, rgba(56, 239, 125, 0.08) 100%);
        border-left: 4px solid #11998e;
        color: #065f46;
    }

    .alert-enhanced.alert-danger {
        background: linear-gradient(135deg, rgba(235, 51, 73, 0.08) 0%, rgba(244, 92, 67, 0.08) 100%);
        border-left: 4px solid #eb3349;
        color: #991b1b;
    }

    .alert-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.2rem;
    }

    .alert-success .alert-icon {
        background: var(--success-gradient);
        color: #fff;
    }

    .alert-danger .alert-icon {
        background: var(--danger-gradient);
        color: #fff;
    }

    /* ========== Main Card ========== */
    .product-card {
        border: none;
        border-radius: var(--border-radius-lg);
        background: #fff;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        animation: fadeInUp 0.6s ease 0.1s both;
        position: relative;
    }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--primary-gradient);
    }

    /* Card Header */
    .card-header-enhanced {
        background: var(--primary-gradient);
        padding: 30px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .card-header-enhanced::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .card-header-enhanced::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: 10%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-icon-wrapper {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition-smooth);
    }

    .header-icon-wrapper:hover {
        transform: rotate(10deg) scale(1.1);
        background: rgba(255, 255, 255, 0.3);
    }

    .header-icon-wrapper i {
        font-size: 1.6rem;
        color: #fff;
    }

    .header-text h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 4px;
    }

    .header-text p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .product-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #fff;
        margin-top: 6px;
        backdrop-filter: blur(5px);
    }

    /* Card Body */
    .card-body-enhanced {
        padding: 36px;
    }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f3f4f6;
    }

    .section-header i {
        color: #667eea;
        font-size: 1.3rem;
    }

    .section-header h6 {
        font-weight: 700;
        color: #374151;
        margin-bottom: 0;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .form-grid.full-width {
        grid-template-columns: 1fr;
    }

    /* Form Group */
    .form-group-enhanced {
        position: relative;
    }

    .form-label-enhanced {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 0.85rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .form-label-enhanced i {
        color: #667eea;
        font-size: 0.95rem;
    }

    .required-star {
        color: #ef4444;
        font-size: 0.75rem;
        margin-left: 2px;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.1rem;
        transition: var(--transition-smooth);
        pointer-events: none;
        z-index: 2;
    }

    .form-control-enhanced {
        width: 100%;
        padding: 14px 16px 14px 46px;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.95rem;
        font-weight: 500;
        color: #1f2937;
        background: #fff;
        transition: var(--transition-smooth);
        outline: none;
    }

    .form-control-enhanced:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: #fff;
    }

    .form-control-enhanced:focus+.input-icon,
    .form-control-enhanced:not(:placeholder-shown)+.input-icon {
        color: #667eea;
    }

    .form-control-enhanced::placeholder {
        color: #d1d5db;
        font-weight: 400;
    }

    /* Select Enhanced */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper .input-icon {
        left: 16px;
    }

    .select-wrapper .select-arrow {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.2rem;
        pointer-events: none;
        transition: var(--transition-smooth);
    }

    .form-select-enhanced {
        width: 100%;
        padding: 14px 40px 14px 46px;
        border: 2px solid #e5e7eb;
        border-radius: var(--border-radius-md);
        font-size: 0.95rem;
        font-weight: 500;
        color: #1f2937;
        background: #fff;
        transition: var(--transition-smooth);
        outline: none;
        appearance: none;
        cursor: pointer;
    }

    .form-select-enhanced:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-select-enhanced:focus~.select-arrow {
        color: #667eea;
        transform: translateY(-50%) rotate(180deg);
    }

    /* Number Input with Controls */
    .number-input-wrapper {
        position: relative;
    }

    .number-input-wrapper .form-control-enhanced {
        padding-right: 80px;
    }

    .number-controls {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .number-btn {
        width: 24px;
        height: 18px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 0.7rem;
        cursor: pointer;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-smooth);
    }

    .number-btn:hover {
        background: #667eea;
        color: #fff;
    }

    /* Price Input */
    .price-input-wrapper {
        position: relative;
    }

    .price-input-wrapper .currency-symbol {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-weight: 700;
        font-size: 1rem;
        z-index: 2;
    }

    .price-input-wrapper .form-control-enhanced {
        padding-left: 36px;
    }

    /* Stock Status Badge */
    .stock-status {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        pointer-events: none;
    }

    .stock-status.in-stock {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .stock-status.low-stock {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .stock-status.out-of-stock {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-top: 24px;
        border-top: 2px solid #f3f4f6;
        margin-top: 10px;
    }

    .btn-enhanced {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 28px;
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--transition-smooth);
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-enhanced i {
        font-size: 1.1rem;
        transition: var(--transition-smooth);
    }

    /* Primary Button */
    .btn-primary-enhanced {
        background: var(--primary-gradient);
        color: #fff;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-primary-enhanced:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(102, 126, 234, 0.45);
        color: #fff;
    }

    .btn-primary-enhanced:hover i {
        transform: translateX(3px);
    }

    .btn-primary-enhanced:active {
        transform: translateY(0);
    }

    /* Loading State */
    .btn-primary-enhanced.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-primary-enhanced.loading .btn-text {
        opacity: 0;
    }

    .btn-primary-enhanced.loading .btn-loader {
        position: absolute;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Secondary Button */
    .btn-secondary-enhanced {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        color: #4b5563;
        border: 2px solid #e5e7eb;
    }

    .btn-secondary-enhanced:hover {
        background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
        border-color: #d1d5db;
        color: #374151;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
    }

    /* Back Link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #6b7280;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: var(--transition-smooth);
        padding: 8px 0;
        margin-left: auto;
    }

    .back-link:hover {
        color: #667eea;
    }

    .back-link i {
        transition: var(--transition-smooth);
    }

    .back-link:hover i {
        transform: translateX(-3px);
    }

    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
        border-radius: var(--border-radius-md);
        padding: 20px;
        margin-top: 24px;
        border: 1px solid #e0e7ff;
    }

    .info-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .info-card-header i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .info-card-header h6 {
        font-weight: 700;
        color: #374151;
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .info-card-body {
        font-size: 0.85rem;
        color: #6b7280;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body-enhanced {
            padding: 24px;
        }

        .card-header-enhanced {
            padding: 24px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-enhanced {
            width: 100%;
        }

        .header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .back-link {
            margin-left: 0;
        }
    }

    /* Validation States */
    .form-control-enhanced.is-valid {
        border-color: #10b981;
    }

    .form-control-enhanced.is-valid:focus {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    .form-control-enhanced.is-invalid {
        border-color: #ef4444;
    }

    .form-control-enhanced.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .form-select-enhanced.is-invalid {
        border-color: #ef4444;
    }

    .form-select-enhanced.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .validation-feedback {
        font-size: 0.78rem;
        font-weight: 500;
        margin-top: 6px;
        display: none;
    }

    .validation-feedback.show {
        display: block;
        animation: fadeInUp 0.2s ease;
    }

    .validation-feedback.error {
        color: #ef4444;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <!-- ========== Breadcrumb ========== -->
        <div class="page-breadcrumb d-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('admin/product'); ?>">Product List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- ========== Flash Messages ========== -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert-enhanced alert-success" role="alert">
                <div class="alert-icon">
                    <i class="bx bx-check"></i>
                </div>
                <div>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert-enhanced alert-danger" role="alert">
                <div class="alert-icon">
                    <i class="bx bx-error"></i>
                </div>
                <div>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- ========== Edit Card ========== -->
        <div class="card product-card">

            <!-- Card Header -->
            <div class="card-header-enhanced">
                <div class="header-content">
                    <div class="header-icon-wrapper">
                        <i class="bx bx-edit-alt"></i>
                    </div>
                    <div class="header-text">
                        <h5>Edit Product</h5>
                        <p>Update product details, pricing, and inventory</p>
                        <span class="product-id-badge">
                            <i class="bx bx-hash"></i> ID: <?php echo $product->id; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body-enhanced">
                <form method="post" action="<?php echo site_url('admin/product/update/' . $product->id); ?>"
                    id="editForm">

                    <!-- Section: Product Details -->
                    <div class="section-header">
                        <i class="bx bx-info-circle"></i>
                        <h6>Product Details</h6>
                    </div>

                    <div class="form-grid">
                        <div class="form-group-enhanced full-width">
                            <label class="form-label-enhanced" for="productName">
                                <i class="bx bx-package"></i>
                                Product Name
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" name="name" id="productName" class="form-control-enhanced"
                                    value="<?php echo htmlspecialchars($product->name); ?>"
                                    placeholder="e.g., Wireless Bluetooth Headphones" required>
                                <i class="bx bx-tag input-icon"></i>
                            </div>
                            <div class="validation-feedback error" id="productNameError">Please enter product name.
                            </div>
                        </div>

                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="category">
                                <i class="bx bx-category"></i>
                                Category
                                <span class="required-star">*</span>
                            </label>
                            <div class="select-wrapper">
                                <select name="category_id" id="category" class="form-select-enhanced" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat->id; ?>" <?php if ($cat->id == $product->category_id)
                                               echo "selected"; ?>>
                                            <?php echo htmlspecialchars($cat->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="bx bx-category input-icon"></i>
                                <i class="bx bx-chevron-down select-arrow"></i>
                            </div>
                            <div class="validation-feedback error" id="categoryError">Please select a category.</div>
                        </div>

                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="brand">
                                <i class="bx bx-label"></i>
                                Brand
                            </label>
                            <div class="input-wrapper">
                                <input type="text" name="brand" id="brand" class="form-control-enhanced"
                                    value="<?php echo htmlspecialchars($product->brand); ?>"
                                    placeholder="e.g., Sony, Apple, Samsung">
                                <i class="bx bx-badge input-icon"></i>
                            </div>
                        </div>

                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="unit">
                                <i class="bx bx-ruler"></i>
                                Unit
                                <span class="required-star">*</span>
                            </label>
                            <div class="select-wrapper">
                                <select name="unit" id="unit" class="form-select-enhanced" required>
                                    <?php
                                    $unitOptions = [
                                        'pcs' => 'PCS',
                                        'box' => 'BOX',
                                        'liter' => 'LITER',
                                        'kg' => 'KG',
                                    ];
                                    $selectedUnit = strtolower((string) $product->unit);
                                    ?>
                                    <option value="">Select Unit</option>
                                    <?php foreach ($unitOptions as $unitValue => $unitLabel): ?>
                                        <option value="<?php echo $unitValue; ?>" <?php echo $selectedUnit === $unitValue ? 'selected' : ''; ?>>
                                            <?php echo $unitLabel; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="bx bx-cube input-icon"></i>
                                <i class="bx bx-chevron-down select-arrow"></i>
                            </div>
                            <div class="validation-feedback error" id="unitError">Please select a unit type.</div>
                        </div>
                    </div>

                    <!-- Section: Pricing & Inventory -->
                    <div class="section-header">
                        <i class="bx bx-dollar-circle"></i>
                        <h6>Pricing & Inventory</h6>
                    </div>

                    <div class="form-grid">
                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="quantity">
                                <i class="bx bx-box"></i>
                                Quantity
                                <span class="required-star">*</span>
                            </label>
                            <div class="number-input-wrapper">
                                <input type="number" name="quantity" id="quantity" class="form-control-enhanced"
                                    value="<?php echo $product->quantity; ?>" min="0" required>
                                <i class="bx bx-layer input-icon"></i>
                                <div class="number-controls">
                                    <button type="button" class="number-btn" onclick="adjustQuantity(1)">
                                        <i class="bx bx-chevron-up"></i>
                                    </button>
                                    <button type="button" class="number-btn" onclick="adjustQuantity(-1)">
                                        <i class="bx bx-chevron-down"></i>
                                    </button>
                                </div>
                                <span class="stock-status <?php echo getStockStatus($product->quantity); ?>"
                                    id="stockStatus">
                                    <i class="bx bx-circle"></i>
                                    <span id="stockText"><?php echo getStockText($product->quantity); ?></span>
                                </span>
                            </div>
                            <div class="validation-feedback error" id="quantityError">Please enter a valid quantity.
                            </div>
                        </div>

                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="purchasePrice">
                                <i class="bx bx-purchase-tag"></i>
                                Purchase Price
                                <span class="required-star">*</span>
                            </label>
                            <div class="price-input-wrapper">
                                <input type="number" name="purchase_price" id="purchasePrice"
                                    class="form-control-enhanced" value="<?php echo $product->purchase_price; ?>"
                                    min="0" step="0.01" placeholder="0.00" required>
                                <span class="currency-symbol">$</span>
                            </div>
                            <div class="validation-feedback error" id="purchasePriceError">Please enter a valid purchase
                                price.</div>
                        </div>

                        <div class="form-group-enhanced">
                            <label class="form-label-enhanced" for="sellPrice">
                                <i class="bx bx-wallet"></i>
                                Sell Price
                            </label>
                            <div class="price-input-wrapper">
                                <input type="number" name="sell_price" id="sellPrice" class="form-control-enhanced"
                                    value="<?php echo $product->sell_price !== null ? $product->sell_price : ''; ?>"
                                    min="0" step="0.01" placeholder="0.00">
                                <span class="currency-symbol">$</span>
                            </div>
                            <div class="validation-feedback error" id="sellPriceError">Please enter a valid sell price.
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="bx bx-info-circle"></i>
                            <h6>Product Guidelines</h6>
                        </div>
                        <div class="info-card-body">
                            <ul>
                                <li>Ensure product name is clear and descriptive</li>
                                <li>Quantity below 10 will trigger low stock warning</li>
                                <li>Price should be entered without currency symbols</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn-enhanced btn-primary-enhanced" id="submitBtn">
                            <span class="btn-text">
                                <i class="bx bx-save"></i> Update Product
                            </span>
                            <span class="btn-loader"></span>
                        </button>

                        <a href="<?php echo site_url('admin/product'); ?>" class="btn-enhanced btn-secondary-enhanced">
                            <i class="bx bx-x"></i> Cancel
                        </a>

                        <a href="<?php echo site_url('admin/product'); ?>" class="back-link">
                            <i class="bx bx-arrow-back"></i> Back to List
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<?php
// Helper functions for stock status
function getStockStatus($quantity)
{
    if ($quantity <= 0)
        return 'out-of-stock';
    if ($quantity <= 10)
        return 'low-stock';
    return 'in-stock';
}

function getStockText($quantity)
{
    if ($quantity <= 0)
        return 'Out of Stock';
    if ($quantity <= 10)
        return 'Low Stock';
    return 'In Stock';
}
?>

<!-- ========== JavaScript ========== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productName = document.getElementById('productName');
        const category = document.getElementById('category');
        const unit = document.getElementById('unit');
        const quantity = document.getElementById('quantity');
        const purchasePrice = document.getElementById('purchasePrice');
        const sellPrice = document.getElementById('sellPrice');
        const stockStatus = document.getElementById('stockStatus');
        const stockText = document.getElementById('stockText');
        const editForm = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');

        function showFieldError(input, errorId, message) {
            if (!input) return;
            input.classList.add('is-invalid');
            const errorEl = document.getElementById(errorId);
            if (errorEl) {
                if (message) {
                    errorEl.textContent = message;
                }
                errorEl.classList.add('show');
            }
        }

        function clearFieldError(input, errorId) {
            if (!input) return;
            input.classList.remove('is-invalid');
            const errorEl = document.getElementById(errorId);
            if (errorEl) {
                errorEl.classList.remove('show');
            }
        }

        // ===== Auto-focus on load =====
        if (productName) {
            productName.focus();
            productName.setSelectionRange(productName.value.length, productName.value.length);
        }

        // ===== Quantity Adjustment =====
        window.adjustQuantity = function (delta) {
            const currentValue = parseInt(quantity.value) || 0;
            const newValue = Math.max(0, currentValue + delta);
            quantity.value = newValue;
            updateStockStatus(newValue);

            // Trigger input event for validation
            quantity.dispatchEvent(new Event('input'));
        };

        // ===== Update Stock Status =====
        function updateStockStatus(qty) {
            stockStatus.className = 'stock-status';

            if (qty <= 0) {
                stockStatus.classList.add('out-of-stock');
                stockText.textContent = 'Out of Stock';
            } else if (qty <= 10) {
                stockStatus.classList.add('low-stock');
                stockText.textContent = 'Low Stock';
            } else {
                stockStatus.classList.add('in-stock');
                stockText.textContent = 'In Stock';
            }
        }

        // ===== Quantity Input Listener =====
        if (quantity) {
            quantity.addEventListener('input', function () {
                updateStockStatus(parseInt(this.value) || 0);
            });

            // Initialize stock status
            updateStockStatus(parseInt(quantity.value) || 0);
        }

        // ===== Price Formatting =====
        if (purchasePrice) {
            purchasePrice.addEventListener('blur', function () {
                const value = parseFloat(this.value);
                if (!isNaN(value)) {
                    this.value = value.toFixed(2);
                }
            });
        }

        if (sellPrice) {
            sellPrice.addEventListener('blur', function () {
                if (this.value === '') {
                    return;
                }

                const value = parseFloat(this.value);
                if (!isNaN(value)) {
                    this.value = value.toFixed(2);
                }
            });
        }

        // ===== Form Submit with Loading State =====
        if (editForm) {
            editForm.addEventListener('submit', function (e) {
                let isValid = true;

                clearFieldError(productName, 'productNameError');
                clearFieldError(category, 'categoryError');
                clearFieldError(unit, 'unitError');
                clearFieldError(quantity, 'quantityError');
                clearFieldError(purchasePrice, 'purchasePriceError');
                clearFieldError(sellPrice, 'sellPriceError');

                if (!productName.value.trim()) {
                    showFieldError(productName, 'productNameError', 'Please enter product name.');
                    isValid = false;
                }

                if (!category.value) {
                    showFieldError(category, 'categoryError', 'Please select a category.');
                    isValid = false;
                }

                if (!unit.value) {
                    showFieldError(unit, 'unitError', 'Please select a unit type.');
                    isValid = false;
                }

                if (!quantity.value || parseInt(quantity.value) < 0) {
                    showFieldError(quantity, 'quantityError', 'Please enter a valid quantity.');
                    isValid = false;
                }

                if (!purchasePrice.value || parseFloat(purchasePrice.value) < 0) {
                    showFieldError(purchasePrice, 'purchasePriceError', 'Please enter a valid purchase price.');
                    isValid = false;
                }

                if (sellPrice.value && parseFloat(sellPrice.value) < 0) {
                    showFieldError(sellPrice, 'sellPriceError', 'Please enter a valid sell price.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    const firstInvalid = editForm.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.focus();
                    }
                    return;
                }

                // Show loading state
                submitBtn.classList.add('loading');
            });
        }

        // ===== Remove validation on input =====
        document.querySelectorAll('.form-control-enhanced, .form-select-enhanced').forEach(function (input) {
            input.addEventListener('input', function () {
                this.classList.remove('is-invalid');
                const errorId = this.id ? this.id + 'Error' : null;
                if (errorId) {
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) {
                        errorEl.classList.remove('show');
                    }
                }
            });

            input.addEventListener('change', function () {
                this.classList.remove('is-invalid');
                const errorId = this.id ? this.id + 'Error' : null;
                if (errorId) {
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) {
                        errorEl.classList.remove('show');
                    }
                }
            });

            input.addEventListener('focus', function () {
                this.parentElement.style.transform = 'scale(1.01)';
            });

            input.addEventListener('blur', function () {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // ===== Auto-dismiss Flash Messages =====
        document.querySelectorAll('.alert-enhanced').forEach(function (alert) {
            setTimeout(function () {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                if (bsAlert) {
                    bsAlert.close();
                }
            }, 5000);
        });

        // ===== Animate form groups on load =====
        document.querySelectorAll('.form-group-enhanced').forEach(function (group, index) {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            setTimeout(function () {
                group.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 100 + (index * 50));
        });
    });
</script>