<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?= base_url(); ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FilterBook – CRM for RO Service Businesses</title>
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
      --accent: #f97316;
      --accent-light: #fff7ed;
      --dark: #0f172a;
      --mid: #334155;
      --muted: #64748b;
      --light: #f8fafc;
      --border: #e2e8f0;
      --white: #ffffff;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --gradient: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%);
      --shadow-sm: 0 1px 3px rgba(14, 165, 233, 0.08), 0 1px 2px rgba(14, 165, 233, 0.06);
      --shadow: 0 4px 24px rgba(14, 165, 233, 0.12), 0 2px 8px rgba(14, 165, 233, 0.08);
      --shadow-lg: 0 20px 60px rgba(14, 165, 233, 0.18), 0 8px 24px rgba(14, 165, 233, 0.12);
      --radius: 16px;
      --radius-sm: 10px;
    }

    * {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      color: var(--dark);
      background: var(--white);
      overflow-x: hidden;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Sora', sans-serif;
    }

    /* ─── NAVBAR ─── */
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
      transform: translateY(-1px);
      box-shadow: var(--shadow-sm);
    }

    /* ─── HERO ─── */
    .hero {
      min-height: 92vh;
      display: flex;
      align-items: center;
      background: linear-gradient(160deg, #f0f9ff 0%, #ffffff 40%, #fff7ed 100%);
      position: relative;
      overflow: hidden;
      padding: 80px 0 60px;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -120px;
      right: -120px;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(14, 165, 233, 0.12) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -80px;
      left: -80px;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(249, 115, 22, 0.08) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--primary-light);
      color: var(--primary-dark);
      border: 1px solid rgba(14, 165, 233, 0.2);
      border-radius: 50px;
      padding: 6px 16px;
      font-size: 0.82rem;
      font-weight: 600;
      margin-bottom: 24px;
      letter-spacing: 0.3px;
    }

    .hero-badge .dot {
      width: 8px;
      height: 8px;
      background: var(--primary);
      border-radius: 50%;
      animation: pulse 1.8s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1)
      }

      50% {
        opacity: .6;
        transform: scale(1.3)
      }
    }

    .hero h1 {
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      font-weight: 800;
      line-height: 1.12;
      letter-spacing: -1.5px;
      color: var(--dark);
      margin-bottom: 22px;
    }

    .hero h1 .highlight {
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero p.lead {
      font-size: 1.1rem;
      color: var(--muted);
      line-height: 1.7;
      max-width: 520px;
      margin-bottom: 36px;
      font-weight: 400;
    }

    .hero-cta-group {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-bottom: 48px;
    }

    .btn-primary-hero {
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 12px;
      padding: 14px 32px;
      font-weight: 700;
      font-size: 1rem;
      font-family: 'Sora', sans-serif;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-primary-hero:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(14, 165, 233, 0.45);
      color: white;
    }

    .btn-secondary-hero {
      background: white;
      color: var(--dark);
      border: 2px solid var(--border);
      border-radius: 12px;
      padding: 13px 28px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.25s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-secondary-hero:hover {
      border-color: var(--primary);
      color: var(--primary);
      transform: translateY(-2px);
    }

    .hero-stats {
      display: flex;
      gap: 36px;
      flex-wrap: wrap;
    }

    .hero-stat {
      display: flex;
      flex-direction: column;
    }

    .hero-stat .num {
      font-family: 'Sora', sans-serif;
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--dark);
      line-height: 1;
    }

    .hero-stat .label {
      font-size: 0.78rem;
      color: var(--muted);
      font-weight: 500;
      margin-top: 4px;
    }

    /* Dashboard mockup */
    .hero-visual {
      position: relative;
    }

    .dashboard-mockup {
      background: white;
      border-radius: 20px;
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border);
      overflow: hidden;
      position: relative;
      z-index: 1;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-10px)
      }
    }

    .mockup-header {
      background: var(--light);
      padding: 12px 18px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .mockup-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
    }

    .mockup-title {
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--muted);
      margin-left: 8px;
    }

    .mockup-body {
      padding: 20px;
      background: #f8fafc;
    }

    .stat-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-bottom: 14px;
    }

    .stat-card {
      background: white;
      border-radius: 12px;
      padding: 14px;
      border: 1px solid var(--border);
      text-align: center;
    }

    .stat-card .s-icon {
      font-size: 1.2rem;
      margin-bottom: 4px;
    }

    .stat-card .s-num {
      font-family: 'Sora', sans-serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark);
    }

    .stat-card .s-lbl {
      font-size: 0.6rem;
      color: var(--muted);
      font-weight: 500;
      margin-top: 2px;
    }

    .mockup-chart {
      background: white;
      border-radius: 12px;
      padding: 14px;
      border: 1px solid var(--border);
    }

    .chart-bar-row {
      display: flex;
      align-items: flex-end;
      gap: 6px;
      height: 60px;
      margin-top: 8px;
    }

    .chart-bar {
      flex: 1;
      border-radius: 6px 6px 0 0;
      transition: height 0.3s;
    }

    .floating-badge {
      position: absolute;
      background: white;
      border-radius: 14px;
      padding: 10px 16px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.8rem;
      font-weight: 600;
      white-space: nowrap;
      z-index: 2;
      animation: floatBadge 3s ease-in-out infinite;
    }

    @keyframes floatBadge {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-6px)
      }
    }

    .badge-1 {
      top: 15%;
      left: -18%;
      animation-delay: 0.5s;
    }

    .badge-2 {
      bottom: 18%;
      right: -12%;
      animation-delay: 1s;
    }

    .badge-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    /* ─── SECTION COMMONS ─── */
    section {
      padding: 90px 0;
    }

    .section-label {
      display: inline-block;
      background: var(--primary-light);
      color: var(--primary-dark);
      border-radius: 50px;
      padding: 5px 16px;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .section-title {
      font-size: clamp(1.8rem, 3.5vw, 2.6rem);
      font-weight: 800;
      letter-spacing: -1px;
      color: var(--dark);
      margin-bottom: 14px;
    }

    .section-sub {
      font-size: 1.05rem;
      color: var(--muted);
      line-height: 1.7;
      max-width: 560px;
      margin: 0 auto 56px;
    }

    /* ─── FEATURES ─── */
    #features {
      background: var(--light);
    }

    .feature-card {
      background: white;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 32px 28px;
      height: 100%;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gradient);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow);
      border-color: rgba(14, 165, 233, 0.2);
    }

    .feature-card:hover::before {
      opacity: 1;
    }

    .feature-icon {
      width: 56px;
      height: 56px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 20px;
    }

    .feature-card h5 {
      font-size: 1.05rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 10px;
    }

    .feature-card p {
      font-size: 0.9rem;
      color: var(--muted);
      line-height: 1.65;
      margin: 0;
    }

    .feature-tag {
      display: inline-block;
      background: var(--primary-light);
      color: var(--primary);
      border-radius: 6px;
      padding: 3px 10px;
      font-size: 0.72rem;
      font-weight: 700;
      margin-top: 14px;
      letter-spacing: 0.3px;
    }

    /* ─── DASHBOARD PREVIEW ─── */
    #dashboard {
      background: white;
    }

    .dashboard-screen {
      background: linear-gradient(145deg, #f0f9ff, #f8fafc);
      border-radius: 24px;
      padding: 28px;
      border: 1px solid var(--border);
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }

    .dash-sidebar {
      background: var(--dark);
      border-radius: 16px;
      padding: 20px 14px;
      height: 100%;
    }

    .dash-nav-item {
      padding: 10px 14px;
      border-radius: 10px;
      color: rgba(255, 255, 255, 0.55);
      font-size: 0.82rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 4px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .dash-nav-item.active,
    .dash-nav-item:hover {
      background: var(--primary);
      color: white;
    }

    .dash-logo {
      color: white;
      font-family: 'Sora', sans-serif;
      font-weight: 800;
      font-size: 1rem;
      padding: 0 14px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 16px;
    }

    .dash-main {
      padding: 0 0 0 16px;
    }

    .dash-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .dash-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark);
    }

    .dash-date {
      font-size: 0.78rem;
      color: var(--muted);
    }

    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
      margin-bottom: 16px;
    }

    .kpi-card {
      background: white;
      border-radius: 14px;
      padding: 16px;
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .kpi-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .kpi-info .num {
      font-family: 'Sora', sans-serif;
      font-size: 1.2rem;
      font-weight: 800;
      color: var(--dark);
    }

    .kpi-info .lbl {
      font-size: 0.7rem;
      color: var(--muted);
      font-weight: 500;
    }

    .recent-list {
      background: white;
      border-radius: 14px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .recent-header {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border);
      font-size: 0.82rem;
      font-weight: 700;
      color: var(--dark);
    }

    .recent-item {
      padding: 12px 16px;
      border-bottom: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .recent-item:last-child {
      border-bottom: none;
    }

    .r-avatar {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 700;
      color: white;
      flex-shrink: 0;
    }

    .r-name {
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--dark);
    }

    .r-sub {
      font-size: 0.7rem;
      color: var(--muted);
    }

    .r-badge {
      margin-left: auto;
      font-size: 0.68rem;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 20px;
    }

    /* ─── HOW IT WORKS ─── */
    #how {
      background: linear-gradient(160deg, #f0f9ff 0%, #f8fafc 100%);
    }

    .step-connector {
      display: flex;
      align-items: center;
      gap: 0;
    }

    .step-box {
      background: white;
      border-radius: var(--radius);
      padding: 28px 24px;
      border: 1px solid var(--border);
      text-align: center;
      position: relative;
      transition: all 0.3s;
      flex: 1;
    }

    .step-box:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow);
    }

    .step-num {
      width: 40px;
      height: 40px;
      background: var(--gradient);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Sora', sans-serif;
      font-weight: 800;
      font-size: 0.9rem;
      margin: 0 auto 16px;
      box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .step-arrow {
      color: var(--border);
      font-size: 1.5rem;
      padding: 0 8px;
      flex-shrink: 0;
    }

    .step-box h6 {
      font-size: 0.95rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 8px;
    }

    .step-box p {
      font-size: 0.82rem;
      color: var(--muted);
      margin: 0;
      line-height: 1.6;
    }

    .step-icon {
      font-size: 1.8rem;
      margin-bottom: 12px;
    }

    /* ─── MOBILE APP ─── */
    #app {
      background: white;
    }

    .phone-frame {
      width: 220px;
      background: var(--dark);
      border-radius: 36px;
      padding: 12px;
      box-shadow: 0 30px 80px rgba(15, 23, 42, 0.35);
      position: relative;
      margin: 0 auto;
    }

    .phone-screen {
      background: #f8fafc;
      border-radius: 26px;
      overflow: hidden;
      min-height: 380px;
    }

    .phone-notch {
      width: 80px;
      height: 24px;
      background: var(--dark);
      border-radius: 0 0 16px 16px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .phone-content {
      padding: 12px;
    }

    .app-header {
      background: var(--primary);
      padding: 14px 12px 20px;
      border-radius: 0 0 20px 20px;
      margin: -12px -12px 12px;
      color: white;
    }

    .app-header h6 {
      font-size: 0.75rem;
      font-weight: 700;
      margin: 0 0 2px;
      opacity: 0.8;
    }

    .app-header p {
      font-size: 1rem;
      font-weight: 800;
      font-family: 'Sora', sans-serif;
      margin: 0;
    }

    .app-card {
      background: white;
      border-radius: 12px;
      padding: 12px;
      margin-bottom: 8px;
      border: 1px solid var(--border);
    }

    .app-card-title {
      font-size: 0.7rem;
      font-weight: 700;
      color: var(--muted);
      margin-bottom: 6px;
    }

    .app-list-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 5px 0;
      border-bottom: 1px solid #f1f5f9;
    }

    .app-list-item:last-child {
      border-bottom: none;
    }

    .app-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .app-text {
      font-size: 0.68rem;
      color: var(--dark);
      font-weight: 500;
    }

    .app-time {
      font-size: 0.62rem;
      color: var(--muted);
      margin-left: auto;
    }

    .app-feature-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .app-feature-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 14px 0;
      border-bottom: 1px solid var(--border);
    }

    .app-feature-list li:last-child {
      border-bottom: none;
    }

    .app-feat-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .app-feat-title {
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--dark);
    }

    .app-feat-desc {
      font-size: 0.8rem;
      color: var(--muted);
      margin-top: 2px;
    }

    /* ─── CATALOG ─── */
    #catalog {
      background: var(--light);
    }

    .catalog-card {
      background: white;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    .catalog-header {
      background: var(--gradient);
      padding: 24px;
      color: white;
    }

    .catalog-header h6 {
      font-size: 0.8rem;
      opacity: 0.85;
      margin: 0 0 4px;
    }

    .catalog-header h4 {
      font-size: 1.1rem;
      font-weight: 800;
      margin: 0;
    }

    .catalog-body {
      padding: 20px;
    }

    .catalog-product {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 0;
      border-bottom: 1px solid var(--border);
    }

    .catalog-product:last-child {
      border-bottom: none;
    }

    .prod-img {
      width: 52px;
      height: 52px;
      border-radius: 10px;
      background: var(--light);
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      flex-shrink: 0;
    }

    .prod-name {
      font-size: 0.85rem;
      font-weight: 700;
      color: var(--dark);
    }

    .prod-price {
      font-size: 0.8rem;
      color: var(--primary);
      font-weight: 700;
    }

    .prod-desc {
      font-size: 0.72rem;
      color: var(--muted);
    }

    .qr-block {
      background: var(--light);
      border: 2px dashed var(--border);
      border-radius: 14px;
      padding: 24px;
      text-align: center;
    }

    .qr-code {
      width: 100px;
      height: 100px;
      background: white;
      border-radius: 10px;
      margin: 0 auto 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
    }

    /* ─── NOTIFICATIONS ─── */
    #notifications {
      background: white;
    }

    .notif-card {
      background: white;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 20px 24px;
      display: flex;
      align-items: center;
      gap: 18px;
      transition: all 0.3s;
      margin-bottom: 14px;
      position: relative;
      overflow: hidden;
    }

    .notif-card::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
    }

    .notif-card.service::before {
      background: var(--primary);
    }

    .notif-card.emi::before {
      background: var(--warning);
    }

    .notif-card.complaint::before {
      background: var(--danger);
    }

    .notif-card.amc::before {
      background: var(--success);
    }

    .notif-card:hover {
      transform: translateX(4px);
      box-shadow: var(--shadow);
    }

    .notif-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      flex-shrink: 0;
    }

    .notif-content h6 {
      font-size: 0.92rem;
      font-weight: 700;
      color: var(--dark);
      margin: 0 0 4px;
      word-break: break-word;
    }

    .notif-content p {
      font-size: 0.8rem;
      color: var(--muted);
      margin: 0;
      word-break: break-word;
    }

    .notif-time {
      margin-left: auto;
      font-size: 0.75rem;
      color: var(--muted);
      white-space: nowrap;
      font-weight: 500;
    }

    .notif-badge {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      position: absolute;
      top: 20px;
      right: 20px;
    }

    /* ─── TESTIMONIALS ─── */
    #testimonials {
      background: var(--light);
    }

    .testimonial-card {
      background: white;
      border-radius: var(--radius);
      padding: 28px;
      border: 1px solid var(--border);
      height: 100%;
      transition: all 0.3s;
      position: relative;
    }

    .testimonial-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow);
    }

    .quote-icon {
      font-size: 2rem;
      color: var(--primary);
      opacity: 0.3;
      margin-bottom: 12px;
      line-height: 1;
    }

    .testimonial-text {
      font-size: 0.92rem;
      color: var(--mid);
      line-height: 1.7;
      margin-bottom: 20px;
      font-style: italic;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .author-avatar {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1rem;
      color: white;
      flex-shrink: 0;
    }

    .author-name {
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--dark);
    }

    .author-role {
      font-size: 0.75rem;
      color: var(--muted);
    }

    .stars {
      color: #f59e0b;
      font-size: 0.85rem;
      margin-bottom: 14px;
      letter-spacing: 2px;
    }

    .video-testimonial {
      background: var(--dark);
      border-radius: var(--radius);
      overflow: hidden;
      position: relative;
      aspect-ratio: 16/9;
      cursor: pointer;
    }

    .video-thumb {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #0f172a, #1e293b);
    }

    .play-btn {
      width: 64px;
      height: 64px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.4rem;
      border: 2px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s;
      text-align: center;
    }

    .video-testimonial:hover .play-btn {
      background: var(--primary);
      border-color: var(--primary);
      transform: scale(1.1);
    }

    .video-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 20px;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
      color: white;
    }

    .video-overlay h6 {
      font-size: 0.88rem;
      font-weight: 700;
      margin: 0 0 2px;
    }

    .video-overlay p {
      font-size: 0.75rem;
      opacity: 0.75;
      margin: 0;
    }

    .video-duration {
      position: absolute;
      top: 14px;
      right: 14px;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      font-size: 0.72rem;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 6px;
    }

    /* ─── PRICING ─── */
    #pricing {
      background: white;
    }

    .pricing-card {
      background: white;
      border: 2px solid var(--border);
      border-radius: 20px;
      padding: 36px 32px;
      height: 100%;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
    }

    .pricing-card.featured {
      background: var(--dark);
      border-color: var(--primary);
      transform: scale(1.04);
      box-shadow: 0 20px 60px rgba(14, 165, 233, 0.25);
    }

    .pricing-card.featured * {
      --dark: #ffffff;
      --mid: rgba(255, 255, 255, 0.8);
      --muted: rgba(255, 255, 255, 0.6);
      --border: rgba(255, 255, 255, 0.15);
    }

    .pricing-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      background: var(--primary);
      color: white;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 20px;
      letter-spacing: 0.5px;
    }

    .price-plan {
      font-size: 0.8rem;
      font-weight: 700;
      color: var(--muted);
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .price-val {
      font-family: 'Sora', sans-serif;
      font-size: 2.6rem;
      font-weight: 800;
      color: var(--dark);
      line-height: 1;
      margin-bottom: 4px;
    }

    .price-period {
      font-size: 0.85rem;
      color: var(--muted);
    }

    .price-divider {
      border-color: var(--border);
      margin: 24px 0;
    }

    .price-feature {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.88rem;
      color: var(--dark);
      margin-bottom: 12px;
    }

    .price-feature i {
      color: var(--success);
      font-size: 1rem;
    }

    .pricing-card.featured .price-feature i {
      color: #34d399;
    }

    .pricing-card.featured .price-plan,
    .pricing-card.featured .price-val,
    .pricing-card.featured .price-period,
    .pricing-card.featured .price-feature {
      color: white;
    }

    .pricing-card.featured .price-period,
    .pricing-card.featured .price-plan {
      color: rgba(255, 255, 255, 0.65);
    }

    .btn-price {
      width: 100%;
      padding: 14px;
      border-radius: 12px;
      font-weight: 700;
      font-size: 0.95rem;
      font-family: 'Sora', sans-serif;
      border: none;
      cursor: pointer;
      transition: all 0.25s;
      margin-top: 24px;
      text-decoration: none;
      display: block;
      text-align: center;
    }

    .btn-price-outline {
      background: transparent;
      color: var(--primary);
      border: 2px solid var(--primary);
    }

    .btn-price-outline:hover {
      background: var(--primary);
      color: white;
    }

    .btn-price-filled {
      background: var(--primary);
      color: white;
      box-shadow: 0 4px 20px rgba(14, 165, 233, 0.4);
    }

    .btn-price-filled:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      color: white;
    }

    /* ─── CONTACT / FOOTER ─── */
    #contact {
      background: var(--light);
    }

    .contact-card {
      background: white;
      border-radius: var(--radius);
      padding: 40px;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
    }

    .form-label {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 6px;
    }

    .form-control,
    .form-select {
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 11px 16px;
      font-size: 0.9rem;
      color: var(--dark);
      transition: all 0.2s;
      background: white;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12);
      outline: none;
    }

    .btn-submit {
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 12px;
      padding: 14px 36px;
      font-weight: 700;
      font-size: 1rem;
      font-family: 'Sora', sans-serif;
      cursor: pointer;
      transition: all 0.25s;
      box-shadow: 0 4px 16px rgba(14, 165, 233, 0.3);
      width: 100%;
    }

    .btn-submit:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }

    .contact-info-item {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 20px;
    }

    .ci-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: var(--primary-light);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .ci-label {
      font-size: 0.75rem;
      color: var(--muted);
      font-weight: 500;
    }

    .ci-val {
      font-size: 0.92rem;
      font-weight: 700;
      color: var(--dark);
    }

    footer {
      background: var(--dark);
      color: rgba(255, 255, 255, 0.75);
      padding: 60px 0 30px;
    }

    .footer-logo {
      font-family: 'Sora', sans-serif;
      font-weight: 800;
      font-size: 1.4rem;
      color: white;
      margin-bottom: 14px;
    }

    .footer-logo span {
      color: var(--primary);
    }

    .footer-desc {
      font-size: 0.87rem;
      color: rgba(255, 255, 255, 0.55);
      line-height: 1.7;
      max-width: 280px;
    }

    .footer-heading {
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 16px;
    }

    .footer-link {
      display: block;
      color: rgba(255, 255, 255, 0.65);
      font-size: 0.88rem;
      text-decoration: none;
      margin-bottom: 10px;
      transition: color 0.2s;
    }

    .footer-link:hover {
      color: var(--primary);
    }

    .footer-divider {
      border-color: rgba(255, 255, 255, 0.1);
      margin: 40px 0 24px;
    }

    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }

    .footer-copy {
      font-size: 0.82rem;
      color: rgba(255, 255, 255, 0.4);
    }

    .social-link {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.08);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: rgba(255, 255, 255, 0.6);
      text-decoration: none;
      transition: all 0.2s;
      font-size: 0.9rem;
    }

    .social-link:hover {
      background: var(--primary);
      color: white;
    }

    /* ─── CTA BAND ─── */
    .cta-band {
      background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }

    .cta-band::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -10%;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, 0.06);
      border-radius: 50%;
    }

    .cta-band h2 {
      font-size: clamp(1.8rem, 3.5vw, 2.6rem);
      font-weight: 800;
      color: white;
      margin-bottom: 16px;
      letter-spacing: -1px;
    }

    .cta-band p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.05rem;
      margin-bottom: 36px;
    }

    .btn-cta-white {
      background: white;
      color: var(--primary-dark);
      border: none;
      border-radius: 12px;
      padding: 14px 32px;
      font-weight: 700;
      font-size: 1rem;
      font-family: 'Sora', sans-serif;
      cursor: pointer;
      transition: all 0.25s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-cta-white:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.2);
      color: var(--primary-dark);
    }

    .btn-cta-ghost {
      background: transparent;
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.4);
      border-radius: 12px;
      padding: 13px 28px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.25s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-cta-ghost:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.6);
      color: white;
    }

    /* ─── MISC ─── */
    .bg-sky {
      background: rgba(14, 165, 233, 0.1);
    }

    .bg-orange {
      background: rgba(249, 115, 22, 0.1);
    }

    .bg-green {
      background: rgba(16, 185, 129, 0.1);
    }

    .bg-purple {
      background: rgba(139, 92, 246, 0.1);
    }

    .bg-yellow {
      background: rgba(245, 158, 11, 0.1);
    }

    .bg-red {
      background: rgba(239, 68, 68, 0.1);
    }

    .text-sky {
      color: var(--primary);
    }

    .text-orange {
      color: var(--accent);
    }

    .text-green {
      color: var(--success);
    }

    .text-purple {
      color: #8b5cf6;
    }

    .text-yellow {
      color: var(--warning);
    }

    .text-red {
      color: var(--danger);
    }

    .divider-wave {
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--primary), transparent);
      opacity: 0.2;
      margin: 0;
    }



    /* ============================================================
   FILTERBOOK – FULL RESPONSIVE FIX
   Drop this <style> block inside <head> AFTER the existing
   <style> block (or paste rules at the bottom of it).
   ============================================================ */

    /* ── BASE: prevent horizontal overflow everywhere ── */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    html,
    body {
      overflow-x: hidden;
      max-width: 100%;
    }

    img,
    video,
    iframe,
    svg {
      max-width: 100%;
      height: auto;
    }

    /* ── FLOATING BADGES: hide on mobile, show on tablet+ ── */
    .floating-badge {
      display: none;
    }

    @media (min-width: 992px) {
      .floating-badge {
        display: flex;
      }
    }

    /* ── HERO ── */
    @media (max-width: 991px) {
      .hero {
        padding: 60px 0 48px;
        min-height: unset;
      }

      .hero h1 {
        font-size: clamp(1.9rem, 6vw, 2.8rem);
        letter-spacing: -0.8px;
      }

      .hero p.lead {
        font-size: 1rem;
        max-width: 100%;
      }

      .hero-cta-group {
        justify-content: center;
        gap: 10px;
      }

      .btn-primary-hero,
      .btn-secondary-hero {
        padding: 12px 22px;
        font-size: 0.92rem;
      }
    }

    @media (max-width: 575px) {
      .hero {
        padding: 48px 0 40px;
        text-align: center;
      }

      .hero h1 {
        font-size: 1.85rem;
      }

      .hero p.lead {
        font-size: 0.95rem;
      }

      /* CTA buttons: stack on very small screens */
      .hero-cta-group {
        flex-direction: column;
        align-items: center;
      }

      .btn-primary-hero,
      .btn-secondary-hero {
        width: 100%;
        justify-content: center;
      }

      /* Stats: 2×2 grid */
      .hero-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 24px;
        justify-items: center;
        width: 100%;
      }

      .hero-stat {
        align-items: center;
        text-align: center;
      }

      .hero-stat .num {
        font-size: 1.4rem;
      }
    }

    /* ── HERO DASHBOARD MOCKUP ── */
    @media (max-width: 991px) {
      .hero-visual {
        margin-top: 32px;
      }

      .dashboard-mockup {
        border-radius: 14px;
        overflow: hidden;
      }

      .stat-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
      }

      .stat-card {
        padding: 10px 8px;
      }

      .stat-card .s-num {
        font-size: 0.95rem;
      }

      .stat-card .s-lbl {
        font-size: 0.55rem;
      }
    }

    @media (max-width: 575px) {
      .mockup-body {
        padding: 12px;
      }

      .stat-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
      }

      .stat-card {
        padding: 8px 6px;
      }

      .stat-card .s-num {
        font-size: 0.85rem;
      }

      .stat-card .s-icon {
        font-size: 1rem;
      }

      .chart-bar-row {
        height: 48px;
      }
    }

    /* ── SECTION SPACING ── */
    @media (max-width: 767px) {
      section {
        padding: 56px 0;
      }

      .section-title {
        font-size: 1.7rem;
        letter-spacing: -0.5px;
      }

      .section-sub {
        font-size: 0.95rem;
        margin-bottom: 36px;
      }
    }

    @media (max-width: 575px) {
      section {
        padding: 44px 0;
      }

      .section-title {
        font-size: 1.55rem;
      }
    }

    /* ── FEATURES ── */
    @media (max-width: 575px) {
      .feature-card {
        padding: 22px 18px;
      }

      .feature-icon {
        width: 48px;
        height: 48px;
        font-size: 1.3rem;
      }

      .feature-card h5 {
        font-size: 1rem;
      }

      .feature-card p {
        font-size: 0.87rem;
      }
    }

    /* ── DASHBOARD PREVIEW (full mockup) ── */
    @media (max-width: 991px) {
      .dashboard-screen {
        padding: 18px;
      }

      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }
    }

    @media (max-width: 767px) {

      /* Stack sidebar above main content */
      .row>.col-lg-3 .dash-sidebar {
        margin-bottom: 16px;
        border-radius: 14px;
      }

      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
      }

      .kpi-card {
        padding: 12px;
        gap: 8px;
      }

      .kpi-icon {
        width: 34px;
        height: 34px;
        font-size: 0.9rem;
      }

      .kpi-info .num {
        font-size: 1rem;
      }

      .kpi-info .lbl {
        font-size: 0.65rem;
      }

      .dash-nav-item {
        font-size: 0.8rem;
        padding: 8px 10px;
      }

      .dash-title {
        font-size: 1rem;
      }
    }

    @media (max-width: 575px) {
      .dashboard-screen {
        padding: 14px;
        border-radius: 18px;
      }

      .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
      }

      .recent-item {
        flex-wrap: wrap;
        gap: 8px;
      }

      .r-badge {
        margin-left: 0;
      }

      /* Collapse sidebar nav to horizontal scroll row on mobile */
      .dash-sidebar {
        padding: 14px 10px;
        border-radius: 12px;
      }

      .dash-logo {
        padding: 0 10px 14px;
        font-size: 0.9rem;
      }
    }

    /* ── HOW IT WORKS ── */
    @media (max-width: 767px) {
      .step-connector {
        flex-direction: column;
        gap: 8px;
      }

      .step-arrow {
        transform: rotate(90deg);
        padding: 4px 0;
      }

      .step-box {
        padding: 22px 18px;
      }
    }

    /* ── MOBILE APP SECTION ── */
    @media (max-width: 991px) {
      .phone-frame {
        width: 200px;
      }

      .phone-screen {
        min-height: 340px;
      }
    }

    @media (max-width: 575px) {
      .phone-frame {
        width: 185px;
      }

      .app-header p {
        font-size: 0.9rem;
      }

      .app-text {
        font-size: 0.65rem;
      }

      .app-time {
        font-size: 0.6rem;
      }

      /* Feature list on mobile */
      .app-feat-title {
        font-size: 0.85rem;
      }

      .app-feat-desc {
        font-size: 0.75rem;
      }

      .app-feat-icon {
        width: 36px;
        height: 36px;
        font-size: 1rem;
      }

      .app-feature-list li {
        padding: 10px 0;
        gap: 10px;
      }

      /* Store buttons: stack */
      .d-flex.gap-3.mt-4 {
        flex-direction: column;
      }

      .d-flex.gap-3.mt-4 a {
        width: 100%;
        justify-content: center;
      }
    }

    /* ── DIGITAL CATALOG ── */
    @media (max-width: 767px) {
      .catalog-card {
        margin-bottom: 24px;
      }

      .catalog-product {
        flex-wrap: wrap;
        gap: 10px;
      }

      .catalog-product button {
        margin-left: 0 !important;
      }

      .prod-img {
        width: 44px;
        height: 44px;
        font-size: 1.2rem;
      }
    }

    @media (max-width: 575px) {
      .qr-block {
        padding: 18px;
      }

      .qr-code {
        width: 80px;
        height: 80px;
      }

      /* 1-col mini feature grid */
      .row.g-3 .col-sm-6 {
        width: 50%;
      }
    }

    /* ── NOTIFICATIONS ── */
    @media (max-width: 767px) {
      .notif-card {
        flex-wrap: wrap;
        padding: 16px 16px 14px 20px;
        gap: 10px;
      }

      .notif-time {
        margin-left: 0;
        width: 100%;
        text-align: left;
      }

      .notif-content {
        flex: 1;
        min-width: 0;
      }

      .notif-content h6 {
        font-size: 0.88rem;
      }

      .notif-content p {
        font-size: 0.78rem;
      }

      .notif-icon {
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
        border-radius: 10px;
      }
    }

    @media (max-width: 575px) {
      .notif-card {
        padding: 14px 14px 12px 18px;
      }

      .notif-content h6 {
        font-size: 0.84rem;
      }

      .notif-content p {
        font-size: 0.74rem;
      }
    }

    /* ── TESTIMONIALS ── */
    @media (max-width: 767px) {
      .testimonial-card {
        padding: 22px 18px;
      }

      .testimonial-text {
        font-size: 0.88rem;
      }

      .video-testimonial {
        min-height: 200px;
      }
    }

    /* ── PRICING ── */
    @media (max-width: 991px) {
      .pricing-card.featured {
        transform: scale(1);
      }
    }

    @media (max-width: 767px) {
      .pricing-card {
        padding: 28px 22px;
        border-radius: 16px;
      }

      .price-val {
        font-size: 2.2rem;
      }
    }

    @media (max-width: 575px) {
      .pricing-card {
        padding: 24px 18px;
      }

      .price-val {
        font-size: 2rem;
      }

      .btn-price {
        padding: 12px;
        font-size: 0.9rem;
      }
    }

    /* ── CONTACT ── */
    @media (max-width: 767px) {
      .contact-card {
        padding: 24px 20px;
      }

      .contact-card h5 {
        font-size: 1.1rem;
      }
    }

    @media (max-width: 575px) {
      .contact-card {
        padding: 20px 16px;
        border-radius: 16px;
      }

      .form-control,
      .form-select {
        padding: 10px 14px;
        font-size: 0.88rem;
      }

      .btn-submit {
        padding: 12px 24px;
        font-size: 0.92rem;
      }

      .ci-val {
        font-size: 0.85rem;
        word-break: break-word;
      }
    }

    /* ── CTA BAND ── */
    @media (max-width: 767px) {
      .cta-band {
        padding: 60px 0;
      }

      .cta-band h2 {
        font-size: 1.7rem;
      }

      .cta-band p {
        font-size: 0.95rem;
      }

      .btn-cta-white,
      .btn-cta-ghost {
        padding: 12px 22px;
        font-size: 0.9rem;
      }
    }

    @media (max-width: 575px) {
      .cta-band {
        padding: 48px 0;
      }

      .cta-band h2 {
        font-size: 1.5rem;
        letter-spacing: -0.5px;
      }

      /* Stack CTA buttons */
      .cta-band .d-flex {
        flex-direction: column;
        align-items: center;
        gap: 12px !important;
      }

      .btn-cta-white,
      .btn-cta-ghost {
        width: 100%;
        max-width: 320px;
        justify-content: center;
      }
    }

    /* ── FOOTER ── */
    @media (max-width: 767px) {
      footer {
        padding: 48px 0 24px;
      }

      .footer-logo {
        font-size: 1.2rem;
      }

      .footer-desc {
        max-width: 100%;
        font-size: 0.84rem;
      }

      .footer-bottom {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .footer-bottom .d-flex {
        flex-wrap: wrap;
        gap: 12px !important;
      }
    }

    @media (max-width: 575px) {
      footer {
        padding: 40px 0 20px;
      }

      .footer-copy {
        font-size: 0.76rem;
      }

      .footer-link {
        font-size: 0.85rem;
      }

      .social-link {
        width: 32px;
        height: 32px;
        font-size: 0.85rem;
      }
    }

    /* ── FLOATING WHATSAPP BUTTON ── */
    .whatsapp-float {
      position: fixed;
      bottom: 24px;
      right: 24px;
      width: 56px;
      height: 56px;
      background: #25d366;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
      box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
      z-index: 9999;
      text-decoration: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 28px rgba(37, 211, 102, 0.55);
      color: white;
    }

    @media (max-width: 575px) {
      .whatsapp-float {
        width: 50px;
        height: 50px;
        font-size: 1.4rem;
        bottom: 18px;
        right: 18px;
      }
    }

    /* ── NAVBAR MOBILE ── */
    @media (max-width: 991px) {
      .navbar {
        padding: 12px 0;
      }

      .navbar-brand {
        font-size: 1.3rem;
      }
    }

    @media (max-width: 575px) {
      .navbar-brand {
        font-size: 1.2rem;
      }

      .navbar-collapse {
        border-radius: 12px;
        margin-top: 8px;
      }

      .btn-nav {
        border-radius: 10px;
      }
    }

    /* ── HERO STATS: fix 4-stat layout on small screens ── */
    @media (max-width: 575px) {
      .hero-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        width: 100%;
        justify-items: center;
      }
    }

    @media (min-width: 576px) and (max-width: 767px) {
      .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 20px 32px;
        justify-content: center;
      }
    }

    /* ── PREVENT TEXT OVERFLOW in tight spaces ── */
    .notif-content h6,
    .notif-content p,
    .r-name,
    .r-sub,
    .prod-name,
    .prod-desc,
    .ci-val,
    .author-name,
    .author-role,
    .app-feat-title,
    .app-feat-desc {
      word-break: break-word;
      overflow-wrap: anywhere;
    }

    /* ── GENERAL CONTAINER SAFETY ── */
    @media (max-width: 575px) {
      .container {
        padding-left: 16px;
        padding-right: 16px;
      }
    }

    /* MOBILE NAVBAR FIX */
    @media (max-width: 768px) {

      .navbar-collapse {
        background: white;
        border-radius: 16px;
        padding: 15px;
        margin-top: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        animation: slideDown 0.3s ease;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .navbar-nav {
        gap: 8px;
      }

      .nav-link {
        padding: 12px !important;
        border-radius: 10px;
        font-size: 0.95rem;
      }

      .nav-link:hover {
        background: #f1f5f9;
      }

      .btn-nav {
        margin-top: 10px;
        width: 100%;
        text-align: center;
        padding: 12px !important;
        border-radius: 12px;
      }
    }


    @media (max-width: 768px) {
      section {
        padding: 50px 0;
      }

      .container {
        padding-left: 15px;
        padding-right: 15px;
      }

      .hero {
        text-align: center;
      }

      .hero p {
        margin-left: auto;
        margin-right: auto;
      }

      .feature-card,
      .pricing-card,
      .testimonial-card {
        padding: 20px;
        border-radius: 16px;
      }

      .feature-icon {
        width: 50px;
        height: 50px;
      }

      .section-title {
        font-size: 1.8rem;
      }
    }

    @media (max-width: 576px) {

      .hero-badge,
      .section-label {
        font-size: 0.76rem;
      }

      .section-title {
        font-size: 2rem;
        letter-spacing: -0.6px;
      }

      .section-sub {
        font-size: 0.95rem;
      }

      .hero-stats,
      .stat-grid,
      .kpi-grid {
        grid-template-columns: 1fr;
      }

      .step-box {
        padding: 22px 18px;
      }

      .dashboard-screen {
        padding: 18px;
      }

      .dash-sidebar {
        padding: 16px 12px;
      }

      .dash-nav-item {
        font-size: 0.78rem;
        padding: 9px 12px;
      }

      .mockup-chart,
      .dash-sidebar,
      .dash-main,
      .contact-card {
        border-radius: 18px;
      }

      .notif-card {
        padding: 16px 16px 14px 18px;
      }

      .notif-time {
        margin-left: 0;
        width: auto;
        font-size: 0.7rem;
      }

      .notif-content {
        width: calc(100% - 54px);
      }

      .testimonial-card,
      .feature-card,
      .pricing-card {
        padding: 20px 18px;
      }

      .testimonial-text,
      .feature-card p,
      .price-feature {
        font-size: 0.84rem;
      }

      .author-name {
        font-size: 0.84rem;
      }

      .author-role {
        font-size: 0.72rem;
      }

      .video-testimonial {
        min-height: 240px;
      }

      .mockup-title {
        font-size: 0.78rem;
      }

      .footer .container,
      footer .container {
        overflow: hidden;
      }

      .footer-desc {
        max-width: 100%;
      }

      .ci-val {
        font-size: 0.88rem;
        word-break: break-word;
      }

      textarea.form-control {
        min-height: 120px;
      }

      .cta-band {
        padding: 56px 0;
      }

      .cta-band p {
        font-size: 0.95rem;
      }
    }

    /* Scroll animations */
    .reveal {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .reveal-left {
      opacity: 0;
      transform: translateX(-30px);
      transition: all 0.6s ease;
    }

    .reveal-left.visible {
      opacity: 1;
      transform: translateX(0);
    }

    .reveal-right {
      opacity: 0;
      transform: translateX(30px);
      transition: all 0.6s ease;
    }

    .reveal-right.visible {
      opacity: 1;
      transform: translateX(0);
    }

    @media (max-width: 768px) {

      .step-connector {
        flex-direction: column;
      }

      .step-arrow {
        transform: rotate(90deg);
        margin: 10px 0;
      }
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="<?= site_url(); ?>">Filter<span>Book</span></a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
        aria-label="Toggle navigation">
        <i class="bi bi-list fs-4"></i>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto align-items-center gap-1">
          <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#demo">Demo</a></li>
          <li class="nav-item"><a class="nav-link" href="#how">How It Works</a></li>
          <li class="nav-item"><a class="nav-link" href="#app">App</a></li>
          <li class="nav-item"><a class="nav-link" href="#testimonials">Reviews</a></li>
          <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
          <li class="nav-item ms-2">
            <a class="nav-link btn-nav" href="<?= site_url('admin/sign_up'); ?>">Start Free Trial</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- ==================== HERO ==================== -->
  <section class="hero" id="home">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="hero-badge">
            <span class="dot"></span>
            Trusted by 500+ RO Businesses Across India
          </div>
          <h1>Smart CRM Built for <span class="highlight">RO Water Purifier</span> Businesses</h1>
          <p class="lead">FilterBook helps RO shop owners manage customers, service schedules, EMI collections,
            complaints & billing — all in one place. Less paperwork. More business.</p>
          <div class="hero-cta-group">
            <a href="<?= site_url('admin/sign_up'); ?>" class="btn-primary-hero" aria-label="Start Free Trial">
              <i class="bi bi-rocket-takeoff-fill"></i>
              Start Free Trial
            </a>
            <a href="#demo" class="btn-secondary-hero" aria-label="Watch Demo Video">
              <i class="bi bi-play-circle-fill text-primary"></i>
              Watch Demo
            </a>
          </div>
          <div class="hero-stats">
            <div class="hero-stat">
              <span class="num">500+</span>
              <span class="label">Active Businesses</span>
            </div>
            <div class="hero-stat">
              <span class="num">50K+</span>
              <span class="label">Customers Managed</span>
            </div>
            <div class="hero-stat">
              <span class="num">99.9%</span>
              <span class="label">Uptime SLA</span>
            </div>
            <div class="hero-stat">
              <span class="num">4.9 ★</span>
              <span class="label">App Store Rating</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="hero-visual">
            <!-- Floating Badges -->
            <div class="floating-badge badge-1">
              <div class="badge-icon bg-green text-green"><i class="bi bi-check-circle-fill"></i></div>
              <div>
                <div style="font-size:0.75rem;color:#334155;">Service Completed</div>
                <div style="font-size:0.68rem;color:#64748b;">Rajesh Kumar • Just now</div>
              </div>
            </div>
            <div class="floating-badge badge-2">
              <div class="badge-icon bg-orange text-orange"><i class="bi bi-bell-fill"></i></div>
              <div>
                <div style="font-size:0.75rem;color:#334155;">3 EMIs Due Today</div>
                <div style="font-size:0.68rem;color:#64748b;">₹8,500 pending</div>
              </div>
            </div>
            <!-- Dashboard Mockup -->
            <div class="dashboard-mockup">
              <div class="mockup-header">
                <div class="mockup-dot" style="background:#ef4444;"></div>
                <div class="mockup-dot" style="background:#f59e0b;"></div>
                <div class="mockup-dot" style="background:#10b981;"></div>
                <span class="mockup-title">FilterBook Dashboard</span>
              </div>
              <div class="mockup-body">
                <div class="stat-grid">
                  <div class="stat-card">
                    <div class="s-icon">👥</div>
                    <div class="s-num" style="color:#0ea5e9;">1,247</div>
                    <div class="s-lbl">Total Customers</div>
                  </div>
                  <div class="stat-card">
                    <div class="s-icon">📦</div>
                    <div class="s-num" style="color:#8b5cf6;">342</div>
                    <div class="s-lbl">Total Orders</div>
                  </div>
                  <div class="stat-card">
                    <div class="s-icon">🔧</div>
                    <div class="s-num" style="color:#f59e0b;">28</div>
                    <div class="s-lbl">Upcoming Services</div>
                  </div>
                  <div class="stat-card">
                    <div class="s-icon">💳</div>
                    <div class="s-num" style="color:#ef4444;">12</div>
                    <div class="s-lbl">EMI Due</div>
                  </div>
                  <div class="stat-card">
                    <div class="s-icon">📋</div>
                    <div class="s-num" style="color:#10b981;">8</div>
                    <div class="s-lbl">AMC Upcoming</div>
                  </div>
                  <div class="stat-card">
                    <div class="s-icon">⚠️</div>
                    <div class="s-num" style="color:#f97316;">5</div>
                    <div class="s-lbl">Open Complaints</div>
                  </div>
                </div>
                <div class="mockup-chart">
                  <div style="font-size:0.72rem;font-weight:700;color:#334155;">Monthly Revenue</div>
                  <div class="chart-bar-row">
                    <div class="chart-bar" style="height:40%;background:#bfdbfe;"></div>
                    <div class="chart-bar" style="height:65%;background:#93c5fd;"></div>
                    <div class="chart-bar" style="height:50%;background:#bfdbfe;"></div>
                    <div class="chart-bar" style="height:80%;background:#60a5fa;"></div>
                    <div class="chart-bar" style="height:70%;background:#93c5fd;"></div>
                    <div class="chart-bar" style="height:100%;background:#0ea5e9;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== MOBILE APP ==================== -->
  <section id="app">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal-left">
          <span class="section-label">📱 Mobile App</span>
          <h2 class="section-title">Manage Your RO Business From Anywhere</h2>
          <p style="color:var(--muted);line-height:1.7;margin-bottom:32px;">
            No more missed services or forgotten EMIs. FilterBook's mobile app keeps you updated and in control —
            whether you're at a customer's home, on the road, or relaxing at home.
          </p>
          <ul class="app-feature-list">
            <li>
              <div class="app-feat-icon bg-sky"><i class="bi bi-bell-fill text-sky"></i></div>
              <div>
                <div class="app-feat-title">Real-Time Push Notifications</div>
                <div class="app-feat-desc">Get instant alerts for upcoming services, EMI due dates, new complaints, and
                  order updates — never miss anything important.</div>
              </div>
            </li>
            <li>
              <div class="app-feat-icon bg-green"><i class="bi bi-qr-code-scan text-green"></i></div>
              <div>
                <div class="app-feat-title">QR-Based Complaint System</div>
                <div class="app-feat-desc">Customers scan the QR code on their unit and raise complaints instantly — no
                  phone calls, no confusion, no delays.</div>
              </div>
            </li>
            <li>
              <div class="app-feat-icon bg-orange"><i class="bi bi-whatsapp text-orange"></i></div>
              <div>
                <div class="app-feat-title">WhatsApp Invoice Sharing</div>
                <div class="app-feat-desc">Send invoices and payment reminders directly on WhatsApp in one tap — the way
                  your customers already communicate.</div>
              </div>
            </li>
            <li>
              <div class="app-feat-icon bg-purple"><i class="bi bi-graph-up-arrow text-purple"></i></div>
              <div>
                <div class="app-feat-title">Daily Sales & Revenue Reports</div>
                <div class="app-feat-desc">Check daily, weekly, and monthly business performance with simple charts —
                  know exactly where your business stands.</div>
              </div>
            </li>
          </ul>
          <div class="d-flex gap-3 mt-4">
            <a href="https://play.google.com/store/apps/details?id=com.visiontechnolabs.filterbook&pcampaignid=web_share" class="btn btn-dark d-flex align-items-center gap-2"
              style="border-radius:12px;padding:10px 20px;" aria-label="Download on Google Play">
              <i class="bi bi-google-play fs-5"></i>
              <div style="text-align:left;">
                <div style="font-size:0.65rem;opacity:0.7;">Get it on</div>
                <div style="font-size:0.85rem;font-weight:700;">Google Play</div>
              </div>
            </a>
            <a href="#" class="btn btn-dark d-flex align-items-center gap-2"
              style="border-radius:12px;padding:10px 20px;" aria-label="Download on App Store">
              <i class="bi bi-apple fs-5"></i>
              <div style="text-align:left;">
                <div style="font-size:0.65rem;opacity:0.7;">Download on</div>
                <div style="font-size:0.85rem;font-weight:700;">App Store</div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-6 reveal-right">
          <div class="row g-3 justify-content-center">
            <div class="col-auto">
              <div class="phone-frame">
                <div class="phone-screen">
                  <div class="phone-notch"></div>
                  <div class="phone-content">
                    <div class="app-header">
                      <h6>Today's Alerts</h6>
                      <p>6 notifications</p>
                    </div>
                    <div class="app-card">
                      <div class="app-card-title">UPCOMING SERVICES</div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#0ea5e9;"></div>
                        <div class="app-text">Priya Sharma – Service Due</div>
                        <div class="app-time">Today</div>
                      </div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#f59e0b;"></div>
                        <div class="app-text">Rohit Verma – Filter Change</div>
                        <div class="app-time">Tomorrow</div>
                      </div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#10b981;"></div>
                        <div class="app-text">Anita Joshi – AMC Renewal</div>
                        <div class="app-time">Apr 10</div>
                      </div>
                    </div>
                    <div class="app-card">
                      <div class="app-card-title">EMI COLLECTIONS</div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#ef4444;"></div>
                        <div class="app-text">Suresh Patel – ₹1,500</div>
                        <div class="app-time">Overdue</div>
                      </div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#f97316;"></div>
                        <div class="app-text">Meena Rao – ₹2,000</div>
                        <div class="app-time">Due Today</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto d-none d-sm-block" style="margin-top:40px;">
              <div class="phone-frame" style="width:190px;">
                <div class="phone-screen" style="min-height:340px;">
                  <div class="phone-notch"></div>
                  <div class="phone-content">
                    <div class="app-header" style="background:#8b5cf6;">
                      <h6>Complaints</h6>
                      <p>5 Open</p>
                    </div>
                    <div class="app-card">
                      <div class="app-card-title">RECENT COMPLAINTS</div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#ef4444;"></div>
                        <div class="app-text">Low pressure issue</div>
                        <div class="app-time">2h ago</div>
                      </div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#f59e0b;"></div>
                        <div class="app-text">Leakage in pipe</div>
                        <div class="app-time">5h ago</div>
                      </div>
                      <div class="app-list-item">
                        <div class="app-dot" style="background:#10b981;"></div>
                        <div class="app-text">Filter replaced ✓</div>
                        <div class="app-time">Yesterday</div>
                      </div>
                    </div>
                    <div style="text-align:center;padding:12px 0;">
                      <div
                        style="width:80px;height:80px;background:#f8fafc;border:2px solid #e2e8f0;border-radius:12px;margin:0 auto;display:flex;align-items:center;justify-content:center;font-size:2.2rem;">
                        <i class="bi bi-qr-code" style="color:#8b5cf6;"></i>
                      </div>
                      <div style="font-size:0.7rem;color:#64748b;margin-top:8px;font-weight:600;">Scan to Raise
                        Complaint</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- FEATURES -->
  <section id="features">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">⚡ Features</span>
        <h2 class="section-title">Everything Your RO Business Needs</h2>
        <p class="section-sub">From customer onboarding to service reminders and digital catalogs — FilterBook has every
          tool to run your business smoothly.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4 reveal">
          <div class="feature-card">
            <div class="feature-icon bg-sky"><i class="bi bi-people-fill text-sky"></i></div>
            <h5>Customer & Order Management</h5>
            <p>Add customers, manage profiles, track orders with EMI or cash payment options. Full order history at your
              fingertips.</p>
            <span class="feature-tag">Core Feature</span>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.1s">
          <div class="feature-card">
            <div class="feature-icon bg-green"><i class="bi bi-file-earmark-text-fill text-green"></i></div>
            <h5>Auto Invoice Generation</h5>
            <p>Automatically generate professional invoices for every order. Send directly to customers via WhatsApp in
              one click.</p>
            <span class="feature-tag">Saves Time</span>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.2s">
          <div class="feature-card">
            <div class="feature-icon bg-orange"><i class="bi bi-qr-code-scan text-orange"></i></div>
            <h5>QR-Based Complaint System</h5>
            <p>Each order has a QR code. Customers scan it to raise complaints directly. Manage and resolve them from
              your dashboard.</p>
            <span class="feature-tag">Customer Delight</span>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.1s">
          <div class="feature-card">
            <div class="feature-icon bg-purple"><i class="bi bi-grid-1x2-fill text-purple"></i></div>
            <h5>Digital Product Catalog</h5>
            <p>Create a stunning digital catalog with your products, prices, and store details. Share via QR code to get
              more inquiries.</p>
            <span class="feature-tag">Boost Sales</span>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.2s">
          <div class="feature-card">
            <div class="feature-icon bg-yellow"><i class="bi bi-bell-fill text-yellow"></i></div>
            <h5>Smart Notifications</h5>
            <p>Never miss a service, EMI, or AMC. Get timely reminders so you can proactively contact customers before
              they call you.</p>
            <span class="feature-tag">Stay Ahead</span>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.3s">
          <div class="feature-card">
            <div class="feature-icon bg-red"><i class="bi bi-phone-fill text-red"></i></div>
            <h5>Mobile App Included</h5>
            <p>Access everything on the go with our powerful mobile app. Manage customers, view complaints, and check
              reports anywhere.</p>
            <span class="feature-tag">Android & iOS</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- DASHBOARD PREVIEW -->
  <section id="dashboard">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">📊 Dashboard</span>
        <h2 class="section-title">A Command Center for Your Business</h2>
        <p class="section-sub">Get a bird's-eye view of your entire business — customers, orders, services, complaints,
          and revenue — all in one place.</p>
      </div>
      <div class="row g-4 reveal">
        <div class="col-lg-3">
          <div class="dash-sidebar h-100">
            <div class="dash-logo">📌 FilterBook</div>
            <div class="dash-nav-item active"><i class="bi bi-speedometer2"></i> Dashboard</div>
            <div class="dash-nav-item"><i class="bi bi-people"></i> Customers</div>
            <div class="dash-nav-item"><i class="bi bi-bag-check"></i> Orders</div>
            <div class="dash-nav-item"><i class="bi bi-tools"></i> Services</div>
            <div class="dash-nav-item"><i class="bi bi-chat-dots"></i> Complaints</div>
            <div class="dash-nav-item"><i class="bi bi-grid"></i> Catalog</div>
            <div class="dash-nav-item"><i class="bi bi-bell"></i> Alerts <span class="badge bg-danger ms-1"
                style="font-size:0.65rem;">5</span></div>
            <div class="dash-nav-item"><i class="bi bi-bar-chart"></i> Reports</div>
            <div style="margin-top:auto;padding-top:20px;border-top:1px solid rgba(255,255,255,0.1);margin-top:16px;">
              <div class="dash-nav-item"><i class="bi bi-gear"></i> Settings</div>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="dash-main">
            <div class="dash-header">
              <div>
                <div class="dash-title">Good Morning, Ramesh! 👋</div>
                <div class="dash-date">Tuesday, April 07, 2026</div>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm"
                  style="background:#e0f2fe;color:#0284c7;border:none;border-radius:8px;font-size:0.78rem;font-weight:600;padding:6px 14px;"><i
                    class="bi bi-plus"></i> Add Customer</button>
                <button class="btn btn-sm"
                  style="background:#f0fdf4;color:#059669;border:none;border-radius:8px;font-size:0.78rem;font-weight:600;padding:6px 14px;"><i
                    class="bi bi-download"></i> Export</button>
              </div>
            </div>
            <div class="kpi-grid mb-3">
              <div class="kpi-card">
                <div class="kpi-icon bg-sky"><i class="bi bi-people-fill text-sky"></i></div>
                <div class="kpi-info">
                  <div class="num">1,247</div>
                  <div class="lbl">Total Customers</div>
                </div>
              </div>
              <div class="kpi-card">
                <div class="kpi-icon bg-purple"><i class="bi bi-bag-check-fill text-purple"></i></div>
                <div class="kpi-info">
                  <div class="num">342</div>
                  <div class="lbl">Total Orders</div>
                </div>
              </div>
              <div class="kpi-card">
                <div class="kpi-icon bg-yellow"><i class="bi bi-wrench-adjustable-circle-fill text-yellow"></i></div>
                <div class="kpi-info">
                  <div class="num">28</div>
                  <div class="lbl">Upcoming Services</div>
                </div>
              </div>
              <div class="kpi-card">
                <div class="kpi-icon bg-red"><i class="bi bi-credit-card-fill text-red"></i></div>
                <div class="kpi-info">
                  <div class="num">12</div>
                  <div class="lbl">EMI Due This Week</div>
                </div>
              </div>
              <div class="kpi-card">
                <div class="kpi-icon bg-green"><i class="bi bi-clipboard-check-fill text-green"></i></div>
                <div class="kpi-info">
                  <div class="num">8</div>
                  <div class="lbl">AMC Renewals Due</div>
                </div>
              </div>
              <div class="kpi-card">
                <div class="kpi-icon bg-orange"><i class="bi bi-exclamation-triangle-fill text-orange"></i></div>
                <div class="kpi-info">
                  <div class="num">5</div>
                  <div class="lbl">Open Complaints</div>
                </div>
              </div>
            </div>
            <div class="recent-list">
              <div class="recent-header">Recent Complaints</div>
              <div class="recent-item">
                <div class="r-avatar" style="background:#0ea5e9;">RK</div>
                <div>
                  <div class="r-name">Rajesh Kumar</div>
                  <div class="r-sub">Water not filtering properly • Order #1042</div>
                </div>
                <span class="r-badge bg-warning text-dark">Pending</span>
              </div>
              <div class="recent-item">
                <div class="r-avatar" style="background:#8b5cf6;">PS</div>
                <div>
                  <div class="r-name">Priya Sharma</div>
                  <div class="r-sub">Filter replacement needed • Order #1038</div>
                </div>
                <span class="r-badge bg-danger text-white">Urgent</span>
              </div>
              <div class="recent-item">
                <div class="r-avatar" style="background:#10b981;">AM</div>
                <div>
                  <div class="r-name">Amit Mehta</div>
                  <div class="r-sub">General service request • Order #1031</div>
                </div>
                <span class="r-badge bg-success text-white">Resolved</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section id="how">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">🚀 How It Works</span>
        <h2 class="section-title">Get Started in 4 Simple Steps</h2>
        <p class="section-sub">FilterBook is designed for non-technical business owners. No training required — just
          sign up and start managing.</p>
      </div>
      <div class="d-flex flex-column flex-md-row gap-2 align-items-stretch reveal">
        <div class="step-box">
          <div class="step-num">1</div>
          <div class="step-icon">🏪</div>
          <h6>Set Up Your Shop</h6>
          <p>Register your business, add your logo, store details, and configure your preferences in under 5 minutes.
          </p>
        </div>
        <div class="step-arrow d-none d-md-flex align-items-center"><i
            class="bi bi-arrow-right-circle-fill text-muted"></i></div>
        <div class="step-box">
          <div class="step-num">2</div>
          <div class="step-icon">👥</div>
          <h6>Add Your Customers</h6>
          <p>Import or manually add your existing customers. Track their orders, payment type, and service schedule.</p>
        </div>
        <div class="step-arrow d-none d-md-flex align-items-center"><i
            class="bi bi-arrow-right-circle-fill text-muted"></i></div>
        <div class="step-box">
          <div class="step-num">3</div>
          <div class="step-icon">📲</div>
          <h6>Share QR & Catalog</h6>
          <p>Every order gets a QR code. Share your digital catalog QR in-store or on WhatsApp to attract more buyers.
          </p>
        </div>
        <div class="step-arrow d-none d-md-flex align-items-center"><i
            class="bi bi-arrow-right-circle-fill text-muted"></i></div>
        <div class="step-box">
          <div class="step-num">4</div>
          <div class="step-icon">📈</div>
          <h6>Grow Your Business</h6>
          <p>Get daily alerts, never miss a service, collect payments on time, and watch your customer satisfaction
            soar.</p>
        </div>
      </div>
    </div>
  </section>



  <!-- DIGITAL CATALOG -->
  <section id="catalog">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal-left">
          <div class="row g-3">
            <div class="col-12">
              <div class="catalog-card">
                <div class="catalog-header">
                  <h6>Ramesh RO Solutions</h6>
                  <h4>📋 Our Product Catalog</h4>
                </div>
                <div class="catalog-body">
                  <div class="catalog-product">
                    <div class="prod-img">💧</div>
                    <div>
                      <div class="prod-name">AquaPure 7-Stage RO</div>
                      <div class="prod-desc">75 GPD | UV + TDS | Wall Mount</div>
                      <div class="prod-price">₹8,500</div>
                    </div>
                    <button class="btn btn-sm ms-auto"
                      style="background:#e0f2fe;color:#0284c7;border:none;border-radius:8px;font-size:0.72rem;font-weight:700;">Enquire</button>
                  </div>
                  <div class="catalog-product">
                    <div class="prod-img">🚿</div>
                    <div>
                      <div class="prod-name">ClearFlow UF System</div>
                      <div class="prod-desc">Gravity Fed | No Electricity</div>
                      <div class="prod-price">₹4,200</div>
                    </div>
                    <button class="btn btn-sm ms-auto"
                      style="background:#e0f2fe;color:#0284c7;border:none;border-radius:8px;font-size:0.72rem;font-weight:700;">Enquire</button>
                  </div>
                  <div class="catalog-product">
                    <div class="prod-img">🔩</div>
                    <div>
                      <div class="prod-name">RO Membrane Filter</div>
                      <div class="prod-desc">75 GPD | Compatible</div>
                      <div class="prod-price">₹850</div>
                    </div>
                    <button class="btn btn-sm ms-auto"
                      style="background:#e0f2fe;color:#0284c7;border:none;border-radius:8px;font-size:0.72rem;font-weight:700;">Enquire</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal-right">
          <span class="section-label">🛒 Digital Catalog</span>
          <h2 class="section-title">Turn Your Store Into a 24/7 Digital Shop</h2>
          <p style="color:var(--muted);line-height:1.7;margin-bottom:28px;">Create a beautiful digital product catalog
            with all your RO products. Share one QR code and customers can browse, see pricing, and contact you
            directly.</p>
          <div class="row g-3 mb-4">
            <div class="col-sm-6">
              <div style="background:white;border:1px solid var(--border);border-radius:14px;padding:18px;">
                <div style="font-size:1.4rem;margin-bottom:8px;">📲</div>
                <div style="font-size:0.88rem;font-weight:700;color:var(--dark);margin-bottom:4px;">One QR Code</div>
                <div style="font-size:0.78rem;color:var(--muted);">Print on banners, visiting cards, or WhatsApp status
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div style="background:white;border:1px solid var(--border);border-radius:14px;padding:18px;">
                <div style="font-size:1.4rem;margin-bottom:8px;">🛍️</div>
                <div style="font-size:0.88rem;font-weight:700;color:var(--dark);margin-bottom:4px;">Instant Inquiries
                </div>
                <div style="font-size:0.78rem;color:var(--muted);">Customer taps "Enquire" and it opens your WhatsApp
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div style="background:white;border:1px solid var(--border);border-radius:14px;padding:18px;">
                <div style="font-size:1.4rem;margin-bottom:8px;">✏️</div>
                <div style="font-size:0.88rem;font-weight:700;color:var(--dark);margin-bottom:4px;">Easy to Update</div>
                <div style="font-size:0.78rem;color:var(--muted);">Add, remove, or update products anytime from the app
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div style="background:white;border:1px solid var(--border);border-radius:14px;padding:18px;">
                <div style="font-size:1.4rem;margin-bottom:8px;">🏪</div>
                <div style="font-size:0.88rem;font-weight:700;color:var(--dark);margin-bottom:4px;">Store Profile</div>
                <div style="font-size:0.78rem;color:var(--muted);">Your shop address, photos, and contact on catalog
                  page</div>
              </div>
            </div>
          </div>
          <div class="qr-block">
            <div class="qr-code">
              <i class="bi bi-qr-code" style="color:var(--primary);font-size:2.5rem;"></i>
            </div>
            <div style="font-size:0.88rem;font-weight:700;color:var(--dark);margin-bottom:4px;">Your Catalog QR Code
            </div>
            <div style="font-size:0.78rem;color:var(--muted);">Generated automatically. Replace with your real QR after
              setup.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- NOTIFICATIONS -->
  <section id="notifications">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-5 reveal-left">
          <span class="section-label">🔔 Smart Alerts</span>
          <h2 class="section-title">Never Miss a Follow-Up Again</h2>
          <p style="color:var(--muted);line-height:1.7;margin-bottom:28px;">FilterBook sends you smart, timely
            notifications so you can proactively serve customers — before they even think to call you. Build trust and
            increase retention.</p>
          <div class="d-flex align-items-center gap-3 mb-4 p-4"
            style="background:var(--primary-light);border-radius:16px;border:1px solid rgba(14,165,233,0.2);">
            <div style="font-size:2rem;">🎯</div>
            <div>
              <div style="font-size:0.9rem;font-weight:700;color:var(--dark);">Businesses using FilterBook alerts report
              </div>
              <div style="font-size:1.3rem;font-weight:800;color:var(--primary);font-family:'Sora',sans-serif;">40%
                better customer retention</div>
            </div>
          </div>
          <ul style="list-style:none;padding:0;margin:0;">
            <li style="display:flex;align-items:center;gap:10px;margin-bottom:10px;font-size:0.9rem;color:var(--mid);">
              <i class="bi bi-check-circle-fill text-green"></i> Customizable notification timing (1 day, 3 days, 1 week
              before)
            </li>
            <li style="display:flex;align-items:center;gap:10px;margin-bottom:10px;font-size:0.9rem;color:var(--mid);">
              <i class="bi bi-check-circle-fill text-green"></i> Push notifications + in-app alerts
            </li>
            <li style="display:flex;align-items:center;gap:10px;font-size:0.9rem;color:var(--mid);">
              <i class="bi bi-check-circle-fill text-green"></i> Complaint alerts with customer details
            </li>
          </ul>
        </div>
        <div class="col-lg-7 reveal-right">
          <div class="notif-card service">
            <div class="notif-badge" style="background:var(--primary);"></div>
            <div class="notif-icon bg-sky"><i class="bi bi-wrench-adjustable-circle-fill text-sky"></i></div>
            <div class="notif-content">
              <h6>Service Due Tomorrow</h6>
              <p>Priya Sharma – 12 Month Service | Order #1042 | Contact: 98765 43210</p>
            </div>
            <div class="notif-time">Tomorrow, 9 AM</div>
          </div>
          <div class="notif-card emi">
            <div class="notif-badge" style="background:var(--warning);"></div>
            <div class="notif-icon bg-yellow"><i class="bi bi-credit-card-fill text-yellow"></i></div>
            <div class="notif-content">
              <h6>EMI Collection Due</h6>
              <p>Suresh Patel – ₹2,000 EMI | Installment 3 of 10 | Order #1038</p>
            </div>
            <div class="notif-time">Today, 10 AM</div>
          </div>
          <div class="notif-card complaint">
            <div class="notif-badge" style="background:var(--danger);"></div>
            <div class="notif-icon bg-red"><i class="bi bi-exclamation-triangle-fill text-red"></i></div>
            <div class="notif-content">
              <h6>New Complaint Raised</h6>
              <p>Rajesh Kumar – "Water tastes bad" | Scanned QR from Order #1035</p>
            </div>
            <div class="notif-time">2 hours ago</div>
          </div>
          <div class="notif-card amc">
            <div class="notif-badge" style="background:var(--success);"></div>
            <div class="notif-icon bg-green"><i class="bi bi-clipboard-check-fill text-green"></i></div>
            <div class="notif-content">
              <h6>AMC Renewal in 7 Days</h6>
              <p>Anita Joshi – Annual Maintenance Contract expiring April 14 | Order #1020</p>
            </div>
            <div class="notif-time">Apr 14</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section id="testimonials">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">⭐ Testimonials</span>
        <h2 class="section-title">Loved by RO Business Owners</h2>
        <p class="section-sub">Hear from real business owners who transformed their operations with FilterBook.</p>
      </div>
      <div class="row g-4 mb-5">
        <div class="col-md-4 reveal">
          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <div class="quote-icon">"</div>
            <p class="testimonial-text">FilterBook completely changed how I run my RO service business. I used to forget
              service dates all the time — now I get alerts 3 days before. My customers love the quick complaint
              resolution!</p>
            <div class="testimonial-author">
              <div class="author-avatar" style="background:#0ea5e9;">RK</div>
              <div>
                <div class="author-name">Ramesh Khatri</div>
                <div class="author-role">RO Service Owner, Ahmedabad</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.1s">
          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <div class="quote-icon">"</div>
            <p class="testimonial-text">The digital catalog feature is a game-changer! I printed the QR code on my
              visiting cards and started getting WhatsApp inquiries from customers who had never even visited my shop.
            </p>
            <div class="testimonial-author">
              <div class="author-avatar" style="background:#8b5cf6;">SG</div>
              <div>
                <div class="author-name">Sunita Gupta</div>
                <div class="author-role">Water Purifier Retailer, Jaipur</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.2s">
          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <div class="quote-icon">"</div>
            <p class="testimonial-text">Managing 600+ customers was a nightmare in Excel. Now with FilterBook, EMI
              tracking and invoice WhatsApp sharing saves me 3 hours every single day. Best investment I made this year!
            </p>
            <div class="testimonial-author">
              <div class="author-avatar" style="background:#10b981;">AM</div>
              <div>
                <div class="author-name">Arjun Mehta</div>
                <div class="author-role">RO Distributor, Surat</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Video Testimonials -->
      <div class="text-center mb-4 reveal">
        <h5 style="font-weight:700;color:var(--dark);">Watch Video Testimonials</h5>
        <p style="color:var(--muted);font-size:0.9rem;">Real stories from real business owners</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4 reveal">
          <div class="video-testimonial">
            <div class="video-thumb d-flex align-items-center justify-content-center">
              <div style="text-align:center;">
                <div style="font-size:3rem;margin-bottom:12px;">🎬</div>
                <div class="play-btn mx-auto"><i class="bi bi-play-fill ms-1"></i></div>
              </div>
            </div>
            <div class="video-duration">0:28</div>
            <div class="video-overlay">
              <h6>Ramesh Khatri shares his experience</h6>
              <p>RO Service, Ahmedabad • Replace with actual video</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.1s">
          <div class="video-testimonial" style="background:linear-gradient(135deg,#1e1b4b,#312e81);">
            <div class="video-thumb d-flex align-items-center justify-content-center">
              <div style="text-align:center;">
                <div style="font-size:3rem;margin-bottom:12px;">📹</div>
                <div class="play-btn mx-auto"><i class="bi bi-play-fill ms-1"></i></div>
              </div>
            </div>
            <div class="video-duration">0:32</div>
            <div class="video-overlay">
              <h6>Sunita Gupta talks about catalog feature</h6>
              <p>Water Purifier Retail, Jaipur • Replace with actual video</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.2s">
          <div class="video-testimonial" style="background:linear-gradient(135deg,#064e3b,#065f46);">
            <div class="video-thumb d-flex align-items-center justify-content-center">
              <div style="text-align:center;">
                <div style="font-size:3rem;margin-bottom:12px;">🎥</div>
                <div class="play-btn mx-auto"><i class="bi bi-play-fill ms-1"></i></div>
              </div>
            </div>
            <div class="video-duration">0:30</div>
            <div class="video-overlay">
              <h6>Arjun Mehta on EMI & billing automation</h6>
              <p>RO Distributor, Surat • Replace with actual video</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section id="pricing">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">💰 Pricing</span>
        <h2 class="section-title">Simple, Transparent Pricing</h2>
        <p class="section-sub">Start free, upgrade when you're ready. No hidden charges. Cancel anytime.</p>
      </div>
      <div class="row g-4 justify-content-center align-items-stretch">
        <div class="col-md-4 reveal">
          <div class="pricing-card">
            <div class="price-plan">Starter</div>
            <div class="price-val">299</div>
            <div class="price-period">Forever, up to 50 customers</div>
            <hr class="price-divider">
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Up to 50 Customers</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Basic Dashboard</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Order Management</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Invoice Generation</div>
            <div class="price-feature" style="opacity:0.35;"><i class="bi bi-x-circle-fill"
                style="color:var(--muted)!important;"></i> QR Complaint System</div>
            <div class="price-feature" style="opacity:0.35;"><i class="bi bi-x-circle-fill"
                style="color:var(--muted)!important;"></i> Digital Catalog</div>
            <div class="price-feature" style="opacity:0.35;"><i class="bi bi-x-circle-fill"
                style="color:var(--muted)!important;"></i> Smart Notifications</div>
            <a href="<?= site_url('admin/login'); ?>" class="btn-price btn-price-outline">Get Started Free</a>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.1s">
          <div class="pricing-card featured">
            <div class="pricing-badge">Most Popular</div>
            <div class="price-plan" style="color:rgba(255,255,255,0.6)!important;">Professional</div>
            <div class="price-val" style="color:white!important;">₹1299 <span
                style="font-size:1rem;font-weight:400;">/mo</span></div>
            <div class="price-period" style="color:rgba(255,255,255,0.6)!important;">Unlimited customers</div>
            <hr class="price-divider" style="border-color:rgba(255,255,255,0.15)!important;">
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> Unlimited Customers</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> Full Dashboard & Reports</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> EMI + Cash Orders</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> WhatsApp Invoice Sharing</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> QR Complaint System</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> Digital Product Catalog</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> Smart Notifications</div>
            <div class="price-feature" style="color:white!important;"><i class="bi bi-check-circle-fill"
                style="color:#34d399!important;"></i> Mobile App (Android + iOS)</div>
            <a href="<?= site_url('admin/login'); ?>" class="btn-price btn-price-filled">Start 14-Day Free Trial</a>
          </div>
        </div>
        <div class="col-md-4 reveal" style="transition-delay:0.2s">
          <div class="pricing-card">
            <div class="price-plan">Enterprise</div>
            <div class="price-val">2,499</div>
            <div class="price-period">For large distributors & franchises</div>
            <hr class="price-divider">
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Everything in Pro</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Multiple Branch Support</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Team Member Access</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Custom Branding</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Priority Support</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> API Access</div>
            <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Dedicated Account Manager</div>
            <a href="<?= site_url('admin/login'); ?>" class="btn-price btn-price-outline">Contact Sales</a>
          </div>
        </div>
      </div>
      <div class="text-center mt-4 reveal">
        <p style="font-size:0.85rem;color:var(--muted);">
          <i class="bi bi-shield-check text-green"></i> 14-day free trial &nbsp;•&nbsp;
          <i class="bi bi-arrow-counterclockwise text-primary"></i> No credit card required &nbsp;•&nbsp;
          <i class="bi bi-x-circle text-orange"></i> Cancel anytime
        </p>
      </div>
    </div>
  </section>

  <!-- CTA BAND -->
  <div class="cta-band">
    <div class="container text-center">
      <h2 class="reveal">Ready to Transform Your RO Business?</h2>
      <p class="reveal">Join 500+ businesses already growing smarter with FilterBook. Start your free trial today — no
        credit card needed.</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap reveal">
        <a href="<?= site_url('admin/login'); ?>" class="btn-cta-white">
          <i class="bi bi-rocket-takeoff-fill"></i>
          Start Free Trial
        </a>
        <a href="tel:+918128966157" class="btn-cta-ghost">
          <i class="bi bi-telephone-fill"></i>
          Call Us:+918128966157
        </a>
      </div>
    </div>
  </div>

  <!-- CONTACT -->
  <section id="contact">
    <div class="container">
      <div class="text-center reveal">
        <span class="section-label">📬 Contact Us</span>
        <h2 class="section-title">Get in Touch</h2>
        <p class="section-sub">Have questions? Want a demo? Our team is ready to help you get started.</p>
      </div>
      <div class="row g-5 align-items-start">
        <div class="col-lg-7 reveal-left">
          <div class="contact-card">
            <h5 style="font-weight:700;margin-bottom:24px;">Send Us a Message</h5>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Your Name</label>
                <input type="text" class="form-control" placeholder="Ramesh Kumar">
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" placeholder="+91 98765 43210">
              </div>
              <div class="col-12">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="ramesh@yourshop.com">
              </div>
              <div class="col-md-6">
                <label class="form-label">Business Type</label>
                <select class="form-select">
                  <option>RO Service Provider</option>
                  <option>RO Retailer / Distributor</option>
                  <option>Franchise / Multi-Branch</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Number of Customers</label>
                <select class="form-select">
                  <option>Less than 50</option>
                  <option>50 – 200</option>
                  <option>200 – 500</option>
                  <option>500+</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Message (Optional)</label>
                <textarea class="form-control" rows="4"
                  placeholder="Tell us about your business or ask any question..."></textarea>
              </div>
              <div class="col-12">
                <button class="btn-submit" onclick="alert('Thank you! We will contact you within 24 hours.')">
                  <i class="bi bi-send-fill me-2"></i>Send Message & Get Free Demo
                </button>
                <p style="font-size:0.78rem;color:var(--muted);text-align:center;margin-top:12px;margin-bottom:0;">
                  We respond within 24 hours · No spam, ever
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 reveal-right">
          <div class="contact-info-item">
            <div class="ci-icon"><i class="bi bi-telephone-fill"></i></div>
            <div>
              <div class="ci-label">Call / WhatsApp</div>
              <div class="ci-val">+918128966157</div>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="ci-icon"><i class="bi bi-envelope-fill"></i></div>
            <div>
              <div class="ci-label">Email Us</div>
              <div class="ci-val">support@filterbook.in</div>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div>
              <div class="ci-label">Office</div>
              <div class="ci-val">Ahmedabad, Gujarat, India</div>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="ci-icon"><i class="bi bi-clock-fill"></i></div>
            <div>
              <div class="ci-label">Support Hours</div>
              <div class="ci-val">Mon–Sat, 9 AM – 7 PM</div>
            </div>
          </div>
          <div
            style="background:var(--primary-light);border-radius:16px;padding:24px;border:1px solid rgba(14,165,233,0.2);margin-top:24px;">
            <div style="font-size:1.5rem;margin-bottom:12px;">💬</div>
            <h6 style="font-weight:700;color:var(--dark);margin-bottom:8px;">Prefer WhatsApp?</h6>
            <p style="font-size:0.85rem;color:var(--muted);margin-bottom:16px;">Chat with us instantly on WhatsApp.
              Quick replies, product demos, and onboarding support.</p>
            <a href="https://wa.me/+918128966157" target="_blank" class="btn-primary-hero"
              style="font-size:0.88rem;padding:10px 22px;">
              <i class="bi bi-whatsapp"></i> Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4">
          <div class="footer-logo">Filter<span>Book</span></div>
          <p class="footer-desc">The complete CRM software designed specifically for RO (water purifier) service
            businesses. Manage customers, services, complaints, and billing — all in one place.</p>
          <div class="d-flex gap-2 mt-3">
            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
            <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
            <a href="#" class="social-link"><i class="bi bi-whatsapp"></i></a>
            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="col-sm-4 col-lg-2">
          <div class="footer-heading">Product</div>
          <a class="footer-link" href="#features">Features</a>
          <a class="footer-link" href="#dashboard">Dashboard</a>
          <a class="footer-link" href="#app">Mobile App</a>
          <a class="footer-link" href="#catalog">Catalog</a>
          <a class="footer-link" href="#pricing">Pricing</a>
        </div>
        <div class="col-sm-4 col-lg-2">
          <div class="footer-heading">Company</div>
          <a class="footer-link" href="#">About Us</a>
          <a class="footer-link" href="#">Blog</a>
          <a class="footer-link" href="#">Careers</a>
          <a class="footer-link" href="#">Press</a>
          <a class="footer-link" href="#contact">Contact</a>
        </div>
        <!-- <div class="col-sm-4 col-lg-2">
        <div class="footer-heading">Support</div>
        <a class="footer-link" href="#">Help Center</a>
        <a class="footer-link" href="#">Video Tutorials</a>
        <a class="footer-link" href="#">WhatsApp Support</a>
        <a class="footer-link" href="#">API Docs</a>
        <a class="footer-link" href="#">Status</a>
      </div> -->
        <div class="col-lg-2">
          <div class="footer-heading">Download App</div>
          <a href="https://play.google.com/store/apps/details?id=com.visiontechnolabs.filterbook&pcampaignid=web_share" class="footer-link d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-google-play" style="font-size:1.1rem;color:var(--primary);"></i> Google Play
          </a>
          <a href="#" class="footer-link d-flex align-items-center gap-2">
            <i class="bi bi-apple" style="font-size:1.1rem;color:white;"></i> App Store
          </a>
        </div>
      </div>
      <hr class="footer-divider">
      <div class="footer-bottom">
        <div class="footer-copy">© 2026 FilterBook. All rights reserved. Made with ❤️ in India.</div>
        <div class="d-flex gap-3">
          <a class="footer-link mb-0" href="<?= site_url('privacy-policy'); ?>" style="font-size:0.78rem;">Privacy
            Policy</a>
          <a class="footer-link mb-0" href="<?= site_url('terms-and-conditions'); ?>" style="font-size:0.78rem;">Terms &
            Conditions</a>
          <a class="footer-link mb-0" href="<?= site_url('refund-policy'); ?>" style="font-size:0.78rem;">Refund
            Policy</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12 });
    revealEls.forEach(el => observer.observe(el));

    // Smooth active nav
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 100) current = s.id;
      });
      navLinks.forEach(l => {
        l.classList.remove('active');
        if (l.getAttribute('href') === '#' + current) l.classList.add('active');
      });
    });

    // Counter animation
    function animateCounter(el, target) {
      let start = 0;
      const duration = 1500;
      const step = target / (duration / 16);
      const timer = setInterval(() => {
        start += step;
        if (start >= target) { el.textContent = el.dataset.suffix ? target + el.dataset.suffix : target + (el.dataset.plus ? '+' : ''); clearInterval(timer); }
        else { el.textContent = Math.floor(start) + (el.dataset.plus ? '+' : ''); }
      }, 16);
    }

    // Navbar collapse on link click (mobile)
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        const nav = document.getElementById('nav');
        if (nav.classList.contains('show')) {
          const toggler = document.querySelector('.navbar-toggler');
          toggler.click();
        }
      });
    });
  </script>
  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/+918128966157?text=Hi%2C%20I%20want%20to%20know%20more%20about%20FilterBook" target="_blank"
    class="whatsapp-float" aria-label="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>
</body>

</html>