<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?= base_url(); ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($page_title) ? html_escape($page_title) . ' | FilterBook' : 'FilterBook'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    :root {
      --primary: #0ea5e9;
      --primary-dark: #0284c7;
      --primary-light: #e0f2fe;
      --accent-light: #fff7ed;
      --dark: #0f172a;
      --mid: #334155;
      --muted: #64748b;
      --light: #f8fafc;
      --border: #e2e8f0;
      --white: #ffffff;
      --shadow-sm: 0 1px 3px rgba(14, 165, 233, 0.08), 0 1px 2px rgba(14, 165, 233, 0.06);
      --shadow: 0 4px 24px rgba(14, 165, 233, 0.12), 0 2px 8px rgba(14, 165, 233, 0.08);
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'DM Sans', sans-serif;
      color: var(--dark);
      background:
        radial-gradient(circle at top right, rgba(14, 165, 233, 0.08), transparent 28%),
        linear-gradient(180deg, #f8fbff 0%, #ffffff 18%, #f8fafc 100%);
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Sora', sans-serif;
    }

    .navbar {
      background: rgba(255, 255, 255, 0.92);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      padding: 14px 0;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 20px rgba(14, 165, 233, 0.06);
    }

    .navbar-brand {
      font-family: 'Sora', sans-serif;
      font-weight: 800;
      font-size: 1.5rem;
      color: var(--primary) !important;
      letter-spacing: -0.5px;
      text-decoration: none;
    }

    .navbar-brand span {
      color: var(--dark);
    }

    .nav-link {
      color: var(--mid) !important;
      font-weight: 500;
      font-size: 0.9rem;
      padding: 6px 16px !important;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .nav-link:hover {
      background: var(--primary-light);
      color: var(--primary) !important;
    }

    .btn-nav {
      background: var(--primary);
      color: white !important;
      border-radius: 10px;
      padding: 8px 20px !important;
      font-weight: 600;
      font-size: 0.88rem;
    }

    .btn-nav:hover {
      background: var(--primary-dark);
      box-shadow: var(--shadow-sm);
    }

    .navbar-toggler {
      border: 1px solid var(--border) !important;
      border-radius: 12px;
      padding: 8px 10px;
      color: var(--dark);
      background: var(--white);
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.2rem rgba(14, 165, 233, 0.15);
    }

    html {
      scroll-behavior: smooth;
    }

    .legal-shell {
      padding: 72px 0 96px;
    }

    .legal-hero {
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.10), rgba(255, 255, 255, 0.96), rgba(249, 115, 22, 0.08));
      border: 1px solid rgba(14, 165, 233, 0.10);
      border-radius: 28px;
      box-shadow: var(--shadow);
      padding: 42px;
      margin-bottom: 30px;
    }

    .legal-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--primary-light);
      color: var(--primary-dark);
      border-radius: 999px;
      padding: 8px 14px;
      font-weight: 700;
      font-size: 0.82rem;
      margin-bottom: 18px;
    }

    .legal-hero h1 {
      font-size: clamp(2rem, 3vw, 3rem);
      font-weight: 800;
      margin-bottom: 12px;
    }

    .legal-hero p {
      color: var(--muted);
      font-size: 1rem;
      line-height: 1.75;
      margin: 0;
      max-width: 760px;
    }

    .legal-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 24px;
      box-shadow: var(--shadow);
      padding: 34px;
    }

    .legal-meta {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--muted);
      font-size: 0.92rem;
      margin-bottom: 20px;
      background: var(--light);
      border-radius: 999px;
      padding: 10px 16px;
    }

    .legal-section+.legal-section {
      margin-top: 28px;
      padding-top: 28px;
      border-top: 1px solid var(--border);
    }

    .legal-section h2 {
      font-size: 1.2rem;
      margin-bottom: 12px;
      font-weight: 700;
    }

    .legal-section p,
    .legal-section li {
      color: var(--mid);
      line-height: 1.8;
      font-size: 0.98rem;
    }

    .legal-section ul {
      margin: 0;
      padding-left: 1.2rem;
    }

    footer {
      background: #0f172a;
      color: white;
      padding: 70px 0 32px;
    }

    .footer-logo {
      font-family: 'Sora', sans-serif;
      font-size: 1.55rem;
      font-weight: 800;
      color: var(--primary);
      margin-bottom: 14px;
    }

    .footer-logo span {
      color: white;
    }

    .footer-desc,
    .footer-copy {
      color: rgba(255, 255, 255, 0.75);
      line-height: 1.75;
      font-size: 0.94rem;
    }

    .footer-heading {
      font-family: 'Sora', sans-serif;
      font-size: 0.92rem;
      font-weight: 700;
      margin-bottom: 18px;
      color: white;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .footer-link {
      display: block;
      color: rgba(255, 255, 255, 0.74);
      text-decoration: none;
      margin-bottom: 12px;
      transition: color 0.2s ease;
    }

    .footer-link:hover {
      color: #7dd3fc;
    }

    .social-link {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.08);
      color: white;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .social-link:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-2px);
    }

    .footer-divider {
      border-color: rgba(255, 255, 255, 0.12);
      margin: 32px 0 22px;
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    @media (max-width: 767.98px) {
      .navbar {
        padding: 10px 0;
      }

      .navbar-brand {
        font-size: 1.3rem;
      }

      .navbar-collapse {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 14px;
        margin-top: 12px;
        box-shadow: var(--shadow);
      }

      .navbar-nav {
        align-items: stretch !important;
      }

      .nav-link {
        display: block;
        text-align: center;
      }

      .btn-nav {
        width: 100%;
      }

      .legal-shell {
        padding: 40px 0 64px;
      }

      .legal-hero,
      .legal-card {
        padding: 24px;
        border-radius: 20px;
      }

      .legal-meta {
        width: 100%;
        justify-content: center;
        text-align: center;
      }

      .footer-bottom {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    @media (max-width: 575.98px) {
      .legal-hero h1 {
        font-size: 1.8rem;
      }

      .legal-hero p,
      .legal-section p,
      .legal-section li {
        font-size: 0.94rem;
      }

      .footer-desc {
        max-width: 100%;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="<?= site_url(); ?>">Filter<span>Book</span></a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
        aria-label="Toggle navigation">
        <i class="bi bi-list fs-4"></i>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto align-items-center gap-1">
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#demo">Demo</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#how">How It Works</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#app">App</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#testimonials">Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>#pricing">Pricing</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="<?= site_url('privacy-policy'); ?>">Privacy Policy</a></li> -->
          <!-- <li class="nav-item"><a class="nav-link" href="<?= site_url('terms-and-conditions'); ?>">Terms & Conditions</a></li> -->
          <li class="nav-item ms-2">
            <a class="nav-link btn-nav" href="<?= site_url('admin/sign_up'); ?>">Start Free Trial</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>