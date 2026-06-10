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
                            <a href="<?php echo site_url('admin/category'); ?>">Categories</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="<?php echo site_url('admin/category'); ?>"
                    class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="bx bx-arrow-back me-1"></i> Back to List
                </a>
            </div>
        </div>

        <!-- ========== Flash Messages ========== -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                        style="width:36px;height:36px;">
                        <i class="bx bx-check"></i>
                    </div>
                    <div>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php
        $oldCategoryName = (string) $this->session->flashdata('old_category_name');
        $oldCategoryDescription = (string) $this->session->flashdata('old_category_description');
        $nameError = (string) $this->session->flashdata('category_name_error');
        ?>

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-12">

                <!-- ========== Main Card ========== -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <!-- Card Header with Gradient -->
                    <div class="card-header border-0 py-4"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex align-items-center">
                            <div class="header-icon bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width:50px; height:50px;">
                                <i class="bx bx-category-alt text-white fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-bold">Add New Category</h5>
                                <p class="mb-0 text-white-50 small">Create a new category for your products</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4 p-md-5">

                        <form method="post" action="<?php echo site_url('admin/category/save'); ?>" id="categoryForm"
                            novalidate>

                            <!-- Category Name -->
                            <div class="mb-4">
                                <label for="categoryName" class="form-label fw-semibold text-dark">
                                    <i class="bx bx-purchase-tag-alt me-1 text-primary"></i> Category Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bx bx-text text-muted"></i>
                                    </span>
                                    <input type="text" name="name" id="categoryName"
                                        class="form-control border-start-0 ps-0 <?= $nameError !== '' ? 'is-invalid' : '' ?>"
                                        placeholder="e.g. Electronics, Fashion, Books..." required autocomplete="off"
                                        maxlength="100"
                                        value="<?= htmlspecialchars($oldCategoryName, ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                                <div class="form-text d-flex justify-content-between mt-2">
                                    <span><i class="bx bx-info-circle me-1"></i>Enter a unique category name</span>
                                    <span class="char-counter text-muted"><span id="charCount">0</span>/100</span>
                                </div>
                                <div class="invalid-feedback <?= $nameError !== '' ? 'd-block' : '' ?>" id="nameError">
                                    <?= $nameError !== '' ? htmlspecialchars($nameError, ENT_QUOTES, 'UTF-8') : 'Please enter a valid category name.' ?>
                                </div>
                            </div>

                            <!-- Slug Preview -->
                            <!-- <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bx bx-link me-1 text-primary"></i> Slug Preview
                                </label>
                                <div class="slug-preview bg-light rounded-3 p-3 d-flex align-items-center">
                                    <i class="bx bx-globe text-muted me-2"></i>
                                    <span class="text-muted" id="slugPreview">category-slug-will-appear-here</span>
                                </div>
                            </div> -->

                            <!-- Description (Optional) -->
                            <div class="mb-4">
                                <label for="categoryDesc" class="form-label fw-semibold text-dark">
                                    <i class="bx bx-notepad me-1 text-primary"></i> Description
                                    <span
                                        class="badge bg-secondary bg-opacity-25 text-secondary ms-1 fw-normal">Optional</span>
                                </label>
                                <textarea name="description" id="categoryDesc" class="form-control" rows="4"
                                    placeholder="Write a brief description about this category..."
                                    maxlength="500"><?= htmlspecialchars($oldCategoryDescription, ENT_QUOTES, 'UTF-8') ?></textarea>
                                <div class="form-text text-end mt-1">
                                    <span id="descCharCount">0</span>/500
                                </div>
                            </div>

                            <!-- Status Toggle -->
                            <!-- <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bx bx-toggle-left me-1 text-primary"></i> Status
                                </label>
                                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                                    <div class="form-check form-switch form-switch-lg">
                                        <input class="form-check-input" type="checkbox" id="statusToggle" name="status" value="1" checked>
                                        <label class="form-check-label fw-medium" for="statusToggle" id="statusLabel">
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                                <i class="bx bx-check-circle me-1"></i> Active
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <hr class="my-4">

                            <!-- Action Buttons -->
                            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                                <a href="<?php echo site_url('admin/category'); ?>"
                                    class="btn btn-outline-secondary px-4 py-2 rounded-pill order-2 order-md-1">
                                    <i class="bx bx-x me-1"></i> Cancel
                                </a>

                                <div class="d-flex gap-2 order-1 order-md-2">
                                    <button type="reset" class="btn btn-light px-4 py-2 rounded-pill" id="resetBtn">
                                        <i class="bx bx-reset me-1"></i> Reset
                                    </button>
                                    <button type="submit"
                                        class="btn px-5 py-2 rounded-pill text-white fw-semibold btn-submit"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bx bx-save me-1"></i> Save Category
                                        <span class="spinner-border spinner-border-sm ms-2 d-none"
                                            id="submitSpinner"></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- ========== Tips Card ========== -->


            </div>
        </div>

    </div>
</div>

<!-- ========== Custom Styles ========== -->
<style>
    /* Card & Shadow */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Form Controls */
    .form-control,
    .input-group-text {
        border-color: #e0e5ec;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .input-group:focus-within .input-group-text {
        border-color: #667eea;
        color: #667eea !important;
    }

    .input-group:focus-within .input-group-text i {
        color: #667eea !important;
    }

    /* Submit Button */
    .btn-submit {
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.45);
        opacity: 0.95;
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Slug Preview */
    .slug-preview {
        border: 1px dashed #d0d5dd;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .slug-preview.active {
        border-color: #667eea;
        background-color: #f0f2ff !important;
    }

    /* Character Counter */
    .char-counter {
        font-size: 0.8rem;
    }

    /* Status Toggle */
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }

    .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    /* Breadcrumb */
    .page-breadcrumb {
        padding: 12px 0;
    }

    .breadcrumb-title {
        font-weight: 700;
        font-size: 1.2rem;
        color: #333;
    }

    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #764ba2;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeInUp 0.5s ease forwards;
    }

    .card:nth-child(2) {
        animation-delay: 0.15s;
    }

    /* Tip Icons */
    .tip-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Validation States */
    .form-control.is-valid {
        border-color: #28a745;
        background-image: none;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem !important;
        }

        .btn-submit {
            width: 100%;
        }
    }
</style>

<!-- ========== Scripts ========== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('categoryName');
        const charCount = document.getElementById('charCount');
        const slugPreview = document.getElementById('slugPreview');
        const descInput = document.getElementById('categoryDesc');
        const descCharCount = document.getElementById('descCharCount');
        const statusToggle = document.getElementById('statusToggle');
        const statusLabel = document.getElementById('statusLabel');
        const form = document.getElementById('categoryForm');
        const submitSpinner = document.getElementById('submitSpinner');
        const slugContainer = document.querySelector('.slug-preview');

        charCount.textContent = nameInput.value.length;
        if (descInput) {
            descCharCount.textContent = descInput.value.length;
        }

        // ── Character Counter & Slug Generator ──
        nameInput.addEventListener('input', function () {
            const val = this.value;
            charCount.textContent = val.length;

            // color counter near limit
            charCount.parentElement.classList.toggle('text-danger', val.length > 90);

            // slug
            const slug = val.toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s_]+/g, '-')
                .replace(/-+/g, '-');

            slugPreview.textContent = slug || 'category-slug-will-appear-here';
            slugContainer.classList.toggle('active', slug.length > 0);

            // live validation
            if (val.trim().length >= 2) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else if (val.trim().length > 0) {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-valid', 'is-invalid');
            }
        });

        // ── Description Counter ──
        if (descInput) {
            descInput.addEventListener('input', function () {
                descCharCount.textContent = this.value.length;
            });
        }

        // ── Status Toggle Label ──
        if (statusToggle && statusLabel) {
            statusToggle.addEventListener('change', function () {
                statusLabel.innerHTML = this.checked
                    ? '<span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill"><i class="bx bx-check-circle me-1"></i> Active</span>'
                    : '<span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill"><i class="bx bx-x-circle me-1"></i> Inactive</span>';
            });
        }

        // ── Form Submit ──
        form.addEventListener('submit', function (e) {
            const name = nameInput.value.trim();

            if (name.length < 2) {
                e.preventDefault();
                nameInput.classList.add('is-invalid');
                nameInput.focus();
                return;
            }

            // show spinner
            const submitBtn = form.querySelector('.btn-submit');
            submitBtn.disabled = true;
            submitSpinner.classList.remove('d-none');
            submitBtn.querySelector('i').classList.add('d-none');
        });

        // ── Reset Button ──
        document.getElementById('resetBtn').addEventListener('click', function () {
            setTimeout(() => {
                charCount.textContent = '0';
                descCharCount.textContent = '0';
                slugPreview.textContent = 'category-slug-will-appear-here';
                slugContainer.classList.remove('active');
                nameInput.classList.remove('is-valid', 'is-invalid');
                if (statusToggle) {
                    statusToggle.checked = true;
                    statusToggle.dispatchEvent(new Event('change'));
                }
            }, 10);
        });

    });
</script>