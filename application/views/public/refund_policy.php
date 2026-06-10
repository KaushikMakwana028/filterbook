<?php
$page_title = 'Refund Policy';
$page_heading = 'Refund Policy';
$page_intro = 'This page explains the refund rules for FilterBook subscriptions and any plan-related payments made through the platform.';
$last_updated = '08 April 2026';
$this->load->view('public/partials/header', compact('page_title'));
?>

<main class="legal-shell">
  <div class="container">
    <div class="legal-hero">
      <div class="legal-badge"><i class="bi bi-arrow-counterclockwise"></i> Public Legal Page</div>
      <h1><?= html_escape($page_heading); ?></h1>
      <p><?= html_escape($page_intro); ?></p>
    </div>

    <div class="legal-card">
      <div class="legal-meta"><i class="bi bi-calendar3"></i> Last updated: <?= html_escape($last_updated); ?></div>

      <section class="legal-section">
        <h2>1. Subscription Payments</h2>
        <p>Subscription payments made for FilterBook plans are generally non-refundable once the plan has been activated, unless a refund is required by applicable law or approved by the company in a special case.</p>
      </section>

      <section class="legal-section">
        <h2>2. Trial Access</h2>
        <p>Where a free trial is offered, users are encouraged to evaluate the service during the trial period before purchasing a paid plan.</p>
      </section>

      <section class="legal-section">
        <h2>3. Duplicate or Incorrect Charges</h2>
        <p>If you believe you were charged incorrectly or more than once for the same plan, you should contact support with payment details so the issue can be reviewed promptly.</p>
      </section>

      <section class="legal-section">
        <h2>4. Cancellation</h2>
        <p>Cancelling a plan will normally stop future renewals or future purchases, but it does not automatically create a refund for the current billing period.</p>
      </section>

      <section class="legal-section">
        <h2>5. Refund Processing</h2>
        <p>If a refund is approved, it will be processed through the original payment method within a reasonable business period, subject to banking or payment gateway timelines.</p>
      </section>

      <section class="legal-section">
        <h2>6. Contact for Refund Requests</h2>
        <p>To request a billing review, please contact the FilterBook support or sales team with your business name, registered mobile number, payment reference, and the reason for the request.</p>
      </section>
    </div>
  </div>
</main>

<?php $this->load->view('public/partials/footer'); ?>
