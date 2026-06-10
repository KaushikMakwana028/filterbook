<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png">

	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />

	<style>
		:root {
			--login-primary: #4361ee;
			--login-primary-dark: #3a0ca3;
			--login-surface: rgba(255, 255, 255, 0.9);
			--bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
		}

		body {
			font-family: 'Plus Jakarta Sans', sans-serif;
			background: var(--bg-gradient);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0;
			overflow-x: hidden;
		}

		/* Animated Background Blobs */
		.bg-blobs {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -1;
			overflow: hidden;
		}

		.blob {
			position: absolute;
			width: 400px;
			height: 400px;
			background: rgba(67, 97, 238, 0.15);
			filter: blur(80px);
			border-radius: 50%;
			z-index: -1;
		}

		/* Glassmorphism Card */
		.login-panel {
			border: 1px solid rgba(255, 255, 255, 0.4);
			border-radius: 24px;
			background: var(--login-surface);
			backdrop-filter: blur(15px);
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
			transition: all 0.3s ease;
			width: 100%;
			max-width: 450px;
		}

		.login-top {
			padding: 40px 40px 20px;
			text-align: center;
		}

		.login-brand img {
			max-height: 60px;
			margin-bottom: 20px;
			filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.05));
		}

		.login-heading h5 {
			font-weight: 700;
			color: #1a1a1a;
			margin-bottom: 10px;
		}

		.login-heading p {
			color: #6c757d;
			font-size: 0.9rem;
			line-height: 1.5;
		}

		.login-form-wrap {
			padding: 0 40px 40px;
		}

		/* Form Styling */
		.form-label {
			font-weight: 600;
			font-size: 0.85rem;
			color: #444;
			margin-bottom: 8px;
		}

		.form-control {
			border-radius: 12px;
			padding: 12px 16px;
			border: 1.5px solid #eee;
			background: #fff;
			transition: all 0.2s ease;
		}

		.form-control:focus {
			border-color: var(--login-primary);
			box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
		}

		/* intl-tel-input adjustment */
		.iti {
			width: 100%;
		}

		.iti__selected-dial-code {
			font-weight: 600;
		}

		.input-group-text {
			background: #fff;
			border-left: none;
			border-radius: 0 12px 12px 0;
			cursor: pointer;
			color: #666;
		}

		.password-field {
			border-right: none;
		}

		.btn-primary {
			background: var(--login-primary);
			border: none;
			padding: 12px;
			border-radius: 12px;
			font-weight: 700;
			letter-spacing: 0.5px;
			transition: all 0.3s ease;
			margin-top: 10px;
		}

		.btn-primary:hover {
			background: var(--login-primary-dark);
			transform: translateY(-2px);
			box-shadow: 0 8px 15px rgba(67, 97, 238, 0.3);
		}

		.forgot-link {
			font-size: 0.85rem;
			color: var(--login-primary);
			text-decoration: none;
			font-weight: 600;
		}

		.login-footer-note {
			text-align: center;
			font-size: 0.9rem;
			margin-top: 20px;
			color: #666;
		}

		/* Alert Styling */
		.alert {
			border-radius: 15px;
			margin: 20px;
			border: none;
		}

		@media (max-width: 576px) {
			.login-panel {
				border-radius: 0;
				min-height: 100vh;
				display: flex;
				flex-direction: column;
				justify-content: center;
			}

			.login-top,
			.login-form-wrap {
				padding: 30px 20px;
			}

			body {
				background: #fff;
			}

			.blob {
				display: none;
			}
		}
	</style>

	<title>Panel Login | Filter Book</title>
</head>

<body>
	<div class="bg-blobs">
		<div class="blob" style="top: -10%; right: -5%;"></div>
		<div class="blob" style="bottom: -10%; left: -5%; background: rgba(0, 166, 166, 0.1);"></div>
	</div>

	<div class="container d-flex justify-content-center">
		<div class="card login-panel">

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success alert-dismissible fade show">
					<i class="bx bxs-check-circle me-2"></i> <?= $this->session->flashdata('success'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<i class="bx bxs-error me-2"></i> <?= $this->session->flashdata('error'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>

			<div class="login-top">
				<div class="login-brand">
					<img src="<?= base_url('assets/images/filtter-logo.png'); ?>" alt="Logo" />
				</div>
				<div class="login-heading">
					<h5><?= isset($user_data['store_name']) ? $user_data['store_name'] : 'Filter Book' ?> Panel Login
					</h5>
					<p>Login with admin or super admin details to continue.</p>
				</div>
			</div>

			<div class="login-form-wrap">
				<form id="loginForm" class="row g-3 needs-validation" action="<?= site_url('admin/login') ?>"
					method="post" novalidate>

					<div class="col-12">
						<label class="form-label">Mobile Number</label>
						<input type="tel" id="inputMobile" name="mobile" class="form-control" required>
						<div class="invalid-feedback">Please enter your mobile number.</div>
					</div>

					<div class="col-12">
						<div class="d-flex justify-content-between">
							<label class="form-label">Password</label>
							<a href="<?= site_url('forgot_password') ?>" id="forgotPasswordLink"
								class="forgot-link">Forgot?</a>
						</div>
						<div class="input-group has-validation" id="show_hide_password">
							<input type="password" name="password" class="form-control password-field"
								placeholder="     " required>
							<span class="input-group-text"><i class='bx bx-hide'></i></span>
						</div>
						<div class="invalid-feedback">Password is required.</div>
					</div>

					<div class="col-12">
						<button type="submit" class="btn btn-primary w-100">Sign In</button>
					</div>

					<div class="login-footer-note">
						New here? <a href="<?= site_url('admin/sign_up'); ?>" class="forgot-link">Create account</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).ready(function () {
			var $passwordField = $('input[name="password"]');
			$passwordField.attr('placeholder', '');
			$passwordField.attr('autocomplete', 'new-password');
			$passwordField.val('');

			// Password Toggle
			$("#show_hide_password span").on('click', function (e) {
				let input = $(this).siblings('input');
				let icon = $(this).find('i');
				if (input.attr("type") == "text") {
					input.attr('type', 'password');
					icon.addClass("bx-hide").removeClass("bx-show");
				} else {
					input.attr('type', 'text');
					icon.removeClass("bx-hide").addClass("bx-show");
				}
			});

			// Intl-Tel-Input
			var input = document.querySelector("#inputMobile");
			var iti = window.intlTelInput(input, {
				initialCountry: "in",
				separateDialCode: true,
				utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
			});

			// Form Submit Logic
			$("#loginForm").on("submit", function (e) {
				var mobileValue = (input.value || '').replace(/\D/g, '');
				var passwordValue = ($passwordField.val() || '').trim();

				if (mobileValue === '' || passwordValue === '' || this.checkValidity() === false) {
					e.preventDefault();
					e.stopPropagation();
				}
				$(this).addClass('was-validated');
				// Number processing
				input.value = mobileValue;
			});

			// Auto-hide Alerts
			setTimeout(() => {
				$('.alert').fadeOut('slow');
			}, 4000);

		});
	</script>
</body>

</html>