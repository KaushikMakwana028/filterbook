  <footer>
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4">
          <div class="footer-logo">Filter<span>Book</span></div>
          <p class="footer-desc">The complete CRM software designed specifically for RO (water purifier) service businesses. Manage customers, services, complaints, and billing - all in one place.</p>
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
          <a class="footer-link" href="<?= site_url(); ?>#features">Features</a>
          <a class="footer-link" href="<?= site_url(); ?>#dashboard">Dashboard</a>
          <a class="footer-link" href="<?= site_url(); ?>#app">Mobile App</a>
          <a class="footer-link" href="<?= site_url(); ?>#catalog">Catalog</a>
          <a class="footer-link" href="<?= site_url(); ?>#pricing">Pricing</a>
        </div>
        <div class="col-sm-4 col-lg-2">
          <div class="footer-heading">Company</div>
          <a class="footer-link" href="#">About Us</a>
          <a class="footer-link" href="#">Blog</a>
          <a class="footer-link" href="#">Careers</a>
          <a class="footer-link" href="#">Press</a>
          <a class="footer-link" href="<?= site_url(); ?>#contact">Contact</a>
        </div>
        <div class="col-lg-2">
          <div class="footer-heading">Download App</div>
          <a href="#" class="footer-link d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-google-play" style="font-size:1.1rem;color:var(--primary);"></i> Google Play
          </a>
          <a href="#" class="footer-link d-flex align-items-center gap-2">
            <i class="bi bi-apple" style="font-size:1.1rem;color:white;"></i> App Store
          </a>
        </div>
      </div>
      <hr class="footer-divider">
      <div class="footer-bottom">
        <div class="footer-copy">© 2026 FilterBook. All rights reserved. Made with love in India.</div>
        <div class="d-flex gap-3">
          <a class="footer-link mb-0" href="<?= site_url('privacy-policy'); ?>" style="font-size:0.82rem;">Privacy Policy</a>
          <a class="footer-link mb-0" href="<?= site_url('terms-and-conditions'); ?>" style="font-size:0.82rem;">Terms & Conditions</a>
          <a class="footer-link mb-0" href="<?= site_url('refund-policy'); ?>" style="font-size:0.82rem;">Refund Policy</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        const nav = document.getElementById('nav');
        if (nav && nav.classList.contains('show')) {
          const toggler = document.querySelector('.navbar-toggler');
          if (toggler) {
            toggler.click();
          }
        }
      });
    });
  </script>
</body>

</html>
