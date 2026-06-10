<?php
$page_title = 'Terms and Conditions';
$page_heading = 'Terms and Conditions';
$page_intro = 'These terms govern the use of the FilterBook website, landing pages, and software services by visitors, trial users, and subscribed customers.';
$last_updated = '08 April 2026';
$this->load->view('public/partials/header', compact('page_title'));
?>

<main class="legal-shell">
  <div class="container">
    <div class="legal-hero">
      <div class="legal-badge"><i class="bi bi-file-earmark-text"></i> Public Legal Page</div>
      <h1><?= html_escape($page_heading); ?></h1>
      <p><?= html_escape($page_intro); ?></p>
    </div>

    <div class="legal-card">
      <div class="legal-meta"><i class="bi bi-calendar3"></i> Last updated: <?= html_escape($last_updated); ?></div>

      <section class="legal-section">
        <h2>1. Acceptance of Terms</h2>
        <p>By accessing or using FilterBook, you agree to these terms and conditions. If you do not agree, please do not use the website or software.</p>
      </section>

      <section class="legal-section">
        <h2>2. Service Usage</h2>
        <p>FilterBook is intended for lawful business use. You agree not to misuse the platform, interfere with operations, attempt unauthorized access, or upload harmful content.</p>
      </section>

      <section class="legal-section">
        <h2>3. Account Responsibility</h2>
        <p>You are responsible for maintaining the confidentiality of your login credentials and for all activity performed through your account.</p>
      </section>

      <section class="legal-section">
        <h2>4. Subscription and Billing</h2>
        <p>Paid features may require an active subscription. Pricing, duration, and plan availability may be updated by the company. Access to premium features may end when a subscription expires or is cancelled.</p>
      </section>

      <section class="legal-section">
        <h2>5. Intellectual Property</h2>
        <p>All software, branding, design, and content related to FilterBook remain the property of the company unless otherwise stated. Users may not copy, resell, or redistribute the platform without permission.</p>
      </section>

      <section class="legal-section">
        <h2>6. Limitation of Liability</h2>
        <p>FilterBook is provided on an as-available basis. To the maximum extent allowed by law, we are not liable for indirect, incidental, or consequential losses arising from the use of the platform.</p>
      </section>

      <section class="legal-section">
        <h2>7. Changes to Terms</h2>
        <p>We may revise these terms from time to time. Continued use of the platform after updates means you accept the revised terms.</p>
      </section>
    </div>
  </div>
</main>

<?php $this->load->view('public/partials/footer'); ?>
