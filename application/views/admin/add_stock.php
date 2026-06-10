<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --primary-50: rgba(79, 70, 229, 0.05);
            --primary-100: rgba(79, 70, 229, 0.1);
            --success: #10b981;
            --success-light: rgba(16, 185, 129, 0.1);
            --warning: #f59e0b;
            --warning-light: rgba(245, 158, 11, 0.1);
            --danger: #ef4444;
            --danger-light: rgba(239, 68, 68, 0.1);
            --dark: #1e293b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            min-height: 100vh;
        }

        /* ── Page Wrapper ── */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Header Bar ── */
        .top-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
            padding: 2rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .top-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .top-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-content h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.025em;
        }

        .header-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .breadcrumb-custom a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.2s;
        }

        .breadcrumb-custom a:hover {
            color: #fff;
        }

        .breadcrumb-custom span {
            color: rgba(255, 255, 255, 0.4);
            margin: 0 0.5rem;
            font-size: 0.75rem;
        }

        .breadcrumb-custom .current {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ── Main Content ── */
        .main-content {
            margin-top: -2.5rem;
            position: relative;
            z-index: 10;
            padding-bottom: 3rem;
        }

        /* ── Cards ── */
        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            animation: cardEntry 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes cardEntry {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card.delay-1 { animation-delay: 0.05s; }
        .form-card.delay-2 { animation-delay: 0.1s; }
        .form-card.delay-3 { animation-delay: 0.15s; }
        .form-card.delay-4 { animation-delay: 0.2s; }

        .card-section-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--gray-50);
        }

        .card-section-header .section-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .card-section-header .section-icon.blue {
            background: var(--primary-100);
            color: var(--primary);
        }

        .card-section-header .section-icon.green {
            background: var(--success-light);
            color: var(--success);
        }

        .card-section-header .section-icon.orange {
            background: var(--warning-light);
            color: var(--warning);
        }

        .card-section-header .section-text h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        .card-section-header .section-text p {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin: 0.15rem 0 0;
        }

        .card-section-body {
            padding: 1.5rem;
        }

        /* ── Progress Bar ── */
        .progress-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: cardEntry 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .progress-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .progress-top .label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress-top .label i {
            color: var(--primary);
        }

        .progress-top .count {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .progress-steps {
            display: flex;
            gap: 6px;
        }

        .progress-step {
            flex: 1;
            height: 6px;
            background: var(--gray-200);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .progress-step .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 20px;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .progress-step.completed .progress-fill {
            width: 100%;
        }

        /* ── Form Controls ── */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-group label .label-icon {
            font-size: 0.7rem;
            color: var(--primary);
            opacity: 0.7;
        }

        .form-group label .required-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--danger);
            display: inline-block;
        }

        .form-group label .optional-badge {
            font-size: 0.65rem;
            color: var(--gray-400);
            background: var(--gray-100);
            padding: 0.15rem 0.5rem;
            border-radius: 20px;
            font-weight: 500;
            margin-left: auto;
            border: 1px solid var(--gray-200);
        }

        .form-group label .info-tip {
            position: relative;
            cursor: help;
            display: inline-flex;
        }

        .form-group label .info-tip i {
            font-size: 0.7rem;
            color: var(--gray-400);
            transition: color 0.2s;
        }

        .form-group label .info-tip:hover i {
            color: var(--primary);
        }

        .form-group label .info-tip .tip-content {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) scale(0.95);
            background: var(--gray-800);
            color: #fff;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
            z-index: 10;
            pointer-events: none;
        }

        .form-group label .info-tip .tip-content::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: var(--gray-800);
        }

        .form-group label .info-tip:hover .tip-content {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) scale(1);
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.85rem;
            transition: all 0.3s;
            z-index: 2;
            pointer-events: none;
        }

        .input-wrapper .input-suffix {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.75rem;
            font-weight: 500;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            background: #fff;
            border: 1.5px solid var(--gray-300);
            border-radius: 12px;
            color: var(--gray-800);
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        .form-control:hover {
            border-color: var(--gray-400);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-control:focus ~ .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .form-group:focus-within label {
            color: var(--primary-dark);
        }

        /* Validation States */
        .form-control.valid {
            border-color: var(--success);
        }

        .form-control.valid ~ .input-icon {
            color: var(--success);
        }

        .form-control.invalid {
            border-color: var(--danger);
        }

        .form-control.invalid ~ .input-icon {
            color: var(--danger);
        }

        .validation-msg {
            font-size: 0.7rem;
            margin-top: 0.4rem;
            display: none;
            align-items: center;
            gap: 0.3rem;
            font-weight: 500;
        }

        .validation-msg.error {
            color: var(--danger);
            display: flex;
        }

        .validation-msg.success {
            color: var(--success);
            display: flex;
        }

        /* ── File Upload ── */
        .file-upload-area {
            position: relative;
            border: 2px dashed var(--gray-300);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: var(--gray-50);
            overflow: hidden;
        }

        .file-upload-area:hover {
            border-color: var(--primary-light);
            background: var(--primary-50);
        }

        .file-upload-area.drag-over {
            border-color: var(--primary);
            background: var(--primary-50);
            transform: scale(1.01);
        }

        .file-upload-area.has-file {
            border-color: var(--success);
            border-style: solid;
            background: rgba(16, 185, 129, 0.03);
        }

        .upload-icon-wrapper {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: var(--primary-100);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .file-upload-area:hover .upload-icon-wrapper {
            background: rgba(79, 70, 229, 0.15);
            transform: scale(1.05);
        }

        .file-upload-area.has-file .upload-icon-wrapper {
            background: var(--success-light);
        }

        .upload-icon-wrapper i {
            font-size: 1.5rem;
            color: var(--primary);
            transition: color 0.3s;
        }

        .file-upload-area.has-file .upload-icon-wrapper i {
            color: var(--success);
        }

        .upload-text h4 {
            color: var(--gray-700);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.35rem;
        }

        .upload-text h4 span {
            color: var(--primary);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .upload-text p {
            color: var(--gray-400);
            font-size: 0.75rem;
        }

        .file-input-hidden {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .file-preview {
            display: none;
            align-items: center;
            gap: 0.875rem;
            padding: 0.875rem;
            background: var(--success-light);
            border-radius: 12px;
            margin-top: 1rem;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(16, 185, 129, 0.15);
        }

        .file-preview.show {
            display: flex;
        }

        .file-preview-icon {
            width: 42px;
            height: 42px;
            background: rgba(16, 185, 129, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .file-preview-icon i {
            color: var(--success);
            font-size: 1rem;
        }

        .file-preview-info {
            flex: 1;
            min-width: 0;
        }

        .file-preview-info h5 {
            font-size: 0.8rem;
            color: var(--gray-800);
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        .file-preview-info p {
            font-size: 0.7rem;
            color: var(--gray-500);
            margin: 0.15rem 0 0;
        }

        .file-remove {
            background: var(--danger-light);
            border: none;
            color: var(--danger);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .file-remove:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .image-preview-container {
            display: none;
            margin-top: 1rem;
        }

        .image-preview-container.show {
            display: block;
        }

        .image-preview-container img {
            max-width: 140px;
            max-height: 140px;
            border-radius: 12px;
            border: 2px solid var(--gray-200);
            object-fit: cover;
            box-shadow: var(--shadow-md);
        }

        /* ── Side Info Cards ── */
        .info-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 1.5rem;
            animation: cardEntry 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .info-card.delay-5 { animation-delay: 0.25s; }
        .info-card.delay-6 { animation-delay: 0.3s; }

        .info-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        .info-card-header h6 {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--gray-700);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-card-header h6 i {
            color: var(--primary);
            font-size: 0.75rem;
        }

        .info-card-body {
            padding: 1.25rem;
        }

        .tip-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.625rem 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .tip-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .tip-item:first-child {
            padding-top: 0;
        }

        .tip-item .tip-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            flex-shrink: 0;
        }

        .tip-item .tip-icon.blue {
            background: var(--primary-100);
            color: var(--primary);
        }

        .tip-item .tip-icon.green {
            background: var(--success-light);
            color: var(--success);
        }

        .tip-item .tip-icon.orange {
            background: var(--warning-light);
            color: var(--warning);
        }

        .tip-item .tip-text {
            font-size: 0.75rem;
            color: var(--gray-600);
            line-height: 1.5;
        }

        .tip-item .tip-text strong {
            color: var(--gray-700);
        }

        /* Shortcut Keys */
        .shortcut-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .shortcut-row:last-child {
            border-bottom: none;
        }

        .shortcut-row .shortcut-label {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .shortcut-row kbd {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            padding: 0.15rem 0.5rem;
            border-radius: 6px;
            font-size: 0.65rem;
            font-family: 'SFMono-Regular', 'Consolas', monospace;
            color: var(--gray-600);
            font-weight: 600;
        }

        /* ── Buttons ── */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .btn-custom {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), #7c3aed);
            color: #fff;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-reset {
            background: #fff;
            color: var(--gray-600);
            border: 1.5px solid var(--gray-300);
        }

        .btn-reset:hover {
            background: var(--gray-50);
            color: var(--gray-800);
            border-color: var(--gray-400);
        }

        .btn-draft {
            background: var(--warning-light);
            color: #b45309;
            border: 1.5px solid rgba(245, 158, 11, 0.2);
        }

        .btn-draft:hover {
            background: rgba(245, 158, 11, 0.15);
        }

        /* Loading State */
        .btn-submit.loading {
            pointer-events: none;
            opacity: 0.85;
        }

        .btn-submit.loading span,
        .btn-submit.loading i {
            opacity: 0;
        }

        .btn-submit.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2.5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── Success Toast ── */
        .toast-custom {
            position: fixed;
            top: 24px;
            right: 24px;
            background: #fff;
            border: 1px solid var(--gray-200);
            border-left: 4px solid var(--success);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 100;
            transform: translateX(calc(100% + 40px));
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: var(--shadow-xl);
            min-width: 300px;
        }

        .toast-custom.show {
            transform: translateX(0);
        }

        .toast-custom .toast-icon {
            width: 36px;
            height: 36px;
            background: var(--success-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
            flex-shrink: 0;
        }

        .toast-custom .toast-body h6 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
        }

        .toast-custom .toast-body p {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin: 0.15rem 0 0;
        }

        .toast-close {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 0.75rem;
            padding: 4px;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: var(--gray-600);
        }

        /* ── Responsive ── */
        @media (max-width: 992px) {
            .sidebar-col {
                margin-top: 0;
            }
        }

        @media (max-width: 768px) {
            .top-header {
                padding: 1.5rem 0 3.5rem;
            }

            .header-content h1 {
                font-size: 1.35rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-custom {
                justify-content: center;
            }
        }

        /* ── Animations ── */
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

        .animate-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        /* ── Row Layout Helper ── */
        .form-row-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 576px) {
            .form-row-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <!-- ══════ TOAST ══════ -->
        <div class="toast-custom" id="successToast">
            <button class="toast-close" onclick="this.parentElement.classList.remove('show')">
                <i class="fas fa-times"></i>
            </button>
            <div class="toast-icon"><i class="fas fa-check"></i></div>
            <div class="toast-body">
                <h6>Stock Added Successfully!</h6>
                <p>New inventory item has been saved.</p>
            </div>
        </div>

        <!-- ══════ TOP HEADER ══════ -->
        <div class="top-header">
            <div class="container">
                <div class="header-content">
                    <div class="breadcrumb-custom mb-3">
                        <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                        <span><i class="fas fa-chevron-right"></i></span>
                        <a href="#">Inventory</a>
                        <span><i class="fas fa-chevron-right"></i></span>
                        <a href="#">Stock List</a>
                        <span><i class="fas fa-chevron-right"></i></span>
                        <span class="current">Add New</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h1><i class="fas fa-plus-circle me-2"></i>Add New Stock</h1>
                            <p>Fill in the details below to add new inventory item</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn-custom btn-reset" style="text-decoration:none;">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════ MAIN CONTENT ══════ -->
        <div class="main-content">
            <div class="container">
                <div class="row g-4">

                    <!-- ── LEFT: Form ── -->
                    <div class="col-lg-8">

                        <!-- Progress -->
                        <div class="progress-card">
                            <div class="progress-top">
                                <div class="label">
                                    <i class="fas fa-tasks"></i>
                                    Form Completion
                                </div>
                                <div class="count" id="progressCount">0 / 5 fields</div>
                            </div>
                            <div class="progress-steps" id="formProgress">
                                <div class="progress-step" data-field="brand_name">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-step" data-field="model_number">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-step" data-field="product_name">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-step" data-field="quantity">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-step" data-field="price">
                                    <div class="progress-fill"></div>
                                </div>
                            </div>
                        </div>

                        <form method="post" action="<?= site_url('admin/stock/save') ?>" enctype="multipart/form-data"
                            id="stockForm" novalidate>

                            <!-- ── Product Information ── -->
                            <div class="form-card delay-1 mb-4">
                                <div class="card-section-header">
                                    <div class="section-icon blue">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div class="section-text">
                                        <h5>Product Information</h5>
                                        <p>Basic details about the product</p>
                                    </div>
                                </div>
                                <div class="card-section-body">

                                    <div class="form-row-grid">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-icon"><i class="fas fa-building"></i></span>
                                                Brand Name
                                                <span class="required-dot"></span>
                                                <span class="info-tip">
                                                    <i class="fas fa-info-circle"></i>
                                                    <span class="tip-content">Enter the manufacturer's brand name</span>
                                                </span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" name="brand_name" class="form-control"
                                                    placeholder="e.g. Samsung, Apple..." required data-track>
                                                <i class="fas fa-building input-icon"></i>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-icon"><i class="fas fa-barcode"></i></span>
                                                Model Number
                                                <span class="required-dot"></span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" name="model_number" class="form-control"
                                                    placeholder="e.g. SM-A546E" required data-track>
                                                <i class="fas fa-barcode input-icon"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top:1.25rem;">
                                        <label>
                                            <span class="label-icon"><i class="fas fa-box-open"></i></span>
                                            Product Name
                                            <span class="required-dot"></span>
                                        </label>
                                        <div class="input-wrapper">
                                            <input type="text" name="product_name" class="form-control"
                                                placeholder="Enter full product name..." required data-track>
                                            <i class="fas fa-box-open input-icon"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- ── Pricing & Quantity ── -->
                            <div class="form-card delay-2 mb-4">
                                <div class="card-section-header">
                                    <div class="section-icon green">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="section-text">
                                        <h5>Pricing & Quantity</h5>
                                        <p>Set stock quantity and unit pricing</p>
                                    </div>
                                </div>
                                <div class="card-section-body">
                                    <div class="form-row-grid">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-icon"><i class="fas fa-layer-group"></i></span>
                                                Quantity
                                                <span class="required-dot"></span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="number" name="quantity" class="form-control"
                                                    placeholder="0" min="1" required data-track>
                                                <i class="fas fa-layer-group input-icon"></i>
                                                <span class="input-suffix">units</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>
                                                <span class="label-icon"><i class="fas fa-dollar-sign"></i></span>
                                                Unit Price
                                                <span class="required-dot"></span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="number" name="price" class="form-control"
                                                    placeholder="0.00" min="0" step="0.01" required data-track>
                                                <i class="fas fa-dollar-sign input-icon"></i>
                                                <span class="input-suffix">USD</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Live Total Preview -->
                                    <div id="totalPreview"
                                        style="display:none;margin-top:1.25rem;padding:1rem;background:var(--primary-50);border-radius:12px;border:1px solid rgba(79,70,229,0.1);">
                                        <div style="display:flex;align-items:center;justify-content:space-between;">
                                            <div style="display:flex;align-items:center;gap:0.5rem;">
                                                <div
                                                    style="width:32px;height:32px;background:var(--primary-100);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                    <i class="fas fa-receipt" style="font-size:0.8rem;color:var(--primary);"></i>
                                                </div>
                                                <div>
                                                    <div style="font-size:0.7rem;color:var(--gray-500);font-weight:500;">
                                                        Total Inventory Value</div>
                                                    <div style="font-size:0.65rem;color:var(--gray-400);">
                                                        Qty × Unit Price</div>
                                                </div>
                                            </div>
                                            <div id="totalValue"
                                                style="font-size:1.25rem;font-weight:800;color:var(--primary);letter-spacing:-0.025em;">
                                                $0.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── Product Image ── -->
                            <div class="form-card delay-3 mb-4">
                                <div class="card-section-header">
                                    <div class="section-icon orange">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <div class="section-text">
                                        <h5>Product Image</h5>
                                        <p>Upload a product photo for identification</p>
                                    </div>
                                </div>
                                <div class="card-section-body">

                                    <div class="form-group">
                                        <label>
                                            <span class="label-icon"><i class="fas fa-camera"></i></span>
                                            Product Photo
                                            <span class="optional-badge">Optional</span>
                                        </label>

                                        <div class="file-upload-area" id="dropZone">
                                            <input type="file" name="photo" class="file-input-hidden" id="fileInput"
                                                accept="image/*">
                                            <div class="upload-icon-wrapper">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-text">
                                                <h4>Drop your image here, or <span>browse</span></h4>
                                                <p>Supports: JPG, PNG, WEBP — Max 5MB</p>
                                            </div>

                                            <div class="file-preview" id="filePreview">
                                                <div class="file-preview-icon">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                                <div class="file-preview-info">
                                                    <h5 id="fileName">image.jpg</h5>
                                                    <p id="fileSize">2.4 MB</p>
                                                </div>
                                                <button type="button" class="file-remove" id="fileRemove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="image-preview-container" id="imagePreview">
                                            <img id="previewImg" src="" alt="Preview">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- ── Actions ── -->
                            <div class="form-card delay-4">
                                <div class="card-section-body">
                                    <div class="form-actions" style="margin-top:0;padding-top:0;border-top:none;">
                                        <button type="button" class="btn-custom btn-reset" onclick="resetForm()">
                                            <i class="fas fa-redo-alt"></i>
                                            <span>Reset</span>
                                        </button>
                                        <button type="button" class="btn-custom btn-draft">
                                            <i class="fas fa-save"></i>
                                            <span>Save Draft</span>
                                        </button>
                                        <button type="submit" class="btn-custom btn-submit" id="submitBtn">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Add to Inventory</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- ── RIGHT: Sidebar ── -->
                    <div class="col-lg-4 sidebar-col">

                        <!-- Tips -->
                        <div class="info-card delay-5">
                            <div class="info-card-header">
                                <h6><i class="fas fa-lightbulb"></i> Quick Tips</h6>
                            </div>
                            <div class="info-card-body">
                                <div class="tip-item">
                                    <div class="tip-icon blue">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div class="tip-text">
                                        Use <strong>official brand names</strong> for consistency across inventory.
                                    </div>
                                </div>
                                <div class="tip-item">
                                    <div class="tip-icon green">
                                        <i class="fas fa-barcode"></i>
                                    </div>
                                    <div class="tip-text">
                                        <strong>Model numbers</strong> help identify products quickly during search.
                                    </div>
                                </div>
                                <div class="tip-item">
                                    <div class="tip-icon orange">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <div class="tip-text">
                                        Upload <strong>clear product images</strong> for easy visual identification.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Keyboard Shortcuts -->
                        <div class="info-card delay-6">
                            <div class="info-card-header">
                                <h6><i class="fas fa-keyboard"></i> Keyboard Shortcuts</h6>
                            </div>
                            <div class="info-card-body">
                                <div class="shortcut-row">
                                    <span class="shortcut-label">Submit form</span>
                                    <div><kbd>Ctrl</kbd> + <kbd>Enter</kbd></div>
                                </div>
                                <div class="shortcut-row">
                                    <span class="shortcut-label">Reset form</span>
                                    <div><kbd>Ctrl</kbd> + <kbd>R</kbd></div>
                                </div>
                                <div class="shortcut-row">
                                    <span class="shortcut-label">Focus search</span>
                                    <div><kbd>Ctrl</kbd> + <kbd>K</kbd></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Items -->
                        <div class="info-card delay-6">
                            <div class="info-card-header">
                                <h6><i class="fas fa-clock-rotate-left"></i> Recently Added</h6>
                            </div>
                            <div class="info-card-body">
                                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                                    <div
                                        style="display:flex;align-items:center;gap:0.75rem;padding:0.625rem;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);">
                                        <div
                                            style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.65rem;font-weight:700;flex-shrink:0;">
                                            SA</div>
                                        <div style="flex:1;min-width:0;">
                                            <div
                                                style="font-size:0.78rem;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                Galaxy A54 5G</div>
                                            <div style="font-size:0.65rem;color:var(--gray-400);">Samsung · 25 units
                                            </div>
                                        </div>
                                        <div style="font-size:0.75rem;font-weight:700;color:var(--success);">$449</div>
                                    </div>
                                    <div
                                        style="display:flex;align-items:center;gap:0.75rem;padding:0.625rem;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);">
                                        <div
                                            style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,#10b981,#34d399);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.65rem;font-weight:700;flex-shrink:0;">
                                            AP</div>
                                        <div style="flex:1;min-width:0;">
                                            <div
                                                style="font-size:0.78rem;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                iPhone 15 Pro</div>
                                            <div style="font-size:0.65rem;color:var(--gray-400);">Apple · 10 units
                                            </div>
                                        </div>
                                        <div style="font-size:0.75rem;font-weight:700;color:var(--success);">$999</div>
                                    </div>
                                    <div
                                        style="display:flex;align-items:center;gap:0.75rem;padding:0.625rem;border-radius:10px;background:var(--gray-50);border:1px solid var(--gray-100);">
                                        <div
                                            style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,#f59e0b,#fbbf24);display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.65rem;font-weight:700;flex-shrink:0;">
                                            XI</div>
                                        <div style="flex:1;min-width:0;">
                                            <div
                                                style="font-size:0.78rem;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                Redmi Note 13</div>
                                            <div style="font-size:0.65rem;color:var(--gray-400);">Xiaomi · 40 units
                                            </div>
                                        </div>
                                        <div style="font-size:0.75rem;font-weight:700;color:var(--success);">$199</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /sidebar -->

                </div>
            </div>
        </div>

    </div>

    <script>
        // ═══════════════════════════════════════
        // PROGRESS TRACKING
        // ═══════════════════════════════════════
        const trackedInputs = document.querySelectorAll('[data-track]');
        const progressSteps = document.querySelectorAll('.progress-step');
        const progressCount = document.getElementById('progressCount');

        function updateProgress() {
            let filled = 0;
            trackedInputs.forEach((input, index) => {
                if (input.value.trim() !== '') {
                    filled++;
                    progressSteps[index]?.classList.add('completed');
                } else {
                    progressSteps[index]?.classList.remove('completed');
                }
            });
            progressCount.textContent = `${filled} / ${trackedInputs.length} fields`;
        }

        trackedInputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });

        // ═══════════════════════════════════════
        // LIVE TOTAL CALCULATION
        // ═══════════════════════════════════════
        const qtyInput = document.querySelector('input[name="quantity"]');
        const priceInput = document.querySelector('input[name="price"]');
        const totalPreview = document.getElementById('totalPreview');
        const totalValue = document.getElementById('totalValue');

        function updateTotal() {
            const qty = parseFloat(qtyInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            const total = qty * price;

            if (qty > 0 && price > 0) {
                totalPreview.style.display = 'block';
                totalValue.textContent = '$' + total.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            } else {
                totalPreview.style.display = 'none';
            }
        }

        qtyInput.addEventListener('input', updateTotal);
        priceInput.addEventListener('input', updateTotal);

        // ═══════════════════════════════════════
        // FILE UPLOAD
        // ═══════════════════════════════════════
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const fileRemove = document.getElementById('fileRemove');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        ['dragenter', 'dragover'].forEach(event => {
            dropZone.addEventListener(event, e => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });
        });

        ['dragleave', 'drop'].forEach(event => {
            dropZone.addEventListener(event, e => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
            });
        });

        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                handleFile(files[0]);
            }
        });

        fileInput.addEventListener('change', function () {
            if (this.files.length) {
                handleFile(this.files[0]);
            }
        });

        function handleFile(file) {
            fileName.textContent = file.name;
            fileSize.textContent = formatSize(file.size);
            filePreview.classList.add('show');
            dropZone.classList.add('has-file');

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    imagePreview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        fileRemove.addEventListener('click', e => {
            e.stopPropagation();
            fileInput.value = '';
            filePreview.classList.remove('show');
            dropZone.classList.remove('has-file');
            imagePreview.classList.remove('show');
            previewImg.src = '';
        });

        function formatSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        // ═══════════════════════════════════════
        // INPUT VALIDATION VISUAL FEEDBACK
        // ═══════════════════════════════════════
        trackedInputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (this.value.trim() !== '') {
                    this.classList.add('valid');
                    this.classList.remove('invalid');
                } else if (this.hasAttribute('required')) {
                    this.classList.add('invalid');
                    this.classList.remove('valid');
                }
            });

            input.addEventListener('input', function () {
                this.classList.remove('valid', 'invalid');
            });
        });

        // ═══════════════════════════════════════
        // FORM SUBMIT
        // ═══════════════════════════════════════
        document.getElementById('stockForm').addEventListener('submit', function (e) {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
        });

        function showToast() {
            const toast = document.getElementById('successToast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 4000);
        }

        function resetForm() {
            const form = document.getElementById('stockForm');
            form.reset();
            trackedInputs.forEach(input => {
                input.classList.remove('valid', 'invalid');
            });
            progressSteps.forEach(step => step.classList.remove('completed'));
            progressCount.textContent = `0 / ${trackedInputs.length} fields`;
            filePreview.classList.remove('show');
            dropZone.classList.remove('has-file');
            imagePreview.classList.remove('show');
            previewImg.src = '';
            totalPreview.style.display = 'none';
        }

        // ═══════════════════════════════════════
        // KEYBOARD SHORTCUTS
        // ═══════════════════════════════════════
        document.addEventListener('keydown', function (e) {
            // Ctrl + Enter → Submit
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('submitBtn').click();
            }
        });
    </script>

</body>

</html>