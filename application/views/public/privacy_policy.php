<?php
$page_title = 'Privacy Policy';
$page_heading = 'Privacy Policy';
$page_intro = 'This page explains what information FilterBook collects, how it is used, and how we protect it when visitors and customers use our website and software.';
$last_updated = '08 April 2026';
$this->load->view('public/partials/header', compact('page_title'));
?>

<main class="legal-shell">
  <div class="container">
    <div class="legal-hero">
      <div class="legal-badge"><i class="bi bi-shield-lock"></i> Public Legal Page</div>
      <h1><?= html_escape($page_heading); ?></h1>
      <p><?= html_escape($page_intro); ?></p>
    </div>

    <div class="legal-card">
      <div class="legal-meta"><i class="bi bi-calendar3"></i> Last updated: <?= html_escape($last_updated); ?></div>

      <section class="legal-section">
        <h2>1. Information We Collect</h2>
        <p>We may collect contact details such as your name, mobile number, email address, business name, billing information, and the data you enter into the FilterBook platform, including customers, products, services, complaints, AMC contracts, and payment records.</p>
      </section>

      <section class="legal-section">
        <h2>2. How We Use Your Information</h2>
        <p>We use the information to provide our CRM services, improve product experience, support user accounts, process subscriptions, send service updates, and maintain platform security.</p>
      </section>

      <section class="legal-section">
        <h2>3. Data Sharing</h2>
        <p>We do not sell your personal information. Data may be shared only with trusted service providers who support hosting, messaging, payment processing, or technical operations, and only where required to operate the service.</p>
      </section>

      <section class="legal-section">
        <h2>4. Data Security</h2>
        <p>We take reasonable administrative and technical measures to protect your information from unauthorized access, misuse, or disclosure. However, no online system can guarantee absolute security.</p>
      </section>

      <section class="legal-section">
        <h2>5. Your Rights</h2>
        <p>You may request access, correction, or deletion of your account information, subject to operational and legal requirements. For account-related requests, contact us through the details provided on the website.</p>
      </section>

      <section class="legal-section">
        <h2>6. Policy Updates</h2>
        <p>We may update this Privacy Policy from time to time. Updated versions will be posted on this page with the revised effective date.</p>
      </section>
    </div>
  </div>
</main>

<?php $this->load->view('public/partials/footer'); ?>
