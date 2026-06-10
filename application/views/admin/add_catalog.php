<style>
    /* ══════════════════════════════════════
   Full Width Fix
══════════════════════════════════════ */
    /* ══════════════════════════════════════
   Full Width + Better Styling
══════════════════════════════════════ */
    .page-wrapper {
        width: 100%;
        max-width: 100% !important;
    }

    .page-content {
        max-width: 100% !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 24px !important;
    }

    /* Inner form card */
    .catalog-form-card {
        max-width: 780px;
        margin: 0 auto;
        background: var(--bg-primary, #fff);
        border: 1px solid var(--border-color, #e2e8f0);
        border-radius: 16px;
        padding: 36px 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }

    /* Back button */
    .catalog-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary, #6366f1);
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 20px;
        transition: all 0.2s ease;
    }

    .catalog-back-btn:hover {
        background: var(--primary-dark, #4f46e5);
        transform: translateY(-1px);
        color: #fff;
        text-decoration: none;
    }

    /* Form heading */
    .catalog-form-card h1 {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: var(--text-primary, #1e293b) !important;
        margin-bottom: 28px !important;
        text-align: left !important;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color, #e2e8f0);
    }

    /* Dark theme */
    [data-theme="dark"] .catalog-form-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .catalog-form-card h1 {
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .form-label {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .form-control {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .form-control:focus {
        background: var(--bg-secondary) !important;
        border-color: var(--primary) !important;
    }

    [data-theme="dark"] .form-control::placeholder {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .image-upload {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .image-upload:hover {
        border-color: var(--primary) !important;
        background: rgba(99, 102, 241, 0.08) !important;
    }

    [data-theme="dark"] .upload-icon {
        color: var(--text-tertiary) !important;
    }

    [data-theme="dark"] .upload-text {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .upload-hint {
        color: var(--text-tertiary) !important;
    }

    .page-content h1 {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: #1e293b;
        transition: all 0.2s ease;
        background-color: #fafbfc;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    /* Custom File Upload */
    .image-upload {
        position: relative;
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
        background-color: #fafbfc;
    }

    .image-upload:hover {
        border-color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.05);
    }

    .image-upload input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .upload-icon {
        font-size: 32px;
        color: #94a3b8;
        margin-bottom: 12px;
    }

    .upload-text {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .upload-text strong {
        color: #3b82f6;
    }

    .upload-hint {
        font-size: 12px;
        color: #94a3b8;
    }

    /* Image Preview */
    .image-preview {
        display: none;
        margin-top: 16px;
        text-align: center;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .remove-image {
        margin-top: 12px;
        padding: 6px 16px;
        background-color: #f87171;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .remove-image:hover {
        background-color: #ef4444;
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        padding: 14px;
        background-color: #10b981;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .submit-btn:hover {
        background-color: #059669;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    /* Responsive Adjustments */
    @media (max-width: 600px) {
        .page-content {
            padding: 24px;
        }

        .image-upload {
            padding: 20px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <!-- Back Button -->
        <a href="<?= site_url('admin/catalog') ?>" class="catalog-back-btn">
            <i class="fas fa-arrow-left"></i> Back to Catalog
        </a>

        <div class="catalog-form-card">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <h1>Add New Product</h1>

            <form method="post" action="<?= site_url('admin/catalog/save') ?>" enctype="multipart/form-data">

                <div class="form-group">
                    <label class="form-label">
                        Product Name <span class="required">*</span>
                    </label>

                    <input type="text"
                        name="name"
                        class="form-control"
                        required
                        placeholder="Enter product name">
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>

                    <textarea name="description"
                        class="form-control"
                        placeholder="Write product description"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Price <span class="required">*</span>
                    </label>

                    <input type="number"
                        name="price"
                        class="form-control"
                        required
                        placeholder="0.00"
                        min="0"
                        step="0.01">
                </div>

                <div class="form-group">
                    <label class="form-label">Product Image</label>

                    <div class="image-upload">
                        <input type="file"
                            name="image"
                            accept="image/*"
                            id="imageInput">

                        <i class="fas fa-cloud-upload-alt upload-icon"></i>

                        <div class="upload-text">
                            <strong>Click to upload</strong> or drag and drop
                        </div>

                        <div class="upload-hint">
                            JPG, PNG, WEBP (Max 5MB)
                        </div>
                    </div>

                    <div class="image-preview" id="imagePreview">
                        <img id="previewImg" alt="Product Image Preview">

                        <button type="button"
                            class="remove-image"
                            id="removeImageBtn">
                            Remove Image
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Save Product
                </button>

            </form>
        </div>
    </div>

    <script>
        // Image Preview Functionality
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImageBtn');

        imageInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.src = event.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        removeImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.style.display = 'none';
            previewImg.src = '';
        });
    </script>