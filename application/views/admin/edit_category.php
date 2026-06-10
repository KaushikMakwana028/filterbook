
<style>
    /* ========== Design System Variables ========== */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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

    @keyframes checkmark {
        0% {
            transform: scale(0) rotate(45deg);
            opacity: 0;
        }
        50% {
            transform: scale(1.2) rotate(45deg);
        }
        100% {
            transform: scale(1) rotate(45deg);
            opacity: 1;
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
        background: var(--secondary-gradient);
        color: #fff;
    }

    /* ========== Main Card ========== */
    .edit-card {
        border: none;
        border-radius: var(--border-radius-lg);
        background: #fff;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        animation: fadeInUp 0.6s ease 0.1s both;
        position: relative;
    }

    .edit-card::before {
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

    .category-id-badge {
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

    /* Form Group */
    .form-group-enhanced {
        margin-bottom: 28px;
        position: relative;
    }

    .form-label-enhanced {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .form-label-enhanced i {
        color: #667eea;
        font-size: 1rem;
    }

    .required-star {
        color: #ef4444;
        font-size: 0.8rem;
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
        font-size: 1.2rem;
        transition: var(--transition-smooth);
        pointer-events: none;
        z-index: 2;
    }

    .form-control-enhanced {
        width: 100%;
        padding: 16px 16px 16px 48px;
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

    .form-control-enhanced:focus + .input-icon,
    .form-control-enhanced:not(:placeholder-shown) + .input-icon {
        color: #667eea;
    }

    .form-control-enhanced::placeholder {
        color: #d1d5db;
        font-weight: 400;
    }

    /* Slug Preview */
    .slug-preview {
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
        border-radius: var(--border-radius-sm);
        border: 1px dashed #c7d2fe;
        transition: var(--transition-smooth);
    }

    .slug-preview:hover {
        border-style: solid;
        border-color: #a5b4fc;
        background: #eef2ff;
    }

    .slug-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .slug-value {
        font-size: 0.85rem;
        font-weight: 600;
        color: #667eea;
        font-family: 'Courier New', monospace;
        word-break: break-all;
    }

    .slug-value::before {
        content: '/category/';
        color: #9ca3af;
        font-weight: 500;
        margin-right: 4px;
    }

    /* Character Counter */
    .char-counter {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.75rem;
        font-weight: 600;
        color: #9ca3af;
        transition: var(--transition-smooth);
        pointer-events: none;
    }

    .form-control-enhanced:focus ~ .char-counter {
        color: #667eea;
    }

    .char-counter.warning {
        color: #f59e0b;
    }

    .char-counter.danger {
        color: #ef4444;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-top: 20px;
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
        to { transform: rotate(360deg); }
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

    .info-card-body ul {
        margin: 8px 0 0 0;
        padding-left: 18px;
    }

    .info-card-body li {
        margin-bottom: 4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body-enhanced {
            padding: 24px;
        }

        .card-header-enhanced {
            padding: 24px;
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

        .char-counter {
            top: auto;
            bottom: -22px;
            right: 0;
            transform: none;
        }

        .form-group-enhanced {
            margin-bottom: 32px;
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

    .validation-feedback.success {
        color: #10b981;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <!-- ========== Breadcrumb ========== -->
        <div class="page-breadcrumb d-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Categories</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('admin/category'); ?>">Category List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
        <div class="card edit-card">

            <!-- Card Header -->
            <div class="card-header-enhanced">
                <div class="header-content">
                    <div class="header-icon-wrapper">
                        <i class="bx bx-edit-alt"></i>
                    </div>
                    <div class="header-text">
                        <h5>Edit Category</h5>
                        <p>Update category details and manage organization</p>
                        <span class="category-id-badge">
                            <i class="bx bx-hash"></i> ID: <?php echo $category->id; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body-enhanced">
                <form method="post" action="<?php echo base_url('index.php/admin/category/update/' . $category->id); ?>" id="editForm">

                    <div class="form-group-enhanced">
                        <label class="form-label-enhanced" for="categoryName">
                            <i class="bx bx-category"></i>
                            Category Name
                            <span class="required-star">*</span>
                        </label>

                        <div class="input-wrapper">
                            <input type="text" 
                                   name="name" 
                                   id="categoryName" 
                                   class="form-control-enhanced" 
                                   value="<?php echo htmlspecialchars($category->name); ?>"
                                   placeholder="e.g., Electronics, Clothing, Books"
                                   required
                                   maxlength="100"
                                   autocomplete="off">
                            <i class="bx bx-tag input-icon"></i>
                            <span class="char-counter" id="charCounter">
                                <?php echo strlen($category->name); ?>/100
                            </span>
                        </div>

                        <!-- Slug Preview -->
                        <div class="slug-preview" id="slugPreview">
                            <span class="slug-label">URL Slug:</span>
                            <span class="slug-value" id="slugValue">
                                <?php echo url_title($category->name, '-', TRUE); ?>
                            </span>
                            <i class="bx bx-copy text-muted" style="cursor: pointer; font-size: 0.9rem;" 
                               title="Copy slug" onclick="copySlug()"></i>
                        </div>

                        <!-- Validation Feedback -->
                        <div class="validation-feedback error" id="nameError">
                            <i class="bx bx-error-circle me-1"></i> Category name is required
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="bx bx-info-circle"></i>
                            <h6>Category Guidelines</h6>
                        </div>
                        <div class="info-card-body">
                            <ul>
                                <li>Use clear, descriptive names for better SEO</li>
                                <li>Avoid special characters in category names</li>
                                <li>URL slug is automatically generated from the name</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn-enhanced btn-primary-enhanced" id="submitBtn">
                            <span class="btn-text">
                                <i class="bx bx-save"></i> Update Category
                            </span>
                            <span class="btn-loader"></span>
                        </button>

                        <a href="<?php echo base_url('index.php/admin/category'); ?>" class="btn-enhanced btn-secondary-enhanced">
                            <i class="bx bx-x"></i> Cancel
                        </a>

                        <a href="<?php echo base_url('index.php/admin/category'); ?>" class="back-link ms-auto">
                            <i class="bx bx-arrow-back"></i> Back to List
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- ========== JavaScript ========== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryName = document.getElementById('categoryName');
    const slugValue = document.getElementById('slugValue');
    const charCounter = document.getElementById('charCounter');
    const editForm = document.getElementById('editForm');
    const submitBtn = document.getElementById('submitBtn');
    const nameError = document.getElementById('nameError');

    // ===== Auto-focus on load =====
    if (categoryName) {
        categoryName.focus();
        categoryName.setSelectionRange(categoryName.value.length, categoryName.value.length);
    }

    // ===== Live Slug Generation =====
    function generateSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    function updateSlug() {
        const slug = generateSlug(categoryName.value);
        slugValue.textContent = slug || 'category-name';
        
        // Animate slug update
        slugValue.style.opacity = '0.5';
        setTimeout(() => {
            slugValue.style.opacity = '1';
        }, 150);
    }

    // ===== Character Counter =====
    function updateCounter() {
        const length = categoryName.value.length;
        const max = parseInt(categoryName.maxLength);
        
        charCounter.textContent = `${length}/${max}`;
        
        // Update counter color
        charCounter.classList.remove('warning', 'danger');
        if (length > max * 0.9) {
            charCounter.classList.add('danger');
        } else if (length > max * 0.75) {
            charCounter.classList.add('warning');
        }
    }

    // ===== Event Listeners =====
    if (categoryName) {
        categoryName.addEventListener('input', function () {
            updateSlug();
            updateCounter();
            
            // Clear validation error
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                nameError.classList.remove('show');
            } else {
                this.classList.remove('is-valid');
            }
        });

        categoryName.addEventListener('blur', function () {
            if (!this.value.trim()) {
                this.classList.add('is-invalid');
                nameError.classList.add('show');
            }
        });
    }

    // ===== Form Submit with Loading State =====
    if (editForm) {
        editForm.addEventListener('submit', function (e) {
            if (!categoryName.value.trim()) {
                e.preventDefault();
                categoryName.classList.add('is-invalid');
                nameError.classList.add('show');
                categoryName.focus();
                return;
            }

            // Show loading state
            submitBtn.classList.add('loading');
            
            // Optional: Add success animation before submit
            // This gives visual feedback
            setTimeout(() => {
                // Form will submit naturally
            }, 300);
        });
    }

    // ===== Copy Slug Function =====
    window.copySlug = function () {
        const slug = slugValue.textContent;
        navigator.clipboard.writeText(slug).then(() => {
            // Show tooltip feedback
            const icon = document.querySelector('.slug-preview .bx-copy');
            const originalClass = icon.className;
            
            icon.className = 'bx bx-check text-success';
            icon.style.fontSize = '1rem';
            
            setTimeout(() => {
                icon.className = originalClass;
            }, 1500);
        });
    };

    // ===== Auto-dismiss Flash Messages =====
    document.querySelectorAll('.alert-enhanced').forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) {
                bsAlert.close();
            }
        }, 5000);
    });

    // ===== Input Animation on Focus =====
    document.querySelectorAll('.form-control-enhanced').forEach(function (input) {
        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
});
</script>

