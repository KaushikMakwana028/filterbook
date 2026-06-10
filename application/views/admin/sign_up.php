<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --input-focus: #764ba2;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8f9fa;
            background-image: radial-gradient(at 0% 0%, rgba(102, 126, 234, 0.15) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(118, 75, 162, 0.15) 0, transparent 50%);
            min-height: 100vh;
        }

        .auth-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(10px);
            background: var(--glass-bg);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            background: #fdfdfd;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
            border-color: var(--input-focus);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(118, 75, 162, 0.3);
        }

        .brand-logo {
            max-width: 180px;
            margin-bottom: 20px;
        }

        .input-group-text {
            border-radius: 0 12px 12px 0 !important;
            cursor: pointer;
            background: #fdfdfd;
        }

        /* Phone Input Adjustment */
        .iti {
            width: 100% !important;
        }

        .iti__flag-container {
            border-radius: 12px 0 0 12px;
        }

        /* Floating Animation for Alert */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #dc3545;
            margin-top: 6px;
        }

        .form-control.is-invalid,
        .iti input.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.08) !important;
        }
    </style>

    <title>Admin Registration | Syndron</title>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center py-5" style="min-height: 100vh;">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 text-white bg-success">
                        <div class="d-flex align-items-center">
                            <i class='bx bxs-check-circle me-2 fs-4'></i>
                            <div><?= $this->session->flashdata('success'); ?></div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card auth-card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center">
                            <img src="<?= base_url('assets/images/filtter-logo.png'); ?>" class="brand-logo" alt="Logo">
                            <h4 class="fw-bold text-dark">Create Account</h4>
                            <p class="text-muted small">Join our admin network today</p>
                        </div>

                        <form class="row g-4 mt-2 needs-validation" id="registerForm"
                            action="<?= site_url('admin/sign_up') ?>" method="post" novalidate>

                            <?php $usernameError = form_error('username') ?: (!empty($custom_errors['username']) ? $custom_errors['username'] : ''); ?>
                            <?php $storeNameError = form_error('store_name') ?: (!empty($custom_errors['store_name']) ? $custom_errors['store_name'] : ''); ?>
                            <?php $emailError = form_error('email') ?: (!empty($custom_errors['email']) ? $custom_errors['email'] : ''); ?>
                            <?php $mobileError = form_error('mobile') ?: (!empty($custom_errors['mobile']) ? $custom_errors['mobile'] : ''); ?>
                            <?php $passwordError = form_error('password') ?: (!empty($custom_errors['password']) ? $custom_errors['password'] : ''); ?>
                            <?php $confirmPasswordError = form_error('confirm_password') ?: (!empty($custom_errors['confirm_password']) ? $custom_errors['confirm_password'] : ''); ?>

                            <div class="col-12">
                                <label class="form-label fw-600">Username</label>
                                <input type="text" class="form-control <?= $usernameError !== '' ? 'is-invalid' : '' ?>"
                                    name="username" placeholder="e.g. JohnDoe"
                                    value="<?= html_escape(set_value('username')); ?>" required>
                                <div class="invalid-feedback">
                                    <?= $usernameError !== '' ? strip_tags($usernameError) : 'Username is required.'; ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Store Name</label>
                                <input type="text"
                                    class="form-control <?= $storeNameError !== '' ? 'is-invalid' : '' ?>"
                                    name="store_name" placeholder="Official Store Name"
                                    value="<?= html_escape(set_value('store_name')); ?>" required>
                                <div class="invalid-feedback">
                                    <?= $storeNameError !== '' ? strip_tags($storeNameError) : 'Store name is required.'; ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control <?= $emailError !== '' ? 'is-invalid' : '' ?>"
                                    name="email" placeholder="name@company.com"
                                    value="<?= html_escape(set_value('email')); ?>" required>
                                <div class="invalid-feedback">
                                    <?= $emailError !== '' ? strip_tags($emailError) : 'Please enter a valid email address.'; ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Mobile Number</label>
                                <input type="tel" id="inputMobile" name="mobile"
                                    class="form-control <?= $mobileError !== '' ? 'is-invalid' : '' ?>"
                                    value="<?= html_escape(set_value('mobile')); ?>" required>
                                <div class="invalid-feedback">
                                    <?= $mobileError !== '' ? strip_tags($mobileError) : 'Please enter a valid mobile number.'; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <div class="input-group has-validation" id="show_hide_password">
                                    <input type="password"
                                        class="form-control border-end-0 <?= $passwordError !== '' ? 'is-invalid' : '' ?>"
                                        name="password" id="passInput" required>
                                    <a class="input-group-text"><i class='bx bx-hide'></i></a>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $passwordError !== '' ? strip_tags($passwordError) : 'Password is required and must be at least 6 characters.'; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Confirm</label>
                                <div class="input-group has-validation" id="show_hide_password_confirm">
                                    <input type="password"
                                        class="form-control border-end-0 <?= $confirmPasswordError !== '' ? 'is-invalid' : '' ?>"
                                        name="confirm_password" required>
                                    <a class="input-group-text"><i class='bx bx-hide'></i></a>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $confirmPasswordError !== '' ? strip_tags($confirmPasswordError) : 'Confirm password is required and must match password.'; ?>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm">Complete
                                    Registration</button>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <p class="mb-0 text-muted small">Already have an account?
                                    <a href="<?= base_url('admin'); ?>"
                                        class="text-primary fw-bold text-decoration-none">Sign in</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>

    <script>
        $(document).ready(function () {
            // Password Toggle Logic
            function togglePassword(containerId) {
                $(`#${containerId} a`).on('click', function (e) {
                    e.preventDefault();
                    let input = $(`#${containerId} input`);
                    let icon = $(`#${containerId} i`);
                    if (input.attr("type") === "text") {
                        input.attr('type', 'password');
                        icon.addClass("bx-hide").removeClass("bx-show");
                    } else {
                        input.attr('type', 'text');
                        icon.removeClass("bx-hide").addClass("bx-show");
                    }
                });
            }
            togglePassword('show_hide_password');
            togglePassword('show_hide_password_confirm');

            // Intl-Tel-Input initialization
            var input = document.querySelector("#inputMobile");
            var iti = window.intlTelInput(input, {
                initialCountry: "in",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
            });

            input.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
                $(this).removeClass('is-invalid');
            });

            $('#registerForm input').on('input', function () {
                $(this).removeClass('is-invalid');
            });

            // Form Submit Logic
            $("#registerForm").on("submit", function (e) {
                var mobileNumber = (input.value || '').replace(/\D/g, '');
                var password = ($("#passInput").val() || '').trim();
                var confirmPassword = ($('input[name="confirm_password"]').val() || '').trim();

                if (
                    !this.checkValidity() ||
                    mobileNumber.length < 10 ||
                    password.length < 6 ||
                    confirmPassword === '' ||
                    password !== confirmPassword
                ) {
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    input.value = mobileNumber;
                }
                $(this).addClass('was-validated');
            });

            // Auto-hide alerts
            setTimeout(() => {
                $(".alert").fadeOut(500, function () { $(this).remove(); });
            }, 4000);
        });
    </script>
</body>

</html>