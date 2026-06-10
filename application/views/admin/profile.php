<style>
    /* ===== PROFILE PAGE ===== */
    .profile-wrapper {
        display: flex;
        gap: 24px;
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px;
    }

    /* --- LEFT CARD --- */
    .profile-card {
        width: 320px;
        flex-shrink: 0;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        text-align: center;
    }

    .profile-cover {
        height: 130px;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
        position: relative;
    }

    .profile-cover::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .profile-cover::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -20px;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
    }

    .profile-avatar {
        margin-top: -52px;
        position: relative;
        z-index: 2;
    }

    .profile-avatar img {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .profile-avatar img:hover {
        transform: scale(1.05);
    }

    .profile-card-body {
        padding: 16px 24px 28px;
    }

    .profile-card-body h2 {
        font-family: 'Inter', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
        letter-spacing: -0.3px;
    }

    .profile-role {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .profile-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 0 0 20px;
    }

    .profile-detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }

    .profile-detail-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #f8fafc;
    }

    .profile-detail-item:last-child {
        border-bottom: none;
    }

    .profile-detail-icon {
        width: 38px;
        height: 38px;
        background: #eef2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        font-size: 14px;
        flex-shrink: 0;
    }

    .profile-detail-text {
        flex: 1;
        min-width: 0;
    }

    .profile-detail-label {
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .profile-detail-value {
        font-size: 13px;
        font-weight: 500;
        color: #1e293b;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .profile-detail-value a {
        color: #6366f1;
        text-decoration: none;
        transition: color 0.2s;
    }

    .profile-detail-value a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    /* Status badge */
    .profile-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        background: #f0fdf4;
        color: #16a34a;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 4px;
    }

    .profile-status::before {
        content: '';
        width: 7px;
        height: 7px;
        background: #16a34a;
        border-radius: 50%;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }
    }

    /* --- RIGHT FORM --- */
    .profile-form-card {
        flex: 1;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .form-header {
        padding: 24px 28px 20px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-header-icon {
        width: 40px;
        height: 40px;
        background: #eef2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        font-size: 16px;
    }

    .form-header h3 {
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.3px;
    }

    .form-header p {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* Flash Messages */
    .flash-msg {
        margin: 20px 28px 0;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: flashIn 0.4s ease;
    }

    .flash-msg i {
        font-size: 15px;
        flex-shrink: 0;
    }

    .flash-success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .flash-success i {
        color: #16a34a;
    }

    .flash-error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .flash-error i {
        color: #ef4444;
    }

    @keyframes flashIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-body {
        padding: 28px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Section Divider */
    .form-section {
        grid-column: 1 / -1;
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 8px 0 4px;
    }

    .form-section-label {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        white-space: nowrap;
    }

    .form-section-line {
        flex: 1;
        height: 1px;
        background: #f1f5f9;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-label .required {
        color: #ef4444;
        font-size: 14px;
    }

    .form-label .label-hint {
        margin-left: auto;
        font-size: 11px;
        font-weight: 400;
        color: #94a3b8;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
        transition: color 0.25s;
    }

    .input-wrapper .form-control {
        padding-left: 40px;
    }

    .input-wrapper:focus-within .input-icon {
        color: #6366f1;
    }

    .form-control {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        color: #1e293b;
        background: #fff;
        outline: none;
        transition: all 0.25s ease;
    }

    .form-control::placeholder {
        color: #cbd5e1;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .form-control:hover:not(:focus) {
        border-color: #cbd5e1;
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    /* File Upload */
    .file-upload-wrapper {
        position: relative;
    }

    .file-upload-area {
        border: 2px dashed #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: #fafbfc;
    }

    .file-upload-area:hover {
        border-color: #6366f1;
        background: #eef2ff;
    }

    .file-upload-area.dragover {
        border-color: #6366f1;
        background: #eef2ff;
        transform: scale(1.01);
    }

    .file-upload-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        background: #eef2ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        font-size: 20px;
    }

    .file-upload-area h4 {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 4px;
    }

    .file-upload-area h4 span {
        color: #6366f1;
        cursor: pointer;
    }

    .file-upload-area p {
        font-size: 12px;
        color: #94a3b8;
    }

    .file-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-preview {
        display: none;
        align-items: center;
        gap: 12px;
        margin-top: 12px;
        padding: 10px 14px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .file-preview.show {
        display: flex;
    }

    .file-preview img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
    }

    .file-preview-info {
        flex: 1;
    }

    .file-preview-name {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }

    .file-preview-size {
        font-size: 11px;
        color: #94a3b8;
    }

    .file-preview-remove {
        width: 28px;
        height: 28px;
        border: none;
        background: #fef2f2;
        color: #ef4444;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .file-preview-remove:hover {
        background: #ef4444;
        color: #fff;
    }

    /* Form Footer */
    .form-footer {
        padding: 20px 28px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-primary {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
    }

    .btn-primary:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.35);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* ===== TOAST ===== */
    .profile-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        padding: 14px 22px;
        background: #0f172a;
        color: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        font-weight: 500;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.45s cubic-bezier(0.68, -0.3, 0.265, 1.35);
        z-index: 1000;
    }

    .profile-toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .profile-toast-icon {
        width: 28px;
        height: 28px;
        background: rgba(16, 185, 129, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-toast-icon i {
        color: #10b981;
        font-size: 12px;
    }

    .profile-avatar-wrap {
        position: relative;
        display: inline-block;
    }

    .profile-avatar-wrap img {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: block;
        transition: filter 0.3s ease;
    }

    .profile-avatar-wrap:hover img {
        filter: brightness(0.75);
    }

    .avatar-camera-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 32px;
        height: 32px;
        background: #6366f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2.5px solid #fff;
        transition: all 0.2s ease;
        z-index: 3;
    }

    .avatar-camera-btn i {
        color: #fff;
        font-size: 13px;
        pointer-events: none;
    }

    .avatar-camera-btn:hover {
        background: #4f46e5;
        transform: scale(1.1);
    }

    /* Tap ring on mobile */
    .avatar-camera-btn:active {
        transform: scale(0.95);
    }

    @media (max-width: 900px) {
        .profile-wrapper {
            flex-direction: column;
            gap: 12px;
        }

        .profile-card {
            width: 100%;
        }
    }

    @media (max-width: 768px) {

        /* ── Kill container padding that causes left/right space ── */
        .container {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* ── Wrapper ── */
        .profile-wrapper {
            padding: 0 8px;
            margin: 10px auto;
            gap: 12px;
        }

        .profile-cover {
            height: 90px;
        }

        /* Add this new rule */
        .profile-card {
            background: linear-gradient(180deg, #a855f7 0px, #fff 160px);
        }

        /* ── Avatar centered ── */
        .profile-avatar {
            margin-top: -44px;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .profile-avatar img {
            width: 88px;
            height: 88px;
            border-width: 3px;
        }

        /* ── Card Body ── */
        .profile-card-body {
            padding: 8px 14px 16px;
            text-align: center;
        }

        .profile-card-body h2 {
            font-size: 17px;
            margin-bottom: 2px;
        }

        .profile-role {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .profile-status {
            font-size: 11px;
            padding: 4px 12px;
        }

        .profile-divider {
            margin-top: 14px;
        }

        /* ── Detail list → 2-column grid (NO scroll) ── */
        .profile-detail-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            padding: 4px 0 0;
            text-align: left;
            overflow: visible;
        }

        .profile-detail-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
            padding: 10px 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 12px;
            min-width: 0;
            flex-shrink: unset;
            overflow: hidden;
        }

        .profile-detail-item:last-child {
            border-bottom: 1px solid #e2e8f0;
        }

        /* If odd number of items, last one spans full width */
        .profile-detail-item:last-child:nth-child(odd) {
            grid-column: 1 / -1;
        }

        .profile-detail-icon {
            width: 30px;
            height: 30px;
            font-size: 12px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .profile-detail-text {
            min-width: 0;
            flex: 1;
        }

        .profile-detail-label {
            font-size: 10px;
            margin-bottom: 2px;
        }

        .profile-detail-value {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .profile-detail-value a {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        /* ── Form Card ── */
        .form-header {
            padding: 14px 14px 12px;
            flex-direction: row;
            align-items: center;
        }

        .form-header-left {
            gap: 10px;
        }

        .form-header-icon {
            width: 34px;
            height: 34px;
            font-size: 14px;
            border-radius: 9px;
            flex-shrink: 0;
        }

        .form-header h3 {
            font-size: 15px;
        }

        .form-header p {
            font-size: 11px;
        }

        .flash-msg {
            margin: 12px 14px 0;
            padding: 10px 12px;
            font-size: 12px;
            border-radius: 9px;
        }

        /* ── Form Body ── */
        .form-body {
            padding: 14px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 13px;
        }

        .form-group.full-width {
            grid-column: 1;
        }

        .form-section {
            margin: 2px 0 0;
        }

        .form-section-label {
            font-size: 10.5px;
        }

        .form-label {
            font-size: 12.5px;
            margin-bottom: 5px;
        }

        .form-control {
            padding: 10px 12px 10px 38px;
            font-size: 13px;
            border-radius: 9px;
            width: 100%;
            box-sizing: border-box;
        }

        .input-wrapper .input-icon {
            left: 12px;
            font-size: 13px;
        }

        textarea.form-control {
            padding-left: 12px;
            min-height: 72px;
        }

        /* ── File upload compact horizontal ── */
        .file-upload-area {
            padding: 14px 12px;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 12px;
            text-align: left;
        }

        .file-upload-icon {
            width: 40px;
            height: 40px;
            font-size: 17px;
            border-radius: 10px;
            margin: 0;
            flex-shrink: 0;
        }

        .file-upload-area h4 {
            font-size: 13px;
            margin-bottom: 2px;
        }

        .file-upload-area p {
            font-size: 11px;
            margin: 0;
        }

        .file-preview {
            padding: 9px 12px;
            gap: 10px;
            margin-top: 10px;
        }

        .file-preview img {
            width: 34px;
            height: 34px;
        }

        .file-preview-name {
            font-size: 11.5px;
        }

        .file-preview-size {
            font-size: 10.5px;
        }

        /* ── Form Footer: always side by side ── */
        .form-footer {
            padding: 12px 14px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 8px;
            flex-direction: unset;
        }

        .btn {
            width: 100%;
            justify-content: center;
            padding: 11px 14px;
            font-size: 13px;
            border-radius: 9px;
        }

        /* ── Toast ── */
        .profile-toast {
            bottom: 12px;
            right: 10px;
            left: 10px;
            padding: 12px 16px;
            font-size: 12.5px;
            border-radius: 10px;
        }

        .profile-avatar-wrap img {
            width: 88px;
            height: 88px;
            border-width: 3px;
        }

        .avatar-camera-btn {
            width: 28px;
            height: 28px;
            bottom: 2px;
            right: 2px;
            border-width: 2px;
        }

        .avatar-camera-btn i {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .profile-wrapper {
            padding: 0 6px;
            margin: 8px auto;
        }

        .profile-cover {
            height: 80px;
        }

        .profile-avatar img {
            width: 80px;
            height: 80px;
        }

        .profile-card-body {
            padding: 6px 12px 14px;
        }

        .profile-card-body h2 {
            font-size: 16px;
        }

        .profile-detail-list {
            gap: 6px;
        }

        .profile-detail-item {
            padding: 9px 8px;
            gap: 7px;
        }

        .profile-detail-icon {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }

        .profile-detail-value {
            font-size: 11.5px;
        }

        .form-body {
            padding: 12px;
        }

        .form-header {
            padding: 12px 12px 10px;
        }

        .flash-msg {
            margin: 10px 12px 0;
        }

        .form-footer {
            padding: 10px 12px;
        }

        .form-control {
            font-size: 12.5px;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <?php $profileImage = !empty($user->profile_image) ? base_url($user->profile_image) : base_url('assets/images/icons/user.png'); ?>
            <?php
            $displayMobile = preg_replace('/\D+/', '', (string) ($user->mobile ?? ''));
            if (strlen($displayMobile) > 10) {
                $displayMobile = substr($displayMobile, -10);
            }
            ?>

            <div class="profile-wrapper">

                <!-- ===== LEFT: PROFILE CARD ===== -->
                <div class="profile-card">

                    <div class="profile-cover"></div>

                    <div class="profile-avatar">
                        <div class="profile-avatar-wrap">
                            <img src="<?= $profileImage ?>" alt="<?= htmlspecialchars($user->name) ?>"
                                id="profilePreviewImg">
                            <label for="fileInput" class="avatar-camera-btn" title="Change photo">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" name="profile_image" id="fileInput"
                                accept="image/*" style="display:none;">
                        </div>
                    </div>

                    <div class="profile-card-body">
                        <h2><?= htmlspecialchars($user->store_name) ?></h2>
                        <p class="profile-role"><?= htmlspecialchars($user->name) ?></p>

                        <span class="profile-status">Active</span>

                        <div class="profile-divider" style="margin-top: 20px;"></div>

                        <ul class="profile-detail-list">
                            <li class="profile-detail-item">
                                <div class="profile-detail-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="profile-detail-text">
                                    <div class="profile-detail-label">Email</div>
                                    <div class="profile-detail-value"><?= htmlspecialchars($user->email) ?></div>
                                </div>
                            </li>
                            <li class="profile-detail-item">
                                <div class="profile-detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="profile-detail-text">
                                    <div class="profile-detail-label">Mobile</div>
                                    <div class="profile-detail-value"><?= htmlspecialchars($displayMobile) ?></div>
                                </div>
                            </li>
                            <li class="profile-detail-item">
                                <div class="profile-detail-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="profile-detail-text">
                                    <div class="profile-detail-label">Store</div>
                                    <div class="profile-detail-value"><?= htmlspecialchars($user->store_name) ?></div>
                                </div>
                            </li>
                            <?php if (!empty($user->address)): ?>
                                <li class="profile-detail-item">
                                    <div class="profile-detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="profile-detail-text">
                                        <div class="profile-detail-label">Address</div>
                                        <div class="profile-detail-value"><?= htmlspecialchars($user->address) ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <!-- Social Links in Left Card -->
                            <?php if (!empty($user->instagram)): ?>
                                <li class="profile-detail-item">
                                    <div class="profile-detail-icon" style="background: #fce7f3; color: #e11d48;">
                                        <i class="fab fa-instagram"></i>
                                    </div>
                                    <div class="profile-detail-text">
                                        <div class="profile-detail-label">Instagram</div>
                                        <div class="profile-detail-value">
                                            <a href="<?= htmlspecialchars($user->instagram) ?>" target="_blank"
                                                rel="noopener">
                                                <?= htmlspecialchars($user->instagram) ?>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($user->facebook)): ?>
                                <li class="profile-detail-item">
                                    <div class="profile-detail-icon" style="background: #dbeafe; color: #2563eb;">
                                        <i class="fab fa-facebook-f"></i>
                                    </div>
                                    <div class="profile-detail-text">
                                        <div class="profile-detail-label">Facebook</div>
                                        <div class="profile-detail-value">
                                            <a href="<?= htmlspecialchars($user->facebook) ?>" target="_blank"
                                                rel="noopener">
                                                <?= htmlspecialchars($user->facebook) ?>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>

                </div>

                <!-- ===== RIGHT: EDIT FORM ===== -->
                <div class="profile-form-card">

                    <div class="form-header">
                        <div class="form-header-left">
                            <div class="form-header-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div>
                                <h3>Edit Profile</h3>
                                <p>Update your personal information & social links</p>
                            </div>
                        </div>
                    </div>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="flash-msg flash-success">
                            <i class="fas fa-check-circle"></i>
                            <?= htmlspecialchars($this->session->flashdata('success')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="flash-msg flash-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= htmlspecialchars($this->session->flashdata('error')) ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('admin/profile/update') ?>" enctype="multipart/form-data"
                        id="profileForm">

                        <div class="form-body">
                            <div class="form-grid">

                                <!-- SECTION: Basic Info -->
                                <div class="form-section">
                                    <span class="form-section-label">Basic Information</span>
                                    <div class="form-section-line"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Store Name <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-store input-icon"></i>
                                        <input type="text" name="store_name" class="form-control"
                                            value="<?= htmlspecialchars($user->store_name) ?>"
                                            placeholder="Enter store name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Full Name <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" name="name" class="form-control"
                                            value="<?= htmlspecialchars($user->name) ?>" placeholder="Enter full name"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Email Address <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" name="email" class="form-control"
                                            value="<?= htmlspecialchars($user->email) ?>"
                                            placeholder="Enter email address" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Mobile Number
                                        <span class="label-hint">10 digits only</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="text" name="mobile" class="form-control"
                                            value="<?= htmlspecialchars($displayMobile) ?>"
                                            placeholder="Enter 10 digit mobile number" maxlength="10"
                                            inputmode="numeric" pattern="[0-9]{10}">
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">
                                        Store Address
                                        <span class="label-hint">Optional</span>
                                    </label>
                                    <textarea name="address" class="form-control"
                                        style="padding-left: 40px;"
                                        placeholder="Enter your store address"
                                        rows="2"><?= htmlspecialchars($user->address ?? '') ?></textarea>
                                </div>

                                <!-- SECTION: Social Links -->
                                <div class="form-section">
                                    <span class="form-section-label">Social Links</span>
                                    <div class="form-section-line"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Instagram
                                        <span class="label-hint">Optional</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fab fa-instagram input-icon" style="color: #e11d48;"></i>
                                        <input type="url" name="instagram" class="form-control"
                                            value="<?= htmlspecialchars($user->instagram ?? '') ?>"
                                            placeholder="https://instagram.com/yourpage">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Facebook
                                        <span class="label-hint">Optional</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fab fa-facebook-f input-icon" style="color: #2563eb;"></i>
                                        <input type="url" name="facebook" class="form-control"
                                            value="<?= htmlspecialchars($user->facebook ?? '') ?>"
                                            placeholder="https://facebook.com/yourpage">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="reset" class="btn btn-secondary" id="resetBtn">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Save Changes
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="profile-toast" id="profileToast">
    <div class="profile-toast-icon"><i class="fas fa-check"></i></div>
    <span id="profileToastMsg">Profile updated successfully!</span>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const profileImg = document.getElementById('profilePreviewImg');

    // Click camera → pick file
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            this.value = '';
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file.');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            // Live preview in the avatar circle
            profileImg.src = e.target.result;

            // Animate the avatar
            profileImg.style.transition = 'transform 0.3s ease';
            profileImg.style.transform = 'scale(1.05)';
            setTimeout(() => {
                profileImg.style.transform = 'scale(1)';
            }, 300);
        };
        reader.readAsDataURL(file);
    });

    // Reset button — restore original photo
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            setTimeout(() => {
                fileInput.value = '';
                profileImg.src = '<?= $profileImage ?>';
            }, 10);
        });
    }

    // Auto-hide flash messages
    document.querySelectorAll('.flash-msg').forEach(function(msg) {
        setTimeout(function() {
            msg.style.transition = 'all 0.4s ease';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-8px)';
            setTimeout(function() {
                msg.remove();
            }, 400);
        }, 5000);
    });

    // Mobile: only 10 digits
    const mobileInput = document.querySelector('input[name="mobile"]');
    if (mobileInput) {
        mobileInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    }
</script>